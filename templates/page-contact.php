<?php
/**
 * Template Name: Contact
 * 
 * @package CanhCamTheme
 */

get_header();

// Include Banner Module
include get_template_directory() . '/modules/common/banner-basic.php';
include get_template_directory() . '/modules/common/breadcrumd.php';

// Modules
include get_template_directory() . '/modules/contact/contact-info.php';

get_footer();
