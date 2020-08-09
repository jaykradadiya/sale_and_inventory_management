<?php
// include_once("header.html");
$Page='Product';
 include_once("navigation.php");
include_once("dbs/category.php");
include_once("dbs/product.php");

$category = new category();
$catdata = $category->getcategorydata();
$product = new product();

if(isset($_SESSION['edit']))
{
    $row = $product->getProductdatabyid($_SESSION['edit']);
}
else
{
    header("location:view_product.php");
}


if(isset($_POST["updateProduct"]))
{
    echo "<pre>";
 print_r($_POST);

   echo  $product->update_product($_POST['productid'],$_POST['productname'],$_POST['productcategory'],$_POST['productprice'],$_POST['productdiscription'],$_POST['productstoke']);
    unset($_SESSION['edit']);
    header("location:view_product.php");
}


if(isset($_POST["back"]))
{
    header("location:view_product.php");
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
    <form action="" method="post">
        <table>
            <tr>
                <h1>edit product</h1>
            </tr>
            <tr>
                <td>product id</td>
                <td><input type="text" name="productid" id="productid" value="<?php echo $row[0][0];?>" readonly></td>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="productname" id="productname" value="<?php echo $row[0][1];?>" ></td>
                <td><span id="p_name_err"></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <div class="custom-select">
                    <select name="productcategory" id="productcategory" value="<?php echo $row[0][2];?>"  >
                    <?php
                     foreach ($catdata as $key) {
                        ?>
                        
                        <option value="<?php echo $key[0];?>"><?php echo $key[1];?></option>
                        
                        <?php
                     }
                    ?>

                   </select>
                    </div>
                   
                </td>
                <td><span id="p_category_err"></span></td>
            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="productprice" id="productprice" value="<?php echo $row[0][3];?>" ></td>
                <td><span id="p_price_err"></span></td>
            </tr>
            <!-- <tr>
                <td>product supplier</td>
                <td>
                    <div class="custom-select">
                        <select name="productsupplier" id="productsupplier">
                        <option value="1" selected>mi</option>
                        <option value="2">olx</option>
                        <option value="3">amazon</option>
                    </select>
                    </div>
                
                </td>
            </tr> -->
            <tr>
                <td>product discription</td>
                <td><input type="text" name="productdiscription" id="productdiscription" value="<?php echo $row[0][4];?>" ></td>
                <td><span id="p_dis_err"></span></td>
            </tr>
            <tr>
                <td>product stoke</td>
                <td><input type="text" name="productstoke" id="productstoke" value="<?php echo $row[0][5];?>" ></td>
                <td><span id="p_stoke_err"></span></td>
            </tr>
            <tr>
            <td>
                    <button id="add" name="updateProduct" value="update">update</button>
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