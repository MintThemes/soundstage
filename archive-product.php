<?php
/**
 * The template for displaying Archives Results pages.
 *
 * @package WordPress
 * @subpackage Soundstage
 * @since Soundstage 3.0
 */
 
 get_header(); ?>

<div class="title-block">
	<h1><?php if ( is_search() ) : ?>
		<?php
			printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
			if ( get_query_var( 'paged' ) )
				printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
		?>
	<?php elseif ( is_tax() ) : ?>
		<?php echo single_term_title( "", false ); ?>
	<?php else : ?>
		<?php
			$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

			echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
		?>
	<?php endif; ?></h1>
</div>

<div id="main"><!-- main -->

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
    
    <?php do_action('woocommerce_before_shop_loop'); ?>
	<ul class="catalog product">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

		<?php endwhile; ?>
	</ul>
	<?php do_action('woocommerce_after_shop_loop'); ?>

	<?php
		/**
		 * woocommerce_pagination hook
		 *
		 * @hooked woocommerce_pagination - 10
		 * @hooked woocommerce_catalog_ordering - 20
		 */
		do_action( 'woocommerce_pagination' );
	?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
	
</div><!-- end main -->
       
<?php get_footer(); ?>