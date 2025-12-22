<?php
// Single Project Gallery (ACF Group: project_gallery)
// UI Source: UI/du-anDetail.html
// Section: .section-project-Detail-3

$gallery_group = get_field('project_gallery');
if ($gallery_group):
    $images = isset($gallery_group['images']) ? $gallery_group['images'] : [];
    if ($images):
?>
<section class="section-project-Detail-3"> 
    <div class="swiper-detail swiper reative overflow-hidden">
        <div class="swiper-wrapper">
            <?php foreach($images as $img): ?>
            <div class="swiper-slide flex justify-center transition-all duration-500">
                <a class="w-full " href="<?php echo esc_url($img['url']); ?>" data-fancybox="gallery">
                    <div class="slide-item relative overflow-hidden img-ratio ratio:pt-[652_1160] rem:max-h-[652px] rounded-4 ">
                        <img class=" object-cover " src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>">
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="flex-center -lg:mt-base">
            <div class="btn-detail btn-prev-detail">
                <a class="btn btn-prev group" href=""> <i class="fa-regular fa-angle-left"></i></a>
            </div>
            <div class="btn-detail btn-next-detail">
                <a class="btn btn-next group" href=""> <i class="fa-regular fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</section>
<?php 
    endif; 
endif; 
?>
