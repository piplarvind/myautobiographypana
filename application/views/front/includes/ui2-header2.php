                       
<input type="hidden" name="site_url" id="site_url" value="<?php echo base_url(); ?>">
<script>
    function get_notification()
    {
        var js_path = $('#site_url').val();

        var obj_params = new Object();

        $.ajax({
            type: "POST",
            data: obj_params,
            url: js_path + "get-user-notification",
            success: function(fdata) {

                var obj = JSON.parse(fdata);

                var view_html = '';

                for (var i = 0; i < obj.arr_user_notification.length; i++) {

                    view_html += '<li>';
                    view_html += '<div class="media">';
                    view_html += '<a href="#" class="single-notification">';
                    view_html += '<span class="pull-left noti-img"><img src="<?php echo base_url() ?>media/front/img/user-images/thumbs/' + obj.arr_user_notification[i]['profile_picture'] + '"></span>';
                    view_html += '<div class="media-body">';
                    view_html += '<p>' + stripslashes(obj.arr_user_notification[i]['subject']) + '</p>';
                    view_html += '<div class="noti-time"><i class="fa fa-clock-o"></i> ' + obj.posted_date[i] + '</div>';
                    view_html += '</div>';
                    view_html += '</a>';
                    view_html += '<span class="read-noti"><a href="javascript:void(0);" class="unread-noti" onclick="delete_notification(' + obj.arr_user_notification[i]['notifications_id'] + ')"></a></span>';
                    view_html += '</div>';
                    view_html += '</li>';

                }

                view_html += '<li class="text-center"><a href="<?php echo base_url(); ?>show-user-notification">View all</a></li>';

                jQuery("#view_notification").html(view_html);

                jQuery("#notification_count").html('0');

            }
        });
    }


    function delete_notification(notification_id) {

        var notification_id = notification_id;
//alert(notification_id);


    }


    function stripslashes(str) {
        return (str + '')
                .replace(/\\(.?)/g, function(s, n1) {
                    switch (n1) {
                        case '\\':
                            return '\\';
                        case '0':
                            return '\u0000';
                        case '':
                            return '';
                        default:
                            return n1;
                    }
                });
    }
</script>
</head>
<body>

    <!-- Wrapper required for sidebar transitions -->
    <div class="st-container">

        <?php if($user_session['user_type'] == '1'){?>
             <!-- For Users -->
            
        <?php if ($user_session['user_role'] == '0') { ?>
            <!--[Start]For User A--> 
            <div class="navbar navbar-main navbar-primary navbar-fixed-top usera-header" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
                    <a class="navbar-brand" href="<?php echo base_url();?>home"><?php echo stripslashes($global['site_title'])?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="nav navbar-nav custom-nav-left">
                        <li><a href="<?php echo base_url()?>home">Dashboard</a></li>
                        <li><a href="<?php echo base_url()?>tiles">Tiles</a></li>
                        <li><a href="<?php echo base_url()?>digital-record">Digital records</a></li>
                        <li class="search-sec">
                            <form>
                                <input type="text" placeholder="Comming soon..." class="form-control">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right custom-nav-right">
                       
			<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Institutional Brownies<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">

                             <?php foreach ($arr_category_list['institutional_list'] as $institutional_details) { ?>
                                    <!--<li><a href="<?php echo base_url()?>student-time-line/<?php echo base64_encode($institutional_details['category_id'])?>/<?php echo base64_encode($institutional_details['parent_id'])?>"><?php echo stripslashes($institutional_details['category_name']);?></a></li>-->
                                    <li><a href="<?php echo base_url()?>student-time-line/<?php echo $institutional_details['url'];?>"><?php echo stripslashes($institutional_details['category_name']);?></a></li>
        	             <?php }?>
                            </ul>
                        </li>

			<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Brownies<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <?php foreach ($arr_category_list['personal_list'] as $personal_details) { 
                                if($personal_details['category_id'] == '18'){ ?>
                                <li class="dropdown-submenu">
                                     <a tabindex="-1" href="javascript:void(0);"><?php echo stripslashes($personal_details['category_name']);?> </a>
                                        <ul class="dropdown-menu margin-left-3">
                                          <?php foreach ($arr_category_list['intrest_list'] as $intrest_details) {?>
                                            <li><a href="<?php echo base_url()?>student-time-line/<?php echo $intrest_details['url']?>"><?php echo stripslashes($intrest_details['category_name']);?></a></li>
<!--                                            <li><a href="<?php echo base_url()?>student-time-line/<?php echo base64_encode($intrest_details['category_id'])?>/<?php echo base64_encode($intrest_details['parent_id'])?>"><?php echo stripslashes($intrest_details['category_name']);?></a></li>-->
                                          <?php } ?>  
                                        </ul>
                                </li>
                                <?php }else{ ?>
                                    <li><a href="<?php echo base_url()?>student-time-line/<?php echo $personal_details['url'];?>"><?php echo stripslashes($personal_details['category_name']);?></a></li>
                                <?php } } ?>  
                             
                            </ul>
                        </li>
                            <li class="hidden-xs">
                            <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1">
                                <i class="fa fa-comments"></i>
                            </a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline">Timeline</a></li>
                        
                        <li class="dropdown notification-list">
                            <a href="#" class="dropdown-toggle user" data-toggle="dropdown" onClick="get_notification()">
                                Notifications <span class="count" id="notification_count"><?php echo $user_notification_count; ?></span> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu notification-drpdwn" role="menu" id="view_notification"></ul>
                        </li>
                        
                    
                        <li class="dropdown themes-link">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <span class="caret"></span></a>
                            <ul class="skins dropdown-menu dropdown-menu" role="menu">
                                <li><span data-skin="default" style="background: #16ae9f "></span></li>
                                <li><span data-skin="orange" style="background: #e74c3c "></span></li>
                                <li><span data-skin="blue" style="background: #4687ce "></span></li>
                                <li><span data-skin="purple" style="background: #af86b9 "></span></li>
                                <li><span data-skin="brown" style="background: #c3a961 "></span></li>
                                <li><span data-skin="default-nav-inverse" style="background: #242424 "></span></li>
                            </ul>
                        </li>

                        <!-- User -->
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                            <?php if($arr_user_data['profile_picture'] !=''){ ?>
                            <img src="<?php echo base_url();?>media/front/img/user-images/50/<?php echo $arr_user_data['profile_picture']; ?>" alt="<?php if($user_session['user_name']!=''){ echo stripcslashes($user_session['user_name']); }else{ echo stripslashes($user_session['first_name']); } ?>" class="img-circle" width="40" /> 
                            <?php } ?>
                            <?php if($user_session['user_name']!=''){ echo stripcslashes($user_session['user_name']); }else{ echo stripslashes($user_session['first_name']); } ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li <?php if($this->uri->segment(1) == 'student-my-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url(); ?>student-my-profile">My Profile</a></li>
                            <li <?php if($this->uri->segment(1) == 'student-user-profile'){ ?> class="active" <?php }?>><a href="<?php echo base_url() ?>student-user-profile"> Edit Profile</a></li>
                        <?php /*<li <?php if($this->uri->segment(1) == 'usera-private-timeline'){ ?> class="active" <?php }?>><a href="<?php echo base_url();?>usera-private-timeline">My Timeline</a></li> */?>
                            <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-manage-friends'){ ?> class="active" <?php }?>><a href="<?php echo base_url() ?>student/user-manage-friends"> My Friends</a></li>
                            <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-private-messages'){ ?> class="active" <?php }?>><a href="<?php echo base_url() ?>student/user-private-messages"> Messages</a></li>
                            <li <?php if($this->uri->segment(1) == 'gallery'){ ?> class="active" <?php }?>><a href="<?php echo base_url()?>gallery/<?php echo $arr_user_data['user_name']?>"> Gallery</a></li>
                            <li <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'user-account-setting'){ ?> class="active" <?php }?>><a href="<?php echo base_url() ?>student/user-account-setting"> Settings</a></li>
                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>

                <!-- /.navbar-collapse -->
                </div>
        </div>

            <!--[End]For User A--> 
        <?php } else {  ?>
            <!--[Start]For User B--> 
            <div class="navbar navbar-main navbar-primary navbar-fixed-top userb-nav" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
                        <a class="navbar-brand" href="<?php echo base_url()?>institute-private-timeline"><?php echo stripslashes($global['site_title']) ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="main-nav">
                        <ul class="nav navbar-nav custom-nav-left">
                            
                            <li><a href="<?php echo base_url()?>institute-private-timeline">Dashboard</a></li>
                            <li class="search-sec">
                                <form>
                                    <input type="text" placeholder="Comming soon..." class="form-control">
                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right custom-nav-right">
                        <li class="hidden-xs">
                                <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1">
                                    <i class="fa fa-comments"></i>
                                </a>
                            </li>
                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Timelines <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                 <?php
                                    foreach ($arr_category_list['digital_list'] as $digital_details) {
                                        if ($digital_details['category_id'] == '49') {
                                            ?>
                                            <li> <a href="<?php echo base_url() ?>institute-time-line/<?php echo $digital_details['url'] ?>"><?php echo stripslashes($digital_details['category_name']); ?></a></li>
<!--                                            <li> <a href="<?php echo base_url() ?>institute-time-line/<?php echo base64_encode($digital_details['category_id']) ?>/<?php echo base64_encode($digital_details['parent_id']) ?>"><?php echo stripslashes($digital_details['category_name']); ?></a></li>-->
                                        <?php
                                        }
                                    } ?>
                                <?php foreach ($arr_category_list['institutional_list'] as $institutional_details) { ?>
                                        <li><a href="<?php echo base_url() ?>institute-time-line/<?php echo $institutional_details['url'] ?>"><?php echo stripslashes($institutional_details['category_name']); ?></a></li>
<!--                                        <li><a href="<?php echo base_url() ?>institute-time-line/<?php echo base64_encode($institutional_details['category_id']) ?>/<?php echo base64_encode($institutional_details['parent_id']) ?>"><?php echo stripslashes($institutional_details['category_name']); ?></a></li>-->
                                <?php } ?>

                                </ul>
                            </li>

                            <li class="dropdown notification-list">
                                <a href="#" class="dropdown-toggle user" data-toggle="dropdown" onClick="get_notification()">
                                    Notifications <span class="count" id="notification_count"><?php echo $user_notification_count; ?></span> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu notification-drpdwn" role="menu" id="view_notification"></ul>
                            </li>

                            
                            <li class="dropdown themes-link">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <span class="caret"></span></a>
                                <ul class="skins dropdown-menu dropdown-menu" role="menu">
                                    <li><span data-skin="default" style="background: #16ae9f "></span></li>
                                    <li><span data-skin="orange" style="background: #e74c3c "></span></li>
                                    <li><span data-skin="blue" style="background: #4687ce "></span></li>
                                    <li><span data-skin="purple" style="background: #af86b9 "></span></li>
                                    <li><span data-skin="brown" style="background: #c3a961 "></span></li>
                                    <li><span data-skin="default-nav-inverse" style="background: #242424 "></span></li>
                                </ul>
                            </li>

                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                                    <?php if ($arr_user_data['profile_picture'] != '') { ?>
                                        <img src="<?php echo base_url(); ?>media/front/img/user-images/50/<?php echo $arr_user_data['profile_picture']; ?>" alt="<?php
                                        if ($user_session['user_name'] != '') {
                                            echo stripcslashes($user_session['user_name']);
                                        } else {
                                            echo stripslashes($user_session['name_of_institute']);
                                        }
                                        ?>" class="img-circle" width="40" /> 
                                         <?php } ?>
                                         <?php
                                         if ($user_session['user_name'] != '') {
                                             echo stripcslashes($user_session['user_name']);
                                         } else {
                                             echo stripslashes($user_session['name_of_institute']);
                                         }
                                         ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li <?php if ($this->uri->segment(1) == 'institution-my-profile') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>institution-my-profile">My Profile</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'institute-user-profile') { ?> class="active" <?php } ?>><a href="<?php echo base_url() ?>institute-user-profile"> Edit Profile</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'institute-private-timeline') { ?> class="active" <?php } ?>><a href="<?php echo base_url(); ?>institute-private-timeline">My Timeline</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'institute' && $this->uri->segment(2) == 'user-private-messages') { ?> class="active" <?php } ?>><a href="<?php echo base_url() ?>institute/user-private-messages"> Messages</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'gallery') { ?> class="active" <?php } ?>><a href="<?php echo base_url()?>gallery/<?php echo $arr_user_data['user_name']?>"> Gallery</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'institute' && $this->uri->segment(2) == 'user-account-setting') { ?> class="active" <?php } ?>><a href="<?php echo base_url() ?>institute/user-account-setting"> Settings</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'institute' && $this->uri->segment(2) == 'add-User-list') { ?> class="active" <?php } ?>><a  href="<?php echo base_url() ?>institute/add-User-list">User A List</a></li>
                                    <li <?php if ($this->uri->segment(1) == 'banner') { ?> class="active" <?php } ?>><a href="<?php echo base_url()?>institute/banner-management">Banner Management</a></li>
                                    <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                                </ul>

                            </li>
                        </ul>
                    </div>

                    <!-- /.navbar-collapse -->
                </div>
            </div>

            <!--[End]For User B--> 
        <?php } ?>
        <?php }else{ ?>
            <!-- For Admin -->
            
            <div class="navbar navbar-main navbar-primary navbar-fixed-top usera-header" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#sidebar-menu" data-effect="st-effect-1" data-toggle="sidebar-menu" class="toggle pull-left visible-xs"><i class="fa fa-ellipsis-v"></i></a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#sidebar-chat" data-toggle="sidebar-menu" data-effect="st-effect-1" class="toggle pull-right visible-xs"><i class="fa fa-comments"></i></a>
                    <a class="navbar-brand" href="<?php echo base_url();?>home"><?php echo stripslashes($global['site_title'])?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="main-nav">
                    <ul class="nav navbar-nav custom-nav-left">
                        <li><a href="<?php echo base_url()?>home">Dashboard</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right custom-nav-right">
			<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Brownies<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                              <?php foreach ($arr_category_list['personal_list'] as $personal_details) { 
                                if($personal_details['category_id'] == '18'){ ?>
                                <li class="dropdown-submenu">
                                     <a tabindex="-1" href="javascript:void(0);"><?php echo stripslashes($personal_details['category_name']);?> </a>
                                        <ul class="dropdown-menu margin-left-3">
                                          <?php foreach ($arr_category_list['intrest_list'] as $intrest_details) {?>
                                            <li><a href="<?php echo base_url()?>student-time-line/<?php echo $intrest_details['url']?>"><?php echo stripslashes($intrest_details['category_name']);?></a></li>
<!--                                            <li><a href="<?php echo base_url()?>student-time-line/<?php echo base64_encode($intrest_details['category_id'])?>/<?php echo base64_encode($intrest_details['parent_id'])?>"><?php echo stripslashes($intrest_details['category_name']);?></a></li>-->
                                          <?php } ?>  
                                        </ul>
                                </li>
                                <?php }else{ ?>
                                    <li><a href="<?php echo base_url()?>student-time-line/<?php echo $personal_details['url'];?>"><?php echo stripslashes($personal_details['category_name']);?></a></li>
<!--                                    <li><a href="<?php echo base_url()?>student-time-line/<?php echo base64_encode($personal_details['category_id'])?>/<?php echo base64_encode($personal_details['parent_id'])?>"><?php echo stripslashes($personal_details['category_name']);?></a></li>-->
                                <?php } } ?>  
                             
                            </ul>
                        </li>
                       
                        <li class="dropdown themes-link">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Themes <span class="caret"></span></a>
                            <ul class="skins dropdown-menu dropdown-menu" role="menu">
                                <li><span data-skin="default" style="background: #16ae9f "></span></li>
                                <li><span data-skin="orange" style="background: #e74c3c "></span></li>
                                <li><span data-skin="blue" style="background: #4687ce "></span></li>
                                <li><span data-skin="purple" style="background: #af86b9 "></span></li>
                                <li><span data-skin="brown" style="background: #c3a961 "></span></li>
                                <li><span data-skin="default-nav-inverse" style="background: #242424 "></span></li>
                            </ul>
                        </li>

                        <!-- User -->
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle user" data-toggle="dropdown">
                            <?php if($arr_user_data['profile_picture'] !=''){ ?>
                            <img src="<?php echo base_url();?>media/front/img/user-images/50/<?php echo $arr_user_data['profile_picture']; ?>" alt="<?php if($user_session['user_name']!=''){ echo stripcslashes($user_session['user_name']); }else{ echo stripslashes($user_session['first_name']); } ?>" class="img-circle" width="40" /> 
                            <?php } ?>
                            <?php if($user_session['user_name']!=''){ echo stripcslashes($user_session['user_name']); }else{ echo stripslashes($user_session['first_name']); } ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>

                <!-- /.navbar-collapse -->
                </div>
        </div>
            
        <?php }?>
        
