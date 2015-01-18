<div class="metro">
    <div class="custom-tile-group cust-tilegroup-2 text-center"> 
     <!--Institutional brownies group start --> 
     <a href="#" class="brownies-grp inst-brownies">
      <?php for($i=0; $i<count($arr_institute_brownies);$i++ ) { ?>
      <div class="tile live" data-role="live-tile" data-effect="slideUpDown" data-delay="4000">
      <div class="tile-content image"> <img src="<?php echo base_url(); ?>media/front/img/category-images/204X159/<?php echo stripslashes($arr_institute_brownies[$i]["category_image"]) ?>"> </div>
      <div class="tile-content image"> <img src="<?php echo base_url(); ?>media/front/img/category-images/204X159/<?php echo stripslashes($arr_institute_brownies[$i]["category_image"]) ?>"> </div>
       <span class="count"><?php echo ($arr_institute_brownies_count[$i][0]["timeline_count"]) ?></span>
      <div class="tile-status bg-dark opacity inner-lbl"> <span class="label"><?php echo stripslashes($arr_institute_brownies[$i]["category_name"]) ?></span> </div>
      </div>
      <?php } ?>
         
         
         
<!--         
    <div class="tile live" data-role="live-tile" data-effect="slideLeftRight" data-speed="850" data-delay="2000">
       <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img6.png"> </div>
       <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img6.png"> </div>
        <span class="count">12</span>
      <div class="tile-status bg-dark opacity  inner-lbl"> <span class="label">Calender & Events</span> </div>
    </div>    
    <div class="tile live brwnie-bottom-tile" data-role="live-tile" data-effect="slideRight" data-speed="600" data-delay="3000">
       <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img7.png"> </div>
       <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img7.png"> </div>
        <span class="count">8</span>
      <div class="tile-status bg-dark opacity inner-lbl"> <span class="label">Achievers</span> </div>
    </div>
     <div class="tile live brwnie-bottom-tile" data-role="live-tile" data-effect="slideUpDown">
      <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img8.png"> </div>
      <div class="tile-content image"> <img src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/pw-img8.png"> </div>
       <span class="count">2</span>
      <div class="tile-status bg-dark opacity  inner-lbl"> <span class="label">Alumni Connect</span> </div>
      </div>
         
         -->
      <div class="tile-status bg-dark opacity lbl-top main-lbl"> <span class="label">My Institutional Brownies</span> </div>
      </a>
      <!--Institutional brownies group end --> 
    </div>
<script>
$( document ).ready(function() {
// Script to edit tile
var $tile1 = null;
var frontFaceClick = function (event) {
    $("#text").val($("#msg").text());
    if ($tile1 == null)
        $tile1 = $("#tile1").liveTile({ repeatCount: 0, delay: 0 });
    else
        $tile1.liveTile('play');
}   
var backFaceClick = function (event) {
    event.stopPropagation();
}    
var doneClick = function (event) {
    $("#msg").text($("#text").val());
    $tile1.liveTile('play');
}    
$("#tile1").find(">.front").bind("click", frontFaceClick);
$("#tile1").find(">.back").bind("click", backFaceClick);
$(".done").bind("click", doneClick);
});

//Script for tiles 
$(".live-tile, .flip-list").not(".exclude").liveTile();
	$(".live-tile").liveTile();
	$( ".tiles" ).sortable();
	$( ".tiles" ).disableSelection();

</script>

</div>