<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

global $wpdb;
$text_rule_record = $wpdb->get_row('SELECT * FROM '.TBL_WB.' WHERE wpwb_id='.$atts["id"].' AND wpwb_type="text-widget"');

if( empty($text_rule_record) ) return;

$unserialize_records = unserialize(stripslashes($text_rule_record->wpwb_data));

$content = apply_filters('the_content', $unserialize_records['text']['description']);

echo '<div class="wpwb_container">';
if( !empty($text_rule_record->wpwb_title) )
{
?>
	<div class="wpwb_wiget_title">
		<h1 class="wpwb_title">
			<?php echo $text_rule_record->wpwb_title; ?>
        </h1>
	</div>
<?php
}
echo '<div class="wpwb_contant">';
echo stripslashes($content);
echo '</div>';
echo '</div>';