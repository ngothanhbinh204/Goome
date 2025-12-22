<?php
/**
 * Template Name: Home Page
 * 
 * @package CanhCamTheme
 */

get_header();

// Include Banner Module (Moved to outside have_rows loop to ensure it always renders if configured)
// Home Page specific logic for banner is handled inside the module via banner resolution rules.
include get_template_directory() . '/modules/common/banner.php';

if (have_rows('home_content')) {
    while (have_rows('home_content')) {
        the_row();
        $layout = get_row_layout();

        // 1. Home About
        if ($layout == 'layout_home_about') {
            include get_template_directory() . '/modules/home/home-about.php';
        }

        // 2. Home Projects
        elseif ($layout == 'layout_home_projects') {
            // Prepare Query: Get Categories and their projects
            $limit = get_sub_field('limit') ? get_sub_field('limit') : 6;
            $project_terms = get_terms([
                'taxonomy' => 'project_cat',
                'hide_empty' => true,
            ]);

            $projects_data = [];
            if (!empty($project_terms) && !is_wp_error($project_terms)) {
                foreach ($project_terms as $term) {
                    $args = [
                        'post_type' => 'project',
                        'posts_per_page' => $limit,
                        'tax_query' => [
                            [
                                'taxonomy' => 'project_cat',
                                'field' => 'term_id',
                                'terms' => $term->term_id,
                            ]
                        ],
                        'orderby' => 'menu_order date',
                        'order' => 'DESC',
                    ];
                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        $projects_data[] = [
                            'term' => $term,
                            'query' => $query
                        ];
                    }
                }
            }
            // Include module and pass $projects_data
            include get_template_directory() . '/modules/home/home-projects.php';
        }

        // 3. Home News
        elseif ($layout == 'layout_home_news') {
            // Prepare Query
            $limit = get_sub_field('limit') ? get_sub_field('limit') : 6;
            $news_args = [
                'post_type' => 'post',
                'posts_per_page' => $limit,
                'orderby' => 'date',
                'order' => 'DESC',
                'ignore_sticky_posts' => 1,
            ];
            $news_query = new WP_Query($news_args);
            
            include get_template_directory() . '/modules/home/home-news.php';
        }

        // 4. Home Partners
        elseif ($layout == 'layout_home_partners') {
            include get_template_directory() . '/modules/home/home-partners.php';
        }
    }
}

get_footer();
