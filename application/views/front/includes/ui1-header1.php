<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="description" content="Droptiles - Metro style Live Tile enabled Web 2.0 Dashboard" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Omar AL Zabir" />
<meta name="copyright" content="2012, Omar AL Zabir" />
<meta name="license" content="Free for personal use. For commercial use, contact me for License. http://oazabir.github.com/Droptiles/" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php  if(count($header)!=0 ) {  ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($header['title']) ? stripslashes($global['site_title']) : stripslashes($header['title']); ?></title>
            <?php } else { ?>
        <title><?php echo stripslashes($global['site_title']) . '-' ?><?php echo empty($title_for_layout) ? stripslashes($global['site_title']) : stripslashes($title_for_layout); ?></title>
<?php } ?><link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/droptiles.css?v=14">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/font-awesome.css">

<!---Metro css attchment---->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/metro-bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/metro-bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/MetroJs.css" rel="stylesheet">

<!---Custom css attchment---->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/main.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<!--Roller attachment start-->
<!--<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.js"></script>

<!--Roller attachment end-->

<!-- Owl Carousel attachment start -->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/owl-carousel/owl.theme.css" rel="stylesheet">
<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/owl-carousel/owl.carousel.js"></script>
<input type="hidden" id="base_path" value="<?php echo base_url().ui1_path;?>"/>
<input type="hidden" id="base_url" value="<?php echo base_url();?>"/>
<input type="hidden" id="application_path" value="<?php echo base_url().application_path;?>"/>



<script src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/owl-carousel/jquery.carouFredSel-6.0.4-packed.js" type="text/javascript"></script>

		
<!-- Owl Carousel attachment end -->

<!----Portfolio css attachments---->
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/DR-listing/animate.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/DR-listing/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/DR-listing/tiles.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jQueryEnhancement.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jQuery.MouseWheel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jquery.kinetic.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/Knockout-2.1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/knockout.sortable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/Underscore.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jQuery.hashchange.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/User.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/jquery.ui.touch-punch.min.js"></script>


<!-----Custom scroll css start----->
<link rel="stylesheet" href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/custom-scroll/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>media/front/UI-1-media/UI1/css/custom-scroll/jquery.mCustomScrollbar.css">
<!-----Custom scroll css end----->


<script type="text/javascript">
    // Bootstrap initialization
    $(document).ready(function () { 
            
        $('.dropdown-toggle').dropdown();        
    });
</script>
<script type="text/javascript">
    window.currentUser = new User({
        firstName: "None",
        lastName: "Anonymous",
        photo: "<?php echo base_url();?>media/front/UI-1-media/UI1/img/User No-Frame.png",
        isAnonymous: true
    });
</script>

<!--for local -->
