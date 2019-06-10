/*
=================================================================
Developer front-end: Peterson Macedo
Developer back-end: Felipe Ribeiro
Date: 06/04/2018
Life Health
MEDrx [content-single-product]
=================================================================
*/

jQuery(document).ready(function($) {

    $(".pricing-selector li").on("click", function(e){
        $(".pricing-selector li").removeClass("selected");
        $(this).addClass("selected");
    })

});