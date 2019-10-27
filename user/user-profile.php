<?php
/*
*	Template Name: User profile
*	Template Post Type: page
*/
if (is_user_logged_in()) {
	wp_redirect( './login/' );
	exit;
} else {
	echo 'Loged in';
}


 ?>