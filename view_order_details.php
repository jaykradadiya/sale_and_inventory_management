<?php
// include_once("header.html");
$Page='Order_view';
include_once("navigation.php");
if(isset($_POST("back")))
{
    header("location:view_orders.php");
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
                    <th>product name</th>
                    <th>product price</th>
                    <th>quanitity</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>name</td>
                    <td>100</td>
                    <td>2</td>
                    <td>200</td>                    
                </tr>
            </table>
        </tr>
        <tr>
            <td> <button id="back" name="back" value="back">back</button></td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>