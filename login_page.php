<?php
// echo "<pre>";
// print_r($_POST);
$page='login';
include_once("dbs/user.php");

if(isset($_SESSION["empEmail"]))
    {
        header("location:navigation.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login_style.css">
    
</head>
<body>
    <header>
        <img src="pic/logo-removebg.png" alt="logo" class="logo">
    </header>
    <br>
    <br>
    <form method="post" class="login_form">
        <div class="center_box">
            <div class="center_img"><img src="pic/logo.png" alt="company logo" class="login_img"></div>
            <h1 class="center_text">Member Login</h1>
            <br>
            <label for="usename"><h3>email id</h3></label>
            <input type="text" name="loginMail" id="loginMail">
            <br>
            <span id="usernameErr"></span>
            <br>
            <label for="password"><h3>Password</h3></label>
            <input type="password" name="loginPassword" id="loginPassword">
            <br>
            <span id="passwordErr">error</span>
            <br>
            <input type="submit" class="logbtn" value="login" name="loginbtn">
            <br>
            <!-- <span class="worong_password">worong password?</span>
            <br><br> -->
            <span >all members are manage by administration</span>
        </div>
    </form>
</body>
</html>