
<style type="text/css">
    div.error {
        color: #bd4247;        
    }
    .validationError{
        color: #bd4247;
    }    

</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/add-user.js"></script>
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
            <h1>Add User A</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form name="frm_user_details" id="frm_user_details" class='form-horizontal'
                                  action="<?php echo base_url(); ?>backend/user-a/add" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Username :<em>*</em>  </label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="user_name" name="user_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">First Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="first_name" id="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Last Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="last_name" id="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name Of Institute :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="institute_id" name="institute_id" class="form-control">
                                            <option value="">Select</option>
                                            <?php foreach ($arr_institute_name as $institute) { ?>
                                                <option value="<?php echo $institute["user_id"]; ?>"><?php echo stripslashes($institute["name_of_institute"]); ?> </option>
                                            <?php } ?>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Gender :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" value="1" checked>
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" value="2" checked>
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Date Of Birth :<em>*</em></label>
                                    <div class="col-sm-9 select-DOB">
                                        <div class="dob-select">
                                            <select name="day" class="form-control">
                                                <option value=''> Day </option>
                                                <?php for ($i = 01; $i <= 31; $i++) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div id="day_error"></div>
                                        </div>
                                        <div class="dob-select">
                                            <select name="month" class="form-control">
                                                <option value=''> Month </option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                            <div id="month_error"></div>
                                        </div>
                                        <div class="dob-select">
                                            <select name="year" class="form-control">
                                                <option value=''> Year </option>
                                                <?php for ($i = 1947; $i <= 1993; $i++) { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div id="year_error"></div>
                                        </div>



                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Pin-Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="pin_code" id="pin_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_email" id="user_email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Email Id :<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="cnf_user_email" id="cnf_user_email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Password :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="user_password" name="user_password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Profile Picture :</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" name="profile_picture" id="profile_picture">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Country Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_country_code" id="user_country_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Contact No :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_contact_no" id="user_contact_no" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">User Registered :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="user_registered" name="user_registered" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>                                    
                                    </div>
                                </div>

                                <div class="form-group single-chkbx">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Newsletter :</label>
                                    <div class="col-sm-9 ">
                                        <input type="checkbox" value="1" name="user_nws" id="user_nws"> 
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="col-sm-3 control-label">&nbsp Interest :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <?php foreach ($arr_interest as $interest) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="<?php echo $interest["category_id"]; ?>" name="interest_id[]" id="interest_id" > 
                                                    <?php echo $interest["category_name"]; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                        <div id="role_error"></div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="1" name="other_interest" id="other_interest" onchange="checkOther()" > 
                                                Other
                                            </label>
                                        </div>
                                        <br>
                                        <div id="other" style="display: none">
                                            <div class="col-sm-9">
                                                <input type="text" value="" name="new_interest" id="new_interest" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/user-a/list';" >Back</button>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
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







