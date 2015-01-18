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


        function changeInterestStatus(interest_id, interest_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.interest_id = interest_id;
            obj_params.interest_status = interest_status;
            jQuery.post("<?php echo base_url(); ?>backend/interest/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the Active and Inactive div of user*/
                    if (interest_status == '0')
                    {
                        $("#inactive_div" + interest_id).css('display', 'inline-block');
                        $("#active_div" + interest_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + interest_id).css('display', 'inline-block');
                        $("#inactive_div" + interest_id).css('display', 'none');
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
            <h1> Manage Email Templates</h1>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form  class="form-horizontal" name="frm_interest" id="frm_interest" action="<?php echo base_url(); ?>backend/manage-interest" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="8%" class="workcap">Title</th>
                        <th width="8%" class="workcap">Subject</th>
                        <th width="12%" class="workcap">Updated on</th>
                        <th width="15%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="22%" class="workcap">Title</th>
                                <th width="22%" class="workcap">Subject</th>
                                <th width="22%" class="workcap">Updated on</th>
                                <th width="15%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_email_templates) > 0) {
                                foreach ($arr_email_templates as $email_template) {
                                    ?>
                                    <tr>

                                        
                                <td class="worktd"  align="left"><?php echo ucwords(str_replace("-"," ",$email_template['email_template_title'])); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo $email_template['email_template_subject']; ?></td>                                    
                                <td class="worktd"  align="left"><?php echo date($global['date_format'],strtotime($email_template['date_updated'])); ?></td>                                    
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Email Template" href="<?php echo base_url();?>backend/edit-email-template/<?php echo $email_template['email_template_id']; ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
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










