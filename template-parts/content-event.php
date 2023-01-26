<?php // Event Contet Template
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */

?>
<?php
	$_pakghor_event_page_options = $pakghor_event_time = $pakghor_event_location = $pakghor_event_speaker_title = $pakghor_event_speaker_name = $pakghor_event_speaker_image = '';
	$event_excerpt = 25;

	if( function_exists('cs_get_option') ){
		$_pakghor_event_page_options		= get_post_meta( get_the_ID(), '_pakghor_event_page_options', true );
		$pakghor_event_time 				= isset( $_pakghor_event_page_options['pakghor_event_time']) ? $_pakghor_event_page_options['pakghor_event_time'] : '';
		$pakghor_event_location 			= isset( $_pakghor_event_page_options['pakghor_event_location']) ? $_pakghor_event_page_options['pakghor_event_location'] : '';
		$pakghor_event_speaker_title 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_title']) ? $_pakghor_event_page_options['pakghor_event_speaker_title'] : '';
		$pakghor_event_speaker_name 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_name']) ? $_pakghor_event_page_options['pakghor_event_speaker_name'] : '';
		$pakghor_event_speaker_image 		= isset( $_pakghor_event_page_options['pakghor_event_speaker_image']) ? $_pakghor_event_page_options['pakghor_event_speaker_image'] : '';
		$pakghor_event_speaker_image_src 		= wp_get_attachment_image_src( $pakghor_event_speaker_image, 'full' );
		$pakghor_event_speaker_image_alt   = get_post_meta( $pakghor_event_speaker_image, '_wp_attachment_image_alt', true );
		$event_excerpt = cs_get_option('event_excerpt');
	}

	?>		
	
	<div class="post-item event-item">
		<?php if( has_post_thumbnail() ) : ?>
		<div class="post-thumb">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('pakghor-event-thumb-300-350'); ?></a>
		</div><!-- post-thumb -->
		<?php endif; ?>
		<div class="post-content">
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<?php if( !empty( $pakghor_event_time ) || !empty( $pakghor_event_location )
 ) : ?>
			<div class="meta-post">
				<ul>
					<?php if( !empty( $pakghor_event_time ) ) : ?>
					<li>
						<i class="fa fa-calendar"></i><?php echo esc_html( $pakghor_event_time ); ?>
					</li>
					<?php endif; ?>
					<?php if( !empty( $pakghor_event_location ) ) : ?>
					<li>
						<i class="fa fa-map-marker"></i><?php echo esc_html( $pakghor_event_location ); ?> 
					</li>
					<?php endif; ?>
				</ul>
			</div><!-- meta post -->
			<?php endif; ?>
			<?php if( !empty($event_excerpt) ) : ?>
			<p><?php echo wp_trim_words( get_the_content(), $event_excerpt, '' ); ?></p>
			<?php else: 
				the_excerpt();
				endif;
			?>
			<?php if( !empty($pakghor_event_speaker_title) || !empty($pakghor_event_speaker_name) || !empty($pakghor_event_speaker_image_src) ) : ?>
			<div class="speaker">
				<?php if(! empty($pakghor_event_speaker_image_src) ) : ?>
				<div class="speaker-img">
					<img src="<?php echo esc_url($pakghor_event_speaker_image_src[0]); ?>" alt="<?php echo esc_attr($pakghor_event_speaker_image_alt); ?>">
				</div>
				<?php endif; ?>

				<?php if ( !empty( $pakghor_event_speaker_title ) || !empty($pakghor_event_speaker_name) ) : ?>
				<div class="speaker-name">
					<h3><?php echo esc_html($pakghor_event_speaker_title); ?></h3>
					<span><?php echo esc_html($pakghor_event_speaker_name); ?></span>
				</div>
				<?php endif; ?>

			</div><!-- speaker -->
			<?php endif; ?>
			<div class="event-btn">
				<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__('Event Details','pakghor') ?></a>
			</div>
		</div><!-- post-content -->
	</div><!-- post-item -->