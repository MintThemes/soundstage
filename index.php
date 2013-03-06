<?php
/**
 * The home page template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

get_header(); ?>

<?php
// array of 6 images for the homepage
$faderimages = array();
for ( $i = 1; $i <= 6; $i++ ) {
	$faderimages[] = array(
		'title'    => of_get_option( sprintf( 'cap_slider_title%d', $i ) ),
		'subtitle' => of_get_option( sprintf( 'cap_slider_subtitle%d', $i ) ),
		'image'    => of_get_option( sprintf( 'cap_slider_image%d', $i ) ),
		'url'      => of_get_option( sprintf( 'cap_slider_link%d', $i ) ),
	);
}
?>
<div class="flex-nav-container"><!-- flexslider -->
	<div class="flex-nav-container-inner">
		<div class="flexslider">
			<ul class="slides">
			<?php 
	        // loop through all the images, only rendering if there's an image
	        foreach($faderimages as $num => $fader) {
				if($fader['image'] != "") {
				?> 
					<li>
						<?php if ($fader['url'] != "Link"){?><a href="<?php echo $fader['url']; ?>"><img src="<?php echo $fader['image']; ?>" alt="<?php echo $fader['title']; ?>" /></a><?php }else{?><img src="<?php echo $fader['image']; ?>" alt="<?php echo $fader['title']; ?>" /><?php } ?>
						<a href="<?php echo $fader['url']; ?>">
						<span class="text"><?php if ($fader['title'] != "Image Title"){?><?php if ($fader['title'] != ""){?><?php echo $fader['title']; ?><?php } } ?><strong> <?php if ($fader['subtitle'] != "Image Subtitle"){?><?php if ($fader['subtitle'] != ""){?><?php echo $fader['subtitle']; ?><?php }} ?></strong></span>
						</a>
					</li>
				<?php
				}// end image check for faders
			}// end loop through faders ?>		
			</ul>
		</div><!-- end flexslider -->
	</div>
</div><!-- end flex-nav-container -->

<div class="items-holder"><!-- items-holder -->
	<?php 
    if ( ! dynamic_sidebar( 'home-widget-area' ) ) : 
        get_search_form(); ?>
    <?php endif; // end home widget area ?>
</div><!-- end items-holder -->

<?php if (of_get_option("cap_recent_posts") == true){ ?>
    <div class="news-holder"><!-- news-holder -->
        <span class="decor-top">&nbsp;</span>
        <div class="holder">
            <h2><?php echo of_get_option("cap_home_recent_posts_title"); ?></h2>
            <div class="news">
                <ul>
                <?php
                //this loop is modified to use the "recent posts" category on line 754 of functions.php
                if ( have_posts() ) {
                    while ( have_posts() ) : the_post(); 
                    ?>
                        <li>
                            <div class="visual">
                                <?php
                                $thumb = get_post_thumbnail_id();
                                $img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
                                ?>
                                <?php if ($img_url != ""){?><img src="<?php echo aq_resize( $img_url, 140, 140, true );  ?>" width="140" height="140" alt="<?php the_title(); ?>" /><?php } ?>
                                <a href="<?php the_permalink(); ?>">&nbsp;</a>
                            </div>
                            <div class="text">
                                <span class="date">posted: <?php the_time("M j, Y") ?></span>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <a href="<?php the_permalink(); ?>" class="btn-more"><span>Read</span></a>
                            </div>
                        </li>
                    <?php endwhile; }?>
                </ul>
            </div><!--news-->
        </div><!--holder-->
        <span class="decor-bottom">&nbsp;</span>
    </div><!-- end news-holder -->
<?php } ?>

<div id="main"><!-- main -->
	<?php if (of_get_option("cap_show_merch") == true){?>
		<?php //woocommerce check ?>
		<?php if (  in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
			<h2><?php echo of_get_option("cap_merch_title"); ?></h2>
			<div class="preview-block">
				<?php
                global $product;
                $num = 0;
                $merch = new WP_Query( array( 
                'posts_per_page' => 5,
                'post_type'      => array( 'product' )
                ) );
    
                if( $merch->have_posts() ) : while( $merch->have_posts() ) : $merch->the_post();
                    $product = new WC_Product( $post->ID ); 
    
                    if ( $num == 0 ) : ?>             
                        <div class="preview">
                            <div class="visual">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 473, 453, true );  ?>" width="473" height="453" alt="<?php the_title(); ?>" />
                                <?php else : ?>
                                    <img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="mask"></a>
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="caption"><?php the_title(); ?></a>
                        </div>
                    <?php else : ?>
                        <?php if ( $num == 1 ) : ?>
                            <ul class="catalog">
                        <?php endif; ?>
                        <li>
                            <div class="visual">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ), 222, 193, true );  ?>" width="222" height="193" alt="<?php the_title(); ?>" />
                                <?php else : ?>
                                    <img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="mask"></a>
                                <?php woocommerce_template_loop_price(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </li>
                        <?php 
                    endif;
                    $num++;
                endwhile;
                ?>
                </ul>
                <?php endif; wp_reset_postdata(); ?>
			</div><!--preview-block-->
		<?php } //woocommerce check?>
	<?php } ?>
    <?php if (of_get_option("cap_show_social") == true || of_get_option("cap_show_newsletter") == true){ ?>
	<div class="social-block">
		<?php if (of_get_option("cap_show_social") == true && of_get_option("cap_show_newsletter") == true){
		//show both links and newsletter using "social-container" class?>
		<div class="social-container">
			<ul class="soc">
				<li> <span class="caption"><?php echo of_get_option("cap_social_title"); ?></span> </li>
				<?php if (of_get_option ("cap_twitter_url") != ""){ ?><li><a href="<?php echo of_get_option ("cap_twitter_url"); ?>">&nbsp;</a></li><?php } ?>
				<?php if (of_get_option ("cap_flickr_url") != ""){ ?><li><a class="alt01" href="<?php echo of_get_option ("cap_flickr_url"); ?>">&nbsp;</a></li><?php } ?>
                <?php if (of_get_option ("cap_facebook_url") != ""){ ?><li><a class="alt02" href="<?php echo of_get_option ("cap_facebook_url"); ?>">&nbsp;</a></li><?php } ?>
                <?php if (of_get_option ("cap_youtube_url") != ""){ ?><li><a class="alt03" href="<?php echo of_get_option ("cap_youtube_url"); ?>">&nbsp;</a></li><?php } ?>
			</ul>
		</div>
		<?php //newsletter ?>
		<div class="social-container">
			<div class="email-signup">
				<span class="caption"><?php echo of_get_option("cap_newsletter_title"); ?></span>
				<a href="<?php echo of_get_option("cap_newsletter_url"); ?>" class="buttoncustom">Sign Up</a>
			</div>
		</div>
		<?php } elseif (of_get_option("cap_show_social") == true && of_get_option("cap_show_newsletter") != true){    
		//show only links and NOT newsletter using "social-container-full" class?> 
		<div class="social-container-full">
			<ul class="soc">
				<li> <span class="caption"><?php echo of_get_option("cap_social_title"); ?></span> </li>
				<?php if (of_get_option ("cap_twitter_url") != ""){ ?><li><a href="<?php echo of_get_option ("cap_twitter_url"); ?>">&nbsp;</a></li><?php } ?>
                <?php if (of_get_option ("cap_flickr_url") != ""){ ?><li><a class="alt01" href="<?php echo of_get_option ("cap_flickr_url"); ?>">&nbsp;</a></li><?php } ?>
                <?php if (of_get_option ("cap_facebook_url") != ""){ ?><li><a class="alt02" href="<?php echo of_get_option ("cap_facebook_url"); ?>">&nbsp;</a></li><?php } ?>
                <?php if (of_get_option ("cap_youtube_url") != ""){ ?><li><a class="alt03" href="<?php echo of_get_option ("cap_youtube_url"); ?>">&nbsp;</a></li><?php } ?>
			</ul>
		</div>
		<?php } elseif (of_get_option("cap_show_social") != true && of_get_option("cap_show_newsletter") == true){   
		//show only newsletter and NOT social links using "social-container-full" class?> 
		<div class="social-container-full">
			<div class="email-signup-full">
                <span class="caption"><?php echo of_get_option("cap_newsletter_title"); ?></span>
                <a href="<?php echo of_get_option("cap_newsletter_url"); ?>" class="buttoncustom">Sign Up</a>
			</div>
		</div>
		<?php } ?>
	</div><!--social-block-->
    <?php } ?>
	<?php if (of_get_option("cap_show_bandmembers") == true){ ?>
		<h2><?php echo of_get_option("cap_bandmembers_title"); ?></h2>
		<?php 
		//array of band members
		$bandmembers = array();
		for ( $i = 1; $i <= 12; $i++ ) {
			$bandmembers[] = array(
				'title'    => of_get_option( sprintf( 'cap_slider_title%d', $i ) ),
				'name' => of_get_option( sprintf('cap_member%d_name', $i ) ),
				'role' => of_get_option( sprintf('cap_member%d_role', $i ) ),
				'picture' => of_get_option( sprintf('cap_member%d_picture', $i ) ),
				'twitter' => of_get_option( sprintf('cap_member%d_twitter', $i ) ),
				'facebook' => of_get_option( sprintf('cap_member%d_facebook', $i ) ),
				'youtube' => of_get_option( sprintf('cap_member%d_youtube', $i ) ),
				'custom_url' => of_get_option( sprintf('cap_member%d_custom', $i ) ),
			);
		}
		?>
		<ul class="team-list">
			<?php
            // loop through all the links, only rendering if there's a link entered
            foreach($bandmembers as $num => $member) {
                if($member['name'] != "") { ?>
                    <li>
                        <div class="visual">
                            <img src="<?php echo aq_resize( $member['picture'], 140, 140, true );  ?>" width="118" height="113" alt=""/>
                            <?php if ($member['custom_url'] != ""){?><a href="<?php echo $member['custom_url']; ?>">&nbsp;</a><?php } ?>
                        </div>
                        <div class="text">
                            <span class="name"><?php echo $member['name']; ?></span>
                            <p><?php echo $member['role']; ?></p>
                            <ul>
                                <?php if ($member['facebook'] != ""){?><li><a href="<?php echo $member['facebook']; ?>">&nbsp;</a></li><?php } ?>
                                <?php if ($member['twitter'] != ""){?><li><a class="alt01" href="<?php echo $member['twitter']; ?>">&nbsp;</a></li><?php } ?>
                                <?php if ($member['youtube'] != ""){?><li><a class="alt02" href="<?php echo $member['youtube']; ?>">&nbsp;</a></li><?php } ?>
                            </ul>
                        </div>
                    </li>
                <?php
                } // end image check for members
            }// end loop through members ?> 
		</ul>
		<?php } ?>
</div><!-- end main -->
<?php get_footer(); ?>