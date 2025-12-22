<?php
// Home Partners Module (ACF: layout_home_partners)
// UI Source: UI/home.html .section-home-4

$title = get_sub_field('title');
// Repeater: partners_logos [logo]
?>
<section class="section-home-4"> 
    <div class="section-px  section-py">
        <div class="bg-utility-gray-50 rounded-4">
            <div class="container">
                <div class="flex flex-col gap-base section-py">
                    <?php if($title): ?>
                    <div class="heading-1"> 
                        <h2><?php echo esc_html($title); ?></h2>
                    </div>
                    <?php endif; ?>

                    <?php if(have_rows('partners_logos')): ?>
                    <div class="swiper-column-auto auto-6-column relative" data-swiper-prev=".button-swiper .btn-prev" data-swiper-next=".button-swiper .btn-next">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php while(have_rows('partners_logos')): the_row(); 
                                    $logo = get_sub_field('logo');
                                ?>
                                <div class="swiper-slide">
                                    <div class="card-brand">
                                        <div class="img img img-ratio ratio:pt-[1_1] rounded-4 zoom-img border border-transparent duration-300 hover:border-primary-1">
                                            <?php if($logo): ?>
                                            <img class="lozad" data-src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>"/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="button-swiper pb-5">
                            <a class="btn btn-prev group" href=""> <i class="fa-regular fa-angle-left"></i></a>
                            <a class="btn btn-next group" href=""> <i class="fa-regular fa-angle-right"></i></a>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
