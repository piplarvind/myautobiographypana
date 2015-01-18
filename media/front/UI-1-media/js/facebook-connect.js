function connectMe(path)
{
    FB.login(function(response) {
        if (response.authResponse) {
            jQuery("#btn_fb_connect").hide();
            jQuery("#btn_login").hide();
            jQuery("#btn_loader").show();
            jQuery("#btn_loader_register").show();
            FB.api('/me', function(response) {
                
                if (response.error)
                {
                    
                    alert("The facebook session is invalid because the user logged out, please try again.");
                    /*jQuery("#connectFb").click(); */
                }
                else
                {
                    if (typeof response['email'] == 'undefined')
                    {
                      
                        alert("Your email address is not verified by facebook. Please check your facebook account to verify your email address.");
                    }
                    else
                    {
                        var params = "first_name=" + response.first_name + "&last_name=" + response.last_name + "&user_name=" + response.username + "&user_email=" + response.email + "&fb_id=" + response.id + "&action=facebook_connect";
                        jQuery.ajax({
                            type: 'post',
                            url: path + 'fb-signup',
                            data: params,
                            success: function(msg) {  
                                
                                console.log(msg);
                                if(msg == 'new_user'){
                                     jQuery("#user_type_id").show();
                                }
                                if(msg == 'Blocked' || msg == 'Inactive')
                                {
                                    window.parent.location = path + "signin";
                                }
                                if(msg)
                                {
                                    window.parent.location = path + "institute/user-profile";
                                }
                               
                            }
                        });
                    }
                }
            });
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {"scope": "email,read_stream,publish_stream"});
}