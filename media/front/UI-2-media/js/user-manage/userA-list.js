var j = jQuery.noConflict();
j(document).ready(function (e) {
    j("#upload_user").validate({
        errorElement: "div",
        rules: {
            file_source:
                    {
                        required: true,
                        accept: 'xls'
                    }
        },
        messages: {
            file_source:
                    {
                        required: "Please select any xls file to upload.",
                        accept: 'Only xls file fomrats are allowed.'
                    }
        },
    });
});