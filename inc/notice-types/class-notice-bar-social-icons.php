<?php
			class Notice_Bar_social_icons{
				function __construct(){
					add_filter( 'notice_bar_types_list', array( $this, 'social_icons_register' ) );
                    add_action( 'notice_bar_frontend_section', array( $this, 'add_social_icons' ), 10, 3 );
					add_action( 'notice_bar_social_styles', array( $this, 'add_styles' ) );
				}

                /**
                 * Social icons register 
                 * 
                 * @since 1.0.0
                 */                
				function social_icons_register( $notice_types ){
					$notice_types['social_icons'] = array(
						'title' => __( 'Social Icons', 'notice-bar' ),
						'content_callback' => array( $this, 'social_icons_settings' )
						);
					return $notice_types;
				}

                /**
                 * Social icons settings 
                 * 
                 * @since 1.0.0
                 */                
				function social_icons_settings( $nb_settings ){ 
					?>
					<div class="nb-notice-type-options nb-social_icons-options">
                        <div class="nb-option-field-wrap">
                            <label for="nb_settings[layout_1][middle][social_icons][label]"><?php echo esc_html__( 'Social Icons Label', 'notice-bar' ); ?></label>
                            <div class="nb-option-field">
                             <?php
                             $social_label = (isset( $nb_settings['layout_1']['middle']['social_icons']['label'])) ? esc_attr( $nb_settings['layout_1']['middle']['social_icons']['label']) : 'Follow Us'; ?>
                                <input type="text" id="nb_settings[layout_1][middle][social_icons][label]" name="nb_settings[layout_1][middle][social_icons][label]" placeholder="<?php echo esc_html__( 'Follow Us', 'notice-bar' ); ?>" value="<?php echo esc_attr($social_label);?>"/>
                                <div class="nb-option-note"><?php echo esc_html__( 'This Label will show just before social icons. Please leave blank if you don\'t want to display the label', 'notice-bar' ); ?></div>
                            </div>
                        </div>
                        <div class="nb-option-field-wrap">
                            <label><?php echo esc_html__( 'Social Icons', 'notice-bar' ); ?></label>
                            <div class="nb-option-field nb-sortable-icons">
                                <ul class="social-accordion">
                                <?php
								$nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
                                if(!isset($nb_settings['layout_1']['middle']['social_icons']) || empty($nb_settings['layout_1']['middle']['social_icons']))
                                {
                                    $social_media = notice_bar_default_settings();
                                    $social_icons = $social_media['layout_1']['middle']['social_icons']['icons'];
                                }
                                else{
                                    $social_icons = $nb_settings['layout_1']['middle']['social_icons']['icons'];
                                }
                                $i=0;
                                foreach ( $social_icons as $icon => $icon_detail ) {
                                    $status = isset( $icon_detail['status'] ) ? $icon_detail['status'] : 0;
                                    ?>
                                    <li>
                                    <a class="toggle-social" href="javascript:void(0);"><div class="icon-name"><i class="fa fa-<?php echo esc_attr( $icon ); ?>"></i><?php echo esc_html($icon); ?></div><span class="dashicons dashicons-arrow-down custom-toggle-social"></span></a>
                                    <div class="nb-each-social-icon">
                                    <div class="nb-each-social-icon-inside">
                                        <label class="nb-plain-label">
                                            <div class="nb-inner-option-wrap">
                                                <span class="nb-inner-label url"><?php echo esc_html__( 'URL', 'notice-bar' ); ?></span>
                                                <input type="text" name="nb_settings[layout_1][middle][social_icons][icons][<?php echo $icon; ?>][url]" value="<?php echo esc_url( $icon_detail['url'] ); ?>"/>
                                            </div>
                                        </label>
                                        
                                         <label class="nb-plain-label">
                                            <div class="nb-inner-option-wrap">
                                                <span class="nb-inner-label"><?php echo esc_html__( 'Icon Color', 'notice-bar' ); ?></span>
                                                <input type="text" name="nb_settings[layout_1][middle][social_icons][icons][<?php echo $icon; ?>][color]" value="<?php echo isset( $icon_detail['color']) ? esc_attr($icon_detail['color'] ) : ''; ?>" class="nb-default-color-field" data-default-color="#dd3333"/>
                                            </div>
                                        </label> 
                                        <label class="nb-plain-label">
                                            <div class="nb-inner-option-wrap">
                                                <span class="nb-inner-label"><?php echo esc_html__( 'Icon Background Color', 'notice-bar' ); ?></span>
                                                <input type="text" name="nb_settings[layout_1][middle][social_icons][icons][<?php echo $icon; ?>][bg]" value="<?php echo isset( $icon_detail['bg']) ? esc_attr($icon_detail['bg'] ) : ''; ?>" class="nb-default-color-field" data-default-color="#dd3333"/>
                                            </div>
                                        </label>

                                         <label class="nb-plain-label">
                                            <div class="nb-inner-option-wrap">
                                                <span class="nb-inner-label"><?php echo esc_html__( 'Icon Hover Color', 'notice-bar' ); ?></span>
                                                <input type="text" name="nb_settings[layout_1][middle][social_icons][icons][<?php echo $icon; ?>][hover]" value="<?php echo isset( $icon_detail['hover']) ? esc_attr($icon_detail['hover'] ) : ''; ?>" class="nb-default-color-field" data-default-color="#dd3333"/>
                                            </div>
                                        </label>

                                        <label class="nb-plain-label">

                                            <div class="nb-inner-option-wrap">
                                                <span class="nb-inner-label"><?php echo esc_html__( 'Icon Background Hover Color', 'notice-bar' ); ?></span>
                                                <input type="text" name="nb_settings[layout_1][middle][social_icons][icons][<?php echo $icon; ?>][hbg]" value="<?php echo isset( $icon_detail['hbg']) ? esc_attr($icon_detail['hbg'] ) : ''; ?>" class="nb-default-color-field" data-default-color="#dd3333"/>
                                            </div>
                                        </label>
                                          
                                    </div>

                                    <span class="nb-drag-icon"></span>
                            
                                    </div>
                                    </li>
                                    <?php
                                    
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                    }

                    /**
                     * Social icons frontend 
                     * 
                     * @since 1.0.0
                     */                    
					function add_social_icons( $post_id, $nb_settings, $section ){ 
                    $nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);

					if( isset($nb_settings['notice']) && 'social-icons' == $nb_settings['notice']['section_'. $section]['type']){ ?>

					<div class="nb-social_icons-wrap">
			            <?php 
			            $social_icons = $nb_settings['layout_1']['middle']['social_icons'];
			            if ( isset($social_icons['label']) && $social_icons['label'] != '' ) { ?><span class="nb-social_icons-label"><?php echo esc_attr( $social_icons['label'] ); ?></span><?php } ?>
			            <div class="nb-social_icons">
			                <?php
			                foreach ( $social_icons['icons'] as $icon_name => $icon_detail ) {
			                    if ( $icon_detail['url'] != '' ) {
			                        ?>
			                        <a href="<?php echo esc_url( $icon_detail['url'] ); ?>" target="_blank" title="<?php echo $icon_name ?>" class="nb-each-icon nb-<?php echo $icon_name ?>" rel="nofollow">
			                            <span class="nb-social-icon-<?php echo absint(get_the_ID());?>"><i class="fa fa-<?php echo esc_attr($icon_name); ?>"></i></span>
			                        </a>
			                        <?php
			                    }

			                }
			                ?>
			            </div>
			        </div>
			        <?php
			    }
			}

            function add_styles( $nb_settings ){
                include NOTICE_BAR_BASE_PATH . '/inc/notice-types/social-icons/social-icons-styles.php';
            }
		}
	new Notice_Bar_social_icons();