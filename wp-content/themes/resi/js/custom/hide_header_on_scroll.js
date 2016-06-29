window.is_preview_opening = false;

(function($){
  var did_scroll;
  var lastScrollTop = 0;
  var delta = 5;
  var navbarHeight = $('#nav-header').outerHeight();

  $(window).on("scroll", function() {
    if ( !window.is_preview_opening ) {
      did_scroll = true;
    }
  })

  setInterval(function() {
    if ( did_scroll ) {
      hasScrolled();
      did_scroll = false;
    }
  }, 250);

  function hasScrolled() {
    console.log("!!!!!!!!!!!");
    var st = $(this).scrollTop();
    
    if(Math.abs(lastScrollTop - st) <= delta)
      return;
    
    if (st > lastScrollTop){
      // scroll down
      console.log("down");
      $('#nav-header').removeClass('nav-down').addClass('nav-up');
    } else {
      if(st + $(window).height() < $(document).height()) {
        // scroll up
        $('#nav-header').removeClass('nav-up').addClass('nav-down');
        console.log("up");
      }
    }
    
    lastScrollTop = st;
}
})(jQuery);