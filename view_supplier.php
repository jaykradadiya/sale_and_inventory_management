<?php

$Page='Supplier';

include_once("dbs/supplier.php");
include("navigation.php");
$supplier = new supplier();
if(isset($_POST["search"]))
{

    $row = $supplier->getSupplierserchdata($_POST["s_search"]);
    // header("location:add_employee.php");
}
else
{
$row = $supplier->getSupplierdata();
}

if(isset($_POST["add"]))
{
    header("location:". domain."add_supplier.php");
}
if(isset($_POST["edit"]))
{
    $_SESSION['edit']=$_POST['edit'];
     header("location:". domain."edit_supplier.php");

}
if(isset($_POST["delete"]))
{
    // echo "<pre>";
    // print_r($_POST);
   $res= $supplier->deletesupplier($_POST['delete']);
   if($res=="sucess") 
   {header("location:". domain."view_supplier.php");} 
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
                <input type="text" name="s_search" id="s_search">
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
                    <th>Supplier Id</th>
                    <th>Supplier Name</th>
                    <th>Supplier address</th>
                    <th>Supplier contect no</th>
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
                    <td>&nbsp;&nbsp;<?php echo $key[3]?></td>
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