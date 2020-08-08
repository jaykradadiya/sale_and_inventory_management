<?php
// include_once("header.html");
$Page='Order_view';
include_once("navigation.php");

if(isset($_POST["search"]))
{
    header("location:add_employee.php");
}

if(isset($_POST["add"]))
{
    header("location:add_employee.php");
}
if(isset($_POST["edit"]))
{
    header("location:edit_employee.php");
}
if(isset($_POST["delete"]))
{
    // header("location:add_employee.php");
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
            <td>search orders</td>
            <td>
                <input type="text" name="p_search" id="p_search">
            </td>
            <td>
                <button name="search" id="search"> search</button>
            </td>
        </tr>
        <tr>
            <table border="1">
            <tr>
                    <th>bill ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Order date</th>
                    <th>total payment</th>
                    <th>billcollector</th>
                    <th>action</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>name</td>
                    <td>email</td>
                    <td>date</td>
                    <td>payment</td>
                    <td>employee</td>
                    <td>
                        <button name="edit" id="edit">view</button>&nbsp;
                        
                </tr>
            </table>
        </tr>
    </table>
    </form>
</div>
</body>
</html>