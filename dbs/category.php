<?php

include_once("database.php");
class category
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
        $sql="SELECT * FROM `category` WHERE `category_name`='$name'";
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
    
    public function create_category($pname,$dis)
    {
         if($this->checkName($pname)==1)
            {
                $sql="INSERT INTO `category`(`category_id`, `category_name`, `Category_desciption`) VALUES (NULL,'$pname','$dis')";
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
                return "Category_name_already_registed";
            }
        
    }

    public function update_category($id,$pname,$dis)
    {
        $sql="UPDATE `category` SET `category_name`='$pname',`Category_desciption`='$dis' WHERE `category_id`='$id'";
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

public function getCategorydata()
{
    $sql="SELECT * FROM `category`";
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
public function getCategoryserchdata($val)
{
    $sql="SELECT * FROM `category` WHERE CONCAT(`category_id`, `category_name`, `Category_desciption`) LIKE '%$val%'";
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

public function getCategorybyid($id)
{
    $sql="SELECT * FROM category WHERE category_id=$id ";
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

public function deleteCategory($id)
{
    $sql="DELETE FROM category WHERE category_id=$id ";
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