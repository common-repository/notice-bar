<?php

$nid = get_the_ID();

$current_offset = get_option('gmt_offset');
$tzstring = get_option('timezone_string');

$check_zone_info = true;

// Remove old Etc mappings. Fallback to gmt_offset.
if (false !== strpos($tzstring, 'Etc/GMT')) {
    $tzstring = '';
}

if (empty($tzstring)) { // Create a UTC+- zone if no timezone string exists
    $check_zone_info = false;
    if (0 == $current_offset) {
        $tzstring = 'UTC';
    } elseif ($current_offset < 0) {
        $tzstring = 'UTC' . $current_offset;
    } else {
        $tzstring = 'UTC+' . $current_offset;
    }
}


date_default_timezone_set($tzstring);
$routine = $nb_settings['display']['routine'];


if (isset($nb_settings['display']['display_position'])) {
    $position_class = 'nb-' . esc_attr($nb_settings['display']['display_position']);
} 

//Notice Display Date/Time.
if (isset($nb_settings['display']['time']['show_tm']) && $nb_settings['display']['time']['show_tm'] != '') {
    $show_date = $nb_settings['display']['time']['show_tm'];
    $current_date = date('m/d/Y g:i A');
    $current_time = date('H:i');

    if (array_key_exists('routine', $nb_settings['display']) && is_array($routine) && count($routine) > 0 && isset($routine['type']) && $routine['type'] != '') {

        if (array_key_exists('display', $nb_settings['display']['routine']) && $nb_settings['display']['routine']['display'] == 'on') {
            if (!(array_key_exists('start_time', $nb_settings['display']['routine']) && array_key_exists('end_time', $nb_settings['display']['routine']))) {
                return;
            }
            $should_display = call_user_func(array(
                $this,
                $routine['type']
            ), $nb_settings['display']['routine']);
            if (!$should_display) {
                return;
            }
        }

    }
    if (strtotime($current_date) >= strtotime($show_date)) {
        if (isset($nb_settings['pages']['entire'])) {
            include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');
        } else {
            if (isset($nb_settings['custom-pages']['enable'])) {
                $custom_pages = '';

                $custom_pages . $nid = $nb_settings['custom-pages']['enable'];

                if ($custom_pages . $nid == '1') {


                    $pages = get_pages();


                    foreach ($pages as $page_data) {


                        if (isset($nb_settings['custom-pages'][$page_data->post_name])) {

                            if ($nb_settings['custom-pages'][$page_data->post_name] == '1') {

                                $page = get_page_by_path($page_data->post_name);

                                if (is_page($page_data->post_name) && $page->ID != get_option('page_on_front') && $page->ID != get_option('page_for_posts')) {
                                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

                                }
                            }
                        }
                    }
                }
            }

            if (isset($nb_settings['custom_post']) && is_array($nb_settings['custom_post'])) {

                ob_start();

                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

                $content = ob_get_contents();

                ob_end_clean();

                wp_reset_query();             
                if (in_array(get_post_type(), array_keys($nb_settings['custom_post'])))  {
                    if(isset($nb_settings['custom_post_ids'][get_post_type()]) && ($nb_settings['custom_post_ids'][get_post_type()] == '' ||in_array(get_the_ID(), explode(',', $nb_settings['custom_post_ids'][get_post_type()])))){
                        echo $content;
                    }
                   

                }
            }
            if (isset($nb_settings['pages']['search'])) {

                if (is_search()) {

                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

                }
            }
            if (isset($nb_settings['pages']['404'])) {

                if (is_404()) {

                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

                }
            }
            if (isset($nb_settings['pages']['archives'])) {

                if (is_archive()) {

                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');


                }
            }
            if (isset($nb_settings['pages']['frontpage'])) {

                if (is_front_page()) {

                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');


                }
            }
            if (isset($nb_settings['pages']['blog'])) {

                if (is_home()) {

                    include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');


                }
            }
        }
    }
    if (!isset($nb_settings['pages']['blog']) && !isset($nb_settings['pages']['frontpage']) && !isset($nb_settings['pages']['archives']) && !isset($nb_settings['pages']['404']) && !isset($nb_settings['pages']['search']) && !isset($nb_settings['custom-pages']['enable']) && !isset($nb_settings['pages']['entire']) && !isset($nb_settings['custom_post'])) {
        include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');
    }


}

if (isset($nb_settings['display']['time']['hide_tm']) && $nb_settings['display']['time']['hide_tm'] != '') {
    $hide_date = $nb_settings['display']['time']['hide_tm'];
    $current_date = date('m/d/Y H:i A');
    if (strtotime($current_date) >= strtotime($hide_date)) {
        echo
            '<style>
                    .nb-notice-outer-wrap-' . absint( get_the_ID() ). '{

                        display: none !important;
                    }
                </style>';

    }
}


if (!isset($nb_settings['display']['time']['hide_tm']) || $nb_settings['display']['time']['hide_tm'] == '' && !isset($nb_settings['display']['time']['show_tm']) || $nb_settings['display']['time']['show_tm'] == '') {

    if (isset($nb_settings['pages']['entire'])) {

        include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

    } else if (isset($nb_settings['custom-pages']['enable'])) {
        $custom_pages = '';
        $custom_pages . $nid = $nb_settings['custom-pages']['enable'];
        if ($custom_pages . $nid == '1') {
            $pages = get_pages();
            foreach ($pages as $page_data) {
                if (isset($nb_settings['custom-pages'][$page_data->post_name])) {
                    if ($nb_settings['custom-pages'][$page_data->post_name] == '1') {

                        $page = get_page_by_path($page_data->post_name);

                        if (is_page($page_data->post_name) && $page->ID != get_option('page_on_front') && $page->ID != get_option('page_for_posts')) {

                            include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

                        }
                    }
                }
            }
        }
    }

    if (!isset($nb_settings['pages']['entire'])) {
        if (isset($nb_settings['pages']['search'])) {

            if (is_search()) {
                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

            }
        }

        if (isset($nb_settings['pages']['404'])) {

            if (is_404()) {

                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');

            }
        }

        if (isset($nb_settings['pages']['archives'])) {

            if (is_archive()) {

                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');


            }

        }

        if (isset($nb_settings['pages']['frontpage'])) {

            if (is_front_page()) {

                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');


            }

        }
        if (isset($nb_settings['pages']['blog'])) {
            $classes = get_body_class();
            if (in_array('blog', $classes)) {
                include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');
            }
        }
    }
    if (!isset($nb_settings['pages']['blog']) && !isset($nb_settings['pages']['frontpage']) && !isset($nb_settings['pages']['archives']) && !isset($nb_settings['pages']['404']) && !isset($nb_settings['pages']['search']) && !isset($nb_settings['custom-pages']['enable']) && !isset($nb_settings['pages']['entire'])) {
        include(NOTICE_BAR_BASE_PATH . '/inc/frontend/nb-template.php');
    }
}


foreach ($nb_settings['layout_1']['middle'] as $key => $val) {
    $$key = $val;
}

$show_int = '';
if (isset($nb_settings['display']['time']['after']) && $nb_settings['display']['time']['after'] != '') {

    $show_int = $nb_settings['display']['time']['after'];
    echo ws_minify_js(
        '<script type="text/javascript">
            jQuery(document).ready(function() {
             jQuery(".nb-notice-outer-wrap-' . get_the_ID() . ' .nb-notice-wrap.' . $position_class . '").addClass("nb-hide");
             jQuery(".nb-notice-outer-wrap-' . get_the_ID() . ' .nb-notice-wrap.' . $position_class . ' .nb-action").hide();
            jQuery(".nb-notice-outer-wrap-' . get_the_ID() . ' .nb-notice-wrap.' . $position_class . '").delay(' . $show_int . ').queue(function() {
                           jQuery(this).removeClass("nb-hide");
                           jQuery(this).addClass("nb-show");
                           jQuery(this).show("fast");
                           jQuery(this).dequeue();
                       });
            jQuery(".nb-notice-outer-wrap-' . get_the_ID() . ' .nb-notice-wrap.' . $position_class . ' .nb-action").delay(' . $show_int . ').show(0);
            });
            </script>');
}

if (isset($nb_settings['display']['time']['hide_sec']) && $nb_settings['display']['time']['hide_sec'] != '') {
    $hide_int = '';

    $hide_int = $nb_settings['display']['time']['hide_sec'];

    $hide = ($show_int) + ($hide_int);

    echo ws_minify_js(
        '<script type="text/javascript">
            jQuery(document).ready(function() {
                setTimeout(function(){
                    jQuery(".nb-notice-outer-wrap-' . get_the_ID() . ' .nb-notice-wrap.' . $position_class . '").hide();
                }, ' . $hide . ');

            });
        </script>');

}