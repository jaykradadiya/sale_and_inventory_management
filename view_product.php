<?php
// include_once("header.html");
$Page='Product';
include("navigation.php");
include_once("dbs/product.php");
$product= new product();
$row= $product->getProductdata();

if(isset($_POST["search"]))
{
    // header("location:add_product.php");
}
if(isset($_POST["stoke"]))
{
    $_SESSION['stoke']=$_POST['stoke'];
    header("location:". domain."stoke_in_product.php");
}

if(isset($_POST["add"]))
{
    header("location:". domain."add_product.php");
}
if(isset($_POST["edit"]))
{
    $_SESSION['edit']=$_POST['edit'];
    header("location:". domain."edit_product.php");
}
if(isset($_POST["delete"]))
{
    $res= $product->deleteProduct($_POST['delete']);
    if($res=="sucess")
    {header("location:". domain."view_product.php");}
    
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
            <td>search product</td>
            <td>
                <input type="text" name="p_search" id="p_search">
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
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Product category</th>
                    <th>Product Price</th>
                    <th>Product description</th>
                    <th>Product stoke</th>
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
                    <td>&nbsp;&nbsp;<?php echo $key[4]?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[5]?></td>
                    <td>
                        <!-- <a href="edit_employee.php"><button id="edit">edit</button></a> -->
                        <button id="stoke" name="stoke"  value="<?php echo $key[0];?>" >stoke in</button>&nbsp;
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