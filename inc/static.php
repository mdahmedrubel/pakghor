<?php
/*
 * Load css js enqueue file.
 */
if( !function_exists( 'pakghor_css_js_enqueue' ) ){
    function pakghor_css_js_enqueue(){
        // Css file
        wp_enqueue_style('pakghor-style', get_stylesheet_uri() );
        wp_enqueue_style('pakghor-font-awesome', PAKGHOR_ASSETS. '/css/font-awesome.css');
        wp_register_style('pakghor-flaticon', PAKGHOR_ASSETS. '/flaticon/flaticon.css');
        wp_register_style('pakghor-lightbox', PAKGHOR_ASSETS. '/css/lightbox.css');
        wp_enqueue_style('pakghor-swiper', PAKGHOR_ASSETS. '/css/swiper.min.css');
        wp_enqueue_style('pakghor-bootstrap', PAKGHOR_ASSETS. '/css/bootstrap.min.css');
        wp_enqueue_style('pakghor-animate-min-css', PAKGHOR_ASSETS. '/css/animate.min.css');
        wp_enqueue_style('pakghor-style-css', PAKGHOR_ASSETS. '/css/style.css' );
        wp_enqueue_style('pakghor-responsive', PAKGHOR_ASSETS. '/css/responsive.css');

        wp_register_script('pakghor-isotope-pkgd-js', PAKGHOR_ASSETS . '/js/isotope.pkgd.min.js', array('jquery'), true, true);
        wp_enqueue_script('pakghor-swiper-miny', PAKGHOR_ASSETS . '/js/swiper.min.js', array('jquery'), true, true);
        wp_register_script('pakghor-lightbox-js', PAKGHOR_ASSETS . '/js/lightbox.js', array('jquery'), true, true);
        wp_enqueue_script('pakghor-wow.min.js', PAKGHOR_ASSETS . '/js/wow.min.js', array('jquery'), true, true);
        wp_register_script( 'pakghor-plugins-js', PAKGHOR_ASSETS . '/js/plugins.js', array('jquery'), true, true);
        wp_enqueue_script('pakghor-functions-js', PAKGHOR_ASSETS . '/js/functions.js', array( 'jquery' ), true, true);
        
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

}add_action('wp_enqueue_scripts', 'pakghor_css_js_enqueue');


// Google Map
if( !function_exists( 'pakghor_gmap_init' ) ) :
    function pakghor_gmap_init(){
        $gmap_api = cs_get_option( 'pakghor_google_api' ); 
        if( ! empty( $gmap_api ) ) :
          wp_enqueue_script( 'pakghor-map-custom', PAKGHOR_ASSETS . '/js/jquery.gmap.min.js', array( 'jquery' ), '1.0.0', false );
          wp_enqueue_script( 'map-custom', PAKGHOR_ASSETS . '/js/map-custom.js', array( 'jquery' ), '1.0.0', true );
          wp_enqueue_script( 'pakghor-gmaps-api', 'https://maps.googleapis.com/maps/api/js?key='.$gmap_api, null, null, false );
        endif;
    }
endif;
if( function_exists( 'cs_get_option' ) ) :
    add_action( 'wp_enqueue_scripts', 'pakghor_gmap_init', 90 );
endif;

/**
 * Pakghor Typhography
*/
if ( ! function_exists( 'pakghor_default_fonts_url' ) ):
    function pakghor_default_fonts_url(){
        $font_families = 'Poppins:400,500,600,700,800,900|Open Sans:400,500,600,700,800,900|Roboto Mono:400,500,600,700,800,900';
        $font_url = add_query_arg('family', urlencode(''.$font_families.'&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
        return $font_url;
    }
endif;

if ( ! function_exists( 'pakghor_fonts_url' ) ):
    function pakghor_fonts_url() {

        if( function_exists('cs_get_option') ) :
            $fonts_url = '';
            $pakghor_body_font   = cs_get_option('pakghor_body_font_family');
            $body_font_family    = $pakghor_body_font['family'];
            $pakghor_title_font       = cs_get_option('pakghor_title_font_family');
            $title_font_family   = $pakghor_title_font['family'];
           $pakghor_section_title_font        = cs_get_option('pakghor_section_title_font_family');
            $section_title_font_family          = $pakghor_section_title_font ['family'];
            $pakghor_menu_font        = cs_get_option('pakghor_menu_font_family');
            $menu_font_family    = $pakghor_menu_font['family'];
            $font_families = array();
            if (!empty($body_font_family)){
                $font_families[] = $body_font_family.':400,500,600,700,800,900';
            }
            if(!empty($title_font_family) && ($title_font_family != $body_font_family)){
                $font_families[] = $title_font_family.':400,500,600,700,800,900';
            } 
            if(!empty($section_title_font_family) && ($section_title_font_family != $body_font_family) && ($section_title_font_family != $title_font_family ) ){
                $font_families[] = $section_title_font_family.':400,500,600,700,800,900';
            }
            if(!empty($menu_font_family) && ($menu_font_family != $body_font_family) && ($menu_font_family != $title_font_family)){
                $font_families[] = $menu_font_family.':400,500,600,700,800,900';
            }
            if (empty($body_font_family) && empty($title_font_family) && empty($menu_font_family)){
                $font_families[] = 'Poppins:400,500,600,700,800,900|Open Sans:400,500,600,700,800,900|Roboto Mono:400,500,600,700,800,900';
            }
            $font_families[] = 'Roboto Mono:400,500,600,700,800,900';
            $query_args = implode('|', $font_families);    
            /*
            Translators: If there are characters in your language that are not supported
            by chosen font(s), translate this to 'off'. Do not translate into your own language.
             */
            if ( 'off' !== _x( 'on', 'Google font: on or off', 'pakghor' ) ) {
                $font_url = add_query_arg( 'family', urlencode( ''.$query_args.'' ), "//fonts.googleapis.com/css" );
            }
            return $font_url;
        endif;
    }
endif;

if ( function_exists( 'cs_get_option' ) ):  
    function pakghor_enqueue_fonts() {
        wp_enqueue_style( 'pakghor-fonts', pakghor_fonts_url(), array(), '1.0.0' );
    }
    add_action( 'wp_enqueue_scripts', 'pakghor_enqueue_fonts' );
else:
    function pakghor_enqueue_default_fonts() {
        wp_enqueue_style( 'pakghor-fonts', pakghor_default_fonts_url(), array(), '1.0.0' );
    }
    add_action( 'wp_enqueue_scripts', 'pakghor_enqueue_default_fonts' );
endif;

if( !function_exists('pakghor_custom_styles') ) :
    function pakghor_custom_styles(){
        if( function_exists('cs_get_option') ) :
            //Body
            $pakghor_body_font         = cs_get_option('pakghor_body_font_family');
            $body_font_family          = $pakghor_body_font['family'];
            $pakghor_body_font_size    = cs_get_option('pakghor_body_font_size');
            $pakghor_primary_color     = cs_get_option('pakghor_primary_color');
            //Title
            $pakghor_title_font        = cs_get_option('pakghor_title_font_family');
            $title_font_family         = $pakghor_title_font['family'];
            //section title
            $pakghor_section_title_font         = cs_get_option('pakghor_section_title_font_family');
            $section_title_font_family          = $pakghor_section_title_font ['family'];
            $pakghor_section_title_font_style   = cs_get_option('pakghor_section_title_font_style');
            $pakghor_section_title_transform    = cs_get_option('pakghor_section_title_transform');
            $pakghor_section_title_font_size    = cs_get_option('pakghor_section_title_font_size');
            $pakghor_section_title_font_weight  = cs_get_option('pakghor_section_title_font_weight');
            $pakghor_section_title_font_color   = cs_get_option('pakghor_section_title_font_color');
            // Menu
            $pakghor_menu_font          = cs_get_option('pakghor_menu_font_family');
            $menu_font_family           = $pakghor_menu_font['family'];
            $pakghor_menu_font_transform     = cs_get_option('pakghor_menu_font_transform');

            wp_enqueue_style('custom-style', PAKGHOR_ASSETS. '/css/custom-style.css');
            $custom_css = "
            .main-menu,.book-table a,.dropdown-menu>li>a:hover,.button,.nav-links ul.page-numbers li span.current,.post-pagination li a:hover,.widget form input.search-submit,.tagcloud a,.scroll-top,.swiper-pagination-bullet-active, .style-3 .search-form input,.cook-team-member:hover,.mailpoet_paragraph .mailpoet_submit,.pricing-table:hover .pricing-head,.comment-respond form p.form-submit input[type='submit'],.service-item:hover .service-item-icon,.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover,.navbar-toggle,.cart a>span.count-total,input.wpcf7-form-control.wpcf7-submit.button,.post-content .button:hover,.about-resturent-content .button:hover,.pricing-table .button:hover,.our-service-item-icon:after,.food-gallery .button-group2 .button:hover,.food-gallery .button-group2 .button.is-checked, .food-menu-3 .button-group .button.is-checked, .food-menu-3 .button-group .button:hover,.service3-item .button:hover,.social-icon-rounded li a:hover,.woocommerce button.button:hover,.woocommerce a.button,.woocommerce button.button.alt,.nav-tabs>li.active>a,.woocommerce #respond input#submit,.nav-tabs>li.active>a:hover,.nav-tabs>li.active>a:focus,.cart-content .cart-item a.remove_from_cart_button:hover,form.woocommerce-cart-form table thead tr,form.woocommerce-cart-form table tbody tr td.product-remove a:hover,a.checkout-button.button.alt.wc-forward,.scroll-top:hover, .food-gallery .button-group3 .button.is-checked,gallery .button-group3 .button:hover, .food-gallery .button-group3 .button:active,.food-gallery .button-group3 .button:hover,.post-pagination-area ul.page-numbers li a:hover,.nav-links ul.page-numbers li a.prev:hover,.nav-links ul.page-numbers li a.next:hover,.post-pagination-area ul.page-numbers li span.current,.post-pagination-area ul.page-numbers li a.next:hover,.post-pagination-area ul.page-numbers li a.prev:hover,.button-next:hover, .button-prev:hover,.error a,.post-single-content input[type='submit'], .food-menu .button-group .button.is-checked, .food-menu .button-group .button:hover{
                background-color: {$pakghor_primary_color};
            }
            .header-top-left ul li>i, .button:hover, .social-profiles ul li a:hover,.post-content .title a:hover,.meta-post.style-2 ul li a:hover,.post-pagination li a:hover,.widget ul li a:hover,.widget ul li a:hover,.widget tr td a:hover, #sidebar .widget ul li a.rsswidget:hover,.widget form input.search-submit:hover,.tagcloud a:hover,.team-widget-item:hover .cooker-details h2,.footer-bottom span,.footer-btn a:hover,.style-2 .post-content .meta-post ul li a:hover,.style-2 .post-content a:hover,.style-2 .post-content .meta-post ul li a:hover,.banner-text h2,.banner-text ul li a:hover,.section-head h2,.section-head i,.gallery-img:hover .gallery-overlay-btn1 a, .gallery-overlay-btn2 a,.service3-item:hover .service-item-des h2,.special-event-content a,.flaticon-signs:before,.flaticon-phone-call:before, .flaticon-time-is-running:before,.about-resturent-content h2,.meta-post ul li a:hover,.customer-review-details h2,.rating-star i,.newslatter-input i,.pricing-head span,.author-name h3,.post-single .title,author-name h3 a,.reply-btn a:hover,ul.comment-list li p a,.tags li a:hover,.service-item:hover .service-item-icon .service-item-des pull-left h2,.cart>a,.cart-content .empty a,.cart-content .empty a:hover,.service-item:hover .service-item-des h2,.service-item-icon i,.dish-btn a.button:hover,.dotted-price,.dotted-name a:hover,input.wpcf7-form-control.wpcf7-submit.button:hover,.section-head i,.style-2 .nav>li>a:focus, .style-2 .nav>li>a:hover,.food-menu-2 .food-item .dotted-name a:hover,.food-menu-btn .button:hover,.our-service-item-icon i,.our-service-item:hover .our-service-item-des h2, .food-item .dotted-name a:hover,.food-menu-2 .button-group .button:hover,.food-menu-2 .button-group .button.is-checked,.style-3 .nav>li>a:hover,.single-team-details h3, .dish-row-head i,.style-2 .cook-team-member:hover .cooker-details h2,.author-name h3 a,.author-name h3 a:hover,.comment-respond form p.logged-in-as a,.comment-respond form p.logged-in-as a:hover,.w-catagory>li:hover a,.w-catagory>li:hover span,.lunch-menu .food-item .dotted-name a:hover,.meta-post ul span.edit-link a.post-edit-link,.meta-post ul span.edit-link a.post-edit-link:hover,.woocommerce .star-rating,.woocommerce .star-rating span::before,.woocommerce #respond input#submit:hover,.add-rating p.stars span a,.product-detail .dotted-name a:hover,button.single_add_to_cart_button.button.alt:hover,.cart-subtotal p>span,.cart-item span.quantity,.cart-content .cart-item a:hover,.woocommerce-message::before,.woocommerce-form-coupon-toggle .woocommerce-info a.showcoupon,.woocommerce-form-coupon-toggle .woocommerce-info a.showcoupon:hover,.woocommerce-info::before,.woocommerce form .form-row .required,tr.cart_item td.product-name,form.woocommerce-cart-form table tbody tr td.product-name:hover a,table.woocommerce-table--order-details tbody tr td.woocommerce-table__product-name a,.woocommerce .woocommerce-customer-details address p,a.added_to_cart.wc-forward,.logo-area-right ul li.phone i, .logo-area-right ul li.place i, .logo-area-right ul li.clock i,.button-next, .button-prev,.tagandshare .tags span.edit-link a.post-edit-link:hover,.tagandshare .tags span.edit-link a.post-edit-link,.user-name a:hover,.error a:hover,.post-single-content input[type='submit']:hover{
                color: {$pakghor_primary_color};
            }
            .header-top-left ul li>i, .button,.nav-links ul.page-numbers li span.current,.post-pagination li a:hover,.widget-title,#sidebar .widget select,.widget form input.search-field,.widget form input.search-field,.widget form input.search-submit:hover,.widget form input.search-submit:hover,.widget form input.search-submit,.tagcloud a,.tagcloud a:hover,.team-widget-item:hover .cooker-img,.swiper-pagination-bullet-active, .cooker-img,.cook-team-member:hover,.reservation-form .input-box:focus,.customer-img,.mailpoet_paragraph .mailpoet_submit,.pricing-table:hover .pricing-head,.wpcf7-form input:focus,.wpcf7-form textarea:focus,.box-title,.comment-respond form p.form-submit input[type='submit'],.service-item:hover .service-item-icon,.service-item-icon,input.wpcf7-form-control.wpcf7-submit.button,input.wpcf7-form-control.wpcf7-submit.button:hover,.button-group .button:hover, .button-group .button:active,.search-form input,.style-2 .header-top,.border-s,.our-service-item-icon,.food-gallery .button-group2 .button:hover,.food-gallery .button-group2 .button.is-checked, .food-menu .button-group .button.is-checked, .food-menu-3 .button-group .button.is-checked,.social-icon-rounded li a,.social-icon-rounded li a:hover,.dish-row-head,.style-2 .cook-team-member:hover .cooker-img,.woocommerce button.button:hover,.woocommerce a.button,.woocommerce a.button:hover,.woocommerce button.button.alt,.woocommerce .quantity .qty, .nav-tabs>li.active>a,.woocommerce #respond input#submit,.woocommerce #respond input#submit,.nav-tabs>li.active>a:hover,.nav-tabs>li.active>a:focus, .nav-tabs>li.active>a,.woocommerce button.button.alt:hover,.woocommerce-message,a.checkout-button.button.alt.wc-forward:hover,a.checkout-button.button.alt.wc-forward,.woocommerce-info,.add-review textarea:focus,section.reservation.style-3.section-padding .reservation-form .wpcf7 form .single-input span input.input-box:focus, .food-gallery .button-group3 .button.is-checked,gallery .button-group3 .button:hover, .food-gallery .button-group3 .button:active,.food-gallery .button-group3 .button:hover,.post-pagination-area ul.page-numbers li a:hover,.post-pagination-area ul.page-numbers li span.current,.error a,.error a:hover,.post-single-content input[type='submit'],.post-single-content input[type='submit']:hover,.comment-form textarea:focus, .food-menu .button-group .button:hover{
                border-color: {$pakghor_primary_color};
            }
            body, .cart, #mailpoet_form_1 .mailpoet_text, .pricing-head span {
                font-family:{$body_font_family}, sans-serif;
                font-size:{$pakghor_body_font_size}px;
            }
            .banner-text h2,.section-head h2,.about-resturent-content h2{
                font-family:{$section_title_font_family},cursive;
                font-style:{$pakghor_section_title_font_style};
                text-transform:{$pakghor_section_title_transform};
                font-size:{$pakghor_section_title_font_size}px;
                font-weight:{$pakghor_section_title_font_weight};
                color:{$pakghor_section_title_font_color};
            }
            .navbar-nav,.banner-text ul li{
                font-family:{$menu_font_family},sans-serif;
            }
            .dropdown-menu>li>a, .navbar-nav>li>a, .mobile-menu ul li a{
                text-transform: {$pakghor_menu_font_transform};
            }
            .post-single-content h2, h1, h2, h3, h4, h5, h6, .dish-row-head h2, button.button, .mailpoet_paragraph .mailpoet_submit, .dotted-name a, .special-event-content a, .nav-tabs>li>a, .product-review h2, .product-review-content h3, add-review h2, .woocommerce #respond input#submit, .comment-respond form p.form-submit input[type='submit'], .single-team-details h3, .single-team-details h5, .widget .style-2 .post-content a,.footer-widget h2.footer-widget-title,.widget h2.widget-title, h2.title, h2.entry-title, h2.box-title, .author-name h3,.cooker-details a h2, .customer-review-details h2, .payment-method h2,.pricing-head h2,.service-item-des a h2,dotted-name a,.service-item-des h2,.dotted-price span, .button-group button, .our-service-item-des h2, .woocommerce div.product form.cart .button, .form-submit input, a.button, .book-table a,.reservation-btn input, h2.vc_custom_heading, p.mailpoet_paragraph input, .banner-text ul li,.footer-btn a, .user-name h3, .reply-btn a,.woocommerce-ordering select option,.woocommerce-cart table.cart th, .cart_totals h2, .woocommerce button.button, .woocommerce-checkout,.comment-respond h2, .error-top h3, .contact-item h2, .dotted-name{
                font-family:{$title_font_family}, sans-serif;
            }";

            wp_add_inline_style( 'custom-style' , $custom_css );
        endif;
        }
endif;

if( function_exists( 'cs_get_option' ) ) :
   add_action( 'wp_enqueue_scripts', 'pakghor_custom_styles');
endif;