
<style type="text/css">
    .error {
        color: #bd4247;
    }
       .validationError{
                color: #bd4247;
            }  
</style>

<script type="text/javascript" >
    var j = jQuery.noConflict();
    j(document).ready(function(e) {
        j("#frm_role").validate({
            errorElement: "div",
             errorClass: 'validationError',
            errorPlacement: function(label, element) {
                if (element[0].name == "role_privileges[]")
                {
                    $("#role_error").html(label);
                }
                else
                {
                    label.insertAfter(element);
                }
            },
            rules: {
                role_name: {
                    required: true,
                    remote: {
                        url: jQuery('#base_url').val() + 'backend/chk-role-name',
                        type: 'post',
                        data: {old_role_name: jQuery('#old_role_name').val()}
                    }
                },
                "role_privileges[]": {
                    required: true
                }
            },
            messages: {
                role_name: {
                    required: "Please enter role name.",
                    remote: "This role name already exist.",
                },
                "role_privileges[]": {
                    required: "Please select atleast one privileges."
                }
            }
        });
    });
</script>
<div class="st-content" id="content">
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1><?php echo ((isset($edit_id) && $edit_id != "") ? "Edit" : "Add"); ?> Role</h1>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form name="frm_role" class="form-horizontal" id="frm_role" action="<?php echo base_url(); ?>backend/role/add" method="POST" >
                                <?php
                                if (isset($edit_id) && $edit_id != '') {
                                    ?>
                                    <input type="hidden" name="frm_type" id="frm_type" value="edit" />
                                    <input type="hidden" name="old_role_name" id="old_role_name" value="<?php
                                    if (isset($arr_role['role_name'])) {
                                        echo str_replace('"', '&quot;', stripslashes($arr_role['role_name']));
                                    }
                                    ?>" />
                                           <?php
                                       } else {
                                           ?>
                                    <input type="hidden" name="frm_type" id="frm_type" value="add" />	
                                    <input type="hidden" name="old_role_name" id="old_role_name" value="" />
                                    <?php
                                }
                                ?>
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Role Name :<em>*</em></label>
                                    <div class="col-sm-5">
                                        <input type="text" value="<?php
                                        if (isset($arr_role['role_name'])) {
                                            echo stripslashes($arr_role['role_name']);
                                        }
                                        ?>" id="role_name" name="role_name" class="form-control" >
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="col-sm-3 control-label" >&nbsp Choose Role Privileges :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <?php foreach ($arr_privileges as $key => $privilege) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="role_privileges[]" id="role_privileges" value="<?php echo $privilege['privileges_id'] ?>"  <?php
                                                    if (isset($edit_id) && $edit_id != '') {
                                                        if (in_array($privilege['privileges_id'], $arr_role_privileges)) {
                                                            ?> checked="checked" <?php
                                                               }
                                                           }
                                                           ?> > 
                                                           <?php echo ucwords($privilege['privilege_name']); ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                        <div id="role_error"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"  ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/role/list';" >Back</button>
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