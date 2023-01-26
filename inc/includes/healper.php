<?php
 /**
 * Post type  Filtering Slug
 */
if ( ! function_exists( 'pakghor_get_terms_link' ) ) {
    function pakghor_get_terms_link($category) {
        $terms = get_the_terms(get_the_ID(), $category);
        if ( $terms && ! is_wp_error( $terms ) ) :
            $draught_links = array();
            foreach ( $terms as $term ) {
                $draught_links = $term->slug.' ';
                echo esc_attr($draught_links);
            }
        endif; 
    }
}
 
//custom pagination(list_type)
if ( ! function_exists('pakghor_custom_pagination')) {
 function pakghor_custom_pagination( $event_post_query ){
    global $event_post_query;
        $total_pages = $event_post_query ->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if ($total_pages > 1){
            $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
            echo paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'prev_text'   => '<i class="fa fa-angle-left"></i>'.__('Prev', 'pakghor'),
                'next_text'   => '<i class="fa fa-angle-right"></i>'.__('Next', 'pakghor'),
                'type'  => 'list',
            ));
        }
 }

}


// Review Option
if ( !function_exists('pakghor_review')) {
   function pakghor_review($client_review){
    $i = 0;
    $half = '';
    $rat = $client_review;
    $int = floor($rat);
    $j = $rat - $int;
    if($j>0.2):
        $half = $int;
    endif;
    for ($i=0; $i <5 ; $i++) { 
        if($i<$int){
            $class = 'fa fa-star';
        } elseif($i==$half){
            $class = 'fa fa-star-half-o';
        } else {
            $class = 'fa fa-star-o';
        }
        $ratting = '<i class="' . esc_attr($class) .'"></i>';
        echo wp_kses_post($ratting);
    }

   }
}

// change custom post type default value
    if( function_exists( 'cs_get_option' ) ) :
        function pakghor_register_post_type_args( $args, $post_type ) {
            $pakghor_team_post_slug        = cs_get_option( 'pakghor_team_post_slug' );
            $pakghor_event_post_slug       = cs_get_option( 'pakghor_event_post_slug' );
            $pakghor_services_post_slug = cs_get_option( 'pakghor_services_post_slug' );
            $pakghor_gallery_post_slug = cs_get_option( 'pakghor_gallery_post_slug' );
            $pakghor_testimonial_post_slug = cs_get_option( 'pakghor_testimonial_post_slug' );
            $pakghor_pricing_tabel_post_slug = cs_get_option( 'pakghor_pricing_tabel_post_slug' );

            if ( 'pakghor_team' === $post_type && !empty($pakghor_team_post_slug) ) {
                $args['rewrite']['slug'] = $pakghor_team_post_slug;
            }
            if ( 'pakghor_event' === $post_type && !empty( $pakghor_event_post_slug ) ) {
                $args['rewrite']['slug'] =  $pakghor_event_post_slug ;
            }
            if ( 'pakghor_gallery' === $post_type && !empty( $pakghor_gallery_post_slug ) ) {
                $args['rewrite']['slug'] =  $pakghor_gallery_post_slug ;
            }
            if ( 'pakghor_services' === $post_type && !empty( $pakghor_services_post_slug ) ) {
                $args['rewrite']['slug'] =   $pakghor_services_post_slug ;
            }
            if ( 'pakghor_testimonial' === $post_type && !empty( $pakghor_testimonial_post_slug ) ) {
                $args['rewrite']['slug'] =   $pakghor_testimonial_post_slug ;
            }
            if ( 'pakghor_pricing' === $post_type && !empty( $pakghor_pricing_tabel_post_slug) ) {
                $args['rewrite']['slug'] =   $pakghor_pricing_tabel_post_slug;
            }
            return $args;
        }
        add_filter( 'register_post_type_args', 'pakghor_register_post_type_args', 10, 2 ); 

    $pakghor_event_post_name = cs_get_option( 'pakghor_event_post_name' );
    if(!empty($pakghor_event_post_name )):
        function pakghor_change_event_labels() {
            $post_name = cs_get_option( 'pakghor_event_post_name' );
            $event_object = get_post_type_object( 'pakghor_event' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_event_labels', 20 );
    endif;

    $pakghor_team_post_name = cs_get_option( 'pakghor_team_post_name' );
    if(!empty($pakghor_team_post_name )):
        function pakghor_change_team_labels() {
            $post_name = cs_get_option( 'pakghor_team_post_name' );
            $event_object = get_post_type_object( 'pakghor_team' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_team_labels', 20 );
    endif;
   
    $pakghor_services_post_name = cs_get_option( 'pakghor_services_post_name' );
    if(!empty($pakghor_services_post_name )):
        function pakghor_change_services_labels() {
            $post_name = cs_get_option( 'pakghor_services_post_name' );
            $event_object = get_post_type_object( 'pakghor_services' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_services_labels', 20 );
    endif;

    $pakghor_gallery_post_name = cs_get_option( 'pakghor_gallery_post_name' );
    if(!empty($pakghor_gallery_post_name )):
        function pakghor_change_gallery_labels() {
            $post_name = cs_get_option( 'pakghor_gallery_post_name' );
            $event_object = get_post_type_object( 'pakghor_gallery' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_gallery_labels', 20 );
    endif;

    $pakghor_testimonial_post_name = cs_get_option( 'pakghor_testimonial_post_name' );
    if(!empty($pakghor_testimonial_post_name )):
        function pakghor_change_testimonial_labels() {
            $post_name = cs_get_option( 'pakghor_testimonial_post_name' );
            $event_object = get_post_type_object( 'pakghor_testimonial' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_testimonial_labels', 20 );
    endif;

    $pakghor_pricing_tabel_post_name = cs_get_option( 'pakghor_pricing_tabel_post_name' );
    if(!empty($pakghor_pricing_tabel_post_name )):
        function pakghor_change_pricing_labels() {
            $post_name = cs_get_option( 'pakghor_pricing_tabel_post_name' );
            $event_object = get_post_type_object( 'pakghor_pricing' );
            $event_object->labels->name = $post_name;
        }
        add_action( 'wp_loaded', 'pakghor_change_pricing_labels', 20 );
    endif;

endif;
