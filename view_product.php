<?php
// include_once("header.html");
$Page='Product';
include_once("navigation.php");
if(isset($_POST["search"]))
{
    // header("location:add_product.php");
}
if(isset($_POST["stoke"]))
{
    header("location:stoke_in_product.php");
}

if(isset($_POST["add"]))
{
    header("location:add_product.php");
}
if(isset($_POST["edit"]))
{
    header("location:edit_product.php");
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
                    <th>Product Supplier</th>
                    <th>Product description</th>
                    <th>Product stoke</th>
                    <th>action</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>name</td>
                    <td>category</td>
                    <td>price</td>
                    <td>Supplier</td>
                    <td>description</td>
                    <td>stoke</td>
                    <td>
                        <button id="stoke" name="stoke" >stoke in</button>&nbsp;
                        <button name="edit" id="edit">edit</button>&nbsp;
                        <button name="delete" id="delete">delete</button></td>
                </tr>
            </table>
        </tr>
    </table>
    </form>
</div>
</body>
</html>