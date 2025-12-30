<?php
get_header();

// Include Banner Module
// include get_template_directory() . '/modules/common/banner.php';

?>

    <?php
    get_template_part('modules/single-project/project-intro');
    get_template_part('modules/single-project/project-info');
    get_template_part('modules/single-project/project-gallery');
    ?>
    <section class="section-project-Detail-4">
				<div class="section-px">
					<div class="bg-utility-gray-50 rounded-4 relative">
						<div class="container">
							<div class="flex flex-col gap-base section-py">
								<div class="heading-1"> 
									<h2>Dự án liên quan</h2>
								</div>
								<div class="swiper-column-auto auto-3-column-custom" data-swiper-prev=".button-swiper .btn-prev" data-swiper-next=".button-swiper .btn-next">
									<div class="swiper">
										<div class="swiper-wrapper">
                                            <?php
                                            $current_id = get_the_ID();
                                            $terms = get_the_terms($current_id, 'project_cat');
                                            $term_ids = [];
                                            if ($terms && !is_wp_error($terms)) {
                                                foreach ($terms as $term) {
                                                    $term_ids[] = $term->term_id;
                                                }
                                            }

                                            $args = [
                                                'post_type'      => 'project',
                                                'posts_per_page' => 6,
                                                'post__not_in'   => [$current_id],
                                                'orderby'        => 'rand',
                                            ];

                                            if (!empty($term_ids)) {
                                                $args['tax_query'] = [
                                                    [
                                                        'taxonomy' => 'project_cat',
                                                        'field'    => 'term_id',
                                                        'terms'    => $term_ids,
                                                    ]
                                                ];
                                            }

                                            $related_query = new WP_Query($args);

                                            if ($related_query->have_posts()):
                                                while ($related_query->have_posts()): $related_query->the_post();
                                                    $r_id = get_the_ID();
                                                    $r_title = get_the_title();
                                                    $r_link = get_permalink();
                                                    $r_img_url = has_post_thumbnail() ? get_the_post_thumbnail_url($r_id, 'full') : '';
                                                    
                                                     $r_intro = get_field('project_intro', $r_id);
                                                     $r_subtitle = isset($r_intro['subtitle']) ? $r_intro['subtitle'] : ''; 
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="card-project group flex flex-col gap-6 "> 
                                                            <a class="img img-ratio ratio:pt-[433_560]  rounded-4 zoom-img" href="<?php echo esc_url($r_link); ?>"> 
                                                                <img class="lozad" data-src="<?php echo esc_url($r_img_url); ?>" alt="<?php echo esc_attr($r_title); ?>"/>
                                                            </a>
                                                            <div class="content-card-project"> 
                                                                <?php if($r_subtitle): ?>
                                                                <div class="body-1 text-utility-gray-500">
                                                                    <?php echo esc_html($r_subtitle); ?>
                                                                </div>
                                                                <?php endif; ?>
                                                                <div class="heading-2 group-hover:text-primary-1 duration-300">
                                                                    <h2><a href="<?php echo esc_url($r_link); ?>"><?php echo esc_html($r_title); ?></a></h2>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endwhile; wp_reset_postdata(); ?>
                                            <?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="button-swiper pb-5"><a class="btn btn-prev group" href="">
								 <i class="fa-regular fa-angle-left"></i></a><a class="btn btn-next group" href="">
								 <i class="fa-regular fa-angle-right"></i></a>
						</div>
					</div>
				</div>
	</section>

<?php get_footer(); ?>
