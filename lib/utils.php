<?php

namespace Roots\Sage\Utils;

function get_excerpt($excerpt, $count){
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, $count);
    $excerpt = $excerpt.'...';
    return $excerpt;
}

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function get_search_form() {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', __NAMESPACE__ . '\\get_search_form');

/**
 * Make a URL relative
 */
function root_relative_url($input) {
  preg_match('|https?://([^/]+)(/.*)|i', $input, $matches);
  if (!isset($matches[1]) || !isset($matches[2])) {
    return $input;
  } elseif (($matches[1] === $_SERVER['SERVER_NAME']) || $matches[1] === $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT']) {
    return wp_make_link_relative($input);
  } else {
    return $input;
  }
}

/**
 * Compare URL against relative URL
 */
function url_compare($url, $rel) {
  $url = trailingslashit($url);
  $rel = trailingslashit($rel);
  if ((strcasecmp($url, $rel) === 0) || root_relative_url($url) == $rel) {
    return true;
  } else {
    return false;
  }
}

/**
 * Check if element is empty
 */
function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

/**
 * Registers a custom content type
 */
function register_content_type( $singular, $plural, $type, $ns = 'theme' )
{
    // Hook into the 'init' action
    add_action( 'init', function() use ( $singular, $plural, $type, $ns ) {

        $labels = [
            'name'                => _x( $plural, 'Post Type General Name', $ns ),
            'singular_name'       => _x( $singular, 'Post Type Singular Name', $ns ),
            'menu_name'           => __( $plural, $ns ),
            'parent_item_colon'   => __( 'Parent ' . $singular . ':', $ns ),
            'all_items'           => __( 'All ' . $plural, $ns ),
            'view_item'           => __( 'View ' . $singular, $ns ),
            'add_new_item'        => __( 'Add New ' . $singular, $ns ),
            'add_new'             => __( 'Add New', $ns ),
            'edit_item'           => __( 'Edit ' . $singular, $ns ),
            'update_item'         => __( 'Update ' . $singular, $ns ),
            'search_items'        => __( 'Search ' . $plural, $ns ),
            'not_found'           => __( 'Not found', $ns ),
            'not_found_in_trash'  => __( 'Not found in Trash', $ns ),
        ];
        $args = [
            'label'               => __( $singular, $ns ),
            'description'         => __( $plural, $ns ),
            'labels'              => $labels,
            'supports'            => [ 'title', 'editor', 'custom-fields', 'thumbnail' ],
            'taxonomies'          => [ 'category', 'post_tag' ],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        ];
        register_post_type( $type, $args );

    }, 0 );
}