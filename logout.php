<?php
session_start();
session_destroy();

// print_r($_SESSION);
header("location:login_page.php");
?>