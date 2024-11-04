document.addEventListener("DOMContentLoaded", function () {
    
});

var quantity = 1;
function increaceQty() {
    
    // var stk = parseInt($("#hidstk").val()); 
    var currentQuantity = parseInt(quantity);
    //Productwise Quantity Binding
   
    var newQuantity = currentQuantity + 1;
        quantity = newQuantity;
   
    $(' input[name="txtqty"]').val(quantity);

}

function decreaseQty() {
    // var stk = parseInt($("#hidstk").val()); 
    var currentQuantity = parseInt(quantity);
   
          //Productwise Quantity Binding
        var newQuantity = currentQuantity - 1;
        quantity = newQuantity; 
        if(quantity == 0){
            quantity = 1;
        }

    $(' input[name="txtqty"]').val(quantity);
}

function cart(id) {
    var userId = $("#userId").data("user-id");
    var product_id = id;
    var qty = $("#txtqty").val() == undefined ? 1 : $("#txtqty").val();
    var price = $("#txtProductPrice" + id).text();console.log(price);
    var currentPrice = parseFloat(price.replace(/AED/g, ""));console.log(currentPrice);
    $.ajax({
        type: "GET",
        url: "/carts/products",
        data: {
            product_id: product_id,
            qty: qty,
            currentPrice: currentPrice,
        },
        dataType: "json",
        success: function (data, textStatus, xhr) {
            if (data.notification_response.alert == "success") {
                $("#cartCount").text(data.count_response.count);
                toastr.success(data.notification_response.message);
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                };
                $("#spnBtnCart").text("view Cart");
                $("#btnPdCart")
                    .removeClass()
                    .addClass(
                        "btn btn-outline btn-rounded btn-success btn-icon-left cart"
                    );
                $("#btnPdCart")
                    .attr("href", `${baseurl}/cart`)
                    .attr("onclick", "");
            } else {
                toastr.error(data.notification_response.message);
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                };
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            if (xhr.status === 401) {
                toastr.error("Please Login First");
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                };
            }
        },
    });
}