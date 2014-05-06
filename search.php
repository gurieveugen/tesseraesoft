<?php get_header(); ?>
<!--top_gradient starts-->
<div class="top_gradient">
	<?php
	if(!have_posts())
	{
		?>
		<div class="container clearfix">
			<div class="grid_12"> 

				<!--page header starts-->
				<div class="page_header clearfix">
					<h1>Sorry</h1>    
					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'theme' ); ?></p>    
				</div>
				<!--page header ends--> 

			</div>
		</div>

		<!--container starts-->
		<div class="container clearfix">
			<?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'theme' ); ?>
		</div>
		<!--container ends-->
		<?php
	}
	else
	{
		?>
		<div class="container clearfix">
			<div class="grid_12"> 

				<!--page header starts-->
				<div class="page_header clearfix">
					<h1><?php printf( __( 'Search Results for: %s', 'theme' ), get_search_query() ); ?></h1> 
				</div>
				<!--page header ends--> 

			</div>
		</div>

		<!--container starts-->
		<div class="container clearfix">
			<?php 
			if(isset($_GET['post_type']) && $_GET['post_type'] != '')
			{
				get_template_part('loop', 'accordion');
			}
			else
			{
				get_template_part('loop');
			}
			?>
		</div>
		<!--container ends-->
		<?php
	}
	?>
	

	<div class="clear"></div>
</div>
<!--top_gradient ends-->

<div class="spacer_30px"></div>
<?php get_footer(); ?>

