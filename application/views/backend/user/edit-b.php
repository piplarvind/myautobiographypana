
<style type="text/css">
    .error {
        color: #bd4247;
    }
     .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/user-manage/edit-user-b.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
<script>

    function selectStates(country_id)
    {
        var obj_params = new Object();
        obj_params.country_id = country_id;
        jQuery.post("<?php echo base_url(); ?>backend/cities/select-states", obj_params, function (msg) {

            $("#state_id").html("")
            console.log(msg);
            var div_data = '';
            div_data += "<option value=" + "" + ">" + "Select State" + "</option>";
            $.each(msg, function (i, v) {
                div_data += "<option value=" + v.state_id + ">" + v.state_name + "</option>";

            });
            $(div_data).appendTo('#state_id');
        }, "json");
    }

</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit User B</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_user_details" id="frm_user_details" action="<?php echo base_url(); ?>backend/user-b/edit/<?php echo $edit_id; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Username :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["user_name"]; ?>" id="user_name" name="user_name" class="form-control" >
                                        <input type="hidden"  name="old_username" id="old_username" value="<?php echo $arr_admin_detail["user_name"]; ?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Name of institute :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["name_of_institute"]; ?>" name="name_of_institute" id="name_of_institute" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Address 1 :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea id="address_1" name="address_1" class="form-control"  ><?php echo $arr_admin_detail["address_1"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Address 2 :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea id="address_2" name="address_2" class="form-control"  ><?php echo $arr_admin_detail["address_2"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Country :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="country_id" name="country_id"  onchange = "selectStates(this.value)"   class="form-control">
                                            <option value=''> Select Country </option>
                                            <?php foreach ($arr_country as $country) { ?>
                                                <option value="<?php echo $country["country_id"]; ?>" <?php if ($arr_admin_detail["country_id"] == $country["country_id"]) { ?> selected="selected" <?php } ?> ><?php echo $country["country_name"] ?></option>
                                            <?php } ?>
                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >State :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select name="state_id" id="state_id"   class="form-control"    >
                                            <option value=''> Select State </option>
                                            <?php foreach ($arr_states as $states) { ?>
                                                <option value="<?php echo $states['state_id']; ?>"  <?php if ($arr_admin_detail["state_id"] == $states["state_id"]) { ?> selected="selected" <?php } ?>   > <?php echo $states['state_name']; ?> </option>
                                            <?php } ?> 
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Village/City :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["user_city"]; ?>" name="user_city" id="user_city" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Pin-Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["pin_code"]; ?>" name="pin_code" id="pin_code" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["user_email"]; ?>" name="user_email" id="user_email" class="form-control" >
                                        <input type="hidden" value="<?php echo $arr_admin_detail["user_email"]; ?>" name="old_email" id="old_email" >
                                       
                                    </div>
                                </div>
                                <?php
                                if ($arr_admin_detail['role_id'] != 1) {
                                    ?>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Change Status :<em>*</em></label>
                                        <br>
                                        <div class="col-sm-9">
                                            <select id="user_status" name="user_status" class="form-control"  >
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
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Change Password :</label>
                                    <div class="col-sm-9" >
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="change_password" value ="on" id="change_password" onchange="valueChanged()" style="margin-top :-12px;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="change_password_div"  name="change_password_div" style="display:none;">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Password :<em>*</em></label>
                                        <div class="col-sm-9">
                                            <input type="password" id="user_password" name="user_password" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"  >Confirm Password :<em>*</em></label>
                                        <div class="col-sm-9">
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Type of Institution :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select name="institute_type" id = "institute_type"  class="form-control"   >
                                            <option value=''> Select Institute </option>
                                            <?php foreach ($arr_institute_type as $institute_type) { ?>
                                                <option value="<?php echo $institute_type["institute_type_id"]; ?>" <?php if ($arr_admin_detail["institute_type"] == $institute_type["institute_type_id"]) { ?> selected="selected"<?php } ?> ><?php echo $institute_type["institute_type"]; ?></option>
                                            <?php } ?>
                                        </select>                                      
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Established In :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["established_in"]; ?>" name="established_in" id="established_in" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Name Of Founder :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["name_of_founder"]; ?>" name="name_of_founder" id="name_of_founder" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Country Code :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["country_code"]; ?>" name="user_country_code" id="user_country_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Contact No :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["contact_no"]; ?>" name="user_contact_no" id="user_contact_no" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Institute Website :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_admin_detail["institute_website"]; ?>" name="user_institute_website" id="user_institute_website" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/user-b/list';" >Back</button>
                                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo intval(base64_decode($edit_id)); ?>" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="footer">
                <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>







