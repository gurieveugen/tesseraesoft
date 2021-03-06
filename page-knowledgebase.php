<?php
/**
 * Template name: Knowledge base
 */
?>
<?php 
get_header();
the_post();
$meta     = $GLOBALS['page_meta']->getMeta(get_the_id()); 
$subtitle = isset($meta['page_sub_title']) ? $meta['page_sub_title'] : '';
?>
<!--top_gradient starts-->
<div class="top_gradient">
	<div class="container clearfix">
		<div class="grid_12"> 

			<!--page header starts-->
			<div class="page_header clearfix">
				<h1><?php the_title(); ?></h1>    
				<p><?php echo $subtitle; ?></p>    
			</div>
			<!--page header ends--> 

		</div>
	</div>

	<!--container starts-->
	<div class="container clearfix">
		<?php $_SESSION['post_type'] = 'knowledgebase'; ?>
		<?php get_search_form(); ?>
		<?php the_content(); ?>
	</div>
	<!--container ends-->

	<div class="clear"></div>
</div>
<!--top_gradient ends-->

<div class="spacer_30px"></div>
<?php get_footer(); ?>
