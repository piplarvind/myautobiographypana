
 /* Start Create Album */
 
 jQuery(document).ready(function(e) {
        jQuery("#frm-new-album").validate({
            debug: true,
            errorClass: 'text-danger',
            rules: {
                album_name: {
                    required: true                    
                }               
            },
            messages: {
                album_name: {
                    required: "Please enter album name."                  
                }                
            }, submitHandler: function(form) {
                jQuery("#btn-create").hide();
                jQuery("#btn_loader").show();
                form.submit();
            }
        });
    });
    
  /* End Create Album */  
  