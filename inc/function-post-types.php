<?php
/**
 * Custom Post Types and Taxonomies Registration
 * Using WordPress Core Standard Functions
 */

function goome_register_post_types() {

    // -------------------------------------------------------------------------
    // 1. PROJECT CPT
    // -------------------------------------------------------------------------

    // Labels for Project CPT
    $labels_project = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'canhcamtheme' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'canhcamtheme' ),
        'menu_name'             => __( 'Projects', 'canhcamtheme' ),
        'name_admin_bar'        => __( 'Project', 'canhcamtheme' ),
        'archives'              => __( 'Project Archives', 'canhcamtheme' ),
        'attributes'            => __( 'Project Attributes', 'canhcamtheme' ),
        'parent_item_colon'     => __( 'Parent Project:', 'canhcamtheme' ),
        'all_items'             => __( 'All Projects', 'canhcamtheme' ),
        'add_new_item'          => __( 'Add New Project', 'canhcamtheme' ),
        'add_new'               => __( 'Add New', 'canhcamtheme' ),
        'new_item'              => __( 'New Project', 'canhcamtheme' ),
        'edit_item'             => __( 'Edit Project', 'canhcamtheme' ),
        'update_item'           => __( 'Update Project', 'canhcamtheme' ),
        'view_item'             => __( 'View Project', 'canhcamtheme' ),
        'view_items'            => __( 'View Projects', 'canhcamtheme' ),
        'search_items'          => __( 'Search Project', 'canhcamtheme' ),
        'not_found'             => __( 'Not found', 'canhcamtheme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'canhcamtheme' ),
        'featured_image'        => __( 'Featured Image', 'canhcamtheme' ),
        'set_featured_image'    => __( 'Set featured image', 'canhcamtheme' ),
        'remove_featured_image' => __( 'Remove featured image', 'canhcamtheme' ),
        'use_featured_image'    => __( 'Use as featured image', 'canhcamtheme' ),
        'insert_into_item'      => __( 'Insert into project', 'canhcamtheme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this project', 'canhcamtheme' ),
        'items_list'            => __( 'Projects list', 'canhcamtheme' ),
        'items_list_navigation' => __( 'Projects list navigation', 'canhcamtheme' ),
        'filter_items_list'     => __( 'Filter projects list', 'canhcamtheme' ),
    );

    // Args for Project CPT
    $args_project = array(
        'label'                 => __( 'Project', 'canhcamtheme' ),
        'description'           => __( 'Project Description', 'canhcamtheme' ),
        'labels'                => $labels_project,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-building',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true, 
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array(
            'slug'       => 'du-an',
            'with_front' => false,
            'pages'      => true
        ),
    );
    register_post_type( 'project', $args_project );

    // -------------------------------------------------------------------------
    // 2. PROJECT CATEGORY TAXONOMY
    // -------------------------------------------------------------------------

    $labels_project_cat = array(
        'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'canhcamtheme' ),
        'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'canhcamtheme' ),
        'menu_name'                  => __( 'Categories', 'canhcamtheme' ),
        'all_items'                  => __( 'All Categories', 'canhcamtheme' ),
        'parent_item'                => __( 'Parent Category', 'canhcamtheme' ),
        'parent_item_colon'          => __( 'Parent Category:', 'canhcamtheme' ),
        'new_item_name'              => __( 'New Category Name', 'canhcamtheme' ),
        'add_new_item'               => __( 'Add New Category', 'canhcamtheme' ),
        'edit_item'                  => __( 'Edit Category', 'canhcamtheme' ),
        'update_item'                => __( 'Update Category', 'canhcamtheme' ),
        'view_item'                  => __( 'View Category', 'canhcamtheme' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'canhcamtheme' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'canhcamtheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'canhcamtheme' ),
        'popular_items'              => __( 'Popular Categories', 'canhcamtheme' ),
        'search_items'               => __( 'Search Categories', 'canhcamtheme' ),
        'not_found'                  => __( 'Not Found', 'canhcamtheme' ),
        'no_terms'                   => __( 'No categories', 'canhcamtheme' ),
        'items_list'                 => __( 'Categories list', 'canhcamtheme' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'canhcamtheme' ),
    );

    $args_project_cat = array(
        'labels'                     => $labels_project_cat,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array(
            'slug'       => 'danh-muc-du-an',
            'with_front' => false,
             'hierarchical' => true
        ),
    );
    register_taxonomy( 'project_cat', array( 'project' ), $args_project_cat );


    // -------------------------------------------------------------------------
    // 3. CAREER CPT
    // -------------------------------------------------------------------------

    $labels_career = array(
        'name'                  => _x( 'Careers', 'Post Type General Name', 'canhcamtheme' ),
        'singular_name'         => _x( 'Career', 'Post Type Singular Name', 'canhcamtheme' ),
        'menu_name'             => __( 'Careers', 'canhcamtheme' ),
        'name_admin_bar'        => __( 'Career', 'canhcamtheme' ),
        'archives'              => __( 'Career Archives', 'canhcamtheme' ),
        'all_items'             => __( 'All Careers', 'canhcamtheme' ),
        'add_new_item'          => __( 'Add New Career', 'canhcamtheme' ),
        'add_new'               => __( 'Add New', 'canhcamtheme' ),
        'new_item'              => __( 'New Career', 'canhcamtheme' ),
        'edit_item'             => __( 'Edit Career', 'canhcamtheme' ),
        'update_item'           => __( 'Update Career', 'canhcamtheme' ),
        'view_item'             => __( 'View Career', 'canhcamtheme' ),
        'view_items'            => __( 'View Careers', 'canhcamtheme' ),
        'search_items'          => __( 'Search Career', 'canhcamtheme' ),
        'not_found'             => __( 'Not found', 'canhcamtheme' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'canhcamtheme' ),
        'featured_image'        => __( 'Featured Image', 'canhcamtheme' ),
        'set_featured_image'    => __( 'Set featured image', 'canhcamtheme' ),
        'remove_featured_image' => __( 'Remove featured image', 'canhcamtheme' ),
        'use_featured_image'    => __( 'Use as featured image', 'canhcamtheme' ),
        'insert_into_item'      => __( 'Insert into career', 'canhcamtheme' ),
        'uploaded_to_this_item' => __( 'Uploaded to this career', 'canhcamtheme' ),
        'items_list'            => __( 'Careers list', 'canhcamtheme' ),
        'items_list_navigation' => __( 'Careers list navigation', 'canhcamtheme' ),
        'filter_items_list'     => __( 'Filter careers list', 'canhcamtheme' ),
    );

    $args_career = array(
        'label'                 => __( 'Career', 'canhcamtheme' ),
        'description'           => __( 'Career Description', 'canhcamtheme' ),
        'labels'                => $labels_career,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-businessman',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => array(
            'slug'       => 'tuyen-dung',
            'with_front' => false,
            'pages'      => true
        ),
    );
    register_post_type( 'career', $args_career );

    // -------------------------------------------------------------------------
    // 4. CAREER CATEGORY TAXONOMY
    // -------------------------------------------------------------------------

    $labels_career_cat = array(
        'name'                       => _x( 'Career Categories', 'Taxonomy General Name', 'canhcamtheme' ),
        'singular_name'              => _x( 'Career Category', 'Taxonomy Singular Name', 'canhcamtheme' ),
        'menu_name'                  => __( 'Categories', 'canhcamtheme' ),
        'all_items'                  => __( 'All Categories', 'canhcamtheme' ),
        'parent_item'                => __( 'Parent Category', 'canhcamtheme' ),
        'parent_item_colon'          => __( 'Parent Category:', 'canhcamtheme' ),
        'new_item_name'              => __( 'New Category Name', 'canhcamtheme' ),
        'add_new_item'               => __( 'Add New Category', 'canhcamtheme' ),
        'edit_item'                  => __( 'Edit Category', 'canhcamtheme' ),
        'update_item'                => __( 'Update Category', 'canhcamtheme' ),
        'view_item'                  => __( 'View Category', 'canhcamtheme' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'canhcamtheme' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'canhcamtheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'canhcamtheme' ),
        'popular_items'              => __( 'Popular Categories', 'canhcamtheme' ),
        'search_items'               => __( 'Search Categories', 'canhcamtheme' ),
        'not_found'                  => __( 'Not Found', 'canhcamtheme' ),
        'no_terms'                   => __( 'No categories', 'canhcamtheme' ),
        'items_list'                 => __( 'Categories list', 'canhcamtheme' ),
        'items_list_navigation'      => __( 'Categories list navigation', 'canhcamtheme' ),
    );

    $args_career_cat = array(
        'labels'                     => $labels_career_cat,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array(
            'slug'       => 'danh-muc-tuyen-dung',
            'with_front' => false,
             'hierarchical' => true
        ),
    );
    register_taxonomy( 'career_cat', array( 'career' ), $args_career_cat );
}

add_action( 'init', 'goome_register_post_types' );
