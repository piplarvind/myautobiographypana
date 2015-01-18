 /*
  *  START :: Contact Us or enquiry form validation :
  *  By Vaibhav Pathak On 30 Sep 2014 :
  */
 var j = jQuery.noConflict();
    j(document).ready(function() {
        
        /* [START] :: add method for complete url validation: */

   j.validator.addMethod("complete_url", function(val, elem) {
        // if no url, don't do anything
        if (val.length == 0) {
            return true;
        }

        // if user has not entered http:// https:// or ftp:// assume they mean http://
        if (!/^(https?|ftp):\/\//i.test(val)) {
            val = 'http://' + val; // set both the value
            $(elem).val(val); // also update the form element
        }
        // now check if valid url
        // http://docs.jquery.com/Plugins/Validation/Methods/url
        // contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
        return /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
    });
    
    j.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Please enter letters only ");

    j.validator.addMethod("numberonly", function(value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Please enter number only ");
    
    j.validator.addMethod("phonenumber", function(value, element) {
        return this.optional(element) || /^\+?[6]{1}?[0-9]{10}$/i.test(value);
                }, "Please enter valid contact number.");
                
     j.validator.addMethod("exactlength", function(value, element, param) {
 return this.optional(element) || value.length == param;
}, j.format("Please enter exactly {0} characters."));            
    
        
    
 
    j(document).ready(function() {
    j('#select_all_news').click(function(event) {  //on click 
        if(!this.checked) { // check select status
            j('.select-news').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            j('.select-news').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});

   

j(document).ready(function() {
        j("#my_news_frm").validate({
        errorElement: "div",
        rules: {
            
            "post_visibility_news[]":
                    {
                        required: true,
                      minlength :1
                    }
            
        },
        messages: {

           "post_visibility_news[]":
                    {
                        required: "Please check news.",
                 minlength :"Please check at least 1 news."
                    }
        }
    });
    
    });



    
    
    
});




