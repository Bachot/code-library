<?php
/* 
 ==========================================================================
 INFORMATION
 ========================================================================== 
 * Title     	: Auto login
 * Description 	: This will help the user to straight logged in after registration
*/
function aln_auto_login_new_user( $user_id ) {
	wp_set_current_user($user_id);
	wp_set_auth_cookie($user_id);
	// Replace the my-account-setting with yours
	wp_redirect( '/my-account-setting' );
	// You can change home_url() to the specific URL, such as
	//wp_redirect( home_url() );
	exit;
}
add_action( 'user_register', 'aln_auto_login_new_user' );