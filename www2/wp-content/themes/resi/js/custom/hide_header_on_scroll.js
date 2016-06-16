(function($){
	var didScroll;
	var lastScrollTop = 0;
	var delta = 5;
	var navbarHeight = $('#nav-header').outerHeight();

	var scrollListener = function(e) {
		var direction = function () {
	
	            var delta = (e.type === 'DOMMouseScroll' ?
	            e.originalEvent.detail * -40 :
	                e.originalEvent.wheelDelta);
	
	            return delta > 0 ? 0 : 1;
	        };
	
	        if ( this.is_scroll_message_shown ) {
	            this.is_scroll_message_shown = false;
	
	            var $scrl_msg = $(".scroll-message");
	
	            TweenLite.to($scrl_msg, 1, {bottom: "-3em", opacity: 0, onComplete: () => {
	                $scrl_msg.hide();
	            }});
	        }
	
	        if ( this.is_transition ) {
	            return;
	        }
	
	        if(direction() === 1) {
	            $('#nav-header').removeClass('nav-down').addClass('nav-up');
	        }
	        if(direction() === 0) {
	            $('#nav-header').removeClass('nav-up').addClass('nav-down');
	        }
	}

	$(window).on('mousewheel DOMMouseScroll', scrollListener);
})(jQuery);