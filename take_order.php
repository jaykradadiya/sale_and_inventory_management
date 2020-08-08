<?php
// include_once("header.html");
$Page='Order_take';
include_once("navigation.php");
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
        <form method="post" onsubmit="return false">
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
                            <td><input type="date" name="O_date" id="O_date"></td>
                        </tr>
                        <tr>
                            <th>Customer Name</th>
                            <td><input type="text" name="O_customer_name" id="O_customer_name"></td>
                        </tr>
                        <tr>
                            <th>Customer Mail address</th>
                            <td><input type="email" name="O_customer_mail" id="O_customer_mail"></td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                            <form onsubmit="return false">
                            <tbody class="product_buy">
                               
                                <div id="parent_order">
                                <tr>
                                    <h1>Procuct Buy</h1>
                                </tr>
                                    <tr>
                                        <th>Procuct id</th>
                                        <th>product name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>total</th>
                                    </tr>
                                <div id="child_order">

                                <tr id="form_product">
                                    <td>
                                        <select name="O_id[]" id="O_id[]">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="O_p_name[]" id="O_p_name[]"></td>
                                    <td><input type="number" name="O_p_price[]" id="O_p_price[]"></td>
                                    <td><input type="number" name="O_p_qty[]" id="O_p_qty[]"></td>
                                    <td><input type="number" name="O_p_total[]" id="O_p_total[]"></td>
                                </tr>
                                </div>
                                </div>
                                
                            
                            </tbody>
                            <tr>
                                    <td><button id="add">add</button></td>
                                    <td><button id="delete">remove</button></td>
                                </tr>
                            </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Customer Mail address</th>
                            <td><input type="email" name="O_customer_mail" id="O_customer_mail"></td>
                        </tr>
                        <tr>
                            <th>total</th>
                            <td><input type="number" name="O_totals" id="O_totals"></td>
                        </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                        <td>
                            <a href="#"> <button id="add">add</button></a>
                        </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>