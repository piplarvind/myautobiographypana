<?php // echo '<pre>';print_r($arr_user_data['user_name']);die;?>
<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->

<div class="sidebar left cust-sidebar sidebar-size-2 sidebar-offset-0 sidebar-visible-desktop sidebar-visible-mobile sidebar-skin-dark" id="sidebar-menu" data-type="collapse">
    <div class="sidebar-menu">
        <div data-scrollable>
            
            <div class="sidebar-block">
                <div class="profile">
                    <?php if($arr_user_data['profile_picture']!=''){ ?>
                    <img src="<?php echo base_url(); ?>media/front/img/user-images/thumbs/<?php echo $arr_user_data['profile_picture'] ?>" alt="<?php echo ucfirst(stripslashes($arr_user_data['name_of_institute']));?>" class="img-circle" />
                    <?php } ?>
                    <h4><?php echo ucfirst(stripslashes($arr_user_data['name_of_institute'])); ?></h4>
                </div>
            </div>
            
       <div class="category">About</div>
      <div class="sidebar-block">
        <ul class="list-about about-block">
          <li><i class="fa fa-map-marker"></i> <?php echo $arr_user_data['user_city'];?>,<?php echo $arr_counrty_name['country_name']?></li>
          <li><i class="fa fa-link"></i> <a href="#"><?php echo $arr_user_data['institute_website'];?></a> </li>
        </ul>
      </div>
            <?php if(count($arr_category_list['timeline_photo']) > 0){ ?>
            <div class="category">Photos</div>
                <div class="sidebar-block">
                    <div class="sidebar-photos">
                        <ul>
                            <?php foreach ($arr_category_list['timeline_photo'] as $timeline_photo) { ?>
                             <li>
                                <a href="#">
                                    <img src="<?php echo base_url(); ?>media/front/img/post-images/thumbs/<?php echo $timeline_photo['timeline_media_path']?>" alt="people" />
                                </a>
                             </li>
                            <?php } ?>
                        </ul>
                        <a href="<?php echo base_url()?>gallery/<?php echo $arr_user_data['user_name']?>" class="btn btn-primary btn-xs">view all</a>
                        <!--<a href="<?php echo base_url()?>gallery" class="btn btn-primary btn-xs">view all</a>-->
                    </div>
                </div>
            <?php }?>
            
            <ul>
                <li class="category">Account</li>
                <!-- Sample 2 Level Collapse -->
                <li class="hasSubmenu">
                    <a href="#submenuDR"><i class="fa fa-chevron-circle-down"></i> <span>Digital Records</span></a>
                    <ul id="submenuDR">
                     <?php foreach ($arr_category_list['digital_list'] as $digital_details) { 
                           if($digital_details['category_id'] == '49'){ ?>
                               <li> <a href="<?php echo base_url()?>institute-time-line/<?php echo $digital_details['url'];?>"><i class="fa fa-circle-o"></i><?php echo stripslashes($digital_details['category_name']);?></a></li>
<!--                               <li> <a href="<?php echo base_url()?>institute-time-line/<?php echo base64_encode($digital_details['category_id'])?>/<?php echo base64_encode($digital_details['parent_id'])?>"><i class="fa fa-circle-o"></i><?php echo stripslashes($digital_details['category_name']);?></a></li>-->
                     <?php } }?>
                    </ul>
                </li>  
                <li class="hasSubmenu">
                    <a href="#submenuIB"><i class="fa fa-chevron-circle-down"></i> <span>Institutional Brownies</span></a>
                    <ul id="submenuIB">
                     <?php foreach ($arr_category_list['institutional_list'] as $institutional_details) { ?>
                          <li><a href="<?php echo base_url()?>institute-time-line/<?php echo $institutional_details['url']?>"><i class="fa fa-circle-o"></i> <?php echo stripslashes($institutional_details['category_name']);?></a></li>
<!--                          <li><a href="<?php echo base_url()?>institute-time-line/<?php echo base64_encode($institutional_details['category_id'])?>/<?php echo base64_encode($institutional_details['parent_id'])?>"><i class="fa fa-circle-o"></i> <?php echo stripslashes($institutional_details['category_name']);?></a></li>-->
                     <?php }?>
                    </ul>
                </li>  
               
            </ul>
            
            
        </div>
    </div>
</div>

<?php $this->load->view('front/includes/user-chat'); ?>
