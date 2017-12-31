<?php
/**
 * Template Name: Full Screen
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.3.8
 */
get_header(); ?>
<div id="content" class="<?php echo voyage_grid_full(); ?> full-screen clearfix" role="main">
<?php
	while ( have_posts() ) {
		the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'full', array( 'class' => 'featured-fullwidth-image' ) );			
		}
?>
	<header class="entry-header clearfix">
		<h1 class="entry-title"><?php the_title(); ?></h1>		
	</header>
	<div class="entry-content clearfix">
<?php	the_content();
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'voyage' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div>
	<footer class="entry-meta clearfix">
<?php	edit_post_link( __( '[Edit]', 'voyage' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>
<?php		
		comments_template( '', true );
	}
?>
</div>
<?php get_footer('fixed'); ?>
