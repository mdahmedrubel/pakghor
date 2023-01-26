<?php 
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since 1.0.0
 * @version 1.0.0
 * @author CodexCoder
 */
	// Callback function for reply
	function pakghor_custom_comment_template($comment, $args, $depth){ 

	$GLOBALS['comment'] = $comment;
    	switch ( $comment->comment_type ) :
	        case 'pingback' :
	        case 'trackback' :
	            // Display trackbacks differently than normal comments.
	            ?>
	            <li <?php comment_class('comments-items'); ?> id="comment-<?php comment_ID(); ?>">
	            <p><?php echo esc_html__( 'Pingback:', 'pakghor' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'pakghor' ), '<span class="edit-link">', '</span>' ); ?></p>
	            <?php
	        break;
	        // Proceed with Normal Comment
	        default;
	        global $post; ?>
	         	<li <?php comment_class('comment') ?> id="li-comment-<?php comment_ID(); ?>">
					<article class="comment-item" id="comment-<?php comment_ID(); ?>">
						<div class="profile-image">
							<?php echo get_avatar( $comment, 80); ?>
						</div>
						<div class="comment-content">
							<div class="comment-meta">
								<div class="user-name">
									<h3><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo get_comment_author_link(); ?></a></h3>
									 
		                                <span><?php echo sprintf( esc_html__( '%1$s at %2$s', 'pakghor' ), get_comment_date(), get_comment_time() ); ?>
		                                </span>
								</div>
								<div class="reply-btn">
									<?php
				                    	comment_reply_link(
				                    		array_merge( $args,
				                    			array(
				                    				'reply_text' => esc_html__( 'Reply', 'pakghor' ),
				                    				'depth' 	 => $depth,
				                    				'max_depth'  => $args['max_depth']
				                    				)
				                    			)
				                    		);
				                    ?>
								</div>
							</div><!-- comment-meta -->
							<div class="content">
					            <?php if ( '0' == $comment->comment_approved ) : ?>
		                            <p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'pakghor' ); ?></p>
		                        <?php endif; ?>
		                         <?php comment_text(); ?>
		                        <?php edit_comment_link( esc_html__( 'Edit', 'pakghor' ), '<p class="edit-link">', '</p>' ); ?>
							</div>
						</div><!-- comment-content -->
					</article><!-- comment-list -->
	<?php 	break; endswitch;
	// Proceed with normal comments ended here.
 	}
 	// Ended callback comment reply 

	/**
	 * Comment Form
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 * @author CodexCoder */

	function pakghor_comment_form(){
		global $consent;
		echo '<div class="single-content-box com-mtop"><div class="content-box-inner">';
		$commenter = wp_get_current_commenter();
	    $req = get_option( 'comment_author_email' );
	    $aria_req = ( $req ? " aria-required='true'" : '' );
	    $fields = array(
	        'author' 	=> '<div class="row"><div class="col-md-6">
							<input id="author" class="input-box" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_attr__( 'Your Name*', 'pakghor' ) . '"' . $aria_req . ' />
							</div>',

	        'email'  	=> '<div class="col-md-6"><input id="email" class="input-box" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' . esc_attr__( 'Your Email*', 'pakghor' ) . '"' . $aria_req . ' /></div></div>',

	        'cookies' 	=> '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .'<label for="wp-comment-cookies-consent">' . __( 'Save my name and email in this browser for the next time I comment.', 'pakghor' ) . '</label></p>',

		);
		$comments_args = array(
	        'fields' 				=> $fields,
	        'title_reply'			=> esc_html__( 'Leave a Comment', 'pakghor' ),
	        'title_reply_before'    => '<h2 class="box-title">',
	        'title_reply_after'     => '</h2>',
	        'label_submit'  		=> esc_html__( 'Post comment', 'pakghor' ),
	        'comment_notes_before'  => '',
	        'comment_field' 		=> '<textarea name="comment" rows="11" autocomplete="off" placeholder="' . esc_attr__( 'Comments*', 'pakghor' ) . '" aria-required="true"></textarea>',
	    );
		comment_form($comments_args);
		echo '</div></div>';

	}
	// Comment filed to bottom
	function pakghor_move_comment_field_to_bottom( $fields ) {

		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;

	}add_filter( 'comment_form_fields', 'pakghor_move_comment_field_to_bottom' );