<?php

function phpAlert($msg) {
    echo '<script type="text/javascript">if (confirm("' . $msg . '")){document.location="index.html"}else{document.location="index.html"}</script>';
}

session_start();

session_destroy();
unset($_SESSION);
phpAlert("You have been logged out.");
header("location:index.html");
exit();