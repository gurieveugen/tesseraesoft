<?php
if(is_active_sidebar('right-sidebar'))
{
	?>
	<div class="sidebar">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
	</div>
	<?php
}
