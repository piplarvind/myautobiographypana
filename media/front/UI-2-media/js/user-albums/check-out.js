/* Start Checkout Form */

jQuery(document).ready(function(e) {
    jQuery("#frm-checkout").validate({
        debug: true,
        errorClass: 'text-danger',
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            addr: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            count: {
                required: true
            },
            postcode: {
                required: true
            },
            contact: {
                required: true,
                digits: true
            }
        },
        messages: {
            fname: {
                required: "Please enter first name."
            },
            lname: {
                required: "Please enter last name."
            },
            addr: {
                required: "Please enter address."
            },
            city: {
                required: "Please enter city."
            },
            state: {
                required: "Please enter state."
            },
            count: {
                required: "Please enter country."
            },
            postcode: {
                required: "Please enter postcode."
            },
            contact: {
                required: "Please enter contact number.",
                digits: "Please enter valid contact number"
            }
        }, submitHandler: function(form) {
            jQuery("#btn-submit").hide();
            jQuery("#btn_loader").show();
            form.submit();
        }
    });
});

/* End Checkout Form */


function funUpdateUserDetails()
{

    jQuery.ajax({
        type: 'POST',
        data: {addr: jQuery('#addr').val(), city: jQuery('#city').val(), state: jQuery('#state').val(), country: jQuery('#count').val(), post: jQuery('#postcode').val(), num: jQuery('#contact').val(), fname: jQuery('#fname').val(), lname: jQuery('#lname').val(), phone: jQuery('#contact').val()},
        url: jQuery('#base_url').val() + 'update-address',
        success: function(msg) {
            return;
        }
    });

}



/* Start - Shipping Address Same */

jQuery('input[name=same]').click(function() {

    if (jQuery("input[name=same]:checked").is(':checked')) {
        jQuery("#addr").val(jQuery("#paddr").html());
        jQuery("#city").val(jQuery("#pcity").html());
        jQuery("#state").val(jQuery("#pstate").html());
        jQuery("#count").val(jQuery("#pcountr").html());
        jQuery("#postcode").val(jQuery("#ppost").html());
        jQuery("#contact").val(jQuery("#pcontc").html());
    }
    else
    {
        jQuery("#addr").val('');
        jQuery("#city").val('');
        jQuery("#state").val('');
        jQuery("#count").val('');
        jQuery("#postcode").val('');
        jQuery("#contact").val('');
    }
});

/* End - Shipping Address Same */