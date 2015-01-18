
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/common.js"></script>


<script type="text/javascript">

            function selectStates(country_id)
            {
                var obj_params = new Object();
                obj_params.country_id = country_id;
                jQuery.post("<?php echo base_url(); ?>backend/cities/select-states", obj_params, function (msg) {
                    console.log(msg);
                    $("#state_id").html("")
                    var div_data = '';
                    div_data+= "<option value=" + ""+ ">" + "Select State"+ "</option>" ;
                    $.each(msg, function(i, v) {
                        div_data+= "<option value=" + v.state_id + ">" + v.state_name+ "</option>";
                        
                     });
                     $(div_data).appendTo('#state_id');
                        }, "json");
                }
</script>


<!--<div id="body" class="unselectable">-->

<div class="middle-section login-form-sec registration">
<!---Register start--->
 
<div class="login-bx reg-box text-center">
    <div class="panel">
      <div class="panel-heading"><a href="#"><i class="fa fa-arrow-circle-left"></i></a> Registration for Institute</div>
      <div class="panel-body">

        <form class="text-left" name="frm_userB_details" id="frm_userB_details" action="<?php echo base_url(); ?>signup-institute" method="post" enctype="multipart/form-data">
        <div class="from-top">
          <!--<div class="prof-pic"> <img src="img/login-prof.png"> </div>-->
          <div class="sign-inner text-center">
          <div class="form-group input-contro">
              <input type="text" placeholder="User name" name="user_name" id="user_name" class="form-control input-lg">
            </div>
              
            <div class="form-group input-contro">
              <input name="Name_of_institute" id="Name_of_institute" type="text" size="17" maxlength="30" placeholder="Name of institute" class="form-control input-lg">
            </div>
              
            <div class="form-group input-contro">
            <textarea placeholder="Address line 1" name="Address_line1" id="Address_line1" class="form-control input-lg"></textarea>
            </div>
            <div class="form-group input-contro">
            <textarea placeholder="Address line 2" name="Address_line2" id="Address_line2" class="form-control input-lg"></textarea>             
            </div>
            
            <div class="form-group input-contro">
             <select name="country_id" id="country_id" onchange = "selectStates(this.value)" class="form-control input-lg" >
                                        <option value=''> Select Country </option>
                                     <?php foreach($arr_country_details as $country) { ?>
                                        <option value="<?php  echo  $country["country_id"] ; ?>"><?php echo $country["country_name"] ?></option>
                                     <?php  } ?>
            </select>
            </div>
            
            <div class="form-group input-contro">
            
            <select class="form-control input-lg" name="state_id" id="state_id" >
                                      <option value=''> Select State </option>
                                       <?php  foreach($arr_geoname_details as $geoname_details) { ?>
                                      <option value="<?php  echo  $geoname_details["state_id"] ; ?>"><?php echo $geoname_details["geoname"] ?></option>
                                     <?php  } ?>
            
            </select>
            </div>
            
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Vilage/ City" name="Village_city" id="Village_city" class="form-control input-lg">
            </div>
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Pin code" name="pin_code" id="pin_code" class="form-control input-lg">
            </div>
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Phone" id="contact_number" name="contact_number" class="form-control input-lg">
            </div>
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Email" id="user_email" name="user_email" class="form-control input-lg">
              <input class="form-control input-lg" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
              <?php echo form_error('user_email'); ?>
            </div>
            
            <div class="form-group input-contro">
           
            <select name="Type_of_institution" id="Type_of_institution" class="form-control input-lg">
                 <option value="">Type of institution</option>
                     <?php foreach ($arr_institute_type as $institute_type) { ?>
                     <option value="<?php echo $institute_type['institute_type_id']?>"><?php echo $institute_type['institute_type']?></option>
                     <?php }?>
              </select>
            </div>
            
            <div class="form-group input-contro">
              <input type="password" placeholder="Password" id="password" name="password" class="form-control input-lg">
            </div>
            
            <div class="form-group input-contro">
              <input type="password" placeholder="Confirm password" id="confirm_password" name="confirm_password" class="form-control input-lg">
            </div>
            
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Established " id="Established" name="Established" class="form-control input-lg">
            </div>
            
            <div class="form-group input-contro">
              <input type="text" placeholder="Name of founder" id="Name_of_founder " name="Name_of_founder" class="form-control input-lg">
            </div>
            
            
            
            <div class="form-group">
              <div class="checkbox text-left">
                <label>
                    <input type="checkbox" name="terms" id="terms" value="1"> Yes I agree <a href="<?php echo base_url()?>cms/terms-and-conditions" target='_blank'>terms and conditions</a> </label>
              </div>
            </div>
          
              <div class="sign-btn">
                  <!--<a class="btn" href="#">Create your account</a>-->
                  
                  <button type="submit" class="btn" name="regi_step2_btn"  id="regi_step2_btn">Create your account</button>
                  
                  <!--<input type="submit" class="btn" name="regi_step2_btn" value="Create your account" id="regi_step2_btn">-->
              </div>
              <p class="terms-text text-right">Already have an account? <a href="<?php echo base_url()?>signin">Sign in now !</a></p>
          
          </div>
          </div>         
            
          
        </form>
      </div>
    </div>
  </div>
  
  <!---Register end--->
  
</div>





<!-- Launcher Start --> 
<script type="text/javascript">
    $(document).ready(function() {  
	$(".menu-btn").click(function(){
			$(".menu-dropdown").toggleClass('slide-menu')
	});

	  
    $("#createWindow").on('click', function(){
$.Dialog({
shadow: true,
overlay: false,
icon: '<span class="icon-rocket"></span>',
title: 'Title',
width: 500,
padding: 10,
content: 'Window content here'
});
});

	
    });
</script> 
