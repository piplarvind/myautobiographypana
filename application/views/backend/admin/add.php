
<style type="text/css">
    .error {
        color: #bd4247;
    }
     .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/admin-manage/add-admin.js"></script>
<script>
    ("#btn_submit").click(function() {
        if ($('input[type=checkbox]:checked').length == 1)
        {
            alert('Please select atleast two checkbox');
        }
    });
</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Add Super Admin</h1>
            <div class="row">
                <div class="col-md-7">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form  class="form-horizontal" name="frm_admin_details" id="frm_admin_details" action="<?php echo base_url(); ?>backend/admin/add" method="POST" enctype="multipart/form-data">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Username :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" id="user_name" name="user_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >First Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="first_name" id="first_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Last Name :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="last_name" id="last_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Email Id :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="" name="user_email" id="user_email" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Password :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="user_password" name="user_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Confirm Password:<em>*</em></label>
                                    <div class="col-sm-9">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Gender :<em>*</em></label>
                                    <div class="col-sm-9"  >
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
                                    <label for="inputEmail3" class="col-sm-3 control-label"  >Choose Admin:<em>*</em><br>Role</label>
                                    <div class="col-sm-9">
                                        <select id="role_id" name="role_id"   class="form-control">
                                            <option value="">Select Role</option>
                                            <?php
                                            foreach ($arr_roles as $key => $role) {
                                                if ($role['role_id'] != 1) {
                                                    ?>
                                                    <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Profile Pic:<em>*</em> </label>
                                    <div class="col-sm-9">
                                        <input type="file"  id="upload_profile_photo" name="upload_profile_photo" onchange="showimagepreviews(this);readURL(this);" />
                                        <img id="blah" src="<?php echo base_url();?>media/front/UI-1-media/img/login-prof.png" height="100" width="80" alt="your image" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9"  >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/admin/list';" >Back</button>
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

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>





