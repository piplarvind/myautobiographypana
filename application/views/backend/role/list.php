


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
            <h1> Manage Roles </h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url();?>backend/role/add" class="btn btn-plus btn-round" title="Add New Role">
                    <button class="btn btn-primary">Add new Role</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
		  <form name="frm_roles" class="form-horizontal" id="frm_roles" action="<?php echo base_url()?>backend/role/list" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <?php
                            if (count($arr_roles) > 1) {
                                ?>
                            <center>Select <br></center>
                            <?php
                        }
                        ?>               
                        </th>
                        <th width="50%" class="workcap">Role Name</th>
                        <th width="30%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="7%" class="workcap">Select</th>
                                <th width="50%" class="workcap">Role Name</th>
                                <th width="30%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_roles) > 0) {
                                foreach ($arr_roles as $roles) {
                                    ?>
                                    <tr>

                                        <td class="worktd" align="left">
                                            <?php
                                            if ($roles['role_id'] != 1) {
                                                ?>
                                    <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $roles['role_id']; ?>" /></center>
                                    <?php
                                }
                                ?>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($roles['role_name']); ?></td>                                    
                                
                                <td class="worktd">
                                    <?php 
				  	if($roles['role_id']!=1)
					{
				  ?>
                                    <a class="btn btn-info" title="Edit Role" href="<?php echo base_url();?>backend/role/edit/<?php echo base64_encode($roles['role_id']); ?>">
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










