
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>


<script type="text/javascript" >
    /* [Start] :: Upload album pictures  ajax */
    //var j = jQuery.noConflict();
    
    $(document).ready(function() {
        $('#upFile').change(function() {
            $("#imageform").ajaxForm({  
                success: function(msg) {
                    if (msg.length <= 7)
                    {
                        alert("Please upload image in valid format.");
                    }
                    else
                    {
                        $('.go_blue').hide();
                        $('#message').show();
                        $('#loader').hide();
                    }
                },
                target: '#new_images'
            }).submit();
        });
    });
    /* [End] :: Upload album pictures  ajax */


</script>

<script type="text/javascript">


   $(document).ready(function() {
    $('#select_all').click(function(event) {  //on click 
        if(!this.checked) { // check select status
            $('.select-photo').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.select-photo').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});


   $(document).ready(function() {
    $('#select_none').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.select-photo').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.select-photo').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});


    /* Delet Photos By Id */
    $(function() {
        var del_num = 0;
        jQuery('#btn-delete').click(function() {
            jQuery('.select-photo').each(function() {  
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
                    jQuery('<img style="margin:0 0 0 450px;" id="load_img" src="' + jQuery('#base_url').val() + 'media/front/img/please-wait.gif" alt="Importing....Please wait.">').prependTo(".my_album_div");
                    var photoIds = [];
                    
                    jQuery(".select-photo").each(function(index, element) {
                    if (jQuery(element).is(":checked")){
                        photoIds.push(jQuery(element).val());
                    }
                });
                   
                        
                                                    
                    jQuery.ajax({
                        type: 'POST',
                        url: jQuery('#base_url').val() + 'delete-photo',
                        data: {
                            photo_ids: photoIds
                        },
                        success: function(msg) {
                            //alert(msg);
                            if (msg == 'false')
                            {
                                window.location.href = jQuery('#base_url').val() + 'signin';
                            }
                            else
                            {
                                jQuery(".select-photo").each(function(index, element) {
                                    if (jQuery(element).is(":checked")) {
                                        jQuery('#photo' + jQuery(element).val()).fadeOut('slow');
                                        jQuery('#photo' + jQuery(element).val()).remove();
                                    }
                                });
                                var picCount = jQuery(".album-photos").children().length;
                                if (picCount == 0)
                                {
                                    jQuery('.album-photos').html('<h2 id="no_photos">No photos added in this album</h2>').hide().fadeIn(1000);
                                    ;
                                }
                                 location.href = location.href;
                            }
                            jQuery('#load_img').remove();
                        }
                    });
                }
            }
        });
    });

    /* Delet Photos By Id */

</script>


<div id="fb-root"></div>
<div class="middle_section">
    <?php ?>
    <div class="page_holder">
        <div class="page_inner">
            <div class="dashboard_main">
                
                <?php if ($this->session->userdata('fb_album_fetched') != '') { ?>
                    <div class="alert alert-success">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->userdata('fb_album_fetched'); ?>
                    </div>
                    <?php
                    $this->session->unset_userdata('fb_album_fetched');
                }
                if ($this->session->userdata('inst_album_fetched') != '') {
                    ?>
                    <div class="alert alert-danger">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->userdata('inst_album_fetched'); ?>
                    </div>
                    <?php
                    $this->session->unset_userdata('inst_album_fetched');
                }
                ?>
                    
                    <?php
                
                if ($this->session->userdata('success_message') != '') {
                    ?>
                    <div class="alert alert-success">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->userdata('success_message'); ?>
                    </div>
                    <?php
                    $this->session->unset_userdata('success_message');
                }
                if ($this->session->userdata('image_error') != '') {
                    ?>
                    <div class="alert alert-success">
                        <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                        <?php echo $this->session->userdata('image_error'); ?>
                    </div>
                    <?php
                    $this->session->unset_userdata('image_error');
                }
                ?>
                <div id="fb-data">   
                    <div class="cat_tab"><?php echo $album_name; ?></div>
                    <div class="dashboard_inn">  
                        <div class="my-this-page-ops">
                            <ul class="go-left">
                                <li> <b>Select:</b></li>
                                <li id="select-all"> 
                                    <a href="javascript:void(0)" id="select_all" name="select_all">All</a>
                                </li>
                                ,
                                <li id="select-none"> <a href="javascript:void(0)" id="select_none" name="select_none">None</a> </li>
                            </ul>
                            <ul class="go-right">              
                                <li class="css-small-button"><a href="javascript:void(0)" name="btn-delete" id="btn-delete">Delete</a> </li>
                            </ul>
                        </div>
                        <div class="myalbum_left mblet">
                            <form id="imageform" name='imageform' action='<?php echo base_url(); ?>ajax-upload-photos' method="post" enctype="multipart/form-data">
                                
                                <div class="upload-img-input">
                                    <input type="file" name="upFile[]" multiple  id="upFile">
                                    <input type="hidden" name="album_id" id="album_id" value="<?php echo $album_id; ?>">
                                </div>
                                <div id="upload_image_error" name="upload_image_error"></div>
                            </form>
                        </div>
                        <div id="new_images"></div>                                     
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                        </div>
                    <div class="my_album_div_first">                        
                        <ul>
                            <?php
                            if (!empty($album_photos)) {
                                foreach ($album_photos as $albums) {
                                    $front_photo = (empty($albums['front_photo'])) ? "no_image.jpeg" : $albums['front_photo'][0]['album_image_path'];
                                    ?>
                                    <li> 
                                        <div class="image_align">
          
                                            <a href="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id;?>/<?php echo $albums['album_image_path']; ?>" data-lightbox="image-1">  
                                                <img title="<?php echo stripcslashes($albums['album_name']); ?>" alt="<?php echo stripcslashes($albums['album_name']); ?>" src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/user_<?php echo $user_id;?>/<?php echo $albums['album_image_path']; ?>">
                                            </a>
                                        </div> 
                                        <div class="info">
                                            <b><?php echo stripcslashes($albums['album_name']); ?></b>
                                        </div>
                                        <div class="infoSmall">
                                            Created: <?php echo date('F d, Y', strtotime($album_datas[0]['created_date'])); ?>, Photos:  <b><?php echo $albums['photos_count'][0]['cnt']; ?></b>
                                        </div>
                                        <span><input type="checkbox" value="<?php echo $albums['album_media_id']; ?>" class="select-photo" name="select-photo[]"></span> 
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


