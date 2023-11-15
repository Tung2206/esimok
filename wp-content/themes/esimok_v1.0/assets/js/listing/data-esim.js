(function ($) {
    'use strict';

    function custom_search_focus() {
        var $body = $('body');
        var $input_focus = $(".esim-search");
        var $over = $('html');
        $body.on('focusin', '.esim-search input', function (e) {
            e.preventDefault();
            $input_focus.addClass('focus');
            $(".esim-search .no-suggestions").addClass('on-focus');
            $over.addClass('gigago-close-side-opened');
        });
        $body.on('click', '.gigago-overlay', function (e) {
            e.preventDefault();
            $input_focus.removeClass('focus');
            $over.removeClass('gigago-close-side-opened');
            $(".esim-search .no-suggestions").removeClass('on-focus');
        });
    }

    $(document).ready(function () {
        custom_search_focus();
    });

})(jQuery);