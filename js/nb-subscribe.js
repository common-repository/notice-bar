jQuery(document).ready(function($){

	$('form[name="customer_details"]').submit(function(e){
		var id = $(this).attr('id').replace("customer_details", "");
		e.preventDefault();
		$('#nb-submit-'+id).attr('disabled', 'disabled' );
	    var email = jQuery('#customer_email'+id).val();

		$.ajax({
			dataType : 'json',   
			type: 'post',
			url: MyAjax.ajaxurl,
			data: {action: 'nb_send_subscriber_mail', customer_email:email, noticebar_id:id},
			success: function(response){
			if(response.type === 'success') {
			    	jQuery(".nb-notice-outer-wrap-"+id+" .success-msg").html( response.message ).fadeIn('slow').delay('3000').fadeOut('3000');
			    	jQuery('#customer_email'+id).val('');
			    }
			else {
			    	jQuery(".nb-notice-outer-wrap-"+id+" .failed-msg").html( response.message ).fadeIn('slow').delay('3000').fadeOut('slow');
			    }
			$('#nb-submit-'+id).removeAttr('disabled' );

			}
		});
	});
});