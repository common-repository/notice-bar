<?php
        $position_class = ( isset( $nb_settings['display']['display_position'] ) ) ? 'nb-' . esc_attr( $nb_settings['display']['display_position'] ) : '' ;
        ?> 
        <div class="nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> <?php echo esc_attr( $position_class ) . '-outer'; ?>">
            <div class="nb-notice-wrap <?php echo esc_attr( $position_class ); ?>">
                <?php
                $active_section_count = 0;
                for ($section=1; $section < 4; $section++) { 
                    if( isset( $nb_settings['notice']['section_'.$section]['type'] ) && '' != $nb_settings['notice']['section_'.$section]['type'] && isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_disp'] ) && 1 == $nb_settings['notice']['section_'.$section]['sec'.$section.'_disp'] )
                    {                        
                        $sec_color = ''; 
                        if(isset( $nb_settings['notice']['section_'.$section]['color'] ) && $nb_settings['notice']['section_'.$section]['color']!='' )
                        {
                        $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                        }
                        ?>
                        <div class="section-<?php echo esc_attr( $section ); ?> common-class" style="background: <?php echo esc_attr( $sec_color );?>"> 
                            <?php do_action( 'notice_bar_frontend_section', absint(get_the_ID()), $nb_settings, $section ); ?>
                        </div>
                        <?php
                        $sec_width = ( (isset( $nb_settings['notice']['section_'.$section]['size'] ) ) ? $nb_settings['notice']['section_'.$section]['size'] : '' );
                        $sec_unit = ( (isset( $nb_settings['notice']['section_'.$section]['unit'] ) ) ? $nb_settings['notice']['section_'.$section]['unit'] : '%' );
                        ?>
                        <style>
                            .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.<?php echo esc_attr( $position_class ) . '-outer'; ?> .nb-notice-wrap .section-<?php echo esc_attr( $section ); ?>{
                                width:<?php echo esc_attr($sec_width).esc_attr($sec_unit);?>;
                            }
                        </style>     

                        <?php
                        $active_section_count++;
                    }
                }
                ?>
                <?php
                if ( $nb_settings['display']['close_action'] != 'disable' ) {
                    ?>
                    <a href="javascript:void(0);" class="nb-action nb-<?php echo $nb_settings['display']['close_action'] . '-action'.absint(get_the_ID());?>">
                        <?php echo $nb_settings['display']['close_action']; ?>
                    </a>
                    <?php
                } 
                ?>
            </div>
            <a href="javascript:void(0);" class="nb-toggle-outer<?php echo absint(get_the_ID());?>" style="display:none;"></a>
        </div>
        <?php 
        $cookie_time='';
        if(isset($nb_settings['display']['cookie']) && $nb_settings['display']['cookie']!='' )
        {
            $cookie_time = $nb_settings['display']['cookie'];
        }
        else{
            $cookie_time = 0;
        }
        echo "\n" . ' <!-- Notice Bar START ID: '.absint(get_the_ID()).' START --><script>';
        $scripts = 'jQuery( function( $ ){

            $(".nb-close-action'.absint(get_the_ID()).'").click(function () {
                $(".nb-notice-outer-wrap-'.absint(get_the_ID()).'").slideUp(500,function(){
                    nb_setCookie( "nb_notice_flag'.absint(get_the_ID()).'","yes",1, ' . $cookie_time . ' );
                });
            });
            $("body").addClass("'.esc_attr( $position_class ).'-open");

            $(".nb-toggle-action'.absint(get_the_ID()).'").click(function () {

                $(".nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap").slideUp(500, function () {
                $("body").addClass("'.esc_attr( $position_class ).'-close").removeClass("'.esc_attr( $position_class ).'-open");
                $(this).next("a").addClass("'.esc_attr( $position_class ).'-outer nb-toggle-outer'.absint(get_the_ID()).'").show();
                });
            });
            $(".nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-toggle-outer'.absint(get_the_ID()).'").click(function () {
                $("body").addClass("'.esc_attr( $position_class ).'-open").removeClass("'.esc_attr( $position_class ).'-close");
                $(this).hide();
                $(".nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap").slideDown(500);

            });

            if($("#wpadminbar").length>0 && $("#wpadminbar").is(":visible")){
                $(".nb-top-fixed, .nb-top-absolute, .nb-toggle-outer'.absint(get_the_ID()).'").css("margin-top","32px");
            }

            var myCookie = getCookie("nb_notice_flag'.absint(get_the_ID()).'");
            var closeAction = "'.$nb_settings['display']['close_action'].'";
            if( myCookie !== null && closeAction=="close")
            {
                $( ".nb-notice-outer-wrap-'.absint(get_the_ID()).'" ).hide();
            }
        });';
        echo  ws_minify_js($scripts);
        echo '</script><!-- Notice Bar ID: '.absint(get_the_ID()).' END -->' . "\n";
        ?>
        <?php
        ob_start();
        include( NOTICE_BAR_BASE_PATH . '/css/dynamic-css.php' );        
        include( NOTICE_BAR_BASE_PATH . '/css/front-end-css.php' );

        $css = ob_get_clean();
        echo ws_minify_css( $css ) ;
        ?>