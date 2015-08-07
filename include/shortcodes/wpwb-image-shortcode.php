<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb;
$image_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="image-widget"');

if( empty($image_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($image_rule_record->wpwb_data));

if( empty($unserialize_records['image_link']) )
$unserialize_image_link = get_bloginfo('siteurl');
else
$unserialize_image_link = $unserialize_records['image_link'];

?>

<div class="wpwb-db-images">

	<div id="wpwb-ca-container" class="wpwb-ca-container">
	
    	<?php
		if( count($unserialize_records['image']) > 0) {
			  
			  $database_images = $unserialize_records['image'];
			  
			  foreach( $database_images as $key => $database_image ) {
		?>
        		  
        <div class="wpwb-ca-item">
        		
               <a href="<?php echo $unserialize_image_link; ?>" target="<?php echo $unserialize_records['image_target']; ?>" title="My image Widget">
               
                   <img alt="Image widget" src="<?php echo $database_image; ?>">
                    
                </a>
        </div>
        
        <?php
			}
		}
		?>
        
    </div>    

    <div class="wpwb_image_widget_contant">
        
        <h3><?php echo $image_rule_record->wpwb_title; ?></h3>
        
        <p>
            <?php echo $unserialize_records['image_description']; ?>
        </p>
    </div>
    
</div>