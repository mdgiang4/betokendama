<?php
/**
 * The template for displaying fixed footer.
 *
 * @package Voyage
 * @since Voyage 1.3.8
 */
?>
</div><!-- #container -->
</div><!-- #main -->
<div id="footer-fixed">
	<div id="site-info">
		<?php esc_attr_e('&copy;', 'voyage'); ?> <?php _e(date('Y')); ?><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?></a>
	</div>
	<div id="site-generator">
		<?php _e('Powered By ', 'voyage'); ?> 
        <a href="<?php echo esc_url(__('http://wordpress.org/','voyage')); ?>" title="<?php esc_attr_e('WordPress', 'voyage'); ?>"><?php esc_attr_e('WordPress', 'voyage'); ?></a>
		<?php _e(' | ', 'voyage') ;?>
		<a href="<?php echo esc_url(__('http://www.xinthemes.com/voyage/','voyage')); ?>" title="<?php esc_attr_e('Voyage Theme by Stephen Cui', 'voyage'); ?>"><?php esc_attr_e('Voyage Theme', 'voyage'); ?></a>		
	</div>
<?php
	if ( has_nav_menu( 'footer-menu' ) ) {
		wp_nav_menu( array( 'container_class' => 'footer-menu', 'theme_location' => 'footer-menu' ) );
    }
?>
	<div class="back-to-top"><a href="#masthead"><span class="icon-chevron-up"></span><?php _e(' TOP','voyage'); ?></a></div>
</div>
</div>
<?php 
	wp_footer();
?>
</body>
</html>
