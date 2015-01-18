 
var j = jQuery.noConflict();
j(document).ready(function () {
    j("#frm_edit_institute_type").validate({
        errorElement: 'div',
         errorClass: 'validationError',
        rules: {
            institute_type: {
                required: true,
                remote: {
                    url: j("#base_url").val() + "backend/institute-type/check-institute-type",
                    type: "post",
                    data: {
                        type: "edit",
                        old_institute_type: j('#old_institute_type').val()
                    }
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