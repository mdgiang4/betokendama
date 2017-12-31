<?php
/**
 * Sidebar for bbPress/BuddyPress.
 *
 * @package Voyage
 * @subpackage voyage1
 * @since Voyage 1.3.0
 */ 
	global $voyage_options;

	if ( $voyage_options['bbp_column2'] > 0 
			&& is_active_sidebar( 'bbp-widget-area' ) ) {
				
		$sidebar_class = 'grid_' . $voyage_options['bbp_column2'];
		if ( 1 == $voyage_options['bbp_position'] ) {
			$sidebar_class = $sidebar_class . " pull_" . $voyage_options['bbp_column1'];
		}
?>	
		<div id="bbp-sidebar" class="<?php echo $sidebar_class; ?> widget-area blog-widgets" role="complementary">		
			<ul class="xoxo">		
<?php			dynamic_sidebar( 'bbp-widget-area' );	?>
			</ul>
		</div>
<?php
	}
?>
