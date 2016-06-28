jQuery(document).ready(function ($) {
    var drawMenuLines = function () {
		var minLeft = 10000;
		var maxWidthPlusLeft = 0;
		var maxWidth = 0;
		$('#og-grid > li').each(function () {
			if ($(this).children().position().left < minLeft)
			{
				minLeft = $(this).children().position().left;
			}			
			if ($(this).children().position().left + $(this).children().width() > maxWidthPlusLeft)
			{
				maxWidthPlusLeft = $(this).children().position().left + $(this).children().width();
			}
        })
		var panelWidth = maxWidthPlusLeft - minLeft;
		$('#topmenud').css('left',minLeft-23);  // KASTIL
		$('#topmenud').css('width',panelWidth+23);	// KASTIL
		
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
    $(window).on("resize", setTimeout(drawMenuLines,100));
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
