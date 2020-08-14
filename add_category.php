<?php
// include_once("header.html");
$Page='Category';
include("navigation.php");
include_once("dbs/category.php");
$cname=$errorcname="";
$dis=$errordis="";
$i=0;
if(isset($_POST['addCategory'])=="add")
{
    // echo "<pre>";
    // print_r($_POST);
    $cname=$_POST['categoryname'];
    if(empty($cname))
    {
        $errorcname="category name required";
    }
    else
    {
        if(!preg_match("/^[a-zA-z]*$/", $cname))
		{
			$errorcname="Invalid category name";
        }
        else
        {
            $i++;
        }   
    }
    $dis=$_POST['productdescription'];
    if(empty($cname))
    {
        $errordis="discription required";
    }
    else
    {
        if(!preg_match("/^[a-zA-z]*$/", $dis))
		{
			$errordis="Invalid discription of category name";
        }
        else
        {
            $i++;
        }   
    }
    if($i==2)
    {

        $categorry = new category();
        $res= $categorry->create_category($cname,$_POST['productdescription']);
        if($res == "sucess")
        {
            header("location:". domain."view_category.php");
        }
    }
}
if(isset($_POST["back"]))
{
    header("location:". domain."view_category.php");
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
                <td><input type="text" name="categoryname" id="categoryname" value="<?php echo $cname;?>"></td>
                <td><span><?php echo $errorcname;?></span></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="productdescription" id="productdescription"  value="<?php echo $dis;?>"></td>
                <td><span><?php echo $errordis;?></span></td>
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