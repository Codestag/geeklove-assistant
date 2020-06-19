<?php

add_action('add_meta_boxes', 'stag_metabox_rsvp');

$all_events               = stag_all_wedding_events();
$all_events['all-events'] = __( 'All Events', 'geeklove' );
$all_events['no-events']  = __( 'No Events', 'geeklove' );

function stag_metabox_rsvp(){
	global $all_events;

	$meta_box = array(
		'id'          => 'stag_metabox_rsvp',
		'title'       => __( 'RSVP Information', 'geeklove' ),
		'description' => __( 'Attendee Information', 'geeklove' ),
		'page'        => 'page',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Attendee Number', 'geeklove' ),
				'desc' => __( 'How many people are attending the event?', 'geeklove' ),
				'id'   => '_stag_attendee_number',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name'    => __( 'Event Attending', 'geeklove' ),
				'desc'    => __( 'Which event attending?', 'geeklove' ),
				'id'      => '_stag_attendee_event',
				'type'    => 'select',
				'options' => $all_events,
				'std'     => '',
			),
		)
	);

	$meta_box['page'] = 'rsvp';
	stag_add_meta_box( $meta_box );
}