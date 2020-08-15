<?php
// include_once("header.html");
$Page='Emp';
include("navigation.php");
include_once("dbs/user.php");
$emp = new user();
$row = $emp->getEmpdata();
// echo "<pre>";
// print_r($row);

if(isset($_POST["search"]))
{
    $row = $emp->getempserchdata($_POST["e_search"]);
}
else
{
    $row = $emp->getEmpdata();   
}

if(isset($_POST["add"]))
{
    header("location:". domain ."add_employee.php");
}
if(isset($_POST["edit"]))
{
    $_SESSION['edit']=$_POST['edit'];
//     echo "<pre>";
// print_r($_POST);

    header("location:". domain ."edit_employee.php");
}
if(isset($_POST["delete"]))
{
    $res= $category->deleteMember($_POST['delete']);
    if($res=="sucess")
    {
    header("location:". domain ."view_employee.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/view_css.css">
</head>
<body>
    <div id="masterTable">
    <form action=""  method="post">
    <table>
        <tr>
            <td>search product</td>
            <td>
                <input type="text" name="e_search" id="e_search">
            </td>
            <td>
                <button name="search" value="search" id="search"> search</button>
            </td>
            <td>
                <button name="add" id="add"> add</button>
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>employee Id</th>
                    <th>employee email</th>
                    <th>employee UserName</th>
                    <th>employee type</th>
                    <th>action</th>
                </tr>
                <?php
                if($row!="Some_error")
                {
                  
                    foreach ($row as $key) {
                ?>
                
                <tr>
                <form method="post">
                    <td>&nbsp;&nbsp;<?php echo $key[0]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[1]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[2]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[4]?></td>
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->
                        <button name="edit" id="edit" value="<?php echo $key[0];?>">edit</button>&nbsp;
                        <button name="delete" id="delete" value="<?php echo $key[0];?>">delete</button>&nbsp;
                        <!-- <a href="#"><button id="delete">delete</button></a></td> -->
                        </form>
                </tr>
                
                <?php    }
                 }
                 else
                 {?>
                     <span id="error">no <?php echo "NO PRODUCT INSERTED";?></span>
                 <?php 
                 }
                 
                ?>
            </table>
        </tr>
    </table>
    </form>
</div>
</body>
</html>