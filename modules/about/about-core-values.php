<?php
// About Core Values (ACF: layout_about_core_values)
// UI Source: UI/gioi-thieu.html .section-about-3

$title = get_sub_field('title');
// 'values' repeater -> icon, name
?>
<section class="section-about-3"> 
    <div class="section-px section-my">
        <div class="bg-utility-gray-50 rounded-4">
            <div class="container"> 
                <div class="flex flex-col gap-base section-py">
                    <?php if($title): ?>
                    <div class="heading-1"> 
                        <h1><?php echo esc_html($title); ?></h1>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(have_rows('values')): ?>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-base"> 
                        <?php while(have_rows('values')): the_row(); 
                            $icon = get_sub_field('icon');
                            $name = get_sub_field('name');
                        ?>
                        <div class="block-item-svg"> 
                            <?php if($icon): ?>
                            <div class="img">
                                <div class="img-ratio ratio:pt-[1.1] ">
                                    <img class="lozad" data-src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($name); ?>"/>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($name): ?>
                            <div class="heading-2"> 
                                <p><?php echo esc_html($name); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
