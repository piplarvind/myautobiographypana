
<script src="<?php echo base_url(); ?>media/front/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.js"></script>


<script type="text/javascript">
//    alert("script");
    $(document).ready(function() {
        $("#interest_frm").validate({
        errorElement: "div",
        rules: {
            
            "interest[]":
                    {
                        required: true,
                      minlength :2
                    }
            
        },
        messages: {

           "interest[]":
                    {
                        required: "Please check  interest.",
                 minlength :"Please check at least 2 interest."
                    }
        }
    });
    
    });
</script>

<div class="inner_page_middle">
    <div class="container">
        <div class="row_box registration_page reg_step1">
            <div class="box10 fade-in one offset-1 text-center">
                <div class="reg-panel">
                    <div class="reg-panel-hed">
                        <h1>create your profile</h1>
                    </div>
                    <form class="text-left" name="interest_frm" id="interest_frm" action="<?php echo base_url(); ?>registration/step2" method="post">
                        <div class="reg-panel-body register_step_1">

                            <div class="small_text">Create your profile free</div>
                            <div class="row_box">
                                <div class="box7">
                                    
                                    <div class="reg-form">
                                        <div class="row_box">
                                            <div class="box4"><label>Interest :<span class="compulsory_fld">*</span></label></div>
                                            <?php foreach ($arr_interest_details as $interest_details) { ?>
                                           <div class="box8">
                                               <input type="checkbox" id="interest" name="interest[]" value="<?php echo $interest_details['interest_id']?>"><?php echo $interest_details['interest_name']?>
                                           </div>
                                          <?php  } ?>
                                            

                                        </div> 
                                    </div>

                        <div class="reg-panel-footer text-center">
                            <input type="submit" name="check_interest" value="createaccount" id="check_interest"><i class="icon-arrow-right2"></i>
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


<?php #[End ::middle section]   ?>
