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

jQuery(window).load(function() {
  var i =0;
  var images = ['http://lowermedia.net/europeanmotors/wp-content/blog.dir/sites/44/2014/08/european-motors-auto-service-center-tacoma-seattle-washington-fix-my-car.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0090.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0127-3.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0137-2.jpg'];
  var image = jQuery('.home .site-header');
  
  //Initial Background image setup
  image.css('background-image', 'url(http://midamericacartell.com/wp-content/blog.dir/sites/37/2014/07/Rally-to-Starved-Rock.jpg)');
  
  //Change image at regular intervals
  setInterval(function(){
   image.animate('slow', function () {
    image.css('background-image', 'url(' + images [i++] +')');
    image.animate('fast','swing');
   });
   if(i == images.length)
    i = 0;
  }, 5000);

});
