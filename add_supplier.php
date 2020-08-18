<?php
// include_once("header.html");
$Page='Supplier';
include("navigation.php");
include_once("dbs/supplier.php");
$sname=$errorsname="";
$add=$erroradd="";
$contect=$errorcontectno="";
$i=0;
if(isset($_POST['addSupplier'])=="add")
{
    // echo "<pre>";
    // print_r($_POST);
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

        $supplier = new supplier();
        $res= $supplier->create_supplier($sname,$add,$contect);
        if($res == "sucess")
        {
            header("location:". domain."view_supplier.php");
        }
        else if($res == "supplier_name_already_registed")
        {
            $errorsname="supplier name already registed";
        }
    }
}
if(isset($_POST["back"]))
{
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
                <h1>add supplier</h1>
            </tr>
            <tr>
                <td>supplier name</td>
                <td><input type="text" name="suppliername" id="suppliername" value="<?php echo $sname;?>"></td>
                <td><span><?php echo $errorsname;?></span></td>
            </tr>
            <tr>
                <td>supplier address</td>
                <td><input type="text" name="supplieraddress" id="productdescription"  value="<?php echo $add;?>"></td>
                <td><span><?php echo $erroradd;?></span></td>
            </tr>
            <tr>
                <td>supplier contectno</td>
                <td><input type="text" name="contectno" id="contectno"  value="<?php echo $contect;?>"></td>
                <td><span><?php echo $errorcontectno;?></span></td>
            </tr>
            <tr>
                <td>
                    <button id="add" name="addSupplier" value="add">add</button>
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