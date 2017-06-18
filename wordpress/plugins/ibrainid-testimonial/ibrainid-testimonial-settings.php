<?php
function ibrainid_team_settings_custom_path() {
	$set_var = get_option( 'ibrteamset_settings' );
	if ( empty($set_var['ibrteamset_custom_slug']) ) {
		return 'ibr-team';
	} else {
		return $set_var['ibrteamset_custom_slug'];
	}
}
add_action( 'admin_menu', 'ibrteamset_add_admin_menu' );
add_action( 'admin_init', 'ibrteamset_settings_init' );
/*
function ibrteamset_add_admin_menu(  ) { 
	add_options_page( 'ibrainiD Team Settings', 'ibrainiD Team Settings', 'manage_options', 'ibrainid_team_settings', 'ibrteamset_options_page' );
}*/
function ibrteamset_add_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=ibrainid_team',
        __('ibrainiD Team Settings Options', 'team'),
        __('ibrainiD Team Settings', 'team'),
        'manage_options',
        'ibrainid_team_settings',
        'ibrteamset_options_page'
	);
}
function ibrteamset_settings_init() { 
	register_setting( 'pluginPage', 'ibrteamset_settings' );
	add_settings_section(
		'ibrteamset_pluginPage_section', 
		__( 'Team Setting', 'wordpress' ), 
		'ibrteamset_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'ibrteamset_custom_slug', 
		__( 'Custom slug', 'ibr-team' ), 
		'ibrteamset_custom_slug_render', 
		'pluginPage', 
		'ibrteamset_pluginPage_section' 
	);
	add_settings_field( 
		'ibrteamset_socialmedia1', 
		__( 'Social media 1', 'ibr-socialmedia1' ), 
		'ibrteamset_socialmedia1_render', 
		'pluginPage', 
		'ibrteamset_pluginPage_section' 
	);
	add_settings_field( 
		'ibrteamset_socialmedia2', 
		__( 'Social media 2', 'ibr-socialmedia2' ), 
		'ibrteamset_socialmedia2_render', 
		'pluginPage', 
		'ibrteamset_pluginPage_section' 
	);
	add_settings_field( 
		'ibrteamset_socialmedia3', 
		__( 'Social media 3', 'ibr-socialmedia3' ), 
		'ibrteamset_socialmedia3_render', 
		'pluginPage', 
		'ibrteamset_pluginPage_section' 
	);
}
function ibrteamset_custom_slug_render(  ) { 
	$options = get_option( 'ibrteamset_settings' );
	?>
	<input type='text' name='ibrteamset_settings[ibrteamset_custom_slug]' value='<?php echo $options['ibrteamset_custom_slug']; ?>' style="width: 80%">
	<h1>Shortcode</h1>
	<p>You can change values</p>
	<p>[ibrteam category="" class="my-class" imgsize="thumbnail" butttontext="More" ]</p>
	<?php 
}
function ibrteamset_socialmedia1_render(  ) { 
	$options = get_option( 'ibrteamset_settings' );
	?>
	<input type='text' name='ibrteamset_settings[ibrteamset_socialmedia1]' value='<?php echo $options['ibrteamset_socialmedia1']; ?>' style="width: 80%">
	<?php  
}
function ibrteamset_socialmedia2_render(  ) { 
	$options = get_option( 'ibrteamset_settings' );
	?>
	<input type='text' name='ibrteamset_settings[ibrteamset_socialmedia2]' value='<?php echo $options['ibrteamset_socialmedia2']; ?>' style="width: 80%">
	<?php  
}
function ibrteamset_socialmedia3_render(  ) {
	$options = get_option( 'ibrteamset_settings' );
	?>
	<input type='text' name='ibrteamset_settings[ibrteamset_socialmedia3]' value='<?php echo $options['ibrteamset_socialmedia3']; ?>' style="width: 80%">
	<?php  
}
function ibrteamset_settings_section_callback(  ) { 
	echo __( 'Change your post slug path', 'wordpress' );
}
function ibrteamset_options_page(  ) { 
	?>
	<form action='options.php' method='post'>
		<h2>ibrainiD</h2>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}
?>