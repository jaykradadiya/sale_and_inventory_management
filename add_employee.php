<?php
// include_once("header.html");
$Page='Emp';
include_once("navigation.php");
include("dbs/user.php");
if(isset($_POST["back"]))
{
    header("location:view_employee.php");
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
    <form  method="post">
        <table>
        <tr>
                <h1>add Employee</h1>
            </tr>
            <tr>
                <td>Employee Email</td>
                <td><input type="email" name="employee_email" id="employee_email"></td>
            </tr>
            <tr>
                <td>Employee Username</td>
                <td><input type="text" name="employee_username" id="employee_username"></td>
            </tr>
            <tr>
                <td>employee type</td>
                <td>
                    <div class="custom-select">
                    <select name="employee_type" id="employee_type" >
                       <option value="1" selected>admin</option>
                       <option value="2">cashier</option>
                       <!-- <option value="3">biller</option> -->
                   </select>
                    </div>
                   
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="emp_password" id="emp_password"></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addEmp" value="add">add</button>
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