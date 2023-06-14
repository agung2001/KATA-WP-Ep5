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

// wp_enqueue_scripts
function my_youtube_plugin_scripts(){
    // 3rd party library.
//    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
//    wp_enqueue_style('tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
//    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    // Custom styles and scripts.
//    wp_enqueue_style('my-youtube-plugin-style', plugins_url('style-main.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'my_youtube_plugin_scripts');

// init
function custom_init_function(){
    // Register Custom Post Type
    register_post_type( 'book',
        array(
            'labels'      => array(
                'name'          => __( 'Books', 'text-domain' ),
                'singular_name' => __( 'Book', 'text-domain' ),
            ),
            'public'      => true,
            'has_archive' => true,
        )
    );

    // Register Custom Taxonomy
    register_taxonomy( 'genre', array( 'book' ),
        array(
            'labels'      => array(
                'name'          => __( 'Genres', 'text-domain' ),
                'singular_name' => __( 'Genre', 'text-domain' ),
            ),
            'public'      => true,
            'hierarchical' => true,
        )
    );
    flush_rewrite_rules();
}
add_action('init', 'custom_init_function');

// wp_head
function custom_wp_head(){
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=YOUR_ANALYTICS_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'YOUR_ANALYTICS_ID');
    </script>
    <?php
}
add_action('wp_head', 'custom_wp_head');

// wp_footer
function custom_wp_footer(){
    // Get the current post URL
    $post_url = urlencode( get_permalink() );

    // Get the current post title
    $post_title = urlencode( get_the_title() );

    // Output the social sharing buttons
    ?>
    <div class="social-sharing-buttons">
        <a href="https://www.facebook.com/sharer.php?u=<?php echo $post_url; ?>" target="_blank" rel="noopener noreferrer">Share on Facebook</a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer">Share on Twitter</a>
        <a href="https://www.linkedin.com/shareArticle?url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer">Share on LinkedIn</a>
    </div>
    <?php
}
add_action('wp_footer', 'custom_wp_footer');

// admin_init
function custom_admin_init(){
    // 3rd party library.
//    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
//    wp_enqueue_style('tailwind', 'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
//    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

    // Custom styles and scripts.
//    wp_enqueue_style('my-youtube-plugin-style', plugins_url('style-main.css', __FILE__));
}
add_action('admin_init', 'custom_admin_init');

// save_post
function custom_save_post( $post_id ){
    if( 19 === $post_id && 'book' === get_post_type($post_id) ){
        update_post_meta( $post_id, 'captain', 'kirk' );
    }
}
add_action('save_post', 'custom_save_post', 10, 1);

// template_redirect
function custom_template_redirect(){
    global $post;
    if( 'book' === $post->post_type && !is_user_logged_in() ){
        wp_redirect( home_url() );
        exit;
    }
}
add_action('template_redirect', 'custom_template_redirect');

// wp_login
function custom_wp_login(){
//    wp_redirect( home_url() );
//    exit;
}
add_action('wp_login', 'custom_wp_login');

// pre_get_posts
function custom_pre_get_posts( $query ){
    if ( $query->is_search() ) {
        $query->set('post_type', array('post')); // Exclude custom post types from search
    }
}
add_action('pre_get_posts', 'custom_pre_get_posts', 10, 1);