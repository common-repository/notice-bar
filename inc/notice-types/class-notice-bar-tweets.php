<?php

			class Notice_Bar_Tweets{
				function __construct(){
					add_filter( 'notice_bar_types_list', array( $this, 'tweets_register' ) );
					add_action( 'notice_bar_frontend_section', array( $this, 'add_tweets' ), 10, 3 );
				}

		        /**
		         * Twitter register 
		         * 
		         * @since 1.0.0
		         */
				function tweets_register( $notice_types ){
					$notice_types['tweets'] = array(
						'title' => __( 'Twitter Tweets', 'notice-bar' ),
						'content_callback' => array( $this, 'tweets_settings' )
						);
					return $notice_types;
				}

		        /**
		         * Twitter settings 
		         * 
		         * @since 1.0.0
		         */				
				function tweets_settings( $nb_settings ){ ?>
					<div class="nb-notice-type-options nb-twitter-tweets-options">
						<div class="nb-option-field-wrap">
						<?php
						$nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
								if(!isset($nb_settings) || $nb_settings=='')
								{
									$nb_settings = notice_bar_default_settings();
								}
							?>
							<label><?php echo esc_html__( 'Twitter Configuration', 'notice-bar' ); ?></label>
							<div class="nb-option-field twitter">
								<p class="tname"><span class="tuname"><label for="nb_settings[tuser]"><?php echo esc_html__( 'Username:', 'notice-bar' ); ?></label></span><input type="text" id="nb_settings[tuser]" name="nb_settings[tuser]" value="<?php if(isset($nb_settings['tuser'])) { echo esc_attr($nb_settings['tuser']); } ?>"/></p>
								<p class="tweets"><span class="ttname"><label for="nb_settings[tno]"><?php echo esc_html__( 'Number of Tweets:', 'notice-bar' ); ?></label></span><input type="number" id="nb_settings[tno]" name="nb_settings[tno]" value="<?php if(isset($nb_settings['tno'])) { echo esc_attr($nb_settings['tno']); } ?>"/></p>
								<p class="image-label"><span class="proimage"><?php echo esc_html__( 'Profile Image:', 'notice-bar' ); ?></span>
									<?php
									$thumb = (isset( $nb_settings['thumb'])) ? esc_attr( $nb_settings['thumb']) : 'true';
									?>
									<label class="nb-plain-label"><input type="radio" name="nb_settings[thumb]" value="true" class="nb-twitter-thumb" <?php checked( $thumb, 'true' );?>/><?php echo esc_html__( 'Show', 'notice-bar' ); ?></label>
									<label class="nb-plain-label"><input type="radio" name="nb_settings[thumb]" value="false" class="nb-twitter-thumb" <?php checked( $thumb,'false'); ?>/><?php echo esc_html__( 'Hide', 'notice-bar' ); ?></label> </p>
								</div>
							</div>
						</div>
						<?php
					}
					

			       /**
			         * Twitter frontend 
			         * 
			         * @since 1.0.0
			         */
					function add_tweets( $post_id, $nb_settings, $section ){
						if( 'twitter-tweets' == $nb_settings['notice']['section_'. $section]['type']){ 
							$gid = absint(get_the_ID());
							?>
							<ul class="tweecool<?php echo $gid;?>"></ul>
							<?php
							if(isset($nb_settings['tuser']) && $nb_settings['tuser']!='')
							{
								$tweet_script =  
								'<script type="text/javascript">
								jQuery(window).load(function($) {

									var uname = params'.$gid.'.tuser;
									var tno = params'.$gid.'.tno;
									var thumb = params'.$gid.'.thumb;
									if(thumb=="1")
									{
										thumb=true;
									}
									else{
										thumb=false;
									}
									jQuery(".tweecool'.$gid.'").tweecool({

										username: uname,

										limit : tno, 


										profile_image : thumb, 


										show_time : true, 


										show_media : false,


										show_media_size: "thumb",


										show_actions: false,
										action_reply_icon: "&crarr;",
										action_retweet_icon: "&prop;",
										action_favorite_icon: "&#9733;",


										profile_img_url: "profile", 

										show_retweeted_text: false 
									})

								});</script>';
								echo ws_minify_js($tweet_script);
								$anchor_link_color = (isset( $nb_settings['display']['anchor_link_color'] )) ? esc_attr( $nb_settings['display']['anchor_link_color'] ) : '';
   								$link_hover_color = (isset( $nb_settings['display']['link_hover_color'] )) ? esc_attr( $nb_settings['display']['link_hover_color'] ) : '';
								$tweet_style =  
								'<style>
								.tweecool'.$gid.'{
									margin:0  auto !important;
									padding:0;
									display:table;
									
								}
								ul.tweecool'.$gid.' a {
									margin:0px;
									width:100%;
									padding:10px 0;
									color: '.$anchor_link_color.';
								}
								ul.tweecool'.$gid.' a:hover {
									color: '.$link_hover_color.';
								}
								.tweecool'.$gid.' ul li{
									display: none;
								}
								.tweecool'.$gid.' ul li:first-child{
									display: inline-block;
								}
								ul.tweecool'.$gid.' ul {
								    list-style: none;
								    margin-left:10px;
								    margin-right:10px;
								    margin-top:0;
								    margin-bottom:0px;
								}
								.tweecool'.$gid.' ul li{margin-top: 1% ; margin-bottom:1%; }
								.tweecool'.$gid.' ul li a img { float:none; margin-right:1%; height: 30px;width: 30px;border-radius: 100%;}
								.tweets_txt {line-height: 1.2; display:inline-block; font-size:10px;}
								</style>';
								echo ws_minify_js($tweet_style);
								
								$tweet_anim =  
								'<script>

								jQuery(document).ready(function ($) {
									$(function(){
										$(".tweecool'.$gid.' ul li").hide().filter(":first").show();
										setInterval(slideshow, 5000);
									});

									function slideshow() {
										$(".tweecool'.$gid.' ul li:first").delay().fadeOut("2500").next().delay().fadeIn("2500").end().appendTo(".tweecool'.$gid.' ul");
									}
								});

							</script>';
							echo ws_minify_js($tweet_anim);
						}
					}
				}
			}
			new Notice_Bar_Tweets();