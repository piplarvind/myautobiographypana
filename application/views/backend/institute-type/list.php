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



        function changeInstituteStatus(institute_type_id, institute_type_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.institute_type_id = institute_type_id;
            obj_params.institute_type_status = institute_type_status;
            jQuery.post("<?php echo base_url(); ?>backend/institute-type/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the Active and Inactive div of user*/
                    if (institute_type_status == '0')
                    {
                        $("#inactive_div" + institute_type_id).css('display', 'inline-block');
                        $("#active_div" + institute_type_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + institute_type_id).css('display', 'inline-block');
                        $("#inactive_div" + institute_type_id).css('display', 'none');
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
            <h1> Manage Institute Type </h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-institute-type" class="btn btn-plus btn-round" title="Add Institute Type">
                    <button class="btn btn-primary">Add Institute Type</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form class="form-horizontal" name="frm_institute_type" id="frm_institute_type" action="<?php echo base_url(); ?>backend/manage-institute-type" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_institute_type) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>

                        <th width="8%" class="workcap">Institute Type</th>
                        <th width="12%" class="workcap">Status</th>
                        <th width="30%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Institute Type</th>
                                <th width="12%" class="workcap">Status</th>
                                <th width="30%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_institute_type) > 0) {
                                foreach ($arr_institute_type as $institute_type) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $institute_type['institute_type_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($institute_type['institute_type']); ?></td>                                    
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $institute_type['institute_type_id']; ?>"  <?php if ($institute_type['institute_type_status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeInstituteStatus('<?php echo $institute_type['institute_type_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $institute_type['institute_type_id']; ?>">Active</a>
                                    </div>
                                    <div id="inactive_div<?php echo $institute_type['institute_type_id']; ?>" <?php if ($institute_type['institute_type_status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeInstituteStatus('<?php echo $institute_type['institute_type_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $institute_type['institute_type_id']; ?>">Inactive</a>
                                    </div>
                                </td>
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Institute Type" href="<?php echo base_url(); ?>backend/edit-institute-type/<?php echo $institute_type['institute_type_id']; ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <th colspan="4"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
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










