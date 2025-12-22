<?php
define('GENERATE_VERSION', '1.1.0');
require get_template_directory() . '/inc/function-root.php';
require get_template_directory() . '/inc/function-custom.php';
require get_template_directory() . '/inc/function-field.php';
require get_template_directory() . '/inc/function-pagination.php';
require get_template_directory() . '/inc/function-setup.php';
require get_template_directory() . '/inc/function-menu-walker.php';
require get_template_directory() . '/inc/function-post-types.php';

// Register Menus
function canhcam_register_menus() {
    register_nav_menus( array(
        'header-menu' => esc_html__( 'Header Menu', 'canhcamtheme' ),
        'footer-1'    => esc_html__( 'Footer Menu 1', 'canhcamtheme' ),
        'footer-2'    => esc_html__( 'Footer Menu 2', 'canhcamtheme' ),
        'footer-3'    => esc_html__( 'Footer Menu 3', 'canhcamtheme' ),
        'footer-4'    => esc_html__( 'Footer Menu 4', 'canhcamtheme' ),
    ) );
}
add_action( 'after_setup_theme', 'canhcam_register_menus' );

// Add Options Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}
