<?php
if(!isset($_SESSION["empEmail"]))
{
    session_start();
    if(!isset($_SESSION["empEmail"]))
    {
        header("location:login_page.php");
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="upnav">
        <img src="pic/logo-removebg.png" alt="logo" class="logo">
        <a href="#"><button class="cta">logout</button></a>
    </header>
    <header class="sidenav">
        <nav class="sidebar">
            <div class="text">
                <?php  echo $_SESSION["empEmail"];?>
            </div>
            <ul class="sidelist">
                <li class="sidelistli list1 <?php if($Page=='Product'){echo 'curr';}?>">
                    <a href="view_product.php" class="list1"> Products</a>
                </li> 
                <li class="sidelistli list2 <?php if($Page=='Category'){echo 'curr';}?>">
                    <a href="view_category.php" class="list2">Category</a>
                </li>
                <!-- <li class="sidelistli list3 <?php if($Page=='Supplier'){echo 'curr';}?>">
                    <a href="view_supplier.php" class="list3">Supplier</a>
                </li> -->
                <li class="sidelistli <?php if($Page=='Order_view'){echo 'curr';}?>">
                    <a href="view_orders.php" >view orders</a>
                    </li>
                <li class="sidelistli <?php if($Page=='Order_take'){echo 'curr';}?>">
                    <a href="take_order.php" >Take orders</a>
                </li>
                <li class="sidelistli list4 <?php if($Page=='Emp'){echo 'curr';}?>">
                    <a href="view_employee.php" class="list4">Employees</a>
                </li>
            </ul>
        </nav>
    </header>
    <footer class="footer">
        <p>copyright &copy</p> 
    </footer>
</body>
</html>