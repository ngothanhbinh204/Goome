<?php
get_header();

// Include Banner Module
// include get_template_directory() . '/modules/common/banner.php';

?>

    <?php
    include get_template_directory() . '/modules/common/breadcrumd.php';
    get_template_part('modules/single-career/career-detail');
    ?>

<?php get_footer(); ?>
