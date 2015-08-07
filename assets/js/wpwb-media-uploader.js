jQuery(document).ready(function($){
	
	var wpwb_custom_file_frame;
	
	$(document).on('click', '.wpwb_upload_image_button', function(event) {
      
		var wpwb_target_input = $(this).attr('id');
		
		event.preventDefault();
		
		//If the frame already exists, reopen it
		if (typeof(wpwb_custom_file_frame)!=="undefined") {
		 
		 	wpwb_custom_file_frame.close();
		}
		
		//Create WP media frame.
		wpwb_custom_file_frame = wp.media.frames.customHeader = wp.media({
			//Title of media manager frame
			title: "Sample title of WP Media Uploader Frame",
			library: {
				type: 'image'
			},
			button: {
				//Button text
				text: "insert text"
			},
			//Do not allow multiple files, if you want multiple, set true
			multiple: false
		});
		
		wpwb_custom_file_frame.on('select', function() {
		
			var attachment = wpwb_custom_file_frame.state().get('selection').first().toJSON();
			
			$('input[name="wpwb_data[image]['+wpwb_target_input+']"]').val(attachment.url);
			
		});
		
		wpwb_custom_file_frame.open();
   });	
   
   $("div.wpwb_contant a.wpwb-add-more-button").click(function() {
                
		var wpwb_length = $("div.wpwb_upload_seprator").length + 1;
		
		var wpwb_more_upload_botton = $('<div class="wpwb_upload_seprator">' +
		'<input type="text" name="wpwb_data[image][image_upload_url_'+wpwb_length+']" id="image_upload_url" class="image_upload_url wpaw-regular-text" />&nbsp;' +
		'<a href="javascript:void(0);" id="image_upload_url_'+wpwb_length+'" class="wpwb-upload-button-primary wpwb_upload_image_button">Upload Image</a>&nbsp;' +
		'<a href="javascript:void(0);" class="wpwb-remove-more-button">Remove</a>' +
		'</div>');
		
		wpwb_more_upload_botton.hide();
		$("div.wpwb_upload_seprator:last").after(wpwb_more_upload_botton);
		wpwb_more_upload_botton.fadeIn("slow");
		
		return false;
    });
	
	$('div.wpwb_contant').on('click', 'a.wpwb-remove-more-button', function() {
        
		$(this).parent().css( 'background-color', '#FBFBFB' );
		
		$(this).parent().fadeOut("slow", function() {
		
			$(this).remove();
			
			$('.wpwb-label-numbers').each(function( index ){
				
				$(this).text( index + 1 );
            });
			
		});
		
		return false;
    });
});