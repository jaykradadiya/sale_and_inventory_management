<?php
// include_once("header.html");
$Page='Order_view';
include("navigation.php");
include_once("dbs/order.php");
$data=new order();
if(isset($_POST["back"]))
{
    header("location:". domain."view_orders.php");
}
if(isset($_SESSION["view"]))
{
    $rows=$data->getbillItems($_SESSION['view']);
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
            <td>Bill Details</td>
        </tr>

        <tr>
            <table border="1">
                <tr>
                    <th>product ID</th>
                    <th>product price</th>
                    <th>quanitity</th>
                    <th>Price</th>
                </tr>
                <?php
                if($rows!="Some_error")
                {
                  
                    foreach ($rows as $key) {
                ?>
                
                <tr>
                    <td>&nbsp;&nbsp;<?php echo $key[0];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[1];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[2];?></td>
                    <td>&nbsp;&nbsp;<?php echo $key[3];?></td>
                    
                </tr>
                
                <?php    }
                 }
                 else
                 {?>
                     <span id="error">no <?php echo "NO PRODUCT INSERTED";?></span>
                 <?php 
                 }
                ?>
                <tr>
                <td>
                    <button name="back" id="back"> back</button>
                    </td>
                </tr>
    </table>
    </form>
</div>
</body>
</html>