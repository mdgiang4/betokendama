<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
get_header(); ?>
<div id="content" class="<?php echo voyage_grid_class(); ?>" role="main">	
<?php
	global $voyage_options;
	if ( $voyage_options['showauthor'] && have_posts() ) {
		if ( 0 == $voyage_options['titlebar'] ) {
			the_post(); ?>
			<header class="page-header">
				<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'voyage' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
			</header>
<?php		rewind_posts();
		}
		voyage_content_nav( 'nav-above' );
		if ( get_the_author_meta( 'description' ) ) { ?>
			<div id="author-info">
			  <div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'voyage_author_bio_avatar_size', 60 ) ); ?>
			  </div>
			  <div id="author-description">
			  	<h2><?php printf( __( 'About %s', 'voyage' ), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
			  </div>
			</div>
<?php	}
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
