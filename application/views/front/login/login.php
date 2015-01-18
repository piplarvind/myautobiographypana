<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<!--<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/common.js"></script>-->
<script src="<?php echo base_url(); ?>media/front/UI-1-media/js/facebook-config.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-1-media/js/facebook-connect.js"></script>
<!--[message box]-->

<!-- jQuery 1.8.3 -->
<script src="<?php echo base_url(); ?>media/front/UI-1-media/js/jquery-1.9.1.min.js"></script>

</head>
<body>
    <!-- site style -->

    <link href="<?php echo base_url(); ?>media/front/UI-1-media/css/newstyle.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- Image that triggers the color configuration bar -->
    <img src="<?php echo base_url(); ?>media/front/UI-1-media/img/system/login/gear.png" id="OptionColor">
    <!-- Image that triggers the background configuration bar -->
    <img src="<?php echo base_url(); ?>media/front/UI-1-media/img/system/login/picture.png" id="OptionBack">
    <!-- Image that triggers the My Autobiography Home Page configuration bar -->
    <a href="<?php echo base_url(); ?>home"><img src="<?php echo base_url(); ?>media/front/UI-1-media/img/system/login/home.png" id="OptionBack" hspace="50" ></a>

        <!--[message box]-->
            <?php
            $msg = $this->session->userdata('msg');
            ?>
        
            <!--[message box]-->
            <div class="login-msb-otr">
            <?php if ($msg != '') { ?>
            
                <div class="msg_box alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                    <?php
                    echo $msg;
                    $this->session->unset_userdata('msg');
                    ?> 
                </div>
              
                <?php }
            ?>
        <?php if ($this->session->userdata('login_error') != '') { ?>
            <div class="msg_box alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
                <?php
                echo $this->session->userdata('login_error');
                $this->session->unset_userdata('login_error');
                ?> 
            </div>
        <?php } ?>
            </div>


    <!-- Login Box -->
    <div class="LoginBox">

        <!-- live avatar -->
<!-- <img src="<?php echo base_url(); ?>media/front/UI-1-media/img/system/login/avatar.png">-->
        <?php if ($this->input->cookie('profile_picture', TRUE) != '') { ?>
            <img class="prof-pic" src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $this->input->cookie('profile_picture', TRUE); ?>">
        <?php } else { ?>
            <img class="prof-pic" src="<?php echo base_url(); ?>media/front/UI-1-media/img/system/login/avatar.png">    
        <?php } ?>
        <!-- Login Message -->


        <!-- Form Fields -->
        <div class="fields">
            <form id="signin_frm" name="signin_frm" method="post" action="<?php echo base_url(); ?>signin">
                <div class="prof-pic"></div>
                <div class="sign-inner ">
                    <div class="form-group input-control">
                        <input name="user_email" id="user_email" type="text" class="form-control input-lg" placeholder="Username or e-mail" data-toggle="tooltip" data-placement="right" title="Please enter your username or e-mail ID." value="<?php echo $this->input->cookie('user_email', TRUE); ?>">
                        <?php echo form_error('user_email'); ?>
                    </div>
                    <div class="form-group">
                        <input id="user_password" name="user_password" type="password" class="form-control input-lg" placeholder="Password" data-toggle="tooltip" data-placement="right" title="Please enter your password" value="<?php echo $this->input->cookie('user_password', TRUE); ?>">
                        <?php echo form_error('password'); ?> 
                    </div>
                    <div class="form-group">
                        <div class="checkbox text-left">
                            <label>
                                <input type="checkbox" name="remember_me" id="remember_me" <?php if ($this->input->cookie('user_email', TRUE) != '') { ?> checked="checked" <?php } ?>>
                                Remember me </label>
                            <div class="pull-right center-link"> <a href="<?php echo base_url() ?>forgot-password">Forgot password?</a> </div>
                        </div>
                    </div>
                    <div class="login-btn">
                        <div class="col-xs-6 sign-btn"> 
                            <input type="hidden" name="back_url" id="back_url" value="<?php echo $back_url; ?>">
                            
                            <button class="btn" type="submit" id="btn_submit" name="btn_submit"/>Login</button>
                        </div>
                    </div>
                     <div class="form-group">
                    <p class="terms-text text-right">Don't have an account? <a href="<?php echo base_url() ?>signup-institute">Sign up now !</a></p>
                </div>
                </div>
                <div class="clearfix"></div>
                
                <!--<div class="or"><span>or</span></div>
                <p class="text-left sign-p">Log in with your social media account</p>
                <a href="javascript:void(0);" class="btn btn-facebook" id="btn_fb_connect" onClick="connectMe('<?php echo base_url(); ?>')"><i class="fa fa-facebook"></i> Sign in with facebook</a>
                -->
                
                <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/UI-1-media/img/loader.gif" alt="Loader">
               
            </form>
            
           
        </div>
    </div>
    
    
     <!-- For facebook name of institute -->     
     <div id="user_type_id" class="fb-login-popup" style="display:none;">
           <div class="fb-popup-inn">
<!--           <div class="close"><a href="#">X</a></div>-->
                 <form name="frm_fb_lnk" id="frm_fb_lnk" action="<?php echo base_url(); ?>fb-user-institute-type" method="post">
                     <div class="form-group">
                          <label>Name of institute :</label>
                          <div class="input-holder">
                          <input id="Name_of_institute" name="Name_of_institute" type="text" class="form-control input-lg" placeholder="Name of institute" data-toggle="tooltip" data-placement="right" title="Please enter name of institute">
                          </div>
                     </div>
                     
                        <div class="sign-btn"> 
                             <button class="btn" type="submit" id="btn_submit" name="btn_submit"/>Login</button>
                         </div>
                     
                 </form>
                 </div>
           </div>
          <!-- For facebook name of institute -->  

    <script src="<?php echo base_url(); ?>media/front/UI-1-media/js/MetroLogin.js"></script>
    <input type="hidden" name="fb_id" id="fb_id" value="<?php echo $global['fb_app_id']; ?>">

</body>
</html>