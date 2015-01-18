 var j = jQuery.noConflict();
j(document).ready(function () {
    j("#frm_add_institute_type").validate({
        errorElement: 'div',
         errorClass: 'validationError',
        rules: {
            institute_type: {
                required: true,
                remote: {
                    url: j("#base_url").val() + "backend/institute-type/check-institute-type",
                    type: "post"
                }
            },
            institute_type_status: {
                required: true
            }
        },
        messages: {
            institute_type:
                    {
                        required: "Please enter institute type.",
                        remote: "Institute type is already exist with site."
                    },
            institute_type_status:
                    {
                        required: "Please select status."
                    }
        }
    });
});