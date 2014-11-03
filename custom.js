/*  ---------------------------------------------------------------------------------------------------------------------------------------------------
#
#    Accordion js for auto services sub pages
#
*/

jQuery(function() {
  jQuery( ".accordion" ).accordion({
    collapsible: true,
    heightStyle: "content"
  });
});

/*  ---------------------------------------------------------------------------------------------------------------------------------------------------
#
#    Home page slider code
#
*/

jQuery(document).ready(function ($) {
  if (jQuery('body').hasClass('home')) {
    var _CaptionTransitions = [];
    _CaptionTransitions["L"] = { $Duration: 900, x: 0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
    _CaptionTransitions["R"] = { $Duration: 900, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
    _CaptionTransitions["T"] = { $Duration: 900, y: 0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
    _CaptionTransitions["B"] = { $Duration: 900, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutSine }, $Opacity: 2 };
    _CaptionTransitions["ZMF|10"] = { $Duration: 900, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 };
    _CaptionTransitions["RTT|10"] = { $Duration: 900, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseOutQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} };
    _CaptionTransitions["RTT|2"] = { $Duration: 900, $Zoom: 3, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInQuad }, $Opacity: 2, $Round: { $Rotate: 0.5} };
    _CaptionTransitions["RTTL|BR"] = { $Duration: 900, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} };
    _CaptionTransitions["CLIP|LR"] = { $Duration: 900, $Clip: 15, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic }, $Opacity: 2 };
    _CaptionTransitions["MCLIP|L"] = { $Duration: 900, $Clip: 1, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };
    _CaptionTransitions["MCLIP|R"] = { $Duration: 900, $Clip: 2, $Move: true, $Easing: { $Clip: $JssorEasing$.$EaseInOutCubic} };

    var options = {
        $FillMode: 2,                                       //[Optional] The way to fill image in slide, 0 stretch, 1 contain (keep aspect ratio and put all inside slide), 2 cover (keep aspect ratio and cover whole slide), 4 actual size, 5 contain for large image, actual size for small image, default value is 0
        $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
        $AutoPlayInterval: 10000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
        $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

        $ArrowKeyNavigation: true,                    //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
        $SlideEasing: $JssorEasing$.$EaseOutQuint,          //[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
        $SlideDuration: 1000,                               //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
        $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
        // $SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
        $SlideHeight: 400,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
        $SlideSpacing: 0,                           //[Optional] Space between each slide in pixels, default value is 0
        $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
        $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
        $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
        $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
        $DragOrientation: 1,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

        $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
            $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
            $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
            $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
            $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
        },

        $BulletNavigatorOptions: {                          //[Optional] Options to specify and enable navigator or not
            $Class: $JssorBulletNavigator$,                 //[Required] Class to create navigator instance
            $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
            $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
            $SpacingX: 8,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
            $SpacingY: 8,                                   //[Optional] Vertical space between each item in pixel, default value is 0
            $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
        },

        $ArrowNavigatorOptions: {                           //[Optional] Options to specify and enable arrow navigator or not
            $Class: $JssorArrowNavigator$,                  //[Requried] Class to create arrow navigator instance
            $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
            $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
            $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
        }
    };

    var jssor_slider1 = new $JssorSlider$("slider1_container", options);

    //responsive code begin
    //you can remove responsive code if you don't want the slider scales while window resizes
    function ScaleSlider() {
        var bodyWidth = document.body.clientWidth;
        if (bodyWidth)
            jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 1920));
        else
            window.setTimeout(ScaleSlider, 30);
    }

    ScaleSlider();

    if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
        $(window).bind('resize', ScaleSlider);
    }


    if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
       $(window).bind("orientationchange", ScaleSlider);
    }
  }
  //responsive code end
});

/*  ---------------------------------------------------------------------------------------------------------------------------------------------------
#
#    LAND OF DEAD CODE
#
*/
/*
#
#   Sticky Header Function
#   - Add background color to override image after certain scroll point
#
#   - ONLY WORKS ON HOME PAGE (WHEN BODY HAS CLASS .home)
*/


  // jQuery(window).scroll(function(){
  //   if (jQuery('body').hasClass('home')) {
      //create Variables
      // var amountScrolled = jQuery(window).scrollTop(),
      //   headerHeight = jQuery(".site-header").height(),
      //   stickyHolderHeight = jQuery(".sticky-holder").height(),
      //   hgroupHeight = jQuery(".hgroup").height(),
      //   changePoint = headerHeight-stickyHolderHeight;//the change point is the point where we add the background color

      //if the user is logged in and can see the admin bar we need to account for that, we add the height of the admin bar to the change point
      // if (jQuery('body').hasClass('admin-bar')) {
      //   adminBarHeight = jQuery("#wpadminbar").height();
      //   changePoint = changePoint + adminBarHeight;
      // }

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
      //if(jQuery(window).scrollTop()<changePoint){
        //jQuery('.sticky-holder-one').css("background","transparent");
      //} else {
        //jQuery('.sticky-holder-one').toggle("#043789");
        //jQuery('.sticky-holder-one').css("background","#043789");
        //jQuery('.sticky-holder-one').effect("highlight", {}, 3000)
      //}


      //if we hit the breakpoint add top margin and z-index to the autobrands div
      // if(jQuery(window).scrollTop()>changePoint){
      //   jQuery('.auto-brands').css("top",amountScrolled-changePoint);
      //   jQuery('.auto-brands').css("z-index","198");
      // }
      // else if(jQuery(window).scrollTop()<changePoint) {
      //   jQuery('.auto-brands').css("top","0px");
      // }
  //   }
  // });

/*
#
#   Background image function
#   http://stackoverflow.com/questions/25342830/remove-white-flash-effect-when-fading-background-images-jquery
#
#   - ONLY WORKS ON HOME PAGE (WHEN BODY HAS CLASS .home)
*/

// jQuery(window).load(function () {
// $(document).ready(function(){})


// var bkimgFunction = jQuery(document).ready(function(){//jQuery(window).load(function () {
//   if (jQuery('body').hasClass('home')) {
//     var i = 0;
//     var images = [
//      'http://europeanmotorsservicecenter.petelower.com//wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/background-front-2500w-800h.jpg',
//      'http://europeanmotorsservicecenter.petelower.com//wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/background-front-2500w-400h.jpg',
//      'http://europeanmotorsservicecenter.petelower.com//wp-content/themes/twentytwelve-europeanmotorsservicecenter/img/background-front-2500w-1000h.jpg',
//         // 'http://dummyimage.com/2500x400/FC0/000&text=Slide+2',
//         // 'http://dummyimage.com/2500x400/CF0/000&text=Slide+3',
//         'http://dummyimage.com/2500x400/0FC/000&text=Slide+4'];
//     jQuery('#backgroundimage').css('background-image', 'url(' + images[i] + ')');
//     setInterval(function () {
//         if (++i === images.length) {
//             i = 0;//reset index
//         }
//         console.log(i);
//         jQuery('#nextimg').css('background-image', 'url(' + images[i] + ')');//load bkimg into 'on deck' div
//         // transition animation of 3 seconds then perform the function to set the bkimg of the bkimg holder div to same as 'on deck' div
//         jQuery('#backgroundimage').fadeOut(3000, function () {
//             jQuery('#backgroundimage').css('background-image', 'url(' + images[i] + ')').show();
//         });
//         // slide change: 9s
//     }, 9000);
//   }

//   var n = 0;
//   jQuery( "#masthead" )
//   .mouseenter(function() {
//     jQuery( "#bkimg-nav-button-container" ).css( "margin-top","-100px" );
//   })
//   .mouseleave(function() {
//     jQuery( "#bkimg-nav-button-container" ).css( "margin-top","0" );
//   });
// });


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
