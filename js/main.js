(function($){
    
    homeSlider = $('#home-blog-slider');
    
    if(homeSlider.length)
    {
        $('#home-blog-slider .owl-carousel').owlCarousel({
            loop:true,
            margin:30,
            nav:true,
            navText:false,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            responsive:{
                0:{
                    items:1
                },
                767:{
                    items:2
                },
                992:{
                    items:2
                },
                1200:{
                    items:3
                }
            }
        });
    }
    
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        navText:false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            767:{
                items:2
            },
            992:{
                items:2
            },
            1200:{
                items:3
            }
        }
    });
    
})(jQuery);