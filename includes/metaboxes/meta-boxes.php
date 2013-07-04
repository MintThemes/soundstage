<?php 
function mt_soundstage_posttype_add_super_box() {
	add_meta_box(
		'posttype-meta-box', 
		__( 'Post Type', 'mt_soundstage_translation' ),
		'mt_soundstage_posttype_meta_super_options', 
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'mt_soundstage_posttype_add_super_box' );

function mt_soundstage_get_post_types() {
	$types = array(
		'standard' => __( 'Standard', 'mt_soundstage_translation' ),
		'video' => __( 'Video', 'mt_soundstage_translation' ),
		'photo' => __( 'Photo Album', 'mt_soundstage_translation' ),
		'discography' => __( 'Disc (Discography)', 'mt_soundstage_translation' ),
		'event' => __( 'Tour Date', 'mt_soundstage_translation' )
	);

	return apply_filters( 'mt_soundstage_get_post_types', $types );
}

function mt_soundstage_posttype_meta_super_options() {
	global $post;
	
	$current = get_post_meta( $post->ID, 'soundstage_post_type', true );
	$types   = mt_soundstage_get_post_types();
?>
	<div id="post-formats-select">
		<?php foreach ( $types as $type_slug => $type ) : ?>
		<input type="radio" id="<?php echo $type_slug; ?>" name="soundstage_post_type" value="<?php echo $type_slug; ?>" <?php checked( $type_slug, $current ); ?>> <label for="<?php echo $type_slug; ?>"><?php echo esc_attr( $type ); ?></label> <br />
		<?php endforeach; ?>
	</div>
<?php
}

function mt_soundstage_posttype_save_item_number(){  
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post->ID;
	
	if ( ! isset( $_POST[ "soundstage_post_type" ] ) )
		return $post->ID;

	$type  = esc_attr( $_POST["soundstage_post_type"] );
	$types = mt_soundstage_get_post_types();

	if ( ! array_key_exists( $type, $types ) )
		return $post->ID;

	update_post_meta( $post->ID, 'soundstage_post_type', $type );
}
add_action( 'save_post', 'mt_soundstage_posttype_save_item_number' );