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
                    
                }

                if($inres ==1)
                    {
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
    ?>
        <tr>
        <td>
            <select name="O_id[]" id="O_id" class="O_id">
            <option value="" selected disabled>select item</option>
            <?php
            foreach ($rows as $key) {
                ?>

                <option value="<?php echo $key[0];?>"><?php echo $key[1];?></option>

            <?php
                }
            ?>

            </select>
        </td>
        <!-- <td><input type="text" name="O_p_name[]" id="O_p_name[]"></td> -->
        <td><input type="number" name="O_p_price[]" id="O_p_price" readonly></td>
        <td><input type="number" name="O_p_qty[]" id="O_p_qty" readonly></td>
        <td><input type="number" name="O_p_b_qty[]" id="O_p_b_qty" class="O_p_b_qty" min="0"></td>
        <td><input type="number" name="O_p_total[]" id="O_p_total" class="O_p_total"></td>
    </tr>   
    
<?php
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

    $cname=$_POST["O_customer_name"];
    $cemail=$_POST["O_customer_mail"];
    $date=$_POST["O_date"];
    $total=$_POST["O_totals"];
    $pids=$_POST["O_id"];
    $O_p_price=$_POST["O_p_price"];
    $pqty=$_POST["O_p_b_qty"];
    $ptotal=$_POST["O_p_total"];
    $order=new order();

     $order->takeorder($cname,$cemail,$pids,$pqty,$ptotal,$counter,$date,$total);
    // header("location:view_order.php");
}

?>