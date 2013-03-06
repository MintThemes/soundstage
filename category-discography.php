<?php
/**
 * The template for displaying Category Results pages.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
get_header(); ?>

<div class="title-block">
			<h1><?php echo single_cat_title( '', false );?></h1>
		</div>
		<div id="main"><!-- main -->
			<div class="items-holder">
				<?php if (have_posts()) : ?>
                <div class="mt_discography_masonry">
            	<?php while (have_posts()) : the_post(); ?>
			
                    <div id="post-<?php the_ID(); ?>" <?php post_class('item-block'); ?>>
                        <div class="block">
                            <div class="visualnojs">
                                <?php
                                $thumb = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
                                ?>
                                <?php if ($img_url != ""){?><img src="<?php echo aq_resize( $img_url, 306, 304, true );  ?>" width="306" height="304" alt="<?php the_title(); ?>" /><?php } ?>
                                <?php if (get_post_meta($post->ID, "soundstage_buy_disc", true) != ""){?>
                                    <span class="sticker"><a href="<?php echo get_post_meta($post->ID, "soundstage_buy_disc", true); ?>"><?php _e('buy', 'mt_soundstage_translation'); ?></a></span>
                                <?php } ?>
                            </div>
                            
                            <div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer"></div>
                            <div class="jp-audio">
                    
                                <div class="jp-type-playlist">
                                    
                                    <div id="jp_playlist_<?php the_ID(); ?>" class="jp-playlist">
                    
                                        <ul>
                                            <!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                            <li></li>
                                        </ul>
                                    </div>
                                <div id="jp_interface_<?php the_ID(); ?>" class="jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                            
                    
                                            
                                            <li><a href="#" class="jp-previous" tabindex="1">previous</a></li>
                                            <li><a href="#" class="jp-next" tabindex="1">next</a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="seekholder">
                                                <div class="jp-seek-bar-bg"></div>
                                                <div class="jp-seek-bar">
                                                
                                                    <div class="jp-play-bar"></div>
                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                        <div class="jp-current-time"> </div>
                                        <div class="slash">/</div>
                                        <div class="jp-duration"></div>
                                    </div>
                                </div>
                            </div>
                            <?php //end jplayer Code?>
                        </div>
                    </div>
                <?php endwhile; // end of the loop. ?>
                </div>
                <?php endif; ?>
				<?php get_template_part ('includes/pagination'); ?>
                
         
			</div>
		</div><!-- end main -->
     
<?php get_footer(); ?>

                
   