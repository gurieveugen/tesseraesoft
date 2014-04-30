<?php

class TwitterFeed extends WP_Widget {
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{		
		require_once 'google_url.php'; 
		require_once 'twitteroauth/twitteroauth.php'; 
		$options = array('classname' => '', 'description' => 'Display '.strtolower(__CLASS__).' feed' );		
		parent::__construct(strtolower(__CLASS__), __CLASS__.' feed widget', $options);
	}

	/**
	 * Render widget
	 * @param  array $args     
	 * @param  array $instance 
	 */
	public function widget($args, $instance) 
	{
		extract($args);

		$title               = isset($instance['title']) ? $instance['title'] : '';
		$username            = isset($instance['username']) ? $instance['username'] : '';
		$count               = isset($instance['count']) ? $instance['count'] : 0;		
		$counsumer_key       = isset($instance['counsumer_key']) ? $instance['counsumer_key'] : '';
		$consumer_secret     = isset($instance['consumer_secret']) ? $instance['consumer_secret'] : '';
		$access_token        = isset($instance['access_token']) ? $instance['access_token'] : '';
		$access_token_secret = isset($instance['access_token_secret']) ? $instance['access_token_secret'] : '';
		$goo_gl              = new Googl();
		
		echo $before_widget;
		if($title) echo $before_title.$title.$after_title;		
		$connection = new TwitterOAuth($counsumer_key, $consumer_secret, $access_token, $access_token_secret);		 
		$tweets     = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$username."&count=".$count);		 
		
		echo '<ul class="twitter">';
		foreach ($tweets as $key => $value) 
		{
			$minutes_ago = intval((microtime(true) - strtotime($value->created_at)) / 60);
			$url         = 'https://twitter.com/'.$username.'/status/'.$value->id_str;
			$url         = $goo_gl->shorten($url);
			?>
			<li class="block">
				<div class="cf">
					<a href="<?php echo $url; ?>" class="link"><?php echo $url; ?></a>
					<span class="time"><?php echo $minutes_ago; ?> min ago</span>
				</div>
				<p><?php echo $value->text; ?></p>
			</li>
			<?php
		}
		echo '</ul><!-- twit-blocks -->';
		echo $after_widget;
	}

	/**
	 * Render options form
	 * @param  array $instance
	 */
	public function form($instance) 
	{	
		$title               = $instance['title'];
		$username            = $instance['username'];
		$count               = $instance['count'];
		$counsumer_key       = $instance['counsumer_key'];
		$consumer_secret     = $instance['consumer_secret'];
		$access_token        = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];

		?>		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>				
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('User name'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo esc_attr($username); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
			</label>
		</p>			
		<p>
			<label for="<?php echo $this->get_field_id('counsumer_key'); ?>"><?php _e('Counsumer key'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('counsumer_key'); ?>" name="<?php echo $this->get_field_name('counsumer_key'); ?>" type="text" value="<?php echo esc_attr($counsumer_key); ?>" />
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer secret'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo esc_attr($consumer_secret); ?>" />
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access token'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo esc_attr($access_token); ?>" />
			</label>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access token secret'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" type="text" value="<?php echo esc_attr($access_token_secret); ?>" />
			</label>
		</p>	
		<?php
	}

	/**
	 * Update data
	 * @param  array $new_instance
	 * @param  array $old_instance
	 * @return array              
	 */
	public function update( $new_instance, $old_instance ) 
	{
		$instance                        = $old_instance;
		$instance['title']               = strip_tags($new_instance['title']);	
		$instance['username']            = strip_tags($new_instance['username']);			
		$instance['count']               = intval($new_instance['count']);		
		$instance['counsumer_key']       = strip_tags($new_instance['counsumer_key']);
		$instance['consumer_secret']     = strip_tags($new_instance['consumer_secret']);
		$instance['access_token']        = strip_tags($new_instance['access_token']);
		$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);	
		
		return $instance;
	}
}