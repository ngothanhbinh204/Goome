<?php
// Modules/Common/Banner.php
// Logic: Resolved $banner_id -> Fetch Post Objects -> Render Swiper Slides

// 1. Resolve Banner Source ID (KEEP LOGIC INTACT)
$obj = get_queried_object();
$banner_source_id = 0; // The ID of the Post/Page to fetch 'banner_select_page' from

if (is_page()) {
    $banner_source_id = get_the_ID();
} elseif (is_singular('project') || is_singular('career')) {
    $id = get_the_ID();
    $banner_source_id = get_field('banner_select_page', $id) ? $id : goome_get_archive_page_id(get_post_type());
} elseif (is_singular('post')) {
    $id = get_the_ID();
    $banner_source_id = get_field('banner_select_page', $id) ? $id : goome_get_archive_page_id('post');
} elseif (is_tax() || is_category() || is_tag()) {
    $term_id = $obj->term_id ?? 0;
    $taxonomy = $obj->taxonomy ?? '';
    $full_id = $taxonomy . '_' . $term_id;
    
    if (get_field('banner_select_page', $full_id)) {
        $banner_source_id = $full_id;
    } else {
        if ($taxonomy == 'project_cat') {
            $banner_source_id = goome_get_archive_page_id('project');
        } elseif ($taxonomy == 'category' || $taxonomy == 'post_tag') {
            $banner_source_id = goome_get_archive_page_id('post');
        } else {
             $banner_source_id = goome_get_archive_page_id('post'); 
        }
    }
} elseif (is_post_type_archive()) {
    $key = isset($obj->name) ? $obj->name : get_post_type();
    $banner_source_id = goome_get_archive_page_id($key);
} elseif (is_home()) {
    $banner_source_id = goome_get_archive_page_id('post');
} else {
    $banner_source_id = get_the_ID();
}

// 2. Fetch Selected Banners (Array of WP_Post objects)
$selected_banners = get_field('banner_select_page', $banner_source_id);

// 3. Render
?>

<?php if ($selected_banners && is_array($selected_banners)): 
    // Filter valid posts first to get accurate count
    $valid_banners = [];
    foreach ($selected_banners as $p) {
        if ($p instanceof WP_Post) {
            $valid_banners[] = $p;
        }
    }
    $banner_count = count($valid_banners);

    if ($banner_count > 0):
?>
<section class="page-banner-main section-home-banner">
    <?php if ($banner_count > 1): ?>
    <div class="swiper">
        <div class="swiper-wrapper">
    <?php else: ?>
    <div class="banner-static relative w-full h-full">
    <?php endif; ?>

            <?php foreach ($valid_banners as $banner_post): 
                $b_id = $banner_post->ID;
                $title = get_the_title($b_id); // Default Title from Post Title
                
                // Get Fields from Banner CPT
                $subtitle = get_field('subtitle', $b_id);
                $banner_content = get_field('banner_content', $b_id);
                $media_type = get_field('media_type', $b_id);
                $link_arr = get_field('link', $b_id);

                if($banner_content){
                    $title = $banner_content;
                }
                
                // Media Logic
                $slide_html = '';
                
                if ($media_type === 'video') {
                    $vid_url = get_field('video_source', $b_id);
                    $poster = get_field('video_poster', $b_id);
                    if ($vid_url) {
                        $slide_html = '<video class="w-full object-cover" src="'.esc_url($vid_url).'" muted playsinline preload="metadata" ' . ($poster ? 'poster="'.esc_url($poster).'"' : '') . ' autoplay loop></video>'; 
                    }
                } else {
                    // Default to Image
                    // Use ACF Image Source if set, fallback to Featured Image
                    $img_arr = get_field('image_source', $b_id);
                    $img_url = '';
                    if ($img_arr) {
                        $img_url = $img_arr['url'];
                    } elseif (has_post_thumbnail($b_id)) {
                        $img_url = get_the_post_thumbnail_url($b_id, 'full');
                    }
                    
                    if ($img_url) {
                            $slide_html = '<img class="lozad" data-src="'.esc_url($img_url).'" alt="'.esc_attr($title).'"/>';
                    }
                }
            ?>
            <div class="<?php echo ($banner_count > 1) ? 'swiper-slide' : 'relative w-full h-full'; ?>">
                <!-- Ratio Container matches UI: xl:ratio:pt-[960_1920] etc -->
                <div class="img img-ratio xl:ratio:pt-[960_1920] md:ratio:pt-[1_1] ratio:pt-[15_10]"> 
                    <?php echo $slide_html; ?>
                </div>

                <!-- Content Overlay -->
                <?php if ($title || $subtitle): ?>
                <div class="absolute left-20 -xl:left-10 -lg:left-5 z-10 bottom-[10%] text-white flex flex-col gap-5"> 
                    <?php if ($subtitle): ?>
                    <div class="body-4 font-bold"> 
                        <p><?php echo wp_kses_post($subtitle); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($title): ?>
                    <div class="heading-1">
                        <h1><?php echo wp_kses_post($title); ?></h1>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

    <?php if ($banner_count > 1): ?>
        </div>
        <!-- Pagination if > 1 slide -->
        <div class="swiper-pagination"></div>
    </div>
    <?php else: ?>
    </div>
    <?php endif; ?>
</section>
<?php endif; ?>
<?php endif; ?>