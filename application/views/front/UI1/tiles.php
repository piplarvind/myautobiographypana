
<div class="middle-section tiles-page-mid">
  
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
      <div id="MetroDashboard" class="tiles-page-tile">
        <div class="tile-group-main content" id="content-8">
    <!--<div id="metro-sections-container" class="metro">-->
                <div class="metro-sections" data-bind="foreach: sections">                   
                    <div class="metro-section" data-bind="attr: {id : uniqueId}">
                        <div class="metro-section-title" data-bind="text: name"></div>
                        <!-- ko foreach: tiles -->
                            <div data-bind="attr: { id: uniqueId, 'class': tileClasses }">
                                <b class="check"></b>
                                <!-- ko if: tileImage -->
                                <div class="tile-image">
                                    <img data-bind="attr: { src: tileImage }" src="img/Internet%20Explorer.png" />
                                </div>
                                <!-- /ko -->
                                <!-- ko if: iconSrc -->
                                <!-- ko if: slides().length == 0 -->
                                <div data-bind="attr: { 'class': iconClasses }">
                                    <img data-bind="attr: { src: iconSrc }" src="img/Internet%20Explorer.png" />
                                </div>
                                <!-- /ko -->
                                <!-- /ko -->
                                <div data-bind="foreach: slides">
                                    <div class="tile-content-main">
                                        <div data-bind="html: $data">
                                        </div>
                                    </div>
                                </div>
                                <!-- ko if: label -->
                                <span class="tile-label" data-bind="html: label">Label</span>
                                <!-- /ko -->
                                <!-- ko if: counter -->
                                <span class="tile-counter" data-bind="html: counter">10</span>
                                <!-- /ko -->
                                <!-- ko if: subContent -->
                                <div data-bind="attr: { 'class': subContentClasses }, html: subContent">
                                    subContent
                                </div>
                                <!-- /ko -->
                            </div>
                        <!-- /ko -->
                    </div>

                </div>
            </div>
            </div>
        </div>
        </div>
          
</div>
<script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/TheCore.js?v=14"></script>
 <script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/tiles/AppStoreTiles.js?v=14"></script>
 <script type="text/javascript" src="<?php echo base_url();?>media/front/UI-1-media/UI1/js/AppStore.js?v=14"></script>   