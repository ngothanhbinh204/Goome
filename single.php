<?php
/**
 * The template for displaying all single posts
 * 
 * @package CanhCamTheme
 */

get_header();

// NO BANNER INCLUDED HERE per instructions

?>
<main>
    <?php
    get_template_part('modules/news/single-content');
    ?>
</main>
<?php get_footer(); ?>
