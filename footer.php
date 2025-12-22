		<footer>
			<?php
			$footer_bg_url = get_template_directory_uri() . '/dist/img/footer.svg';
			
			// ACF Options
			$footer_settings = get_field('footer_settings', 'option');
			
			// Default values to prevent errors
			$f_logo = isset($footer_settings['footer_logo']) ? $footer_settings['footer_logo'] : '';
			$f_intro_title = isset($footer_settings['footer_intro_title']) ? $footer_settings['footer_intro_title'] : '';
			$f_intro_desc = isset($footer_settings['footer_intro_desc']) ? $footer_settings['footer_intro_desc'] : '';
			$f_form_shortcode = isset($footer_settings['footer_form_shortcode']) ? $footer_settings['footer_form_shortcode'] : '';
			
			$f_quick_links_title = isset($footer_settings['footer_quick_links_title']) ? $footer_settings['footer_quick_links_title'] : '';
			
			$f_contact_title = isset($footer_settings['footer_contact_title']) ? $footer_settings['footer_contact_title'] : '';
			$f_contact_list = isset($footer_settings['footer_contact_list']) ? $footer_settings['footer_contact_list'] : [];
			
			$f_copyright = isset($footer_settings['footer_copyright']) ? $footer_settings['footer_copyright'] : '';
			$f_socials = isset($footer_settings['footer_socials']) ? $footer_settings['footer_socials'] : [];
			?>
			<div class="bg-img-footer w-full rem:min-h-[654px] -md:min-h-auto relative flex-center " setBackground="<?php echo esc_url($footer_bg_url); ?>">
				<div class="main-content">
					<div class="container">
						<div class="block-footer">
							<!-- Left Block -->
							<div class="block-footer-left rem:w-[calc(440/1440*100%)] -lg:w-full">
								<div class="block-content">
									<?php if($f_logo): ?>
									<div class="logo-footer">
										<img src="<?php echo esc_url($f_logo['url']); ?>" alt="<?php echo esc_attr($f_logo['alt']); ?>">
									</div>
									<?php endif; ?>
									
									<div class="block-contact"> 
										<?php if($f_intro_title): ?>
										<div class="heading-2 uppercase">
											<h2><?php echo esc_html($f_intro_title); ?></h2>
										</div>
										<?php endif; ?>
										<?php if($f_intro_desc): ?>
										<div class="body-1">
											<p><?php echo wp_kses_post(nl2br($f_intro_desc)); ?></p>
										</div>
										<?php endif; ?>
									</div>
									
									<div class="block-from">
										<?php if($f_form_shortcode): ?>
											<?php echo do_shortcode($f_form_shortcode); ?>
										<?php else: ?>
											<!-- Fallback Static Form (Matching UI but non-functional) -->
											<div class="block-input"> 
												<input type="text" placeholder="Tên">
											</div>
											<div class="block-input"> 
												<input type="text" placeholder="Điện thoại">
											</div>
											<div class="block-input"> 
												<input type="text" placeholder="Email">
												<button class="icon-contact">
													 <i class="fa-sharp fa-light fa-paper-plane"></i></button>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
							
							<!-- Right Block -->
							<div class="block-footer-right rem:w-[calc(800/1440*100%)] -lg:w-full">
								<div class="footer-top">
									<!-- Menu Footer 1 (Quick Links) -->
									<div class="block-content-left rem:w-[calc(240/800*100%)] -md:w-full">
										<div class="block-menu-footer">
											<?php if($f_quick_links_title): ?>
											<div class="heading-2 uppercase"> 
												<h2><?php echo esc_html($f_quick_links_title); ?></h2>
											</div>
											<?php endif; ?>
											
											<?php 
											wp_nav_menu(array(
												'theme_location' => 'footer-1',
												'container' => false,
												'menu_class' => '', // Default UL
												'fallback_cb' => false
											)); 
											?>
										</div>
									</div>
									
									<!-- Contact Info (Repeater) -->
									<div class="block-content-right rem:w-[calc(440/800*100%)] -md:w-full">
										<?php if($f_contact_title): ?>
										<div class="heading-2 uppercase"> 
											<h2><?php echo esc_html($f_contact_title); ?></h2>
										</div>
										<?php endif; ?>
										
										<?php if($f_contact_list): ?>
										<ul>
											<?php foreach($f_contact_list as $item): 
												$icon = $item['icon_class'];
												$content = $item['content'];
											?>
											<li>
												<?php if($icon): ?>
												<div class="icon-info"><i class="<?php echo esc_attr($icon); ?>"></i></div>
												<?php endif; ?>
												
												<div class="block-content-link">
													<?php echo wp_kses_post($content); ?>
												</div>
											</li>
											<?php endforeach; ?>
										</ul>
										<?php endif; ?>
									</div>
								</div>
								
								<div class="footer-bottom">
									<div class="body-2">
										<?php if($f_copyright): ?>
										<p><?php echo esc_html($f_copyright); ?></p>
										<?php endif; ?>
									</div>
									
									<?php if($f_socials): ?>
									<div class="block-icon">
										<?php foreach($f_socials as $s_item): 
											$s_icon = $s_item['icon_class'];
											$s_link = $s_item['link'];
										?>
										<a href="<?php echo esc_url($s_link); ?>" class="block-icon-item" target="_blank">
											 <i class="<?php echo esc_attr($s_icon); ?>"></i>
										</a>
										<?php endforeach; ?>
									</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<script src="<?php echo get_template_directory_uri(); ?>/dist/js/core.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/dist/js/main.min.js"></script>
		<?php wp_footer(); ?>
	</body>
</html>