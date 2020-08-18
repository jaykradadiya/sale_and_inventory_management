<?php

include_once("database.php");
class supplier
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
        // $db= new database();
        // $this->con=$db->con();
        $sql="SELECT `supplier_name` FROM `supplier` WHERE `supplier_name`='$name'";
        // echo $sql;
        $res=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(!$res)
        {
            return "category name not found";
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
    
    public function create_supplier($sname,$address,$con_no)
    {
         if($this->checkName($sname)==1)
            {
                $sql="INSERT INTO `supplier`(`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contect_no`) VALUES (NULL,'$sname','$address','$con_no')";
                // echo $sql;
                $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                if($inres ==1)
                {
                    return "sucess";
                }
                else
                {
                    return "Some_error";
                }
            }
            else{
                return "supplier_name_already_registed";
            }
        
    }

    public function update_supplier($id,$sname,$address,$con_no)
    {
        $sql="UPDATE `supplier` SET `supplier_name`='$sname',`supplier_address`='$address',`supplier_contect_no`= '$con_no' WHERE `supplier_id`=$id";
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

public function getSupplierdata()
{
    $sql="SELECT * FROM `supplier`";
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
public function getSupplierserchdata($val)
{
    $sql="SELECT * FROM `supplier` WHERE CONCAT(`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contect_no`) LIKE '%$val%'";
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

public function getSupplierbyid($id)
{
    $sql="SELECT * FROM supplier WHERE supplier_id=$id ";
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

public function deletesupplier($id)
{
    $sql="DELETE FROM supplier WHERE supplier_id=$id ";
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

// if(isset($_POST['addCategory'])=="add")
// {
//     // echo "<pre>";
//     // print_r($_POST);
    
// $O = new category();
//  $res= $O->create_category($_POST["categoryname"],$_POST['productdescription']);
// if($res == "sucess")
// {
//     header("location:view_category.php");
// }
// }

?>