<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/colorbox.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.colorbox.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/user-profile/account-settings.js"></script>

<div class="middle_section">
    <div class="page_holder">
        <div class="page_inner">
            <div class="dashboard_main">

                <?php $this->load->view('front/includes/top-nav'); ?>  
                
                <div class="cat_tab">Account Setting</div>
                <div class="dashboard_inn">

                    <div class="dashboard_left">
                       <form id="imageform" method="POST" enctype="multipart/form-data" action='<?php echo base_url() ?>ajax-upload'>              
             <div class="profile_img" id="user_pic">
               <?php
                        if (is_null($arr_user_data['profile_picture']) || $arr_user_data['profile_picture'] == '') {
                            $profile_img_path = base_url() . 'media/front/img/testi.png';
                        } else {
                            $profile_img_path = base_url() . 'media/front/img/users/130x160/' . $arr_user_data['profile_picture'];
                        }
                        ?>  
               <img title="User" alt="User" src="<?php echo $profile_img_path; ?>"/> 
           
           </div>
          
            
            </form>  
                    </div>
                    <div class="dashboard_right">
                        <?php if ($this->session->userdata('change_password') != '') { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $this->session->userdata('change_password'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('change_password');
                        }
                        ?>
                        
                        <h1>Account Setting</h1>
                        <form id="frm_edit_account_setting" name="frm_edit_account_setting" method="post" action="<?php echo base_url(); ?>profile/account-setting" class="bs-example form-horizontal">     
                            <div class="contact_fld">
                                <div class="fld_otr">
                                    <label> Current password :</label>
                                    <div class="input_holder">
                                        <input type="password" name="old_user_password" id="old_user_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="fld_otr">
                                    <label>New password :</label>
                                    <div class="input_holder">
                                        <input type="password"  name="new_user_password" id="new_user_password" placeholder="New password">
                                        <span id="result"></span>
<!--                                        <div class="password-meter">
                                            <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                            <div class="password-meter-bg">
                                                <div class="password-meter-bar password-meter-too-short"></div>
                                            </div>
                                        </div>-->
                                        <sub>
                                            (Password must be minimum six character long and no spaces are allowed)
                                        </sub>
                                    </div>
                                </div>
                                <div class="fld_otr">
                                    <label>Confirm password :  </label>
                                    <div class="input_holder">
                                        <input type="password" name="cnf_user_password" id="cnf_user_password" placeholder="Confirm password">
                                    </div>
                                </div>
                                <div class="send_btn fld_otr">
                                    <label>&nbsp;</label>
                                    <input type="submit" name="btn_account_setting" id="btn_account_setting"  class="button" value="Update">
                                    <img id="btn_loader" style="display: none; border: none" src="<?php echo base_url(); ?>media/front/img/loader.gif"  alt="loader">
                                </div>                
                            </div>
                        </form>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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