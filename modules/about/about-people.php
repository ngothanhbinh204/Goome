<?php
// About People (ACF: layout_about_people)
// UI Source: UI/gioi-thieu.html .section-about-5

$title = get_sub_field('title');
$desc = get_sub_field('description');
// Repeater: people (Group Name -> Members repeater)

?>
<section class="section-about-5"> 
    <div class="section-px section-my">
        <div class="bg-utility-gray-50 rounded-4">
            <div class="container"> 
                <div class="section-py">
                    <div class="block-title"> 
                        <?php if($title): ?>
                        <div class="heading-1"> 
                            <h3><?php echo esc_html($title); ?></h3>
                        </div>
                        <?php endif; ?>
                        <?php if($desc): ?>
                        <div class="body-1 text-utility-gray-800">
                            <?php echo wp_kses_post($desc); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if(have_rows('people')): ?>
                        <?php while(have_rows('people')): the_row(); 
                            $group_name = get_sub_field('group_name');
                        ?>
                        <div class="block-item <?php echo ($group_name == 'Quản lý phòng ban') ? 'border-none' : ''; // Simple check or just standard border-b ?>">
                            <?php if($group_name): ?>
                            <div class="heading-6"> <span> </span>
                                <h4><?php echo esc_html($group_name); ?></h4>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(have_rows('members')): ?>
                            <div class="item-grid">
                                <?php while(have_rows('members')): the_row(); 
                                    $m_img = get_sub_field('image');
                                    $m_name = get_sub_field('name');
                                    $m_role = get_sub_field('role');
                                ?>
                                <div class="card-about flex flex-col gap-5"> 
                                    <?php if($m_img): ?>
                                    <div class="img img img-ratio ratio:pt-[210_210] rounded-4">
                                        <img class="lozad" data-src="<?php echo esc_url($m_img['url']); ?>" alt="<?php echo esc_attr($m_name); ?>"/>
                                    </div>
                                    <?php endif; ?>
                                    <div class="flex flex-col gap-2"> 
                                        <?php if($m_name): ?>
                                        <div class="body-3 uppercase font-bold">
                                            <p><?php echo esc_html($m_name); ?></p>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($m_role): ?>
                                        <div class="body-1 text-utility-gray-800">
                                            <p><?php echo esc_html($m_role); ?></p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
