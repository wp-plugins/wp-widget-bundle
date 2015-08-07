<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb;
$comment_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="comment-widget"');

if( empty($comment_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($comment_rule_record->wpwb_data));

if( !empty($unserialize_records['comment']['post_type']) )
$args['post_type'] 	=  $unserialize_records['comment']['post_type'];
else
$args['post_type'] 	=  '';

if( $unserialize_records['comment']['post_inc_exe'] == 'include' ) {

	if( !empty($unserialize_records['comment']['post_id']) ) {
		
		if ( strpos($unserialize_records['comment']['post_id'],',') !== false ) {
			
			$exp_post_ids = explode(',', trim($unserialize_records['comment']['post_id']));
		}
		else
		{
			$exp_post_ids = array(trim($unserialize_records['comment']['post_id']));
		}
		
		$args['post__in'] 	=  $exp_post_ids;
	}
	else
	{
		$args['post__in'] 	=  '';
	}
}

if( $unserialize_records['comment']['post_inc_exe'] == 'exclude' ) {

	if( !empty($unserialize_records['comment']['post_id']) ) {
		
		if ( strpos($unserialize_records['comment']['post_id'],',') !== false ) {
			
			$exp_post_ids = explode(',', trim($unserialize_records['comment']['post_id']));
		}
		else
		{
			$exp_post_ids = array(trim($unserialize_records['comment']['post_id']));
		}
		
		$args['post__not_in'] 	=  $exp_post_ids;
	}
	else
	{
		$args['post__not_in'] 	=  '';
	}
}

if( $unserialize_records['comment']['author_inc_exe'] == 'include' ) {

	if( !empty($unserialize_records['comment']['author_id']) )
	$args['author__in'] 	=  $unserialize_records['comment']['author_id'];
	else
	$args['author__in'] 	=  '';
}

if( $unserialize_records['comment']['author_inc_exe'] == 'exclude' ) {
	
	if( !empty($unserialize_records['comment']['author_id']) )
	$args['author__not_in'] 	=  $unserialize_records['comment']['author_id'];
	else
	$args['author__not_in'] 	=  '';
}

if( $unserialize_records['comment']['comment_inc_exe'] == 'include' ) {

	if( !empty($unserialize_records['comment']['comment_id']) )
	$args['comment__in'] 	=  $unserialize_records['comment']['comment_id'];
	else
	$args['comment__in'] 	=  '';
}

if( $unserialize_records['comment']['comment_inc_exe'] == 'exclude' ) {
	
	if( !empty($unserialize_records['comment']['comment_id']) )
	$args['comment__not_in'] 	=  $unserialize_records['comment']['comment_id'];
	else
	$args['comment__not_in'] 	=  '';
}

if( !empty($unserialize_records['comment']['display_comment_limit']) )
$args['number'] 	=  $unserialize_records['comment']['display_comment_limit'];
else
$args['number'] 	=  '';

if( !empty($unserialize_records['comment']['comment_order_by']) )
$args['orderby'] 	=  $unserialize_records['comment']['comment_order_by'];
else
$args['orderby'] 	=  '';

$args['order'] 	=  $unserialize_records['comment']['comment_order'];

$comment_records = get_comments( $args );
?>

<div class="wpwb_container">
	<div class="wpwb_wiget_title">
		<h1 class="wpwb_title">Recent Comments</h1>
	</div>
    <div class="wpwb_contant">
        <ul class="wpwb-comment-list">
        <?php
		if( !empty($comment_records) ) {
			
			foreach($comment_records as $comment_record) {
				
			$post_content = get_post( $comment_record->comment_post_ID );
		?>
            <li class="wpwb-comment">
                <span class="wpwb-comment-avatar">
				   <?php echo get_avatar( $comment_record->user_id, apply_filters( 'wpwb_widget_avatar_size', 40) ); ?>
                </span>
                <span class="wpwb-comment-single">
                    <span class="wpwb-comment-author"><?php echo $comment_record->comment_author; ?></span>
                    <span class="wpwb-comment-text"> { "<?php echo $this->wpwb_comment_excerpt($comment_record->comment_content, 25); ?>" } – </span> 
                    <a href="<?php echo get_comment_link($comment_record->comment_ID, array('type' => 'comment')); ?>" title="<?php echo $post_content->post_title; ?>">
                        <strong><?php echo date_i18n('M d, g:i A', strtotime($comment_record->comment_date)); ?></strong>
                    </a>
                 </span>
             </li>
          <?php
			}
		  }
		  ?>   
        </ul>
     </div>   
</div>