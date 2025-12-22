<?php
// About Vision Mission (ACF: layout_about_vision_mission)
// UI Source: UI/gioi-thieu.html .section-about-2

$vision_icon = get_sub_field('vision_icon');
$vision_title = get_sub_field('vision_title');
$vision_desc = get_sub_field('vision_description');

$mission_icon = get_sub_field('mission_icon');
$mission_title = get_sub_field('mission_title');
$mission_desc = get_sub_field('mission_description');

$image_arr = get_sub_field('image');
$image_url = is_array($image_arr) ? $image_arr['url'] : '';
?>
<section class="section-about-2"> 
    <div class="section-px">
        <div class="bg-utility-gray-50 rounded-4">
            <div class="container">
                <div class="section-py">
                    <div class="grid grid-cols-2 gap-base -lg:grid-cols-1">
                        <div class="block-left"> 
                            
                            <!-- Vision -->
                            <div class="block-item-1">
                                <?php if($vision_icon): ?>
                                <div class="block-svg">
                                    <img class="lozad" data-src="<?php echo esc_url($vision_icon['url']); ?>" alt="<?php echo esc_attr($vision_icon['alt']); ?>"/>
                                </div>
                                <?php endif; ?>
                                <div class="block-content">
                                    <?php if($vision_title): ?>
                                    <div class="heading-1"> 
                                        <h2><?php echo esc_html($vision_title); ?></h2>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($vision_desc): ?>
                                    <div class="body-1">
                                        <?php echo wp_kses_post($vision_desc); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Mission -->
                            <div class="block-item-2">
                                <?php if($mission_icon): ?>
                                <div class="block-svg"> 
                                    <img class="lozad" data-src="<?php echo esc_url($mission_icon['url']); ?>" alt="<?php echo esc_attr($mission_icon['alt']); ?>"/>
                                </div>
                                <?php endif; ?>
                                <div class="block-content"> 
                                    <?php if($mission_title): ?>
                                    <div class="heading-1"> 
                                        <h2><?php echo esc_html($mission_title); ?></h2>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($mission_desc): ?>
                                    <div class="body-1">
                                        <?php echo wp_kses_post($mission_desc); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                        <?php if($image_url): ?>
                        <div class="block-right"> 
                            <a class="img img-ratio ratio:pt-[616_680] rounded-4 zoom-img" href="">
                                <img class="lozad" data-src="<?php echo esc_url($image_url); ?>" alt="Vision Mission"/>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
