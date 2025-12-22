<?php
get_header();

// Include Banner Module
// include get_template_directory() . '/modules/common/banner.php';

?>
<main>
    <?php
    get_template_part('modules/single-project/project-intro');
    get_template_part('modules/single-project/project-info');
    get_template_part('modules/single-project/project-gallery');
    ?>
    <section class="related-projects">
        <div class="container">
            <!-- Custom Query for Related Projects -->
        </div>
    </section>
</main>
<?php get_footer(); ?>
