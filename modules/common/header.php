<?php
// Header Module
// UI: UI/home.html

$logo = get_field('field_footer_logo', 'option'); // Reuse footer logo or add specific header logo field? Assuming footer logo or static fallback for now as per instructions. Usually Header has own field.
// Actually, instructions said "If custom logo exists → render it. Else → render site name."
// We can use the native 'custom_logo' feature.

$custom_logo_id = get_theme_mod('custom_logo');
$logo_img = wp_get_attachment_image_src($custom_logo_id, 'full');
$site_name = get_bloginfo('name');
?>

<div class="section-px">
    <div class="block-header"> 
        <div class="hamburger-mobile">
            <div class="header-hamburger">
                <div class="wrap"><span></span><span></span><span></span></div>
                <div id="pulseMe">
                    <div class="bar left"></div>
                    <div class="bar top"></div>
                    <div class="bar right"></div>
                    <div class="bar bottom"></div>
                </div>
            </div>
            
            <div class="navbar-mobile xl:hidden p-0">
                <div class="menu-overlay"></div>
                <div class="mobi-bg md:w-1/2 h-full bg-white z-50 p-5 relative">
                    <div class="header-search-form-mobile">
                        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                            <input class="focus:outline-primary-1/20" type="text" name="s" placeholder="<?php echo esc_attr( 'Search', 'canhcamtheme' ); ?>">
                            <button type="submit"></button>
                        </form>
                    </div>
                    <div class="menu-list">
                         <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container' => false,
                            'walker' => new CanhCam_Walker_Nav_Menu(),
                            'fallback_cb' => false
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="header-logo"> 
            <a href="<?php echo home_url('/'); ?>">
                <?php if ($logo_img): ?>
                    <img src="<?php echo esc_url($logo_img[0]); ?>" alt="<?php echo esc_attr($site_name); ?>">
                <?php else: ?>
                    <span><?php echo esc_html($site_name); ?></span>
                <?php endif; ?>
            </a>
        </div>
        
        <div class="header-right"> 
            <div class="header-menu"> 
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container' => false,
                    'walker' => new CanhCam_Walker_Nav_Menu(),
                    'fallback_cb' => false
                ));
                ?>
            </div>
            
            <div class="header-icon"> 
                <button class="header-search header-search-btn -md:hidden "><i class="fa-light fa-magnifying-glass"></i></button>
                <div class="lang"> 
                    <!-- Language logic usually handled by Plugin or specialized code. 
                         Placeholder structure from UI preserved. -->
                    <ul> 
                        <li class="wpml-ls-item">
                            <a href="#"> 
                                <img src="<?php echo get_template_directory_uri(); ?>/dist/img/lang.png" alt="VN"/>
                                <span class="wpml-ls-native">VN</span>
                            </a>
                        </li>
                        <ul> 
                            <li> 
                                <a href="#"> 
                                    <img src="<?php echo get_template_directory_uri(); ?>/dist/img/lang.png" alt="EN"/>
                                    <span>EN</span>
                                </a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Form Popup (Global) -->
<div class="header-search-form">
    <div class="close flex-center w-12 h-12 bg-primary-1 rounded-full text-white absolute top-0 right-0 m-3 cursor-pointer hover:bg-primary-7">
        <i class="fa-light fa-xmark"></i>
    </div>
    <div class="container">
        <div class="wrap-form-search-product">
            <div class="productsearchbox">
                <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                    <input type="text" name="s" placeholder="<?php echo esc_attr( 'Tìm kiếm ...', 'canhcamtheme' ); ?>">
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</div>
