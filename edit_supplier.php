<?php
// include_once("header.html");
$Page='Supplier';
include("navigation.php");
include_once("dbs/supplier.php");
$supplier = new supplier();

$sname=$errorsname="";
$add=$erroradd="";
$contect=$errorcontectno="";
$i=0;
if(isset($_SESSION['edit']))
{
    $row = $supplier->getSupplierbyid($_SESSION['edit']);
}
else
{
    header("location:". domain."view_supplier.php");
}
// echo "<pre>";
// print_r($row);

if(isset($_POST['updateSupplier']))
{
    $sname=$_POST['suppliername'];
    if(empty($sname))
    {
        $errorsname="supplier name required";
    }
    else
    {
        if(!preg_match("/^[a-zA-z]*$/", $sname))
		{
			$errorsname="Invalid supplier name";
        }
        else
        {
            $i++;
        }   
    }
    $add=$_POST['supplieraddress'];
    if(empty($add))
    {
        $erroradd="address required";
    }
    else
    {
        if(!preg_match("/^[a-zA-z]*$/", $add))
		{
			$erroradd="Invalid address";
        }
        else
        {
            $i++;
        }   
    }
    $contect=$_POST['contectno'];
    if(empty($contect))
    {
        $errorcontectno="contect no required";
    }
    else
    {
        if(!preg_match("/^[0-9]{10}$/", $contect))
		{
			$errorcontectno="Invalid contect no";
        }
        else
        {
            $i++;
        }   
    }
    if($i==3)
    {
        $res= $supplier->update_supplier($_POST['supplierid'],$sname,$add,$contect);
        unset($_SESSION['edit']);
        if($res == "sucess")
        {
            header("location:". domain."view_supplier.php");
        }
        else
        {
            echo $res;
        }
    }
    else{
        echo $i;
    }
}

if(isset($_POST["back"]))
{
    unset($_SESSION['edit']);
    header("location:". domain."view_supplier.php");
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
                <h1>edit supplier</h1>
            </tr>
            <tr>
                <td>supplier ID</td>
                <td><input type="number" name="supplierid" id="supplierid" value="<?php echo $row[0][0];?>"></td>
                <!-- <td><span><?php echo $errorsname;?></span></td> -->
            </tr>
            <tr>
                <td>supplier name</td>
                <td><input type="text" name="suppliername" id="suppliername" value="<?php echo $row[0][1];?>"></td>
                <td><span><?php echo $errorsname;?></span></td>
            </tr>
            <tr>
                <td>supplier address</td>
                <td><input type="text" name="supplieraddress" id="productdescription"  value="<?php echo $row[0][2];?>"></td>
                <td><span><?php echo $erroradd;?></span></td>
            </tr>
            <tr>
                <td>supplier contectno</td>
                <td><input type="text" name="contectno" id="contectno"  value="<?php echo $row[0][3];?>"></td>
                <td><span><?php echo $errorcontectno;?></span></td>
            </tr>
            <td>
                    <button id="add" name="updateSupplier" value="update">update</button>
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