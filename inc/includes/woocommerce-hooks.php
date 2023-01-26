<?php
if( class_exists( 'WooCommerce' ) ) :
	
	//Change Product per page show
	add_filter( 'loop_shop_per_page', 'pakghor_new_loop_shop_per_page', 20 );
	//$posts_limit = 6;
	function pakghor_new_loop_shop_per_page( $cols ) {
		$posts_limit	=	'';
		if (function_exists('cs_get_option')) {
			$posts_limit	= cs_get_option('pakghor_woo_product_per_page');
		}
	  // $cols contains the current number of products per page based on the value stored on Options -> Reading
	  // Return the number of products you wanna show per page.
		
	  $cols = $posts_limit;
	  return $cols;
	}
	/**
	 * Remove woocommerce_sidebar - 10
	 */
	function pakghor_remove_woocommerce_sidebar() {
	  remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 ); 
	}
	add_action( 'init', 'pakghor_remove_woocommerce_sidebar' );

	/**
	 * Remove woocommerce_breadcrumb - 20
	 */
	function pakghor_remove_woocommerce_breadcrumb(){
		remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	}
	add_action('init','pakghor_remove_woocommerce_breadcrumb');

	/**
	 * Remove woocommerce_result_count - 20
	 */
	function pakghor_remove_woocommerce_result_count(){
		remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}
	add_action('init','pakghor_remove_woocommerce_result_count');

	/**
	* Remove woocommerce_catalog_ordering - 30
	*/
	function pakghor_remove_woocommerce_catalog_ordering(){
		remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}
	add_action('init','pakghor_remove_woocommerce_catalog_ordering');

	/**
	* Remove woocommerce_show_product_loop_sale_flash - 10
	*/
	function pakghor_remove_woocommerce_show_product_loop_sale_flash(){
		remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_show_product_loop_sale_flash');

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	function pakghor_remove_woocommerce_shop_loop_item_title(){
		remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_shop_loop_item_title');

	/**
	* Remove woocommerce_show_product_sale_flash - 10
	*/
	function pakghor_remove_woocommerce_shop_single_sale_flash(){
		remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_shop_single_sale_flash');

	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 * Remove Add to Cart
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */

	function pakghor_remove_woocommerce_template_loop_add_to_cart(){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_template_loop_add_to_cart');

	/** 
	* Remove Rating
	*
	*/
	function pakghor_remove_woocommerce_template_loop_rating(){
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	}
	add_action('init','pakghor_remove_woocommerce_template_loop_rating');

	/** 
	* Remove Price
	 *
	 */
	function pakghor_remove_woocommerce_template_loop_price(){
		remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
	}
	add_action('init','pakghor_remove_woocommerce_template_loop_price');

	// Excerpt Limit
	$pakghor_woocommerce_excerpt_lenth = '';
	add_filter('woocommerce_short_description', 'pakghor_woocommerce_short_description', 10, 1);
	function pakghor_woocommerce_short_description($post_excerpt){
		if(function_exists('cs_get_option')){
			$pakghor_woocommerce_excerpt_lenth = cs_get_option('pakghor_woocommerce_short_description_excerpt_lenth');
		}
	    if (!is_product()) {
	        $post_excerpt = substr($post_excerpt, 0, $pakghor_woocommerce_excerpt_lenth );
	    }
	    return $post_excerpt;
	}

	/** 
	* Remove Single shop product title
	*/
	function pakghor_remove_woocommerce_template_single_title(){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	}
	add_action('init','pakghor_remove_woocommerce_template_single_title');

	/** 
	* Remove Single shop price
	*/
	function pakghor_remove_woocommerce_template_single_price(){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_template_single_price');

	/** 
	* Remove Single shop meta
	*/
	function pakghor_remove_woocommerce_template_single_meta(){
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	}
	add_action('init','pakghor_remove_woocommerce_template_single_meta');

	/* The woocommerce_review_before_comment_meta hook.
	 *
	 * @hooked woocommerce_review_display_rating - 10
	 */
	function pakghor_remove_woocommerce_review_display_rating(){
		remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );
	}
	add_action('init','pakghor_remove_woocommerce_review_display_rating');

	// Mini Cart on Header area
	function pakghor_woocommerce_mini_cart_dropdown () { ?>
		<div class="cart">
			<a href="<?php echo wc_get_checkout_url() ?>"><?php echo WC() -> cart -> get_cart_subtotal(); ?><i class="fa fa-shopping-cart"></i><span class="count-total"><?php echo WC() -> cart -> cart_contents_count; ?></span>
			</a>
			
			<?php echo wc_get_template( 'cart/mini-cart.php' ); ?>
			
		</div>
	<?php }

	/**
	* WooCommerce update mini cart on ajax click
	*/
	add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
	    ob_start();
	    ?>
	    <div class="cart">
			<a href="<?php echo wc_get_checkout_url() ?>"><?php echo WC() -> cart -> get_cart_subtotal(); ?><i class="fa fa-shopping-cart"></i><span class="count-total"><?php echo WC() -> cart -> cart_contents_count; ?></span>
			</a>
			<?php woocommerce_mini_cart(); ?>
		</div>
	    <?php $fragments['div.cart'] = ob_get_clean();
	    return $fragments;
	} );
	// Ensure cart contents update when products are added to the cart via AJAX
	add_filter( 'woocommerce_add_to_cart_fragments', 'pakghor_woocommerce_header_add_to_cart_fragment' );
	function pakghor_woocommerce_header_add_to_cart_fragment($fragments){
	    ob_start();
	    ?>
	    <span class="count-total">
	        <?php echo WC()->cart->cart_contents_count; ?>
	    </span>
	    <?php
	    $fragments['span.count-total'] = ob_get_clean();
	    return $fragments;
	}

	// Related Product Count
	add_filter( 'woocommerce_output_related_products_args', 'pakghor_change_number_related_products', 9999 );
	function pakghor_change_number_related_products( $args ) {
		if(function_exists('cs_get_option')){
			$pakghor_woo_related_item = cs_get_option('pakghor_woo_related_item_count');
		}
		$args['posts_per_page'] = $pakghor_woo_related_item; // # of related products
		$args['columns'] = $pakghor_woo_related_item; // # of columns per row
		return $args;
	}

endif;