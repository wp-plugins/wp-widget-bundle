<?php
/**
* @version 1.0.0
* @package WP Widget Bundle
*/

include('lib/twitteroauth.php');

$options = get_option( '_wpwb_tweets_settings' );
$options = unserialize($options);

$wpwb_consumer_key = ( $options['wpwb_consumer_key'] != "" ) ? sanitize_text_field( $options['wpwb_consumer_key'] ) : '';

$wpwb_consumer_secret = ( $options['wpwb_consumer_secret'] != "" ) ? sanitize_text_field( $options['wpwb_consumer_secret'] ) : '';

$wpwb_access_token = ( $options['wpwb_access_token'] != "" ) ? sanitize_text_field( $options['wpwb_access_token'] ) : '';

$wpwb_access_token_secret = ( $options['wpwb_access_token_secret'] != "" ) ? sanitize_text_field( $options['wpwb_access_token_secret'] ) : "";

$wpwb_screen_name = ( $options['wpwb_screen_name'] != "" ) ? sanitize_text_field( $options['wpwb_screen_name'] ) : "";

$wpwb_display_tweet = ( $options['wpwb_display_tweet'] != "" ) ? sanitize_text_field( $options['wpwb_display_tweet'] ) : "";

$wpwb_include_rts = ( $options['wpwb_include_rts'] != "" ) ? sanitize_text_field( $options['wpwb_include_rts'] ) : "";

$wpwb_exclude_replies = ( $options['wpwb_exclude_replies'] != "" ) ? sanitize_text_field( $options['wpwb_exclude_replies'] ) : "";

define( 'CONSUMER_KEY', $wpwb_consumer_key );
define( 'CONSUMER_SECRET', $wpwb_consumer_secret );
define( 'ACCESS_TOKEN', $wpwb_access_token );
define( 'ACCESS_TOKEN_SECRET', $wpwb_access_token_secret );
define( 'TWITTER_USERNAME', $wpwb_screen_name );
define( 'TWEET_LIMIT', $wpwb_display_tweet );
define( 'INCLUDE_RTS', $wpwb_include_rts );
define( 'EXECLUDE_REPLIES', $wpwb_exclude_replies );

# Create the connection
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

# Load the Tweets
$tweets = $twitter->get('statuses/user_timeline', array('screen_name' => TWITTER_USERNAME, 'exclude_replies' => EXECLUDE_REPLIES, 'include_rts' => INCLUDE_RTS, 'count' => TWEET_LIMIT));

echo '<div class="wpwb_container">';

if( !empty($atts['title']) )
{
?>
	<div class="wpwb_wiget_title">
		<h1 class="wpwb_title"><?php echo $atts['title']; ?></h1>
	</div>
<?php
}
?>		
<div class="wpwb_contant">
    <?php
    # Example output
    if( !empty($tweets) ) {

        foreach($tweets as $tweet) {

            # Access as an object
            $tweetText = $tweet->text;
    
            # Make links active
            $tweetText = preg_replace("/(http:\/\/|(www\.))(([^\s<]{4,68})[^\s<]*)/", '<a href="http:%2f%2f$2$3" target="_blank">$1$2$4</a>', $tweetText);
    
            # Linkify user mentions
            $tweetText = preg_replace("/@(\w+)/", "<a href='http:/www.twitter.com/$1' target='_blank'>@$1</a>", $tweetText);
    
            # Linkify tags
            $tweetText = preg_replace("/#(\w+)/", "<a href='http:/search.twitter.com/search?q=$1' target='_blank'>#$1</a>", $tweetText);
    
            # Output
            echo "<p>".$tweetText."</p>";
        }
	}
	else
	{
		echo "<p>Tweets not found.</p>";
	}
	?>
</div>	
</div>