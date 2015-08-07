<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

$args = array(
  'public'   => true,
  'show_ui' => true,
  'rewrite' => true
); 
$output = 'objects'; // or objects
$operator = 'and'; // 'and' or 'or'
$taxonomies = get_taxonomies( $args, $output, $operator ); 
?>

<div class="wpwb_contant">
	
    <div class="wpwb_contant_header">
        <h2>
            <span class="glyphicon glyphicon-asterisk"></span>
            <?php 
              if(isset($_GET['action']) and $_GET['action']=='edit')
              _e('Edit Category Widget', 'wp-widget-bundle');
              else
              _e('Create Category Widget', 'wp-widget-bundle');
              ?>
         </h2>
     </div>
     
     <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
     
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="category-widget">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role">
              <?php _e( 'Title', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_title" id="wpwb_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_title']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here title.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Select Taxonomy', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[category][category_taxonomy]" id="category_taxonomy">
              <?php if ( $taxonomies ) {
						  foreach ( $taxonomies  as $taxonomy ) {
						  ?>
              <option value="<?php echo $taxonomy->name; ?>"<?php selected($_POST['wpwb_data']['category']['category_taxonomy'],$taxonomy->name); ?>><?php echo $taxonomy->labels->singular_name; ?></option>
              <?php
						  }
						}
					  ?>
            </select>
            <p class="description">
              <?php _e( 'Please select taxonomy.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Display as dropdown', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="category_dropdown" name="wpwb_data[category][category_dropdown]" value="true"<?php checked($_POST['wpwb_data']['category']['category_dropdown'],'true'); ?> />
              <?php _e( 'Please check to { Display Dropdown List }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Display as hierarchy', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="category_hierarchy" name="wpwb_data[category][category_hierarchy]" value="true"<?php checked($_POST['wpwb_data']['category']['category_hierarchy'],'true'); ?> />
              <?php _e( 'Please check to { Display Hierarchical List }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Display Posts Count', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><p class="description">
              <input type="checkbox" id="category_posts_count" name="wpwb_data[category][category_posts_count]" value="true"<?php checked($_POST['wpwb_data']['category']['category_posts_count'],'true'); ?> />
              <?php _e( 'Please check to { Display Post Count }.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Filter by Category IDs', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[category][category_incexc]">
                  <option value="">None</option>	
                  <option value="include" <?php selected($_POST['wpwb_data']['category']['category_incexc'],'include'); ?>>Include</option>
                  <option value="exclude" <?php selected($_POST['wpwb_data']['category']['category_incexc'],'exclude'); ?>>Exclude</option>
                </select>
            <p class="description">
              <?php _e( 'Please choose any one option for include or exclude categories.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role"></label>
          </th>
          <td>
          		<input type="text" name="wpwb_data[category][category_id]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['category']['category_id']; ?>" />
                <p class="description">
                  <?php _e( 'Please enter here { Category IDs } by comma seprated. { Example : 2, 3, 5 }', 'wp-widget-bundle' ); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Limit of Categories', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_data[category][category_display_noc]" id="category_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['category']['category_display_noc']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here limit for display categories.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Category Order By', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[category][category_order_by]" id="category_order_by">
              <option value="name"<?php selected($_POST['wpwb_data']['category']['category_order_by'],'name'); ?>>Name</option>
              <option value="ID"<?php selected($_POST['wpwb_data']['category']['category_order_by'],'ID'); ?>>ID</option>
              <option value="slug"<?php selected($_POST['wpwb_data']['category']['category_order_by'],'slug'); ?>>Slug</option>
              <option value="count"<?php selected($_POST['wpwb_data']['category']['category_order_by'],'count'); ?>>Count</option>
              <option value="term_group"<?php selected($_POST['wpwb_data']['category']['category_order_by'],'term_group'); ?>>Term Group</option>
            </select>
            <p class="description">
              <?php _e( 'Please select category order by.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Category Order', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[category][category_order]" id="category_order">
              <option value="ASC"<?php selected($_POST['wpwb_data']['category']['category_order'],'ASC'); ?>>Ascending</option>
              <option value="DESC"<?php selected($_POST['wpwb_data']['category']['category_order'],'DESC'); ?>>Descending</option>
            </select>
            <p class="description">
              <?php _e( 'Please select category order.', 'wp-widget-bundle' ); ?>
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
