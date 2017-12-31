<?php
/**
 * The Sidebar containing the First and Second widget areas.
 *
 * @package Voyage
 * @subpackage voyage1
 * @since Voyage 1.0
 */
	global $voyage_options;

	$width = $voyage_options['column_sidebar1'] + $voyage_options['column_sidebar2'];
	if ( 3 != $voyage_options['blog_layout'] && $width > 0 && is_active_sidebar( 'full-widget-area' ) ) {
		if ( ( $width + $voyage_options['column_content'] ) > $voyage_options['grid_column'] ) 
			$width = $voyage_options['grid_column'] - $voyage_options['column_content'];
		$sidebar_class = 'grid_' . $width;
		if ( 2 == $voyage_options['blog_layout'] )
			$sidebar_class = $sidebar_class . " pull_" . $voyage_options['column_content']; ?>
		<div id="sidebar_full" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">
			<ul class="xoxo">
<?php			dynamic_sidebar( 'full-widget-area' );	?>
			</ul>
		</div>
<?php
	}
	if ( $voyage_options['column_sidebar1'] > 0 ) {
		$sidebar_class = 'grid_' . $voyage_options['column_sidebar1'];
		if ( 1 != $voyage_options['blog_layout'] )
			$sidebar_class = $sidebar_class . " pull_" . $voyage_options['column_content'];
?>	
		<div id="sidebar_one" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">
		<ul class="xoxo">		
<?php		if ( is_active_sidebar( 'first-widget-area' ) ) {
				dynamic_sidebar( 'first-widget-area' );	
			}
			elseif ( ! is_active_sidebar( 'second-widget-area' ) || 0 == $voyage_options['column_sidebar2'] ) { //If no sidebar used at all, show some default widgets
				voyage_default_widgets();				
			}
?>
		</ul>
		</div>
<?php
	}
	// Second Sidebar
	if ( is_active_sidebar( 'second-widget-area' ) && ( $voyage_options['column_sidebar2'] > 0) ) {
		$sidebar_class = "grid_" . $voyage_options['column_sidebar2'];
		if ( 2 == $voyage_options['blog_layout'] )
			$sidebar_class = $sidebar_class . " pull_" . $voyage_options['column_content'];
?>
		<div id="sidebar_two" class="<?php echo $sidebar_class; ?> widget-area blog-widgets pull-right" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-widget-area' ); ?>
			</ul>
		</div>
<?php
	}
?>	

