	<?php 


   if((isset($nb_settings['notice']['section_1']['type']) && $nb_settings['notice']['section_1']['type']=='news-ticker') || (isset($nb_settings['notice']['section_2']['type']) && $nb_settings['notice']['section_2']['type']=='news-ticker') || (isset($nb_settings['notice']['section_3']['type']) && $nb_settings['notice']['section_3']['type']=='news-ticker')) 
   {
	$font_color = ($nb_settings['display']['font_color'] == '') ? '#ffffff' : esc_attr( $nb_settings['display']['font_color'] );
	
    $ticker_label = '';

    if(isset($nb_settings['layout_1']['middle']['ticker']['ticker_label']))
    {
        $ticker_label = $nb_settings['layout_1']['middle']['ticker']['ticker_label'];
    }
    if(isset($nb_settings['notice']['section_'.$section]['color']) && $nb_settings['notice']['section_'.$section]['color']!='')
    {
    $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
    }
    else{
        $sec_color = $nb_settings['display']['background_color'];
    }
   
    echo ws_minify_css( 
    '<style>
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .bx-viewport, 
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-swipe,
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-swipe span, 
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-content,
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-wrapper.has-js, 
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker{

        background:  '.esc_attr( $sec_color ).' ;

    }
    
    </style>');
    
    if(isset($ticker_label) && $ticker_label!='')
    {
        $ticker_label_background = $sec_color;
    if(isset($nb_settings['layout_1']['middle']['ticker']['ticker_label_background']) && $nb_settings['layout_1']['middle']['ticker']['ticker_label_background']!='' )
    {
        $ticker_label_background = esc_attr($nb_settings['layout_1']['middle']['ticker']['ticker_label_background']);
    }
    echo 
    ws_minify_css(
    '<style>
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-title { color: '.esc_attr( $font_color ).'; background-color:  '.$ticker_label_background.' ; z-index: 12;}
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .left .nb-right-arw:after{
         color: '.esc_attr( $ticker_label_background ).';
    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .right .nb-right-arw:before{
        border-right-color: '.esc_attr( $ticker_label_background ).'; 
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .nb-right-arw{box-shadow:0 0 2px '.esc_attr( $ticker_label_background ).';
    }
    </style>');
    }
    else{
        echo 
    ws_minify_css(
    '<style>
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker { 

    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .ticker-title { 
        visibility: hidden;
    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .left .nb-right-arw:after{
        visibility: hidden; 
    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .right .nb-right-arw:before{
        visibility: hidden;
    }
    .nb-notice-outer-wrap-'.absint(get_the_ID()).' .nb-notice-wrap .nb-right-arw{
        visibility: hidden;
    }
    </style>');
    }

    }?>