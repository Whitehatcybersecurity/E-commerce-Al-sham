document.addEventListener("DOMContentLoaded", function () {
    $(".mobilenumber").on("input", function () {
        $(this).val(
            $(this)
                .val()
                .replace(/[^0-9]/g, "")
        );

        var mobileNumber = $(this).val();
        if (mobileNumber.length != 10 || isNaN(mobileNumber)) {
            $(this).css("border-color", "red");
        } else {
            $(this).css("border-color", "green");
        }
    });
});

// jquery Validation
$(function () {
    $("form[name='register']").validate({
        rules: {
            txtUsername: "required",
            txtEmail: "required",
            txtMobile: "required",
            password: "required",
            confirm_password: {
                required: true,
                equalTo: "#password",
            },
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
