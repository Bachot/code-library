<?php
add_action( 'admin_menu', 'ibrlinkset_add_admin_menu' );
add_action( 'admin_init', 'ibrlinkset_settings_init' );
function ibrlinkset_add_admin_menu(  ) { 
	add_options_page( 'ibrainiD Link Settings', 'ibrainiD Link Settings', 'manage_options', 'ibrainid_link_settings', 'ibrlinkset_options_page' );
}
function ibrlinkset_settings_init(  ) { 
	register_setting( 'pluginPage', 'ibrlinkset_settings' );
	add_settings_section(
		'ibrlinkset_pluginPage_section', 
		__( 'Post Link Setting', 'wordpress' ), 
		'ibrlinkset_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'ibrlinkset_custom_slug', 
		__( 'Custom slug', 'ibr-link' ), 
		'ibrlinkset_custom_slug_render', 
		'pluginPage', 
		'ibrlinkset_pluginPage_section' 
	);
}
function ibrlinkset_custom_slug_render(  ) { 
	$options = get_option( 'ibrlinkset_settings' );
	?>
	<input type='text' name='ibrlinkset_settings[ibrlinkset_custom_slug]' value='<?php echo $options['ibrlinkset_custom_slug']; ?>' style="width: 80%">
	<h1>Shortcode</h1>
	<p>You can change values</p>
	<p>[ibrlink category="ebook" class="my-class" imgsize="thumbnail" butttontext="More" ]</p>
	<?php
}
function ibrlinkset_settings_section_callback(  ) { 
	echo __( 'Change your post slug path', 'wordpress' );
}
function ibrlinkset_options_page(  ) { 
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