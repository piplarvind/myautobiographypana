<div class="top-banner">
 <div id="BannerSlider" class="owl-carousel owl-theme"><?php //print_r($user_session);die;?>
            <?php if(!(empty($banner)) && $user_session['user_type']==1 ){ foreach($banner as $b){?>
     <div class="item" style="background-image: url(<?php echo base_url();?>media/front/img/banner-images/<?php echo $b['banner_image'];?>)"></div>
            <?php }}else{?>
     <div class="item" style="background-image: url(<?php echo base_url();?>media/front/UI-1-media/UI1/img/banner1.jpg)"></div>
          <div class="item" style="background-image: url(<?php echo base_url();?>media/front/UI-1-media/UI1/img/banner2.jpg)"></div>
          <div class="item" style="background-image: url(<?php echo base_url();?>media/front/UI-1-media/UI1/img/banner3.jpg)"></div>
            <?php }?>
        </div>
        <div class="fade-in-txt text-center">
          <div class="quotes">So..what's your story..?</div>
          <div class="quotes">My personal digital real estate</div>
          <div class="quotes"> In addition to my sight I have 3 other sights here; Hindsight, Foresight and Insight</div>
          <div class="quotes">You are a prospect, person, province of eminence.. Believe in it</div>
          <div class="quotes">You are a POEM..lyricize it</div>
        </div>
  </div>
<script type="text/javascript">
    $(document).ready(function() {  
	$(".menu-btn").click(function(){
			$(".menu-dropdown").toggleClass('slide-menu')
	});

	  
    $("#BannerSlider").owlCarousel({     
    autoPlay: 3000, //Set AutoPlay to 3 seconds     
    singleItem:true,
   
    });
	
	
         var owl = $("#owl-demo");
 
owl.owlCarousel({
    autoPlay: 1000,
    loop:true,
itemsCustom : [
[0, 2],
[450, 4],
[600, 7],
[700, 9],
[1000, 10],
[1200, 12],
[1400, 13],
[1600, 15]
],
navigation : true
 
});
 
   
	
    });
</script> 