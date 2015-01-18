
var j = jQuery.noConflict();
j(document).ready(function (e) {

    j.validator.addMethod("emailspecialchars", function (value, element) {
        return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
    }, "Please enter only letters, numbers, @ , _ and (.) dot.");

    j("#frm_user_details").validate({
        errorElement: "div",
        errorClass: 'validationError',
        errorPlacement: function (label, element) {
            if (element[0].name == "day")
            {
                $("#day_error").html(label);
            }
            else if (element[0].name == "month")
            {
                $("#month_error").html(label);
            }
            else if (element[0].name == "year")
            {
                $("#year_error").html(label);
            }
            else if (element[0].name == "interest_id[]")
            {
                $("#role_error").html(label);
            }
            else
            {
                label.insertAfter(element);
            }
        },
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            user_name: {
                required: true,
                remote: {
                    url: j("#base_url").val() + "backend/admin/check-admin-username",
                    type: "post"
                }
            },
            day: {
                required: true
            },
            month: {
                required: true
            },
            year: {
                required: true
            },
            pin_code: {
                required: true,
                number: true
            },
            user_email: {
                required: true,
                email: true,
                emailspecialchars: true,
                remote: {
                    url: jQuery("#base_url").val() + "backend/admin/check-admin-email",
                    type: "post"
                }
            },
            cnf_user_email: {
                required: true,
                email: true,
                equalTo: '#user_email'
            },
            user_password: {
                required: true,
                minlength: 8

            },
            confirm_password: {
                required: true,
                equalTo: '#user_password'
            },
            profile_picture: {
//                required: true,
                accept: 'jpg|jpeg|gif|png'
            },
            user_contact_no: {
                required: true,
                number: true,
                minlength: "10"
            },
            user_country_code: {
                required: true,
                number: true
            },
            user_registered: {
                required: true
            },
            institute_id: {
                required: true
            },
            "interest_id[]": {
                required: true,
                minlength: "2"
            },
            new_interest : {
              required :true  
            },
            role_id: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name."
            },
            last_name: {
                required: "Please enter last name."
            },
            user_name: {
                required: "Please enter username.",
                remote: "Username already exists."
            },
            day: {
                required: "Please select a day."
            },
            month: {
                required: "Please select a month."
            },
            year: {
                required: "Please select a year."
            },
            pin_code: {
                required: "Please enter pin code.",
                number: "Please enter valid pin code."
            },
            institute_id: {
                required: "Please select Institute Name."
            },
            user_email: {
                required: "Please enter an email address.",
                email: "Please enter a valid email address.",
                remote: "Email address already exists."
            },
            cnf_user_email: {
                required: "Please enter a confirm email address .",
                email: "Please enter a valid email address.",
                equalTo: 'email and confirm email does not match.'
            },
            user_password: {
                required: "Please enter password.",
                minlength: "Please enter atleast 8 characters."
            },
            confirm_password: {
                required: "Please enter confirm password.",
                equalTo: "Password and confirm password does not match."
            },
            profile_picture: {
//                required: "Please select a file to upload",
                accept: 'Only jpg|jpeg|gif|png formats are allowed'
            },
            user_country_code: {
                required: "Please enter country code.",
                number: "Please enter valid country code."
            },
            user_contact_no: {
                required: "Please enter contact number.",
                number: "Please enter valid contact number.",
                minlength: "Please enter 10 digit contact number."
            },
            user_registered: {
                required: "Please select status."
            },
            "interest_id[]": {
                required: "Please select the interest.",
                minlength: "Please select at least two interest."
            },
            new_interest : {
              required :"Please enter other interest."
            },
        },
        submitHandler: function (form) {
            j("#btn_submit").hide();
            form.submit();
        }
    });

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