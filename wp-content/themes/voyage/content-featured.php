<?php
	global $more, $voyage_options;
	$more = 0;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
<?php	
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
if ( $image[1] > 0 ) { // has_post_thumbnail() has bug - this is the wordaround.
	if ( $image[1] >= ( $voyage_options['grid_pixel'] * 0.70 ) ) { // Large Thumnail
		if ( 1 == $voyage_options['fp_image'] ) { //Normal ?>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'carousel-image', 'title' => get_the_title() ) ); ?></a>	
<?php		echo '<div class="carousel-caption foreground-imgae">';
		} 
		elseif ( 2 == $voyage_options['fp_image'] ) { //Background Centered
?>
<style>
.featured .carousel-inner .item.post-<?php the_ID(); ?> {
	background: url(<?php echo esc_url($image[0]); ?>) no-repeat center;
<?php 		if ($voyage_options['fp_height'] > 0 && $image[2] > $voyage_options['fp_height']) {
				$offset = absint( ($image[2] - $voyage_options['fp_height'] ) / 2 );
				echo 'background-position: auto -' . $offset . 'px;';
			}
			else {
				echo 'background-position: auto 0;';
			} ?>
}
</style>
<?php		echo '<div class="carousel-caption background-image">';
		} else { //Full Screen
			the_post_thumbnail( 'full', array( 'class' => 'featured-fullwidth-image', 'title' => get_the_title() ) );
			echo '<div class="fullwidth-caption clearfix">';
		}?>

		<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
  <?php 
		if (3 == $voyage_options['fp_image'] ) {
			if ( has_excerpt() ) {
				the_excerpt();
				voyage_custom_readmore( $voyage_options['fp_action'] );
			} else {
				echo '<div class="entry-content">';
				the_content( '' );
				echo '</div>';
			}
		}
		else {
			the_excerpt(); 
			voyage_custom_readmore();
		} 
		echo '</div>';	 
	} else { //Smaller Thumnail ?>
	<div class="<?php echo voyage_grid_full(); ?> small-thumbnail clearfix">
		<div class="one_half alpha">
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header>	
<?php 		if ( has_excerpt() ) {
				echo '<div class="entry-summary clearfix">';
				the_excerpt();
			}
			else {
				echo '<div class="entry-content clearfix">';
				add_filter( 'the_content', 'remove_images', 100 );
				the_content( '' );
				remove_filter( 'the_content', 'remove_images', 100 );	
			}
			voyage_custom_readmore( $voyage_options['fp_action'] );
			echo '</div>';
?>
		</div>
		<div class="one_half omega">		
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'full', array( 'class'	=> 'carousel-image', 'title' => get_the_title() ) ); ?></a>
		</div>			
	</div>
<?php
	} //Large or Small featured images
} elseif ( has_post_format( 'image' ) ) { //Image Posts  ?>
	<div class="<?php echo voyage_grid_full(); ?> no-thumbnail clearfix">
		<?php the_content( '' ); ?>		
		<div class="carousel-caption clearfix">
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</div>
	</div>		
<?php
} else { // Post without Featured Image 
?>
	<div class="<?php echo voyage_grid_full(); ?> no-thumbnail clearfix">
		<header class="entry-header">			
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content clearfix">								
			<?php the_content( '' ); ?>	
		</div>
	</div>
<?php
} 
?>
</article>
