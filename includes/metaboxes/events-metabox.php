<?php /**
 * Adds event post metaboxes for start time and end time
 * http://codex.wordpress.org/Function_Reference/add_meta_box
 *
 * We want two time event metaboxes, one for the start time and one for the end time.
 * Two avoid repeating code, we'll just pass the $identifier in a callback.
 * If you wanted to add this to regular posts instead, just swap 'event' for 'post' in add_meta_box.
 */
function mt_soundstage_ep_eventposts_metaboxes() {
    add_meta_box( 'mt_soundstage_ept_event_date_start', 'Tour Date Info (Leave blank if this post is not a tour date)', 'mt_soundstage_ept_event_date', 'post', 'normal', 'high', array( 'id' => '_start') );
    //add_meta_box( 'mt_soundstage_ept_event_date_end', 'End Date and Time - (Leave blank unless this is a tour date)', 'mt_soundstage_ept_event_date', 'post', 'normal', 'high', array('id'=>'_end') );
   // add_meta_box( 'mt_soundstage_ept_event_venue', 'Event Location', 'mt_soundstage_ept_event_venue', 'post', 'normal', 'default', array('id'=>'_end') );
}
add_action( 'admin_init', 'mt_soundstage_ep_eventposts_metaboxes' );
// Metabox HTML
function mt_soundstage_ept_event_date($post, $args) {
    $metabox_id = $args['args']['id'];
    global $post, $wp_locale;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'ep_eventposts_nonce' );
    $time_adj = current_time( 'timestamp' );
    $month = get_post_meta( $post->ID, $metabox_id . '_month', true );
    if ( empty( $month ) ) {
        $month = gmdate( 'm', $time_adj );
    }
    $day = get_post_meta( $post->ID, $metabox_id . '_day', true );
    if ( empty( $day ) ) {
        $day = gmdate( 'd', $time_adj );
    }
    $year = get_post_meta( $post->ID, $metabox_id . '_year', true );
    if ( empty( $year ) ) {
        $year = gmdate( 'Y', $time_adj );
    }
    $hour = get_post_meta($post->ID, $metabox_id . '_hour', true);
    if ( empty($hour) ) {
        $hour = gmdate( 'H', $time_adj );
    }
    $min = get_post_meta($post->ID, $metabox_id . '_minute', true);
    if ( empty($min) ) {
        $min = '00';
    }
    $month_s = '<select name="' . $metabox_id . '_month">';
    for ( $i = 1; $i < 13; $i = $i +1 ) {
        $month_s .= "\t\t\t" . '<option value="' . zeroise( $i, 2 ) . '"';
        if ( $i == $month )
            $month_s .= ' selected="selected"';
        $month_s .= '>' . $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) ) . "</option>\n";
    }
    $month_s .= '</select>';
	if (!isset($_POST["event_venue"])){
		$event_venue = get_post_meta($post->ID, "event_venue", true);
	}
	if (!isset($_POST["event_city"])){
		$event_city = get_post_meta($post->ID, "event_city", true);
	}
	if (!isset($_POST["button_text"])){
		$button_text = get_post_meta($post->ID, "button_text", true);
	}
	if (!isset($_POST["button_link"])){
		$button_link = get_post_meta($post->ID, "button_link", true);
	}
    echo $month_s;
    echo '<input type="text" name="' . $metabox_id . '_day" value="' . $day  . '" size="2" maxlength="2" />';
    echo '<input type="text" name="' . $metabox_id . '_year" value="' . $year . '" size="4" maxlength="4" /> @ ';
    echo '<input type="text" name="' . $metabox_id . '_hour" value="' . $hour . '" size="2" maxlength="2"/>:';
    echo '<input type="text" name="' . $metabox_id . '_minute" value="' . $min . '" size="2" maxlength="2" />';
	echo '<br><br><label for="event_venue">Venue:</label>';
    echo ' <input type="text" name="event_venue" value="' . $event_venue  . '" />';
	echo '<br><br><label for="event_city">City:</label>';
    echo ' <input type="text" name="event_city" value="' . $event_city  . '" />';
	echo '<br><br><label for="button_text">Button Text:</label>';
    echo ' <input type="text" name="button_text" value="' . $button_text  . '" />';
	echo '<br><br><label for="button_text">Button Link:</label>';
    echo ' <input type="text" name="button_link" value="' . $button_link  . '" />';
}
// Save the Metabox Data
function mt_soundstage_ep_eventposts_save_meta( $post_id, $post ) {
	//save the location
	if (isset($_POST["event_venue"])){
	update_post_meta($post->ID, "event_venue", $_POST["event_venue"]);
	}
	//save the city
	if (isset($_POST["event_city"])){
	update_post_meta($post->ID, "event_city", $_POST["event_city"]);
	}
	//save the button text
	if (isset($_POST["button_text"])){
	update_post_meta($post->ID, "button_text", $_POST["button_text"]);
	}
	//save the button link
	if (isset($_POST["button_link"])){
	update_post_meta($post->ID, "button_link", $_POST["button_link"]);
	}
	//save the time
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['ep_eventposts_nonce'] ) )
        return;
    if ( !wp_verify_nonce( $_POST['ep_eventposts_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ) )
        return;
    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though
    $metabox_ids = array( '_start', '_end' );
    foreach ($metabox_ids as $key ) {
        $aa = $_POST[$key . '_year'];
        $mm = $_POST[$key . '_month'];
        $jj = $_POST[$key . '_day'];
        $hh = $_POST[$key . '_hour'];
        $mn = $_POST[$key . '_minute'];
        $aa = ($aa <= 0 ) ? date('Y') : $aa;
        $mm = ($mm <= 0 ) ? date('n') : $mm;
        $jj = sprintf('%02d',$jj);
        $jj = ($jj > 31 ) ? 31 : $jj;
        $jj = ($jj <= 0 ) ? date('j') : $jj;
        $hh = sprintf('%02d',$hh);
        $hh = ($hh > 23 ) ? 23 : $hh;
        $mn = sprintf('%02d',$mn);
        $mn = ($mn > 59 ) ? 59 : $mn;
        $events_meta[$key . '_year'] = $aa;
        $events_meta[$key . '_month'] = $mm;
        $events_meta[$key . '_day'] = $jj;
        $events_meta[$key . '_hour'] = $hh;
        $events_meta[$key . '_minute'] = $mn;
        $events_meta[$key . '_eventtimestamp'] = $aa . $mm . $jj . $hh . $mn;
        }
    // Add values of $events_meta as custom fields
    foreach ( $events_meta as $key => $value ) { // Cycle through the $events_meta array!
        if ( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode( ',', (array)$value ); // If $value is an array, make it a CSV (unlikely)
        if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
            update_post_meta( $post->ID, $key, $value );
        } else { // If the custom field doesn't have a value
            add_post_meta( $post->ID, $key, $value );
        }
        if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
    }
}
add_action( 'save_post', 'mt_soundstage_ep_eventposts_save_meta', 1, 2 );
/**
 * Helpers to display the date on the front end
 */
// Get the Month Abbreviation
function mt_soundstage_eventposttype_get_the_month_abbr($month) {
    global $wp_locale;
    for ( $i = 1; $i < 13; $i = $i +1 ) {
                if ( $i == $month )
                    $monthabbr = $wp_locale->get_month_abbrev( $wp_locale->get_month( $i ) );
                }
    return $monthabbr;
}
// Display the date
function mt_soundstage_eventposttype_get_the_event_date() {
    global $post;
    $eventdate = '';
	$date =  get_post_meta($post->ID, '_start_eventtimestamp', true);
	//month
    $month = str_split($date, 4);
	$month = str_split($month[1], 2);
	$month = $month[0];
	//year
	$year = str_split($date, 4);
	$year = $year[0];
	//day
	$day = str_split($date, 6);
	$day = str_split($day[1], 2);
	$day = $day[0];
	//hour
	$hour = str_split($date, 8);
	$hour = str_split($hour[1], 2);
	$hour = $hour[0];
	//minute
	$minute = str_split($date, 10);
	$minute = str_split($minute[1], 2);
	$minute = $minute[0];
	
    $eventdate = mt_soundstage_eventposttype_get_the_month_abbr($month);
    $eventdate .= ' ' . $day . ',';
    $eventdate .= ' ' . $year;
    $eventdate .= __(' at ', 'mt_soundstage_translation') . $hour;
    $eventdate .= ':' . $minute;
    echo $eventdate;
}

// Display the date without hour
function mt_soundstage_eventposttype_get_the_event_date_without_hour() {
    global $post;
    $eventdate = '';
	$date =  get_post_meta($post->ID, '_start_eventtimestamp', true);
	//month
    $month = str_split($date, 4);
	$month = str_split($month[1], 2);
	$month = $month[0];
	//year
	$year = str_split($date, 4);
	$year = $year[0];
	//day
	$day = str_split($date, 6);
	$day = str_split($day[1], 2);
	$day = $day[0];
	//hour
	$hour = str_split($date, 8);
	$hour = str_split($hour[1], 2);
	$hour = $hour[0];
	//minute
	$minute = str_split($date, 10);
	$minute = str_split($minute[1], 2);
	$minute = $minute[0];
	
    $eventdate = mt_soundstage_eventposttype_get_the_month_abbr($month);
    $eventdate .= ' ' . $day . ',';
    $eventdate .= ' ' . $year;
    echo $eventdate;
}

// Display the date without year
function mt_soundstage_eventposttype_get_the_event_date_without_year() {
    global $post;
    $eventdate = '';
	$date =  get_post_meta($post->ID, '_start_eventtimestamp', true);
	//month
    $month = str_split($date, 4);
	$month = str_split($month[1], 2);
	$month = $month[0];
	//year
	$year = str_split($date, 4);
	$year = $year[0];
	//day
	$day = str_split($date, 6);
	$day = str_split($day[1], 2);
	$day = $day[0];
	//hour
	$hour = str_split($date, 8);
	$hour = str_split($hour[1], 2);
	$hour = $hour[0];
	//minute
	$minute = str_split($date, 10);
	$minute = str_split($minute[1], 2);
	$minute = $minute[0];
	
    $eventdate = mt_soundstage_eventposttype_get_the_month_abbr($month);
    $eventdate .= ' ' . $day;
    echo $eventdate;
}

// Display the time only
function mt_soundstage_eventposttype_get_the_event_time_only() {
    global $post;
    $eventdate = '';
	$date =  get_post_meta($post->ID, '_start_eventtimestamp', true);
	//hour
	$hour = str_split($date, 8);
	$hour = str_split($hour[1], 2);
	$hour = $hour[0];
	//minute
	$minute = str_split($date, 10);
	$minute = str_split($minute[1], 2);
	$minute = $minute[0];
	
    $eventdate = mt_soundstage_eventposttype_get_the_month_abbr($month);
   
    $eventdate .= $hour;
    $eventdate .= ':' . $minute;
    echo $eventdate;
}