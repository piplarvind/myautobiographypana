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


        function changeAlbumStatus(album_id, album_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.album_id = album_id;
            obj_params.album_status = album_status;
            jQuery.post("<?php echo base_url(); ?>backend/gallery/change-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the Active and Inactive div of user*/
                    if (album_status == '0')
                    {
                        $("#inactive_div" + album_id).css('display', 'inline-block');
                        $("#active_div" + album_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + album_id).css('display', 'inline-block');
                        $("#inactive_div" + album_id).css('display', 'none');
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
            <h1>Manage Gallery</h1>
            <div class="widget-head">
<!--                <a style="float:right;" href="<?php echo base_url(); ?>backend/add-advertise/" class="btn btn-plus btn-round" title="Add new Advertise">
                    <button class="btn btn-primary">Add new Advertise</button>
                </a>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form  class="form-horizontal" name="frm_gallery" id="frm_gallery" action="<?php echo base_url(); ?>backend/manage-gallery" method="post">
                    <!-- Data table -->
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap"><center>Select </center></th>
                        <th width="8%" class="workcap">User Name</th>
                        <th width="8%" class="workcap">Album Name</th>
                        <th width="6%" class="workcap">Status</th>   
                        <th width="15%" class="workcap">Created on</th>                    
                        <th width="5%" class="workcap" align="center">Action</th>
                        </thead>
                        <tfoot>
                            <tr>
                        <th width="7%" class="workcap"><center>Select </center></th>
                        <th width="8%" class="workcap">User Name</th>
                        <th width="8%" class="workcap">Album Name</th>
                        <th width="6%" class="workcap">Status</th>   
                        <th width="15%" class="workcap">Created on</th>                    
                        <th width="5%" class="workcap" align="center">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (count($arr_user_gallery) > 0) {
                                foreach ($arr_user_gallery as $user_gallery) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $user_gallery['album_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($user_gallery['first_name']) . " " . stripslashes($user_gallery['last_name']); ?></td>
                                <td class="worktd"  align="left"><?php echo stripslashes($user_gallery['album_name']); ?></td>
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $user_gallery['album_id']; ?>"  <?php if ($user_gallery['album_status'] == "1") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeAlbumStatus('<?php echo $user_gallery['album_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $user_gallery['album_id']; ?>">Active</a>
                                    </div>
                                    <div id="inactive_div<?php echo $user_gallery['album_id']; ?>" <?php if ($user_gallery['album_status'] == "0") { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeAlbumStatus('<?php echo $user_gallery['album_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $user_gallery['album_id']; ?>">Inactive</a>
                                    </div>
                                </td>
                                <td class="worktd"  align="left">
                                    <?php echo date($global['date_format'], strtotime($user_gallery['created_date'])); ?>
                                </td>
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit" href="<?php echo base_url(); ?>backend/edit-gallery/<?php echo ($user_gallery['album_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit</a>
        <!--                                    <a class="btn btn-success" title="Preview" href="<?php echo base_url(); ?>backend/view-gallery/<?php echo ($user_gallery['album_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Preview</a>-->
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
            </div>
        </div>
    </div>
</div>












