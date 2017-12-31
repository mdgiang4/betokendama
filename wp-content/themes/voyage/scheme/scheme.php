<?php
/**
 * Add scheme related options
 *
 * @package voyage
 * @subpackage voyage
 * @since Voyage 1.2.6
 */
if ( ! defined('ABSPATH') ) exit;

function voyage_scheme_options( $scheme = NULL ) {
	$theme_uri = get_template_directory_uri();
	$scheme = array(
	'0' 		=>	array( 'key' => '0',
				   		'label' => __('Default','voyage'),
						'css' => '',
						'demoimg' => '',
						'options' => array(
							array( 'name'  => 'navbarcolor','value' => 0),
						),
				),					
	'dark' 		=> array( 'key' => 'dark',
				   		'label' => __('Dark','voyage'),
						'css' => $theme_uri . '/scheme/dark.css',
						'demoimg' => '',
				   		'options' => array(
							array( 'name'  => 'navbarcolor','value' => 1),
						),
				),
	'lightblue' => array( 'key' => 'lightblue',
				   		'label' => __('Light Blue','voyage'),
						'css' => $theme_uri . '/scheme/lightblue.css',
						'demoimg' => '',
				   		'options' => array(
							array( 'name'  => 'navbarcolor','value' => 0),
						),
				),
	'nature' => array(	'key' => 'nature',
				   		'label' => __('Nature','voyage'),
						'css' => $theme_uri . '/scheme/nature.css',
						'demoimg' => '',
				   		'options' => array(
							array( 'name'  => 'navbarcolor','value' => 0),
						),
				),
	'sandy'	=> array(	'key' => 'sandy',
				   		'label' => __('Sandy','voyage'),
						'css' => $theme_uri . '/scheme/sandy.css',
						'demoimg' => '',
				   		'options' => array(
							array( 'name'  => 'navbarcolor','value' => 0),
						),
				),
	'silvermac'	=> array( 'key' => 'silvermac',
				   		'label' => __('Silver Mac','voyage'),
						'css' => $theme_uri . '/scheme/silvermac.css',
						'demoimg' => '',
				   		'options' => array(
							array( 'name'  => 'navbarcolor','value' => 0),
							array( 'name'  => 'datestyle','value' => 2),
							array( 'name'  => 'sitetitlefont','value' => 0),
							array( 'name'  => 'sitedescfont','value' => 0),
						),
				),
	);
	return apply_filters( 'voyage_colorscheme_array', $scheme );
}
?>