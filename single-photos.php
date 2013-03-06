<?php
/**
 * The Template for displaying all single photo albums.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="title-block">
			<h1><?php the_title(); ?></h1>
		</div>
		<div id="main"><!-- main -->
			<ul class="catalog product">
				 <?php
					$args = array(
						'post_type' => 'attachment',
						'numberposts' => -1,
						'post_status' => null,
						'post_parent' => $post->ID
						); 
					$attachments = get_posts($args);
					$currentAttachmentNum = 0;
					//
					if ($attachments) {
						$currentAttachmentNum = 0;
						foreach ($attachments as $attachment1) {?>
                        <li>             
                            <div class="visual">
                                <img src="<?php echo aq_resize( $attachment1->guid, 306, 305, true );  ?>" width="306" height="305" alt="<?php the_title(); ?>"/>
                                <a class="mask" href="<?php echo home_url(); echo ("/?attachment_id=" . $attachment1->ID); ?>">&nbsp;</a>
                            </div>
                            <a href="<?php echo home_url(); echo ("/?attachment_id=" . $attachment1->ID); ?>"><?php echo $attachment1->post_title; ?></a>
                        </li>
                     <?php } }?>
			</ul>
		</div><!-- end main -->
        
        <?php endwhile; // end of the loop. ?>
    
        
<?php get_footer(); ?>   
      