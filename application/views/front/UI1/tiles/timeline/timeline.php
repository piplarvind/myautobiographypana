<div class="feature">
   <h2>Timeline Snapshot</h2>
   
   <?php if(!(empty($timeline))){  foreach($timeline as $post){// print_r($post); ?>
   <div class="feature_detail news-slide">
       <p><?php echo stripcslashes($post['timeline_post_data']);?><?php echo stripcslashes($post['category_name']);?><?php echo  relative_time($post['timeline_posted_date']); //date("",$post['timeline_posted_date']);?></p>
       
    </div>
   <?php }}else{?>
   
    
    <div class="center-tile">
        <a href="<?php echo base_url();?>signin">Login</a> to make tile live.
    </div>
    
   
   <?php }?>
    
</div>
<span class="count"><?php echo $timeline[0]['cnt'];?></span>