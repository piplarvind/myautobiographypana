
<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/edit-user.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
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
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit  User A</h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form name="frm_user_details" id="frm_user_details" class='form-horizontal' action="<?php echo base_url(); ?>backend/user-a/edit/<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Username :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_admin_detail['user_name']); ?>" id="user_name" name="user_name" class="form-control">
                                        <input type="hidden" value="<?php echo $arr_admin_detail['user_name']; ?>" id="old_username" name="old_username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >First Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo htmlentities($arr_admin_detail['first_name']); ?>" name="first_name" id="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Last Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo htmlentities($arr_admin_detail['last_name']); ?>" name="last_name" id="last_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name Of Institute :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="institute_id" name="institute_id" class="form-control">
                                            <option value="">Select</option>

                                            <?php foreach ($arr_institute_name as $institute) { ?>
                                                <option value="<?php echo $institute["user_id"]; ?>"  <?php if ($institute["user_id"] == $arr_admin_detail['institute_id']) { ?>selected="selected" <?php } ?>><?php echo $institute["name_of_institute"]; ?> </option>
                                            <?php } ?>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Gender :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" value="1"<?php if ($arr_admin_detail['gender'] == 1) { ?> checked="checked"<?php } ?> >
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" value="2" <?php if ($arr_admin_detail['gender'] == 2) { ?> checked="checked"<?php } ?> >
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $birth_date = $arr_admin_detail["date_of_birth"];
                                $birth_date = explode("-", $birth_date);
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Date Of Birth :<em>*</em> </label>
                                    <div class="col-sm-9  select-DOB">
                                        <div class="dob-select">
                                            <select name="day"  class="form-control">
                                                <option value=''> Day </option>
                                                <?php for ($i = 01; $i <= 31; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if ($birth_date["2"] == $i) { ?> selected="selected" <?php } ?> ><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>  <div id="day_error"></div></div>
                                        <div class="dob-select">
                                            <select name="month" class="form-control" >
                                                <option value=''> Month </option>
                                                <option value="01" <?php if ($birth_date["1"] == "1") { ?> selected="selected" <?php } ?> >January</option>
                                                <option value="02" <?php if ($birth_date["1"] == "2") { ?> selected="selected" <?php } ?>  >February</option>
                                                <option value="03"  <?php if ($birth_date["1"] == "3") { ?> selected="selected" <?php } ?> >March</option>
                                                <option value="04" <?php if ($birth_date["1"] == "4") { ?> selected="selected" <?php } ?>   >April</option>
                                                <option value="05" <?php if ($birth_date["1"] == "5") { ?> selected="selected" <?php } ?>  >May</option>
                                                <option value="06" <?php if ($birth_date["1"] == "6") { ?> selected="selected" <?php } ?>  >June</option>
                                                <option value="07" <?php if ($birth_date["1"] == "7") { ?> selected="selected" <?php } ?>  >July</option>
                                                <option value="08" <?php if ($birth_date["1"] == "8") { ?> selected="selected" <?php } ?>  >August</option>
                                                <option value="09" <?php if ($birth_date["1"] == "9") { ?> selected="selected" <?php } ?>  >September</option>
                                                <option value="10"  <?php if ($birth_date["1"] == "10") { ?> selected="selected" <?php } ?>  >October</option>
                                                <option value="11" <?php if ($birth_date["1"] == "11") { ?> selected="selected" <?php } ?>  >November</option>
                                                <option value="12" <?php if ($birth_date["1"] == "12") { ?> selected="selected" <?php } ?>  >December</option>
                                            </select>
                                            <div id="month_error"></div>                                           
                                        </div>
                                        <div class="dob-select">
                                            <select name="year" class="form-control" >
                                                <option value=''> Year </option>
                                                <?php for ($i = 1947; $i <= 1993; $i++) { ?>
                                                    <option value="<?php echo $i; ?>" <?php if ($birth_date["0"] == $i) { ?> selected="selected" <?php } ?> ><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select> 
                                            <div id="year_error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Pin-Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_admin_detail['pin_code']); ?>" name="pin_code" id="pin_code" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail['user_email']; ?>" name="user_email" id="user_email" class="form-control">
                                        <input type="hidden" value=<?php echo $arr_admin_detail['user_email']; ?> name="old_email" id="old_email" class="FETextInput">								
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Change Password :</label>
                                    <div class="col-sm-9" >
                                        <div class="checkbox" style="margin-top: -16px;">
                                            <label>
                                                <input type="checkbox" name="change_password" value ="on" id="change_password" >
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="change_password_div"  name="change_password_div" style="display: none;" >
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Password :<em>*</em></label>
                                        <div class="col-sm-9">
                                            <input type="password" id="user_password" name="user_password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"  >Confirm Password :<em>*</em></label>
                                        <div class="col-sm-9">
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($arr_admin_detail['role_id'] != 1) {
                                    ?>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Change Status :<em>*</em></label>
                                        <br>
                                        <div class="col-sm-9">
                                            <select id="user_status" name="user_status" class="form-control">
                                                <?php
                                                if ($arr_admin_detail['user_status'] == 0) {
                                                    ?>
                                                    <option value="">Select Status</option>
                                                    <?php
                                                }
                                                ?>
                                                <option value="1" <?php if ($arr_admin_detail['user_status'] == 1) { ?> selected="selected" <?php } ?>>Active</option>
                                                <option value="2" <?php if ($arr_admin_detail['user_status'] == 2) { ?> selected="selected" <?php } ?>>Blocked</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Profile Picture :</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" name="profile_picture" id="profile_picture" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Profile Picture :</label>
                                    <div class="col-sm-9" >
                                        <?php if ($arr_admin_detail['profile_picture'] == "0" || $arr_admin_detail['profile_picture'] == "") { ?>
                                            <?php
                                            echo "Profile picture is not uploaded.";
                                        } else {
                                            ?>
                                            <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo stripslashes($arr_admin_detail['profile_picture']); ?>" alt="<?php echo stripslashes($arr_admin_detail['profile_picture']); ?>" />
                                            <input type = "hidden" id="old_profile_picture" name="old_profile_picture"  value="<?php echo stripslashes($arr_admin_detail['profile_picture']); ?>"> 
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Country Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail['country_code']; ?>" name="user_country_code" id="user_country_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Contact No :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail['contact_no']; ?>" name="user_contact_no" id="user_contact_no" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >User Registered :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="user_registered" name="user_registered"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($arr_admin_detail['user_registered'] == "1") { ?> selected="selected" <?php } ?><?php if ($arr_admin_detail['user_registered'] == "1") { ?> selected="selected" <?php } ?>>Yes</option>
                                            <option value="0" <?php if ($arr_admin_detail['user_registered'] == "0") { ?> selected="selected" <?php } ?>>No</option>
                                        </select>                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Newsletter :</label>
                                    <div class="col-sm-9" >
                                        <div class="checkbox" style="margin-top: -16px;">
                                            <label>
                                                <input type="checkbox" value="1" name="user_news" id="user_news" <?php if ($arr_admin_detail["send_email_notification"] == "1") { ?> checked="checked" <?php } ?>  >
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php $interest_id = explode(",", $arr_admin_detail["interest_id"]); ?>
                                <div class="form-group"> 
                                    <label class="col-sm-3 control-label" >&nbsp Interest :<em>*</em></label>
                                    <div class="col-sm-9" >
                                    <?php foreach ($arr_interest as $interest) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="<?php echo $interest["category_id"]; ?>" name="interest_id[]" id="interest_id" <?php if (in_array($interest["category_id"], $interest_id)) { ?>checked="checked"<?php } ?> > 
                                         <?php echo $interest["category_name"]; ?>
                                                </label>
                                            </div>
                                <?php } ?>
                                        <div id="role_error"></div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="other_interest" id="other_interest" <?php if (!empty($arr_other_interest)) {  ?> checked="checked" <?php } ?> onchange="checkOther()" > 
                                                Other
                                            </label>
                                        </div>
                                        <br>
                                        <div id="other" style=" <?php if (!empty($arr_other_interest)) {  ?> display: block <?php } else { ?> display: none <?php }  ?>">
                                            <div class="col-sm-9">
                                                <input type="text" value="<?php echo stripslashes($arr_other_interest["comment"]); ?>" name="new_interest" id="new_interest" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/user-a/list';" >Back</button>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="footer">
<?php echo $global['site_title']; ?>  &copy; Copyright
        </div>
        <!-- // Footer -->
    </div>
</div>
<!-- /st-content-inner -->
</div>







