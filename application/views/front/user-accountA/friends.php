<div id="content">
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
            <div class="cover overlay">
                <img src="<?php echo base_url()?>media/front/UI-2-media/images/profile-cover.jpg" alt="cover" />
                <a href="#" class="btn btn-cover"><i class="fa fa-pencil fa-fw"></i></a>
            </div>
            <div id="filter">
                <form class="form-inline">
                    <label>Filter:</label>
                    <select name="users-filter" id="users-filter-select" class="selectpicker" data-style="btn-primary" data-width="auto">
                        <option value="all">All</option>
                        <option value="innercircle">Inner Circle</option>
                        <option value="outercircle">Outer Circle</option>
                    </select>
                    <div id="users-filter-trigger">
                        <div class="select-friends hidden">
                            <select name="users-filter-friends" class="selectpicker" data-style="btn-primary" data-live-search="true">
                                <option value="0">Select Friend</option>
                                <option value="1">Mary D.</option>
                                <option value="2">Michelle S.</option>
                                <option value="3">Adrian Demian</option>
                            </select>
                        </div>
                        <div class="search-name hidden">
                            <input type="text" class="form-control" name="user-first" placeholder="First Last Name" id="name" />
                            <a href="#" class="btn btn-primary btn-sm hidden" id="user-search-name"><i class="fa fa-search"></i> Search</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="timeline row" data-toggle="gridalicious">
                <div class="timeline-block">
                    <div class="panel panel-default user-box">
                        <div class="panel-body">
                            <div class="media">
                                <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-6.jpg" alt="people" class="media-object img-circle pull-left" />
                                <div class="media-body">
                                    <a href="" class="username">Adrian D.</a>
                                    <div class="profile-icons">
                                        <span><i class="fa fa-calendar"></i> 372</span> <span><i class="fa fa-photo"></i> 43</span> <span><i class="fa fa-video-camera"></i> 3 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body bordered">
                            <p class="common-friends">Common Friends</p>
                            <div class="user-friend-list">
                                <a href="public-profile.html">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-4.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-1.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-7.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-2.jpg" alt="people" class="img-circle" />
                                </a>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="#" class="btn btn-default btn-sm">Follow <i class="fa fa-share"></i></a>
                        </div>
                    </div>
                </div>
                <div class="timeline-block">
                    <div class="panel panel-default user-box">
                        <div class="panel-body">
                            <div class="media">
                                <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-6.jpg" alt="people" class="media-object img-circle pull-left" />
                                <div class="media-body">
                                    <a href="" class="username">Adrian D.</a>
                                    <div class="profile-icons">
                                        <span><i class="fa fa-calendar"></i> 372</span> <span><i class="fa fa-photo"></i> 43</span> <span><i class="fa fa-video-camera"></i> 3 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body bordered">
                            <p class="common-friends">Common Friends</p>
                            <div class="user-friend-list">
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-9.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-2.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-8.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-5.jpg" alt="people" class="img-circle" />
                                </a>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="#" class="btn btn-default btn-sm">Follow <i class="fa fa-share"></i></a>
                        </div>
                    </div>
                </div>
                <div class="timeline-block">
                    <div class="panel panel-default user-box">
                        <div class="panel-body">
                            <div class="media">
                                <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-1.jpg" alt="people" class="media-object img-circle pull-left" />
                                <div class="media-body">
                                    <a href="" class="username">Adrian D.</a>
                                    <div class="profile-icons">
                                        <span><i class="fa fa-calendar"></i> 372</span> <span><i class="fa fa-photo"></i> 43</span> <span><i class="fa fa-video-camera"></i> 3 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body bordered">
                            <p class="common-friends">Common Friends</p>
                            <div class="user-friend-list">
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-2.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-9.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-1.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-6.jpg" alt="people" class="img-circle" />
                                </a>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="#" class="btn btn-default btn-sm">Follow <i class="fa fa-share"></i></a>
                        </div>
                    </div>
                </div>
                <div class="timeline-block">
                    <div class="panel panel-default user-box">
                        <div class="panel-body">
                            <div class="media">
                                <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-5.jpg" alt="people" class="media-object img-circle pull-left" />
                                <div class="media-body">
                                    <a href="" class="username">Adrian D.</a>
                                    <div class="profile-icons">
                                        <span><i class="fa fa-calendar"></i> 372</span> <span><i class="fa fa-photo"></i> 43</span> <span><i class="fa fa-video-camera"></i> 3 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body bordered">
                            <p class="common-friends">Common Friends</p>
                            <div class="user-friend-list">
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-1.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/guy-6.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-5.jpg" alt="people" class="img-circle" />
                                </a>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/50/woman-9.jpg" alt="people" class="img-circle" />
                                </a>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="#" class="btn btn-default btn-sm">Follow <i class="fa fa-share"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
      <?php $this->load->view('front/includes/ui2-footer'); ?>

        <!-- // Footer -->
        </div>


 <!-- Vendor Scripts Bundle -->
    <script src="<?php echo base_url();?>media/front/UI-2-media/js/vendor.min.js"></script>

    <!-- App Scripts Bundle -->
    <script src="<?php echo base_url();?>media/front/UI-2-media/js/scripts.min.js"></script>
    <script src="<?php echo base_url();?>media/front/UI-2-media/js/jquery.metisMenu.js"></script>

 <script>
	$(function() {

    $('#side-menu').metisMenu();

});
</script>
</body>
</html>