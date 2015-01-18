var j = jQuery.noConflict();

j(document).ready(function (e) {



    j.validator.addMethod("emailspecialchars", function (value, element) {
        return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
    }, "Please enter only letters, numbers, @ , _ and (.) dot.");


    j("#frm_admin_details").validate({
        errorElement: "div",
        errorClass: 'validationError',
        errorPlacement: function (label, element) {
            if (element[0].name == "admin_privileges[]")
            {
                label.insertAfter("#pre_div");
            } else
            {
                label.insertAfter(element);
            }
        },
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            contact_no: {
                number: true,
                minlength: 10
            },
            user_name: {
                required: true,
                remote: {
                    url: j("#base_url").val() + "backend/admin/check-admin-username",
                    type: "post",
                    data: {
                        type: "edit",
                        old_username: j('#old_username').val()
                    }
                }
            },
            user_email: {
                required: true,
                email: true,
                emailspecialchars: true,
                remote: {
                    url: j("#base_url").val() + "backend/admin/check-admin-email",
                    type: "post",
                    data: {
                        type: "edit",
                        old_email: j('#old_email').val()
                    }
                }
            },
            user_password: {
                required: true,
                minlength: 8
            },
            confirm_password: {
                required: true,
                equalTo: '#user_password'
            },
            role_id: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Please enter the first name."
            },
            last_name: {
                required: "Please enter the last name."
            },
            contact_no: {
                number: "Please enter valid contact number.",
                minlength: "Please enter 10 digit conact number"
            },
            user_name: {
                required: "Please enter the username.",
                remote: "Username already exists."
            },
            user_email: {
                required: "Please enter an email address.",
                email: "Please enter a valid email address.",
                remote: "Email address already exists."
            },
            user_password: {
                required: "Please enter a password.",
                minlength: "Please enter at least 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                equalTo: "Password and confirm password do not match."
            },
            role_id: {
                required: "Please select admin user role."
            }
        }
    });
    j("#check_box").css({display: "block", opacity: "0", height: "0", width: "0", "float": "right"});
    j("#change_password").bind("click", function () {
        if ($("#change_password").is(':checked'))
        {
            j('#change_password_div').css('display', 'block');
        }
        else
        {
            j('#change_password_div').css('display', 'none');
        }
    });
});