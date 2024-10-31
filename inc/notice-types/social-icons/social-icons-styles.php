    <?php

    if($nb_settings['notice']['section_1']['type']=='social-icons' || (isset($nb_settings['notice']['section_2']['type']) && $nb_settings['notice']['section_2']['type']=='social-icons') || (isset($nb_settings['notice']['section_3']['type']) && $nb_settings['notice']['section_3']['type']=='social-icons')) 
    {

        $icon_color_fb = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['color']):'#000000';
        $icon_hover_background_fb = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hbg']) &&  $nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hbg']): '';
        $icon_background_fb = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['bg']):'#ffffff';
        $icon_hover_color_fb = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['facebook']['hover']):'';

        $icon_color_tw = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['color']):'#000000';
        $icon_hover_background_tw = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hbg']):'';
        $icon_background_tw = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['bg']):'#ffffff';
        $icon_hover_color_tw = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['twitter']['hover']):'';

        $icon_color_gp = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['color']):'#000000';
        $icon_hover_background_gp = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hbg']):'' ;
        $icon_background_gp = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['bg']):'#ffffff';
        $icon_hover_color_gp = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['google-plus']['hover']):'';


        $icon_color_in = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['color']):'#000000';
        $icon_hover_background_in = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hbg']):'' ;
        $icon_background_in = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['bg']):'#ffffff';
        $icon_hover_color_in = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['instagram']['hover']):'';

        $icon_color_li = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['color']):'#000000';
        $icon_hover_background_li = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hbg']):'' ;
        $icon_background_li = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['bg']):'#ffffff';
        $icon_hover_color_li = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['linkedin']['hover']):'';


        $icon_color_yt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['color']):'#000000';
        $icon_hover_background_yt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hbg']):'';
        $icon_background_yt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['bg']):'#ffffff';
        $icon_hover_color_yt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['youtube']['hover']):'';


        $icon_color_pi = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['color']):'#000000';
        $icon_hover_background_pi = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hbg']):'';
        $icon_background_pi = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['bg']):'#ffffff';
        $icon_hover_color_pi = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['pinterest']['hover']):'';


        $icon_color_tu = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['color']):'#000000';
        $icon_hover_background_tu = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hbg'])&& $nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hbg']):'';
        $icon_background_tu = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['bg']):'#ffffff';
        $icon_hover_color_tu = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['hover']):'';


        $icon_color_rt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['tumblr']['color']):'#000000';
        $icon_hover_background_rt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hbg']):'';
        $icon_background_rt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['bg']):'#ffffff';
        $icon_hover_color_rt = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['reddit']['hover']):'';


        $icon_color_fr = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['color']):'#000000';
        $icon_hover_background_fr = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hbg']):'';
        $icon_background_fr = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['bg']):'#ffffff';
        $icon_hover_color_fr = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['flickr']['hover']):'';


        $icon_color_vn = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['color']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['color']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['color']):'#000000';
        $icon_hover_background_vn = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hbg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hbg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hbg']):'';
        $icon_background_vn = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['bg']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['bg']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['bg']):'#ffffff';
        $icon_hover_color_vn = (isset($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hover']) && $nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hover']!='') ? esc_attr($nb_settings['layout_1']['middle']['social_icons']['icons']['vine']['hover']):'';

        echo
        ws_minify_css('<style>

            .nb-social-icon-'.absint(get_the_ID()).' .fa-facebook {
            background: '.esc_attr( $icon_background_fb ).';
            color: '.esc_attr( $icon_color_fb ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-facebook:hover {
            background: '.esc_attr( $icon_hover_background_fb ).';
            color: '.esc_attr( $icon_hover_color_fb ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-twitter {
            background: '.esc_attr( $icon_background_tw ).';
            color: '.esc_attr( $icon_color_tw ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-twitter:hover {
            background: '.esc_attr( $icon_hover_background_tw ).';
            color: '.esc_attr( $icon_hover_color_tw ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-linkedin {
            background: '.esc_attr( $icon_background_li ).';
            color: '.esc_attr( $icon_color_li )  .';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-linkedin:hover {
            background: '.esc_attr( $icon_hover_background_li ).';
            color: '.esc_attr( $icon_hover_color_li ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-instagram {
            background: '.esc_attr( $icon_background_in ).';
            color: '.esc_attr( $icon_color_in ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-instagram:hover {
            background: '.esc_attr( $icon_hover_background_in ).';
            color: '.esc_attr( $icon_hover_color_in ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-google-plus {
            background: '.esc_attr( $icon_background_gp ).';
            color: '.esc_attr( $icon_color_gp ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-google-plus:hover {
            background: '.esc_attr( $icon_hover_background_gp ).';
            color: '.esc_attr( $icon_hover_color_gp ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-youtube {
            background: '.esc_attr( $icon_background_yt ).';
            color: '.esc_attr( $icon_color_yt ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-youtube:hover {
            background: '.esc_attr( $icon_hover_background_yt ).';
            color: '.esc_attr( $icon_hover_color_yt ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-pinterest {
            background: '.esc_attr( $icon_background_pi ).';
            color: '.esc_attr( $icon_color_pi ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-pinterest:hover {
            background: '.esc_attr( $icon_hover_background_pi ).';
            color: '.esc_attr( $icon_hover_color_pi ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-tumblr {
            background: '.esc_attr( $icon_background_tu ).';
            color: '.esc_attr( $icon_color_tu ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-tumblr:hover {
            background: '.esc_attr( $icon_hover_background_tu ).';
            color: '.esc_attr( $icon_hover_color_tu ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-reddit {
            background: '.esc_attr( $icon_background_rt ).';
            color: '.esc_attr( $icon_color_rt ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-reddit:hover {
            background: '.esc_attr( $icon_hover_background_rt ).';
            color: '.esc_attr( $icon_hover_color_rt ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-flickr {
            background: '.esc_attr( $icon_background_fr ).';
            color: '.esc_attr( $icon_color_fr ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-flickr:hover {
            background: '.esc_attr( $icon_hover_background_fb ).';
            color: '.esc_attr( $icon_hover_color_fr ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-vine {
            background: '.esc_attr( $icon_background_vn ).';
            color: '.esc_attr( $icon_color_vn ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
            span.nb-social_icons-label {
                font-size: 14px;
            }
            .nb-social_icons {
               margin-top: 4px;
            }
            .nb-social-icon-'.absint(get_the_ID()).' .fa-vine:hover {
            background: '.esc_attr( $icon_hover_background_vn ).';
            color: '.esc_attr( $icon_hover_color_vn ).';
            display: block;
            border-radius: 50%;
            padding: 5px;
            height: 25px;
            width: 25px;
            }
        </style>');
    }