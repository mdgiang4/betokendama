<?php
/**
 * Template Name: Image Slider
 *
 * @package Voyage
 * @subpackage Voyage
 * @since 1.3.6
 */
get_header();

	if ( get_query_var('paged') )
	    $paged = get_query_var('paged');
	elseif ( get_query_var('page') ) 
	    $paged = get_query_var('page');
	else 
		$paged = 1;
		
if ( have_posts() ) {
	the_post();
	$sidebar = get_post_meta($post->ID, '_voyage_sidebar', true);
?>		
<div id="content" class="<?php echo $sidebar ? voyage_grid_class() : voyage_grid_full(); ?>" role="main">
<?php
	if ( 1 == $paged ) {
		$pt_thumbnail = get_post_meta($post->ID, '_voyage_thumbnail', true);
		$pt_size_x = get_post_meta($post->ID, '_voyage_size_x', true);
		$pt_size_y = get_post_meta($post->ID, '_voyage_size_y', true);
		
		if ( empty( $pt_thumbnail ) )
			$image_size = 'full';
		else
			$image_size = voyage_thumbnail_size($pt_thumbnail, $pt_size_x, $pt_size_y);
		echo '<div id="skitter" class="clearfix">';
		$content = get_the_content();
		$images = voyage_gallery_image_ids( $content );
		if ( $images ) {
   			$content = preg_replace( '/\[gallery.*.\]/', voyage_skitter_content( $images, $image_size ), $content );
			voyage_skitter_inline( $images, $image_size );
		}		
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;
		echo '</div>';
	}
	if ( $sidebar ) {
		$pt_category = get_post_meta($post->ID, '_voyage_category', true);
		$postperpage = get_post_meta($post->ID, '_voyage_postperpage', true);
		$blog_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'paged'	=> $paged );
		if ($postperpage)
			$blog_args['posts_per_page'] = $postperpage;
		if ($pt_category)
			$blog_args['category__in'] = $pt_category;
		$blog = new WP_Query( $blog_args );
	
		global $more;
 		if ( $blog->have_posts() ) :
			voyage_content_nav_link( $blog->max_num_pages, 'nav-above' );
			while ( $blog->have_posts() ) :
				$blog->the_post();
				$more = 0;
				get_template_part( 'content', get_post_format() );
			endwhile;				
			voyage_content_nav_link( $blog->max_num_pages, 'nav-below' );
		endif;
		wp_reset_postdata();
	}
?>
</div>
<?php
}
if ( $sidebar )
	get_sidebar();
?>
</div><!-- #container -->
<div id="content-wrapper" class="<?php echo voyage_container_class(); ?> clearfix">
<?php
	if ( ! $sidebar )
		get_sidebar('home');
	get_footer();
?>
