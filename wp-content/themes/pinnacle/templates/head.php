<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?> <?php pinnacle_html_tag_schema();?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?> <?php pinnacle_html_tag_schema();?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?> <?php pinnacle_html_tag_schema();?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?> <?php pinnacle_html_tag_schema();?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <?php if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function pinnacle_slug_render_title() { ?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php }
		add_action( 'wp_head', 'pinnacle_slug_render_title' );
	} ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php global $pinnacle; if(!empty($pinnacle['pinnacle_custom_favicon']['url'])) {
   	echo '<link rel="shortcut icon" type="image/x-icon" href="'. esc_attr($pinnacle['pinnacle_custom_favicon']['url']).'"/>';
   } ?>
  <?php wp_head(); ?>
</head>
