
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
            <div class="panel panel-default">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#home" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i> Photos</a>
                    </li>
                    <li class=""><a href="#profile" role="tab" data-toggle="tab"><i class="fa fa-folder"></i> Albums</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home">
                        <img src="images/place1.jpg" alt="image" />
                        <img src="images/place2.jpg" alt="image" />
                        <img src="images/food1.jpg" alt="image" />
                    </div>
                    <div class="tab-pane fade" id="profile">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                    </div>
                    <div class="tab-pane fade" id="dropdown1">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                    </div>
                    <div class="tab-pane fade" id="dropdown2">
                        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <!--Friends -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">
                            <a href="#" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                            <i class="fa fa-info-circle"></i> About
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled profile-about">
                                <li>
                                    <div class="row">
                                        <div class="col-sm-4"><span class="text-muted">Date of Birth</span>
                                        </div>
                                        <div class="col-sm-8">12 January 1990</div>
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
                                        <div class="col-sm-8">Male</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-sm-4"><span class="text-muted">Lives in</span>
                                        </div>
                                        <div class="col-sm-8">Miami, FL, USA</div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-sm-4"><span class="text-muted">Credits</span>
                                        </div>
                                        <div class="col-sm-8">249</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <!--Friends -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">
                            <a href="#" class="btn btn-primary btn-xs pull-right">Add <i class="fa fa-plus"></i></a>
                            <i class="icon-user-1"></i> Friends
                        </div>
                        <ul class="list-unstyled friends-list">
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-6.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-3.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-2.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="images/people/110/guy-9.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-9.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-4.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-1.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/woman-4.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/people/110/guy-6.jpg" alt="image" class="img-responsive" />
                                </a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-gray">
                    <i class="fa fa-bookmark"></i> Bookmarks
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="#" class="h5 margin-none">Climb a Mountain</a>
                                    <div class="text-muted">
                                        <small><i class="fa fa-calendar"></i> 24/10/2014</small>
                                    </div>
                                </div>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/place1-full.jpg" alt="image" class="img-responsive" />
                                </a>
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor impedit ipsum laborum maiores tempore veritatis....</p>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-xs pull-right">read</a>
                                        <a href="#" class="text-muted"> <i class="fa fa-comments"></i> 6</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <a href="#" class="h5 margin-none">Vegetarian Pizza</a>
                                    <div class="text-muted">
                                        <small><i class="fa fa-calendar"></i> 24/10/2014</small>
                                    </div>
                                    <div class="rating">
                                        <span class="star"></span>
                                        <span class="star filled"></span>
                                        <span class="star filled"></span>
                                        <span class="star filled"></span>
                                        <span class="star filled"></span>
                                    </div>
                                </div>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/food1-full.jpg" alt="image" class="img-responsive" />
                                </a>
                                <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor impedit ipsum laborum maiores tempore veritatis....</p>
                                    <div>
                                        <a href="#" class="btn btn-primary btn-xs pull-right">read</a>
                                        <a href="#" class="text-muted"> <i class="fa fa-comments"></i> 6</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <a href="#" class="btn btn-success btn-xs pull-right"><i class="fa fa-check-circle"></i></a>
                                    <a href="#" class="h5">Win a Holiday</a>
                                    <div class="text-muted">
                                        <small><i class="fa fa-calendar"></i> 24/10/2014</small>
                                    </div>
                                </div>
                                <a href="#">
                                    <img src="<?php echo base_url()?>media/front/UI-2-media/images/place2-full.jpg" alt="image" class="img-responsive" />
                                </a>
                                <div class="panel-body">
                                    <ul class="icon-list block bordered">
                                        <li><i class="fa fa-calendar fa-fw"></i> <a href="#">1 Week</a>
                                        </li>
                                        <li><i class="fa fa-users fa-fw"></i> <a href="#"> 2 People</a>
                                        </li>
                                        <li><i class="fa fa-map-marker fa-fw"></i> <a href="#">Miami, FL, USA</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php $this->load->view('front/includes/ui2-footer'); ?>

        <!-- // Footer -->
        </div>

<!-- Vendor Scripts Bundle --><script src="<?php echo base_url();?>media/front/UI-2-media/js/vendor.min.js"></script>

    <!-- App Scripts Bundle -->
    <script src="<?php echo base_url();?>media/front/UI-2-media/js/scripts.min.js"></script>
</body>
</html>