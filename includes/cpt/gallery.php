<?php
/**
 * Register Gallery post type.
 *
 * @return void
 */
function create_post_type_gallery(){
    $labels = array(
        'name'               => __( 'Gallery', 'geeklove-assistant'),
        'singular_name'      => __( 'Gallery' , 'geeklove-assistant'),
        'add_new'            => __('Add New', 'geeklove-assistant'),
        'add_new_item'       => __('Add New Gallery', 'geeklove-assistant'),
        'edit_item'          => __('Edit Gallery', 'geeklove-assistant'),
        'new_item'           => __('New Gallery', 'geeklove-assistant'),
        'view_item'          => __('View Gallery', 'geeklove-assistant'),
        'search_items'       => __('Search Gallery', 'geeklove-assistant'),
        'not_found'          =>  __('No galleries found', 'geeklove-assistant'),
        'not_found_in_trash' => __('No galleries found in Trash', 'geeklove-assistant'),
        'parent_item_colon'  => ''
    );

    $args = array(
		'labels'              => $labels,
		'public'              => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'rewrite'             => array('slug' => 'gallery'),
		'show_ui'             => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'hierarchical'        => false,
		'menu_position'       => 32,
		'menu_icon'           => 'dashicons-format-gallery',
		'has_archive'         => false,
		'supports'            => array('title'),
		'hierarchical'        => false,
		'show_in_nav_menus'   => false
    );

    register_post_type( 'gallery', $args );
}

function gallery_build_taxonomies(){
  register_taxonomy( 'photo-type', 'gallery', array(
    "hierarchical"   => true,
    "label"          => __( "Categories", 'geeklove-assistant' ),
    "singular_label" => __( "Categories", 'geeklove-assistant' ),
    "rewrite"        => array('slug' => 'photo-type', 'hierarchical' => true)
    )
  );
}

function gallery_edit_columns($columns){

    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => __( 'Gallery Title', 'geeklove-assistant' ),
        "date" => __('Date Added', 'geeklove-assistant')
    );

    return $columns;
}

add_action('init', 'create_post_type_gallery');
add_action('init', 'gallery_build_taxonomies', 0);
add_filter("manage_edit-gallery_columns", "gallery_edit_columns");
