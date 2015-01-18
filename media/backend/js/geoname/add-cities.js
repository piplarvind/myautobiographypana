 var j = jQuery.noConflict();
j(document).ready(function () {
    j("#frm_add_cities").validate({
        errorElement: 'div',
        errorClass: 'validationError',
        rules: {
            country_id: {
                required: true
            },
            state_id: {
                required: true
            },
            city_name: {
                required: true,
                lettersonly: true,
                remote: {
                    url: j("#base_url").val() + "backend/geoname/check-city-name",
                    type: "post"
                }
            },
            city_status: {
                required: true
            }
        },
        messages: {
            country_id: {
                required: "Please select country."
            },
            state_id: {
                required: "Please select state."
            },
            city_name: {
                required: "Please enter city name.",
                remote: "This city name already exist with site."
            },
            city_status: {
                required: "Please select status."
            }
        }
    });

    j.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Please enter alphabetical characters only");

});