<?php 
/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
  add_theme_support( 'woocommerce' );
}
/*-----------------------------------------------------------------------------------*/
/* WooCommerce Functions */
/*-----------------------------------------------------------------------------------*/

if (class_exists('woocommerce')) {
  add_filter( 'woocommerce_enqueue_styles', '__return_false' );
  // Disable WooCommerce Lightbox
  update_option( 'woocommerce_enable_lightbox', false );
    
}
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Redefine woocommerce_output_related_products()
add_filter( 'woocommerce_output_related_products_args', 'pinnacle_woo_related_products_limit' );
  function pinnacle_woo_related_products_limit( $args ) {
  $args['posts_per_page'] = 4; // 4 related products
  $args['columns'] = 4; // arranged in 2 columns
  return $args;
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

function pinnacle_woocommerce_output_upsells() {
  woocommerce_upsell_display( 4,4 ); 
}
add_action( 'woocommerce_after_single_product_summary', 'pinnacle_woocommerce_output_upsells', 15 );

function pinnacle_product_thumnbnail_image($html) {
    $html = str_replace('data-rel="prettyPhoto', 'data-rel="lightbox', $html);
    return $html;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'pinnacle_product_thumnbnail_image');

// Number of products per page
function pinnacle_products_per_page() {
    global $pinnacle;
    if ( isset( $pinnacle['products_per_page'] ) ) {
      return $pinnacle['products_per_page'];
    }
}
add_filter('loop_shop_per_page', 'pinnacle_products_per_page');

// Display product tabs?
add_action('wp_head','pinnacle_tab_check');
function pinnacle_tab_check() {
    global $pinnacle;
    if ( isset( $pinnacle[ 'product_tabs' ] ) && $pinnacle[ 'product_tabs' ] == "0" ) {
      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    }
}

// Display related products?
add_action('wp_head','pinnacle_related_products');
function pinnacle_related_products() {
    global $pinnacle;
    if ( isset( $pinnacle[ 'related_products' ] ) && $pinnacle[ 'related_products' ] == "0" ) {
      remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    }
}

add_filter('loop_shop_columns', 'pinnacle_loop_columns');
  function pinnacle_loop_columns() {
    global $pinnacle;
    if(isset($pinnacle['product_shop_layout'])) {
      return $pinnacle['product_shop_layout'];
    } else {
      return 4;
    }
}

// Shop Pages
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

if ( isset( $pinnacle['default_showproducttitle_inpost'] ) && $pinnacle['default_showproducttitle_inpost'] == 0 ) {
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
}

add_filter( 'add_to_cart_fragments', 'kt_get_refreshed_fragments' );
 function kt_get_refreshed_fragments($fragments) {
    // Get mini cart
    ob_start();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $fragments['div.kt-header-mini-cart-refreash'] ='<div class="kt-header-mini-cart-refreash">' . $mini_cart . '</div>';

    return $fragments;

  }
  add_filter( 'add_to_cart_fragments', 'kt_get_refreshed_fragments_number' );
 function kt_get_refreshed_fragments_number($fragments) {
    global $woocommerce;
    // Get mini cart
    ob_start();

    ?><span class="kt-cart-total"><?php echo $woocommerce->cart->cart_contents_count; ?></span> <?php

    $fragments['span.kt-cart-total'] = ob_get_clean();

    return $fragments;

  }


