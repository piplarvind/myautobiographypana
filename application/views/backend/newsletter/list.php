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
        function changeStatus(newsletter_id, newsletter_status)
        {
            /* changing the newsletter status*/
            var obj_params = new Object();
            obj_params.newsletter_id = newsletter_id;
            obj_params.newsletter_status = newsletter_status;
            jQuery.post("<?php echo base_url(); ?>backend/newsletter/change-status", obj_params, function (msg) {
                alert(msg.error_message);
                document.location.reload();
            }, "json");
        }


        function alert_delete(user_id)
        {
            var user_id = user_id;
            var status = confirm("Do you really want to delete this record?");
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


        function deleteAll() {

            if (jQuery(".checkbox:checked").length == "0")
            {
                alert("Please select atleast one record to delete");
                return;
            }

            if (confirm("Are you sure to delete these record ?"))
            {
                var arrCatIds = [];

                jQuery(".case").each(function (index, element) {

                    if (jQuery(element).is(":checked"))
                        arrCatIds.push(jQuery(element).val());

                });

                var objParams = new Object();
                objParams.user_ids = arrCatIds;

                jQuery.post("<?php echo base_url(); ?>backend/user/delete-user", objParams, function (msg) {
                    if (msg.error == "1")
                    {
                        alert(msg.errorMessage);
                    }
                    else
                    {
                        alert("Your request has been completed successfully!");
                        location.href = location.href;
                    }
                }, "json");
            }
        }
    </script>

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Manage Newsletter</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/newsletter/add" class="btn btn-plus btn-round" title="Add Newsletter">
                    <button class="btn btn-primary">Add Newsletter</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                    <form name="frm_newsletter" id="frm_newsletter" action="<?php echo base_url(); ?>backend/newsletter/list" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <center> Select <br></center>
                        </th>
                        <th width="12%" class="workcap">Subject</th>
                        <th width="7%" class="workcap">Status</th>
                        <th width="12%" class="workcap">Created on</th>
                        <th width="12%" class="workcap">Updated on</th>
                        <th width="10%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="12%" class="workcap">Subject</th>
                                <th width="7%" class="workcap">Status</th>
                                <th width="12%" class="workcap">Created on</th>
                                <th width="12%" class="workcap">Updated on</th>
                                <th width="10%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_newsletter_list) > 0) {
                                foreach ($arr_newsletter_list as $newsletter) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $newsletter['newsletter_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($newsletter['newsletter_subject']); ?></td>                                    
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $newsletter['newsletter_id']; ?>"  <?php if ($newsletter['newsletter_status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $newsletter['newsletter_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $newsletter['newsletter_id']; ?>">Active</a>
                                    </div>
                                    <div id="inactive_div<?php echo $newsletter['newsletter_id']; ?>" <?php if ($newsletter['newsletter_status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeStatus('<?php echo $newsletter['newsletter_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $newsletter['newsletter_id']; ?>">Inactive</a>
                                    </div>
                                </td>
                                <td class="worktd"  align="left">  <?php echo date($global['date_format'], strtotime($newsletter['add_date'])); ?></td>                                    
                                <td class="worktd"  align="left">   <?php echo ($newsletter['update_date'] != '0000-00-00') ? date($global['date_format'], strtotime($newsletter['update_date'])) : 'Not Updated'; ?></td>

                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Newsletter" href="<?php echo base_url(); ?>backend/newsletter/edit/<?php echo $newsletter['newsletter_id']; ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                    <?php if ($newsletter['newsletter_status'] == 1) { ?>
                                        <a class="btn btn-success" title="Send Newsletter" href="<?php echo base_url(); ?>backend/newsletter/send-newsletter/<?php echo $newsletter['newsletter_id']; ?>">
                                            <i class="icon-edit icon-white"></i>Send</a>
                                    <?php } ?>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <th colspan="7"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="footer">
               <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>










