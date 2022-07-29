<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Subscription extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_obj =& get_instance();
		$this->load->library('core/restaurant');
		$this->load->library('email');
		
		if( $this->session->userdata('restaurant')== FALSE )
		   redirect(base_url()."restaurantportal",true);
	}


	function index () {
		$total_remaining_day 		= 0;
		$trile_remaining_days		= 0;

		$is_trial_remaining 		= "no";
		$current_package			= "Trial";

		$restaurantArr 				= $this->session->userdata('restaurant');
		$restaurantID				= $restaurantArr["id"];
		$restaurant_name			= $restaurantArr["restaurant_name"];
		$created_at					= $restaurantArr["stamp"];
		$sub_expiry_date			= '';
		// $expiry_date 				= date("Y-m-d", strtotime('+60 days', strtotime(date("Y-m-d"))));
		$current_date 				= date("Y-m-d");
		$is_subscribe = 'no';
		//
		$subscribe_info = $this->restaurant->getSubscription($restaurantID);

		if (!empty($subscribe_info)) {
			//
			$end_date = date("Y-m-d", strtotime($subscribe_info['end_date']));
			//  
			if ($subscribe_info['category'] == 'monthly') {
				$current_package	= "Monthly";
			} else {
				$current_package	= "Annually";
			}

			$is_subscribe = 'yes';
		}
				
		//
		$expiry_date = date("Y-m-d", strtotime('+60 days', strtotime($created_at)));
		//
		$trail_date2 = date_create($expiry_date);
		$trail_date1 = date_create($current_date);
		$trail_diff = date_diff($trail_date1,$trail_date2);
		//
		if ($trail_diff->format("%R%a") > 0)
		{
			if (empty($sub_expiry_date)) {
				$sub_expiry_date = $expiry_date;
			}
			$trile_remaining_days = $trail_diff->format("%R%a");
		   	$total_remaining_day = $total_remaining_day + $trile_remaining_days;

			$is_trial_remaining = "yes";
		} else {

			if (empty($sub_expiry_date)) {
				$sub_expiry_date = $expiry_date;
			}
		}
		//
		$data						=	array();
		$data["activemenu"]			=	"print_qr_code";
		$data["restaurantID"]		=	$restaurantID;
		$data["restaurant_name"]	=	$restaurant_name;
		$data["title"]				=	"Subscription Info";
		$data["current_package"]	=	$current_package;
		$data["sub_expiry_date"]	=	$sub_expiry_date;

		$data["is_trial_remaining"]	=	$is_trial_remaining;
		$data["trial_day"]			=	str_replace('+', '', $trile_remaining_days);

		$data["total_day"]			=	str_replace('+', '', $total_remaining_day);
		$data["phone"]				=	"+234 913 537 2467";
		$data["email"]				=	"support@waivemenu.com";
		$data["is_subscribe"]		=	$is_subscribe;

		$this->load->view('restaurantportal/subscription/subscription_package',$data);

		// if ($data["total_day"] > 0 || (!empty($subscribe_info) && !empty($subscribe_info['subscription_code']))) {
		// 	$data["activemenu"]	=	"subscription";
		// 	$this->load->view('restaurantportal/subscription/subscription_package',$data);
		// } else {
		// 	$this->load->view('restaurantportal/subscription/index',$data);
		// }
	}

	function purchase ($type, $days) {
		$price = 0;
		//
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurant_id = $restaurantArr['id'];
		$restaurant_email = $restaurantArr['email'];
		$restaurant_name = $restaurantArr['restaurant_name'];
		//
		if ($type == 'monthly') {
			$plan_price = $this->restaurant->getSubscriptionPlanPrice('monthly');
			$price = MONTHLY_SUBSCRIPTION;
		} else {
			$plan_price = $this->restaurant->getSubscriptionPlanPrice('annually');
			$price = YEARLY_SUBSCRIPTION;
		}
		//
		$callback_url = base_url('subscription/call_back/'.$type.'/'.$days);  

		$curl = curl_init();
		//
		$paystack_key = $this->config->item('paystack_key');
		//
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_POSTFIELDS => json_encode([
		    'amount'=>$plan_price,
		    'email'=>$restaurant_email,
		    'callback_url' => $callback_url,
		    // 'currency' => "USD"
		  ]),
		  CURLOPT_HTTPHEADER => [
		    "authorization: Bearer ".$paystack_key, //replace this with your own test key
		    "content-type: application/json",
		    "cache-control: no-cache"
		  ],
		));
		//
		$response = curl_exec($curl);
		$err = curl_error($curl);
		//
		if($err){
			$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later');
			redirect(base_url("subscription"),true);
		}

		$tranx = json_decode($response, true);

		if(!$tranx['status']){
			$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later');
			redirect(base_url("subscription"),true);	
		}

		header('Location: ' . $tranx['data']['authorization_url']);
	}


	function call_back ($type, $remaining_days) {
		//
		$curl = curl_init();
		$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
		//
		if(!$reference){
			$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later');
			redirect(base_url("dashboard"),true);
		}
		//
		$paystack_key = $this->config->item('paystack_key');
		//
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_SSL_VERIFYPEER => false,
		  	CURLOPT_HTTPHEADER => [
		    	"accept: application/json",
		    	"authorization: Bearer ".$paystack_key,
		    	"cache-control: no-cache"
		  	],
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		if ($err) {
		  	$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later');
		  	redirect(base_url("dashboard"),true);
		}

		$tranx = json_decode($response);

		if (!$tranx->status) {
		 	$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later');
		 	redirect(base_url("dashboard"),true);
		}

		if ('success' == $tranx->data->status) {
			//
			$plan_price = 0;
			$end_date = '';
			$start_date = date("Y-m-d");
			//
			if ($type == 'monthly') {
				$plan_price = $this->restaurant->getSubscriptionPlanPrice('monthly');
				$price = MONTHLY_SUBSCRIPTION;
				$recalculate = 30 + $remaining_days;
				$total_days = "+".$recalculate." days";
				$end_date = date("Y-m-d", strtotime($total_days, strtotime(date('Y-m-d H:i:s'))));
			} else {
				$plan_price = $this->restaurant->getSubscriptionPlanPrice('annually');
				$price = YEARLY_SUBSCRIPTION;
				$recalculate = 365 + $remaining_days;
				$total_days = "+".$recalculate." days";
				$end_date = date("Y-m-d", strtotime($total_days, strtotime(date('Y-m-d H:i:s'))));
			}
			//
			$restaurantArr = $this->session->userdata('restaurant');
			//
			$restaurant_id = $restaurantArr['id'];
			$restaurant_email = $restaurantArr['email'];
			$restaurant_name = $restaurantArr['restaurant_name'];
			//
			$subscribe_info = $this->restaurant->getSubscription($restaurant_id);

			if (!empty($subscribe_info)) {
				//
				$subscription_code = $subscribe_info['subscription_code'];
    			$subscription_token =	$subscribe_info['subscription_email_token'];
    			//
    			$this->disable_subscription($subscription_token, $subscription_code);	
				//
				if ($type == 'monthly') {
					$plan_code = $this->restaurant->getSubscriptionPlanCode('monthly');
				} else {
					$plan_code = $this->restaurant->getSubscriptionPlanCode('annually');
				}
				//
				$datetime = new DateTime($end_date);
				$sub_start_date = $datetime->format('c');
				//
				$customer_code = $restaurantArr['paystack_id'];
				//
				$sub_code = $this->subscribe_customer($customer_code, $plan_code, $sub_start_date, $subscribe_info['id']);
				//
				if ($sub_code == "error") {
					$this->session->set_flashdata('payment_error', '<b>Error:</b> This subscription is already in place.');
					redirect(base_url("dashboard"),true);
				}
				//
				$data_to_update = array();
				$data_to_update['category'] = $type;
				$data_to_update['price'] = $plan_price;
				$data_to_update['start_date'] = $start_date;
				$data_to_update['end_date'] = $end_date;
				
				$this->restaurant->updateSubscription($subscribe_info['id'],$data_to_update);
			} else {
				//
				$data_to_insert = array();
				$data_to_insert['category'] = $type;
				$data_to_insert['price'] = $plan_price;
				$data_to_insert['restauran_id'] = $restaurant_id;
				$data_to_insert['restauran_name'] = $restaurant_name;
				$data_to_insert['restauran_email'] = $restaurant_email;
				$data_to_insert['start_date'] = $start_date;
				$data_to_insert['end_date'] = $end_date;
				
				$record_id = $this->restaurant->addSubscription($data_to_insert);

				$customer_code = $this->create_custumer($restaurant_email, $restaurant_name);

				if ($customer_code != "error") {
					$plan_code = '';
					//
					if ($type == 'monthly') {
						$plan_code = $this->restaurant->getSubscriptionPlanCode('monthly');
					} else {
						$plan_code = $this->restaurant->getSubscriptionPlanCode('annually');
					}
					//
					$datetime = new DateTime($end_date);
					$sub_start_date = $datetime->format('c');
					$sub_code = $this->subscribe_customer($customer_code, $plan_code, $sub_start_date, $record_id);

					if ($sub_code == "error") {
						$this->session->set_flashdata('payment_error', '<b>Error:</b> This subscription is already in place.');
						redirect(base_url("dashboard"),true);
					}
				} else {
					$this->session->set_flashdata('payment_error', '<b>Error:</b> Custumer not created on Paystack.');
					redirect(base_url("dashboard"),true);
				}
			}
			
			//
			$this->session->set_flashdata('payment_success', '<b>Success:</b> You have been successfully subscribed.');
			redirect(base_url("dashboard"),true);
			exit();
			
		} else {

			$this->session->set_flashdata('payment_error', '<b>Error:</b> Payment fail please try again later.');
			redirect(base_url("dashboard"),true);	
		}
		
	}

	//https://paystack.com/docs/api
	//document used for pay stack
	function create_custumer ($email, $name) {
		$url = "https://api.paystack.co/customer";
		$fields = [
		    'email' => $email,
		    'first_name' => $name,
		];
		
		$fields_string = http_build_query($fields);
		//open connection
		$ch = curl_init();
		//
		$paystack_key = $this->config->item('paystack_key');
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "accept: application/json",
		    "authorization: Bearer ".$paystack_key,
		    "cache-control: no-cache"
		));
		  
		  //So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
		  
		  //execute post
		$customer = curl_exec($ch);
		
		$customer_obj = json_decode($customer);
		$customer_info = (array)$customer_obj;

		if ($customer_info['status'] == true) { 
			$customer_data = (array) $customer_info['data'];
			$customer_email = $customer_data['email'];
			$data_to_update = array();
			$data_to_update['paystack_id'] = $customer_data['customer_code'];

			$this->restaurant->addCustumerPaystackId($customer_email, $data_to_update);
			return $customer_data['customer_code'];
		} else {
			return 'error';
		}		
	}

	function disable_subscription ($email_token, $sub_code) {
		$url = "https://api.paystack.co/subscription/disable";
		$fields = [
		    'code' => $sub_code,
		    'token' => $email_token
		];
		//
		$fields_string = http_build_query($fields);
		//open connection
		$ch = curl_init();
		//
		$paystack_key = $this->config->item('paystack_key'); 
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		"accept: application/json",
		    "authorization: Bearer ".$paystack_key,
		    "cache-control: no-cache"
  		));
		  
		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
	}

	function subscribe_customer ($customer, $plan, $date, $row_id) {
		$url = "https://api.paystack.co/subscription";
  		
  		$fields = [
    		'customer' => $customer,
    		'plan' => $plan,
    		'start_date' => $date
  		];
  		$fields_string = http_build_query($fields);
  
  		//open connection
  		$ch = curl_init();
  		//
  		$paystack_key = $this->config->item('paystack_key');
  		//set the url, number of POST vars, POST data
  		curl_setopt($ch,CURLOPT_URL, $url);
  		curl_setopt($ch,CURLOPT_POST, true);
  		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
  		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		"accept: application/json",
		    "authorization: Bearer ".$paystack_key,
		    "cache-control: no-cache"
  		));
  
  		//So that curl_exec returns the contents of the cURL; rather than echoing it
  		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  		//execute post
  		$custumer_subscription = curl_exec($ch);

  		$custumer_subscription_obj = json_decode($custumer_subscription);
		$custumer_subscription_info = (array)$custumer_subscription_obj;

  		if ($custumer_subscription_info['status'] == true) { 
			$custumer_subscription_data = (array) $custumer_subscription_info['data'];
			$data_to_update = array();
			$data_to_update['subscription_code'] = $custumer_subscription_data['subscription_code'];
			$data_to_update['subscription_email_token'] = $custumer_subscription_data['email_token'];
			$data_to_update['subscription_id'] = $custumer_subscription_data['id'];
			$data_to_update['subscription_authorization'] = $custumer_subscription_data['authorization'];

			$this->restaurant->updateSubscription($row_id, $data_to_update);
		} else {
			return 'error';
		}
	}

	function create_subscription_plan ($name, $interval, $amount) {
		//
		$plan_id = $this->restaurant->checkSubscriptionPlan($interval);
		//
		$url = '';
		//
		$price = $amount*100;
		//
		$fields = [
		    'name' => $name,
		    'amount' => (int)$price,
		];
		//
		if (empty($plan_id)) {
			$url = "https://api.paystack.co/plan";
			$fields['interval'] = $interval;
		} else {
			$plan_code = $this->restaurant->getSubscriptionPlanCode($interval);
			$url = "https://api.paystack.co/plan/".$plan_code;
		}
		
		//
		
		//
		$fields_string = http_build_query($fields);
  		//open connection
  		$ch = curl_init();
  		//
  		$paystack_key = $this->config->item('paystack_key');
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		if (empty($plan_id)) {
			curl_setopt($ch,CURLOPT_POST, true);
		} else {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		}
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "accept: application/json",
		    "authorization: Bearer ".$paystack_key,
		    "cache-control: no-cache"
		));
  
 		//So that curl_exec returns the contents of the cURL; rather than echoing it
  		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  		//execute post
  		$plan = curl_exec($ch);
  		//
  		$plan_obj = json_decode($plan);
  		//
		$plan_info = (array)$plan_obj;
  		//

		if ($plan_info['status'] == 1) { 
			if (isset($plan_info['data'])) {
				$plan_data = (array) $plan_info['data'];

				$data_to_insert = array();
				$data_to_insert['category'] = $plan_data['interval'];
				$data_to_insert['price'] = $plan_data['amount'];
				$data_to_insert['currency'] = $plan_data['currency'];
				$data_to_insert['plan_code'] = $plan_data['plan_code'];
				$data_to_insert['send_invoices'] = $plan_data['send_invoices'];
				$data_to_insert['send_sms'] = $plan_data['send_sms'];
				$data_to_insert['created_at'] = date("Y-m-d", strtotime($plan_data['createdAt']));
				$data_to_insert['updated_at'] = date("Y-m-d", strtotime($plan_data['updatedAt']));
				
				$this->restaurant->addSubscriptionPlane($data_to_insert);
			} else {
				$data_to_update = array();
				$data_to_update['price'] = $price;

				$this->restaurant->updateSubscriptionPlane($plan_id, $data_to_update);
			}
			

			return 'success';
		} else {
			return 'error';
		}
	}

	

	function event_listener () {
		$input = @file_get_contents("php://input");

		$event_obj = json_decode($input);

		$event_info = (array)$event_obj;

		if (!empty($event_info)) {
			if (isset($event_info['event']) && $event_info['event'] == 'invoice.create') {
				$event_data = (array) $event_info['data'];
				//
				$start_date = isset($event_data['created_at']) ? $event_data['created_at'] : '';
				$end_date 	= isset($event_data['subscription']->next_payment_date) ? $event_data['subscription']->next_payment_date : '';
				$subscription_code 	= isset($event_data['subscription']->subscription_code) ? $event_data['subscription']->subscription_code : '';
				//
				if (!empty($start_date) && !empty($end_date)) {
					$data_to_update = array();
					$data_to_update['start_date'] = date("Y-m-d", strtotime($start_date));
					$data_to_update['end_date'] = date("Y-m-d", strtotime($end_date));
					
					$this->restaurant->updateSubscriptionEvent($subscription_code, $data_to_update);
				}
			}
		} 

	}

	function test_plan (){
		// $paystack_key = $this->config->item('paystack_key');
		// echo $paystack_key;
		$price = 410000;
		$this->create_subscription_plan('Annually Subscription', 'annually', $price);

		die('plane created');
	}


/**
.........................................................................................................
									End Restaurant Dash Board Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
