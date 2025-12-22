<?php
// About Org Chart (ACF: layout_about_org_chart)
// UI Source: UI/gioi-thieu.html .section-about-4

$title = get_sub_field('title');
$img = get_sub_field('image');
$img_url = is_array($img) ? $img['url'] : '';
?>
<section class="section-about-4"> 
    <div class="section-px">
        <div class="bg-utility-gray-50 rounded-4">
            <div class="container">
                <div class="section-py">
                    <div class="flex gap-20 flex-col -lg:gap-base">
                        <?php if($title): ?>
                        <div class="heading-1"> 
                            <h2><?php echo esc_html($title); ?></h2>
                        </div>
                        <?php endif; ?>
                        <?php if($img_url): ?>
                        <div class="img img-ratio ratio:pt-[1064_1400] ">
                            <img class="lozad" data-src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($title); ?>"/>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
