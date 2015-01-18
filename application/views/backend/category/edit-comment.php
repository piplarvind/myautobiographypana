<style type="text/css">
    .error {
        color: #bd4247;
    }
     .validationError{
        color: #bd4247;
    }      
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/edit-timeline-comment.js"></script>
<div class="st-content" id="content">

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Comment</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_comment" id="frm_edit_comment" action="<?php echo base_url(); ?>backend/categories/edit-timeline-comment/<?php echo base64_encode($arr_timeline_comment["comments_id"]); ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Comment :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none"  id="comment" name="comment" class="form-control"  ><?php echo stripslashes($arr_timeline_comment["comments"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Comment Image/Video :</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" id="comment_file" name="comment_file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-9">
                                        <?php if ($arr_timeline_comment["comments_media_type"] == "0") { ?><img src="<?php echo base_url() ?>media/front/img/post-images/thumbs/<?php echo $arr_timeline_comment['comments_media_path'] ?>"> <?php } else if ($arr_timeline_comment["comments_media_type"] == "1") { ?> 
                                           <!--<iframe src="<?php echo base_url() ?>media/front/img/post-video/<?php echo $arr_timeline_comment['comments_media_path'] ?>" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
                                              <iframe src="//player.vimeo.com/video/50522981?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                             
                                            <?php } else {
                                            echo "No Media";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Comment Status :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <select id="comments_status" name="comments_status" class="form-control"  >
                                            <option value="">Select Status</option>
                                            <option value="1" <?php if ($arr_timeline_comment['comments_status'] == 1) { ?> selected="selected" <?php } ?>>Published</option>
                                            <option value="0" <?php if ($arr_timeline_comment['comments_status'] == 0) { ?> selected="selected" <?php } ?>>Unpublished</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" value="" id="old_comment_file" name="old_comment_file">
                                        <input type="hidden" name="timeline_id" id="timeline_id" value="<?php echo base64_encode($arr_timeline_comment["timeline_id"]); ?>">
                                        <input type="hidden" name="comments_id" id="comments_id" value="<?php echo ($arr_timeline_comment["comments_id"]); ?>">
                                        <input type="hidden" name="comments_media_id" id="comments_media_id" value="<?php echo $arr_timeline_comment["comments_media_id"]; ?>">
                                        <input type="hidden" name="old_comment_file" id="old_comment_file" value="<?php echo $arr_timeline_comment["comments_media_id"]; ?>">
                                        <input type="hidden" name="old_comments_media_type" id="old_comments_media_type" value="<?php echo $arr_timeline_comment["comments_media_type"]; ?>">
                                        <input type="hidden" name="old_comments_media_path" id="old_comments_media_path" value="<?php echo $arr_timeline_comment["comments_media_path"]; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="history.go(-1);" >Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
               <?php echo $global['site_title'];?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>
