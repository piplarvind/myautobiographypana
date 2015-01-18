<?php #[Start ::middle section]       ?>

<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/common.js"></script>


<div class="inner_page_middle">
    <div class="container">
        <div class="row_box registration_page reg_step1">
            <div class="box10 fade-in one offset-1 text-center">
                <div class="box-content">
                    <div class="reg-panel-hed">
                        <h1>create your profile</h1>
                    </div>
                    <form class="text-left" name="frm_user_details" id="frm_user_details" action="<?php echo base_url(); ?>signup-student" method="post" enctype="multipart/form-data">
                        <div class="reg-panel-body register_step_1"><li> <a href="<?php echo base_url(); ?>signin">Sign In</a></li>

                            <div class="small_text">Create your profile free</div>
                            <div class="row_box">
                                <div class="box7">

                                    
                                        <div class="control-group">
                                            <label for="typeahead" class="control-label">user name<span class="compulsory_fld">*</span></label> 
                                            <div class="controls">
                                                <input name="user_name" id="user_name" type="text" size="17" maxlength="30" autofocus="autofocus" class="FETextInput">
                                            </div>
                                            <div class="controls"><input name="old_user_name" id="old_user_name" type="hidden" size="17" maxlength="30"></div>
                                        </div>
                                    

                                    <div class="reg-form gender">
                                        <div class="row_box">
                                            <div class="box4"><label>Gender:<span class="compulsory_fld">*</span></label></div>
                                            <div class="box8">
                                                <label class="label-inline">
                                                    <input type="radio" name="gender" id="gender" value="2"<?php if ($user_session['gender'] == 2) { ?> checked="checked" <?php } ?> ><?php echo "female"; ?>
                                                </label> 
                                                <label class="label-inline">
                                                    <input type="radio" name="gender" id="gender" value="1" <?php if ($user_session['gender'] == 1) { ?> checked="checked" <?php } ?> ><?php echo "male"; ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="reg-form dob">
                                        <div class="row_box">
                                            <div class="box4"><label>date of birth:<span class="compulsory_fld">*</span></label></div>
                                            <div class="box8">                        
                                                <div class="date" id="day_div">
                                                    <select name="day" id="day">
                                                        <option value="">day</option>
                                                        <?php
                                                        for ($i = 1; $i <= 31; $i++) {
                                                            echo'<option value=' . $i . ' > ' . $i . '</option> ';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="month">
                                                    <select name="month" id="month"  onchange="get_days();">
                                                        <option value="">month</option>
                                                        <option value="01"><?php echo "January" ?></option>
                                                        <option value="02"><?php echo "February"; ?></option>
                                                        <option value="03"><?php echo "March"; ?></option>
                                                        <option value="04"><?php echo "April"; ?></option>
                                                        <option value="05"><?php echo "May"; ?></option>
                                                        <option value="06"><?php echo "June"; ?></option>
                                                        <option value="07"><?php echo "July"; ?></option>
                                                        <option value="08"><?php echo "August"; ?></option>
                                                        <option value="09"><?php echo "September"; ?></option>
                                                        <option value="10"><?php echo "October"; ?></option>
                                                        <option value="11"><?php echo "November"; ?></option>
                                                        <option value="12"><?php echo "December"; ?></option>
                                                    </select>
                                                </div> 
                                                <div class="year">
                                                    <select name="year" id="year"  onchange="get_days();">
                                                        <option value="">year</option>
                                                        <?php for ($i = date('Y', strtotime('-18 year')); $i >= date('Y', strtotime('-98 year')); $i--) { ?>
                                                        <?php // for ($i = 1947; $i <= 1996; $i++) { ?>
                                                            <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>                        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>pin code<span class="compulsory_fld">*</span></label> </div>
                                            <div class="box8"><input name="pin_code" id="pin_code" type="text" size="17" maxlength="30" value="" ></div>
                                        </div>
                                    </div>

                                    <div class="reg-form">

                                        <div class="row_box">
                                            <div class="box4">email:<span class="compulsory_fld">*</span></label></div>
                                            <div class="box8"><input type="text" id="user_email" name="user_email" value=""></div>
                                             <input class="form-control" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
                                             <?php echo form_error('user_email'); ?>
                                            <div class="box8"><input type="hidden" id="old_user_email" name="old_user_email" value=""></div>
                                        </div>
                                    </div>

                                    <div class="reg-form">

                                        <div class="row_box">
                                            <div class="box4">confirm email:<span class="compulsory_fld">*</span></label></div>
                                            <div class="box8"><input type="text" id="confirm_email" name="confirm_email" value=""></div>
                                            <?php echo form_error('confirm_email'); ?>
                                        </div>
                                    </div>

                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>password<span class="compulsory_fld">*</span></label></div>

                                            <div class="box8"><input type="password" id="password" name="password" value=""></div>
                                            <?php echo form_error('password'); ?>
                                        </div>
                                    </div>

                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>confirm password<span class="compulsory_fld">*</span></label></div>

                                            <div class="box8"><input type="password" id="confirm_password" name="confirm_password" value=""></div>
                                            <?php echo form_error('confirm_password'); ?>
                                        </div>
                                    </div>

                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>profile picture(optional)<span class="compulsory_fld"></span></label></div>

                                            <div class="box8"><input type="file" id="profile_picture" name="profile_picture" value=""></div>

                                        </div>
                                    </div>


                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>contact number<span class="compulsory_fld">*</span></label></div>
                                             
                                            <div class="box8"><input type="text" id="contact_number" name="contact_number"></div>
                                            <?php echo form_error('contact_number'); ?>
                                        </div>
                                    </div>

                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><input type="checkbox" id="newsletter" name="newsletter" value="1">
                                                <label>Newsletter<span class="compulsory_fld">*</span></label></div>
                                        </div>
                                    </div>


                                    <div class="reg-form">
                                        <div class="row_box">

                                            <div class="box8 remember_me">
                                                <input type="checkbox" name="terms" id="terms" value="1">
                                                <label>yes i agree term_condition <span class="compulsory_fld">*</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reg-panel-footer text-center">
                                        <input type="submit" name="regi_step1_btn" value="create account" id="regi_step1_btn"><i class="icon-arrow-right2"></i>
                                    </div>

                                </div>


                            </div>
                        </div>

                    </form>

                </div>           

            </div>


        </div>
    </div>
</div>


</div>
<?php #[End ::middle section]   ?>

