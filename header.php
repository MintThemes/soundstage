<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * Soundstage_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>    
    
<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lt IE 9]><link rel="stylesheet" media="all" type="text/css" href="<?php get_template_directory_uri(); ?>/css/ie.css" /><![endif]-->
<meta name=viewport content="width=device-width, initial-scale=1">

    
<!-- JavaScript / jQuery -->


<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && of_get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>> 

<div id="wrapper" class="hfeed site"><!-- wrapper -->
		<div id="header"><!-- header -->
			<span class="decor">&nbsp;</span>
			<h1 class="logo">
				<a href="<?php echo home_url( '/' ); ?>">
							<?php // check to see if there's a header image set
                            if (of_get_option('cap_logo_image') == 'Image URL' || of_get_option('cap_logo_image') == "") {?><div class="logotext"><?php print bloginfo( 'name' );?></div><?php
                            } else {
                                // if there's a header image, print it
                            ?><img src="<?php echo of_get_option('cap_logo_image'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                            <?php
                            // end logo image test
                            }
                            ?>
                            </a>
			</h1>
            	<nav id="site-navigation" class="navigation-main" role="navigation">
                        
                    <div class="nav-inner">
                        <h1 class="menu-toggle"><?php _e( 'Menu', 'mp_knapstack' ); ?></h1>
                        <div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mp_knapstack' ); ?>"><?php _e( 'Skip to content', 'mp_knapstack' ); ?></a></div>
            
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'mp_core_link_to_menu_editor', 'container_class' => 'menu-main-navigation-container', ) ); ?>
                        
                        <?php  echo function_exists( 'mp_links' ) ? mp_links( get_theme_mod('mp_knapstack_header_link_group') ) : NULL; ?>
                    </div><!-- .nav-inner -->
                    
                </nav><!-- #site-navigation -->
		</div><!-- end header -->