document.addEventListener("DOMContentLoaded", function () {

});

//jquery validation
$(function() {
    // Your code here
    $("form[name='adminlogin']").validate({
        rules: {
            txtEmailId: "required",
            password: {
                required: true,
                minlength: 6 // Minimum password length of 6 characters
            },
        },
        messages: {
            password : "Enter minimum 6 charecters"
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