// jQuery(window).scroll(function() {
//     if (jQuery(this).scrollTop() > 200) {
//         jQuery( ".sticky-back" ).fadeIn();
//     } else {
//         console.log('there');
//         jQuery( ".sticky-back" ).fadeOut();
//     }
// });

// jQuery(window).bind("scroll", function() {
//     if (jQuery(this).scrollTop() > 200) {
//         jQuery(".sticky-nav").fadeIn();
//     } else {
//         jQuery(".sticky-nav").stop().fadeOut();
//     }
// });

// var divs = jQuery('.sticky-nav');
jQuery(window).scroll(function(){



   var amountScrolled = jQuery(window).scrollTop(),
       headerHeight = jQuery(".site-header").height(),
       stickyHolderHeight = jQuery(".sticky-holder").height(),
       changePoint = headerHeight-stickyHolderHeight,
       martop = 32 + amountScrolled;
    
    if (jQuery('body').hasClass('admin-bar')) {
      changePoint = changePoint+32;
    }

   console.log(
      "Px from top: "+amountScrolled,
      "Header Height: "+headerHeight,
      "Sticky Holder Height: "+stickyHolderHeight,
      "Background Showing: "+(headerHeight-amountScrolled),
      "Change Point: "+changePoint,
      "New Margin Top: "+martop+"px !important"
      );

   if(jQuery(window).scrollTop()<changePoint){
         jQuery('.sticky-holder-one').css("background","transparent");
   } else {
         jQuery('.sticky-holder-one').css("background","#262466");
   }

   if(jQuery(window).scrollTop()>changePoint){
         jQuery('.auto-brands').css("top",amountScrolled-changePoint);
         jQuery('.auto-brands').css("z-index","200");
   }
   else if(jQuery(window).scrollTop()<changePoint) {
         jQuery('.auto-brands').css("top","0px");
   }
});