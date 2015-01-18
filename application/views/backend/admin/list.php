<div class="st-content" id="content">
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
        <?php
    }
    ?> 
    <script src="<?php echo base_url(); ?>media/backend/js/select-all-delete.js"></script> 
    <script type="text/javascript">


        function changeStatus(user_id, user_status)
                {
                /* changing the user status*/
                var obj_params = new Object();
                        obj_params.user_id = user_id;
                        obj_params.user_status = user_status;
                        jQuery.post("<?php echo base_url(); ?>backend/admin/change-status", obj_params, function (msg) {
                        if (msg.error == "1")
                        {
                        alert(msg.error_message);
                        }
                        else
                        {
                        /* toogling the bloked and active div of user*/
                        if (user_status == 2)
                        {
                        $("#blocked_div" + user_id).css('display', 'inline-block');
                                $("#active_div" + user_id).css('display', 'none');
                        }
                        else
                        {
                        $("#active_div" + user_id).css('display', 'inline-block');
                                $("#blocked_div" + user_id).css('display', 'none');
                        }
                        }
                        }, "json");
                }

function deleteAll()
        {
            var delete_all = 0;
            jQuery('.case').each(function () {
                if (this.checked) {
                    delete_all= 1;
                }
            });

            if (!delete_all) {
                alert("Please select atleast one record to delete.");
                return false;
            }
            else {
                var status = confirm("Do you really want to delete this record?");
                if (status)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    </script>
    
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Super Admin Management</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/admin/add" class="btn btn-plus btn-round" title="Add Admin User">
                    <button class="btn btn-primary">Add Super Admin</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    
                </div>
                <form  class="form-horizontal" name="frm_admin_users" id="frm_admin_users" action="<?php echo base_url(); ?>backend/admin/list" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_admin_list) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>
                        <th width="8%" class="workcap">Username</th>
                        <th width="12%" class="workcap">First Name</th>
                        <th width="12%" class="workcap">Last Name</th>
                        <th width="10%" class="workcap">Email Id</th>   
                        <th width="10%" class="workcap">Role</th>   
                        <th width="6%" class="workcap">Status</th>   
                        <th width="10%" class="workcap">Created on</th>                    
                        <th width="30%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>

                                <th width="8%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Username</th>
                                <th width="12%" class="workcap">First Name</th>
                                <th width="12%" class="workcap">Last Name</th>
                                <th width="10%" class="workcap">Email Id</th>   
                                <th width="10%" class="workcap">Role</th>   
                                <th width="6%" class="workcap">Status</th>   
                                <th width="10%" class="workcap">Created on</th>                    
                                <th width="30%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_admin_list) > 0) {
                                foreach ($arr_admin_list as $admin) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                            <?php
                                            if ($admin['role_id'] != 1) {
                                                ?>
                                    <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $admin['user_id']; ?>" /></center>
                                    <?php
                                }
                                ?>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($admin['user_name']); ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($admin['first_name']); ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($admin['last_name']); ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($admin['user_email']); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo stripslashes($admin['role_name']); ?></td>                                    
                                <td class="worktd"  align="left">
                                    <?php
                                    if ($admin['role_id'] != 1) {
                                        if ($admin['user_status'] == 0) {
                                            ?>
                                            <div>
                                                <a style="cursor:default;" class="label label-warning" href="javascript:void(0);" id="status_<?php echo $admin['user_id']; ?>">Inactive</a>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div id="active_div<?php echo $admin['user_id']; ?>"  <?php if ($admin['user_status'] == 1) { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                                <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $admin['user_id']; ?>', 2);" href="javascript:void(0);" id="status_<?php echo $admin['user_id']; ?>">Active</a>
                                            </div>
                                            <div id="blocked_div<?php echo $admin['user_id']; ?>" <?php if ($admin['user_status'] == 2) { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                                <a class="label label-warning" title="Click to Change Status" onClick="changeStatus('<?php echo $admin['user_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $admin['user_id']; ?>">Blocked</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    } else {
                                        ?>
                                        <div id="active_div">
                                            <a class="label label-success" style="cursor:default;" title="" href="javascript:void(0);" id="status">Active</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="worktd"  align="left">
                                    <?php echo date($global['date_format'], strtotime($admin['register_date'])); ?>
                                </td>
                                <td class="worktd">
                                    <?php
                                    if ($admin['role_id'] == 1) {
                                        $user_account = $this->session->userdata('user_account');
                                        if ($admin['user_id'] == $user_account['user_id']) {
                                            ?>
                                            <a class="btn btn-info" title="Edit Admin User Details" href="<?php echo base_url(); ?>backend/admin/edit/<?php echo base64_encode($admin['user_id']); ?>">
                                                <i class="icon-edit icon-white"></i>Edit</a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a class="btn btn-info" title="Edit Admin User Details" href="<?php echo base_url(); ?>backend/admin/edit/<?php echo base64_encode($admin['user_id']); ?>">
                                            <i class="icon-edit icon-white"></i>Edit</a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <?php
                        if (count($arr_admin_list) > 1) {
                            ?>
                            <tfoot>
                            <th colspan="9"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
                            </tfoot>
                            <?php
                        }
                        ?> 
                    </table>
                    <!-- // Data table -->
                </form>
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












