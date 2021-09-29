<?php $title = 'Yamero! - PGP Tool'; include("header.php"); include("navbar.php")?>
<div class="container" id="pgp-toolbox">
    <div class="wrapper">
    <h1>Yamero!</h1>
    <p class="lead" id="pgptool-info">This tool is here for convenience. It is recommended to use GPG/PGP on your <a href="https://gnupg.org/gph/en/manual.html#MANAGEMENT" target="_blank">local machine</a>. <br> It's pretty "secure" since key pairs are generated client side using <a href="https://github.com/keybase/kbpgp" target="_blank">kbpgp</a>. <br> You will also have more robust configuration options.</p>

    </div>
    <?php include("pgptoolbox.php");?>
</div>

<?php include("footer.php") ?>