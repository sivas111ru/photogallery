jQuery(document).ready(function ($) {
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
		if (minLeft == 10000 || maxWidthPlusLeft == 0)
		{
			$('#topmenud').css('left', 23);  // KASTIL
			$('#topmenud').css('width', '100%');	// KASTIL
		}
		else
		{
			var panelWidth = maxWidthPlusLeft - minLeft;
			$('#topmenud').css('left',minLeft-23);  // KASTIL
			$('#topmenud').css('width',panelWidth+23);	// KASTIL
            $( "#smMenuBtn" ).css('left',panelWidth-23); // NORM KASTIL
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

    $(window).on("resize", drawMenuLines);
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
