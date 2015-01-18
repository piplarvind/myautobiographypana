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
            j(elem).val(val); // also update the form element
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
    
        
        j("#contact_us_frm").validate({
         errorElement:"div",
        rules: {
           user_name : 
           {
            required: true
           },
           email: 
           {
            required: true,
            email:true
           },
           content:
           {
             required: true
           }
        },
        messages:{
           user_name : 
           {
            required: "Please enter your full name."
           },
           email: 
           {
            required: "Please enter email address.",
            email: "Please enter valid email address."
           },
           content:
           {
             required: "Please enter message content."
           }
          },
       submitHandler: function(){
		j('#btn_submit').attr('disabled', 'disabled');
                form.submit();
         }
     }); 
     
    /* Add user comment over posted blog form validation */ 
     
     
     j("#post-comment-frm").validate({
         errorElement:"div",
        rules: {
           full_name : 
           {
            required: true
           },
           email: 
           {
            required: true,
            email:true
           },
           url:
           {
             required: true,
             complete_url: true
           },
           message:
           {
             required: true
           }
        },
        messages:{
           full_name : 
           {
            required: "Please enter your full name."
           },
           email: 
           {
            required: "Please enter email address.",
            email: "Please enter valid email address."
           },
           url:
           {
             required: "Please enter url.",
             complete_url: "Please enter valid url."
           },
           message:
           {
             required: "Please enter message content."
           }
          },
       submitHandler: function(){
		j('#btn_submit').attr('disabled', 'disabled');
                form.submit();
         }
     }); 
    
    
    
    /* Add user registration form validation */

    j("#frm_user_details").validate({
        errorElement: "div",
        rules: {
            
            
            user_name:
                    {
                        required: true,
                        lettersonly: true,
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
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: j('#base_url').val() + "chk-email-duplicate",
                    method: 'post'
                }
            },
            confirm_email:
                    {
                        required: true,
                        email: true,
                        equalTo: "#user_email"
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
                    
        },
        messages: {

            user_name:
                    {
                        required: "Please enter user name.",
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
            pin_code:
                    {
                        required: "Please enter pin code.",
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
            confirm_email:
                    {
                        required: "Please enter your contact confirm email.",
                        email: "Please enter valid email address.",
                        equalTo: "These contact email don't match. Try again.",
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
            submitHandler: function() {
                j('#regi_step1_btn').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });





   /* Add user  B registration  form validation */

    j("#frm_userB_details").validate({
        
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
            country_id:
                    {
                        required: true,
                       
                    },
            state_id:
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
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: j('#base_url').val() + "chk-email-duplicate",
                    method: 'post'
                }
            },
            Type_of_institution:
                    {
                        required: true,
                       
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
             Established: 
                     {
                required: true,
                number: true,
                exactlength:"4"
            },        
            Name_of_founder:
                    {
                        required: true
                       // lettersonly: true,
                    },  
                     user_name: {
                required: true,
                 lettersonly: true,
                remote: {
                    url: j("#base_url").val() + "backend/admin/check-admin-username",
                    type: "post"
                }
            },
//                     user_name:
//                    {
//                        required: true,
//                        lettersonly: true,
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
            country_id:
                    {
                        required: "Please select country.",
                    },   
            state_id:
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
            Type_of_institution:
                    {
                        required: "Please select type of institution.",
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
             Established: {
                required: "Please enter year of established in.",
                number: "Please enter valid year of established in.",
                exactlength :"Please enter 4 digit year of established in."
            },      
            Name_of_founder:
                    {
                        required: "Please enter valid name.",
                    },   
                    user_name: {
                required: "Please enter username.",
                remote: "Username already exists."
            },
//            user_name:
//                    {
//                        required: "Please enter user name.",
//                    },        
            submitHandler: function() {
                j('#regi_step2_btn').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });
    
    
    
    /**********login validation*********/
    j("#signin_frm").validate({
         errorElement:"div",
        rules: {
           
          user_email: {
                required: true
                //email: true,
//                remote: {
//                    url: j('#base_url').val() + "chk-email-duplicate",
//                    method: 'post'
//                }
            },
            user_password:
                    {
                        required: true,
                        minlength: 5
                        /* password_strenth:true */
                    }
        },
        messages:{
           user_email:
                    {
                        required: "Please enter your email.",
     //                   email: "Please enter valid email address.",
//                        remote: "This email address is already registered with site."
                    },
            user_password:
                    {
                        required: "Please enter your password.",
                        minlength: "Please enter atleast 5 character." 
                    }
          },
       submitHandler: function(){
		j('#btn_submit').attr('disabled', 'disabled');
                form.submit();
         }
     });
     
     
     
     /* edit user  B registration  form validation */

    j("#edit_userB_details").validate({
        
        errorElement: "div",
        rules: {
                        
            Name_of_institute:
                    {
                        required: true,
                        lettersonly: true,
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
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: jQuery('#base_url').val() + 'chk-edit-email-duplicate',
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
            Name_of_founder:
                    {
                        required: true,
                        lettersonly: true,
                    },     
                     user_name:
                    {
                        required: true,
                        lettersonly: true,
                    },
                    
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
                   
            Name_of_founder:
                    {
                        required: "Please enter valid name.",
                    },   
            user_name:
                    {
                        required: "Please enter user name.",
                    },        
            submitHandler: function() {
                j('#regi_step2_btn').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });
    
    
    /***************user A edit profile validation*****************/
     /* Add user registration form validation */

    j("#edit_userA_details").validate({ 
        errorElement: "div",
        rules: {
            
            
            user_name:
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
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: jQuery('#base_url').val() + 'chk-edit-email-duplicate',
                    type: 'post',
                    data: {
                        type: "post",
                        old_user_email: j("#old_user_email").val()
                    }
                }
            },

        },
        messages: {

            user_name:
                    {
                        required: "Please enter user name.",
                    },
            pin_code:
                    {
                        required: "Please enter pin code.",
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

            submitHandler: function() {
                j('#regi_step1_btn').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });
    
    
    
  

  /* [Start]  Forgot password validation */
    j("#frm_forgot_password").validate(
            {
                
                rules: {
                    user_email:
                            {
                                required: true,
                                email: true,
                                    remote: {
                    url: j('#base_url').val() + 'forgot-password-email-exist',
                    type: 'post'
                }
                                
                            },

                },
                messages:
                        {
                            user_email:
                                    {
                                        required: "Enter email address.",
                                        email: "Invalid email address.",
                                        remote: "This email is not registered."
                                    },

                        },
                        
                 submitHandler: function() {
                j('#bnt_submit').attr('disabled', 'disabled');
                form.submit();
            }       
            });
    /* [End]  forgot password validation */

    
 
 
 /* reset password form validation */

    j("#reset_new_password").validate({
        errorElement: "div",
        rules: {
            
           
           
            user_password:
                    {
                        required: true,
                        minlength: 8
                        /* password_strenth:true */
                    },
            cnf_user_password:
                    {
                        required: true,
                        equalTo: "#user_password"},
                    
        },
        messages: {

           
            user_password:
                    {
                        required: "Please enter your password.",
                        minlength: "Please enter atleast 8 character." 
                    },
            cnf_user_password:
                    {
                        required: "Please enter your confirm password.",
                        equalTo: "These passwords don't match. Try again.",
                    },
            submitHandler: function() {
                j('#btn_pass').attr('disabled', 'disabled');
                form.submit();
            }

        },
    });
    
    
    /*********contact form validation******/
    
     j("#contact_us_frm").validate({
        errorElement: "div",
        rules: {
            user_name:
                    {
                        required: true
                    },
            email:
                    {
                        required: true,
                        email: true
                    },
            content:
                    {
                        required: true
                    }
        },
        messages: {
            user_name:
                    {
                        required: "Please enter your full name."
                    },
            email:
                    {
                        required: "Please enter email address.",
                        email: "Please enter valid email address."
                    },
            content:
                    {
                        required: "Please enter message content."
                    }
        },
        submitHandler: function() {
            j('#btn_submit').attr('disabled', 'disabled');
            form.submit();
        }
    });
    
    
    
    
  j("#home").click(function(){
      console.log("dsxe");
    j("#del").hide();
  });
  j("#profile").click(function(){
    j("#del").show();
  });

    
    
    
    
});




