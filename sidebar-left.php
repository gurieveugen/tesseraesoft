<?php
if(is_active_sidebar('left-sidebar'))
{
	?>
	<div class="sidebar">
	<?php dynamic_sidebar( 'left-sidebar' ); ?>
	</div>
	<?php
}
