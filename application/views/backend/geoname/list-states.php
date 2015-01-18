
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


        function changeStateStatus(state_id, state_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.state_id = state_id;
            obj_params.state_status = state_status;
            jQuery.post("<?php echo base_url(); ?>backend/states/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the Active and Inactive div of user*/
                    if (state_status == '0')
                    {
                        $("#inactive_div" + state_id).css('display', 'inline-block');
                        $("#active_div" + state_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + state_id).css('display', 'inline-block');
                        $("#inactive_div" + state_id).css('display', 'none');
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
            <h1>Manage States</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-states" class="btn btn-plus btn-round" title="Add States">
                    <button class="btn btn-primary">Add State</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                   
                </div>
                <form class="form-horizontal" name="frm_states" id="frm_states" action="<?php echo base_url(); ?>backend/manage-states" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_states) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>

                        <th width="8%" class="workcap">Country</th>
                        <th width="10%" class="workcap">State</th>
                        <th width="12%" class="workcap">Status</th>
                        <th width="30%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Country</th>
                                <th width="10%" class="workcap">State</th>
                                <th width="12%" class="workcap">Status</th>
                                <th width="30%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_states) > 0) {
                                foreach ($arr_states as $states) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $states['geoname_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo $states['country_name']; ?></td>                                    
                                <td class="worktd"  align="left"><?php echo $states['geoname']; ?></td>                                    
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $states['geoname_id']; ?>"  <?php if ($states['status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeStateStatus('<?php echo $states['geoname_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $states['geoname_id']; ?>">Active</a>
                                    </div>
                                    <div id="inactive_div<?php echo $states['geoname_id']; ?>" <?php if ($states['status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeStateStatus('<?php echo $states['geoname_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $states['geoname_id']; ?>">Inactive</a>
                                    </div>
                                </td>
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit State" href="<?php echo base_url(); ?>backend/edit-states/<?php echo base64_encode($states['geoname_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <th colspan="5"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
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
