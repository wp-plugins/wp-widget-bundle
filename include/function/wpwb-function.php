<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

if( !empty($response["error"]) ) {

	$this->show_message($response["error"], true);

}
else if( !empty($response["success"]) ) {

    $this->show_message($response["success"]);
}