<?php
// Contact Info Module
// UI: UI/lien-he.html .section-contact

$group = get_field('contact_info');
if ($group) {
    $form_title = isset($group['form_title']) ? $group['form_title'] : '';
    $form_desc = isset($group['form_description']) ? $group['form_description'] : '';
    $form_shortcode = isset($group['form_shortcode']) ? $group['form_shortcode'] : '';
    $form_img = isset($group['form_image']) ? $group['form_image'] : '';
    
    $company_name = isset($group['company_name']) ? $group['company_name'] : '';
    $details = isset($group['contact_details']) ? $group['contact_details'] : [];
    
    $map_img = isset($group['map_image']) ? $group['map_image'] : '';
} else {
    // Fallback or empty init
    $form_title = ''; $form_desc = ''; $form_shortcode = ''; $form_img = '';
    $company_name = ''; $details = []; $map_img = '';
}
?>
<section class="section-contact section-py">
    <div class="container">
        <div class="contact flex -lg:flex-col-reverse -lg:gap-base">
            <div class="block-contact-form w-full lg:w-7/12 xl:w-[calc(1121/1600*100%)] lg:pr-8">
                <?php if($form_title): ?>
                <h1 class="contact-title heading-1"><?php echo esc_html($form_title); ?></h1>
                <?php endif; ?>
                
                <div class="form-contact">
                    <div class="subtitle text-body-1 mt-6">
                        <?php if($form_desc): ?>
                        <p><?php echo wp_kses_post($form_desc); ?></p>
                        <?php endif; ?>
                        
                        <!-- Form Shortcode Output -->
                        <div class="wrap-inp mt-5">
                            <?php 
                            if ($form_shortcode) {
                                echo do_shortcode($form_shortcode);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-action flex sm:items-center gap-5 -sm:flex-col sm:justify-between mt-6"> 
                    <?php if($form_img): ?>
                    <div class="img-robot"> 
                        <img class="lozad max-w-full" data-src="<?php echo esc_url($form_img['url']); ?>" alt="Decoration"/>
                    </div>
                    <?php endif; ?>
                    <!-- Submit button is usually part of the form shortcode, but if UI has it separate, we might need to hide the CF7 one and use this, or style the CF7 one. 
                         The UI puts it here inside 'form-action'. CF7 usually renders it inside the form. 
                         For now, assuming the shortcode renders the inputs and the submit button is properly styled via CSS targeting the CF7 output. 
                         The UI HTML shows the button *outside* the inputs wrapper but *inside* form-action. 
                         If the shortcode covers the whole form, this might be tricky. 
                         For safety, we assume the shortcode does the Heavy Lifting.
                    -->
                </div>
            </div>
            
            <div class="block-contact-info w-full lg:w-5/12 xl:w-[calc(480/1600*100%)]">
                <div class="contact-info p-10 rounded-lg bg-primary-1">
                    <?php if($company_name): ?>
                    <h2 class="contact-info-title heading-2 text-white"><?php echo esc_html($company_name); ?></h2>
                    <?php endif; ?>
                    
                    <?php if($details): ?>
                    <ul class="contact-info-list mt-6 flex flex-col gap-y-3">
                        <?php foreach($details as $item): 
                            $icon_class = $item['icon_class'];
                            $d_title = $item['title'];
                            $d_content = $item['content'];
                            $d_link = $item['link'];
                        ?>
                        <li class="contact-info-item flex gap-x-2">
                            <?php if($icon_class): ?>
                            <div class="icon text-lg text-primary-7">
                                 <i class="<?php echo esc_attr($icon_class); ?>"></i>
                            </div>
                            <span class="text-base text-primary-7">|</span>
                            <?php endif; ?>
                            
                            <div class="block-content text-white">
                                <?php if($d_title): ?>
                                <span class="title text-body-1 font-bold"><?php echo esc_html($d_title); ?>:</span>
                                <?php endif; ?>
                                
                                <?php if($d_link): ?>
                                    <a class="content text-body-1 mt-3 block break-all" href="<?php echo esc_url($d_link); ?>"><?php echo esc_html($d_content); ?></a>
                                <?php else: ?>
                                    <p class="content text-body-1 mt-3"><?php echo wp_kses_post($d_content); ?></p>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if($map_img): ?>
        <div class="contact-map mt-16">
            <!-- If using image map -->
            <div class="block-map img-ratio ratio:pt-[560_1600]">
                <img class="lozad" data-src="<?php echo esc_url($map_img['url']); ?>" alt="Map"/>
            </div>
        </div>
        <?php endif; ?>
        
    </div>
</section>
