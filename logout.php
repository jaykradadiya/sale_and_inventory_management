<?php
session_start();
print_r($_SESSION);
session_destroy();

// print_r($_SESSION);
header("location:login_page.php");
?>