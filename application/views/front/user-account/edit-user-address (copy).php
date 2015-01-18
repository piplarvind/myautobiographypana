<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/comman.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/user-profile/user-address.js"></script>
<div class="middle_section">
  <div class="page_holder">
    <div class="page_inner">
      <div class="dashboard_main">      
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
            <h1>Edit Address Details</h1>
            <?php //echo $arr_address_data['address_line1']; ?>
            <form id="frm_edit_address" name="frm_edit_address" method="post" action="<?php echo base_url(); ?>edit-address/<?php echo base64_encode($arr_address_data['trans_user_address_id']); ?>" enctype="multipart/form-data">     
            <div class="contact_fld">
              <div class="fld_otr">
                <label>Address : </label>
                <div class="input_holder">
                    <textarea name="user_street_addr" id="user_street_addr" cols="55" rows="3" ><?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_street_addr']!="" ? stripcslashes($arr_address_data['user_street_addr']) : ""; }else { echo '';} ?></textarea>                  
                </div>
              </div>

              <div class="fld_otr">
                <label>City : </label>
                <div class="input_holder">
                  <input type="text" name="user_city" id="user_city" value="<?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_city']!='' ? stripcslashes($arr_address_data['user_city']) : ""; }else { echo '';} ?>">
                </div>
              </div>
                <div class="fld_otr">
                <label>Postcode : </label>
                <div class="input_holder">
                  <input type="text" name="user_zip_code" id="user_zip_code" value="<?php if(!empty($arr_address_data)) {  echo $arr_address_data['user_zip_code']!=0 ? stripcslashes($arr_address_data['user_zip_code']) : ""; }else { echo '';} ?>">
                </div>
              </div>
              
              <div class="fld_otr">
                                <label for="user_name" class="col-lg-2 control-label">Location:</label>
                                <div class="input_holder">
                                   <select name="user_country" id="user_country" onchange="get_state(this.value)">
                                   <option value="">Select</option>
                                 <?php foreach($countries as $country)
                                   { ?>
                                  <option value="<?php echo $country['iso'] ?>" <?php if($arr_address_data!='') { if($country['iso']==$arr_address_data['user_country']) { ?> selected='selected' <?php  } } ?>  ><?php echo $country['country'] ?></option>
                                   <?php
                                   } ?>

                                   </select>
                                </div>
                            </div>
                            <div class="fld_otr" >
                                <label for="user_name" class="col-lg-2 control-label">State:</label>
                                <div class="input_holder" id="STATE_ID">
                                   <select name="state" id="state">
                                   <option value="">Select</option>
                                 <?php foreach($states as $state)
                                   { ?>
                                  <option value="<?php echo $state['state_id'] ?>" <?php if($state['state_id']==$arr_address_data['user_state']) { ?> selected='selected' <?php  } ?>  ><?php echo $state['state_name'] ?></option>
                                   <?php
                                   } ?>

                                   </select>
                                </div>
                            </div>
                 
                
              <div class="send_btn fld_otr">
              	   <label>&nbsp;</label>
                <input type="submit" name="btn_edit_address" id="btn_edit_address" value="Update Address" class="button">
                <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                <button type="button" name="btn_edit_address_cancel" id="btn_edit_address_cancel" onclick="javascript:document.location.href='<?php echo base_url();?>profile'" class="button">Cancel</button>
                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">  
                <input type="hidden" name="trans_user_address_id" id="trans_user_address_id" value="<?php echo  $arr_address_data['trans_user_address_id'] ?>" >
              </div>
            </div>
            </form>
            
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

