<?php
/* Template Name: News Archive Entry */
get_header();

// Include Banner Module
include get_template_directory() . '/modules/common/banner.php';

$archive_page_id = get_the_ID(); 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 10, // 1 featured + 9 grid?
    'paged'          => $paged,
    'status'         => 'publish'
];
$news_query = new WP_Query($args);

?>
<main>
    <?php 
    get_template_part('modules/news/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $news_query
    ]); 
    ?>
</main>
<?php get_footer(); ?>
