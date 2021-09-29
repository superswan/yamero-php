<?php
$title = 'Yamero! - Account';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "dbconfig.php";
        
$sql = "SELECT fingerprint FROM userpubkeys WHERE user_id = :user_id";

$param_user_id = $_SESSION['id'];
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $param_user_id);
if ($stmt->execute()) {
    $fingerprint = $stmt->fetchColumn();
} 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/css/style.css">
    <script text="text/javascript" src="static/js/app.js"></script>
</head>
<body>
    <?php include("navbar.php") ?>
    <div class="container">
    <h3 class="my-5">Logged in as: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h3>
    <p>
        <?php if ($fingerprint) {?>
        <p class="user-fingerprint">Your key: <?php echo "<b> $fingerprint</b>"; ?></p>
        <?php } else { ?> 
        <p class="user-fingerprint">No key found. You can add a key <a href="userpgp.php">here</a></p> 
        <?php } ?> 
        <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>
    </div>
</body>
</html>