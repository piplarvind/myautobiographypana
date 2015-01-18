<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/CombinedDashboard.js?v=14"></script>

<script>
    
jQuery(document).ready(function(e) {	
	setInterval( function(e){
	jQuery(".preloader").hide();
	}, 400);
})
</script>

<div class="middle-section home-middle-sec">
<?php $this->load->view('front/UI1/banner');?>
  
  
  <div id="content" class="tiles-holder">
    <div id="browser_incompatible" class="alert">
      <button class="close" data-dismiss="alert">×</button>
      <strong>Warning!</strong> Your browser is incompatible with Droptiles. Please use Internet Explorer 9+, Chrome, Firefox or Safari. </div>
    <div id="CombinedScriptAlert" class="alert">
      <button class="close" data-dismiss="alert">×</button>
      <strong>Warning!</strong> Combined javascript files are outdated. 
      Please retun the js\Combine.bat file. 
      Otherwise it won't work when you will deploy on a server. </div>
    <div id="metro-sections-container" class="metro custom-tile-group">
      <div id="trash" class="trashcan" data-bind="sortable: { data: trash }"> </div>
      <div id="MetroDashboard">
        <div class="tile-group-main content" id="content-8">
       
          <div class="metro-sections" data-bind="foreach: sections">
            <div class="metro-section" data-bind="sortable: { data: tiles }">
              <div data-bind="attr: { id: uniqueId, 'class': tileClasses }"> 
                
                <!-- ko if: tileImage -->
                <div class="tile-image"> <img data-bind="attr: { src: tileImage }" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/154342192-326x217.jpg" /> </div>
                <!-- /ko --> 
                <!-- ko if: iconSrc --> 
                <!-- ko if: slides().length == 0 -->
                <div data-bind="attr: { 'class': iconClasses }"> <img data-bind="attr: { src: iconSrc }" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/119077424-326x217.jpg" /> </div>
                <!-- /ko --> 
                <!-- /ko -->
                <div data-bind="foreach: slides">
                  <div class="tile-content-main">
                    <div data-bind="html: $data"> </div>
                  </div>
                </div>
                <!-- ko if: label --> 
                <span class="tile-label" data-bind="html: label">Label</span> 
                <!-- /ko --> 
                <!-- ko if: counter --> 
                <span class="tile-counter" data-bind="html: counter">10</span> 
                <!-- /ko --> 
                <!-- ko if: subContent -->
                <div data-bind="attr: { 'class': subContentClasses }, html: subContent"> subContent </div>
                <!-- /ko --> 
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-----Roller start--->
  
  <div class="roller">
			<div id="carousel">
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /> </div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-2.jpg" /> </div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-3.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-4.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-6.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-7.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-8.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-2.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-10.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-11.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-12.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-2.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-3.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-4.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-8.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-6.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-7.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-8.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-10.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-11.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-12.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-1.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-2.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-3.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-4.jpg" /></div>
<div><img class="class1" src="<?php echo base_url();?>media/front/UI-1-media/UI1/img/thumbnail-slider-8.jpg" /></div>
			</div>
		</div>

  <!-----Roller end--->
</div>
