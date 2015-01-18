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

        function changeStatus(comments_id, comments_status)
        {
            /* changing the user status*/
            var obj_params = new Object();
            obj_params.comments_id = comments_id;
            obj_params.comments_status = comments_status;
            jQuery.post("<?php echo base_url(); ?>backend/categories/comments-status", obj_params, function (msg) {
                if (msg.error == "1")
                {
                    alert(msg.error_message);
                }
                else
                {
                    /* togling the bloked and active div of user*/
                    if (comments_status == '0')
                    {
                        $("#blocked_div" + comments_id).css('display', 'inline-block');
                        $("#active_div" + comments_id).css('display', 'none');
                    }
                    else
                    {
                        $("#active_div" + comments_id).css('display', 'inline-block');
                        $("#blocked_div" + comments_id).css('display', 'none');
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
            <h1>View Timeline Comments</h1>
            <div class="widget-head">
                <a style="float:right;" href="<?php echo base_url(); ?>backend/categories/view-timeline/<?php echo $category_id; ?>/<?php echo $parent_id; ?>"  class="btn btn-plus btn-round" title="Back">
                    <button class="btn btn-danger">Back</button>
                </a>
                <a style="float:right;" href="<?php echo base_url(); ?>backend/categories/add-timeline-comment/<?php echo $timeline_id; ?>" class="btn btn-plus btn-round" title="Add Comment">
                    <button class="btn btn-success">Add Comment</button>
                </a>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                </div>
                <form name="frm_timeline_comments"  class="form-horizontal" id="frm_timeline_comments" action="<?php echo base_url(); ?>backend/categories/view-comments/<?php echo $timeline_id; ?>" method="post">
                    <table id="data-table" class="table" cellspacing="0" width="100%">
                        <thead>
                        <th width="7%" class="workcap">
                           
                            <center>Select </center>
                                     
                        </th>
                        <th width="15%" class="workcap"> Commented By</th>
                        <th width="15%" class="workcap">Comment</th>
<!--                        <th width="15%" class="workcap">Comment Type</th>
                        <th width="15%" class="workcap">Comment Media</th>-->
                        <th width="15%" class="workcap">Status</th>
                        <th width="15%" class="workcap">Commented On</th>
                        <th width="20%" class="workcap" align="center">Action</th>
                        </thead>
                        <tbody>
                            <?php
                            if (count($arr_timeline_comments) > 0) {
                                foreach ($arr_timeline_comments as $timeline_comments) {
                                    ?>
                                    <tr>
                                        <td class="worktd" align="left">
                                <center><input name="checkbox[]" class="case" type="checkbox" id="checkbox[]" value="<?php echo $timeline_comments['comments_id']; ?>" /></center>
                                </td>
                                <td class="worktd"  align="left"><?php echo stripslashes($timeline_comments["first_name"] . " " . $timeline_comments["last_name"]); ?></td>                                    
                                <td class="worktd"  align="left"><?php
                                    echo substr(stripslashes($timeline_comments["comments"]), 0, 30);
                                    if (strlen($timeline_comments["comments"]) >= 30) {
                                        echo "...";
                                    }
                                    ?></td>  
                                <?php /* ?>
                                <td class="worktd"  align="left">
                                    <?php
                                    if ($timeline_comments["comments_media_type"] == "0") {
                                        echo "Image";
                                    } else if ($timeline_comments["comments_media_type"] == "1") {
                                        echo "Video";
                                    } else {
                                        echo "---";
                                    }
                                    ?>
                                </td>                                    
                                <td class="worktd"  align="left"><?php if ($timeline_comments["comments_media_type"] == "0") { ?><img src="<?php echo base_url() ?>media/front/img/post-images/thumbs/<?php echo $timeline_comments['comments_media_path'] ?>"> <?php } else if ($timeline_comments["comments_media_type"] == "1") { ?> <img src="<?php echo base_url() ?>media/front/img/post-video/<?php echo $timeline_comments['comments_media_path'] ?>"><?php
                                    } else {
                                        echo "No Media";
                                    }
                                    ?></td>
                                
                                <?php */ ?>
                                <td class="worktd"  align="left">
                                    <div id="active_div<?php echo $timeline_comments['comments_id']; ?>"  <?php if ($timeline_comments['comments_status'] == 1) { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?>>
                                        <a class="label label-success" title="Click to Change Status" onClick="changeStatus('<?php echo $timeline_comments['comments_id']; ?>', 0);" href="javascript:void(0);" id="status_<?php echo $timeline_comments['comments_id']; ?>">Published</a>
                                    </div>
                                    <div id="blocked_div<?php echo $timeline_comments['comments_id']; ?>" <?php if ($timeline_comments['comments_status'] == 0) { ?> style="display:inline-block" <?php } else { ?> style="display:none;" <?php } ?> >
                                        <a class="label label-warning" title="Click to Change Status" onClick="changeStatus('<?php echo $timeline_comments['comments_id']; ?>', 1);" href="javascript:void(0);" id="status_<?php echo $timeline_comments['comments_id']; ?>">Unpublished</a>
                                    </div>
                                </td>                                    
                                <td class="worktd"  align="left"><?php echo date($global["date_format"], strtotime($timeline_comments["comments_posted_date"])); ?></td>                                    
                                <td class="worktd">
                                    <a class="btn btn-info" title="Edit Comment" href="<?php echo base_url(); ?>backend/categories/edit-timeline-comment/<?php echo base64_encode($timeline_comments['comments_id']); ?>">
                                        <i class="icon-edit icon-white"></i>Edit Comment</a>
                                </td>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <th colspan="8"><input type="submit" name="btn_delete_all" id="btn_delete_all" onClick="return deleteAll();" class="btn btn-danger" value="Delete Selected"></th>
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








