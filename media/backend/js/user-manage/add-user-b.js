
var j = jQuery.noConflict();

j(document).ready(function (e) {

    j.validator.addMethod("emailspecialchars", function (value, element) {
        return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
    }, "Please enter only letters, numbers, @ , _ and (.) dot.");

    j("#frm_user_details").validate({
        errorElement: "div",
        errorClass: 'validationError',
        rules: {
            user_name: {
                required: true,
                remote: {
                    url: j("#base_url").val() + "backend/admin/check-admin-username",
                    type: "post"
                }
            },
            name_of_institute: {
                required: true
            },
            address_1: {
                required: true
            },
            address_2: {
                required: true
            },
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            user_city: {
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
                    url: j("#base_url").val() + "backend/admin/check-admin-email",
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
            institute_type: {
                required: true
            },
            user_country_code: {
                required: true,
                number: true
            },
            user_contact_no: {
                required: true,
                number: true,
                minlength: "10"
            },
            user_institute_website: {
                required: true,
                url: true
            },
            established_in: {
                required: true,
                number: true,
                exactlength: "4"
            },
            name_of_founder: {
                required: true
            },
            role_id: {
                required: true
            }
        },
        messages: {
            name_of_institute: {
                required: "Please enter name of institute."
            },
            address_1: {
                required: "Please enter the Address 1."
            },
            address_2: {
                required: "Please enter the Address 2."
            },
            country_id: {
                required: "Please select country."
            },
            state_id: {
                required: "Please select state."
            },
            contact_no: {
                number: "Please enter valid contact number.",
                minlength: "Please enter 10 digit conact number"
            },
            user_name: {
                required: "Please enter username.",
                chk_username_field: "Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "Username already exists."
            },
            user_contact_no: {
                required: "Please enter contact number.",
                number: "Please enter valid contact number.",
                minlength: "Please enter 10 digit contact number."
            },
            user_country_code: {
                required: "Please enter country code.",
                number: "Please enter valid country code."
            },
            user_institute_website: {
                required: "Please enter institute website url.",
                url: "Please enter valid institute website url."
            },
            user_city: {
                required: "Please enter village/city."
            },
            institute_type: {
                required: "Please select type of institute."
            },
            established_in: {
                required: "Please enter year of established in.",
                number: "Please enter valid year of established in.",
                exactlength: "Please enter 4 digit year of established in."
            },
            name_of_founder: {
                required: "Please enter name of founder."
            },
            pin_code: {
                required: "Please enter pin code.",
                number: "Please enter valid pin code."
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
            }
        },
        submitHandler: function (form) {
            j("#btn_submit").hide();
            form.submit();
        }
    });
    j.validator.addMethod("exactlength", function (value, element, param) {
        return this.optional(element) || value.length == param;
    }, j.format("Please enter exactly {0} characters."));

});