window.IS_PREVIEW_SHOWN = false;

var MOBILE_SCREEN_RESOLUTION = 600;

jQuery(document).ready(function ($) {
  $(window).on("resize", function () {
    if ( window.IS_PREVIEW_SHOWN && window.innerWidth < MOBILE_SCREEN_RESOLUTION ) {
      var $prev_ul = $(".gallery-item.og-expanded");

      hidePreview();

      setTimeout(function(){
        $prev_ul.css("height", "");
      }, 100);

      window.IS_PREVIEW_SHOWN = false;
    }
  });
})