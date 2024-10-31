<div class="nb-basic-configurations nb-configurations">
                <h4><?php echo esc_html__( 'Sections', 'notice-bar' ); ?></h4>
                
            <?php
            /**
            * Get unit type options for slider.
            *
            * @since    1.0.0
            */
            function nb_get_unit_type_options() {

                $options = array(
                    '%'             => __( 'Percent', 'notice-bar' ),
                    'px'            => __( 'Pixels', 'notice-bar' ),
                    'em'            => __( 'Em', 'notice-bar' ),
                    );
                $options = apply_filters( 'notice_unit_type_options', $options );
                return $options;

            }

            /**
            * Get notice type options.
            *
            * @since    1.0.0
            */
            function get_notice_type_options() {

                $options = array(
                    'plain-text'        => __( 'Plain text', 'notice-bar' ),
                    'slider'            => __( 'Slider', 'notice-bar' ),
                    'news-ticker'       => __( 'News Ticker', 'notice-bar' ),
                    'nb-subscribe-form' => __( 'Subscribe Form', 'notice-bar' ),
                    'call-to-action'    => __( 'Call To Action', 'notice-bar' ),
                    'shortcodes'        => __( 'Shortcodes', 'notice-bar' ),
                    'twitter-tweets'    => __( 'Twitter Tweets', 'notice-bar' ),
                    'social-icons'      => __( 'Social Icons', 'notice-bar' ),
                    );                
                $options = apply_filters( 'notice_bar_type_options', $options );
                return $options;

            }
            ?>
            <div class="nb-option-note basic"></label><p><?php echo esc_html__( 'Notice bar is divided into 3 sections. Please chooose the below sections according to the requirement.  ', 'notice-bar' ); ?><a href="http://wensolutions.com/documentation/notice-bar/#doc-section-settings-13" target="_blank"><?php echo esc_html__( 'Learn more.', 'notice-bar' ); ?></a></p></div>

            <div class="sections-wrap">
                <ul class="basic-accordion">
                    <?php 
                    for ($nb_sec=1; $nb_sec<4 ; $nb_sec++) { ?>

                        <li>
                            <a class="toggle-basic" href="javascript:void(0);"><label><?php echo esc_html__( 'Section ','notice-bar' ) . esc_html( $nb_sec ); ?></label><span class="dashicons dashicons-arrow-down custom-toggle-basic"></span></a>
                            <div class="nb-option-field-wrap">

                                <div class="section-<?php echo esc_html( $nb_sec );?>-wrap">
                                    <?php 
                                    $nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
                                    if(!isset($nb_settings) || $nb_settings=='')
                                    {
                                        $nb_settings = notice_bar_default_settings();
                                    }
                                    $selected_val = '';
                                    if(isset( $nb_settings['notice']['section_'.$nb_sec]['type']) || !empty($nb_settings['notice']['section_'.$nb_sec]['type']))
                                    {
                                        esc_attr($selected_val = $nb_settings['notice']['section_'.$nb_sec]['type']);
                                    }
                                    ?>
                                    <label for="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][type]"><?php echo esc_html__( 'Type', 'notice-bar' ); ?></label>
                                    <select id="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][type]" name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][type]">
                                        <option value=""><?php echo esc_html__( 'Please select...','notice-bar' ); ?></option>

                                        <?php
                                        $notice_types = get_notice_type_options();
                                        foreach ( $notice_types as $key => $type ): ?>
                                        <?php echo $selected_val;?>
                                        <option value="<?php echo esc_attr( $key ); ?>" <?php esc_attr( selected( $selected_val, $key ) ); ?>><?php echo esc_html( $type ); ?></option>
                                        <?php 
                                        endforeach;?>  
                                    </select> 

                                    <div class="section-size">

                                        <label for="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][size]"><?php echo esc_html__( 'Width', 'notice-bar' ); ?></label>

                                        <input type="number" max="100" min="1" id="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][size]" name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][size]" value="<?php echo ( (isset( $nb_settings['notice']['section_'.$nb_sec]['size'] ) ) ? esc_attr($nb_settings['notice']['section_'.$nb_sec]['size']) : '' ); ?>"/>
                                        <select name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][unit]">
                                            <?php
                                            $unit_options = nb_get_unit_type_options();
                                            $nb_sec_1_unit = isset( $nb_settings['notice']['section_'.$nb_sec]['unit'] ) ? esc_attr($nb_settings['notice']['section_'.$nb_sec]['unit']) : 'percent';
                                            ?>
                                            <?php if ( ! empty( $unit_options ) ): ?>
                                            <?php foreach ( $unit_options as $key => $type ): ?>
                                            <option value="<?php echo esc_attr( $key ); ?>" <?php esc_attr( selected( $nb_sec_1_unit, $key ) ); ?> ><?php echo esc_html( $type ); ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>


                                <div class="nb-option-note-section-size"><?php echo esc_html__( 'Please enter the section-1 size and choose the width unit.', 'notice-bar' ); ?>                   
                                </div>
                            </div>
                        </div>
                        <div class="section-color">
                            <label for="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][color]"><?php echo esc_html__( 'Background Color', 'notice-bar' ); ?></label>
                            <div class="nb-section-color">
                                <input type="text" id="nb_settings[notice][section_<?php echo $nb_sec;?>][color]" name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][color]" class="nb-colorpicker" value="<?php echo ( (isset( $nb_settings['notice']['section_'.$nb_sec]['color'] ) ) ? esc_attr($nb_settings['notice']['section_'.$nb_sec]['color']) : '' ); ?>"/>
                            </div>
                        </div>

                        <div class="nb-option-field-section-enable">
                            <label for="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_disp]"><?php echo esc_html__( 'Enable', 'notice-bar' ); ?></label>
                            <div class="nb-option-field">
                                <label class="nb-plain-label">  
                                    <?php //echo $nb_settings['debug_mode'];?>
                                    <input type="checkbox" value="1" id="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_disp]" name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_disp]" <?php
                                    if ( isset( $nb_settings['notice']['section_'.$nb_sec]['sec'.$nb_sec.'_disp'] ) ) {
                                        checked( $nb_settings['notice']['section_'.esc_html( $nb_sec)]['sec'.esc_html( $nb_sec).'_disp'], true );
                                    }
                                    ?>>
                                    <div class="nb-option-note"><?php echo esc_html__( 'Check if you want to enable section-', 'notice-bar' ) . esc_html( $nb_sec ) ; ?></div>                
                                </label>
                            </div>
                        </div>
                        <div class="nb-option-field-section-enable">
                            <label for="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_mob]"><?php echo esc_html__( 'Disable on mobile', 'notice-bar' ); ?></label>
                            <div class="nb-option-field">
                                <label class="nb-plain-label">  
                                    <?php //echo $nb_settings['debug_mode'];?>
                                    <input type="checkbox" value="1" id="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_mob]" name="nb_settings[notice][section_<?php echo esc_html( $nb_sec );?>][sec<?php echo esc_html( $nb_sec );?>_mob]" <?php
                                    if ( isset( $nb_settings['notice']['section_'.$nb_sec]['sec'.$nb_sec.'_mob'] ) ) {
                                        checked( $nb_settings['notice']['section_'.$nb_sec]['sec'.$nb_sec.'_mob'], true );
                                    }
                                    ?>>
                                    <div class="nb-option-note"><?php echo esc_html__( 'Check if you want to disable section-', 'notice-bar' ).esc_html( $nb_sec ).esc_html__(' in mobile.', 'notice-bar' ); ?></div>

                                </label>
                            </div>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>