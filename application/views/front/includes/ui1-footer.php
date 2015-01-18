
<div class="footer">



  <div class="container navbar">
    <div class="payment-gateway-imgs">
    <div class="payment-imgs">
    <div class="payment-sec1">
    <div class="secured-sites">
    <label> Secured Sites: </label>
    
    <a href="#" onclick="window.open('https://www.sitelock.com/verify.php?site=myautobiography.in','SiteLock','width=600,height=600,left=160,top=170');" ><img alt="website security" title="SiteLock" src="//shield.sitelock.com/shield/myautobiography.in"/></a>
    

    </div>
    
    </div>
    <div class="payment-sec2">
    <label>We Accept: </label>
    <a href="#"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/visa-img.png"></a>
    <a href="#"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/master-card-img.png"></a>
   
    </div>
    
    </div>
    <div class="logo"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/logo-img.png"></div>
    <div class="place-right footer-links">
    <div class="dropdown"> 
     <a href="javascript:void(0)" id="abtsite-btn">About My Autobiography <i class="fa fa-angle-down"></i></a>
    </div>
      <ul class="element-menu">
      
        <li><a href="<?php echo base_url();?>cms/terms-and-privacy">Terms &amp; Privacy </a></li>
        <li><a href="<?php echo base_url();?>cms/partners">Partners</a></li>
        <li><a href="<?php echo base_url();?>contact-us">Contact us</a></li>
      </ul>
      <div class="dropdown country"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/india-flag.png"> India <i class="fa fa-angle-down"></i></a>
              <ul class="dropdown-menu">
                <li><a href="#"><img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/us-flag.png"> US site</a></li>
              </ul>
            </div>
    </div>
    </div>    
  </div>
  <div id="abt-desc" class="about-desc" style="display:none;">
<div class="abt-desc-txt">
<p>
    <?php 
    //print_r($cmsPage);
    echo substr(stripcslashes($cmsPage[0]['page_content']),0,185);
    ?>
<!--    All those that ended up writing there autobiographies did not know that one-day they would get to do it. It is thus to be inferred that each of us is a *PoEM *Prospect of Eminence.

Where you currently are may also be a *Province of Eminence. You may thus emerge in your life as a *Person of Eminence.

This platform provides each individual a complete ‘do-it-yourself’ opportunity to start writing the story of his or her life. There is a section on that website where the institution travels with the individual all through life.

So, if you are an institution, this is for your members where you will travel with them as their biographers and if you are an individual, this is for you and your institution.

The current social media platforms are like instant coffee, like…here and now...like…*instant sight!  -->
<a href="<?php echo base_url();?>cms/about-my-autobiography" class="read-more">Read more...</a>
</p>
    </div>
</div>
  <div class="copyright-txt">
      <p>&copy; 2014-2015 <a href="javascript:void(0);"><?php echo $global['site_title'];?></a> | All rights reserved.</p>
    </div>
    
</div>

<!---Footer end----> 

  <script>
  //$(function () {
  //$('[data-toggle="tooltip"]').tooltip()
//})
$(document).ready(function() {  
	$(".menu-btn").click(function(){
			$(".menu-dropdown").toggleClass('slide-menu')
	});
	});
</script>

<script>
$( "#abtsite-btn" ).click(function() {
$( "#abt-desc" ).slideToggle( "slow" );
});
$( "#main-menu-btn" ).click(function() {
$( "#menu-drpdwn" ).slideToggle( "slow" );
});
</script>

<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/roller/quotes.js"></script> 


 

<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/DR-listing/DR_jquery_003.js"></script> 
<script type="text/javascript">
var themifyScript = {"lightbox":{"lightboxSelector":".lightbox","lightboxOn":true,"lightboxContentImages":false,"lightboxContentImagesSelector":".post-content a[href$=jpg],.page-content a[href$=jpg],.post-content a[href$=gif],.page-content a[href$=gif],.post-content a[href$=png],.page-content a[href$=png],.post-content a[href$=JPG],.page-content a[href$=JPG],.post-content a[href$=GIF],.page-content a[href$=GIF],.post-content a[href$=PNG],.page-content a[href$=PNG],.post-content a[href$=jpeg],.page-content a[href$=jpeg],.post-content a[href$=JPEG],.page-content a[href$=JPEG]","theme":"pp_default","social_tools":false,"allow_resize":true,"show_title":false,"overlay_gallery":false,"screenWidthNoLightbox":600,"deeplinking":false,"contentImagesAreas":".post, .type-page, .type-highlight, .type-slider","gallerySelector":".gallery-icon > a[href$=jpg],.gallery-icon > a[href$=gif],.gallery-icon > a[href$=png],.gallery-icon > a[href$=JPG],.gallery-icon > a[href$=GIF],.gallery-icon > a[href$=PNG],.gallery-icon > a[href$=jpeg],.gallery-icon > a[href$=JPEG]","lightboxGalleryOn":true},"lightboxContext":"#pagewrap","isTouch":"false","loadingImg":"http:\/\/themify.me\/demo\/themes\/metro\/wp-content\/themes\/metro\/images\/loading.gif","maxPages":"0","autoInfinite":"auto","audioPlayer":"http:\/\/themify.me\/demo\/themes\/metro\/wp-content\/themes\/metro\/js\/player.swf"};
</script> 
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/DR-listing/themify_002.js"></script>



<!----Custom scroll js start----->

	<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/custom-scroll/jquery.mCustomScrollbar.concat.min.js"></script>	
	<script>
		(function($){
			$(window).load(function(){				
				$("#content-8").mCustomScrollbar({
					axis:"yx",
					scrollButtons:{enable:true},
					theme:"3d",
					scrollbarPosition:"outside"
				});				
			});
		})(jQuery);
	</script>
<!----Custom scroll js end----->
 

</body>
</html>