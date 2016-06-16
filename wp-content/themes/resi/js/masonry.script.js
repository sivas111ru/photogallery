(function($){
$(document).ready(function() {

var container = document.querySelector('#gallery-container');
	var msnry; imagesLoaded( container, function() {
  	msnry = new Masonry( container, {
 	   itemSelector: '.gallery-image',
	   transitionDuration: '0.3s',
       columnWidth: container.querySelector('.gallery-image') })
	});	
	
});
})( jQuery );  
