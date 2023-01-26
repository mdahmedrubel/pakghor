<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * Template Name: Full Width Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pakghor
 * @author CodexCoder
 * @since 1.0.0
 * @version 1.0.0
 */

get_header(); 

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', 'fullwidth' );

	endwhile; // End of the loop.

get_footer();