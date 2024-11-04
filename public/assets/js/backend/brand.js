document.addEventListener("DOMContentLoaded", function () {
    $("#tblBrand").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "ASC"]],
        ajax: "getbranddata",
        fnRowCallback: serialNoCount,
        columns: [
            { data: "id", orderable: false },
            {
                data: "brand_image",
                render: function (data, type, row) {
                    return (
                        '<img src="' +
                        row.brand_image +
                        '" class="avatar" width="50" height="50"/>'
                    );
                },
            },
            { data: "brand_name" },
            { data: "action", }
            
        ],
    });
});

// jquery Validation
$(function () {
    $("form[name='brand']").validate({
        rules: {
            txtBrandName: "required",
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
    $("#hdBrandId").val(id);
    $("#txtBrandName").focus();
    $("#btnSave").text("Update");
    $("#heading").text("Update Brand");
    getBrandById(id);
}

function getBrandById(id) {
    $.ajax({
        type: "GET",
        url: "getbrand/" + id,
        dataType: "json",
        success: function (data) {
            $("#txtBrandName").val(data.brand.brand_name);
            $("#hdBrandImage").val(data.brand.brand_image);
            $("#previewImage").attr("src", data.brand.brand_image);
            $("#fileBrandImage").removeAttr("required");
        },
    });
}

function showDelete(id) {
    confirmDelete(id, "brand/", "tblBrand");
}
