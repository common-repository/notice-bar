<?php
$current_offset = get_option( 'gmt_offset' );
$tzstring       = get_option( 'timezone_string' );

$check_zone_info = true;

// Remove old Etc mappings. Fallback to gmt_offset.
if ( false !== strpos( $tzstring, 'Etc/GMT' ) ) {
	$tzstring = '';
}

if ( empty( $tzstring ) ) { // Create a UTC+- zone if no timezone string exists
	$check_zone_info = false;
	if ( 0 == $current_offset ) {
		$tzstring = 'UTC+0';
	} elseif ( $current_offset < 0 ) {
		$tzstring = 'UTC' . $current_offset;
	} else {
		$tzstring = 'UTC+' . $current_offset;
	}
}

@date_default_timezone_set( $tzstring );
?>
<style>
	.collapse{display:none}.collapse.in{display:block}
</style>

<div class="nb-visibility-configurations nb-configurations" style="display:none">
    <h4><?php echo esc_html__( 'Visibility', 'notice-bar' ); ?></h4>
    <div class="nb-option-field-wrap">
        <label for="notice-enable-check"><?php echo esc_html__( 'Enable Notice', 'notice-bar' ); ?></label>
        <div class="nb-option-field">
            <label class="nb-plain-label">
                <input type="checkbox" value="1" id="notice-enable-check" name="nb_settings[enable]" <?php
				if ( isset( $nb_settings['enable'] ) ) {
					checked( $nb_settings['enable'], true );
				}
				?>>
                <div class="nb-option-note"><?php echo esc_html__( 'Check if you want to enable notice in frontend. Please choose the display options for notice bar below.', 'notice-bar' ); ?></div>
            </label>
        </div>
    </div>
    <div class="nb-option-field-wrap">
        <label for="nb_settings[display][time][after]"><?php echo esc_html__( 'Display After', 'notice-bar' ); ?></label>
        <div class="nb-option-field">
			<?php
			$display_after = '';
			if ( isset( $nb_settings['display']['time']['after'] ) ) {
				$display_after = esc_attr( $nb_settings['display']['time']['after'] );
			}
			?>
            <input type="number" min="1000" step="500" id="nb_settings[display][time][after]"
                   name="nb_settings[display][time][after]" value="<?php echo esc_attr( $display_after ); ?>" min="1"/>
            <div class="nb-option-note"><?php echo esc_html__( 'Please enter the number of milliseconds the notice bar will be displayed after the page loads.', 'notice-bar' ); ?></div>
        </div>
    </div>

    <div class="nb-option-field-wrap">
        <label for="nb_settings[display][time][hide_sec]"><?php echo esc_html__( 'Hide After', 'notice-bar' ); ?></label>
        <div class="nb-option-field">
			<?php
			$hide_sec = '';
			if ( isset( $nb_settings['display']['time']['hide_sec'] ) ) {
				$hide_sec = esc_attr( $nb_settings['display']['time']['hide_sec'] );
			}
			?>
            <input type="number" min="1000" step="500" id="nb_settings[display][time][hide_sec]"
                   name="nb_settings[display][time][hide_sec]" value="<?php echo esc_attr( $hide_sec ); ?>" min="1"/>
            <div class="nb-option-note"><?php echo esc_html__( 'Please enter the number of milliseconds the notice bar will be hidden after the page loads.', 'notice-bar' ); ?></div>
        </div>
    </div>

    <div class="nb-option-field-wrap">
        <label for="datetimepicker1"><?php echo esc_html__( 'Notice Display Date/Time', 'notice-bar' ); ?></label>
        <div class="nb-option-field date">
			<?php
			$show_tm = '';
			if ( isset( $nb_settings['display']['time']['show_tm'] ) ) {
				$show_tm = esc_attr( $nb_settings['display']['time']['show_tm'] );
			}
			?>
			 <div class="date-picker-input-wrapper">
	            <input type="text" name="nb_settings[display][time][show_tm]" id="datetimepicker1"
	                   value="<?php echo esc_attr( $show_tm ); ?>" min="1"/>
	             <i class="fa fa-calendar" aria-hidden="true"></i>
	          </div>
            <input type="button" id="reset-dtp1" value="Reset">
            <div class="current-time">
				<?php
				$current_date = date( 'm/d/Y H:i A' );
				echo sprintf( "You have set your default timezone to ' %s ' in your WP Settings. You can change it from 'Settings > General > Timezone'. Current date and time of is :", esc_html( $tzstring ), esc_html( $tzstring ) ) . esc_html( $current_date );

				?>
            </div>
            <div class="nb-option-note"><?php echo esc_html__( 'Please enter the date and time for the notice. Notice will be displayed after the choosen date-time.', 'notice-bar' ); ?></div>

        </div>
    </div>

    <div class="nb-option-field-wrap">
        <label for="datetimepicker2"><?php echo esc_html__( 'Notice Hide Date/Time', 'notice-bar' ); ?></label>
        <div class="nb-option-field date">
			<?php
			$hide_tm = '';
			if ( isset( $nb_settings['display']['time']['hide_tm'] ) ) {
				$hide_tm = esc_attr( $nb_settings['display']['time']['hide_tm'] );
			}
			?>
			<div class="date-picker-input-wrapper">
	            <input type="text" id="datetimepicker2" name="nb_settings[display][time][hide_tm]"
	                   value="<?php echo esc_attr( $hide_tm ); ?>" min="1"/>
	             <i class="fa fa-calendar" aria-hidden="true"></i>
             </div>
            <input type="button" id="reset-dtp2" value="Reset">
            <div class="current-time">
				<?php
				echo sprintf( "You have set your default timezone to ' %s ' in your WP Settings. You can change it from 'Settings > General > Timezone'. Current date and time of is :", esc_html( $tzstring ), esc_html( $tzstring ) ) . esc_html( $current_date );

				?>
            </div>
            <div class="nb-option-note"><?php echo esc_html__( 'Please enter the date and time for the notice. Notice will be displayed until the choosen date-time.', 'notice-bar' ); ?></div>

        </div>
    </div>

    <div class="nb-option-field-wrap">
        <label for="routine-chooser"><?php echo esc_html__( 'Enable Notice Routine', 'notice-bar' ); ?></label>
        <div class="nb-option-field">
            <label for="enable_routine"><input <?php checked( array_key_exists( 'routine', $nb_settings['display'] ) && array_key_exists( 'display', $nb_settings['display']['routine'] ) ? $nb_settings['display']['routine']['display'] : false, 'on' ); ?>
                        id="enable_routine" value="on" type="checkbox" name="nb_settings[display][routine][display]">
            </label>
            <br>
            <script>
                jQuery(document).ready(function ($) {
                    var timeSetting = {format: 'H:mm'};
                    $('#starttimepicker').datetimepicker(timeSetting);
                    $('#endtimepicker').datetimepicker(timeSetting);
                    var caller = function () {
                        if ($('label[for=enable_routine]').find('input').is(':checked'))
                            $('.routine-conditional').show('slow')
                        else
                            $('.routine-conditional').fadeOut('default')
                    };
                    caller();
                    $('label[for=enable_routine]').click(caller);
                    var $input = $('input[type=radio]');
                    $input.each(function () {
                        if (!$(this).is(':checked')) {
                            $(this).siblings('.callback').fadeOut();
                        }
                    });
                    $input.change(function () {
                        $('.callback').hide('slow');
                        $(this).siblings('.callback').show('slow');
                    })
                });
            </script>
            <div class="routine-conditional">
                <label for="">
                    <?php echo esc_html__( 'From', 'notice-bar' );?> <input name="nb_settings[display][routine][start_time]" id="starttimepicker"
                                value="<?php if ( isset($nb_settings['display']['routine'] ) && array_key_exists( 'start_time', $nb_settings['display']['routine'] ) ) {
						            echo esc_attr( $nb_settings['display']['routine']['start_time'] );
					            } ?>"/> to <input name="nb_settings[display][routine][end_time]"
                                                  value="<?php if ( 
                                                  isset( $nb_settings['display']['routine']) && array_key_exists( 'end_time', $nb_settings['display']['routine'] ) ) {
						                              echo esc_attr( $nb_settings['display']['routine']['end_time'] );
					                              } ?>" id="endtimepicker"/>
                </label>
				<?php
				$routines = array( 'daily', 'weekly', 'monthly' );
				$days = array(
					'sunday',
					'monday',
					'tuesday',
					'wednesday',
					'thursday',
					'friday',
					'saturday'
				);
				$GLOBALS['nb_settings'] = $nb_settings;
				function daily_callback() {
				}

				function monthly_callback() {
					global $nb_settings;
					$routine = array_key_exists( 'routine', $nb_settings['display'] ) ? $nb_settings['display']['routine'] : array(
						array(
							'month' => array(
								'start' => '',
								'end'   => ''
							)
						)
					);
					$start   = $routine && array_key_exists( 'month', $routine ) ? $routine['month']['start'] : '';
					$end     = $routine && array_key_exists( 'month', $routine ) ? $routine['month']['end'] : '';
					$days    = range( 1, 32 );
					$html    = __("From day ", 'notice-bar');
					$html .= "<select name='nb_settings[display][routine][month][start]'>";
					foreach ( $days as $day ) {
						$html .= "<option  value='" . esc_attr( $day ) . "'" . esc_attr( selected( $start, $day, false ) ) . ">" . esc_html( $day ) . "</option>";
					}
					$html .= "</select>";
					$html .= __(" to day ", 'notice-bar');
					$html .= "<select name='nb_settings[display][routine][month][end]'>";
					foreach ( $days as $day ) {
						$html .= "<option  value='" . esc_attr( $day ) . "'" . esc_attr( selected( $end, $day, false ) ). ">" . esc_html( $day ) . "</option>";
					}
					$html .= "</select>";

					return $html;
				}

				function weekly_callback() {
					global $nb_settings;
					$week = array_key_exists( 'routine', $nb_settings['display'] ) && array_key_exists( 'week', $nb_settings['display']['routine'] ) ? $nb_settings['display']['routine']['week'] : array();
					$days = array( 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' );
					$html = '';
					foreach ( $days as $key => $day ) {
						$checked = in_array( $key, $week ) ? checked( 1, 1, false ) : '';
						$html .= "<label for='{$day}'><input  id='{$day}' type='checkbox' name='nb_settings[display][routine][week][]' {$checked} value='{$key}' />" . ucfirst($day) . "</label> <br/>";
					}

					return $html;
				}

				array_walk( $routines, function ( $routine ) use ( $nb_settings ) {
					echo "<div class='" . esc_attr( $routine ). "'>";
					echo '<label  class="nb_radios nb-plain-label" for="' . esc_attr( $routine ) . '"><input ' . checked( isset($nb_settings['display']['routine']['type']) ? $nb_settings['display']['routine']['type'] : '', $routine, false ) . ' value="' . esc_attr( $routine ) . '" id="' . esc_attr( $routine ) . '" type="radio" name="nb_settings[display][routine][type]">' . esc_html( ucfirst( $routine ) ) . '</br><div class="callback">' . call_user_func( $routine . '_callback' ) . '</div></label>';
					echo "</div>";
				} ); ?>
            </div>
        </div>
    </div>

    <div class="nb-option-field-wrap">
        <label><?php echo esc_html__( 'Notice Display Control', 'notice-bar' ); ?></label>
        <div class="nb-option-field control">
            <p><label><input type="checkbox" id="entire-select" value="1" name="nb_settings[pages][entire]" <?php
					if ( isset( $nb_settings['pages']['entire'] ) ) {
						checked( $nb_settings['pages']['entire'], true );
					}
					?>> <?php echo esc_html__( 'Entire Site', 'notice-bar' ); ?></label></p>
            <div id="other-select">
                <p><label><input type="checkbox" value="1" name="nb_settings[pages][search]" <?php
						if ( isset( $nb_settings['pages']['search'] ) ) {
							checked( $nb_settings['pages']['search'], true );
						}
						?>> <?php echo esc_html__( 'Search Page', 'notice-bar' ); ?></label></p>
                <p><label><input type="checkbox" value="1" name="nb_settings[pages][404]" <?php
						if ( isset( $nb_settings['pages']['404'] ) ) {
							checked( $nb_settings['pages']['404'], true );
						}
						?>> <?php echo esc_html__( '404 Page', 'notice-bar' ); ?></label></p>
                <p><label><input type="checkbox" value="1" name="nb_settings[pages][archives]" <?php
						if ( isset( $nb_settings['pages']['archives'] ) ) {
							checked( $nb_settings['pages']['archives'], true );
						}
						?>> <?php echo esc_html__( 'Archives', 'notice-bar' ); ?></label></p>
                <p><label><input type="checkbox" value="1" name="nb_settings[pages][frontpage]" <?php
						if ( isset( $nb_settings['pages']['frontpage'] ) ) {
							checked( $nb_settings['pages']['frontpage'], true );
						}
						?>> <?php echo esc_html__( 'Front Page', 'notice-bar' ); ?></label></p>
	            <?php $posts = array_filter(get_post_types(array('public'=>true,'publicly_queryable'=>true,'_builtin'=>false)), function($post_type){
		            return $post_type != 'subscriber';

	            });
	            array_walk($posts,function($post) use ($nb_settings){
		            ?>
                    <p><label><input type="checkbox" data-id="<?php echo esc_attr( $post ); ?>" class="custom_post" value="1" name="nb_settings[custom_post][<?php echo esc_attr( $post ); ?>]" <?php
				            if ( isset( $nb_settings['custom_post'][$post] ) ) {
					            checked(  $nb_settings['custom_post'][$post], true );
				            }
				            ?>><?php echo esc_html( ucfirst($post) ); ?></label></p>
				            <div style="padding-left: 30px;"> <input type="text" id="<?php echo esc_attr( $post ); ?>" value="<?php 
						if ( isset( $nb_settings['custom_post_ids'][$post] ) ) {
				            echo esc_attr( $nb_settings['custom_post_ids'][$post] );
				            } ?>" name="nb_settings[custom_post_ids][<?php echo esc_attr( $post ); ?>]" placeholder="1,2,3">
							<span class="nb-option-note"><?php echo esc_html__( 'Place the ID of posts seperated by comma(,)', 'notice-bar' ); ?></span>
				            </div>

		            <?php
	            } );
	            ?>
<style>
	.nb-option-field.control p {
    display: inline-block;
    margin: 0;
}
.nb-option-note {
	display: block;
    margin-top: 3px;
}
</style>

                <p><label><input type="checkbox" value="1" name="nb_settings[pages][blog]" <?php
						if ( isset( $nb_settings['pages']['blog'] ) ) {
							checked( $nb_settings['pages']['blog'], true );
						}
						?>> <?php echo esc_html__( 'Blog Page', 'notice-bar' ); ?></label></p>
                <label><input type="checkbox" value="1" class="custom-page-list"
                              name="nb_settings[custom-pages][enable]" <?php
					if ( isset( $nb_settings['custom-pages']['enable'] ) ) {
						checked( $nb_settings['custom-pages']['enable'], true );
					}
					?>> <b><?php echo esc_html__( 'Custom Pages', 'notice-bar' ); ?></b></label>

                <div class="custom-pages">
					<?php $pages = get_pages();
					foreach ( $pages as $page_data ) { ?>
                        <p class="custom-child"><label><input type="checkbox" class="custom-page-list-pages" value="1"
                                                              name="nb_settings[custom-pages][<?php echo esc_html( $page_data->post_name ); ?>]" <?php
								if ( isset( $nb_settings['custom-pages'][ $page_data->post_name ] ) ) {
									checked( $nb_settings['custom-pages'][ $page_data->post_name ], true );
								}
								?>><?php echo esc_html( $page_data->post_title ); ?></label></p>
					<?php } ?>
                </div>
            </div>

        </div>
        <div class="nb-option-note"><?php echo esc_html__( 'Please choose the conditions for the notice-bar to display it.', 'notice-bar' ); ?></div>
    </div>
</div>