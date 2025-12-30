<?php
/* Template Name: Projects Archive Entry */
get_header();

// Include Banner Module
include get_template_directory() . '/modules/common/banner.php';

$archive_page_id = get_the_ID(); // This page IS the entry page

// Custom Query for "All Projects"
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type'      => 'project',
    'posts_per_page' => 9, 
    'paged'          => $paged,
    'status'         => 'publish'
];
$project_query = new WP_Query($args);

?>

    <?php 
    get_template_part('modules/projects/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $project_query
    ]); 
    ?>

<?php get_footer(); ?>
