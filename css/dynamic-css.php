<?php
    $background_color = '#dd3333';
    $sec_color = $background_color;
    if(isset($nb_settings['display']['background_color']) && $nb_settings['display']['background_color']!='')
    {
        $background_color = esc_attr($nb_settings['display']['background_color']);
    }

    if(isset($nb_settings['notice']['section_'.$active_section_count]['sec'.$active_section_count.'_disp']))
    {
        $sec_color = (isset( $nb_settings['notice']['section_'.$active_section_count]['color'] ) && $nb_settings['notice']['section_'.$active_section_count]['color'] != '') ? esc_attr( $nb_settings['notice']['section_'.$active_section_count]['color'] ) : $background_color;
    }
    

    $font_color = '#ffffff';
    if(isset($nb_settings['display']['font_color']) && $nb_settings['display']['font_color']!='')
    {
        $font_color = esc_attr($nb_settings['display']['font_color']);
    }
    $top_bottom = (isset( $nb_settings['display']['top_bottom'] ) && $nb_settings['display']['top_bottom'] != '') ? esc_attr( $nb_settings['display']['top_bottom'] ) : '0';
    
    $anchor_link_color = '';
    if(isset( $nb_settings['display']['anchor_link_color'] ) && $nb_settings['display']['anchor_link_color']!='' )
    {
            $anchor_link_color = esc_attr($nb_settings['display']['anchor_link_color']);

    }

    $link_hover_color = (isset( $nb_settings['display']['link_hover_color'] )) ? esc_attr( $nb_settings['display']['link_hover_color'] ) : '';
    $ticker_label_background = (isset($nb_settings['layout_1']['middle']['ticker']['ticker_label_background'] ) && $nb_settings['layout_1']['middle']['ticker']['ticker_label_background'] != '') ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_label_background'] ) : '#000000';
    ?>
    <?php
    $nid = absint(get_the_ID());
    // Here add custom css for the notice types.
    do_action('notice_bar_social_styles', $nb_settings );
    do_action('notice_bar_nb_subscribe_styles', $nb_settings);
    @do_action('notice_bar_ticker_styles', $nid, $sec_color, $nb_settings);
    do_action('notice_bar_nb_cta_styles', $nb_settings);
    ?>

    <style type="text/css">    
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap
        {
            background:<?php echo esc_attr( $background_color ); ?>;
            color:<?php echo esc_attr( $font_color ); ?>;
            font-size:12px;
            overflow: visible;
        }
        .nb-notice-wrap .ticker-wrapper.has-js{
            font-size: 12px;
          /*  margin-top: 1%;*/
        }
        .nb-plain-text-wrap {
            padding: 8px;
            width: 100%;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-plain-text-wrap a,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-slider-wrap<?php echo absint(get_the_ID());?> a, 
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .ticker-content a {color:<?php echo esc_attr( $anchor_link_color ); ?>;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .ticker-content {color:<?php echo esc_attr( $font_color ); ?>;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-plain-text-wrap a:hover,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-slider-wrap<?php echo absint(get_the_ID());?> a:hover, 
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .ticker-content a:hover {color:<?php echo esc_attr( $link_hover_color ); ?>;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-fixed {top: <?php echo esc_attr( $top_bottom ); ?>px; position: fixed; width: 100%; display: inline-flex;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-fixed-outer .nb-toggle-outer<?php echo absint(get_the_ID());?> {top: <?php echo esc_attr( $top_bottom ) + 24; ?>px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute{top:<?php echo esc_attr( $top_bottom ); ?>px; position: absolute; width: 100%; display: inline-flex;}
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>{top:<?php echo esc_attr( $top_bottom ) + 24; ?>px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-bottom{bottom:<?php echo esc_attr( $top_bottom ); ?>px; position: fixed; width: 100%; display: inline-flex;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-bottom-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>{bottom:<?php echo esc_attr( $top_bottom ) + 24; ?>px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap {
            text-align: center;
            box-shadow: 0 0 2px;
            width: 100%;
            z-index: 9999;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap a,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap a:hover,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap a:focus{
            text-decoration:none;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap.nb-top-fixed{
            margin:0;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap.nb-bottom{
            margin:0;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>   .nb-notice-wrap button{
            box-shadow:none;
            margin: 0 23px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-each-icon {
            border-radius: 50%;
            display: inline-block;
            font-size: 15px;
            height: 32px;
            line-height: 31px;
            margin-right: 5px;
            text-align: center;
            transition: all 0.5s ease 0s;
            vertical-align: middle;
            width: 32px;
        }


    /*css for cross button hover effect */

    .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-top-absolute-outer .nb-close-action<?php echo absint(get_the_ID());?>:hover,
    .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-top-absolute-outer .nb-close-action<?php echo absint(get_the_ID());?>:focus{
        color:#fff;}

        /*css for cross button hover effect */
        .nb-close-action<?php echo absint(get_the_ID());?>::after {
            content: "\f00d";
            font-family: Fontawesome;
            font-size: 15px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-bottom-outer .nb-toggle-outer<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            display: inline-block;
            font-size: 0;
            float: right;
            height: 21px;
            line-height: 21px;
            position: fixed;
            right: 10px;
            transition: all 0.5s ease 0s;
            width: 34px;
            z-index: 9999999;
            bottom:0;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-bottom-outer .nb-toggle-action<?php echo absint(get_the_ID());?>
        {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            display: inline-block;
            font-size: 0;
            float: right;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            transition: all 0.5s ease 0s;
            width: 34px;
            z-index: 99;
            bottom: 100%;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-fixed .nb-toggle-action<?php echo absint(get_the_ID());?>
        {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            display: inline-block;
            font-size: 0;
            float: right;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            transition: all 0.5s ease 0s;
            width: 34px;
            z-index: 99;
            top: 100%;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-fixed-outer .nb-toggle-outer<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            position: fixed;
            right: 10px;
            height: 21px;
            line-height: 21px;
            width: 34px;
            text-align: center;
            transition: all 0.5s ease 0s;
            top: 0;
            z-index: 9999999;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>{
            position:absolute;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-toggle-action<?php echo absint(get_the_ID());?>::after,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute-outer .nb-toggle-action<?php echo absint(get_the_ID());?>::after{
            content: "\f102";
            font-family: Fontawesome;
            font-size: 17px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>.nb-bottom-outer::after {
            content: "\f102";
            font-family: Fontawesome;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-fixed-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-top-absolute-outer .nb-toggle-outer{
            line-height: 25px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-absolute-outer .nb-notice-wrap .nb-close-action<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            font-size: 0;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            top: 100%;
            width: 34px;
            z-index: 9999999;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-fixed-outer .nb-notice-wrap.nb-top-fixed .nb-close-action<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            font-size: 0;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            top: 100%;
            width: 34px;
            z-index: 9999999;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-bottom-outer .nb-notice-wrap.nb-bottom .nb-close-action<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            display: inline-block;
            font-size: 0;
            float: right;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            transition: all 0.5s ease 0s;
            width: 34px;
            z-index: 99;
            bottom: 100%;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-absolute-outer .nb-notice-wrap .nb-toggle-action<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color: <?php echo esc_attr( $font_color ); ?>;
            display: inline-block;
            font-size: 0;
            float: right;
            height: 21px;
            line-height: 21px;
            position: absolute;
            right: 0px;
            transition: all 0.5s ease 0s;
            width: 34px;
            z-index: 99;
            top: 100%;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-absolute-outer .nb-toggle-outer<?php echo absint(get_the_ID());?> {
            background-color: <?php echo esc_attr( $sec_color ); ?>;
            color:  <?php echo esc_attr( $font_color ); ?>;
            position: fixed;
            right: 10px;
            height: 21px;
            top:0;
            line-height: 21px;
            width: 34px;
            z-index: 9999999;
            text-align: center;
            transition: all 0.5s ease 0s;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-fixed-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>::after,
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-top-absolute-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>::after
        {
            content: "\f103";
            font-family: Fontawesome;

        }

        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-bottom-outer .nb-notice-wrap.nb-bottom > .nb-toggle-action<?php echo absint(get_the_ID());?>::after
        {
            content: "\f103";
            font-family: Fontawesome;
            font-size: 17px;

        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>.nb-bottom-outer .nb-toggle-outer<?php echo absint(get_the_ID());?>.nb-bottom-outer:after{
            content: "\f102";
            font-family: Fontawesome;
            font-size: 17px;
        }


    /*Media Queries*/
    @media (min-width: 1200px) and (max-width: 1920px) {

    }
    @media (min-width: 992px) and (max-width: 1199px) {
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-plain-text-wrap{
            margin: 10px;
        }
    }
    @media (max-width: 767px) {
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-plain-text-wrap{
            font-size:12px;
           margin: 10px;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .ticker-title{
            display:none;
            visibility:hidden;
            width:0;
        }
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .ticker-content a{
            overflow:auto;
        }
    }
    
    @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?>   .nb-social_icons-wrap .nb-social_icons-label{
            display:inline-block;
            margin-bottom:5px;
        }

    }

    /* Smartphones (landscape) ----------- */
    @media only screen and (max-width : 320px) {
        /* Styles */
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-social_icons-wrap {
            text-align:center;
        }
    }

    /* Smartphones (portrait) ----------- */
    @media only screen and (min-width : 320px) and (max-width : 480px) {
        .nb-notice-outer-wrap-<?php echo absint(get_the_ID());?> .nb-notice-wrap .nb-plain-text-wrap{
            text-align:justify;
        }

    }
    .section-1, .section-2, .section-3 { 
        float: left;
    }
   
    </style>