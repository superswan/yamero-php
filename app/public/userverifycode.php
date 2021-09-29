<?php
session_start();

require_once "dbconfig.php";

$title = 'Yamero! - PGP Key'; include("header.php"); include("navbar.php");
$success_msg = "";

function tokenGen($length = 16) {
    #this is a much better method compared to uniqid
    if (function_exists("random_bytes")) {
        $bytes = random_bytes(ceil($length / 2));
    } elseif (function_exists("openssl_random_pseudo_bytes")) {
        $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
    } else {
        throw new Exception("no cryptographically secure random function available");
    }
    return substr(bin2hex($bytes), 0, $length);
}
function run($cmd) {
    $result = null;
    $output = null;
    shell_exec($cmd);
    return shell_exec($cmd);
}

function encryptToken($str, $recipient) {
    $cmd = sprintf('echo "%s" | gpg --encrypt --armor -r %s --homedir=/var/www/.gnupg --always-trust', $str, $recipient);
    $token = run($cmd);
    return $token;
}

//Initialize pubKey and message
if($_SERVER["REQUEST_METHOD"] == "POST"){

    //Verify the generated token upon submission and associate with user ID
    if (isset($_POST['verify-token'])) {
        $submitted_token = $_POST['verify-token'];
        $verify_token = $_SESSION['verify-token'];

        if ($submitted_token === $verify_token) {
            
            $sql = "INSERT INTO userpubkeys (user_id, fingerprint) VALUES (:user_id, :fingerprint)";
            
            if ($stmt = $pdo->prepare($sql)) {
                $param_user_id = $_SESSION['id'];
                $param_fingerprint = $_SESSION['fingerprint'];

                $stmt->bindValue(':user_id', $param_user_id);
                $stmt->bindValue(':fingerprint', $param_fingerprint);

                if($stmt->execute()){
                    echo $success_msg = "<span class='success'>Key with fingerprint: $param_fingerprint has been successfully added to your account.</span>";
                }
            }

        } else {
            echo "Invalid verification code.";
        }
        exit;
    }

$pubKey = "";

putenv("GNUPGHOME=/var/www/.gnupg");

// create GnuPG object
$gpg = new gnupg();

$gpg->seterrormode(gnupg::ERROR_EXCEPTION);
$gpg -> setsignmode(gnupg::SIG_MODE_CLEAR); 
$gpg -> setarmor(1);


$pubKey = htmlspecialchars($_POST['public-key']);
    if (!is_null($pubKey)) {
        $info = $gpg->import($pubKey);
        if ($info) {
            if ($info['imported'] === 1 || $info['unchanged'] === 1){
                $fingerprint = $info['fingerprint'];

                //Check for duplicate fingerprint before continuing
                $sql = "SELECT fingerprint FROM userpubkeys WHERE fingerprint = :fingerprint";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':fingerprint', $fingerprint);
                if ($stmt->execute()) {
                    $result = $stmt->fetchColumn();
                    if (!empty($result)) {
                       echo "<span class='invalid-feedback'>This key is already associated with an account. Please use a different key.</span>";
                       exit;
                    }
                }

                $gpg->addencryptkey($fingerprint);
                $verify_token = tokenGen();
                $encrypted_token = $gpg->encrypt($verify_token);
                $gpg->clearencryptkeys();

                $_SESSION['verify-token'] = $verify_token;
                $_SESSION['fingerprint'] = $fingerprint;

            } else {
                print_r($info);
            }
    } else {
        var_dump($info);
        echo 'oops';
    }
    }
}

?>
<div class="container">
<h3>Decrypt this message and submit the token to verify ownership of key with fingerprint: <pre><?php echo $fingerprint;?></pre> </h3>
                <textarea rows="18" cols="84"><?php echo $encrypted_token; ?></textarea>
                <form action='' method='post'>
                <label for='verify-token'>Verify Token: </label>
                <input type='text' id='verify-token' name='verify-token'>
                <input type='submit' value='Submit'>
                </form>
</div>


<?php include("footer.php"); ?>
