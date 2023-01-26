<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Topnews for publication on 
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 */
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pakghor_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function pakghor_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => esc_html__('WPBakery Visual Composer','pakghor'),
			'slug'               => 'js_composer',
			'source'             => get_template_directory() . '/inc/plugins/js_composer.zip',
			'required'           => true,
			'version'            => ' 6.7.0',
			'force_activation'   => false,
			'force_deactivation' => true,
		),
		array(
			'name'               => esc_html__('Revolution Slider','pakghor'),
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/inc/plugins/revslider.zip',
			'required'           => true,
			'version'            => '6.5.8',
			'force_activation'   => false,
			'force_deactivation' => true,
		),
		array(
			'name'               => esc_html__('Codestar Framework','pakghor'),
			'slug'               => 'codestar-framework',
			'source'             => get_template_directory() . '/inc/plugins/codestar-framework.zip',
			'required'           => true,
			'version'            => '1.0.1',
			'force_activation'   => false,
			'force_deactivation' => true,
		),
		array(
			'name'               => esc_html__('Pakghor Custom Post','pakghor'),
			'slug'               => 'pakghor-custom-post',
			'source'             => get_template_directory() . '/inc/plugins/pakghor-custom-post.zip',
			'required'           => true,
			'version'            => '1.0.0',
			'force_activation'   => false,
			'force_deactivation' => true,
		),
		array(
			'name'               => esc_html__('Pakghor Social Share','pakghor'),
			'slug'               => 'pakghor-social-share',
			'source'             => get_template_directory() . '/inc/plugins/pakghor-social-share.zip',
			'required'           => true,
			'version'            => '1.0.0',
			'force_activation'   => false,
			'force_deactivation' => true,
		),
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => esc_html__('Contact Form 7','pakghor'),
			'slug'      => 'contact-form-7',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('Woocommerce','pakghor'),
			'slug'      => 'woocommerce',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('Easy Twitter Feed Widget','pakghor'),
			'slug'      => 'easy-twitter-feed-widget',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('MailPoet Newsletters (New)','pakghor'),
			'slug'      => 'mailpoet',
			'required'  => true,
		),
		array(
			'name'      => esc_html__('User Profile Picture','pakghor'),
			'slug'      => 'metronet-profile-picture',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('WordPress Importer','pakghor'),
			'slug'      => 'wordpress-importer',
			'required'  => false,
		),
		array(
			'name'      => esc_html__('One Click Demo Import','pakghor'),
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

	);
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'pakghor',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.		
	);

	tgmpa( $plugins, $config );
}