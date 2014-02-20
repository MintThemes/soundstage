<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_template();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'mt_soundstage_translation'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	
	$category_args = array('hide_empty' => 0);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$terms  = get_terms( array( 'category' ), array( 'hide_empty' => 0 ) );
	
	foreach ( $terms as $term ) {
		$options_categories[ $term->term_id ] = $term->name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

	$options[] = array(
		'name' => __('Basic Settings', 'mt_soundstage_translation'),
		'type' => 'heading');
	
	$options[] = array( "name" => __("Custom Logo", 'mt_soundstage_translation'),
                    "desc" => __("Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png). Recomended Size: 234px by 47px. It is also recommended to upload a logo with a transparent background in PNG format.", 'mt_soundstage_translation'),
                    "id" => "cap_logo_image",
                    "std" => "Image URL",
                    "type" => "upload");
	

	$options[] = array( "name" => __("Videos Category", 'mt_soundstage_translation'),
					"desc" => __("Select the category you want to use for the videos.", 'mt_soundstage_translation'),
					"id" => "cap_videos_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $options_categories);
	
	$options[] = array( "name" => __("Photos Category", 'mt_soundstage_translation'),
					"desc" => __("Select the category you want to use for photos.", 'mt_soundstage_translation'),
					"id" => "cap_photos_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $options_categories);
		

	$options[] = array( "name" => __("Discography Category", 'mt_soundstage_translation'),
					"desc" => __("Select the category you want to use for discography.", 'mt_soundstage_translation'),
					"id" => "cap_disc_cat",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $options_categories);
	
		$options[] = array( "name" => __("Tour Dates Category", 'mt_soundstage_translation'),
					"desc" => __("Select the category you want to use for tour dates.", 'mt_soundstage_translation'),
					"id" => "cap_events_cat",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $options_categories);
		
$options[] = array( "name" => __("Custom Favicon", 'mt_soundstage_translation'),
                    "desc" => __("Upload a 16px x 16px PNG/GIF image that will represent your website's favicon.", 'mt_soundstage_translation'),
                    "id" => "cap_custom_favicon",
                    "std" => "Favicon",
                    "type" => "upload");

//slider
$options[] = array(
					'name' => __('Top Slider', 'mt_soundstage_translation'),
					'type' => 'heading');

$options[] = array( "name" => __("Slideshow ON?", 'mt_soundstage_translation'),
					"desc" => __("Do you want the slideshow to be on?", 'mt_soundstage_translation'),
					"id" => "cap_slider_slideshow",
					"std" => "On.",
					"type" => "checkbox");

$options[] = array( "name" => __("Pause Length", 'mt_soundstage_translation'),
                    "desc" => __("Enter the length of the pause for each slide. Enter in Milliseconds. Eg: 3000 = 3 seconds.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_time",
                    "std" => "3000",
                    "type" => "text");

$options[] = array( "name" => __("First Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the first slide on the homepage",
					"type" => "info");

$options[] = array( "name" => __("First Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 1st image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image1",
                    "std" => "1st URL",
                    "type" => "upload");

$options[] = array( "name" => __("First Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title1",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => __("First Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle1",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("First Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link1",
                    "std" => "Link",
                    "type" => "text");

$options[] = array( "name" => __("Second Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the second slide on the homepage",
					"type" => "info");
//
$options[] = array( "name" => __("Second Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 2nd image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image2",
                    "std" => "2nd URL",
                    "type" => "upload");

$options[] = array( "name" => __("Second Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title2",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => __("Second Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle2",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("Second Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link2",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => __("Third Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the third slide on the homepage",
					"type" => "info");

$options[] = array( "name" => __("Third Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 3rd image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image3",
                    "std" => "3rd URL",
                    "type" => "upload");

$options[] = array( "name" => __("Third Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title3",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => __("Third Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle3",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("Third Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link3",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => __("Fourth Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the fourth slide on the homepage",
					"type" => "info");

$options[] = array( "name" => __("Fourth Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 4th image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image4",
                    "std" => "4th URL",
                    "type" => "upload");

$options[] = array( "name" => __("Fourth Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title4",
                    "std" => "Image Title",
                    "type" => "text");


$options[] = array( "name" => __("Fourth Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle4",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("Fourth Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link4",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => __("Fifth Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the fifth slide on the homepage",
					"type" => "info");

$options[] = array( "name" => __("Fifth Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 5th image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image5",
                    "std" => "5th URL",
                    "type" => "upload");

$options[] = array( "name" => __("Fifth Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title5",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => __("Fifth Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle5",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("Fifth Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link5",
                    "std" => "Link",
                    "type" => "text");
//
$options[] = array( "name" => __("Sixth Slide", 'mt_soundstage_translation'),
					"desc" => __("", 'mt_soundstage_translation'),
					"std" => "Enter the following information for the sixth slide on the homepage",
					"type" => "info");

$options[] = array( "name" => __("Sixth Image Slide", 'mt_soundstage_translation'),
                    "desc" => __("Upload the 6th image for the homepage fader. 1440px by 442px", 'mt_soundstage_translation'),
                    "id" => "cap_slider_image6",
                    "std" => "6th URL",
                    "type" => "upload");

$options[] = array( "name" => __("Sixth Image Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_title6",
                    "std" => "Image Title",
                    "type" => "text");

$options[] = array( "name" => __("Sixth Image Subtitle", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Subtitle you want to go with this image. Optional.", 'mt_soundstage_translation'),
                    "id" => "cap_slider_subtitle6",
                    "std" => "Image Subtitle",
                    "type" => "text");

$options[] = array( "name" => __("Sixth Image URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL you want this image to go when clicked", 'mt_soundstage_translation'),
                    "id" => "cap_slider_link6",
                    "std" => "Link",
                    "type" => "text");



// recent posts
$options[] = array( "name" => __("News", 'mt_soundstage_translation'),
                    "type" => "heading");

$options[] = array( "name" => __("Show News and Announcements on Homepage?", 'mt_soundstage_translation'),
                    "desc" => __("Do you want to show the \"News and Announcements\" section on the homepage?", 'mt_soundstage_translation'),
                    "id" => "cap_recent_posts",
                    "std" => "true",
                    "type" => "checkbox"); 

$options[] = array( "name" => __("News and Announcements Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to use for the 'News and Announcements' area on the homepage. ", 'mt_soundstage_translation'),
                    "id" => "cap_home_recent_posts_title",
                    "std" => "News and Announcements",
                    "type" => "text");

$options[] = array( "name" => __("News and Announcements Category", 'mt_soundstage_translation'),
					"desc" => __("If you selected the opton above, select the category you want to use for the recent posts on the homepage. If not, this option doesn't matter as it will not be used and the options below will be used instead.", 'mt_soundstage_translation'),
					"id" => "cap_recent_posts_cat",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $options_categories);



// Merch
$options[] = array( "name" => __("Merch", 'mt_soundstage_translation'),
                    "type" => "heading");


$options[] = array( "name" => __("Show Merchandise on Homepage?", 'mt_soundstage_translation'),
                    "desc" => __("Do you want to show the \"Merchandise\" section on the homepage?", 'mt_soundstage_translation'),
                    "id" => "cap_show_merch",
                    "std" => "true",
                    "type" => "checkbox"); 

$options[] = array( "name" => __("Merchandise Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to use for the 'Merchandise' area on the homepage. ", 'mt_soundstage_translation'),
                    "id" => "cap_merch_title",
                    "std" => "Merchandise",
                    "type" => "text");


//Social Links
$options[] = array( "name" => __("Social Links", 'mt_soundstage_translation'),
                    "type" => "heading");


$options[] = array( "name" => __("Show Social Links on Homepage?", 'mt_soundstage_translation'),
                    "desc" => __("Do you want to show the \"Social Links\" section on the homepage?", 'mt_soundstage_translation'),
                    "id" => "cap_show_social",
                    "std" => "true",
                    "type" => "checkbox"); 

$options[] = array( "name" => __("Social Area Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Title you want to use for the 'Social Links' area on the homepage. ", 'mt_soundstage_translation'),
                    "id" => "cap_social_title",
                    "std" => "Social Links",
                    "type" => "text");

$options[] = array( "name" => __("Twitter URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL ", 'mt_soundstage_translation'),
                    "id" => "cap_twitter_url",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Facebook URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL ", 'mt_soundstage_translation'),
                    "id" => "cap_facebook_url",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Flickr URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Flickr URL ", 'mt_soundstage_translation'),
                    "id" => "cap_flickr_url",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("YouTube URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL ", 'mt_soundstage_translation'),
                    "id" => "cap_youtube_url",
                    "std" => "",
                    "type" => "text");


//Newsletter
$options[] = array( "name" => __("Newsletter", 'mt_soundstage_translation'),
                    "type" => "heading");

$options[] = array( "name" => __("Show Newsletter Signup on Homepage?", 'mt_soundstage_translation'),
                    "desc" => __("Do you want to show the \"Newsletter\" section on the homepage?", 'mt_soundstage_translation'),
                    "id" => "cap_show_newsletter",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array( "name" => __("Newsletter Instruction", 'mt_soundstage_translation'),
                    "desc" => __("Enter the instructions for signing up to the newsletter. eg \"Join Our Newsletter\".", 'mt_soundstage_translation'),
                    "id" => "cap_newsletter_title",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Newsletter URL", 'mt_soundstage_translation'),
                    "desc" => __("Enter the URL where people can join your newsletter. EG: http://mailchimp.com", 'mt_soundstage_translation'),
                    "id" => "cap_newsletter_url",
                    "std" => "",
                    "type" => "text");

//Newsletter
$options[] = array( "name" => __("Band Members", 'mt_soundstage_translation'),
                    "type" => "heading");

$options[] = array( "name" => __("Show Band Members on Homepage?", 'mt_soundstage_translation'),
                    "desc" => __("Do you want to show the \"Band Members\" section on the homepage?", 'mt_soundstage_translation'),
                    "id" => "cap_show_bandmembers",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array( "name" => __("Band Member's Title", 'mt_soundstage_translation'),
                    "desc" => __("Enter the title of the Band Members area on the homepage", 'mt_soundstage_translation'),
                    "id" => "cap_bandmembers_title",
                    "std" => "Band Members",
                    "type" => "text");

$options[] = array( "name" => __("---------------------------------------- Member 1's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 1", 'mt_soundstage_translation'),
                    "id" => "cap_member1_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 1's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 1. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member1_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 1's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 1.", 'mt_soundstage_translation'),
                    "id" => "cap_member1_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 1's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 1.", 'mt_soundstage_translation'),
                    "id" => "cap_member1_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 1's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 1.", 'mt_soundstage_translation'),
                    "id" => "cap_member1_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 1's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 1.", 'mt_soundstage_translation'),
                    "id" => "cap_member1_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 1's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 1. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member1_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");


$options[] = array( "name" => __("---------------------------------------- Member 2's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 2", 'mt_soundstage_translation'),
                    "id" => "cap_member2_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 2's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 2. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member2_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 2's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 2.", 'mt_soundstage_translation'),
                    "id" => "cap_member2_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 2's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 2.", 'mt_soundstage_translation'),
                    "id" => "cap_member2_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 2's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 2.", 'mt_soundstage_translation'),
                    "id" => "cap_member2_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 2's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 2.", 'mt_soundstage_translation'),
                    "id" => "cap_member2_youtube",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 2's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 2. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member2_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");


$options[] = array( "name" => __("---------------------------------------- Member 3's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 3", 'mt_soundstage_translation'),
                    "id" => "cap_member3_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 3's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 3. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member3_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 3's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 3.", 'mt_soundstage_translation'),
                    "id" => "cap_member3_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 3's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 3.", 'mt_soundstage_translation'),
                    "id" => "cap_member3_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 3's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 3.", 'mt_soundstage_translation'),
                    "id" => "cap_member3_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 3's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 3.", 'mt_soundstage_translation'),
                    "id" => "cap_member3_youtube",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 3's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 3. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member3_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");


$options[] = array( "name" => __("---------------------------------------- Member 4's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 4", 'mt_soundstage_translation'),
                    "id" => "cap_member4_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 4's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 4. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member4_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 4's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 4.", 'mt_soundstage_translation'),
                    "id" => "cap_member4_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 4's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 4.", 'mt_soundstage_translation'),
                    "id" => "cap_member4_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 4's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 4.", 'mt_soundstage_translation'),
                    "id" => "cap_member4_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 4's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 4.", 'mt_soundstage_translation'),
                    "id" => "cap_member4_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 4's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 4. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member4_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");


$options[] = array( "name" => __("---------------------------------------- Member 5's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 5", 'mt_soundstage_translation'),
                    "id" => "cap_member5_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 5's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 5. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member5_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 5's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 5.", 'mt_soundstage_translation'),
                    "id" => "cap_member5_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 5's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 5.", 'mt_soundstage_translation'),
                    "id" => "cap_member5_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 5's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 5.", 'mt_soundstage_translation'),
                    "id" => "cap_member5_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 5's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 5.", 'mt_soundstage_translation'),
                    "id" => "cap_member5_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 5's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 5. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member5_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");


$options[] = array( "name" => __("---------------------------------------- Member 6's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 6", 'mt_soundstage_translation'),
                    "id" => "cap_member6_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 6's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 6. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member6_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 6's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 6.", 'mt_soundstage_translation'),
                    "id" => "cap_member6_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 6's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 6.", 'mt_soundstage_translation'),
                    "id" => "cap_member6_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 6's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 6.", 'mt_soundstage_translation'),
                    "id" => "cap_member6_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 6's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 6.", 'mt_soundstage_translation'),
                    "id" => "cap_member6_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 6's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 6. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member6_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");
					
$options[] = array( "name" => __("---------------------------------------- Member 7's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 7", 'mt_soundstage_translation'),
                    "id" => "cap_member7_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 7's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 7. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member7_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 7's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 7.", 'mt_soundstage_translation'),
                    "id" => "cap_member7_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 7's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 7.", 'mt_soundstage_translation'),
                    "id" => "cap_member7_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 7's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 7.", 'mt_soundstage_translation'),
                    "id" => "cap_member7_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 7's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 7.", 'mt_soundstage_translation'),
                    "id" => "cap_member7_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 7's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 7. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member7_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");

$options[] = array( "name" => __("---------------------------------------- Member 8's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 8", 'mt_soundstage_translation'),
                    "id" => "cap_member8_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 8's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 8. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member8_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 8's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 8.", 'mt_soundstage_translation'),
                    "id" => "cap_member8_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 8's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 8.", 'mt_soundstage_translation'),
                    "id" => "cap_member8_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 8's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 8.", 'mt_soundstage_translation'),
                    "id" => "cap_member8_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 8's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 8.", 'mt_soundstage_translation'),
                    "id" => "cap_member8_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 8's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 8. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member8_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");

$options[] = array( "name" => __("---------------------------------------- Member 9's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 9", 'mt_soundstage_translation'),
                    "id" => "cap_member9_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 9's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 9. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member9_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 9's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 9.", 'mt_soundstage_translation'),
                    "id" => "cap_member9_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 9's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 9.", 'mt_soundstage_translation'),
                    "id" => "cap_member9_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 9's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 9.", 'mt_soundstage_translation'),
                    "id" => "cap_member9_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 9's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 9.", 'mt_soundstage_translation'),
                    "id" => "cap_member9_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 9's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 9. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member9_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");

$options[] = array( "name" => __("---------------------------------------- Member 10's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 10", 'mt_soundstage_translation'),
                    "id" => "cap_member10_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 10's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 10. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member10_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 10's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 10.", 'mt_soundstage_translation'),
                    "id" => "cap_member10_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 10's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 10.", 'mt_soundstage_translation'),
                    "id" => "cap_member10_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 10's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 10.", 'mt_soundstage_translation'),
                    "id" => "cap_member10_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 10's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 10.", 'mt_soundstage_translation'),
                    "id" => "cap_member10_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 10's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 10. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member10_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");

$options[] = array( "name" => __("---------------------------------------- Member 11's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 11", 'mt_soundstage_translation'),
                    "id" => "cap_member11_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 11's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 11. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member11_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 11's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 11.", 'mt_soundstage_translation'),
                    "id" => "cap_member11_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 11's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 11.", 'mt_soundstage_translation'),
                    "id" => "cap_member11_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 11's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 11.", 'mt_soundstage_translation'),
                    "id" => "cap_member11_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 11's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 11.", 'mt_soundstage_translation'),
                    "id" => "cap_member11_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 11's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 11. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member11_custom",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");
					
$options[] = array( "name" => __("---------------------------------------- Member 12's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 12", 'mt_soundstage_translation'),
                    "id" => "cap_member12_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 12's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 12. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member12_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 12's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 12.", 'mt_soundstage_translation'),
                    "id" => "cap_member12_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 12's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 12.", 'mt_soundstage_translation'),
                    "id" => "cap_member12_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 12's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 12.", 'mt_soundstage_translation'),
                    "id" => "cap_member12_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 12's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 12.", 'mt_soundstage_translation'),
                    "id" => "cap_member12_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 12's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 12. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member12_custom",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("---------------------------------------- Member 13's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 13", 'mt_soundstage_translation'),
                    "id" => "cap_member13_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 13's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 13. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member13_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 13's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 13.", 'mt_soundstage_translation'),
                    "id" => "cap_member13_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 13's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 13.", 'mt_soundstage_translation'),
                    "id" => "cap_member13_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 13's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 13.", 'mt_soundstage_translation'),
                    "id" => "cap_member13_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 13's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 13.", 'mt_soundstage_translation'),
                    "id" => "cap_member13_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 13's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 13. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member13_custom",
                    "std" => "",
                    "type" => "text");
$options[] = array( "name" => __("---------------------------------------- Member 14's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 14", 'mt_soundstage_translation'),
                    "id" => "cap_member14_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 14's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 14. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member14_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 14's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 14.", 'mt_soundstage_translation'),
                    "id" => "cap_member14_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 14's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 14.", 'mt_soundstage_translation'),
                    "id" => "cap_member14_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 14's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 14.", 'mt_soundstage_translation'),
                    "id" => "cap_member14_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 14's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 14.", 'mt_soundstage_translation'),
                    "id" => "cap_member14_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 14's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 14. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member14_custom",
                    "std" => "",
                    "type" => "text");
$options[] = array( "name" => __("---------------------------------------- Member 15's Name ----------------------------------------", 'mt_soundstage_translation'),
                    "desc" => __("Enter the name of Member 15", 'mt_soundstage_translation'),
                    "id" => "cap_member15_name",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 15's Picture", 'mt_soundstage_translation'),
                    "desc" => __("Upload the picture of Member 15. Recommended size: 118px X 113px", 'mt_soundstage_translation'),
                    "id" => "cap_member15_picture",
                    "std" => "",
                    "type" => "upload");

$options[] = array( "name" => __("Member 15's Role (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Describe the role in the band of Member 15.", 'mt_soundstage_translation'),
                    "id" => "cap_member15_role",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 15's Twitter (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Twitter URL of Member 15.", 'mt_soundstage_translation'),
                    "id" => "cap_member15_twitter",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 15's Facebook (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the Facebook URL of Member 15.", 'mt_soundstage_translation'),
                    "id" => "cap_member15_facebook",
                    "std" => "",
                    "type" => "text");

$options[] = array( "name" => __("Member 15's YouTube (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter the YouTube URL of Member 15.", 'mt_soundstage_translation'),
                    "id" => "cap_member15_youtube",
                    "std" => "",
                    "type" => "text");
					
$options[] = array( "name" => __("Member 15's Custom URL (optional)", 'mt_soundstage_translation'),
                    "desc" => __("Enter a custom URL of Member 15. This is used when a user clicks on the band member's image.", 'mt_soundstage_translation'),
                    "id" => "cap_member15_custom",
                    "std" => "",
                    "type" => "text");


$options[] = array( "name" => __("", 'mt_soundstage_translation'),
                    "desc" => __("", 'mt_soundstage_translation'), 
                    "id" => "",
                    "std" => "",
                    "type" => "none");









	return $options;
}



/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}