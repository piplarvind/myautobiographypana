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
            <h1>Manage Other Interest </h1>

            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form name="frm_interest" id="frm_interest" action="<?php echo base_url(); ?>backend/manage-other-interest" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_other_interest) > 0) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>
                        <th width="8%" class="workcap">User Name</th>
                        <th width="8%" class="workcap">Interest</th>
                        <th width="12%" class="workcap">Status</th>
                        <!--<th width="20%" class="workcap" align="center">Action</th>-->
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="8%" class="workcap">User Name</th>
                                <th width="8%" class="workcap">Interest</th>
                                <th width="12%" class="workcap">Status</th>
                                <!--<th width="20%" class="workcap" align="center">Action</th>-->
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_other_interest) > 0) {
                                foreach ($arr_other_interest as $interest) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $interest['temp_interest_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($interest['first_name']) . " " . stripslashes($interest['last_name']); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo stripslashes($interest['comment']); ?></td>                                    
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $interest['temp_interest_id']; ?>"  <?php if ($interest['status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" href="javascript:void(0);" id="status_<?php echo $interest['temp_interest_id']; ?>">Approved</a>
                                    </div>
                                    <div id="inactive_div<?php echo $interest['temp_interest_id']; ?>" <?php if ($interest['status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status"  href="<?php echo base_url(); ?>backend/categories/add-interest/MTg=/<?php echo $interest['temp_interest_id'] ; ?>" id="status_<?php echo $interest['temp_interest_id']; ?>">Un Approved</a>
                                    </div>
                                </td>
<!--                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Interest" href="<?php echo base_url(); ?>backend/edit-interest/<?php echo $interest['temp_interest_id']; ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>-->
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
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
            <!-- // Footer -->
        </div>
    </div>
    <!-- /st-content-inner -->
</div>










