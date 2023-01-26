(function($){
    "use strict";
    $(document).ready(function(){

        $(window).load(function() {

            // Preloader
            jQuery('#preloder').remove('#preloder');
            
            // WOW Active
            new WOW().init();
            
            // swiper
            var swiper = new Swiper('.special-dishes-container',{
                pagination: '.swiper-pagination',
                slidesPerView: 3,
                paginationClickable: true,
                spaceBetween: 30,
                nextButton: '.button-next',
                prevButton: '.button-prev',
                speed :800,
                breakpoints:{
                    990:{
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    768:{
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                  	640: {
                    	slidesPerView: 1,
                    	spaceBetween: 20,
                  },
                }
            });
            var swiper = new Swiper('.customer-review .swiper-container', {
                pagination: '.swiper-pagination',
                direction: 'vertical',
                slidesPerView: 1,
                paginationClickable: true,
                spaceBetween: 0,
                mousewheelControl: true,
                loop: true,
                height:180,
                autoHeight: true,
                speed :700,
                breakpoints:{
                    990: {
                        height:200,
                    },
                    640: {
                        height:230,
                    },
                    480: {
                        height:280,
                    },
                    360: {
                        height:390,
                    }
                }
            });
            var swiper = new Swiper('.special-event .swiper-container', {
                pagination: '.swiper-pagination',
                direction: 'vertical',
                slidesPerView: 1,
                paginationClickable: true,
                spaceBetween: 0,
                mousewheelControl: true,
                loop: true,
                height:400, 
                autoHeight: true,
                speed :900,
            });

        }); // Window Load

        //menu fixed sticky menu
        jQuery(window).on('scroll', function(){
            // Sticky Nav
            if ( jQuery(window).scrollTop() > 90 ) {
                jQuery('.main-nav').addClass('animated fadeInDown menu-fixed');
            } else {
                jQuery('.main-nav').removeClass('animated fadeInDown menu-fixed');
            }
        });

        // Book Button scroll
        jQuery('body').on('click', 'a.tp-caption, .book-table a', function() {
            var $this = jQuery(this),
            href = $this.attr('href');

            if(!href || href.charAt(0) !== '#') return;
            var el = jQuery(href);

            if(!el.length) el = jQuery('a[name=' + href.substring(1, href.length) + ']');
            if(!el.length) return;

            jQuery('html, body').animate({scrollTop: el.offset().top}, 1000);
            return false;
        });

        //scroll to top
        $(window).scroll(function() {
            if ($(this).scrollTop() > 900) {
                $('.scroll-top').fadeIn(1000);
            } else {
                $('.scroll-top').fadeOut(1000);
            }
        }); 
        $('.scroll-top').click(function(){
            $("html,body").animate({ scrollTop: 0 }, 2000);
            return false;
        });

        //search bar
        $('.search-area i').click(function(){
            $(".search-area").toggleClass("search-form-open");
        })
        $('.search-box .search-btn').click(function(){
            $(".search-box").toggleClass("search-form-open");
        })

        //Add arrow before submenu
        $(function() {
            $('.sub-menu a').each(function() {
                if ( $(this).parent('li').size() > 0 ) {
                    $(this).prepend('<i class="fa fa-angle-double-right" aria-hidden="true"></i>');
                }           
            });
        });

        //for mobile menu 
        $('.navbar-toggle').on('click', function(e) {
            $('body').addClass('open-mobile-menu')
        });

        $('.close-btn').on('click', function(e) {
            $('body').removeClass('open-mobile-menu')
        });

        $('.mobile-menu>ul>li>a,.mobile-menu ul.mobile-submenu>li>a').on('click', function(e) {
            var element = $(this).parent('li');

            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(1500,"swing");
            }
            else {
                element.addClass('open');
                element.children('ul').slideDown(1500,"swing");
                element.siblings('li').children('ul').slideUp(1500,"swing");
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(1500,"swing");
            }        
        }); 

        //Drop Duwn menu fixed from right depth
        $(".dropdown").mouseover(function(){ 
            if($(this).children('ul').length == 1) {

                var parent = $(this);
                var child_menu = $(this).children('ul');

                if( $(parent).offset().left + $(parent).width() + $(child_menu).width() > $(window).width() ){
                  $(child_menu).css('left', '-100%');
                } else {
                  $(child_menu).css('left','100%');
                }
            }
        });
        $(".main-menu>ul>li").mouseover(function(){ 
            if($(this).children('ul').length == 1) {

                var parent = $(this);
                var child_menu = $(this).children('ul');

                if( $(parent).offset().left + $(parent).width() + $(child_menu).width() > $(window).width() ){
                  $(child_menu).css({"right":"0","left":"auto"});
                } else {
                  $(child_menu).css({"right":"auto","left":"0"});
                }
            }
        });
        
    });  

})(jQuery);