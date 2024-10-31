<?php
        class Notice_Bar_Plain_Text{
            function __construct(){
                add_filter( 'notice_bar_types_list', array( $this, 'register' ) );
                add_action( 'notice_bar_frontend_section', array( $this, 'add_content' ), 10, 3 );
            }

       /**
         * Plain-text register 
         * 
         * @since 1.0.0
         */
        function register( $notice_types ){
            $notice_types['plain-text'] = array(
                'title' => __( 'Plain Text', 'notice-bar' ),
                'content_callback' => array( $this, 'settings' )
                );
            return $notice_types;
        }

        /**
        * Get marquee direction options.
        *
        * @since    1.0.0
        */
        function get_marquee_options() {

            $options = array(
                    'left'     => __( 'Left Scroll', 'notice-bar' ),
                    'right'    => __( 'Right Scroll', 'notice-bar' ),
                );
            $options = apply_filters( 'notice_bar_marquee_options', $options );
            return $options;

        }
        /**
        * Get marquee direction options.
        *
        * @since    1.0.0
        */
        function get_animate_options() {

            $options = array(
                'marquee'    => __( 'Marquee', 'notice-bar' ),
                'blink'    => __( 'Blink', 'notice-bar' )
                );
            $options = apply_filters( 'notice_bar_animate_options', $options );
            return $options;

        }

        /**
         * Plain-text settings 
         * 
         * @since 1.0.0
         */
        function settings( $nb_settings ){
            ?>

            <div class="nb-notice-type-options nb-plain-text-options">
                <div class="nb-option-field-wrap">
                    <label for="nb_settings[layout_1][middle][notice_text]"><?php echo esc_html__( 'Notice Text', 'notice-bar' ); ?></label>
                    <div class="nb-option-field">
                        <?php
                        $plain_text= '';
                        if(isset($nb_settings['layout_1']['middle']['notice_text']) && $nb_settings['layout_1']['middle']['notice_text']!='')
                        {
                            $allowed_tags = '<a><button><em><br><strong>';  
                            $plain_text = strip_tags($plain_text, $allowed_tags);
                            $plain_text = $nb_settings['layout_1']['middle']['notice_text'];
                        }
                        ?>
                        <textarea id="nb_settings[layout_1][middle][notice_text]" name="nb_settings[layout_1][middle][notice_text]" rows="5"><?php echo esc_html( $plain_text ); ?></textarea>
                        <div class="nb-option-note">
                            <?php echo esc_html__( 'Allowed HTML Tags are : a, button, em, br, strong', 'notice-bar' ); ?>
                        </div>
                    </div>
                </div>  


                <div class="nb-option-field-wrap">
                    <label for="marquee-checkbox"><?php echo esc_html__( 'Animation', 'notice-bar' ); ?></label>
                    <div class="nb-option-field">
                        <input type="checkbox" id="marquee-checkbox" name="nb_settings[layout_1][middle][notice][animate]" value="1" <?php
                        if ( isset( $nb_settings['layout_1']['middle']['notice']['animate'] ) ) {
                            checked( $nb_settings['layout_1']['middle']['notice']['animate'], true );
                        }
                        ?>>
                        <div class="nb-option-note"><?php echo esc_html__( 'Check if you want to have animation on notice text.', 'notice-bar' ); ?>
                        </div>
                    </div>
                </div>     


                <div class="nb-option-field-wrap marqueedir">
                    <label for="nb-animate"><?php echo esc_html__( 'Animation Options', 'notice-bar' ); ?></label>

                    <select id="nb-animate" name="nb_settings[layout_1][middle][notice][animate_type]">
                        <?php
                        $animate_options = $this->get_animate_options();
                        $animate_type = '';
                        if(isset($nb_settings['layout_1']['middle']['notice']['animate_type']) && $nb_settings['layout_1']['middle']['notice']['animate_type']!='')
                        {
                            $animate_type = $nb_settings['layout_1']['middle']['notice']['animate_type'];
                        }
                        ?>
                        <?php if ( ! empty( $animate_options ) ): ?>
                        <?php foreach ( $animate_options as $key => $type ): ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $animate_type, $key ); ?> ><?php echo esc_html( $type ); ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>

            <div class=" marquee-option">
                <label for="nb_settings[layout_1][middle][notice][marquee_type]"><?php echo esc_html__( 'Marquee Type', 'notice-bar' ); ?></label>
                <div class="marquee-select">
                    <select id="nb_settings[layout_1][middle][notice][marquee_type]" name="nb_settings[layout_1][middle][notice][marquee_type]">
                        <?php
                        $marquee_options = $this->get_marquee_options();
                        $marquee_types='';
                        if(isset($nb_settings['layout_1']['middle']['notice']['marquee_type']) && $nb_settings['layout_1']['middle']['notice']['marquee_type']!='')
                        {
                            $marquee_types = $nb_settings['layout_1']['middle']['notice']['marquee_type'];
                        }

                        ?>
                        <?php if ( ! empty( $marquee_options ) ): ?>
                        <?php foreach ( $marquee_options as $key => $type ): ?>
                        <option value="<?php echo esc_attr( $key ); ?>" <?php selected($marquee_types , $key ); ?> ><?php echo esc_html( $type ); ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
        </div>

        <label for="nb_settings[layout_1][middle][notice][marquee_scroll_speed]"><?php echo esc_html__( 'Marquee Speed', 'notice-bar' ); ?></label>
        <input type="number" min="10" step="10" id="nb_settings[layout_1][middle][notice][marquee_scroll_speed]" name="nb_settings[layout_1][middle][notice][marquee_scroll_speed]" value="<?php echo ( isset( $nb_settings['layout_1']['middle']['notice']['marquee_scroll_speed'] ) ? $nb_settings['layout_1']['middle']['notice']['marquee_scroll_speed'] : '90' ); ?>" >
        <div class="nb-option-note"><?php echo esc_html__( 'Please enter the marquee speed in milliseconds. Default speed is 90', 'notice-bar' ); ?></div>
    </div>

    <div class="blink-option">
        <label for="nb_settings[layout_1][middle][notice][blink_speed]"><?php echo esc_html__( 'Blink Speed', 'notice-bar' ); ?></label>
        <div class="marquee-select">
            <input type="number" min="500" step="500" id="nb_settings[layout_1][middle][notice][blink_speed]" name="nb_settings[layout_1][middle][notice][blink_speed]" value="<?php echo ( isset( $nb_settings['layout_1']['middle']['notice']['blink_speed'] ) ? $nb_settings['layout_1']['middle']['notice']['blink_speed'] : '1000' ); ?>" >
        </div>
        <div class="nb-option-note"><?php echo esc_html__( 'Please enter the blink speed in milliseconds. Default speed is 1000', 'notice-bar' ); ?></div>
    </div>
</div>

</div>
<?php
}

/**
 * Plain-text front
 * 
 * @since 1.0.0
 */
function add_content( $post_id, $nb_settings, $section ){
    if( 'plain-text' == $nb_settings['notice']['section_'. $section]['type']){
        ?>
        <div class="nb-plain-text-wrap">
            <?php
            $notice_text = $nb_settings['layout_1']['middle']['notice_text'];
            $allowed_tags = '<a><button><em><br><strong>';  
            $notice_text = strip_tags($notice_text, $allowed_tags);

            if ( isset( $nb_settings['layout_1']['middle']['notice']['animate'] ) && $nb_settings['layout_1']['middle']['notice']['animate']=='1' ) 
            {
                $animate_type = isset( $nb_settings['layout_1']['middle']['notice']['animate_type'] ) ? esc_attr( $nb_settings['layout_1']['middle']['notice']['animate_type'] ) : '';
                if($animate_type=='marquee')
                {
                    $marquee_type = $nb_settings['layout_1']['middle']['notice']['marquee_type'];

                    $marquee_pace = $nb_settings['layout_1']['middle']['notice']['marquee_scroll_speed'];

                    if(!isset($marquee_pace) && $marquee_pace=='')
                    {
                        $marquee_scroll_speed='90';

                    }
                    else{
                        $marquee_scroll_speed =  $nb_settings['layout_1']['middle']['notice']['marquee_scroll_speed'];  
                    }

                    ?>
                    <marquee  onmouseover="this.stop();" onmouseout="this.start();" direction="<?php echo esc_attr($marquee_type);?>" scrolldelay="<?php echo esc_attr($marquee_scroll_speed);?>"><?php echo $notice_text; ?></marquee>
                    <?php

                }        


                if($animate_type=='blink')
                { ?>
                        <span class="blink-text<?php echo absint(get_the_ID());?>"><?php echo $notice_text; ?></span>
                        <?php 
                        $blink_speed = $nb_settings['layout_1']['middle']['notice']['blink_speed'];
                        $blink_script = '<script>
                        jQuery(document).ready(function($){
                            var blink_speed = '.$blink_speed.'
                            function blinker() {
                                $(".blink-text'.absint(get_the_ID()).'").fadeOut();
                                $(".blink-text'.absint(get_the_ID()).'").fadeIn(1000);
                            }
                            setInterval(blinker, blink_speed); 
                        });
                    </script>';
                    echo ws_minify_js($blink_script);
                    ?>
                    <?php
                }
            }

            else
            { 
                echo $notice_text;
            }
            ?>
        </div>
        <?php
    }
}
}

new Notice_Bar_Plain_Text();