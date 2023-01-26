<?php
/*
** Class to include all files
*/
class Pakghor_Includes {
	private static $rel_path = null;

	private static $include_isolated_callable;

	private static $initialized = false;

	public static function init()
	{
		if (self::$initialized) {
			return;
		} else {
			self::$initialized = true;
		}

		/**
		 * Include a file isolated, to not have access to current context variables
		 */
		self::$include_isolated_callable = create_function('$path', 'include $path;');

		/**
		 * Both frontend and backend
		 */
		{		
			self::include_child_first( '/static.php' );
			self::include_child_first( '/includes/pakghor-pagination.php' );
			self::include_child_first( '/includes/pakghor-comment-template.php' );
			self::include_child_first( '/includes/healper.php' );
			self::include_child_first( '/widgets.php' );
			self::include_child_first( '/pakghor-wp-bootstrap-navwalker.php' );
			self::include_child_first( '/includes/breadcrumbs.php' );
			self::include_child_first( '/tgm-plugin-activation/class-tgm-plugin-activation.php' );
			self::include_child_first( '/tgm-plugin-activation/tgm-plugin-setup.php' );
			self::include_child_first( '/includes/woocommerce-hooks.php' );
			self::include_child_first( '/theme-setup.php' );
            self::include_child_first( '/custom-header.php' );
			self::include_child_first( '/customizer.php' );
			self::include_child_first( '/jetpack.php' );
			self::include_child_first( '/template-functions.php' );
			self::include_child_first( '/template-tags.php' );
			
			add_action('init', array(__CLASS__, '_vc_shortcode_action_init'));   
            if (function_exists('cs_get_option')):
                self::include_child_first('/codestar-widget-config.php');
                add_action('widgets_init', array(__CLASS__, '_action_widgets_init'));
            endif;                        
		}
	}

	private static function get_rel_path($append = '')
	{
		if (self::$rel_path === null) {
			$framework_url = get_template_directory() . '/inc';
			self::$rel_path = '/'. basename($framework_url);
		}

		return self::$rel_path . $append;
	}

	/**
	 * @param string $dirname 'foo-bar'
	 * @return string 'Foo_Bar'
	 */
	private static function dirname_to_classname($dirname) {
		$class_name = explode('-', $dirname);
		$class_name = array_map('ucfirst', $class_name);
		$class_name = implode('_', $class_name);

		return $class_name;
	}

	public static function get_parent_path($rel_path){
		return get_template_directory() . self::get_rel_path($rel_path);
	}

	public static function get_child_path($rel_path){
		if (!is_child_theme()) {
			return null;
		}

		return get_stylesheet_directory() . self::get_rel_path($rel_path);
	}

	public static function include_isolated($path){
		call_user_func(self::$include_isolated_callable, $path);
	}

	public static function include_child_first($rel_path){
		if ( is_child_theme() ) {
			$path = self::get_child_path($rel_path);

			if (file_exists($path)) {
				self::include_isolated($path);
			}
		}

		{
			$path = self::get_parent_path($rel_path);

			if (file_exists($path)) {
				self::include_isolated($path);
			}
		}
	}

    /**
	 * @visual composer shortcode
	 */
	public static function _vc_shortcode_action_init(){
		self::include_child_first('/shortcode/feature-1.php');//done
		self::include_child_first('/shortcode/feature-2.php');//done
		self::include_child_first('/shortcode/team.php');//done
		self::include_child_first('/shortcode/latest-post.php');//done
		self::include_child_first('/shortcode/testimonial.php');//done
		self::include_child_first('/shortcode/reservation-form.php');//done
		self::include_child_first('/shortcode/reservation-form-two.php');//done
		self::include_child_first('/shortcode/newsletter-form.php');//done
		self::include_child_first('/shortcode/about.php');//done
		self::include_child_first('/shortcode/reservation-button.php');//done
		self::include_child_first('/shortcode/food-package.php');//done
		self::include_child_first('/shortcode/food-gallery.php');//done
		self::include_child_first('/shortcode/food-gallery-masonry.php');//done
		self::include_child_first('/shortcode/services.php');//done
		self::include_child_first('/shortcode/special-event.php');//done
		self::include_child_first('/shortcode/contact-info-form.php');//done
		self::include_child_first('/shortcode/google-map.php');//done
		self::include_child_first('/shortcode/woo-products/product-slider.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-one.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-two.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-three.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-four.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-five.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-six.php');//done
		self::include_child_first('/shortcode/woo-products/product-day-package.php');//done
		self::include_child_first('/shortcode/woo-products/product-style-seven.php');//done
        self::include_child_first('/shortcode/map-multiple-location.php');//done
		
	}

	/**
	 * @internal
	 */
	public static function _action_widgets_init(){
		{
			$paths = array();

			if (is_child_theme()) {
				$paths[] = self::get_child_path('/widgets');
			}

			$paths[] = self::get_parent_path('/widgets');
		}

		$included_widgets = array();

		foreach ($paths as $path) {
			$dirs = glob($path .'/*', GLOB_ONLYDIR);

			if (!$dirs) {
				continue;
			}

			foreach ($dirs as $dir) {
				$dirname = basename($dir);

				if (isset($included_widgets[$dirname])) {
					// this happens when a widget in child theme wants to overwrite the widget from parent theme
					continue;
				} else {
					$included_widgets[$dirname] = true;
				}

				self::include_isolated($dir .'/class-widget-'. $dirname .'.php');

				register_widget('Widget_'. self::dirname_to_classname($dirname));
			}
		}
	}    
}

Pakghor_Includes::init();