// Forgot Password validation file 
var J = jQuery.noConflict();
J(document).ready(function(e) {
    J("#frm_admin_forgot_password").validate({
        errorElement: "div",
        rules: {
            user_email: {
                required: true,
                email: true,
                remote: {
                    url: jQuery("#base_url").val() + "backend/forgot-password-email",
                    type: "post"
                }
            }
        }, //end rules
        messages: {
            user_email: {
                required: "Please enter email address.",
                email: "Please enter a valid email address.",
                remote: "This email is not registered with us."
            }
        } //end messages
    }); //end validate
}); //end document ready
