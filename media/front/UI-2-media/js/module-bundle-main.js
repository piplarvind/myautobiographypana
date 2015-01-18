(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({"./app/js/themes/social-2/main.js":[function(require,module,exports){
// COMMON
require('../../common/main');

// Essentials
require('../../../vendor/ui/js/main');

// Layout
require('../../../vendor/layout/js/main');

// Sidebar
require('../../../vendor/sidebar/js/main');

// Navbar
require('../../../vendor/navbar/js/main');

// Chat
require('../../../vendor/chat/js/main');

// Social
require('../../../vendor/social/js/main');

// Messages
require('../../components/messages/main');

// CUSTOM
require('../../pages/users');
},{"../../../vendor/chat/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/main.js","../../../vendor/layout/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/main.js","../../../vendor/navbar/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/navbar/js/main.js","../../../vendor/sidebar/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/main.js","../../../vendor/social/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/social/js/main.js","../../../vendor/ui/js/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/main.js","../../common/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/common/main.js","../../components/messages/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/main.js","../../pages/users":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/pages/users.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/common/main.js":[function(require,module,exports){
require('../components/forms/main');
require('../components/tables/main');
require('../components/other/_tooltip');
require('../components/other/_offcanvas');
require('../components/other/_ratings');
},{"../components/forms/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/main.js","../components/other/_offcanvas":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_offcanvas.js","../components/other/_ratings":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_ratings.js","../components/other/_tooltip":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_tooltip.js","../components/tables/main":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/main.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_datepicker.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // Datepicker INIT
    $('.datepicker').datepicker();

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_minicolors.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // Minicolors INIT
    $('.minicolors').each(function () {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function (hex, opacity) {
                if (! hex) return;
                if (opacity) hex += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(hex);
                }
            },
            theme: 'bootstrap'
        });
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_progress-bars.js":[function(require,module,exports){
(function ($) {

    // Progress Bar Animation
    $('.progress-bar').each(function () {
        $(this).width($(this).attr('aria-valuenow') + '%');
    });

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_selectpicker.js":[function(require,module,exports){
(function ($) {
    "use strict";
    $(function () {
        $('.selectpicker').each(function(){
            $(this).selectpicker({
                width: $(this).data('width') || '100%'
            });
        });
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_slider.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $('[data-slider="default"]').slider();

    $('[data-slider="formatter"]').slider({
        formatter: function (value) {
            return 'Current value: ' + value;
        }
    });

    $('[data-on-slide]').on("slide", function (slideEvt) {
        $($(this).attr('data-on-slide')).text(slideEvt.value);
    });

    $('.slider-handle').html('<i class="fa fa-bars fa-rotate-90"></i>');

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/main.js":[function(require,module,exports){
require('./_progress-bars');
require('./_slider');
require('./_selectpicker');
require('./_datepicker');
require('./_minicolors');
},{"./_datepicker":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_datepicker.js","./_minicolors":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_minicolors.js","./_progress-bars":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_progress-bars.js","./_selectpicker":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_selectpicker.js","./_slider":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/forms/_slider.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/_breakpoints.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $(window).bind('enterBreakpoint320', function () {
        var img = $('.messages-list .panel ul img');
        $('.messages-list .panel ul').width(img.first().width() * img.length);
    });

    $(window).bind('exitBreakpoint320', function () {
        $('.messages-list .panel ul').width('auto');
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/_nicescroll.js":[function(require,module,exports){
(function ($) {
    "use strict";

    var nice = $('.messages-list .panel').niceScroll({cursorborder: 0, cursorcolor: "#25ad9f", zindex: 1});

    var _super = nice.getContentSize;

    nice.getContentSize = function () {
        var page = _super.call(nice);
        page.h = nice.win.height();
        return page;
    };

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/main.js":[function(require,module,exports){
require('./_breakpoints');
require('./_nicescroll');
},{"./_breakpoints":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/_breakpoints.js","./_nicescroll":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/messages/_nicescroll.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_offcanvas.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // OffCanvas
    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active');
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_ratings.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // Ratings
    $('.rating span.star').on('click', function () {
        var total = $(this).parent().children().length;
        var clickedIndex = $(this).index();
        $('.rating span.star').removeClass('filled');
        for (var i = clickedIndex; i < total; i ++) {
            $('.rating span.star').eq(i).addClass('filled');
        }
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/other/_tooltip.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // Tooltip
    $("body").tooltip({selector: '[data-toggle="tooltip"]', container: "body"});

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/_check-all.js":[function(require,module,exports){
(function ($) {
    "use strict";

    // Table Checkbox All
    $('#checkAll').on('click', function (e) {
        $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/_datatables.js":[function(require,module,exports){
(function ($) {

    // Datatables
    $('#data-table').dataTable();

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/main.js":[function(require,module,exports){
require('./_datatables');
require('./_check-all');
},{"./_check-all":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/_check-all.js","./_datatables":"/persistent/var/www/html/themekit-3.5.0/dev/app/js/components/tables/_datatables.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/js/pages/users.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $('#users-filter-select').on('change', function () {
        if (this.value === 'name') {
            $('#user-first').removeClass('hidden');
            $('#user-search-name').removeClass('hidden');
        } else {
            $('#user-first').addClass('hidden');
            $('#user-search-name').addClass('hidden');
        }
        if (this.value === 'friends') {
            $('.select-friends').removeClass('hidden');

        } else {
            $('.select-friends').addClass('hidden');
        }
        if (this.value === 'name') {
            $('.search-name').removeClass('hidden');

        } else {
            $('.search-name').addClass('hidden');
        }
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_breakpoints.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $(window).bind('enterBreakpoint480', function () {
        $('.chat-window-container .panel:not(:last)').remove();
        $('.chat-window-container .panel').attr('id', 'chat-0001');
    });

    $(window).bind('enterBreakpoint768', function () {
        if ($('.chat-window-container .panel').length == 3) {
            $('.chat-window-container .panel:first').remove();
            $('.chat-window-container .panel:first').attr('id', 'chat-0001');
            $('.chat-window-container .panel:last').attr('id', 'chat-0002');
        }
    });

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_search.js":[function(require,module,exports){
(function ($) {

    // match anything
    $.expr[ ":" ].containsNoCase = function (el, i, m) {
        var search = m[ 3 ];
        if (! search) return false;
        return new RegExp(search, "i").test($(el).text());
    };

    // Search Filter
    function searchFilterCallBack($data, $opt) {
        var search = $data instanceof jQuery ? $data.val() : $(this).val(),
            opt = typeof $opt == 'undefined' ? $data.data.opt : $opt;

        var $target = $(opt.targetSelector);
        $target.show();

        if (search && search.length >= opt.charCount) {
            $target.not(":containsNoCase(" + search + ")").hide();
        }
    }

    // input filter
    $.fn.searchFilter = function (options) {
        var opt = $.extend({
            // target selector
            targetSelector: "",
            // number of characters before search is applied
            charCount: 1
        }, options);

        return this.each(function () {
            var $el = $(this);
            $el.off("keyup", searchFilterCallBack);
            $el.on("keyup", null, {opt: opt}, searchFilterCallBack);
        });

    };

    // Filter by All/Online/Offline
    $(".chat-filter a").on('click', function (e) {

        e.preventDefault();
        $('.chat-contacts li').hide();
        $('.chat-contacts').find($(this).data('target')).show();

        $(".chat-filter li").removeClass('active');
        $(this).parent().addClass('active');

        $(".chat-search input").searchFilter({targetSelector: ".chat-contacts " + $(this).data('target')});

        // Filter Contacts by Search and Tabs
        searchFilterCallBack($(".chat-search input"), {
            targetSelector: ".chat-contacts " + $(this).data('target'),
            charCount: 1
        });
    });

    // Trigger Search Filter
    $(".chat-search input").searchFilter({targetSelector: ".chat-contacts li"});

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_toggle.js":[function(require,module,exports){
(function ($) {

    $('[data-toggle="chat-box"]').on('click', function () {
        $(".chat-contacts li:first").trigger('click');
        if ($(this).data('hide')) $(this).hide();
    });

    function checkChat() {
        if (! $('html').hasClass('show-chat')) {
            $('.chat-window-container .panel-body').addClass('display-none');
            $('.chat-window-container input').addClass('display-none');
        } else {
            $('.chat-window-container .panel-body').removeClass('display-none');
            $('.chat-window-container input').removeClass('display-none');
        }
    }

    (function () {
        var toggleBtn = $('[data-toggle="sidebar-chat"]');

        // If No Sidebar Exit
        if (! toggleBtn.length) return;

        toggleBtn.on('click', function () {

            $('html').toggleClass('show-chat');

            checkChat();
        });
    })();

    checkChat();
})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_windows.js":[function(require,module,exports){
(function ($) {
    "use strict";

    var container = $('.chat-window-container');

    // Click User
    $(".chat-contacts li").on('click', function () {

        if ($('.chat-window-container [data-user-id="' + $(this).data('userId') + '"]').length) return;

        // If user is offline do nothing
        if ($(this).attr('class') === 'offline') return;

        var source = $("#chat-window-template").html();
        var template = Handlebars.compile(source);

        var context = {user_image: $(this).find('img').attr('src'), user: $(this).find('.contact-name').text()};
        var html = template(context);

        var clone = $(html);

        clone.attr("data-user-id", $(this).data("userId"));

        container.find('.panel:not([id^="chat"])').remove();

        var count = container.find('.panel').length;

        count ++;
        var limit = $(window).width() > 768 ? 3 : 1;
        if (count >= limit) {
            container.find('#chat-000'+ limit).remove();
            count = limit;
        }

        clone.attr('id', 'chat-000' + parseInt(count));
        container.append(clone).show();

        clone.show();
        clone.find('> .panel-body').removeClass('display-none');
        clone.find('> input').removeClass('display-none');
    });

    // Change ID by No. of Windows
    function chatLayout() {
        container.find('.panel').each(function (index, value) {
            $(this).attr('id', 'chat-000' + parseInt(index + 1));
        });
    }

    // remove window
    $("body").on('click', ".chat-window-container .close", function () {
        $(this).parent().parent().remove();
        chatLayout();
        if ($(window).width() < 768) $('.chat-window-container').hide();
    });

    // Chat heading collapse window
    $('body').on('click', '.chat-window-container .panel-heading', function (e) {
        e.preventDefault();
        $(this).parent().find('> .panel-body').toggleClass('display-none');
        $(this).parent().find('> input').toggleClass('display-none');
    });

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/main.js":[function(require,module,exports){
require('./_breakpoints');
require('./_search');
require('./_windows');
require('./_toggle');
},{"./_breakpoints":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_breakpoints.js","./_search":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_search.js","./_toggle":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_toggle.js","./_windows":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/chat/js/_windows.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_async.js":[function(require,module,exports){
function contentLoaded(win, fn) {

    var done = false, top = true,

        doc = win.document,
        root = doc.documentElement,
        modern = doc.addEventListener,

        add = modern ? 'addEventListener' : 'attachEvent',
        rem = modern ? 'removeEventListener' : 'detachEvent',
        pre = modern ? '' : 'on',

        init = function (e) {
            if (e.type == 'readystatechange' && doc.readyState != 'complete') return;
            (e.type == 'load' ? win : doc)[ rem ](pre + e.type, init, false);
            if (! done && (done = true)) fn.call(win, e.type || e);
        },

        poll = function () {
            try {
                root.doScroll('left');
            } catch (e) {
                setTimeout(poll, 50);
                return;
            }
            init('poll');
        };

    if (doc.readyState == 'complete') fn.call(win, 'lazy');
    else {
        if (! modern && root.doScroll) {
            try {
                top = ! win.frameElement;
            } catch (e) {
            }
            if (top) poll();
        }
        doc[ add ](pre + 'DOMContentLoaded', init, false);
        doc[ add ](pre + 'readystatechange', init, false);
        win[ add ](pre + 'load', init, false);
    }
}

module.exports = function(urls, callback) {

    var asyncLoader = function (urls, callback) {

        urls.foreach(function (i, file) {
            loadCss(file);
        });

        // checking for a callback function
        if (typeof callback == 'function') {
            // calling the callback
            contentLoaded(window, callback);
        }
    };

    var loadCss = function (url) {
        var link = document.createElement('link');
        link.type = 'text/css';
        link.rel = 'stylesheet';
        link.href = url;
        document.getElementsByTagName('head')[ 0 ].appendChild(link);
    };

    // simple foreach implementation
    Array.prototype.foreach = function (callback) {
        for (var i = 0; i < this.length; i ++) {
            callback(i, this[ i ]);
        }
    };

    asyncLoader(urls, callback);

};
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_breakpoints.js":[function(require,module,exports){
(function ($) {

    $(window).setBreakpoints({
        distinct: true,
        breakpoints: [ 320, 480, 768, 1024 ]
    });

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_gridalicious.js":[function(require,module,exports){
(function($){

    $('[data-toggle*="gridalicious"]').each(function () {
        $(this).gridalicious({
            gutter: $(this).data('gutter') || 15,
            width: $(this).data('width') || 370,
            selector: '> div'
        });
    });

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_scrollable.js":[function(require,module,exports){
(function ($) {

    var skin = require('./_skin')();

    $('[data-scrollable]').niceScroll({
        cursorborder: 0,
        cursorcolor: config.skins[ skin ][ 'primary-color' ],
        horizrailenabled: false
    });

    $('.st-content-inner').niceScroll({
        cursorborder: 0,
        cursorcolor: config.skins[ skin ][ 'primary-color' ],
        horizrailenabled: false
    });

    $('[data-scrollable]').getNiceScroll().resize();

}(jQuery));
},{"./_skin":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skin.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skin.js":[function(require,module,exports){
module.exports = (function () {
    var skin = $.cookie('skin');

    if (typeof skin == 'undefined') {
        skin = 'default';
    }
    return skin;
});
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skins.js":[function(require,module,exports){
var asyncLoader = require('./_async');

(function ($) {

    var changeSkin = function () {
        var skin = $.cookie("skin");
        if (typeof skin != 'undefined') {
            asyncLoader([ 'css/' + skin + '.min.css' ], function () {
                $('[data-skin]').removeProp('disabled').parent().removeClass('loading');
            });
        }
    };

    $('[data-skin]').on('click', function () {

        if ($(this).prop('disabled')) return;

        $('[data-skin]').prop('disabled', true);

        $(this).parent().addClass('loading');

        $.cookie("skin", $(this).data('skin'));

        changeSkin();

    });

    var skin = $.cookie("skin");

    if (typeof skin != 'undefined' && skin != 'default') {
        changeSkin();
    }

})(jQuery);
},{"./_async":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_async.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/main.js":[function(require,module,exports){
require('./_breakpoints.js');
require('./_gridalicious.js');
require('./_scrollable.js');
require('./_skins');
},{"./_breakpoints.js":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_breakpoints.js","./_gridalicious.js":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_gridalicious.js","./_scrollable.js":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_scrollable.js","./_skins":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skins.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/navbar/js/_switch.js":[function(require,module,exports){
(function ($) {
    $("[name='switch-checkbox']").bootstrapSwitch({
        offColor: 'danger'
    });
})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/navbar/js/main.js":[function(require,module,exports){
require('./_switch');
},{"./_switch":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/navbar/js/_switch.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_breakpoints.js":[function(require,module,exports){
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
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/main.js":[function(require,module,exports){
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
},{"./_breakpoints":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_breakpoints.js","./_collapsible":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_collapsible.js","./_dropdown":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_dropdown.js","./_sidebar-menu":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-menu.js","./_sidebar-toggle":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/sidebar/js/_sidebar-toggle.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/social/js/_timeline.js":[function(require,module,exports){
(function ($) {
    "use strict";

    $('.share textarea').on('keyup', function () {
        $(".share button")[ $(this).val() === '' ? 'hide' : 'show' ]();
    });

    if (! $("#scroll-spy").length) return;

    var offset = $("#scroll-spy").offset().top;

    $('body').scrollspy({target: '#scroll-spy', offset: offset});

})(jQuery);

},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/social/js/main.js":[function(require,module,exports){
require('./_timeline');
},{"./_timeline":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/social/js/_timeline.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_show-hover.js":[function(require,module,exports){
(function ($) {

    var showHover = function () {
        $('[data-show-hover]').hide().each(function () {
            var self = $(this),
                parent = $(this).data('showHover');

            self.closest(parent).on('mouseover', function (e) {
                e.stopPropagation();
                self.show();
            }).on('mouseout', function () {
                self.hide();
            });
        });
    };

    showHover();

    window.showHover = showHover;

})(jQuery);
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_skin.js":[function(require,module,exports){
module.exports=require("/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skin.js")
},{"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skin.js":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/layout/js/_skin.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_tabs.js":[function(require,module,exports){
(function ($) {

    var skin = require('./_skin')();

    $('.tabbable .nav-tabs').each(function(){
        var tabs = $(this).niceScroll({
            cursorborder: 0,
            cursorcolor: config.skins[ skin ][ 'primary-color' ],
            horizrailenabled: true,
            oneaxismousemode: true
        });

        var _super = tabs.getContentSize;
        tabs.getContentSize = function() {
            var page = _super.call(tabs);
            page.h = tabs.win.height();
            return page;
        };
    });

    $('[data-scrollable]').getNiceScroll().resize();

    $('.tabbable .nav-tabs a').on('shown.bs.tab', function(e){
        var tab = $(this).closest('.tabbable');
        var target = $(e.target),
            targetPane = target.attr('href') || target.data('target');

        // refresh tabs with horizontal scroll
        tab.find('.nav-tabs').getNiceScroll().resize();

        // refresh [data-scrollable] within the activated tab pane
        $(targetPane).find('[data-scrollable]').getNiceScroll().resize();
    });

}(jQuery));
},{"./_skin":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_skin.js"}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_tree.js":[function(require,module,exports){
(function ($) {

    var tree_glyph_options = {
        map: {
            checkbox: "fa fa-square-o",
            checkboxSelected: "fa fa-check-square",
            checkboxUnknown: "fa fa-check-square fa-muted",
            error: "fa fa-exclamation-triangle",
            expanderClosed: "fa fa-caret-right",
            expanderLazy: "fa fa-angle-right",
            expanderOpen: "fa fa-caret-down",
            doc: "fa fa-file-o",
            noExpander: "",
            docOpen: "fa fa-file",
            loading: "fa fa-refresh fa-spin",
            folder: "fa fa-folder",
            folderOpen: "fa fa-folder-open"
        }
    },
    tree_dnd_options = {
        autoExpandMS: 400,
            focusOnClick: true,
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            dragStart: function(node, data) {
            /** This function MUST be defined to enable dragging for the tree.
             *  Return false to cancel dragging of node.
             */
            return true;
        },
        dragEnter: function(node, data) {
            /** data.otherNode may be null for non-fancytree droppables.
             *  Return false to disallow dropping on node. In this case
             *  dragOver and dragLeave are not called.
             *  Return 'over', 'before, or 'after' to force a hitMode.
             *  Return ['before', 'after'] to restrict available hitModes.
             *  Any other return value will calc the hitMode from the cursor position.
             */
            // Prevent dropping a parent below another parent (only sort
            // nodes under the same parent)
            /*
            if(node.parent !== data.otherNode.parent){
                return false;
            }
            // Don't allow dropping *over* a node (would create a child)
            return ["before", "after"];
            */
            return true;
        },
        dragDrop: function(node, data) {
            /** This function MUST be defined to enable dropping of items on
             *  the tree.
             */
            data.otherNode.moveTo(node, data.hitMode);
        }
    };

    // using default options
    $('[data-toggle="tree"]').each(function () {
        var extensions = [ "glyph" ];
        if (typeof $(this).attr('data-tree-dnd') !== "undefined") {
            extensions.push( "dnd" );
        }
        $(this).fancytree({
            extensions: extensions,
            glyph: tree_glyph_options,
            dnd: tree_dnd_options,
            clickFolderMode: 3,
            checkbox: typeof $(this).attr('data-tree-checkbox') !== "undefined" || false,
            selectMode: typeof $(this).attr('data-tree-select') !== "undefined" ? parseInt($(this).attr('data-tree-select')) : 2
        });
    });

}(jQuery));
},{}],"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/main.js":[function(require,module,exports){
require('./_tabs');
require('./_tree');
require('./_show-hover');
},{"./_show-hover":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_show-hover.js","./_tabs":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_tabs.js","./_tree":"/persistent/var/www/html/themekit-3.5.0/dev/app/vendor/ui/js/_tree.js"}]},{},["./app/js/themes/social-2/main.js"])
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIm5vZGVfbW9kdWxlcy9icm93c2VyaWZ5L25vZGVfbW9kdWxlcy9icm93c2VyLXBhY2svX3ByZWx1ZGUuanMiLCJhcHAvanMvdGhlbWVzL3NvY2lhbC0yL21haW4uanMiLCJhcHAvanMvY29tbW9uL21haW4uanMiLCJhcHAvanMvY29tcG9uZW50cy9mb3Jtcy9fZGF0ZXBpY2tlci5qcyIsImFwcC9qcy9jb21wb25lbnRzL2Zvcm1zL19taW5pY29sb3JzLmpzIiwiYXBwL2pzL2NvbXBvbmVudHMvZm9ybXMvX3Byb2dyZXNzLWJhcnMuanMiLCJhcHAvanMvY29tcG9uZW50cy9mb3Jtcy9fc2VsZWN0cGlja2VyLmpzIiwiYXBwL2pzL2NvbXBvbmVudHMvZm9ybXMvX3NsaWRlci5qcyIsImFwcC9qcy9jb21wb25lbnRzL2Zvcm1zL21haW4uanMiLCJhcHAvanMvY29tcG9uZW50cy9tZXNzYWdlcy9fYnJlYWtwb2ludHMuanMiLCJhcHAvanMvY29tcG9uZW50cy9tZXNzYWdlcy9fbmljZXNjcm9sbC5qcyIsImFwcC9qcy9jb21wb25lbnRzL21lc3NhZ2VzL21haW4uanMiLCJhcHAvanMvY29tcG9uZW50cy9vdGhlci9fb2ZmY2FudmFzLmpzIiwiYXBwL2pzL2NvbXBvbmVudHMvb3RoZXIvX3JhdGluZ3MuanMiLCJhcHAvanMvY29tcG9uZW50cy9vdGhlci9fdG9vbHRpcC5qcyIsImFwcC9qcy9jb21wb25lbnRzL3RhYmxlcy9fY2hlY2stYWxsLmpzIiwiYXBwL2pzL2NvbXBvbmVudHMvdGFibGVzL19kYXRhdGFibGVzLmpzIiwiYXBwL2pzL2NvbXBvbmVudHMvdGFibGVzL21haW4uanMiLCJhcHAvanMvcGFnZXMvdXNlcnMuanMiLCJhcHAvdmVuZG9yL2NoYXQvanMvX2JyZWFrcG9pbnRzLmpzIiwiYXBwL3ZlbmRvci9jaGF0L2pzL19zZWFyY2guanMiLCJhcHAvdmVuZG9yL2NoYXQvanMvX3RvZ2dsZS5qcyIsImFwcC92ZW5kb3IvY2hhdC9qcy9fd2luZG93cy5qcyIsImFwcC92ZW5kb3IvY2hhdC9qcy9tYWluLmpzIiwiYXBwL3ZlbmRvci9sYXlvdXQvanMvX2FzeW5jLmpzIiwiYXBwL3ZlbmRvci9sYXlvdXQvanMvX2JyZWFrcG9pbnRzLmpzIiwiYXBwL3ZlbmRvci9sYXlvdXQvanMvX2dyaWRhbGljaW91cy5qcyIsImFwcC92ZW5kb3IvbGF5b3V0L2pzL19zY3JvbGxhYmxlLmpzIiwiYXBwL3ZlbmRvci9sYXlvdXQvanMvX3NraW4uanMiLCJhcHAvdmVuZG9yL2xheW91dC9qcy9fc2tpbnMuanMiLCJhcHAvdmVuZG9yL2xheW91dC9qcy9tYWluLmpzIiwiYXBwL3ZlbmRvci9uYXZiYXIvanMvX3N3aXRjaC5qcyIsImFwcC92ZW5kb3IvbmF2YmFyL2pzL21haW4uanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvX2JyZWFrcG9pbnRzLmpzIiwiYXBwL3ZlbmRvci9zaWRlYmFyL2pzL19jb2xsYXBzaWJsZS5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fZHJvcGRvd24uanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvX29wdGlvbnMuanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvX3NpZGViYXItbWVudS5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fc2lkZWJhci10b2dnbGUuanMiLCJhcHAvdmVuZG9yL3NpZGViYXIvanMvX3RyYW5zZm9ybV9jb2xsYXBzZS5qcyIsImFwcC92ZW5kb3Ivc2lkZWJhci9qcy9fdHJhbnNmb3JtX2Ryb3Bkb3duLmpzIiwiYXBwL3ZlbmRvci9zaWRlYmFyL2pzL21haW4uanMiLCJhcHAvdmVuZG9yL3NvY2lhbC9qcy9fdGltZWxpbmUuanMiLCJhcHAvdmVuZG9yL3NvY2lhbC9qcy9tYWluLmpzIiwiYXBwL3ZlbmRvci91aS9qcy9fc2hvdy1ob3Zlci5qcyIsImFwcC92ZW5kb3IvdWkvanMvX3RhYnMuanMiLCJhcHAvdmVuZG9yL3VpL2pzL190cmVlLmpzIiwiYXBwL3ZlbmRvci91aS9qcy9tYWluLmpzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0FDQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUN6QkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNKQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ1BBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3hCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ1BBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNYQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDakJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDSkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNiQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ2JBO0FBQ0E7O0FDREE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDVEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ2RBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDUEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDVEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ0xBO0FBQ0E7O0FDREE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQzFCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ2hCQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDOURBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNoQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNoRUE7QUFDQTtBQUNBO0FBQ0E7O0FDSEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDM0VBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDUEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNWQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNsQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNQQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNqQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDSEE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNKQTs7QUNBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNyQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNKQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDdkJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNMQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNyQkE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3ZIQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUM1REE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQ3JHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNmQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDZEE7O0FDQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7O0FDcEJBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDbENBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FDekVBO0FBQ0E7QUFDQSIsImZpbGUiOiJnZW5lcmF0ZWQuanMiLCJzb3VyY2VSb290IjoiIiwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uIGUodCxuLHIpe2Z1bmN0aW9uIHMobyx1KXtpZighbltvXSl7aWYoIXRbb10pe3ZhciBhPXR5cGVvZiByZXF1aXJlPT1cImZ1bmN0aW9uXCImJnJlcXVpcmU7aWYoIXUmJmEpcmV0dXJuIGEobywhMCk7aWYoaSlyZXR1cm4gaShvLCEwKTt2YXIgZj1uZXcgRXJyb3IoXCJDYW5ub3QgZmluZCBtb2R1bGUgJ1wiK28rXCInXCIpO3Rocm93IGYuY29kZT1cIk1PRFVMRV9OT1RfRk9VTkRcIixmfXZhciBsPW5bb109e2V4cG9ydHM6e319O3Rbb11bMF0uY2FsbChsLmV4cG9ydHMsZnVuY3Rpb24oZSl7dmFyIG49dFtvXVsxXVtlXTtyZXR1cm4gcyhuP246ZSl9LGwsbC5leHBvcnRzLGUsdCxuLHIpfXJldHVybiBuW29dLmV4cG9ydHN9dmFyIGk9dHlwZW9mIHJlcXVpcmU9PVwiZnVuY3Rpb25cIiYmcmVxdWlyZTtmb3IodmFyIG89MDtvPHIubGVuZ3RoO28rKylzKHJbb10pO3JldHVybiBzfSkiLCIvLyBDT01NT05cbnJlcXVpcmUoJy4uLy4uL2NvbW1vbi9tYWluJyk7XG5cbi8vIEVzc2VudGlhbHNcbnJlcXVpcmUoJy4uLy4uLy4uL3ZlbmRvci91aS9qcy9tYWluJyk7XG5cbi8vIExheW91dFxucmVxdWlyZSgnLi4vLi4vLi4vdmVuZG9yL2xheW91dC9qcy9tYWluJyk7XG5cbi8vIFNpZGViYXJcbnJlcXVpcmUoJy4uLy4uLy4uL3ZlbmRvci9zaWRlYmFyL2pzL21haW4nKTtcblxuLy8gTmF2YmFyXG5yZXF1aXJlKCcuLi8uLi8uLi92ZW5kb3IvbmF2YmFyL2pzL21haW4nKTtcblxuLy8gQ2hhdFxucmVxdWlyZSgnLi4vLi4vLi4vdmVuZG9yL2NoYXQvanMvbWFpbicpO1xuXG4vLyBTb2NpYWxcbnJlcXVpcmUoJy4uLy4uLy4uL3ZlbmRvci9zb2NpYWwvanMvbWFpbicpO1xuXG4vLyBNZXNzYWdlc1xucmVxdWlyZSgnLi4vLi4vY29tcG9uZW50cy9tZXNzYWdlcy9tYWluJyk7XG5cbi8vIENVU1RPTVxucmVxdWlyZSgnLi4vLi4vcGFnZXMvdXNlcnMnKTsiLCJyZXF1aXJlKCcuLi9jb21wb25lbnRzL2Zvcm1zL21haW4nKTtcbnJlcXVpcmUoJy4uL2NvbXBvbmVudHMvdGFibGVzL21haW4nKTtcbnJlcXVpcmUoJy4uL2NvbXBvbmVudHMvb3RoZXIvX3Rvb2x0aXAnKTtcbnJlcXVpcmUoJy4uL2NvbXBvbmVudHMvb3RoZXIvX29mZmNhbnZhcycpO1xucmVxdWlyZSgnLi4vY29tcG9uZW50cy9vdGhlci9fcmF0aW5ncycpOyIsIihmdW5jdGlvbiAoJCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgLy8gRGF0ZXBpY2tlciBJTklUXG4gICAgJCgnLmRhdGVwaWNrZXInKS5kYXRlcGlja2VyKCk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIC8vIE1pbmljb2xvcnMgSU5JVFxuICAgICQoJy5taW5pY29sb3JzJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICQodGhpcykubWluaWNvbG9ycyh7XG4gICAgICAgICAgICBjb250cm9sOiAkKHRoaXMpLmF0dHIoJ2RhdGEtY29udHJvbCcpIHx8ICdodWUnLFxuICAgICAgICAgICAgZGVmYXVsdFZhbHVlOiAkKHRoaXMpLmF0dHIoJ2RhdGEtZGVmYXVsdFZhbHVlJykgfHwgJycsXG4gICAgICAgICAgICBpbmxpbmU6ICQodGhpcykuYXR0cignZGF0YS1pbmxpbmUnKSA9PT0gJ3RydWUnLFxuICAgICAgICAgICAgbGV0dGVyQ2FzZTogJCh0aGlzKS5hdHRyKCdkYXRhLWxldHRlckNhc2UnKSB8fCAnbG93ZXJjYXNlJyxcbiAgICAgICAgICAgIG9wYWNpdHk6ICQodGhpcykuYXR0cignZGF0YS1vcGFjaXR5JyksXG4gICAgICAgICAgICBwb3NpdGlvbjogJCh0aGlzKS5hdHRyKCdkYXRhLXBvc2l0aW9uJykgfHwgJ2JvdHRvbSBsZWZ0JyxcbiAgICAgICAgICAgIGNoYW5nZTogZnVuY3Rpb24gKGhleCwgb3BhY2l0eSkge1xuICAgICAgICAgICAgICAgIGlmICghIGhleCkgcmV0dXJuO1xuICAgICAgICAgICAgICAgIGlmIChvcGFjaXR5KSBoZXggKz0gJywgJyArIG9wYWNpdHk7XG4gICAgICAgICAgICAgICAgaWYgKHR5cGVvZiBjb25zb2xlID09PSAnb2JqZWN0Jykge1xuICAgICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyhoZXgpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICB0aGVtZTogJ2Jvb3RzdHJhcCdcbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24gKCQpIHtcblxuICAgIC8vIFByb2dyZXNzIEJhciBBbmltYXRpb25cbiAgICAkKCcucHJvZ3Jlc3MtYmFyJykuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICQodGhpcykud2lkdGgoJCh0aGlzKS5hdHRyKCdhcmlhLXZhbHVlbm93JykgKyAnJScpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpOyIsIihmdW5jdGlvbiAoJCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuICAgICQoZnVuY3Rpb24gKCkge1xuICAgICAgICAkKCcuc2VsZWN0cGlja2VyJykuZWFjaChmdW5jdGlvbigpe1xuICAgICAgICAgICAgJCh0aGlzKS5zZWxlY3RwaWNrZXIoe1xuICAgICAgICAgICAgICAgIHdpZHRoOiAkKHRoaXMpLmRhdGEoJ3dpZHRoJykgfHwgJzEwMCUnXG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgICQoJ1tkYXRhLXNsaWRlcj1cImRlZmF1bHRcIl0nKS5zbGlkZXIoKTtcblxuICAgICQoJ1tkYXRhLXNsaWRlcj1cImZvcm1hdHRlclwiXScpLnNsaWRlcih7XG4gICAgICAgIGZvcm1hdHRlcjogZnVuY3Rpb24gKHZhbHVlKSB7XG4gICAgICAgICAgICByZXR1cm4gJ0N1cnJlbnQgdmFsdWU6ICcgKyB2YWx1ZTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG4gICAgJCgnW2RhdGEtb24tc2xpZGVdJykub24oXCJzbGlkZVwiLCBmdW5jdGlvbiAoc2xpZGVFdnQpIHtcbiAgICAgICAgJCgkKHRoaXMpLmF0dHIoJ2RhdGEtb24tc2xpZGUnKSkudGV4dChzbGlkZUV2dC52YWx1ZSk7XG4gICAgfSk7XG5cbiAgICAkKCcuc2xpZGVyLWhhbmRsZScpLmh0bWwoJzxpIGNsYXNzPVwiZmEgZmEtYmFycyBmYS1yb3RhdGUtOTBcIj48L2k+Jyk7XG5cbn0pKGpRdWVyeSk7IiwicmVxdWlyZSgnLi9fcHJvZ3Jlc3MtYmFycycpO1xucmVxdWlyZSgnLi9fc2xpZGVyJyk7XG5yZXF1aXJlKCcuL19zZWxlY3RwaWNrZXInKTtcbnJlcXVpcmUoJy4vX2RhdGVwaWNrZXInKTtcbnJlcXVpcmUoJy4vX21pbmljb2xvcnMnKTsiLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQzMjAnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciBpbWcgPSAkKCcubWVzc2FnZXMtbGlzdCAucGFuZWwgdWwgaW1nJyk7XG4gICAgICAgICQoJy5tZXNzYWdlcy1saXN0IC5wYW5lbCB1bCcpLndpZHRoKGltZy5maXJzdCgpLndpZHRoKCkgKiBpbWcubGVuZ3RoKTtcbiAgICB9KTtcblxuICAgICQod2luZG93KS5iaW5kKCdleGl0QnJlYWtwb2ludDMyMCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnLm1lc3NhZ2VzLWxpc3QgLnBhbmVsIHVsJykud2lkdGgoJ2F1dG8nKTtcbiAgICB9KTtcblxufSkoalF1ZXJ5KTtcbiIsIihmdW5jdGlvbiAoJCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgdmFyIG5pY2UgPSAkKCcubWVzc2FnZXMtbGlzdCAucGFuZWwnKS5uaWNlU2Nyb2xsKHtjdXJzb3Jib3JkZXI6IDAsIGN1cnNvcmNvbG9yOiBcIiMyNWFkOWZcIiwgemluZGV4OiAxfSk7XG5cbiAgICB2YXIgX3N1cGVyID0gbmljZS5nZXRDb250ZW50U2l6ZTtcblxuICAgIG5pY2UuZ2V0Q29udGVudFNpemUgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciBwYWdlID0gX3N1cGVyLmNhbGwobmljZSk7XG4gICAgICAgIHBhZ2UuaCA9IG5pY2Uud2luLmhlaWdodCgpO1xuICAgICAgICByZXR1cm4gcGFnZTtcbiAgICB9O1xuXG59KShqUXVlcnkpOyIsInJlcXVpcmUoJy4vX2JyZWFrcG9pbnRzJyk7XG5yZXF1aXJlKCcuL19uaWNlc2Nyb2xsJyk7IiwiKGZ1bmN0aW9uICgkKSB7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICAvLyBPZmZDYW52YXNcbiAgICAkKCdbZGF0YS10b2dnbGU9XCJvZmZjYW52YXNcIl0nKS5jbGljayhmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJy5yb3ctb2ZmY2FudmFzJykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuIiwiKGZ1bmN0aW9uICgkKSB7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICAvLyBSYXRpbmdzXG4gICAgJCgnLnJhdGluZyBzcGFuLnN0YXInKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIHZhciB0b3RhbCA9ICQodGhpcykucGFyZW50KCkuY2hpbGRyZW4oKS5sZW5ndGg7XG4gICAgICAgIHZhciBjbGlja2VkSW5kZXggPSAkKHRoaXMpLmluZGV4KCk7XG4gICAgICAgICQoJy5yYXRpbmcgc3Bhbi5zdGFyJykucmVtb3ZlQ2xhc3MoJ2ZpbGxlZCcpO1xuICAgICAgICBmb3IgKHZhciBpID0gY2xpY2tlZEluZGV4OyBpIDwgdG90YWw7IGkgKyspIHtcbiAgICAgICAgICAgICQoJy5yYXRpbmcgc3Bhbi5zdGFyJykuZXEoaSkuYWRkQ2xhc3MoJ2ZpbGxlZCcpO1xuICAgICAgICB9XG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIC8vIFRvb2x0aXBcbiAgICAkKFwiYm9keVwiKS50b29sdGlwKHtzZWxlY3RvcjogJ1tkYXRhLXRvZ2dsZT1cInRvb2x0aXBcIl0nLCBjb250YWluZXI6IFwiYm9keVwifSk7XG5cbn0pKGpRdWVyeSk7XG4iLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIC8vIFRhYmxlIENoZWNrYm94IEFsbFxuICAgICQoJyNjaGVja0FsbCcpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICQodGhpcykuY2xvc2VzdCgndGFibGUnKS5maW5kKCd0ZCBpbnB1dDpjaGVja2JveCcpLnByb3AoJ2NoZWNrZWQnLCB0aGlzLmNoZWNrZWQpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuIiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICAvLyBEYXRhdGFibGVzXG4gICAgJCgnI2RhdGEtdGFibGUnKS5kYXRhVGFibGUoKTtcblxufSkoalF1ZXJ5KTsiLCJyZXF1aXJlKCcuL19kYXRhdGFibGVzJyk7XG5yZXF1aXJlKCcuL19jaGVjay1hbGwnKTsiLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgICQoJyN1c2Vycy1maWx0ZXItc2VsZWN0Jykub24oJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKHRoaXMudmFsdWUgPT09ICduYW1lJykge1xuICAgICAgICAgICAgJCgnI3VzZXItZmlyc3QnKS5yZW1vdmVDbGFzcygnaGlkZGVuJyk7XG4gICAgICAgICAgICAkKCcjdXNlci1zZWFyY2gtbmFtZScpLnJlbW92ZUNsYXNzKCdoaWRkZW4nKTtcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICQoJyN1c2VyLWZpcnN0JykuYWRkQ2xhc3MoJ2hpZGRlbicpO1xuICAgICAgICAgICAgJCgnI3VzZXItc2VhcmNoLW5hbWUnKS5hZGRDbGFzcygnaGlkZGVuJyk7XG4gICAgICAgIH1cbiAgICAgICAgaWYgKHRoaXMudmFsdWUgPT09ICdmcmllbmRzJykge1xuICAgICAgICAgICAgJCgnLnNlbGVjdC1mcmllbmRzJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xuXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKCcuc2VsZWN0LWZyaWVuZHMnKS5hZGRDbGFzcygnaGlkZGVuJyk7XG4gICAgICAgIH1cbiAgICAgICAgaWYgKHRoaXMudmFsdWUgPT09ICduYW1lJykge1xuICAgICAgICAgICAgJCgnLnNlYXJjaC1uYW1lJykucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xuXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKCcuc2VhcmNoLW5hbWUnKS5hZGRDbGFzcygnaGlkZGVuJyk7XG4gICAgICAgIH1cbiAgICB9KTtcblxufSkoalF1ZXJ5KTtcbiIsIihmdW5jdGlvbiAoJCkge1xuICAgIFwidXNlIHN0cmljdFwiO1xuXG4gICAgJCh3aW5kb3cpLmJpbmQoJ2VudGVyQnJlYWtwb2ludDQ4MCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnLmNoYXQtd2luZG93LWNvbnRhaW5lciAucGFuZWw6bm90KDpsYXN0KScpLnJlbW92ZSgpO1xuICAgICAgICAkKCcuY2hhdC13aW5kb3ctY29udGFpbmVyIC5wYW5lbCcpLmF0dHIoJ2lkJywgJ2NoYXQtMDAwMScpO1xuICAgIH0pO1xuXG4gICAgJCh3aW5kb3cpLmJpbmQoJ2VudGVyQnJlYWtwb2ludDc2OCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKCQoJy5jaGF0LXdpbmRvdy1jb250YWluZXIgLnBhbmVsJykubGVuZ3RoID09IDMpIHtcbiAgICAgICAgICAgICQoJy5jaGF0LXdpbmRvdy1jb250YWluZXIgLnBhbmVsOmZpcnN0JykucmVtb3ZlKCk7XG4gICAgICAgICAgICAkKCcuY2hhdC13aW5kb3ctY29udGFpbmVyIC5wYW5lbDpmaXJzdCcpLmF0dHIoJ2lkJywgJ2NoYXQtMDAwMScpO1xuICAgICAgICAgICAgJCgnLmNoYXQtd2luZG93LWNvbnRhaW5lciAucGFuZWw6bGFzdCcpLmF0dHIoJ2lkJywgJ2NoYXQtMDAwMicpO1xuICAgICAgICB9XG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7IiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICAvLyBtYXRjaCBhbnl0aGluZ1xuICAgICQuZXhwclsgXCI6XCIgXS5jb250YWluc05vQ2FzZSA9IGZ1bmN0aW9uIChlbCwgaSwgbSkge1xuICAgICAgICB2YXIgc2VhcmNoID0gbVsgMyBdO1xuICAgICAgICBpZiAoISBzZWFyY2gpIHJldHVybiBmYWxzZTtcbiAgICAgICAgcmV0dXJuIG5ldyBSZWdFeHAoc2VhcmNoLCBcImlcIikudGVzdCgkKGVsKS50ZXh0KCkpO1xuICAgIH07XG5cbiAgICAvLyBTZWFyY2ggRmlsdGVyXG4gICAgZnVuY3Rpb24gc2VhcmNoRmlsdGVyQ2FsbEJhY2soJGRhdGEsICRvcHQpIHtcbiAgICAgICAgdmFyIHNlYXJjaCA9ICRkYXRhIGluc3RhbmNlb2YgalF1ZXJ5ID8gJGRhdGEudmFsKCkgOiAkKHRoaXMpLnZhbCgpLFxuICAgICAgICAgICAgb3B0ID0gdHlwZW9mICRvcHQgPT0gJ3VuZGVmaW5lZCcgPyAkZGF0YS5kYXRhLm9wdCA6ICRvcHQ7XG5cbiAgICAgICAgdmFyICR0YXJnZXQgPSAkKG9wdC50YXJnZXRTZWxlY3Rvcik7XG4gICAgICAgICR0YXJnZXQuc2hvdygpO1xuXG4gICAgICAgIGlmIChzZWFyY2ggJiYgc2VhcmNoLmxlbmd0aCA+PSBvcHQuY2hhckNvdW50KSB7XG4gICAgICAgICAgICAkdGFyZ2V0Lm5vdChcIjpjb250YWluc05vQ2FzZShcIiArIHNlYXJjaCArIFwiKVwiKS5oaWRlKCk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICAvLyBpbnB1dCBmaWx0ZXJcbiAgICAkLmZuLnNlYXJjaEZpbHRlciA9IGZ1bmN0aW9uIChvcHRpb25zKSB7XG4gICAgICAgIHZhciBvcHQgPSAkLmV4dGVuZCh7XG4gICAgICAgICAgICAvLyB0YXJnZXQgc2VsZWN0b3JcbiAgICAgICAgICAgIHRhcmdldFNlbGVjdG9yOiBcIlwiLFxuICAgICAgICAgICAgLy8gbnVtYmVyIG9mIGNoYXJhY3RlcnMgYmVmb3JlIHNlYXJjaCBpcyBhcHBsaWVkXG4gICAgICAgICAgICBjaGFyQ291bnQ6IDFcbiAgICAgICAgfSwgb3B0aW9ucyk7XG5cbiAgICAgICAgcmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgJGVsID0gJCh0aGlzKTtcbiAgICAgICAgICAgICRlbC5vZmYoXCJrZXl1cFwiLCBzZWFyY2hGaWx0ZXJDYWxsQmFjayk7XG4gICAgICAgICAgICAkZWwub24oXCJrZXl1cFwiLCBudWxsLCB7b3B0OiBvcHR9LCBzZWFyY2hGaWx0ZXJDYWxsQmFjayk7XG4gICAgICAgIH0pO1xuXG4gICAgfTtcblxuICAgIC8vIEZpbHRlciBieSBBbGwvT25saW5lL09mZmxpbmVcbiAgICAkKFwiLmNoYXQtZmlsdGVyIGFcIikub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcblxuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICQoJy5jaGF0LWNvbnRhY3RzIGxpJykuaGlkZSgpO1xuICAgICAgICAkKCcuY2hhdC1jb250YWN0cycpLmZpbmQoJCh0aGlzKS5kYXRhKCd0YXJnZXQnKSkuc2hvdygpO1xuXG4gICAgICAgICQoXCIuY2hhdC1maWx0ZXIgbGlcIikucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKCdhY3RpdmUnKTtcblxuICAgICAgICAkKFwiLmNoYXQtc2VhcmNoIGlucHV0XCIpLnNlYXJjaEZpbHRlcih7dGFyZ2V0U2VsZWN0b3I6IFwiLmNoYXQtY29udGFjdHMgXCIgKyAkKHRoaXMpLmRhdGEoJ3RhcmdldCcpfSk7XG5cbiAgICAgICAgLy8gRmlsdGVyIENvbnRhY3RzIGJ5IFNlYXJjaCBhbmQgVGFic1xuICAgICAgICBzZWFyY2hGaWx0ZXJDYWxsQmFjaygkKFwiLmNoYXQtc2VhcmNoIGlucHV0XCIpLCB7XG4gICAgICAgICAgICB0YXJnZXRTZWxlY3RvcjogXCIuY2hhdC1jb250YWN0cyBcIiArICQodGhpcykuZGF0YSgndGFyZ2V0JyksXG4gICAgICAgICAgICBjaGFyQ291bnQ6IDFcbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbiAgICAvLyBUcmlnZ2VyIFNlYXJjaCBGaWx0ZXJcbiAgICAkKFwiLmNoYXQtc2VhcmNoIGlucHV0XCIpLnNlYXJjaEZpbHRlcih7dGFyZ2V0U2VsZWN0b3I6IFwiLmNoYXQtY29udGFjdHMgbGlcIn0pO1xuXG59KShqUXVlcnkpO1xuIiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICAkKCdbZGF0YS10b2dnbGU9XCJjaGF0LWJveFwiXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJChcIi5jaGF0LWNvbnRhY3RzIGxpOmZpcnN0XCIpLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgIGlmICgkKHRoaXMpLmRhdGEoJ2hpZGUnKSkgJCh0aGlzKS5oaWRlKCk7XG4gICAgfSk7XG5cbiAgICBmdW5jdGlvbiBjaGVja0NoYXQoKSB7XG4gICAgICAgIGlmICghICQoJ2h0bWwnKS5oYXNDbGFzcygnc2hvdy1jaGF0JykpIHtcbiAgICAgICAgICAgICQoJy5jaGF0LXdpbmRvdy1jb250YWluZXIgLnBhbmVsLWJvZHknKS5hZGRDbGFzcygnZGlzcGxheS1ub25lJyk7XG4gICAgICAgICAgICAkKCcuY2hhdC13aW5kb3ctY29udGFpbmVyIGlucHV0JykuYWRkQ2xhc3MoJ2Rpc3BsYXktbm9uZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgJCgnLmNoYXQtd2luZG93LWNvbnRhaW5lciAucGFuZWwtYm9keScpLnJlbW92ZUNsYXNzKCdkaXNwbGF5LW5vbmUnKTtcbiAgICAgICAgICAgICQoJy5jaGF0LXdpbmRvdy1jb250YWluZXIgaW5wdXQnKS5yZW1vdmVDbGFzcygnZGlzcGxheS1ub25lJyk7XG4gICAgICAgIH1cbiAgICB9XG5cbiAgICAoZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgdG9nZ2xlQnRuID0gJCgnW2RhdGEtdG9nZ2xlPVwic2lkZWJhci1jaGF0XCJdJyk7XG5cbiAgICAgICAgLy8gSWYgTm8gU2lkZWJhciBFeGl0XG4gICAgICAgIGlmICghIHRvZ2dsZUJ0bi5sZW5ndGgpIHJldHVybjtcblxuICAgICAgICB0b2dnbGVCdG4ub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXG4gICAgICAgICAgICAkKCdodG1sJykudG9nZ2xlQ2xhc3MoJ3Nob3ctY2hhdCcpO1xuXG4gICAgICAgICAgICBjaGVja0NoYXQoKTtcbiAgICAgICAgfSk7XG4gICAgfSkoKTtcblxuICAgIGNoZWNrQ2hhdCgpO1xufSkoalF1ZXJ5KTsiLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgIHZhciBjb250YWluZXIgPSAkKCcuY2hhdC13aW5kb3ctY29udGFpbmVyJyk7XG5cbiAgICAvLyBDbGljayBVc2VyXG4gICAgJChcIi5jaGF0LWNvbnRhY3RzIGxpXCIpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcblxuICAgICAgICBpZiAoJCgnLmNoYXQtd2luZG93LWNvbnRhaW5lciBbZGF0YS11c2VyLWlkPVwiJyArICQodGhpcykuZGF0YSgndXNlcklkJykgKyAnXCJdJykubGVuZ3RoKSByZXR1cm47XG5cbiAgICAgICAgLy8gSWYgdXNlciBpcyBvZmZsaW5lIGRvIG5vdGhpbmdcbiAgICAgICAgaWYgKCQodGhpcykuYXR0cignY2xhc3MnKSA9PT0gJ29mZmxpbmUnKSByZXR1cm47XG5cbiAgICAgICAgdmFyIHNvdXJjZSA9ICQoXCIjY2hhdC13aW5kb3ctdGVtcGxhdGVcIikuaHRtbCgpO1xuICAgICAgICB2YXIgdGVtcGxhdGUgPSBIYW5kbGViYXJzLmNvbXBpbGUoc291cmNlKTtcblxuICAgICAgICB2YXIgY29udGV4dCA9IHt1c2VyX2ltYWdlOiAkKHRoaXMpLmZpbmQoJ2ltZycpLmF0dHIoJ3NyYycpLCB1c2VyOiAkKHRoaXMpLmZpbmQoJy5jb250YWN0LW5hbWUnKS50ZXh0KCl9O1xuICAgICAgICB2YXIgaHRtbCA9IHRlbXBsYXRlKGNvbnRleHQpO1xuXG4gICAgICAgIHZhciBjbG9uZSA9ICQoaHRtbCk7XG5cbiAgICAgICAgY2xvbmUuYXR0cihcImRhdGEtdXNlci1pZFwiLCAkKHRoaXMpLmRhdGEoXCJ1c2VySWRcIikpO1xuXG4gICAgICAgIGNvbnRhaW5lci5maW5kKCcucGFuZWw6bm90KFtpZF49XCJjaGF0XCJdKScpLnJlbW92ZSgpO1xuXG4gICAgICAgIHZhciBjb3VudCA9IGNvbnRhaW5lci5maW5kKCcucGFuZWwnKS5sZW5ndGg7XG5cbiAgICAgICAgY291bnQgKys7XG4gICAgICAgIHZhciBsaW1pdCA9ICQod2luZG93KS53aWR0aCgpID4gNzY4ID8gMyA6IDE7XG4gICAgICAgIGlmIChjb3VudCA+PSBsaW1pdCkge1xuICAgICAgICAgICAgY29udGFpbmVyLmZpbmQoJyNjaGF0LTAwMCcrIGxpbWl0KS5yZW1vdmUoKTtcbiAgICAgICAgICAgIGNvdW50ID0gbGltaXQ7XG4gICAgICAgIH1cblxuICAgICAgICBjbG9uZS5hdHRyKCdpZCcsICdjaGF0LTAwMCcgKyBwYXJzZUludChjb3VudCkpO1xuICAgICAgICBjb250YWluZXIuYXBwZW5kKGNsb25lKS5zaG93KCk7XG5cbiAgICAgICAgY2xvbmUuc2hvdygpO1xuICAgICAgICBjbG9uZS5maW5kKCc+IC5wYW5lbC1ib2R5JykucmVtb3ZlQ2xhc3MoJ2Rpc3BsYXktbm9uZScpO1xuICAgICAgICBjbG9uZS5maW5kKCc+IGlucHV0JykucmVtb3ZlQ2xhc3MoJ2Rpc3BsYXktbm9uZScpO1xuICAgIH0pO1xuXG4gICAgLy8gQ2hhbmdlIElEIGJ5IE5vLiBvZiBXaW5kb3dzXG4gICAgZnVuY3Rpb24gY2hhdExheW91dCgpIHtcbiAgICAgICAgY29udGFpbmVyLmZpbmQoJy5wYW5lbCcpLmVhY2goZnVuY3Rpb24gKGluZGV4LCB2YWx1ZSkge1xuICAgICAgICAgICAgJCh0aGlzKS5hdHRyKCdpZCcsICdjaGF0LTAwMCcgKyBwYXJzZUludChpbmRleCArIDEpKTtcbiAgICAgICAgfSk7XG4gICAgfVxuXG4gICAgLy8gcmVtb3ZlIHdpbmRvd1xuICAgICQoXCJib2R5XCIpLm9uKCdjbGljaycsIFwiLmNoYXQtd2luZG93LWNvbnRhaW5lciAuY2xvc2VcIiwgZnVuY3Rpb24gKCkge1xuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnBhcmVudCgpLnJlbW92ZSgpO1xuICAgICAgICBjaGF0TGF5b3V0KCk7XG4gICAgICAgIGlmICgkKHdpbmRvdykud2lkdGgoKSA8IDc2OCkgJCgnLmNoYXQtd2luZG93LWNvbnRhaW5lcicpLmhpZGUoKTtcbiAgICB9KTtcblxuICAgIC8vIENoYXQgaGVhZGluZyBjb2xsYXBzZSB3aW5kb3dcbiAgICAkKCdib2R5Jykub24oJ2NsaWNrJywgJy5jaGF0LXdpbmRvdy1jb250YWluZXIgLnBhbmVsLWhlYWRpbmcnLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICQodGhpcykucGFyZW50KCkuZmluZCgnPiAucGFuZWwtYm9keScpLnRvZ2dsZUNsYXNzKCdkaXNwbGF5LW5vbmUnKTtcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5maW5kKCc+IGlucHV0JykudG9nZ2xlQ2xhc3MoJ2Rpc3BsYXktbm9uZScpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuIiwicmVxdWlyZSgnLi9fYnJlYWtwb2ludHMnKTtcbnJlcXVpcmUoJy4vX3NlYXJjaCcpO1xucmVxdWlyZSgnLi9fd2luZG93cycpO1xucmVxdWlyZSgnLi9fdG9nZ2xlJyk7IiwiZnVuY3Rpb24gY29udGVudExvYWRlZCh3aW4sIGZuKSB7XG5cbiAgICB2YXIgZG9uZSA9IGZhbHNlLCB0b3AgPSB0cnVlLFxuXG4gICAgICAgIGRvYyA9IHdpbi5kb2N1bWVudCxcbiAgICAgICAgcm9vdCA9IGRvYy5kb2N1bWVudEVsZW1lbnQsXG4gICAgICAgIG1vZGVybiA9IGRvYy5hZGRFdmVudExpc3RlbmVyLFxuXG4gICAgICAgIGFkZCA9IG1vZGVybiA/ICdhZGRFdmVudExpc3RlbmVyJyA6ICdhdHRhY2hFdmVudCcsXG4gICAgICAgIHJlbSA9IG1vZGVybiA/ICdyZW1vdmVFdmVudExpc3RlbmVyJyA6ICdkZXRhY2hFdmVudCcsXG4gICAgICAgIHByZSA9IG1vZGVybiA/ICcnIDogJ29uJyxcblxuICAgICAgICBpbml0ID0gZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIGlmIChlLnR5cGUgPT0gJ3JlYWR5c3RhdGVjaGFuZ2UnICYmIGRvYy5yZWFkeVN0YXRlICE9ICdjb21wbGV0ZScpIHJldHVybjtcbiAgICAgICAgICAgIChlLnR5cGUgPT0gJ2xvYWQnID8gd2luIDogZG9jKVsgcmVtIF0ocHJlICsgZS50eXBlLCBpbml0LCBmYWxzZSk7XG4gICAgICAgICAgICBpZiAoISBkb25lICYmIChkb25lID0gdHJ1ZSkpIGZuLmNhbGwod2luLCBlLnR5cGUgfHwgZSk7XG4gICAgICAgIH0sXG5cbiAgICAgICAgcG9sbCA9IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIHRyeSB7XG4gICAgICAgICAgICAgICAgcm9vdC5kb1Njcm9sbCgnbGVmdCcpO1xuICAgICAgICAgICAgfSBjYXRjaCAoZSkge1xuICAgICAgICAgICAgICAgIHNldFRpbWVvdXQocG9sbCwgNTApO1xuICAgICAgICAgICAgICAgIHJldHVybjtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGluaXQoJ3BvbGwnKTtcbiAgICAgICAgfTtcblxuICAgIGlmIChkb2MucmVhZHlTdGF0ZSA9PSAnY29tcGxldGUnKSBmbi5jYWxsKHdpbiwgJ2xhenknKTtcbiAgICBlbHNlIHtcbiAgICAgICAgaWYgKCEgbW9kZXJuICYmIHJvb3QuZG9TY3JvbGwpIHtcbiAgICAgICAgICAgIHRyeSB7XG4gICAgICAgICAgICAgICAgdG9wID0gISB3aW4uZnJhbWVFbGVtZW50O1xuICAgICAgICAgICAgfSBjYXRjaCAoZSkge1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKHRvcCkgcG9sbCgpO1xuICAgICAgICB9XG4gICAgICAgIGRvY1sgYWRkIF0ocHJlICsgJ0RPTUNvbnRlbnRMb2FkZWQnLCBpbml0LCBmYWxzZSk7XG4gICAgICAgIGRvY1sgYWRkIF0ocHJlICsgJ3JlYWR5c3RhdGVjaGFuZ2UnLCBpbml0LCBmYWxzZSk7XG4gICAgICAgIHdpblsgYWRkIF0ocHJlICsgJ2xvYWQnLCBpbml0LCBmYWxzZSk7XG4gICAgfVxufVxuXG5tb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uKHVybHMsIGNhbGxiYWNrKSB7XG5cbiAgICB2YXIgYXN5bmNMb2FkZXIgPSBmdW5jdGlvbiAodXJscywgY2FsbGJhY2spIHtcblxuICAgICAgICB1cmxzLmZvcmVhY2goZnVuY3Rpb24gKGksIGZpbGUpIHtcbiAgICAgICAgICAgIGxvYWRDc3MoZmlsZSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIC8vIGNoZWNraW5nIGZvciBhIGNhbGxiYWNrIGZ1bmN0aW9uXG4gICAgICAgIGlmICh0eXBlb2YgY2FsbGJhY2sgPT0gJ2Z1bmN0aW9uJykge1xuICAgICAgICAgICAgLy8gY2FsbGluZyB0aGUgY2FsbGJhY2tcbiAgICAgICAgICAgIGNvbnRlbnRMb2FkZWQod2luZG93LCBjYWxsYmFjayk7XG4gICAgICAgIH1cbiAgICB9O1xuXG4gICAgdmFyIGxvYWRDc3MgPSBmdW5jdGlvbiAodXJsKSB7XG4gICAgICAgIHZhciBsaW5rID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnbGluaycpO1xuICAgICAgICBsaW5rLnR5cGUgPSAndGV4dC9jc3MnO1xuICAgICAgICBsaW5rLnJlbCA9ICdzdHlsZXNoZWV0JztcbiAgICAgICAgbGluay5ocmVmID0gdXJsO1xuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgnaGVhZCcpWyAwIF0uYXBwZW5kQ2hpbGQobGluayk7XG4gICAgfTtcblxuICAgIC8vIHNpbXBsZSBmb3JlYWNoIGltcGxlbWVudGF0aW9uXG4gICAgQXJyYXkucHJvdG90eXBlLmZvcmVhY2ggPSBmdW5jdGlvbiAoY2FsbGJhY2spIHtcbiAgICAgICAgZm9yICh2YXIgaSA9IDA7IGkgPCB0aGlzLmxlbmd0aDsgaSArKykge1xuICAgICAgICAgICAgY2FsbGJhY2soaSwgdGhpc1sgaSBdKTtcbiAgICAgICAgfVxuICAgIH07XG5cbiAgICBhc3luY0xvYWRlcih1cmxzLCBjYWxsYmFjayk7XG5cbn07IiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICAkKHdpbmRvdykuc2V0QnJlYWtwb2ludHMoe1xuICAgICAgICBkaXN0aW5jdDogdHJ1ZSxcbiAgICAgICAgYnJlYWtwb2ludHM6IFsgMzIwLCA0ODAsIDc2OCwgMTAyNCBdXG4gICAgfSk7XG5cbn0pKGpRdWVyeSk7IiwiKGZ1bmN0aW9uKCQpe1xuXG4gICAgJCgnW2RhdGEtdG9nZ2xlKj1cImdyaWRhbGljaW91c1wiXScpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAkKHRoaXMpLmdyaWRhbGljaW91cyh7XG4gICAgICAgICAgICBndXR0ZXI6ICQodGhpcykuZGF0YSgnZ3V0dGVyJykgfHwgMTUsXG4gICAgICAgICAgICB3aWR0aDogJCh0aGlzKS5kYXRhKCd3aWR0aCcpIHx8IDM3MCxcbiAgICAgICAgICAgIHNlbGVjdG9yOiAnPiBkaXYnXG4gICAgICAgIH0pO1xuICAgIH0pO1xuXG59KShqUXVlcnkpOyIsIihmdW5jdGlvbiAoJCkge1xuXG4gICAgdmFyIHNraW4gPSByZXF1aXJlKCcuL19za2luJykoKTtcblxuICAgICQoJ1tkYXRhLXNjcm9sbGFibGVdJykubmljZVNjcm9sbCh7XG4gICAgICAgIGN1cnNvcmJvcmRlcjogMCxcbiAgICAgICAgY3Vyc29yY29sb3I6IGNvbmZpZy5za2luc1sgc2tpbiBdWyAncHJpbWFyeS1jb2xvcicgXSxcbiAgICAgICAgaG9yaXpyYWlsZW5hYmxlZDogZmFsc2VcbiAgICB9KTtcblxuICAgICQoJy5zdC1jb250ZW50LWlubmVyJykubmljZVNjcm9sbCh7XG4gICAgICAgIGN1cnNvcmJvcmRlcjogMCxcbiAgICAgICAgY3Vyc29yY29sb3I6IGNvbmZpZy5za2luc1sgc2tpbiBdWyAncHJpbWFyeS1jb2xvcicgXSxcbiAgICAgICAgaG9yaXpyYWlsZW5hYmxlZDogZmFsc2VcbiAgICB9KTtcblxuICAgICQoJ1tkYXRhLXNjcm9sbGFibGVdJykuZ2V0TmljZVNjcm9sbCgpLnJlc2l6ZSgpO1xuXG59KGpRdWVyeSkpOyIsIm1vZHVsZS5leHBvcnRzID0gKGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgc2tpbiA9ICQuY29va2llKCdza2luJyk7XG5cbiAgICBpZiAodHlwZW9mIHNraW4gPT0gJ3VuZGVmaW5lZCcpIHtcbiAgICAgICAgc2tpbiA9ICdkZWZhdWx0JztcbiAgICB9XG4gICAgcmV0dXJuIHNraW47XG59KTsiLCJ2YXIgYXN5bmNMb2FkZXIgPSByZXF1aXJlKCcuL19hc3luYycpO1xuXG4oZnVuY3Rpb24gKCQpIHtcblxuICAgIHZhciBjaGFuZ2VTa2luID0gZnVuY3Rpb24gKCkge1xuICAgICAgICB2YXIgc2tpbiA9ICQuY29va2llKFwic2tpblwiKTtcbiAgICAgICAgaWYgKHR5cGVvZiBza2luICE9ICd1bmRlZmluZWQnKSB7XG4gICAgICAgICAgICBhc3luY0xvYWRlcihbICdjc3MvJyArIHNraW4gKyAnLm1pbi5jc3MnIF0sIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICAgICAkKCdbZGF0YS1za2luXScpLnJlbW92ZVByb3AoJ2Rpc2FibGVkJykucGFyZW50KCkucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcnKTtcbiAgICAgICAgICAgIH0pO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgICQoJ1tkYXRhLXNraW5dJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuXG4gICAgICAgIGlmICgkKHRoaXMpLnByb3AoJ2Rpc2FibGVkJykpIHJldHVybjtcblxuICAgICAgICAkKCdbZGF0YS1za2luXScpLnByb3AoJ2Rpc2FibGVkJywgdHJ1ZSk7XG5cbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS5hZGRDbGFzcygnbG9hZGluZycpO1xuXG4gICAgICAgICQuY29va2llKFwic2tpblwiLCAkKHRoaXMpLmRhdGEoJ3NraW4nKSk7XG5cbiAgICAgICAgY2hhbmdlU2tpbigpO1xuXG4gICAgfSk7XG5cbiAgICB2YXIgc2tpbiA9ICQuY29va2llKFwic2tpblwiKTtcblxuICAgIGlmICh0eXBlb2Ygc2tpbiAhPSAndW5kZWZpbmVkJyAmJiBza2luICE9ICdkZWZhdWx0Jykge1xuICAgICAgICBjaGFuZ2VTa2luKCk7XG4gICAgfVxuXG59KShqUXVlcnkpOyIsInJlcXVpcmUoJy4vX2JyZWFrcG9pbnRzLmpzJyk7XG5yZXF1aXJlKCcuL19ncmlkYWxpY2lvdXMuanMnKTtcbnJlcXVpcmUoJy4vX3Njcm9sbGFibGUuanMnKTtcbnJlcXVpcmUoJy4vX3NraW5zJyk7IiwiKGZ1bmN0aW9uICgkKSB7XG4gICAgJChcIltuYW1lPSdzd2l0Y2gtY2hlY2tib3gnXVwiKS5ib290c3RyYXBTd2l0Y2goe1xuICAgICAgICBvZmZDb2xvcjogJ2RhbmdlcidcbiAgICB9KTtcbn0pKGpRdWVyeSk7IiwicmVxdWlyZSgnLi9fc3dpdGNoJyk7IiwiKGZ1bmN0aW9uICgkKSB7XG4gICAgXCJ1c2Ugc3RyaWN0XCI7XG5cbiAgICAkKHdpbmRvdykuYmluZCgnZW50ZXJCcmVha3BvaW50NzY4JywgZnVuY3Rpb24gKCkge1xuICAgICAgICBpZiAoISAkKCcuc2lkZWJhcicpLmxlbmd0aCkgcmV0dXJuO1xuICAgICAgICBpZiAoJCgnLmhpZGUtc2lkZWJhcicpLmxlbmd0aCkgcmV0dXJuO1xuICAgICAgICAkKFwiaHRtbFwiKS5hZGRDbGFzcygnc2hvdy1zaWRlYmFyJyk7XG4gICAgfSk7XG5cbiAgICAkKHdpbmRvdykuYmluZCgnZW50ZXJCcmVha3BvaW50MTAyNCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKCEgJCgnLnNpZGViYXInKS5sZW5ndGgpIHJldHVybjtcbiAgICAgICAgaWYgKCQoJy5oaWRlLXNpZGViYXInKS5sZW5ndGgpIHJldHVybjtcbiAgICAgICAgJChcImh0bWxcIikuYWRkQ2xhc3MoJ3Nob3ctc2lkZWJhcicpO1xuICAgIH0pO1xuXG4gICAgJCh3aW5kb3cpLmJpbmQoJ2VudGVyQnJlYWtwb2ludDQ4MCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKCEgJCgnLnNpZGViYXInKS5sZW5ndGgpIHJldHVybjtcbiAgICAgICAgJChcImh0bWxcIikucmVtb3ZlQ2xhc3MoJ3Nob3ctc2lkZWJhcicpO1xuICAgIH0pO1xuXG59KShqUXVlcnkpO1xuIiwiKGZ1bmN0aW9uKCQpe1xuXG4gICAgcmVxdWlyZSgnLi9fdHJhbnNmb3JtX2NvbGxhcHNlJykoKTtcblxufSkoalF1ZXJ5KTsiLCIoZnVuY3Rpb24gKCQpIHtcblxuICAgIHZhciB0cmFuc2Zvcm1fZGQgPSByZXF1aXJlKCcuL190cmFuc2Zvcm1fZHJvcGRvd24nKSxcbiAgICAgICAgdHJhbnNmb3JtX2NvbGxhcHNlID0gcmVxdWlyZSgnLi9fdHJhbnNmb3JtX2NvbGxhcHNlJyk7XG5cbiAgICB0cmFuc2Zvcm1fZGQoKTtcblxuICAgICQod2luZG93KS5iaW5kKCdlbnRlckJyZWFrcG9pbnQ0ODAnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICghICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJykubGVuZ3RoKSByZXR1cm47XG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJykuYXR0cignZGF0YS10eXBlJywgJ2NvbGxhcHNlJykuYXR0cignZGF0YS10cmFuc2Zvcm1lZCcsIHRydWUpO1xuICAgICAgICB0cmFuc2Zvcm1fY29sbGFwc2UoKTtcbiAgICB9KTtcblxuICAgIGZ1bmN0aW9uIG1ha2VfZGQoKSB7XG4gICAgICAgIGlmICghICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImNvbGxhcHNlXCJdW2RhdGEtdHJhbnNmb3JtZWRdJykubGVuZ3RoKSByZXR1cm47XG4gICAgICAgICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImNvbGxhcHNlXCJdW2RhdGEtdHJhbnNmb3JtZWRdJykuYXR0cignZGF0YS10eXBlJywgJ2Ryb3Bkb3duJykuYXR0cignZGF0YS10cmFuc2Zvcm1lZCcsIHRydWUpO1xuICAgICAgICB0cmFuc2Zvcm1fZGQoKTtcbiAgICB9XG5cbiAgICAkKHdpbmRvdykuYmluZCgnZW50ZXJCcmVha3BvaW50NzY4JywgbWFrZV9kZCk7XG5cbiAgICAkKHdpbmRvdykuYmluZCgnZW50ZXJCcmVha3BvaW50MTAyNCcsIG1ha2VfZGQpO1xuXG59KShqUXVlcnkpOyIsIm1vZHVsZS5leHBvcnRzID0gZnVuY3Rpb24gKHNpZGViYXIpIHtcbiAgICByZXR1cm4ge1xuICAgICAgICBcInRyYW5zZm9ybS1idXR0b25cIjogc2lkZWJhci5kYXRhKCd0cmFuc2Zvcm1CdXR0b24nKSA9PT0gdHJ1ZSxcbiAgICAgICAgXCJ0cmFuc2Zvcm0tYnV0dG9uLWljb25cIjogc2lkZWJhci5kYXRhKCd0cmFuc2Zvcm1CdXR0b25JY29uJykgfHwgJ2ZhLWVsbGlwc2lzLWgnXG4gICAgfTtcbn07IiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICB2YXIgc2lkZWJhcnMgPSAkKCcuc2lkZWJhcicpO1xuXG4gICAgc2lkZWJhcnMuZWFjaChmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgdmFyIHNpZGViYXIgPSAkKHRoaXMpO1xuICAgICAgICB2YXIgb3B0aW9ucyA9IHJlcXVpcmUoJy4vX29wdGlvbnMnKShzaWRlYmFyKTtcblxuICAgICAgICBpZiAob3B0aW9uc1sgJ3RyYW5zZm9ybS1idXR0b24nIF0pIHtcbiAgICAgICAgICAgIHZhciBidXR0b24gPSAkKCc8YnV0dG9uIHR5cGU9XCJidXR0b25cIj48L2J1dHRvbj4nKTtcblxuICAgICAgICAgICAgYnV0dG9uXG4gICAgICAgICAgICAgICAgLmF0dHIoJ2RhdGEtdG9nZ2xlJywgJ3NpZGViYXItdHJhbnNmb3JtJylcbiAgICAgICAgICAgICAgICAuYWRkQ2xhc3MoJ2J0biBidG4tZGVmYXVsdCcpXG4gICAgICAgICAgICAgICAgLmh0bWwoJzxpIGNsYXNzPVwiZmEgJyArIG9wdGlvbnNbICd0cmFuc2Zvcm0tYnV0dG9uLWljb24nIF0gKyAnXCI+PC9pPicpO1xuXG4gICAgICAgICAgICBzaWRlYmFyLmZpbmQoJy5zaWRlYmFyLW1lbnUnKS5hcHBlbmQoYnV0dG9uKTtcbiAgICAgICAgfVxuICAgIH0pO1xuXG59KGpRdWVyeSkpOyIsIihmdW5jdGlvbiAoJCkge1xuICAgIC8qanNoaW50IGJyb3dzZXI6IHRydWUsIHN0cmljdDogZmFsc2UgKi9cblxuICAgICQoJyNzdWJuYXYnKS5jb2xsYXBzZSh7J3RvZ2dsZSc6IGZhbHNlfSk7XG5cbiAgICAkKCdbZGF0YS10b2dnbGU9XCJzaWRlYmFyLXRyYW5zZm9ybVwiXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJCgnYm9keScpLnRvZ2dsZUNsYXNzKCdzaWRlYmFyLW1pbmknKTtcbiAgICAgICAgaWYgKCQoJ2JvZHknKS5pcygnLnNpZGViYXItbWluaScpKSAkKCcuc2lkZWJhci1tZW51IC5jb2xsYXBzZScpLmNvbGxhcHNlKCdoaWRlJyk7XG4gICAgICAgICQoJyNkcm9wZG93bi10ZW1wJykuaGlkZSgpO1xuICAgICAgICAkKCcuc2lkZWJhci1tZW51IC5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICB9KTtcblxufSkoalF1ZXJ5KTtcblxuKGZ1bmN0aW9uICgkKSB7XG5cbiAgICBmdW5jdGlvbiBtb2JpbGVjaGVjaygpIHtcbiAgICAgICAgdmFyIGNoZWNrID0gZmFsc2U7XG4gICAgICAgIChmdW5jdGlvbiAoYSkge1xuICAgICAgICAgICAgaWYgKC8oYW5kcm9pZHxpcGFkfHBsYXlib29rfHNpbGt8YmJcXGQrfG1lZWdvKS4rbW9iaWxlfGF2YW50Z298YmFkYVxcL3xibGFja2JlcnJ5fGJsYXplcnxjb21wYWx8ZWxhaW5lfGZlbm5lY3xoaXB0b3B8aWVtb2JpbGV8aXAoaG9uZXxvZCl8aXJpc3xraW5kbGV8bGdlIHxtYWVtb3xtaWRwfG1tcHxuZXRmcm9udHxvcGVyYSBtKG9ifGluKWl8cGFsbSggb3MpP3xwaG9uZXxwKGl4aXxyZSlcXC98cGx1Y2tlcnxwb2NrZXR8cHNwfHNlcmllcyg0fDYpMHxzeW1iaWFufHRyZW98dXBcXC4oYnJvd3NlcnxsaW5rKXx2b2RhZm9uZXx3YXB8d2luZG93cyAoY2V8cGhvbmUpfHhkYXx4aWluby9pLnRlc3QoYSkgfHwgLzEyMDd8NjMxMHw2NTkwfDNnc298NHRocHw1MFsxLTZdaXw3NzBzfDgwMnN8YSB3YXxhYmFjfGFjKGVyfG9vfHNcXC0pfGFpKGtvfHJuKXxhbChhdnxjYXxjbyl8YW1vaXxhbihleHxueXx5dyl8YXB0dXxhcihjaHxnbyl8YXModGV8dXMpfGF0dHd8YXUoZGl8XFwtbXxyIHxzICl8YXZhbnxiZShja3xsbHxucSl8YmkobGJ8cmQpfGJsKGFjfGF6KXxicihlfHYpd3xidW1ifGJ3XFwtKG58dSl8YzU1XFwvfGNhcGl8Y2N3YXxjZG1cXC18Y2VsbHxjaHRtfGNsZGN8Y21kXFwtfGNvKG1wfG5kKXxjcmF3fGRhKGl0fGxsfG5nKXxkYnRlfGRjXFwtc3xkZXZpfGRpY2F8ZG1vYnxkbyhjfHApb3xkcygxMnxcXC1kKXxlbCg0OXxhaSl8ZW0obDJ8dWwpfGVyKGljfGswKXxlc2w4fGV6KFs0LTddMHxvc3x3YXx6ZSl8ZmV0Y3xmbHkoXFwtfF8pfGcxIHV8ZzU2MHxnZW5lfGdmXFwtNXxnXFwtbW98Z28oXFwud3xvZCl8Z3IoYWR8dW4pfGhhaWV8aGNpdHxoZFxcLShtfHB8dCl8aGVpXFwtfGhpKHB0fHRhKXxocCggaXxpcCl8aHNcXC1jfGh0KGMoXFwtfCB8X3xhfGd8cHxzfHQpfHRwKXxodShhd3x0Yyl8aVxcLSgyMHxnb3xtYSl8aTIzMHxpYWMoIHxcXC18XFwvKXxpYnJvfGlkZWF8aWcwMXxpa29tfGltMWt8aW5ub3xpcGFxfGlyaXN8amEodHx2KWF8amJyb3xqZW11fGppZ3N8a2RkaXxrZWppfGtndCggfFxcLyl8a2xvbnxrcHQgfGt3Y1xcLXxreW8oY3xrKXxsZShub3x4aSl8bGcoIGd8XFwvKGt8bHx1KXw1MHw1NHxcXC1bYS13XSl8bGlid3xseW54fG0xXFwtd3xtM2dhfG01MFxcL3xtYSh0ZXx1aXx4byl8bWMoMDF8MjF8Y2EpfG1cXC1jcnxtZShyY3xyaSl8bWkobzh8b2F8dHMpfG1tZWZ8bW8oMDF8MDJ8Yml8ZGV8ZG98dChcXC18IHxvfHYpfHp6KXxtdCg1MHxwMXx2ICl8bXdicHxteXdhfG4xMFswLTJdfG4yMFsyLTNdfG4zMCgwfDIpfG41MCgwfDJ8NSl8bjcoMCgwfDEpfDEwKXxuZSgoY3xtKVxcLXxvbnx0Znx3Znx3Z3x3dCl8bm9rKDZ8aSl8bnpwaHxvMmltfG9wKHRpfHd2KXxvcmFufG93ZzF8cDgwMHxwYW4oYXxkfHQpfHBkeGd8cGcoMTN8XFwtKFsxLThdfGMpKXxwaGlsfHBpcmV8cGwoYXl8dWMpfHBuXFwtMnxwbyhja3xydHxzZSl8cHJveHxwc2lvfHB0XFwtZ3xxYVxcLWF8cWMoMDd8MTJ8MjF8MzJ8NjB8XFwtWzItN118aVxcLSl8cXRla3xyMzgwfHI2MDB8cmFrc3xyaW05fHJvKHZlfHpvKXxzNTVcXC98c2EoZ2V8bWF8bW18bXN8bnl8dmEpfHNjKDAxfGhcXC18b298cFxcLSl8c2RrXFwvfHNlKGMoXFwtfDB8MSl8NDd8bWN8bmR8cmkpfHNnaFxcLXxzaGFyfHNpZShcXC18bSl8c2tcXC0wfHNsKDQ1fGlkKXxzbShhbHxhcnxiM3xpdHx0NSl8c28oZnR8bnkpfHNwKDAxfGhcXC18dlxcLXx2ICl8c3koMDF8bWIpfHQyKDE4fDUwKXx0NigwMHwxMHwxOCl8dGEoZ3R8bGspfHRjbFxcLXx0ZGdcXC18dGVsKGl8bSl8dGltXFwtfHRcXC1tb3x0byhwbHxzaCl8dHMoNzB8bVxcLXxtM3xtNSl8dHhcXC05fHVwKFxcLmJ8ZzF8c2kpfHV0c3R8djQwMHx2NzUwfHZlcml8dmkocmd8dGUpfHZrKDQwfDVbMC0zXXxcXC12KXx2bTQwfHZvZGF8dnVsY3x2eCg1Mnw1M3w2MHw2MXw3MHw4MHw4MXw4M3w4NXw5OCl8dzNjKFxcLXwgKXx3ZWJjfHdoaXR8d2koZyB8bmN8bncpfHdtbGJ8d29udXx4NzAwfHlhc1xcLXx5b3VyfHpldG98enRlXFwtL2kudGVzdChhLnN1YnN0cigwLCA0KSkpXG4gICAgICAgICAgICAgICAgY2hlY2sgPSB0cnVlO1xuICAgICAgICB9KShuYXZpZ2F0b3IudXNlckFnZW50IHx8IG5hdmlnYXRvci52ZW5kb3IgfHwgd2luZG93Lm9wZXJhKTtcbiAgICAgICAgcmV0dXJuIGNoZWNrO1xuICAgIH1cblxuICAgIChmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgdmFyIGNvbnRhaW5lciA9ICQoJy5zdC1jb250YWluZXInKSxcblxuICAgICAgICAgICAgZXZlbnR0eXBlID0gbW9iaWxlY2hlY2soKSA/ICd0b3VjaHN0YXJ0JyA6ICdjbGljaycsXG4gICAgICAgICAgICByZXNldE1lbnUgPSBmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgICAgICAgICB2YXIgZWZmZWN0ID0gY29udGFpbmVyLmRhdGEoJ3N0TWVudUVmZmVjdCcpLFxuICAgICAgICAgICAgICAgICAgICBzaWRlYmFyID0gJChjb250YWluZXIuZGF0YSgnc3RNZW51VGFyZ2V0JykpLFxuICAgICAgICAgICAgICAgICAgICBodG1sT2xkQ2xhc3MgPSAkKCdodG1sJykuZ2V0KDApLmNsYXNzTmFtZS5tYXRjaCgvc3QtZWZmZWN0LVxcUysvaWcpO1xuXG4gICAgICAgICAgICAgICAgY29udGFpbmVyLnJlbW92ZUNsYXNzKCdzdC1tZW51LW9wZW4nKTtcblxuICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24oKXtcbiAgICAgICAgICAgICAgICAgICAgaWYgKGh0bWxPbGRDbGFzcyAhPT0gbnVsbCkgJCgnaHRtbCcpLnJlbW92ZUNsYXNzKGh0bWxPbGRDbGFzcy5qb2luKFwiIFwiKSk7XG4gICAgICAgICAgICAgICAgICAgIHNpZGViYXIucmVtb3ZlQ2xhc3MoZWZmZWN0KTtcbiAgICAgICAgICAgICAgICAgICAgY29udGFpbmVyLmdldCgwKS5jbGFzc05hbWUgPSAnc3QtY29udGFpbmVyJzsgLy8gY2xlYXJcbiAgICAgICAgICAgICAgICAgICAgc2lkZWJhci5oaWRlKCk7XG4gICAgICAgICAgICAgICAgfSwgNTUwKTtcblxuICAgICAgICAgICAgfSxcblxuICAgICAgICAgICAgYW5pbWF0ZSA9IGZ1bmN0aW9uIChlKSB7XG5cbiAgICAgICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcblxuICAgICAgICAgICAgICAgIGlmICgkKHRoaXMpLmhhc0NsYXNzKCdhbmltYXRpbmcnKSkgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ2FuaW1hdGluZycpO1xuXG4gICAgICAgICAgICAgICAgdmFyIGJ1dHRvbiA9ICQodGhpcyksXG4gICAgICAgICAgICAgICAgICAgIGVmZmVjdCA9IGJ1dHRvbi5kYXRhKCdlZmZlY3QnKSB8fCAnc3QtZWZmZWN0LTEnLFxuICAgICAgICAgICAgICAgICAgICB0YXJnZXQgPSBidXR0b24uYXR0cignaHJlZicpO1xuXG4gICAgICAgICAgICAgICAgdmFyIGN1cnJlbnRBY3RpdmVFbGVtZW50ID0gJCgnW2RhdGEtdG9nZ2xlPVwic2lkZWJhci1tZW51XCJdJykubm90KHRoaXMpLmNsb3Nlc3QoJ2xpJykubGVuZ3RoID8gJCgnW2RhdGEtdG9nZ2xlPVwic2lkZWJhci1tZW51XCJdJykubm90KHRoaXMpLmNsb3Nlc3QoJ2xpJykgOiAkKCdbZGF0YS10b2dnbGU9XCJzaWRlYmFyLW1lbnVcIl0nKS5ub3QodGhpcyk7XG4gICAgICAgICAgICAgICAgY3VycmVudEFjdGl2ZUVsZW1lbnQucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuXG4gICAgICAgICAgICAgICAgdmFyIGFjdGl2ZUVsZW1lbnQgPSAkKHRoaXMpLmNsb3Nlc3QoJ2xpJykubGVuZ3RoID8gJCh0aGlzKS5jbG9zZXN0KCdsaScpIDogJCh0aGlzKTtcbiAgICAgICAgICAgICAgICBhY3RpdmVFbGVtZW50LmFkZENsYXNzKCdhY3RpdmUnKTtcblxuICAgICAgICAgICAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgICAgICBidXR0b24ucmVtb3ZlQ2xhc3MoJ2FuaW1hdGluZycpO1xuICAgICAgICAgICAgICAgIH0sIDU1MCk7XG5cbiAgICAgICAgICAgICAgICBpZiAodGFyZ2V0Lmxlbmd0aCA8IDMpIHtcbiAgICAgICAgICAgICAgICAgICAgaWYgKCQoJ2h0bWwnKS5oYXNDbGFzcygnc2hvdy1zaWRlYmFyJykpIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGFjdGl2ZUVsZW1lbnQucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xuICAgICAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICAgICAgICAgICQoJ2h0bWwnKS5yZW1vdmVDbGFzcygnc2hvdy1zaWRlYmFyJyk7XG4gICAgICAgICAgICAgICAgICAgIGlmIChhY3RpdmVFbGVtZW50Lmhhc0NsYXNzKCdhY3RpdmUnKSkgJCgnaHRtbCcpLmFkZENsYXNzKCdzaG93LXNpZGViYXInKTtcbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuO1xuICAgICAgICAgICAgICAgIH1cblxuICAgICAgICAgICAgICAgIHZhciBzaWRlYmFyID0gJCh0YXJnZXQpLFxuICAgICAgICAgICAgICAgICAgICBkaXJlY3Rpb24gPSBzaWRlYmFyLmlzKCcubGVmdCcpID8gJ2wnIDogJ3InLFxuICAgICAgICAgICAgICAgICAgICBzaXplID0gc2lkZWJhci5nZXQoMCkuY2xhc3NOYW1lLm1hdGNoKC9zaWRlYmFyLXNpemUtKFxcUyspLykucG9wKCksXG4gICAgICAgICAgICAgICAgICAgIGh0bWxDbGFzcyA9ICdzdC1lZmZlY3QtJyArIGRpcmVjdGlvbiArIHNpemU7XG5cbiAgICAgICAgICAgICAgICBpZiAoY29udGFpbmVyLmhhc0NsYXNzKCdzdC1tZW51LW9wZW4nKSkge1xuICAgICAgICAgICAgICAgICAgICBhY3RpdmVFbGVtZW50LnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICAgICAgICAgICAgcmVzZXRNZW51KCk7XG4gICAgICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICAkKCdodG1sJykuYWRkQ2xhc3MoaHRtbENsYXNzKTtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLnNob3coKTtcblxuICAgICAgICAgICAgICAgIGNvbnRhaW5lci5kYXRhKCdzdE1lbnVFZmZlY3QnLCBlZmZlY3QpO1xuICAgICAgICAgICAgICAgIGNvbnRhaW5lci5kYXRhKCdzdE1lbnVUYXJnZXQnLCB0YXJnZXQpO1xuXG4gICAgICAgICAgICAgICAgc2lkZWJhci5hZGRDbGFzcyhlZmZlY3QpO1xuICAgICAgICAgICAgICAgIGNvbnRhaW5lci5hZGRDbGFzcyhlZmZlY3QpO1xuXG4gICAgICAgICAgICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAgIGNvbnRhaW5lci5hZGRDbGFzcygnc3QtbWVudS1vcGVuJyk7XG4gICAgICAgICAgICAgICAgICAgIHNpZGViYXIuZmluZCgnW2RhdGEtc2Nyb2xsYWJsZV0nKS5nZXROaWNlU2Nyb2xsKCkucmVzaXplKCk7XG4gICAgICAgICAgICAgICAgfSwgMjUpO1xuICAgICAgICAgICAgfTtcblxuICAgICAgICAkKCdib2R5Jykub24oZXZlbnR0eXBlLCAnW2RhdGEtdG9nZ2xlPVwic2lkZWJhci1tZW51XCJdJywgYW5pbWF0ZSk7XG4gICAgICAgICQoZG9jdW1lbnQpLm9uKCdrZXlkb3duJywgbnVsbCwgJ2VzYycsIGZ1bmN0aW9uKCl7XG4gICAgICAgICAgICBpZiAoY29udGFpbmVyLmhhc0NsYXNzKCdzdC1tZW51LW9wZW4nKSkge1xuICAgICAgICAgICAgICAgICQoJ1tkYXRhLXRvZ2dsZT1cInNpZGViYXItbWVudVwiXScpXG4gICAgICAgICAgICAgICAgICAgIC5yZW1vdmVDbGFzcygnYWN0aXZlJylcbiAgICAgICAgICAgICAgICAgICAgLmNsb3Nlc3QoJ2xpJylcbiAgICAgICAgICAgICAgICAgICAgLnJlbW92ZUNsYXNzKCdhY3RpdmUnKTtcblxuICAgICAgICAgICAgICAgIHJlc2V0TWVudSgpO1xuICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICB9KSgpO1xuXG59KShqUXVlcnkpOyIsIm1vZHVsZS5leHBvcnRzID0gZnVuY3Rpb24gKCkge1xuICAgIHZhciBkZCA9ICQoJy5zaWRlYmFyW2RhdGEtdHlwZT1cImNvbGxhcHNlXCJdJyk7XG5cbiAgICBpZiAoZGQubGVuZ3RoKSB7XG5cbiAgICAgICAgJCgnLnNpZGViYXIgW2RhdGEtc2Nyb2xsYWJsZV0gPiB1bCA+IGxpID4gYScpLm9mZignbW91c2VlbnRlcicpO1xuICAgICAgICAkKCcuc2lkZWJhciBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkuZHJvcGRvd24gPiBhJykub2ZmKCdtb3VzZWVudGVyJyk7XG4gICAgICAgICQoJy5zaWRlYmFyIFtkYXRhLXNjcm9sbGFibGVdID4gdWwgPiBsaSA+IGEnKS5vZmYoJ21vdXNlZW50ZXInKTtcbiAgICAgICAgJCgnLnNpZGViYXIgW2RhdGEtc2Nyb2xsYWJsZV0gPiB1bCA+IGxpID4gYScpLm9mZignY2xpY2snKTtcbiAgICAgICAgJCgnLnNpZGViYXInKS5vZmYoJ21vdXNlbGVhdmUnKTtcbiAgICAgICAgJCgnLnNpZGViYXIgLmRyb3Bkb3duJykub2ZmKCdtb3VzZW92ZXInKTtcbiAgICAgICAgJCgnLnNpZGViYXIgLmRyb3Bkb3duJykub2ZmKCdtb3VzZW91dCcpO1xuICAgICAgICAkKCdib2R5Jykub2ZmKCdtb3VzZW91dCcsICcjZHJvcGRvd24tdGVtcCAuZHJvcGRvd24nKTtcblxuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9mZignc2hvd24uYnMuY29sbGFwc2UnKTtcbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vZmYoJ3Nob3cuYnMuY29sbGFwc2UnKTtcbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vZmYoJ2hpZGUuYnMuY29sbGFwc2UnKTtcbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vZmYoJ2hpZGRlbi5icy5jb2xsYXBzZScpO1xuXG4gICAgICAgIGRkLmZpbmQoJyNkcm9wZG93bi10ZW1wJykucmVtb3ZlKCk7XG5cbiAgICAgICAgZGQuZmluZCgnLmhhc1N1Ym1lbnUnKS5yZW1vdmVDbGFzcygnZHJvcGRvd24nKVxuICAgICAgICAgICAgLmZpbmQoJz4gdWwnKS5hZGRDbGFzcygnY29sbGFwc2UnKS5yZW1vdmVDbGFzcygnZHJvcGRvd24tbWVudSBzdWJtZW51LWhpZGUgc3VibWVudS1zaG93JylcbiAgICAgICAgICAgIC5lbmQoKVxuICAgICAgICAgICAgLmZpbmQoJz4gYScpLmF0dHIoJ2RhdGEtdG9nZ2xlJywgJ2NvbGxhcHNlJyk7XG5cbiAgICAgICAgZGQuZmluZCgnLmNvbGxhcHNlJykuY29sbGFwc2Uoeyd0b2dnbGUnOiBmYWxzZX0pO1xuXG4gICAgICAgICQoJy5zaWRlYmFyIHVsLmNvbGxhcHNlJykub24oJ3Nob3duLmJzLmNvbGxhcHNlJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgICQoJy5zaWRlYmFyIFtkYXRhLXNjcm9sbGFibGVdJykuZ2V0TmljZVNjcm9sbCgpLnJlc2l6ZSgpO1xuICAgICAgICB9KTtcblxuICAgICAgICAvLyBDb2xsYXBzZVxuICAgICAgICAkKCcuc2lkZWJhciB1bC5jb2xsYXBzZScpLm9uKCdzaG93LmJzLmNvbGxhcHNlJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG5cbiAgICAgICAgICAgIGlmICgkKCcuc2lkZWJhci1taW5pJykubGVuZ3RoKSAkKCcuc2lkZWJhci1taW5pJykucmVtb3ZlQ2xhc3MoJ3NpZGViYXItbWluaScpLmRhdGEoJ21pbmknLCB0cnVlKTtcblxuICAgICAgICAgICAgdmFyIHBhcmVudHMgPSAkKHRoaXMpLnBhcmVudHMoJ3VsOmZpcnN0JykuZmluZCgnPiBsaS5vcGVuIFtkYXRhLXRvZ2dsZT1cImNvbGxhcHNlXCJdJyk7XG4gICAgICAgICAgICBpZiAocGFyZW50cy5sZW5ndGgpIHtcbiAgICAgICAgICAgICAgICBwYXJlbnRzLnRyaWdnZXIoJ2NsaWNrJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLmFkZENsYXNzKFwib3BlblwiKTtcbiAgICAgICAgfSk7XG5cbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vbignaGlkZS5icy5jb2xsYXBzZScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICAgICAgaWYgKCQodGhpcykuaXMoJy5zaWRlYmFyLW1lbnUgW2RhdGEtc2Nyb2xsYWJsZV0gPiB1bCA+IGxpID4gdWwnKSkge1xuICAgICAgICAgICAgICAgIGlmICgkKCcuc2hvdy1zaWRlYmFyJykuZGF0YSgnbWluaScpKSB7XG4gICAgICAgICAgICAgICAgICAgICQoJy5zaG93LXNpZGViYXInKS5hZGRDbGFzcygnc2lkZWJhci1taW5pJyk7XG4gICAgICAgICAgICAgICAgICAgICQodGhpcykucGFyZW50KCkucmVtb3ZlQ2xhc3MoXCJvcGVuXCIpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICAgICAgJCgnLnNpZGViYXIgdWwuY29sbGFwc2UnKS5vbignaGlkZGVuLmJzLmNvbGxhcHNlJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnJlbW92ZUNsYXNzKFwib3BlblwiKTtcbiAgICAgICAgfSk7XG4gICAgfVxufTsiLCJtb2R1bGUuZXhwb3J0cyA9IGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgZGQgPSAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXScpO1xuXG4gICAgaWYgKGRkLmxlbmd0aCkge1xuXG4gICAgICAgICQoJy5zaWRlYmFyIHVsLmNvbGxhcHNlJylcbiAgICAgICAgICAgIC5vZmYoJ3Nob3duLmJzLmNvbGxhcHNlJylcbiAgICAgICAgICAgIC5vZmYoJ3Nob3cuYnMuY29sbGFwc2UnKVxuICAgICAgICAgICAgLm9mZignaGlkZGVuLmJzLmNvbGxhcHNlJyk7XG5cbiAgICAgICAgZGQuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICB2YXIgc2lkZWJhciA9ICQodGhpcyk7XG4gICAgICAgICAgICB2YXIgbmljZSA9IHNpZGViYXIuZmluZCgnW2RhdGEtc2Nyb2xsYWJsZV0nKS5nZXROaWNlU2Nyb2xsKClbIDAgXTtcblxuICAgICAgICAgICAgbmljZS5zY3JvbGxzdGFydChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgaWYgKCEgc2lkZWJhci5pcygnW2RhdGEtdHlwZT1cImRyb3Bkb3duXCJdJykpIHJldHVybjtcbiAgICAgICAgICAgICAgICBzaWRlYmFyLmZpbmQoJy5zaWRlYmFyLW1lbnUnKS5hZGRDbGFzcygnc2Nyb2xsaW5nJyk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcjZHJvcGRvd24tdGVtcCA+IHVsID4gbGknKS5lbXB0eSgpO1xuICAgICAgICAgICAgICAgIHNpZGViYXIuZmluZCgnI2Ryb3Bkb3duLXRlbXAnKS5oaWRlKCk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcub3BlbicpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgbmljZS5zY3JvbGxlbmQoZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAgIGlmICghIHNpZGViYXIuaXMoJ1tkYXRhLXR5cGU9XCJkcm9wZG93blwiXScpKSByZXR1cm47XG4gICAgICAgICAgICAgICAgJC5kYXRhKHRoaXMsICdsYXN0U2Nyb2xsVG9wJywgbmljZS5nZXRTY3JvbGxUb3AoKSk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcuc2lkZWJhci1tZW51JykucmVtb3ZlQ2xhc3MoJ3Njcm9sbGluZycpO1xuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgIGRkLmZpbmQoJy5oYXNTdWJtZW51JykuYWRkQ2xhc3MoJ2Ryb3Bkb3duJykucmVtb3ZlQ2xhc3MoJ29wZW4nKVxuICAgICAgICAgICAgLmZpbmQoJz4gdWwnKS5hZGRDbGFzcygnZHJvcGRvd24tbWVudScpLnJlbW92ZUNsYXNzKCdjb2xsYXBzZSBpbicpLnJlbW92ZUF0dHIoJ3N0eWxlJylcbiAgICAgICAgICAgIC5lbmQoKVxuICAgICAgICAgICAgLmZpbmQoJz4gYScpLnJlbW92ZUNsYXNzKCdjb2xsYXBzZWQnKVxuICAgICAgICAgICAgLnJlbW92ZUF0dHIoJ2RhdGEtdG9nZ2xlJyk7XG5cbiAgICAgICAgJCgnLnNpZGViYXJbZGF0YS10eXBlPVwiZHJvcGRvd25cIl0gW2RhdGEtc2Nyb2xsYWJsZV0gPiB1bCA+IGxpLmRyb3Bkb3duID4gYScpLm9uKCdtb3VzZWVudGVyJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgaWYgKCEgJCh0aGlzKS5wYXJlbnQoJy5kcm9wZG93bicpLmlzKCcub3BlbicpICYmICEgJCgnLnNpZGViYXItbWVudScpLmlzKCcuc2Nyb2xsaW5nJykpIHtcbiAgICAgICAgICAgICAgICB2YXIgcCA9ICQodGhpcykucGFyZW50KCcuZHJvcGRvd24nKSxcbiAgICAgICAgICAgICAgICAgICAgdCA9IHAuZmluZCgnPiAuZHJvcGRvd24tbWVudScpLmNsb25lKCkucmVtb3ZlQ2xhc3MoJ3N1Ym1lbnUtaGlkZScpLFxuICAgICAgICAgICAgICAgICAgICBtID0gJCh0aGlzKS5jbG9zZXN0KCcuc2lkZWJhci1tZW51JyksXG4gICAgICAgICAgICAgICAgICAgIHNpZGViYXIgPSAkKHRoaXMpLmNsb3Nlc3QoJy5zaWRlYmFyJyksXG4gICAgICAgICAgICAgICAgICAgIGMgPSBtLmZpbmQoJz4gI2Ryb3Bkb3duLXRlbXAnKTtcblxuICAgICAgICAgICAgICAgIG0uZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuXG4gICAgICAgICAgICAgICAgaWYgKCEgYy5sZW5ndGgpIHtcbiAgICAgICAgICAgICAgICAgICAgYyA9ICQoJzxkaXYvPicpLmF0dHIoJ2lkJywgJ2Ryb3Bkb3duLXRlbXAnKS5hcHBlbmRUbyhtKTtcbiAgICAgICAgICAgICAgICAgICAgYy5odG1sKCc8dWw+PGxpPjwvbGk+PC91bD4nKTtcbiAgICAgICAgICAgICAgICB9XG5cbiAgICAgICAgICAgICAgICBjLnNob3coKTtcbiAgICAgICAgICAgICAgICBjLmZpbmQoJy5kcm9wZG93bi1tZW51JykucmVtb3ZlKCk7XG4gICAgICAgICAgICAgICAgYyA9IGMuZmluZCgnPiB1bCA+IGxpJykuY3NzKHtvdmVyZmxvdzogJ3Zpc2libGUnfSkuYWRkQ2xhc3MoJ2Ryb3Bkb3duIG9wZW4nKTtcblxuICAgICAgICAgICAgICAgIHAuYWRkQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAgICAgICB0LmFwcGVuZFRvKGMpLmNzcyh7XG4gICAgICAgICAgICAgICAgICAgIHRvcDogcC5vZmZzZXQoKS50b3AgLSBjLm9mZnNldCgpLnRvcCxcbiAgICAgICAgICAgICAgICAgICAgbGVmdDogJzEwMCUnXG4gICAgICAgICAgICAgICAgfSkuc2hvdygpO1xuXG4gICAgICAgICAgICAgICAgaWYgKHNpZGViYXIuaXMoJy5yaWdodCcpKSB7XG4gICAgICAgICAgICAgICAgICAgIHQuY3NzKHtcbiAgICAgICAgICAgICAgICAgICAgICAgIGxlZnQ6ICdhdXRvJyxcbiAgICAgICAgICAgICAgICAgICAgICAgIHJpZ2h0OiAnMTAwJSdcbiAgICAgICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXSBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkgPiBhJykub24oJ21vdXNlZW50ZXInLCBmdW5jdGlvbiAoKSB7XG5cbiAgICAgICAgICAgIGlmICghICQodGhpcykucGFyZW50KCkuaXMoJy5kcm9wZG93bicpKSB7XG4gICAgICAgICAgICAgICAgdmFyIHNpZGViYXIgPSAkKHRoaXMpLmNsb3Nlc3QoJy5zaWRlYmFyJyk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcub3BlbicpLnJlbW92ZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgICAgICAgICAgc2lkZWJhci5maW5kKCcjZHJvcGRvd24tdGVtcCcpLmhpZGUoKTtcbiAgICAgICAgICAgIH1cblxuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXSBbZGF0YS1zY3JvbGxhYmxlXSA+IHVsID4gbGkgPiBhJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAgIGlmICgkKHRoaXMpLnBhcmVudCgpLmlzKCcuZHJvcGRvd24nKSkge1xuICAgICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICAgICAgfVxuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXScpLm9uKCdtb3VzZWxlYXZlJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCh0aGlzKS5maW5kKCcjZHJvcGRvd24tdGVtcCcpLmhpZGUoKTtcbiAgICAgICAgICAgICQodGhpcykuZmluZCgnLm9wZW4nKS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgICB9KTtcblxuICAgICAgICAkKCcuc2lkZWJhcltkYXRhLXR5cGU9XCJkcm9wZG93blwiXSAuZHJvcGRvd24nKS5vbignbW91c2VvdmVyJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnb3BlbicpLmNoaWxkcmVuKCd1bCcpLnJlbW92ZUNsYXNzKCdzdWJtZW51LWhpZGUnKS5hZGRDbGFzcygnc3VibWVudS1zaG93Jyk7XG4gICAgICAgIH0pLm9uKCdtb3VzZW91dCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQodGhpcykuY2hpbGRyZW4oJ3VsJykucmVtb3ZlQ2xhc3MoJy5zdWJtZW51LXNob3cnKS5hZGRDbGFzcygnc3VibWVudS1oaWRlJyk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJ2JvZHknKS5vbignbW91c2VvdXQnLCAnI2Ryb3Bkb3duLXRlbXAgLmRyb3Bkb3duJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJCgnLnNpZGViYXItbWVudSAub3BlbicpLnJlbW92ZUNsYXNzKCcub3BlbicpO1xuICAgICAgICB9KTtcbiAgICB9XG59OyIsInJlcXVpcmUoJy4vX2JyZWFrcG9pbnRzJyk7XG5yZXF1aXJlKCcuL19zaWRlYmFyLW1lbnUnKTtcbnJlcXVpcmUoJy4vX2NvbGxhcHNpYmxlJyk7XG5yZXF1aXJlKCcuL19kcm9wZG93bicpO1xucmVxdWlyZSgnLi9fc2lkZWJhci10b2dnbGUnKTtcblxuKGZ1bmN0aW9uKCQpe1xuXG4gICAgaWYgKCQod2luZG93KS53aWR0aCgpIDw9IDQ4MClcbiAgICB7XG4gICAgICAgIGlmICghICQoJy5zaWRlYmFyJykubGVuZ3RoKSByZXR1cm47XG5cbiAgICAgICAgJChcImh0bWxcIikucmVtb3ZlQ2xhc3MoJ3Nob3ctc2lkZWJhcicpO1xuICAgIH1cblxufSkoalF1ZXJ5KTsiLCIoZnVuY3Rpb24gKCQpIHtcbiAgICBcInVzZSBzdHJpY3RcIjtcblxuICAgICQoJy5zaGFyZSB0ZXh0YXJlYScpLm9uKCdrZXl1cCcsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJChcIi5zaGFyZSBidXR0b25cIilbICQodGhpcykudmFsKCkgPT09ICcnID8gJ2hpZGUnIDogJ3Nob3cnIF0oKTtcbiAgICB9KTtcblxuICAgIGlmICghICQoXCIjc2Nyb2xsLXNweVwiKS5sZW5ndGgpIHJldHVybjtcblxuICAgIHZhciBvZmZzZXQgPSAkKFwiI3Njcm9sbC1zcHlcIikub2Zmc2V0KCkudG9wO1xuXG4gICAgJCgnYm9keScpLnNjcm9sbHNweSh7dGFyZ2V0OiAnI3Njcm9sbC1zcHknLCBvZmZzZXQ6IG9mZnNldH0pO1xuXG59KShqUXVlcnkpO1xuIiwicmVxdWlyZSgnLi9fdGltZWxpbmUnKTsiLCIoZnVuY3Rpb24gKCQpIHtcblxuICAgIHZhciBzaG93SG92ZXIgPSBmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJ1tkYXRhLXNob3ctaG92ZXJdJykuaGlkZSgpLmVhY2goZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgdmFyIHNlbGYgPSAkKHRoaXMpLFxuICAgICAgICAgICAgICAgIHBhcmVudCA9ICQodGhpcykuZGF0YSgnc2hvd0hvdmVyJyk7XG5cbiAgICAgICAgICAgIHNlbGYuY2xvc2VzdChwYXJlbnQpLm9uKCdtb3VzZW92ZXInLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgICAgICAgICAgc2VsZi5zaG93KCk7XG4gICAgICAgICAgICB9KS5vbignbW91c2VvdXQnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgc2VsZi5oaWRlKCk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgfSk7XG4gICAgfTtcblxuICAgIHNob3dIb3ZlcigpO1xuXG4gICAgd2luZG93LnNob3dIb3ZlciA9IHNob3dIb3ZlcjtcblxufSkoalF1ZXJ5KTsiLCIoZnVuY3Rpb24gKCQpIHtcblxuICAgIHZhciBza2luID0gcmVxdWlyZSgnLi9fc2tpbicpKCk7XG5cbiAgICAkKCcudGFiYmFibGUgLm5hdi10YWJzJykuZWFjaChmdW5jdGlvbigpe1xuICAgICAgICB2YXIgdGFicyA9ICQodGhpcykubmljZVNjcm9sbCh7XG4gICAgICAgICAgICBjdXJzb3Jib3JkZXI6IDAsXG4gICAgICAgICAgICBjdXJzb3Jjb2xvcjogY29uZmlnLnNraW5zWyBza2luIF1bICdwcmltYXJ5LWNvbG9yJyBdLFxuICAgICAgICAgICAgaG9yaXpyYWlsZW5hYmxlZDogdHJ1ZSxcbiAgICAgICAgICAgIG9uZWF4aXNtb3VzZW1vZGU6IHRydWVcbiAgICAgICAgfSk7XG5cbiAgICAgICAgdmFyIF9zdXBlciA9IHRhYnMuZ2V0Q29udGVudFNpemU7XG4gICAgICAgIHRhYnMuZ2V0Q29udGVudFNpemUgPSBmdW5jdGlvbigpIHtcbiAgICAgICAgICAgIHZhciBwYWdlID0gX3N1cGVyLmNhbGwodGFicyk7XG4gICAgICAgICAgICBwYWdlLmggPSB0YWJzLndpbi5oZWlnaHQoKTtcbiAgICAgICAgICAgIHJldHVybiBwYWdlO1xuICAgICAgICB9O1xuICAgIH0pO1xuXG4gICAgJCgnW2RhdGEtc2Nyb2xsYWJsZV0nKS5nZXROaWNlU2Nyb2xsKCkucmVzaXplKCk7XG5cbiAgICAkKCcudGFiYmFibGUgLm5hdi10YWJzIGEnKS5vbignc2hvd24uYnMudGFiJywgZnVuY3Rpb24oZSl7XG4gICAgICAgIHZhciB0YWIgPSAkKHRoaXMpLmNsb3Nlc3QoJy50YWJiYWJsZScpO1xuICAgICAgICB2YXIgdGFyZ2V0ID0gJChlLnRhcmdldCksXG4gICAgICAgICAgICB0YXJnZXRQYW5lID0gdGFyZ2V0LmF0dHIoJ2hyZWYnKSB8fCB0YXJnZXQuZGF0YSgndGFyZ2V0Jyk7XG5cbiAgICAgICAgLy8gcmVmcmVzaCB0YWJzIHdpdGggaG9yaXpvbnRhbCBzY3JvbGxcbiAgICAgICAgdGFiLmZpbmQoJy5uYXYtdGFicycpLmdldE5pY2VTY3JvbGwoKS5yZXNpemUoKTtcblxuICAgICAgICAvLyByZWZyZXNoIFtkYXRhLXNjcm9sbGFibGVdIHdpdGhpbiB0aGUgYWN0aXZhdGVkIHRhYiBwYW5lXG4gICAgICAgICQodGFyZ2V0UGFuZSkuZmluZCgnW2RhdGEtc2Nyb2xsYWJsZV0nKS5nZXROaWNlU2Nyb2xsKCkucmVzaXplKCk7XG4gICAgfSk7XG5cbn0oalF1ZXJ5KSk7IiwiKGZ1bmN0aW9uICgkKSB7XG5cbiAgICB2YXIgdHJlZV9nbHlwaF9vcHRpb25zID0ge1xuICAgICAgICBtYXA6IHtcbiAgICAgICAgICAgIGNoZWNrYm94OiBcImZhIGZhLXNxdWFyZS1vXCIsXG4gICAgICAgICAgICBjaGVja2JveFNlbGVjdGVkOiBcImZhIGZhLWNoZWNrLXNxdWFyZVwiLFxuICAgICAgICAgICAgY2hlY2tib3hVbmtub3duOiBcImZhIGZhLWNoZWNrLXNxdWFyZSBmYS1tdXRlZFwiLFxuICAgICAgICAgICAgZXJyb3I6IFwiZmEgZmEtZXhjbGFtYXRpb24tdHJpYW5nbGVcIixcbiAgICAgICAgICAgIGV4cGFuZGVyQ2xvc2VkOiBcImZhIGZhLWNhcmV0LXJpZ2h0XCIsXG4gICAgICAgICAgICBleHBhbmRlckxhenk6IFwiZmEgZmEtYW5nbGUtcmlnaHRcIixcbiAgICAgICAgICAgIGV4cGFuZGVyT3BlbjogXCJmYSBmYS1jYXJldC1kb3duXCIsXG4gICAgICAgICAgICBkb2M6IFwiZmEgZmEtZmlsZS1vXCIsXG4gICAgICAgICAgICBub0V4cGFuZGVyOiBcIlwiLFxuICAgICAgICAgICAgZG9jT3BlbjogXCJmYSBmYS1maWxlXCIsXG4gICAgICAgICAgICBsb2FkaW5nOiBcImZhIGZhLXJlZnJlc2ggZmEtc3BpblwiLFxuICAgICAgICAgICAgZm9sZGVyOiBcImZhIGZhLWZvbGRlclwiLFxuICAgICAgICAgICAgZm9sZGVyT3BlbjogXCJmYSBmYS1mb2xkZXItb3BlblwiXG4gICAgICAgIH1cbiAgICB9LFxuICAgIHRyZWVfZG5kX29wdGlvbnMgPSB7XG4gICAgICAgIGF1dG9FeHBhbmRNUzogNDAwLFxuICAgICAgICAgICAgZm9jdXNPbkNsaWNrOiB0cnVlLFxuICAgICAgICAgICAgcHJldmVudFZvaWRNb3ZlczogdHJ1ZSwgLy8gUHJldmVudCBkcm9wcGluZyBub2RlcyAnYmVmb3JlIHNlbGYnLCBldGMuXG4gICAgICAgICAgICBwcmV2ZW50UmVjdXJzaXZlTW92ZXM6IHRydWUsIC8vIFByZXZlbnQgZHJvcHBpbmcgbm9kZXMgb24gb3duIGRlc2NlbmRhbnRzXG4gICAgICAgICAgICBkcmFnU3RhcnQ6IGZ1bmN0aW9uKG5vZGUsIGRhdGEpIHtcbiAgICAgICAgICAgIC8qKiBUaGlzIGZ1bmN0aW9uIE1VU1QgYmUgZGVmaW5lZCB0byBlbmFibGUgZHJhZ2dpbmcgZm9yIHRoZSB0cmVlLlxuICAgICAgICAgICAgICogIFJldHVybiBmYWxzZSB0byBjYW5jZWwgZHJhZ2dpbmcgb2Ygbm9kZS5cbiAgICAgICAgICAgICAqL1xuICAgICAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICAgIH0sXG4gICAgICAgIGRyYWdFbnRlcjogZnVuY3Rpb24obm9kZSwgZGF0YSkge1xuICAgICAgICAgICAgLyoqIGRhdGEub3RoZXJOb2RlIG1heSBiZSBudWxsIGZvciBub24tZmFuY3l0cmVlIGRyb3BwYWJsZXMuXG4gICAgICAgICAgICAgKiAgUmV0dXJuIGZhbHNlIHRvIGRpc2FsbG93IGRyb3BwaW5nIG9uIG5vZGUuIEluIHRoaXMgY2FzZVxuICAgICAgICAgICAgICogIGRyYWdPdmVyIGFuZCBkcmFnTGVhdmUgYXJlIG5vdCBjYWxsZWQuXG4gICAgICAgICAgICAgKiAgUmV0dXJuICdvdmVyJywgJ2JlZm9yZSwgb3IgJ2FmdGVyJyB0byBmb3JjZSBhIGhpdE1vZGUuXG4gICAgICAgICAgICAgKiAgUmV0dXJuIFsnYmVmb3JlJywgJ2FmdGVyJ10gdG8gcmVzdHJpY3QgYXZhaWxhYmxlIGhpdE1vZGVzLlxuICAgICAgICAgICAgICogIEFueSBvdGhlciByZXR1cm4gdmFsdWUgd2lsbCBjYWxjIHRoZSBoaXRNb2RlIGZyb20gdGhlIGN1cnNvciBwb3NpdGlvbi5cbiAgICAgICAgICAgICAqL1xuICAgICAgICAgICAgLy8gUHJldmVudCBkcm9wcGluZyBhIHBhcmVudCBiZWxvdyBhbm90aGVyIHBhcmVudCAob25seSBzb3J0XG4gICAgICAgICAgICAvLyBub2RlcyB1bmRlciB0aGUgc2FtZSBwYXJlbnQpXG4gICAgICAgICAgICAvKlxuICAgICAgICAgICAgaWYobm9kZS5wYXJlbnQgIT09IGRhdGEub3RoZXJOb2RlLnBhcmVudCl7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgLy8gRG9uJ3QgYWxsb3cgZHJvcHBpbmcgKm92ZXIqIGEgbm9kZSAod291bGQgY3JlYXRlIGEgY2hpbGQpXG4gICAgICAgICAgICByZXR1cm4gW1wiYmVmb3JlXCIsIFwiYWZ0ZXJcIl07XG4gICAgICAgICAgICAqL1xuICAgICAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICAgIH0sXG4gICAgICAgIGRyYWdEcm9wOiBmdW5jdGlvbihub2RlLCBkYXRhKSB7XG4gICAgICAgICAgICAvKiogVGhpcyBmdW5jdGlvbiBNVVNUIGJlIGRlZmluZWQgdG8gZW5hYmxlIGRyb3BwaW5nIG9mIGl0ZW1zIG9uXG4gICAgICAgICAgICAgKiAgdGhlIHRyZWUuXG4gICAgICAgICAgICAgKi9cbiAgICAgICAgICAgIGRhdGEub3RoZXJOb2RlLm1vdmVUbyhub2RlLCBkYXRhLmhpdE1vZGUpO1xuICAgICAgICB9XG4gICAgfTtcblxuICAgIC8vIHVzaW5nIGRlZmF1bHQgb3B0aW9uc1xuICAgICQoJ1tkYXRhLXRvZ2dsZT1cInRyZWVcIl0nKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgICAgdmFyIGV4dGVuc2lvbnMgPSBbIFwiZ2x5cGhcIiBdO1xuICAgICAgICBpZiAodHlwZW9mICQodGhpcykuYXR0cignZGF0YS10cmVlLWRuZCcpICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgICAgICBleHRlbnNpb25zLnB1c2goIFwiZG5kXCIgKTtcbiAgICAgICAgfVxuICAgICAgICAkKHRoaXMpLmZhbmN5dHJlZSh7XG4gICAgICAgICAgICBleHRlbnNpb25zOiBleHRlbnNpb25zLFxuICAgICAgICAgICAgZ2x5cGg6IHRyZWVfZ2x5cGhfb3B0aW9ucyxcbiAgICAgICAgICAgIGRuZDogdHJlZV9kbmRfb3B0aW9ucyxcbiAgICAgICAgICAgIGNsaWNrRm9sZGVyTW9kZTogMyxcbiAgICAgICAgICAgIGNoZWNrYm94OiB0eXBlb2YgJCh0aGlzKS5hdHRyKCdkYXRhLXRyZWUtY2hlY2tib3gnKSAhPT0gXCJ1bmRlZmluZWRcIiB8fCBmYWxzZSxcbiAgICAgICAgICAgIHNlbGVjdE1vZGU6IHR5cGVvZiAkKHRoaXMpLmF0dHIoJ2RhdGEtdHJlZS1zZWxlY3QnKSAhPT0gXCJ1bmRlZmluZWRcIiA/IHBhcnNlSW50KCQodGhpcykuYXR0cignZGF0YS10cmVlLXNlbGVjdCcpKSA6IDJcbiAgICAgICAgfSk7XG4gICAgfSk7XG5cbn0oalF1ZXJ5KSk7IiwicmVxdWlyZSgnLi9fdGFicycpO1xucmVxdWlyZSgnLi9fdHJlZScpO1xucmVxdWlyZSgnLi9fc2hvdy1ob3ZlcicpOyJdfQ==
