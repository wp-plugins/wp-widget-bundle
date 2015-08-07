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
              _e('Edit Link Widget', 'wp-widget-bundle');
              else
              _e('Create Link Widget', 'wp-widget-bundle');
              ?>
    </h2>
  </div>
  <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="link-widget">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label>
              <?php _e( 'Title', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label></th>
          </th>
          <td><input type="text" name="wpwb_title" class="wpaw-regular-text" id="wpwb_title" value="<?php echo $_POST['wpwb_title']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here title.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Links Categories', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select id="link_category_id" name="wpwb_data[link][link_category_id]">
              <option value="">
              <?php _ex('All', 'links widget'); ?>
              </option>
              <?php
						$link_cats = get_terms( 'link_category' );
						foreach ( $link_cats as $link_cat ) {
						?>
              <option value="<?php echo $link_cat->term_id; ?>"<?php selected($_POST['wpwb_data']['link']['link_category_id'],$link_cat->term_id); ?>><?php echo $link_cat->name; ?></option>
              <?php } ?>
            </select>
            <p class="description">
              <?php _e( 'Please select link category. if you select { All } display all categories links.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Show Link Image', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="show_link_image" name="wpwb_data[link][show_link_image]" value="true"<?php checked($_POST['wpwb_data']['link']['show_link_image'],'true'); ?> />
              <?php _e( 'Please check to { Show Link Image }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Link Description', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="show_link_description" name="wpwb_data[link][show_link_description]" value="false"<?php checked($_POST['wpwb_data']['link']['show_link_description'],'false'); ?> />
              <?php _e( 'Please check to { Hide Link Description }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Link Rating', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="show_link_rating" name="wpwb_data[link][show_link_rating]" value="false"<?php checked($_POST['wpwb_data']['link']['show_link_rating'],'false'); ?> />
              <?php _e( 'Please check to { Hide Link Rating }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Link Order By', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[link][link_order_by]" id="link_order_by">
              <option value="name"<?php selected($_POST['wpwb_data']['link']['link_order_by'],'name'); ?>>Name</option>
              <option value="id"<?php selected($_POST['wpwb_data']['link']['link_order_by'],'id'); ?>>ID</option>
              <option value="slug"<?php selected($_POST['wpwb_data']['link']['link_order_by'],'slug'); ?>>Slug</option>
              <option value="count"<?php selected($_POST['wpwb_data']['link']['link_order_by'],'count'); ?>>Count</option>
            </select>
            <p class="description">
              <?php _e( 'Please select link order by.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Link Order', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[link][link_order]" id="link_order">
              <option value="ASC"<?php selected($_POST['wpwb_data']['link']['link_order'],'ASC'); ?>>Ascending</option>
              <option value="DESC"<?php selected($_POST['wpwb_data']['link']['link_order'],'DESC'); ?>>Descending</option>
            </select>
            <p class="description">
              <?php _e( 'Please select link order.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( '# of Display Links', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_data[link][link_display_nol]" id="category_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['link']['link_display_nol']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here number of links.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <input type="submit" name="submit" id="submit" class="wpwb-button-primary" value="Save">
          </th>
        </tr>
      </tbody>
    </table>
  </form>
</div>
