<?php
/**
 * Template name: Thank you
 */
?>
<?php 
get_header();
the_post();
?>
<!--top_gradient starts-->
<div class="top_gradient">
	<div class="container clearfix">
		<div class="grid_12"> 

			<!--page header starts-->
			<div class="page_header clearfix">
				<h1><?php the_title(); ?></h1>    
			</div>
			<!--page header ends--> 

		</div>
	</div>

	<!--container starts-->
	<div class="container clearfix">
		<?php the_content(); ?>
		<?php
		$options = $GLOBALS['paypal']->getAll();
		$options = $options['paypal_options'];
		if( isset($_GET['token']) && !empty($_GET['token']) ) 
		{ 
			$paypal        = new Paypal($options['api_user_name'], $options['api_password'], $options['api_signature'], $options['mode']);
			// $paypal        = new Paypal('seller_1297608781_biz_api1.lionite.com', '1297608792', 'A3g66.FS3NAf4mkHn3BDQdpo6JD.ACcPc4wMrInvUEqO3Uapovity47p', $options['mode'].'s');			
			$request_params = array(
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
				'TOKEN'                          => $_GET['token'],
				'PAYERID'                        => $_GET['PayerID']);

			
			$response = $paypal->request('DoExpressCheckoutPayment', $request_params + $_SESSION['items']);
			
			if( is_array($response) && $response['ACK'] == 'Success') 
			{ 
				$user = wp_get_current_user();
				$meta = get_user_meta($user->ID, 'products', true);
				foreach ($meta as &$item) 
				{
					$item['status'] = 'paid';
				}
				update_user_meta($user->ID, 'products', $meta);
			}
			else
			{
				var_dump('<pre>', $response, '</pre>');
			}
		}
		?>		
	</div>
	<!--container ends-->

	<div class="clear"></div>
</div>
<!--top_gradient ends-->

<div class="spacer_30px"></div>
<?php get_footer(); ?>


