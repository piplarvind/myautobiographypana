<?php // echo '<pre>';print_r($album_photos);die;?>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>

<script type="text/javascript" >
    function selectFile3() {
        document.getElementById("upFile").click();
    }
    
    function view_img(user_id,image_path)
    {
        var view_html = '';
        view_html+= '<img class="img-responsive" src="<?php echo base_url() ?>media/front/UI-2-media/images/album_photos/user_'+user_id+'/'+image_path+'" alt="Place" width="100%">';

        jQuery("#show_img").html(view_html);
        $('#showImageModal').modal('show');
    }
    
    
    var j = jQuery.noConflict();
    j(document).ready(function() {
        j('#upFile').change(function() {

            j("#btn_loader").show();
            
            j("#imageform").ajaxForm({
                success: function(msg) {
//                    alert(msg);
                    j("#btn_loader").hide();
                    j('#album_photo').append(msg);
                     
                  },
                  

            }).submit();
        });

    });
    
    
    /* [End] :: Upload album pictures  ajax */
</script>

<script type="text/javascript">

    var j = jQuery.noConflict();
    j(document).ready(function() {
        j('#select_all_photo').click(function(event) {  //on click 
            if (!this.checked) { // check select status
                j('.select-photo').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                });
            } else {
                j('.select-photo').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                });
            }
        });

    });


    j(document).ready(function() {
        j('#select_none').click(function(event) {  //on click 
            if (this.checked) { // check select status
                j('.select-photo').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"               
                });
            } else {
                j('.select-photo').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                });
            }
        });

    });


    /* Delet Photos By Id */
    j(function() {
        var del_num = 0;
        j('#btn-delete').click(function() {
            j('.select-photo').each(function() {
                if (this.checked) {
                    del_num = 1;
                }
            });

            if (!del_num) {
                alert("Please select at least one photo to delete");
                return false;
            }
            else {
                var del = confirm("Are you sure you want to delete?");
                if (del == true) {
                    j('<img style="margin:0 0 0 450px;" id="load_img" src="' + j('#base_url').val() + 'media/front/img/please-wait.gif" alt="Importing....Please wait.">').prependTo(".my_album_div");
                    var photoIds = [];

                    j(".select-photo").each(function(index, element) {
                        if (j(element).is(":checked")) {
                            photoIds.push(j(element).val());
                        }
                    });



                    j.ajax({
                        type: 'POST',
                        url: j('#base_url').val() + 'delete-photo',
                        data: {
                            photo_ids: photoIds
                        },
                        success: function(msg) {
                            //alert(msg);
                            if (msg == 'false')
                            {
                                window.location.href = j('#base_url').val() + 'signin';
                            }
                            else
                            {
                                j(".select-photo").each(function(index, element) {
                                    if (j(element).is(":checked")) {
                                        j('#photo' + j(element).val()).fadeOut('slow');
                                        j('#photo_' + j(element).val()).remove();
                                    }
                                });
                                var picCount = j(".album-photos").children().length;
                                if (picCount == 0)
                                {
                                    j('.album-photos').html('<h2 id="no_photos">No photos added in this album</h2>').hide().fadeIn(1000);

                                }
//                                 location.href = location.href;
                            }
                            j('#load_img').remove();
                        }
                    });
                }
            }
        });
    });

    /* Delet Photos By Id */

</script>


<!--<div id="content">-->
<div class="st-pusher">

    <!-- sidebar effects INSIDE of st-pusher: -->

    <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
    <!-- this is the wrapper for the content --><div class="st-content">

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
                       <ul class="nav navbar-nav"> 
                        <?php if ($user_session['user_role'] == '0') { ?>
                        <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                        <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                         <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                        <?php }else{ ?>
                       
                             <li><a href="<?php echo base_url();?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li><a href="<?php echo base_url();?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                        
                        <?php }?>
                        </ul>
                        
                      
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
                 </nav>

            <div class="container-fluid gallery-page">
                <h1>Gallery</h1>
                 <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/splash-loader.gif" alt="Loader">
                <div class="panel panel-default relative">
                    <form id="imageform" class="form-horizontal" name='imageform' action='<?php echo base_url(); ?>ajax-upload-photos/<?php $album_id ?>' method="post" enctype="multipart/form-data">
                        <div class="create-album-btn">
                            <input type="file" class="form-control" name="upFile[]" multiple  id="upFile" style="opacity: 0;">
                            <input type="hidden" name="album_id" id="album_id" value="<?php echo $album_id; ?>">
                            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                            <a href="#" class="btn btn-primary" id="upFile_btn" onClick="selectFile3()"><i class="fa fa-plus"></i> Add photos</a>
                            
                            <a class="btn btn-primary" href="javascript:void(0)" name="btn-delete" id="btn-delete">Delete</a> 
                            <a href="#" title="select all for delete" id="select_all_photo" name="select_all_photo" class="btn btn-primary">All</a>
                        </div>
                    </form> 

                    <ul class="nav nav-tabs" role="tablist">
                        <li class=""><a href="#profile" role="tab" data-toggle="tab"><i class="fa fa-folder"></i> <?php echo stripslashes($album_name); ?></a></li>
                    </ul>
                    
                </div>
                 
                 
                 
                 
                 
                 
                 
                <div id="grid-gallery" class="grid-gallery">
                    <section class="grid-wrap" >
                        <ul class="grid" id="album_photo">
                            <li class="grid-sizer"></li><!-- for Masonry column width -->
                           <?php
                    if (!empty($album_photos) && count($album_photos) != '') {
                        foreach ($album_photos as $key => $albums) {
                            ?>
                            <li id="photo_<?php echo $albums['album_media_id']; ?>">
                                <figure style="background:#fff url(<?php echo base_url() ?>media/front/UI-2-media/images/album_photos/400x400/<?php echo $albums['album_image_path']; ?>) center center no-repeat;"></figure>
                                <span class="select_item"> <input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]"></span>
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
                 
                 
                 
                 
                 
                 
                 
                 
                 

<!--                <div class="row gallery-image" data-toggle="gridalicious" data-gutter="10" data-width="250" id="album_photo">
                    <?php
                    if (!empty($album_photos) && count($album_photos) != '') {
                        foreach ($album_photos as $key => $albums) {
                            ?>
                            <div class="panel" id="photo_<?php echo $albums['album_media_id']; ?>" >
                                <a href="#" data-toggle="modal" id='zoom_image' onclick="view_img('<?php echo $user_id; ?>','<?php echo $albums['album_image_path']; ?>');">
                                    <img  src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/400x400/<?php echo $albums['album_image_path']; ?>" alt="image" />
                                </a>
                                <span class="select_item"> <input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]"></span>
                            </div>
                            
                            <?php
                        }
                    } else {
                        echo '<div class="col-xs-12"> <div class="no-record-found"> No album present </div> </div>';
                    }
                    ?>
                </div>

                 Modal 
                <div class="modal fade image-gallery-item" id="showImageModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-header">
                            <div class="album-name pull-left"><?php echo stripslashes($album_name); ?></div>
                            <div class="pull-right picture-info">
                                <p><strong>Uploaded on :</strong> <?php echo  date('d M Y', strtotime($created_date)); ?></p>
                                <p><strong>Time :</strong> <?php echo  date('H i A', strtotime($created_date)); ?></p>
                                
                                
                            </div>
                            </div>
                        <button data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <div id="show_img"></div>
                    </div>
                </div>-->
                
            </div>
        </div>

    </div>

    <!-- /st-content-inner -->
</div>

<!-- /st-content -->
</div>



