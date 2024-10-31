<?php
$nb_settings = get_option( 'nb_new_settings' ); ?>
<div class="wrap">
    
    <h2><?php echo esc_html__( 'Notice Bar Settings', 'notice-bar' ); ?></h2>
    <?php if ( isset( $_GET['success'] ) && 'true' == $_GET['success'] ) : ?>
        <div id="notice-bar-settings_updated" class="updated settings-error notice is-dismissible"> 
            <p>
                <strong><?php echo ($_GET['msg'] == 1) ? esc_html__( 'Settings saved.', 'notice-bar' ) : esc_html__( 'Default settings restored successfully.', 'notice-bar' ); ?></strong>
            </p>
            <button type="button" class="notice-dismiss">
                <span class="screen-reader-text"><?php echo esc_html__( 'Dismiss this notice.', 'notice-bar' ); ?></span>
            </button>
        </div>
    <?php endif; ?>

    <div class="nb-settings-form-wrap" >
        <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="nb-settings-form">
            <input type="hidden" name="action" value="nb_settings_save"/>
            <?php wp_nonce_field( 'nb-settings-nonce', 'nb_settings_nonce_field' ); ?>       
            <?php do_action( 'notice_bar_before_setting_fields', $nb_settings ); ?>
            <div class="nb-new-settings-wrap">
                <h3 class="settings-title"><a class="toggle-settings" href="javascript:void(0);"><?php echo esc_html__( 'Settings', 'notice-bar' ); ?><span class="dashicons dashicons-arrow-down custom-toggle-settings"></span></a></h3>
                <div class="nb-basic-configurations nb-configurations show">
                    <div class="nb-option-field-wrap">
                        <label><?php echo esc_html__( 'Enable Debug Mode', 'notice-bar' ); ?></label>
                        <div class="nb-option-field">
                            <label class="nb-plain-label">
                                <input type="checkbox" value="1" name="nb_settings[debug_mode]" <?php
                                if ( isset( $nb_settings['debug_mode'] ) ) {
                                    checked( $nb_settings['debug_mode'], true );
                                }
                                ?>>
                                <div class="nb-option-side-note"><?php echo esc_html__( 'Check if you want to enable debug mode in frontend.', 'notice-bar' ); ?></div>
                                <div class="nb-option-note"><?php echo esc_html__( 'Enabling debug mode will use uncompressed css and js files in frontend which can be used to debug the css and js conflicts.', 'notice-bar' ); ?></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action( 'notice_bar_after_setting_fields', $nb_settings ); ?>
            <div class="nb-option-field-wrap">
                <label></label>
                <div class="nb-option-field-submit">
                    <input type="submit" name="nb_settings_save_submit" value="<?php echo esc_html__( 'Save Changes', 'notice-bar' ); ?>" class="button button-primary"/>
                </div>
            </div>

        </form>  
    </div>      
    <?php include(NOTICE_BAR_BASE_PATH . '/inc/backend/sidebar.php'); ?>

</div>