<?php
// Add the post_links Meta Boxes
function add_post_links_metaboxes() {
	add_meta_box('wpt_post_links_location', 'URL Link', 'wpt_post_links_location', 'ibrainid_link', 'normal', 'high');
}

// Save the Metabox Data

function wpt_save_post_links_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( isset($_POST['postlinkmeta_noncename']), plugin_basename(__FILE__) )) {
		return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$post_links_meta['_urllink'] = $_POST['_urllink'];
	
	// Add values of $post_links_meta as custom fields
	
	foreach ($post_links_meta as $key => $value) { // Cycle through the $post_links_meta array!
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

add_action('save_post', 'wpt_save_post_links_meta', 1, 2); // save the custom fields

// The Post Link Metabox

function wpt_post_links_location() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="postlinkmeta_noncename" id="postlinkmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$link = get_post_meta($post->ID, '_urllink', true);
	
	// Echo out the field
    echo '<p>Enter the link:</p>';
	echo '<input type="text" name="_urllink" value="' . $link . '" class="widefat" />';
}