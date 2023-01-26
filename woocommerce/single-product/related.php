<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pakghor_related_product_switcher = $pakghor_related_product_icon = $pakghor_related_product_title = $pakghor_related_product_sub_title = '';

if (function_exists('cs_get_option')) {
	$pakghor_related_product_switcher 	= cs_get_option('pakghor_related_product_switcher');
	$pakghor_related_product_icon 		= cs_get_option('pakghor_related_product_icon');
	$pakghor_related_product_title 	= cs_get_option('pakghor_related_product_title');
	$pakghor_related_product_sub_title = cs_get_option('pakghor_related_product_sub_title');
}
if ( $related_products && $pakghor_related_product_switcher == 1 ) : ?>

	<div class="similar-product">
		<?php if( !empty($pakghor_related_product_icon) || !empty($pakghor_related_product_title) || !empty($pakghor_related_product_sub_title) ) : ?>
				<div class="section-head">
					<?php if(!empty($pakghor_related_product_icon) ): ?>
					<i class="<?php echo esc_attr($pakghor_related_product_icon); ?>"></i>
					<?php endif; ?>
					<?php if(!empty($pakghor_related_product_title) ) : ?>
					<h2><?php echo esc_html($pakghor_related_product_title); ?></h2>
					<?php endif; ?>
					<?php if(!empty($pakghor_related_product_sub_title)) : ?>
					<p><?php echo esc_html($pakghor_related_product_sub_title) ?></p>
					<?php endif; ?>
				</div><!-- section-head -->
			<?php endif; ?>
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'related' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>
				
		</div>

<?php endif;

wp_reset_postdata();