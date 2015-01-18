
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/common.js"></script>
<script>
    
jQuery(document).ready(function(e) {	
	setInterval( function(e){
	jQuery(".preloader").hide();
	}, 400);
})
</script>
<!----forgot password start----->
<div class="middle-section forgot-pwd">

<div class="fade-bg">
  <div class="fade-bg-inn"> </div>
  <div class="login-bx text-center">
    <div class="panel">
      <div class="panel-heading"><a href="#"><i class="fa fa-arrow-circle-left"></i></a> Forgot password</div>
      <div class="panel-body">
        <!--<p class="text-left">Recover your password by email</p>-->
        <form class="offset-top-20 text-left" id="frm_forgot_password" name="frm_forgot_password" method="post" action="<?php echo base_url(); ?>password-recovery">
          
          <div class="sign-inner  ad-wid">
              <div class="form-group input-control username-one">
                <input name="user_email" id="user_email" type="text" class="form-control input-lg" placeholder="e.g. johndoe@gmail.com" data-toggle="tooltip" data-placement="right" title="Please enter your e-mail ID.">
                <input class="form-control input-lg" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
              <?php  echo form_error('user_email'); ?>
            </div>
            
            <div class="login-btn">
              <div class="sign-btn"> 
                 <input class="btn" type="submit"  id="bnt_submit" name="bnt_submit" value="Forgot password" />
              </div>
            </div>
            <p class="terms-text text-center">Don't have an account? <a href="<?php echo base_url()?>signup-institute">Sign up now !</a></p>
          </div>
        
          
        </form>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Forgot password end--> 