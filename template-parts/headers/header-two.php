<?php
/**
 * Template part for displaying header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pakghor
 */

?>
<?php
	$pakghor_theme_logo_dark = $pakghor_logo_dark_width = $pakghor_logo_dark_height = $pakghor_header_top_bar_switcher = $pakghor_social_switcher = $pakghor_menu_book_btn_option = $pakghor_header_social	= $pakghor_menu_book_btn_text = $pakghor_menu_book_btn_url = $pakghor_search_switcher = $pakghor_add_to_cart = $pakghor_header_top_bgc	= $pakghor_header_bottom_bgc  = $pakghor_header_top_bar_info	= $pakghor_header_loaction = $pakghor_header_phone = $pakghor_working_days = $_pakghor_page_options = '';
	if( function_exists('cs_get_option') ) :
		if( is_page() ) :
			$_pakghor_page_options	= get_post_meta( get_the_ID(), '_pakghor_custom_page_options', true );
		endif;
		if( ! empty( $_pakghor_page_options['pakghor_theme_logo_dark'] ) ){
			$pakghor_theme_logo_dark = $_pakghor_page_options['pakghor_theme_logo_dark'];
		}else{
			$pakghor_theme_logo_dark = cs_get_option( 'pakghor_theme_logo_dark' );
		}
		$pakghor_header_top_bar_switcher = isset($_pakghor_page_options['pakghor_header_top_bar_switcher']) ? $_pakghor_page_options['pakghor_header_top_bar_switcher'] : cs_get_option('pakghor_header_top_bar_switcher');
		$pakghor_search_switcher = isset($_pakghor_page_options['pakghor_search_switcher']) ? $_pakghor_page_options['pakghor_search_switcher'] : cs_get_option( 'pakghor_search_switcher' );
		$pakghor_logo_dark_height = cs_get_option('pakghor_logo_dark_height');
		$pakghor_logo_dark_width = cs_get_option('pakghor_logo_dark_width');
		$pakghor_header_top_groups	= cs_get_option( 'pakghor_header_top_groups' );
		$pakghor_social_switcher 	= cs_get_option( 'pakghor_social_switcher');
		$pakghor_menu_book_btn_option = cs_get_option( 'pakghor_menu_book_btn_option' );
		$pakghor_header_social 		= cs_get_option( 'pakghor_header_social' );
		$pakghor_menu_book_btn_text	= cs_get_option( 'pakghor_menu_book_btn_text' );
		$pakghor_menu_book_btn_url	= cs_get_option( 'pakghor_menu_book_btn_url' );
		$pakghor_add_to_cart 		= cs_get_option( 'pakghor_add_to_cart', 'pakghor' );
		$pakghor_header_top_bgc		= cs_get_option( 'pakghor_header_top_bgc', 'pakghor' );
		$pakghor_header_bottom_bgc 	= cs_get_option( 'pakghor_header_bottom_bgc' );
		$pakghor_header_top_bar_info = cs_get_option( 'pakghor_header_top_bar_info' );
		$pakghor_header_loaction  	= cs_get_option( 'pakghor_header_loaction' );
		$pakghor_header_phone  		= cs_get_option( 'pakghor_header_phone' );
		$pakghor_working_days  		= cs_get_option( 'pakghor_working_days' );
	endif;
	$pakghor_logo_dark = wp_get_attachment_image_src($pakghor_theme_logo_dark, 'full');
	$htop_classes = array('header-top');
    $htop_class = implode(' ', $htop_classes);
    $htop_attr = array();
    $htop_attr[] = 'class="'. esc_attr($htop_class) .'"';
    if( !empty($pakghor_header_top_bgc) ){
        $section_attr[] ='style="background-color:'.esc_attr($pakghor_header_top_bgc).'"';
    }
    $logo_dark_attrs = array();
    if( ! empty( $pakghor_logo_dark_width ) ){
    	$logo_dark_attrs[] = 'width:' . esc_attr( $pakghor_logo_dark_width ) .'';
    }
    if( ! empty( $pakghor_logo_dark_height ) ){
    	$logo_dark_attrs[] = 'height:' . esc_attr( $pakghor_logo_dark_height ) .'';
    }
 ?>
	<header class="header style-2 main-nav">
		<?php if( $pakghor_header_top_bar_switcher == 1 ): ?>
		<div <?php echo implode(' ', $htop_attr); ?>>
			<div class="container">
				<div class="row">
				<?php if( ! empty( $pakghor_header_top_bar_info ) ) : ?>
					<div class="header-top-left">
						<ul>
							<?php if(!empty($pakghor_header_loaction)) : ?>
							<li><i class="fa fa-home"></i><?php echo esc_html($pakghor_header_loaction); ?></li>
							<?php endif; ?>

       						<?php if(!empty($pakghor_header_loaction)) : ?>
							<li><i class="fa fa-phone"></i><?php echo esc_html($pakghor_header_phone); ?></li>
							<?php endif ?>
 								<?php if(!empty($pakghor_header_loaction)) : ?>
							<li><i class="fa fa-calendar"></i><?php echo esc_html($pakghor_working_days); ?></li>
							<?php endif ?>
						</ul>
					</div><!-- Header top left -->
					<?php endif; ?>
					
					<?php if($pakghor_social_switcher == 1 || $pakghor_menu_book_btn_option == 1 ): ?>
					<div class="header-top-right">
						<?php if( $pakghor_social_switcher == 1 && !empty($pakghor_header_social) ): ?>
						<div class="social-profiles">
							<ul>
								<?php foreach ($pakghor_header_social as $pakghor_header_social_single ) : ?>
								<li><a href="<?php echo esc_url($pakghor_header_social_single['pakghor_social_link']) ?>"><i class="<?php echo esc_attr($pakghor_header_social_single['pakghor_social_icon']); ?>"></i></a></li>
							<?php endforeach; ?>
							</ul>
						</div><!-- Social profiles -->
						<?php endif; ?>
						
					<?php if( $pakghor_menu_book_btn_option == 1 && !empty($pakghor_menu_book_btn_text) || !empty($pakghor_menu_book_btn_url)) : ?>
						<div class="book-table">
							<a href="<?php echo esc_url($pakghor_menu_book_btn_url) ?>"><?php echo esc_html($pakghor_menu_book_btn_text) ?></a>
						</div> <!-- Book a table -->
						<?php endif; ?>
					</div><!-- Header top Right -->
					<?php endif; ?>
				</div>
			</div><!-- Container -->
		</div><!-- Header top -->
		<?php endif; ?>
		<div class="main-menu">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
					    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					       <span class="sr-only"><?php echo esc_html__('Toggle navigation', 'pakghor'); ?></span>
					       <span class="icon-bar"></span>
					       <span class="icon-bar"></span>
					       <span class="icon-bar"></span>
					    </button>
					    <?php if( $pakghor_theme_logo_dark ): ?>
						<div class="navbar-brand logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img <?php  if( ! empty( $pakghor_logo_dark_width ) || ! empty( $pakghor_logo_dark_height ) ) : ?> style="<?php echo implode( '; ', $logo_dark_attrs ); ?>" <?php endif; ?> src="<?php echo esc_url($pakghor_logo_dark['0']); ?>" alt="<?php echo get_bloginfo('name') ?>"></a>
						</div>
						<?php else: ?>
						<div class="navbar-brand logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2><?php echo esc_html(get_bloginfo('name')); ?></h2></a>
						</div>
						<?php endif; ?>
					    <?php if( $pakghor_search_switcher == 1 ): ?>
					    <div class="search-area">
					    	<i class="fa fa-search icon-1"></i>
					    	<i class="fa fa-times icon-2"></i>
					    	<form class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
								<input type="search" name="s" placeholder="<?php echo esc_attr__('Search Your Queries', 'pakghor') ?>">
							</form><!-- Search form -->
					    </div><!-- search-area -->
						<?php endif; ?>
					</div><!-- navbar header -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<?php
							if( has_nav_menu('menu-home') ){
								wp_nav_menu(array(
									'theme_location'	=> 'menu-home',
									'menu_class'		=> 'nav navbar-nav',
									'container'			=> false,
									'walker'			=> new pakghor_nav_walker(),
								));
							}
						?>
						<?php if($pakghor_search_switcher == 1 || $pakghor_add_to_cart == 1 ) : ?>
					    <div class="menu-right-area">
							<?php if( $pakghor_search_switcher == 1 ): ?>
				    	    <div class="right search-area">
				    	    	<i class="fa fa-search icon-1"></i>
				    	    	<i class="fa fa-times icon-2"></i>
				    	    	<form class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
				    				<input type="search" name="s" placeholder="<?php echo esc_attr__('Search Your Queries', 'pakghor') ?>">
				    			</form><!-- Search form -->
				    	    </div><!-- search-area -->
							<?php endif; ?>
						<?php if( class_exists( 'WooCommerce' ) && $pakghor_add_to_cart == 1 ):
							if(function_exists('pakghor_woocommerce_mini_cart_dropdown')){
								pakghor_woocommerce_mini_cart_dropdown();
							}
						 ?>
							<?php endif; ?>
					    </div>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- container -->
		</div><!-- main menu -->
	</header><!-- header-end -->