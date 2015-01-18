<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/user-profile/user_dashboard.js"></script>

<div class="middle_section">
  <div class="page_holder">
    <div class="page_inner">
      <div class="dashboard_main">
      
      <?php $this->load->view('front/includes/top-nav');?>
          
        <div class="cat_tab">My Profile</div>
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
               <img title="User" alt="User" src="<?php echo $profile_img_path; ?>"> 
           
           </div>       
           
       </form>  
          </div>
          <div class="dashboard_right">
            <h1>Edit Personal Details</h1>
         <form id="frm_edit_profile" name="frm_edit_profile" method="post" action="<?php echo base_url(); ?>profile/edit" enctype="multipart/form-data">
            <div class="contact_fld">                      
              <div class="fld_otr">
                <label>First name :</label>
                <div class="input_holder">
                  <input type="text" id="first_name" name="first_name" value="<?php echo $arr_user_data['first_name']; ?>">
                </div>
              </div>
              <div class="fld_otr">
                <label>Last name :</label>
                <div class="input_holder">
                  <input type="text" name="last_name" id="last_name" value="<?php echo $arr_user_data['last_name']; ?>">
                </div>
              </div>
              <div class="fld_otr">
                <label>Email : </label>
                <div class="input_holder">
                  <input type="text" name="user_email" id="user_email" value="<?php echo $arr_user_data['user_email']; ?>"  disabled>
                 <input type="hidden"  name="user_email_old" id="user_email_old" value="<?php echo $arr_user_data['user_email']; ?>">
                </div>
              </div>
              <div class="fld_otr">
                <label>Phone number : </label>
                <div class="input_holder">
                  <input type="text" name="contact_no" id="contact_no" value="<?php echo $arr_user_data['contact_no']; ?>">
                </div>
              </div>
              <div class="send_btn fld_otr">
              	   <label>&nbsp;</label>
                <input type="submit" name="btn_submit" id="btn_submit" value="Update Profile" class="button">
                  <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                  <button type="button" name="btn_edit_profile_cancel" id="btn_edit_profile_cancel" onclick="javascript:document.location.href='<?php echo base_url();?>profile'" class="button" >Cancel</button> 
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
	margin: 2px 0 0 216px;	
    }    
</style>
