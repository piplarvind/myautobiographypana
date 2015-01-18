/*
 *  START :: Contact Us or enquiry form validation :
 *  By Vaibhav Pathak On 30 Sep 2014 :
 */
var j = jQuery.noConflict();
j(document).ready(function() {

    /* [START] :: add method for complete url validation: */

    j.validator.addMethod("complete_url", function(val, elem) {
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

    j.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter letters only ");

    j.validator.addMethod("numberonly", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Please enter number only ");

    j.validator.addMethod("phonenumber", function(value, element) {
        return this.optional(element) || /^\+?[6]{1}?[0-9]{10}$/i.test(value);
    }, "Please enter valid contact number.");

    j.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    }, j.format("Please enter exactly {0} characters."));


    
    
    /* edit user  B registration  form validation */

    j("#edit_userB_details").validate({
        errorElement: "div",
        rules: {
                   
            
            
            Name_of_institute:
                    {
                        required: true
                       // lettersonly: true,
                    },
            Address_line1:
                    {
                        required: true,
                    }, 
               
             Address_line2:
                    {
                        required: true,
                    },               
            country:
                    {
                        required: true,
                       
                    },
            state:
                    {
                        required: true,
                       
                    },  
            Village_city:
                    {
                        required: true,
                        lettersonly: true,
                    },    
            pin_code:
                    {
                        required: true,
                        numberonly: true,
                    },        
            contact_number:
                    {
                        required: true,
                        numberonly:true
                        /* number: true, 
                       
                        minlength: 10,
                        maxlength:12 */
                        
                    },
              country_code:
                    {
                        required: true,
                        numberonly: true,
                    }, 
            user_email: {
                required: true,
                email: true,
                emailspecialchars : true,
                remote: {
                    url: j('#base_url').val() + 'chk-edit-email-duplicate',
                    type: 'post',
                    data: {
                        type: "post",
                        old_user_email: j("#old_user_email").val()
                    }
                }
            },

            password:
                    {
                        required: true,
                        minlength: 8
                        /* password_strenth:true */
                    },
            confirm_password:
                    {
                        required: true,
                        equalTo: "#password"},
            institute_website: {required: true, url: true},
            Name_of_founder:
                    {
                        required: true
                       // lettersonly: true,
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
//                     user_name:
//                    {
//                        required: true
//                    },
                    
        },
        messages: {

            Name_of_institute:
                    {
                        required: "Please enter user name.",
                    },
                    
            Address_line1:
                    {
                        required: "Please enter address line1.",
                    },   
            Address_line2:
                    {
                        required: "Please enter address line2.",
                    },           
            country:
                    {
                        required: "Please select country.",
                    },   
            state:
                    {
                        required: "Please select state.",
                    },
            Village_city:
                    {
                        required: "Please enter village/city name.",
                    },        
            pin_code:
                    {
                        required: "Please enter pin code.",
                    },
             country_code:
                    {
                        required: "Please enter valid country code.",
                    },       
            contact_number:
                    {
                        required: "Please enter your contact number."
                        /* number: "Please enter valid contact number.", 
                        minlength: "Please enter 12 digit contact number.",
                        maxlength: "Please enter 12 digit contact number." */
                        
                    },
            user_email:
                    {
                        required: "Please enter your contact email.",
                        email: "Please enter valid email address.",
                        remote: "This email address is already registered with site."
                    },

            password:
                    {
                        required: "Please enter your password.",
                        minlength: "Please enter atleast 8 character." 
                    },
            confirm_password:
                    {
                        required: "Please enter your confirm password.",
                        equalTo: "These passwords don't match. Try again.",
                    },
                   institute_website: {required: "Please enter website url."},
            Name_of_founder:
                    {
                        required: "Please enter valid name.",
                    },   
            user_name: {
                required: "Please enter username.",
                chk_username_field: "Please enter a valid username. It must contain 5-20 characters. Characters other than <b> A-Z , a-z , _ , . , - </b>  are not allowed.",
                remote: "Username already exists."
            },      
            submitHandler: function() {
                j('#regi_step2_btn').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });

});
  jQuery.validator.addMethod("emailspecialchars", function (value, element) {
        return value.match(new RegExp(/^[0-9a-z_A-Z.@s]+$/));
    }, "Please enter only letters, numbers, @ , _ and (.) dot.");



