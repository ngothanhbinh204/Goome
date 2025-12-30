<?php
/**
 * Module: Project Archive Content
 * Used by: page-projects.php, archive-project.php, taxonomy-project_cat.php
 * Expects:
 * - $args['archive_page_id'] (int)
 * - $args['query'] (WP_Query object)
 */

$archive_page_id = isset($args['archive_page_id']) ? $args['archive_page_id'] : 0;
$the_query       = isset($args['query']) ? $args['query'] : null;

// Get Intro Fields
$intro_group = get_field('project_page_intro', $archive_page_id);
$title       = isset($intro_group['title']) ? $intro_group['title'] : '';
$desc        = isset($intro_group['description']) ? $intro_group['description'] : '';

if (!$title && $archive_page_id) {
    $title = get_the_title($archive_page_id);
} elseif (is_tax()) {
    $title = single_term_title('', false);
}

// Get Terms for Filter
$terms = get_terms([
    'taxonomy'   => 'project_cat',
    'hide_empty' => true,
]);
$current_term_id = is_tax('project_cat') ? get_queried_object_id() : 0;
// Link to the "All" page (Archive Entry Page)
$all_link = get_permalink(goome_get_archive_page_id('project'));

?>

<section class="section-project-list"> 
    <div class="section-px">
        <div class="section-py"> 
            <div class="block-content"> 
                <?php if ($title || $desc): ?>
                <div class="heading-1">
                    <h1><?php echo esc_html($title); ?></h1>
                </div>
                <?php if ($desc): ?>
                <div class="content-project body-1">
                    <?php echo wp_kses_post($desc); ?>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <div class="block-project"> 
                    <div class="list-project"> 
                        <ul>
                            <li class="<?php echo ($current_term_id === 0) ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url($all_link); ?>">Tất cả</a>
                            </li>
                            <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                                <?php foreach ($terms as $term): ?>
                                    <li class="<?php echo ($current_term_id === $term->term_id) ? 'active' : ''; ?>">
                                        <a href="<?php echo esc_url(get_term_link($term)); ?>">
                                            <?php echo esc_html($term->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php if ($the_query && $the_query->have_posts()): ?>
                    <div class="project-grid  grid grid-cols-1 md:grid-cols-3 gap-base">
                        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                            <?php 
                                $feat_img = get_post_thumbnail_id(get_the_ID());
                                $feat_img_url = wp_get_attachment_image_url($feat_img, 'full');
                                $terms_list = get_the_terms(get_the_ID(), 'project_cat');
                                $term_name = (!empty($terms_list) && !is_wp_error($terms_list)) ? $terms_list[0]->name : '';
                                $location = get_field('location');
                            ?>
                            <div class="card-project group flex flex-col gap-6 "> 
                                <a class="img img-ratio ratio:pt-[433_560]  rounded-4 zoom-img" href="<?php the_permalink(); ?>"> 
                                   <?php echo get_image_post(get_the_ID(), 'image'); ?>
                                </a>
                                <div class="content-card-project"> 
                                    <?php if ($term_name): ?>
                                    <div class="body-1 text-utility-gray-500">
                                        <p><?php echo esc_html($term_name); ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <div class="heading-2 group-hover:text-primary-1 duration-300">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                  <?php echo wp_bootstrap_pagination(array('custom_query' => $the_query)) ?>
                    <?php else: ?>
                        <p><?php esc_html_e('Không có dự án nào.', 'canhcamtheme'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
