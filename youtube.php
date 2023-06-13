<?php
/*
 * Plugin Name:       My YouTube Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Agung Sundoro
 * Author URI:        https://agung2001.github.io
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       my-youtube-plugin
 * Domain Path:       /languages
 */

// Custom Action Hook : lapor_pak
class Laporan {
    function lapor_pak(){
        echo "Lapor Pak RT 123!";
    }
}
add_action('lapor_pak_class', array( new Laporan, 'lapor_pak' ));




// Filter Custom Filters : salam_lapor_pak
function filter_salam_lapor_pak($salam){
    return str_replace('Pak RT', 'Bu RT', $salam);
}
add_filter('salam_lapor_pak', 'filter_salam_lapor_pak');


// Custom Action Hook : lapor_pak
function lapor_pak(){
    echo apply_filters('salam_lapor_pak', "Lapor Pak RT!");
}
add_action('lapor_pak', 'lapor_pak');


// Action Hook : Init
function fungsi_init(){
    do_action('lapor_pak');
}
add_action('init', 'fungsi_init');




// Action Hook : wp_head
function fungsi_genteng(){
    echo "<div style='color:red;'>PAKAI GENTENG ASPAL!</div>";
}
add_action('wp_head', 'fungsi_genteng');

// Action Hook : wp_footer
function fungsi_sepiteng(){
    echo "<div style='color:blue;'>PAKAI SEPITENG!</div>";
}
add_action('wp_footer', 'fungsi_sepiteng');




// Filter Hook : the_content
function filter_the_content($content){
//    return 'PREFIX' . $content . 'SUFFIX';
    return str_replace('WordPress', 'WP', $content);
}
add_filter('the_content', 'filter_the_content');

// Filter Hook : the_title
function filter_the_title($title){
    return str_replace('world', 'agung', $title);
}
add_filter('the_title', 'filter_the_title');