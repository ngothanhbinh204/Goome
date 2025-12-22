<?php
// About Awards (ACF: layout_about_awards)
// UI Source: UI/gioi-thieu.html .section-about-6
// Note: UI has complex swiper structure. 
// For now, implementing basic structure mapping to attributes provided.
// ACF Structure: title, subtitle, description, awards (repeater of images)

$title  = get_sub_field('title');
$sub    = get_sub_field('subtitle');
$desc   = get_sub_field('description');
$images = get_sub_field('awards'); // Repeater of images (or Gallery?) - JSON said Repeater with 'image' sub_field.
?>
<section class="section-about-6"> 
    <div class="section-px">
        <div class="bg-about-6  rounded-4 -sm:overflow-hidden" setBackground="<?php echo get_template_directory_uri(); ?>/dist/img/about-6.png">
            <div class="container relative z-1">
                <div class="section-py"> 
                    <div class="grid grid-cols-2 -lg:grid-cols-1 gap-base">
                        <div class="block-left">
                            <div class="section-detailPrd  relative flex xl:gap-20 -lg:flex-col gap-base ">
                                <div class="detailPrd-banner flex w-full -lg:flex-col-reverse   -lg:gap-4">                              
                                    <!-- Implement Swiper Logic Here if Images exist -->
                                    <?php if($images): ?>
                                    <!-- Thumbnail Slider -->
                                    <div class="product-banner-pagination w-[calc((153/593)*100%)] -lg:w-full -lg:pr-0 pr-8">
                                        <div class="flex-1 relative w-full h-full ">
                                            <div class="swiper swiper-detail-product-thumb lg:absolute xl:left-0 xl:top-0 w-full h-full " thumbsSlider="">
                                                <div class="swiper-wrapper">
                                                    <?php foreach($images as $item): 
                                                        $img = $item['image'];
                                                    ?>
                                                    <div class="swiper-slide cursor-pointer select-none rounded-4">
                                                        <div class="img h-full img-ratio ratio:pt-[1_1] rounded-4"> 
                                                            <img class="lozad hover:scale-115 transition-500" data-src="<?php echo esc_url($img['url']); ?>" alt=""/>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="swiper-scrollbar"></div>
                                        </div>
                                    </div>
                                    
                                    <!-- Main Slider -->
                                    <div class="product-banner-main relative w-[calc((440/593)*100%)]  -lg:w-full">
                                        <div class="swiper swiper-detail-product">
                                            <div class="swiper-wrapper">
                                                 <?php foreach($images as $item): 
                                                    $img = $item['image'];
                                                 ?>
                                                <div class="swiper-slide overflow-hidden rounded-4">
                                                    <a class="h-full group img-ratio ratio:pt-[550_440] -lg:ratio:pt-[1_2]" href="<?php echo esc_url($img['url']); ?>" data-fancybox="gallery"> 
                                                        <img class="lozad group-hover:scale-115 transition-500" data-src="<?php echo esc_url($img['url']); ?>" alt=""/>
                                                    </a>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="block-right"> 
                            <!-- Right Content Slider (Usually syncs with left, but here seemingly simpler or static text?)
                                 UI shows a swiper for text too. For simplicity, we might just show the text fields 
                                 or if the text needs to slide with images, the ACF structure would need to match (Repeater of Image + Text).
                                 Currently JSON: Title, Subtitle, Description are top level. Awards is just Image list.
                                 So we assume Text is static/single, and Images slide.
                            -->
                            <div class="block-big">
                                <div class="title-top"> 
                                    <?php if($title): ?>
                                    <div class="heading-1">
                                        <h2><?php echo esc_html($title); ?></h2>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="sup-title"> 
                                    <?php if($sub): ?>
                                    <div class="heading-2"> 
                                        <h3><?php echo esc_html($sub); ?></h3>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($desc): ?>
                                    <div class="body-1 text-gray-800">
                                        <?php echo wp_kses_post($desc); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
