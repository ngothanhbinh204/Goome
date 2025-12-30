<?php
// About Awards (ACF: layout_about_awards)
// UI Source: UI/gioi-thieu.html .section-about-6

$awards = get_sub_field('awards'); 
$image_bgAward = get_sub_field('image_bg_award');
?>
<section class="section-about-6"> 
    <div class="section-px">
        <div class="bg-about-6  rounded-4 -sm:overflow-hidden" setBackground="<?php echo esc_url($image_bgAward['url']); ?>">
            <div class="container relative z-1">
                <div class="section-py"> 
                    <div class="grid grid-cols-2 -lg:grid-cols-1 gap-base">
                        <div class="block-left">
                            <div class="section-detailPrd  relative flex xl:gap-20 -lg:flex-col gap-base ">
                                <div class="detailPrd-banner flex w-full -lg:flex-col-reverse   -lg:gap-4">                              
                                    <?php if($awards): ?>
                                    <!-- Thumbnail Slider -->
                                    <div class="product-banner-pagination w-[calc((153/593)*100%)] -lg:w-full -lg:pr-0 pr-8">
                                        <div class="flex-1 relative w-full h-full ">
                                            <div class="swiper swiper-detail-product-thumb lg:absolute xl:left-0 xl:top-0 w-full h-full " thumbsSlider="">
                                                <div class="swiper-wrapper">
                                                    <?php foreach($awards as $item): 
                                                        $img = isset($item['image']) ? $item['image'] : '';
                                                        $img_url = isset($img['url']) ? $img['url'] : '';
                                                    ?>
                                                    <div class="swiper-slide cursor-pointer select-none rounded-4">
                                                        <div class="img h-full img-ratio ratio:pt-[1_1] rounded-4"> 
                                                            <img class="lozad hover:scale-115 transition-500" data-src="<?php echo esc_url($img_url); ?>" alt=""/>
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
                                                 <?php foreach($awards as $item): 
                                                    $img = isset($item['image']) ? $item['image'] : '';
                                                    $img_url = isset($img['url']) ? $img['url'] : '';
                                                 ?>
                                                <div class="swiper-slide overflow-hidden rounded-4">
                                                    <a class="h-full group img-ratio ratio:pt-[550_440] -lg:ratio:pt-[1_2]" href="<?php echo esc_url($img_url); ?>" data-fancybox="gallery"> 
                                                        <img class="lozad group-hover:scale-115 transition-500" data-src="<?php echo esc_url($img_url); ?>" alt=""/>
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
                            <div class="swiper-column-auto auto-1-column" data-swiper-prev=".button-swiper .btn-prev" data-swiper-next=".button-swiper .btn-next">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <?php if($awards): ?>
                                            <?php foreach($awards as $item): 
                                                $title = isset($item['title']) ? $item['title'] : '';
                                                $sub = isset($item['subtitle']) ? $item['subtitle'] : '';
                                                $desc = isset($item['description']) ? $item['description'] : '';
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="block-big">
                                                    <div class="title-top"> 
                                                        <div class="heading-1">
                                                            <h2><?php echo esc_html($title); ?></h2>
                                                        </div>
                                                    </div>
                                                    <div class="sup-title"> 
                                                        <div class="heading-2"> 
                                                            <h3><?php echo wp_kses_post($sub); ?></h3>
                                                        </div>
                                                        <div class="body-1 text-gray-800">
                                                            <p><?php echo wp_kses_post($desc); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="button-swiper">
                                    <a class="btn btn-prev group" href=""> <i class="fa-regular fa-angle-left"></i></a>
                                    <a class="btn btn-next group" href=""> <i class="fa-regular fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
