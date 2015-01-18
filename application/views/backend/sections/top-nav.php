<!-- Wrapper required for sidebar transitions -->
<div class="st-container">
    <!-- Fixed navbar -->
    <div class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#sidebar-menu" data-toggle="sidebar-menu" data-effect="st-effect-3" class="toggle pull-left visible-xs">
                    <i class="fa fa-bars"></i>
                </a>

                <!-- Chat Toggle Button on Mobile -->
                <a href="#sidebar-chat" data-toggle="sidebar-menu" class="toggle pull-right visible-xs">
                    <i class="fa fa-comments"></i>
                </a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url();?>home" class="navbar-brand navbar-brand-primary hidden-xs"><?php echo $global['site_title'];?></a>
            </div>
            <div class="navbar-collapse collapse" id="collapse">
<!--                <form class="navbar-form navbar-left hidden-xs" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search... ">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>-->
                
                <ul class="nav navbar-nav navbar-right">
                    
                    
                    <li class="dropdown notifications hidden-xs hidden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <!--<span class="badge badge-primary">4</span>-->
                        </a>
<!--                        <ul class="dropdown-menu" role="notification">
                            <li class="dropdown-header">
                                Notifications
                            </li>
                            <li class="media">
                                <span class="label label-success pull-right">New</span>
                                <div class="media-body">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>media/backend/images/people/50/guy-2.jpg" alt="people" class="img-circle" width="20"> Adrian D.</a> posted a <i class="fa fa-photo"></i> <a href="#">photo</a> on his timeline.
                                    <small class="text-muted">5 min</small>
                                </div>
                            </li>
                            <li class="media">
                                <span class="label label-success pull-right">New</span>
                                <div class="media-body">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>media/backend/images/people/50/guy-6.jpg" alt="people" class="img-circle" width="20"> Bill
                                    </a> posted a <i class="fa fa-comments"></i> <a href="#">comment</a> on Adrian's recent <a href="#">post</a>.
                                    <small class="text-muted">3 hrs</small>
                                </div>
                            </li>
                            <li class="media">
                                <div class="media-body">
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>media/backend/images/people/50/woman-6.jpg" alt="people" class="img-circle" width="20"> Mary D.</a> and
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>media/backend/images/people/50/woman-3.jpg" alt="people" class="img-circle" width="20"> Michelle</a>
                                    are now friends.
                                    <small class="text-muted">1 day</small>
                                </div>
                            </li>
                        </ul>-->
                    </li>
                     
                    <li class="dropdown notifications hidden-xs hidden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <!--<span class="badge floating badge-danger">12</span>-->
                        </a>
<!--                        <ul class="dropdown-menu">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object thumb" src="<?php echo base_url(); ?>media/backend/images/people/50/guy-2.jpg" alt="people">
                                </a>
                                <div class="media-body">
                                    <span class="label label-default pull-right">5 min</span>
                                    <h5 class="media-heading">Adrian D.</h5>
                                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object thumb" src="<?php echo base_url(); ?>media/backend/images/people/50/woman-7.jpg" alt="people">
                                </a>
                                <div class="media-body">
                                    <span class="label label-default pull-right">2 days</span>
                                    <h5 class="media-heading">Jane B.</h5>
                                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object thumb" src="<?php echo base_url(); ?>media/backend/images/people/50/guy-8.jpg" alt="people">
                                </a>
                                <div class="media-body">
                                    <span class="label label-default pull-right">3 days</span>
                                    <h5 class="media-heading">Andrew M.</h5>
                                    <p class="margin-none">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                </div>
                            </li>
                        </ul>-->
                    </li>
                    
                    <?php $user_account = $this->session->userdata('user_account'); ?>
                    <li class="dropdown user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php
                            $abs_path = $this->common_model->absolutePath();
                            $picture = "";
                            $user_photo = ($user_account['admin_image'] != "" && file_exists($abs_path . 'media/backend/images/admin_user/' . $user_account['admin_image'])) ? base_url() . 'media/backend/images/admin_user/' . $user_account['admin_image'] : base_url() . 'media/front/UI-1-media/img/login-prof.png';
                            ?>
                            <img src="<?php echo $user_photo ?>" alt="" class="img-circle" /><?php echo $user_account['user_name'] ?><span class="caret"></span>      
                        </a>
                        <ul class="dropdown-menu" role="menu">
                           
                             <li><a href="<?php echo base_url(); ?>backend/admin/edit/<?php echo base64_encode($user_account['user_id']); ?>"><i class="fa fa-pencil"></i>Edit Profile</a>
                            </li>
                          
                             <li><a href="<?php echo base_url(); ?>backend/log-out"><i class="fa fa-sign-out"></i>Logout</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </div>