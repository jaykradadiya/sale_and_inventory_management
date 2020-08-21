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

if(isset($_SESSION['stoke']))
{
    $row = $product->getProductdatabyid($_SESSION['stoke']);
}
else
{
    header("location:". domain."view_product.php");
}

$pstoke=$errorstoke="";
$pnewstoke=$errornewstoke="";
$i=0;
if(isset($_POST["updatestoke"]))
{
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

    $pnewstoke=$_POST['productnewstoke'];
    if(empty($pstoke))
    {
        $errornewstoke="type not seleced";
    }
    else
    {
        if(!filter_var($pnewstoke,FILTER_VALIDATE_INT))
        {
            $errorstoke="Invalid email format";
        }
        else
        {
            if($i==1)
            {    
                $res=  $product->update_product_stoke($_POST['productid'],($pstoke+$pnewstoke));

                if($res=="Sucess")
                {
                    unset($_SESSION['edit']);
                    header("location:". domain."view_product.php");
                }}
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
                <h1>update product stoke</h1>
            </tr>
            <tr>
                <td>product id</td>
                <td><input type="text" name="productid" id="productid" value="<?php echo $row[0][0];?>" disabled></td>
            </tr>
            <tr>
                <td>product name</td>
                <td><input type="text" name="productname" id="productname" value="<?php echo $row[0][1];?>" disabled></td>
                <td><span id="p_name_err"></span></td>
            </tr>
            <tr>
                <td>product category</td>
                <td>
                    <select name="productcategory" id="productcategory" disabled>
                    <?php
                     foreach ($catdata as $key) {
                        ?>
                        
                        <option value="<?php echo $key[0];?>"<?php if($key[0]==$row[0][2]){echo "selected";}?>><?php echo $key[1];?></option>
                        
                        <?php
                     }
                    ?>

                   </select>
                   
                </td>
                <td><span id="p_category_err"></span></td>
            </tr>
            <tr>
                <td>product price</td>
                <td><input type="text" name="productprice" id="productprice" value="<?php echo $row[0][3];?>" disabled></td>
                <td><span id="p_price_err"></span></td>
            </tr>
            <tr>
                <td>product supplier</td>
                <td>
                    <select name="productsupplier" id="productsupplier"disabled >
                    <?php
                    foreach ($sup as $key) {
                        ?>
                           <option value="<?php echo $key[0];?>" <?php if($key[0]==$row[0][6]){echo "selected";}?> ><?php echo $key[1];?></option>
                        <?php
                    }
                    ?>
                      
                   </select>
                    
                </td>
            </tr>
            <tr>
                <td>product discription</td>
                <td><input type="text" name="productdiscription" id="productdiscription" value="<?php echo $row[0][4];?>"disabled ></td>
                <td><span id="p_dis_err"></span></td>
            </tr>
            <tr>
                <td>picture</td>
                <!-- <td><input type="file" name="product_pic" id="product_pic"></td> -->
                <td>
                    <img src="<?php echo "pic/".$row[0][7]?>" id="viewimg" alt="<?php echo $row[0][7]?>" srcset="">
                    </td>
            </tr>
            <tr>
                <td>product available stoke</td>
                <td><input type="text" name="productstoke" id="productstoke" value="<?php echo $row[0][5];?>" ></td>
                <td><span><?php echo $errorstoke;?></span></td>
            </tr>
            <tr>
                <td>product new stoke</td>
                <td><input type="text" name="productnewstoke" id="productnewstoke" value="0" ></td>
                <td><span><?php echo $errornewstoke;?></span></td>
            </tr>
            <tr>
            <td>
                    <button id="add" name="updatestoke" value="update">update</button>
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