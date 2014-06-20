<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */
// =========================================================
// REQUIRED
// =========================================================
require_once 'includes/walker_tesserasoft.php';
require_once 'includes/post_type_factory.php';
require_once 'includes/page_factory.php';
require_once 'includes/widget_testimonials.php';
require_once 'includes/widget_twitter_feed.php';
require_once 'includes/lorem_posts.php';
require_once 'includes/paypal.php';
// =========================================================
// CONSTANTS
// =========================================================
define('TDU', get_bloginfo('template_url'));
// =========================================================
// HOOKS
// =========================================================
add_filter('use_default_gallery_style', '__return_false');
add_filter('nav_menu_css_class', 'cheangeMenuClasses');
add_filter('default_content', 'themeDefaultContent');
add_filter('the_content', 'templateUrl');
add_filter('get_the_content', 'templateUrl');
add_filter('widget_text', 'templateUrl');
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
add_action('wp_enqueue_scripts', 'scriptsMethod');
add_action('admin_enqueue_scripts', 'adminScriptsMethod');
add_action('widgets_init', 'registerWidgets');
add_shortcode('faq', 'shortcodeFAQ');
add_shortcode('knowledgebase', 'shortcodeKnowledgeBase');
add_shortcode('items', 'shortcodeDisplayItems');
add_shortcode('products', 'shortcodeDisplayProducts');
add_shortcode('screencasts', 'shortcodeDisplayScreencasts');
// =========================================================
// THEME SUPPORT
// =========================================================
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list'));
// =========================================================
// IMAGES SETTINGS
// =========================================================
add_image_size( 'single-post-thumbnail', 400, 9999, false );
add_image_size( 'screencast-small-img', 200, 125, true);
set_post_thumbnail_size( 604, 270, true );
// =========================================================
// REGISTER SIDEBARS AND MENUS
// =========================================================
register_sidebar(array(
	'id'            => 'right-sidebar',
	'name'          => 'Right Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4>',
	'after_title'   => '</h4>'));

register_sidebar(array(
	'id'            => 'left-sidebar',
	'name'          => 'Left Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4>',
	'after_title'   => '</h4>'));

register_sidebar(array(
	'id'            => 'front-page-first-row',
	'name'          => 'Front page first row',
	'before_widget' => '<div class="grid_4 %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4>',
	'after_title'   => '</h4>'));

register_sidebar(array(
	'id'            => 'front-page-second-row',
	'name'          => 'Front page second row',
	'before_widget' => '<div class="grid_4 %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4>',
	'after_title'   => '</h4>'));

register_sidebar(array(
	'id'            => 'footer-sidebar',
	'name'          => 'Footer Sidebar',
	'before_widget' => '<div class="grid_3 %2$s" id="%1$s">',
	'after_widget'  => '</div><!-- End -->',
	'before_title'  => '<h4>',
	'after_title'   => '</h4>'));

register_nav_menus(array(
	'primary_nav' => __('Primary Navigation'),	
	'footer_nav'  => __('Footer Navigation')));


// =========================================================
// POST TYPES
// =========================================================

$testimonial_args                         = array(
	'supports'  => array("title", "editor"),
	'icon_code' => 'f164');
$GLOBALS['testimonial']                   = new PostTypeFactory('testimonial', $testimonial_args);
$GLOBALS['testimonial']->meta_box_context = 'side';
$GLOBALS['testimonial']->addMetaBox('Testimonial', array(
	'name' => 'text',
	'url'  => 'text'));


$GLOBALS['page_meta'] = new PostTypeFactory('page');
$GLOBALS['page_meta']->addMetaBox('Additional info', array('Sub title' => 'text'));

$GLOBALS['faq']           = new PostTypeFactory('faq', array('supports' => array("title", "editor"), 'icon_code' => 'f128'));
$GLOBALS['knowledgebase'] = new PostTypeFactory('knowledge base', array('supports' => array("title", "editor"), 'icon_code' => 'f02d'));
$GLOBALS['product']      = new PostTypeFactory('product', array('supports' => array("title", "editor"), 'icon_code' => 'f07a'));
$GLOBALS['product']->meta_box_context = 'side';
$GLOBALS['product']->addMetaBox('Additional info', array('price' => 'text'));


$GLOBALS['screencast'] = new PostTypeFactory('Screencast', array('icon_code' => 'f03e'));

// =========================================================
// PAGES
// =========================================================
$GLOBALS['paypal'] = new PageFactory('PayPal', array('parent_page' => '', 'icon_code' => 'f085'));
$GLOBALS['paypal']->addFields('PayPal options', array(
	array( 'name' => 'Mode', 'type' => 'text'),
	array( 'name' => 'Api User name', 'type' => 'text'),
	array( 'name' => 'Api Password', 'type' => 'text'),
	array( 'name' => 'Api Signature', 'type' => 'text'),
	array( 'name' => 'Currency Code', 'type' => 'text'),
	array( 'name' => 'Return URL', 'type' => 'text'),
	array( 'name' => 'Cancel URL', 'type' => 'text')));

$GLOBALS['front_page'] = new PageFactory('Front page options', array('parent_page' => 'themes.php', 'icon_code' => ''));
$GLOBALS['front_page']->addFields('Front page Options', array(
	array('name' => 'Video HTML', 'type' => 'textarea'),
	array('name' => 'Video description HTML', 'type' => 'textarea'),
	array('name' => 'Basic requirements HTML', 'type' => 'textarea')
	));

$GLOBALS['paid'] = new PageFactory('Paid Orders', array(
	'parent_page' => '', 
	'icon_code'   => 'f0d6',
	'capability'  => 'subscriber'));


$GLOBALS['paid']->addTable(getPaidOrders(), array('class' => 'widefat'));


$GLOBALS['paid_all'] = new PageFactory('All Paid Orders', array(
	'parent_page' => '', 
	'icon_code'   => 'f0d6',
	'capability'  => 'administrator'));

$args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => '',
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'id',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => '');
$users = get_users($args);

if($users)
{
	$GLOBALS['paid_all']->addHTML('<label for="user-select">Select user:</label>');
	$GLOBALS['paid_all']->addHTML(getUsersSelect($users));
	foreach ($users as &$user) 
	{		
		$GLOBALS['paid_all']->addTable(getPaidOrders($user->id), array('class' => 'widefat hide user-table', 'id' => 'user-'.$user->id));
	}
}

// =========================================================
// GENERATE LOREM POSTS
// =========================================================
$lp = new LoremPosts();
// $lp->deletaAllPosts('faq');
// $lp->deletaAllPosts('knowledgebase');
// $lp->generatePosts(10, 'screencast');
// $lp->generatePosts(10, 'knowledgebase');
// 

// =========================================================
// LAUNCH SESSION
// =========================================================
_session_start();

/**
 * Register custom widgets
 */
function registerWidgets()
{
	$widgets = array('Testimonials', 'TwitterFeed');
	foreach ($widgets as &$widget) 
	{
		register_widget($widget);	
	}
}

/**
 * Theme helper 
 */
function themePagingNav() 
{
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="nav-links cf">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'theme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Theme helper
 */
function themePostNav() 
{
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'theme' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'theme' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'theme' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Theme helper
 * @param  boolean $echo
 * @return string
 */
function themeEntryDate( $echo = true ) 
{
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'theme' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}

/**
 * Theme helper
 */
function themeEntryMeta() 
{
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'theme' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		theme_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'theme' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'theme' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
}

/**
 * Change menu classes
 * @param  string $css_classes 
 * @return string              
 */
function cheangeMenuClasses($css_classes)
{
	$css_classes = str_replace("current-menu-item", "current-menu-item active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "current-menu-parent active", $css_classes);
	return $css_classes;
}

/**
 * Template url - short code for widget's and content
 * @param  string $text 
 * @return 
 */
function templateUrl($text) 
{
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}

/**
 * Add scripts and styles to HTML header
 */
function scriptsMethod() 
{
	// =========================================================
	// STYLES
	// =========================================================
	wp_enqueue_style('main', get_bloginfo('stylesheet_url'));
	wp_enqueue_style('google_fonts', 'http://fonts.googleapis.com/css?family=Arimo:400,400italic');
	wp_enqueue_style('navigation', TDU.'/css/navigation.css');
	wp_enqueue_style('jquery-ui-1.10.3.custom', TDU.'/css/jquery-ui-1.10.3.custom.css');
	wp_enqueue_style('flexslider', TDU.'/css/flexslider.css');
	wp_enqueue_style('jcarousel', TDU.'/css/jcarousel.css');
	wp_enqueue_style('prettyPhoto', TDU.'/css/prettyPhoto.css');
	wp_enqueue_style('nivoslider', TDU.'/css/nivo-slider.css');
	wp_enqueue_style('modal', TDU.'/css/jquery.modal.css');	
	// =========================================================
	// SCRIPTS
	// =========================================================
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', TDU.'/js/jquery-1.9.1.min.js');
	wp_enqueue_script('modernizr', TDU.'/js/modernizr.js', array('jquery'));
	wp_enqueue_script('flexslider', TDU.'/js/jquery.flexslider-min.js');
	wp_enqueue_script('main', TDU.'/js/main.js', array('jquery'));
	wp_enqueue_script('jcarousel', TDU.'/js/jquery.jcarousel.min.js');
	wp_enqueue_script('prettyPhoto', TDU.'/js/jquery.prettyPhoto.js');
	wp_enqueue_script('validate', TDU.'/js/jquery.validate.js');
	wp_enqueue_script('form', TDU.'/js/jquery.form.js');
	wp_enqueue_script('jquery.cycle.all', TDU.'/js/jquery.cycle.all.js');
	wp_enqueue_script('jquery-ui-1.10.3.custom', TDU.'/js/jquery-ui-1.10.3.custom.js');
	wp_enqueue_script('jquery.easing.1.3', TDU.'/js/jquery.easing.1.3.js');
	wp_enqueue_script('jquery.supersubs', TDU.'/js/jquery.supersubs.js');
	wp_enqueue_script('jquery.superfish', TDU.'/js/jquery.superfish.js');
	wp_enqueue_script('custom', TDU.'/js/custom.js');
	wp_enqueue_script('nivoslider', TDU.'/js/jquery.nivoslider.js');
	wp_enqueue_script('quicksand', TDU.'/js/jquery.quicksand.js');
	wp_enqueue_script('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5316dc2271b78736');
	wp_enqueue_script('modal', TDU.'/js/jquery.modal.js');


	wp_localize_script('main', 'defaults', array( 
			'ajaxurl'      => TDU.'/includes/ajax.php',
			'tdu'          => TDU,
			'is_logged_in' => is_user_logged_in()));
}

/**
 * Add scripts and styles to HTML header in admin panel
 */
function adminScriptsMethod()
{
	// =========================================================
	// STYLES
	// =========================================================
	wp_enqueue_style('admin-styles', TDU.'/css/admin_styles.css');
	// =========================================================
	// SCRIPTS
	// =========================================================
	wp_enqueue_script('admin-scripts', TDU.'/js/admin_scripts.js', array('jquery'));
}

/**
 * Default content for new post
 * @param  string $content
 * @return string
 */
function themeDefaultContent( $content ) 
{
	$content = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ultrices, magna non porttitor commodo, massa nibh malesuada augue, non viverra odio mi quis nisl. Nullam convallis tincidunt dignissim. Nam vitae purus eget quam adipiscing aliquam. Sed a congue libero. Quisque feugiat tincidunt tortor sed sodales. Etiam mattis, justo in euismod volutpat, ipsum quam aliquet lectus, eu blandit neque libero eu justo. Nunc nibh nulla, accumsan in imperdiet vel, pretium in metus. Aenean in lacus at lacus imperdiet euismod in non nulla. Mauris luctus sodales metus, ac porttitor est lacinia non. Proin diam urna, feugiat at adipiscing in, varius vel mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed tincidunt commodo massa interdum iaculis.</p><!--more--><p>Aliquam metus libero, elementum et malesuada fermentum, sagittis et libero. Nullam quis odio vel ipsum facilisis viverra id sit amet nibh. Vestibulum ullamcorper luctus lacinia. Etiam accumsan, orci eu blandit vestibulum, purus ante malesuada purus, non commodo odio ligula quis turpis. Vestibulum scelerisque feugiat diam, eu mollis elit cursus nec. Quisque commodo ultricies scelerisque. In hac habitasse platea dictumst. Nullam hendrerit rhoncus lacus, id lobortis leo condimentum sed. Nulla facilisi. Quisque ut velit a neque feugiat rutrum at sit amet neque. Sed at libero dictum est aliquam porttitor. Morbi tempor nulla ut tellus malesuada cursus condimentum metus luctus. Quisque dui neque, lobortis id vehicula et, tincidunt eget justo. Morbi vulputate velit eget leo fermentum convallis. Nam mauris risus, consectetur a posuere ultricies, elementum non orci.</p><p>Ut viverra elit vel mauris venenatis gravida ut quis mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend urna sit amet nisi scelerisque pretium. Nulla facilisi. Donec et odio vel sem gravida cursus vestibulum dapibus enim. Pellentesque eget aliquet nisl. In malesuada, quam ac interdum placerat, elit metus consequat lorem, non consequat felis ipsum et ligula. Sed varius interdum volutpat. Vestibulum et libero nisi. Maecenas sit amet risus et sapien lobortis ornare vel quis ipsum. Nam aliquet euismod aliquam. Donec velit purus, convallis ac convallis vel, malesuada vitae erat.</p>";
	return $content;
}

/**
 * SHORT CODE. [screencasts]
 * Display screencasts items.
 * @param  array $args --- shortcode parameters
 * @return mixed
 */
function shortcodeDisplayScreencasts($args)
{
	if(!is_array($args)) $args = array();
	$defaults = array(
		'posts_per_page' => 5,
		'post_type'      => 'screencast');
	$args = array_merge($defaults, $args);

	$posts = get_posts($args);
	if($posts)
	{
		ob_start();
		?>
		<ul id="mycarousel" class="jcarousel-skin-tango">
			<?php
			foreach ($posts as &$p) 
			{
				$img_sm = has_post_thumbnail($p->ID) ? getImgSrc($p->ID, 'screencast-small-img') : 'http://placehold.it/200x125';
				$img_lg = has_post_thumbnail($p->ID) ? getImgSrc($p->ID, 'full') : 'http://placehold.it/500x300';				
				?>
				<li>
				    <div class="thumb">
				        <a href="#">
				            <img src="<?php echo $img_sm; ?>" width="200" height="125" alt="<?php echo $p->post_title; ?>"/>
				        </a>
				        <a href="<?php echo $img_lg; ?>" data-rel="prettyPhoto[mixed]" title="This is title of image" class="zoom first_icon"></a>
				    </div>
				</li>
				<?php
			}
			?>
		</ul>
		<?php	
		$var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}
	return '';
}

/**
 * SHORT CODE. [faq]
 * Display faq items.
 * @param  array $args --- shortcode parameters
 * @return mixed
 */
function shortcodeFAQ($args)
{
	$args['post_type'] = 'faq';

	return shortcodeDisplayItems($args);
}

/**
 * SHORT CODE. [knowledgebase]
 * Display knowledgebase items.
 * @param  array $args --- shortcode parameters
 * @return mixed
 */
function shortcodeKnowledgeBase($args)
{	
	$args['post_type'] = 'knowledgebase';
	return shortcodeDisplayItems($args);
}

/**
 * Short code.
 * Display custom post type.
 * Generate accordion HTML code.
 * @param  array $args --- options array
 * @return mixed
 */
function shortcodeDisplayItems($args)
{
	if(!isset($args['post_type'])) return;
	$pt    = $args['post_type'];
	$count = isset($args['count']) ? intval($args['count']) : -1;

	$items = $GLOBALS[$pt]->getItems(array('posts_per_page' => $count));
	$out   = '';
	if(!$items) return;

	
	foreach ($items as $item) 
	{
		$out.= wrapAccordionItem(get_permalink($item->ID), $item->post_title, $item->post_content);	
	}
	return  sprintf('<!--accordion starts--><div class="accordion_wrapper">%s</div><!--accordion ends-->', $out);
}

/**
 * Helper function. Wrap accordion item
 * in to html code
 * @param  string $url   --- Link to post
 * @param  string $title --- Post title
 * @param  string $text  --- Post content
 * @return string        --- HTML code
 */
function wrapAccordionItem($url, $title, $text)
{
	return sprintf('<div> <h3><a href="%s">%s</a></h3> <div>%s</div> </div>', $url, $title, $text);
}

/**
 * Short code.
 * Display custom post type.
 * Generate Products HTML code
 * @param  array $args --- options array
 * @return mixed
 */
function shortcodeDisplayProducts($args, $content = '')
{
	$thead  = '';
	$tbody  = '';
	$bottom = '';
	$count  = isset($args['count']) ? intval($args['count']) : -1;
	$items  = $GLOBALS['product']->getItems($args);

	if(!$items) return;	
	foreach ($items as &$item) 
	{		
		$thead .= sprintf('<td><h1>%s</h1><span class="pricing pricefont-%s"><strong>$%s</strong></span></td>', $item->post_title, strlen($item->meta['product_price']), $item->meta['product_price']);
		$tbody .= sprintf('<td class="text-padding">%s</td>', $item->post_content);
		$bottom.= sprintf('<td><a class="button button-black buy" data-id="%s" href="#">Choose plan</a> </td>', $item->ID);
	}
	if(!$args['show_description']) $tbody = '';
	
	ob_start();
	?>
	<div id="pricing">
	    <table cellspacing="0" cellpadding="0" border="0">
	        <thead>
	            <tr>
					<?php echo $thead; ?>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php echo $content; ?>
	            <tr>
	                <?php echo $tbody; ?>
	            </tr>
	            <tr class="bottom">
	               <?php echo $bottom; ?>
	            </tr>
	        </tbody>
	    </table>
	</div>
	<?php
	$var = ob_get_contents();
    ob_end_clean();
    return $var;
}	

/**
 * Start session if session not started
 */
function _session_start()
{
	if(session_id() == '') 
	{
		return session_start();
	}
	return false;
}

/**
 * Return all paid orders
 * @param  $user_id --- User id
 * @return array    --- paid orders
 */
function getPaidOrders($user_id = '')
{	
	if($user_id == '') 
	{
		$user    = wp_get_current_user();
		$user_id = intval($user->id);
	}

	$meta   = get_user_meta($user_id, 'products', true);	
	$paid[] = array('Title', 'Description', 'Date/Time', 'Count', 'Price', 'Sum');
	$total  = 0;
	if(!$meta) return false;
	foreach ($meta as $id => $item) 
	{
		$p     = get_post($id);
		$price = get_post_meta($id, 'product_price', true);					
		$dt    = date('d-m-Y H:i', $item['time']);
		$sum   = $item['count']*$price;
		if($item['status'] == 'paid') 
		{
			$paid[] = array($p->post_title, strip_tags($p->post_content), $dt, $item['count'], $price, $sum);
			$total  = $total + $sum; 		
		}
	}
	if($total > 0)
	{
		$paid[] = array('<h2>Total sum:</h2>', '', '', '', '', sprintf('<h2>%s</h2>', $total));
	}
	return $paid;
}

/**
 * Get users select for admin panel
 * @param  array $users --- user objects
 * @param  string $name --- select name
 * @return string       --- HTML Code
 */
function getUsersSelect($users, $name='user-select')
{
	$out = '<option value="-1">Please select user</option>';
	foreach ($users as &$user) 
	{		
		$out.= sprintf('<option value="%s">%s</option>', $user->id, $user->display_name);
	}
	return sprintf('<select name="%s" id="%s">%s</select>', $name, $name, $out);
}

/**
 * Get only image src
 * @param  integer $id  --- post id
 * @param  string $size --- size name
 * @return string       --- image src
 */
function getImgSrc($id, $size)
{
	if(!has_post_thumbnail($id)) return false;
	$res = wp_get_attachment_image_src(get_post_thumbnail_id($id), $size);
	return $res[0];
}