<?php 

/**
 * Numeric Pagination
 */

function pakghor_numeric_pagination() {

	if( is_singular() )
		return;

	global $wp_query;	

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="post-pagination-area">
			<ul class="post-pagination">' . "\n";

					$total = $wp_query->max_num_pages;
						// only bother with the rest if we have more than 1 page!
						if ( $total > 1 )  {
						     // get the current page
						     if ( !$current_page = get_query_var('paged') )
						          $current_page = 1;
						     // structure of "format" depends on whether we're using pretty permalinks
						     if( get_option('permalink_structure') ) {
							     $format = '/page/%#%';
						     } else {
							     $format = 'page/%#%/';
						     }
						     
						     echo paginate_links(array(
						          'base'     => get_pagenum_link(1) . '%_%',
						          'format'   => $format,
						          'current'  => $current_page,
						          'total'    => $total,
						          'mid_size' => 3,
						          'type'     => 'list'
						     	)
						   );
					}

				echo '</ul>
		</div>' . "\n";
	}