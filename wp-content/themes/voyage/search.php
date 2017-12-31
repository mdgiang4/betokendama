<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
get_header(); 
?>
<div id="content" class="<?php echo voyage_grid_class(); ?> voyage_recent_post" role="main">
<?php
	global $voyage_options, $voyage_thumbnail, $voyage_display_excerpt, $voyage_entry_meta;
	$voyage_display_excerpt = 1;
	$voyage_thumbnail = 'thumbnail';
	$voyage_entry_meta = 1;
	
	if ( have_posts() ) {
		if ( 0 == $voyage_options['titlebar'] ) { ?>
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'voyage' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>
<?php	}
		voyage_content_nav( 'nav-above' );
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'summary' );
		}
		voyage_content_nav( 'nav-below' );
	} else { //No posts
		get_template_part( 'content-none' );
	} ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
