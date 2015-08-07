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
              _e('Edit Comment Widget', 'wp-widget-bundle');
              else
              _e('Create Comment Widget', 'wp-widget-bundle');
              ?>
    </h2>
  </div>
  
  <?php require_once(WPWB_FUNCTION.'wpwb-function.php'); ?>
  
  <form method="post" action="">
    <input type="hidden" name="wpwb_type" value="comment-widget">
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
              <?php _e( 'Filter by Post Type', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[comment][post_type]" id="wpwb_display_posts">
                  <option value="">All</option>	
                  <option value="post" <?php selected($_POST['wpwb_data']['comment']['post_type'],'post'); ?>>Post</option>
                  <option value="page" <?php selected($_POST['wpwb_data']['comment']['post_type'],'page'); ?>>Page</option>
                  <?php foreach ( $all_custom_post_types as $post_type ) { ?>
                  <option value="<?php echo $post_type; ?>"<?php selected($_POST['wpwb_data']['comment']['wprpw_rule_type'],$post_type); ?>><?php echo $post_type; ?></option>
                  <?php } ?>
                </select>
            <p class="description">
              <?php _e( 'Please select post type. if you select { All } display all post type comments.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Filter by Post IDs', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[comment][post_inc_exe]">
                  <option value="">None</option>	
                  <option value="include" <?php selected($_POST['wpwb_data']['comment']['post_inc_exe'],'include'); ?>>Include</option>
                  <option value="exclude" <?php selected($_POST['wpwb_data']['comment']['post_inc_exe'],'exclude'); ?>>Exclude</option>
                </select>
            <p class="description">
              <?php _e( 'Please choose any one option for include or exclude comments.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role"></label>
          </th>
          <td>
          		<input type="text" name="wpwb_data[comment][post_id]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['comment']['post_id']; ?>" />
                <p class="description">
                  <?php _e( 'Please enter here { Post IDs } by comma seprated. { Example : 2, 3, 5 }', 'wp-widget-bundle' ); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Filter by Author IDs', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[comment][author_inc_exe]" id="wpwb_display_posts">
                  <option value="">None</option>	
                  <option value="include" <?php selected($_POST['wpwb_data']['comment']['author_inc_exe'],'include'); ?>>Include</option>
                  <option value="exclude" <?php selected($_POST['wpwb_data']['comment']['author_inc_exe'],'exclude'); ?>>Exclude</option>
                </select>
            <p class="description">
              <?php _e( 'Please choose any one option for include or exclude comments.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role"></label>
          </th>
          <td>
          		<input type="text" name="wpwb_data[comment][author_id]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['comment']['author_id']; ?>" />
                <p class="description">
                  <?php _e( 'Please enter here { Author IDs } by comma seprated. { Example : 2, 3, 5 }', 'wp-widget-bundle' ); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Filter by Comment IDs', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          		<select name="wpwb_data[comment][comment_inc_exe]" id="wpwb_display_posts">
                  <option value="">None</option>	
                  <option value="include" <?php selected($_POST['wpwb_data']['comment']['comment_inc_exe'],'include'); ?>>Include</option>
                  <option value="exclude" <?php selected($_POST['wpwb_data']['comment']['comment_inc_exe'],'exclude'); ?>>Exclude</option>
                </select>
            <p class="description">
              <?php _e( 'Please choose any one option for include or exclude comments.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> 
          	<label for="default_role"></label>
          </th>
          <td>
          		<input type="text" name="wpwb_data[comment][comment_id]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['comment']['comment_id']; ?>" />
                <p class="description">
                  <?php _e( 'Please enter here { Comment IDs } by comma seprated. { Example : 7, 9, 12 }', 'wp-widget-bundle' ); ?>
                </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Limit of Comments', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><input type="text" name="wpwb_data[comment][display_comment_limit]" id="post_title" class="wpaw-regular-text" value="<?php echo $_POST['wpwb_data']['comment']['display_comment_limit']; ?>" />
            <p class="description">
              <?php _e( 'Please enter here limit for display comments.', 'wp-widget-bundle' ); ?>
            </p></td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Comments Order By', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td>
          	<select name="wpwb_data[comment][comment_order_by]">
              <option value="">None</option>
              <option value="comment_agent"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_agent'); ?>>Comment Agent</option>
              <option value="comment_approved"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_approved'); ?>>Comment Approved</option>	
              <option value="comment_author"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_author'); ?>>Comment Author</option>
              <option value="comment_author_email"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_author_email'); ?>>Comment Author Email</option>
              <option value="comment_author_url"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_author_url'); ?>>Comment Author URL</option>
              <option value="comment_content"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_content'); ?>>Comment Content</option>
              <option value="comment_date"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_date'); ?>>Comment Date</option>
              <option value="comment_date_gmt"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_date_gmt'); ?>>Comment Date GMT</option>
              <option value="comment_ID"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_ID'); ?>>Comment ID</option>
              <option value="comment_karma"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_karma'); ?>>Comment Karma</option>
              <option value="comment_parent"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_parent'); ?>>Comment Parent</option>
              <option value="comment_post_ID"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_post_ID'); ?>>Comment Post ID</option>
              <option value="comment_type"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'comment_type'); ?>>Comment Type</option>
              <option value="user_id"<?php selected($_POST['wpwb_data']['comment']['comment_order_by'],'user_id'); ?>>User ID</option>
            </select>
            <p class="description">
              <?php _e( 'Please select comment order by.', 'wp-widget-bundle' ); ?>
            </p>
            </td>
        </tr>
        <tr valign="top">
          <th scope="row"> <label for="default_role">
              <?php _e( 'Comments Order', 'wp-widget-bundle' ); ?>
            </label>
          </th>
          <td><select name="wpwb_data[comment][comment_order]">
              <option value="ASC"<?php selected($_POST['wpwb_data']['comment']['comment_order'],'ASC'); ?>>Ascending</option>
              <option value="DESC"<?php selected($_POST['wpwb_data']['comment']['comment_order'],'DESC'); ?>>Descending</option>
            </select>
            <p class="description">
              <?php _e( 'Please select comment order.', 'wp-widget-bundle' ); ?>
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
