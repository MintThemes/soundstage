<?php 
//---------
//----------------------------Discography Settings
//---------
$mt_soundstage_discography_super_box_settings = array(
    'id' => 'discography-meta-box',
    'title' => 'Discography Settings:',
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high'
);

add_action('admin_menu', 'mt_soundstage_discography_add_super_box');

// Add meta box
function mt_soundstage_discography_add_super_box() {
    global $mt_soundstage_discography_super_box_settings;

    add_meta_box($mt_soundstage_discography_super_box_settings['id'], $mt_soundstage_discography_super_box_settings['title'], 'mt_soundstage_discography_meta_super_options', $mt_soundstage_discography_super_box_settings['page'], $mt_soundstage_discography_super_box_settings['context'], $mt_soundstage_discography_super_box_settings['priority']);
}


function mt_soundstage_discography_meta_super_options() {
	
	global $mt_soundstage_discography_meta_box, $post, $wpdb, $table_prefix;
	$custom = get_post_custom($post->ID);
	if (isset($custom["soundstage_buy_disc"][0])){
		$soundstage_buy_disc = $custom["soundstage_buy_disc"][0];
	}
	
    echo '<label for="soundstage_buy_disc">Buy Link (eg: iTunes):</label>';
    echo ' <input type="text" name="soundstage_buy_disc" value="' . $soundstage_buy_disc  . '" />';
	
}

//
function mt_soundstage_discography_save_item_number(){  
	global $post;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post->ID;
	} 
	if (isset($_POST["soundstage_buy_disc"])){
	update_post_meta($post->ID, "soundstage_buy_disc", $_POST["soundstage_buy_disc"]);
	}
	
}




//Save the custom Discographys//--------------------------
add_action('save_post', 'mt_soundstage_discography_save_item_number');

