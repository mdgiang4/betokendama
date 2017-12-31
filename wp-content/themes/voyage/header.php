<?php
/**
 * @package Voyage
 * @subpackage voyage
 * @since Voyage 1.0
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<header id="masthead" class="site-header clearfix">
<?php	
	global $voyage_options;
	
	voyage_screen_reader();
	voyage_top_menu();
	if ( ! is_page_template( 'page-templates/fullscreen.php' ) ) {
		if ( 1 == $voyage_options['headerstyle'] )
			voyage_header_style_one();
		elseif ( '' == $voyage_options['headerstyle'] ) {
			voyage_branding();
			voyage_nav_menu();		
		}
	}
?>
	</header>
<?php voyage_header_before_main(); ?>		
<div id="main">
<?php
	voyage_header_after_main();
	if ( is_page_template( 'page-templates/landing.php' )
		|| is_page_template( 'page-templates/featured.php' )
//		|| is_page_template( 'page-templates/imageslider.php' )
		|| ( is_home() && ( 1 == $voyage_options['homepage'] || 2 == $voyage_options['homepage'] ) &&  'page' != get_option( 'show_on_front' ) ) ) {
		echo '<div class="featured-wrapper clearfix">';	
	}
	elseif ( ! is_page_template( 'page-templates/fullscreen.php' ) ) {
		voyage_title_bar();
	}
	echo '<div class="' . voyage_container_class() . ' clearfix">';	
?>
