<?php
// Modules/Common/Banner-basic.php
$obj = get_queried_object();
$banner_source_id = 0; 

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
        $banner_post = $valid_banners[0];
        $b_id = $banner_post->ID;
        $img_arr = get_field('image_source', $b_id);
        $img_url = '';
        
        if ($img_arr) {
            $img_url = $img_arr['url'];
        } elseif (has_post_thumbnail($b_id)) {
            $img_url = get_the_post_thumbnail_url($b_id, 'full');
        }
?>
<section class="section-page-backgroud"> 
				<div class="img img img-ratio ratio:pt-[656_1920]">
                    <img class="lozad" data-src="<?php echo esc_url($img_url); ?>" alt=""/>
				</div>
			</section>
<?php endif; ?>
<?php endif; ?>