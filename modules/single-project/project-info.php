<?php
// Single Project Info & Solution (ACF Group: project_info)
// UI Source: UI/du-anDetail.html
// Section: .section-project-Detail-2

$info_group = get_field('project_info');
if ($info_group):
    $attributes = isset($info_group['attributes']) ? $info_group['attributes'] : [];
    $sol_title  = isset($info_group['solution_title']) ? $info_group['solution_title'] : '';
    $sol_content= isset($info_group['solution_content']) ? $info_group['solution_content'] : '';
?>
<section class="section-project-Detail-2">
    <div class="container">
        <div class="project-Detail-2 flex gap-base -md:flex-col">
            <?php if(!empty($attributes)): ?>
            <div class="block-left w-[calc(560/1440*100rem)] -md:w-full"> 
                <?php foreach($attributes as $attr): ?>
                <div class="left-item"> 
                    <?php if(!empty($attr['icon'])): ?>
                    <div class="item-icon">
                        <?php echo $attr['icon']; ?>
                    </div>
                    <?php endif; ?>
                    <div class="content-item"> 
                        <div class="body-2"> 
                            <p><?php echo esc_html($attr['label']); ?></p>
                        </div>
                        <div class="body-1 font-bold">
                            <p><?php echo wp_kses_post($attr['value']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="block-right w-[calc(800/1440*100rem)]  -md:w-full">
                <?php if($sol_title): ?>
                <div class="heading-6 text-primary-7"> 
                    <h3><?php echo esc_html($sol_title); ?></h3>
                </div>
                <?php endif; ?>
                <?php if($sol_content): ?>
                <div class="format-content body-1 text-utility-gray-800 flex flex-col gap-6">
                    <?php echo wp_kses_post($sol_content); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
