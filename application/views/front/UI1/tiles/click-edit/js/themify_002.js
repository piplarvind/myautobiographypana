;// Themify Theme Scripts - http://themify.me/

// Initialize object literals
var EntryFilter = {};

//////////////////////////////
// Test if touch event exists
//////////////////////////////
function is_touch_device() {
	return 'true' == themifyScript.isTouch;
}

// JS reduce for old browsers
if("function"!==typeof Array.prototype.reduce){Array.prototype.reduce=function(callback,opt_initialValue){if(null===this||"undefined"===typeof this){throw new TypeError("Array.prototype.reduce called on null or undefined");}if("function"!==typeof callback){throw new TypeError(callback+" is not a function");}var index,value,length=this.length>>>0,isValueSet=false;if(1<arguments.length){value=opt_initialValue;isValueSet=true;}for(index=0;length>index;++index){if(this.hasOwnProperty(index)){if(isValueSet){value=callback(value,this[index],index,this);}else{value=this[index];isValueSet=true;}}}if(!isValueSet){throw new TypeError("Reduce of empty array with no initial value");}return value;};}

(function($){

	// Entry Filter /////////////////////////
	EntryFilter = {

		options: {},

		init: function( settings ) {
			this.options = $.extend( {}, {
				type: '.type-post',
				filter: '.post-filter',
				loops: '.loops-wrapper'
			}, settings );
			this.filter();
		},

		setFilters: function(refresh){
			var self = this,
				$filter = $(self.options.filter);

			if ( $filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope ){
				$filter.find('li').each(function(){
					var $li = $(this),
						$entries = $li.parent().next(),
						cat = $li.attr('class').replace( /(current-cat)|(cat-item)|(-)|(active)|(enabled)|(disabled)/g, '' ).replace( ' ', '' );
					if ( $entries.find(self.options.type + '.cat-' + cat).length <= 0 ) {
						$li.addClass('disabled').removeClass('enabled');
					} else {
						$li.addClass('enabled').removeClass('disabled');
					}
				});
			}
			if ( refresh ) {
				$filter.find('.active').find('a').trigger('click');
			}
		},

		filter: function(){
			var self = this,
				$filter = $(self.options.filter);
			if ( $filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope ){
				self.setFilters();

				$filter.show().on('click', 'a', function(e) {
					e.preventDefault();
					var $li = $(this).parent(),
						$entries = $li.parent().next();
					if ( $li.hasClass('active') ) {
						$li.removeClass('active');
						$entries.isotope( {
							filter: self.options.type
						} );
					} else {
						$li.siblings('.active').removeClass('active');
						$li.addClass('active');
						$entries.isotope( {
							filter: '.cat-' + $li.attr('class').replace( /(current-cat)|(cat-item)|(-)|(active)|(enabled)|(disabled)/g, '' ).replace( ' ', '' )  } );
					}
				} );
			}
		}
	};

	// Prepare vars
	var tileFlipped = [];

// Initialize Audio Player
function doAudio(context){
	$('.f-embed-audio', context).each(function(index){
		$this = $(this);
		f_id = $this.attr('id');
		
		if('yes' == $this.data('html5incompl')){
			up = $this.parent().parent();
			
			AudioPlayer.embed( f_id, { soundFile: $this.data('src') } );
			
			if($.browser.mozilla) {
				tempaud = document.getElementsByTagName("audio")[0];
				$(tempaud).remove();
				$("div.audio_wrap div").show()
			} else {
				$("div.audio_wrap div *").remove();
			}
		}
	});
}

function flipTile(e) {

	var $self = $(this),
		selfID = $self.attr('id');

	if ( ( 'touchstart' == e.type || 'MSPointerDown' == e.type ) && ( 'undefined' == typeof tileFlipped[selfID] || !tileFlipped[selfID] ) ) {
		e.preventDefault();
		tileFlipped[selfID] = true;
		$('.tile-flip', $self).addClass('tile-flipped');
		$self.css('z-index', '999');
	} else if ( 'mouseover' == e.type ) {
		$('.tile-flip', $self).addClass('tile-flipped');
		$self.css('z-index', '999');
	} else if ( 'mouseout' == e.type ) {
		$('.tile-flip', $self).removeClass('tile-flipped');
		$self.css('z-index', '1');
	}
}

// Check if isotope is enabled
if(typeof jQuery.fn.isotope !== 'undefined'){
	$.Isotope.prototype._themifyPostReset = function() {
		// layout-specific props
		this.themifyPost = {};
		// FIXME shouldn't have to call this again
		this._getSegments();
		var i = this.themifyPost.cols;
		this.themifyPost.colYs = [];
		while (i--) {
			this.themifyPost.colYs.push( 0 );
		}
	};

	$.Isotope.prototype._themifyPostLayout = function( $elems ) {
		var instance = this,
		props = instance.themifyPost;
		$elems.each(function(){
			var $this  = $(this),
			//how many columns does this brick span
			colSpan = Math.ceil( $this.outerWidth(true) / props.columnWidth );
			colSpan = Math.min( colSpan, props.cols );

			if ( colSpan === 1 ) {
				// if brick spans only one column, just like singleMode
				instance._themifyPostPlaceBrick( $this, props.colYs );
			} else {
				// brick spans more than one column
				// how many different places could this brick fit horizontally
				var groupCount = props.cols + 1 - colSpan,
				groupY = [],
				groupColY,
				i;

				// for each group potential horizontal position
				for ( i=0; i < groupCount; i++ ) {
					// make an array of colY values for that one group
					groupColY = props.colYs.slice( i, i+colSpan );
					// and get the max value of the array
					groupY[i] = Math.max.apply( Math, groupColY );
				}

				instance._themifyPostPlaceBrick( $this, groupY );
			}
		});
	};

	$.Isotope.prototype._themifyPostPlaceBrick = function( $brick, setY ) {
		// get the minimum Y value from the columns
		var minimumY = Math.min.apply( Math, setY ),
			shortCol = 0;

		// Find index of short column, the first from the left
		for (var i=0, len = setY.length; i < len; i++) {
			if ( setY[i] === minimumY ) {
				shortCol = i;
				break;
			}
		}

		// position the brick
		var x = this.themifyPost.columnWidth * shortCol,
			y = minimumY,
			extendW = 0;

		// hack the width
		if ( shortCol > 0 ) {
			if ( this.themifyPost.cols == 3 ) {
				extendW = (x - $brick.prevAll('.isotope-item').last().width()) - this.themifyPost.columnWidth;
				extendW = extendW < 0 ? this.themifyPost.cols : extendW;
			} else if ( this.themifyPost.cols == 2 ) {
				extendW = x - $brick.prevAll('.isotope-item').last().width();
			}
			x += extendW;
		}
		this._pushPosition( $brick, x, y );

		// apply setHeight to necessary columns
		var setHeight = minimumY + $brick.outerHeight(true),
			setSpan = this.themifyPost.cols + 1 - len;
		for ( i=0; i < setSpan; i++ ) {
			this.themifyPost.colYs[ shortCol + i ] = setHeight;
		}
	};

	$.Isotope.prototype._themifyPostGetContainerSize = function() {
		var containerHeight = Math.max.apply( Math, this.themifyPost.colYs );
		return { height: containerHeight };
	};

	$.Isotope.prototype._themifyPostResizeChanged = function() {
		return this._checkIfSegmentsChanged();
	};
}

$(document).ready(function(){

	/////////////////////////////////////////////
	// Flip Block
	/////////////////////////////////////////////
	if (window.navigator.msPointerEnabled) {
		$(document).on('mouseover mouseout MSPointerDown', '.tile-post.image, .tile-post.map, .portfolio-post', flipTile);
	} else {
		$(document).on('mouseover mouseout touchstart', '.tile-post.image, .tile-post.map, .portfolio-post', flipTile);
	}


	// Show/Hide direction arrows
	$(document).on('mouseover mouseout', '.tile-post .slideshow-wrap', function(event) {
		if (event.type == 'mouseover') {
			if( $(window).width() > 600 ){
				$('.carousel-nav-wrap', $(this)).css('display', 'block');
			}
		} else {
			if( $(window).width() > 600 ){
				$('.carousel-nav-wrap', $(this)).css('display', 'none');
			}
		}
	});
	
	$(document).on('mouseover mouseout', '.portfolio-post .slideshow-wrap', function(event) {
		if (event.type == 'mouseover') {
			if( $(window).width() > 600 ){
				$('.carousel-nav-wrap .carousel-prev, .carousel-nav-wrap .carousel-next', $(this)).css('display', 'block');
			}
		} else {
			if( $(window).width() > 600 ){
				$('.carousel-nav-wrap .carousel-prev, .carousel-nav-wrap .carousel-next', $(this)).css('display', 'none');
			}
		}
	});
	
	/////////////////////////////////////////////
	// Scroll to top 							
	/////////////////////////////////////////////
	$('.back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	/////////////////////////////////////////////
	// Toggle menu on mobile 							
	/////////////////////////////////////////////
	$("#menu-icon").click(function(){
		$("#headerwrap #main-nav").fadeToggle();
		$(this).toggleClass("active");
	});

	// Set path to audio player
	AudioPlayer.setup(themifyScript.audioPlayer, {
		width: '90%',
		transparentpagebg: 'yes'
	});
	
	// Lightbox / Fullscreen initialization ///////////
	if(typeof ThemifyGallery !== 'undefined'){ ThemifyGallery.init({'context': jQuery(themifyScript.lightboxContext)}); }
});

function infiniteIsotope(containerSelector, itemSelectorIso, itemSelectorInf, containerInfinite, doIso, isoColW, isoCallback){

	// Get max pages for regular category pages and home
	var scrollMaxPages = parseInt(themifyScript.maxPages),
		$container = $(containerSelector),
		$containerInfinite = $(containerInfinite);

	// Get max pages for Query Category pages
	if( typeof qp_max_pages != 'undefined')
		scrollMaxPages = qp_max_pages;

	if( (! $('body.list-post').length > 0) && doIso ){
		// isotope init
		$container.isotope({
			masonry: {
				columnWidth: isoColW
			},
			itemSelector : itemSelectorIso,
			transformsEnabled : false,
			animationEngine: 'jquery',
			onLayout: function( $elems, instance){
				$('.portfolio-post .tile-flip').css('position', 'absolute');
			}
		});
		$(window).resize();
		// load callback
		if( $.isFunction(isoCallback) ){
			isoCallback.call(this, $container);
		}
	}

	// infinite scroll
	$containerInfinite.infinitescroll({
		navSelector  : '#load-more a:last', 		// selector for the paged navigation
		nextSelector : '#load-more a:last', 		// selector for the NEXT link (to page 2)
		itemSelector : itemSelectorInf, 	// selector for all items you'll retrieve
		loadingText  : '',
		donetext     : '',
		loading 	 : { img: themifyScript.loadingImg },
		maxPage      : scrollMaxPages,
		behavior	 : 'auto' != themifyScript.autoInfinite? 'twitter' : '',
		pathParse 	 : function (path, nextPage) {
			return path.match(/^(.*?)\b2\b(?!.*\b2\b)(.*?$)/).slice(1);
		}
	}, function(newElements) {
		// call Isotope for new elements
		var $newElems = $(newElements);

		// Mark new items: remove newItems from already loaded items and add it to loaded items
		$('.post.newItems').removeClass('newItems');
		$newElems.addClass('newItems');

		$newElems.hide().imagesLoaded(function(){

			$newElems.css({'margin-left': 0}).fadeIn();

			$('#infscr-loading').fadeOut('normal');
			if( 1 == scrollMaxPages ){
				$('#load-more, #infscr-loading').remove();
			}

			// For audio player
			doAudio($newElems);

			// Create carousel on portfolio new items
			createCarousel($('.portfolio-post.newItems .slideshow'));

			$('.portfolio-post').each(function(index){
				$this = $(this);
				thisH = $('.tile-flip img', $this).height();
				$('.tile-flip', $this).css({'height': thisH});
				$this.css({'height': thisH});
			});

			if( (! $('body.list-post').length > 0) && doIso ){
				$container.isotope('appended', $newElems );

				EntryFilter.setFilters(true);
			}

			// Apply lightbox/fullscreen gallery to new items
			if(typeof ThemifyGallery !== 'undefined'){ ThemifyGallery.init({'context': jQuery(themifyScript.lightboxContext)}); }
		});

		scrollMaxPages = scrollMaxPages - 1;
		if( 1 < scrollMaxPages && 'auto' != themifyScript.autoInfinite)
			$('#load-more a').show();
	});

	// disable auto infinite scroll based on user selection
	if( 'auto' == themifyScript.autoInfinite ){
		jQuery('#load-more, #load-more a').hide();
	}

}

function createCarousel(obj){
	obj.each(function(){
		var $this = $(this),
		$args = {
			responsive: true,
			circular: true,
			infinite: true,
			swipe: true,
			scroll: {
				items: 1,
				fx: $this.data('effect'),
				duration: parseInt($this.data('speed'))
			},
			auto: {
				play: ('off' != $this.data('autoplay')),
				timeoutDuration: 'off' != $this.data('autoplay')? parseInt($this.data('autoplay')): 0
			},
			items: {
				visible: { min: 1, max: 1 },
				width: 222
			},
			onCreate: function(){
				$('.portfolio-post .slideshow-wrap').css({'visibility':'visible', 'height':'auto'});
				$('.portfolio-post .carousel-nav-wrap .carousel-prev, .portfolio-post .carousel-nav-wrap .carousel-next').hide();
			}
		};

		if( typeof ($this.data('navigation')) !== 'undefined' && $this.data('navigation') ) {
			$args.prev = '#' + $this.data('id') + ' .carousel-prev';
			$args.next = '#' + $this.data('id') + ' .carousel-next';
			$args.pagination = { container: '#' + $this.data('id') + ' .carousel-pager' };
		}

		$this.carouFredSel($args);
	});
}

$(window).load(function(){

	if(typeof $.fn.carouFredSel !== 'undefined'){
		createCarousel($('.portfolio-post .slideshow'));
		$('.tile .slideshow').each(function(){
			$this = $(this);
			$this.carouFredSel({
				responsive: true,
				prev: '#' + $this.data('id') + ' .carousel-prev',
				next: '#' + $this.data('id') + ' .carousel-next',
				pagination: { container: '#' + $this.data('id') + ' .carousel-pager' },
				circular: true,
				infinite: true,
				swipe: true,
				scroll: {
					items: 1,
					fx: $this.data('effect'),
					duration: parseInt($this.data('speed'))
				},
				auto: {
					play: ('off' != $this.data('autoplay')),
					timeoutDuration: 'off' != $this.data('autoplay')? parseInt($this.data('autoplay')): 0
				},
				items: {
					visible: { min: 1, max: 1 },
					width: 326
				},
				onCreate: function(){
					$('.tile .slideshow-wrap').css({'visibility':'visible', 'height':'auto'});
				}
			});

			$this.find('.slider-image-caption').on('touchstart', function() {
				var $self = $(this).find('a');
				if ( $self.attr('href') ) {
					$self.trigger('touchcancel');
					window.open($self.attr('href'));
				}
			});
		});
	}

	// For audio player
	doAudio(document);

	$('.portfolio-post').each(function(index){
		$this = $(this);
		thisH = $('.tile-flip img', $this).height();
		$('.tile-flip', $this).css({'height': thisH});
		$this.css({'height': thisH});
	});

	// Check if isotope is enabled
	if(typeof jQuery.fn.isotope !== 'undefined'){
		var $tileWrapper = $('.tile-wrapper');
		if( $tileWrapper.length > 0 && $('.tile', $tileWrapper).length > 0 ) {
			var narrowest = [].reduce.call($('.tile', $tileWrapper), function(sml, cur) {
				return $(sml).width() < $(cur).width() ? sml : cur;
			});
			var tileW = parseInt($(narrowest).width() + 10);

			// isotope container, isotope item, item fetched by infinite scroll, infinite scroll
			infiniteIsotope('.tile-wrapper', '.tile', '#content .tile', '.tile-wrapper', true, tileW, function(container){
				container.isotope({resizable: false});
				// update columnWidth on window resize
				$(window).smartresize(function(){
					tileW = parseInt( $(narrowest).width() + 10 );
					container.isotope({
						// update columnWidth to a percentage of container width
						masonry: { columnWidth: tileW }
					});
				});
			});
		}

		if($('.portfolio-post').length > 0){
			var portoCols = parseInt($('.portfolio-wrapper').width() / $('.portfolio-post').width()),
				portoW = $('.portfolio-wrapper').width() / portoCols;

			// isotope container, isotope item, item fetched by infinite scroll, infinite scroll
			infiniteIsotope('.portfolio-wrapper', '.portfolio-post', '.portfolio-post', '.portfolio-wrapper', true, portoW, function(container){
				container.isotope({resizable: false});
				container.children().css('margin-left', 0);
				// update columnWidth on window resize
				var tempPortoCols = portoCols;
				$(window).smartresize(function(){
					portoCols = parseInt($('.portfolio-wrapper').width() / $('.portfolio-post').width());
					portoW = parseInt(container.width() / portoCols);
					$('.portfolio-post').each(function(index){
						$this = $(this);
						thisH = $('.tile-flip img', $this).height();
						$('.tile-flip', $this).css({'height': thisH});
						$this.css({'height': thisH});
					});
					container.isotope({
						// update columnWidth to a percentage of container width
						layoutMode: 'themifyPost',
						themifyPost: { columnWidth: portoW }
					}).isotope('reLayout');
				});
			});
		}

		if($('.post').length > 0){
			var postCols = parseInt($('#loops-wrapper').width() / $('.post').width()),
				postW = $('#loops-wrapper').width() / postCols;

			// isotope container, isotope item, item fetched by infinite scroll, infinite scroll
			infiniteIsotope('#loops-wrapper', '.post', '#content .post', '#loops-wrapper', true, postW, function(container){
				container.isotope({resizable: false});
				container.children().css('margin-left', 0);
				// update columnWidth on window resize
				$(window).smartresize(function(){
					postW = parseInt(container.width() / postCols);
					container.isotope({
						// update columnWidth to a percentage of container width
						layoutMode: 'themifyPost',
						themifyPost: { columnWidth: postW }
					}).isotope('reLayout');
				});
			});
		}

		/////////////////////////////////////////////
		// Entry Filter
		/////////////////////////////////////////////
		EntryFilter.init({
			filter: '.sorting-nav'
		});
	}

});

})(jQuery);