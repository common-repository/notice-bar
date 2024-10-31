<?php
class Notice_Bar_Post_Type{

	function __construct(){
	    add_action( 'init',  array( $this,'nb_add_post_type' ) );
		add_action( 'admin_menu', array( $this, 'new_version_menu' ), 20 );
	    add_action( 'add_meta_boxes', array($this, 'nb_add_meta_boxes' ) );
		add_action( 'save_post', array($this, 'notice_bar_save_meta_box_data' ) );
		add_filter( 'notice_bar_admin_sections_tab', array( $this, 'sections_tab' ), 10, 2 );
		add_filter( 'notice_bar_admin_notice_types_tab', array( $this, 'notice_types_tab' ), 10, 2 );
		add_filter( 'notice_bar_admin_notice_display_tab', array( $this, 'notice_display_tab' ), 10, 2 );
		add_filter( 'notice_bar_admin_visibility_tab', array( $this, 'visibility_tab' ), 10, 2 );
	}

	/**
	 * Register a notice post type.
	 */
	function nb_add_post_type() {
	    $labels = array(
	        'name'               => _x( 'Notice Bars', 'post type general name', 'notice-bar' ),
	        'singular_name'      => _x( 'Notice Bar', 'post type singular name', 'notice-bar' ),
	        'menu_name'          => _x( 'Notice Bar', 'admin menu', 'notice-bar' ),
	        'name_admin_bar'     => _x( 'Notice Bar', 'add new on admin bar', 'notice-bar' ),
	        'add_new'            => _x( 'Add New', 'notice', 'notice-bar' ),
	        'add_new_item'       => __( 'Add New Notice Bar', 'notice-bar' ),
	        'new_item'           => __( 'New Notice Bar', 'notice-bar' ),
	        'edit_item'          => __( 'Edit Notice Bar', 'notice-bar' ),
	        'view_item'          => __( 'View Notice Bar', 'notice-bar' ),
	        'all_items'          => __( 'All Notice Bars', 'notice-bar' ),
	        'search_items'       => __( 'Search Notice Bars', 'notice-bar' ),
	        'parent_item_colon'  => __( 'Parent Notice Bars:', 'notice-bar' ),
	        'not_found'          => __( 'No notice bars found.', 'notice-bar' ),
	        'not_found_in_trash' => __( 'No notice bars found in Trash.', 'notice-bar' )
	        );

	    $args = array(
	        'labels'             => $labels,
	        'description'        => __( 'Description.', 'notice-bar' ),
	        'public'             => false,
	        'publicly_queryable' => false,
	        'exclude_from_search'=> true,
	        'show_in_nav_menus'  => false,
	        'show_ui'            => true,
	        'show_in_menu'       => true,        
	        'query_var'          => true,
	        'rewrite'            => false,
	        'capability_type'    => 'post',
	        'has_archive'        => false,
	        'menu_icon'   		 => 'dashicons-megaphone',
	        'hierarchical'       => false,
	        'supports'           => array( 'title' )
	        );

	    register_post_type( 'notice-bar', $args );
	}

   /**
	 * Adds submenu page 
	 * 
	 * @since 1.0.0
	 */
	public function new_version_menu() {
	    add_submenu_page( 'edit.php?post_type=notice-bar', __( 'Settings', 'notice-bar' ), __( 'Settings', 'notice-bar' ), 'manage_options', 'notice-bar', array( $this, 'new_settings_page' ) );
	}

	/**
	* Settings Page for new version
	* 
	* @since 1.0.0
	*/
	public static function new_settings_page() {
	    include(NOTICE_BAR_BASE_PATH . '/inc/backend/views/settings.php');
	}

	/**
	 * Adds metabox for backend configurations. 
	 * 
	 * @since 1.0.0
	 */
	function nb_add_meta_boxes(){
		$screens = array( 'notice-bar' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'notice_tab_id',
				__( 'Notice Configurations', 'notice-bar' ),
				array($this,'nb_tab_meta_box_callback'),
				$screen,
				'normal',
				'high'
			);
		}
	}

	// Tab for notice listing and settings
	public function nb_tab_meta_box_callback(){
		global $post;
		$nb_settings = get_post_meta( $post->ID, 'notice_bar_setting', true ); 
    	$nb_settings =  ( $nb_settings=='' || empty( $nb_settings ) ) ? notice_bar_default_settings() : $nb_settings ;

		$tab_args = array(
			'container_id' => 'tabs-container',
			'content_wrap_class' => 'nb-setting-outer-wrap',
			'tabs' => array(
					array(
						'id' => 'notice-types',
						'title' => __( 'Notice Types', 'notice-bar' ),
						'is_active' => true,
						'content' => apply_filters( 'notice_bar_admin_notice_types_tab', '', $nb_settings ),
					),
					array(
						'id' => 'basic',
						'title' => __( 'Sections', 'notice-bar' ),
						'content' => apply_filters( 'notice_bar_admin_sections_tab', '', $nb_settings ),
					),
					array(
						'id' => 'display',
						'title' => __( 'Display', 'notice-bar' ),
						'class' => '',
						'content' => apply_filters( 'notice_bar_admin_notice_display_tab', '', $nb_settings ),
					),
					array(
						'id' => 'visibility',
						'title' => __( 'Visibility', 'notice-bar' ),
						'class' => '',
						'content' => apply_filters( 'notice_bar_admin_visibility_tab', '', $nb_settings ),
					)
				)			
			);
		Notice_Bar_Meta_Tabs::create( $tab_args );
	}

	/**
	 * Basic config tab. 
	 * 
	 * @since 1.0.0
	 */
	function sections_tab( $data, $nb_settings ){
		ob_start();
		include_once NOTICE_BAR_BASE_PATH . '/inc/backend/views/sections-config.php';
		$data .= ob_get_contents();
		ob_end_clean();
		return $data;
	}

    /**
     * Notice types tab. 
     * 
     * @since 1.0.0
     */
	function notice_types_tab( $data, $nb_settings ){
		ob_start();
		$notice_types = apply_filters( 'notice_bar_types_list', array(), $nb_settings );
		include_once NOTICE_BAR_BASE_PATH . '/inc/backend/views/notice-config.php';
		$data .= ob_get_contents();
		ob_end_clean();
		return $data;
	}


    /**
     * Notice display tab. 
     * 
     * @since 1.0.0
     */
	function notice_display_tab( $data, $nb_settings ){
		ob_start();
		$display_options = apply_filters( 'notice_bar_display_options', array(), $nb_settings );
		include_once NOTICE_BAR_BASE_PATH . '/inc/backend/views/display-config.php';
		$data .= ob_get_contents();
		ob_end_clean();
		return $data;
	}

	/**
	 * Visibility tab. 
	 * 
	 * @since 1.0.0
	 */
	function visibility_tab( $data, $nb_settings ){
		ob_start();
		$display_options = apply_filters( 'notice_bar_visibility_options', array(), $nb_settings );
		include_once NOTICE_BAR_BASE_PATH . '/inc/backend/views/visibility-config.php';
		$data .= ob_get_contents();
		ob_end_clean();
		return $data;
	}
	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function notice_bar_save_meta_box_data( $post_id ) {
		
	    /*
	     * We need to verify this came from our screen and with proper authorization,
	     * because the save_post action can be triggered at other times.
	     */
	    // Sanitize user input.
	    if(isset($_POST['nb_settings']))
	    {
		    $Label1 = $_POST['nb_settings'];
		    update_post_meta( $post_id, 'notice_bar_setting', $Label1 );
	    }  
	}	
}

new Notice_Bar_Post_Type();