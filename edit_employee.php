<?php
// include_once("header.html");
$Page='Emp';
include("navigation.php");
include_once("dbs/user.php");
include_once("dbs/ftp.php");
$member=new user();

$password=$errorPass=$errorfile="";
$i=0;
if(isset($_SESSION['edit']))
{
    $row = $member->getmemberdata($_SESSION['edit']);
}
else
{
    header("location:view_employee.php");
}
if(isset($_POST["updateEmp"]))
{
    $id=$_POST['employee_id'];
    $type=$_POST['employee_type'];
    $password=$_POST["emp_password"];
	if(empty($password))
	{
		$errorPass="password is required";
	}
	else
	{
        if(strlen($password)>5)
        {
		if(!preg_match("/^[A-Za-z_0-9]{6,}$/", $password))
		{
			$errorPass="password should be contain capital,small and special character";
        }
        else
        {
            $i++;
            $member->update_member($id,$password,$type);
            unset($_SESSION['edit']);
            header("location:". domain."view_employee.php");
        }
        }
        else
        {
            $errorPass="password should be contain 6 character";
        }
    }

    // $pic=$_FILES["emp_pic"]["tmp_name"];
    // if(empty($pic))
    // {
    //     $errorfile="file is not selected";
    // }
    // else{
    //     $ftp=new ftp();
    //     $ftpres=$ftp->putfile($_FILES["emp_pic"]["name"],$pic);
    //     if($ftpres=="FTP_upload_has_failed!")
    //     {
    //         $errorfile="file not uploaded";
    //     }
    //     else
    //     {
    //         $i++;
    //     }
    // }
    
}
if(isset($_POST["back"]))
{
    header("location:". domain."view_employee.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<div, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/view_css.css">
</head>
<body>
    <div id="masterTable">
    <form  method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <h1>Edit Employee</h1>
            </tr>
            <tr>
                <td>Employee ID</td>
                <td><input type="text" name="employee_id" id="employee_id" value="<?php echo $row[0][0];?>" disabled></td>
            </tr>
            <tr>
                <td>Employee Email</td>
                <td><input type="text" name="employee_email" id="employee_email" value="<?php echo $row[0][1];?>" disabled></td>
            </tr>
            <tr>
                <td>Employee Username</td>
                <td><input type="text" name="employee_username" id="employee_username" value="<?php echo $row[0][2];?>" disabled></td>
            </tr>
            <tr>
                <td>employee type</td>
                <td>
                    <div class="custom-select">
                    <select name="employee_type" id="employee_type" value="<?php echo $row[0][4];?>" >
                       <option value="1" selected>admin</option>
                       <option value="2">cashier</option>
                       <!-- <option value="3">biller</option> -->
                   </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="emp_password" id="emp_password" value="<?php echo $row[0][3];?>" ></td>
                <td><span><?php echo $errorPass;?></span></td>
            </tr>
            <tr>
                <td>picture</td>
                <!-- <td><input type="file" name="emp_pic" id="emp_pic" accept="image/*" value="<?php echo "pic/".$row[0][5]?>"></td> -->
                <td>
                    <img src="<?php echo "pic/".$row[0][5]?>" id="viewimg" alt="<?php echo $row[0][5]?>" srcset="">
                    </td>
                    <td><span><?php echo $errorfile;?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="updateEmp" value="update">update</button>
                </td>
                <td>
                    <button name="back" id="back"> back</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
   
</body>
</html>