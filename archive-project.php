<?php
get_header();

// Include Banner Module
include get_template_directory() . '/modules/common/banner.php';

$archive_page_id = goome_get_archive_page_id('project');
global $wp_query;
?>
<main>
    <?php 
    get_template_part('modules/projects/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $wp_query
    ]); 
    ?>
</main>
<?php get_footer(); ?>
