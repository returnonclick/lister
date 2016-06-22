<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

function theme_enqueue_scripts() {
	wp_register_script('avada-child-custom-js', get_stylesheet_directory_uri() . '/js/custom.js' );
	wp_enqueue_script('avada-child-custom-js');
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );


add_filter( 'rwmb_meta_boxes', 'your_prefix_meta_boxes' );
function your_prefix_meta_boxes( $meta_boxes ) {


	// Better has an underscore as last sign
	$prefix = 'roc_';

	$meta_boxes[] = array(
		'title'      => __( 'Information about the art', 'textdomain' ),
		'post_types' => 'avada_portfolio',
		'fields'     => array(
			// TEXT
			array(
				// Field name - Will be used as label
				'name'  => esc_html__( 'City', 'roc' ),
				// Field ID, i.e. the meta key
				'id'    => "{$prefix}city",
				'type'  => 'text',
			),
			// DATE
			array(
				'name'       => esc_html__( 'Date', 'roc' ),
				'id'         => "{$prefix}date",
				'type'       => 'date',
				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( '(yyyy-mm-dd)', 'roc' ),
					'dateFormat'      => esc_html__( 'yy-mm-dd', 'roc' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			)
		),
	);
	return $meta_boxes;
}