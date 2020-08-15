$(document).ready(function()
{
   var domain="http://localhost/sem5/php_new/sale_and_inventory_management/";
   var productdata=[];
   var p=[];
   var row;
   function getselected()
   {
      $('option').prop('disabled', false); //reset all the disabled options on every change event
      $('select').each(function() { //loop through all the select elements
        var val = this.value;
        $('select').not(this).find('option').filter(function() { //filter option elements having value as selected option
          return this.value === val;
        }).prop('disabled', true); //disable those option elements
      });
   }
    function additemdata()
    {
      $.ajax(
         {
            url : domain+"dbs/order.php",
            method : "POST",
            data : {additemfun:1},
            dataType:"JSON",
            success: function(data)
            {
               console.log(data);
               console.log(data.length);
            data.forEach((val,index)=>
            {
               if(data[index]!=null)
               {
                  for(var i in data[index])
                  {
                     if(i<6)
                     p.push(data[index][i]);
                  }
                  p.push("0");
                  productdata.push(p);
                  p= [];
               }
            }

            )
            console.log(productdata);
            additem();
            }    
         }     
         );
      
    }
    additemdata();
    function additem()
    {
               
         row="<tr>";
         row+="<td>";
         row+="<select name='O_id[]' id='O_id' class='O_id'>";
            row+= "<option value='' selected disabled>select item</option>"
            productdata.forEach((val,index)=>{
                  row+="<option value='"+productdata[index][0]+"'>"+ productdata[index][1]+"</option>";
            })
            row+="</select>";
         row+="</td>";
         row+="<td><input type='number' name='O_p_price[]' id='O_p_price' readonly></td>";
         row+="<td><input type='number' name='O_p_qty[]' id='O_p_qty' readonly></td>";
         row+="<td><input type='number' name='O_p_b_qty[]' id='O_p_b_qty' class='O_p_b_qty' min='0'></td>";
         row+="<td><input type='number' name='O_p_total[]' id='O_p_total' class='O_p_total' readonly></td>";
         row+="</tr>";
         $("tbody#product_buy").append(row);
         // getselected();
    }
    $("#add").click(function()
    {
       additem();
    });
    $("#delete").click(function()
    {
        $("tbody#product_buy").children("tr:last").remove();
    });
 
   function getselected()
   {
      $('option').prop('disabled', false); //reset all the disabled options on every change event
      $('select').each(function() { //loop through all the select elements
        var val = this.value;
        $('select').not(this).find('option').filter(function() { //filter option elements having value as selected option
          return this.value === val;
        }).prop('disabled', true); //disable those option elements
      });
   }

    
   $("#product_buy").delegate(".O_id","change",function()
   {

      var pid = $(this).val();
      var tr =$(this).parent().parent();
      // getselected();
      $.ajax(
         {
            url : domain+"dbs/order.php",
            method : "POST",
            data : {getdata:1,id:pid},
            dataType:"JSON",
            success: function(data)
            { 
               tr.find("#O_p_price").val(data["product_price"]);
               tr.find("#O_p_qty").val(data["product_stoke"]);
               tr.find("#O_p_b_qty").attr("max",data["product_stoke"]);

            }  
         });
   });

   function gettotal()
   {
      var total = 0;
      $(".O_p_total").each(function()
      {
          total = total + parseInt($(this).val());
         console.log($(this).val());
         console.log(total);
      });
      $("#O_totals").val(total);

   }
   $("#product_buy").delegate(".O_p_b_qty","keyup",function()
   {
      
      var data=$(this).val();
      console.log(data);
      var tr =$(this).parent().parent();
      var price=tr.find("#O_p_price").val();
      var total= data*price;
      var max=$(this).attr("max");
      tr.find("#O_p_total").val(total);
      gettotal();
   });

   $("#addorder").click(function()
   {
    console.log("clicked");
      //  $.post("../sale_and_inventory_management/dbs/order.php",
      //   {$("#order_Table").serialize()},
      //      function (data) {
      //          alert(data);}
      //  );
      
    $.ajax(
        {
            url : domain+"dbs/order.php",
            method : "POST",
            data :$("#order_Table").serialize(),
            success: function(data)
            {
               // console.log(data);
               // alert(data);
               if(data=="suceess")
               {
                  window.location=domain+"view_orders.php"; 
               }
               else
               {
                  alert("some error");                 
                  console.log(data);                 
               }
            }  
        }
    )
   });
});