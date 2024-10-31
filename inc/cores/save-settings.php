<?php
$sanitize_rule = array( 'notice_text' => 'html' );
$nb_settings = $this->sanitize_array( stripslashes_deep( $_POST['nb_settings'] ), $sanitize_rule );
update_option( 'nb_new_settings', $nb_settings );
$redirect_url = admin_url( 'admin.php?page=notice-bar&success=true&msg=1' );
wp_redirect( $redirect_url );
exit;




