<?php
/**
 * The template for displaying Archive pages.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
global $voyage_options;
get_header();
?>
<div id="content" class="<?php echo voyage_grid_class(); ?>" role="main">
<?php
	if ( have_posts() ) {
	  	if ( 0 == $voyage_options['titlebar'] ) {
?>
	<header class="page-header">
		<h1 class="page-title">
<?php
			if ( is_day() )
				printf( __( 'Daily Archives: %s', 'voyage' ), '<span>' . get_the_date() . '</span>' );
			elseif ( is_month() )
				printf( __( 'Monthly Archives: %s', 'voyage' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'voyage' ) ) . '</span>' );
			elseif ( is_year() )
				printf( __( 'Yearly Archives: %s', 'voyage' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'voyage' ) ) . '</span>' );
			else
				_e( 'Blog Archives', 'voyage' ); 
?>
		</h1>
	</header>
<?php
		}
		voyage_content_nav( 'nav-above' );
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
		voyage_content_nav( 'nav-below' );
	} else { // No posts
		get_template_part( 'content-none' );
	};
?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
