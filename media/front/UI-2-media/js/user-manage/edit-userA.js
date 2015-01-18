/*
 *  START :: Contact Us or enquiry form validation :
 *  By Vaibhav Pathak On 30 Sep 2014 :
 */
var j = jQuery.noConflict();
j(document).ready(function () {

    /* [START] :: add method for complete url validation: */

    j.validator.addMethod("complete_url", function (val, elem) {
        // if no url, don't do anything
        if (val.length == 0) {
            return true;
        }

        // if user has not entered http:// https:// or ftp:// assume they mean http://
        if (!/^(https?|ftp):\/\//i.test(val)) {
            val = 'http://' + val; // set both the value
            $(elem).val(val); // also update the form element
        }
        // now check if valid url
        // http://docs.jquery.com/Plugins/Validation/Methods/url
        // contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
        return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
    });

    j.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter letters only ");

    j.validator.addMethod("numberonly", function (value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Please enter number only ");

    j.validator.addMethod("phonenumber", function (value, element) {
        return this.optional(element) || /^\+?[6]{1}?[0-9]{10}$/i.test(value);
    }, "Please enter valid contact number.");

    j.validator.addMethod("exactlength", function (value, element, param) {
        return this.optional(element) || value.length == param;
    }, j.format("Please enter exactly {0} characters."));




    /***************user A edit profile validation*****************/
    /* Add user registration form validation */

    j("#edit_userA_details_form").validate({
        errorElement: "div",
        errorPlacement: function (label, element) {
            if (element[0].name == "interest[]")
            {
                j("#post_error").html(label);
            }
            else
            {
                label.insertAfter(element);
            }
        },
        rules: {
//            user_name:{
//                        required: true
//                    },
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
            day:
                    {
                        required: true
                    },
            month:
                    {
                        required: true
                    },
            year:
                    {
                        required: true
                    },
            pin_code:
                    {
                        required: true,
                        numberonly: true,
                    },
            contact_number:
                    {
                        required: true,
                        numberonly: true
                                /* number: true, 
                                 minlength: 10,
                                 maxlength:12 */
                    },
            country_code:
                    {
                        required: true,
                        numberonly: true,
                    },
            "interest[]": {
                required: true,
                minlength: 2
            },
            new_interest:
                    {
                        required: true
                    },
            user_email: {
                required: true,
                email: true,
                emailspecialchars: true,
                remote: {
                    url: jQuery('#base_url').val() + 'chk-edit-email-duplicate',
                    type: 'post',
                    data: {
                        type: "post",
                        old_user_email: $("#old_user_email").val()
                    }
                }
            },
        },
        messages: {
//            user_name:
//                    {
//                        required: "Please enter user name.",
//                    },
            user_name: {
                required: "Please enter username.",
                chk_username_field: "Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "Username already exists."
            },
            day:
                    {
                        required: "Please select the day.",
                    },
            month:
                    {
                        required: "Please select the month.",
                    },
            year:
                    {
                        required: "Please select the year.",
                    },
            pin_code:
                    {
                        required: "Please enter pin code.",
                    },
                       new_interest:
                    {
                        required: "Please enter other interest."
                    },
            contact_number:
                    {
                        required: "Please enter your contact number."
                                /* number: "Please enter valid contact number.", 
                                 minlength: "Please enter 12 digit contact number.",
                                 maxlength: "Please enter 12 digit contact number." */

                    },
            country_code:
                    {
                        required: "Please enter valid country code.",
                    },
            "interest[]":
                    {
                        required: "Please check at least 2 interest.",
                        minlength: "Please check at least 2 interest."
                    },
            user_email:
                    {
                        required: "Please enter your contact email.",
                        email: "Please enter valid email address.",
                        remote: "This email address is already registered with site."
                    },
        }
    });

//    j("#edit_institutional_brownies_form").validate({
//        errorElement: "div",
//        rules: {
//            category_name:
//                    {
//                        required: true,
//                        lettersonly: true,
//                    },
//            category_title:
//                    {
//                        required: true,
//                        lettersonly: true,
//                    },
//            meta_keyword:
//                    {
//                        required: true,
////                        lettersonly: true,
//                    },  
//            meta_description:
//                    {
//                        required: true,
////                        lettersonly: true,
//                    }
//            
//         
//        },
//        messages: {
//            category_name:
//                    {
//                        required: "Please enter category name.",
//                    },
//            category_title:
//                    {
//                        required: "Please enter category title.",
//                    },
//            meta_keyword:
//                    {
//                        required: "Please enter page keyword code.",
//                    },  
//            meta_description:
//                    {
//                        required: "Please enter page description.",
//                    }
//        },
//    });






});



jQuery.validator.addMethod("emailspecialchars", function (value, element) {
    return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
}, "Please enter only letters, numbers, @ , _ and (.) dot.");



