<style type="text/css">
    .error {
        color: #bd4247;
    }
    .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/edit-post-timeline.js"></script>
    <script>
    function selectType() {
        var type = $('#timeline_media_type').val();
        if (type == '0') {
            $("#image").show();
            $("#file").hide();
            $("#video").hide();
        } else if (type == '1') {
            $("#image").hide();
             $("#file").hide();
            $("#video").show();
        } else if (type == '2') {
            $("#image").hide();
            $("#video").hide();
            $("#file").show();
        } else {
            $("#image").hide();
            $("#video").hide();
            $("#file").hide();
        }

    }
</script>
<div class="st-content" id="content">
   <?php
    $msg = $this->session->userdata('msg');
    ?>
    <!--[message box]-->
    <?php if ($msg != '') { ?>
        <div class="msg_box alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
            <?php
            echo $msg;
            $this->session->unset_userdata('msg');
            ?> 
        </div>
        <?php
    }
    ?> 
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Timeline Post</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_timeline" id="frm_edit_timeline" action="<?php echo base_url(); ?>backend/categories/edit-post-timeline/<?php echo base64_encode($arr_timeline['timeline_id']); ?>/<?php echo $arr_timeline["category_id"]; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Post Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" value="" id="post_title" name="post_title" class="form-control"  ><?php echo stripslashes($arr_timeline["timeline_post_data"]); ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" > Media Type :</label>
                                    <div class="col-sm-9">
                                        <select name="timeline_media_type" id = "timeline_media_type"  onchange="selectType(this.val)" class="form-control">
                                            <option value=''> Select Media Type </option>
                                            <option value="0" <?php if($arr_timeline_media[0]["timeline_media_type"]== "0") { ?> selected="selected"<?php   } ?>>Images</option>
                                            <option value="1" <?php if($arr_timeline_media[0]["timeline_media_type"]== "1") { ?> selected="selected"<?php   } ?>>Video</option>
                                             <option value="2" <?php if($arr_timeline_media[0]["timeline_media_type"]== "2") { ?> selected="selected"<?php   } ?>>Files</option>
                                        </select>                                      
                                    </div>
                                </div>
                                <div id="image"  <?php if($arr_timeline_media[0]["timeline_media_type"] == "0") { ?>  style="display: block;" <?php   } else { ?> style="display: none ;" <?php } ?>>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Post Images :</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_image" name="post_image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div id="video" <?php if($arr_timeline_media[0]["timeline_media_type"] == "1") { ?>  style="display: block;" <?php   } else { ?> style="display: none ;" <?php } ?>">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Post Video :</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_video" name="post_video">
                                        </div>
                                    </div>
                                </div>
                                <div id="file" <?php if($arr_timeline_media[0]["timeline_media_type"] == "2") { ?>  style="display: block;" <?php   } else { ?> style="display: none ;" <?php } ?>>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Files:</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_files" name="post_files[]" multiple="multiple">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-9">
                                        <?php foreach ($arr_timeline_media as $timeline_media) { ?>
                                            <?php if ($timeline_media["timeline_media_type"] == "0") { ?><img src="<?php echo base_url() ?>media/front/img/post-images/thumbs/<?php echo $timeline_media['timeline_media_path'] ?>"> <?php } else if ($timeline_media["timeline_media_type"] == "1") { ?> 
                                              <!--<iframe src="<?php echo base_url() ?>media/front/img/post-video/<?php echo $timeline_media['timeline_media_path'] ?>" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
                                              <iframe src="//player.vimeo.com/video/50522981?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                              <?php }else if ($timeline_media["timeline_media_type"] == "2") { ?> <a href="<?php echo base_url() ?>media/front/img/post-images/<?php echo $timeline_media['timeline_media_path'] ?>">Download</a><?php
                                            } else {
                                                echo "No Media";
                                            }
                                            ?>
                                            <?php if($timeline_media["timeline_media_type"] == "0" || $timeline_media["timeline_media_type"] == "1") { ?>
                                            <a href="<?php echo base_url(); ?>backend/categories/delete-timeline-image/<?php echo $timeline_media['timeline_media_id']; ?>/<?php echo $timeline_media['timeline_id']; ?>" class="gallery-delete" title="Delete" style="margin-left: -14px ">
                                                <img id="edit"  src="<?php echo base_url() ?>media/front/img/close.png" alt="delete"  >
                                            </a>
                                        <?php } else  { ?>
                                            &nbsp;&nbsp;<a href="<?php echo base_url(); ?>backend/categories/delete-timeline-image/<?php echo $timeline_media['timeline_media_id']; ?>/<?php echo $timeline_media['timeline_id']; ?>" class="gallery-delete" title="Delete" style="margin-left: -14px ">
                                                   &nbsp;<span style="color: red">x</span>
                                                <!--<img id="edit"  src="<?php echo base_url() ?>media/front/img/close.png" alt="delete"  >-->
                                            </a>
                                        <?php } } ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="old_post_file" id="old_post_file" value="<?php echo $arr_timeline['timeline_media_path'] ?>">
                                        <input type="hidden" name="old_media_type" id="old_media_type" value="<?php echo $arr_timeline['timeline_media_type'] ?>">
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $arr_timeline["category_id"]; ?>">
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $arr_timeline["sub_category_id"]; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/categories/view-timeline/<?php echo base64_encode($arr_timeline['sub_category_id']); ?>/<?php echo $arr_timeline["category_id"]; ?>';" >Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <?php echo $global['site_title']; ?>  &copy; Copyright
            </div>
        </div>
    </div>
</div>
