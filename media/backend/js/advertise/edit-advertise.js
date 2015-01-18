var j = jQuery.noConflict();
j(document).ready(function () {
    j("#frm_advertise").validate({
        errorElement: 'div',
        errorClass: 'validationError',
        rules: {
            input_title: {
                required: true,
                minlength: 3
            },
            select_category: {required: true},
            input_image: {accept: "jpg|jpeg|png|ico|bmp|gif"},
            textarea_script: {required: true},
            input_redirect_url: {required: true, url: true},
            input_start_date: {required: true},
            input_end_date: {required: true},
            size: {required: true},
            input_advertise_position: {required: true},
        },
        messages: {
            input_title: {
                required: "Please enter title of advertise",
                minlength: "Please enter at least 3 characters"
            },
            select_category: {required: "Please select category"},
            textarea_script: {required: "Please enter script."},
            input_redirect_url: {required: "Please enter redirect URL."},
            input_start_date: {required: "Please select start date"},
            input_end_date: {required: "Please select end date"},
            size: {required: "Please select size"},
            input_advertise_position: {required: "Please select position"},
            input_image: {
                accept: "Please select image with extention 'jpg|jpeg|png|ico|bmp|gif'"
            }
        },
        // set this class to error-labels to indicate valid fields
        success: function (label) {
            // set &nbsp; as text for IE
            label.hide();
        },
        submitHandler: function (form) {
            var var_bool = false;

            j(".page_class").each(function (index, element) {
                if (j(element).is(":checked"))
                    var_bool = true;
            });


            if (var_bool == true) {
                j('form').find(":submit").attr("disabled", true).attr("value", "Submitting...");
                form.submit();
            } else {
                alert("Please select at least one page.");
            }
        }
    });
});