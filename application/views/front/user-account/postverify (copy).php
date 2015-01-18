 <script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.form.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/colorbox.css" />
<script type="text/javascript"  src="<?php echo base_url(); ?>media/front/js/comman.js" ></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.colorbox.js"></script> 
<script type="text/javascript" >
 var increment=1;
    var address=2;
	  $("#add_topic").click(function(){
	  	$("#no_topic_found").hide();
	  	$("#add-topic-form").show();
	  });
  $("#addButton").click(function(){
		
	  /*if(increment > 5)
	  {
		alert(increment);
		return false;
	  }*/
	  // first memthod...we can write div element
		var maincontent="<h1>Address details "+address+" <h1><div class='form-group'><label for='user_name' class='col-lg-2 control-label'> Registered Company Name:</label><div class='col-lg-10'><input type='text' name='company_name' id='company_name' value=''></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Street</label><div class='col-lg-10'><input type='text' name='company_street["+increment+"]' id='company_street_"+increment+"' value=''></div><div class='col-lg-10'></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>City</label><div class='col-lg-10'><input type='text' name='company_city["+increment+"]' id='company_city_"+increment+"' value=''></div><div class='col-lg-10'></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Province/State/Country</label><div class='col-lg-10'><input type='text' name='company_state["+increment+"]' id='company_state_"+increment+"' value=''></div><div class='col-lg-10'></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Zip Code</label><div class='col-lg-10'><input type='text' name='postal_code["+increment+"]' id='postal_code_"+increment+"' value=''></div><div class='col-lg-10'></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Company Telephone number:</label><div class='col-lg-10'><input type='text' name='telephone_number["+increment+"]' id='telephone_number_"+increment+"' value=''></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Name of Authorised Representative:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' name='ar_fname["+increment+"]' id='ar_fname_"+increment+"' value=''><input type='text' class='form-control' name='ar_lname["+increment+"]' id='ar_lname_"+increment+"' value=''></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Email of Authorised Representative:<sup class='mandatory'>*</sup></label><div class='col-lg-10'><input type='text' class='form-control' name='ar_email["+increment+"]' id='ar_email_"+increment+"' value=''></div></div><div class='form-group'><label for='user_name' class='col-lg-2 control-label'>Phone of Authorised Representative:</label><div class='col-lg-10'><input type='text' name='phone_number["+increment+"]' id='phone_number_"+increment+"' value=''></div></div><a class='delete_records' onclick='disp("+increment+")' href='javascript:void(0)' ><img src='<?php echo base_url()?>front-media/images/small-close.png' title='Remove' alt='Remove' ></a></div>";
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

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user-profile/user_dashboard.js"></script>
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
                    <form id="frm_user_registration" name="frm_user_registration" method="post" action="<?php echo base_url(); ?>post-verification-action" class="bs-example form-horizontal">

                        <fieldset>
                            <legend>Verification</legend>
                            <div class="help-block text-center">Enter your details below</div>
                            <div class="form-group">
                                <label for="first_name" class="col-lg-2 control-label">First name:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="first_name" name="first_name"  value="<?php if($user_details) { if($user_details[0]['first_name']) echo $user_details[0]['first_name'];  }else { echo ''; } ?>">                                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-lg-2 control-label">Last name:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="last_name" id="last_name" value="<?php if($user_details) { if($user_details[0]['last_name']) echo $user_details[0]['last_name'];  }else { echo ''; } ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-lg-2 control-label">Job Title:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="job_title" id="job_title" value="">
                                </div>
                            </div>
                            
																									<div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">VAT Identification Number:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="vat_number" id="vat_number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Region number:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="region_number" id="region_number" value="">
                                </div>
                            </div>
                            <?php if($user_arr_company) { $cname = $user_arr_company[0]['company_name']; }else{ $cname = ''; } ?>
                             <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label"> Registered Company Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="company_name" id="company_name_0" value="<?php echo $cname; ?>">
                                </div>
                            </div>
                            <h1>Registered Company Address :</h1>
                              <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Street</label>
                                 <div class="col-lg-10">
                                    <input type="text" name="company_street" id="company_street_0" value="">
                                </div>
                                <div class="col-lg-10">
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">City</label>
                                 <div class="col-lg-10">
                                    <input type="text" name="company_city" id="company_city_0" value="">
                                </div>
                                <div class="col-lg-10">
                                  
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Province/State/Country</label>
                                 <div class="col-lg-10">
                                    <input type="text" name="company_state" id="company_state_0" value="">
                                </div>
                                <div class="col-lg-10">
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Zip Code</label>
                                 <div class="col-lg-10">
                                    <input type="text" name="postal_code" id="postal_code_0" value="">
                                </div>
                                <div class="col-lg-10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Company Telephone number:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="telephone_number" id="telephone_number_0" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Name of Authorised Representative:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="ar_fname" id="ar_fname_0" value="">
                                    <input type="text" class="form-control" name="ar_lname" id="ar_lname_0" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Email of Authorised Representative:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="ar_email" id="ar_email_0" value="">
                                </div>
                            </div>
                            
																									<div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Credit card number:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="card_number" id="card_number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">CSV Number:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="csv_number" id="csv_number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Card Type:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="radio"  name="card_type" checked="checked" id="card_type" value="d"> Debit
                                    <input type="radio" name="card_type"  id="card_type" value="c"> Credit
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">card_company:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="card_company" id="card_company" value="">
                                </div>
                            </div>                            
                            
                            
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Phone of Authorised Representative:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone_number" id="phone_number_0" value="">
                                </div>
                            </div>
                            
                          <!--    <div class="form-group">
                      <a style="float:right;" href="javascript:void(0)" id="addButton" ><input type="button" name="test" value="Add another Address "></a>
                     </div>
                   -->
                   								<div class="hr_row" id="TextBoxesGroup"></div>			
                            <h1 id="more_info" >+More information</h1>
                            <div class="form-group" style="display:none" id="display_more">
                                <label for="user_name" class="col-lg-2 control-label">More Information:</label>
                                <div class="col-lg-10">
                                   <textarea id="more_information" name="more_information" ></textarea>
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
                        </fieldset>
                    </form>
                    <!-- <div class="btn_fld"> 
                                <input type="file" id="article_pic" name="article_pic"  accept='image/*'>
                                <a href="" id="anch" class="button">Upload photo</a>
                            </div> -->
                     
                </div>
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
<script type="text/javascript" >

</script>