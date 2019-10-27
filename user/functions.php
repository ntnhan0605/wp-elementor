<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function getRold($role) {
	return wp_roles()->get_role($role);
}

if (!function_exists('addRoleUser')) {
	add_action( 'after_switch_theme', 'addRoleUser' );
	function addRoleUser() {
		if (!get_role('user')) {
			
		}
	}
}


add_action( 'wp_ajax_nopriv_loginuser', 'nopriv_loginuser' );
function nopriv_loginuser() {
	$info = array();
    $info['user_login'] = $_POST['log'];
    $info['user_password'] = $_POST['pwd'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if (is_user_logged_in()) {
    	echo json_encode($user_signon);
    } else {
    	echo 'false';
    }
	die();
}

add_action( 'wp_ajax_loginuser', 'loginuser' );
function loginuser() {
	if (is_user_logged_in()) {
		echo 'true';
	} else {
		echo 'false';
	}
	die();
}







// Create page User Login
// if (!function_exists('createPageUser')) {
// 	add_action( 'after_switch_theme', 'createPageUser' );
// 	function createPageUser() {
// 		$ID = checkPage('user-login');
// 		if ($ID) {
// 			if (get_page_template_slug( $ID ) !== 'user/user-login.php') {
// 				update_post_meta( $ID, '_wp_page_template', 'user/user-login.php' );
// 			}
// 		} else {
// 			$ID = wp_insert_post(array(
// 				'post_title' => 'User',
// 				'post_name' => 'user-login',
// 				'post_type' => 'page',
// 				'post_status' => 'publish'
// 			));
// 			if ($ID) {
// 				update_post_meta( $ID, '_wp_page_template', 'user/user-login.php' );
// 			}
// 		}
// 	}
// 	function checkPage($slug) {
// 		$pages = get_posts(array(
// 			'post_type' => 'page',
// 			'pagename' => $slug
// 		));
// 		if (!empty($pages)) {
// 			return $pages[0]->ID;
// 		} else {
// 			return false;
// 		}
// 	}
// }

if (!function_exists('loginRedirect')) {
	add_action( 'wp_login', 'loginRedirect' );
	function loginRedirect() {

	}
}