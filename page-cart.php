<?php 
/**
 * Template name: Cart
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
		<?php the_content(); ?>
		<?php 
		$user = wp_get_current_user();
		$meta = get_user_meta($user->ID, 'products', true);
		$sum  = 0;
		$paid = array();
		if(is_array($meta))
		{
			?>
			<form action="#" method="post" id="cart-form">
				<div class="table_wrapper table_indigo">
					<table cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th>Title</th>
								<th>Description</th>
								<th>Date/Time</th>
								<th>Count</th>
								<th>Price</th>
								<th>Remove</th>				
							</tr>
						</thead>
						<tbody>						
							<?php
							foreach ($meta as $id => $item) 
							{
								$p          = get_post($id);
								$base_price = get_post_meta($id, 'product_price', true);
								$price      = $base_price * $item['count'];								
								$dt         = date('d-m-Y H:i', $item['time']);
								if($item['status'] != 'paid')
								{
									$sum = $sum + floatval($price);
									?>
									<tr data-price="<?php echo $price; ?>">
										<td>
											<?php echo $p->post_title; ?>
											<input type="hidden" name="items[<?php echo $id; ?>][title]" value="<?php echo $p->post_title; ?>">
										</td>
										<td>
											<?php echo $p->post_content; ?>
											<input type="hidden" name="items[<?php echo $id; ?>][content]" value="<?php echo $p->post_content; ?>">
										</td>
										<td><?php echo $dt; ?></td>
										<td>
											<?php echo $item['count']; ?>
											<input type="hidden" name="items[<?php echo $id; ?>][count]" value="<?php echo $item['count']; ?>">
										</td>
										<td>
											<?php echo $price; ?>
											<input type="hidden" name="items[<?php echo $id; ?>][price]" value="<?php echo $base_price; ?>">
										</td>
										<td><a href="#" class="button button-red remove-item" data-id="<?php echo $id; ?>" data-price="<?php echo $price; ?>" data-sum="<?php echo $sum; ?>">Remove</a></td>
									</tr>		
									<?php
								}
								else
								{
									$paid[$id] = $item;
								}
							}
							?>	
							<tr>
								<td></td>
								<td><button type="submit" class="button button-black checkout-btn"><i class="fa fa-credit-card "></i> Checkout</button></td>
								<td></td>
								<td></td>
								<td><h3 id="sum"><?php echo $sum; ?></h3></td>
								<td></td>
							</tr>						
						</tbody>
					</table>
				</div>
			</form>
			<h1>PAID Orders</h1>
			<div class="table_wrapper table_red">
				<table cellspacing="0" cellpadding="0">
					<thead>
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Date/Time</th>
							<th>Count</th>
							<th>Price</th>											
						</tr>
					</thead>
					<tbody>						
						<?php	
						$sum = 0;					
						foreach ($paid as $id => $item) 
						{
							$p          = get_post($id);
							$base_price = get_post_meta($id, 'product_price', true);
							$price      = $base_price * $item['count'];
							$sum        = $sum + floatval($price);
							$dt         = date('d-m-Y H:i', $item['time']);
							?>
							<tr data-price="<?php echo $price; ?>">
								<td>
									<?php echo $p->post_title; ?>
									
								</td>
								<td>
									<?php echo $p->post_content; ?>
									
								</td>
								<td><?php echo $dt; ?></td>
								<td>
									<?php echo $item['count']; ?>
									
								</td>
								<td>
									<?php echo $price; ?>
									
								</td>									
							</tr>		
							<?php							
						}
						?>	
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><h3 id="sum"><?php echo $sum; ?></h3></td>							
						</tr>						
					</tbody>
				</table>
			</div>
			<?php
		}
		?>
	</div>
	<!--container ends-->

	<div class="clear"></div>
</div>
<!--top_gradient ends-->

<div class="spacer_30px"></div>
<?php get_footer(); ?>