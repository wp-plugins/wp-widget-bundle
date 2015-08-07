<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb,$post;
$post_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="post-widget"');

if( empty($post_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($post_rule_record->wpwb_data));
				
if( !empty($unserialize_records['post']['post_type']) )
{
	$args['post_type']		= $unserialize_records['post']['post_type'];
}

if( $unserialize_records['post']['post_incexc'] == 'include' ) {

	if( !empty($unserialize_records['post']['post_id']) ) {
		
		if ( strpos($unserialize_records['post']['post_id'],',') !== false ) {
			
			$exp_post_ids = explode(',', trim($unserialize_records['post']['post_id']));
		}
		else
		{
			$exp_post_ids = array(trim($unserialize_records['post']['post_id']));
		}
		
		$args['post__in'] 	=  $exp_post_ids;
	}
	else
	{
		$args['post__in'] 	=  '';
	}
}

if( $unserialize_records['post']['post_incexc'] == 'exclude' ) {

	if( !empty($unserialize_records['post']['post_id']) ) {
		
		if ( strpos($unserialize_records['post']['post_id'],',') !== false ) {
			
			$exp_post_ids = explode(',', trim($unserialize_records['post']['post_id']));
		}
		else
		{
			$exp_post_ids = array(trim($unserialize_records['post']['post_id']));
		}
		
		$args['post__not_in'] 	=  $exp_post_ids;
	}
	else
	{
		$args['post__not_in'] 	=  '';
	}
}

if( !empty($unserialize_records['post']['post_display_nop']) ) 
$args['posts_per_page']		= $unserialize_records['post']['post_display_nop'];
else 
$args['posts_per_page']		= '-1';

$args['orderby']			= $unserialize_records['post']['post_order_by'];
$args['order']				= $unserialize_records['post']['post_order'];

$the_query =  new WP_Query($args); 

if($the_query->have_posts())
{

	echo '<div class="wpwb_post_container">';

	if( !empty($post_rule_record->wpwb_title) )
	{
	?>
		<div class="wpwb_wiget_title">
			<h1 class="wpwb_title"><?php echo $post_rule_record->wpwb_title; ?></h1>
		</div>
	<?php
	}
	
	echo '<div class="wpwb_post_contant">';
	
	while ( $the_query->have_posts() )
	{
		$the_query->the_post();
	?>
   
    <div class="wpwb_posts post-<?php echo $post->ID; ?>">
    
    	<div class="wpwb_post_image_contant">
               
               <?php if($unserialize_records['post']['hide_posts_title']!='true') { ?>
			
                <h3>
                    
                    <a href="<?php echo get_permalink(); ?>">
            
                        <?php echo get_the_title(); ?>
                    </a>
                
                </h3>
	 	
			<?php } ?>
			   
        </div>
        
        <div class="wpwb-entry-meta">
        
        	<?php if($unserialize_records['post']['hide_posts_date']!='true') { ?>
			
            <span class="wpwb-calendar wpwb-field-icon">
            
            	<a href="<?php echo get_permalink(); ?>"><?php echo get_the_date(); ?></a> 
			   
            </span>
            
            <?php } 
			 	  
             if($unserialize_records['post']['hide_posts_author']!='true') { 
             
			 ?>
             
            <span class="wpwb-user-icon wpwb-field-icon">
            
             
             <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a>
              
            </span>
            
             <?php } ?> 
             
         </div>
        
        <div class="wpwb_post_image_container">
        	
        	<?php 
				 
				 if($unserialize_records['post']['hide_posts_thumbnail']!='true') { 
					  
					  if ( has_post_thumbnail() ) {
							$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
							echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute( 'echo=0' ) . '">';
							echo '<img class="wpwb_post_image_circle" src="' . $large_image_url[0] . '" />';
							echo '</a>';
					 }
				 } 
				 
				 ?>
        	
                <?php
				
				 if($unserialize_records['post']['hide_posts_content']!='true') {
					  
					  if($unserialize_records['post']['content_type']=='excerpt') {
					  	
						echo '<p>'.$this->wpwb_custom_excerpt_max_charlength(140).'</p>';
					  }
					  else
					  {
						  echo '<p>'.get_the_content().'</p>';
					  }
				 }
				 
				 ?>
                 
                 <div class="wpwb-entry-meta">
                 
                 <?php if($unserialize_records['post']['hide_posts_categories']!='true') { ?>
				 	
                    <span class="wpwb-cat-links wpwb-field-icon">
						<?php the_category(','); ?>			
                    </span>
                    
					<br />
                    
				<?php }
				
				 if($unserialize_records['post']['hide_posts_tags']!='true') {
					 
				 ?>
                 
                    <span class="wpwb-tags-links wpwb-field-icon">
						<?php the_tags(''); ?>
                    </span>
                    
					<br />
                    
                 <?php } 
				 
				 if($unserialize_records['post']['hide_post_reply_link']!='true') { 
				 
				 ?>
					
                    <span class="wpwb-comments-link wpwb-field-icon">
                    	<?php echo get_post_reply_link(); ?>
                    </span>
                    
					<br />
                    
					<?php }
				 
				 	if($unserialize_records['post']['hide_edit_post_link']!='true') { 
			   
			   		?>
                    
					<span class="wpwb-edit-link wpwb-field-icon">
                    	<a href="<?php echo get_edit_post_link(); ?>">Edit</a>
                    </span>	
                    
                     <?php } ?>
                     
                 </div>
        </div>
	
    </div>
    
	<?php
	}
	
	echo '</div>';
	echo '</div>';
	
	wp_reset_postdata();
}	