<?php
/**
 * Pagination
 */

global $wp_query;
?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>

<?php
	if ( get_query_var( 'paged' ) ) {
		$current_page = get_query_var( 'paged' );
	} else if ( get_query_var( 'page' ) ) {
		$current_page = get_query_var( 'page' );
	} else {
		$current_page = 1;
	}
	
	$permalink_structure = get_option('permalink_structure');
	$format = empty( $permalink_structure ) ? '?page=%#%' : 'page/%#%/';
	
	$defaults = array(
		'total'     => $wp_query->max_num_pages,
		'base'      => get_pagenum_link(1) . '%_%',
		'format'    => $format,
		'current'   => $current_page,
		'prev_next' => false,
		'type'      => 'list',
		'show_all'  => true
	);

	echo paginate_links( $defaults );
?>

<?php endif; ?>