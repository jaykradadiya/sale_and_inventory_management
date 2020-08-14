<?php

include("database.php");
class user
{
    // $db=new database();
    private $con;
    public function __construct()
    {
        $db=new database();
       
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
    private function checkEmail($email)
    {
        // $db= new database();
        // $this->con=$db->con();
        $sql="SELECT * FROM emp WHERE empEmail='$email'";
        // echo $sql;
        $res=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(!$res)
        {
            echo "no not";
        }
        else{
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
    private function checkUsername($username)
    {
        $sql="SELECT * FROM emp WHERE empUsername='$username'";
        // echo $sql;
        $res=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(!$res)
        {
            echo "no not";
        }
        else{
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
    public function create_member($email,$username,$password,$memberType)
    {
        if($this->checkEmail($email)==1)
        {
            if($this->checkUsername($username)==1)
            {
                $sql="INSERT INTO `emp`(`empID`, `empEmail`, `empUsername`, `empPassword`, `empType`) VALUES (NULL,'$email','$username','$password',$memberType)";
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
                return "Username_already_registed";
            }
        }
        else{
            return "Email_already_registed";
        }
    }
    public function getmemberdata($id)
    {
        $sql="SELECT * FROM emp WHERE empID=$id";
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
    public function update_member($id,$password,$memberType)
    {
        $sql="UPDATE emp SET empPassword='$password',empType=$memberType WHERE empID=$id";
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

public function userLogin($email,$password)
{
    if($this->checkEmail($email)==0)
    {
        $sql="SELECT * FROM emp WHERE empEmail='$email' and empPassword='$password' ";
        // echo $sql;
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(mysqli_num_rows($inres)==1)
        {
            $row=mysqli_fetch_array($inres);
            $_SESSION["empEmail"]=$row["empEmail"];
            $_SESSION["empUsername"]=$row["empUsername"];
            $_SESSION["empType"]=$row["empType"];
            return "Sucess";
        }
        else
        {
            return "Please check EMail and password";
        }
    }
    else{
        return "Username_not_registed";
    }
}

public function getEmpdata()
{
    $sql="SELECT * FROM emp ";
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


public function deleteMember($id)
{
    $sql="DELETE FROM emp WHERE empID=$id ";
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


// if(isset($_POST['addEmp'])=="add")
// {
//     // echo "<pre>";
//     // print_r($_POST);
    
// $O = new user();
// echo $O->create_member($_POST["employee_email"],$_POST['employee_username'],$_POST["emp_password"],$_POST['employee_type']);
// header("location:../sale_and_inventory_management/view_employee.php");
// }

// if(isset($_POST['loginbtn'])=="login")
// {
//     echo "<pre>";
//     print_r($_POST);
    
// $O = new user();
// echo $O->userLogin($_POST["loginMail"],$_POST["loginPassword"]);
//  header("location:../sale_and_inventory_management/navigation.php");
// }
?>