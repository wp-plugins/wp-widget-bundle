<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/
?>

<div class="wpwb_contant">
  <div class="wpwb_contant_header">
    <h2> <span class="glyphicon glyphicon-asterisk"></span>
      <?php 
              if(isset($_GET['action']) and $_GET['action']=='edit')
              _e('Edit Image Widget', 'wp-widget-bundle');
              else
              _e('Create Image Widget', 'wp-widget-bundle');
              ?>
    </h2>
  </div>
  
  <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="image-widget">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Title', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_title" class="wpaw-regular-text" id="image_title" value="<?php echo $_POST['wpwb_title']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here title.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Upload Image', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          
          <?php
		  if( count($_POST['wpwb_data']['image']) > 0) {
			  
			  $database_images = $_POST['wpwb_data']['image'];
			  
			  $i = 1;
			  
			  foreach( $database_images as $key => $database_image ) {
				
			  ?>
              
              	<div class="wpwb_upload_seprator">
                
                    <!--<label><span class="wpwb-label-numbers"><?php //echo $i; ?></span></label>-->
					<input type="text" name="wpwb_data[image][image_upload_url_<?php echo $i; ?>]" id="image_upload_url" class="image_upload_url wpaw-regular-text" value="<?php echo $database_image; ?>" />
                    
                    <a href="javascript:void(0);" id="image_upload_url_<?php echo $i; ?>" class="wpwb-upload-button-primary wpwb_upload_image_button"><?php _e( 'Upload Image', 'wp-widget-bundle' ); ?></a>			
                    <?php echo ( 'image_upload_url_1' == $key ? '<a href="javascript:void(0);" class="wpwb-add-more-button">Add More</a>' : '<a href="javascript:void(0);" class="wpwb-remove-more-button">Remove</a>' ); ?>
                    
                </div>
				
			  <?php	
			  $i++;
			  }
		  }
		  else {	 
		  ?>
          
                <div class="wpwb_upload_seprator">
                
                    <input type="text" name="wpwb_data[image][image_upload_url_1]" id="image_upload_url" class="image_upload_url wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['image']['image_upload_url']; ?>" />
                    
                    <a href="javascript:void(0);" id="image_upload_url_1" class="wpwb-upload-button-primary wpwb_upload_image_button"><?php _e( 'Upload Image', 'wp-widget-bundle' ); ?></a>
                  
                    <a href="javascript:void(0);" class="wpwb-add-more-button"><?php _e( 'Add More', 'wp-widget-bundle' ); ?></a>
                    
                </div> 
           <?php
		  	}
		  ?>
                <p class="description">
                  <?php _e( 'Please upload image.', 'wp-widget-bundle' ); ?>
                </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Description', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><textarea id="image_description" class="image_description wpaw-textarea-text" name="wpwb_data[image_description]" type="text"><?php echo $_POST['wpwb_data']['image_description']; ?></textarea>
            <p class="description">
              <?php _e( 'Please enter here image description.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Link', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input id="image_link" class="image_link wpaw-regular-text" name="wpwb_data[image_link]" type="text" value="<?php echo $_POST['wpwb_data']['image_link']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here image link.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Target', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[image_target]" id="image_target">
              <option value="_self"<?php selected($_POST['wpwb_data']['image_target'],'_self'); ?>>Open in Same Window</option>
              <option value="_blank"<?php selected($_POST['wpwb_data']['image_target'],'_blank'); ?>>Open in New Window</option>
            </select>
            <p class="description">
              <?php _e( 'Please select image target.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <input type="submit" name="submit" id="submit" class="wpwb-button-primary" value="Save">
            </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
