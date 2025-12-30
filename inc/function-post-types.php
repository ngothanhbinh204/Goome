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
        'name'                  => _x( 'Dự án', 'Post Type General Name', 'canhcamtheme' ),
        'singular_name'         => _x( 'Dự án', 'Post Type Singular Name', 'canhcamtheme' ),
        'menu_name'             => __( 'Dự án', 'canhcamtheme' ),
        'name_admin_bar'        => __( 'Dự án', 'canhcamtheme' ),
        'archives'              => __( 'Lưu trữ dự án', 'canhcamtheme' ),
        'attributes'            => __( 'Thuộc tính dự án', 'canhcamtheme' ),
        'parent_item_colon'     => __( 'Dự án cha:', 'canhcamtheme' ),
        'all_items'             => __( 'Tất cả dự án', 'canhcamtheme' ),
        'add_new_item'          => __( 'Thêm dự án mới', 'canhcamtheme' ),
        'add_new'               => __( 'Thêm mới', 'canhcamtheme' ),
        'new_item'              => __( 'Dự án mới', 'canhcamtheme' ),
        'edit_item'             => __( 'Chỉnh sửa dự án', 'canhcamtheme' ),
        'update_item'           => __( 'Cập nhật dự án', 'canhcamtheme' ),
        'view_item'             => __( 'Xem dự án', 'canhcamtheme' ),
        'view_items'            => __( 'Xem các dự án', 'canhcamtheme' ),
        'search_items'          => __( 'Tìm dự án', 'canhcamtheme' ),
        'not_found'             => __( 'Không tìm thấy', 'canhcamtheme' ),
        'not_found_in_trash'    => __( 'Không tìm thấy trong thùng rác', 'canhcamtheme' ),
        'featured_image'        => __( 'Ảnh đại diện', 'canhcamtheme' ),
        'set_featured_image'    => __( 'Đặt ảnh đại diện', 'canhcamtheme' ),
        'remove_featured_image' => __( 'Xóa ảnh đại diện', 'canhcamtheme' ),
        'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'canhcamtheme' ),
        'insert_into_item'      => __( 'Chèn vào dự án', 'canhcamtheme' ),
        'uploaded_to_this_item' => __( 'Tải lên dự án này', 'canhcamtheme' ),
        'items_list'            => __( 'Danh sách dự án', 'canhcamtheme' ),
        'items_list_navigation' => __( 'Điều hướng danh sách dự án', 'canhcamtheme' ),
        'filter_items_list'     => __( 'Lọc danh sách dự án', 'canhcamtheme' ),
    );

    // Args for Project CPT
    $args_project = array(
        'label'                 => __( 'Dự án', 'canhcamtheme' ),
        'description'           => __( 'Mô tả dự án', 'canhcamtheme' ),
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
        'name'                       => _x( 'Danh mục dự án', 'Taxonomy General Name', 'canhcamtheme' ),
        'singular_name'              => _x( 'Danh mục dự án', 'Taxonomy Singular Name', 'canhcamtheme' ),
        'menu_name'                  => __( 'Danh mục', 'canhcamtheme' ),
        'all_items'                  => __( 'Tất cả danh mục', 'canhcamtheme' ),
        'parent_item'                => __( 'Danh mục cha', 'canhcamtheme' ),
        'parent_item_colon'          => __( 'Danh mục cha:', 'canhcamtheme' ),
        'new_item_name'              => __( 'Tên danh mục mới', 'canhcamtheme' ),
        'add_new_item'               => __( 'Thêm danh mục mới', 'canhcamtheme' ),
        'edit_item'                  => __( 'Sửa danh mục', 'canhcamtheme' ),
        'update_item'                => __( 'Cập nhật danh mục', 'canhcamtheme' ),
        'view_item'                  => __( 'Xem danh mục', 'canhcamtheme' ),
        'separate_items_with_commas' => __( 'Phân tách danh mục bằng dấu phẩy', 'canhcamtheme' ),
        'add_or_remove_items'        => __( 'Thêm hoặc xóa danh mục', 'canhcamtheme' ),
        'choose_from_most_used'      => __( 'Chọn từ danh mục phổ biến nhất', 'canhcamtheme' ),
        'popular_items'              => __( 'Danh mục phổ biến', 'canhcamtheme' ),
        'search_items'               => __( 'Tìm kiếm danh mục', 'canhcamtheme' ),
        'not_found'                  => __( 'Không tìm thấy', 'canhcamtheme' ),
        'no_terms'                   => __( 'Không có danh mục', 'canhcamtheme' ),
        'items_list'                 => __( 'Danh sách danh mục', 'canhcamtheme' ),
        'items_list_navigation'      => __( 'Điều hướng danh sách danh mục', 'canhcamtheme' ),
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
        'name'                  => _x( 'Tuyển dụng', 'Post Type General Name', 'canhcamtheme' ),
        'singular_name'         => _x( 'Tuyển dụng', 'Post Type Singular Name', 'canhcamtheme' ),
        'menu_name'             => __( 'Tuyển dụng', 'canhcamtheme' ),
        'name_admin_bar'        => __( 'Tuyển dụng', 'canhcamtheme' ),
        'archives'              => __( 'Lưu trữ tuyển dụng', 'canhcamtheme' ),
        'all_items'             => __( 'Tất cả vị trí', 'canhcamtheme' ),
        'add_new_item'          => __( 'Thêm vị trí mới', 'canhcamtheme' ),
        'add_new'               => __( 'Thêm mới', 'canhcamtheme' ),
        'new_item'              => __( 'Vị trí mới', 'canhcamtheme' ),
        'edit_item'             => __( 'Sửa vị trí', 'canhcamtheme' ),
        'update_item'           => __( 'Cập nhật vị trí', 'canhcamtheme' ),
        'view_item'             => __( 'Xem vị trí', 'canhcamtheme' ),
        'view_items'            => __( 'Xem các vị trí', 'canhcamtheme' ),
        'search_items'          => __( 'Tìm vị trí', 'canhcamtheme' ),
        'not_found'             => __( 'Không tìm thấy', 'canhcamtheme' ),
        'not_found_in_trash'    => __( 'Không tìm thấy trong thùng rác', 'canhcamtheme' ),
        'featured_image'        => __( 'Ảnh đại diện', 'canhcamtheme' ),
        'set_featured_image'    => __( 'Đặt ảnh đại diện', 'canhcamtheme' ),
        'remove_featured_image' => __( 'Xóa ảnh đại diện', 'canhcamtheme' ),
        'use_featured_image'    => __( 'Sử dụng làm ảnh đại diện', 'canhcamtheme' ),
        'insert_into_item'      => __( 'Chèn vào tin tuyển dụng', 'canhcamtheme' ),
        'uploaded_to_this_item' => __( 'Tải lên tin này', 'canhcamtheme' ),
        'items_list'            => __( 'Danh sách tuyển dụng', 'canhcamtheme' ),
        'items_list_navigation' => __( 'Điều hướng danh sách tuyển dụng', 'canhcamtheme' ),
        'filter_items_list'     => __( 'Lọc danh sách tuyển dụng', 'canhcamtheme' ),
    );

    $args_career = array(
        'label'                 => __( 'Tuyển dụng', 'canhcamtheme' ),
        'description'           => __( 'Mô tả tuyển dụng', 'canhcamtheme' ),
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
        'name'                       => _x( 'Career Location', 'Taxonomy General Name', 'canhcamtheme' ),
        'singular_name'              => _x( 'Career Location', 'Taxonomy Singular Name', 'canhcamtheme' ),
        'menu_name'                  => __( 'Location', 'canhcamtheme' ),
        'all_items'                  => __( 'All Locations', 'canhcamtheme' ),
        'parent_item'                => __( 'Parent Location', 'canhcamtheme' ),
        'parent_item_colon'          => __( 'Parent Location:', 'canhcamtheme' ),
        'new_item_name'              => __( 'New Location Name', 'canhcamtheme' ),
        'add_new_item'               => __( 'Add New Location', 'canhcamtheme' ),
        'edit_item'                  => __( 'Edit Location', 'canhcamtheme' ),
        'update_item'                => __( 'Update Location', 'canhcamtheme' ),
        'view_item'                  => __( 'View Location', 'canhcamtheme' ),
        'separate_items_with_commas' => __( 'Separate locations with commas', 'canhcamtheme' ),
        'add_or_remove_items'        => __( 'Add or remove locations', 'canhcamtheme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'canhcamtheme' ),
        'popular_items'              => __( 'Popular Locations', 'canhcamtheme' ),
        'search_items'               => __( 'Search Locations', 'canhcamtheme' ),
        'not_found'                  => __( 'Not Found', 'canhcamtheme' ),
        'no_terms'                   => __( 'No locations', 'canhcamtheme' ),
        'items_list'                 => __( 'Locations list', 'canhcamtheme' ),
        'items_list_navigation'      => __( 'Locations list navigation', 'canhcamtheme' ),
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
            'slug'       => 'dia-diem-tuyen-dung',
            'with_front' => false,
             'hierarchical' => true
        ),
    );
    register_taxonomy( 'career_cat', array( 'career' ), $args_career_cat );
}

add_action( 'init', 'goome_register_post_types' );
