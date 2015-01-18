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
            <h1>Manage Advertise</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-advertise/" class="btn btn-plus btn-round" title="Add new Advertise">
                    <button class="btn btn-primary">Add new Advertise</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    Bootstrap Datatables
                </div>
                <form  class="form-horizontal" name="frm_advertise" id="frm_advertise" action="<?php echo base_url(); ?>backend/advertises" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">

                        <center>Select</center>

                        </th>
                        <th width="8%" class="workcap">Title</th>
                        <th width="6%" class="workcap">Type</th>
                        <th width="6%" class="workcap">Status</th>   
                        <th width="10%" class="workcap">Created on</th>                    
                        <th width="15%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="8%" class="workcap">Select</th>
                                <th width="8%" class="workcap">Title</th>
                                <th width="6%" class="workcap">Type</th>
                                <th width="6%" class="workcap">Status</th>   
                                <th width="10%" class="workcap">Created on</th>                    
                                <th width="15%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_adverties) > 0) {
                                foreach ($arr_adverties as $advertise) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $advertise['advertise_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo $advertise['title']; ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($advertise['advertise_type']); ?></td>
                                <td class="worktd"  align="left">
                                    <?php
                                    if ($advertise['status'] == 'Active')
                                        echo '<a class="label label-success" href="' . base_url() . 'backend/change-advertise-status/' . ($advertise['advertise_id']) . '/Inactive">Active</a>';
                                    else
                                        echo '<a class="label label-warning" href="' . base_url() . 'backend/change-advertise-status/' . ($advertise['advertise_id']) . '/Active">Inactive</a>';
                                    ?>
                                </td>
                                <td class="worktd"  align="left">
                                    <?php echo date($global['date_format'], strtotime($advertise['created_on'])); ?>
                                </td>
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit" href="<?php echo base_url(); ?>backend/edit-advertise/<?php echo ($advertise['advertise_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                    <a class="btn btn-success" title="Preview" href="<?php echo base_url(); ?>backend/preview-advertise/<?php echo ($advertise['advertise_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Preview</a>
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <th colspan="6"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
                        </tfoot>
                    </table>
                </form>
            </div>
            <div class="footer">
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>












