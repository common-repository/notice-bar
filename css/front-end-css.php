<?php
        echo
        '<style>
        .nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).' .nb-notice-wrap.'.esc_attr( $position_class ).'.nb-hide{
          visibility:hidden;
        }

        .nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).' .section-1.'.esc_attr( $position_class ).'.nb-show{
          display: inline-flex;
        }
      </style>';
      ?>
      <style>
        .section-1, .section-2, .section-3 { 
          align-items: center;
          display: flex;
          overflow: hidden;

        }
        /*slick */
        .nb-notice-wrap .slick-initialized.slick-slider {
          padding: 0 20px;
          width: 100%;
        }

        .nb-notice-wrap .slick-slider{
            margin-bottom: 0px;
        }

        .nb-notice-wrap .slick-next {
            transform: translate(0,-50%) rotate(360deg) !important;
        }

        .nb-notice-wrap .slick-prev {
            transform: translate(0,-50%) rotate(360deg) !important;
        }
        
        .nb-notice-wrap .slick-slide
        {
            /* display: none; */
            float: left;
            text-align: center;
            padding:  10px;
            height: 100%;
            min-height: 1px;
        }
        .nb-slide-textarea{
          width: 100% !important;
        }

        .nb-notice-wrap  .slick-prev
          {
              left: -20px;
          }
          [dir='rtl'] .slick-prev
          {
              right: -20px;
              left: auto;
          }

          .nb-notice-wrap .slick-next
          {
              right: -20px;
          }
          [dir='rtl'] .slick-next
          {
              right: auto;
              left: -20px;
          }
          .nb-notice-wrap .slick-list{
            max-height:68px;
          }

          /* slick */
        .nb-social_icons-wrap {
          width: 100%;
          padding: 10px 0;
        }
        .nb-form {
         padding: 15px 0;
          display: flex;
          vertical-align: middle;
          margin: 0 auto;
        }
        .nb-shortcodes {
           margin: 0 auto;
           padding: 0 10px;
        }
        
        /*Media Queries*/
        @media (min-width: 1200px) and (max-width: 1920px) {

        }
        @media (min-width: 992px) and (max-width: 1199px) {
        }
        @media (min-width: 768px) and (max-width: 991px) {

        }
        @media (max-width: 767px) {

          .nb-form {
            padding: 15px 0;
          }
          .nb-social_icons {
            margin: 10px 0;
          }
          .nb-notice-wrap.nb-top-absolute, .nb-notice-wrap.nb-bottom, .nb-notice-wrap.nb-top-fixed {
            display: block;
          }
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-3, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-3, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-3
          {
            width: 100% ;
            height: auto !important;
            /*  display: table-cell;*/
          }
          <?php 
          if(isset($nb_settings['display']['disable_for_mobile']))
          {
            echo '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'{
              display: none;
            }';
          }

          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 
          ?>

          <?php 
          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          }
          if(isset($nb_settings['notice']['section_1']['sec1_mob']) && isset($nb_settings['notice']['section_2']['sec2_mob']) && isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).' .nb-notice-wrap.'.esc_attr( $position_class ).' .nb-action{
              display: none !important;
            }';
          } 
          if($position_class == 'nb-bottom')
          {
            for ($section=3; $section > 0; $section--) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }
          }

          else{
            for ($section=1; $section < 4; $section++) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }           
          }
          ?>



          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap.nb-bottom .nb-close-action<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;
          }


          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?> .nb-top-fixed .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap.nb-top-fixed .nb-close-action<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }


          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-close-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }

        }
        @media only screen and (max-width : 640px) {
          .nb-form {
            padding: 15px 0;
          }
          .nb-social_icons {
            margin: 10px 0;
          }
          .nb-notice-wrap.nb-top-absolute, .nb-notice-wrap.nb-bottom, .nb-notice-wrap.nb-top-fixed {
            display: block;
          }
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-3, 
         
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-3, 

          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-3
          {
            width: 100% ;
            height: auto !important;
            /*  display: table-cell;*/
          }
          <?php 
          if(isset($nb_settings['display']['disable_for_mobile']))
          {
            echo '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'{
              display: none;
            }';
          }

          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 
          ?>

          <?php 
          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          }
          if(isset($nb_settings['notice']['section_1']['sec1_mob']) && isset($nb_settings['notice']['section_2']['sec2_mob']) && isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).' .nb-notice-wrap.'.esc_attr( $position_class ).' .nb-action{
              display: none !important;
            }';
          } 
          
          if($position_class == 'nb-bottom')
          {
            for ($section=3; $section > 0; $section--) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }
          }

          else{
            for ($section=1; $section < 4; $section++) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }           
          }
          ?>
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap.nb-bottom .nb-close-action<?php echo esc_attr( get_the_ID() );?>{
            background-color: <?php echo esc_attr($sec_color); ?>;
          }


          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?> .nb-top-fixed .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap.nb-top-fixed .nb-close-action<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }


          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-close-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }

        }



        /* Smartphones (landscape) ----------- */
        @media only screen and (max-width : 320px) {
          /* Styles */
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .section-3, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap .section-3, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-1,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-2,.nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap .section-3
          {
            width: 100% ;
            height: auto !important;
          }
          <?php 
          if(isset($nb_settings['display']['disable_for_mobile']))
          {
            echo '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'{
              display: none;
            }';
          }

          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-absolute-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 
          ?>

          <?php 
          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-bottom-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 
          ?>


          <?php 
          if(isset($nb_settings['notice']['section_1']['sec1_mob']))
          { 
            echo  
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-1{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_2']['sec2_mob']))
          { 
            echo 
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-2{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo   
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).'.nb-top-fixed-outer .nb-notice-wrap .section-3{
              display: none !important;
            }';
          } 

          if(isset($nb_settings['notice']['section_1']['sec1_mob']) && isset($nb_settings['notice']['section_2']['sec2_mob']) && isset($nb_settings['notice']['section_3']['sec3_mob']))
          {
            echo
            '.nb-notice-outer-wrap-'.esc_attr( get_the_ID() ).' .nb-notice-wrap.'.esc_attr( $position_class ).' .nb-action{
              display: none !important;
            }';
          }
          if($position_class == 'nb-bottom')
          {
            for ($section=3; $section > 0; $section--) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }
          }

          else{
            for ($section=1; $section < 4; $section++) { 
              if( !isset( $nb_settings['notice']['section_'.$section]['sec'.$section.'_mob'] ) && isset($nb_settings['notice']['section_'.$section]['sec'.$section.'_disp']) ) 
              {                        
                $sec_color = ''; 
                if(isset( $nb_settings['notice']['section_'.$section]['color'] ))
                {
                  $sec_color =  $nb_settings['notice']['section_'.$section]['color'];
                }
              }
            }           
          }
          ?>
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-bottom-outer .nb-notice-wrap.nb-bottom .nb-close-action<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;
          }

          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?> .nb-top-fixed .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap.nb-top-fixed .nb-close-action<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }
          .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-close-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-notice-wrap .nb-toggle-action<?php echo esc_attr( get_the_ID() );?>, .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-absolute-outer .nb-toggle-outer<?php echo esc_attr( get_the_ID() );?>
          {
            background-color: <?php echo esc_attr($sec_color); ?>;

          }

        }
        /* Notice bar close button css */
        .nb-notice-outer-wrap-<?php echo esc_attr( get_the_ID() );?>.nb-top-fixed-outer .nb-notice-wrap.nb-top-fixed .nb-close-action<?php echo esc_attr( get_the_ID() );?> {
            background-color: #222;
            border-radius: 50%;
            color: #fff;
            font-size: 0;
            height: 25px;
            line-height: 24px;
            position: absolute;
            right: 36px;
            top: 50%;
            transform: translateY(-50%);
            width: 25px;
        }
        .nb-notice-wrap .slick-next {
          transform: translate(0, -50%) rotate(90deg);
        }
        .nb-notice-wrap .slick-prev {
          transform: translate(0, -50%) rotate(-90deg);
        }

      </style>