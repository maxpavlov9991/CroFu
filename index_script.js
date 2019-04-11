'use strict';

$(document).on("scroll", function (){
    if($(window).scrollTop() === 0){
        $("header").removeClass("fixed");
    }
    else{
        $("header").attr("class", "fixed");
    }
});

