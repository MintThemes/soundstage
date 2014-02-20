<?php
/**
 * The template for displaying Category Results pages.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

if ($cat == of_get_option('cap_disc_cat')){
	//load the discography page
	include 'category-discography.php';
}elseif ($cat == of_get_option('cap_events_cat')){
	//load the discography page
	include 'category-tour.php';
}else{
	//load the normal single page
	include 'category-normal.php';
}

