<?php
/**
 * @package WordPress
 * @subpackage Base_theme
 */
?>
<div class="container footer_inner clearfix"> 
<?php
	if (is_active_sidebar('footer-sidebar')) dynamic_sidebar( 'footer-sidebar' );
?>
</div>