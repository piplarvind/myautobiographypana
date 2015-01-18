<script src="<?php echo base_url(); ?>media/front/js/contact-us.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/captcha.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.min.js"></script>
<section>
<div class="page_holder">	
    <div class="page_inner ">
   													 <?php
                    if (($this->session->userdata('msg'))) {

                        if ($this->session->userdata('msg') == 'sent') {
                            ?>
                            <div class="msg-success">Your message has been posted successfully. We will get back to you soon.</div>
                            <?php
                        }
                        if ($this->session->userdata('msg') == 'fail') {
                            ?>
                            <div class="msg-error">Your message is failed, please try again.</div>
                            <?php
                        }

                        $this->session->unset_userdata('msg');
                    }
                    ?>
        <div class="heading mrgn_top">Contact Us </div>
        <div class="login_main cms contactus ">
        	
        	<div class="contact">
           <div class="contct_info"> 
                	<h2> » Contact info</h2>
                    
                                        <h5>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</h5>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque la udantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia.<br>
</p>
<address>
<strong>The Company Name Inc.<br>
9870 St Vincent Place,<br>
Glasgow, DC 45 Fr 45.</strong><br>
Telephone: <span class="skype_c2c_print_container">+1 800 603 6035</span><span skype_menu_props="{&quot;numberToCall&quot;:&quot;+18006036035&quot;,&quot;isFreecall&quot;:false,&quot;isMobile&quot;:false,&quot;isRtl&quot;:false}" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span class="skype_c2c_textarea_span"><img src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">+1 800 603 6035</span><span class="skype_c2c_free_text_span"></span></span></span></span><br>
FAX: +1 800 889 9898<br>
E-mail: <a href="mailto:info@demolink.org">mail@demolink.org </a>

</address>
                </div>
                <div class="right_cont">
           		<div class="ct_map"> <img alt="map" src="<?php echo base_url() ?>media/front/img/map.png"> </div>	
                <form name="form_contact_us" id="form_contact_us" action="<?php echo base_url(); ?>contact-us" method="post">
                <div class="contct_form">
                   <h2> » Contact form</h2> 
                	<div class="ct_top_row">
                    	<span class="span"> <input type="text" name="first_name" id="first_name" placeholder="<?php echo $lang['REGISTRATION_PAGE_FIRST_NAME_LABEL']; ?>" ></span>
                        <span class="span"><input type="text" name="last_name" id="last_name" placeholder="<?php echo $lang['REGISTRATION_PAGE_LAST_NAME_LABEL']; ?>"></span>
                        <span class="span"><input type="text" name="email" id="email" placeholder="<?php echo $lang['REGISTRATION_PAGE_EMAIL_ADDRESS_LABEL']; ?>"></span>
                        <span class="span"> <input type="text" name="subject" id="subject" placeholder="<?php echo $lang['CONTACT_US_SUBJECT']; ?>"></span>
                       <!--  <span> <img src="" id="captcha" class="captcha"/>
                                        <a href="javascript:void(0)" onClick="refreshCaptha();" >
                                            <img src="<?php echo base_url(); ?>media/front/img/refresh.png" width="35px"></a></span>
                        <span><input type="text" name="input_captcha_value" id="input_captcha_value"></span> -->
                    </div>
                    <div class="ct_top_row">
                    	<span class=""> <textarea class="sptarea" name="message" id="message" placeholder="<?php echo $lang['CONTACT_US_MESSAGE']; ?>"></textarea></span>
                    </div>
                    
                     <div class="ct_top_row">
                    	<span class="clr"><input  class="button" type="submit" name="btn_submit" id="btn_submit" value="Send"></span>
                    </div>
                </div>
                </form>
                </div>
           </div>
        </div>
    </div>
</div>        
</section>