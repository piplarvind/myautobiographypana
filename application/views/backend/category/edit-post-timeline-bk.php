<style type="text/css">
    .error {
        color: #bd4247;
    }
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/edit-post-timeline.js"></script>
<div class="st-content" id="content">

    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Timeline Post</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_timeline" id="frm_edit_timeline" action="<?php echo base_url(); ?>backend/categories/edit-post-timeline/<?php echo base64_encode($arr_timeline_post['timeline_id']) ; ?>/<?php echo $arr_timeline_post["category_id"] ; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Post Title :</label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" value="" id="post_title" name="post_title" class="form-control"  ><?php echo stripslashes($arr_timeline_post["timeline_post_data"])  ; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Post Image/Video :</label>
                                    <div class="col-sm-9">
                                        <input type="file" value="" id="post_file" name="post_file">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                        <div class="col-sm-9">
                                            <?php if ($arr_timeline_post["timeline_media_type"] == "0") { ?><img src="<?php echo base_url() ?>media/front/img/post-images/thumbs/<?php echo $arr_timeline_post['timeline_media_path'] ?>"> <?php } else if ($arr_timeline_post["timeline_media_type"] == "1") { ?> <img src="<?php echo base_url() ?>media/front/img/post-video/<?php echo $arr_timeline_post['timeline_media_path'] ?>"><?php } else {  echo "No Media" ; } ?>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="old_post_file" id="old_post_file" value="<?php echo $arr_timeline_post['timeline_media_path'] ?>">
                                        <input type="hidden" name="old_media_type" id="old_media_type" value="<?php echo $arr_timeline_post['timeline_media_type'] ?>">
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo   $arr_timeline_post["category_id"]  ; ?>">
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo   $arr_timeline_post["sub_category_id"]  ; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/categories/view-timeline/<?php echo base64_encode($arr_timeline_post['sub_category_id']) ; ?>/<?php echo $arr_timeline_post["category_id"] ; ?>';" >Back</button>
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
