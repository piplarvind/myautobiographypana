<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/registration/forgot-password.js"></script>

<div class="middle_section">
    <div class="banner_box">
        <div class="page_holder">
            <div class="page_inner">
               <!--  <div class="banner">
                    <img src="<?php echo base_url() ?>media/front/img/home-images/519x364/<?php echo $global['home_image'];?>" alt="Banner imaage">
                </div> -->   
                <div class="banner_right">
                    <div class="logo logo01">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>media/front/img/logo.png" alt="logo"></a>                         
                    </div>
                    <!--------------Login starts here--------------------->
                    <div class="Login_main">
                        <div class="box_bg">
                            <div class="content"> 
                                <h1>Forgot Password?</h1>                              
                                <form id="frm_forgot_password" name="frm_forgot_password" method="post" action="<?php echo base_url(); ?>password-recovery">
                                <div class="login_box">
                                    <span> Enter your registered email address here: </span>
                                    <div class="login_row">
                                        <input type="text" id="user_email" name="user_email" class="login user" placeholder="Email Address">
                                    </div>
                                    <div class="login_row">
                                        <input  type="submit" name="btn_login" id="btn_login" value="Submit" class="button_sub">
                                        <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/img/loader.gif" border="0">
                                    </div>                      
                                </div>
                               </form>     
                            </div>
                          
                        </div>
                    </div>
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                    <!--------------Login starts here---------------------> 
                </div>
            </div>
        </div>
    </div>   
</div>
