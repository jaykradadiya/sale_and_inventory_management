<?php
// include_once("header.html");
$Page='Category';
// include_once("navigation.php");
include_once("dbs/category.php");
$cate = new category();

if(isset($_SESSION['edit']))
{
    $row = $cate->getCategorybyid($_SESSION['edit']);
}
else
{
    header("location:view_category.php");
}
// echo "<pre>";
// print_r($row);

if(isset($_POST["updateCategory"]))
{
   echo  $cate->update_category($_POST['categoryid'],$_POST['categoryname'],$_POST['productdescription']);
    unset($_SESSION['edit']);
    header("location:view_category.php");
}

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
                <h1>edit category</h1>
            </tr>
            <tr>
                <td>category Id</td>
                <td><input type="text" name="categoryid" id="categoryid" value="<?php echo $row[0][0];?>" readonly></td>
            </tr>
            <tr>
                <td>category name</td>
                <td><input type="text" name="categoryname" id="categoryname" value="<?php echo $row[0][1];?>"></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="productdescription" id="productdescription" value="<?php echo $row[0][2];?>"></td>
            </tr>
            <tr>
            <td>
                    <button id="add" name="updateCategory" value="update">update</button>
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