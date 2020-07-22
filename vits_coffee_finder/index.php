<?php
/**
 * Plugin Name: Vits Coffee Finder
 * Plugin URI: https://vitsderkaffee.de/
 * Description: A guide for customers to find the right coffee
 * Version: 1.0
 * Author: Anna Pfützner, Sven
 * Author URI: https://vitsderkaffee.de/
 **/


// place holder Code
function dh_modify_read_more_link() {

    return '<a class="more-link" href="' . get_permalink() . '">Click to Read!</a>';

}

add_filter( 'the_content_more_link', 'dh_modify_read_more_link' );