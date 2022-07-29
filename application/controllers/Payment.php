<?
use Twilio\Rest\Client;
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Payment extends CI_Controller {

	function __construct()
	{
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/order');
		$this->load->library('core/user');
		$this->load->library('core/restaurant');
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
		$this->load->library('core/orderitem');
		$this->load->library('core/menuitem');
		$this->load->library('core/cart');
		$this->load->library('core/lphp');
		$this->load->library('form_validation');
		$this->load->library('session');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('c_date');	
		$this->load->library('core/comission');
		$this->load->library('core/authorize_core');

		// use Twilio\Rest\Client;
		// require_once(APPPATH . 'Twilio\Rest\Client');
	}
	
	
/**
.........................................................................................................
									Start Restaurant payment Section 
.........................................................................................................
*/	
	/*
	* @method 
	* @params 	
	*/
	function initialize($order_id)
	{
		//
		$orderDetail = $this->order->getOrderById($order_id);
		//
		$restaurant_id = $orderDetail['restaurant_id'];
		//
		$secret_key = $this->order->getRestaurantPaystackSecretKey($restaurant_id);
		//
		$email = $orderDetail['order_email'];
		//
		$amount = $orderDetail['totalprice'];
		//
		if (empty($secret_key)) {
			$this->redirectHandler($email);
		}
		// url to go to after payment
		$callback_url = base_url('payment/call_back/'.$order_id);  

		$curl = curl_init();
		//
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_POSTFIELDS => json_encode([
		    'amount'=>$amount*100,
		    'email'=>$email,
		    'callback_url' => $callback_url
		  ]),
		  CURLOPT_HTTPHEADER => [
		    "authorization: Bearer ".$secret_key, //replace this with your own test key
		    "content-type: application/json",
		    "cache-control: no-cache"
		  ],
		));
		//
		$response = curl_exec($curl);
		$err = curl_error($curl);
		//
		if($err){
			$this->redirectHandler($email);	
		}

		$tranx = json_decode($response, true);

		if(!$tranx['status']){
			$this->redirectHandler($email);	
		}

		// comment out this line if you want to redirect the user to the payment page
		// print_r($tranx);
		// redirect to page so User can pay
		// uncomment this line to allow the user redirect to the payment page
		header('Location: ' . $tranx['data']['authorization_url']);
	}


	function call_back ($order_id) {
		//
		$orderDetail 		= $this->order->getOrderById($order_id);
		//
		$restaurant_id = $orderDetail['restaurant_id'];
		//
		$secret_key = $this->order->getRestaurantPaystackSecretKey($restaurant_id);
		//
		$email_to 			= $orderDetail['order_email'];
		//
		$curl = curl_init();
		//
		$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
		//
		if(!$reference){
			$this->redirectHandler($email_to);
		}
		//
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_HTTPHEADER => [
		    "accept: application/json",
		    "authorization: Bearer ".$secret_key,
		    "cache-control: no-cache"
		  ],
		));
		//
		$response = curl_exec($curl);
		$err = curl_error($curl);

		if ($err) {
		  	$this->redirectHandler($email_to);
		}

		$tranx = json_decode($response);

		if (!$tranx->status) {
		 	$this->redirectHandler($email_to);
		}

		if ('success' == $tranx->data->status) {
			//
			$order_status = "Confirmed";
			//
			$orderArr1["id"]			=	$order_id;
			$orderArr1["order_status"]	=	$order_status;
			//
			if($this->session->userdata('table_no'))
			{
				$orderArr1["order_table"]	=	$this->session->userdata('table_no');
			}
			//
			$this->order->updateOrder($orderArr1);
			//
			// get order details
			$orderDetail 				= $this->order->getOrderById($order_id);
			//
			$restaurantId 				= $orderDetail['restaurant_id'];
			//
			// get restaurant details
			$restaurantDetail 			= $this->restaurant->getRestaurantByIdWithTerminal($restaurantId);
			$restaurantName 			= $restaurantDetail["restaurant_name"];
			$terminalId 				= $restaurantDetail["terminal_id"];
			//
			// get terminal detail
			$terminalDetail 			= $this->terminals->getTerminalById($terminalId);
			//
			// get airport details
			$airportDetail 				= $this->airport_core->listAirportById($terminalDetail[0]["airport_id"]);
			//
			$airportName 				= $airportDetail[0]["airport_name"];
			//
			$data["airportName"] 		= $airportName;
			$data["restaurantName"] 	= $restaurantName;
			$data["status"] 			= $order_status;
			$data["orderNumber"] 		= $orderDetail['order_code'];
			$data["email_to"] 			= $email_to;
			$data["deliveryTime"]		= date("h:i A",strtotime($orderDetail['delivery_time']));
			$data["date"] 				= date("F d, Y",strtotime($orderDetail['delivery_time']));
			$data["order_id"] = $order_id;
			$data["restaurantID"] = $restaurantId;

			//
			if ($orderDetail['user_id'] != 0) {
				$userDetail 			= $this->user->getUserById($orderDetail['user_id']);
				$firstName 				= $userDetail[0]['firstname'];
				$data["firstName"] 		= $firstName;
			} else {
				$firstName 				= "Guest";
				$data["firstName"] 		= $firstName;
			}
			//
			$this->user->orders($data);
			//
			redirect(base_url()."userorder/orderSuccess");
			exit();
			
		} else {
			$this->redirectHandler($email_to);	
		}
	}

	private function redirectHandler($email){
        //
		$data["status"] 	= "Unpaid";
		$data["email_to"] 	= $email_to;
		//
		$this->user->orders($data);
		//
		redirect(base_url()."userorder/orderFail");	
    }

    /**
     *
	 *	
     */
    function sms () {
    	
		$sid = 'AC23d5365eec206da935a09e287b97354c';
        $token = '805fff342d29dda47d97fb7594529981';
     	$client = new Client($sid, $token);
 
        // Use the client to do fun stuff like send text messages!
         return $client->messages->create(
            // the number you'd like to send the message to
            "+923205511887",
            array(
                // A Twilio phone number you purchased at twilio.com/console
                "from" => "+your Twilio number",
                // the body of the text message you'd like to send
                'body' => "please leave me alone"
            )
        );

    }


/**
.........................................................................................................
									End Restaurant Payment Section
.........................................................................................................
*/	


}


/* End of file Payment.php */
/* Location: ./system/application/controllers/Payment.php */
?>
