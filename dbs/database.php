<?php
if(!isset($_SESSION["empEmail"]))
{
    session_start();
}
define("host","localhost");
define("user","root");
define("password","");
define("database_name","pos1");
define("domain","http://localhost/sem5/php_new/sale_and_inventory_management/");
class database{
    private $connection;
    private $db;
    public function __construct()
    {
        $this->connection= mysqli_connect(host,user,password);
        $this->db=mysqli_select_db( $this->connection,database_name);
        if( $this->connection)
        {
            // echo="connected";

            if($this->db==NULL)
            {
                $this->databsecreate();

            }           
        }
    }

    public function __deconstruct()
    {
        mysqli_close($this->connection);
    }
    public function con()
    {
        return  $this->connection;
        //  return "Database_not_connect";
    }

    private function createTables()
    {
        // bill items
        $sql="CREATE TABLE `bill_items`(`bill_id` int(11) NOT NULL,`product_id` int(11) NOT NULL,`quantity` int(11) NOT NULL,`price` int(11) NOT NULL)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        // categoty
        $sql="CREATE TABLE `category` (`category_id` int(255) NOT NULL,`category_name` varchar(255) NOT NULL,`Category_desciption` varchar(255) NOT NULL)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="CREATE TABLE `emp` (`empID` int(255) NOT NULL,`empEmail` varchar(40) NOT NULL,`empUsername` varchar(10) NOT NULL,`empPassword` varchar(10) NOT NULL,`empType` int(2) NOT NULL)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="CREATE TABLE `product` (`product_id` int(255) NOT NULL,`product_name` varchar(255) NOT NULL,`product_category` int(255) NOT NULL,`product_price` int(255) NOT NULL,`product_dis` varchar(255) NOT NULL,`product_stoke` int(255) NOT NULL)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="CREATE TABLE `bill` (`bill_id` int(255) NOT NULL,`customerName` varchar(255) NOT NULL,`customerEmail` varchar(255) NOT NULL,`bill_counter` varchar(255) NOT NULL,`date` date NOT NULL,`total` int(255) NOT NULL)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        // table creation complited

        $sql="ALTER TABLE `bill`ADD PRIMARY KEY (`bill_id`)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `bill_items` ADD PRIMARY KEY (`bill_id`,`product_id`),ADD KEY `product` (`product_id`)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `category` ADD PRIMARY KEY (`category_id`), ADD UNIQUE KEY `category_name` (`category_name`)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `emp` ADD PRIMARY KEY (`empID`),ADD UNIQUE KEY `empEmail` (`empEmail`,`empUsername`)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `product` ADD PRIMARY KEY (`product_id`), ADD UNIQUE KEY `product_name` (`product_name`), ADD KEY `category` (`product_category`)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `bill`  MODIFY `bill_id` int(255) NOT NULL AUTO_INCREMENT";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `category` MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `emp` MODIFY `empID` int(255) NOT NULL AUTO_INCREMENT";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `product` MODIFY `product_id` int(255) NOT NULL AUTO_INCREMENT";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `bill_items` ADD CONSTRAINT `bill` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`) ON UPDATE CASCADE, ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON UPDATE CASCADE";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="ALTER TABLE `product` ADD CONSTRAINT `category` FOREIGN KEY (`product_category`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);

        $sql="INSERT INTO `emp` (`empEmail`, `empUsername`, `empPassword`, `empType`) VALUES('admin@gmail.com', 'admin', 'admin', 1)";
        echo $sql;
        mysqli_query($this->connection,$sql) or die(mysqli_error);
   
    }

    private function databsecreate()
    {
        $sql="create database ".database_name;
        echo $sql;
        mysqli_query($this->connection,$sql);
        $this->db = mysqli_select_db($this->connection,database_name);
        if($this->db)
        {
            echo "created";
            $this->createTables();
        }
        
    }
    
}
?>