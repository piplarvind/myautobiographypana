var j = jQuery.noConflict();
j(document).ready(function () {
    j("#frm_add_states").validate({
        errorElement: 'div',
        errorClass: 'validationError',
        rules: {
            country_id: {
                required: true
            },
            state_name: {
                required: true,
                lettersonly: true,
                remote: {
                    url: j("#base_url").val() + "backend/geoname/check-state-name",
                    type: "post"
                }
            },
            state_status: {
                required: true
            }
        },
        messages: {
            country_id: {
                required: "Please select country."
            },
            state_name: {
                required: "Please enter state name.",
                remote: "This state name already exist with site."
            },
            state_status: {
                required: "Please select status."
            }
        }
    });
    j.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please enter alphabetical charaters only");

});

