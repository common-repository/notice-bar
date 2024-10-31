<?php
            /**
            * settings class
            */
            class Notice_bar_Settings
            {
                
                function __construct()
                {
                add_action( 'admin_post_nb_settings_save', array( $this, 'save_settings' ) ); // saves the new version settings
                add_action( 'admin_post_nb_restore_default_action', array( $this, 'restore_default_settings' ) ); // restores default settings for new version
  
                }
            
            /**
            * Saves settings
            * 
            * @since 1.0.0
            */
            function save_settings() {
                if ( !empty( $_POST ) && wp_verify_nonce( $_POST['nb_settings_nonce_field'], 'nb-settings-nonce' ) ) {
                    include(NOTICE_BAR_BASE_PATH . '/inc/cores/save-settings.php');
                } else {
                    die( 'No script kiddies please!!' );
                }
            }

            /**
            * Returns default settings array 
            * 
            * @return array
            * 
            * @since 1.0.0
            */
            function default_settings() {
                $default_settings = array(
                    'enable' => 0,
                    'layout' => 'layout-1',
                    'layout_1' => array(
                        'middle' => array
                        (
                            'notice_type' => 'plain-text',
                            'notice_text' => __( 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 'notice-bar' ),
                            'slider' => array(
                            'slides' => array(
                                'textarea' =>  __( 'Notice bar for all your custom notifications for your site visitors. Tweak them as you like using flexible options.', 'notice-bar' ) ),
                                'auto_start' => 1,
                                'show_controls' => 0,
                                'slide_duration' => ''
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
                                    'facenotice' => array
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
                )
            );
            return $default_settings;
        }

            /**
            * Retores default settings
            * 
            * @since 1.0.0
            */
            function restore_default_settings() {
                if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'nb-restore-nonce' ) ) {
                    $default_settings = $this->default_settings();
                    update_option( 'nb_new_settings', $default_settings );
                    $redirect_url = admin_url( 'admin.php?page=notice-bar&success=true&msg=2' );
                    wp_redirect( $redirect_url );
                    exit;
                }
            }

            
            /**
            * Sanitizes multidemnsional array
            * @param array $array
            * @param array $sanitize_rule
            * @return array
            * 
            * @since 1.0.0
            */
            function sanitize_array( $array = array(), $sanitize_rule = array() ) {
                if ( !is_array( $array ) || count( $array ) == 0 ) {
                    return array();
                }

                foreach ( $array as $k => $v ) {
                    if ( !is_array( $v ) ) {

                        $default_sanitize_rule = (is_numeric( $k )) ? 'html' : 'text';
                        $sanitize_type = isset( $sanitize_rule[$k] ) ? $sanitize_rule[$k] : $default_sanitize_rule;
                        $array[$k] = $this->nb_sanitize_value( $v, $sanitize_type );
                    }
                    if ( is_array( $v ) ) {
                        $array[$k] = $this->sanitize_array( $v, $sanitize_rule );
                    }
                }

                return $array;
            }

            function nb_sanitize_value( $value = '', $sanitize_type = 'text' ) {
                switch ( $sanitize_type ) {
                    case 'html':
                    $allowed_html = array(
                        'a' => array(
                            'href' => array(),
                            'title' => array(),
                            'target' => array()
                            ),
                        'br' => array(),
                        'em' => array(),
                        'strong' => array(),
                        'button' => array()
                        );
                    return wp_kses( $value, $allowed_html );
                    break;
                    default:
                    return sanitize_text_field( $value );
                    break;
                }
            }

        }    

    $new_notice_bar_settings = new Notice_bar_Settings();


