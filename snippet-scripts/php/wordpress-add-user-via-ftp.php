/*** Replace these credentials with yours ***/
function wp_add_admin_account(){
	$user = 'yourname';
	$pass = 'mypassword';
	$email = 'youremail@mail.com';
	if ( !username_exists( $user )  && !email_exists( $email ) ) {
	$user_id = wp_create_user( $user, $pass, $email );
	$user = new WP_User( $user_id );
	$user->set_role( 'administrator' );
	} 
}
add_action('init','wp_add_admin_account');