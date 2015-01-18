<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/comman.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/user-profile/user-address.js"></script>
<section>
<div class="page_holder">	
    <div class="page_inner ">
        <div class="heading mrgn_top">My Profile </div>
        <div class="login_main dashboard">
        	<?php echo $this->load->view('front/includes/left-panel'); ?>               
                        <div class="right_panal">
                        	<div class="my_prof_otr my_prof_shown">
                                <div class="my_prof_inner" id="">
                                <form id="imageform" method="POST" enctype="multipart/form-data" action='<?php echo base_url() ?>ajax-upload'>              
            																	<div class="prof_pic" id="user_pic">
               																<?php
                        												if (is_null($arr_user_data['profile_picture']) || $arr_user_data['profile_picture'] == '') {
                            												$profile_img_path = base_url() . 'media/front/img/testi.png';
                        											 } else {
                            												$profile_img_path = base_url() . 'media/front/img/users/130x160/' . $arr_user_data['profile_picture'];
                        												} ?>  
               															<img title="User" alt="User" src="<?php echo $profile_img_path; ?>">
           																			</div>           
          																					</form>
          																					   
                                    <div class="right_panal_inner edtprof">
                                     <form id="frm_edit_address" name="frm_edit_address" method="post" action="<?php echo base_url(); ?>add-address" enctype="multipart/form-data">
                                       	<!-- <div class="input_fld_otr">
                                            <label><?php echo $lang['REGISTRATION_PAGE_FIRST_NAME_LABEL'];  ?> :</label>
                                           <div class="span"><input type="text" class="form-control"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['REGISTRATION_PAGE_LAST_NAME_LABEL'];  ?> :</label>
                                        <div class="span"><input type="text" class="form-control"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['REGISTRATION_PAGE_USER_NAME_LABEL'];  ?>:</label>
                                            <div class="span"><input type="text" class="form-control"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['REGISTRATION_PAGE_EMAIL_ADDRESS_LABEL'];  ?>:</label>
                                           <div class="span"><input type="text" class="form-control"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_CONTACT_NUMBER'];  ?> :</label>
                                            <div class="span"><input type="text" class="form-control"></div>
                                        </div> -->
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_STREET_ADDRESS'];  ?>:</label>
                                           <div class="span">
                                            <textarea class="form-control" name="user_street_addr" id="user_street_addr" cols="55" rows="3" ><?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_street_addr']!="" ? stripcslashes($arr_address_data['user_street_addr']) : ""; }else { echo '';} ?></textarea>
                                              </div></div>
                                        
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_CITY_ADDRESS'];  ?> :</label>
                                           <div class="span"> <input class="form-control" type="text" name="user_city" id="user_city" value="<?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_city']!='' ? stripcslashes($arr_address_data['user_city']) : ""; }else { echo '';} ?>"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_STATE_ADDRESS'];  ?> :</label>
                                           <div class="span" id="STATE_ID"> 
 																																							<select name="state" id="state" class="form-control">
                                   										<option value="">Select</option>
                                 														<?php foreach($states as $state)	  { ?>
                                  														<option value="<?php echo $state['state_id'] ?>" <?php if($state['state_id']==$arr_address_data['user_state']) { ?> selected='selected' <?php  } ?>  ><?php echo $state['state_name'] ?></option>
                                   													<?php  } ?>
                                   									</select>                                           
                                       					</div>
                                        			</div>
                                        
                                        				<div class="input_fld_otr">
                                             <label><?php echo $lang['PROFILE_PAGE_ZIP_CODE_ADDRESS'];  ?> :</label>
                                         					<div class="span"><input type="text" name="user_zip_code" id="user_zip_code" value="<?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_zip_code']!=0 ? stripcslashes($arr_address_data['user_zip_code']) : ""; }else { echo '';} ?>" class="form-control"></div>
                                        				</div>
                                        
                                        				<div class="input_fld_otr">
                                            	<label><?php echo $lang['PROFILE_PAGE_COUNTRY_ADDRESS'];  ?> :</label>
                                           			<div class="span">
                                           				<select  class="form-control" name="user_country" id="user_country" onchange="get_state(this.value)">
                                   												<option value="">Select</option>
                                 															<?php foreach($countries as $country)			{ ?>
                                  														<option value="<?php echo $country['iso'] ?>" <?php if($arr_address_data!='') { if($country['iso']==$arr_address_data['user_country']) { ?> selected='selected' <?php  } } ?>  ><?php echo $country['country'] ?></option>
                                   														<?php } ?>
                                   												</select></div>
                                        						</div>
                                        
                                                 <div class="input_fld_otr">
                                                     <label>&nbsp;</label>
                                                   <div class="span"> <input type="submit" name="btn_edit_address" id="btn_edit_address" value="Update Address" class="button"></div>
																								                        <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                																								        <div class="span"> </span>
                																															<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">  
                																							 									</div>
                                       										</div>
                                          						</form>
                                    							</div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</section>
          
<script type="text/javascript" src="<?php echo base_url();?>media/front/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user-profile/user_dashboard.js"></script>

<style type="text/css">
    #profile_pic
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
    #anch
    {
        position: absolute;     
        left:0px;
        z-index: 10;    
        cursor: pointer;	
	margin: 2px 0 0 162px;	
    }    
</style>

