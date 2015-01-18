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
            <h4>Photo Gallery</h4>
            <hr/>
            <div class="row gallery-image" data-toggle="gridalicious" data-gutter="1" data-width="250">
                <?php
                foreach ($arr_album_image as $album_image) {
                    $cnt++
                    ?>
                    <div class="panel">
                        <a href="#showImageModal<?php echo $cnt; ?>" data-toggle="modal">
                            <span class="overlay"></span>
                            <span><?php echo $arr_album_gallery["album_name"]; ?></span>
                            <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $arr_album_gallery["user_id"]; ?>/<?php echo $album_image["album_image_path"]; ?>" alt="image" />
                        </a>
                    </div>
                    <div class="modal fade image-gallery-item" id="showImageModal<?php echo $cnt; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-header">
                            <?php echo $arr_album_gallery["album_name"]; ?>
                                <button type="button" class="close" data-dismiss="modal" onclick="window.location.href='<?php echo base_url(); ?>backend/delete-gallery-image/<?php echo $album_image["album_media_id"]; ?>'"><span class="glyphicon glyphicon-trash" style="color: white;"aria-hidden="true"></span></button>
                            </div>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                            <img class="img-responsive" src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $arr_album_gallery["user_id"]; ?>/<?php echo $album_image["album_image_path"]; ?>" alt="Place">
                        </div>
                    </div>
                    <?php } ?>
            </div>
            <hr/>
            <div class="footer">
                <?php echo $global['site_title'];?>  &copy; Copyright
            </div>

            <!-- // Footer -->
        </div>
    </div>

    <!-- /st-content-inner -->
</div>