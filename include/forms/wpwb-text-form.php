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
              _e('Edit Text Widget', 'wp-widget-bundle');
              else
              _e('Create Text Widget', 'wp-widget-bundle');
              ?>
    </h2>
  </div>
  <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="text-widget">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Title', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_title" class="wpaw-regular-text" id="text_rule_title" value="<?php echo $_POST['wpwb_title']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here title.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Description', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><?php
						$args = array("textarea_name" => "wpwb_data[text][description]");
						wp_editor( $_POST['wpwb_data']['text']['description'], "description", $args );
					?></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <input type="submit" name="submit" id="submit" class="wpwb-button-primary" value="Save">
          </th>
        </tr>
      </tbody>
    </table>
  </form>
</div>
