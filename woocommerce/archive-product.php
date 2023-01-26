<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
	$posts_limit = $pakghor_woo_shop_menu = '';
	if (function_exists('cs_get_option')) {
		$posts_limit	= cs_get_option('pakghor_woo_product_per_page');
		$pakghor_woo_shop_menu = cs_get_option('pakghor_woo_shop_menu');;
	}
	global $posts_limit;

defined( 'ABSPATH' ) || exit;

get_header( 'shop' ); 

wp_enqueue_script('pakghor-isotope-pkgd-js');
wp_enqueue_script('pakghor-plugins-js');

?>

<!-- shop-page -->
<div class="shop-page">
	<div class="container">
		<div class="row">
			<?php 
				$woo_product_cats = get_terms('product_cat', array(
						'hide_empty' => true
					)
				);
			?>
			
			<div class="isotope-top">
				<?php if($pakghor_woo_shop_menu == 1): ?>
				<?php if($woo_product_cats) : ?>
				<div id="filters" class="button-group">
					<button class="button is-checked" data-filter="*"><?php echo esc_html__('view all','pakghor') ?></button>
					<?php foreach ( $woo_product_cats  as $woo_product_cat ) : ?>
					<button class="button" data-filter=".<?php echo esc_attr($woo_product_cat->slug); ?>"><?php echo esc_html($woo_product_cat->name); ?></button>
					<?php endforeach; ?>
				</div><!--button group-->
				<?php endif; ?>
				<?php endif; ?>
				<div class="catagorys">
					<div class="woo-catalog-ordering catagory-item">
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div><!--Catagorys-->
			</div>
<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );


if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' ); 

	woocommerce_product_loop_start();

?>


<?php	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}
	}
?>

<?php

	woocommerce_product_loop_end(); 
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' ); 


/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' ); ?>

		</div>
	</div>
</div>

<?php get_footer( 'shop' );
