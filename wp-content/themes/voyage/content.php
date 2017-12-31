<?php
/**
 * The default template for displaying content
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
<?php
	voyage_display_post_thumbnail($post->ID); ?>
	
	<header class="entry-header">
<?php
		voyage_posted_on( 2 );
		voyage_posted_category();
		voyage_post_title();
		voyage_posted_on();
?>
	</header>
	<div class="entry-content clearfix">
<?php
		$readmore = get_post_meta($post->ID, '_voyage_readmore', true);
		if ( empty( $readmore ) )
			$content_more = __( '<span class="more-link btn btn-small">read more<span class="meta-nav"></span></span>', 'voyage' );
		else
			$content_more = '<span class="more-link btn btn-small">' . $readmore . '</span>';
		the_content( $content_more );

		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'voyage' ) . '</span>', 'after' => '</div>' ) );  ?>
	</div>
	<?php voyage_single_post_link(); ?>		
	<footer class="entry-footer clearfix">
<?php
		voyage_posted_in();
		voyage_social_post_bottom();
		voyage_author_info();
?>
	</footer>
</article>
