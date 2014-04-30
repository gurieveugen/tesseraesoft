<?php

class Testimonials extends WP_Widget {	
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct() 
	{
		$options = array('classname' => '', 'description' => __CLASS__.' widget' );		
		parent::__construct(strtolower(__CLASS__), __CLASS__.' widget', $options);
	}

	public function widget($args, $instance) 
	{
		extract($args);
		$title = strip_tags($instance['title']);		
		$count = intval($instance['count']);

		echo $before_widget;		
		// =========================================================
		// Print featured widget
		// =========================================================		
		if($title != '') echo $before_title.$title.$after_title;
		$testimonials = $GLOBALS['testimonial']->getItems(array('posts_per_page' => $count));
		?>
		<div class="testimonial_style1">
			<?php
			foreach ($testimonials as &$testimonial) 
			{
				?>
				<div>
				  <p>
				    "<?php echo $testimonial->post_content; ?>"
				  </p>
				  <span>
				    <?php echo $testimonial->meta['testimonial_name']; ?>
				    <br/>
				    <?php printf('<a href="%s">%s</a>', $testimonial->meta['testimonial_url'], $testimonial->meta['testimonial_url']); ?>
				  </span>
				</div>
				<?php
			}
			?>
		</div>
		<?php		
		echo $after_widget;
	}

	function form($instance) 
	{	
		$title = $instance['title'];     		
		$count = $instance['count'];

		?>		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>				
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count'); ?>: 
				<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
			</label>
		</p>		
		<?php
	}

	/**
	 * Update all edits
	 * @param  array $new_instance 
	 * @param  array $old_instance 
	 * @return array               
	 */
	function update($new_instance, $old_instance) 
	{
		$instance          = $old_instance;		
		$instance['title'] = strip_tags($new_instance['title']);				
		$instance['count'] = intval($new_instance['count']);

		return $instance;
	}
}