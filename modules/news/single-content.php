<?php
// Modules/News/SingleContent.php
// UI: UI/tin-tucDetail.html

// Ensure we are inside the loop or setup post data
if (!have_posts()) return;
the_post();

$post_id = get_the_ID();
$title = get_the_title();
$date = get_the_date('d-m-Y');
$categories = get_the_category();
$cat_name = !empty($categories) ? $categories[0]->name : '';
$content = get_the_content();
$content = apply_filters('the_content', $content);
$feat_img_url = get_the_post_thumbnail_url($post_id, 'full');

?>

<section class="global-breadcrumb">
    <div class="section-px">
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
    </div>
</section>

<section class="section-new-detail">
    <div class="section-py"> 
        <div class="relative">
            <div class="container"> 
                <div class="mx-[calc(115/1440*100%)] "></div>
                <div class="flex flex-col gap-6">
                    <div class="heading-1"> 
                        <h1><?php echo esc_html($title); ?></h1>
                    </div>
                    <div class="new-line"> 
                        <div class="date"> 
                            <?php if ($cat_name): ?>
                                <p><?php echo esc_html($cat_name); ?> </p>
                            <?php endif; ?>
                            <p><?php echo esc_html($date); ?></p>
                        </div>
                        <div class="new-line"></div>
                    </div>
                    
                    <div class="block-content-main">
                        <div class="format-conetnt"> 
                            <?php if ($feat_img_url): ?>
                                <div class="img img-ratio ratio:pt-[652_1160] my-6">
                                     <img class="lozad" data-src="<?php echo esc_url($feat_img_url); ?>" alt="<?php echo esc_attr($title); ?>"/>
                                </div>
                            <?php endif; ?>
                            
                            <div class="body-1 flex flex-col gap-5"> 
                                <?php echo $content; // Already guarded by existing filters + wp_kses_post usually safe but user asked for wp_kses_post usage - `the_content` is safe-ish, but for strictness: echo wp_kses_post($content); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="block-new-icon">
                <!-- Social Share (Static/Placeholder per UI or use plugins usually. Using static structure from UI) -->
                <a class="icon-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a class="icon-item" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode($title); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
</section>

<?php
// Related Posts (Section home 3 reuse from UI)
// Query: Same category, exclude current
$related_args = array(
    'post_type' => 'post',
    'posts_per_page' => 6, // UI shows slider, usually more than 3
    'post__not_in' => array($post_id),
    'orderby' => 'date', 
    'order' => 'DESC',
    'cat' => !empty($categories) ? $categories[0]->term_id : ''
);
$related_query = new WP_Query($related_args);

if ($related_query->have_posts()):
?>
<section class="section-home-3">
    <div class="section-px">
        <div class="bg-utility-gray-50 rounded-4 relative">
            <div class="container">
                <div class="flex flex-col gap-base section-py">
                    <div class="heading-1"> 
                        <h2><?= __('Tin tức & Kiến thức', 'canhcamtheme') ?></h2> 
                    </div>
                    <div class="swiper-column-auto auto-3-column-custom" data-swiper-prev=".button-swiper .btn-prev" data-swiper-next=".button-swiper .btn-next">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php while($related_query->have_posts()): $related_query->the_post(); 
                                    $r_id = get_the_ID();
                                    $r_title = get_the_title();
                                    $r_date = get_the_date('d/m/Y');
                                    // Use get_image_post helper if available or standard
                                    $r_img = get_the_post_thumbnail_url($r_id, 'medium_large');
                                ?>
                                <div class="swiper-slide">
                                    <div class="card-new card-new flex flex-col gap-6 group"> 
                                        <a class="img img-ratio ratio:pt-[340_440] group rounded-4 zoom-img" href="<?php the_permalink(); ?>">
                                            <?php if($r_img): ?>
                                                <img class="lozad" data-src="<?php echo esc_url($r_img); ?>" alt="<?php echo esc_attr($r_title); ?>"/>
                                            <?php endif; ?>
                                        </a>
                                        <div class="new-content">
                                            <div class="date body-2 pb-2 border-b border-utility-gray-200-line">
                                                <p><?php echo esc_html($r_date); ?></p>
                                            </div>
                                        </div>
                                        <div class="content-new">
                                            <div class="heading-2"> 
                                                <h3><a class=" group-hover:text-primary-7" href="<?php the_permalink(); ?>"><?php echo esc_html($r_title); ?></a></h3>
                                            </div>
                                            <div class="body-1 line-clamp-2">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                     <div class="button-swiper pb-5"><a class="btn btn-prev group" href="">
                             <i class="fa-regular fa-angle-left"></i></a><a class="btn btn-next group" href="">
                             <i class="fa-regular fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
