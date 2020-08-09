<?php
// include_once("header.html");
$Page='Product';
include_once("navigation.php");
include_once("dbs/product.php");

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
                <h1>add product</h1>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="productname" id="productname"></td>
                <td><span id="p_name_err"></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <div class="custom-select">
                    <select name="productcategory" id="productcategory" >
                       <option value="1" selected><div class="select-selected"> leptop</div> </option>
                       <option value="2">mobile</option>
                       <option value="3">cloths</option>
                   </select>
                    </div>
                   
                </td>
                <td><span id="p_category_err"></span></td>

            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="productprice" id="productprice"></td>
                <td><span id="p_price_err"></span></td>
            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="productdiscription" id="productdiscription"></td>
                <td><span id="p_dis_err"></span></td>
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
                <td>product stoke</td>
                <td><input type="text" name="productstoke" id="productstoke"></td>
                <td><span id="p_stoke_err"></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addProduct" value="add">add</button>
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