<?php
/*
* Plugin Name: ibrainiD PayGate
* Description: South Africa PayGate (www.paygate.co.za)
* Version: 1.0
* Author: Bachot Mpunga
* Author URI: www.bachotdesign.com
*/
add_action( 'admin_menu', 'ibrpgte_add_admin_menu' );
add_action( 'admin_init', 'ibrpgte_settings_init' );
function ibrpgte_add_admin_menu(  ) { 
	add_options_page( 'ibrainiD PayGate', 'ibrainiD PayGate', 'manage_options', 'ibrainid_paygate', 'ibrpgte_options_page' );
}
function ibrpgte_settings_init(  ) { 
	register_setting( 'pluginPage', 'ibrpgte_settings' );
	add_settings_section(
		'ibrpgte_pluginPage_section', 
		__( 'PayGate Setting', 'wordpress' ), 
		'ibrpgte_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'ibrpgte_paygate_id', 
		__( 'Paygate ID', 'wordpress' ), 
		'ibrpgte_paygate_id_render', 
		'pluginPage', 
		'ibrpgte_pluginPage_section' 
	);
	
	add_settings_field( 
		'ibrpgte_return_url', 
		__( 'Return Url', 'wordpress' ), 
		'ibrpgte_return_url_render', 
		'pluginPage', 
		'ibrpgte_pluginPage_section' 
	);
	
	add_settings_field( 
		'ibrpgte_encryption_key', 
		__( 'Encryption Key', 'wordpress' ), 
		'ibrpgte_encryption_key_render', 
		'pluginPage', 
		'ibrpgte_pluginPage_section' 
	);
	add_settings_field( 
		'ibrpgte_country', 
		__( 'Country', 'wordpress' ), 
		'ibrpgte_country_render', 
		'pluginPage', 
		'ibrpgte_pluginPage_section' 
	);
}
function ibrpgte_paygate_id_render(  ) { 
	$options = get_option( 'ibrpgte_settings' );
	?>
	<input type='text' name='ibrpgte_settings[ibrpgte_paygate_id]' value='<?php echo $options['ibrpgte_paygate_id']; ?>'>
	<?php
}
function ibrpgte_return_url_render(  ) { 
	$options = get_option( 'ibrpgte_settings' );
	?>
	<input type='text' name='ibrpgte_settings[ibrpgte_return_url]' value='<?php echo $options['ibrpgte_return_url']; ?>'>
	<?php
}
function ibrpgte_encryption_key_render(  ) { 
	$options = get_option( 'ibrpgte_settings' );
	?>
	<input type='text' name='ibrpgte_settings[ibrpgte_encryption_key]' value='<?php echo $options['ibrpgte_encryption_key']; ?>'>
	<?php
}
function ibrpgte_country_render(  ) { 
		$options = get_option( 'ibrpgte_settings' );
	?>
	<select name='ibrpgte_settings[ibrpgte_country]'>
		<option value='ZAF' <?php selected( $options['ibrpgte_country'], 'ZAF' ); ?>>South Africa</option>
		<option value='USA' <?php selected( $options['ibrpgte_country'], 'USA' ); ?>>United States</option>
	</select>
<?php
}
function ibrpgte_settings_section_callback(  ) { 
	echo __( 'This section description', 'wordpress' );
}
function ibrpgte_options_page(  ) { 
	?>
	<form action='options.php' method='post'>
		<h2>ibrainiD PayGate</h2>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}
?>
