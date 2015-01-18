<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>
<script type="text/javascript" >
    
    
    function view_img(user_id,image_path)
    {
        var view_html = '';
        view_html+= '<img class="img-responsive" src="<?php echo base_url() ?>media/front/UI-2-media/images/album_photos/user_'+user_id+'/'+image_path+'" alt="Place" width="100%">';

        jQuery("#show_img").html(view_html);
        $('#showImageModal').modal('show');
    }
    
    
  
    /* [End] :: Upload album pictures  ajax */
</script>

<!--<div class="st-container">-->
<!--<div id="content">-->
    <div class="st-pusher">
        <div class="st-content">

                <!-- extra div for emulating position:fixed of the menu -->
                <div class="st-content-inner" id="content">
                    <nav class="navbar navbar-subnav navbar-static-top margin-bottom-none" role="navigation">
                <div class="container-fluid">
                    
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="fa fa-ellipsis-h"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="subnav">
                         <?php 
                        if($user_session['user_role'] == '0'){ #For User A ?>
                        <ul class="nav navbar-nav">
                            <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                            <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                        </ul>
                        <?php }else{ ?>
                         <ul class="nav navbar-nav">
                             <li><a href="<?php echo base_url();?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li><a href="<?php echo base_url();?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                        </ul>
                        <?php }?>
                        
                      
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
                 </nav>
                    <div class="container-fluid">
                        <h2>Gallery</h2>
                        <br/>
                        
                        
                        
                        
                        
                        <div id="grid-gallery" class="grid-gallery">
                    <section class="grid-wrap">
                        <ul class="grid">
                            <li class="grid-sizer"></li><!-- for Masonry column width -->
                           <?php
                            if (!empty($album_photos) && count($album_photos) !='') {
                            foreach ($album_photos as $key => $albums) {
                            ?>
                            <li>
                                <figure style="background:#fff url(<?php echo base_url() ?>media/front/UI-2-media/images/album_photos/400x400/<?php echo $albums['album_image_path']; ?>) center center no-repeat;"></figure>
                                <!--<span class="select_item"> <input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]"></span>-->
                            </li>
                            
                    <?php } } 
                    else {
                        echo '<div class="col-xs-12"> <div class="no-record-found"> No album present </div> </div>';
                    }?>
                        </ul>
                    </section><!-- // grid-wrap -->
                    <section class="slideshow">
                        <ul>
                        <?php foreach ($album_photos as $key => $albums) { ?>
                            <li>
                                <figure>
                                    <figcaption>
                                        <h3><?php echo stripslashes($album_name); ?></h3>
                                        <div class="picture-info">
                                            <p><strong>Uploaded on :</strong> <span class="media_date"><?php echo date('d M Y H:i:s A', strtotime($created_date)); ?></span></p>
                                        </div>
                                    </figcaption>
                                    <img src="<?php echo base_url() ?>media/front/UI-2-media/images/album_photos/400x400/<?php echo $albums['album_image_path']; ?>" alt="img01"/>
                                </figure>
                            </li>
                            <?php } ?>
                        </ul>
                        <nav>
                            <span class="icon nav-prev"><i class="fa fa-angle-left"></i></span>
                            <span class="icon nav-next"><i class="fa fa-angle-right"></i></span>
                            <span class="icon nav-close"><i class="fa fa-remove"></i></span>
                        </nav>

                    </section><!-- // slideshow -->
                </div> 
                        
                        
                        
                        
                        
<!--                        <div class="row gallery-image" data-toggle="gridalicious" data-gutter="10" data-width="250" id="album_photo">
                            <?php 
                                            if (!empty($album_photos) && count($album_photos) !='') {
                                                foreach ($album_photos as $key => $albums) {
                                    ?>
                            <div class="panel" id="photo_<?php echo $albums['album_media_id']; ?>" >
                                <a href="#" data-toggle="modal" onclick="view_img('<?php echo $user_id; ?>','<?php echo $albums['album_image_path']; ?>');">
                                    <span class="overlay"></span>
                                    <span>On my way to the top!</span>
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/400x400/<?php echo $albums['album_image_path']; ?>" alt="image" />
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id; ?>/<?php echo $albums['album_image_path']; ?>" alt="image" />
                                    
                                </a>
                               
                            </div>
                            <?php
                                    }
                                } 
                                else {
                        echo 'No album present';
                        }
                        ?>
                            

                        </div>

                         Modal 
                        <div class="modal fade image-gallery-item" id="showImageModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-header"><?php echo stripslashes($album_name); ?></div>
                                <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <div id="show_img"></div>
                            </div>
                        </div>-->
                    </div>
                </div>
                    
                </div>

                <!-- /st-content-inner -->
                </div>
<!--</div>-->
            <!-- /st-content -->
<!--            </div>-->


    



<!--<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>


<div id="content">
    <nav class="navbar navbar-subnav navbar-static-top" role="navigation">
        <div class="container-fluid">
             Brand and toggle get grouped for better mobile display 
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#subnav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-ellipsis-h"></span>
                </button>
            </div>
        </div>
    </nav> 

    [message box]
    <?php
    $msg = $this->session->userdata('msg');
    ?>
    [message box]
    <?php if ($msg != '') { ?>
        <div class="msg_box alert alert-success">
            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
            <?php
            echo $msg;
            $this->session->unset_userdata('msg');
            ?> 
        </div>
    <?php }
    ?>

    [message box]
    <?php
    $msg1 = $this->session->userdata('image_error');
    ?>
    [message box]
    <?php if ($msg1 != '') { ?>
        <div class="msg_box alert alert-success">
            <button type="button" class="close" data-dismiss="alert" id="msg_close" name="msg_close">×</button>
            <?php
            echo $msg1;
            $this->session->unset_userdata('image_error');
            ?> 
        </div>
    <?php }
    ?>

    <div class="container-fluid">
        <div class="cover overlay">
            <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/profile-cover.jpg" alt="cover" />
        </div>
        <div class="panel panel-default share">
            <div class="input-group">
                <div class="input-group-btn">
                    <a class="btn btn-primary" href="#"><i class="fa fa-envelope"></i> Send</a>
                </div>

                 /btn-group 
                <input type="text" class="form-control share-text" placeholder="Write message..." />
            </div>
             /input-group 
        </div>
        <div class="panel panel-default">

            <form id="imageform" class="form-horizontal" name='imageform' action='<?php echo base_url(); ?>ajax-upload-photos/<?php $album_id ?>' method="post" enctype="multipart/form-data">
                <div class="create-album-btn">
                    <input type="file" class="form-control" name="upFile[]" multiple  id="upFile" style="opacity: 0;">
                    <input type="hidden" name="album_id" id="album_id" value="<?php echo $album_id; ?>">
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                </div>
            </form> 

            <ul class="nav nav-tabs" role="tablist">
                <li class=""><a href="#profile" role="tab" data-toggle="tab"><i class="fa fa-folder"></i> <?php echo stripslashes($album_name); ?></a>
                </li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane fade active in photos-list" id="album_photo">

                    <div class="select-all-pics">
                        <ul class="nav navbar-nav">
                            <li> <b>Select:</b></li>
                            <li id="select-all"><a href="javascript:void(0)" id="select_all" name="select_all" class="btn btn-primary">All</a></li>
                            <li id="select-none"> <a href="javascript:void(0)" id="select_none" name="select_none" class="btn btn-primary">None</a> </li>
                        </ul>
                    </div>

                    <div class="photos-list-all offset-top-20">




                        <?php
//                        if (!empty($album_photos)) {
//                            foreach ($album_photos as $key => $albums) {
                                ?>
                                <div class="single-album" id="photo_<?php echo $albums['album_media_id']; ?>">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id; ?>/<?php echo $albums['album_image_path']; ?>" />
                                    </a>
                                    <span class="select_item">
                                        <input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]">
                                    </span>
                                </div>

                                <?php
//                            }
//                        } else {
////                        echo 'No album present';
//                        }
                        ?>


                       <div id="grid-gallery" class="grid-gallery">
                            <section class="grid-wrap">
                                <ul class="grid">
                                    <li class="grid-sizer"></li> for Masonry column width 
                                    <?php 
                                            if (!empty($album_photos) && count($album_photos) !='') {
                                                foreach ($album_photos as $key => $albums) {
                                    ?>
                                    
                                    <li id="photo_<?php echo $albums['album_media_id']; ?>">
                                        <figure class="single-album">
                                            <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id; ?>/<?php echo $albums['album_image_path']; ?>" alt="image" />
                                        </figure>
                                        <span class="select_item">
                                            <input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]">
                                        </span>
                                    </li>
                                    <?php
                                    }
                                } 
                                else {
                        echo 'No album present';
                        }
                        ?>
                                </ul>
                            </section> // grid-wrap 
                            
                            <section class="slideshow">
                                <ul>
                                    <?php 
                                            if (!empty($album_photos)) {
                                                foreach ($album_photos as $key => $albums) {
                                    ?>
                                    <li>
                                        <figure>
                                            <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id; ?>/<?php echo $albums['album_image_path']; ?>" alt="image" />
                                        </figure>
                                    </li>

                                    <?php
                                    }
                                } ?>
                                    
                                </ul>
                                <nav>
                                    <span class="fa fa-angle-left nav-prev"></span>
                                    <span class="fa fa-angle-right nav-next"></span>
                                    <span class="fa fa-close nav-close"></span>
                                </nav>
                                <div class="info-keys"><i class="fa fa-folder"> </i><?php echo stripslashes($album_name); ?></div>
                            </section> // slideshow 
                        </div>



                    </div>

                </div>
            </div>
        </div>
         Footer 
        <?php $this->load->view('front/includes/ui2-footer'); ?>
         // Footer 
    </div>
     Vendor Scripts Bundle 
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/vendor.min.js"></script>
     App Scripts Bundle 
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/scripts.min.js"></script>
    <script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.metisMenu.js"></script>
    <script>
                             $(function() {

                                 $('#side-menu').metisMenu();

                             });
    </script>
</body>
</html>-->

