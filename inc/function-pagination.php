<?php

/**
 * WordPress Bootstrap Pagination
 *
 * <?php echo wp_bootstrap_pagination(array('custom_query' => $the_query)) ?>
 *
 * Thêm tham số sau vào WP_Query
 * $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
 * 'paged' => $paged
 */
/**
 * WordPress Bootstrap Pagination (Chỉ hiển thị số trang, không có số 0 ở đầu)
 */
function wp_bootstrap_pagination($args = array())
{
    $defaults = array(
        'range'         => 4,
        'custom_query'  => FALSE,
        'before_output' => '<div class="navigation flex gap-2 body-2">',
        'after_output'  => '</div>'
    );

    $args = wp_parse_args(
        $args,
        apply_filters('wp_bootstrap_pagination_defaults', $defaults)
    );

    if (!$args['custom_query']) {
        $args['custom_query'] = $GLOBALS['wp_query'];
    }

    $count = (int) $args['custom_query']->max_num_pages;
    $page  = intval(get_query_var('paged'));
    if (!$page) $page = 1;

    if ($count <= 1) return FALSE;

    $range = (int) $args['range'] - 1;
    $ceil  = ceil($range / 2);

    if ($count > $range) {
        if ($page <= $range) {
            $min = 1;
            $max = $range + 1;
        } elseif ($page >= ($count - $ceil)) {
            $min = $count - $range;
            $max = $count;
        } else {
            $min = $page - $ceil;
            $max = $page + $ceil;
        }
    } else {
        $min = 1;
        $max = $count;
    }

    $echo = '';

    if (!empty($min) && !empty($max)) {
        for ($i = $min; $i <= $max; $i++) {
            // Đã loại bỏ str_pad để hiển thị số tự nhiên (1, 2, 3...)
            if ($page == $i) {
                $echo .= '<a class="btn-primary btn active rounded-2" href="javascript:void(0)"><span>' . (int)$i . '</span></a>';
            } else {
                $echo .= '<a class="btn-primary btn bg-utility-gray-100 rounded-2 border-utility-gray-100" href="' . esc_attr(get_pagenum_link($i)) . '"><span>' . (int)$i . '</span></a>';
            }
        }
    }

    if (!empty($echo)) {
        echo $args['before_output'] . $echo . $args['after_output'];
    }
}