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
    
    <?php wp_enqueue_script("jquery"); ?>
    
    
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/flexslider.css" />

<!--[if lt IE 9]><link rel="stylesheet" media="all" type="text/css" href="<?php get_template_directory_uri(); ?>/css/ie.css" /><![endif]-->
<meta name="viewport" content="width=1024">

    
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

<div id="wrapper"><!-- wrapper -->
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
            
			<ul id="nav">
				<?php
                
                $options = array(
                'echo' => false
                ,'container' => false
                );
                
                $menu = wp_nav_menu($options);
                echo preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $menu );
                
                ?>
			</ul>
		</div><!-- end header -->