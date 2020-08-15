<?php

include_once("database.php");
include_once("product.php");

$product=new product();

class order
{
    private $con;
    public function __construct()
    {
        
        $db= new database();
        $this->con=$db->con();
    }
    public function __destruct()
    {
        mysqli_close($this->con);
    }
    public function takeorder($cname,$cemail,$pids,$pqty,$ptotal,$counter,$date,$total)
    {
        $sql="START TRANSACTION";
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
        $sql="INSERT INTO `bill`(`customerName`, `customerEmail`, `bill_counter`, `date`, `total`) VALUES ('$cname','$cemail','$counter','$date',$total)";
        echo $sql;
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
        if($inres ==1)
        {
            $bill_id=$this->con->insert_id;
            echo $bill_id ."  ". count($pids);
            if($bill_id!=NULL)
            {
                for($i=0;$i<count($pids);$i++)
                {
                    $id=$pids[$i];
                    $qty=$pqty[$i];
                    $itotal=$ptotal[$i];
                    $sql="INSERT INTO `bill_items`(`bill_id`, `product_id`, `quantity`, `price`) VALUES ($bill_id,$id,$qty,$itotal)";
                    // echo $sql;
                    $inres=mysqli_query($this->con,$sql) or die(mysqli_error());

                    $sql="UPDATE `product` SET `product_stoke`=product_stoke-$qty WHERE `product_id`=$id";
                    $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                    if(!$inres)
                    {
                        $sql="rollback";
                        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                        return "some error";
                    }
                    
                }

                if($inres ==1)
                    {
                        $sql="commit";
                        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
                        return "suceess";
                    }
                    else
                    {
                        return "Some_error";
                    }
            }
            else{
                return "bill id not geted";
            }
        }
        else
        {
            return "Some_error";
        }

    }

    public function getbills()
    {
        
    $sql="SELECT * FROM `bill`";
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

    public function getbillItems($id)
    {   
        $sql="SELECT * FROM `bill_items` WHERE `bill_id`=$id ";
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

}


if(isset($_POST["additemfun"]))
{
    
    $rows=$product->getProductdata();
    echo json_encode($rows);

    exit();
}

if(isset($_POST["getdata"]))
{
    $row=$product->getProductdatabyid($_POST["id"]);
    echo json_encode($row[0]);
    exit();
}

if(isset($_POST["O_customer_name"]))
{
    $counter=$_SESSION["empUsername"];
    $errorname=$erroeEmail=$errorTotal=$errorPid=$errorPqty="";
    $error=[];
    $i=0;
    $cname=$_POST["O_customer_name"];
    $cemail=$_POST["O_customer_mail"];
    $date=$_POST["O_date"];
    
    if(empty($cname))
	{
        // $errorname="product name is required";
        $error[0]="product name is required";
	}
	else
	{
		if(!preg_match("/^[a-zA-z\_]*$/", $cname))
		{
            // $errorname="Only alphabets allowed with _";
            $error[0]="Only alphabets allowed with _";
        }
        else
        {
            $i++;
        }
        
    }
    if(empty($cemail))
    {
        // $erroeEmail=
        $error[1]="type not seleced";
    }
    else
    {
        if(!filter_var($cemail,FILTER_VALIDATE_INT))
        {
            // $erroeEmail=
            $error[1]="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }

    $total=$_POST["O_totals"];
    if(empty($total))
    {
        // $errorTotal=
        $error[2]="total shold not be empty";

    }
    else{
        $i++;
    }
    if(isset($_POST["O_id"]))
    {
        $pids=$_POST["O_id"];
        foreach ($pid as $key=>$val ) {
            if(empty($key))
            {
                // $errorPid=
                $error[3]="product is empty on". $key;
            }
        }
        // if($errorPid="")
        if($error[3]="")
        {
            $i++;
        }
    }
    else{
        // $errorPid=
        $error[3]="product is not selected";
    }
    $O_p_price=$_POST["O_p_price"];
    if(isset($_POST["O_p_b_qty"]))
            {    $pqty=$_POST["O_p_b_qty"];
                foreach ($pqty as $key=>$val ) {
                    if(empty($val))
                    {
                        $error[4]="product qty empty on". $key;
                    }

                }
                if($error[4]=="")
                {
                    $i++;
                }

            }    
    $ptotal=$_POST["O_p_total"];

    if($i==5)
    {
    $order=new order();
    $res= $order->takeorder($cname,$cemail,$pids,$pqty,$ptotal,$counter,$date,$total);
    echo $res;
    }
    else{
        // echo json_encode([$errorname,$erroeEmail,$errorTotal,$errorPid,$errorPqty]);
        print_r($error);
        
        $main = array('data'=>$error); 
        echo json_encode($main); 
    }
    // header("location:view_order.php");
   
}

?>