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
            <h1>Manage Notifications</h1>
            <!--            <div class="widget-head">
                            <a style="float:right;" href="<?php echo base_url(); ?>backend/admin/add" class="btn btn-plus btn-round" title="Add Admin User">
                                <button class="btn btn-primary">Add Super Admin</button>
                            </a>
                        </div>-->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">

                </div>
                <form  class="form-horizontal" name="frm_manage_notifications" id="frm_manage_notifications" action="<?php echo base_url(); ?>backend/admin/manage-notification" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_notification) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>
                        <th width="10%" class="workcap">Username</th>
                        <th width="25%" class="workcap">Subject</th>
                        <th width="15%" class="workcap">Message Date</th>                    
                        <th width="10%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="8%" class="workcap">Select</th>
                            <th width="10%" class="workcap">Username</th>
                            <th width="25%" class="workcap">Subject</th>
                            <th width="15%" class="workcap">Message Date</th>                    
                            <th width="10%" class="workcap" align="center">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_notification) > 0) {
                                foreach ($arr_notification as $notification) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                            <?php
                                            if ($notification['notifications_id'] != "") {
                                                ?>
                                    <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $notification['notifications_id']; ?>" /></center>
                                    <?php
                                }
                                ?>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($notification['user_name']); ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($notification['subject']); ?></td>
                                <td class="worktd"  align="left">
                                    <?php echo date($global['date_format'], strtotime($notification['message_date'])); ?>
                                </td>
                                <td class="worktd">
                                            <a class="btn btn- btn-danger" title="Delete Notification" href="<?php echo base_url(); ?>backend/admin/delete-notification/<?php echo base64_encode($notification['notifications_id']); ?>">
                                                <i class="icon-edit icon-white"></i>Delete</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <?php
                        if (count($arr_notification) > 0) {
                            ?>
                            <tfoot>
                            <th colspan="5"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
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
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>












