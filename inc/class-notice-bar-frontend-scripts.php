<?php
/**
 * Registers frontend assets
 */
class Notice_Bar_Frontend_Scripts {

	/**
     * Determine if the notice should be displayed daily under certain time frame
	 * @param $routine
	 *
	 * @return bool
	 */
	public function daily( $routine ) {
		return $this->shouldDisplay( $routine['start_time'], $routine['end_time'] );
	}

	/**
     * Determine if the notice should be displayed weekly under certain time frame
	 * @param $routine
	 *
	 * @return bool
	 */
	public function weekly( $routine ) {
		return array_key_exists('week',$routine) && is_array($routine['week']) && $this->shouldDisplay( $routine['start_time'], $routine['end_time'] ) && in_array( date( 'w' ), $routine['week'] );
	}

	/**
     * Determine if the notice should be displayed monthly under certain time frame
	 * @param $routine
	 *
	 * @return bool
	 */
	public function monthly( $routine ) {
	    $start = array_key_exists('start',$routine['month']) ? $routine['month']['start'] : false;
		$end = array_key_exists('end',$routine['month']) ? $routine['month']['end'] : false;
		return array_key_exists('month',$routine) && is_array($routine['month']) && $start && $end && $this->shouldDisplay( $routine['start_time'], $routine['end_time'] ) && $start <= date('j') && date('j') <= $end ;
	}

	/**
	 * @param $show_time
	 * @param $hide_time
	 *
	 * @return bool
	 */
	public function shouldDisplay( $show_time, $hide_time ) {
		$show_time    = date( 'H:i', strtotime( $show_time ) );
		$hide_time    = date( 'H:i', strtotime( $hide_time ) );
		$current_time = date( 'H:i' );

		return $show_time < $current_time && $current_time < $hide_time;
	}


	function __construct() {
		add_action( 'wp_head', array( $this, 'nb_plugin_custom_css' ) ); //add custom css
		add_action( 'wp_enqueue_scripts', array(
			$this,
			'register_front_assets'
		) ); // registers css and js for frontend
		add_action( 'wp_footer', array( $this, 'new_notice_bar_settings' ) ); // appends new notice bar in the frontend
	}


	function nb_plugin_custom_css( $custom_css ) {
		if ( isset( $custom_css ) ) {
			$customnid = $custom_css;
			echo '<style type="text/css" id="custom-plugin-css">' . $customnid . '</style>';
		}
	}

	/**
	 * New Version Notice Bar in Frontend
	 *
	 * @since 1.0.0
	 *
	 */
	function new_notice_bar_settings() {
		global $post;
		$nb_settings = get_post_meta( $post->ID, 'notice_bar_setting', true );

		$args = array( 'post_type' => 'notice-bar', 'posts_per_page' => - 1 );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			$nid         = get_the_ID();
			$nb_settings = get_post_meta( $post->ID, 'notice_bar_setting', true );

			$font_family = 'Merriweather';
			if ( isset( $nb_settings['display']['font_family'] ) && $nb_settings['display']['font_family'] != '' ) {
				$font_family = esc_attr( $nb_settings['display']['font_family'] );
			}


			$this->font_re_form( $font_family );
			$this->nb_enqueue_front( $nid, $font_family );
			?>
            <!-- Notice Bar Assets -->
			<?php
			echo '
                <style>
                    .nb-notice-outer-wrap-' . get_the_ID() . '{
                        font-family:' . $font_family .
			     '}
                </style>';
			/**
			 * If notice bar is disabled
			 */
			if ( isset( $nb_settings['enable'] ) && 1 == $nb_settings['enable'] ) {

				include( NOTICE_BAR_BASE_PATH . '/inc/frontend/front-notice-bar.php' );
			}
			if ( isset( $nb_settings['customcss'] ) ) {
				$custom_css = $nid;
				$custom_css = $nb_settings['customcss'];
				$this->nb_plugin_custom_css( $custom_css );
			}
		endwhile;
		wp_reset_postdata();

	}


	/**
	 * Fonts enqueue
	 *
	 * @since 1.0.0
	 */
	function font_re_form( $font_family ) {
		$fonts_final = str_replace( ' ', '+', $font_family );
		$query_args  = array(
			'family' => $fonts_final,
		);

		return $query_args;
	}

	/**
	 * Enqueue function
	 *
	 * @since 1.0.0
	 */
	function nb_enqueue_front( $nid, $font_family ) {
		wp_enqueue_style( 'nb-google-fonts-style' . $nid, add_query_arg( $this->font_re_form( $font_family ), "//fonts.googleapis.com/css" ) );
	}


	/**
	 * New version CSS and JS for frontend
	 *
	 * @since 1.0.0
	 */
	function register_front_assets() {

		$nb_settings = get_option( 'nb_new_settings' );
		$debug_mode  = ( isset( $nb_settings['debug_mode'] ) ) ? true : false;

		/**
		 * Frontend Styles
		 */
		wp_enqueue_style( 'nb-front-fa', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), NOTICE_BAR_VERSION );
		if ( $debug_mode == '1' ) {
			wp_enqueue_style( 'nb-news-ticker-style', NOTICE_BAR_FILE_URL . '/css/ticker-style.css', false, NOTICE_BAR_VERSION );
			wp_enqueue_style( 'nb-slick-style', NOTICE_BAR_FILE_URL . '/css/slick.css', false, NOTICE_BAR_VERSION );
			wp_enqueue_style( 'nb-slick-theme-style', NOTICE_BAR_FILE_URL . '/css/slick-theme.css', false, NOTICE_BAR_VERSION );


		} else {

			wp_enqueue_style( 'nb-news-ticker-style', NOTICE_BAR_FILE_URL . '/css/ticker-style.min.css', false, NOTICE_BAR_VERSION );
			wp_enqueue_style( 'nb-slick-style', NOTICE_BAR_FILE_URL . '/css/slick.min.css', false, NOTICE_BAR_VERSION );
			wp_enqueue_style( 'nb-slick-theme-style', NOTICE_BAR_FILE_URL . '/css/slick-theme.min.css', false, NOTICE_BAR_VERSION );

		}

		/**
		 * Frontend Scripts
		 */

		if ( $debug_mode == '1' ) {
			wp_enqueue_script( 'nb-news-ticker', NOTICE_BAR_FILE_URL . '/js/jquery.ticker.js', array( 'jquery' ), NOTICE_BAR_VERSION, true );
			wp_enqueue_script( 'nb-slick', NOTICE_BAR_FILE_URL . '/js/slick.js', array( 'jquery', ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-new-tweecool', NOTICE_BAR_FILE_URL . '/js/tweecool.min.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-new-frontend', NOTICE_BAR_FILE_URL . '/js/nb-frontend.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-subscriber', NOTICE_BAR_FILE_URL . '/js/nb-subscribe.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_localize_script( 'nb-subscriber', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


			global $post;
			$args   = array( 'post_type' => 'notice-bar', 'posts_per_page' => - 1 );
			$loop   = new WP_Query( $args );
			$params = '';
			$i      = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$nid         = get_the_ID();
				$nb_settings = get_post_meta( $post->ID, 'notice_bar_setting', true );

				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'slider' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'slider' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'slider' ) ) {

					$auto_start     = isset( $nb_settings['layout_1']['middle']['slider']['auto_start'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['auto_start'] ) : 0;
					$anim           = isset( $nb_settings['layout_1']['middle']['slider']['animation'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['animation'] ) : 0;
					$show_controls  = isset( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) : 0;
					$slide_duration = '1000';
					if ( isset( $nb_settings['layout_1']['middle']['slider']['slide_duration'] ) && $nb_settings['layout_1']['middle']['slider']['slide_duration'] != '' ) {
						$slide_duration = $nb_settings['layout_1']['middle']['slider']['slide_duration'];
					}

					$slides    = '';
					$slidesnid = $slides . $nid;
					$slidesnid = array(
						'auto' => $auto_start,
						'anim' => $anim,
						'con'  => $show_controls,
						'dur'  => $slide_duration
					);

					wp_enqueue_script( 'nb-demo' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );

					wp_localize_script( 'nb-demo' . $nid, 'slides' . $nid, $slidesnid );

				}


				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'twitter-tweets' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'twitter-tweets' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'twitter-tweets' ) ) {


					if ( isset( $nb_settings['tuser'] ) ) {

						$nb_settings['thumb'] = ( isset( $nb_settings['thumb'] ) && $nb_settings['thumb'] != '' ) ? esc_attr( $nb_settings['thumb'] ) : 'true';

						$nb_settings['tno'] = ( isset( $nb_settings['tno'] ) && $nb_settings['tno'] != '' ) ? esc_attr( $nb_settings['tno'] ) : '3';

						if ( $nb_settings['thumb'] == 'true' ) {
							$nb_settings['thumb'] = '1';
						} else {
							$nb_settings['thumb'] = '0';
						}
						$paramsnid = $params . $nid;
						$paramsnid = array(
							'tuser' => $nb_settings['tuser'],
							'tno'   => $nb_settings['tno'],
							'thumb' => $nb_settings['thumb']
						);

						wp_enqueue_script( 'nb-demo-' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );
						wp_localize_script( 'nb-demo-' . $nid, 'params' . $nid, $paramsnid );
					}

				}
				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'news-ticker' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'news-ticker' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'news-ticker' ) ) {

					$ticker_label = isset( $nb_settings['layout_1']['middle']['ticker']['ticker_label'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_label'] ) : '';

					$ticker_direction = 'ltr';
					if ( isset( $nb_settings['layout_1']['middle']['ticker']['ticker_direction'] ) && $nb_settings['layout_1']['middle']['ticker']['ticker_direction'] != '' ) {
						$ticker_direction = esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_direction'] );
					}

					$ticker_speed = '0.10';
					if ( isset( $nb_settings['layout_1']['middle']['ticker']['ticker_speed'] ) && $nb_settings['layout_1']['middle']['ticker']['ticker_speed'] != '' ) {
						$ticker_speed = esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_speed'] );
					}

					$ticker_pause_duration = '2000';
					if ( isset( $nb_settings['layout_1']['middle']['ticker']['ticker_pause'] ) && $nb_settings['layout_1']['middle']['ticker']['ticker_pause'] != '' ) {
						$ticker_pause_duration = esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_pause'] );
					}
					$ticker    = '';
					$tickernid = $ticker . $nid;
					$tickernid = array(
						'ticker_label'          => $ticker_label,
						'ticker_direction'      => $ticker_direction,
						'ticker_speed'          => $ticker_speed,
						'ticker_pause_duration' => $ticker_pause_duration
					);


					wp_enqueue_script( 'ticker' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );

					wp_localize_script( 'ticker' . $nid, 'ticker' . $nid, $tickernid );

				}

			endwhile;


		} else {
			wp_enqueue_script( 'nb-news-ticker', NOTICE_BAR_FILE_URL . '/js/jquery.ticker.min.js', array( 'jquery' ), NOTICE_BAR_VERSION, true );
			wp_enqueue_script( 'nb-slick', NOTICE_BAR_FILE_URL . '/js/slick.min.js', array( 'jquery', ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-new-tweecool', NOTICE_BAR_FILE_URL . '/js/tweecool.min.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-new-frontend', NOTICE_BAR_FILE_URL . '/js/nb-frontend.min.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_enqueue_script( 'nb-subscriber', NOTICE_BAR_FILE_URL . '/js/nb-subscribe.min.js', array( 'jquery' ), NOTICE_BAR_VERSION );
			wp_localize_script( 'nb-subscriber', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

			global $post;
			$args   = array( 'post_type' => 'notice-bar', 'posts_per_page' => - 1 );
			$loop   = new WP_Query( $args );
			$params = '';
			$i      = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
				$nid         = get_the_ID();
				$nb_settings = get_post_meta( $post->ID, 'notice_bar_setting', true );

				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'slider' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'slider' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'slider' ) ) {

					$auto_start     = isset( $nb_settings['layout_1']['middle']['slider']['auto_start'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['auto_start'] ) : 0;
					$anim           = isset( $nb_settings['layout_1']['middle']['slider']['animation'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['animation'] ) : 0;
					$show_controls  = isset( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) : 0;
					$slide_duration = '1000';
					if ( isset( $nb_settings['layout_1']['middle']['slider']['slide_duration'] ) && $nb_settings['layout_1']['middle']['slider']['slide_duration'] != '' ) {
						$slide_duration = $nb_settings['layout_1']['middle']['slider']['slide_duration'];
					}
					$slides = '';


					$slidesnid = $slides . $nid;
					$slidesnid = array(
						'auto' => $auto_start,
						'anim' => $anim,
						'con'  => $show_controls,
						'dur'  => $slide_duration
					);

					wp_enqueue_script( 'nb-demo' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );

					wp_localize_script( 'nb-demo' . $nid, 'slides' . $nid, $slidesnid );

				}


				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'twitter-tweets' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'twitter-tweets' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'twitter-tweets' ) ) {

					if ( isset( $nb_settings['tuser'] ) ) {

						$nb_settings['thumb'] = ( isset( $nb_settings['thumb'] ) && $nb_settings['thumb'] != '' ) ? esc_attr( $nb_settings['thumb'] ) : 'true';

						$nb_settings['tno'] = ( isset( $nb_settings['tno'] ) && $nb_settings['tno'] != '' ) ? esc_attr( $nb_settings['tno'] ) : '3';

						if ( $nb_settings['thumb'] == 'true' ) {
							$nb_settings['thumb'] = '1';
						} else {
							$nb_settings['thumb'] = '0';
						}
						$paramsnid = $params . $nid;
						$paramsnid = array(
							'tuser' => $nb_settings['tuser'],
							'tno'   => $nb_settings['tno'],
							'thumb' => $nb_settings['thumb']
						);

						wp_enqueue_script( 'nb-demo-' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );
						wp_localize_script( 'nb-demo-' . $nid, 'params' . $nid, $paramsnid );
					}

				}
				if ( isset( $nb_settings['notice']['section_1']['type'] ) && $nb_settings['notice']['section_1']['type'] == 'news-ticker' || ( isset( $nb_settings['notice']['section_2']['type'] ) && $nb_settings['notice']['section_2']['type'] == 'news-ticker' ) || ( isset( $nb_settings['notice']['section_3']['type'] ) && $nb_settings['notice']['section_3']['type'] == 'news-ticker' ) ) {

					$ticker_label          = isset( $nb_settings['layout_1']['middle']['ticker']['ticker_label'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_label'] ) : '';
					$ticker_direction      = isset( $nb_settings['layout_1']['middle']['ticker']['ticker_direction'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_direction'] ) : 'ltr';
					$ticker_speed          = isset( $nb_settings['layout_1']['middle']['ticker']['ticker_speed'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_speed'] ) : '0.10';
					$ticker_pause_duration = isset( $nb_settings['layout_1']['middle']['ticker']['ticker_pause'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_pause'] ) : '2000';
					$ticker                = '';


					$tickernid = $ticker . $nid;
					$tickernid = array(
						'ticker_label'          => $ticker_label,
						'ticker_direction'      => $ticker_direction,
						'ticker_speed'          => $ticker_speed,
						'ticker_pause_duration' => $ticker_pause_duration
					);


					wp_enqueue_script( 'ticker' . $nid, NOTICE_BAR_FILE_URL . '/js/nb-demo.js', array( 'jquery' ), NOTICE_BAR_VERSION );

					wp_localize_script( 'ticker' . $nid, 'ticker' . $nid, $tickernid );

				}

			endwhile;

		}
		wp_reset_postdata();

	}


}

$obj_frontend_scripts = new Notice_Bar_Frontend_Scripts();