<style type="text/css">
    .error {
        color: #bd4247;
    }

    .validationError{
        color: #bd4247;
    }   
</style>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>media/backend/js/category/post-for-timeline.js"></script>


<script>
    function selectType() {
        var type = $('#media_type').val();
        if (type == 'img') {
            $("#image").show();
            $("#file").hide();
            $("#video").hide();
        } else if (type == 'vid') {
            $("#image").hide();
             $("#file").hide();
            $("#video").show();
        } else if (type == 'fl') {
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
            <h1>Post For Timeline</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_timeline" id="frm_timeline" action="<?php echo base_url(); ?>backend/categories/post-for-timeline/<?php echo base64_encode($category_id); ?>/<?php echo $parent_id; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Post Title :<em>*</em></label>
                                    <div class="col-sm-9">
                                        <textarea style="resize: none" value="" id="post_title" name="post_title" class="form-control"  ></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" > Media Type :</label>
                                    <div class="col-sm-9">
                                        <select name="media_type" id = "media_type"  onchange="selectType(this.val)" class="form-control">
                                            <option value=''> Select Media Type </option>
                                            <option value="img">Images</option>
                                            <option value="vid">Video</option>
                                            <option value="fl">Files</option>
                                        </select>                                      
                                    </div>
                                </div>
                                <div id="image" style="display: none;">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Post Images :</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_image" name="post_image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div id="video" style="display: none;">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Post Video :</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_video" name="post_video">
                                        </div>
                                    </div>
                                </div>
                                <div id="file" style="display: none;">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label" >Files:</label>
                                        <div class="col-sm-9">
                                            <input type="file" value="" id="post_files" name="post_files[]" multiple="multiple">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id; ?>">
                                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <?php if ($parent_id == "18") { ?>
                                            <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/categories/list-interest/<?php echo base64_encode($parent_id); ?>';" >Back</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/category/list/<?php echo $parent_id; ?>';" >Back</button>
                                        <?php } ?>
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
