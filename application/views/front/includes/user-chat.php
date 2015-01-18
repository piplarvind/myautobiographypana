<!-- Chat box -->
<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
<div class="sidebar sidebar-chat right sidebar-size-2 sidebar-offset-0 chat-skin-white sidebar-visible-mobile" id=sidebar-chat>
    <div class="split-vertical">
        <div class="chat-search">
            <input type="text" class="form-control" placeholder="Search" readonly=""/>
        </div>
        <ul class="chat-filter nav nav-pills ">
            <li class="active"><a href="#" data-target="li">All</a>
            </li>
            <li><a href="#" data-target=".online">Online</a>
            </li>
            <li><a href="#" data-target=".offline">Offline</a>
            </li>
        </ul>
        <div class="split-vertical-body">
            <div class="split-vertical-cell">
                <div data-scrollable>
                    <ul class="chat-contacts">
                        
                        
                        <li class="online" data-user-id="1">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <?php if($arr_user_data['profile_picture'] !=''){ ?>
                                           <img src="<?php echo base_url();?>media/front/img/user-images/50/<?php echo $arr_user_data['profile_picture']; ?>" width="40" class="img-circle" /> 
                                       <?php } ?>

                                    </div>
                                    <div class="media-body">
                                        
                                        <?php if($user_session['user_role'] == '0'){ ?>
                                        <!--[Statr]For User A-->
                                        <div class="contact-name"><?php echo ucfirst(stripslashes($arr_user_data['first_name']))." ".  ucfirst(substr(stripslashes($arr_user_data['last_name']),0,1))."."; ?></div>
                                        <?php }else{ ?>
                                        <!--[Statr]For User B-->
                                            <div class="contact-name"><?php echo ucfirst(stripslashes($arr_user_data['name_of_institute'])); ?></div>
                                        <?php } ?>
                                        
                                        
                                        <small>"Free Today"</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        
                                    <div class="comming-soon-txt"> Comming soon</div>
                        
<!--                        <li class="online away" data-user-id="2">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-5.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Mary A.</div>
                                        <small>"Feeling Groovy"</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online" data-user-id="3">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-3.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Adrian D.</div>
                                        <small>Busy</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline" data-user-id="4">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-6.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Michelle S.</div>
                                        <small>Offline</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline" data-user-id="5">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-7.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Daniele A.</div>
                                        <small>Offline</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online" data-user-id="6">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-4.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Jake F.</div>
                                        <small>Busy</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online away" data-user-id="7">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-6.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Jane A.</div>
                                        <small>"Custom Status"</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline" data-user-id="8">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-8.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Sabine J.</div>
                                        <small>"Offline right now"</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online away" data-user-id="9">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-9.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Danny B.</div>
                                        <small>Be Right Back</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online" data-user-id="10">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/woman-8.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">Elise J.</div>
                                        <small>My Status</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online" data-user-id="11">
                            <a href="#">
                                <div class="media">
                                    <div class="pull-left">
                                        <span class="status"></span>
                                        <img src="<?php echo base_url(); ?>media/front/UI-2-media/images/people/110/guy-3.jpg" width="40" class="img-circle" />
                                    </div>
                                    <div class="media-body">
                                        <div class="contact-name">John J.</div>
                                        <small>My Status #1</small>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
   
</div>

<script id="chat-window-template" type="text/x-handlebars-template">
    <div class="panel panel-default">
       <div class="panel-heading" data-toggle="chat-collapse" data-target="#chat-bill">
        <a href="#" class="close"><i class="fa fa-times"></i></a>
        <a href="#">
        <img src="{{ user_image }}" width="40" class="pull-left">
        <span class="contact-name">{{user}}</span>
        </a>
       </div>
        <div class="panel-body" id="chat-bill">
        <div class="media">
      
        <div class="comming-soon-txt"> Comming soon</div>
       

        </div>
    </div>
    <input type="text" class="form-control" placeholder="Type message..." />
    </div>
</script>
<!--<script id="chat-window-template" type="text/x-handlebars-template">
    <div class="panel panel-default">
    <div class="panel-heading" data-toggle="chat-collapse" data-target="#chat-bill">
    <a href="#" class="close"><i class="fa fa-times"></i></a>
    <a href="#">
    <img src="{{ user_image }}" width="40" class="pull-left">
    <span class="contact-name">{{user}}</span>
    </a>
    </div>
    <div class="panel-body" id="chat-bill">
    <div class="media">
    <div class="pull-left">
    <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
    </div>
    <div class="media-body">
    <span class="message">Feeling Groovy?</span>
    </div>
    </div>
    <div class="media right">
    <div class="pull-right">
    <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
    </div>
    <div class="media-body">
    <span class="message">Yep.</span>
    </div>
    </div>
    <div class="media">
    <div class="pull-left">
    <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
    </div>
    <div class="media-body">
    <span class="message">This chat window looks amazing.</span>
    </div>
    </div>
    <div class="media right">
    <div class="pull-right">
    <img src="{{ user_image }}" width="25" class="img-circle" alt="people" />
    </div>
    <div class="media-body">
    <span class="message">Thanks!</span>
    </div>
    </div>
    </div>
    <input type="text" class="form-control" placeholder="Type message..." />
    </div>
</script>-->
<div class="chat-window-container"></div>