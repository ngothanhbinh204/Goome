<?php 
// Single Project Intro (ACF Group: project_intro)
// UI Source: UI/du-anDetail.html
// Section: .section-project-Detail-1

$intro_group = get_field('project_intro');
if ($intro_group):
    $title     = get_the_title();
    // Subtitle could be a custom field or Category
    $subtitle  = isset($intro_group['subtitle']) ? $intro_group['subtitle'] : ''; 
    $desc      = isset($intro_group['description']) ? $intro_group['description'] : '';
    $contact   = isset($intro_group['contact_text']) ? $intro_group['contact_text'] : '';
    $image     = isset($intro_group['image']) ? $intro_group['image'] : ''; // Array
    $image_url = is_array($image) ? $image['url'] : '';
?>
<section class="section-project-Detail-1"> 
    <div class="bg-project-detail-1"> 
        <div class="project-detail-1 flex -md:flex-col">
            <div class="block-left w-[calc(860/1920*100rem)]  -md:w-full">
                <div class="bg-utility-gray-50 w-full h-full flex items-center justify-end px-[13%] -lg:section-px -md:py-5">
                    <div class="block-left-content"> 
                        <div class="global-breadcrumb">
                             <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        </div>
                        <div class="left-content-item"> 
                            <div class="heading-1"> 
                                <h1><?php echo esc_html($title); ?></h1>
                            </div>
                            <?php if($subtitle): ?>
                            <div class="heading-6"> 
                                <h2><?php echo esc_html($subtitle); ?></h2>
                            </div>
                            <?php endif; ?>
                            <?php if($desc): ?>
                            <div class="body-1 text-utility-gray-800"> 
                                <?php echo wp_kses_post($desc); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <a class="btn-primary btn heading-4 flex gap-2 items-center" href="<?php echo esc_url(get_permalink(get_page_by_path('lien-he'))); ?>">
                            <i class="fa-solid fa-phone"></i>
                            <span><?php echo esc_html($contact ? $contact : 'Liên hệ ngay'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if($image_url): ?>
            <div class="blcok-rigth w-[calc(1060/1920*100rem)]  -md:w-full">
                <div class="img img-ratio ratio:pt-[596_1060] ">
                    <img class="lozad" data-src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>"/>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
