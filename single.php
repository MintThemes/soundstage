<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Photostore
 * @since Photostore 3.0
 */

if (get_post_meta($post->ID, 'soundstage_post_type', true) == "video"){
	//load the collection page because this is a collection
	include 'single-video.php';
}elseif (get_post_meta($post->ID, 'soundstage_post_type', true) == "photo"){
	//load the video page because this is a video
	include 'single-photos.php';
}elseif (get_post_meta($post->ID, 'soundstage_post_type', true) == "merch"){
	//load the video page because this is a video
	include 'single-merch.php';
}elseif (get_post_meta($post->ID, 'soundstage_post_type', true) == "event"){
	//load the video page because this is a video
	include 'single-tourdate.php';
}else{
	//load the normal single page
	include 'single-standard.php';
}

