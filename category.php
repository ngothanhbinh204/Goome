<?php
get_header();

$archive_page_id = goome_get_archive_page_id('post');
global $wp_query;
?>
    <?php 
    include get_template_directory() . '/modules/common/banner-basic.php';
    include get_template_directory() . '/modules/common/breadcrumd.php';
    get_template_part('modules/news/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $wp_query
    ]); 
    ?>
<?php get_footer(); ?>
