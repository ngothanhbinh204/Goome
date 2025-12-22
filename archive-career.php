<?php
get_header();
$archive_page_id = goome_get_archive_page_id('career');
global $wp_query;
?>
<main>
    <?php 
    get_template_part('modules/career/archive-content', null, [
        'archive_page_id' => $archive_page_id,
        'query'           => $wp_query
    ]); 
    ?>
</main>
<?php get_footer(); ?>
