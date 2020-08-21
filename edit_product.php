<?php
// include_once("header.html");
$Page='Product';
 include("navigation.php");
include_once("dbs/category.php");
include_once("dbs/product.php");
include_once("dbs/supplier.php");

$category = new category();
$catdata = $category->getcategorydata();
$product = new product();
$supplier=new supplier();
$sup=$supplier->getSupplierdata();
$i=0;
$pname=$pcategory=$pprice=$dis=$pstoke=$psupplier="";
$errorpname=$errorcategory=$errorprice=$errordis=$errorstoke=$errorsupplier="";

if(isset($_SESSION['edit']))
{
    $row = $product->getProductdatabyid($_SESSION['edit']);
}   
else
{
    header("location:". domain."view_product.php");
}


if(isset($_POST["updateProduct"]))
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

    $psupplier=$_POST['productsupplier'];
    if(empty($psupplier))
    {
        $errorsupplier="type not seleced";
    }
    else
    {
        if(!filter_var($psupplier,FILTER_VALIDATE_INT))
        {
            $errorsupplier="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }

      if($i==6)
      {  
    
      $res= $product->update_product($_POST['productid'],$pname,$pcategory,$pprice,$dis,$pstoke,$psupplier);
      if($res=="Sucess")
      {
        unset($_SESSION['edit']);
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
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <h1>edit product</h1>
            </tr>
            <tr>
                <td>product id</td>
                <td><input type="text" name="productid" id="productid" value="<?php echo $row[0][0];?>" disabled></td>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="productname" id="productname" value="<?php echo $row[0][1];?>" ></td>
                <td><span><?php echo $errorpname;?></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <select name="productcategory" id="productcategory" >
                    <?php
                     foreach ($catdata as $key) {
                        ?>
                        
                        <option value="<?php echo $key[0];?>" <?php if($key[0]==$row[0][2]){echo "selected";}?>><?php echo $key[1];?></option>
                        
                        <?php
                     }
                    ?>

                   </select>
                   
                </td>
                <td><span><?php echo $errorcategory;?></span></td>
            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="productprice" id="productprice" value="<?php echo $row[0][3];?>" ></td>
                <td><span><?php echo $errorprice;?></span></td>
            </tr>
            <tr>
                <td>product supplier</td>
                <td>
                    <select name="productsupplier" id="productsupplier"  >
                    <?php
                    foreach ($sup as $key) {
                        ?>
                           <option value="<?php echo $key[0];?>" <?php if($key[0]==$row[0][6]){echo "selected";}?> ><?php echo $key[1];?></option>
                        <?php
                    }
                    ?>
                      
                   </select>
                    
                </td>
                <td><span><?php echo $errorsupplier;?></span></td>

            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="productdiscription" id="productdiscription" value="<?php echo $row[0][4];?>" ></td>
                <td><span><?php echo $errordis;?></span></td>
            </tr>
            <tr>
                <td>product stoke</td>
                <td><input type="text" name="productstoke" id="productstoke" value="<?php echo $row[0][5];?>" ></td>
                <td><span><?php echo $errorstoke;?></span></td>
            </tr>
            
            <tr>
                <td>picture</td>
                <!-- <td><input type="file" name="product_pic" id="product_pic"></td> -->
                <td>
                    <img src="<?php echo "pic/".$row[0][7]?>" id="viewimg" alt="<?php echo $row[0][7]?>" srcset="">
                    </td>
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