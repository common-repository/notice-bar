<?php
  // Exit if accessed directly.
  if ( !defined( 'ABSPATH' ) ) {
      exit;
  }

  $old_settings = get_option( 'nb_new_settings' );

  if( !is_array( $old_settings ) || empty( $old_settings ) )
      return;

  $new_notice_bar = array(
    'post_title'    => 'Notice Bar #1',
    'post_status'   => 'publish',
    'post_author'   => get_current_user_id(),
    'post_type'     => NOTICE_BAR_POST_TYPE
  );


  $existing_page = get_page_by_title( $new_notice_bar['post_title'], OBJECT, NOTICE_BAR_POST_TYPE );

  // If notice if already imported exit.
  if ( ! empty( $existing_page ) && 'notice-bar' === $existing_page->post_type )
      return;
  $new_settings = array();
  $new_settings['notice']['section_1']['type'] = $old_settings['layout_1']['middle']['notice_type'];
  $new_settings['notice']['section_1']['size'] = '100';
  $new_settings['notice']['section_1']['unit'] = '%';
  if(isset($old_settings['enable']))
  {
      $new_settings['enable'] = $old_settings['enable'];
  }
  $new_settings['pages']['entire']=1;
  if(isset($old_settings['display']['disable_for_mobile']))
  {
  $new_settings['notice']['section_1']['sec1_mob'] =  $old_settings['display']['disable_for_mobile'];
  $new_settings['display']['disable_for_mobile'] = $old_settings['display']['disable_for_mobile'];
  }

  if(isset($old_settings['enable']))
  {
  $new_settings['notice']['section_1']['sec1_disp'] = $old_settings['enable'];
  }

  if(isset($old_settings['display']['display_position']) && $old_settings['display']['display_position']!='')
  {
  $new_settings['display']['display_position'] = $old_settings['display']['display_position'];
  }

  if(isset($old_settings['layout_1']['middle']['notice_text']) && $old_settings['layout_1']['middle']['notice_text']!='')
  {
    $new_settings['layout_1']['middle']['notice_text'] = $old_settings['layout_1']['middle']['notice_text'];
  }

  if(isset($old_settings['display']['close_action']) && $old_settings['display']['close_action']!='')
  {
  $new_settings['display']['close_action'] = $old_settings['display']['close_action'];
  }

  if(isset($old_settings['display']['background_color']) && $old_settings['display']['background_color']!='')
  {
  $new_settings['display']['background_color'] = $old_settings['display']['background_color'];
  }

  if(isset($old_settings['display']['font_color']) && $old_settings['display']['font_color']!='')
  {
  $new_settings['display']['font_color'] = $old_settings['display']['font_color'] ;
  }

  if(isset($old_settings['display']['anchor_link_color']) && $old_settings['display']['anchor_link_color']!='')
  {
  $new_settings['display']['anchor_link_color'] = $old_settings['display']['anchor_link_color'] ;
  }

  if(isset($old_settings['display']['link_hover_color']) && $old_settings['display']['link_hover_color']!='')
  {
  $new_settings['display']['link_hover_color'] = $old_settings['display']['link_hover_color']; 
  }

  if(isset($old_settings['layout_1']['middle']['ticker']['ticker_label']) && $old_settings['layout_1']['middle']['ticker']['ticker_label']!='')
  {
    $new_settings['layout_1']['middle']['ticker']['ticker_label'] = $old_settings['layout_1']['middle']['ticker']['ticker_label'];
  }

  if(isset($old_settings['layout_1']['middle']['ticker']['ticker_direction']) && $old_settings['layout_1']['middle']['ticker']['ticker_direction']!='')
  {
    $new_settings['layout_1']['middle']['ticker']['ticker_direction'] = $old_settings['layout_1']['middle']['ticker']['ticker_direction'];
  }

  if(isset($old_settings['layout_1']['middle']['ticker']['ticker_speed']) && $old_settings['layout_1']['middle']['ticker']['ticker_speed']!='')
  {
    $new_settings['layout_1']['middle']['ticker']['ticker_speed'] = $old_settings['layout_1']['middle']['ticker']['ticker_speed'];
  }

  if(isset($old_settings['display']['ticker_label_background']) && $old_settings['display']['ticker_label_background']!='')
  {
  $new_settings['layout_1']['middle']['ticker']['ticker_label_background'] = $old_settings['display']['ticker_label_background'];
  }

  if(isset($old_settings['display']['top_bottom']) && $old_settings['display']['top_bottom']!='')
  {
  $new_settings['display']['top_bottom'] = $old_settings['display']['top_bottom'] ; 
  } 

  if(isset($old_settings['layout_1']['middle']['ticker']['ticker_items']))
  {
    
    $new_settings['layout_1']['middle']['ticker']['ticker_items'] = $old_settings['layout_1']['middle']['ticker']['ticker_items'];
  }

  if(isset($old_settings['layout_1']['middle']['ticker']['ticker_pause']) && $old_settings['layout_1']['middle']['ticker']['ticker_pause']!='')
  {
  $new_settings['layout_1']['middle']['ticker']['ticker_pause'] = $old_settings['layout_1']['middle']['ticker']['ticker_pause'];
  }

  if( isset( $old_settings['layout_1']['middle']['slider']['slides'] ) ) {
      $i=0;
      foreach ($old_settings['layout_1']['middle']['slider']['slides'] as $slides) {
          $new_settings['layout_1']['middle']['slider']['slides']['textarea'][$i] = $slides;
          $i++;
      }
  }

  if(isset($old_settings['layout_1']['middle']['slider']['auto_start']))
  {
  $new_settings['layout_1']['middle']['slider']['auto_start'] = $old_settings['layout_1']['middle']['slider']['auto_start'];
  }

  if(isset($old_settings['layout_1']['middle']['slider']['show_controls']))
  {
  $new_settings['layout_1']['middle']['slider']['show_controls'] = $old_settings['layout_1']['middle']['slider']['show_controls'];
  }
  if(isset($old_settings['layout_1']['middle']['slider']['slide_duration']))
  {
  $new_settings['layout_1']['middle']['slider']['slide_duration'] = $old_settings['layout_1']['middle']['slider']['slide_duration'];
  }
  if(isset($old_settings['layout_1']['middle']['social_icons']['label']))
  {
  $new_settings['layout_1']['middle']['social_icons']['label'] = $old_settings['layout_1']['middle']['social_icons']['label'];
  }

  $array1 = array("youtube" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''),"pinterest" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''),"tumblr" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''),"reddit" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''),"flickr" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''),"vine" => array('status' => '0', 'url' =>'' ,'size' =>'' ,'color' =>'' ,'hover' =>''));

  foreach ($array1 as $arr) {
      $new_settings['layout_1']['middle']['social_icons']['icons'] = array_merge( $old_settings['layout_1']['middle']['social_icons']['icons'], $array1 );
  }

  $wppost = wp_insert_post( $new_notice_bar );

  update_post_meta($wppost, 'notice_bar_setting', $new_settings);