<?php
$session = $this->session->set_userdata('parent_id', $parent_id);
$this->session->set_userdata('category', $category);
?>

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
        $(document).ready(function () {
            $('#check_all').click(function (event) {  //on click 
                if (this.checked) { // check select status
                    $('.checkbox8').each(function () { //loop through each checkbox
                        this.checked = true;  //select all checkboxes with class "checkbox1"               
                    });
                } else {
                    $('.checkbox8').each(function () { //loop through each checkbox
                        this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                    });
                }
            });

        });
    </script>
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
            <h1>Manage Interest</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/category/list/3" class="btn btn-plus btn-round" title="Back">
                    <button class="btn btn-danger">Back</button>
                </a>
            </div>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/categories/add-interest/<?php echo base64_encode("18"); ?>" class="btn btn-plus btn-round" title="Back">
                    <button class="btn btn-success">Add Interest</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form name="frm_list_interest"  class="form-horizontal" id="frm_list_interest" action="<?php echo base_url(); ?>backend/categories/list-interest/<?php echo base64_encode($parent_id) ; ?>" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                            <center>Select <br></center>
                        </th>
                        <th width="30%" class="workcap">Interest Name</th>
                        <th width="20%" class="workcap">Interest Image</th>
                        <th width="25%" class="workcap">Interest Title</th>
                        <th width="20%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                                <th width="5%" class="workcap">Select</th>
                                <th width="30%" class="workcap">Interest Name</th>
                                <th width="20%" class="workcap">Interest Image</th>
                                <th width="25%" class="workcap">Interest Title</th>
                                <th width="20%" class="workcap" align="center">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_categories) > 0) {
                                foreach ($arr_categories as $cat_val) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" value="<?php echo $cat_val['category_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"> <?php if ($arr_interests["category_id"] == $cat_val['category_id'] && $arr_interests["category_name"] == $cat_val["category_name"]) { ?><a href="<?php echo base_url(); ?>backend/categories/add-interest/<?php echo base64_encode($cat_val['category_id']); ?>" title="Add Interest"><?php echo stripslashes($cat_val['category_name']); ?></a> <?php } else { ?><a href="<?php echo base_url(); ?>backend/categories/view-timeline/<?php echo base64_encode($cat_val['category_id']); ?>/<?php echo $parent_id; ?>" title="View Timeline"><?php echo stripslashes($cat_val['category_name']); ?></a> <?php } ?></td>                                    
                                <td class="worktd"  align="left"><img src="<?php echo base_url() ?>media/front/img/category-images/thumbs-for-backend/<?php echo $cat_val['category_image'] ?>"></td>                                    
                                <td class="worktd"  align="left"><?php echo stripslashes($cat_val['page_title']); ?></td>                                    
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Interest" href="<?php echo base_url(); ?>backend/categories/edit-interest/<?php echo base64_encode($cat_val['category_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
                                    <a class="btn btn-success" title="Post New Timeline" href="<?php echo base_url(); ?>backend/categories/post-for-timeline/<?php echo base64_encode($cat_val['category_id']); ?>/<?php echo $parent_id; ?>">
                                        <i class="icon-edit icon-white"></i>Post For Timeline</a>
                                </td>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <th colspan="5"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
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








<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

