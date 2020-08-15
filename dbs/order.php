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
        $inres=mysqli_query($this->con,$sql) or die(mysqli_error());
        if($inres ==1)
        {
            $bill_id=$this->con->insert_id;

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
    $i=0;
    $cname=$_POST["O_customer_name"];
    $cemail=$_POST["O_customer_mail"];
    $date=$_POST["O_date"];
    
    if(empty($cname))
	{
        $errorname="product name is required";
	}
	else
	{
		if(!preg_match("/^[a-zA-z\_]*$/", $cname))
		{
            $errorname="Only alphabets allowed with _";
        }
        else
        {
            $i++;
        }
        
    }
    if(empty($cemail))
    {
        $erroeEmail="please emter email address";
    }
    else
    {
        if(!filter_var($cemail,FILTER_VALIDATE_EMAIL))
        {
            $erroeEmail="Invalid email format";
        }
        else
        {
            $i++;
        }   
    }

    $total=$_POST["O_totals"];
    if(empty($total))
    {
        $errorTotal="total shold not be empty";

    }
    else{
        $i++;
    }


    if(isset($_POST["O_id"]))
    {
        $pids=$_POST["O_id"];
        $errorPid="product is empty on ";
        foreach ($pids as $key=>$val ) {
                if(empty($val))
                {
                    $errorPid= $errorPid. $key;
                }
            }
            if($errorPid=="product is empty on ")
            {
                $errorPid=" ";
                $i++;
            }
    }
    else{
        $errorPid="product is not selected";
    }
    $O_p_price=$_POST["O_p_price"];
    if(isset($_POST["O_p_b_qty"]))
    {  
            $pqty=$_POST["O_p_b_qty"];
            $errorPqty="product qty empty on ";
            foreach ($pqty as $key=>$val ) {
                if(empty($val))
                {
                    $errorPqty = $errorPqty . $key;
                }
            }
            if($errorPqty=="product qty empty on ")
            {
                $errorPqty=" ";
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
        ?>
<script>

var cname= "<?php echo $errorname;?>";
var cemail= "<?php echo $erroeEmail;?>";
var total= "<?php echo $errorTotal;?>";
var pid= "<?php echo $errorPid;?>";
var pqty= "<?php echo $errorPqty;?>";
console.log(cname);
$("#errorcname").html(cname);
$("#errorEmail").html(cemail);
$("#errorproduct").html(pid);
$("#errorpqty").html(pqty);
$("#errorTotal").html(total);

</script>


        <?php 
    }
    // header("location:view_order.php");
   
}

?>