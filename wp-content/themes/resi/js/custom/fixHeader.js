jQuery(document).ready(function ($) {
	
	var $header = $("#nav-header");
    var $header_space = $("#masthead");
    var fixHeaderHeight = function() {
        $header_space.height($header.outerHeight(true));
    }

    fixHeaderHeight();

    var drawMenuLines = function () {
		var minLeft = 10000;
		var maxWidthPlusLeft = 0;
		var maxWidth = 0;
		$('#og-grid > li').each(function () {
			if ($(this).children('a').offset().left < minLeft)
			{
				minLeft = $(this).children('a').offset().left;			
			}			
			if ($(this).children('a').offset().left + $(this).children('a').width() > maxWidthPlusLeft)
			{
				maxWidthPlusLeft = $(this).children('a').offset().left + $(this).children('a').width();			
			}
        })
		var winWidth = $(window).width();
		
		if (minLeft == 10000 || maxWidthPlusLeft == 0)
		{
			if (winWidth>1500)
			{
				minLeft = (winWidth - 1460)/2;
				maxWidthPlusLeft = minLeft+1460;
			}
		}
		
		if (minLeft == 10000 || maxWidthPlusLeft == 0)
		{
					$('#topmenud').css('left', '10%');  // KASTIL
					$('#topmenud').css('width', '80%');	// KASTIL
					$( "#smMenuBtn" ).css('left','80%'); // NORM KASTIL	
					//$( "#staticCounterDivId" ).css('left',panelWidth-23-25); 
		}
		else
		{
			var panelWidth = maxWidthPlusLeft - minLeft;
			$('#topmenud').css('left',minLeft-23);  // KASTIL
			$('#topmenud').css('width',panelWidth+23);	// KASTIL
            $( "#smMenuBtn" ).css('left',panelWidth-23); // NORM KASTIL	

				if ($("#staticCounterDivId").lenth==0);
				{
					$('<div />', {
					class: 'staticCounter',
					id: 'staticCounterDivId',
					onclick:"location.href='../pdf/pdf.html'"
				}).appendTo("#site-navigation");
				}
				
			if ($(window).width()<500)
			{
				
				$( "#staticCounterDivId" ).css('left',panelWidth-23-25); 
				$( "#staticCounterDivId" ).css('top',55); 
			}
			else
			{
				$( "#staticCounterDivId" ).css('top',0); 
				$( "#staticCounterDivId" ).css('left',panelWidth-103); 
			}
			
			
		}
		
		
        var lastElement = false;
        $('#primary-menu > li').each(function () {
            if (lastElement) {
                lastElement.removeClass("noborder");
            }

            if (lastElement && lastElement.offset().top != $(this).offset().top) {
                lastElement.addClass("noborder");
            }
            /*      if (!$(this).has('ul').length)
                      lastElement = $(this);
                  else {
                      lastElement = false;
                  }*/
            lastElement = $(this);
        }).last().addClass("noborder");
    };

    drawMenuLines();

    $(window).on("resize", function() {
    	setTimeout(timedOutResizeListener, 1);
    });

    function timedOutResizeListener(e) {
    	drawMenuLines();
    	fixHeaderHeight();
    }
    // $(window).on("resize", setTimeout(drawMenuLines,100));
})



jQuery(document).ready(function ($) {
    var addClassNew = function () {
        var lastElement = false;
        $('#primary-menu > li').each(function () {

            var el = $(this).children().eq(0).children().eq(0);
            if ( (el.html() == "ABOUT") || (el.html() == "INSTAGRAM") || (el.html() == "IMPRINT"))
                {
                     $(this).children().eq(0).children().eq(0).addClass("lowercase");
                }
           })
    };





    addClassNew();



    $(window).on("resize", addClassNew);
})
