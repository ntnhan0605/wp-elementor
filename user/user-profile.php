<?php
/*
*	Template Name: User profile
*	Template Post Type: page
*/
get_header();
add_filter('show_admin_bar', '__return_false');
if (!is_user_logged_in()) {
	wp_redirect( './user-login/' );
	exit;
} else {
	echo 'Loged none';
	echo '<p style="max-width: 100%; ">'.json_encode(wp_get_current_user()).'</p>';
	echo '<a href="'.wp_logout_url( './user-login/' ).'">Log out</a>';
}

?>

<?php get_footer() ?>