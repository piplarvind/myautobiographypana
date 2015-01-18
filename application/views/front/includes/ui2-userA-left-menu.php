<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->

<?php if($user_session['user_type'] == '1'){?>
  <!-- For Users -->
<div class="sidebar left cust-sidebar sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
  <div class="sidebar-menu">
    <div data-scrollable>
      <div class="sidebar-block">
        <div class="profile">
          <?php if($arr_user_data['profile_picture']){ ?>
          <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture'] ?>" alt="<?php echo ucfirst(stripslashes($user_session['first_name'])); ?> Profile Photo" class="img-circle" />
          <?php } ?>
          <h4><?php echo ucfirst(stripslashes($arr_user_data['first_name']))." ".  ucfirst(substr(stripslashes($arr_user_data['last_name']),0,1))."."; ?></h4>
        </div>
      </div>
      <?php if(count($arr_category_list['timeline_photo']) > 0){ ?>
      <div class="category">Photos</div>
      <div class="sidebar-block">
        <div class="sidebar-photos">
          <ul>
            <?php foreach ($arr_category_list['timeline_photo'] as $timeline_photo) { ?>
            <li> <a href="#"> <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $timeline_photo['timeline_media_path']?>" alt="people" /> </a> </li>
            <?php } ?>
          </ul>
          <!--<a href="<?php echo base_url(); ?>gallery" class="btn btn-primary btn-xs">view all</a> </div>-->
          <a href="<?php echo base_url(); ?>gallery/<?php echo $arr_user_data['user_name']?>" class="btn btn-primary btn-xs">view all</a> </div>
      </div>
      <?php }?>
      <ul>
        <li class="category">Account</li>
        <!-- Sample 2 Level Collapse -->
        <li class="hasSubmenu"> <a href="#submenuDR"><i class="fa fa-chevron-circle-down"></i> <span>Digital Records</span></a>
          <ul id="submenuDR">
            <?php foreach ($arr_category_list['digital_list'] as $digital_details) { ?>
            <li> <a href="<?php echo base_url()?>student-time-line/<?php echo $digital_details['url']?>"><i class="fa fa-circle-o"></i><?php echo stripslashes($digital_details['category_name']);?></a></li>
<!--            <li> <a href="<?php echo base_url()?>student-time-line/<?php echo base64_encode($digital_details['category_id'])?>/<?php echo base64_encode($digital_details['parent_id'])?>"><i class="fa fa-circle-o"></i><?php echo stripslashes($digital_details['category_name']);?></a></li>-->
            <?php  }?>
          </ul>
        </li>
      </ul>
      <div class="category">News Feed</div>
      <div class="sidebar-block">
                    <div class="activity-feed">
                        <ul>
                            <?php 
                            for($i=0;$i<count($login_friend_details['login_friend']);$i++){ ?>
                            <li class="media news-item">
                                <span class="news-item-success pull-right "><i class="fa fa-circle"></i></span>
                                <span class="pull-left media-object">
                                    <i class="fa fa-fw fa-bell"></i>
                                </span>
                                <div class="media-body">
                                    <a class="text-white" href="<?php echo base_url() ?>profile/<?php echo $login_friend_details['login_friend'][$i]['user_name'] ?>"><?php echo $login_friend_details['login_friend'][$i]['user_name']?></a> just logged in 
                                    <span class="time"><?php echo date('H:i:s', strtotime($login_friend_details['login_friend'][$i]['last_login'])); ?> min ago</span>
                                </div>
                            </li>
                            <?php }?>
                            
                            <?php 
                            for($i=0;$i<count($login_friend_details['timeline']);$i++){ ?>
                            <li class="media news-item">
                                <span class="news-item-success pull-right "><i class="fa fa-circle"></i></span>
                                <span class="pull-left media-object">
                                    <i class="fa fa-fw fa-bell"></i>
                                </span>
                                <div class="media-body">
                                    <a class="text-white" href="<?php echo base_url() ?><?php echo $login_friend_details['timeline'][$i]['user_name'] ?>"><?php echo $login_friend_details['timeline'][$i]['user_name']?></a> just added <a class="text-white" href=""><?php $login_friend_details['timeline'][$i]['subject']?></a> as their office
                                    <span class="time"><?php echo date('H:i:s', strtotime($login_friend_details['login_friend'][$i]['message_date'])); ?> min ago</span>
                                </div>
                            </li>
                            <?php } ?>
                            <!--
                            <li class="media news-item">
                                <span class="pull-left media-object">
                                    <i class="fa fa-fw fa-bell"></i>
                                </span>
                                <div class="media-body">
                                    <a class="text-white" href="">Adrian</a> just logged in
                                    <span class="time">2 min ago</span>
                                </div>
                            </li>
                            <li class="media news-item">
                                <span class="pull-left media-object">
                                    <i class="fa fa-fw fa-bell"></i>
                                </span>
                                <div class="media-body">
                                    <a class="text-white" href="">Adrian</a> just logged in
                                    <span class="time">2 min ago</span>
                                </div>
                            </li>
                            <li class="media news-item">
                                <span class="pull-left media-object">
                                    <i class="fa fa-fw fa-bell"></i>
                                </span>
                                <div class="media-body">
                                    <a class="text-white" href="">Adrian</a> just logged in
                                    <span class="time">2 min ago</span>
                                </div>
                            </li>-->
                        </ul>
                    </div>
                </div>
    </div>
  </div>
</div>
<?php $this->load->view('front/includes/user-chat'); 

}else{ ?>

  <div class="sidebar left cust-sidebar sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
  <div class="sidebar-menu">
    <div data-scrollable>
      <div class="sidebar-block">
        <div class="profile">
          <?php if($arr_user_data['profile_picture']){ ?>
          <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture'] ?>" alt="<?php echo ucfirst(stripslashes($user_session['first_name'])); ?> Profile Photo" class="img-circle" />
          <?php } ?>
          <h4><?php echo ucfirst(stripslashes($arr_user_data['first_name']))." ".  ucfirst(substr(stripslashes($arr_user_data['last_name']),0,1))."."; ?></h4>
        </div>
      </div>
      
      <ul>
    
        <li class="hasSubmenu">
            <a href="#submenu"><i class="fa fa-chevron-circle-down"></i> <span>Personal Brownies</span></a>
            <ul id="submenu">
        <?php foreach ($arr_category_list['personal_list'] as $personal_details) { 
              if($personal_details['category_id'] == '18'){ ?>
                <li class="hasSubmenu">
                        <a href="#submenu-1"><i class="fa fa-circle-o"></i> <?php echo stripslashes($personal_details['category_name']);?></a>
                        <ul id="submenu-1">
                            <?php foreach ($arr_category_list['intrest_list'] as $intrest_details) {?>
                                 <li><a href="<?php echo base_url()?>student-time-line/<?php echo $intrest_details['url'];?>"><?php echo stripslashes($intrest_details['category_name']);?></a></li>
                            <?php } ?> 
                        </ul>
               </li>
        <?php }else{ ?>
              <li><a href="<?php echo base_url()?>student-time-line/<?php echo $personal_details['url'];?>"> <i class="fa fa-circle-o"></i><?php echo stripslashes($personal_details['category_name']);?></a></li>
        <?php  } } ?>
            </ul>
        </li>
                        
                        
      </ul>
      
    </div>
  </div>
</div>
  
<?php }?>
