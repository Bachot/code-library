<?php
add_action( 'admin_menu', 'ibrttset_add_admin_menu' );
add_action( 'admin_init', 'ibrttset_settings_init' );
function ibrttset_add_admin_menu(  ) { 
	add_options_page( 'ibrainiD Team and Testimonials Settings', 'ibrainiD Team and Testimonials Settings', 'manage_options', 'ibrainid_tt_settings', 'ibrttset_options_page' );
}
function ibrttset_settings_init(  ) { 
	register_setting( 'pluginPage', 'ibrttset_settings' );
	add_settings_section(
		'ibrttset_pluginPage_section', 
		__( 'Team and Testimonials Setting', 'wordpress' ), 
		'ibrttset_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'ibrttset_custom_slug', 
		__( 'Custom slug', 'ibr-tt' ), 
		'ibrttset_custom_slug_render', 
		'pluginPage', 
		'ibrttset_pluginPage_section' 
	);
}
function ibrttset_custom_slug_render(  ) { 
	$options = get_option( 'ibrttset_settings' );
	?>
	<input type='text' name='ibrttset_settings[ibrttset_custom_slug]' value='<?php echo $options['ibrttset_custom_slug']; ?>' style="width: 80%">
	<h1>Shortcode</h1>
	<p>You can change values</p>
	<p>[ibrtt category="ebook" class="my-class" imgsize="thumbnail" butttontext="More" ]</p>
	<?php
}
function ibrttset_settings_section_callback(  ) { 
	echo __( 'Change your post slug path', 'wordpress' );
}
function ibrttset_options_page(  ) { 
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