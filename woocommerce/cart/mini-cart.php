<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="cart-content">
<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<div class="cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
						<?php
						echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
							__( 'Remove this item', 'pakghor' ),
							esc_attr( $product_id ),
							esc_attr( $cart_item_key ),
							esc_attr( $_product->get_sku() )
						), $cart_item_key );
						?>
						<?php if ( empty( $product_permalink ) ) : ?>
						
							<?php echo wp_kses_post($thumbnail . $product_name . '&nbsp;'); ?>
							
						<?php else : ?>
						
							<a href="<?php echo esc_url( $product_permalink ); ?>">
								<?php echo wp_kses_post($thumbnail . $product_name . '&nbsp;'); ?>
							</a>
						
						<?php endif; ?>

						<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
					</div>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
		?>


	<div class="cart-bottom">
		<div class="cart-subtotal">
			<p><?php echo esc_html__('Subtotal: ','pakghor') ?><span><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>
		</div>
		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
		<div class="cart-action">
			<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
		</div>
	</div>

<?php else : ?>

	<div class="empty">
		<p><?php echo esc_html__( 'No products in the cart.', 'pakghor' ) ?></p>
		<a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ) ?>">
		<i class="fa fa-shopping-cart"></i> <?php esc_html_e('View Shop', 'pakghor'); ?></a>
	</div>

<?php endif;

do_action( 'woocommerce_after_mini_cart' ); ?>

</div>