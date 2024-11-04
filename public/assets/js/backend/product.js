document.addEventListener("DOMContentLoaded", function () {
    $("#tblProduct").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "ASC"]],
        ajax: "getproductdata",
        fnRowCallback: serialNoCount,
        columns: [
            { data: "id", orderable: false },
            {
                data: "product_image",
                render: function (data, type, row) {
                    return (
                        '<img src="' +
                        row.product_image +
                        '" class="avatar" width="50" height="50"/>'
                    );
                },
            },
            { data: "product_name" },
            { data: "description" },
            { data: "product_price" },
            { data: "category_name" },
            { data: "brand_name" },
            { data: "discount" },
            { data: "action", }
            
        ],
    });
});


// jquery Validation
$(function () {
    $("form[name='product']").validate({
        rules: {
            txtProductName: "required",
            ddlCategory: "required",
            txtProductPrice: "required",
            ddlBrand: "required",
            txtProductDiscount: "required",
            txtShortDescription: "required",
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

//Image Showing
const inputFiles = document.querySelectorAll('input[type="file"]');
const previewImages = document.querySelectorAll('img[id^="previewImage"]');

inputFiles.forEach(function (inputFile, index) {
    inputFile.addEventListener("change", function () {
        const file = this.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            previewImages[index].setAttribute("src", this.result);
        });

        if (file) {
            reader.readAsDataURL(file);
        }
    });
});

function doEdit(id) {
    $("#hdProductId").val(id);
    $("#txtProductName").focus();
    $("#btnSave").text("Update");
    $("#heading").text("Update Product");
    getProductById(id);
}

function getProductById(id) {
    $.ajax({
        type: "GET",
        url: "getproduct/" + id,
        dataType: "json",
        success: function (data) {
            $("#txtProductName").val(data.product.product_name);
            $("#ddlCategory").val(data.product.category_id).trigger("change");
            $("#txtProductPrice").val(data.product.product_price);
            $("#ddlBrand").val(data.product.brand_id).trigger("change");
            $("#txtProductDiscount").val(data.product.discount);
            $("#txtShortDescription").val(data.product.description);
            $("#hdProductImage").val(data.product.product_image);
            $("#previewImage").attr("src", data.product.product_image);
            $("#fileProductImage").removeAttr("required");
        },
    });
    
}

function showDelete(id) {
    confirmDelete(id, "product/", "tblProduct");
}