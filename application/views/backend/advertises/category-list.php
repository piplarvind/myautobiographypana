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
            <h1>Manage Advertise Categories</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-advertise-category" class="btn btn-plus btn-round" title="Add Advertise Category">
                    <button class="btn btn-primary">Add Advertise Category</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    Bootstrap Datatables
                </div>
                <form  class="form-horizontal" name="frm_ad_category" id="frm_ad_category" action="<?php echo base_url(); ?>backend/advertise-categories" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <center>Select</center>
                        </th>
                        <th width="12%" class="workcap">Category Name</th>
                        <th width="12%" class="workcap">Category Status</th>
                        <th width="30%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                        <tr>
                            <th width="8%" class="workcap">Select</th>
                            <th width="12%" class="workcap">Category Name</th>
                            <th width="12%" class="workcap">Category Status</th>
                            <th width="30%" class="workcap" align="center">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                           <?php
                                if (count($arr_ads_categories) > 0) {
                                    foreach ($arr_ads_categories as $category) {
                                        $cnt++;
                                        ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $category['category_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo $category['category_name']; ?></td>
                                <td class="worktd"  align="left">
                                   <?php
                                if ($category['status'] == 'Active')
                                    echo '<a class="label label-success" href="' . base_url() . 'backend/change-advertise-category-status/' . ($category['category_id']) . '/Inactive">Active</a>';
                                else
                                    echo '<a class="label label-warning" href="' . base_url() . 'backend/change-advertise-category-status/' . ($category['category_id']) . '/Active">Inactive</a>';
                                        ?>
                                </td>
                               
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit" href="<?php echo base_url(); ?>backend/add-advertise-category/<?php echo ($category['category_id']); ?>">
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
                </form>
            </div>
            <div class="footer">
                <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>












