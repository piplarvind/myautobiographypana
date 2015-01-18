<?php // echo '<pre>';print_r($security_question);die;?>
<div class="wrapper">
   <div class="Wrapper_Outer">
      <div class="main">
         <div class="signin-page-otr">
            <div class="text"> Forgot Password </div>
            <div class="sign_in_box">
               <div class="fld">

                  
               <form class="gf-form" method="post" name="forgot_password_form" id="forgot_password_form" action="<?php echo base_url();?>forgot-password-action">
                   <div class="fld_otr">
                     <label>Your answered question is :</label>
                     <div class="input_holder">
                        <select id="forgot_security_question" name="forgot_security_question">
		           <?php for($i=0;$i<count($security_question);$i++){?>
			   <option <?php if($security_question[$i]['security_question_id']==$question){?> selected="selected" <?php }?> value="<?php echo $security_question[$i]['security_question_id']?>"><?php echo $security_question[$i]['security_question_lang_content']?></option>
                           <?php }?>					
			</select>		
			<input type="text" name="forgot_security_answer" id="forgot_security_answer" value=""/>
                     </div>
                  </div>
                   
                  <div class="fld_otr">
                     <div class="sign_in_btn"> 
                     			<input type="hidden" value="<?php echo $email;?>" name="forgot_email" />
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
