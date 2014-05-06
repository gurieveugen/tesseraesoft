<?php 

class LoremPosts{
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	private $args;
	private $generated;

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($args = array())
	{
		$defaults = array(
			'title' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, unde!',
			'text'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, similique, sed, assumenda dolor nulla consequuntur earum id ullam iusto tempora itaque maiores in quod cum accusantium aut nesciunt voluptate pariatur rerum sit. Est, sint, explicabo, facilis a commodi mollitia ex quaerat quo nulla iusto magnam nostrum inventore voluptatum ducimus fugit modi itaque odit ab sed in nobis officiis enim aperiam repellendus provident perspiciatis aliquam reiciendis molestias adipisci quasi repudiandae laudantium natus amet omnis ipsam quam rem. Nemo perferendis mollitia voluptates sint tempora vero fugit architecto velit libero aspernatur! Consequatur, et, dolorum, similique accusamus placeat obcaecati eius facere velit veniam eos quidem natus animi reiciendis fugiat facilis perferendis illo exercitationem! Beatae, unde, labore a molestias consectetur exercitationem in odit quaerat tenetur asperiores totam commodi quas nemo. Quos, libero omnis assumenda facilis aperiam. Sunt, molestias, at quod delectus fuga quibusdam esse ipsum facere ad id velit iusto facilis praesentium quis doloremque. Repudiandae, laborum magnam numquam odit illum eligendi laudantium officia sit inventore dolores quibusdam ullam delectus. Ratione, non, corporis eius amet aliquid animi laudantium enim optio doloremque at nobis porro nostrum sunt. Repellendus, nihil, nemo, exercitationem vitae a eaque omnis aliquid atque ipsa ab enim inventore earum molestiae quasi reiciendis sit suscipit.');
		$this->args      = array_merge($defaults, $args);
		$this->generated = array();
	}

	/**
	 * Generate lorem posts
	 * @param  integer $count     --- how mutch post we need
	 * @param  string  $post_type --- post type
	 */
	public function generatePosts($count  = 10, $post_type = 'post')
	{
		if(!in_array($post_type, $this->generated))
		{
			array_push($this->generated, $post_type);
			for ($i=1; $i <= $count; $i++) 
			{ 
				$p = array(
					'post_title'   => $this->args['title']." $i",
					'post_content' => $this->args['text'],
					'post_status'  => 'publish',
					'post_type'    => $post_type);

				wp_insert_post($p);
			}	
		}
	}

	/**
	 * Delete all post from post type
	 * @param  string  $post_type    --- custom post type
	 * @param  boolean $force_delete --- delete permanently
	 * @return boolean               --- if succsess, return true else return false.
	 */
	public function deletaAllPosts($post_type, $force_delete = true)
	{
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => $post_type,
			'post_mime_type'   => '',
			'fields'		   => 'ids',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true );

		$posts = get_posts($args);
		if($posts)
		{
			foreach ($posts as &$post) 
			{
				 wp_delete_post($post, $force_delete);
			}
			return true;
		}
		return false;

	}
}