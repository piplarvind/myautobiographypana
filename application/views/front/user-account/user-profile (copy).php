<div class="middle_section">
    <div class="page_holder">
        <div class="page_inner">
            <div class="dashboard_main">

                <?php $this->load->view('front/includes/top-nav'); ?>  

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
                                <img title="User" alt="User" src="<?php echo $profile_img_path; ?>"/>           
                            </div>

                            <div class="btn_fld"> 
                                <input type="file" id="profile_pic" name="profile_pic" accept='image/*'>
                                <a href="" id="anch" class="button">Upload photo</a>
                            </div>
                        </form>
                        
                    </div>
                    <div class="dashboard_right">
                        <?php if ($this->session->userdata('edit_profile_success') != '') { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $this->session->userdata('edit_profile_success'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('edit_profile_success');
                        }
                        ?>
                        <?php if ($this->session->userdata('edit_profile_picture_success') != '') { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $this->session->userdata('edit_profile_picture_success'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('edit_profile_picture_success');
                        }
                        ?> 
                        <?php if ($this->session->userdata('fb_registration') != '') { ?>
                            <div class="alert alert-success">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $this->session->userdata('fb_registration'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('fb_registration');
                        }
                        ?>
                        <?php if ($this->session->userdata('image_size_error') != '') { ?>
                            <div class="alert alert-error">
                                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                                <?php echo $this->session->userdata('image_size_error'); ?>
                            </div>
                            <?php
                            $this->session->unset_userdata('image_size_error');
                        }
                        ?>

                        <h1>Personal Details</h1>
                        <div class="contact_fld editpro">
                            <div class="fld_otr">
                                <label>First name :</label>
                                <div class="input_holder">
                                    <p><?php echo $arr_user_data['first_name']; ?></p>
                                </div>
                            </div>
                            <div class="fld_otr">
                                <label>Last name :</label>
                                <div class="input_holder">
                                    <p><?php echo $arr_user_data['last_name']; ?></p>
                                </div>
                            </div>
                            <div class="fld_otr">
                                <label>Email : </label>
                                <div class="input_holder">
                                    <p><?php echo $arr_user_data['user_email']; ?></p>
                                </div>
                            </div>
                            
                            <?php if($arr_user_data['contact_no'] != 0) { ?>
                            <div class="fld_otr">
                                <label>Phone number : </label>
                                <div class="input_holder">
                                    <p><?php echo $arr_user_data['contact_no'] != 0 ? $arr_user_data['contact_no'] : ""; ?></p>
                                </div>
                            </div>
																									<?php } ?>                            
                            
                            <div class="send_btn ">
                                <label>&nbsp;</label>
                                <a href="<?php echo base_url(); ?>profile/edit">
                                    <input type="button" value="Edit Profile " class="button"/>
                                </a>
                            </div>
                        </div>  

                        <h1>Address Details</h1>  <a href="<?php echo base_url(); ?>add-address">
                                    <input type="button" value="Add Address " class="button">
                                </a>
                        <div class="contact_fld editpro">
																						<?php foreach($arr_user_address_data_loop as $arr_user_address_data) { ?>
                            <div class="fld_otr">
                                <label>Address : </label>
                                <div class="input_holder">
                                    <p><?php if (!empty($arr_user_address_data['user_street_addr'])) {
                            echo $arr_user_address_data['user_street_addr'] != "" ? stripcslashes($arr_user_address_data['user_street_addr']) : "---";
                        } else {
                            echo '---';
                        } ?></p>
                                </div>
                            </div>

                            <div class="fld_otr">
                                <label>City : </label>
                                <div class="input_holder">
                                    <p><?php if (!empty($arr_user_address_data)) {
                            echo $arr_user_address_data['user_city'] != '' ? stripcslashes($arr_user_address_data['user_city']) : "---";
                        } else {
                            echo '---';
                        } ?></p>
                                </div>
                            </div>

                            <div class="fld_otr">
                                <label>Postcode : </label>
                                <div class="input_holder">
                                    <p><?php if (!empty($arr_user_address_data)) {
                            echo $arr_user_address_data['user_zip_code'] != 0 ? stripcslashes($arr_user_address_data['user_zip_code']) : "---";
                        } else {
                            echo '---';
                        } ?></p>
                                </div>
                            </div>
                            <div class="fld_otr">
                                <label>State : </label>
                                <div class="input_holder">
                                    <p><?php if (!empty($arr_user_address_data)) {
                            echo $arr_user_address_data['user_state'] != 0 ? stripcslashes($arr_user_address_data['user_state']) : "---";
                        } else {
                            echo '---';
                        } ?></p>
                                </div>
                            </div>
                            <div class="fld_otr">
                                <label>Country : </label>
                                <div class="input_holder">
                                    <p><?php if (!empty($arr_user_address_data)) {
                            echo $arr_user_address_data['user_country'] != "" ? stripcslashes($arr_user_address_data['user_country']) : "---";
                        } else {
                            echo '---'; 
                        } ?></p>
                                </div>
                            </div>

                            <div class="send_btn ">
                                <label>&nbsp;</label>
                                <a href="<?php echo base_url(); ?>edit-address/<?php echo base64_encode($arr_user_address_data['trans_user_address_id']); ?>">
                                    <input type="button" value="Edit Address " class="button">
                                </a>
                                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">     
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/js/jquery.form.js"></script>
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

</style>

