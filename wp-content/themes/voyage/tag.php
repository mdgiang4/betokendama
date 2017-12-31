<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
get_header(); ?>
<div id="content" class="<?php echo voyage_grid_class(); ?>" role="main">
<?php
	global $voyage_options;
	if ( have_posts() ) {
		if ( 0 == $voyage_options['titlebar'] ) { ?>
			<header class="page-header">
			<?php $tag_description = tag_description();
			if ( empty( $tag_description ) )
				$pg_title_class = "";
			else
				$pg_title_class = " hide";
?>
			<h1 class="page-title <?php echo $pg_title_class ?>">
<?php			printf( __( 'Tag Archives: %s', 'voyage' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
			</h1>
<?php		if ( ! empty( $tag_description ) )
				echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
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
