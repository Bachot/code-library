<?php
/* 
 ==========================================================================
 INFORMATION
 ========================================================================== 
 * Title     	: Add user role as class at the body tag
 * Description 	: This script helping you to add user role as a class in the body tag
 * Version      : 1.0.0
 * Author		: Bachot Mpunga
 *                https://za.linkedin.com/in/bachot-mpunga-bashala-b834191b
 * Author URI   : bachotdesign.com
 * Company      : Struto
                : https://www.struto.co.uk/
				
 *** Example ****
  <body class="subscriber editor"> 
  Why use this:
   - This method will help you targeting child node classes within your html
*/
/*************************************************************
					*** USER JOURNEY ***
 *************************************************************/
/*** Targeting particular CSS classes 
    with different content user level access ***/ 
function urc_class_user() {
	$class_user_access = "";
	$space = " ";
	$css_prefix = "urc-";
	$sp_pref = $space . $css_prefix; //Space and prefix
	$class_user = wp_get_current_user();
	if ( in_array( 'subscriber', (array) $class_user->roles )):
		$class_user_access .= $sp_pref . "subscriber";
	endif; 
	if ( in_array( 'editor', (array) $class_user->roles )):
		$class_user_access .= $sp_pref . "editor";
	endif;
	if ( in_array( 'contributor', (array) $class_user->roles ) ):
		$class_user_access .= $sp_pref. "contributor";
	endif; 
	if ( in_array( 'administrator', (array) $class_user->roles )):
		$class_user_access .= $sp_pref . "administrator";
	endif;
	
	return $class_user_access;
	
}
add_filter( 'body_class', function( $classes ) {  
		return array_merge( $classes, array( urc_class_user() ) ); 
	} 
);
