<?php
/**
 * Template Name: A to Z Index
 *
 * @package Voyage
 * @subpackage Voyage
 * @since 1.3.3
 */
get_header();

    if ( get_query_var( 'paged' ) )
	    $paged = get_query_var( 'paged' );
	elseif ( get_query_var( 'page' ) ) 
	    $paged = get_query_var( 'page' );
	else 
		$paged = 1;
		
	if ( isset( $_GET['start'] ) )
		$start = $_GET['start'];
	else
		$start = '';
	global $voyage_thumbnail, $voyage_display_excerpt, $voyage_entry_meta;	
	
	if ( have_posts() && is_page() ) {
		the_post();
		$pt_category = get_post_meta( $post->ID, '_voyage_category', true );

		$column = get_post_meta($post->ID, '_voyage_column', true );
		if ( '' == $column )
			$column = 3;

		$postperpage = get_post_meta( $post->ID, '_voyage_postperpage', true );
		if ( $postperpage < $column )
			$postperpage = 12;

		$pt_thumbnail = get_post_meta( $post->ID, '_voyage_thumbnail', true );
		$pt_size_x = get_post_meta( $post->ID, '_voyage_size_x', true );
		$pt_size_y = get_post_meta( $post->ID, '_voyage_size_y', true );
			
		$voyage_thumbnail = voyage_thumbnail_size( $pt_thumbnail, $pt_size_x, $pt_size_y );

		$voyage_display_excerpt = get_post_meta( $post->ID, '_voyage_intro', true );
		if ( '' == $voyage_display_excerpt)
			$voyage_display_excerpt = 1;

		$voyage_entry_meta = get_post_meta( $post->ID, '_voyage_disp_meta', true );
		$sidebar = get_post_meta( $post->ID, '_voyage_sidebar', true );
		voyage_template_intro();
	}
	else {
		$pt_category = '';
		$voyage_display_excerpt = 1;
		$column = 1;
		$postperpage = 0;
		$voyage_thumbnail = 'thumbnail';
		$voyage_entry_meta = 1;
		$sidebar = 1;
	}
	if ( has_action( 'voyage_atoz_index' ) ) {
 //Use Child Theme to create voyage_atoz_index for other languages;
		do_action( 'voyage_atoz_index' );
	}
	else {
?>
<div class="btn-toolbar">
  <div class="btn-group atoz-nav">
	<a class="btn btn-small" href="?start="><?php _e('All','voyage'); ?></a>
  </div>
  <div class="btn-group atoz-nav">
	<a class="btn btn-small" href="?start=a">A</a>
	<a class="btn btn-small" href="?start=b">B</a>
	<a class="btn btn-small" href="?start=c">C</a>
	<a class="btn btn-small" href="?start=d">D</a>
	<a class="btn btn-small" href="?start=e">E</a>
	<a class="btn btn-small" href="?start=f">F</a>
	<a class="btn btn-small" href="?start=g">G</a>
	<a class="btn btn-small" href="?start=h">H</a>
  </div>
  <div class="btn-group atoz-nav">
	<a class="btn btn-small" href="?start=i">I</a>
	<a class="btn btn-small" href="?start=j">J</a>
	<a class="btn btn-small" href="?start=k">K</a>
	<a class="btn btn-small" href="?start=l">L</a>
	<a class="btn btn-small" href="?start=m">M</a>
	<a class="btn btn-small" href="?start=n">N</a>
	<a class="btn btn-small" href="?start=o">O</a>
	<a class="btn btn-small" href="?start=p">P</a>
	<a class="btn btn-small" href="?start=q">Q</a>
  </div>
  <div class="btn-group atoz-nav">

	<a class="btn btn-small" href="?start=r">R</a>
	<a class="btn btn-small" href="?start=s">S</a>
	<a class="btn btn-small" href="?start=t">T</a>
	<a class="btn btn-small" href="?start=u">U</a>
	<a class="btn btn-small" href="?start=v">V</a>
	<a class="btn btn-small" href="?start=w">W</a>
	<a class="btn btn-small" href="?start=x">X</a>
	<a class="btn btn-small" href="?start=y">Y</a>
	<a class="btn btn-small" href="?start=z">Z</a>
  </div>
</div>
<?php } ?>
<div id="content" class="<?php echo $sidebar ? voyage_grid_class() : voyage_grid_full(); ?> voyage_recent_post portfolio column-<?php echo $column; ?>" role="main">
<input type="hidden" id="portfolio-column" value="<?php echo $column; ?>">
<?php 
	$blog_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged'	=> $paged,
		'posts_per_page' => $postperpage,
		'ignore_sticky_posts' => 1,
		'orderby' => 'title',
		'order' => 'ASC' );
	if ( ! empty( $start ) ) {
		$post_ids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '".$start."%' ");
		$blog_args['post__in'] = $post_ids;		
	}

	if ( $pt_category ) {
		$blog_args['category__in'] = $pt_category;
	}
	if ( ! empty( $post_ids ) || '' == $start )
		$blog = new WP_Query( $blog_args );	
	if ( ( ! empty( $post_ids ) || '' == $start ) && $blog->have_posts() ) {
		$col = 0;
		while ( $blog->have_posts() ) {
			$blog->the_post();
			echo '<div class="item">';
			get_template_part( 'content', 'summary' );
			echo '</div>';	
		}
		voyage_content_nav_link( $blog->max_num_pages, 'nav-below' );
		wp_reset_postdata();
	}
	else {
		if ( 1 == $paged ) {
			echo '<div class="item">';
			printf( __('No post start with %s. Please select All or other alphabet.','voyage'), strtoupper($start) );
			echo '</div>';
		}
	}
?>						
</div>
<?php if ($sidebar) get_sidebar(); ?>
<?php get_footer(); ?>