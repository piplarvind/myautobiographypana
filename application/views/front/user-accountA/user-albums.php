
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>

<script type="text/javascript">
    /* Start Create Album */

    jQuery(document).ready(function(e) {
        jQuery("#frm-new-album").validate({
            debug: true,
            errorClass: 'text-danger',
            rules: {
                album_name: {
                    required: true
                }
            },
            messages: {
                album_name: {
                    required: "Please enter album name."
                }
            }, submitHandler: function(form) {
                jQuery("#btn-create").hide();
                jQuery("#btn_loader").show();
                form.submit();
            }
        });
    });

    /* End Create Album */

</script> 

<script type="text/javascript">

    var j = jQuery.noConflict();
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
                alert("Please select at least one album to delete");
                return false;
            }
            else {
                var del = confirm("Are you sure you want to delete?");
                if (del == true) {
                    j('<img style="margin:0 0 0 450px;" id="load_img" src="' + jQuery('#base_url').val() + 'media/front/img/please-wait.gif" alt="Importing....Please wait.">').prependTo(".my_album_div");
                    var photoIds = [];

                    j(".select-photo").each(function(index, element) {
                        if (j(element).is(":checked")) {
                            photoIds.push(j(element).val());
                        }
                    });
                    j.ajax({
                        type: 'POST',
                        url: '<?php echo base_url(); ?>' + 'delete-album',
                        data: {
                            photo_ids: photoIds
                        },
                        success: function(msg) {
                            if (msg == 'false')
                            {
                                window.location.href = j('#base_url').val() + 'signin';
                            }
                            else
                            {
                                j(".select-photo").each(function(index, element) {
                                    if (j(element).is(":checked")) {
                                        j('#photo' + j(element).val()).fadeOut('slow');
                                        j('#photo' + j(element).val()).remove();
                                    }
                                });
                                var picCount = j(".album-photos").children().length;
                                if (picCount == 0)
                                {
                                    j('.album-photos').html('<h2 id="no_photos">No photos added in this album</h2>').hide().fadeIn(1000);
                                    
                                }
                                location.href = location.href;
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


<div class="middle_section">
    <div class="page_holder">
        <div class="page_inner">
            <div class="dashboard_main">

                <?php if ($this->session->userdata('album_added') != '') { ?>
                    <div class="alert alert-success">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->userdata('album_added'); ?>
                    </div>
                    <?php
                    $this->session->unset_userdata('album_added');
                  }
                ?>
                <div class="cat_tab">My Albums</div>
                <div>
                    <ul class="go-right">              
                        <li class="css-small-button"><a href="javascript:void(0)" name="btn-delete" id="btn-delete">Delete</a> </li>
                    </ul>
                </div>   
                <div class="dashboard_inn">                                        
                    <h2>Create A New Album To Upload Photos</h2>
                    <div class="myalbum_left mblet">
                        <form name="frm-new-album" class="cre_album"  id="frm-new-album" method="POST" enctype="multipart/form-data">
                            <label> Album Name </label> 
                            <div class="inpt_otr"> <input type="text" id="album_name" name="album_name"></div>
                            <div class="form-group ">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <input type="submit" name="btn-create" id="btn-create" class="button" value="Create Album">     
                                    <img id="btn_loader" style="display: none;" src="<?php echo base_url(); ?>media/front/UI-2-media/images/loader.gif" alt="Loader">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my_album_div_first" >                        
                        <ul>
                            <?php 
                            if (!empty($user_albums)) {
                                foreach ($user_albums as $key => $albums) {
                                    $front_photo = (empty($albums['front_photo'])) ? "no_image.jpeg" : $albums['front_photo'][0]['album_image_path'];
                                    ?>
                                    <li> 
                                        <div class="image_align">
                                            <a href="<?php echo base_url() ?>my/photos/<?php echo $albums['album_id']; ?>">
                                                <img title="<?php echo stripcslashes($albums['album_name']); ?>" alt="<?php echo stripcslashes($albums['album_name']); ?>" <?php if($front_photo == "no_image.jpeg"){?> src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/<?php echo $front_photo; ?>" <?php } else {?>src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id?>/<?php echo $front_photo; ?>" <?php }?>>
                                            </a>
                                        </div> 
                                        <div class="info">
                                            <b><?php echo stripcslashes($albums['album_name']); ?></b>
                                        </div>
                                        <div class="infoSmall">
                                            Created: <?php echo $albums['created_date']; ?>, Photos: <b><?php echo $albums['photos_count'][0]['cnt']; ?></b>
                                        </div>
                                        <span><input type="checkbox" value="<?php echo $albums['album_id']; ?>" class="select-photo" name="select-photo[]"></span> 
                                    </li>  
                                    <?php
                                }
                             } else {
                                ?>    
                                <li><h2>No albums created yet.</h2></li>
                            <?php } ?>    
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
