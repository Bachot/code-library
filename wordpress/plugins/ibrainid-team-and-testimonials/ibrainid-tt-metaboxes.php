<?php
// Add the post_links Meta Boxes
function add_tt_metaboxes() {
	add_meta_box('wpt_tt_title', 'Title', 'wpt_tt_title', 'ibrainid_tt', 'normal', 'high');
	add_meta_box('wpt_tt_company', 'Company', 'wpt_tt_company', 'ibrainid_tt', 'normal', 'high');
}

// Save the Metabox Data

function wpt_save_tt_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( isset($_POST['ttmeta_noncename']), plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$tt_meta['_title'] = $_POST['_title'];
	$tt_meta['_company'] = $_POST['_company'];
	
	// Add values of $tt_meta as custom fields
	
	foreach ($tt_meta as $key => $value) { // Cycle through the $tt_meta array!
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

add_action('save_post', 'wpt_save_tt_meta', 1, 2); // save the custom fields

function wpt_tt_title() {
	global $post;
	echo '<input type="hidden" name="ttmeta_noncename" id="ttmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$title = get_post_meta($post->ID, '_title', true);
    echo '<p>Enter the title:</p>';
	echo '<input type="text" name="_title" value="' . $title . '" class="widefat" />';
}
function wpt_tt_company() {
	global $post;
	echo '<input type="hidden" name="ttmeta_noncename" id="ttmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$company = get_post_meta($post->ID, '_company', true);
    echo '<p>Enter the company:</p>';
	echo '<input type="text" name="_company" value="' . $company . '" class="widefat" />';
}