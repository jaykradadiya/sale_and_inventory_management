<?php
// include_once("header.html");
$Page='Product';
include_once("navigation.php");
include_once("dbs/product.php");
include_once("dbs/category.php");
$category =new category();
$cat=$category->getCategorydata();

$pname=$pcategory=$pprice=$dis=$pstoke="";
$errorpname=$errorcategory=$errorprice=$errordis=$errorstoke="";

if(isset($_POST['addProduct'])=="add")
{
    $pname=$_POST["productname"];
	if(empty($pname))
	{
		$errorpname="product name is required";
	}
	else
	{
		if(!preg_match("/^[a-zA-z\_]*$/", $pname))
		{
			$errorpname="Only alphabets allowed with _";
        }
        else
        {
            $i++;
        }
        
    }

    $dis=$_POST["productname"];
	if(empty($dis))
	{
		$errordis="product name is required";
	}
	else
	{
		if(!preg_match("/^[a-zA-z\_]*$/", $dis))
		{
			$errordis="Only alphabets allowed with _";
        }
        else
        {
            $i++;
        }
        
    }

    $pcategory=$_POST['productcategory'];
    if(empty($pcategory))
    {
        $errorcategory="type not seleced";
    }
    else
    {
        if(!filter_var($pcategory,FILTER_VALIDATE_INT))
        {
            $errorcategory="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }


    $pprice=$_POST['productprice'];
    if(empty($pprice))
    {
        $errorprice="type not seleced";
    }
    else
    {
        if(!filter_var($pprice,FILTER_VALIDATE_INT))
        {
            $errorprice="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }

    $pstoke=$_POST['productstoke'];
    if(empty($pstoke))
    {
        $errorstoke="type not seleced";
    }
    else
    {
        if(!filter_var($pstoke,FILTER_VALIDATE_INT))
        {
            $errorstoke="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }

      if($i==5)
      {  
        $product = new product();
        $res= $product->create_product($pname,$pcategory,$pprice,$_POST["productdiscription"],$_POST['productstoke']);
        if($res=="Sucess")
        {
            header("location:". domain."view_product.php");
        }
    }
}

if(isset($_POST["back"]))
{
    header("location:". domain."view_product.php");
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
                <td><input type="text" name="productname" id="productname" <?php echo $pname;?>></td>
                <td><span><?php echo $errorpname;?></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <div class="custom-select">
                    <select name="productcategory" id="productcategory" >
                    <?php
                    foreach ($cat as $key) {
                        ?>
                           <option value="<?php echo $key[0];?>"><?php echo $key[1];?></option>
                        <?php
                    }
                    ?>
                      
                   </select>
                    </div>
                   
                </td>
                <td><span><?php echo $errorcategory;?></span></td>

            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="productprice" id="productprice" <?php echo $pprice;?>></td>
                <td><span><?php echo $errorprice;?></span></td>

            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="productdiscription" id="productdiscription" <?php echo $dis;?> ></td>
                <td><span><?php echo $errordis;?></span></td>

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
                <td><input type="text" name="productstoke" id="productstoke" <?php echo $pstoke;?>></td>
                <td><span><?php echo $errorstoke;?></span></td>
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