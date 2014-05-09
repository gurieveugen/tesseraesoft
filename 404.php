<?php 
get_header();
?>
<!--top_gradient starts-->
<div class="top_gradient">
	<div class="container clearfix">
		<div class="grid_12"> 

			<!--page header starts-->
			<div class="page_header clearfix">
				<h1><?php _e( 'Not found', 'theme' ); ?></h1>    
			</div>
			<!--page header ends--> 

		</div>
	</div>

	<!--container starts-->
	<div class="container clearfix">
		<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'theme' ); ?></h2>
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'theme' ); ?></p>
		<?php get_search_form(); ?>
	</div>
	<!--container ends-->

	<div class="clear"></div>
</div>
<!--top_gradient ends-->

<div class="spacer_30px"></div>
<?php get_footer(); ?>

