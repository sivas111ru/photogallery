var MOBILE_SCREEN_RESOLUTION = 600;


var Grid;

(function($) {
var $event = $.event,
$special,
resizeTimeout;

//--Set Other Settings
var xpgalImgHeight;
var linkLove;

    /*
     * debouncedresize: special jQuery event that happens once after a window resize
     *
     * latest version and complete README available on Github:
     * https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
     *
     * Copyright 2011 @louis_remi
     * Licensed under the MIT license.
     */

$special = $event.special.debouncedresize = {
	setup: function() {
		$( this ).on( "resize", $special.handler );
	},
	teardown: function() {
		$( this ).off( "resize", $special.handler );
	},
	handler: function( event, execAsap ) {
		// Save the context
		var context = this,
			args = arguments,
			dispatch = function() {
				// set correct event type
				event.type = "debouncedresize";
				$event.dispatch.apply( context, args );
			};

		if ( resizeTimeout ) {
			clearTimeout( resizeTimeout );
		}

		execAsap ?
			dispatch() :
			resizeTimeout = setTimeout( dispatch, $special.threshold );
	},
	threshold: 250
};

// ======================= imagesLoaded Plugin ===============================
// https://github.com/desandro/imagesloaded

// $('#my-container').imagesLoaded(myFunction)
// execute a callback when all images have loaded.
// needed because .load() doesn't work on cached images

// callback function gets image collection as argument
//  this is the container

// original: MIT license. Paul Irish. 2010.
// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

// blank image data-uri bypasses webkit log warning (thx doug jones)
var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

$.fn.imagesLoaded = function( callback ) {
	var $this = this,
		deferred = $.isFunction($.Deferred) ? $.Deferred() : 0,
		hasNotify = $.isFunction(deferred.notify),
		$images = $this.find('img').add( $this.filter('img') ),
		$currentItem = null,
		loaded = [],
		proper = [],
		broken = [];

	// Register deferred callbacks
	if ($.isPlainObject(callback)) {
		$.each(callback, function (key, value) {
			if (key === 'callback') {
				callback = value;
			} else if (deferred) {
				deferred[key](value);
			}
		});
	}

	function doneLoading() {
		var $proper = $(proper),
			$broken = $(broken);

		if ( deferred ) {
			if ( broken.length ) {
				deferred.reject( $images, $proper, $broken );
			} else {
				deferred.resolve( $images );
			}
		}

		if ( $.isFunction( callback ) ) {
			callback.call( $this, $images, $proper, $broken );
		}
	}

	function imgLoaded( img, isBroken ) {
		// don't proceed if BLANK image, or image is already loaded
		if ( img.src === BLANK || $.inArray( img, loaded ) !== -1 ) {
			return;
		}

		// store element in loaded images array
		loaded.push( img );

		// keep track of broken and properly loaded images
		if ( isBroken ) {
			broken.push( img );
		} else {
			proper.push( img );
		}

		// cache image and its state for future calls
		$.data( img, 'imagesLoaded', { isBroken: isBroken, src: img.src } );

		// trigger deferred progress method if present
		if ( hasNotify ) {
			deferred.notifyWith( $(img), [ isBroken, $images, $(proper), $(broken) ] );
		}

		// call doneLoading and clean listeners if all images are loaded
		if ( $images.length === loaded.length ){
			setTimeout( doneLoading );
			$images.unbind( '.imagesLoaded' );
		}
	}

	// if no images, trigger immediately
	if ( !$images.length ) {
		doneLoading();
	} else {
		$images.bind( 'load.imagesLoaded error.imagesLoaded', function( event ){
			// trigger imgLoaded
			imgLoaded( event.target, event.type === 'error' );
		}).each( function( i, el ) {
			var src = el.src;

			// find out if this image has been already checked for status
			// if it was, and src has not changed, call imgLoaded on it
			var cached = $.data( el, 'imagesLoaded' );
			if ( cached && cached.src === src ) {
				imgLoaded( el, cached.isBroken );
				return;
			}

			// if complete is true and browser supports natural sizes, try
			// to check for image status manually
			if ( el.complete && el.naturalWidth !== undefined ) {
				imgLoaded( el, el.naturalWidth === 0 || el.naturalHeight === 0 );
				return;
			}

			// cached images don't fire load sometimes, so we reset src, but only when
			// dealing with IE, or image is complete (loaded) and failed manual check
			// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
			if ( el.readyState || el.complete ) {
				el.src = BLANK;
				el.src = src;
			}
		});
	}

	return deferred ? deferred.promise( $this ) : $this;
};

Grid = (function() {

		// list of items
	var $grid = $( '#og-grid' ),
		// the items
		$items = $grid.children( 'li' ),
		// current expanded item's index
		current = -1,
		// position (top) of the expanded item
		// used to know if the preview will expand in a different row
		previewPos = -1,
		// extra amount of pixels to scroll the window
		scrollExtra = 0,
		// extra margin when expanded (between preview overlay and the next items)
		marginExpanded = -10,
		$window = $( window ), winsize,
		$body = $( 'html, body' ),
		// transitionend events
		transEndEventNames = {
			'WebkitTransition' : 'webkitTransitionEnd',
			'MozTransition' : 'transitionend',
			'OTransition' : 'oTransitionEnd',
			'msTransition' : 'MSTransitionEnd',
			'transition' : 'transitionend'
		},
		transEndEventName = transEndEventNames[ CModernizr.prefixed( 'transition' ) ],
		// support for csstransitions
		support = CModernizr.csstransitions,
		// default settings
		settings = {
			minHeight : 550,
			speed : 350,
			easing : 'ease'
		};

	function init( xpgalPreviewHeight, xpgalAnimSpeed, xpgalLinkLove ) {

        $items = $( '#og-grid').children('li');

		// the settings..
        xpgalImgHeight = xpgalPreviewHeight - 50;
        linkLove = xpgalLinkLove;
        settings = {
            minHeight : xpgalPreviewHeight,
            speed : xpgalAnimSpeed,
            easing : 'ease'
        };

		// preload all images
		$grid.imagesLoaded( function() {

			// save item´s size and offset
			saveItemInfo( true );
			// get window´s size
			getWinSize();
			// initialize some events
			initEvents();

		} );

	}

	// add more items to the grid.
	// the new items need to appended to the grid.
	// after that call Grid.addItems(theItems);
	function addItems( $newitems ) {

		$items = $items.add( $newitems );

		$newitems.each( function() {
			var $item = $( this );
			$item.data( {
				offsetTop : $item.offset().top,
				height : $item.height()
			} );
		} );

		initItemsEvents( $newitems );

	}

	// saves the item´s offset top and height (if saveheight is true)
	function saveItemInfo( saveheight ) {
		$items.each( function() {
			var $item = $( this );
			$item.data( 'offsetTop', $item.offset().top );
			if( saveheight ) {
				$item.data( 'height', $item.height() );
			}
		} );
	}

	function initEvents() {
		
		// when clicking an item, show the preview with the item´s info and large image.
		// close the item if already expanded.
		// also close if clicking on the item´s cross
		initItemsEvents( $items );
		
		initFocusEvent($items);
		
		prevNextKeys();

        prevNextBtn();
		
		// on window resize get the window´s size again
		// reset some values..
		$window.on( 'debouncedresize', function() {
			
			scrollExtra = 0;
			previewPos = -1;
			// save item´s offset
			saveItemInfo();
			getWinSize();
			var preview = $.data( this, 'preview' );
			if( typeof preview != 'undefined' ) {
				hidePreview();
			}

		} );

	}

	function initItemsEvents( $items ) {
		$items.on( 'click', 'span.og-close', function() {
			hidePreview();
			return false;
		} ).children( 'a' ).on( 'click', function() {
			var $item = $( this ).parent();
			// check if item already opened
			current === $item.index() ? hidePreview() : showPreview( $item );
			$currentItem = $item;

			return false;

		} );
	}

function initFocusEvent($items) {
	  $items.on('focus', 'div.og-expander-inner', function() {
		  var $item = $( this ).parents('li.gallery-item');
		  }
	  );
	}
	
function prevNextKeys() {
	$(document).keydown(function(e) {
  	if(e.keyCode == 37) { // izq
        if($currentItem.prev().length){
    	showPreview( $currentItem.prev() );
		$currentItem = $currentItem.prev();
        }
        else{
            hidePreview();
        }
  	}
  	if(e.keyCode == 39) { // der
        if($currentItem.next().length){
    	showPreview( $currentItem.next() );
		$currentItem = $currentItem.next();
        }
        else{
            hidePreview();
        }
  	}
	});
	}
	
function prevNextBtn() {

    $(document).on('click', '.prevLnk', function() {
        if($currentItem.prev().length){
    	showPreview( $currentItem.prev() );
        $currentItem = $currentItem.prev();
        }
        else{
            hidePreview();
        }
        return false;
		});


    $(document).on('click', '.nextLnk', function() {
        if($currentItem.next().length){
    	showPreview( $currentItem.next() );
       $currentItem = $currentItem.next();
        }
        else{
            hidePreview();
        }
        return false;
	});
	}
	
	

	function getWinSize() {
		winsize = { width : $window.width(), height : $window.height() };
	}

	function showPreview( $item ) {
// EDITED 
		if ( window.innerWidth < MOBILE_SCREEN_RESOLUTION ) {
			return;
		}

		var preview = $.data( this, 'preview' ),
			// item´s offset top
			position = $item.data( 'offsetTop' );

		scrollExtra = 0;

		// if a preview exists and previewPos is different (different row) from item´s top then close it
		if( typeof preview != 'undefined' ) {
			// not in the same row
			if( previewPos !== position ) {
				hidePreview();
			}
			// same row
			else {
				preview.update( $item );
				return false;
			}
			
		}

		// update previewPos
		previewPos = position;
		// initialize new preview for the clicked item
		preview = $.data( this, 'preview', new Preview( $item ) );
		// expand preview overlay
        
                                        
        // $('#nav-header').removeClass('nav-up').addClass('nav-down'); 
        
		preview.open();

        
        var abc = $('#topmenud').width();  
        var cba = $(window).width();
        var ccc = $( ".og-close" ).width()
      
        var resLeft = (abc + ( ((cba-abc)/2) )) - (ccc+8);
        var resRight = ( ((cba-abc)/2) );
        
        $( ".og-close" ).css('left',resLeft);
        $( ".prevLnk" ).css('right',resLeft);
        $( ".nextLnk" ).css('right',resRight);
        
        

	}

	function hidePreview() {
		current = -1;
		var preview = $.data( this, 'preview' );
		preview.close();
		$.removeData( this, 'preview' );
	}

// EDITED
	window.hidePreview = hidePreview;

	// the preview obj / overlay
	function Preview( $item ) {
		this.$item = $item;
		this.expandedIdx = this.$item.index();
		this.create();
		this.update();
	}
	
	
  var is_cursor_changed = false;
  var is_left;

	Preview.prototype = {
		create : function() {
			// create Preview structure:
			this.$parent_perma = $( '' );
			
			this.$title = $( '<p></p>' );
			this.$description = $( '<p></p>' );
			
			this.$li2 = $( '<a href="#" class="prevLnk">&laquo;</a>' );
			this.$li3 = $( '<a href="#" class="nextLnk">&raquo;</a>' );
            this.$lnkLoveTxt = $('<p id="xpgalLnk">Powered by <a href="http://dev.hey.uy/xpand-gallery-for-wordpress/" target="_blank">Xpand Gallery</a></p>');

			this.$details = $( '<div class="og-details"></div>' ).append( this.$title, this.$description, this.$lista );
			this.$loading = $( '<div class="og-loading"></div>' );
			this.$fullimage = $( '<div class="og-fullimg" style="height: '+ xpgalImgHeight +'px"></div>' ).append( this.$loading );
			this.$closePreview = $( '<span class="og-close"></span>' );
            if(linkLove){
                this.$previewInner = $( '<div class="og-expander-inner" tabindex="0"></div>' ).append( this.$closePreview, this.$fullimage, this.$lnkLoveTxt, this.$li2, this.$li3 );
            } else{
                this.$previewInner = $( '<div class="og-expander-inner" tabindex="0"></div>' ).append( this.$closePreview, this.$fullimage, this.$li2, this.$li3 );
            }

			this.$previewEl = $( '<div class="og-expander"></div>' ).append( this.$previewInner );
			// append preview element to the item
			this.$item.append( this.getEl() );
			// set the transitions for the preview and the item
			if( support ) {
				this.setTransition();
			}
		},
		update : function( $item ) {


			
			if( $item ) {
				this.$item = $item;
			}
			
			/*this.$item.children('div').remove(this.$item.children('div').children('span');
			var span = $('<span />').attr('class', 'addPdf');
			span.attr('onclick','setUnsetButton(this)');
			span.css('display','block');
			span.css('opacity','1');*/
			//this.$item.children('div').append(span);
			
			// if already expanded remove class "og-expanded" from current item and add it to new item
			if( current !== -1 ) {
				var $currentItem = $items.eq( current );
				$currentItem.removeClass( 'og-expanded' );
				this.$item.addClass( 'og-expanded' );
				// position the preview correctly
				this.positionPreview();
			}

			// update current value
			current = this.$item.index();

			// update preview´s content
			var $itemEl = this.$item.children( 'a' ),
				eldata = {
					href : $itemEl.attr( 'href' ),
					largesrc : $itemEl.data( 'largesrc' ),
					title : $itemEl.data( 'title' ),
					description : $itemEl.data( 'description' )
				};

			this.$title.html( eldata.title );
			this.$description.html( eldata.description );
			
			//rescatamos solo el basename de la url (el permalink sin la url)
			var $test1;
			$test1 = this.$item.children('a').attr('data-permalink');
			
			//extraemos de la url completa, solo el nombre del archivo
			var $url_completa = this.$item.children('a').attr('data-largesrc');
			var $filename = $url_completa.substring($url_completa.lastIndexOf('/')+1);

			var self = this;
			
			// remove the current image in the preview
			if( typeof self.$largeImg != 'undefined' ) {
				self.$largeImg.remove();
			}

			// preload large image and add it to the preview
			// for smaller screens we don´t display the large image (the media query will hide the fullimage wrapper)
			if( self.$fullimage.is( ':visible' ) ) {
				this.$loading.show();
				$( '<img/>' ).load( function() {
					var $img = $( this );
					
					if( $img.attr( 'src' ) === self.$item.children('a').data( 'largesrc' ) ) {
						self.$loading.hide();
						self.$fullimage.find( 'img' ).remove();
						self.$largeImg = $img.fadeIn( 350 );
						self.$fullimage.append( self.$largeImg );
					}
				} ).attr( 'src', eldata.largesrc );	
			}

		},
		open : function() {
			window.IS_PREVIEW_SHOWN = true;

			this.$item.css( 'position', 'static' );

			/*var span = $('<span />').attr('class', 'addPdf');
			span.attr('onclick','setUnsetButton(this)');
			span.css('display','block');
			span.css('opacity','1');
			this.$item.children('div').append(span);
			*/
			setTimeout( $.proxy( function() {	
				// set the height for the preview and the item
				this.setHeights();
				// scroll to position the preview in the right place
				this.positionPreview();
			}, this ), 25 );

      $(".og-fullimg").on("click", this.imageClickListener);

      $(".og-fullimg").on("mousemove", this.imageMoveListener);

		},

    imageClickListener: function (e) {
      if ( e.clientX < window.innerWidth / 2 ) {
        if($currentItem.prev().length){
          showPreview( $currentItem.prev() );
          $currentItem = $currentItem.prev();
        }
        else{
          hidePreview();
        }
      }
      else {
        if($currentItem.next().length){
          showPreview( $currentItem.next() );
          $currentItem = $currentItem.next();
        }
        else{
          hidePreview();
        }
      }
    },

    imageMoveListener: function (e) {
      if ( typeof is_left === "undefined" ) {
        is_left = e.clientX > window.innerWidth / 2
      }

      if ( e.clientX > window.innerWidth / 2 ) {
        if ( is_left ) {
          is_left = false;
          is_cursor_changed = true;
        }
      }
      else {
        if ( !is_left ) {
          is_left = true;
          is_cursor_changed = true;
        }
      }

      if ( is_cursor_changed ) {
        if ( is_left ) {
          $(".og-fullimg").removeClass("right-cursor");
        }
        else {
          $(".og-fullimg").addClass("right-cursor");
        }
      }
    },

		close : function() {
			window.IS_PREVIEW_SHOWN = false;
			
			this.$item.css( 'position', 'relative' );
			var self = this,
				onEndFn = function() {
					if( support ) {
						$( this ).off( transEndEventName );
					}
					self.$item.removeClass( 'og-expanded' );
					self.$previewEl.remove();
				};

			setTimeout( $.proxy( function() {

				if( typeof this.$largeImg !== 'undefined' ) {
					this.$largeImg.fadeOut( 'fast' );
				}
				this.$previewEl.css( 'height', 0 );
				// the current expanded item (might be different from this.$item)
				var $expandedItem = $items.eq( this.expandedIdx );
				$expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );

				if( !support ) {
					onEndFn.call();
				}

			}, this ), 25 );

      $(".og-fullimg").unbind("click", this.imageClickListener);
      $(".og-fullimg").unbind("mousemove", this.imageMoveListener);
			
			return false;

		},
		calcHeight : function() {

			var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,
				itemHeight = winsize.height;

			if( heightPreview < settings.minHeight ) {
				heightPreview = settings.minHeight;
				itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
			}


			//obligamos a la altura a ser la que queramos tanto del preview (el fondo oscuro) como la altura del item (miniatura):
			heightPreview = settings.minHeight;
			itemHeight = settings.minHeight + this.$item.data( 'height' ) - marginExpanded;
			//end dani
			
			
			this.height = heightPreview; /* EDITED */
			this.itemHeight = itemHeight+150;

		},
		setHeights : function() {

			var self = this,
				onEndFn = function() {
					if( support ) {
						self.$item.off( transEndEventName );
					}
					self.$item.addClass( 'og-expanded' );
				};			
			this.calcHeight();
			this.$previewEl.css( 'height', this.height ); // div1			
			this.$item.css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );

			if( !support ) {
				onEndFn.call();
			}
				
			//Vahe code // overriding variables 					
			//preview struct
				// LI
				// -> a href 	// main image
				// -> div1		// preview image
				// -> -> div11
				// -> -> -> span // close preview button
				// -> -> -> div 111 // preview image
				// -> -> -> -> div 1111 // loading div
				// -> -> -> -> image    // preview image							
			getWinSize();
		    var ignoreNavBar = false;
			
			var marginSize = 70;
			var freeSpace = ignoreNavBar?winsize.height:winsize.height- $('#nav-header').outerHeight()-marginSize;
			
			var picRealHeight = this.$previewEl.children('div').eq(0).children('div').eq(0).children('img').eq(0).height(); //850
			var mainPicHeight = this.$previewEl.parent().children('a').eq(0).children('img').eq(0).height();  //300
			if (picRealHeight<500) picRealHeight = 850;
			if (mainPicHeight<295) mainPicHeight = 300;
			if (freeSpace < mainPicHeight+marginSize) // preview will never be smaller than main pic
				freeSpace = mainPicHeight+marginSize;
			if (freeSpace > picRealHeight + marginSize)
				freeSpace = picRealHeight + marginSize;
			
			this.$previewEl.parent().css( 'height', freeSpace + mainPicHeight+marginSize ); // LI 
			this.$previewEl.css( 'height', freeSpace+marginSize ); // div1			
			this.$previewEl.children('div').eq(0).children('div').eq(0).css( 'height', freeSpace  ); // div 111 // -50 margins
			//Vahe code		
			
		},
		positionPreview : function() {

			// scroll page
			// case 1 : preview height + item height fits in window´s height
			// case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
			// case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
            var ignoreNavBar = false;
            getWinSize();
            var navHeigth = $('#nav-header').outerHeight();
			var position = this.$item.data( 'offsetTop' ) - navHeigth,

				previewOffsetT = this.$previewEl.offset().top - scrollExtra;
				//var scrollVal = this.height + navHeigth + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;
				var scrollVal = ignoreNavBar?previewOffsetT+1:previewOffsetT+1-$('#nav-header').outerHeight() ;//Vahe code// always scroll bottom to bottom of preview image
//            $('html, body').animate( { scrollTop : scrollVal }, settings.speed );
            
// EDITED 
            var self = this;
            window.is_preview_opening = true;
            $('#nav-header').removeClass('nav-up').addClass('nav-down');
            
            $('html, body')
              .finish()
              .clearQueue()
              .animate( { scrollTop : scrollVal }, settings.speed, function() {
                clearTimeout(self.doit);
                self.doit = setTimeout(function(){
                  window.is_preview_opening = false;
                }, settings.speed);
              });


		},
		setTransition  : function() {
			this.$previewEl.css( 'transition', 'height ' + 0 + 'ms ' + settings.easing );
			this.$item.css( 'transition', 'height ' + 0 + 'ms ' + settings.easing );
		},
		getEl : function() {
			return this.$previewEl;
		}
		,
		setFreeSpace : function() {
			
		}
	}

	return { 
		init : init,
		addItems : addItems
	};

})();
})(jQuery);