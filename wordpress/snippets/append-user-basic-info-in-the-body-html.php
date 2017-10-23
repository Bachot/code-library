<?php
/* 
 ==========================================================================
 INFORMATION
 ========================================================================== 
 * Title     	: Append User Basic Info in the Body Html
 * Description 	: Appending basic user profile information in the html 
                  body tag which will have a hiddenn attribute property
 * Version      : 1.0.0
 * Author		: Bachot Mpunga
 *                https://za.linkedin.com/in/bachot-mpunga-bashala-b834191b
 * Author URI   : bachotdesign.com
 * Company      : Struto
                : https://www.struto.co.uk/
*/
function uih_user_info_js(){
	$current_user = wp_get_current_user();
	
	$js = '<script>
			jQuery(function(){
				jQuery(window).on("load", function(){
					var html = [];
					html.push("<input name='."'userlogin'". ' value='."'". $current_user->user_login ."'". '/>");
					html.push("<input name='."'email'". ' value='."'". $current_user->user_email ."'". '/>");
					html.push("<input name='."'firstname'". ' value='."'". $current_user->user_firstname ."'". '/>");
					html.push("<input name='."'lastname'". ' value='."'". $current_user->user_lastname ."'". '/>");
					html.push("<input name='."'website'". ' value='."'". $current_user->user_website ."'". '/>");
					jQuery("body").append("<div id='."'uih-user-info-js'".' style='."'display: none'".' hidden></div>");
					jQuery("#uih-user-info-js").append(html);
				});
		   });
		</script>';
	echo $js . "First name" . $current_user->user_login . " Email: " . $current_user->user_email;
}
add_action('wp_footer','uih_user_info_js');