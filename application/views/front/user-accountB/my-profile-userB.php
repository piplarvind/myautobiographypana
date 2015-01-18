<?php //  echo ".media/front/img/post-images/doc-img.png";die;?>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>
<script type="text/javascript" >
    function view_img(image_path,date)
    {
        var view_html = '';
        view_html+= '<img class="img-responsive" src="<?php echo base_url() ?>media/front/img/post-images/400x400/'+image_path+'" alt="Place">';

jQuery(".media_date").html(date);
        jQuery("#show_img").html(view_html);
        $('#showImageModal').modal('show');
    }
    
</script>
<script type="text/javascript">
    /* Start Create Album */
    var j = jQuery.noConflict();
    j(document).ready(function(e) {
        j("#frm-new-album").validate({
                      errorClass: 'text-danger',
            rules: {
                album_name: {
                    required: true,
                    remote: {
                    url: j('#base_url').val() + "chk-album-duplicate",
                    method: 'post'
                }
                }
            },
            messages: {
                album_name: {
                    required: "Please enter album name.",
                    remote: "This album already exist."
                }
            }
        });
        
        j('#frm-new-album').keypress(function(e){
            if ( e.which == 13 ) return false;
            //or...
            if ( e.which == 13 ) e.preventDefault();
        });
        
    });

    /* End Create Album */

</script> 
<script>

    function display() {
        $('#del').hide();
        $('#new_album_name').hide();
        
//        document.getElementById("del").style.display="none"
    }

    function display1() {
        $('#del').show();
        $('#new_album_name').show();

    }
    
    function display2() {
        $('#del').hide();
        $('#new_album_name').hide();

    }
    
    function display3() {
        $('#del').hide();
        $('#new_album_name').hide();

    }

</script>
<script type="text/javascript">
    
    j(document).ready(function() {
        j('#album_name').change(function() {
        });
    });
    function createAlbum()
    {
       
        if(j("#frm-new-album").valid()){
        j("#frm-new-album").ajaxForm({
            data: {
                
            },
            success: function(msg) {
              j("#profile").prepend(msg);
              j("#album_name").val('');
              
              $('#CreateAlbum').modal('hide');
            },
           // target: '#new_images'
        }).submit();
    }
         // return false;
    }
    /* [END] : To post timeline details.*/

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
                                        j('#photo_' + j(element).val()).remove();



                                    }
                                });
                                var picCount = j(".album-photos").children().length;
                                if (picCount == 0)
                                {
                                    j('.album-photos').html('<h2 id="no_photos">No photos added in this album</h2>').hide().fadeIn(1000);
                                    ;
                                }
                                //location.href = location.href;
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

<!-- sidebar effects OUTSIDE of st-pusher: -->

<!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
<!-- content push wrapper --><div class="st-pusher" id="content">

    <!-- sidebar effects INSIDE of st-pusher: -->

    <!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
    <!-- this is the wrapper for the content --><div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner">
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
                             <li><a href="<?php echo base_url();?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li><a href="<?php echo base_url();?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right hidden-xs">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a>
                            </li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
                 </nav>
            <div class="container-fluid">
                <?php
                $abs_path = $this->common_model->absolutePath();
                $user_photo = ($arr_user_data['profile_cover'] != "" && file_exists($abs_path . 'media/front/UI-2-media/images/cover-photos/' . $arr_user_data['profile_cover'])) ? base_url() . 'media/front/UI-2-media/images/cover-photos/' . $arr_user_data['profile_cover'] : base_url() . 'media/front/UI-2-media/images/cover-photos/user.jpg';
                ?>
                <div class="cover overlay hover cover-image-full cover-height-300-all">
                    <?php /*?><img src="<?php echo $user_photo; ?>" alt="cover" /><?php */?>
                       <div style="background:#fff url(<?php echo $user_photo; ?>) center center no-repeat;" class="cover-img"></div>
                    
                    <div class="overlay overlay-full overlay-hover overlay-bg-black">
<!--                        <div class="v-center">
                            <a class="btn btn-circle btn-lg btn-white" href=""><i class="fa fa-plus"></i></a>
                            <br/>
                            <a href="" class="text-h3">Update cover</a>
                        </div>-->
                    </div>
                </div>
                <div class="tabbable">
                     <div class="create-album-btn" id="new_album_name" style="display:none;">
                        <a href="#" data-toggle="modal"  data-target="#CreateAlbum" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Create  Album
                        </a>
                        <a href="javascript:void(0)" name="btn-delete" class="btn btn-primary" id="btn-delete">Delete</a>
                     </div>
                    <ul class="nav nav-tabs">
                        <li onclick="display();"  class="<?php echo $active_class_photo; ?>"><a href="#home" data-toggle="tab"><i class="fa fa-picture-o"></i> Photos</a></li>
                        <li onclick="display2();" ><a href="#files" data-toggle="tab"><i class="fa fa-picture-o"></i> Files</a></li>
                        <li onclick="display3();" ><a href="#videos" data-toggle="tab"><i class="fa fa-picture-o"></i> Videos</a></li>
                        <li onclick="display1()" class="<?php echo $active_class_album; ?>"><a href="#profile" data-toggle="tab"><i class="fa fa-folder"></i> Albums</a></li>
                    </ul>
                    <div class="tab-content">
                        
                        <div class="user-pics tab-pane fade <?php echo $active_class_photo_in; ?>" id="home">

                            <?php
                            if(count($timelinephotolist['timeline_image'])) {
                            for ($i = 0; $i < count($timelinephotolist['timeline_image']); $i++) { 
                                if($i < 10 ){?>
<!--                                    <a style="background:#fff url(<?php echo base_url() ?>media/front/img/post-images/thumbs/<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']; ?>) center center no-repeat;" href="#" data-toggle="modal" onclick="view_img('<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']; ?>','<?php echo date("d M Y h:i:s A",strtotime($timelinephotolist['timeline_image'][$i]['timeline_posted_date'])); ?>');"></a>-->
                                    <a href="#" data-toggle="modal" onclick="view_img('<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']; ?>','<?php echo date("d M Y h:i:s A",strtotime($timelinephotolist['timeline_image'][$i]['timeline_posted_date'])); ?>');">
                                    <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']?>" alt="image" />
                                    </a>
                            <?php } } ?>
                            
                            <?php if(count($timelinephotolist['timeline_image'])>=9){?>
                            <a href="<?php echo base_url()?>gallery/<?php echo stripslashes($arr_user_data['user_name']); ?>"><img src="<?php echo base_url(); ?>media/front/img/post-images/see-more-photos.jpg"> </a>
                            <?php }?>
                            
                            <?php }
                            else{
                                echo "No timeline image";
                            }
                            ?>   
                        </div>
                        
                        <div class="tab-pane fade " id="files">
                            
                           <?php  if(count($timelinephotolist['timeline_files'])) { 
                                   for ($i = 0; $i < count($timelinephotolist['timeline_files']); $i++) { ?>
                            <a href="<?php echo base_url()?>media/front/img/post-images/<?php echo $timelinephotolist['timeline_files'][$i]['timeline_media_path']?>">
                                <img src="<?php echo base_url(); ?>media/front/img/post-images/images1.jpeg" alt="file" />
                            </a>
                           <?php } }
                           else {
                               echo "No timeline file";
                           }
                        ?>   
                        </div>
                        
                        <div class="tab-pane fade " id="videos">
                            <div class="videoWrapper" >
                                <?php   
                                if(count($timelinephotolist['timeline_videos'])) { 
                                    for ($i = 0; $i < count($timelinephotolist['timeline_videos']); $i++) { ?>
                                <iframe width="500" height="271" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php echo base_url();?>media/front/post-video/<?php echo $timelinephotolist['timeline_files'][$i]['timeline_media_path']?>"></iframe>
                                <?php } }
                                else {
                                     echo "No timeline video";
                                }?>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade album-list <?php echo $active_class_album_in; ?>" id="profile">
                            
                             <?php
                    if (!empty($user_albums)) {
                        foreach ($user_albums as $key => $albums) {
                            $front_photo = (empty($albums['front_photo'])) ? "no_image.jpeg" : $albums['front_photo'][0]['album_image_path'];
                            ?>
                            <div id="photo_<?php echo $albums['album_id']; ?>" class="single-album album_<?php echo $albums['album_id']; ?>">
                                <span class="select_item"><input type="checkbox" value="<?php echo $albums['album_id']; ?>" class="select-photo" name="select-photo[]"></span>
                                <a href="<?php echo base_url() ?>show-album-images/<?php echo base64_encode($albums['album_id']); ?>">

                                    <img  title="<?php echo stripcslashes($albums['album_name']); ?>" <?php if ($front_photo == "no_image.jpeg") { ?> src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/<?php echo $front_photo; ?>" <?php } else { ?>src="<?php echo base_url(); ?>media/front/UI-2-media/images/album_photos/120x120/<?php echo $front_photo; ?>" <?php } ?>>
                                </a>
                                <div class="album-info">
                                    <div class="album-name"><a href="<?php echo base_url() ?>show-album-images/<?php echo base64_encode($albums['album_id']); ?>"><?php echo stripcslashes($albums['album_name']); ?></a></div>
                                    <div class="photos-no">Photos:<b><?php echo $albums['photos_count'][0]['cnt']; ?></b></div>
                                    <div class="basic-info">
                                        <div class="album-craeted-on">created date<b><?php echo  date('d M Y', strtotime($albums['created_date'])); ?></b></div>
                                        <div class="album-craeted-by">By: <?php echo $user_session['user_name']; ?> </div>
                                        
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo 'No album present';
                    }
                    ?>
                            <!--<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>-->
                        </div>
                        <div class="tab-pane fade" id="dropdown1">
                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div>
                        <div class="tab-pane fade" id="dropdown2">
                            <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-6">

                        <!--Friends -->
                        <div class="panel panel-default profile-about userb-prof-abt">
                            <div class="panel-heading panel-heading-gray">
                                <a href="#" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                                <i class="fa fa-info-circle"></i> About
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled profile-about">
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Name</span>
                                            </div>
                                            <div class="col-sm-8"><?php echo $arr_user_data['user_name'];?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Date of Birth</span>
                                            </div>
                                            <div class="col-sm-8"><?php echo date('d M,Y', strtotime($arr_user_data['date_of_birth'])); ?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Job</span>
                                            </div>
                                            <div class="col-sm-8">Specialist</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Gender</span>
                                            </div>
                                            <div class="col-sm-8"><?php if($arr_user_data['gender'] == '1') {echo "Male" ; } else { echo "Female"; }?></div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Lives in</span>
                                            </div>
                                            <div class="col-sm-8"><?php echo $arr_user_data['address_1']?>,<?php echo $arr_user_data['address_2']?></div>
                                        </div>
                                    </li>
<!--                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4"><span class="text-muted">Credits</span>
                                            </div>
                                            <div class="col-sm-8">249</div>
                                        </div>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
        
        <div class="modal fade" id="CreateAlbum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create new album</h4>
                </div>

                <form name="frm-new-album" class="form-horizontal"  id="frm-new-album" action="<?php echo base_url();?>my/album" method="POST" enctype="multipart/form-data">     
                    <div class="modal-body">
                        <div class="form-group">
                            <label  class="col-xs-12 col-sm-3 lable-control"> Album Name :</label>
                            <div class="col-xs-12 col-sm-9">
                                <input type="text" class="form-control" id="album_name" name="album_name">
                                <input class="form-control" type="hidden" value="<?php echo base_url() ?>" id="base_url" name="base_url" />
                                  <?php echo form_error('album_name'); ?>
                                 <input type="hidden" id="old_album_name" name="old_album_name" value="">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" name="btn-create" id="btn-create" class="btn btn-primary" onclick="createAlbum();" value="Save changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
        
    </div>
    
    <div class="modal fade image-gallery-item" id="showImageModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-header">
                            <!--<div class="album-name pull-left">Album name</div>-->
                            <div class="pull-right picture-info">
                                <p><strong>Uploaded on :</strong> <span class="media_date"></span></p>
                                <!--<p><strong>Time :</strong> <?php echo  date('H i A', strtotime($arr_timeline_photos[0]['timeline_posted_date'])); ?></p>-->
                                
                                
                            </div>
                            </div>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div id="show_img"></div>
                    </div>
                </div>
