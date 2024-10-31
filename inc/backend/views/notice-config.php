<?php
if( empty( $notice_types ) )
    return;
// print_r( $notice_types );
?>
<h4><?php echo esc_html__( 'Notice Types', 'notice-bar' ); ?></h4>
<div class="nb-components-wrap">
    <div class="nb-layout-1-component nb-layout-component">
        <ul class="accordion">
            <?php foreach( $notice_types as $key => $notice_type ) : ?>
            <li class="<?php echo esc_attr($key); ?>">
                <a class="toggle" href="javascript:void(0);"><?php echo esc_attr($notice_type['title']); ?><span class="dashicons dashicons-arrow-down custom-toggle"></span></a>
                <div class="nb-notice-type-options nb-<?php echo esc_attr( $key ); ?>-options">
                    <?php echo call_user_func( $notice_type['content_callback'], $nb_settings ); ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>