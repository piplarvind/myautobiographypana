<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user-profile/user_dashboard.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/colorbox.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.colorbox.js"></script>
<script type="text/javascript"  src="<?php echo base_url(); ?>media/front/js/comman.js" ></script>
<section>
<div class="page_holder">	
    <div class="page_inner ">
        <div class="heading mrgn_top">Edit Profile </div>
        <div class="login_main dashboard">
       								 <?php echo $this->load->view('front/includes/left-panel') ?>	
                         <div class="right_panal">
                        	<div class="my_prof_otr my_prof_shown">
                                <div class="my_prof_inner" id="">
                                <form id="imageform" method="POST" enctype="multipart/form-data" action='<?php echo base_url() ?>ajax-upload'>
                                	<div class="prof_pic" >
                                    <?php
                                    			if (is_null($arr_user_data['profile_picture']) || $arr_user_data['profile_picture'] == '') {
                                    							$profile_img_path = base_url() . 'media/front/img/testi.png';
                                							} else {
                                    							$profile_img_path = base_url() . 'media/front/img/users/130x160/' . $arr_user_data['profile_picture'];
                                							} 
                                							?> 
                                        <div class="imgotrd" id="user_pic">
                                							 <img src="<?php echo $profile_img_path; ?>" alt="<?php echo  $arr_user_data['first_name']; ?>" >
                                        </div>
                                							 	<input type="file" id="profile_pic" name="profile_pic" accept='image/*'>
                                									<a href="" id="anch" class="button"><?php echo $lang['PROFILE_PAGE_BROWSE']; ?></a> 
                            									</div>
                                 </div>
                                     </form>
                                
                                <!-- 	<div class="prof_pic" >
                                    <?php
                                    			if (is_null($arr_user_data['profile_picture']) || $arr_user_data['profile_picture'] == '') {
                                    							$profile_img_path = base_url() . 'media/front/img/testi.png';
                                							} else {
                                    							$profile_img_path = base_url() . 'media/front/img/users/130x160/' . $arr_user_data['profile_picture'];
                                							} ?> 
                                        <div class="imgotrd" id="user_pic">
                                							 <img src="<?php echo $profile_img_path; ?>" alt="<?php echo  $arr_user_data['first_name']; ?>" >
                                							 	</div>
                                							 	<input type="file" id="profile_pic" name="profile_pic" accept='image/*'>
                                									<a href="" id="anch" class="button"><?php echo $lang['PROFILE_PAGE_BROWSE']; ?></a> 
                            									   </div>
                            									   </div> -->
                                    <form id="frm_edit_profile" name="frm_edit_profile" method="post" action="<?php echo base_url(); ?>edit-profile" enctype="multipart/form-data">
                                    	<div class="right_panal_inner edtprof">
                                    			<div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_FIRST_NAME']; ?> :</label>
                                           <div class="span"><input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $arr_user_data['first_name']; ?>"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_LAST_NAME']; ?> :</label>
                                        <div class="span"><input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $arr_user_data['last_name']; ?>"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_USER_NAME']; ?>:</label>
                                            <div class="span"><input type="text" name="user_name" id="user_name" value="<?php echo $arr_user_data['user_name']; ?>" class="form-control"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_EMAIL_ADDRESS']; ?> :</label>
                                           <div class="span">
                                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $arr_user_data['user_email']; ?>"  disabled>
                 																								<input type="hidden"  name="user_email_old" id="user_email_old" value="<?php echo $arr_user_data['user_email']; ?>"></div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                																							<label><?php echo $lang['PROFILE_PAGE_CONTACT_NUMBER']; ?> :</label>
                																							<div class="span">
                  																						<input class="form-control" type="text" name="contact_no" id="contact_no" value="<?php echo $arr_user_data['contact_no']; ?>">
                																							</div>
              																								</div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_OLD_PASSWORD']; ?> :</label>
                                           <div class="span"><input class="form-control" type="password" name="old_password" id="old_password" value="<?php echo $arr_user_data['user_password']; ?>"  > </div>
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_PASSWORD'] ?>:</label>
                                            <div class="span"><input type="password" name="user_password" id="user_password" value=""  class="form-control">
																																				<span id="result"></span>
																																				                                          
                                            </div>
                                            <div class="password-meter">
               																								<div class="password-meter-message password-meter-message-too-short"><?php echo $lang['REGISTRATION_PAGE_PASSWORD_TO_SHORT']; ?></div>
                   																							 <div class="password-meter-bg">
            					     																								<div class="password-meter-bar password-meter-too-short"></div>
                   																								</div>
             																											</div>
             																										<sub><?php echo $lang['REGISTRATION_PAGE_PASSWORD_MUST_HAVE']; ?></sub>  
                                        </div>
                                        
                                        <div class="input_fld_otr">
                                            <label><?php echo $lang['PROFILE_PAGE_CONFIRM_PASSWORD'] ?> :</label>
                                           <div class="span"> <input type="password" name="cpassword" id="cpassword" value="" class="form-control"></div>
                                        </div>
                                        
                                         <div class="input_fld_otr">
                                            <label>&nbsp;</label>
                                           <div class="span"> <input type="submit" value="Submit" name="send" title="Login" class="button"></div>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</div>        
</section>
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
							margin: 9px 0 0 34px;	
    }    

    #profile_pic
    {
        opacity:0;
        filter:alpha(opacity=0);
        -moz-opacity:0;
        -khtml-opacity: 0;
        position: absolute;
        left:-6px;
        z-index: 20;
        cursor: pointer;
    }

</style>

