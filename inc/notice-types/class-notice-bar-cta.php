<?php
	class Notice_Bar_Cta{
			function __construct(){
				add_filter( 'notice_bar_types_list', array( $this, 'cta_register' ) );
				add_action( 'notice_bar_frontend_section', array( $this, 'add_cta' ), 10, 3 );
				add_action( 'notice_bar_nb_cta_styles', array( $this, 'add_nb_cta_styles' ) );

			}

		    /**
		     * CTA register  
		     * 
		     * @since 1.0.0
		     */
			function cta_register( $notice_types ){
				$notice_types['call-to-action'] = array(
					'title' => __( 'Call to Action', 'notice-bar' ),
					'content_callback' => array( $this, 'cta_settings' )
					);
				return $notice_types;
			}

		    /**
		     * CTA settings  
		     * 
		     * @since 1.0.0
		     */			
			function cta_settings( $nb_settings ){ ?>
				<div class="nb-notice-type-options nb-cta-options">
                    <div class="nb-option-field-wrap">
                        <label><?php echo esc_html__( 'Call To Action', 'notice-bar' ); ?></label>
                        <div class="nb-option-field">
                            <p class="cta-text"><span class="ct-text"><label for="nb_settings[cta-text]"><?php echo esc_html__( 'CTA Button Text: ', 'notice-bar' ); ?></label></span><input type="text" id="nb_settings[cta-text]" name="nb_settings[cta-text]" value="<?php if(isset($nb_settings['cta-text'])) { echo esc_attr($nb_settings['cta-text']); } ?>"/></p>
                            <p class="cta-link"><span class="cta-nlink"><label for="nb_settings[cta-link]"><?php echo esc_html__( 'CTA Button Link: ', 'notice-bar' ); ?></label></span><input type="text" name="nb_settings[cta-link]" id="nb_settings[cta-link]" value="<?php if(isset($nb_settings['cta-link'])) { echo esc_url($nb_settings['cta-link']); } ?>"/></p>
                            <p class="cta-tarea"><span class="cta-nlink"><label for="nb_settings[cta-textarea]"><?php echo esc_html__( 'CTA Text: ', 'notice-bar' ); ?></label><textarea placeholder="<?php echo esc_html__('Please make call to action description short...','notice-bar');?>" id="nb_settings[cta-textarea]" name="nb_settings[cta-textarea]" rows="5"><?php if(isset($nb_settings['cta-textarea'])){ echo esc_attr( $nb_settings['cta-textarea'] ); } ?></textarea></p>
                        </div>
                    </div>
                </div>
                <?php
                }

                /**
			     * CTA front-end  
			     * 
			     * @since 1.0.0
			     */
				function add_cta( $post_id, $nb_settings, $section ){
					if( 'call-to-action' == $nb_settings['notice']['section_'. $section]['type']){
						 	$cta_textarea = (isset($nb_settings['cta-textarea']) && $nb_settings['cta-textarea']!='') ? esc_attr($nb_settings['cta-textarea']):'';
						  	$cta_link = (isset($nb_settings['cta-link']) && $nb_settings['cta-link']!='') ? esc_attr($nb_settings['cta-link']):'#';
						   	$cta_text = (isset($nb_settings['cta-text']) && $nb_settings['cta-text']!='') ? esc_attr($nb_settings['cta-text']):'Button';
						?>
						<div class="nb-cta"><div class="nb-cta-textarea"><?php echo esc_attr($cta_textarea);?></div><div class="nb-cta-btn"><a href="<?php echo esc_url($cta_link);?>" target="_blank"><?php echo esc_attr($cta_text);?></a></div></div>
						<?php
					}
				}

			    /**
			     * Add CTA styles  
			     * 
			     * @since 1.0.0
			     */
				function add_nb_cta_styles( $nb_settings ){
            	include NOTICE_BAR_BASE_PATH . '/inc/notice-types/nb-cta/nb-cta-styles.php';
    			}		
			}
			new Notice_Bar_Cta();