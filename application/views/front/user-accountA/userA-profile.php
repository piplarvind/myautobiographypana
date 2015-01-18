<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/edit-userA.js"></script>
<script>
  
    function checkOther()
    {
        if ($("#other_interest").is(':checked'))
        {
            $('#other').css('display', 'block');
        }
        else
        {
            $('#other').css('display', 'none');
        }
    }
    
   
</script>
<div class="st-container edit-prof">
    <div class="chat-window-container"></div>
    <div class="st-pusher" id="content">
        <div class="st-content">
           
            <div class="st-content-inner">
                <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
                    <div class="container-fluid">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="fa fa-ellipsis-h"></span>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="subnav">
                            <ul class="nav navbar-nav">
                                <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                                <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                                <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                            </ul>
                        </div>

                        <!-- /.navbar-collapse -->
                    </div>
                </nav>
                <div class="container-fluid">
                 <!--[message box]-->
            <?php
            $msg = $this->session->userdata('msg');
            ?>
            <!--[message box]-->
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
                    <h1>Edit your profile</h1>
                    <div class="row">
                        <div class="col-md-10 col-xs-12">
                            <div class="panel panel-default">
                                <!--<div class="panel-heading panel-heading-gray">Elements</div>-->
                                <div class="panel-body">

                                    <form class="form-horizontal" name="edit_userA_details_form" id="edit_userA_details_form" action="<?php echo base_url(); ?>edit-userA-profile" method="post" enctype="multipart/form-data">   
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">User Name:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="user_name" class="form-control" id="user_name" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['user_name'] ?>">
                                                <input type="hidden"  class="form-control" value="<?php echo $arr_user_data['user_name']; ?>" id="old_username" name="old_username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Gender:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="2"<?php if ($arr_user_data['gender'] == 2) { ?> checked="checked" <?php } ?> ><?php echo "female"; ?>
                                                </label> 
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="1" <?php if ($arr_user_data['gender'] == 1) { ?> checked="checked" <?php } ?> ><?php echo "male"; ?>
                                                </label>
                                            </div>
                                        </div>  

                                        <?php
                                        $birth_date = $arr_user_data["date_of_birth"];
                                        $birth_date = explode("-", $birth_date);
                                        ?>


                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Date of birth:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">


                                                <div class="box8 dob">      
                                                    <div class="dob-select">
                                                        <select name="day" id="day" class="form-control">
                                                            <option value=''> --Day-- </option>
                                                            <?php for ($i = 01; $i <= 31; $i++) { ?>
                                                                <option value="<?php echo $i; ?>" <?php if ($birth_date["2"] == $i) { ?> selected="selected" <?php } ?>  ><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>



                                                    <div class="dob-select">
                                                        <select name="month" id="month" class="form-control" onchange="get_days();">
                                                            <option value="">--Month--</option>
                                                            <option value="01" <?php if ($birth_date["1"] == "1") { ?> selected="selected" <?php } ?> ><?php echo "January" ?></option>
                                                            <option value="02" <?php if ($birth_date["1"] == "2") { ?> selected="selected" <?php } ?> ><?php echo "February"; ?></option>
                                                            <option value="03" <?php if ($birth_date["1"] == '3') { ?> selected="selected" <?php } ?> ><?php echo "March"; ?></option>
                                                            <option value="04" <?php if ($birth_date["1"] == '4') { ?> selected="selected" <?php } ?> ><?php echo "April"; ?></option>
                                                            <option value="05" <?php if ($birth_date["1"] == '5') { ?> selected="selected" <?php } ?> ><?php echo "May"; ?></option>
                                                            <option value="06" <?php if ($birth_date["1"] == '6') { ?> selected="selected" <?php } ?> ><?php echo "June"; ?></option>
                                                            <option value="07" <?php if ($birth_date["1"] == '7') { ?> selected="selected" <?php } ?> ><?php echo "July"; ?></option>
                                                            <option value="08" <?php if ($birth_date["1"] == '8') { ?> selected="selected" <?php } ?> ><?php echo "August"; ?></option>
                                                            <option value="9" <?php if ($birth_date["1"] == '9') { ?> selected="selected" <?php } ?>  > <?php echo "September"; ?></option>
                                                            <option value="10" <?php if ($birth_date["1"] == '10') { ?> selected="selected" <?php } ?>  ><?php echo "October"; ?></option>
                                                            <option value="11" <?php if ($birth_date["1"] == '11') { ?> selected="selected" <?php } ?>  ><?php echo "November"; ?></option>
                                                            <option value="12"<?php if ($birth_date["1"] == '12') { ?> selected="selected" <?php } ?> ><?php echo "December"; ?></option>
                                                        </select>
                                                    </div>

                                                    <div class="dob-select">
                                                        <select name="year" id="year" class="form-control" onchange="get_days();">
                                                            <option value="">--Year--</option>
                                                            <?php for ($i = date('Y', strtotime('-10 year')); $i >= date('Y', strtotime('-90 year')); $i--) { ?>
                                                                <option value="<?php echo $i; ?>" <?php if ($birth_date["0"] == $i) { ?> selected="selected" <?php } ?> ><?php echo $i; ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="col-sm-3 control-label">Pin code:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="pin_code" class="form-control" id="pin_code" type="text" size="17" maxlength="30" value="<?php
                                                if ($arr_user_data['pin_code'] != '0') {
                                                    echo $arr_user_data['pin_code'];
                                                }
                                                ?>" >
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $arr_user_data['user_email'] ?>" >
                                                <input type="hidden" class="form-control" id="old_user_email" name="old_user_email" value="<?php echo $arr_user_data['user_email'] ?>" >
                                                <input class="form-control" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
                                            </div>
                                        </div>   

                                        <div class="form-group contol-lbl-padding0">
                                            <label  class="col-sm-3 control-label">Profile picture(optional):</label>
                                            <div class="col-sm-9">
                                                <input type="file" id="profile_picture" name="profile_picture" onchange="showimagepreviews(this);
                                                        readURL(this);" value="<?php echo base_url() ?>media/front/img/user-images/<?php echo $arr_user_data['profile_picture'] ?>">
                                                <input type="hidden" id="old_image_name" name="old_image_name" value="<?php echo $arr_user_data['profile_picture'] ?>">
                                            </div>
                                        </div>

                                        <?php if ($arr_user_data['profile_picture'] != '') { ?>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                                <div class="col-sm-9 prof-pic-holder" >
                                                    <img class="bordered-img" src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture']; ?>" />
                                                </div>
                                            </div>
                                        <?php } ?>


                                        <div class="form-group contact-no-div">
                                            <label  class="col-sm-3 control-label">Contact number:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-2 cntry-code">
                                                        <input type="text" class="form-control" id="country_code" name="country_code" value="<?php echo $arr_user_data['country_code'] ?>" placeholder="Country code"></div>
                                                    <div class="col-sm-10 cont-no">
                                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $arr_user_data['contact_no'] ?>" placeholder="Contact number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <?php $interest_id = explode(',', $arr_user_data['interest_id']) ?>          
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Interest:<span class="compulsory_fld">*</span></label>

                                            <div class="col-sm-9">
                                                <?php foreach ($arr_interest_details as $interest_details) { ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"  id="interest" name="interest[]" <?php if (in_array($interest_details["category_id"], $interest_id)) { ?>checked="checked"<?php } ?> value="<?php echo $interest_details['category_id'] ?>"><?php echo $interest_details['category_name'] ?>
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                                <div for="interest[]" generated="true" class="error"></div>
                                                <div id='post_error'></div>
                                                
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"  id="other_interest" name="other_interest" <?php if(!empty($arr_other_interest)) { ?>checked="checked" <?php } ?> onchange="checkOther()" value="1">Other
                                                    </label>
                                                </div>
                                                <div id="other"  <?php if(!empty($arr_other_interest)) { ?>style="display: block" <?php } else {?> style="display: none" <?php } ?>>
                                                    <br>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="new_interest" name="new_interest" value="<?php echo stripslashes($arr_other_interest["comment"]) ; ?>" placeholder="Other Interest">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>           


                                        <div class="form-group newsletter-div">
                                            <?php // $newsletter_id = $arr_user_data['newsletter'];   ?>
                                            <label for="inputEmail3" class="col-sm-3 control-label">Newsletter:</label>
                                            <div class="col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"  name="newsletter" id="newsletter" <?php if ($arr_user_data['send_email_notification'] == "1") { ?> checked="checked" <?php } ?> value="1" > &nbsp; 
                                                    </label>
                                                </div>
                                            </div>     
                                        </div>  


                                        <div class="form-group">
                                            <?php $term_id = $arr_user_data['terms_condition']; ?>
                                            <label  class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="terms"  name="terms" <?php if ($term_id == '1') { ?>checked="checked"<?php } ?>  value="1"> yes, I agree to the   <a href="#"  data-target="#TermsConditionsModal" data-toggle="modal">Terms and Conditions.</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="submit"  class="btn btn-primary" name="regi_step1_btn"  value="Edit profile" id="regi_step1_btn">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="modal fade" id="TermsConditionsModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog show-terms">
            <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Terms & Conditions</h4>
      </div>
      <div class="modal-body">
      <div id="show_terms">
                   <p> <?php echo stripslashes($arr_terms_condtion['page_content']); ?></p>
                </div>
        
      </div>

                

                
            </div>
        </div>
        <script>
            function showimagepreviews(input) {
                var file_name = input.files[0]['name'];
                var size = input.files[0]['size'];
                var arr_file = new Array();
                arr_file = file_name.split('.');
                var file_ext = arr_file[1];
                switch (file_ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    case 'JPG':
                    case 'JPEG':
                    case 'PNG':
                    case 'GIF':
                        break;
                    default:
                        $('#upload_cover_photo').replaceWith($('#upload_cover_photo').val('').clone(true));
                        alert('Please upload a file only of type jpg,jpeg,gif,png.');
                        return true;
                }
            }
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
