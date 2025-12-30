<?php
function log_dump($data)
{
	// Use the PHP ob_start function to capture the output of the var_dump function
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	// Use the PHP highlight_string function to highlight the syntax
	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

	// Remove the PHP tags and wrap the highlighted code in a <pre> tag
	$formatted = '<pre>' . substr($highlighted, 27, -8) . '</pre>';

	// Add custom CSS styles for the .php and .hlt classes
	$custom_css = 'pre {position: static;
		background: #ffffff80;
		// max-height: 50vh;
		width: 100vw;
	}
	pre::-webkit-scrollbar{
	width: 1rem;}';

	// Wrap the custom CSS in a <style> tag
	$formatted_css = '<style>' . $custom_css . '</style>';
	echo ($formatted_css . $formatted);
}

function empty_content($str)
{
	return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}


function goome_get_archive_page_id($post_type) {
    $templates = [
        'project' => 'templates/page-projects.php',
        'career'  => 'templates/page-career.php',
        'post'    => 'templates/page-news.php',
    ];

    if (isset($templates[$post_type])) {
        $pages = get_pages([
            'meta_key'   => '_wp_page_template',
            'meta_value' => $templates[$post_type],
            'number'     => 1
        ]);
        if (!empty($pages)) {
            return $pages[0]->ID;
        }
    }
    return 0;
}

/**
 * Customize Rank Math Breadcrumbs
 */
add_filter( 'rank_math/frontend/breadcrumb/args', function( $args ) {
	$args['delimiter'] = '<span class="separator"> | </span>';
	$args['wrap_before'] = '<nav class="rank-math-breadcrumb" aria-label="breadcrumbs"><p>';
	$args['wrap_after'] = '</p></nav>';
	return $args;
} );
?>