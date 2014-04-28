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
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );  wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<header id="header">
			<?php if(is_front_page()): ?>
				<h1 class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
			<?php else: ?>
				<strong class="logo"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></strong>
			<?php endif; ?>
			<?php wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'primary_nav',
				'menu_id' => 'nav',
				'menu_class' => 'navigation'
				/*'walker' => new Custom_Walker_Nav_Menu*/
				)); ?>
		</header>
		<div id="main">