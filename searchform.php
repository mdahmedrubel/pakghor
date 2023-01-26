<?php
/**
 * Template for displaying search forms in Pakghor
 *
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'pakghor' ); ?>" value="<?php echo get_search_query(); ?>">
  <button class="button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>