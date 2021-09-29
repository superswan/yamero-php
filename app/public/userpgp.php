<?php $title = 'Yamero! - PGP Key'; 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} else {
    include("header.php");
    include("navbar.php");
}

?>
<div class="container">
    <div class="wrapper">
    <h2> Validate your key </h2>
    <p class="lead">Please provide your PGP Public key. You will be asked to decrypt a message with your private key and enter a code in order to verify ownership of the key.</p>
    <?php include("userverification.php"); ?>
</div>
</div>

<?php include("footer.php"); ?>