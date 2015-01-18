<style type="text/css">
    .error {
        color: #bd4247;
    }
</style>
<script type="text/javascript">
    var j = jQuery.noConflict();
// JavaScript Document
    j(document).ready(function (e) {
        j("#frm_edit_gallery").validate({
            errorElement: "div",
            rules: {
                album_name: {
                    required: true
                }
            },
            messages: {
                album_name: {
                    required: "Please enter album name."
                }
            }
        });
    });
</script>
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
    <!-- extra div for emulating position:fixed of the menu -->
    <div class="st-content-inner">
        <div class="container-fluid">
            <h1>Edit Gallery</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">&nbsp;</div>
                        <div class="panel-body">
                            <form class="form-horizontal" name="frm_edit_gallery" id="frm_edit_gallery" action="<?php echo base_url(); ?>backend/edit-gallery/<?php echo $arr_album_gallery["album_id"]; ?>" method="post" enctype="multipart/form-data" >
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Album Name :</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?php echo $arr_album_gallery["album_name"]; ?>" id="album_name" name="album_name" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" >Album Images :</label>
                                    <div class="col-sm-9">

                                        <div class="row">
                                             <?php foreach ($arr_album_image as $album_image) { ?>
                                                <div class="col-sm-6 col-md-4">
                                                    <div class="thumbnail" >
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $arr_album_gallery["user_id"]; ?>/<?php echo $album_image["album_image_path"]; ?>"  width="180" height="100">
                                                        <div class="caption">
                                                            <p><a href="<?php echo base_url(); ?>backend/delete-gallery-image/<?php echo $album_image["album_media_id"]; ?>" class="btn btn-danger" role="button">Delete</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label" ></label>
                                    <div class="col-sm-offset-3 col-sm-9" >
                                        <button type="submit" class="btn btn-primary" id= "btn_submit" name= "btn_submit" value="Submit">Submit</button>
                                        <button type="button" class="btn btn-danger" id= "btn_back" name= "btn_back" value="btn_back"  onclick="window.location.href = '<?php echo base_url(); ?>backend/manage-gallery';" >Back</button>
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
