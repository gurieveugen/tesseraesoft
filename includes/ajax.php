<?php
// =========================================================
// REQUIRE
// =========================================================
require($_SERVER["DOCUMENT_ROOT"].'/wp-blog-header.php');
require_once 'paypal.php';

header("HTTP/1.1 200 OK");


class AJAX{
	//                          __              __      
	//   _________  ____  _____/ /_____ _____  / /______
	//  / ___/ __ \/ __ \/ ___/ __/ __ `/ __ \/ __/ ___/
	// / /__/ /_/ / / / (__  ) /_/ /_/ / / / / /_(__  ) 
	// \___/\____/_/ /_/____/\__/\__,_/_/ /_/\__/____/  
	const SUBSCRIBE_NONCE    = 'subscribe-nonce';
	const SUBSCRIBE_OPTION   = 'subscribers';	                                                 
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($action)
	{			
		if(method_exists($this, $action))
		{
			$this->$action();
		}		
	}

	/**
	 * Buy product
	 */
	public function buy()
	{
		$user                = wp_get_current_user();
		$meta                = get_user_meta($user->ID, 'products', true);
		$id                  = $_POST['id'];		
		$meta                = !is_array($meta) ? array() : $meta;
		$meta[$id]['count']  = isset($meta[$id]) ? $meta[$id]['count']+1 : 1;
		$meta[$id]['time']   = microtime(true);
		$meta[$id]['status'] = 'pending';

		$json['result'] = update_user_meta($user->ID, 'products', $meta);

		echo json_encode($json);
	}

	/**
	 * Remove one item
	 */
	public function remove()
	{
		$user                = wp_get_current_user();
		$meta                = get_user_meta($user->ID, 'products', true);
		$id                  = $_POST['id'];
		unset($meta[$id]);
		$json['result'] = update_user_meta($user->ID, 'products', $meta);

		echo json_encode($json);
	}

	/**
	 * PAYPAL Checkout
	 */
	public function checkout()
	{
		$options       = $GLOBALS['paypal']->getAll();
		$options       = $options['paypal_options'];
		$paypal        = new Paypal($options['api_user_name'], $options['api_password'], $options['api_signature'], $options['mode']);
		// $paypal        = new Paypal('seller_1297608781_biz_api1.lionite.com', '1297608792', 'A3g66.FS3NAf4mkHn3BDQdpo6JD.ACcPc4wMrInvUEqO3Uapovity47p', $options['mode'].'s');		
		$sandbox       = ($options['mode'] == 'sandbox') ? '.sandbox' : '';
		$request_params = array(
		   'RETURNURL' => $options['return_url'],
		   'CANCELURL' => $options['cancel_url']);

		if(is_array($_POST['items']))
		{
			$i = 0;
			foreach ($_POST['items'] as $id => &$item) 
			{
				$count                                 = intval($item['count']);
				$price                                 = floatval($item['price']);
				$items['L_PAYMENTREQUEST_0_QTY'.$i]    = $count;
				$items['L_PAYMENTREQUEST_0_AMT'.$i]    = $price;
				$items['L_PAYMENTREQUEST_0_NAME'.$i]   = urlencode($item['title']);
				$items['L_PAYMENTREQUEST_0_NUMBER'.$i] = $id;
				$grand_total                           = $grand_total + ($count*$price);
				$i++;
			}
		}

		$order_params = array(
			'PAYMENTREQUEST_0_AMT'          => $grand_total,
			'PAYMENTREQUEST_0_SHIPPINGAMT'  => '0',
			'PAYMENTREQUEST_0_CURRENCYCODE' => $options['currency_code'],
			'PAYMENTREQUEST_0_ITEMAMT'      => $grand_total);
		
		
		$response = $paypal->request('SetExpressCheckout', $request_params + $order_params + $items);
		
		$json['result'] = false;
		if(is_array($response) && $response['ACK'] == 'Success') 
		{
			$_SESSION['items'] = $order_params + $items;
			$token          = $response['TOKEN'];					
			$json['url']    ='https://www'.$sandbox.'.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token);
			$json['result'] = true;
		}
		echo json_encode($json);
	}

	/**
	 * JUST FOR DEBUG
	 */
	public function clear()
	{
		$user = wp_get_current_user();
		delete_user_meta($user->ID, 'products');
	}
}

// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['AJAX'] = new AJAX($_GET['action']);