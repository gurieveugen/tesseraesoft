<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php echo wp_title( ' ', false, 'right' ) != '' ? wp_title( ' ', false, 'right' ) : get_bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" type="image/png" href="<?php echo TDU; ?>/images/favicon.png"/>
	<!--[if IE 7]>
	        <link rel="stylesheet" type="text/css" href="css/ie7.css">
	<![endif]-->
	<!--[if IE 8]>
	        <link rel="stylesheet" type="text/css" href="css/ie8.css">
	<![endif]-->
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );  wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<!--top starts-->
<div id="top">
  <div class="container clearfix">
    <div class="grid_12">
      <p>Hello! it's me... softone</p>
      <p class="call">Call for support <span class="color">+ 12 345 678</span></p>
    </div>
  </div>
</div>
<!--top ends--> 

<!--header starts-->
<div id="header">
  <div class="container  header_inner clearfix">
    <div class="grid_12"> 
      
      	<!--logo here--> 
      	<a href="<?php bloginfo('url'); ?>"> <img src="<?php echo TDU; ?>/images/logo.png" width="125" height="35" alt="logo" class="logo"> </a> 
      	<!--menu / navigation starts-->
		<?php 
		wp_nav_menu(array(
			'container'      => false,
			'theme_location' => 'primary_nav',
			'menu_id'        => '',
			'menu_class'     => 'sf-menu',
			'walker'         => new WalkertTesseraSoft()));
		?>
      	<!--menu ends-->
      	<div class="clear"></div>
    </div>
  </div>
</div>
<!--header ends--> 