<?php
// echo "<pre>";
// print_r($_POST);
$page='login';
include_once("dbs/user.php");
$error="";
$email="";
if(isset($_POST['loginbtn'])=="Login")
{
    // echo "<pre>";
    // print_r($_POST);
    $email=$_POST["loginMail"];
	if(empty($email))
	{
		$error="Email is required";
	}
	else
	{
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			$error="Invalid email format";
        }
        else
        {
            if(empty($_POST["loginPassword"]))
            {
                $error="please Enter password";
            }
            else
            {$user = new user();
        $error= $user->userLogin($_POST["loginMail"],$_POST["loginPassword"]);
        if($error=="Sucess")
        {header("location:". domain ."navigation.php");}
        }
        }
    }

// $user = new user();
// echo $user->userLogin($_POST["loginMail"],$_POST["loginPassword"]);
//  header("location:". domain ."navigation.php");
}

if(isset($_SESSION["empEmail"]))
    {
        header("location:". domain ."navigation.php");
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
    <!-- <header>
        <img src="pic/logo-removebg.png" alt="logo" class="logo">
    </header> -->
    <br>
    <br>
    <form method="post" class="login_form">
        <div class="center_box">
            <div class="center_img"><img src="pic/logo-removebg.png" alt="company logo" class="login_img"></div>
            <h1 class="center_text">Member Login</h1>
            <br>
            <label for="usename"><h3>Email id</h3></label>
            <input type="text" name="loginMail" id="loginMail" value="<?php echo $email;?>" placeholder="Enter Email address">
            <span id="usernameErr"></span>
            <br>
            <label for="password"><h3>Password</h3></label>
            <input type="password" name="loginPassword" id="loginPassword" placeholder="Enter Password">
            <br>
            <span id="passwordErr"><?php echo $error;?></span>
            <br>
            <input type="submit" class="logbtn" value="Login" name="loginbtn">
            <br>
            <!-- <span class="worong_password">worong password?</span>
            <br><br> -->
            <span >all members are manage by administration</span>
        </div>
    </form>
</body>
</html>