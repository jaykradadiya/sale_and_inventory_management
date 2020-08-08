<?php

include("database.php");
class user
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
    private function checkEmail($email)
    {
        $db= new database();
        $this->con=$db->con();
        $sql="SELECT * FROM emp WHERE empEmail='$email'";
        echo $sql;
        $res=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(!$res)
        {
            echo "no not";
        }
        else{
            echo mysqli_num_rows($res);
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
        echo $sql;
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
                echo $sql;
                $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                if($inres ==1)
                {
                    header("location:../php_new/view_employee.php");
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

public function userLogin($email,$password)
{
    if($this->checkEmail($email)==0)
    {
        $sql="SELECT * FROM emp WHERE empEmail='$email' and empPassword='$password' ";
        echo $sql;
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
        if(mysqli_num_rows($inres)==1)
        {
            $row=mysqli_fetch_array($inres);
            $_SESSION["empEmail"]=$row["empEmail"];
            $_SESSION["empUsername"]=$row["empUsername"];
            $_SESSION["empType"]=$row["empType"];
            // header("location:../php_new/view_employee.php");
            return "Sucess";
        }
        else
        {
            return "Some_error";
        }
    }
    else{
        return "Username_not_registed";
    }
}

public function getEmpdata()
{
    $sql="SELECT * FROM emp ";
    echo $sql;
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

}

if(isset($_POST['addEmp'])=="add")
{
    echo "<pre>";
    print_r($_POST);
    
$O = new user();
echo $O->create_member($_POST["employee_email"],$_POST['employee_username'],$_POST["emp_password"],$_POST['employee_type']);
}
if(isset($_POST['loginbtn'])=="login")
{
    // echo "<pre>";
    // print_r($_POST);
    
$O = new user();
echo $O->userLogin($_POST["loginMail"],$_POST["loginPassword"]);
}

// if($page=='login')
// {
//     if(isset($_SESSION["empEmail"]))
//     {
//         header("location:view_orders.php");
//     }
// }
// else
// {
//     if(!isset($_SESSION["empEmail"]))
//     {
//         header("location:login_page.php");
//     }
// }
?>