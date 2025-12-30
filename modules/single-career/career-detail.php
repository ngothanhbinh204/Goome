<?php 
// Single Career Detail (ACF: career_detail)
// UI Source: UI/tuyen-dungDetail.html

$title = get_the_title();
$group_detail = get_field('career_detail');
$content      = isset($group_detail['content']) ? $group_detail['content'] : '';
$attributes   = isset($group_detail['info_attributes']) ? $group_detail['info_attributes'] : [];

// Separate Attributes into specific UI buckets if needed, or loops?
// UI Right Sidebar: "Information" -> Expiration, Salary, Gender, Experience.
?>
<div class="space-header pt-[var(--header-height)]"></div>
<section class="section-recruitment-detail section-py">
    <div class="container">   
        <div class="recruitment-detail grid grid-cols-12 gap-base">
            <div class="block-main-content relative col-span-full lg:col-span-8">
                <h1 class="detail-title heading-3 pb-4 border-b border-utility-gray-200"><?php echo esc_html($title); ?></h1>
                
                <?php if ($content): ?>
                <div class="main-detail-content mt-6 flex flex-col gap-base">
                    <?php echo wp_kses_post($content); ?>
                </div>
                <?php endif; ?>

                <div class="social xl:absolute xl:right-full xl:top-0 -xl:mt-4 xl:mr-4.5 xl:h-full">
                    <ul class="social-list sticky rem:top-[calc(var(--header-height)+12px)]">
                        <li class="social-item"> 
                            <a class="flex-center w-10 h-10 bg-primary-1 text-base text-white rounded-full" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="recruitment-detail-action col-span-full lg:col-span-4">
                <div class="sticky top-[var(--header-height)]">
                    <?php if (!empty($attributes)): ?>
                    <div class="block-apply p-8 bg-gray-400 text-white rounded-4">
                        <h2 class="apply-title heading-2 text-white"><?php esc_html_e('Information', 'canhcamtheme'); ?></h2>
                        <ul class="apply-list">
                            <?php foreach($attributes as $attr): ?>
                            <li class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30"> 
                                <?php if (!empty($attr['icon'])): ?>
                               <span class="icon w-10 h-auto">
                                    <?php
                                    $icon_svg   = $attr['icon'] ?? '';
                                    $icon_image = $attr['icon_image'] ?? null;

                                    if (!empty($icon_svg)) {
                                        echo wp_kses(
                                            $icon_svg,
                                            [
                                                'svg'   => [
                                                    'xmlns'       => true,
                                                    'viewBox'     => true,
                                                    'width'       => true,
                                                    'height'      => true,
                                                    'fill'        => true,
                                                    'class'       => true,
                                                    'aria-hidden' => true,
                                                    'role'        => true,
                                                ],
                                                'path'  => [
                                                    'd'     => true,
                                                    'fill'  => true,
                                                    'class' => true,
                                                ],
                                                'g'     => ['fill' => true, 'class' => true],
                                                'title' => [],
                                            ]
                                        );
                                    } elseif (!empty($icon_image) && !empty($icon_image['url'])) {
                                        ?>
                                        <img
                                            src="<?php echo esc_url($icon_image['url']); ?>"
                                            alt="<?php echo esc_attr($icon_image['alt'] ?? ''); ?>"
                                            loading="lazy"
                                        >
                                        <?php
                                    }
                                    ?>
                                </span>

                                <?php endif; ?>
                                <div class="block-content flex flex-col gap-y-1">
                                    <span class="top-content text-body-3"><?php echo esc_html($attr['label']); ?></span>
                                    <span class="bottom-content text-body-1"><?php echo esc_html($attr['value']); ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <button class="btn w-full px-6 py-3.5 mt-3 text-body-1 text-primary-1 bg-white " id="apply-now-btn"><?php esc_html_e('Ứng tuyển ngay', 'canhcamtheme'); ?></button>
                    </div>
                    <?php endif; ?>

                    <!-- Similar Jobs (Related Query) -->
                    <?php 
                    $related_args = [
                        'post_type' => 'career',
                        'posts_per_page' => 5,
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'date'
                    ];
                    $related = new WP_Query($related_args);
                    if ($related->have_posts()):
                    ?>
                    <div class="block-similar-jobs p-5 shadow-[4px_4px_32px_16px_rgba(0,0,0,0.08)] mt-base rounded-4">
                        <h2 class="similar-jobs-title heading-2"><?php esc_html_e('Similar Jobs', 'canhcamtheme'); ?></h2>
                        <ul class="similar-jobs-list"> 
                            <?php while($related->have_posts()): $related->the_post(); 
                                // Fetch date again if stored in ACF
                                $rel_group = get_field('career_detail');
                                $rel_date = '';
                                if(isset($rel_group['info_attributes'])) {
                                    foreach($rel_group['info_attributes'] as $ra) {
                                         if (stripos($ra['label'], 'Hạn nộp') !== false || stripos($ra['label'], 'Expiration') !== false) {
                                            $rel_date = $ra['value'];
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <li class="similar-jobs-item group py-5 border-b border-utility-gray-100">
                                <?php if($rel_date): ?>
                                <span class="date text-body-2 text-utility-gray-500"><?php echo esc_html($rel_date); ?></span>
                                <?php endif; ?>
                                <h3 class="title heading-4 mt-2.5 line-clamp-2 transition-300 group-hover:text-primary-1">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                            </li>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popup Overlay (Static/Form) - Kept from UI -->
<div class="popup-overlay fixed inset-0 bg-black/50 z-[1000] opacity-0 invisible transition-all duration-300 ease-in-out"></div>
<div class="fixed z-[1001] w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-all duration-300 ease-in-out opacity-0 invisible scale-95" id="popup-applyNow">
    <div class="container relative"> 
        <div class="wrap-popup-applyNow absolute-center w-[calc(100%-30px)] md:w-[calc(1026/1600*100%)] flex flex-col gap-y-4 p-5 -md:pt-7 rounded-4 md:p-10 bg-white mx-auto">
            <div class="btn-close absolute right-1 top-2 flex-center w-7 h-7 md:w-10 md:h-10 bg-primary-1 text-base md:text-xl rounded-full text-white cursor-pointer"><i class="fa-light fa-xmark"></i></div>
            <span class="popup-applyNow-title heading-3 -md:heading-4"><?php the_title(); ?></span>
            <p class="subtitle text-body-1"><?php esc_html_e('Contact us for more information and be a part of the wonderful journey', 'canhcamtheme'); ?></p>
            
            <form class="form-register-applyNow" action="" method="post" enctype="multipart/form-data"> 
                 <!-- Note: Form implementation requires backend handling (CF7 or custom). Leaving structure. -->
                <div class="top-inp grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="block-inp"> 
                        <input class="style-inp" type="text" name="first_name" placeholder="First name"/>
                    </div>
                    <div class="block-inp"> 
                        <input class="style-inp" type="text" name="last_name" placeholder="Last name"/>
                    </div>
                    <div class="block-inp"> 
                        <input class="style-inp" type="email" name="email" placeholder="Email*" required="required"/>
                    </div>
                    <div class="block-inp"> 
                        <input class="style-inp" type="tel" name="phone" placeholder="Phone number*" required="required"/>
                    </div>
                </div>
                <div class="last-inp pt-5 mt-5 border-t border-utility-gray-200">
                    <div class="block-inp"> 
                        <input class="style-inp" type="text" required="required" placeholder="Update your resume*" disabled="disabled"/>
                    </div>
                    <div class="block-choseFile">
                         <div class="choseFile-btn">
                            <input class="style-btn-file" type="file" name="resume"/><span class="content">CHOOSE FILE</span>
                        </div>
                        <span class="allow-file-content">Allow file doc, docx, xls, xlsx, ppt, pdf and up to 1mb</span>
                    </div>
                </div>
                 <div class="submit-form-checkRobot flex-between -md:flex-col gap-3"> 
                    <!-- Robot check skipped -->
                    <button type="submit" class="btn-primary btn flex justify-center rem:min-w-[80px]"><span>Gửi</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
