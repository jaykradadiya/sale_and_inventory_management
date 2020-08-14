<?php

include_once("database.php");
class product
{
    private $con;
    public function __construct()
    {
       
        $db= new database();
        $this->con=$db->con();
        // if( $this->con)
        // {
        //     echo "connected";
        // }
        // else
        // {
        //     echo "not connected";
        // }
    }

    public function __destruct()
    {
        mysqli_close($this->con);
    }
    
    private function checkName($name)
    {
        $db= new database();
        $this->con=$db->con();
        $sql="SELECT * FROM `product` WHERE `product_name`='$name'";
        // echo $sql;
        $res=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(!$res)
        {
            return "product name not found";
        }
        else{
            // echo mysqli_num_rows($res);
        if(mysqli_num_rows($res)==1)
        {
            return 0;//registed
        }
        else
        {
            return 1;//not registed
        }
    }
    }
    
    public function create_product($pname,$pcategory,$pprice,$dis,$stoke)
    {
         if($this->checkName($pname)==1)
            {
                $sql="INSERT INTO `product`(`product_id`, `product_name`, `product_category`, `product_price`, `product_dis`, `product_stoke`) VALUES (NULL,'$pname',$pcategory,$pprice,'$dis',$stoke)";
                // echo $sql;
                $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                if($inres ==1)
                {
                    return "Sucess";
                }
                else
                {
                    return "Some_error";
                }
            }
            else{
                return "product_name_already_registed";
            }
        
    }

    public function update_product($id,$pname,$pcategory,$pprice,$dis,$stoke)
    {
        $sql="UPDATE `product` SET`product_name`='$pname',`product_category`=$pcategory,`product_price`=$pprice,`product_dis`='$dis',`product_stoke`=$stoke  WHERE `product_id`=$id";
                // echo $sql;
                $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                if($inres ==1)
                {
                    return "Sucess";
                }
                else
                {
                    return "Some_error";
                }
        
        
    }

    public function update_product_stoke($id,$stoke)
    {
        
        $sql="UPDATE `product` SET `product_stoke`=$stoke  WHERE `product_id`=$id";
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());

        if($inres == 1)
        {
            return "Sucess";
        }
        else
        {
            return "Some_error";
        }
        
    }

public function getProductdata()
{
    $sql="SELECT * FROM `product`";
    // echo $sql;
    $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
    if(mysqli_num_rows($inres)>0)
    {
        $rows= array();

        while($row =mysqli_fetch_array($inres))
        {
            $rows[]=$row;
        }
        return $rows;
    }
    else
    {
        return "Some_error";
    }

}

public function getProductdatabyid($id)
{
    $sql="SELECT * FROM product WHERE  `product_id`=$id ";
    // echo $sql;
    $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
    if(mysqli_num_rows($inres)>0)
    {
        $rows= array();

        while($row =mysqli_fetch_array($inres))
        {
            $rows[]=$row;
        }
        return $rows;
    }
    else
    {
        return "Some_error";
    }

}
public function deleteProduct($id)
{
    $sql="DELETE FROM `product` WHERE `product_id`=$id ";
    // echo $sql;
    $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
    if(mysqli_num_rows($inres)==0)
    {
        return "sucess";
    }
    else
    {
        return "Some_error";
    }

}

}

// if(isset($_POST['addProduct'])=="add")
// {
//     echo "<pre>";
//     print_r($_POST);
    
// $O = new product();
// echo $O->create_product($_POST["productname"],$_POST['productcategory'],$_POST["productprice"],$_POST["productdiscription"],$_POST['productstoke']);
// }
?>