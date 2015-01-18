$(function(){
    if ((document.location.host.indexOf('.dev') > -1) || (document.location.host.indexOf('modernui') > -1) ) {
        $("<script/>").attr('src', 'UI-1-media/js/metro/metro-loader.js').appendTo($('head'));
    } else {
        $("<script/>").attr('src', 'media/front/UI-1-media/js/metro.min.js').appendTo($('head'));
    }
})