<?php
			class Notice_Bar_Nb_Subscribe{
				function __construct(){
					add_filter( 'notice_bar_types_list', array( $this, 'subscribe_register' ) );
					add_action( 'notice_bar_frontend_section', array( $this, 'add_nb_subscribe' ), 10, 3 );
					add_action( 'notice_bar_nb_subscribe_styles', array( $this, 'add_nb_subscribe_styles' ) );

				}
		        /**
		         * Registers subscriber post type. 
		         * 
		         * @since 1.0.0
		         */				
				function subscribe_register( $notice_types ){
					$notice_types['nb-subscribe-form'] = array(
						'title' => __( 'NB Subscribe Form', 'notice-bar' ),
						'content_callback' => array( $this, 'nb_subscribe_settings' )
						);
					return $notice_types;
				}
		        
		        /**
		         * Creates settings for subscribe form 
		         * 
		         * @since 1.0.0
		         */
				function nb_subscribe_settings()
				{ 
				$nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
				?>
					<div class="nb-notice-type-options nb-subscribe-form-options">
                    <div class="nb-option-field-wrap">
                        <label for="nb_settings[aemail]"><?php echo esc_html__( 'Admin Email', 'notice-bar' ); ?></label>
                        <div class="nb-option-field twitter">
                        <?php  $admin_email = get_option( 'admin_email' ); 
                               if(isset($nb_settings['aemail']) && $nb_settings['aemail']!='')
                               {
                                $admin_email = $nb_settings['aemail'];
                               }
                            ?>
                        <input type="mail" id="nb_settings[aemail]" name="nb_settings[aemail]" value="<?php echo esc_attr($admin_email);?>"/></p>
                        </div>
                    </div>
                </div>
                <?php
            	}
            	function add_nb_subscribe( $post_id, $nb_settings, $section ){
				if( 'nb-subscribe-form' == $nb_settings['notice']['section_'. $section]['type']){
					?>
				<div class="nb-form"><?php echo do_shortcode('[nb_subscribe]');?></div>
				<?php
			}
		}

   /**
	* Add styles for subscribe form. 
 	* 
 	* @since 1.0.0
 	*/
	
	function add_nb_subscribe_styles( $nb_settings ){
            include NOTICE_BAR_BASE_PATH . '/inc/notice-types/nb-subscribe/nb-subscribe-styles.php';
            
    }

	}
	new Notice_Bar_Nb_Subscribe();