<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

$args = array(
		'public' 	=> true,
		'_builtin' 	=> false
);
$all_custom_post_types = get_post_types($args, 'names');
?>

<div class="wpwb_contant">
  <div class="wpwb_contant_header">
    <h2> <span class="glyphicon glyphicon-asterisk"></span>
      <?php 
              if(isset($_GET['action']) and $_GET['action']=='edit')
              _e('Edit Post Widget', 'wp-widget-bundle');
              else
              _e('Create Post Widget', 'wp-widget-bundle');
              ?>
    </h2>
  </div>
  
  <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
  
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="post-widget">
    <table class="wpwb-form-table">
      <tbody>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Title', 'wp-widget-bundle' ); ?>&nbsp;<span style="color:#F00;">*</span>
            </label>
          </th>
          <td><input type="text" name="wpwb_title" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_title']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here title.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Select Post Type', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[post][post_type]" id="wpwb_display_posts">
              <option value="post" <?php selected($_POST['wpwb_data']['post']['post_type'],'post'); ?>>Post</option>
              <option value="page" <?php selected($_POST['wpwb_data']['post']['post_type'],'page'); ?>>Page</option>
              <?php foreach ( $all_custom_post_types as $post_type ) { ?>
              <option value="<?php echo $post_type; ?>"<?php selected($_POST['wpwb_data']['post']['wprpw_rule_type'],$post_type); ?>><?php echo $post_type; ?></option>
              <?php } ?>
            </select>
            <p class="description">
              <?php _e( 'Please select post type.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Title', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_title" name="wpwb_data[post][hide_posts_title]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_title'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Title }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Thumbnail', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_thumbnail" name="wpwb_data[post][hide_posts_thumbnail]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_thumbnail'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Thumbnail }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Post Content Type', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[post][content_type]" id="wpwb_display_posts">
              <option value="excerpt" <?php selected($_POST['wpwb_data']['post']['content_type'],'excerpt'); ?>>Excerpt</option>
              <option value="full" <?php selected($_POST['wpwb_data']['post']['content_type'],'full'); ?>>Full</option>
            </select>
            <p class="description">
              <?php _e( 'Please select content type.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Content', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_content" name="wpwb_data[post][hide_posts_content]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_content'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Content }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Author', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_author" name="wpwb_data[post][hide_posts_author]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_author'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Author }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post date', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_date" name="wpwb_data[post][hide_posts_date]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_date'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Date }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Categories', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_categories" name="wpwb_data[post][hide_posts_categories]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_categories'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Categories }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Post Tags', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_tags" name="wpwb_data[post][hide_posts_tags]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_posts_tags'],'true'); ?> />
          <?php _e( 'Please check to { Hide Post Tags }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Leave a Comment', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_time" name="wpwb_data[post][hide_post_reply_link]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_post_reply_link'],'true'); ?> />
          <?php _e( 'Please check to hide { Leave a Comment }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Hide Edit Post Link', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          <p class="description">
          <input type="checkbox" id="hide_posts_time" name="wpwb_data[post][hide_edit_post_link]" value="true"<?php checked($_POST['wpwb_data']['post']['hide_edit_post_link'],'true'); ?> />
          <?php _e( 'Please check to hide { Edit Post Link }.', 'wp-widget-bundle' ); ?>
            </p>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Filter by Post IDs', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[post][post_incexc]">
                  <option value="">None</option>	
                  <option value="include" <?php selected($_POST['wpwb_data']['post']['post_incexc'],'include'); ?>>Include</option>
                  <option value="exclude" <?php selected($_POST['wpwb_data']['post']['post_incexc'],'exclude'); ?>>Exclude</option>
                </select>
            <p class="description">
              <?php _e( 'Please choose any one option for include or exclude posts.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role"></label>
          </th>
          <td>
          		<input type="text" name="wpwb_data[post][post_id]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['post']['post_id']; ?>" />
                <p class="description">
                  <?php _e( 'Please enter here { Post IDs } by comma seprated. { Example : 2, 3, 5 }', 'wp-widget-bundle' ); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Limit of Posts', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_data[post][post_display_nop]" id="category_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['post']['post_display_nop']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here limit for display posts.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Post Order By', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[post][post_order_by]" id="post_order_by">
              <option value="name"<?php selected($_POST['wpwb_data']['post']['post_order_by'],'name'); ?>>Name</option>
              <option value="ID"<?php selected($_POST['wpwb_data']['post']['post_order_by'],'ID'); ?>>ID</option>
              <option value="author"<?php selected($_POST['wpwb_data']['post']['post_order_by'],'author'); ?>>Author</option>
              <option value="title"<?php selected($_POST['wpwb_data']['post']['post_order_by'],'title'); ?>>Title</option>
              <option value="rand"<?php selected($_POST['wpwb_data']['post']['post_order_by'],'rand'); ?>>Random</option>
            </select>
            <p class="description">
              <?php _e( 'Please select post order by.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Post Order', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[post][post_order]" id="post_order">
              <option value="ASC"<?php selected($_POST['wpwb_data']['post']['post_order'],'ASC'); ?>>Ascending</option>
              <option value="DESC"<?php selected($_POST['wpwb_data']['post']['post_order'],'DESC'); ?>>Descending</option>
            </select>
            <p class="description">
              <?php _e( 'Please select post order.', 'wp-widget-bundle' ); ?>
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
