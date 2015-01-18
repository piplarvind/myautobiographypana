<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>media/front/UI-2-media/js/jquery.form.js"></script>
<link href="<?php echo base_url() ?>media/front/UI-2-media/css/video-js.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url() ?>media/front/UI-2-media/js/video.js"></script>
<script type="text/javascript">

    /* [START] : To post timeline details.*/
    var j = jQuery.noConflict();
    j(document).ready(function() {
        j('#upFile').change(function() {
        });
    });
    function postTimeLine()
    {
        j("#imageform").ajaxForm({
            success: function(msg) {
                
                j('#post_data').val('');
                j('#upFile').val('');
                j('#upDocFile').val('');
                j('#upVideoFile').val('');
                j('#btnSubmit').hide('');

            },
            target: '#new_images',
        }).submit();

    }

</script>

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
                            <li><a href="<?php echo base_url(); ?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                            <li><a href="<?php echo base_url(); ?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
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
                </div>

                <div class="A-timeline-page">
                    <h1 class="timeline-ttl"><?php echo stripslashes($arr_category_name[0]['category_name']); ?></h1>
                    <div class="row">
                        <div class="col-md-9">
                            <ul class="timeline-list">
                                <li class="media single-post">
                                    <div class="pull-left timeline-user-pic">
                                        <?php if ($arr_user_data['profile_picture'] != '') { ?>
                                            <a class="timeline-user-thumb" href="<?php echo base_url() ?>profile/<?php echo stripslashes($arr_user_data['user_name']); ?>" >
                                                <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture']; ?>" alt="<?php echo ucfirst(stripslashes($user_session['first_name'])); ?> Profile Photo" class="img-circle" width="80" />
                                            </a>
                                        <?php } ?>
                                        <div><a href="<?php echo base_url() ?>profile/<?php echo stripslashes($arr_user_data['user_name']); ?>"><?php echo ucfirst(stripslashes($user_session['user_name'])); ?></a></div>
                                        <div class="date"><div class="post-date-time-cont">
                                                <span class="life-event">Life event #<?php echo ($life_event_count + 1); ?></span>
                                                <div class="date-time"><p>Date: <?php echo date('d M'); ?></p>
                                                    <p>Time: <?php echo date('h:i A'); ?></p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="media-body">
                                        <form id="imageform" name='imageform' method="post" action='<?php echo base_url(); ?>ajax-images-upload' enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-xs-12 post-new-event">
                                                    <div class="panel panel-default share">
                                                        <div class="panel-heading panel-heading-gray title">
                                                            What&acute;s new
                                                        </div>
                                                        <div class="panel-body">
                                                            <textarea name="post_data" id="post_data" class="form-control share-text" rows="3" placeholder="Share your status..."></textarea>
                                                        </div>
                                                        <div class="panel-footer share-buttons">
                                                            <a class="upload-file" href="javascript:void(0);"><i class="fa fa-file-code-o"></i>
                                                                <input type="file" name="upDocFile[]" multiple id="upDocFile" onchange="showimagepreviews2(this)">
                                                            </a>
                                                            <a class="upload-file" href="javascript:void(0);"><i class="fa fa-photo"></i>
                                                                <input type="file" name="upFile[]" multiple id="upFile" onchange="showimagepreviews(this)">
                                                            </a>
                                                            <a class="upload-file" href="javascript:void(0);"><i class="fa fa-video-camera"></i>
                                                                <input  type="file" name="upVideoFile"  id="upVideoFile" onchange="showimagepreviews1(this)">
                                                            </a>
                                                            <div class="pull-right share-btns">

                                                                <select name="visibility" id="visibility" class="user btn btn-primary">
                                                                    <?php
                                                                    foreach ($arr_visibility as $visibility) {
                                                                        if ($visibility['visibility_id'] == '1' || $visibility['visibility_id'] == '2') {
                                                                            ?>
                                                                            <option value="<?php echo $visibility['visibility_id']; ?>"><?php echo stripslashes($visibility['visibility_name']); ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>


                                                                <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                                                                <input type="hidden" name="sub_category_id" id="sub_category_id" value="<?php echo $sub_category_id; ?>">
                                                                <button id="btnSubmit" name="btnSubmit" type="button" class="btn btn-primary btn-xs pull-right display-none" onclick="postTimeLine();">Post</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>

                            </ul>
                            <ul class="timeline-list" id="new_images"></ul>
                            <ul class="timeline-list">


                                <?php if (count($arr_get_time_line) > 0) { ?>

                                    <?php
                                    for ($i = 0; $i < count($arr_get_time_line); $i++) {
                                        ?>
                                        <li class="media single-post" id="loadCategoryDiv">
                                            <div class="pull-left timeline-user-pic">
                                                <?php if ($arr_get_time_line[$i]['profile_picture'] != '') { ?>        
                                                    <a class="timeline-user-thumb" href="<?php echo base_url() ?>profile/<?php echo stripslashes($arr_get_time_line[$i]['user_name']); ?>" >
                                                        <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_get_time_line[$i]['profile_picture']; ?>" alt="User Profile Photo" class="img-circle" width="80" />
                                                    </a>
                                                <?php } ?>
                                                <div><a href="<?php echo base_url() ?>profile/<?php echo stripslashes($arr_get_time_line[$i]['user_name']); ?>"><?php
                                                        if ($arr_get_time_line[$i]['user_role'] == '0') {
                                                            echo ucfirst(stripslashes($arr_get_time_line[$i]['first_name'])) . " " . ucfirst(substr(stripslashes($arr_get_time_line[$i]['last_name']), 0, 1)) . ".";
                                                        } else {
                                                            echo ucfirst(stripslashes($arr_get_time_line[$i]['user_name']));
                                                        }
                                                        ?></a></div>
                                                <div class="date">
                                                    <div class="post-date-time-cont">
                                                        <span class="life-event">Life event #<?php echo $life_event_count; ?></span>
                                                        <div class="date-time"><p>Date: <?php echo date('d M', strtotime($arr_get_time_line[$i]['timeline_posted_date'])); ?></p>
                                                            <p>Time: <?php echo date('h:i A', strtotime($arr_get_time_line[$i]['timeline_posted_date'])); ?></p></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="media-body">
                                                <div class="panel panel-default">

                                                    <?php if (count($arr_timeline_media[$i]) > 0) { ?>

                                                        <?php
                                                        if (count($arr_timeline_media[$i]) == 1) { #Show Single Image or Video
                                                            if ($arr_timeline_media[$i][0]['timeline_media_type'] == '0') {
                                                                ?>
                                                                <!--[Start] Show Single Image-->
                                                                <div class="panel-body">
                                                                    <div class="boxed">
                                                                        <div class="media">
                                                                            <a href="#" class="media-object pull-left">
                                                                                <?php if ($arr_timeline_media[$i][0]['timeline_media_path'] != '') { ?>
                                                                                    <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $arr_timeline_media[$i][0]['timeline_media_path']; ?>" alt="" width="80" />
                                                                                <?php } ?>
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <p><?php echo stripslashes($arr_get_time_line[$i]['timeline_post_data']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <ul class="icon-list">
                                                                            <li><i class="fa fa-star fa-fw"></i> 4.8</li>
                                                                            <li><i class="fa fa-clock-o fa-fw"></i> <?php echo relative_time($arr_get_time_line[$i]['timeline_posted_date']); ?></li>
                                                                            <li><i class="fa fa-graduation-cap fa-fw"></i> Beginner</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <!--[End] Show Single Image-->
                                                            <?php } else { ?>
                                                                <!--[Start] Show Single Video-->
                                                                <div class="panel-body">
                                                                    <?php echo stripslashes($arr_get_time_line[$i]['timeline_post_data']); ?>
                                                                </div>
                                                                <div class="videoWrapper">

                                                                    <iframe src="//player.vimeo.com/video/50522981?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>


     <!--<iframe src="<?php echo base_url() ?>media/front/post-video/<?php echo $video; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->

<!--                                                            <div class="video">
                                                                <video id="example_video_1"  style="margin:0px auto" class="video-js vjs-default-skin" controls preload="none"  width="500" height="271"
                                                                          poster="<?php echo base_url(); ?>media/front/img/video.png"
                                                                          data-setup="{}">
                                                                       <source src="<?php echo base_url(); ?>media/front/post-video/<?php echo $arr_timeline_media[$i][0]['timeline_media_path']; ?>" type="video/mp4">
                                                                       <source src="movie.ogg" type="video/ogg">
                                                                       <track kind="captions" src="<?php echo base_url(); ?>media/front/demo.captions.vtt" srclang="en" label="English"></track> Tracks need an ending tag thanks to IE9 
                                                                       <track kind="subtitles" src="<?php echo base_url(); ?>media/front/" srclang="en" label="English"></track> Tracks need an ending tag thanks to IE9 
                                                                </video>  
                                                            </div>-->
                                                                </div>

                                                                <!--[End] Show Single Video-->
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <!--[Start] Show multiple images-->
                                                        <?php if (count($arr_timeline_media[$i]) > 1) { ?>
                                                            <!-- [Start ]:IF multiple img-->

                                                            <div class="panel-body">
                                                                <p><?php echo stripslashes($arr_get_time_line[$i]['timeline_post_data']); ?></p>
                                                                <div class="timeline-added-images">
                                                                    <?php for ($j = 0; $j < count($arr_timeline_media[$i]); $j++) { ?>
                                                                        <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $arr_timeline_media[$i][$j]['timeline_media_path']; ?>" alt="" width="80" />
                                                                    <?php } ?>
                                                                </div>
                                                            </div>


                                                            <!-- [Start ]:IF multiple img-->
                                                        <?php } ?>
                                                        <!--[End] Show multiple images-->

                                                    <?php } else { ?>
                                                        <!--[Start: ] Show only post data-->    
                                                        <div class="panel-body">
                                                            <p><?php echo stripslashes($arr_get_time_line[$i]['timeline_post_data']); ?></p>
                                                        </div>
                                                        <!--[End: ] Show only post data-->    
                                                    <?php } ?>
                                                    <div class="view-all-comments"><a href="#"><i class="fa fa-comments-o"></i> View all</a> <?php echo count($arr_get_timeline_comments[$i]); ?> comments</div>
                                                    <ul class="comments" id="new_comment_<?php echo $arr_get_time_line[$i]['timeline_id']; ?>">
                                                        <?php for ($Tcomment = 0; $Tcomment < count($arr_get_timeline_comments[$i]); $Tcomment++) { 
                                                            
                                                            if($arr_get_timeline_comments[$i][$Tcomment]['user_role'] == '1'){ #user B
                                                                $show_name = ucfirst(stripslashes($arr_get_timeline_comments[$i][$Tcomment]['user_name']));
                                                            }else{
                                                                $show_name = ucfirst(stripslashes($arr_get_timeline_comments[$i][$Tcomment]['first_name'])) . " " . ucfirst(substr($arr_get_timeline_comments[$i][$Tcomment]['last_name'], 0, 1));
                                                            }
                                                            ?>
                                                            <li>
                                                                <div class="media">
                                                                    <?php if ($arr_get_timeline_comments[$i][$Tcomment]['profile_picture'] != '') { ?>
                                                                        <a href="javascript:void(0);" class="pull-left">
                                                                            <img src="<?php echo base_url(); ?>media/front/img/user-images/50/<?php echo $arr_get_timeline_comments[$i][$Tcomment]['profile_picture']; ?>" class="media-object" alt="<?php echo ucfirst(stripslashes($arr_get_timeline_comments[$i][$Tcomment]['first_name'])); ?> Profile Photo">
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($arr_get_timeline_comments[$i][$Tcomment]['user_id'] == $user_session['user_id']){ ?> 
                                                                    <div class="pull-right dropdown" data-show-hover="li">
                                                                        <a href="#" data-toggle="dropdown" class="toggle-button">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li><a href="#">Edit</a>
                                                                            </li>
                                                                            <li><a href="#">Delete</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <?php } ?>
                                                                    <div class="media-body">
                                                                        <a href="" class="comment-author"><?php echo $show_name; ?></a>
                                                                        <span><?php echo stripslashes($arr_get_timeline_comments[$i][$Tcomment]['comments']) ?></span>
                                                                        <div class="comment-date"><?php echo relative_time($arr_get_timeline_comments[$i][$Tcomment]['comments_posted_date']); ?></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php } ?>   
                                                    </ul>
                                                    <ul class="comments">
                                                        <li class="comment-form">
                                                            <form id="frm_institute_timeline_comment" name="frm_institute_timeline_comment" method="post" action="<?php echo base_url(); ?>comment-on-institute-time-line" onsubmit="return validateCommentFeedback(<?php echo $arr_get_time_line[$i]['timeline_id']; ?>)">
                                                                <div class="input-group">
                                                                    <input type="hidden" name="timeline_id" id="timeline_id" value="<?php echo $arr_get_time_line[$i]['timeline_id']; ?>">
                                                                    <input type="text" class="form-control post_comments" name="post_comments" id="post_comments_<?php echo $arr_get_time_line[$i]['timeline_id']; ?>" />
                                                                    <span class="input-group-btn">
                                                                        <!--<a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>-->
                                                                        <button type="submit" id="btnComment" class="btn btn-default">  <i class="fa fa-photo"></i></button>
                                                                        <img id="showLoader" style="display:none;" src="<?php echo base_url() ?>media/front/img/loader.gif">
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                <?php } else { ?>
                                    No Record found!
                                <?php } ?>
                            </ul>
                        </div>
                        <?php if (count($arr_get_time_line) > 0) { ?>

                            <div class="col-md-3">
                                <ul class="nav timeline-months">
                                    <li class="active"><a href="#october"><i class="fa fa-calendar fa-fw"></i>October</a>
                                    </li>
                                    <li><a href="#september"><i class="fa fa-calendar fa-fw"></i>September</a>
                                    </li>
                                    <li><a href="#august"><i class="fa fa-calendar fa-fw"></i>August</a>
                                    </li>
                                    <li><a href="#july"><i class="fa fa-calendar fa-fw"></i>July</a>
                                    </li>
                                    <li><a href="#june"><i class="fa fa-calendar fa-fw"></i>June</a>
                                    </li>
                                    <li><a href="#may"><i class="fa fa-calendar fa-fw"></i>May</a>
                                    </li>
                                </ul>
                            </div>

                        <?php } ?>
                    </div>
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">    
                </div>      
                <script type="text/javascript">


                    var j = jQuery.noConflict();
                    /* Validate Comment Field.*/
                    function validateCommentFeedback(id)
                    {
                        if (j("#post_comments_" + id).val() == "")
                        {
                            alert("Please enter your comment.");
                            return false;
                        }
                    }
                    
                    j(document).ready(function() {
                        /* [Start]:: Comments on TimeLine.*/
                        j('.post_comments').change(function() {
                            /*j('#btnComment').hide();
                             j('#showLoader').show();*/
                            j("#frm_institute_timeline_comment").ajaxForm({
                                success: function(msg) {
                                    var splitStr = msg.split('|');
                                    var id = splitStr[0];
                                    j('#new_comment_' + id).append(splitStr[1]);
                                    j('.post_comments').val('');
                                }
                            })
                        });
                    });

                    function reloadResult() {
                        jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>get-more-timeline",
                            data: {pg: jQuery("#offset_cnt").val(), category: jQuery("#category_id").val(), sub_category: jQuery("#sub_category_id").val()},
                            success: function(html)
                            {
                                if ($.trim(html) == "1")
                                {
                                    return false;
                                }
                                if (html)
                                {
                                    $("#loadCategoryDiv").append(html);
                                    var cnt = jQuery("#offset_cnt").val();
                                    jQuery("#offset_cnt").val((parseInt(cnt) + 3));
                                    var offset = jQuery("#offset_cnt").val();
                                    var final_cnt = jQuery("#final_cnt").val();
                                    if (parseInt(offset) > parseInt(final_cnt))
                                    {
                                        $('#load_more').hide();
                                    }
                                }
                            }
                        });
                    }
                    $(function() {
                        $('#side-menu').metisMenu();
                    });
                    /* [End] :: Upload album pictures  ajax */
                    function showimagepreviews(input) {
                        var file_name = input.files[0]['name'];
                        var arr_file = new Array();
                        arr_file = file_name.split('.');
                        var file_ext = arr_file[1];
                        switch (file_ext) {
                            case 'jpg':
                            case 'jpeg':
                            case 'png':
                            case 'gif':
                            case 'JPG':
                            case 'JPEG':
                            case 'PNG':
                            case 'GIF':
                                break;
                            default:
                                $('#upFile').replaceWith($('#upFile').val('').clone(true));
                                alert('Please upload valid images. eg : jpg | jpeg | png | gif');
                                return true;
                        }
                    }

                    function showimagepreviews1(input) {
                        var file_name = input.files[0]['name'];
                        var arr_file = new Array();
                        arr_file = file_name.split('.');
                        var file_ext = arr_file[1];
                        switch (file_ext) {
                            case 'avi':
                            case 'flv':
                            case 'wmv':
                            case 'mpeg':
                            case 'mp3':
                            case 'mp4':
                            case 'mov':
                            case 'ogg':
                                break;
                            default:
                                $('#upVideoFile').replaceWith($('#upVideoFile').val('').clone(true));
                                alert('Please upload valid videos. eg : avi | flv | wmv | mpeg | mp3 | mp4 | mov | ogg');
                                return true;
                        }
                    }
                    function showimagepreviews2(input) {
                        var file_name = input.files[0]['name'];
                        var arr_file = new Array();
                        arr_file = file_name.split('.');
                        var file_ext = arr_file[1];

                        switch (file_ext) {
                            case 'doc':
                            case 'docx':
                            case 'txt':
                            case 'pdf':
                                break;
                            default:
                                $('#upDocFile').replaceWith($('#upDocFile').val('').clone(true));
                                alert('Please upload valid videos. eg : doc | docx | txt | PDF');
                                return true;
                        }
                    }
                </script>
