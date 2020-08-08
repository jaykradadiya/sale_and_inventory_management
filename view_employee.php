<?php
// include_once("header.html");
$Page='Emp';
include_once("navigation.php");
include_once("dbs/user.php");
$O = new user();
$row = $O->getEmpdata();
// echo "<pre>";
// print_r($row);

if(isset($_POST["search"]))
{
    header("location:add_employee.php");
}

if(isset($_POST["add"]))
{
    header("location:add_employee.php");
}
if(isset($_POST["edit"]))
{
    header("location:edit_employee.php");
}
if(isset($_POST["delete"]))
{
    // header("location:add_employee.php");
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
                <button name="search" id="search"> search</button>
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
                        <button name="edit" id="edit">edit</button>&nbsp;
                        <button name="delete" id="delete">delete</button>&nbsp;
                        <!-- <a href="#"><button id="delete">delete</button></a></td> -->
                        </form>
                </tr>
                
                <?php    }
                ?>
            </table>
        </tr>
    </table>
    </form>
</div>
</body>
</html>