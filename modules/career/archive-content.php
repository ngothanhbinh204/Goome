<?php
/**
 * Module: Career Archive Content
 * Used by: page-career.php, archive-career.php
 * Expects:
 * - $args['archive_page_id'] (int)
 * - $args['query'] (WP_Query object)
 */

$archive_page_id = isset($args['archive_page_id']) ? $args['archive_page_id'] : 0;
$the_query       = isset($args['query']) ? $args['query'] : null;

// Get Intro Fields from 'career_page_intro'
$intro_group = get_field('career_page_intro', $archive_page_id);
$title       = isset($intro_group['title']) ? $intro_group['title'] : '';
$desc        = isset($intro_group['description']) ? $intro_group['description'] : '';
$decoration_image = isset($intro_group['decoration_image']) ? $intro_group['decoration_image'] : '';
$journey_image = isset($intro_group['journey_image']) ? $intro_group['journey_image'] : '';
// Fallbacks
if (!$title && $archive_page_id) {
    $title = get_the_title($archive_page_id);
}
?>

<section class="section-recruitment section-py !pb-10 relative">
    <div class="container">
        <div class="recruitment">
            <div class="recruitment-introduce w-full lg:w-1/2">
                <?php if ($title): ?>
                <h2 class="title heading-1"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if ($desc): ?>
                <div class="desc mt-5 text-body-1">
                    <?php echo wp_kses_post($desc); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <img class="absolute right-[8%] bottom-0 w-[120px] md:w-[180px] lg:rem:w-[361px] lg:rem:h-[274px]" src="<?php echo $decoration_image['url']; ?>" alt="decoration">
</section>

<section class="section-journey">
    <div class="journey relative">
        <div class="hero-img img-ratio ratio:pt-[760_1920]">
            <?php echo get_image_attrachment($journey_image, 'image'); ?>
        </div>
    </div>
</section>

<section class="section-career-opportunities section-py"> 
    <div class="container">
        <div class="career-opportunities flex flex-col gap-base"> 
            <h2 class="career-opportunities-title heading-1 text-center"><?php esc_html_e('Cơ hội nghề nghiệp', 'canhcamtheme'); ?></h2>
            
            <?php if ($the_query && $the_query->have_posts()): ?>
            <div class="block-job-tb">
                <table class="job-tb w-full">
                    <thead class="-md:hidden">
                        <tr class="row-title uppercase text-body-1 text-white bg-primary-1 ">
                            <th class="w-[calc(70/1600*100%)] font-normal p-1.5"><?php esc_html_e('STT', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(676/1600*100%)] font-normal text-left py-3 px-4 "><?php esc_html_e('Tiêu đề', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal text-left py-3 px-4 whitespace-nowrap"><?php esc_html_e('HẠN NỘP HỒ SƠ', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal text-left py-3 px-4"><?php esc_html_e('ĐỊA ĐIỂM', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal py-3 px-4"></th>
                        </tr>
                    </thead>
                    <tbody class="-md:flex -md:flex-col -md:gap-y-3">
                        <?php 
                        $i = 0;
                        while($the_query->have_posts()): $the_query->the_post(); 
                        $i++;
                        // ACF fields for Single Career usually have these details?
                        // 'career_detail' group -> 'info_attributes' repeater in single-career.json
                        // We need to fetch that here.
                        $detail_group = get_field('career_detail', get_the_ID());
                        $attributes = isset($detail_group['info_attributes']) ? $detail_group['info_attributes'] : [];
                        
                        // Extract specific attributes by label/key if possible, or just standard fields?
                        // UI shows: Expiration Date, Location.
                        // Assuming the repeater has these. We need to find them.
                        $exp_date = '';
                        $location = '';
                        
                        if ($attributes) {
                            foreach ($attributes as $attr) {
                                // Simple string matching or keys? 
                                // JSON check: keys are icon, label, value.
                                if (stripos($attr['label'], 'Hạn nộp') !== false || stripos($attr['label'], 'Expiration') !== false) {
                                    $exp_date = $attr['value'];
                                }
                                if (stripos($attr['label'], 'Địa điểm') !== false || stripos($attr['label'], 'Location') !== false) {
                                    $location = $attr['value'];
                                }
                            }
                        }
                        ?>
                        <tr class="row-job -md:grid -md:grid-cols-1 -md:p-2 text-body-1 -md:rounded-1 border border-utility-gray-10 bg-secondary-1 bg-opacity-[0.05]">
                            <td class="text-center -md:hidden"><?php echo sprintf('%02d', $i); ?></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:font-semibold"><?php the_title(); ?></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:order-3"><?php echo esc_html($exp_date); ?></td>
                            <td class="p-2 px-4 py-2 md:py-3"><?php echo esc_html($location); ?></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:order-4"> 
                                <div class="flex-center h-full -md:justify-start">
                                    <a class="flex items-center gap-x-2.5 text-utility-gray-500" href="<?php the_permalink(); ?>">   
                                        <span class="text-body-1"><?php esc_html_e('Ứng tuyển ngay', 'canhcamtheme'); ?></span>
                                        <i class="fa-light fa-angle-right text-base"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-center">
                 <?php 
                    /* Custom pagination or standard? UI shows "Tìm hiểu thêm" button? 
                       Actually UI shows a button "Tìm hiểu thêm" at bottom of table? 
                       Or is it pagination? "list-new" had pagination 1,2,3.
                       "career-opportunities" in html shows a button.
                       If 'Load More', we need ajax. If standard pagination, use numbers.
                       Let's stick to standard pagination if list is long.
                    */
                    if (function_exists('canhcam_pagination')) {
                        canhcam_pagination($the_query);
                    }
                 ?>
            </div>
            <?php else: ?>
                <p class="text-center"><?php esc_html_e('Hiện chưa có vị trí tuyển dụng nào.', 'canhcamtheme'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
