<?php

// Initialize the session
if(!isset($_SESSION))
{
    session_start();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="static/css/style.css" />
    <script text="text/javascript" src="static/js/app.js"></script>
</head>
<body>