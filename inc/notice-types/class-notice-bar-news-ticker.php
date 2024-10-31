<?php
		class Notice_Bar_News_Ticker{
			function __construct(){
				add_filter( 'notice_bar_types_list', array( $this, 'ticker_register' ) );
				add_action( 'notice_bar_frontend_section', array( $this, 'add_ticker' ), 10, 3 );
			}

	        /**
	         * Registers ticker 
	         * 
	         * @since 1.0.0
	         */
			function ticker_register( $notice_types ){
				$notice_types['news-ticker'] = array(
					'title' => __( 'News Ticker', 'notice-bar' ),
					'content_callback' => array( $this, 'ticker_settings' )
					);
				return $notice_types;
			}

	       /**
	         * Ticker settings 
	         * 
	         * @since 1.0.0
	         */
			function ticker_settings( $nb_settings ){
				$nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
				//print_r($nb_settings);
				?>
				<div class="nb-notice-type-options nb-news-ticker-options">
					<div class="nb-option-field-wrap">
						<label for="nb_settings[layout_1][middle][ticker][ticker_label]"><?php echo esc_html__( 'Ticker Label', 'notice-bar' ); ?></label>
						<div class="nb-option-field">
							<?php
							$ticker_label = '';
							if(isset($nb_settings['layout_1']['middle']['ticker']['ticker_label'] ) && $nb_settings['layout_1']['middle']['ticker']['ticker_label']!='')
							{
								
								$ticker_label = $nb_settings['layout_1']['middle']['ticker']['ticker_label'];
							}
							
							?>
							<input type="text" id= "nb_settings[layout_1][middle][ticker][ticker_label]" name="nb_settings[layout_1][middle][ticker][ticker_label]" placeholder="<?php echo esc_html__( 'Latest News', 'notice-bar' ); ?>" value="<?php echo esc_attr($ticker_label);?>"/>
							<div class="nb-option-note"><?php echo esc_html__( 'Please enter the ticker label. Leave blank if you don\'t want to display ticker label.', 'notice-bar' ); ?></div>
						</div>
					</div>
					<div class="nb-option-field-wrap  nb-display-ref nb-news-ticker-ref">
						<label for="nb_settings[layout_1][middle][ticker][ticker_label_background]"><?php echo esc_html__( 'Ticker Label Background', 'notice-bar' ); ?></label>
						<div class="nb-option-field">
							<input type="text" id="nb_settings[layout_1][middle][ticker][ticker_label_background]" name="nb_settings[layout_1][middle][ticker][ticker_label_background]" class="nb-colorpicker"  value="<?php echo isset( $nb_settings['layout_1']['middle']['ticker']['ticker_label_background'] ) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_label_background'] ) : ''; ?>"/>
							<div class="nb-option-note"><?php echo esc_html__( 'Please choose the background color of the ticker label. Leave blank if you want to assign the same background color of the section.', 'notice-bar' ); ?></div>
						</div>
					</div>
					<div class="nb-option-field-wrap">
						<label><?php echo esc_html__( 'Ticker Items', 'notice-bar' ); ?></label>
						<div class="nb-option-field">
							<div class="nb-ticker-append">
								<?php
								$ticker_count = 0;
								if(isset($nb_settings['layout_1']['middle']['ticker']['ticker_items']))
								{
								$ticker_items = $nb_settings['layout_1']['middle']['ticker']['ticker_items'];
								}
								else{
									$tickers = notice_bar_default_settings();
									$ticker_items = $tickers['layout_1']['middle']['ticker']['ticker_items'];

								}	
								foreach ( $ticker_items as $ticker ) {
									$ticker_count++;
									?>
									<div class="nb-each-slide">
										<input type="text" name="nb_settings[layout_1][middle][ticker][ticker_items][]" value="<?php echo esc_attr( $ticker ); ?>"/>
										<?php if ( $ticker_count != 1 ) {
											?>
											<a href="javascript:void(0);" title="Delete Slide" class="nb-remove-slide">x</a>
											<?php }
											?>
										</div>
										<?php
									} 
									?>
									</div>
									<input type="button" class="button-primary nb-new-ticker-trigger" value="<?php echo esc_html__( 'Add New Item', 'notice-bar' ); ?>" data-ticker-name="[layout_1][middle][ticker][ticker_items][]"/>
									<div class="nb-option-note">
                            		<?php echo esc_html__( '"a" tag allowed.', 'notice-bar' ); ?>
                        			</div>
									<div class="nb-option-note"><?php echo esc_html__( 'Please add the ticker text which will fit in the width of the notice bar.', 'notice-bar' ) ?></div>
								</div>
							</div>
							<div class="nb-option-field-wrap">
								<label for="nb_settings[layout_1][middle][ticker][ticker_direction]"><?php echo esc_html__( 'Ticker Direction', 'notice-bar' ); ?></label>
								<div class="nb-option-field">
									<select id="nb_settings[layout_1][middle][ticker][ticker_direction]" name="nb_settings[layout_1][middle][ticker][ticker_direction]">
										<?php 
										$ticker_direction = (isset( $nb_settings['layout_1']['middle']['ticker']['ticker_direction'])) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_direction']) : 'ltr';
										?>                                    
										<option value="ltr" <?php selected( $ticker_direction, 'ltr' ); ?>><?php echo esc_html__( 'Left to right', 'notice-bar' ); ?></option>
										<option value="rtl" <?php selected( $ticker_direction, 'rtl' ); ?>><?php echo esc_html__( 'Right to left', 'notice-bar' ); ?></option>
									</select>
								</div>
							</div>
							<div class="nb-option-field-wrap">
								<label for="nb_settings[layout_1][middle][ticker][ticker_speed]"><?php echo esc_html__( 'Ticker Speed', 'notice-bar' ); ?></label>
								<div class="nb-option-field">
									<?php
									$ticker_speed = (isset( $nb_settings['layout_1']['middle']['ticker']['ticker_speed'])) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_speed']) : '0.10'; ?>                                       

									<input type="text" id="nb_settings[layout_1][middle][ticker][ticker_speed]" name="nb_settings[layout_1][middle][ticker][ticker_speed]" placeholder="0.10" value="<?php echo esc_attr( $ticker_speed ); ?>"/>
									<div class="nb-option-note"><?php echo esc_html__( 'Please enter the reveal speed of ticker. Default value is 0.10 ', 'notice-bar' ); ?></div>
								</div>
							</div>
							<div class="nb-option-field-wrap">
								<label for="nb_settings[layout_1][middle][ticker][ticker_pause]"><?php echo esc_html__( 'Ticker Pause Duration', 'notice-bar' ); ?></label>
								<div class="nb-option-field">
									<?php
									$ticker_pause = (isset( $nb_settings['layout_1']['middle']['ticker']['ticker_pause'])) ? esc_attr( $nb_settings['layout_1']['middle']['ticker']['ticker_pause']) : '2000'; ?>                                       
									<input type="text" id="nb_settings[layout_1][middle][ticker][ticker_pause]" name="nb_settings[layout_1][middle][ticker][ticker_pause]" placeholder="2000"  value="<?php echo esc_attr( $ticker_pause); ?>"/>
									<div class="nb-option-note"><?php echo esc_html__( 'Please enter the pause duration between each ticker item in milliseconds. Default value is 2000', 'notice-bar' ); ?></div>
								</div>
							</div>
						</div>
						<?php
						}
						
				        /**
				         * Frontend ticker 
				         * 
				         * @since 1.0.0
				         */
						function add_ticker( $post_id, $nb_settings, $section ){
							if( 'news-ticker' == $nb_settings['notice']['section_'. $section]['type']){
								?>

								<div class="nb-news-ticker-wrap">
									<ol class="ticker-classx ticker" id="nb-news-ticker<?php echo get_the_ID();?>">
										<?php
										$ticker_items = $nb_settings['layout_1']['middle']['ticker']['ticker_items'];

										if ( count( $ticker_items ) ) {
											foreach ( $ticker_items as $ticker_item ) {
												if($ticker_item!='')
												{
												$allowed_tags = '<a>';  
												$ticker_item = strip_tags($ticker_item, $allowed_tags);
												?>
												<li class="nb-each-ticker">
													<?php echo $ticker_item; ?>
												</li>
												<?php
												}
											}
										}
										?>  
									</ol>
								</div>
								<?php
								

							$ticker_config = "<script>
											jQuery(function($) {
												var speed = ticker".absint(get_the_ID()).".ticker_speed;
													var label = ticker".absint(get_the_ID()).".ticker_label;
													var direction = ticker".absint(get_the_ID()).".ticker_direction;
													var pause_duration = ticker".absint(get_the_ID()).".ticker_pause_duration;


												$('#nb-news-ticker".absint(get_the_ID())."').ticker({
													speed: speed,			
													ajaxFeed: false,
													feedUrl: '',
													feedType: 'xml',
													displayType: 'reveal',
													htmlFeed: true,
													debugMode: true,
													controls: true,
													titleText: label,	
													direction: direction,	
													pauseOnItems: pause_duration,
													fadeInSpeed: 600,
													fadeOutSpeed: 300
												});
											});
										</script>";
						echo ws_minify_js($ticker_config);
			include NOTICE_BAR_BASE_PATH . '/inc/notice-types/news-ticker/news-ticker-styles.php';

			}                
		}
	}
	new Notice_Bar_News_Ticker();