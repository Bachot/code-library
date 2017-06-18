<?php
/*
* Plugin Name: ibrainiD Logout Menu item
* Description: On clicking the log out button will redirect you stratight to tthe homepage
* Version: 1.0
* Author: Bachot Mpunga
* Author URI: www.bachotdesign.com
*/
/*** === Custom menu logged menu ======= ***/
 function vxg_menu() {
		register_nav_menus(
			array(
				'logged-menu' => __( 'Logged Menu' )
			)
		);
}
add_action( 'init', 'vxg_menu' );

/*** === Menu logout/login ============= ***/
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (is_user_logged_in() && $args->theme_location == 'logged-menu') {
        $items .= '<li><a href="'. wp_logout_url( home_url() ) .'">LOG OUT</a></li>';
    }
    elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
        $items .= '<li><a href="'. site_url('control-panel') .'">Log In</a></li>';
    }
    return $items;
}
