<?php
/* Template Name: About Page */
get_header();

// Include Banner Module
include get_template_directory() . '/modules/common/banner.php';

?>
<main>
    <?php if(have_rows('about_sections')): ?>
        <?php while(have_rows('about_sections')): the_row(); ?>
            <?php
            $layout = get_row_layout();
            $file_name = str_replace('layout_', '', $layout);
            $file_name = str_replace('_', '-', $file_name);  
            get_template_part('modules/about/' . $file_name);
            ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
