(function($){
    var $header = $("#nav-header");
    var $header_space = $("#masthead");
    var fixHeaderHeight = function() {
        $header_space.height($header.outerHeight(true));
    }

    fixHeaderHeight();
	$(window).on("ready", setTimeout(fixHeaderHeight,500));
    $(window).on("resize", fixHeaderHeight);
})(jQuery);