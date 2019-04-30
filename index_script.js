'use strict';
function slowScroll(id) {
    $('html').animate({
        scrollTop: $(id).offset().top
    }, 500);
}

$(document).on("scroll", function (){
    if($(window).scrollTop() === 0){
        $("header").removeClass("fixed");
    }
    else{
        $("header").attr("class", "fixed");
    }
});

