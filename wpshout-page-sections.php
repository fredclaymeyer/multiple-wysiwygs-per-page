<?php
/*
Plugin Name:  wpshout Page Sections
Description:  Creates differently colored page sections
Author:       Press Up
Author URI:   http://pressupinc.com
*/


/**
 * All glory to CMB2: https://github.com/WebDevStudios/CMB2/
 */


/**
 * Pull in the CMB2 plugin
 */
if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {

	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}


// Meta prefix; starts with an underscore to hide fields from custom fields list
$prefix = '_wpshout_';


/**
 * Create radio button for main MCE window
 */
add_action( 'cmb2_init', 'wpshout_register_radio' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function wpshout_register_radio() {
	global $prefix;

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => $prefix . 'main_wysiwyg_background',
        'title'         => 'Background Color',
        'object_types'  => array( 'page', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        // 'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

	$cmb->add_field( array(
	    'name'             => 'Background',
	    'id'               => $prefix . 'main_wysiwyg_background',
	    'type'             => 'radio',
	    'show_option_none' => false,
	    'options'   => array(
	    	'white' => 'White',
			'blue'   => 'Blue',
			'gray'     => 'Gray',
	    ),
	) );
}


/**
 * Create arbitrarily many additional MCE fields
 */
add_action( 'cmb2_init', 'wpshout_register_repeatable_group_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function wpshout_register_repeatable_group_field_metabox() {
	global $prefix;

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Repeating Field Group', 'cmb2' ),
		'object_types' => array( 'page', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'wysiwyg',
		'type'        => 'group',
		'description' => __( 'Generates reusable form entries', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Section {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Section', 'cmb2' ),
			'remove_button' => __( 'Remove Section', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => __( 'Section Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => 'Content',
		'description' => 'Section content',
		'id'          => 'content',
		'type'        => 'wysiwyg',
		'options' => array(
        	'wpautop' => true, // use wpautop?
        	'media_buttons' => true, // show insert/upload button(s)
        ),
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Entry Image', 'cmb2' ),
		'id'   => 'color',
	    'type'   => 'radio',
	    'show_option_none' => false,
	    'options'   => array(
	    	'white' => 'White',
			'blue'   => 'Blue',
			'gray'     => 'Gray',
	    ),
	) );
}