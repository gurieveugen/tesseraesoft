<?php
$sq        = get_search_query() ? get_search_query() : ''; 
$post_type = isset($_SESSION['post_type']) ? $_SESSION['post_type'] : '';
unset($_SESSION['post_type']);
?>
<form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
	<fieldset>
		<input type="text" name="s" value="<?php echo $sq; ?>" class="text" />
		<input class="btn-search" type="submit" value="Search"/>
		<input type="hidden" name="post_type" value="<?php echo $post_type; ?>">
	</fieldset>
</form>