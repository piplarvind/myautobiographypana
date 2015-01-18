
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
                   <ul class="nav navbar-nav navbar-right">
                       <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                   </ul>
                </div>

                <!-- /.navbar-collapse -->
            </div>
        </nav>
            <div class="container-fluid">
                
                <?php $this->load->view('front/includes/user-cover-photo',$data); ?>
<h1 class="timeline-ttl">Timeline</h1>
                
                
                <div class="row">
                    <div class="col-md-9">
                        <ul class="timeline-list">
                            <li class="media single-post">
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-5.jpg" alt="people" class="img-circle" width="80" />
                                    <div><a class="user-name-link" href="#">Adrian D.</a></div>
                                    <div class="date"><div class="post-date-time-cont">
                                <span class="life-event">Life event #50</span>
                                <div class="date-time"><p>Date: 19 OCT</p>
                                <p>Time: 04:00 PM</p></div>
                                </div></div>
                                </div>
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-xs-12 post-new-event">
                                            <div class="panel panel-default share">
                                                <div class="panel-heading panel-heading-gray title">
                                                    What&acute;s new
                                                </div>
                                                <div class="panel-body">
                                                    <textarea name="status" class="form-control share-text" rows="3" placeholder="Share your status..."></textarea>
                                                </div>
                                                <div class="panel-footer share-buttons">
                                                    <a href="#"><i class="fa fa-file-code-o"></i></a>
                                                    <a href="#"><i class="fa fa-photo"></i></a>
                                                    <a href="#"><i class="fa fa-video-camera"></i></a>
                                                    <div class="pull-right share-btns">
                                                    <select class="user btn btn-primary">
                                                    <option>Public</option>
                                                    <option>Private</option>
                                                    </select>
                                                    
                                                    <button type="submit" class="btn btn-primary btn-xs pull-right display-none" href="#">Post</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                            <li class="media single-post">
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-9.jpg" alt="people" class="img-circle" width="80" />
                                    <div><a href="#">Michelle D.</a>
                                    </div>
                                    <div class="date"><div class="post-date-time-cont">
                                <span class="life-event">Life event #50</span>
                                <div class="date-time"><p>Date: 19 OCT</p>
                                <p>Time: 04:00 PM</p></div>
                                </div></div>
                                </div>
                                <div class="media-body">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <p>Late Night Show Photos</p>
                                            <div class="timeline-added-images">
                                                <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/social/100/1.jpg" width="80" alt="photo" />
                                                <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/social/100/2.jpg" width="80" alt="photo" />
                                                <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/social/100/3.jpg" width="80" alt="photo" />
                                            </div>
                                        </div>
                                        <div class="view-all-comments"><a href="#"><i class="fa fa-comments-o"></i> View all</a> 10 comments</div>
                                        <ul class="comments">
                                            <li>
                                                <div class="media ">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/guy-5.jpg" class="media-object">
                                                    </a>
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
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Bill D.</a>
                                                        <span>Hi Mary, Nice Party</span>
                                                        <div class="comment-date">21st September</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/woman-5.jpg" class="media-object">
                                                    </a>
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
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Mary</a>
                                                        <span>Thanks Bill</span>
                                                        <div class="comment-date">2 days</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/guy-5.jpg" class="media-object">
                                                    </a>
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
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Bill D.</a>
                                                        <span>What time did it finish?</span>
                                                        <div class="comment-date">14 min</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="media single-post">
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-5.jpg" alt="people" class="img-circle" width="80" />
                                    <div class="date"><div class="post-date-time-cont">
                                <span class="life-event">Life event #50</span>
                                <div class="date-time"><p>Date: 19 OCT</p>
                                <p>Time: 04:00 PM</p></div>
                                </div></div>
                                </div>
                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-8">
                                            <div class="panel panel-default">
                                                <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/place1-full.jpg" class="img-responsive">
                                                <ul class="comments">
                                                    <li>
                                                        <div class="media">
                                                            <a href="" class="pull-left">
                                                                <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/woman-5.jpg" class="media-object">
                                                            </a>
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
                                                            <div class="media-body">
                                                                <a href="" class="comment-author">Mary</a>
                                                                <span>Wow</span>
                                                                <div class="comment-date">2 days</div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="comment-form">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" />
                                                            <span class="input-group-btn">
                                                                <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="media single-post" id="september">
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-5.jpg" alt="people" class="img-circle" width="80" />
                                    <div class="date"><div class="post-date-time-cont">
                                <span class="life-event">Life event #50</span>
                                <div class="date-time"><p>Date: 19 OCT</p>
                                <p>Time: 04:00 PM</p></div>
                                </div></div>
                                </div>
                                <div class="media-body">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            Amazing 3D Animation
                                        </div>
                                        <div class="videoWrapper">
                                            <iframe src="//player.vimeo.com/video/50522981?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="500" height="271" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        </div>
                                        <div class="view-all-comments"><i class="fa fa-comments-o"></i> Be the first to comment</div>
                                        <ul class="comments">
                                            <li class="comment-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            
                            
                            
                            <li class="media single-post">
                                <div class="pull-left timeline-user-pic">
                                    <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-5.jpg" alt="people" class="img-circle" width="80" />
                                    <div class="date"><div class="post-date-time-cont">
                                <span class="life-event">Life event #50</span>
                                <div class="date-time"><p>Date: 19 OCT</p>
                                <p>Time: 04:00 PM</p></div>
                                </div></div>
                                </div>
                                <div class="media-body">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad blanditiis perspiciatis praesentium quaerat repudiandae soluta? Cum doloribus esse et eum facilis impedit officiis omnis optio, placeat, quia quo reprehenderit sunt velit? Asperiores cumque deserunt eveniet hic reprehenderit sit, ut voluptatum?</p>
                                        </div>
                                        <div class="view-all-comments"><a href="#"><i class="fa fa-comments-o"></i> View all</a> 10 comments</div>
                                        <ul class="comments">
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/woman-5.jpg" class="media-object">
                                                    </a>
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
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Mary</a>
                                                        <span>Thanks Bill</span>
                                                        <div class="comment-date">2 days</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="media">
                                                    <a href="" class="pull-left">
                                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/50/guy-5.jpg" class="media-object">
                                                    </a>
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
                                                    <div class="media-body">
                                                        <a href="" class="comment-author">Bill D.</a>
                                                        <span>What time did it finish?</span>
                                                        <div class="comment-date">14 min</div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="comment-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" />
                                                    <span class="input-group-btn">
                                                        <a href="" class="btn btn-default"><i class="fa fa-photo"></i></a>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
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
                        <div class="ad-block"><img src="<?php echo base_url(); ?>media/front/UI-2-media/images/ad1.jpg"></div>
                                 <div class="ad-block"><img src="<?php echo base_url(); ?>media/front/UI-2-media/images/ads.jpg"></div>
                    </div>
                </div>
