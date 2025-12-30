<?php
/**
 * The template for displaying all single posts
 * 
 * @package CanhCamTheme
 */

get_header();

// NO BANNER INCLUDED HERE per instructions

?>

    <?php
    include get_template_directory() . '/modules/common/breadcrumd.php';
    get_template_part('modules/news/single-content');
    ?>

<?php get_footer(); ?>
