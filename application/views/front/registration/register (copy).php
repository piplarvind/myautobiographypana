<script src="<?php echo base_url(); ?>media/front/js/jquery-1.10.2.min.js"></script>

<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/comman.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/colorbox.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.colorbox.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/jquery.validate.password.css" />
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/facebook-config.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/facebook-connect.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/captcha.js"></script>
<script type="text/javascript"  src="<?php echo base_url(); ?>media/front/js/comman.js" ></script>
<div class="container">
    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h1 id="buttons">User Registration</h1>
                </div>
            </div>
        </div>
    </div>        
    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="well">
                    <form id="frm_user_registration" name="frm_user_registration" method="post" action="<?php echo base_url(); ?>signup" class="bs-example form-horizontal">

                        <fieldset>
                            <legend>Sign up</legend>
                            <div class="help-block text-center">Enter your details below</div>
                            <div class="help-block text-right"><a href="<?php echo base_url(); ?>signin">Already account</a></div>
                            <div class="form-group">
                                <label for="first_name" class="col-lg-2 control-label">First name:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="first_name" name="first_name">                                            
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-lg-2 control-label">Last name:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-lg-2 control-label">Email:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="user_email" id="user_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Username:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="user_name" id="user_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="col-lg-2 control-label">Password:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">                                        
                                    <input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off">

                                    <span id="result"></span>
                                    <div class="password-meter">
                                        <div class="password-meter-message password-meter-message-too-short">Too short</div>
                                        <div class="password-meter-bg">
                                            <div class="password-meter-bar password-meter-too-short"></div>
                                        </div>
                                    </div>
                                    <sub>(Password must be combination of atleast 1 number, 1 special character and 1 upper case letter with minimum 8 characters)</sub>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cnf_user_password" class="col-lg-2 control-label">Confirm password:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" name="cnf_user_password" id="cnf_user_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cnf_user_password" class="col-lg-2 control-label">&nbsp;</label>
                                <div class="col-lg-10">
                                    <img src="" id="captcha" class="captcha"/>

                                    <a href="javascript:void(0)" onClick="refreshCaptha();" ><img src="<?php echo base_url(); ?>media/front/img/refresh.png" width="35px"></a>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Company Name:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="company_name" id="company_name" value="">
                                </div>
                            </div>
                              <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Location:</label>
                                <div class="col-lg-10">
                                   <select name="country" id="country" onchange="get_state(this.value)">
                                   <option value="">Select</option>
                                 <?php foreach($countries as $country)
                                   { ?>
                                  <option value="<?php echo $country['country_id'] ?>" ><?php echo $country['country_name'] ?></option>
                                   <?php
                                   } ?>

                                   </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="user_name" class="col-lg-2 control-label">State:</label>
                                <div class="col-lg-10" id="STATE_ID">
                                   <select name="state" id="state">
                                   <option value="">Select</option>
                                 <?php foreach($states as $state)
                                   { ?>
                                  <option value="<?php echo $state['state_id'] ?>" ><?php echo $state['state_name'] ?></option>
                                   <?php
                                   } ?>

                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">I am:</label>
                                <div class="col-lg-10">
                                    <input type="radio" name="buyer" id="buyer" value="1"> buyer
                                    <input type="radio" name="buyer" id="seller" value="3"> seller
                                    <input type="radio" name="buyer" id="both" value="4"> both
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Phone number:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="phone_number" id="phone_number" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input_captha_value" class="col-lg-2 control-label">Enter the security code:<sup class="mandatory">*</sup></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="input_captcha_value" id="input_captcha_value">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="user_name" class="col-lg-2 control-label">Gender:</label>
                                <div class="col-lg-10">
                                    <input type="radio" name="gender" id="gender" checked="" value="1">Male
                                    <input type="radio" name="gender" id="gender" value="2">Female
                                </div>
                            </div> -->
                           
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
                                    <button type="submit" name="btn_register" id="btn_register" class="btn btn-success">Register</button> 
                                    <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                    <div style="float: right;">
                                        <div id="fb-root"></div>
                                        <a href="javascript:void(0);" id="btn_fb_connect" onClick="connectMe('<?php echo base_url(); ?>')"><img src="<?php echo base_url(); ?>media/front/img/fb_connect.png" border="0"></a>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
    </section>
    <br>
</div>