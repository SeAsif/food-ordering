<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Flutterwave extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/order');
		$this->load->library('core/user');
		$this->load->library('core/restaurant');
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
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
	function initialize ($order_id) {
		//
		$orderDetail = $this->order->getOrderById($order_id);
		//
		$restaurant_id = $orderDetail['restaurant_id'];
		//
		$secret_key = $this->order->getRestaurantFlutterwaveSecretKey($restaurant_id);
		//
		$email = $orderDetail['order_email'];
		//
		$amount = $orderDetail['totalprice'];
		//
		if (empty($secret_key)) {
			$this->redirectHandler($email);
		}
		//
		$callback_url = base_url('flutterwave/call_back/'.$order_id); 

	    //* Prepare our rave request
	    $request = [
	        'tx_ref' => time(),
	        'amount' => $amount,
	        'currency' => 'NGN',
	        'payment_options' => 'card',
	        'redirect_url' => $callback_url,
	        'customer' => [
	            'email' => $email,
	            'name' => 'Zubdev'
	        ],
	        'meta' => [
	            'price' => $amount
	        ],
	        'customizations' => [
	            'title' => 'Paying for a sample product',
	            'description' => 'sample'
	        ]
	    ];

	    //* Ca;; f;iterwave emdpoint
	    $curl = curl_init();

	    curl_setopt_array($curl, array(
	    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_ENCODING => '',
	    CURLOPT_MAXREDIRS => 10,
	    CURLOPT_TIMEOUT => 0,
	    CURLOPT_FOLLOWLOCATION => true,
	    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	    CURLOPT_CUSTOMREQUEST => 'POST',
	    CURLOPT_POSTFIELDS => json_encode($request),
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_HTTPHEADER => array(
	        "Authorization: Bearer ".$secret_key,
	        'Content-Type: application/json'
	    ),
	    ));

	    $response = curl_exec($curl);

	    curl_close($curl);
	    
	    $res = json_decode($response);

	    if($res->status == 'success')
	    {
	        $link = $res->data->link;
	        header('Location: '.$link);
	    }
	    else
	    {
	        $this->redirectHandler($email);
	    }
	}

	function call_back ($order_id) {
		if(isset($_GET['status']))
	    {
	    	//
			$orderDetail 		= $this->order->getOrderById($order_id);
			//
			$restaurant_id = $orderDetail['restaurant_id'];
			//
			$secret_key = $this->order->getRestaurantFlutterwaveSecretKey($restaurant_id);
			//
			$email_to 			= $orderDetail['order_email'];
			//
	        //* check payment status
	        if($_GET['status'] == 'cancelled')
	        {
	            // echo 'YOu cancel the payment';
	            header('Location: index.php');
	        }
	        elseif($_GET['status'] == 'successful')
	        {
	            $txid = $_GET['transaction_id'];

	            $curl = curl_init();
	            curl_setopt_array($curl, array(
	                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
	                CURLOPT_RETURNTRANSFER => true,
	                CURLOPT_ENCODING => "",
	                CURLOPT_MAXREDIRS => 10,
	                CURLOPT_TIMEOUT => 0,
	                CURLOPT_FOLLOWLOCATION => true,
	                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	                CURLOPT_CUSTOMREQUEST => "GET",
	                CURLOPT_SSL_VERIFYPEER => false,
	                CURLOPT_HTTPHEADER => array(
	                  	"Content-Type: application/json",
	                  	"Authorization: Bearer ".$secret_key
	                ),
	            ));
	              
	            $response = curl_exec($curl);
	              
	            curl_close($curl);
	              
	            $res = json_decode($response);

	            if ($res->status) {
	                $amountPaid = $res->data->charged_amount;
	                $amountToPay = $res->data->meta->price;
	                if ($amountPaid >= $amountToPay) {
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
	            } else {
	                $this->redirectHandler($email_to);
	            }
	        }
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
.........................................................................................................
									End Restaurant Payment Section
.........................................................................................................
*/	


}


/* End of file Payment.php */
/* Location: ./system/application/controllers/Payment.php */
?>