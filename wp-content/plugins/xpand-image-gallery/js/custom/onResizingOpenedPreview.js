window.IS_PREVIEW_SHOWN = false;

var MOBILE_SCREEN_RESOLUTION = 540;

jQuery(document).ready(function ($) {
  $(window).on("resize", function () {
    if ( window.IS_PREVIEW_SHOWN && window.innerWidth < MOBILE_SCREEN_RESOLUTION ) {
      hidePreview();
      window.IS_PREVIEW_SHOWN = false;
    }
  });
})