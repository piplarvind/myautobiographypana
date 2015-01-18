/* Start Add Photos */
  
jQuery('#upFile').change(function() {
       console.log("upFile");							
    jQuery('<img style="margin:0 0 0 450px;" id="load_img" src="' + jQuery('#base_url').val() + 'media/front/img/please-wait.gif" alt="Importing....Please wait.">').prependTo(".my_album_div");        
        
    jQuery("#uploadForm").ajaxForm({
        		        				        			
        success: function(data) {
            
            jQuery('.album-photos').append(data);                            
            jQuery('#load_img').remove(); 
            jQuery('#upFile').val('');
            jQuery('#no_photos').hide();
            
        }		
    }).submit();
});


/* End Add Photos */

/* Start Select All Photos */

jQuery('#select_all').click(function () {    
    jQuery('.select-photo').prop("checked", true);   

});

jQuery('#select_none').click(function () {   
    jQuery('.select-photo').removeAttr("checked");
});


/* For Fb Albums */

jQuery('#select_all_alb').click(function () {    
    jQuery('.album-id').prop("checked", true);   

});

jQuery('#select_none_alb').click(function () {   
    jQuery('.album-id').removeAttr("checked");
});

/* For FB Photos */

jQuery('#select_all_phot').click(function () {    
    jQuery('.photo-id').prop("checked", true);   

});

jQuery('#select_none_phot').click(function () {   
    jQuery('.photo-id').removeAttr("checked");
});

/* End  Select All Photos */

/*Print Photos Clicked */


jQuery(document).ready(function(e) {
        
        var sel_photo_id = jQuery('#sel_photo_id').val();
        var sel_paper_id = jQuery('#sel_paper_id').val();
        var sel_size_id = jQuery('#sel_size_id').val();
        
        
        //var avail_sizes = jQuery('#avail_sizes').val();        
        //var sizes = avail_sizes.split(',');        
        //jQuery('#photo_type').val(sel_photo_id);  
        //jQuery('#photo_type').trigger('change');        
        //alert(sizes);        
        //alert(sel_paper_id);
        //alert(sel_size_id);
        
       //jQuery("#photo_type option[value=" + sel_photo_id + "]").attr('selected', 'selected');

        
     jQuery('#photo_type').change(function(){
         
        var type_id = jQuery('#photo_type').val();
        var quantt = jQuery('#quantity').val();
                                
        jQuery('#photo_size').empty();
        jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
        
        jQuery('#paper_type').empty();
        jQuery('#paper_type').append('<option value="">--Select Paper Type--</option>');
                      
        if(type_id!='')
        {
            jQuery('#photo_id').val(type_id);
        }
        else
        {
            jQuery('#photo_id').val('');
            jQuery('#size_id').val('');
            jQuery('#net-price').html('---');
            jQuery('#unit-price').html('---');
            jQuery('#unit_price').val('');
            jQuery('#total_price').val('');
            jQuery('#cost_id').val('');            
        }
                    
        if (type_id != ""){
            var post_url = jQuery('#base_url').val()+"get_paper_sizes";
            $.ajax({
                type: "POST",
                url: post_url, 
                dataType: "json",            
                data : {
                           type_id:type_id
                },                          
                success: function(data) //we're calling the response json array 'cities'
                {                                                                                                    
                    if(data.paperObj == '')
                    {              						
                        jQuery('#paper_type').empty();
                        jQuery('#paper_type').append('<option value="">--Select Paper Type--</option>'); 
                        jQuery('#paper_id').val('');
                    }
                    else
                    {
                        jQuery('#paper_type').empty();
                        jQuery('#paper_id').val(data.paperObj[0]['paper_type_id']);
                        
                        jQuery('#paper_type').append('<option value="">--Select Paper Type--</option>');
                        jQuery('#paper_id').val('');
                        jQuery('#quantity').val('');
                        
                        jQuery.each(data.paperObj,function(id,name) 
                        {
                            jQuery('#paper_type').append('<option value="' + name.paper_type_id + '">' + name.paper_name + '</option>');                            
                        });
                    }
                    /*if(data.sizeObj == '')
                    {              						
                        jQuery('#photo_size').empty();
                        jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
                        jQuery('#size_id').val('');
                    }
                    else
                    {
                        jQuery('#photo_size').empty();  
                        jQuery('#size_id').val(data.sizeObj[0]['photo_size_id']);
                        
                        jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
                        jQuery('#size_id').val('');
                        jQuery('#quantity').val('');
                        
                        jQuery.each(data.sizeObj,function(id,name)
                        {
                            jQuery('#photo_size').append('<option value="' + name.photo_size_id  + '">' + name.photo_width+"x"+name.photo_height+ ' ('+name.photo_unit+ ')</option>');
                        });
                    }*/
                    /*if(quantt!='')
                    {
                        alert(quantt);
                        jQuery('#quantity').val(quantt)
                    }*/
                    calculatePrice();
                    
                } //end success
            }); //end AJAX
            
            
        } else {
                    jQuery('#paper_type').empty();   
                    jQuery('#photo_size').empty(); 
                    jQuery('#paper_type').append('<option value="">--Select Paper Type--</option>');
                    jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
        } //end if        
    });  //end change 
    
                 
    jQuery('#paper_type,#photo_size,#quant').change(function(){
         
        var quant = jQuery('#quant').val();
        jQuery('#quantity').val(quant)
            
        if(this.name == "paper_type")
        {
            jQuery('#paper_id').val(this.value);
            
            
            var photoId = jQuery('#photo_id').val();
            var paperId = this.value;
            
            var post_url = jQuery('#base_url').val()+"get-avail-paper-sizes";
            
            $.ajax({
                type: "POST",
                url: post_url, 
                dataType: "json",            
                data : {
                           photoId:photoId,paperId:paperId
                },                          
                success: function(data) //we're calling the response json array 'cities'
                {
                    if(data.sizeObj == '')
                    {              						
                        jQuery('#photo_size').empty();
                        jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
                        jQuery('#size_id').val('');
                    }
                    else
                    {
                        jQuery('#photo_size').empty();  
                        jQuery('#size_id').val(data.sizeObj[0]['photo_size_id']);
                        
                        jQuery('#photo_size').append('<option value="">--Select Photo Size--</option>');
                        jQuery('#size_id').val('');
                        jQuery('#quantity').val('');
                        
                        jQuery.each(data.sizeObj,function(id,name)
                        {
                            jQuery('#photo_size').append('<option value="' + name.photo_size_id  + '">' + name.photo_width+"x"+name.photo_height+ ' ('+name.photo_unit+ ')</option>');
                        });
                    }
                }
            });
        }
        else if(this.name == "photo_size")
        {
            jQuery('#size_id').val(this.value);            
        }
        else if(this.name == "quant")
        {
                        
            if(this.value!="")
            {                
                jQuery('#quantity').val(this.value);  
            }
            else
            {                
                jQuery('#quantity').val('');  
                jQuery('#net-price').html('---');                                                   
                jQuery('#total_price').val('');                
            }                     
        }
        
        calculatePrice();                
    });
});


function calculatePrice()
{            
        var photoTypeId = jQuery('#photo_id').val();
        var paperTypeId = jQuery('#paper_id').val();
        var photoSizeId = jQuery('#size_id').val();
                        
        var quant = jQuery('#quant').val();
        jQuery('#quantity').val(quant)
                                                
        jQuery.ajax({
            
                    type: 'POST',
                    url: jQuery('#base_url').val()+'get-printing-cost',
                    data: {photo_type_id:photoTypeId,paper_type_id:paperTypeId,photo_size_id:photoSizeId},
                    success: function(msg){
                        if(msg == 'false')
                        {
                            window.location.href = jQuery('#base_url').val()+'signin';
                        }
                        else
                        {                            
                            if(msg == 'blank') {
                                jQuery('#unit-price').html('---');
                                jQuery('#net-price').html('---');
                                jQuery('#unit_price').val('');
                                jQuery('#total_price').val('');
                                jQuery('#cost_id').val('');
                            }    
                            else { 
                                    msg = msg.split('###'); 
                                    
                                    jQuery('#unit-price').html(msg[1]);
                                    jQuery('#cost_id').val(msg[0]);
                                    
                                    if(quant!='')
                                    {    
                                        var totalPrice = parseFloat(quant)*parseFloat(msg[1]);                                                                            
                                        
                                        jQuery('#net-price').html(totalPrice.toFixed(2));                                    
                                        jQuery('#unit_price').val(parseFloat(msg[1]));
                                        jQuery('#total_price').val(totalPrice.toFixed(2));                                          
                                    }     
                            }     
                        }
                    }
                });      
 }
 
 
 function funValidate()
 {
     var unitPrice = jQuery('#unit_price').val();
     var totalPrice = jQuery('#total_price').val();
     
     if(unitPrice == "" || totalPrice == "" || totalPrice == 'NaN'){         
         alert('Invalid price! Please select appropriate options.')
         return false;
     }
     else{
            jQuery('#btn-print').hide();
            jQuery("#btn_loader").css('float','left');
            jQuery("#btn_loader").show();
            jQuery('#frm-print').submit();
     }
 }



