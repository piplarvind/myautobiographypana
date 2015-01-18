 <script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.form.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/colorbox.css" />
<script type="text/javascript"  src="<?php echo base_url(); ?>media/front/js/comman.js" ></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.colorbox.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user-profile/user_dashboard.js"></script>
<script src="<?php echo base_url();?>media/front/js/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript" >
$(document).ready(function(e) {
	increment = 2;
 $("#addButton").click(function(){
	
	  /*if(increment > 5)
	  {
		alert(increment);
		return false;
	  }*/
	  // first memthod...we can write div element
		var maincontent="<div class='form-group'><label for='product_name' class='col-lg-2 control-label'>Product name:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' id='product_name' name='product_name'  value=''></div></div><div class='form-group'><label for='last_name' class='col-lg-2 control-label'>Product Description:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' name='product_description' id='product_description' value='' ></div></div><div class='form-group'><label for='user_email' class='col-lg-2 control-label'>Product Quantity:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' name='product_quantity' id='product_quantity' value=''></div></div><div class='form-group'><label for='user_email' class='col-lg-2 control-label'>Product Quantity unit:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' name='product_quantity_unit' id='product_quantity_unit' value=''></div></div><a class='delete_records' onclick='disp("+increment+")' href='javascript:void(0)' ><img src='<?php echo base_url()?>front-media/images/small-close.png' title='Remove' alt='Remove' ></a></div>";
		var fun="<div id='TextBoxDiv"+increment+"'><div class='request_one'>"+maincontent+"</div></div>";
		$("#TextBoxesGroup").append(fun);

	increment++;
	address++;
  });
  $("#removeButton").click(function () {
		    if(increment==1){
		        jAlert("No more textbox to remove");
		        return false;
		    }   
	        increment--;
			
	        $("#TextBoxDiv" + increment).remove();
		});
		
		$("#getButtonValue").click(function () {
		
			var msg = '';
			for(i=1; i<increment; i++){
				msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
			}
		   //	alert(msg);
		}); 
	
	
$('#file_upload').uploadify({
		'swf'      : '<?php echo base_url();?>media/front/js/uploadify.swf',
		'uploader' : '<?php echo base_url();?>media/uploadify.php',
		formData : { '<?php echo session_name();?>' : '<?php echo session_id();?>' },
		'fileTypeDesc' : 'Image Files',
        'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
		'onUploadSuccess' : function(file, data, response) {
			console.log(response);
			var imgDiv=document.createElement("DIV");
			var imgEle=document.createElement("IMG");
			jQuery(imgDiv).append(imgEle);
			jQuery(imgEle).addClass("span11");
			jQuery(imgEle).addClass("img-responsive");
			jQuery(imgEle).attr("src",data);

			jQuery("#productImages").append(imgDiv);
			jQuery(imgDiv).addClass("span4");
			jQuery(imgDiv).addClass("img-thumb");
			var objRemoveButton=document.createElement("img");
			
			jQuery(objRemoveButton).attr("src","<?php echo base_url();?>admin-media/img/uploadify-cancel.png");
			
			var arrFileName=data.split("/");
			
			
			jQuery(objRemoveButton).attr("data-href",arrFileName[arrFileName.length-1]);
			
			jQuery(objRemoveButton).attr("data-confirm","0");
			jQuery(imgDiv).append(objRemoveButton);
			jQuery(objRemoveButton).addClass("btnRemovePicture");
			bindImgRemove();
        } 
		// Put your options here
	});
bindImgRemove();
});

function bindImgRemove()
{
	jQuery(".btnRemovePicture").bind("click",function(e){
			var is_remove_image="yes";
			if(jQuery(e.currentTarget).attr("data-confirm")=="1")
			{
				if(!confirm("Are you sure to delete this image?"))
				{
					return;
				}
				is_remove_image="no";
			}
			jQuery(e.currentTarget).parent().remove();
		jQuery.post("<?php echo base_url(); ?>products/remove-product-image.php",{img:(jQuery(e.currentTarget).attr("data-href")),"delete_image":is_remove_image},function(){
		
			});
		
	});
}
</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons">User Verification</h1>
                </div>
            </div>
        </div>
    </div>        
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <form id="frm_buying_req" name="frm_buying_req" method="post" action="<?php echo base_url(); ?>post-buying-request" class="bs-example form-horizontal">

                        <fieldset>
                            <legend>Post Inquiry</legend>
                            <div class="help-block text-center">Enter your details below</div>
                            <div class="form-group">
                                <label for="first_name" class="col-lg-2 control-label">Product name:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="product_name_1" name="product_name[]"  value="">                                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-lg-2 control-label">Product Description:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="product_description[]" id="product_description_1" value="" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-lg-2 control-label">Product Quantity:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="product_quantity[]" id="product_quantity_1" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-lg-2 control-label">Product Quantity unit:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="product_quantity_unit[]" id="product_quantity_unit_1" value="">
                                </div>
                            </div>
																									<div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Expired On:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="expiry_on" id="expiry_on" value="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="terms" class="col-lg-2 control-label">&nbsp;</label>
                                <div class="col-lg-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" class="form-control" name="terms" id="terms" >
                                            I agree to the </label><a class="btn-link ajax" href="<?php echo base_url(); ?>cms/terms">Terms and conditions</a>
                                        <br><label class="text-danger" generated="true" for="terms"></label>

                                    </div>
                                </div>
                            </div>  
                                       
                                            
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" name="btn_verify" value="verify" id="btn_verify" class="btn btn-success">Verify</button> 
                                    <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                    <div style="float: right;">
                                        <div id="fb-root"></div>
                                        <a href="javascript:void(0);" id="btn_fb_connect" onClick="connectMe('<?php echo base_url(); ?>')"><img src="<?php echo base_url(); ?>media/front/img/fb_connect.png" border="0"></a>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                      <a style="float:right;" href="javascript:void(0)" id="addButton" ><input type="button" name="test" value="Add another Address "></a>
                     </div>
                   
                   								<div class="hr_row" id="TextBoxesGroup"></div>		
                   								
                        </fieldset>
                    </form>
                    <!-- <div class="btn_fld"> 
                                <input type="file" id="article_pic" name="article_pic"  accept='image/*'>
                                <a href="" id="anch" class="button">Upload photo</a>
                            </div> -->
                     
                </div>
                 <legend>Product Images</legend>
                <div class="span12">
                <input type="file" name="file" id="file_upload">
                </div>
                <span class="clearfix"></span>
                <div class="span12" id="productImages">
               
            </div>
    </section>
    <br>
</div>
<style type="text/css">
    #article_pic
    {
        opacity:0;
        filter:alpha(opacity=0);
        -moz-opacity:0;
        -khtml-opacity: 0;
        position: absolute;
        left:0px;
        z-index: 20;
        cursor: pointer;
    }
</style>
