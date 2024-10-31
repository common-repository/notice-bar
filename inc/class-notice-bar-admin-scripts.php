<?php


            if ( !class_exists( 'Notice_bar_Admin_Scripts' ) ) {

                class Notice_bar_Admin_Scripts {

            /**
            * New version settings initialization
            * 
            * @since 1.0.0
            */
            function __construct() {
                add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ) ); // registers css and js for new version admin settings 
                add_action('admin_menu', array($this, 'disable_new_posts') );

            
            }

            function disable_new_posts() {
                // Hide sidebar link
                global $submenu;
                unset($submenu['edit.php?post_type=subscriber'][10]);

                // Hide link on listing page
                if (isset($_GET['post_type']) && $_GET['post_type'] == 'subscriber') {
                    echo '<style type="text/css">
                    .post-type-subscriber a.page-title-action{
                     display: none;
                    }
                    </style>';
                }
            }
            /**
            * Registers admin css and js for new version
            * 
            * @since 1.0.0
            */
            public static function register_admin_assets( $hook ) {
                
                $screen = get_current_screen();  
                if($screen->post_type=="notice-bar" || isset($_GET['page']) && $_GET['page']=='notice-bar')
                {
                wp_enqueue_style( 'wp-color-picker' );
                
                wp_enqueue_script( "jquery-ui-datepicker" );

                wp_enqueue_style( 'nb-new-admin-style', NOTICE_BAR_FILE_URL . '/css/backend.css', array(), NOTICE_BAR_VERSION );
                wp_enqueue_style( 'nb-new-dt-picker-css', NOTICE_BAR_FILE_URL . '/css/bootstrap-datetimepicker.css', array(), NOTICE_BAR_VERSION );
                
                wp_enqueue_script( 'nb-new-dt-picker', NOTICE_BAR_FILE_URL . '/js/moment-with-locales.js', array( 'jquery' ), NOTICE_BAR_VERSION );                              
                wp_enqueue_script( 'nb-new-dt-custom-picker', NOTICE_BAR_FILE_URL . '/js/bootstrap-datetimepicker.js', array( 'jquery' ), NOTICE_BAR_VERSION );

                wp_enqueue_script( 'nb-new-admin-script', NOTICE_BAR_FILE_URL . '/js/backend.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), NOTICE_BAR_VERSION );
                
                wp_enqueue_style( 'nb-fa', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), NOTICE_BAR_VERSION );  
                }             

            }

        }
    $obj_admin_scripts = new Notice_bar_Admin_Scripts();
    }