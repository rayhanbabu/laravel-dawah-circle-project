(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
    });



    $(document).ready(function(){
        $('.courses-carousel').owlCarousel({
          loop: true,
          margin: 30,  // Adjust space between items
          nav: true,   // Show next/prev buttons
          dots: true,  // Show navigation dots
          autoplay: true,
          autoplayTimeout: 5000,
          responsive: {
            0: {
              items: 1  // 1 item on small screens
            },
            768: {
              items: 2  // 2 items on medium screens (e.g., tablets)
            },
            1024: {
              items: 3  // 3 items on larger screens
            }
          }
        });
      });
      

    
})(jQuery);

