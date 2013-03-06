<?php
/**
 * The template for displaying attachments.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */


get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="title-block">
	<h1><a href="<?php echo get_permalink($post->post_parent); ?>"><?php echo get_the_title( $post->post_parent ); ?></a> > <?php the_title(); ?></h1>
</div>
<div id="main"><!-- main -->
	<div class="flex-nav-container">
		<div class="photoholder">
			<ul class="slides">
                <li>
                    <?php 
					if ( wp_attachment_is_image() ) { ?>
						<?php //this attachment is not an image 
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID ){break;}
						}
						$k++;
						// If there is more than 1 image attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] )) {
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							}else{
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
							}	
						} else {
							// or, if there's only 1 image attachment, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
						?>
                        <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                            $attachment_size = apply_filters( 'Soundstage_attachment_size', 976 );
                            echo wp_get_attachment_image( $post->ID, array( $attachment_size, 976 ) ); // filterable image width with, essentially, no limit for image height.
                        ?></a>                       
					<?php } else { ?>
                    	<?php //this attachment is not an image ?>
                    	<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
                    <?php }; ?>
                    <?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
                    <?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'Soundstage' ), 'after' => '' ) ); ?>
                </li>
			</ul>    
		</div><!--"photoholder"-->
	</div><!--"flex-nav-container"-->
    <div class="text-holder">
        <?php the_content(); ?>
    </div>
    <?php comments_template( '', true ); ?>	
</div><!-- end main -->
<?php endwhile; ?> 
<?php get_footer(); ?>