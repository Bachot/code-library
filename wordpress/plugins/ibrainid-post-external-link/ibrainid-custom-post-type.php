<?php
add_action( 'init', 'ibrainid_execute_custom_post_type');
function ibrainid_execute_custom_post_type() { 
	ibrainid_set_custom_post_type( 'ibrainid_link', 'ibrainiD', ibrainid_custom_path() );
}
add_action( 'init', 'ibrainid_remove_editor' );
function ibrainid_remove_editor() {
	remove_post_type_support( 'ibrainid_link', 'editor' );
}
function ibrainid_custom_path() {
	$set_var = get_option( 'ibrlinkset_settings' );
	if ( empty($set_var['ibrlinkset_custom_slug']) ) {
		return 'ibr-link';
	} else {
		return $set_var['ibrlinkset_custom_slug'];
	}
}
function ibrainid_set_custom_post_type( $obj, $name, $slug ) {
	
	add_post_type_support( $obj, 'thumbnail' );	
	add_post_type_support( $obj, 'thumbnail' );
	add_post_type_support( $obj, 'excerpt');
	//add_post_type_support( $obj, 'custom-fields');
	
	
	//set the name of the taxonomy
    $taxonomy = $obj . '_category';
    //set the post types for the taxonomy
    $object_type = $obj;
    
    //populate our array of names for our taxonomy
    $category_labels = array(
        'name'               => $name . ' Categories',
        'singular_name'      => 'category',
        'search_items'       => 'Search category',
        'all_items'          => 'All categories',
        'parent_item'        => 'Parent category',
        'parent_item_colon'  => 'Parent category:',
        'update_item'        => 'Update category',
        'edit_item'          => 'Edit category',
        'add_new_item'       => 'Add New category', 
        'new_item_name'      => 'New Category Name',
        'menu_name'          => 'Categories'
    );
    
    //define arguments to be used 
    $category_args = array(
        'labels'            => $category_labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'how_in_nav_menus'  => true,
        'public'            => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => $slug . '-category')
    );
    
    //call the register_taxonomy function
    register_taxonomy($taxonomy, $object_type, $category_args); 

	$labels = array(
		'name'                  => __( $name . ' Items', 'text_domain' ),
		'singular_name'         => __( $name . ' Item', 'text_domain' ),
		'menu_name'             => __( $name . ' Links', 'text_domain' ),
		'name_admin_bar'        => __( $name . ' Links', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( $name, 'text_domain' ),
		'description'           => __( 'This is where you create price post item', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon' => plugin_dir_url( __FILE__ ) .'/external-link.png', 
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'rewrite' => array('slug' => $slug),
		'register_meta_box_cb' => 'add_post_links_metaboxes',
	);
	register_post_type( $obj, $args );
}
add_action( 'add_meta_boxes', 'add_post_links_metaboxes' );