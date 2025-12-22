<?php
/**
 * Module: News Archive Content
 * Used by: page-news.php, archive.php, category.php, tag.php
 * Expects:
 * - $args['archive_page_id'] (int)
 * - $args['query'] (WP_Query object)
 */

$archive_page_id = isset($args['archive_page_id']) ? $args['archive_page_id'] : 0;
$the_query       = isset($args['query']) ? $args['query'] : null;

// Get Intro Fields
$intro_group = get_field('news_page_intro', $archive_page_id);
$title       = isset($intro_group['title']) ? $intro_group['title'] : '';

if (!$title && $archive_page_id) {
    // If not set in ACF, fallback to page title
    $title = get_the_title($archive_page_id);
} elseif (is_category() || is_tag()) {
    $title = single_term_title('', false);
} elseif (is_home() && !$title) {
    // Fallback for generic blog home if not entry page
    $title = __('Tin tức & Kiên thức', 'canhcamtheme'); 
}

// Get Terms for Filter (Categories)
// Exclude 'Uncategorized' (usually ID 1) if desired, or hide empty.
$categories = get_terms([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'exclude'    => [1] 
]);
$current_term_id = (is_category()) ? get_queried_object_id() : 0;
$all_link = get_permalink(goome_get_archive_page_id('post'));

?>

<section class="section-new-list"> 
    <div class="container">
        <div class="section-py"> 
            <div class="flex flex-col gap-base">
                <div class="block-content-top"> 
                    <?php if ($title): ?>
                    <div class="heading-1 whitespace-nowrap">
                        <h1><?php echo esc_html($title); ?></h1>
                    </div>
                    <?php endif; ?>
                    <div class="list-new"> 
                        <ul>
                            <li class="<?php echo ($current_term_id === 0) ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url($all_link); ?>"><?php esc_html_e('Tất cả', 'canhcamtheme'); ?></a>
                            </li>
                            <?php if (!empty($categories) && !is_wp_error($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <li class="<?php echo ($current_term_id === $cat->term_id) ? 'active' : ''; ?>">
                                        <a href="<?php echo esc_url(get_term_link($cat)); ?>">
                                            <?php echo esc_html($cat->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <?php 
                // Featured News (First item in query) - Only show on first page or "All" view?
                // UI shows a "block-new-banner" with a large featured post.
                // We'll extract the first post from the query for this, if exists.
                if ($the_query && $the_query->have_posts()): 
                    $the_query->the_post(); // Advance 1 for featured?
                    // Or keep it simple: Just loop all in grid?
                    // UI explicitly shows .block-new-banner separate from .block-new-card.
                    // Let's take the first post as featured.
                    $feat_post_id = get_the_ID();
                    $feat_img = get_post_thumbnail_id($feat_post_id);
                    $feat_img_url = wp_get_attachment_image_url($feat_img, 'large'); // Need proper ratio
                    $feat_date = get_the_date('d/m/Y');
                    $feat_cats = get_the_category();
                    $feat_cat_name = !empty($feat_cats) ? $feat_cats[0]->name : '';
                    $feat_excerpt = get_the_excerpt();
                ?>
                <div class="block-new-banner">
                    <div class="grid grid-cols-2 -md:grid-cols-1 -md:gap-base">
                        <div class="img img-ratio ratio:pt-[69%] zoom-img rounded-4 md:rounded-r-none">
                            <?php if($feat_img_url): ?>
                            <img class="lozad" data-src="<?php echo esc_url($feat_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                            <?php endif; ?>
                        </div>
                        <div class="bg-new bg-utility-gray-50 w-full h-full flex items-center pr-base pl-base  md:rounded-r-4">
                            <div class="block-content">
                                <div class="date"> 
                                    <p><?php echo esc_html($feat_date); ?></p>
                                    <?php if($feat_cat_name): ?><span><?php echo esc_html($feat_cat_name); ?></span><?php endif; ?>
                                </div>
                                <div class="main-content flex flex-col gap-1">
                                    <div class="title-new"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                    <div class="body-1"> 
                                        <p><?php echo wp_trim_words($feat_excerpt, 20); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block-new-card"> 
                    <div class="grid grid-cols-1 gap-base sm:grid-cols-2 md:grid-cols-3">
                        <?php 
                        // Loop remaining posts
                        while ($the_query->have_posts()): $the_query->the_post(); 
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url = wp_get_attachment_image_url($thumb_id, 'medium'); // Use appropriate size
                            $p_date = get_the_date('d/m/Y');
                            $p_cats = get_the_category();
                            $p_cat_name = !empty($p_cats) ? $p_cats[0]->name : '';
                            $p_excerpt = get_the_excerpt();
                        ?>
                        <div class="card-new card-new flex flex-col gap-6 group"> 
                            <a class="img img-ratio ratio:pt-[340_440] group rounded-4 zoom-img" href="<?php the_permalink(); ?>">
                                <?php if($thumb_url): ?>
                                <img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                                <?php endif; ?>
                            </a>
                            <div class="new-content">
                                <div class="date body-2 pb-2 border-b border-utility-gray-200-line">
                                    <p><?php echo esc_html($p_date); ?></p>
                                    <?php if($p_cat_name): ?><span><?php echo esc_html($p_cat_name); ?></span><?php endif; ?>
                                </div>
                            </div>
                            <div class="content-new">
                                <div class="heading-2"> 
                                    <h3><a class=" group-hover:text-primary-7" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                                <div class="body-1 line-clamp-2">
                                    <p><?php echo wp_trim_words($p_excerpt, 20); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <?php 
                        if (function_exists('canhcam_pagination')) {
                            canhcam_pagination($the_query);
                        }
                    ?>
                </div>

                <?php else: ?>
                    <p><?php esc_html_e('Hiện chưa có tin tức nào.', 'canhcamtheme'); ?></p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
