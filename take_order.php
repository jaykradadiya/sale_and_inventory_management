<?php
// include_once("header.html");
$Page='Order_take';
include("navigation.php");
include_once("dbs/product.php");
$product=new product();

if(isset($_POST["addorder"]))
{
    echo "<pre>";
    print_r($_POST);
}
// $today_date=date();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/view_css.css">
    <link rel="stylesheet" href="css/take_order_css.css">
    <script src="js/jquery.js"></script>
    <script src="js/take_order.js"></script>

</head>
<body>
    <div id="masterTable">
        <form id="order_Table" onsubmit="return false">
            <table">
                <tr>
                    <td>
                        <h1>Take Order</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                    <table >
                        <tr>
                            <th>date</th>
                            <td><input type="date" name="O_date" id="O_date" value="<?php echo date('Y-m-d');?>" readonly></td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td><input type="text" name="O_customer_name" id="O_customer_name"></td>
                            <td><span id="errorcname"></span></td>
                        </tr>
                        <tr>
                            <th>Customer Mail address</th>
                            <td><input type="email" name="O_customer_mail" id="O_customer_mail"></td>
                            <td><span id="errorEmail"></span></td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                            <tbody id="product_buy">
                               
                                <tr>
                                    <h1>Procuct Buy</h1>
                                </tr>
                                    <tr>
                                        <th>Procuct id</th>
                                        <!-- <th>product name</th> -->
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Buy Quntity</th>
                                        <th>total</th>
                                    </tr>
                            
                            </tbody>
                            <tr>
                            <td><span id="errorproduct"></span></td>
                           </tr>
                           <tr>
                            <td><span id="errorpqty"></span></td>
                           </tr>
                            <tr>
                                    <td><button name="additem" value="add" id="add">add</button></td>
                                    <td><button name="deleteitem" value="delete" id="delete">remove</button></td>
                                </tr>
                            </td>
                        </tr>
                        <tr>
                            <th>total</th>
                            <td><input type="number" name="O_totals" id="O_totals" readonly></td>
                            <td><span id="errorTotal"></span></td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                        <td>
                          <button name="addorder" id="addorder" value="add">add</button>
                        </td>
                </tr>
            </table>
        </form>
       <!-- <a href="dbs/order.php"><button name="addorder"  value="add">add</button></a>  -->
    </div>
</body>
</html>