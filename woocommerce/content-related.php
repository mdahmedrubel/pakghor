 <div class="element-item food-item style-2 col-md-6 col-sm-4 <?php pakghor_get_terms_link('product_cat') ?>">
		<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' ); ?>
			<div class="food-item-img">
			<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

			<div class="food-item-img-overlay"></div>
				<div class="food-item-img-overlay-content">
					<a href="<?php echo get_the_permalink() . '?add-to-cart=' . get_the_ID() ?>" class="button"><?php echo esc_html__('add to cart','pakghor') ?></a>
				</div>
			</div>

			<div class="food-item-details">
				<div class="dotted-title">
					<div class="dotted-name">

			<?php	
				/**
				 * Hook: woocommerce_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' ); ?>
					<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
					</div>
					<div class="dotted-dot"></div>
					<?php woocommerce_template_loop_price(); ?>
				</div>
				<?php woocommerce_template_single_excerpt() ?>
				<?php woocommerce_template_loop_rating(); ?>
		</div>
	<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

				
	<?php	/**
		 * Hook: woocommerce_after_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
</div>