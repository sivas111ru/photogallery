jQuery(document).ready(function ($) {
    var resizeImages = function () {
        var lastElement = false;
        var element_on_row = 0;
        var prevElement = null;     
        $('#og-grid > li').each(function () {

            if (lastElement && lastElement.offset().top != $(this).offset().top) {
                /*console.log($(this).children().eq(0).children().eq(0).offsetParent().width());*/
                element_on_row = 0;
                prevElement = null;
            }
            element_on_row++;

            lastElement = $(this);
            prevElement = $(this);
           /* console.log($(this).children().eq(0).children().eq(0));*/
            resizeGridImages($(this),prevElement);
        })
    };

    resizeImages();
    $(window).on("resize", resizeImages);
    $(window).on("resize", setTimeout(resizeImages,100));
    
    function resizeGridImages(current, prev) {
        $('#site-navigation').css('max-width', $('#og-grid').width()*0.98); /* F2 */
        
        /* BUTTON smMenu pos */
        var abc = $('#topmenud').width();  
        var cba = $(window).width();
        var ccc = $( "#smMenuBtn" ).width()
      
        var resLeft = (abc + ( ((cba-abc)/2) )) - ccc;
        var resRight = ( ((cba-abc)/2) );
        

        $( "#smMenuBtn" ).css('left',resLeft);
        /* BUTTON smMenu pos end */
        
        
        console.log($('#og-grid').width());

        if ((current.children().eq(0).children().eq(0).offsetParent().width() && prev.children().eq(0).children().eq(0).offsetParent().width()) == 225) {
            current.children().eq(0).children().eq(0).css("width", 226.5);
            prev.children().eq(0).children().eq(0).css("width", 226.5); // 463 / 2 - 2.5   ||  large/2 - (border/2)
        }
    }


})