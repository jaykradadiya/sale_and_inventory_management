<?php

$Page='Category';

include_once("dbs/category.php");
include_once("navigation.php");
$category = new category();
$row = $category->getcategorydata();
if(isset($_POST["search"]))
{
    // header("location:add_employee.php");
}

if(isset($_POST["add"]))
{
    header("location:add_category.php");
}
if(isset($_POST["edit"]))
{
    $_SESSION['edit']=$_POST['edit'];
     header("location:edit_category.php");

}
if(isset($_POST["delete"]))
{
    // echo "<pre>";
    // print_r($_POST);
    echo $category->deleteCategory($_POST['delete']);
    header("location:view_category.php");

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
    <form action="" method="post">
    <table>
        <tr>
            <td>search category</td>
            <td>
                <input type="text" name="c_search" id="c_search">
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
                    <th>Category Id</th>
                    <th>Category Name</th>
                    <th>Category description</th>
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
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->
                        <button name="edit" id="edit" value="<?php echo $key[0];?>">edit</button>&nbsp;
                        <button name="delete" id="delete" value="<?php echo $key[0];?>">delete</button>&nbsp;
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