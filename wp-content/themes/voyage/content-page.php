<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Voyage
 * @subpackage Voyage
 * @since Voyage 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	global $voyage_options;
	if ( '' != get_the_title() && 0 == $voyage_options['titlebar'] ) { ?>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php the_title(); ?></h1>		
		</header>
<?php
	} 
	voyage_posted_on();
	?> 
	<div class="entry-content clearfix">
<?php	the_content();
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'voyage' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div>
	<footer class="entry-meta clearfix">
<?php
		edit_post_link( __( '[Edit]', 'voyage' ), '<span class="edit-link">', '</span>' );
		if ( 1 == $voyage_options['sharesocial']
				&& 1 == $voyage_options['share_bottom']
		  		&&  function_exists( 'sharing_display' ) )
			echo sharing_display();
?>				
	</footer>
</article>
