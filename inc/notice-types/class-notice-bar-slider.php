<?php
		class Notice_Bar_Slider{
			function __construct(){
				add_filter( 'notice_bar_types_list', array( $this, 'slider_register' ) );
				add_action( 'notice_bar_frontend_section', array( $this, 'add_slider' ), 10, 3 );

			}

	        /**
	         * Slider register 
	         * 
	         * @since 1.0.0
	         */
			function slider_register( $notice_types ){
				$notice_types['slider'] = array(
					'title' => __( 'Slider', 'notice-bar' ),
					'content_callback' => array( $this, 'slider_settings' )
					);
				return $notice_types;
			}

			/**
			* Get animation options for slider.
			*
			* @since    1.0.0
			*/
			function get_animation_options() {

				$options = array(
					'horizontal'    => __( 'Horizontal', 'notice-bar' ),
					'fade'          => __( 'Fade', 'notice-bar' )
					);
				$options = apply_filters( 'notice_bar_animation_options', $options );
				return $options;

			}

	        /**
	         * Slider settings 
	         * 
	         * @since 1.0.0
	         */			
			function slider_settings()
			{ ?>

				<div class="nb-notice-type-options nb-slider-options">
					<div class="nb-option-field-wrap"> 
						<label><?php echo esc_html__( 'Slides','notice-bar' ) ?></label>
						<div class="nb-option-field">

							<div class="nb-slides-append">
								<?php
								$slide_count = 0;

								$maxlen = '';
								$nb_settings = get_post_meta(get_the_ID(), 'notice_bar_setting', true);
								if(!isset($nb_settings) || $nb_settings=='')
								{
									$nb_settings = notice_bar_default_settings();
								}
								if(isset($nb_settings['layout_1']['middle']['slider']['slides']['textarea']))
								{
									$length = sizeof($nb_settings['layout_1']['middle']['slider']['slides']['textarea']);
									$maxlen = $length;
								}

								for($i=0; $i < $maxlen; $i++)
								{                                       

									?>
									<div class="nb-each-slider">
										<textarea placeholder="Slider Text" class="textarea" name="nb_settings[layout_1][middle][slider][slides][textarea][<?php echo $i;?>]"><?php echo ( isset( $nb_settings['layout_1']['middle']['slider']['slides']['textarea'][$i] ) ?$nb_settings['layout_1']['middle']['slider']['slides']['textarea'][$i]:''); ?></textarea>



										<?php if ( $slide_count != 1 ) {
											?>
											<a href="javascript:void(0);" title="Delete Slide" class="nb-remove-slide">x</a>
											<?php
										}
										?>
									</div>
									<?php 
								}
								?>
							<div class="nb-option-note">
                            <?php echo esc_html__( '"a" tag allowed.', 'notice-bar' ); ?>
                        	</div>
							</div>
							<input type="button" class="button-primary nb-new-slide-trigger" value="<?php echo esc_html__( 'Add New Slide', 'notice-bar' ); ?>" data-slide-name="[layout_1][middle][slider][slides]"/>
						</div>
					</div>
					<div class="nb-option-field-wrap">
						<label for="nb_settings[layout_1][middle][slider][auto_start]"><?php echo esc_html__( 'Auto Slide','notice-bar' ); ?></label>
						<div class="nb-option-field">
							<label class="nb-plain-label">

								<input type="checkbox" id="nb_settings[layout_1][middle][slider][auto_start]" name="nb_settings[layout_1][middle][slider][auto_start]" value="1" <?php
								if ( isset( $nb_settings['layout_1']['middle']['slider']['auto_start'] ) && $nb_settings['layout_1']['middle']['slider']['auto_start']==1) {
									checked( $nb_settings['layout_1']['middle']['slider']['auto_start'], true );
								}
								?>>
								<div class="nb-option-side-note"><?php echo esc_html__( 'Check if you want to auto start the slider', 'notice-bar' ); ?></div>
							</label>
						</div>
					</div>


					<div class="nb-option-field-wrap">
						<label for="nb_settings[layout_1][middle][slider][animation]"><?php echo esc_html__( 'Animation','notice-bar' ); ?></label>
						<div class="nb-option-field">
							<select id="nb_settings[layout_1][middle][slider][animation]" name="nb_settings[layout_1][middle][slider][animation]">
								<?php

								$slider_options = $this->get_animation_options(); 
								if(isset($nb_settings['layout_1']['middle']['slider']['animation']))
								{
									$anim = $nb_settings['layout_1']['middle']['slider']['animation'];
								}
								else{
									$anim = '';
								}

								?>
								<?php if ( ! empty( $slider_options ) ): ?>
								<?php foreach ( $slider_options as $key => $type ): ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected($anim, $key ); ?> ><?php echo esc_html( $type ); ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
			</div>

			<div class="nb-option-field-wrap">
				<label for="nb_settings[layout_1][middle][slider][show_controls]"><?php echo esc_html__( 'Show Controls','notice-bar' ); ?></label>
				<div class="nb-option-field">
					<label class="nb-plain-label">
						<?php
						$show_controls =  isset( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) ? esc_attr( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) : 0;
						?>
						<input type="checkbox" id="nb_settings[layout_1][middle][slider][show_controls]" name="nb_settings[layout_1][middle][slider][show_controls]" value="1"<?php
						if ( isset( $nb_settings['layout_1']['middle']['slider']['show_controls'] ) ) {
							checked( $nb_settings['layout_1']['middle']['slider']['show_controls'], true );
						}
						?>>
						<div class="nb-option-side-note"><?php echo esc_html__( 'Check if you want to show slider controls', 'notice-bar' ); ?></div>
					</label>
				</div>
			</div>
			<div class="nb-option-field-wrap">
				<label for="nb_settings[layout_1][middle][slider][slide_duration]"><?php echo esc_html__( 'Slide Duration', 'notice-bar' ); ?></label>
				<div class="nb-option-field">
				<?php
				$slide_duration = 1000;
				if(isset($nb_settings['layout_1']['middle']['slider']['slide_duration']) && $nb_settings['layout_1']['middle']['slider']['slide_duration']!='')
				{
					$slide_duration = $nb_settings['layout_1']['middle']['slider']['slide_duration']; 
				}
				?>
					<input type="number" id="nb_settings[layout_1][middle][slider][slide_duration]" name="nb_settings[layout_1][middle][slider][slide_duration]" placeholder="1000" value="<?php echo esc_html($slide_duration); ?>" min="0" step="100"/>
					<div class="nb-option-note"><?php echo esc_html__( 'Please enter the slide duration in milliseconds. Default duration is 1000', 'notice-bar' ); ?></div>
				</div>
			</div>
		</div> 
		<?php } 

		/**
         * Slider front-end 
         * 
         * @since 1.0.0
         */
		function add_slider( $post_id, $nb_settings, $section ){
			if( 'slider' == $nb_settings['notice']['section_'. $section]['type']){ ?>

				<div class="nb-slider-wrap<?php echo absint(get_the_ID());?>"> 

					<?php
					$slides = $nb_settings['layout_1']['middle']['slider']['slides'];
					$maxlen = sizeof($slides['textarea']);
					if ( count( $slides ) ) {
						for($i=0; $i<$maxlen; $i++)
						{ 
							$slide = $slides['textarea'][$i];
							if($slide!='')
							{
							$allowed_tags = '<a>';  
							$slide_item = strip_tags($slide, $allowed_tags);
							?>
							<div class="nb-each-slide"><div class="nb-slide-textarea"><?php echo $slide_item;?></div></div>
							<?php
							}
						}
						$i++;
					} ?>
				</div>

				<?php
				$slider_script = '<script>
				jQuery(document).ready(function($){
					var slide_duration = slides'.absint(get_the_ID()).'.dur;
					var controls = slides'.absint(get_the_ID()).'.con;
					if(controls=="1")
					{
						controls=true;
					}
					else{
						controls=false;
					}

					var auto_start = slides'.absint(get_the_ID()).'.auto;
					if(auto_start=="1")
					{
						auto_start=true;
					}
					else{
						auto_start=false;
					}

					var anim = slides'.absint(get_the_ID()).'.anim;
					if(anim=="fade")
					{
						$(".nb-slider-wrap'.absint(get_the_ID()).'").slick({
							autoplay: auto_start,
							dots: false,
							speed: 1000,
							arrows: controls,
							infinite: true,
							fade: true,
							autoplaySpeed: slide_duration,
							
						}); 
					}

					else{
						$(".nb-slider-wrap'.absint(get_the_ID()).'").slick({
							autoplay: auto_start,
							dots: false,
							speed: 1000,
							arrows: controls,
							slidesToScroll: 1,
							infinite: true,
							autoplaySpeed: slide_duration,
							slidesToShow: 1
							
						});

					}  

				});
			</script>';
			echo ws_minify_js($slider_script);
		}
	}
}
new Notice_Bar_Slider();