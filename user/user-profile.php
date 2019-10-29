<?php
/*
*	Template Name: User profile
*	Template Post Type: page
*/
echo '<html>';
echo '<body>';
if (!is_user_logged_in()) {
	wp_redirect( './user-login/' );
	exit;
} else {
	echo 'Loged none';
	echo '<p style="max-width: 100vw; ">'.json_encode(wp_get_current_user()).'</p>';
	echo '<a href="'.wp_logout_url( './user-login/' ).'">Log out</a>';
}
echo '</body>';
echo '</html>';

 ?>