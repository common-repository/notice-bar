<?php

		class Notice_Bar_Shortcodes{
			function __construct(){
				add_filter( 'notice_bar_types_list', array( $this, 'shortcodes_register' ) );
				add_action( 'notice_bar_frontend_section', array( $this, 'add_shortcodes' ), 10, 3 );
			}
			
			/**
             * Shortcode register 
             * 
             * @since 1.0.0
             */ 
			function shortcodes_register( $notice_types ){
				$notice_types['shortcodes'] = array(
					'title' => __( 'Shortcodes', 'notice-bar' ),
					'content_callback' => array( $this, 'shortcodes_settings' )
					);
				return $notice_types;
			}

			/**
             * Shortcode setting register 
             * 
             * @since 1.0.0
             */ 
			function shortcodes_settings( $nb_settings ){ ?>
				<div class="nb-notice-type-options nb-shortcodes-options">
                    <div class="nb-option-field-wrap">
                        <label for="nb_settings[shortcode]"><?php echo esc_html__( 'Newsletter Form Shortcode', 'notice-bar' ); ?></label>
                        <div class="nb-option-field">
                            <textarea id="nb_settings[shortcode]" name="nb_settings[shortcode]"><?php if(isset($nb_settings['shortcode'])) { echo $nb_settings['shortcode']; } ?></textarea>
                            <div class="nb-option-note">
                                <?php echo esc_html__( "You can put a newsletter form as well as contact form shortcode here.", 'notice-bar' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
				
				/**
                 * Shortcode setting 
                 * 
                 * @since 1.0.0
                 */ 
				function add_shortcodes( $post_id, $nb_settings, $section ){
					if( 'shortcodes' == $nb_settings['notice']['section_'. $section]['type']){
						if(isset($nb_settings['shortcode']))
    						{
        					$nb_sc = $nb_settings['shortcode'];
    						}
						?>

					<div class="nb-shortcodes"><?php echo do_shortcode($nb_sc);?></div>
					<?php
				}
			}
		}
		new Notice_Bar_Shortcodes();
