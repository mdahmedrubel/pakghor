<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
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
 * @version     3.2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comments"  class="product-review">
		<h2><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
				printf( esc_html( _n( '%1$s Customer Review', '%1$s Customer Reviews', $count, 'pakghor' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
			} else {
				_e( 'No Reviews', 'pakghor' );
			}
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ul class="product-review-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.', 'pakghor' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		
			<div id="review_form" class="add-review">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a Review', 'pakghor' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'pakghor' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'pakghor' ),
						'title_reply_before'   => '<h2>',
						'title_reply_after'    => '</h2>',
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="row"><div class="col-md-6"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="input-box" aria-required="true" placeholder="'.esc_attr__('Your Name','pakghor').'*" required /></div>',
							'email'  => '<div class="col-md-6">
								<input placeholder="'.esc_attr__('Your Email','pakghor').'*" class="input-box" id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-required="true" required /></div></div>',
						),
						'label_submit'  => __( 'add review', 'pakghor' ),
						'logged_in_as'  => '',
						'comment_field' => '',
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'pakghor' ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="add-rating"><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'pakghor' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'pakghor' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'pakghor' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'pakghor' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'pakghor' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'pakghor' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<textarea id="comment" placeholder="' . esc_attr__('Messages', 'pakghor'). '" autocomplete="off" name="comment" rows="5" aria-required="true" required></textarea>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'pakghor' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
