document.addEventListener("DOMContentLoaded", function () {
    $("#tblCategory").DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "ASC"]],
        ajax: "getcategorydata",
        fnRowCallback: serialNoCount,
        columns: [
            { data: "id", orderable: false },
            {
                data: "category_image",
                render: function (data, type, row) {
                    return (
                        '<img src="' +
                        row.category_image +
                        '" class="avatar" width="50" height="50"/>'
                    );
                },
            },
            { data: "category_name" },
            { data: "action", }
            
        ],
    });
});


// jquery Validation
$(function () {
    $("form[name='category']").validate({
        rules: {
            txtCategoryName: "required",
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
    $("#hdCategoryId").val(id);
    $("#txtCategoryName").focus();
    $("#btnSave").text("Update");
    $("#heading").text("Update Category");
    getCategoryById(id);
}

function getCategoryById(id) {
    $.ajax({
        type: "GET",
        url: "getcategory/" + id,
        dataType: "json",
        success: function (data) {
            $("#txtCategoryName").val(data.category.category_name);
            $("#hdCategoryImage").val(data.category.category_image);
            $("#previewImage").attr("src", data.category.category_image);
            $("#fileCategoryImage").removeAttr("required");
        },
    });
}

function showDelete(id) {
    confirmDelete(id, "category/", "tblCategory");
}