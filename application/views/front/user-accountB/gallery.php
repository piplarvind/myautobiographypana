<div class="st-pusher" id="content">

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
                        <?php if ($user_session['user_role'] == '0') { #For User A ?>
                            <ul class="nav navbar-nav">
                                <li <?php if ($this->uri->segment(1) == 'usera-private-timeline') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                                <li <?php if ($this->uri->segment(1) == 'student-my-profile') { ?> class="active" <?php } ?>><a href="<?php echo base_url() ?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                                <li <?php if ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends') { ?> class="active" <?php } ?>><a href="<?php echo base_url() ?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                            </ul>
                        <?php } else { ?>
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo base_url(); ?>institute-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                                <li><a href="<?php echo base_url(); ?>institution-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                            </ul>
                        <?php } ?>

                        <ul class="nav navbar-nav navbar-right hidden-xs">
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
<!--                    <img src="<?php echo $user_photo; ?>" alt="cover" />-->
                    <div style="background:#fff url(<?php echo $user_photo; ?>) center center no-repeat;" class="cover-img"></div>
                </div>
                <h1>Gallery</h1>
                <!------ New gallery end---->
                <div id="grid-gallery" class="grid-gallery">
                    <section class="grid-wrap">
                        <ul class="grid">
                            <li class="grid-sizer"></li><!-- for Masonry column width -->
                            <?php for ($i = 0; $i < count($timelinephotolist['timeline_image']); $i++) { ?>
                            <li>
                                <figure style="background:#fff url(<?php echo base_url() ?>media/front/img/post-images/400x400/<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']; ?>) center center no-repeat;"></figure>
                            </li>
                            <?php } ?>
                        </ul>
                    </section><!-- // grid-wrap -->
                    <section class="slideshow">
                        <ul>
                        <?php for ($i = 0; $i < count($timelinephotolist['timeline_image']); $i++) { ?>
                            <li>
                                <figure>
                                    <figcaption>
                                        <h3><?php echo stripslashes($timelinephotolist['timeline_image'][$i]['category_name']); ?></h3>
                                        <div class="picture-info">
                                            <p><strong>Uploaded on :</strong> <span class="media_date"><?php echo date('d M Y H:i:s A', strtotime($timelinephotolist['timeline_image'][$i]['timeline_posted_date'])); ?></span></p>
                                        </div>
                                    </figcaption>
                                    <img src="<?php echo base_url() ?>media/front/img/post-images/<?php echo $timelinephotolist['timeline_image'][$i]['timeline_media_path']; ?>" alt="img01"/>
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
                <!------ New gallery end---->







