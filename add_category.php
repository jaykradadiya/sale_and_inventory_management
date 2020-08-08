<?php
// include_once("header.html");
$Page='Category';
include_once("navigation.php");
include_once("dbs/category.php");

if(isset($_POST["back"]))
{
    header("location:view_category.php");
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
                <h1>add category</h1>
            </tr>
            <tr>
                <td>category name</td>
                <td><input type="text" name="categoryname" id="categoryname"></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="productdescription" id="productdescription"></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addCategory" value="add">add</button>
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