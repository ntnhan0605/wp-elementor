<?php
require 'inc/init.php';
require 'init/init.php';
require 'rn-ext/rn-ext.php';

require 'user/functions.php';

/**
 * WP Elementor Theme Enqueue styles
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function ntn_theme_style()
{
	wp_enqueue_style('bootstrap', get_theme_file_uri('assets/css/bootstrap.min.css'), array(), null, 'all');
	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Noticia+Text:400,400i,700,700i|Quicksand:300,400,500,600,700&display=swap&subset=vietnamese', null, null, 'all');
	wp_enqueue_style('material', get_theme_file_uri('assets/css/materialdesignicons.min.css'), null, null, 'all');
	wp_enqueue_style('style', get_theme_file_uri('assets/css/style.css'), null, null, 'all');
}
add_action('wp_enqueue_scripts', 'ntn_theme_style', 20);


/**
 * WP Elementor Theme Enqueue scripts
 *
 * @param string $handle Script name
 * @param string $src Script url
 * @param array $deps (optional) Array of script names on which this script depends
 * @param string|bool $ver (optional) Script version (used for cache busting), set to null to disable
 * @param bool $in_footer (optional) Whether to enqueue the script before </head> or before </body>
 */
function ntn_theme_script()
{
	wp_enqueue_script('bootstrap', get_theme_file_uri('assets/js/bootstrap.bundle.min.js'), array('jquery'), null, true);
	wp_enqueue_script('script', get_theme_file_uri('assets/js/script.js'), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'ntn_theme_script', 20);


function ntn_theme_support()
{
	load_theme_textdomain('ntn_ext');

	add_theme_support('automatic-feed-links');

	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(1200, 9999);

	add_theme_support('custom-logo', array(
		'height'      => 150,
		'width'       => 240,
		'flex-height' => true,
	));

	register_nav_menus(array(
		'main_menu' => __('Main Menu', 'ntn-ext')
	));
}
add_action('init', 'ntn_theme_support');