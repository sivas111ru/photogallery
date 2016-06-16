jQuery(document).ready(function ($) {
    var drawMenuLines = function () {
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
})
