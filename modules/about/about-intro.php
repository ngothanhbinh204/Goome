<?php
// About Intro (ACF: layout_about_intro)
// UI Source: UI/gioi-thieu.html .section-about-1
$title = get_sub_field('title');
$desc = get_sub_field('description');
$bg_image_arr = get_sub_field('image_bg');
$bg_image_url = is_array($bg_image_arr) ? $bg_image_arr['url'] : '';
?>
<section class="section-about-1"> 
    <div class="section-py">
        <div class="container">
            <div class="relative">
                <div class="block-content">
                    <?php if($title): ?>
                    <div class="heading-1"> 
                        <h1><?php echo esc_html($title); ?></h1>
                    </div>
                    <?php endif; ?>
                    <?php if($desc): ?>
                    <div class="body-1"> 
                        <?php echo wp_kses_post($desc); ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($bg_image_url): ?>
                <div class="block-logo-bg"> 
                    <div class="img img-ratio ratio:pt-[202_1165] ">
                        <img class="lozad" data-src="<?php echo esc_url($bg_image_url); ?>" alt="Background Decoration"/>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
