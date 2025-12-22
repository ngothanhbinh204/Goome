<?php
get_header();

// Include Banner Module
// include get_template_directory() . '/modules/common/banner.php';

?>
<main>
    <?php
    get_template_part('modules/single-career/career-detail');
    ?>
</main>
<?php get_footer(); ?>
