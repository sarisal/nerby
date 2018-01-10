<?php
global $wp_query;
$post = $wp_query->post;

$background_colour = get_field('header_background_colour', $post->ID);
$logo_colour = get_field('header_logo_colour', $post->ID);
$menu_item_colour = get_field('header_menu_item_colour', $post->ID);
$menu_item_hover_colour = get_field('header_menu_item_hover_colour', $post->ID);
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" type="application/rss+xml" title="<?= get_bloginfo('name'); ?> Feed" href="<?= esc_url(get_feed_link()); ?>">
    <link href="https://file.myfontastic.com/Xv9FaXvwhw6vB4qbGXsRSY/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/fot2jlp.css">
    <?php wp_head(); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
  </head>