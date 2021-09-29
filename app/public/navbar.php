<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>
<div class="topnav">
        <a class="<?php active('index.php');?>" href="index.php">Upload</a>
        <a class="<?php active('paste.php');?>" href="paste.php">Paste</a>
        <a class="<?php active('pgptool.php');?>" href="pgptool.php">PGP Tool</a>
        <div class="account">
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {?>
            <div class="user-dropdown">
                <button onclick="userDropdown()" class="dropbtn"><?php echo $_SESSION['username']?></button>
                <div id="userDropdown" class ="dropdown-content">
                    <ul class="user-menu">
                    <li><a class="user-account" href="account.php">Settings</a></li>
                    <li><a class="user-account" href="userpgp.php">PGP Key</a></li>
                    <li><a class="user-account" href="logout.php">Sign Out</a></li>
                    </ul>
                </div>
            </div>
            <?php } else { ?>
            <a class="<?php active('register.php');?>" href="register.php">Sign Up</a>
            <a class="<?php active('login.php');?>" href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>