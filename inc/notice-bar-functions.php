<?php
// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Notice Bar Default Settings 
 * 
 * @since 1.0.0
 */
function notice_bar_default_settings(){
	
	$default_settings = array(
	    'enable' => 1,
	     'notice' => array
        (
            'section_1' => array
                (
                    
                    'sec1_disp' => 1
                )
         ),

	    'layout' => 'layout-1',
	    'layout_1' => array(
	        'middle' => array
	            (
	            'notice'      => array(
	            			'marquee_type' => 'left'
	            	),
	            'notice_type' => 'plain-text',
	            'notice_text' => __( 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 'notice-bar' ),
	              'slider' => Array
                        (
                            'slides' => Array
                                (
                                    'textarea' => Array
                                        (
                                            '0' => 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 
                                            
                                        ),

                                ),

                            'auto_start' => 1,
                            'animation' => 'horizontal',
                            'show_controls' => 1,
                            'slide_duration' => 2000,
                        ),
	            'ticker' => array(
	                'ticker_label' => '',
	                'ticker_items' => array( __( 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 'notice-bar' ) ),
	                'ticker_direction' => 'ltr',
	                'ticker_speed' => '',
	                'ticker_pause' => ''
	            ),
	            'social_icons' => array(
	                'label' => '',
	                'icons' => array
	                    (
	                    'facebook' => array
	                        (
	                        'status' => 0,
	                        'url' => ''
	                    ),
	                    'twitter' => array
	                        (
	                        'status' => 0,
	                        'url' => ''
	                    ),
	                    'google-plus' => array
	                        (
	                        'status' => 0,
	                        'url' => ''
	                    ),
	                    'instagram' => array
	                        (
	                        'status' => 0,
	                        'url' => ''
	                    ),
	                    'linkedin' => array
	                        (
	                        'status' => 0,
	                        'url' => ''
	                    ),
	                    'youtube' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        ),
	                    'pinterest' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        ),
	                    'tumblr' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        ),
	                    'reddit' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        ),
	                    'flickr' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        ),
	                    'vine' => array
	                    (
	                        'status' => 0,
	                        'url' => ''
	                        )
	                )
	            )
	        )
	    ),
	    'display' => array(
	        'display_position' => 'top-fixed',
	        'close_action' => 1,
	        'background_color' => '#dd3333',
	        'font_color' => '#ffffff',
	        'font_size' => '12',
	        'social_icon_background' => '#222222',
	        'social_icon_color' => '#fff',
	        'ticker_label_background' => '#b61818'
	    ),
	    'pages' => array
        (
            'entire' => 1
        ),
        'customcss' => '',
	);

	return $default_settings;
}

// JavaScript Minifier
if( !function_exists( 'ws_minify_js' ) ){
	function ws_minify_js( $input ) {
	    if(trim($input) === "") return $input;
	    return preg_replace(
	        array(
	            // Remove comment(s)
	            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
	            // Remove white-space(s) outside the string and regex
	            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
	            // Remove the last semicolon
	            '#;+\}#',
	            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
	            '#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
	            // --ibid. From `foo['bar']` to `foo.bar`
	            '#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
	            // Replace `true` with `!0`
	            '#(?<=return |[=:,\(\[])true\b#',
	            // Replace `false` with `!1`
	            '#(?<=return |[=:,\(\[])false\b#',
	            // Clean up ...
	            '#\s*(\/\*|\*\/)\s*#'
	        ),
	        array(
	            '$1',
	            '$1$2',
	            '}',
	            '$1$3',
	            '$1.$3',
	            '!0',
	            '!1',
	            '$1'
	        ),
	    $input);
	}
}

if( !function_exists( 'ws_minify_css' ) ){
	function ws_minify_css( $input ) {
	    if(trim($input) === "") return $input;
	    // Force white-space(s) in `calc()`
	    if(strpos($input, 'calc(') !== false) {
	        $input = preg_replace_callback('#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function($matches) {
	            return 'calc(' . preg_replace('#\s+#', "\x1A", $matches[1]) . ')';
	        }, $input);
	    }
	    return preg_replace(
	        array(
	            // Remove comment(s)
	            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
	            // Remove unused white-space(s)
	            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
	            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
	            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
	            // Replace `:0 0 0 0` with `:0`
	            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
	            // Replace `background-position:0` with `background-position:0 0`
	            '#(background-position):0(?=[;\}])#si',
	            // Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
	            '#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
	            // Minify string value
	            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
	            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
	            // Minify HEX color code
	            '#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
	            // Replace `(border|outline):none` with `(border|outline):0`
	            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
	            // Remove empty selector(s)
	            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
	            '#\x1A#'
	        ),
	        array(
	            '$1',
	            '$1$2$3$4$5$6$7',
	            '$1',
	            ':0',
	            '$1:0 0',
	            '.$1',
	            '$1$3',
	            '$1$2$4$5',
	            '$1$2$3',
	            '$1:0',
	            '$1$2',
	            ' '
	        ),
	    $input);
	}
}
