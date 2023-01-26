<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 *
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}?>
  <!-- Post Author BIO and Social links -->
  	<?php if( ! is_page() ) : ?>
  	<div class="pak-author">
		<div class="single-content-box">
			<h2 class="box-title"><?php esc_html_e('About Author','pakghor') ?></h2>
			<div class="content-box-inner">
				<div class="author-img">
					<?php echo get_avatar(get_the_author_meta('ID'), 122 ); ?>
				</div>
				<div class="author-details">
					<div class="author-meta">
						<div class="author-name">
						<?php  
							printf( '<a href="%2$s"><h3>%3$s</h3></a>','',
				              esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				              get_the_author_meta( 'nickname' )
				            );
							// author Role
				            $author_id = get_the_author_meta('ID');
				        ?>
				        <span style="text-transform: capitalize;"><?php echo get_user_role($author_id); ?></span>
						</div>
						<?php pakghor_author_social(); ?>
					</div><!-- author-meta -->
					<p><?php the_author_meta('description'); ?></p>
				</div><!-- author-details -->
			</div><!-- content-box-inner -->
		</div><!-- single-content-box -->
	<!--// Post Author BIO and Social links -->
	</div>
	<?php endif; ?>
<?php // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
	<div class="single-content-box">
		<h2 class="box-title">
		<?php $pakghor_comment_count = get_comments_number();
			if ( '1' === $pakghor_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One Comment', 'pakghor' ),
					'<span>' . get_the_title() . '</span>'
				);
			} elseif('0' === $pakghor_comment_count){
				printf(
					/* translators: 1: title. */
					esc_html__( 'No Comment', 'pakghor' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s Comment', '%1$s Comments', $pakghor_comment_count, 'comments title', 'pakghor' ) ),
					number_format_i18n( $pakghor_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			} ?>
		</h2><!-- .comments-title -->
		<div class="clearfix"></div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		 // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'pakghor' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'pakghor' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<div class="clearfix"></div>
		<?php endif; // Check for comment navigation. 
		?>
		<?php // Comment Reply ?>
		<div class="content-box-inner">
			<ul class="comment-list">
				<?php
				wp_list_comments( array(
					'style'      	=> 'ul',
					'short_ping' 	=> true,
					'callback'		=> 'pakghor_custom_comment_template', // Comment template.php file

				) );
				?>
			</ul><!-- .comment-list -->
		</div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : 
		// Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'pakghor' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'pakghor' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
	        <div class="clearfix"></div>
		<?php endif; // Check for comment navigation
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<h5 class="no-comments"><?php esc_html_e( 'Comments are closed by Admin.', 'pakghor' ); ?></h5>
			<?php
		endif; ?>
	</div><!-- #comments -->
<?php endif; // Check for have_comments().
	// Comment form check for showing
	if ( comments_open() ) {
		pakghor_comment_form(); // Coment Form From Comment Template file
	}