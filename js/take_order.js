$(document).ready(function()
{
    
    var tag=$("#form_product").html();
    console.log({tag});
    $("#add").click(function()
   {
    //    $("#child_order").clone().appendTo("table");
       $("tbody.product_buy").append("<tr>"+tag+"</tr>");
   });
   $("#delete").click(function()
   {
    //    $("#child_order").clone().appendTo("table");
       $("tbody.product_buy").children("tr:last").remove();
   });
});