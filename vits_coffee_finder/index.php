<?php
/**
 * Plugin Name: Vits Coffee Finder
 * Plugin URI: https://vitsderkaffee.de/
 * Description: A guide for customers to find the right coffee
 * Version: 1.0
 * Author: Anna Wagner, Sven
 * Author URI: https://vitsderkaffee.de/
 **/

// setup admin part
const VITS_CF_PLUGIN_PATH = WP_PLUGIN_DIR . '/vits_coffee_finder';
require_once(VITS_CF_PLUGIN_PATH . "/admin/admin.php");
vits_cf_setup_admin_plugin();

/**
 * @todo How to group tags?
 *       1. Maybe with hierarchical tags: https://css-tricks.com/how-and-why-to-convert-wordpress-tags-from-flat-to-hierarchical/
 *       2. Maybe add a backend
 * @link [advanced Woo Search guide](https://advanced-woo-search.com/guide/?utm_source=wp-repo&utm_medium=listing&utm_campaign=aws-repo)
 */
function vits_cf_print_product_tags_as_json()
{
    $terms = get_terms('product_tag');
    $term_array = array();
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $term_array[] = $term->name;
        }
    }

    //todo: temporary output
    echo "<script>var tags=" . json_encode($term_array) . "</script>";
    echo '<a href="http://localhost:8080/?s=schokoladig%20nussig&post_type=product">example search</a>';
}


add_shortcode('coffee-finder', 'vits_cf_print_product_tags_as_json');




