<?php
// Home About Module (ACF: layout_home_about)
// UI Source: UI/home.html .section-home-1

$content_desc = get_sub_field('description');
$link_arr = get_sub_field('link');
$main_image_arr = get_sub_field('main_image');
$gallery_images = get_sub_field('gallery');

$link_url = isset($link_arr['url']) ? $link_arr['url'] : '';
$link_title = isset($link_arr['title']) ? $link_arr['title'] : 'Về chúng tôi';
$link_target = isset($link_arr['target']) ? $link_arr['target'] : '_self';

$main_img_url = isset($main_image_arr['url']) ? $main_image_arr['url'] : '';
?>
<section class="section-home-1 bg-transparent overflow-hidden">
    <div class="section-px section-py">
        <div class="flex gap-base -lg:flex-col">
            <div class="block-home-left w-[calc(560/1920*100rem)]  -lg:w-full" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                <div class="main-content-left">
                    <div class="content-img-top">
                        <?php if($content_desc): ?>
                        <div class="body-1"> 
                            <?php echo wp_kses_post($content_desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if($link_url): ?>
                    <div class="content-img-botom">
                        <div class="heading-2 text-center">
                            <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($main_img_url): ?>
                    <a class="img img-ratio ratio:pt-[780_560]  zoom-img rounded-4 relative " href="<?php echo esc_url($main_img_url); ?>" data-fancybox>
                        <img class="lozad" data-src="<?php echo esc_url($main_img_url); ?>" alt="<?php echo esc_attr($link_title); ?>"/>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="block-home-left w-[calc(1160/1920*100rem)] relative -lg:w-full">
                <div class="swiper-column-auto auto-1-column">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?php 
                            // The UI shows a grid of 4 images inside each Slide.
                            // If we have many images, we need to chunk them into groups of 4.
                            if($gallery_images && is_array($gallery_images)):
                                $chunks = array_chunk($gallery_images, 4);
                                foreach($chunks as $chunk):
                            ?>
                            <div class="swiper-slide">
                                <div class="grid grid-cols-2 gap-base -md:grid-cols-1">
                                    <?php foreach($chunk as $g_item): 
                                        $g_url = $g_item['url'];
                                        $g_alt = $g_item['alt'];
                                    ?>
                                    <div class="relative" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                                        <?php if($link_url): ?>
                                        <div class="content-img-botom">
                                            <div class="heading-2 text-center">
                                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <a class="img img-ratio ratio:pt-[370_560] zoom-img rounded-4 relative " href="<?php echo esc_url($g_url); ?>" data-fancybox="gallery-home"> 
                                            <img class="lozad" data-src="<?php echo esc_url($g_url); ?>" alt="<?php echo esc_attr($g_alt); ?>"/>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php 
                                endforeach; 
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="button-swiper">
                        <a class="btn btn-next group" href=""> <i class="fa-regular fa-angle-right"></i></a>
                        <a class="btn btn-prev group" href=""> <i class="fa-regular fa-angle-left"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
