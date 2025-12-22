<?php
// Home Projects Module (ACF: layout_home_projects)
// UI Source: UI/home.html .section-home-2
// Variables provided by template: $projects_data (Array of ['term' => WP_Term, 'query' => WP_Query])

$title = get_sub_field('title');
?>
<section class="section-home-2 overflow-hidden"> 
    <div class="section-px section-py -sm:pt-0">
        <div class="home-2-gird" data-toggle="tabslet-hover"> 
            
            <?php if($title): ?>
            <div class="heading-1 mb-base xl:hidden">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
            <?php endif; ?>

            <div class="wrap">
                <?php if($title): ?>
                <div class="heading-1 mb-10  hidden xl:block">
                    <h2><?php echo esc_html($title); ?></h2>
                </div>
                <?php endif; ?>

                <ul class="tabslet-tab">
                    <?php 
                    if (!empty($projects_data)):
                        foreach ($projects_data as $index => $data):
                            $term = $data['term'];
                            $query = $data['query'];
                            $tab_id = 'tab-term-' . $term->term_id;
                            $term_link = get_term_link($term);
                    ?>
                    <li data-aos="fade-right" data-aos-delay="<?php echo 250 + ($index * 50); ?>">
                        <a href="#<?php echo esc_attr($tab_id); ?>"> 
                            <div class="heading-2">
                                <h3><?php echo esc_html($term->name); ?></h3>
                            </div>
                        </a>
                        <div class="content-hiden">
                            <div class="body-1">
                                <p><?php echo wp_kses_post(term_description($term->term_id)); ?></p>
                            </div>
                            <a class="heading-5 text-gray-500 font-medium flex gap-4 items-center pb-3 " href="<?php echo esc_url($term_link); ?>"> 
                                <span>Xem chi tiết </span><i class="fa-regular fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                    <?php 
                        endforeach; 
                    endif;
                    ?>
                </ul>
            </div>
            
            <!-- Tab Contents (Images) -->
            <?php 
            if (!empty($projects_data)):
                foreach ($projects_data as $index => $data):
                    $term = $data['term'];
                    $query = $data['query'];
                    $tab_id = 'tab-term-' . $term->term_id; // Match href above
                    
                    // The UI shows ONE main image for the tab content in the 'img' tag.
                    // But actually, it seems the UI structure uses 'img' tag with 'id' matching the tab href!
                    // Wait, UI: <a class="img... tabslet-content" id="tab1" href="large-img"> <img ...> </a>
                    // So for each tab, we render ONE Featured Project Image.
                    
                    if ($query->have_posts()):
                        $query->the_post(); // Get first post
                        $thumb = get_post_thumbnail_id();
                        $thumb_url = wp_get_attachment_image_url($thumb, 'full'); // Use large size
                        $project_link = get_permalink();
                        
                        if($thumb_url):
            ?>
            <a class="img img-ratio ratio:pt-[861_780] -lg:ratio:pt-[] rounded-4 tabslet-content -lg:order-1 " href="<?php echo esc_url($project_link); ?>" id="<?php echo esc_attr($tab_id); ?>">
                <img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
            </a>
            <?php 
                        endif;
                        wp_reset_postdata(); // Reset needed? We only took one. Yes safety.
                    endif;
                endforeach;
            endif;
            ?>

        </div>
    </div>
</section>
