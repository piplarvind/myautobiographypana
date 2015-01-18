
<div id="friends-slider" >
    
    <?php if(!(empty($friends))){ //print_r($friends);?>
            <marquee direction="down" behavior=alternate scrolldelay=5>
    <?php  foreach($friends as $frnd){?>
   

   
        
        <div class="feature">
    <div class="feature_detail news-slide">
        <p>
             <?php  if($frnd['profile_picture'] ==''){?>
        <img class="float_left mCS_img_loaded" src="<?php echo base_url(); ?>media/front/img/user-images/50/<?php echo $frnd['profile_picture'] ?>" alt="people" class="media-object img-circle pull-left"/><h2><?php echo ucfirst($frnd['first_name']);?></h2>
        <?php }else{?>
        <img class="float_left mCS_img_loaded" src="<?php echo base_url(); ?>media/front/img/user-images/50/<?php echo $frnd['profile_picture'] ?>" alt="people" class="media-object img-circle pull-left"/><h2><?php echo ucfirst($frnd['first_name']);?></h2>
        <?php }?>
         
            <?php echo stripcslashes($frnd['timeline_post_data']); ?> <?php echo relative_time($frnd['timeline_posted_date']);  ?>
        
           </p>
           <span class="count"><?php echo $frnd['cnt']; ?> </span>
    </div>
</div>
        
        
        
    <?php } ?>
</marquee>
    <?php }else{ ?>
      <div class="center-tile">
        <a href="<?php echo base_url();?>signin">Login</a> to make tile live.
    </div>
        <?php } ?>
        </div>
