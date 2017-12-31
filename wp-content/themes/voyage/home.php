<?php
/**
 * Default Home Page
 * 
 * @package Voyage
 * @subpackage Voyage
 * @since 1.2.0
 */
	global $voyage_options;
	get_header();
	
	if ( 'page' == get_option( 'show_on_front' ) || 3 == $voyage_options['homepage'] ) {
?>  
	<div id="content" class="<?php echo voyage_grid_class(); ?>" role="main">
<?php
		if ( have_posts() ) {
			voyage_content_nav( 'nav-above' );
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}				
			voyage_content_nav( 'nav-below' );
		} elseif ( current_user_can( 'edit_posts' ) ) {
			get_template_part( 'content-none', 'index' );
		} ?>						
	</div>
<?php
		get_sidebar();
	} elseif ( 1 == $voyage_options['homepage'] ) {
		get_template_part( 'page-templates/featured'  ); 		
	} elseif ( 2 == $voyage_options['homepage'] ) {
 		get_template_part( 'page-templates/landing'  ); 		
	} elseif ( 4 == $voyage_options['homepage'] ) {
		get_template_part( 'page-templates/portfolio' );
	} elseif ( 5 == $voyage_options['homepage'] ) {
		get_template_part( 'page-templates/blog-sticky' );
	}
	get_footer();
?>