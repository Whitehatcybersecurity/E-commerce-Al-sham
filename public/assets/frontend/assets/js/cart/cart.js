document.addEventListener("DOMContentLoaded", function () {
    
    
});

// jquery Validation
$(function () {
    $("form[name='cartdetails']").validate({
        rules: {
            customer_name: "required",
            customer_number: "required",
            customer_email: "required",
           
        },
        errorPlacement: function (error, element) {
            if (element.is(":radio")) {
                error.appendTo(element.parents(".form-group"));
            } else {
                // This is the default behavior
                // error.insertAfter(element);
                if (element.siblings(".error").html() == undefined) {
                    error.appendTo(element.parent().next(".error"));
                } else {
                    error.appendTo(element.siblings(".error"));
                }
            }
        },
    });
});

function cartdelete(id){

    $.ajax({
        type: "GET",
        url: "/carts/products/delete/" + id,
        data: {
           
        },
        dataType: "json",
        success: function (data, textStatus, xhr) {
            if (data.notification_response.alert == "success") {
                // $("#cartCount").text(data.count_response.count);
                toastr.success(data.notification_response.message);
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                };
                setTimeout(function() {
                    location.reload();
                }, 1000); 
                // $("#spnBtnCart").text("view Cart");
                // $("#btnPdCart")
                //     .removeClass()
                //     .addClass(
                //         "btn btn-outline btn-rounded btn-success btn-icon-left cart"
                //     );
                // $("#btnPdCart")
                //     .attr("href", `${baseurl}/cart`)
                //     .attr("onclick", "");
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