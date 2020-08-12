$(document).ready(function()
{
    function additem()
    {
      $.ajax(
         {
            url : "../sale_and_inventory_management/dbs/order.php",
            method : "POST",
            data : {additemfun:1},
            success: function(data)
            {
               $("tbody#product_buy").append(data);
            }    
         }     
         );
    }
    additem();
    $("#add").click(function()
   {

      additem();
    //    $("#child_order").clone().appendTo("table");
       
   });
   $("#delete").click(function()
   {
    //    $("#child_order").clone().appendTo("table");
       $("tbody#product_buy").children("tr:last").remove();
   });

   $("#product_buy").delegate(".O_id","change",function()
   {
      var pid = $(this).val();
      var tr =$(this).parent().parent();

      var q=$("O_p_qty[pid]").val();
      console.log(q);
      $.ajax(
         {
            url : "../sale_and_inventory_management/dbs/order.php",
            method : "POST",
            data : {getdata:1,id:pid},
            dataType:"JSON",
            success: function(data)
            {
               console.table(tr);
               console.log(data);
               console.table(data["product_price"]);
               console.table(data["product_stoke"]);
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
            url : "../sale_and_inventory_management/dbs/order.php",
            method : "POST",
            data :$("#order_Table").serialize()
        }
    )
   });
});