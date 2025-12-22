<?php
// Home News Module (ACF: layout_home_news)
// UI Source: UI/home.html .section-home-3
// Variables provided by template: $news_query

$title = get_sub_field('title');
$btn_label = get_sub_field('button_label');
$btn_link = get_sub_field('button_link');
$btn_url = isset($btn_link['url']) ? $btn_link['url'] : '';
$btn_target = isset($btn_link['target']) ? $btn_link['target'] : '_self';
?>
<section class="section-home-3">
    <div class="section-px">
        <div class="bg-utility-gray-50 rounded-4 relative">
            <div class="container">
                <div class="flex flex-col gap-base section-py">
                    <?php if($title): ?>
                    <div class="heading-1"> 
                        <h2><?php echo esc_html($title); ?></h2>
                    </div>
                    <?php endif; ?>

                    <?php if(isset($news_query) && $news_query->have_posts()): ?>
                    <div class="swiper-column-auto auto-3-column-custom" data-swiper-prev=".button-swiper .btn-prev" data-swiper-next=".button-swiper .btn-next">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <?php while($news_query->have_posts()): $news_query->the_post(); 
                                    $thumb = get_post_thumbnail_id();
                                    $thumb_url = wp_get_attachment_image_url($thumb, 'large');
                                ?>
                                <div class="swiper-slide">
                                    <div class="card-new card-new flex flex-col gap-6 group" data-aos="fade-up" data-aos-duration="2000"> 
                                        <a class="img img-ratio ratio:pt-[340_440] group rounded-4 zoom-img" href="<?php the_permalink(); ?>">
                                            <?php if($thumb_url): ?>
                                            <img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>"/>
                                            <?php endif; ?>
                                        </a>
                                        <div class="new-content">
                                            <div class="date body-2 pb-2 border-b border-utility-gray-200-line">
                                                <p><?php echo get_the_date('d/m/Y'); ?></p>
                                            </div>
                                        </div>
                                        <div class="content-new">
                                            <div class="heading-2"> 
                                                <h3><a class=" group-hover:text-primary-7" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            </div>
                                            <div class="body-1 line-clamp-2">
                                                <p><?php echo get_the_excerpt(); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($btn_url): ?>
                    <div class="flex-center">
                        <a class="btn-primary btn uppercase" href="<?php echo esc_url($btn_url); ?>" target="<?php echo esc_attr($btn_target); ?>">
                            <span><?php echo esc_html($btn_label); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
            
            <div class="button-swiper pb-5">
                <a class="btn btn-prev group" href=""> <i class="fa-regular fa-angle-left"></i></a>
                <a class="btn btn-next group" href=""> <i class="fa-regular fa-angle-right"></i></a>
            </div>

        </div>
    </div>
</section>
