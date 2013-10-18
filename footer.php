<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
?>

<div class="footer-holder"><!-- footer -->
			<div id="footer">
				<div class="holder">
					<?php 
                    if ( ! dynamic_sidebar( 'footer-widget-area' ) ) : ?>

                       <?php get_search_form(); ?>
            
                    <?php endif; // end footer widget area ?>
                    
              
					
				</div>
            
				<ul class="footer-nav">
					<?php
                
					$options = array(
					'echo' => false
					,'container' => false,
					'theme_location' => 'footer'
					);
					
					$menu = wp_nav_menu($options);
					echo preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
					
					?>
				</ul>
				<p class="copy">&copy; <?php echo date("Y");?> <?php print bloginfo( 'name' ); ?>. <?php _e('All Rights Reserved ', 'mt_soundstage_translation'); ?>. <?php _e('Designed By ', 'mt_soundstage_translation'); ?><a href="http://mintthemes.com"><?php _e('Mint Themes ', 'mt_soundstage_translation'); ?></a></p>
			</div>
		</div><!-- end footer -->
	</div><!-- end wrapper -->
    <?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
	?>
</body>
</html>
