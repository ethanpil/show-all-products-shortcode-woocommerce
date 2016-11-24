<?php
/*
   Plugin Name: Show All Products Shortcode for WooCommerce
   Plugin URI: http://wordpress.org/extend/plugins/show-all-products-shortcode-woocommerce/
   Version: 1.0
   Author: Ethan Piliavin
   Description: An easy [all_products] shortcode to list all woocommerce products on one page.
   Text Domain: woocommerce-show-all-products-shortcode
   License: GPLv3
*/
/*
 * Usage : [all_products] to display all products.
 */
 
add_shortcode('all_products', 'wc_show_all_products');

if ( ! function_exists( 'wc_show_all_products' ) ) :

  function wc_show_all_products($atts){
   
   
        $args = array(
			'post_type' => 'product',
			'posts_per_page' => -1
			);
		$products = new WP_Query( $args );
		
        ob_start();
		if ( $products->have_posts() ) {
			?>


			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>


			<?php
		} else {
			echo __( 'No products found' );
		}
        
		woocommerce_reset_loop();
		wp_reset_postdata();
		return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';
   
  }
  
endif;
