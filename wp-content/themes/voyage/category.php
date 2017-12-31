<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
global $voyage_options;
get_header(); ?>
<div id="content" class="<?php echo voyage_grid_class(); ?>" role="main">
<?php
	if ( have_posts() ) {
		if ( 0 == $voyage_options['titlebar'] ) { ?>
			<header class="page-header">	
<?php		$category_description = category_description();
			if ( empty( $category_description ) )
				$pg_title_class = "";
			else
				$pg_title_class = " hide";
?>
			<h1 class="page-title <?php echo $pg_title_class ?>"><?php
				printf( __( 'Category Archives: %s', 'voyage' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
<?php
			if ( ! empty( $category_description ) )
				echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
?>
			</header>
<?php	}
		voyage_content_nav( 'nav-above' );
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );
		}
		voyage_content_nav( 'nav-below' );
	} else {
		get_template_part( 'content-none' );
	} ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
