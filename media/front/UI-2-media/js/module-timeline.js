/*!
 * Modern UI Kits for Apps & Websites 3.5.0
 * Author: mosaicpro
 * Licence: http://themeforest.net/licenses
 * Copyright 2014
 */

(function ($) {
    "use strict";

    $('.share textarea').on('keyup', function () {
        $(".share button")[ $(this).val() === '' ? 'hide' : 'show' ]();
    });

    if (! $("#scroll-spy").length) return;

    var offset = $("#scroll-spy").offset().top;

    $('body').scrollspy({target: '#scroll-spy', offset: offset});

})(jQuery);
