<DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Droptiles - Metro style Live Tile enabled Web 2.0 Dashboard" />
    <meta name="author" content="Omar AL Zabir" />
    <meta name="copyright" content="2012, Omar AL Zabir" />
    <meta name="license" content="Free for personal use. For commercial use, contact me for License. http://oazabir.github.com/Droptiles/" />
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    
    <title>Droptiles - Web 2.0 Dashboard in metro style</title>

    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/droptiles.css?v=14">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    
    <link rel="stylesheet" type="text/css" href="css/AppStore.css?v=14" /> 
    
    
</head>


     
<body>
    <div id="body" class="unselectable">
        <div id="navbar" class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">                    
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <li class="active">                                
                                <a class="brand" href="?"><img src="img/avatar474_2.gif" style="max-height: 20px; margin-top: -2px; margin-right:5px; vertical-align: middle" />Droptiles</a>
                            </li>
                            <li><a class="active" href="?"><i class="icon-white icon-th-large"></i>Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="content" style="visibility: hidden">
            <a class="backbutton" href="Default.aspx">
                <img src="img/Left.png" />
            </a>
            
            <div id="metro-sections-container" class="metro">
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
        <div id="copyright">
            Copyright 2012 Omar AL Zabir. 
            For license or to get the code, <a href="http://oazabir.github.com/Droptiles/">Click here</a>
        </div>
    </div>
    </body>
   


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
        photo: "img/User No-Frame.png",
        isAnonymous: true
    });
</script>

    <!-- Copyright 2012 Omar AL Zabir -->
    <script type="text/javascript" src="js/theCore.js?v=14"></script>
    <script type="text/javascript" src="tiles/AppStoreTiles.js?v=14"></script>
    <script type="text/javascript" src="js/appStore.js?v=14"></script>       

	
	<script type="text/ecmascript">
        
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-33406100-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>

    
</html>
