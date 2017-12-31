<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Voyage Theme functions: Content
 *
 * @package voyage
 * @subpackage voyage
 * @since Voyage 1.1.3
 */
if ( ! function_exists( 'voyage_screen_reader' ) ) :
// Display screen reader text
function voyage_screen_reader() {
	printf( '<div class="screen-reader-text"><a href="#content" title="%1$s">%1$s</a></div>',
		 __( 'Skip to content', 'voyage' ) );
}
endif; 

if ( ! function_exists( 'voyage_single_post_link' ) ) :
/* This function echo the link to single post view for the following:
- Aside Post
- Post without title
------------------------------------------------------------------------- */
function voyage_single_post_link() {
	if ( ! is_single() ) {
		if ( has_post_format( 'aside' ) || has_post_format( 'quote' ) || '' == the_title_attribute( 'echo=0' ) ) { 
			printf ('<a class="single-post-link" href="%1$s" title="%1$s"><i class="icon-chevron-right"></i></a>',
				get_permalink(),
				get_the_title()	);
		} 
	}
}
endif;

if ( ! function_exists( 'voyage_display_post_thumbnail' ) ) :
// Display Large Post Thumbnail on top of the post
function voyage_display_post_thumbnail( $post_id ) {
	global $voyage_options;
//	if ( has_post_thumbnail() ) { has_post_thumbnail has bug 
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );	
	if ( $image[1] >= ( $voyage_options['grid_pixel'] * 0.7  ) 
			&& $image[2] < 1000 ) {
		if ( ! is_single() ) {
			printf ('<a href="%1$s" title="%2$s">', 
				get_permalink(),
				get_the_title()	);	
			the_post_thumbnail( 'full', array( 'class'	=> 'img-polaroid featured-image', 'title' => get_the_title() ) );
			echo '</a>';
		}
		else
			the_post_thumbnail( 'full', array( 'class'	=> 'img-polaroid featured-image', 'title' => get_the_title() ) );
	}
}
endif;

if ( ! function_exists( 'voyage_post_title' ) ) :
// Display Post Title
function voyage_post_title() {
	global $voyage_options;
	if ( is_single() ) {
		if ( 0 == $voyage_options['titlebar'] )
			printf('<h1 class="entry-title">%1$s</h1>',
				get_the_title()	);		
	}
	else {
		printf('<h2 class="entry-title"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></h2>',
			get_permalink(),
			sprintf( esc_attr__( 'Permalink to %s', 'voyage' ), the_title_attribute( 'echo=0' ) ),
			get_the_title()	);
	}
}
endif;

if ( ! function_exists( 'voyage_author_info' ) ) :
/************************************************
Display Author Info on single post view 
 and author has filled out their description
 and showauthor option checked 
************************************************/ 
function voyage_author_info() {
	global $voyage_options;
	if ( is_single() && get_the_author_meta( 'description' ) && $voyage_options['showauthor'] ) { ?>
	<div id="author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'voyage_author_bio_avatar_size', 64 ) ); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h2><?php printf( __( 'About %s', 'voyage' ), get_the_author() ); ?></h2>
			<?php the_author_meta( 'description' ); ?>
			<div id="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s <span class="meta-nav"></span>', 'voyage' ), get_the_author() ); ?></a>
			</div>
		</div>
	</div>
<?php 
	}
}
endif;

if ( ! function_exists( 'voyage_top_menu' ) ) :	
/************************************************
Display Top Menu
************************************************/ 
function voyage_top_menu() {
	global $voyage_options;
	
	if ( has_nav_menu('top-menu') || $voyage_options['sociallink_top'] ) {
		if ( $voyage_options['fixed_menu'] )
			$class = "navbar-inverse navbar-fixed-top";
		else
			$class = "navbar-no-background";
		echo '<div id="access" class="navbar ' . $class . ' clearfix">';
		echo '<div class="navbar-inner">';
		echo '<div class="'	. voyage_container_class() . '">';	
		if ( $voyage_options['sociallink_top'] )
			voyage_social_connection( 'top' );
		$header_image = get_header_image();

		if ( ! empty( $header_image ) && 3 == $voyage_options['logopos'] ) { ?>
			<div id="logo" class="pull-left">
    	      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			  	<?php voyage_logo_image( $header_image ) ?>
		  	  </a>
			</div>
<?php
		}
		if ( has_nav_menu( 'top-menu' ) ) {
			echo '<nav id="top-navigation" class="top-menu">';
			wp_nav_menu( array(	'container' => '',
							'container_class' => '',
							'theme_location'  => 'top-menu',
							'menu_class'      => 'menu',
							'fallback_cb' 	  => false,				
							 ) );
			echo '</nav>';
		}
		echo '</div></div></div>';
  	}
}
endif;

if ( ! function_exists( 'voyage_nav_menu' ) ) :
function voyage_nav_menu() {
	global $voyage_options;
	
	voyage_header_before_navbar();	
?>
<div id="mainmenu" class="navbar <?php if ( 1 == $voyage_options['navbarcolor'] ) echo 'navbar-inverse ';  ?>clearfix">
  <div class="<?php echo voyage_container_class(); ?>">
<?php
	if ( $voyage_options['nonavbar'] != '1' ) {
?>
  	<div class="navbar-inner">
	  <nav id="section-menu" class="section-menu">	
<?php
		$header_image = get_header_image();
		if ( ! empty( $header_image ) && 1 == $voyage_options['logopos'] ) { ?>
          	<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php voyage_logo_image( $header_image ) ?>
			</a>
<?php	} ?>
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
		<div class="nav-collapse">
<?php		if ( 1 == $voyage_options['searchform'] || 2 == $voyage_options['searchform'] ) {
				voyage_top_search_form();
			}				
			if ( has_nav_menu( 'section-menu' ) ) {
				wp_nav_menu(
					array( 'container_class' => 'section-menu-container', 
						   'theme_location' => 'section-menu',
						   'menu_class'     => 'nav',
						   'walker'         => new voyage_walker_nav_menu,
						   'fallback_cb' 	  => false,	
					 		) );
			}
	 		voyage_subsection_menu(); ?>
		</div><?php //nav-collapse ?>
	</nav>
    </div><?php //nav-inner ?>
<?php
	}
	get_sidebar( 'navigation' ); ?>
  </div><?php //container ?>
</div><?php //navbar ?>
<?php
}
endif;

if ( ! function_exists( 'voyage_top_search_form' ) ) :	
function voyage_top_search_form() {
	global $voyage_options;
	$phone_class = '';
	if (2 == $voyage_options['searchform'] )
		$phone_class ="visible-phone"; 
?>
    <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-search pull-right <?php echo $phone_class; ?>">
    	<input type="text" class="search-query" name="s" id="s1" placeholder="<?php esc_attr_e( 'Search', 'voyage' ); ?>">
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'voyage' ); ?>" />
    </form>
<?php
}
endif;

if ( ! function_exists( 'voyage_subsection_menu' ) ) :
/************************************************
Display Subsection Menu and wp_page_menu fallback
if no menu assigned
************************************************/ 
function voyage_subsection_menu() {
	if ( has_nav_menu( 'subsection-menu' ) 
			|| ( ! has_nav_menu( 'top-menu' ) && ! has_nav_menu( 'section-menu' ) ) ) {
		if ( has_nav_menu( 'section-menu' ) )
			echo '<div class="clear"></div>';
		echo '<div id="subsection-menu" class="subsection-menu">';
		wp_nav_menu( array(	'container' => '',
							'container_class' => '',
							'theme_location'  => 'subsection-menu',
							'menu_class'      => 'menu',			
							 ) );
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'voyage_logo_image' ) ) :
function voyage_logo_image( $header_image, $size = 'full' ) {
	$html = '';
//	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) {
		if( function_exists( 'get_custom_header' ) ) {
			$header_width = get_custom_header() -> width;
			$header_height = get_custom_header() -> height;
		}
		else {
			$header_width = HEADER_IMAGE_WIDTH;
			$header_height = HEADER_IMAGE_HEIGHT;				
		}
		if ( 'full' != $size ) {
			$ratio = $size / $header_height;
			$header_height = (int) $header_height * $ratio;
			$header_width = (int) $header_width  * $ratio;				 
		}
		$html = '<img src="' . $header_image . '" width="';
		$html .= $header_width . '" height="' . $header_height;
		$html .= '" alt="' . get_bloginfo( 'name') . '" />';
	}	
	echo apply_filters( 'voyage_logo_image', $html );
}
endif;

if ( ! function_exists( 'voyage_branding' ) ) :
function voyage_branding() {
	global $voyage_options;
?>
<div id="branding" class="<?php echo voyage_container_class(); ?> clearfix">
  <div class="<?php echo voyage_grid_full(); ?> clearfix">
<?php
	voyage_header_branding();
	get_sidebar( 'header' );
	if ( 4 == $voyage_options['searchform'] )
		voyage_top_search_form();
	$header_image = get_header_image();

	if ( ! empty( $header_image ) && 2 == $voyage_options['logopos'] ) { ?>
		<div id="logo">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		  	<?php voyage_logo_image( $header_image ) ?>
		  </a>
		</div>
<?php
	} else { ?>
		<hgroup>
		  <h3 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
		  <h3 id="site-description"><?php bloginfo( 'description' ); ?></h3>
		</hgroup>	
<?php
	}
?>	  
  </div>
</div>
<?php
}
endif;

if ( ! function_exists( 'voyage_header_style_one' ) ) :
// Logo on the left, Menu float to right
function voyage_header_style_one() {
	global $voyage_options;
?>
<div id="branding" class="<?php echo voyage_container_class(); ?> clearfix">
  <div class="<?php echo voyage_grid_full(); ?> clearfix">
<?php
	voyage_header_branding();
	get_sidebar( 'header' );
	if ( 1 == $voyage_options['searchform'] || 4 == $voyage_options['searchform'] )
		voyage_top_search_form();
	$header_image = get_header_image();

	if ( ! empty( $header_image ) && 3 != $voyage_options['logopos']) { ?>
		<div id="logo" class="pull-left">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		  	<?php voyage_logo_image( $header_image ) ?>		  	
		  </a>
		</div>
<?php
	} else { ?>
		<hgroup class="pull-left">
		  <h3 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
		  <h3 id="site-description"><?php bloginfo( 'description' ); ?></h3>
		</hgroup>	
<?php
	}
	voyage_header_before_navbar();
	if ( $voyage_options['nonavbar'] != '1' ) {	
?>
	  <div id="mainmenu-one" class="navbar <?php if (1 == $voyage_options['navbarcolor'] ) echo 'navbar-inverse '; ?> pull-right">
  		<div class="navbar-inner">
		  <nav id="section-menu" class="section-menu">	
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a>
		    <div class="nav-collapse">
<?php			
			if ( has_nav_menu( 'section-menu' ) ) {
				wp_nav_menu(
					array(  'container_class' => 'section-menu-container', 
							'theme_location' => 'section-menu',
							'menu_class'     => 'nav',
							'walker'         => new voyage_walker_nav_menu,
							'fallback_cb' 	  => false,	
					 		) );
			}
	 		voyage_subsection_menu(); ?>
		 	</div><?php //nav-collapse ?>
		  </nav>
   		</div><?php //nav-inner ?>
	  </div><?php //navbar ?>
<?php
	}
		?>
	<div class="clear"></div>
	<?php get_sidebar( 'navigation' ); ?>
  </div>
</div>
<?php
}
endif;
if ( ! function_exists( 'voyage_default_widgets' ) ) :	
/************************************************
Display defaul tabbed widgets
************************************************/ 
function voyage_default_widgets() {
?>
<li class="widget-container voyage_navigation">
	<ul id="vntTab" class="nav nav-tabs">
		<li class="active"><a href="#category" data-toggle="tab"><?php _e('Categories','voyage'); ?></a></li>
		<li><a href="#archive" data-toggle="tab"><?php _e('Archives','voyage'); ?></a></li>
        <li><a href="#tag" data-toggle="tab"><?php _e('Tags','voyage'); ?></a></li>
    </ul>
	<div id="vntTabContent" class="tab-content">
        <div class="widget_categories tab-pane fadein active" id="category">
			<ul>
			<?php
				$cat_args = array();
				$cat_args['show_count'] = 1;
				$cat_args['title_li'] = '';
				$cat_args['exclude'] = 1;
				wp_list_categories( $cat_args ); ?>
			</ul>
        </div>
        <div class="widget_archive tab-pane fade" id="archive">
			<ul>
			<?php
				$arc_args = array();
				$arc_args['type'] = 'monthly';
				$arc_args['limit'] = 10;
				wp_get_archives( $arc_args ); ?>
			</ul>
        </div>
        <div class="widget_tag_cloud tab-pane fade" id="tag">
			<ul>
			<?php
				$tag_args = array();
				wp_tag_cloud( $tag_args ); 
			?>
			</ul>
        </div>
	</div>
</li>
<li id="recent_post" class="widget-container widget_recent_entries">
	<h4 class="widget-title"><?php _e( 'Recent Posts', 'voyage' ); ?></h4>
	<ul>
<?php	$args = array( 'post_status' => 'publish' );
		$recent_posts = wp_get_recent_posts( $args );
		foreach( $recent_posts as $recent ) {
			echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' .   $recent["post_title"].'</a> </li> ';
		}
?>
	</ul>
</li>
<?php
}
endif;

if ( ! function_exists( 'voyage_carousel_controls' ) ) :	
/************************************************
Display carousel_controls
************************************************/ 
function voyage_carousel_controls($count) {
?>
	<a id="featured-prev" class="carousel-control left">&lsaquo;</a>
	<a id="featured-next" class="carousel-control right">&rsaquo;</a>
	<div class="carousel-nav clearfix">
	  <ol class="carousel-indicators">
<?php
		for ( $i = 0; $i < $count; $i++ ) {
			echo '<li data-target=".carousel" data-slide-to="';
			if ( 0 == $i )
				echo '0" class="active"></li>';
			else
				echo $i . '"></li>';
		}
?>
	  </ol>
	</div>
<?php
}
endif;

if ( ! function_exists( 'voyage_gallery_summary' ) ) :	
function voyage_gallery_summary() {
	$content = get_the_content();
	foreach ( voyage_gallery_image_ids( $content ) as $image )
		echo wp_get_attachment_link( $image, 'thumbnail' );
}
endif;

if ( ! function_exists( 'voyage_title_bar' ) ) :	
function voyage_title_bar() {
	global $voyage_options;

	if ( 1 == $voyage_options['sociallink_middle']
		|| ( 1 == $voyage_options['titlebar'] && ! is_home() )
		|| function_exists( 'bcn_display' ) ) {
?>
	<div id="title" class="titlebar clearfix">
	  <div class="<?php echo voyage_container_class(); ?>">
		<div class="<?php echo voyage_grid_full(); ?>">
<?php
		if ( $voyage_options['sociallink_middle'] )
			voyage_social_connection('middle');			
		if ( 1 == $voyage_options['titlebar'] )
			voyage_page_title();
?>
<div class="breadcrumbs">
<?php	if ( function_exists( 'bcn_display' ) ) {
        	bcn_display();
    	}
?>
</div>
	  	</div>
	  </div>	  
	</div>
<?php
	}
}
endif;

if ( ! function_exists( 'voyage_page_title' ) ) :	
function voyage_page_title() {
	global $voyage_options, $post;
	if ( ! have_posts()) return;
	if ( is_single() ) {
		printf( '<h1>%1$s</h1>', get_the_title() );		
	} elseif ( is_page() ) {
		$pagetitle = get_post_meta( $post->ID, '_voyage_title', true );
		if ( empty( $pagetitle ) )
			printf( '<h1>%1$s</h1>', get_the_title() );
	} elseif ( is_search() ) { ?>
		<h1><?php printf( __( 'Search Results for: %s', 'voyage' ), '<span>' . get_search_query() . '</span>' ); ?></h1>	
<?php
	} elseif ( is_author() ) {
		if (  $voyage_options['showauthor'] ) {
			the_post(); ?>
			<h1><?php printf( __( 'Author Archives: %s', 'voyage' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
<?php		rewind_posts();		
		}
	}
	elseif ( is_category() ) {
		$category_description = category_description();
		if ( empty( $category_description ) ) { ?>					
			<h1><?php printf( __( 'Category Archives: %s', 'voyage' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
<?php
		} else
			echo '<h1>'. $category_description .'</h1>';			
	}
	elseif ( is_tag() ) {
		$tag_description = tag_description();
		if ( empty( $tag_description ) ) { ?>					
			<h1><?php printf( __( 'Tag Archives: %s', 'voyage' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
<?php
		} else
			echo '<h1>'. $tag_description .'</h1>';			
	}
	elseif ( is_archive() ) {
		echo '<h1>';
		if ( is_day() ) 
			printf( __( 'Daily Archives: %s', 'voyage' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() )
			printf( __( 'Monthly Archives: %s', 'voyage' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'voyage' ) ) . '</span>' );
		elseif ( is_year() )
			printf( __( 'Yearly Archives: %s', 'voyage' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'voyage' ) ) . '</span>' );
		else
			the_title(); 
		echo '</h1>';	
	}
}
endif;

if ( ! function_exists( 'voyage_custom_readmore' ) ) :	
function voyage_custom_readmore( $default = '' ) {
	global $post;
	
	$readmore = get_post_meta( $post->ID, '_voyage_readmore', true );
	if ( ! empty( $readmore ) )
		$list = '<p class="more-link-custom"><a class="btn btn-info" href="'. get_permalink() . '">' . $readmore . '</a></p>';
	elseif ( ! empty( $default ) )
		$list = '<p class="more-link-custom"><a class="btn btn-info" href="'. get_permalink() . '">' . $default . '</a></p>';
	else
		$list = '';	
	echo $list;
}
endif;

if ( ! function_exists( 'voyage_template_intro' ) ) :
function voyage_template_intro() {
	global $post, $voyage_options;
		
	$pagetitle = get_post_meta( $post->ID, '_voyage_title', true );
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	if ( ( empty( $pagetitle ) && 0 == $voyage_options['titlebar'] ) || ! empty($content)) {
?>
<article id="post-<?php the_ID(); ?>" class="template-intro clearfix <?php echo voyage_grid_full(); ?>">
<?php
		if ( empty( $pagetitle ) && 0 == $voyage_options['titlebar'] )
			printf('<h1 class="entry-title">%1$s</h1>',
				get_the_title()	);
		if ( ! empty( $content ) ) {
			echo '<div class="entry-content clearfix">';
			echo $content;
			echo '</div>';			
		}
?>
</article>
<?php
	}
}
endif;

if ( ! function_exists( 'voyage_display_headline' ) ) :
function voyage_display_headline() {
	global $voyage_options;
	if ( 1== $voyage_options['fp_headline'] ) {
?>
	  <div class="headline-wrapper clearfix">
		<div class="<?php echo voyage_container_class(); ?>">
		  <div class="<?php echo voyage_grid_full(); ?> headline">
<?php		if (!empty($voyage_options['headline']))
				printf('<h1>%s</h1>', $voyage_options['headline']);
			if (!empty($voyage_options['tagline']))
				printf('<p>%s</p>', $voyage_options['tagline'] );
?>
		  </div>
		</div>
	  </div>
<?php
	}
}
endif;

