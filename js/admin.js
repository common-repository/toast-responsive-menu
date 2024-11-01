jQuery(window).ready(function(){

	//Tab controls
    jQuery('.toast-mm-tab').on('click', function(){
        var tab = jQuery(this).attr('data-tab');
        jQuery('.toast-mm-tab, .toast-mm-tab-area').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.toast-mm-tab-area[data-tab="'+tab+'"]').addClass('active');
    })

    //Update options
    function toastMMUpdateoptions(element){
		var element = jQuery(element);
		var option = jQuery(element).attr('name');
		var value = jQuery(element).val();
		console.log(value);
		
		if(jQuery(element).is(':checkbox')){
			value = jQuery(element).prop('checked');
		}
		 jQuery.ajax({
			 type : "post",
			 url : './admin-ajax.php',
         	 data : {action: 'toast_mm_update_options', 
				 	 option : option,
				 	 value : value
					},
         	  success: function(toast_mm_update_options) {
				  jQuery(element).parents('.toast-mm-options-area').addClass('success');
				  
				  setTimeout(function(element){
					jQuery('.toast-mm-options-area').removeClass('success');
				  }, 1200);
              }
      })
	}
	
    jQuery('body').on('change','select, input', function(){
        toastMMUpdateoptions(jQuery(this))
 	})

	//Color picker setup
	var updatedColourPicker = false;
	jQuery('.colour-picker').wpColorPicker({
		change: function(e){
			var colorpicker = jQuery(this);
			if(updatedColourPicker == false){
				updatedColourPicker = true;
				setTimeout(function(){
					toastMMUpdateoptions(jQuery(colorpicker));
					updatedColourPicker = false;
				}, 500)
			}
		}
	});

	// Selecting menu logo
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id;

	jQuery('#upload_image_button').on('click', function( event ){
		event.preventDefault();
		var associated_input = jQuery(this).attr('data-associated-input');
		var input = jQuery('input[name="'+associated_input+'"]');

		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select a image to upload',
			button: {
				text: 'Use this image',
			},
			multiple: false
		});

		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			jQuery( '.image-preview-wrapper[data-associated-input="'+associated_input+'"] img' ).attr( 'src', attachment.url ).show();
			jQuery('.image-preview-wrapper[data-associated-input="'+associated_input+'"]').removeClass('empty');
			jQuery(input).val(attachment.id).trigger('change');

			wp.media.model.settings.post.id = wp_media_post_id;
		});
			file_frame.open();
	});

	jQuery( 'a.add_media' ).on( 'click', function() {
		wp.media.model.settings.post.id = wp_media_post_id;
	});

	//Removing menu logo
	jQuery('body').on('click','.remove-image', function(){
		var associated_input = jQuery(this).attr('data-associated-input');
		jQuery('input[name="'+associated_input+'"]').val('').trigger('change');
		jQuery('.image-preview-wrapper[data-associated-input="'+associated_input+'"] img').attr('src', '').hide();
	})

})