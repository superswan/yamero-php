
<h3>Email Address / Key ID / Fingerprint</h3>

<form method="post" action="">
<textarea rows="10" cols="50" name="public-key" id="public-key"></textarea>

<h3>Message to Encrypt</h3>
<textarea rows="20" cols="50" name="message" id="message-to-encrypt"></textarea>
<br>
<input type="submit" name="button" id="gpg-submit" value="Submit"/>
</form>
<?php

//Initialize pubKey and message
if($_SERVER["REQUEST_METHOD"] == "POST"){
$pubKey = $message = [];

putenv("GNUPGHOME=/var/www/.gnupg");

// create GnuPG object
$gpg = new gnupg();

$gpg->seterrormode(gnupg::ERROR_EXCEPTION);

$pubKey = htmlspecialchars($_POST['public-key']);

//plaintext
$plaintext = $_POST['message'];

if (!is_null($pubKey) || !is_null($message)) {
    try {
        $gpg->import($pubKey);
        $gpg->addencryptkey($pubKey);
        $encrypted_message = $gpg->encrypt($plaintext);
        echo $encrypted_message;
    } catch (Excepton $e) {
        die('ERROR: ' . $e->getMessage());
    }
}
}

?>

