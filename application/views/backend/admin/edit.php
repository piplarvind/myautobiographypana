<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/admin-manage/edit-admin.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/js/jquery.validate.password.js"></script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Super Admin</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal"  name="frm_admin_details" id="frm_admin_details" action="<?php echo base_url(); ?>backend/admin/edit/<?php echo $edit_id; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Username :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['user_name'])); ?>" id="user_name" name="user_name" class="form-control" >
                                        <input type="hidden" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['user_name'])); ?>" id="old_username" name="old_username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >First Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['first_name'])); ?>" name="first_name" id="first_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Last Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo str_replace('"', '&quot;', stripslashes($arr_admin_detail['last_name'])); ?>" name="last_name" id="last_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo stripslashes($arr_admin_detail['user_email']); ?>" name="user_email" id="user_email" class="form-control" >
                                        <input type="hidden" value="<?php echo stripslashes($arr_admin_detail['user_email']); ?>" name="old_email" id="old_email" class="FETextInput">								
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Change Password :</label>
                                    <div class="col-sm-9" >
                                        <input type="checkbox" name="change_password" id="change_password" value="on">
                                    </div>
                                </div>
                                <div id="change_password_div" style="display:none;">
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
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Gender :<em>*</em></label>
                                    <div class="col-sm-9"  >
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" <?php if ($arr_admin_detail['gender'] == 1) { ?> checked="checked"<?php } ?> value="1" >
                                                Male
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="gender" id="gender" value="2" <?php if ($arr_admin_detail['gender'] == 2) { ?> checked="checked"<?php } ?>>
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($arr_admin_detail['role_id'] != 1) {
                                    ?>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Choose Admin:<em>*</em><br>Role</label>
                                        <div class="col-sm-9">
                                            <select id="role_id" name="role_id" class="form-control">
                                                <option value="">Select Role</option>
                                                <?php
                                                foreach ($arr_roles as $key => $role) {
                                                    if ($role['role_id'] != 1) {
                                                        ?>
                                                        <option value="<?php echo $role['role_id']; ?>" <?php if ($arr_admin_detail['role_id'] == $role['role_id']) { ?> selected="selected"<?php } ?>><?php echo $role['role_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <input type="hidden" name="role_id" id="role_id" value="1" />
                                    <?php
                                }
                                ?>   
                                <?php
                                if ($arr_admin_detail['role_id'] != 1) {
                                    ?>
                                    <br>                                
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Change Status :<em>*</em><br>Role</label>
                                        <div class="col-sm-9">
                                            <select id="user_status" name="user_status" class="form-control" >
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
                                } else {
                                    ?>
                                    <input type="hidden" name="user_status" id="user_status" value="1" />
                                    <?php
                                }
                                ?>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Profile Pic: <em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="file"  id="upload_profile_photo" name="upload_profile_photo" onchange="showimagepreviews(this);
                                                readURL(this);" />
                                        <input type="hidden"  id="old_pic" name="old_pic" value="<?php echo $arr_admin_detail['profile_picture']; ?>" />
                                        <?php
                                        $abs_path = $this->common_model->absolutePath();
                                        $picture = "";
                                        $user_photo = ($arr_admin_detail['profile_picture'] != "" && file_exists($abs_path . 'media/backend/images/admin_user/' . $arr_admin_detail['profile_picture'])) ? base_url() . 'media/backend/images/admin_user/' . $arr_admin_detail['profile_picture'] : base_url() . 'media/front/UI-1-media/img/login-prof.png';
                                        ?>
                                        <img id="blah"height="80" width="100" src="<?php echo $user_photo ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                   <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/admin/list';" >Back</button>
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
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>
<script>
    function showimagepreviews(input) {
        var file_name = input.files[0]['name'];
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
                $('#upload_profile_photo').replaceWith($('#upload_profile_photo').val('').clone(true));
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
