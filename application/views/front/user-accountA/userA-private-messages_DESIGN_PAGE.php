<!-- sidebar effects OUTSIDE of st-pusher: -->

<!-- st-effect-1, st-effect-2, st-effect-4, st-effect-5, st-effect-9, st-effect-10, st-effect-11, st-effect-12, st-effect-13 -->
<!-- content push wrapper --><div class="st-pusher" id="content">

    <!-- sidebar effects INSIDE of st-pusher: -->

<!-- st-effect-3, st-effect-6, st-effect-7, st-effect-8, st-effect-14 -->
<!-- this is the wrapper for the content --><div class="st-content">

        <!-- extra div for emulating position:fixed of the menu -->
<div class="st-content-inner">
    <nav class="navbar navbar-subnav navbar-static-top" role="navigation">
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
                    <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline"><i class="fa fa-fw icon-ship-wheel"></i>My Timeline</a></li>
                    <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student-my-profile"><i class="fa fa-fw icon-user-1"></i> About</a></li>
                    <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>student/user-manage-friends"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="chat-box">Chat <i class="fa fa-fw fa-comment-o"></i></a></li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
            </div>
    </nav>
    <div class="container-fluid">
        <div class="media messages-container">
            <div class="messages-list pull-left">
                <div class="panel panel-default">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-5.jpg" width="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Today</span>
                                        <span class="user">Mary D.</span>
                                        <div class="message">Are we ok to meet...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-3.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-4.jpg" width="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">5 days</span>
                                        <span class="user">Michelle A.</span>
                                        <div class="message">Nice design.</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-3.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Sue T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-9.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-9.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-6.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-2.jpg" height="50" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>
                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="media-body">
                <div class="panel panel-default share">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a class="btn btn-primary" href="#">
                                <i class="fa fa-envelope"></i> Send
                            </a>
                        </div>

                        <!-- /btn-group -->
                        <input type="text" class="form-control share-text" placeholder="Write message..." />
                    </div>

                    <!-- /input-group -->
                    </div>
                <div class="media">
                    <div class="pull-left media-object">
                        <a href="#">
                            <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-5.jpg" width="60" alt="" />
                        </a>
                    </div>
                    <div class="media-body message">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-white">
                                <div class="pull-right">
                                    <small class="text-muted">2 min ago</small>
                                </div>
                                <a href="#">Mary D.</a>
                            </div>
                            <div class="panel-body">
                                Hi Bill,
                                <br/> Is it ok if we schedule the meeting tomorrow?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-right media-object">
                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-5.jpg" width="60" alt="" />
                    </div>
                    <div class="media-body message">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-white">
                                <div class="pull-right">
                                    <small class="text-muted">10 min ago</small>
                                </div>
                                <a href="#">Me</a>
                            </div>
                            <div class="panel-body">
                                Are we still on for Today?
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-left media-object">
                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-5.jpg" width="60" alt="" />
                    </div>
                    <div class="media-body message">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-white">
                                <div class="pull-right">
                                    <small class="text-muted">1 day ago</small>
                                </div>
                                <a href="#">Mary D.</a>
                            </div>
                            <div class="panel-body">
                                Cool. It's settled. Tomorrow will discuss the project.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="pull-right media-object">
                        <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-5.jpg" width="60" alt="" />
                    </div>
                    <div class="media-body message">
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-white">
                                <div class="pull-right">
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <a href="#">Me</a>
                            </div>
                            <div class="panel-body">
                                I suggest a meeting on Tuesday. What do you think?
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
