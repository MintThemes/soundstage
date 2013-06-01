<?php
/**
 * Soundstage functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, mt_soundstage_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'mt_soundstage_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 1.0.0.0
 */
 
 
 /**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */		
if ( ! isset( $content_width ) )
	$content_width = 1008;
	
// Check for Options Framework Plugin	
function mt_soundstage_of_check()
{
  if ( !function_exists('of_get_option') )
  {
	add_action('admin_notices', 'mt_soundstage_of_check_notice');
  }
}

function mt_soundstage_wc_check() {
	if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action( 'admin_notices', 'mt_soundstage_wc_check_notice' );
	}
}

function mt_soundstage_wc_check_notice() {
?>
	<div class="updated fade">
		<p><?php printf( __( 'Make sure to download, install, and activate the <a href="%s">WooCommerce</a> plugin.', 'mt_soundstage_translation' ), admin_url( sprintf( 'update.php?action=install-plugin&plugin=woocommerce&_wpnonce=%s', wp_create_nonce( 'install-plugin_woocommerce' ) ) ) );  ?></p>
	</div>
<?php
}

// The Admin Notice for the Options Framework Plugin
function mt_soundstage_of_check_notice()
{
?>
  <div class='updated fade'>
	<p><?php printf( __( 'The Options Framework plugin is required for this theme to function properly. <a href="%s">Install Now</a>', 'mt_soundstage_translation' ), admin_url( sprintf( 'update.php?action=install-plugin&plugin=options-framework&_wpnonce=%s', wp_create_nonce( 'install-plugin_options-framework' ) ) ) );  ?></p>
 
  </div>
<?php
}


/** Tell WordPress to run mt_soundstage_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'mt_soundstage_setup' );

if ( ! function_exists( 'mt_soundstage_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * To override mt_soundstage_setup() in a child theme, add your own mt_soundstage_setup to your child theme's
	 * functions.php file.
	 *
	 *
	 * @since Soundstage 1.0.0.0
	 */
	
	// Call The Admin Notice for the Options Framework Plugin
	mt_soundstage_of_check();

	mt_soundstage_wc_check();
	
	//define links to functions and includes
	$functions_path = get_template_directory() . '/functions/';
	$includes_path = get_template_directory() . '/includes/';
	
	//Custom Post Formats
	require_once ($includes_path . 'metaboxes/meta-boxes.php'); 			// Options panel settings and custom settings
	
	//Discography Settings for uploaded tracks
	require_once ($includes_path . 'audio-track-details.php'); 			// Options panel settings and custom settings
	
	//Video Metabox
	require_once ($includes_path . 'metaboxes/video-metabox.php'); 			// Options panel settings and custom settings
	
	//Events Metabox
	require_once ($includes_path . 'metaboxes/events-metabox.php'); 			// Options panel settings and custom settings
	
	//Discography Metabox
	require_once ($includes_path . 'metaboxes/discography-metabox.php'); 			// Options panel settings and custom settings
	
	//Comments
	require_once ($includes_path . 'comments.php'); 			// comments		
	
	//Check for Theme Updates:
	//require('includes/update-notifier.php');
	
	//AQ RESIZER:
	require( get_template_directory() . '/includes/aq_resizer/aq-resizer.php' );
	require( get_template_directory() . '/includes/aq_resizer/aq-resizer-ratio-check.php' );

	
	//jPlayer HTML 5 mp3/ogg player
	require_once ($includes_path . 'jplayer.php'); 	
	
	//discography jplayer loop and javascript
	require_once ($includes_path . 'jplayer-discography-head.php'); 	
	
	//WIDGETS
	//social links widget
	require_once ($includes_path . '/widgets/sociallinks.php'); 			
	//social links widget
	require_once ($includes_path . '/widgets/upcomingshows.php'); 
	//music player widget
	require_once ($includes_path . '/widgets/musicplayer.php'); 
	//latest photos widget
	require_once ($includes_path . '/widgets/latestphotos.php'); 
	//latest video widget
	require_once ($includes_path . '/widgets/latestvideo.php'); 
	
	/** WooCommerce */
	require_once( get_template_directory() . '/includes/woocommerce.php' );
	
	/**
	 * load woocommerce styles from woocommerce stylesheet included in the theme's css folder
	 **/
	function wp_enqueue_woocommerce_style(){
		wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
		if ( class_exists( 'woocommerce' ) ) {
			wp_dequeue_style('woocommerce_frontend_styles');
			wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
			wp_enqueue_style( 'woocommerce' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style', 50 );
		
	//Get current Page name:
	function mt_soundstage_curPageName() {
	 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
	
	//Setup
	function mt_soundstage_setup() {
	
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
	
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
	
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		/**
		 * Declare support for WooCommerce
		 */
		add_theme_support( 'woocommerce' );
	
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'mt_soundstage_translation', get_template_directory() . '/languages' );
	
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'mt_soundstage_translation' ),
		) );
		
	
		
	}
endif;


/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since Twenty Ten 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function mt_soundstage_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'armonico' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'armonico' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'armonico' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'mt_soundstage_filter_wp_title', 10, 2 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Soundstage 1.0.0.0
 */
function mt_soundstage_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mt_soundstage_page_menu_args' );

/**
 * Sets the post excerpt length to 150 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Soundstage 1.0.0.0
 * @return int
 */
function mt_soundstage_excerpt_length( $length ) {
	return 150;
}
add_filter( 'excerpt_length', 'mt_soundstage_excerpt_length' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override mt_soundstage_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function mt_soundstage_widgets_init() {
	// Area 1, located on the homepage.
	register_sidebar( array(
		'name' => __( 'Home Page Widget Area', 'mt_soundstage_translation' ),
		'id' => 'home-widget-area',
		'description' => __( 'The home widget area', 'mt_soundstage_translation' ),
		'before_widget' => '<div class="item-block">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget_title">',
		'after_title' => '</div>',
	) );
	// Area 2, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'mt_soundstage_translation' ),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', 'mt_soundstage_translation' ),
		'before_widget' => '<div class="item-block">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget_title">',
		'after_title' => '</div>',
	) );
	// Area 3, located at the footer.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'mt_soundstage_translation' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer widget area', 'mt_soundstage_translation' ),
		'before_widget' => '<div class="footer-block">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer_widget_title">',
		'after_title' => '</div>',
	) );
	
	//register widgets
	register_widget( 'mt_soundstage_Social_links' );
	register_widget( 'mt_soundstage_Upcoming_shows' );
	register_widget( 'mt_soundstage_Music_player' );
	register_widget( 'mt_soundstage_Latest_video' );
	register_widget( 'mt_soundstage_Latest_photos' );
	
}
/** Register sidebars by running mt_soundstage_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'mt_soundstage_widgets_init' );



// Get author image URL
global $wp_version;

if ( empty($wp_version) || version_compare($wp_version, '2.5', '<') ) { // WP 2.4 or less
    wp_die(__('This version of GetAvatarImg Plugin requires WordPress version 2.5 or newer.'));
}


// use it just as get_avatar
function get_avatar_img($id_or_email, $size = '96', $default = '', $alt = false){
	// retrieves the avatar
	$avatar = get_avatar($id_or_email, $size, $default, $alt);
	// image parsing
	$openPos = strpos($avatar, 'src=\'');
	$closePos = strpos(substr($avatar, ($openPos+5)), '\'');
	$newAvatar = substr($avatar, ($openPos+5), ($closePos-($openPos+5)) );
	
	// returns the url
	return $newAvatar;
}

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function mt_soundstage_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'mt_soundstage_remove_recent_comments_style' );

if ( ! function_exists( 'mt_soundstage_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post—date/time and author.
	 *
	 * @since Twenty Ten 1.0
	 */
	function mt_soundstage_posted_on() {
		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'mt_soundstage_translation' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'mt_soundstage_translation' ), get_the_author() ),
				get_the_author()
			)
		);
	}
endif;

//Get category ID based off of the category name 
function mt_soundstage_get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

//Header Scripts and Jquery
function mt_soundstage_header_scripts(){ 

	wp_enqueue_script("jquery");
	
    // Register the scripts for the theme: 
	wp_enqueue_script( 'mt_clear-form-feilds', get_template_directory_uri() . '/js/clear-form-feilds.js' ); 
	wp_enqueue_script( 'mt_flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' ); 
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'mt_ui_select', get_template_directory_uri() . '/js/ui.js', array( 'jquery-ui-core', 'jquery-ui-widget' ) ); 
    wp_enqueue_script( 'mt_main', get_template_directory_uri() . '/js/jquery.main.js' ); 
	wp_localize_script('mt_main', 'mt_script_vars', array(
			'cap_slider_slideshow' => __(of_get_option("cap_slider_slideshow"), 'Soundstage'),
			'cap_slider_time' => __(of_get_option("cap_slider_time"), 'Soundstage')
		)
	);
	
	//thickbox
	add_thickbox();
	
}
add_action('wp_enqueue_scripts', 'mt_soundstage_header_scripts');

function mt_soundstage_css() {
	wp_enqueue_style( 'soundstage', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mt_soundstage_css', 100 );


//modify the main loop on the for home and other pages
function mt_soundstage_loop_query( $query = false ) {

	// Bail if not front page, not a query, not main query
	if ( ! is_front_page() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query()){
		return;
	}
	
	//home
	if (is_front_page()){
		// set
		$query->set('cat' , of_get_option('cap_recent_posts_cat'));
		$query->set('showposts', 4);	
	}
	
	//archive pages
	if( !$query->is_archive == 1 ) {
		return;
		$query->set('paged' , true);
	}
}
add_action( 'pre_get_posts', 'mt_soundstage_loop_query' );


//modify the loop for the event page
function mt_soundstage_ep_event_query( $query ) {
    // http://codex.wordpress.org/Function_Reference/current_time
	echo $cat;
    $current_time = current_time('mysql');
    list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $current_time );
    $current_timestamp = $today_year . $today_month . $today_day . $hour . $minute;
    global $wp_the_query;
    if ( $wp_the_query == $query && !is_admin() && $cat = of_get_option("cap_events_cat") ) {
        $meta_query = array(
            array(
                'key' => '_start_eventtimestamp',
                'value' => $current_timestamp,
                'compare' => '>'
            )
        );
        $query->set( 'meta_query', $meta_query );
        $query->set( 'orderby', 'meta_value_num' );
        $query->set( 'meta_key', '_start_eventtimestamp' );
        $query->set( 'order', 'ASC' );
		
    }
}
//add_action( 'pre_get_posts', 'mt_soundstage_ep_event_query' );


/**
* Returns ID of top-level parent category, or current category if you are viewing a top-level
*
* @param	string		$catid 		Category ID to be checked
* @return 	string		$catParent	ID of top-level parent category
*/
function mt_soundstage_pa_category_top_parent_id ($catid) {
 while ($catid) {
  $cat = get_category($catid); // get the object for the catid
  $catid = $cat->category_parent; // assign parent ID (if exists) to $catid
  // the while loop will continue whilst there is a $catid
  // when there is no longer a parent $catid will be NULL so we can assign our $catParent
  $catParent = $cat->cat_ID;
 }
return $catParent;
}

//Favicon
function mt_soundstage_favicon(){
	//show analytics
	if (of_get_option("cap_custom_favicon") != ""){
		echo ('<link rel="icon" type="image/png" href="' . of_get_option("cap_custom_favicon") . '">');
	}
}
add_action( 'wp_head', 'mt_soundstage_favicon' );

//Get posts by category function
function mt_soundstage_get_posts_by_cat($catid){
	$category_query_args = array(
		'cat' => $catid
	);
	
	$category_query = new WP_Query( $category_query_args );	
	
	if ( $category_query->have_posts() ) {
		 while ( $category_query->have_posts() ) { 
			 $category_query->the_post();
			// Loop output goes here
			$return_array[get_the_ID()] = get_the_title(); 
			
		 }
	}
	
	return $return_array;
}
