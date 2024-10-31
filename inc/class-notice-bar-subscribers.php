<?php
class Notice_Bar_subscribers{

	function __construct(){

		add_action( 'init',  array( $this,'register_post_type' ) ); //add post type notice
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
		add_shortcode( 'nb_subscribe',  array( $this,'nb_subscribe_shortcode' ) );
		add_action('wp_ajax_nb_send_subscriber_mail', array($this, 'nb_send_subscriber_mail') );
		add_action('wp_ajax_nopriv_nb_send_subscriber_mail', array($this, 'nb_send_subscriber_mail') );

	}

    /**
     * Register post-type subscribers.  
     * 
     * @since 1.0.0
     */
	function register_post_type(){
		$labels = array(
	        'name'               => _x( 'Subscribers', 'post type general name', 'notice-bar' ),
	        'singular_name'      => _x( 'Subscriber', 'post type singular name', 'notice-bar' ),
	        'menu_name'          => _x( 'Subscribers', 'admin menu', 'notice-bar' ),
	        'name_admin_bar'     => _x( 'Subscriber', 'add new on admin bar', 'notice-bar' ),
	        'add_new'            => _x( 'Add New', 'subscriber', 'notice-bar' ),
	        'add_new_item'       => __( 'Add New Subscriber', 'notice-bar' ),
	        'new_item'           => __( 'New Subscriber', 'notice-bar' ),
	        'edit_item'          => __( 'Edit Subscriber', 'notice-bar' ),
	        'view_item'          => __( 'View Subscriber', 'notice-bar' ),
	        'all_items'          => __( 'All Subscribers', 'notice-bar' ),
	        'search_items'       => __( 'Search Subscribers', 'notice-bar' ),
	        'parent_item_colon'  => __( 'Parent Subscribers:', 'notice-bar' ),
	        'not_found'          => __( 'No subscribers found.', 'notice-bar' ),
	        'not_found_in_trash' => __( 'No subscribers found in Trash.', 'notice-bar' )
	        );

	    $args = array(
	        'labels'             => $labels,
	        'description'        => __( 'Description.', 'notice-bar' ),
	        'public'             => true,
	        'publicly_queryable' => true,
	        'show_ui'            => true,
	        'show_in_menu'       => 'edit.php?post_type=notice-bar',
	        'query_var'          => true,
	        'rewrite'            => array( 'slug' => 'subscriber' ),
	        'capability_type'    => 'post',
	        'has_archive'        => true,
	        'hierarchical'       => false,
	        'supports'           => array( 'title')
	        );

	    register_post_type( 'subscriber', $args );
	}

	/**
	* Adds a box to the main column on the Post and Page edit screens.
	* @since 1.0.0 
	*/
	function add_meta_box() {

	    $screens = array( 'subscriber' );

	    foreach ( $screens as $screen ) {

	        add_meta_box(
	            'subscriber_header_section',
	            __( 'Subscriber Info', 'notice-bar' ),
	            array($this,'subscriber_meta_box_callback'),
	            $screen
	            );
	    }
	}

	/**
	* Prints the box content.
	*
	* @param WP_Post $post The object for the current post/page.
	*/
	function subscriber_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	    wp_nonce_field( 'subscriber_save_meta_box_data', 'subscriber_meta_box_nonce' );

	/*
	* Use get_post_meta() to retrieve an existing value
	* from the database and use the value for the form.
	*/
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		{
			$data = $_REQUEST['noticebar_id'];
			$result = json_encode($data);
		}
	

	$subscriber = get_post_meta( $post->ID, 'subscriber', true );

	echo '<label for="subscriber">';
	echo esc_html__( 'Subscriber Email:', 'notice-bar' );
	echo '</label> ';
	echo '<input type="text" id="subscriber" name="subscriber" value="' . esc_attr( $subscriber ) . '" size="25"/><br><br><hr>';
	}

	/**
	* When the post is saved, saves our custom data.
	*
	* @param int $post_id The ID of the post being saved.
	*/
	function save_meta_box( $post_id ) {

	/*
	* We need to verify this came from our screen and with proper authorization,
	* because the save_post action can be triggered at other times.
	*/

	// Check if our nonce is set.
	if ( ! isset( $_POST['subscriber_meta_box_nonce'] ) ) {
	    return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['subscriber_meta_box_nonce'], 'subscriber_save_meta_box_data' ) ) {
	    return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	    return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

	    if ( ! current_user_can( 'edit_page', $post_id ) ) {
	        return;
	    }

	} else {

	    if ( ! current_user_can( 'edit_post', $post_id ) ) {
	        return;
	    }
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['subscriber'] ) ) {
	    return;
	}

	// Sanitize user input.
	$subscriber = sanitize_text_field( $_POST['subscriber'] );


	// Update the meta field in the database.
	update_post_meta( $post_id, 'subscriber', $subscriber_item );
	}

	/**
	 * Sends mail to subscriber and admin. 
	 * 
	 * @since 1.0.0
	 */
	function nb_send_subscriber_mail(){
		$email = sanitize_email( $_POST['customer_email'] );
		$noticebar_id = intval( $_POST['noticebar_id'] );
		$to = $email;

		if ( !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $to ) ) {
			$result['type'] = 'error';
			$result['message'] = __( 'Please enter valid email.', 'notice-bar' );
			echo json_encode( $result );
			exit;
		}
		$args = array(
			'post_type'  => 'subscriber',
			'meta_query' => array(
				array(
					'key'     => 'subscriber',
					'value'   => $email,
				),
			),
		);
		$query = new WP_Query( $args );

		if( $query->found_posts  > 0 ){
			$result['type'] = 'error';
			$result['message'] = __( 'Email aready on subscription list.', 'notice-bar' );
			echo json_encode( $result );
			exit;
		}

		$insert_email = $this->nb_subscribe_post( $email );

		if( ! $insert_email ){
			$result['type'] = 'error';
			$result['message'] = __( 'There was error in subscription.', 'notice-bar' );
			echo json_encode( $result );
			exit;
		}

	    $subject = 'Subscribe To Newsletter';

	    $nb_settings = get_post_meta( $noticebar_id, 'notice_bar_setting', true ); 
	    $admin_email = $nb_settings['aemail'];

	    $from = esc_attr($admin_email);
	    
	// To send HTML mail, the Content-type header must be set.
	    $headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Create email headers.
	    $headers .= 'From: '.$from."\r\n".
	    'Reply-To: '.$from."\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	    $message = '<html><body>';
	    $message .=apply_filters( 'notice_bar_admin_email_title','<div style="background:#f5f5f5; padding:15px;"><div style=" border-radius:7px; background:#fff; marin:0 auto; width:65%; margin:0 auto; margin-bottom:20px; margin-top:20px; padding:10px 0;"><h3 style="color:#777; font-size:17px; margin:0px 10px; padding:8px; ">'."Hello,"." ".'</h3>'.'<p style="padding:0 10px; color:#555; font-size:21px;">You have gained a new subscriber.</p>'.'<p style="color:#555; font-size:11px; margin:0 10px 20px; padding:8px; line-height:1.6; background:#f5f5f5; display:inline-block; ">'."Email Address: ".$to."</p>".'<p style="color:#555; font-size:11px; margin:0 10px 20px; padding:8px; line-height:1.6; background:#f5f5f5; display:inline-block; ">'."Subscription Date: ".date("Y-m-d H:i:s")."</p>".'<br /></div></div></body></html>');

	  	$message1 = '<html><body>';
       	$message1 .=apply_filters( 'notice_bar_subscriber_email_title','<div style="background:#f5f5f5; padding:15px;"><div style=" border-radius:7px; background:#fff; marin:0 auto; width:65%; margin:0 auto; margin-bottom:20px; margin-top:20px; padding:10px 0;"><h3 style="color:#777; font-size:17px; margin:0px;padding:8px; ">'."Hello,"." ".'</h3>'.'<p style="padding:0 10px; color:#555; font-size:21px;">Please confirm your subscription</p>'.'<p style="color:#555; font-size:15px; margin:0; padding:0 0 0 8px; line-height:1.6; ">'.'<br />'."
            Subscribe to our email newsletter today to receive updates and latest news.
            Thanks for signing up.".'<br /></div></div></body></html>');

	    $admin_sent = wp_mail( $from, $subject, $message, $headers );
	    $customer_sent = wp_mail( $to, $subject, $message1, $headers );

	    if($admin_sent && $customer_sent)
	    {	
			$result['type'] = "success";
			$result['message'] = __( "You have successfully subscribed newsletter.", 'notice-bar' );		
		
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			{
				$result = json_encode($result);
				echo $result;
			}
		}
		exit;	
	}

   	/**
	 * Create post-type subscriber. 
	 * 
	 * @since 1.0.0
	*/
	function nb_subscribe_post( $email ) {
		$new_post = array(
			'post_title' => 'subscriber ',
			'post_status' => 'publish',
			'post_type' => 'subscriber',
		);

		// Insert the post into the database.
		$post_id = wp_insert_post( $new_post );

		if( !$post_id ){
			return false;
		}

		add_post_meta( $post_id, 'subscriber', $email );

		$title = 'Subscriber #'.$post_id;

		$post_data = array(
			'ID'           => $post_id,
			'post_title'   => $title
		);

		// Update the post into the database.
		wp_update_post( $post_data );

		if ( false !== $updated ) {
			return true;
		} 

		return false;
	}

  /**
	 * Creates shortcode for subscribe form. 
	 * 
	 * @since 1.0.0
	 */

	function nb_subscribe_shortcode()
	{ 
		global $post;
	    $nb_sc = '<form name="customer_details" id="customer_details'.absint($post->ID).'" method="POST" action="">
	       <div class="nb-customer"><input type="email" id="customer_email'.absint($post->ID).'" name="customer_email" placeholder="Your email..." />
	       <input type="hidden" value="'.absint($post->ID).'" name="noticebar_id" id="noticebar_id" />
	        <div class="nb-customer-submit"><input class="input-customer" id="nb-submit-'.absint($post->ID).'" type="submit" name="submit" value="Submit"/></div>
	        </div>
	        <div class="success-msg"></div>
	        <div class="failed-msg"></div>

	    </form>';

	    echo
			ws_minify_css('<style>
			input#customer_email'.absint($post->ID).' {
			   padding: 7px 7px;
			   font-size: 13px;
			   border-radius: 0;
			   height: 31px;
			   line-height: 30px;
			   width: 100%;
			   margin: 0;
			}
			</style>');
	    return $nb_sc;
	    
	}
}

new Notice_Bar_subscribers();