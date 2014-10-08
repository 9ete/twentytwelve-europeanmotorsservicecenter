
/*
#
#   Sticky Header Function
#   - Add background color to overide image after certain scroll point
#
#   - ONLY WORKS ON HOME PAGE (WHEN BODY HAS CLASS .home)
*/

  jQuery(window).scroll(function(){
    if (jQuery('body').hasClass('home')) {
      //create Variables
      var amountScrolled = jQuery(window).scrollTop(),
        headerHeight = jQuery(".site-header").height(),
        stickyHolderHeight = jQuery(".sticky-holder").height(),
        changePoint = headerHeight-stickyHolderHeight;//the change point is the point where we add the background color

      //if the user is logged in and can see the admin bar we need to account for that, we add the height of the admin bar to the change point
      if (jQuery('body').hasClass('admin-bar')) {
        adminBarHeight = jQuery("#wpadminbar").height();
        changePoint = changePoint + adminBarHeight;
      }

      //DEBUG OUTPUT
      // console.log(
      //    "Px from top: "+amountScrolled,
      //    "Header Height: "+headerHeight,
      //    "Sticky Holder Height: "+stickyHolderHeight,
      //    "Background Showing: "+(headerHeight-amountScrolled),
      //    "Change Point: "+changePoint,
      //    adminBarHeight = jQuery(".admin-bar").height()
      //    );

      //toggle background image and color
      if(jQuery(window).scrollTop()<changePoint){
        jQuery('.sticky-holder-one').css("background","transparent");
      } else {
        //jQuery('.sticky-holder-one').toggle("#043789");
        jQuery('.sticky-holder-one').css("background","#043789");
        //jQuery('.sticky-holder-one').effect("highlight", {}, 3000)
      }


      //if we hit the breakpoint add top margin and z-index to the autobrands div
      if(jQuery(window).scrollTop()>changePoint){
        jQuery('.auto-brands').css("top",amountScrolled-changePoint);
        jQuery('.auto-brands').css("z-index","198");
      }
      else if(jQuery(window).scrollTop()<changePoint) {
        jQuery('.auto-brands').css("top","0px");
      }
    }
  });

/*
#
#   Background image function
#   http://stackoverflow.com/questions/25342830/remove-white-flash-effect-when-fading-background-images-jquery
#
#   - ONLY WORKS ON HOME PAGE (WHEN BODY HAS CLASS .home)
*/

//jQuery(window).load(function () {
//$(document).ready(function(){})
var bkimgFunction = jQuery(document).ready(function(){//jQuery(window).load(function () {
  if (jQuery('body').hasClass('home')) {
    var i = 0;
    var images = [
        // 'http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/fix-my-bmw-seattle-tacoma-lakewood-washington-jaquar-audi-mercedes.png',
        // 'http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/10/fix-my-audi-seattle-tacoma-lakewood-washington-jaquar-audi-mercedes.png',
        'http://dummyimage.com/1400x660/FC0/000&text=Slide+1',
        'http://dummyimage.com/1400x660/CF0/000&text=Slide+2',
        'http://dummyimage.com/1400x660/0FC/000&text=Slide+3'];
        // var  images = ['http://lowermedia.net/europeanmotors/wp-content/blog.dir/sites/44/2014/08/european-motors-auto-service-center-tacoma-seattle-washington-fix-my-car.jpg',
        //             'http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0090.jpg',
        //             'http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0127-3.jpg',
        //             'http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/fix-my-bmw-tacoma-seattle-washington-audi.jpg'];
    jQuery('#backgroundimage').css('background-image', 'url(' + images[i] + ')');
    setInterval(function () {
        if (++i === images.length) {
            i = 0;//reset index
        }
        console.log(i);
        jQuery('#nextimg').css('background-image', 'url(' + images[i] + ')');//load bkimg into 'on deck' div
        // transition animation of 3 seconds then perform the function to set the bkimg of the bkimg holder div to same as 'on deck' div
        jQuery('#backgroundimage').fadeOut(3000, function () {
            jQuery('#backgroundimage').css('background-image', 'url(' + images[i] + ')').show();
        });
        // slide change: 9s
    }, 9000);
  }

  var n = 0;
  jQuery( "#masthead" )
  .mouseenter(function() {
    jQuery( "#bkimg-nav-button-container" ).css( "margin-top","-100px" );
  })
  .mouseleave(function() {
    jQuery( "#bkimg-nav-button-container" ).css( "margin-top","0" );
  });
});



/*
#
#    LAND OF DEAD CODE
#
*/

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

/*
#
#
#   Background image rotator function
#   - 
#
#
*/

  // jQuery(window).load(function() {
  //   var i =0;
  //   var images = ['http://lowermedia.net/europeanmotors/wp-content/blog.dir/sites/44/2014/08/european-motors-auto-service-center-tacoma-seattle-washington-fix-my-car.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0090.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/IMG_0127-3.jpg','http://europeanmotorsservicecenter.petelower.com/wp-content/uploads/2014/09/fix-my-bmw-tacoma-seattle-washington-audi.jpg'];
  //   var image = jQuery('.home .site-header');
    
  //   //Initial Background image setup
  //   image.css('background-image', 'url(http://midamericacartell.com/wp-content/blog.dir/sites/37/2014/07/Rally-to-Starved-Rock.jpg)');
    
  //   //Change image at regular intervals
  //   setInterval(function(){
  //    image.animate('fast', function () {
  //     image.css('background-image', 'url(' + images [i++] +')');
  //     image.animate('fast','swing');
  //    });
  //    if(i == images.length)
  //     i = 0;
  //   }, 10000);
  // });


/*
#
#
#   Toggle Class Function
#   - 
#
#
*/

  // setInterval(function(){
  //    // toggle the class every five second
  //    jQuery('.home .site-header').toggleClass('wiggle');
  //    setTimeout(function(){
  //      // toggle back after 1 second
  //      jQuery('.home .site-header').toggleClass('wiggle');
  //    },1000);

  // },5000);
