<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * General Framework function
 *
 * @package voyage
 * @since Voyage 1.3.7
 */
 
function voyage_thumbnail_array() {
	$sizes = array (
		array(	'key' => '6',
				'name' => __( 'None', 'voyage' ) ),
		array(	'key' => '',
				'name' => __( 'Default', 'voyage' ) ),
		array(	'key' => '1',
				'name' => __( 'Thumbnail', 'voyage' ) ),
		array(	'key' => '2',
				'name' => __( 'Medium', 'voyage' ) ),
		array(	'key' => '3',
				'name' => __( 'Large', 'voyage' ) ),
		array(	'key' => '4',
				'name' => __( 'Full', 'voyage' ) ),
		array(	'key' => '5',
				'name' => __( 'Custom', 'voyage' ) ),
	);
	global $_wp_additional_image_sizes;

	if ( isset( $_wp_additional_image_sizes ) )
		foreach( $_wp_additional_image_sizes as $name => $item) 
			$sizes[] = array( 'key' => $name, 'name' => $name );
	return apply_filters( 'voyage_thumbnail_array', $sizes );
}

function voyage_post_types() { 
	$args = array(
  		'public'   => true,
  		'_builtin' => false ); 
	$post_types = get_post_types( $args ); 
	$types = array( 
		array(	'key' => 'post',
				'name' => __( 'post', 'voyage' ) ),
		array(	'key' => 'page',
				'name' => __( 'page', 'voyage' ) ),
	);
	foreach ( $post_types as $post_type ) {
		$types[] = array( 'key' => $post_type, 'name' => $post_type );
	}
	return apply_filters( 'voyage_post_types', $types );
}

function voyage_gallery_image_ids( $content ) {
	$image_ids = array();
    preg_match_all( '/\[gallery.*.\]/' , $content, $matches);
	foreach ( $matches[0] as $match ) {
        $str = str_replace (" ", "&", trim ($match));
        $str = str_replace ('"', '', $str);
		$attrs = wp_parse_args( $str );
		if ( isset( $attrs['ids'] ) ) {
			$ids = explode( ',', $attrs['ids'] );	
			$image_ids = array_merge( $image_ids, $ids );	
		}
	}
	return $image_ids;
}

function voyage_skitter_content( $images, $size = 'full' ) {
	$slider = '<div class="border_box">';
	$slider .= '<div class="box_skitter box_skitter_inline box_skitter_custom">';
	$slider .= '<ul>';
	foreach ( $images as $id ) {
		$slider .= '<li>';
		$image = wp_get_attachment_image_src( $id, $size );
		$slider .=  '<img src="' . $image[0] . '" class="random">';
		$alt_text = get_post_meta($id, '_wp_attachment_image_alt', true);
		$slider .=  '<div class="label_text"><p>' .  $alt_text . '</p></div>';
		$slider .=  '</li>';		
	}
	$slider .= '</ul></div></div>';
	return apply_filters( 'voyage_skitter_content', $slider );
}

function voyage_skitter_inline( $images, $size = 'full' ) {
	$height = 99999;

	foreach ( $images as $id ) {
		$image = wp_get_attachment_image_src( $id, $size );
		if ( $image[2] < $height )
			$height = $image[2];
	}
	$css = "<!-- Voyage Skitter Inline CSS -->\n";
	$css .= "<style>\n";
	$css .= '.box_skitter_inline {' . "\n";
	$css .= '  height: ' . $height . 'px;' . "\n";
	$css .= "}\n";
	$css .= "</style>\n<!-- Voyage Skitter Inline CSS -->\n";
	echo apply_filters( 'voyage_skitter_inline', $css );
}