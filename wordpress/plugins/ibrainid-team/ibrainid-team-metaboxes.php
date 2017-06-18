<?php
// Add the post_links Meta Boxes
function add_team_metaboxes() {
	add_meta_box('wpt_team_title', 'Title', 'wpt_team_title', 'ibrainid_team', 'normal', 'high');
}

// Save the Metabox Data

function wpt_save_team_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( wp_verify_nonce( isset($_POST['teammeta_noncename']), plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID )) {
		return $post->ID;
    }
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$team_meta['_title'] = $_POST['_title'];
	$team_meta['_socialmedia1'] = $_POST['_socialmedia1'];
	$team_meta['_socialmedia2'] = $_POST['_socialmedia2'];
	$team_meta['_socialmedia3'] = $_POST['_socialmedia3'];
	
	// Add values of $post_links_meta as custom fields
	
	foreach ($team_meta as $key => $value) { // Cycle through the $post_links_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
	
}

add_action('save_post', 'wpt_save_team_meta', 1, 2); // save the custom fields

// The Post Link Metabox

function wpt_team_title() {
	$set_var = get_option( 'ibrteamset_settings' );
	if ( empty($set_var['ibrteamset_socialmedia1'])) { $s1 = 'social media 1'; } 
	else { $s1 = $set_var['ibrteamset_socialmedia1']; }
	
	if ( empty($set_var['ibrteamset_socialmedia2'])) { $s2 = 'social media 2'; } 
	else { $s2 = $set_var['ibrteamset_socialmedia2'] ; }
	
	if ( empty($set_var['ibrteamset_socialmedia3'])) { $s3 = 'social media 3'; } 
	else { $s3 = $set_var['ibrteamset_socialmedia3']; }

	wpt_text_field('title', 'Title');
	wpt_text_field('socialmedia1', $s1);
	wpt_text_field('socialmedia2', $s2);
	wpt_text_field('socialmedia3', $s3);
}

function wpt_text_field($name, $label){
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="teammeta_noncename" id="teammeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the data if its already been entered
	$dt_value = '_' . $name;
	$value = get_post_meta($post->ID, $dt_value, true);
	
	// Echo out the field
    echo '<p class="ibr-team-input">'.$label.':</p>';
	echo '<input type="text" name="'. $dt_value.'" value="' . $value . '" class="widefat" />';
}