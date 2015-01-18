

var j = jQuery.noConflict();

j(document).ready(function () {
    j("#frm_add_interest").validate({
        errorElement: 'div',
        rules: {
            interest_name: {
                required: true,
                remote:{
                    url: j("#base_url").val()+"backend/interest/check-interest-name",
                    type: "post"
                    }
            },
            interest_status: {
                required: true
            }
        },
        messages: {
            interest_name:
                    {
                        required: "Please enter interest name.",
                        remote :"Interest name is already exist with site."
                    },
            interest_status:
                    {
                        required: "Please select status."
                    }
        }
    });
});