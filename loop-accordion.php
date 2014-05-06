<?php 
if(have_posts())
{
	?>
	<!--accordion starts-->
	<div class="accordion_wrapper">
		<?php
		while(have_posts())
		{
			the_post();
			?>
			<div>
				<h3>
					<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div><?php the_content(); ?></div>
			</div>
			<?php
		}
		?>
	</div>
	<!--accordion ends-->
	<?php
}

