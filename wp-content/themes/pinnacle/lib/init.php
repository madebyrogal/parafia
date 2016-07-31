<?php
/**
 * Pinnacle initial setup and constants
 */
function kadence_setup() {
  // Register Menus
  register_nav_menus(array(
    'primary_navigation'  => __('Primary Navigation', 'pinnacle'),
    'topbar_navigation'   => __('Topbar Navigation', 'pinnacle'),
    'footer_navigation'   => __('Footer Navigation', 'pinnacle'),
  ));
  add_theme_support('post-thumbnails');
  add_theme_support( 'title-tag' );
  add_image_size( 'pinnacle_widget-thumb', 60, 60, true );
  add_post_type_support( 'attachment', 'page-attributes' );
  add_theme_support('post-formats', array('gallery', 'image', 'video'));
  add_theme_support( 'automatic-feed-links' );
  add_editor_style('/assets/css/editor-style.css');
}
add_action('after_setup_theme', 'kadence_setup');

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
/**
 * Define helper constants
 */
$get_theme_name = explode('/themes/', get_template_directory());

define('RELATIVE_CONTENT_PATH', str_replace(home_url() . '/', '', content_url()));
define('THEME_NAME',            next($get_theme_name));
define('THEME_PATH',            RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
