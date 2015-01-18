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
        $(document).ready(function (e) {
            $('#btn_cancel').click(function () {
                window.location = "<?php echo base_url(); ?>backend/newsletter/list";
            });

            jQuery("#frm_send_newsletter").validate({
                errorElement: 'div',
                errorClass: 'validationError',
                rules: {
                    input_subject: {
                        required: true,
                        minlength: 3
                    },
                    user_status: {
                        required: true
                    }
                },
                messages: {
                    input_subject: {
                        required: "Please enter newsletter subject.",
                        minlength: "Please enter at least 3 characters."
                    },
                    user_status: {
                        required: "Please select user type to send newsletter."
                    }
                },
                // set this class to error-labels to indicate valid fields
                success: function (label) {
                    // set &nbsp; as text for IE
                    label.hide();
                }
            });

            $.cleditor.buttons.image.uploadUrl = '<?php echo base_url(); ?>backend/newsletter/upload-cleditor-image';
            jQuery(".cleditor").cleditor();
        });
        function display_list_div()
        {
            var type = $("#type").val();
            var user_status = $("#user_status").val();

            if ($("#user_list").val() == "none")
            {
                $("#for_list").css("display", "none");
            }
            else
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>backend/get-all-users",
                    type: "post",
                    data: {'user_status': user_status},
                    success: function (msg)
                    {
                        $("#for_list").css("display", "block");
                        $("#list_of_users").html(msg);
                        $("#button_submit").css("display", "block");
                    }
                });
            }
        }

        function SendNewsletter()
        {
            var send_num = 0;
            jQuery('.case').each(function () {
                if (this.checked) {
                    send_num = 1;
                }
            });

            if (!send_num) {
                alert("Please select atleast one record to send newsletter");
                return false;
            }
            else {
                var status = confirm("Do you really want to send newsletter?");
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
    <style type="text/css">
        .validationError{
            color: #ff0000;
        }            
    </style>
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Send Newsletter</h1>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <div>
                    <input type="hidden" value="<?php echo $email_template[0]['newsletter_subject']; ?>" title="Subject" data-rel="tooltip" name="input_subject" id="input_subject" />
                </div>
                <form class="form-horizontal" name="frm_send_newsletter" id="frm_send_newsletter" action="<?php echo base_url(); ?>backend/newsletter/send-newsletter/<?php echo $newsletter_id; ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="subject" value="<?php echo $email_template[0]['newsletter_subject']; ?>" />
                    <input type="hidden" name="newsletter_id" value="<?php echo $email_template[0]['newsletter_id']; ?>" />

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
                        <th width="8%" class="workcap">First Name</th>
                        <th width="12%" class="workcap">Last Name</th>
                        <th width="12%" class="workcap">Email ID</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="8%" class="workcap">First Name</th>
                                <th width="12%" class="workcap">Last Name</th>
                                <th width="12%" class="workcap">Email ID</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_user_list) > 0) {
                                foreach ($arr_user_list as $user) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $user['user_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($user['first_name']); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo stripslashes($user['last_name']); ?></td>                                    
                                <td class="worktd"  align="left"><?php echo stripslashes($user['user_email']); ?></td>                                    
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <?php
                        if (count($arr_user_list) > 0) {
                            ?>
                        <tfoot>
                        <th colspan="4"><input type="submit" name="send_nessletter" id="send_nessletter" onClick="return SendNewsletter();" class="btn btn-info" value="Send"> <input type="button" name="btn_cancel" id="btn_cancel" onclick="window.history.go(-1)"  class="btn btn-danger" value="Cancel"></th>
                        </tfoot>
                         <?php } ?> 
                    </table>
                </form>
            </div>
            <div class="footer">
              <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>