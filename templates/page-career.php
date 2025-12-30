<?php
/* Template Name: Career Archive Entry */
get_header();



$archive_page_id = get_the_ID(); 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type'      => 'career',
    'posts_per_page' => 10,
    'paged'          => $paged,
    'status'         => 'publish'
];
$career_query = new WP_Query($args);

?>
    <?php 
    // Include Banner Module
    include get_template_directory() . '/modules/common/banner-basic.php';
    include get_template_directory() . '/modules/common/breadcrumd.php';
    get_template_part('modules/career/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $career_query
    ]); 
    ?>
<?php get_footer(); ?>
