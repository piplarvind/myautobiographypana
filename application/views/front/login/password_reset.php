<div class="wrapper">
   <div class="Wrapper_Outer">
      <div class="main">
         <div class="signin-page-otr">
            <div class="text"> Password Reset </div>
            <div class="sign_in_box">
               <div class="fld">
					<form class="gf-form" method="post" name="password_reset_form" id="password_reset_form" action="<?php echo base_url();?>password-reset-action">
                  <div class="fld_otr">
                     <label>New Password :</label>
                     <div class="input_holder">
                        <input id="password" type="password" name="password">
                     </div>
                  </div>
                  
                  <div class="fld_otr">
                     <label>Confirm Password :</label>
                     <div class="input_holder">
                        <input id="cpassword" type="password" name="cpassword">
                     </div>
                  </div>
                  
                   
                   
                  <div class="fld_otr">
                     <div class="sign_in_btn"> 
                      			<input id="user_id" type="hidden" value="<?php echo $userDtl[0]['user_id'];?>" name="user_id">
                        <input type="submit" value="Submit" name="text">
                     </div>
                  </div>
               </form>   
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
