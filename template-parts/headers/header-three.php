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
//  Header style Three
	$pakghor_theme_logo = $pakghor_theme_logo_width = $pakghor_theme_logo_height = $pakghor_theme_logo_dark = $pakghor_logo_dark_height = $pakghor_logo_dark_width = $pakghor_header_top_bar_switcher = $pakghor_header_top_bar_info = $pakghor_header_loaction_title = $pakghor_header_loaction = $pakghor_header_phone_title = $pakghor_header_phone = $pakghor_header_working_title = $pakghor_working_days = $header_top_slogan = $pakghor_social_switcher	= $pakghor_menu_book_btn_option = $pakghor_header_social = $pakghor_menu_book_btn_text = $pakghor_menu_book_btn_url = $pakghor_search_switcher = $pakghor_header_top_bgc = $pakghor_header_bottom_bgc = $_pakghor_page_options = '';
	if( function_exists('cs_get_option') ) :
		if( is_page() ):
			$_pakghor_page_options = get_post_meta( get_the_ID(), '_pakghor_custom_page_options', true );
		endif;
		if( !empty($_pakghor_page_options['pakghor_theme_logo']) ){
			$pakghor_theme_logo = $_pakghor_page_options['pakghor_theme_logo'];
		}else{
			$pakghor_theme_logo = cs_get_option( 'pakghor_theme_logo' );
		}
		if( !empty($_pakghor_page_options['pakghor_theme_logo_dark']) ){
			$pakghor_theme_logo_dark = $_pakghor_page_options['pakghor_theme_logo_dark'];
		}else{
			$pakghor_theme_logo_dark = cs_get_option( 'pakghor_theme_logo_dark' );
		}
		$pakghor_header_top_bar_switcher = isset($_pakghor_page_options['pakghor_header_top_bar_switcher']) ? $_pakghor_page_options['pakghor_header_top_bar_switcher'] : cs_get_option('pakghor_header_top_bar_switcher');
		$pakghor_search_switcher = isset($_pakghor_page_options['pakghor_search_switcher']) ? $_pakghor_page_options['pakghor_search_switcher'] : cs_get_option( 'pakghor_search_switcher' );
		$pakghor_theme_logo_width 		= cs_get_option('pakghor_theme_logo_width');
		$pakghor_theme_logo_height 		= cs_get_option('pakghor_theme_logo_height');
		$pakghor_logo_dark_height 		= cs_get_option('pakghor_logo_dark_height');
		$pakghor_logo_dark_width 		= cs_get_option('pakghor_logo_dark_width');
		$header_top_slogan				= cs_get_option( 'header_top_slogan' );
		$pakghor_social_switcher		= cs_get_option( 'pakghor_social_switcher' );
		$pakghor_menu_book_btn_option	= cs_get_option( 'pakghor_menu_book_btn_option' );
		$pakghor_header_social 			= cs_get_option( 'pakghor_header_social' );
		$pakghor_menu_book_btn_text		= cs_get_option( 'pakghor_menu_book_btn_text' );
		$pakghor_menu_book_btn_url		= cs_get_option( 'pakghor_menu_book_btn_url' );
		$pakghor_header_top_bgc			= cs_get_option( 'pakghor_header_top_bgc' );
		$pakghor_header_bottom_bgc		= cs_get_option( 'pakghor_header_bottom_bgc' );
		$pakghor_header_top_bar_info	= cs_get_option( 'pakghor_header_top_bar_info' );
		$pakghor_header_loaction_title	= cs_get_option( 'pakghor_header_loaction_title' );
		$pakghor_header_loaction 		= cs_get_option( 'pakghor_header_loaction' );
		$pakghor_header_phone_title		= cs_get_option( 'pakghor_header_phone_title' );
		$pakghor_header_phone 			= cs_get_option( 'pakghor_header_phone' );
		$pakghor_header_working_title 	= cs_get_option( 'pakghor_header_working_title' );
		$pakghor_working_days 			= cs_get_option( 'pakghor_working_days' );
	endif;
	$pakghor_logo = wp_get_attachment_image_src($pakghor_theme_logo, 'full');
	$pakghor_logo_dark = wp_get_attachment_image_src($pakghor_theme_logo_dark, 'full');
	$htop_classes = array('header-top');
    $htop_class = implode(' ', $htop_classes);
    $htop_attr = array();
    $htop_attr[] = 'class="'. esc_attr($htop_class) .'"';
    if( !empty($pakghor_header_top_bgc) ){
        $section_attr[] ='style="background-color:'.esc_attr($pakghor_header_top_bgc).'"';
    }
    $hbottom_classes = array('logo-search-area');
    $hbottom_class = implode(' ', $hbottom_classes);
    $hbottom_attr = array();
    $hbottom_attr[] = 'class="'. esc_attr($hbottom_class) .'"';
    if( !empty($pakghor_header_bottom_bgc) ){
        $section_attr[] ='style="background-color:'.esc_attr($pakghor_header_top_bgc).'"';
    }
    $logo_attrs = array();
    if( !empty($pakghor_theme_logo_width) ){
    	$logo_attrs[] = 'width:' . esc_attr( $pakghor_theme_logo_width ) .'';
    }
    if( !empty($pakghor_theme_logo_height) ){
    	$logo_attrs[] = 'height:' . esc_attr( $pakghor_theme_logo_height ) .'';
    }
    $logo_dark_attrs = array();
    if( ! empty( $pakghor_logo_dark_width ) ){
    	$logo_dark_attrs[] = 'width:' . esc_attr( $pakghor_logo_dark_width ) .'';
    }
    if( ! empty( $pakghor_logo_dark_height ) ){
    	$logo_dark_attrs[] = 'height:' . esc_attr( $pakghor_logo_dark_height ) .'';
    }

    wp_enqueue_style('pakghor-flaticon');

 ?>
	<!-- Header style 3-->
	<header class="header style-3">
	<?php if( $pakghor_header_top_bar_switcher == 1 ): ?>
		<div <?php echo implode(' ', $htop_attr); ?>>
			<div class="container">
				<div class="row">
					<?php if( !empty($header_top_slogan) ) : ?>
					<div class="header-top-left">
						<ul>
							<?php if( ! empty( $header_top_slogan ) ): ?>
							<li><?php echo esc_html($header_top_slogan); ?></li>
							<?php endif; ?>
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
		<div <?php echo implode(' ', $hbottom_attr); ?>>
			<div class="container">
				<div class="row">
					<?php if( $pakghor_theme_logo ): ?>
					<div class="col-md-3">
						<div class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img <?php  if(!empty($pakghor_theme_logo_width) || !empty($pakghor_theme_logo_height) ) : ?> style="<?php echo implode( '; ', $logo_attrs ); ?>" <?php endif; ?> src="<?php echo esc_url($pakghor_logo['0']); ?>" alt="<?php echo get_bloginfo('name') ?>"></a>
						</div><!-- logo -->
					</div>
					<?php else: ?>
					<div class="col-md-3">
						<div class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2><?php echo esc_html(get_bloginfo('name')); ?></h2></a>
						</div><!-- logo -->
					</div>
					<?php endif; ?>
					<?php if( $pakghor_header_top_bar_switcher	== 1 && !empty($pakghor_header_top_bar_info) ) : ?>
						<div class="col-md-9">
							<div class="logo-area-right">
								<ul>
									<?php if(!empty($pakghor_header_loaction_title	) || $pakghor_header_loaction ) : ?>
									<li class="place">
										<?php if(!empty($pakghor_header_loaction)): ?>
										<i class="flaticon-signs"></i>
										<?php endif; ?>
										<div class="area-content">
											<?php if(!empty($pakghor_header_loaction_title)): ?>
											<h2><?php echo esc_html($pakghor_header_loaction_title); ?></h2>
											<?php endif; ?>
											<?php if(!empty($pakghor_header_loaction)): ?>
											<span><?php echo esc_html($pakghor_header_loaction); ?> </span>
											<?php endif; ?>
										</div>
									</li>
									<?php endif; ?>
									<?php if( !empty($pakghor_header_phone_title) || !empty($pakghor_header_phone) ) : ?>
									<li class="phone">
										<?php if( !empty($pakghor_header_phone)) : ?>
										<i class="flaticon-phone-call"></i>
										<?php endif; ?>
										<div class="area-content">
											<?php if(!empty($pakghor_header_phone_title)) : ?>
											<h2><?php echo esc_html($pakghor_header_phone_title); ?></h2>
											<?php endif; ?>
											<?php if(!empty($pakghor_header_phone)): ?>
											<span><?php echo esc_html($pakghor_header_phone); ?></span>
											<?php endif; ?>
										</div>
									</li>
									<?php endif; ?>
									<?php if(! empty($pakghor_header_working_title ) || !empty($pakghor_working_days) ) : ?>
									<li class="clock">
										<?php if(!empty($pakghor_working_days)): ?>
										<i class="flaticon-time-is-running"></i>
										<?php endif; ?>
										<div class="area-content">
											<?php if(!empty($pakghor_header_working_title)): ?>
											<h2><?php echo esc_html($pakghor_header_working_title); ?></h2>
											<?php endif; ?>
											<?php if(!empty($pakghor_working_days)): ?>
											<span><?php echo esc_html($pakghor_working_days); ?> </span>
											<?php endif; ?>
										</div>
									</li>
									<?php endif; ?>

								</ul>
							</div><!--Logo Area Right-->
						</div>
					<?php endif; ?>
				</div>
			</div><!--Container-->
		</div><!--Logo Area-->
		<div class="main-menu main-nav">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
					    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					       <span class="sr-only"><?php echo esc_html__('Toggle navigation', 'pakghor') ?></span>
					       <span class="icon-bar"></span>
					       <span class="icon-bar"></span>
					       <span class="icon-bar"></span>
					    </button>

						<?php if( $pakghor_theme_logo_dark ): ?>
						<a class="navbar-brand logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img <?php  if( ! empty( $pakghor_logo_dark_width ) || ! empty( $pakghor_logo_dark_height ) ) : ?> style="<?php echo implode( '; ', $logo_dark_attrs ); ?>" <?php endif; ?> src="<?php echo esc_url($pakghor_logo_dark['0']); ?>" alt="<?php echo get_bloginfo('name') ?>"></a>
						<?php else: ?>
						<a class="navbar-brand logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><h2><?php echo esc_html(get_bloginfo('name')); ?></h2></a>
						<?php endif; ?>

 						<?php if( $pakghor_search_switcher == 1 ): ?>
					    <div class="search-area">
					    	<i class="fa fa-search icon-1"></i>
					    	<i class="fa fa-times icon-2"></i>
					    	<form class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
								<input type="search" name="s" placeholder="<?php echo esc_attr__('Search Your Queries', 'pakghor') ?>">
							</form><!-- Search form -->
					    </div>
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
						<?php if( $pakghor_search_switcher == 1 ): ?>
					    <div class="search-box">
					    	<form class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
								<input type="search" name="s" placeholder="<?php echo esc_attr__('Search Your Queries', 'pakghor') ?>">
					    	</form><!-- Search form -->
					    </div><!-- Search area -->
						<?php endif; ?>
					</div>
				</div>
			</div><!-- container -->
		</div><!-- main menu -->
	</header><!-- Header end -->