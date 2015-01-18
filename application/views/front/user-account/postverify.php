<script src="<?php echo base_url(); ?>media/front/js/jquery.validate_img.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.form.js"></script>
<script src="<?php echo base_url();?>media/front/js/comman.js"></script>
<section>
<div class="page_holder">	
    <div class="page_inner ">
     <?php 
        if ($this->session->userdata('already_applied') != '') { ?>
            <div class="alert alert-success">
             <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->userdata('already_applied'); ?>
             </div>
        <?php
          $this->session->unset_userdata('already_applied');   }
        if ($this->session->userdata('already_applied') != '') { ?>
            <div class="alert alert-success">
             <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <?php echo $this->session->userdata('already_applied'); ?>
             </div>
        <?php
          $this->session->unset_userdata('already_applied');   }
        ?>
        <div class="heading mrgn_top">Verification Information </div>
        <div class="verification">
            <div class="vrifi_box">
            	<h2> <i class="fa fa-certificate  fa-lg"></i> &nbsp;&nbsp; Get Verified for free &nbsp;&nbsp;
                 <a href="#"> <i class="fa fa-check-circle  fa-lg grn"></i> </a> </h2>
                 <p>As a Verified Membership,You can get Following Benefits:</p>
                 <ul>
                 	<li><i class="fa fa-dot-circle-o"></i> Increase your product ranking</li>
                    <li><i class="fa fa-dot-circle-o"></i> Gain greater trust</li>
                    <li> <i class="fa fa-dot-circle-o"></i> Access to buying requests customs profile</li>
                    <li> <i class="fa fa-dot-circle-o"></i> Post up to 300 product</li>
                 </ul>
            	<p  class="htf">Please enter the exact same information as you registered with your local government office  <a href="#">  How to fill </a></p>
            </div>
        	
            <div class="verify_div"> 
            	<div class="verify_head">  <i class="fa fa-share-square-o"></i> &nbsp; Personal Information:</div>
            				
            <form enctype="multipart/form-data" id="frm_verify_registration" name="frm_verify_registration" method="post" action="<?php echo base_url(); ?>post-verification-action" class="bs-example form-horizontal">
                <div  class="verify_row">
                	<label> Name </label>
                    <div class="verfy_inpt_otr">
                    	<input type="text" class="form-control widt" id="first_name" name="first_name"  value="<?php if($user_details) { if($user_details[0]['first_name']) echo $user_details[0]['first_name'];  }else { echo ''; } ?>">
                    <input type="text" class="form-control widt" name="last_name" id="last_name" value="<?php if($user_details) { if($user_details[0]['last_name']) echo $user_details[0]['last_name'];  }else { echo ''; } ?>" >
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Job Title </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt_1" name="job_title" id="job_title" value="">
                    	</div>
                </div>
                
                
                 <div  class="verify_row">
                	<label> Email Address: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control widt_1"  name="user_email" id="user_email" value="<?php if($user_details) { if($user_details[0]['user_email']) echo $user_details[0]['user_email'];  }else { echo ''; } ?>">
                    </div>
                </div>
                
                
                 <div  class="verify_row">
                	<label> Name of Authorized Representative: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control widt" name="ar_fname" id="ar_fname_0" value="">
                     <input type="text" class="form-control widt" name="ar_lname" id="ar_lname_0" value="">
                    </div>
                </div>
                
                 <div  class="verify_row">
                	<label> Email of Authorized Representative: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control widt_1" name="ar_email" id="ar_email_0" value="">
                    	</div>
                </div>
                 
                 <div  class="verify_row">
                	<label> Phone No of Authorized Representative: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" name="phone_number" id="phone_number_0" value="">
                   <!--  	<input type="text" class="form-control widt_2" /> 
                        <input type="text" class="form-control widt_2" />
                        <input type="text" class="form-control widt_3" /> -->
                        <div class="sml">Ex:91 080 12345678</div>
                    </div>
                </div>
                
                <div class="verify_head"> <i class="fa fa-share-square-o"></i> &nbsp; Company Information:</div>
                
                 <div  class="verify_row">
                	<label> Vat Identification Number: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt"  name="vat_number" id="vat_number" value="">
                    </div>
                </div>
                
                 <!-- <div  class="verify_row">
                	<label> Company ID Number: </label>
                    <div class="verfy_inpt_otr">
                    	<input type="text" class="form-control widt" /> 
                        
                        <div class="sml">Please at least one of the item above.These ID are only for business verification and will not be shown on the website nor shared with any third party.</div>                   
                    </div>
                </div> -->
                
                <div  class="verify_row">
                	<label> Registered Company Name : </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt_1" name="region_number" id="region_number" value="">
                    </div>
                </div>
                
                <div class="verify_head"> <i class="fa fa-share-square-o"></i> &nbsp; Registered Company Address :</div>
                
                 <div  class="verify_row">
                	<label> Street: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text"  class="form-control widt" name="company_street" id="company_street_0" value="">
                    	</div>
                </div>
                
                <div  class="verify_row">
                	<label> City: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt" name="company_city" id="company_city_0" value="">
                    </div>
                </div>
                
                
                <div  class="verify_row">
                	<label> Province State/Country: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt" name="company_state" id="company_state_0" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Company Telephone number: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt" name="telephone_number" id="telephone_number_0" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label>Name of Authorised Representative: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control widt" name="ar_fname" id="ar_fname_0" value="">
                     <input type="text" class="form-control widt" name="ar_lname" id="ar_lname_0" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Email of Authorised Representative: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control widt" name="ar_email" id="ar_email_0" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Credit card number: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control widt" name="card_number" id="card_number" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> CSV Number: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" maxlength="3" class="form-control widt" name="csv_number" id="csv_number" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Card Type: </label>
                    <div class="verfy_inpt_otr">
                     <input type="radio" class=""  name="card_type" checked="checked" id="card_type" value="d"> Debit
                     <input type="radio" class=""  name="card_type"  id="card_type" value="c"> Credit
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Card Company: </label>
                    <div class="verfy_inpt_otr">
                    <input type="text" class="form-control" name="card_company" id="card_company" value="">
                    </div>
                </div>
                
                <div  class="verify_row">
                	<label> Phone of Authorised Representative: </label>
                    <div class="verfy_inpt_otr">
                     <input type="text" class="form-control" name="phone_number" id="phone_number_0" value="">
                     </div>
                </div>
                
                <div  class="verify_row">
                	<label> Attach files to upload: </label>
                    <div class="verfy_inpt_otr">
                     <input type="file" multiple="" id="docFile" name="docFile[]"  >
                     </div>
                </div>
                
                 <div class="verify_head" > <i class="fa fa-share-square-o"></i> &nbsp; <span id="more_info">Additional Information:</span></div>
                 <div  class="verify_row">
                	   <div class="verfy_inpt_otr" id="display_more" style="display:none;">
                	     <textarea class="form-control" id="more_information" name="more_information" ></textarea>
                     </div>
                </div>
                
                
                
                 <div  class="verify_row chevery">
                	<label> &nbsp; </label>
                    <div class="verfy_inpt_otr">
                     <input type="checkbox" class="" name="terms" id="terms" >  I Confirm that  
                     <p> <i class="fa fa-caret-right"></i>  The information provided above is true and accurate.</p>
                     <p>  <i class="fa fa-caret-right"></i> I am authorized to represent my company to submit the above information for verification.</p>                
                    </div>
                </div>
                
                
                 <div  class="verify_row">
                	<label> &nbsp; </label>
                    <div class="verfy_inpt_otr">
                     <button type="submit" name="btn_verify" value="verify" id="btn_verify" class="button">Verify</button>
                    </div>
 														</form>
 														
 														<!-- <div class="verify_row">
            				 <form method="POST" id="uploadForm" name="uploadForm" enctype="multipart/form-data" action="<?php echo base_url() ?>user_photo_upload">                    
                    <div class="form-group">
                    	<label> Attach your files: </label>
                        <div class="col-lg-10 col-lg-offset-2">
                            <input type="file" multiple="" id="docFile" name="docFile[]" accept='image/pdf' >
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        </div>
                    </div>
                    <div class="album-photos">
                    </div>
                </form> 
            				</div> -->
                </div>
                
            </div>
           
		</div>
    </div>
       
</section>

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
<script type="text/javascript" >

</script>