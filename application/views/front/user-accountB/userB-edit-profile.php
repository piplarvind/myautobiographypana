<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/user-manage/edit-userB.js"></script>
<script type="text/javascript">
    function selectStates(country_id)
    {
        var obj_params = new Object();
        obj_params.country_id = country_id;
        jQuery.post("<?php echo base_url(); ?>backend/cities/select-states", obj_params, function(msg) {

            $("#state_id").html("")
            console.log(msg);
            var div_data = '';
            div_data += "<option value=" + "" + ">" + "Select State" + "</option>";
            $.each(msg, function(i, v) {
                div_data += "<option value=" + v.state_id + ">" + v.state_name + "</option>";

            });
            $(div_data).appendTo('#state_id');
        }, "json");
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
                                <li><a href="<?php echo base_url(); ?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                                <li><a href="<?php echo base_url(); ?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right hidden-xs">
                                <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a>
                                </li>
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

                                    <form class="form-horizontal" name="edit_userB_details" id="edit_userB_details" action="<?php echo base_url(); ?>institute/edit-user-profile" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">User name:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="user_name" class="form-control" id="user_name" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['user_name'] ?>">
                                                <input type="hidden"  class="form-control" value="<?php echo $arr_user_data['user_name']; ?>" id="old_username" name="old_username">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Name of institute:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="Name_of_institute" class="form-control" id="Name_of_institute" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['name_of_institute'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address line 1:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="Address_line1" class="form-control" id="Address_line1" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['address_1'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Address line 2:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="Address_line2" class="form-control" id="Address_line2" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['address_2'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Country :<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="country_id" id ="country_id" onchange = "selectStates(this.value)" >
                                                    <option value=''> Select Country </option>
                                                    <?php foreach ($arr_country_details as $country_details) { ?>
                                                        <option value="<?php echo $country_details["country_id"]; ?>" <?php if ($arr_user_data["country_id"] == $country_details["country_id"]) { ?> selected="selected" <?php } ?>><?php echo $country_details["country_name"] ?></option>
                                                    <?php } ?> 
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">State :<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="state_id" name="state_id"  >
                                                    <option value=''> Select State </option>
                                                    <?php foreach ($arr_states as $states) { ?>
                                                        <option value="<?php echo $states['state_id']; ?>"  <?php if ($arr_user_data["state_id"] == $states["state_id"]) { ?> selected="selected" <?php } ?>   > <?php echo $states['state_name']; ?> </option>
                                                    <?php } ?> 
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Village/city:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="Village_city" class="form-control" id="Village_city" type="text" size="17" maxlength="30" value="<?php echo $arr_user_data['user_city'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Pin code:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input name="pin_code" class="form-control"  id="pin_code" type="text" size="17" maxlength="30" value="<?php if ($arr_user_data['pin_code'] != '0') {
                                                        echo $arr_user_data['pin_code'];
                                                    } ?>" >
                                            </div>
                                        </div>

                                        <div class="form-group contact-no-div">
                                            <label class="col-sm-3 control-label">Phone Number:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-2 cntry-code">
                                                        <input type="text" class="form-control" id="country_code" name="country_code" value="<?php if ($arr_user_data['country_code'] != '0') {
                                                        echo $arr_user_data['country_code'];
                                                    } ?>" placeholder="Country code"></div>
                                                    <div class="col-sm-10 cont-no">
                                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php if ($arr_user_data['contact_no'] != '0') {
                                                        echo $arr_user_data['contact_no'];
                                                    } ?>" placeholder="Phone number"></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Email:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $arr_user_data['user_email'] ?>">
                                                <input type="hidden" id="old_user_email" name="old_user_email" value="<?php echo $arr_user_data['user_email'] ?>" >
                                                <input class="form-control" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Type of institution:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="Type_of_institution" id="Type_of_institution" >
                                                    <option value="">Type of institution</option>
                                                      <?php foreach ($arr_institute_type as $institute_type) { ?>
                                                        <option value="<?php echo $institute_type["institute_type_id"]; ?>" <?php if ($arr_user_data["institute_type"] == $institute_type["institute_type_id"]) { ?> selected="selected" <?php } ?>><?php echo $institute_type['institute_type'] ?></option>
                                                      <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Established:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Established" name="Established" value="<?php echo $arr_user_data['established_in'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Name of founder:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="Name_of_founder " name="Name_of_founder" value="<?php echo $arr_user_data['name_of_founder'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Institute WebSite:<span class="compulsory_fld">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="institute_website " name="institute_website" value="<?php echo $arr_user_data['institute_website'] ?>">
                                            </div>
                                        </div>


                                        <div class="form-group contol-lbl-padding0">
                                            <label  class="col-sm-3 control-label">Profile picture(optional):</label>
                                            <div class="col-sm-9 prof-pic-holder">
                                                <input type="file" id="profile_picture" name="profile_picture"  onchange="showimagepreviews(this);
                                                        readURL(this);"  value="<?php echo base_url() ?>media/front/img/user-images/<?php echo $arr_user_data['profile_picture'] ?>">
                                                <input type="hidden" id="old_image_name" name="old_image_name" value="<?php echo $arr_user_data['profile_picture'] ?>">

                                                <image id="blah" class="bordered-img" src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture']; ?>" />
                                            </div>
                                        </div>  

                                        <div class="form-group contol-lbl-padding0">
                                               <?php $term_id = $arr_user_data['terms_condition']; ?>
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" id="terms"  name="terms" <?php if ($term_id == '1') { ?>checked="checked"<?php } ?>  value="1"> yes, I agree to the   <a href="#"  data-target="#TermsConditionsModal" data-toggle="modal">Terms and Conditions.</a>
                                                    </label>
                                                </div>
                                                <div>    
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <input type="submit" class="btn btn-primary" name="regi_step2_btn" value="Edit profile" id="regi_step2_btn">
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
            <p><?php echo stripslashes($arr_terms_condtion['page_content']); ?></p>
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

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>