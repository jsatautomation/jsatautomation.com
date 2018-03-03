jQuery(document).ready(function($) {
    /*if ($(window).width() > 768) {
        $('.nav li.dropdown').hover(function() {
            $(this).addClass('open');
        }, function() {
            $(this).removeClass('open');
        });
        $('.nav li.dropdown-menu').hover(function() {
            $(this).addClass('open');
        }, function() {
            $(this).removeClass('open');
        });
    }*/

    $('.nav li.dropdown').find('.caret').each(function() {
        $(this).on('click', function() {
            if ($(window).width() < 768) {
                $(this).parent().next().slideToggle();
            }
            return false;
        });
    });


    $(window).scroll(function() {
        if ($(window).width() > 768) {
            if ($(this).scrollTop() > 100) {
                $('header').addClass('sticky-head');
            } else {
                $('header').removeClass('sticky-head');
            }
        } else {
            if ($(this).scrollTop() > 100) {
                $('header').addClass('sticky-head');
            } else {
                $('header').removeClass('sticky-head');
            }
        }
    });

    /* Slider */

    var swiper = new Swiper('.home-swiper', {
        pagination: '.swiper-pagination',
        effect: 'flip',
        grabCursor: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay:false,
        loop: true,
    });

    
    /* Clients */
    var swiper = new Swiper('.home-clients', {
        loop: true,
        autoplay: 2500,
        spaceBetween: 10,
        slidesPerView: '4',
        nextButton: '.client-next',
        prevButton: '.client-prev',
    });
    /* Clients */

});
new WOW().init();

jQuery(document).ready(function($) {
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#masthead').outerHeight();

    $(window).scroll(function(event) {
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('#masthead').removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('#masthead').removeClass('nav-up').addClass('nav-down');
            }
        }

        lastScrollTop = st;
    }


});


(function($) {
    /* Lignt Box*/
    var gallery = $('.w_blogs .ec-right').simpleLightbox();
    var gallery = $('.bp-home-blog .bp-right').simpleLightbox();
    var gallery = $('.bp-home-portfolio .port-show').simpleLightbox();
    
    
})(jQuery);
