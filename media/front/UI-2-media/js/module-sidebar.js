(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({"./app/vendor/sidebar/js/main.js":[function(require,module,exports){
require('./_breakpoints');
require('./_sidebar-menu');
require('./_collapsible');
require('./_dropdown');
require('./_sidebar-toggle');

(function($){

    if ($(window).width() <= 480)
    {
        if (! $('.sidebar').length) return;

        $("html").removeClass('show-sidebar');
    }

})(jQuery);
},{"./_breakpoints":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_breakpoints.js","./_collapsible":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_collapsible.js","./_dropdown":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_dropdown.js","./_sidebar-menu":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-menu.js","./_sidebar-toggle":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-toggle.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_breakpoints.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $(window).bind('enterBreakpoint768', function () {
        if (! $('.sidebar').length) return;
        if ($('.hide-sidebar').length) return;
        $("html").addClass('show-sidebar');
    });

    $(window).bind('enterBreakpoint1024', function () {
        if (! $('.sidebar').length) return;
        if ($('.hide-sidebar').length) return;
        $("html").addClass('show-sidebar');
    });

    $(window).bind('enterBreakpoint480', function () {
        if (! $('.sidebar').length) return;
        $("html").removeClass('show-sidebar');
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_collapsible.js":[function(require,module,exports){
(function($){

    require('./_transform_collapse')();

})(jQuery);
},{"./_transform_collapse":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_transform_collapse.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_dropdown.js":[function(require,module,exports){
(function ($) {

    var transform_dd = require('./_transform_dropdown'),
        transform_collapse = require('./_transform_collapse');

    transform_dd();

    $(window).bind('enterBreakpoint480', function () {
        if (! $('.sidebar[data-type="dropdown"]').length) return;
        $('.sidebar[data-type="dropdown"]').attr('data-type', 'collapse').attr('data-transformed', true);
        transform_collapse();
    });

    function make_dd() {
        if (! $('.sidebar[data-type="collapse"][data-transformed]').length) return;
        $('.sidebar[data-type="collapse"][data-transformed]').attr('data-type', 'dropdown').attr('data-transformed', true);
        transform_dd();
    }

    $(window).bind('enterBreakpoint768', make_dd);

    $(window).bind('enterBreakpoint1024', make_dd);

})(jQuery);
},{"./_transform_collapse":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_transform_collapse.js","./_transform_dropdown":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_transform_dropdown.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_options.js":[function(require,module,exports){
module.exports = function (sidebar) {
    return {
        "transform-button": sidebar.data('transformButton') === true,
        "transform-button-icon": sidebar.data('transformButtonIcon') || 'fa-ellipsis-h'
    };
};
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-menu.js":[function(require,module,exports){
(function ($) {

    var sidebars = $('.sidebar');

    sidebars.each(function () {

        var sidebar = $(this);
        var options = require('./_options')(sidebar);

        if (options[ 'transform-button' ]) {
            var button = $('<button type="button"></button>');

            button
                .attr('data-toggle', 'sidebar-transform')
                .addClass('btn btn-default')
                .html('<i class="fa ' + options[ 'transform-button-icon' ] + '"></i>');

            sidebar.find('.sidebar-menu').append(button);
        }
    });

}(jQuery));
},{"./_options":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_options.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-toggle.js":[function(require,module,exports){
(function ($) {
    /*jshint browser: true, strict: false */

    $('#subnav').collapse({'toggle': false});

    $('[data-toggle="sidebar-transform"]').on('click', function () {
        $('body').toggleClass('sidebar-mini');
        if ($('body').is('.sidebar-mini')) $('.sidebar-menu .collapse').collapse('hide');
        $('#dropdown-temp').hide();
        $('.sidebar-menu .open').removeClass('open');
    });

})(jQuery);

(function ($) {

    function mobilecheck() {
        var check = false;
        (function (a) {
            if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    (function () {

        var container = $('.st-container'),

            eventtype = mobilecheck() ? 'touchstart' : 'click',
            resetMenu = function () {

                var effect = container.data('stMenuEffect'),
                    sidebar = $(container.data('stMenuTarget')),
                    htmlOldClass = $('html').get(0).className.match(/st-effect-\S+/ig);

                container.removeClass('st-menu-open');

                setTimeout(function(){
                    if (htmlOldClass !== null) $('html').removeClass(htmlOldClass.join(" "));
                    sidebar.removeClass(effect);
                    container.get(0).className = 'st-container'; // clear
                    sidebar.hide();
                }, 550);

            },

            animate = function (e) {

                e.stopPropagation();
                e.preventDefault();

                if ($(this).hasClass('animating')) return false;
                $(this).addClass('animating');

                var button = $(this),
                    effect = button.data('effect') || 'st-effect-1',
                    target = button.attr('href');

                var currentActiveElement = $('[data-toggle="sidebar-menu"]').not(this).closest('li').length ? $('[data-toggle="sidebar-menu"]').not(this).closest('li') : $('[data-toggle="sidebar-menu"]').not(this);
                currentActiveElement.removeClass('active');

                var activeElement = $(this).closest('li').length ? $(this).closest('li') : $(this);
                activeElement.addClass('active');

                setTimeout(function () {
                    button.removeClass('animating');
                }, 550);

                if (target.length < 3) {
                    if ($('html').hasClass('show-sidebar')) {
                        activeElement.removeClass('active');
                    }
                    $('html').removeClass('show-sidebar');
                    if (activeElement.hasClass('active')) $('html').addClass('show-sidebar');
                    return;
                }

                var sidebar = $(target),
                    direction = sidebar.is('.left') ? 'l' : 'r',
                    size = sidebar.get(0).className.match(/sidebar-size-(\S+)/).pop(),
                    htmlClass = 'st-effect-' + direction + size;

                if (container.hasClass('st-menu-open')) {
                    activeElement.removeClass('active');
                    resetMenu();
                    return false;
                }

                $('html').addClass(htmlClass);
                sidebar.show();

                container.data('stMenuEffect', effect);
                container.data('stMenuTarget', target);

                sidebar.addClass(effect);
                container.addClass(effect);

                setTimeout(function () {
                    container.addClass('st-menu-open');
                    sidebar.find('[data-scrollable]').getNiceScroll().resize();
                }, 25);
            };

        $('body').on(eventtype, '[data-toggle="sidebar-menu"]', animate);
        $(document).on('keydown', null, 'esc', function(){
            if (container.hasClass('st-menu-open')) {
                $('[data-toggle="sidebar-menu"]')
                    .removeClass('active')
                    .closest('li')
                    .removeClass('active');

                resetMenu();
                return false;
            }
        });

    })();

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_transform_collapse.js":[function(require,module,exports){
module.exports = function () {
    var dd = $('.sidebar[data-type="collapse"]');

    if (dd.length) {

        $('.sidebar [data-scrollable] > ul > li > a').off('mouseenter');
        $('.sidebar [data-scrollable] > ul > li.dropdown > a').off('mouseenter');
        $('.sidebar [data-scrollable] > ul > li > a').off('mouseenter');
        $('.sidebar [data-scrollable] > ul > li > a').off('click');
        $('.sidebar').off('mouseleave');
        $('.sidebar .dropdown').off('mouseover');
        $('.sidebar .dropdown').off('mouseout');
        $('body').off('mouseout', '#dropdown-temp .dropdown');

        $('.sidebar ul.collapse').off('shown.bs.collapse');
        $('.sidebar ul.collapse').off('show.bs.collapse');
        $('.sidebar ul.collapse').off('hide.bs.collapse');
        $('.sidebar ul.collapse').off('hidden.bs.collapse');

        dd.find('#dropdown-temp').remove();

        dd.find('.hasSubmenu').removeClass('dropdown')
            .find('> ul').addClass('collapse').removeClass('dropdown-menu submenu-hide submenu-show')
            .end()
            .find('> a').attr('data-toggle', 'collapse');

        dd.find('.collapse').collapse({'toggle': false});

        $('.sidebar ul.collapse').on('shown.bs.collapse', function (e) {
            $('.sidebar [data-scrollable]').getNiceScroll().resize();
        });

        // Collapse
        $('.sidebar ul.collapse').on('show.bs.collapse', function (e) {
            e.stopPropagation();

            if ($('.sidebar-mini').length) $('.sidebar-mini').removeClass('sidebar-mini').data('mini', true);

            var parents = $(this).parents('ul:first').find('> li.open [data-toggle="collapse"]');
            if (parents.length) {
                parents.trigger('click');
            }
            $(this).parent().addClass("open");
        });

        $('.sidebar ul.collapse').on('hide.bs.collapse', function (e) {
            e.stopPropagation();
            if ($(this).is('.sidebar-menu [data-scrollable] > ul > li > ul')) {
                if ($('.show-sidebar').data('mini')) {
                    $('.show-sidebar').addClass('sidebar-mini');
                    $(this).parent().removeClass("open");
                }
            }
        });

        $('.sidebar ul.collapse').on('hidden.bs.collapse', function (e) {
            e.stopPropagation();
            $(this).parent().removeClass("open");
        });
    }
};
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_transform_dropdown.js":[function(require,module,exports){
module.exports = function () {
    var dd = $('.sidebar[data-type="dropdown"]');

    if (dd.length) {

        $('.sidebar ul.collapse')
            .off('shown.bs.collapse')
            .off('show.bs.collapse')
            .off('hidden.bs.collapse');

        dd.each(function () {
            var sidebar = $(this);
            var nice = sidebar.find('[data-scrollable]').getNiceScroll()[ 0 ];

            nice.scrollstart(function () {
                if (! sidebar.is('[data-type="dropdown"]')) return;
                sidebar.find('.sidebar-menu').addClass('scrolling');
                sidebar.find('#dropdown-temp > ul > li').empty();
                sidebar.find('#dropdown-temp').hide();
                sidebar.find('.open').removeClass('open');
            });

            nice.scrollend(function () {
                if (! sidebar.is('[data-type="dropdown"]')) return;
                $.data(this, 'lastScrollTop', nice.getScrollTop());
                sidebar.find('.sidebar-menu').removeClass('scrolling');
            });
        });

        dd.find('.hasSubmenu').addClass('dropdown').removeClass('open')
            .find('> ul').addClass('dropdown-menu').removeClass('collapse in').removeAttr('style')
            .end()
            .find('> a').removeClass('collapsed')
            .removeAttr('data-toggle');

        $('.sidebar[data-type="dropdown"] [data-scrollable] > ul > li.dropdown > a').on('mouseenter', function () {
            if (! $(this).parent('.dropdown').is('.open') && ! $('.sidebar-menu').is('.scrolling')) {
                var p = $(this).parent('.dropdown'),
                    t = p.find('> .dropdown-menu').clone().removeClass('submenu-hide'),
                    m = $(this).closest('.sidebar-menu'),
                    sidebar = $(this).closest('.sidebar'),
                    c = m.find('> #dropdown-temp');

                m.find('.open').removeClass('open');

                if (! c.length) {
                    c = $('<div/>').attr('id', 'dropdown-temp').appendTo(m);
                    c.html('<ul><li></li></ul>');
                }

                c.show();
                c.find('.dropdown-menu').remove();
                c = c.find('> ul > li').css({overflow: 'visible'}).addClass('dropdown open');

                p.addClass('open');
                t.appendTo(c).css({
                    top: p.offset().top - c.offset().top,
                    left: '100%'
                }).show();

                if (sidebar.is('.right')) {
                    t.css({
                        left: 'auto',
                        right: '100%'
                    });
                }
            }
        });

        $('.sidebar[data-type="dropdown"] [data-scrollable] > ul > li > a').on('mouseenter', function () {

            if (! $(this).parent().is('.dropdown')) {
                var sidebar = $(this).closest('.sidebar');
                sidebar.find('.open').removeClass('open');
                sidebar.find('#dropdown-temp').hide();
            }

        });

        $('.sidebar[data-type="dropdown"] [data-scrollable] > ul > li > a').on('click', function (e) {
            if ($(this).parent().is('.dropdown')) {
                e.preventDefault();
                e.stopPropagation();
            }
        });

        $('.sidebar[data-type="dropdown"]').on('mouseleave', function () {
            $(this).find('#dropdown-temp').hide();
            $(this).find('.open').removeClass('open');
        });

        $('.sidebar[data-type="dropdown"] .dropdown').on('mouseover', function () {
            $(this).addClass('open').children('ul').removeClass('submenu-hide').addClass('submenu-show');
        }).on('mouseout', function () {
            $(this).children('ul').removeClass('.submenu-show').addClass('submenu-hide');
        });

        $('body').on('mouseout', '#dropdown-temp .dropdown', function () {
            $('.sidebar-menu .open').removeClass('.open');
        });
    }
};
},{}]},{},["./app/vendor/sidebar/js/main.js"])
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyaWZ5L25vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvbWFpbi5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fYnJlYWtwb2ludHMuanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvX2NvbGxhcHNpYmxlLmpzIiwiYXBwL3ZlbmRvci9zaWRlYmFyL2pzL19kcm9wZG93bi5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fb3B0aW9ucy5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fc2lkZWJhci1tZW51LmpzIiwiYXBwL3ZlbmRvci9zaWRlYmFyL2pzL19zaWRlYmFyLXRvZ2dsZS5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fdHJhbnNmb3JtX2NvbGxhcHNlLmpzIiwiYXBwL3ZlbmRvci9zaWRlYmFyL2pzL190cmFuc2Zvcm1fZHJvcGRvd24uanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUNBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNmQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNyQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNKQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDdkJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNMQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNyQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3ZIQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUM1REE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gZSh0LG4scil7ZnVuY3Rpb24gcyhvLHUpe2lmKCFuW29dKXtpZighdFtvXSl7dmFyIGE9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtpZighdSYmYSlyZXR1cm4gYShvLCEwKTtpZihpKXJldHVybiBpKG8sITApO3ZhciBmPW5ldyBFcnJvcihcIkNhbm5vdCBmaW5kIG1vZHVsZSAnXCIrbytcIidcIik7dGhyb3cgZi5jb2RlPVwiTU9EVUxFX05PVF9GT1VORFwiLGZ9dmFyIGw9bltvXT17ZXhwb3J0czp7fX07dFtvXVswXS5jYWxsKGwuZXhwb3J0cyxmdW5jdGlvbihlKXt2YXIgbj10W29dWzFdW2VdO3JldHVybiBzKG4/bjplKX0sbCxsLmV4cG9ydHMsZSx0LG4scil9cmV0dXJuIG5bb10uZXhwb3J0c312YXIgaT10eXBlb2YgcmVxdWlyZT09XCJmdW5jdGlvblwiJiZyZXF1aXJlO2Zvcih2YXIgbz0wO288ci5sZW5ndGg7bysrKXMocltvXSk7cmV0dXJuIHN9KSIsInJlcXVpcmUoJy4vX2JyZWFrcG9pbnRzJyk7XG5yZXF1aXJlKCcuL19zaWRlYmFyLW1lbnUnKTtcbnJlcXVpcmUoJy4vX2NvbGxhcHNpYmxlJyk7XG5yZXF1aXJlKCcuL19kcm9wZG93bicpO1xucmVxdWlyZSgnLi9fc2lkZWJhci10b2dnbGUnKTtcblxuKGZ1bmN0aW9uKCQpe1xuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDw9IDQ4MClcbiAgICB7XG4gICAgICAgIGlmICghICQoJy5zaWRlYmFyJykubGVuZ3RoKSByZXR1cm47XG5cbiAgICAgICAgJChcImh0bWxcIikucmVtb3ZlQ2xhc3MoJ3Nob3ctc2lkZWJhcicpO1xuICAgIH1cblxufSkoalF1ZXJ5KTsiLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQ3NjgnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICghICQoJy5zaWRlYmFyJykubGVuZ3RoKSByZXR1cm47XG4gICAgICAgIGlmICgkKCcuaGlkZS1zaWRlYmFyJykubGVuZ3RoKSByZXR1cm47XG4gICAgICAgICQoXCJodG1sXCIpLmFkZENsYXNzKCdzaG93LXNpZGViYXInKTtcbiAgICB9KTtcblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQxMDI0JywgZnVuY3Rpb24gKCkge1xuICAgICAgICBpZiAoISAkKCcuc2lkZWJhcicpLmxlbmd0aCkgcmV0dXJuO1xuICAgICAgICBpZiAoJCgnLmhpZGUtc2lkZWJhcicpLmxlbmd0aCkgcmV0dXJuO1xuICAgICAgICAkKFwiaHRtbFwiKS5hZGRDbGFzcygnc2hvdy1zaWRlYmFyJyk7XG4gICAgfSk7XG5cbiAgICAkKHdpbmRvdykuYmluZCgnZW50ZXJCcmVha3BvaW50NDgwJywgZnVuY3Rpb24gKCkge1xuICAgICAgICBpZiAoISAkKCcuc2lkZWJhcicpLmxlbmd0aCkgcmV0dXJuO1xuICAgICAgICAkKFwiaHRtbFwiKS5yZW1vdmVDbGFzcygnc2hvdy1zaWRlYmFyJyk7XG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24oJCl7XG5cbiAgICByZXF1aXJlKCcuL190cmFuc2Zvcm1fY29sbGFwc2UnKSgpO1xuXG59KShqUXVlcnkpOyIsIihmdW5jdGlvbiAoJCkge1xuXG4gICAgdmFyIHRyYW5zZm9ybV9kZCA9IHJlcXVpcmUoJy4vX3RyYW5zZm9ybV9kcm9wZG93bicpLFxuICAgICAgICB0cmFuc2Zvcm1fY29sbGFwc2UgPSByZXF1aXJlKCcuL190cmFuc2Zvcm1fY29sbGFwc2UnKTtcblxuICAgIHRyYW5zZm9ybV9kZCgpO1xuXG4gICAgJCh3aW5kb3cpLmJpbmQoJ2VudGVyQnJlYWtwb2ludDQ4MCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKCEgJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiZHJvcGRvd25cIl0nKS5sZW5ndGgpIHJldHVybjtcbiAgICAgICAgJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiZHJvcGRvd25cIl0nKS5hdHRyKCdkYXRhLXR5cGUnLCAnY29sbGFwc2UnKS5hdHRyKCdkYXRhLXRyYW5zZm9ybWVkJywgdHJ1ZSk7XG4gICAgICAgIHRyYW5zZm9ybV9jb2xsYXBzZSgpO1xuICAgIH0pO1xuXG4gICAgZnVuY3Rpb24gbWFrZV9kZCgpIHtcbiAgICAgICAgaWYgKCEgJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiY29sbGFwc2VcIl1bZGF0YS10cmFuc2Zvcm1lZF0nKS5sZW5ndGgpIHJldHVybjtcbiAgICAgICAgJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiY29sbGFwc2VcIl1bZGF0YS10cmFuc2Zvcm1lZF0nKS5hdHRyKCdkYXRhLXR5cGUnLCAnZHJvcGRvd24nKS5hdHRyKCdkYXRhLXRyYW5zZm9ybWVkJywgdHJ1ZSk7XG4gICAgICAgIHRyYW5zZm9ybV9kZCgpO1xuICAgIH1cblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQ3NjgnLCBtYWtlX2RkKTtcblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQxMDI0JywgbWFrZV9kZCk7XG5cbn0pKGpRdWVyeSk7IiwibW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbiAoc2lkZWJhcikge1xuICAgIHJldHVybiB7XG4gICAgICAgIFwidHJhbnNmb3JtLWJ1dHRvblwiOiBzaWRlYmFyLmRhdGEoJ3RyYW5zZm9ybUJ1dHRvbicpID09PSB0cnVlLFxuICAgICAgICBcInRyYW5zZm9ybS1idXR0b24taWNvblwiOiBzaWRlYmFyLmRhdGEoJ3RyYW5zZm9ybUJ1dHRvbkljb24nKSB8fCAnZmEtZWxsaXBzaXMtaCdcbiAgICB9O1xufTsiLCIoZnVuY3Rpb24gKCQpIHtcblxuICAgIHZhciBzaWRlYmFycyA9ICQoJy5zaWRlYmFyJyk7XG5cbiAgICBzaWRlYmFycy5lYWNoKGZ1bmN0aW9uICgpIHtcblxuICAgICAgICB2YXIgc2lkZWJhciA9ICQodGhpcyk7XG4gICAgICAgIHZhciBvcHRpb25zID0gcmVxdWlyZSgnLi9fb3B0aW9ucycpKHNpZGViYXIpO1xuXG4gICAgICAgIGlmIChvcHRpb25zWyAndHJhbnNmb3JtLWJ1dHRvbicgXSkge1xuICAgICAgICAgICAgdmFyIGJ1dHRvbiA9ICQoJzxidXR0b24gdHlwZT1cImJ1dHRvblwiPjwvYnV0dG9uPicpO1xuXG4gICAgICAgICAgICBidXR0b25cbiAgICAgICAgICAgICAgICAuYXR0cignZGF0YS10b2dnbGUnLCAnc2lkZWJhci10cmFuc2Zvcm0nKVxuICAgICAgICAgICAgICAgIC5hZGRDbGFzcygnYnRuIGJ0bi1kZWZhdWx0JylcbiAgICAgICAgICAgICAgICAuaHRtbCgnPGkgY2xhc3M9XCJmYSAnICsgb3B0aW9uc1sgJ3RyYW5zZm9ybS1idXR0b24taWNvbicgXSArICdcIj48L2k+Jyk7XG5cbiAgICAgICAgICAgIHNpZGViYXIuZmluZCgnLnNpZGViYXItbWVudScpLmFwcGVuZChidXR0b24pO1xuICAgICAgICB9XG4gICAgfSk7XG5cbn0oalF1ZXJ5KSk7IiwiKGZ1bmN0aW9uICgkKSB7XG4gICAgLypqc2hpbnQgYnJvd3NlcjogdHJ1ZSwgc3RyaWN0OiBmYWxzZSAqL1xuXG4gICAgJCgnI3N1Ym5hdicpLmNvbGxhcHNlKHsndG9nZ2xlJzogZmFsc2V9KTtcblxuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInNpZGViYXItdHJhbnNmb3JtXCJdJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKCdib2R5JykudG9nZ2xlQ2xhc3MoJ3NpZGViYXItbWluaScpO1xuICAgICAgICBpZiAoJCgnYm9keScpLmlzKCcuc2lkZWJhci1taW5pJykpICQoJy5zaWRlYmFyLW1lbnUgLmNvbGxhcHNlJykuY29sbGFwc2UoJ2hpZGUnKTtcbiAgICAgICAgJCgnI2Ryb3Bkb3duLXRlbXAnKS5oaWRlKCk7XG4gICAgICAgICQoJy5zaWRlYmFyLW1lbnUgLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuXG4oZnVuY3Rpb24gKCQpIHtcblxuICAgIGZ1bmN0aW9uIG1vYmlsZWNoZWNrKCkge1xuICAgICAgICB2YXIgY2hlY2sgPSBmYWxzZTtcbiAgICAgICAgKGZ1bmN0aW9uIChhKSB7XG4gICAgICAgICAgICBpZiAoLyhhbmRyb2lkfGlwYWR8cGxheWJvb2t8c2lsa3xiYlxcZCt8bWVlZ28pLittb2JpbGV8YXZhbnRnb3xiYWRhXFwvfGJsYWNrYmVycnl8YmxhemVyfGNvbXBhbHxlbGFpbmV8ZmVubmVjfGhpcHRvcHxpZW1vYmlsZXxpcChob25lfG9kKXxpcmlzfGtpbmRsZXxsZ2UgfG1hZW1vfG1pZHB8bW1wfG5ldGZyb250fG9wZXJhIG0ob2J8aW4paXxwYWxtKCBvcyk/fHBob25lfHAoaXhpfHJlKVxcL3xwbHVja2VyfHBvY2tldHxwc3B8c2VyaWVzKDR8NikwfHN5bWJpYW58dHJlb3x1cFxcLihicm93c2VyfGxpbmspfHZvZGFmb25lfHdhcHx3aW5kb3dzIChjZXxwaG9uZSl8eGRhfHhpaW5vL2kudGVzdChhKSB8fCAvMTIwN3w2MzEwfDY1OTB8M2dzb3w0dGhwfDUwWzEtNl1pfDc3MHN8ODAyc3xhIHdhfGFiYWN8YWMoZXJ8b298c1xcLSl8YWkoa298cm4pfGFsKGF2fGNhfGNvKXxhbW9pfGFuKGV4fG55fHl3KXxhcHR1fGFyKGNofGdvKXxhcyh0ZXx1cyl8YXR0d3xhdShkaXxcXC1tfHIgfHMgKXxhdmFufGJlKGNrfGxsfG5xKXxiaShsYnxyZCl8YmwoYWN8YXopfGJyKGV8dil3fGJ1bWJ8YndcXC0obnx1KXxjNTVcXC98Y2FwaXxjY3dhfGNkbVxcLXxjZWxsfGNodG18Y2xkY3xjbWRcXC18Y28obXB8bmQpfGNyYXd8ZGEoaXR8bGx8bmcpfGRidGV8ZGNcXC1zfGRldml8ZGljYXxkbW9ifGRvKGN8cClvfGRzKDEyfFxcLWQpfGVsKDQ5fGFpKXxlbShsMnx1bCl8ZXIoaWN8azApfGVzbDh8ZXooWzQtN10wfG9zfHdhfHplKXxmZXRjfGZseShcXC18Xyl8ZzEgdXxnNTYwfGdlbmV8Z2ZcXC01fGdcXC1tb3xnbyhcXC53fG9kKXxncihhZHx1bil8aGFpZXxoY2l0fGhkXFwtKG18cHx0KXxoZWlcXC18aGkocHR8dGEpfGhwKCBpfGlwKXxoc1xcLWN8aHQoYyhcXC18IHxffGF8Z3xwfHN8dCl8dHApfGh1KGF3fHRjKXxpXFwtKDIwfGdvfG1hKXxpMjMwfGlhYyggfFxcLXxcXC8pfGlicm98aWRlYXxpZzAxfGlrb218aW0xa3xpbm5vfGlwYXF8aXJpc3xqYSh0fHYpYXxqYnJvfGplbXV8amlnc3xrZGRpfGtlaml8a2d0KCB8XFwvKXxrbG9ufGtwdCB8a3djXFwtfGt5byhjfGspfGxlKG5vfHhpKXxsZyggZ3xcXC8oa3xsfHUpfDUwfDU0fFxcLVthLXddKXxsaWJ3fGx5bnh8bTFcXC13fG0zZ2F8bTUwXFwvfG1hKHRlfHVpfHhvKXxtYygwMXwyMXxjYSl8bVxcLWNyfG1lKHJjfHJpKXxtaShvOHxvYXx0cyl8bW1lZnxtbygwMXwwMnxiaXxkZXxkb3x0KFxcLXwgfG98dil8enopfG10KDUwfHAxfHYgKXxtd2JwfG15d2F8bjEwWzAtMl18bjIwWzItM118bjMwKDB8Mil8bjUwKDB8Mnw1KXxuNygwKDB8MSl8MTApfG5lKChjfG0pXFwtfG9ufHRmfHdmfHdnfHd0KXxub2soNnxpKXxuenBofG8yaW18b3AodGl8d3YpfG9yYW58b3dnMXxwODAwfHBhbihhfGR8dCl8cGR4Z3xwZygxM3xcXC0oWzEtOF18YykpfHBoaWx8cGlyZXxwbChheXx1Yyl8cG5cXC0yfHBvKGNrfHJ0fHNlKXxwcm94fHBzaW98cHRcXC1nfHFhXFwtYXxxYygwN3wxMnwyMXwzMnw2MHxcXC1bMi03XXxpXFwtKXxxdGVrfHIzODB8cjYwMHxyYWtzfHJpbTl8cm8odmV8em8pfHM1NVxcL3xzYShnZXxtYXxtbXxtc3xueXx2YSl8c2MoMDF8aFxcLXxvb3xwXFwtKXxzZGtcXC98c2UoYyhcXC18MHwxKXw0N3xtY3xuZHxyaSl8c2doXFwtfHNoYXJ8c2llKFxcLXxtKXxza1xcLTB8c2woNDV8aWQpfHNtKGFsfGFyfGIzfGl0fHQ1KXxzbyhmdHxueSl8c3AoMDF8aFxcLXx2XFwtfHYgKXxzeSgwMXxtYil8dDIoMTh8NTApfHQ2KDAwfDEwfDE4KXx0YShndHxsayl8dGNsXFwtfHRkZ1xcLXx0ZWwoaXxtKXx0aW1cXC18dFxcLW1vfHRvKHBsfHNoKXx0cyg3MHxtXFwtfG0zfG01KXx0eFxcLTl8dXAoXFwuYnxnMXxzaSl8dXRzdHx2NDAwfHY3NTB8dmVyaXx2aShyZ3x0ZSl8dmsoNDB8NVswLTNdfFxcLXYpfHZtNDB8dm9kYXx2dWxjfHZ4KDUyfDUzfDYwfDYxfDcwfDgwfDgxfDgzfDg1fDk4KXx3M2MoXFwtfCApfHdlYmN8d2hpdHx3aShnIHxuY3xudyl8d21sYnx3b251fHg3MDB8eWFzXFwtfHlvdXJ8emV0b3x6dGVcXC0vaS50ZXN0KGEuc3Vic3RyKDAsIDQpKSlcbiAgICAgICAgICAgICAgICBjaGVjayA9IHRydWU7XG4gICAgICAgIH0pKG5hdmlnYXRvci51c2VyQWdlbnQgfHwgbmF2aWdhdG9yLnZlbmRvciB8fCB3aW5kb3cub3BlcmEpO1xuICAgICAgICByZXR1cm4gY2hlY2s7XG4gICAgfVxuXG4gICAgKGZ1bmN0aW9uICgpIHtcblxuICAgICAgICB2YXIgY29udGFpbmVyID0gJCgnLnN0LWNvbnRhaW5lcicpLFxuXG4gICAgICAgICAgICBldmVudHR5cGUgPSBtb2JpbGVjaGVjaygpID8gJ3RvdWNoc3RhcnQnIDogJ2NsaWNrJyxcbiAgICAgICAgICAgIHJlc2V0TWVudSA9IGZ1bmN0aW9uICgpIHtcblxuICAgICAgICAgICAgICAgIHZhciBlZmZlY3QgPSBjb250YWluZXIuZGF0YSgnc3RNZW51RWZmZWN0JyksXG4gICAgICAgICAgICAgICAgICAgIHNpZGViYXIgPSAkKGNvbnRhaW5lci5kYXRhKCdzdE1lbnVUYXJnZXQnKSksXG4gICAgICAgICAgICAgICAgICAgIGh0bWxPbGRDbGFzcyA9ICQoJ2h0bWwnKS5nZXQoMCkuY2xhc3NOYW1lLm1hdGNoKC9zdC1lZmZlY3QtXFxTKy9pZyk7XG5cbiAgICAgICAgICAgICAgICBjb250YWluZXIucmVtb3ZlQ2xhc3MoJ3N0LW1lbnUtb3BlbicpO1xuXG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbigpe1xuICAgICAgICAgICAgICAgICAgICBpZiAoaHRtbE9sZENsYXNzICE9PSBudWxsKSAkKCdodG1sJykucmVtb3ZlQ2xhc3MoaHRtbE9sZENsYXNzLmpvaW4oXCIgXCIpKTtcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhci5yZW1vdmVDbGFzcyhlZmZlY3QpO1xuICAgICAgICAgICAgICAgICAgICBjb250YWluZXIuZ2V0KDApLmNsYXNzTmFtZSA9ICdzdC1jb250YWluZXInOyAvLyBjbGVhclxuICAgICAgICAgICAgICAgICAgICBzaWRlYmFyLmhpZGUoKTtcbiAgICAgICAgICAgICAgICB9LCA1NTApO1xuXG4gICAgICAgICAgICB9LFxuXG4gICAgICAgICAgICBhbmltYXRlID0gZnVuY3Rpb24gKGUpIHtcblxuICAgICAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuXG4gICAgICAgICAgICAgICAgaWYgKCQodGhpcykuaGFzQ2xhc3MoJ2FuaW1hdGluZycpKSByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnYW5pbWF0aW5nJyk7XG5cbiAgICAgICAgICAgICAgICB2YXIgYnV0dG9uID0gJCh0aGlzKSxcbiAgICAgICAgICAgICAgICAgICAgZWZmZWN0ID0gYnV0dG9uLmRhdGEoJ2VmZmVjdCcpIHx8ICdzdC1lZmZlY3QtMScsXG4gICAgICAgICAgICAgICAgICAgIHRhcmdldCA9IGJ1dHRvbi5hdHRyKCdocmVmJyk7XG5cbiAgICAgICAgICAgICAgICB2YXIgY3VycmVudEFjdGl2ZUVsZW1lbnQgPSAkKCdbZGF0YS10b2dnbGU9XCJzaWRlYmFyLW1lbnVcIl0nKS5ub3QodGhpcykuY2xvc2VzdCgnbGknKS5sZW5ndGggPyAkKCdbZGF0YS10b2dnbGU9XCJzaWRlYmFyLW1lbnVcIl0nKS5ub3QodGhpcykuY2xvc2VzdCgnbGknKSA6ICQoJ1tkYXRhLXRvZ2dsZT1cInNpZGViYXItbWVudVwiXScpLm5vdCh0aGlzKTtcbiAgICAgICAgICAgICAgICBjdXJyZW50QWN0aXZlRWxlbWVudC5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XG5cbiAgICAgICAgICAgICAgICB2YXIgYWN0aXZlRWxlbWVudCA9ICQodGhpcykuY2xvc2VzdCgnbGknKS5sZW5ndGggPyAkKHRoaXMpLmNsb3Nlc3QoJ2xpJykgOiAkKHRoaXMpO1xuICAgICAgICAgICAgICAgIGFjdGl2ZUVsZW1lbnQuYWRkQ2xhc3MoJ2FjdGl2ZScpO1xuXG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGJ1dHRvbi5yZW1vdmVDbGFzcygnYW5pbWF0aW5nJyk7XG4gICAgICAgICAgICAgICAgfSwgNTUwKTtcblxuICAgICAgICAgICAgICAgIGlmICh0YXJnZXQubGVuZ3RoIDwgMykge1xuICAgICAgICAgICAgICAgICAgICBpZiAoJCgnaHRtbCcpLmhhc0NsYXNzKCdzaG93LXNpZGViYXInKSkge1xuICAgICAgICAgICAgICAgICAgICAgICAgYWN0aXZlRWxlbWVudC5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgJCgnaHRtbCcpLnJlbW92ZUNsYXNzKCdzaG93LXNpZGViYXInKTtcbiAgICAgICAgICAgICAgICAgICAgaWYgKGFjdGl2ZUVsZW1lbnQuaGFzQ2xhc3MoJ2FjdGl2ZScpKSAkKCdodG1sJykuYWRkQ2xhc3MoJ3Nob3ctc2lkZWJhcicpO1xuICAgICAgICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICAgICAgdmFyIHNpZGViYXIgPSAkKHRhcmdldCksXG4gICAgICAgICAgICAgICAgICAgIGRpcmVjdGlvbiA9IHNpZGViYXIuaXMoJy5sZWZ0JykgPyAnbCcgOiAncicsXG4gICAgICAgICAgICAgICAgICAgIHNpemUgPSBzaWRlYmFyLmdldCgwKS5jbGFzc05hbWUubWF0Y2goL3NpZGViYXItc2l6ZS0oXFxTKykvKS5wb3AoKSxcbiAgICAgICAgICAgICAgICAgICAgaHRtbENsYXNzID0gJ3N0LWVmZmVjdC0nICsgZGlyZWN0aW9uICsgc2l6ZTtcblxuICAgICAgICAgICAgICAgIGlmIChjb250YWluZXIuaGFzQ2xhc3MoJ3N0LW1lbnUtb3BlbicpKSB7XG4gICAgICAgICAgICAgICAgICAgIGFjdGl2ZUVsZW1lbnQucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICAgICAgICAgICByZXNldE1lbnUoKTtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgICQoJ2h0bWwnKS5hZGRDbGFzcyhodG1sQ2xhc3MpO1xuICAgICAgICAgICAgICAgIHNpZGViYXIuc2hvdygpO1xuXG4gICAgICAgICAgICAgICAgY29udGFpbmVyLmRhdGEoJ3N0TWVudUVmZmVjdCcsIGVmZmVjdCk7XG4gICAgICAgICAgICAgICAgY29udGFpbmVyLmRhdGEoJ3N0TWVudVRhcmdldCcsIHRhcmdldCk7XG5cbiAgICAgICAgICAgICAgICBzaWRlYmFyLmFkZENsYXNzKGVmZmVjdCk7XG4gICAgICAgICAgICAgICAgY29udGFpbmVyLmFkZENsYXNzKGVmZmVjdCk7XG5cbiAgICAgICAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAgICAgY29udGFpbmVyLmFkZENsYXNzKCdzdC1tZW51LW9wZW4nKTtcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCdbZGF0YS1zY3JvbGxhYmxlXScpLmdldE5pY2VTY3JvbGwoKS5yZXNpemUoKTtcbiAgICAgICAgICAgICAgICB9LCAyNSk7XG4gICAgICAgICAgICB9O1xuXG4gICAgICAgICQoJ2JvZHknKS5vbihldmVudHR5cGUsICdbZGF0YS10b2dnbGU9XCJzaWRlYmFyLW1lbnVcIl0nLCBhbmltYXRlKTtcbiAgICAgICAgJChkb2N1bWVudCkub24oJ2tleWRvd24nLCBudWxsLCAnZXNjJywgZnVuY3Rpb24oKXtcbiAgICAgICAgICAgIGlmIChjb250YWluZXIuaGFzQ2xhc3MoJ3N0LW1lbnUtb3BlbicpKSB7XG4gICAgICAgICAgICAgICAgJCgnW2RhdGEtdG9nZ2xlPVwic2lkZWJhci1tZW51XCJdJylcbiAgICAgICAgICAgICAgICAgICAgLnJlbW92ZUNsYXNzKCdhY3RpdmUnKVxuICAgICAgICAgICAgICAgICAgICAuY2xvc2VzdCgnbGknKVxuICAgICAgICAgICAgICAgICAgICAucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuXG4gICAgICAgICAgICAgICAgcmVzZXRNZW51KCk7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgIH0pKCk7XG5cbn0pKGpRdWVyeSk7IiwibW9kdWxlLmV4cG9ydHMgPSBmdW5jdGlvbiAoKSB7XG4gICAgdmFyIGRkID0gJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiY29sbGFwc2VcIl0nKTtcblxuICAgIGlmIChkZC5sZW5ndGgpIHtcblxuICAgICAgICAkKCcuc2lkZWJhciBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkgPiBhJykub2ZmKCdtb3VzZWVudGVyJyk7XG4gICAgICAgICQoJy5zaWRlYmFyIFtkYXRhLXNjcm9sbGFibGVdID4gdWwgPiBsaS5kcm9wZG93biA+IGEnKS5vZmYoJ21vdXNlZW50ZXInKTtcbiAgICAgICAgJCgnLnNpZGViYXIgW2RhdGEtc2Nyb2xsYWJsZV0gPiB1bCA+IGxpID4gYScpLm9mZignbW91c2VlbnRlcicpO1xuICAgICAgICAkKCcuc2lkZWJhciBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkgPiBhJykub2ZmKCdjbGljaycpO1xuICAgICAgICAkKCcuc2lkZWJhcicpLm9mZignbW91c2VsZWF2ZScpO1xuICAgICAgICAkKCcuc2lkZWJhciAuZHJvcGRvd24nKS5vZmYoJ21vdXNlb3ZlcicpO1xuICAgICAgICAkKCcuc2lkZWJhciAuZHJvcGRvd24nKS5vZmYoJ21vdXNlb3V0Jyk7XG4gICAgICAgICQoJ2JvZHknKS5vZmYoJ21vdXNlb3V0JywgJyNkcm9wZG93bi10ZW1wIC5kcm9wZG93bicpO1xuXG4gICAgICAgICQoJy5zaWRlYmFyIHVsLmNvbGxhcHNlJykub2ZmKCdzaG93bi5icy5jb2xsYXBzZScpO1xuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9mZignc2hvdy5icy5jb2xsYXBzZScpO1xuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9mZignaGlkZS5icy5jb2xsYXBzZScpO1xuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9mZignaGlkZGVuLmJzLmNvbGxhcHNlJyk7XG5cbiAgICAgICAgZGQuZmluZCgnI2Ryb3Bkb3duLXRlbXAnKS5yZW1vdmUoKTtcblxuICAgICAgICBkZC5maW5kKCcuaGFzU3VibWVudScpLnJlbW92ZUNsYXNzKCdkcm9wZG93bicpXG4gICAgICAgICAgICAuZmluZCgnPiB1bCcpLmFkZENsYXNzKCdjb2xsYXBzZScpLnJlbW92ZUNsYXNzKCdkcm9wZG93bi1tZW51IHN1Ym1lbnUtaGlkZSBzdWJtZW51LXNob3cnKVxuICAgICAgICAgICAgLmVuZCgpXG4gICAgICAgICAgICAuZmluZCgnPiBhJykuYXR0cignZGF0YS10b2dnbGUnLCAnY29sbGFwc2UnKTtcblxuICAgICAgICBkZC5maW5kKCcuY29sbGFwc2UnKS5jb2xsYXBzZSh7J3RvZ2dsZSc6IGZhbHNlfSk7XG5cbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vbignc2hvd24uYnMuY29sbGFwc2UnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgJCgnLnNpZGViYXIgW2RhdGEtc2Nyb2xsYWJsZV0nKS5nZXROaWNlU2Nyb2xsKCkucmVzaXplKCk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIENvbGxhcHNlXG4gICAgICAgICQoJy5zaWRlYmFyIHVsLmNvbGxhcHNlJykub24oJ3Nob3cuYnMuY29sbGFwc2UnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcblxuICAgICAgICAgICAgaWYgKCQoJy5zaWRlYmFyLW1pbmknKS5sZW5ndGgpICQoJy5zaWRlYmFyLW1pbmknKS5yZW1vdmVDbGFzcygnc2lkZWJhci1taW5pJykuZGF0YSgnbWluaScsIHRydWUpO1xuXG4gICAgICAgICAgICB2YXIgcGFyZW50cyA9ICQodGhpcykucGFyZW50cygndWw6Zmlyc3QnKS5maW5kKCc+IGxpLm9wZW4gW2RhdGEtdG9nZ2xlPVwiY29sbGFwc2VcIl0nKTtcbiAgICAgICAgICAgIGlmIChwYXJlbnRzLmxlbmd0aCkge1xuICAgICAgICAgICAgICAgIHBhcmVudHMudHJpZ2dlcignY2xpY2snKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgICQodGhpcykucGFyZW50KCkuYWRkQ2xhc3MoXCJvcGVuXCIpO1xuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9uKCdoaWRlLmJzLmNvbGxhcHNlJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICBpZiAoJCh0aGlzKS5pcygnLnNpZGViYXItbWVudSBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkgPiB1bCcpKSB7XG4gICAgICAgICAgICAgICAgaWYgKCQoJy5zaG93LXNpZGViYXInKS5kYXRhKCdtaW5pJykpIHtcbiAgICAgICAgICAgICAgICAgICAgJCgnLnNob3ctc2lkZWJhcicpLmFkZENsYXNzKCdzaWRlYmFyLW1pbmknKTtcbiAgICAgICAgICAgICAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5yZW1vdmVDbGFzcyhcIm9wZW5cIik7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9uKCdoaWRkZW4uYnMuY29sbGFwc2UnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICAgICAgICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoXCJvcGVuXCIpO1xuICAgICAgICB9KTtcbiAgICB9XG59OyIsIm1vZHVsZS5leHBvcnRzID0gZnVuY3Rpb24gKCkge1xuICAgIHZhciBkZCA9ICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJyk7XG5cbiAgICBpZiAoZGQubGVuZ3RoKSB7XG5cbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKVxuICAgICAgICAgICAgLm9mZignc2hvd24uYnMuY29sbGFwc2UnKVxuICAgICAgICAgICAgLm9mZignc2hvdy5icy5jb2xsYXBzZScpXG4gICAgICAgICAgICAub2ZmKCdoaWRkZW4uYnMuY29sbGFwc2UnKTtcblxuICAgICAgICBkZC5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHZhciBzaWRlYmFyID0gJCh0aGlzKTtcbiAgICAgICAgICAgIHZhciBuaWNlID0gc2lkZWJhci5maW5kKCdbZGF0YS1zY3JvbGxhYmxlXScpLmdldE5pY2VTY3JvbGwoKVsgMCBdO1xuXG4gICAgICAgICAgICBuaWNlLnNjcm9sbHN0YXJ0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICBpZiAoISBzaWRlYmFyLmlzKCdbZGF0YS10eXBlPVwiZHJvcGRvd25cIl0nKSkgcmV0dXJuO1xuICAgICAgICAgICAgICAgIHNpZGViYXIuZmluZCgnLnNpZGViYXItbWVudScpLmFkZENsYXNzKCdzY3JvbGxpbmcnKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJyNkcm9wZG93bi10ZW1wID4gdWwgPiBsaScpLmVtcHR5KCk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcjZHJvcGRvd24tdGVtcCcpLmhpZGUoKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJy5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICBuaWNlLnNjcm9sbGVuZChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgaWYgKCEgc2lkZWJhci5pcygnW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJykpIHJldHVybjtcbiAgICAgICAgICAgICAgICAkLmRhdGEodGhpcywgJ2xhc3RTY3JvbGxUb3AnLCBuaWNlLmdldFNjcm9sbFRvcCgpKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJy5zaWRlYmFyLW1lbnUnKS5yZW1vdmVDbGFzcygnc2Nyb2xsaW5nJyk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgZGQuZmluZCgnLmhhc1N1Ym1lbnUnKS5hZGRDbGFzcygnZHJvcGRvd24nKS5yZW1vdmVDbGFzcygnb3BlbicpXG4gICAgICAgICAgICAuZmluZCgnPiB1bCcpLmFkZENsYXNzKCdkcm9wZG93bi1tZW51JykucmVtb3ZlQ2xhc3MoJ2NvbGxhcHNlIGluJykucmVtb3ZlQXR0cignc3R5bGUnKVxuICAgICAgICAgICAgLmVuZCgpXG4gICAgICAgICAgICAuZmluZCgnPiBhJykucmVtb3ZlQ2xhc3MoJ2NvbGxhcHNlZCcpXG4gICAgICAgICAgICAucmVtb3ZlQXR0cignZGF0YS10b2dnbGUnKTtcblxuICAgICAgICAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXSBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkuZHJvcGRvd24gPiBhJykub24oJ21vdXNlZW50ZXInLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZiAoISAkKHRoaXMpLnBhcmVudCgnLmRyb3Bkb3duJykuaXMoJy5vcGVuJykgJiYgISAkKCcuc2lkZWJhci1tZW51JykuaXMoJy5zY3JvbGxpbmcnKSkge1xuICAgICAgICAgICAgICAgIHZhciBwID0gJCh0aGlzKS5wYXJlbnQoJy5kcm9wZG93bicpLFxuICAgICAgICAgICAgICAgICAgICB0ID0gcC5maW5kKCc+IC5kcm9wZG93bi1tZW51JykuY2xvbmUoKS5yZW1vdmVDbGFzcygnc3VibWVudS1oaWRlJyksXG4gICAgICAgICAgICAgICAgICAgIG0gPSAkKHRoaXMpLmNsb3Nlc3QoJy5zaWRlYmFyLW1lbnUnKSxcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhciA9ICQodGhpcykuY2xvc2VzdCgnLnNpZGViYXInKSxcbiAgICAgICAgICAgICAgICAgICAgYyA9IG0uZmluZCgnPiAjZHJvcGRvd24tdGVtcCcpO1xuXG4gICAgICAgICAgICAgICAgbS5maW5kKCcub3BlbicpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG5cbiAgICAgICAgICAgICAgICBpZiAoISBjLmxlbmd0aCkge1xuICAgICAgICAgICAgICAgICAgICBjID0gJCgnPGRpdi8+JykuYXR0cignaWQnLCAnZHJvcGRvd24tdGVtcCcpLmFwcGVuZFRvKG0pO1xuICAgICAgICAgICAgICAgICAgICBjLmh0bWwoJzx1bD48bGk+PC9saT48L3VsPicpO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIGMuc2hvdygpO1xuICAgICAgICAgICAgICAgIGMuZmluZCgnLmRyb3Bkb3duLW1lbnUnKS5yZW1vdmUoKTtcbiAgICAgICAgICAgICAgICBjID0gYy5maW5kKCc+IHVsID4gbGknKS5jc3Moe292ZXJmbG93OiAndmlzaWJsZSd9KS5hZGRDbGFzcygnZHJvcGRvd24gb3BlbicpO1xuXG4gICAgICAgICAgICAgICAgcC5hZGRDbGFzcygnb3BlbicpO1xuICAgICAgICAgICAgICAgIHQuYXBwZW5kVG8oYykuY3NzKHtcbiAgICAgICAgICAgICAgICAgICAgdG9wOiBwLm9mZnNldCgpLnRvcCAtIGMub2Zmc2V0KCkudG9wLFxuICAgICAgICAgICAgICAgICAgICBsZWZ0OiAnMTAwJSdcbiAgICAgICAgICAgICAgICB9KS5zaG93KCk7XG5cbiAgICAgICAgICAgICAgICBpZiAoc2lkZWJhci5pcygnLnJpZ2h0JykpIHtcbiAgICAgICAgICAgICAgICAgICAgdC5jc3Moe1xuICAgICAgICAgICAgICAgICAgICAgICAgbGVmdDogJ2F1dG8nLFxuICAgICAgICAgICAgICAgICAgICAgICAgcmlnaHQ6ICcxMDAlJ1xuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdIFtkYXRhLXNjcm9sbGFibGVdID4gdWwgPiBsaSA+IGEnKS5vbignbW91c2VlbnRlcicsIGZ1bmN0aW9uICgpIHtcblxuICAgICAgICAgICAgaWYgKCEgJCh0aGlzKS5wYXJlbnQoKS5pcygnLmRyb3Bkb3duJykpIHtcbiAgICAgICAgICAgICAgICB2YXIgc2lkZWJhciA9ICQodGhpcykuY2xvc2VzdCgnLnNpZGViYXInKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJy5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJyNkcm9wZG93bi10ZW1wJykuaGlkZSgpO1xuICAgICAgICAgICAgfVxuXG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdIFtkYXRhLXNjcm9sbGFibGVdID4gdWwgPiBsaSA+IGEnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgaWYgKCQodGhpcykucGFyZW50KCkuaXMoJy5kcm9wZG93bicpKSB7XG4gICAgICAgICAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJykub24oJ21vdXNlbGVhdmUnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmZpbmQoJyNkcm9wZG93bi10ZW1wJykuaGlkZSgpO1xuICAgICAgICAgICAgJCh0aGlzKS5maW5kKCcub3BlbicpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdIC5kcm9wZG93bicpLm9uKCdtb3VzZW92ZXInLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdvcGVuJykuY2hpbGRyZW4oJ3VsJykucmVtb3ZlQ2xhc3MoJ3N1Ym1lbnUtaGlkZScpLmFkZENsYXNzKCdzdWJtZW51LXNob3cnKTtcbiAgICAgICAgfSkub24oJ21vdXNlb3V0JywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCh0aGlzKS5jaGlsZHJlbigndWwnKS5yZW1vdmVDbGFzcygnLnN1Ym1lbnUtc2hvdycpLmFkZENsYXNzKCdzdWJtZW51LWhpZGUnKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgJCgnYm9keScpLm9uKCdtb3VzZW91dCcsICcjZHJvcGRvd24tdGVtcCAuZHJvcGRvd24nLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAkKCcuc2lkZWJhci1tZW51IC5vcGVuJykucmVtb3ZlQ2xhc3MoJy5vcGVuJyk7XG4gICAgICAgIH0pO1xuICAgIH1cbn07Il19
