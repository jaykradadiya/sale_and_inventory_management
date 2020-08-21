<?php
// include_once("header.html");
$Page='Category';
include("navigation.php");
include_once("dbs/category.php");
$cate = new category();

$cname=$errorcname="";
$dis=$errordis="";
$i=0;

if(isset($_SESSION['edit']))
{
    $row = $cate->getCategorybyid($_SESSION['edit']);
}
else
{
    header("location:". domain."view_category.php");
}
// echo "<pre>";
// print_r($row);

if(isset($_POST['updateCategory']))
{
    $cname=$_POST['categoryname'];
    if(empty($cname))
    {
        $errorcname="category name required";
    }
    else
    {
        if(!preg_match("/^[a-zA-z]*$/",$cname))
		{
			$errorcname="Invalid category name";
        }
        else
        {
            $i++;
        }   
    }

    $dis=$_POST['productdescription'];
    if(empty($dis))
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
        $res=$cate->update_category($_POST['categoryid'],$cname,$dis);
        unset($_SESSION['edit']);
        if($res == "sucess")
        {
            header("location:". domain."view_category.php");
        }
    }
}

if(isset($_POST["back"]))
{
    unset($_SESSION['edit']);
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
                <h1>edit category</h1>
            </tr>
            <tr>
                <td>category Id</td>
                <td><input type="text" name="categoryid" id="categoryid" value="<?php echo $row[0][0];?>" disabled></td>
            </tr>
            <tr>
                <td>category name</td>
                <td><input type="text" name="categoryname" id="categoryname" value="<?php echo $row[0][1];?>"></td>
                <td><span><?php echo $errorcname;?></span></td>
            </tr>
            </tr>
            <tr>
                <td>product description</td>
                <td><input type="text" name="productdescription" id="productdescription" value="<?php echo $row[0][2];?>"></td>
                <td><span><?php echo $errordis;?></span></td>
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