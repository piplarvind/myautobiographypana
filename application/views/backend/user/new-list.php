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
            jQuery.post("<?php echo base_url(); ?>backend/user-a/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the bloked and active div of user*/
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


        function alert_delete(user_id)
        {
            var user_id = user_id;
            var status = confirm("Do you really want to delete this user?");
            if (status)
            {
                window.location = '<?php echo base_url(); ?>backend/user-a/delete-user/' + user_id;
                return true;
            }
            else
            {
                return false;
            }
        }


        function deleteAll()
        {
            var delete_all = 0;
            jQuery('.case').each(function () {
                if (this.checked) {
                    delete_all = 1;
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
            <h1>Manage New User</h1>
            <div class="widget-head">
<!--                <a style="float:right;" href="<?php echo base_url(); ?>backend/user-a/add" class="btn btn-plus btn-round" title="Add New User A">
                    <button class="btn btn-primary">Add User A</button>
                </a>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    </div>
                <form name="frm_new_users" id="frm_new_users" action="<?php echo base_url(); ?>backend/new-user/list" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_user_list) > 0) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>
                        <th width="8%" class="workcap">Send By</th>
                        <th width="12%" class="workcap">First Name</th>
                        <th width="12%" class="workcap">Last Name</th>
                        <th width="10%" class="workcap">Email Id</th>   
                        <th width="10%" class="workcap">Created on</th>                    
                        <th width="25%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>

                                <th width="8%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Send By</th>
                                <th width="12%" class="workcap">First Name</th>
                                <th width="12%" class="workcap">Last Name</th>
                                <th width="10%" class="workcap">Email Id</th>   
                                <th width="10%" class="workcap">Created on</th>                    
                                <th width="25%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                                    <?php
                                    if (count($arr_user_list) > 0) {
                                        foreach ($arr_user_list as $user) {
                                            ?>
                                            <tr>
                                        <td class="worktd" align="left">
                                            <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $user['temp_id']; ?>" /></center>
                                        </td>
                                        <td class="worktd"  align="left"><?php echo stripslashes($user['user_name']); ?></td>
                                        <td class="worktd"  align="left"><?php echo stripslashes($user['first_name']); ?></td>
                                        <td class="worktd"  align="left"><?php echo stripslashes($user['last_name']); ?></td>
                                        <td class="worktd"  align="left"><?php echo stripslashes($user['user_email']); ?></td>                                    
                                        <td class="worktd"  align="left">
                                            <?php echo date($global['date_format'], strtotime($user['date_time'])); ?>
                                        </td>
                                        <td class="worktd">
                                            <a class="btn btn-info" title="Send Activation Link" href="<?php echo base_url(); ?>backend/new-user/send-activation/<?php echo base64_encode($user['temp_id']); ?>">
                                                <input name="checkbox[]" class="case" type="hidden" id="checkbox[]" value="<?php echo $user['temp_id']; ?>" />
                                                <i class="icon-edit icon-white"></i><?php if($user['send_link'] == '0'){ ?>Send Activation Link<?php }else{ ?>Resend Activation Link<?php }?>
                                            </a>
                                        </td>
                                        
                                    <?php }
                                }
                                ?>
                        </tbody>
                        <tfoot>
                        <th colspan="7"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
                        </tfoot>
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












