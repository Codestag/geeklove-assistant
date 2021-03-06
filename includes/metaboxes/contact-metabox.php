<?php
add_action( 'add_meta_boxes', 'stag_metabox_contact' );

function stag_metabox_contact() {
	$meta_box = array(
		'id'          => 'stag_metabox_contact',
		'title'       => __( 'Contact Prefrences', 'geeklove-assistant' ),
		'description' => __( 'Edit your contact preferences', 'geeklove-assistant' ),
		'page'        => 'page',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Secondary Title', 'geeklove-assistant' ),
				'desc' => __( 'Enter the secondary title, used for second section on contact page.', 'geeklove-assistant' ),
				'id'   => '_stag_contact_secondary_title',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Contact Number', 'geeklove-assistant' ),
				'desc' => __( 'Enter your contact number.', 'geeklove-assistant' ),
				'id'   => '_stag_contact_number',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => __( 'Email Address', 'geeklove-assistant' ),
				'desc' => __( 'Enter your email address.', 'geeklove-assistant' ),
				'id'   => '_stag_contact_email',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	global $post;
	$post_id       = ( isset( $_GET['post'] ) ) ? $_GET['post'] : $post->ID;
	$template_file = get_post_meta( $post_id, '_wp_page_template', true );
	if ( $template_file == 'page-templates/template-contact.php' ) {
		stag_add_meta_box( $meta_box );
	}
}
