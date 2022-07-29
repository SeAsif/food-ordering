<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class UserOrder extends CI_Controller {

	function __construct()
	{
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
	}
	
/**
.........................................................................................................
									Start Restaurant Orders Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data	=	array();
//		$this->load->view('userfront/home',$data);
	}

	function orderhistory()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$data	=	array();
		
		$orderFilter["user_id"]	=	$this->session->userdata('id');
		$orderFilter["order_status"]	=	"All";
		
		if ($_POST)
		{
			$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
			$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['start_date']	=	form_error('start_date');
				$errorsArray['end_date']	=	form_error('end_date');

				$data["errors"]=$errorsArray;
			
			}
			else
			{
		
				$orderFilter["start_date"]	=	date("Y-m-d",strtotime($this->input->get_post("start_date")));
				$orderFilter["end_date"]	=	date("Y-m-d",strtotime($this->input->get_post("end_date")));
			}
		}
		$orders=$this->order->getOrdersByUser($orderFilter);
		//print_r ($orders);
		$data["orders"]	=	$orders;
		$data["orderFilter"]	=	$orderFilter;
		
		
//		print_r($orders);
//		print_r($orderFilters);
		
		
		$this->load->view('userfront/userorder/orderhistory',$data);
	}

	function orderdetail($orderid, $pdf = false)
	{
		
		if (!$this->session->userdata('id') && !$this->session->userdata('guest_email'))
			redirect(base_url()."/");
			
		$data	=	array();
		$data['pdf'] = $pdf;
		$order	=	$this->order->getOrderById($orderid);
  
		$data["orderitems"]=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$orderid));		
		
		$terminal = $this->terminals->getTerminalById($order["terminal_id"]);
		
		$airport = $this->airport_core->listAirportById($terminal[0]["airport_id"]);
		
		$data["order"] = $order;
		$data["terminal"] = $terminal;
		$data["airport"] = $airport;
		
		$restaurantDetail=$this->restaurant->getRestaurantByIdWithTerminal($order['restaurant_id']);
			
		$data["restaurantInfo"]	=	$restaurantDetail;
		$this->load->view('userfront/userorder/orderdetail',$data);
	}

	function reOrder($orderId)
	{
//		$order	=	$this->order->getOrderById($orderId);
		echo json_encode($this->order->reOrder($orderId, $this->session->userdata("tgb_session_id")));
		//print_r ($order);
	}

	function checkout($validated="")
	{
		$data	=	array();
		$id = $this->session->userdata('restaurantID');

		if($this->session->userdata('table_no'))
		{
			$data["table_no"]	=	$this->session->userdata('table_no');
		}

		$table_no = $this->session->userdata('table_no');
		$info = $this->restaurant->listRestaurantById($id);
		if($validated == "Time_Expired")
			$errorsArray['time'] = "<strong>Alert : </strong>Sorry order pick up time must be ".$info["delivery_time_before"]." minutes after the current time for ".$info["restaurant_name"]." restaurant. The time has been Expired.<br /> Please Reconfirm the timings.!!";
			
		else if($validated == "Price_Problem")
			$errorsArray['failed'] = "<strong>Alert : </strong>Sorry the Price does not Match with the Actual Price. Process cannot be done!.<br /> Please Reconfirm the order!!";
			
		else if($validated == "Session_Problem")
			$errorsArray['failed'] = "<strong>Alert : </strong>Sorry Your session does not match with the actual session. Process cannot be done!.<br /> Please Reconfirm the order!!";	
			
		else if($validated == "payment_gateway_not_set")
			$errorsArray['failed'] = "<strong>Alert : </strong>Your payment method is not setup, please contact restaurant owner to setup payment gateway";	
			
		$this->load->library('core/orderitem');	

		$cartItems	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$this->session->userdata("tgb_session_id")));
		
		//print_r ($cartItems);

		$data["cartItems"]	=	$cartItems;
		$data["restaurantInfo"]	=	$info;
		$data["errors"] = $errorsArray;
		
		$this->load->view('userfront/userorder/checkout',$data);
	}

	function paymentinfo($order_id=0)
	{
		$info = $this->session->userdata('validation_information');
		if($info["validation"] == "NO")
		{
			$errorsArray['time'] = "<strong>Alert : </strong>Sorry ".$info["text"]." Please try again";
		}
		$this->session->unset_userdata('validation_information');
		$data	=	array();
		$data["order"]=$order_id;
		$orderDetail=$this->order->getOrderById($order_id);
		$cartItems	=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$order_id));

		if($this->session->userdata('id'))
		{
			$userInfo = $this->user->getUserById($orderDetail["user_id"]);
			if($userInfo[0]["customer_profile_id"] != "")
				$data["profile_id"] = 1;
			else
				$data["profile_id"] = 0;	
		}
		$newyear = date("Y");
		$data["newyear"]=$newyear+1;
		$data["cartItems"]	=	$cartItems;
		$data["orderDetail"] = $orderDetail;
		$data["errors"] = $errorsArray;
		$this->load->view('userfront/userorder/paymentinfo',$data);
	}

	function addOrder()
	{	
		
		
		$table_no	=	trim($this->input->get_post("table_no"));
		if (!empty($table_no)) {
			$this->session->set_userdata("table_no" , $table_no);
		}
		$arrInfo["restaurant_id"]	=	trim($this->input->get_post("restaurant_id"));
		$arrInfo["payment_method"]	=	trim($this->input->get_post("payment_method"));
		$arrSearchCriteria	=	$this->session->userdata('search_criteria');


		$date = date("Y-m-d");
		if (isset($arrSearchCriteria['flight_date'])) {
			$date = date("Y-m-j",strtotime($arrSearchCriteria['flight_date']));//echo "<br />";
		}
					
		$deliveryTime = date("H:i:s");
		if (isset($arrSearchCriteria['pickup_time_hour']) && isset($arrSearchCriteria['pickup_time_minute']) && isset($arrSearchCriteria['pickup_time_type'])) {
			$deliveryTime=date("H:i:s",strtotime($arrSearchCriteria['pickup_time_hour'].":".$arrSearchCriteria['pickup_time_minute'].":00 ".$arrSearchCriteria['pickup_time_type']));//echo "<br />";
		} 
		
		$arrInfo["delivery_time"]	=	date($date)." ".$deliveryTime;
		if($this->input->get_post("pre_order") == "Yes"){
			$arrInfo["pre_order"]	=	trim($this->input->get_post("pre_order"));
			$date = \DateTime::createFromFormat('d-m-Y', trim($this->input->get_post("date")));
			$date = $date->format('Y-m-d');
			$arrInfo["delivery_time"]	=	$date." ".trim($this->input->get_post("time"));
		}
		$arrInfo["stamp"] = date("Y-m-d H:i:s");
		
		if($this->input->get_post("box"))
			$arrInfo["is_favorite"]	=	$this->input->get_post("box");
		else
			$arrInfo["is_favorite"]	=	"No";
			
		if($this->session->userdata('guest_email')!="" && $this->session->userdata('id')=="")
		{
			$arrInfo["order_name"]= $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$arrInfo["order_email"]=$this->session->userdata('guest_email');
			$arrInfo["order_phone"]=$this->session->userdata('phone');
		}	
		
		else
		{
			$arrInfo["order_name"]= $this->session->userdata('firstname').' '.$this->session->userdata('lastname');
			$arrInfo["order_email"]=$this->session->userdata('email');
			$arrInfo["order_phone"]=$this->session->userdata('phone');
		}	
		$arrInfo["totalprice"]	=	trim($this->input->get_post("order_cost"));
		
		
		
		if($this->session->userdata('id')!="")
			$arrInfo["user_id"]		=	trim($this->input->get_post("user_id"));
		else
			$arrInfo["user_id"]		=	0;
		$arrInfo["order_through"]	=	"Web";
		$arrInfo["order_type"]	=	trim($this->input->get_post("order_type"));
		if($arrInfo["order_type"] == "Delivery"){
			$arrInfo["address"]	=	trim($this->input->get_post("address"));
		}
		$sessionid	=	"";
		
		
		$sessionid	=	$this->session->userdata("tgb_session_id");
	
		$itemsWithVariants	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$sessionid));
		
		$returnData = $this->cart->getTaxes($sessionid);
		$totalCityTax = 0;
		$totalStateTax = 0;
		foreach($returnData as $row)
		{
			$totalCityTax = $totalCityTax + $row["city_tax"];
			$totalStateTax = $totalStateTax + $row["state_tax"];
		}
		//	$arrInfo["totalprice"] = $arrInfo["totalprice"] + $totalCityTax + $totalStateTax;
		$arrInfo["city_tax"] = $totalCityTax;
		$arrInfo["state_tax"] = $totalStateTax;

		///////////////Calculate number of minutes remianing in pickup time////////////////////
		$pickUpTime=$arrInfo["delivery_time"];
		$current_date=date("Y-m-d H:i:s");
		$diff=$this->c_date->diffDate ($current_date, $pickUpTime);
		$diff=ceil($diff*24*60);

		$commPercent=$this->comission->calculateComission($diff);
		if($commPercent==NULL)
			$commPercent=$this->config->item('DEFAULT_PERCENTAGE');

		$comission=($arrInfo["totalprice"]*$commPercent)/100;
		$arrInfo["tgb_comission"]	=	$comission;
		if ($arrInfo['order_type'] == "Delivery") {
			$deliveryCharges = $this->order->getDeliveryCharges($arrInfo["restaurant_id"]);
			$arrInfo['delivery_charge'] = $deliveryCharges;
			$arrInfo['totalprice'] = $arrInfo['totalprice'] + $deliveryCharges;
		}

		$validated = $this->order->validateOrder($arrInfo,$itemsWithVariants,$sessionid);

		if($validated == "VERIFIED")
		{

			if(!empty($table_no))
			{
				$arrInfo["order_table"]	=	$table_no;
			}
			//
			$insert_coupon_history = "no";
			//
			$coupon_history_data = array();
			//
			if (isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
				$coupon_code = $_POST['coupon_code'];
				
				$restaurant_id = $_POST['restaurant_id'];
				$valid_coupon_info = $this->order->checkCouponCodeValid($coupon_code, $restaurant_id);

				if (empty($valid_coupon_info)) {
					$this->session->set_flashdata('coupon_message', '<strong>Error:</strong> You are enter invalid coupon code!');
					redirect(base_url()."userorder/checkout");
				} else if ($valid_coupon_info['usage'] != 0) {
					$used_coupon_count = $this->order->checkUserAvailCoupon($arrInfo['order_email'], $coupon_code, $restaurant_id);

					if ($valid_coupon_info['usage'] == $used_coupon_count) {
						$this->session->set_flashdata('coupon_message', '<strong>Error:</strong> You are already avail this ('.$coupon_code.') coupon limit. please try any other valid coupon code!');
						redirect(base_url()."userorder/checkout");
					}
				} 

				if ($valid_coupon_info['customer_log'] == 'Yes' ) {
					if ($arrInfo['user_id'] == 0) {
						$this->session->set_flashdata('coupon_message', '<strong>Error:</strong> This coupon required login. please login to avail coupon!');
						redirect(base_url()."userorder/checkout");
					}
					
				}

				$discount_value = $valid_coupon_info['discount'];
				$order_price = $arrInfo['totalprice'];
				$new_price = 0 ;
				//
				if ($valid_coupon_info['discount_type'] == 'Percentage') {
					$discount_price = ($discount_value / 100) * $order_price;
					$coupon_history_data['discount_amount'] = $discount_price;
					$new_price = $order_price - $discount_price;
				} else {
					$new_price = $order_price - $discount_value;
					$coupon_history_data['discount_amount'] = $discount_value;
				}

				$arrInfo['totalprice'] = $new_price;

				$coupon_history_data['coupon_code'] = $coupon_code;
				$coupon_history_data['total_amount'] = $order_price;
				$coupon_history_data['new_total_amount'] = $new_price;
				$coupon_history_data['restaurant_id'] = $restaurant_id;
				$coupon_history_data['user_email'] = $arrInfo['order_email'];
				//
				$insert_coupon_history = "yes";
			}
			//
			$order	=	$this->order->addOrder($arrInfo,$itemsWithVariants,$sessionid);
			//
			if ($insert_coupon_history == 'yes') {
				$coupon_history_data['order_id'] = $order['order_id'];
				$coupon_history_data['created_at'] = date("Y-m-d H:i:s");

				$this->order->saveCouponhistory($coupon_history_data);

			}
			//
			$arrSession['order']=$order;
			//	exit();
			$this->session->set_userdata($arrSession);
			$this->session->unset_userdata('restaurantID');
			if($this->input->get_post("payment_method") == "Card" ){
				$payment_gateway_info = $this->restaurant->getRestaurantSecretKey($arrInfo["restaurant_id"]);
				$gateway = $payment_gateway_info['payment_gateway'];
				if ($gateway == 'paystack') {
					return redirect(base_url('payment/initialize') . '/' .$order['order_id']);
				} else if($gateway == 'flutterwave'){
					return redirect(base_url('flutterwave/initialize') . '/' .$order['order_id']);
				}else{
					return redirect(base_url()."userorder/checkout/payment_gateway_not_set");	
				}

				
			}else{
				$myorder['oid'] = $order['order_id'];
				$myorder['ordertype'] = 'SALE';
				$myorder['chargetotal'] = $arrInfo['totalprice'];
				return $this->processorder_gateway($myorder);
			}
		}
		else
		{//die('yesssssssssssss');	//echo "Sorry Cannot Process. Something went Wrong. Please Reconfirm!!";
			redirect(base_url()."userorder/checkout/$validated");	
		}
		// else if ($validated == "TIME_EXPIRED")
		// {
		// 	echo "Sorry order pick up time must be 25 minutes after the current time. The time has been Expired. Please Reconfirm!!";
		// }
		//redirect(base_url()."userorder/paymentinfo/$list[order_id]");	
		
	}


	function processOrder($orderId="")
	{
		/*
		order_title
		order_no
		amount
		buyer_email
		*/
		$order	=	$this->order->getOrderById($orderId);
		$ordersdetail["order_no"]=$order["id"];
		$ordersdetail["amount"]=$order["totalprice"];
		$ordersdetail["buyer_email"]=$order["order_email"];
		$ordersdetail["order_title"]="Order Payment ".$order["id"];
		$data	=	array();
		$data["orderDetail"]	=	$ordersdetail;
		
		$this->load->view('userfront/userorder/paypal',$data);
	}	

	function Success()
	{
		$data = [];
		$this->load->view('orders/paypal_success',$data);
	}	
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function ipn_order()
	{
	
		// read the post from PayPal system and add 'cmd'
			
		$req = 'cmd=_notify-validate';
		
		foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$req .= "&$key=$value";
		}

		// Assign posted variables to local variables
		
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = 'Completed';//$_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		
		
		
		
			
		// post back to PayPal system to validate
		/*$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Host: www.paypal.com:80\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);*/
		
		$header .= "POST /us/cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Host: www.paypal.com:80\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
		
		fputs ($fp, $header . $req);
		while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) {
		// check the payment_status is Completed
		
		
			//$order	=	$this->order->getOrderById($item_number);
			$orderArr1["id"]	=	$item_number;
			$orderArr1["order_status"]	=	"Pending";
			$data["status"] = $orderArr1["order_status"];
			$this->order->updateOrder($orderArr1); 
			$orderDetail=$this->order->getOrderById($orderArr1["id"]);
			$orderNumber=$orderDetail['order_code'];
			$email_to = $orderDetail['order_email'];
			$data["orderNumber"] = $orderNumber;
			$data["email_to"] = $email_to;
			
			$restaurantId=$orderDetail['restaurant_id'];
			$deliveryTime=date("h:i A",strtotime($orderDetail['delivery_time']));
			$data["deliveryTime"] = $deliveryTime;
			
			$date=date("F d, Y",strtotime($orderDetail['delivery_time']));
			$data["date"] = $date;
			//get user details
			if($orderDetail['user_id']!=0)
			{
			$userDetail=$this->user->getUserById($orderDetail['user_id']);
			$firstName=$userDetail[0]['firstname'];
			$email_to = $userDetail[0]['email'];
			$data["email_to"] = $email_to;
			$data["firstName"] = $firstName;
			}else
			{
			$firstName="Guest";
			$data["firstName"] = $firstName;
			}
				
			//get restaurant details
			$restaurantDetail=$this->restaurant->getRestaurantByIdWithTerminal($restaurantId);
			$restaurantName=$restaurantDetail["restaurant_name"];
			$data["restaurantName"] = $restaurantName;
			
			$terminalId=$restaurantDetail["terminal_id"];
			$data["terminalId"] = $terminalId;
			//get terminal detail
			$terminalDetail=$this->terminals->getTerminalById($terminalId);
			$data["terminalDetail"] = $terminalDetail;
			
			//get airport details
			$airportDetail=$this->airport_core->listAirportById($terminalDetail[0]["airport_id"]);
			
			$airportName=$airportDetail[0]["airport_name"];
			$data["airportName"] = $airportName;
			//send email to payer
			
			$this->user->orders($data);
			
		}//if
		else
		{
			$data["status"] = "Unpaid";
			$orderArr1["id"]	=	$item_number;
			$orderDetail=$this->order->getOrderById($orderArr1["id"]);
			$email_to = $orderDetail['order_email'];
			$data["email_to"] = $email_to;
			$this->user->orders($data);
		}
		}//while
		exit ();
	}

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function processorder_gateway($myorder = null)
	{
		$this->load->library('core/profile_core');
		$this->load->library('core/authorize_core');
	
		# form data
		if($myorder == null){
			$myorder["cardnumber"]    = $_POST["cardnumber"];
			$myorder["cardexpmonth"]  = $_POST["cardexpmonth"];
			$myorder["cardexpyear"]   = $_POST["cardexpyear"];
			$myorder["chargetotal"]   = $_POST["chargetotal"];
			$myorder["ordertype"]     = $_POST["ordertype"];
			$myorder["cvmvalue"]      = $_POST["cvmvalue"];
			$myorder["oid"]     = $_POST["oid"];
		}

/////////////////////////////////////////////////////////////////////////////////////////////////////		
		
		$paymentProfile = 0;
		if ($this->input->get_post("use_payment_profile") && $this->input->get_post("user_id"))
		{
			
			$arrInfo["userid"]  = $this->input->get_post("user_id");
			$arrInfo["cardnumber"]  = $myorder["cardnumber"];
			$arrInfo["expyear"]  = $myorder["cardexpyear"];
			$arrInfo["expmonth"]  = $myorder["cardexpmonth"];
			$arrInfo["chargetotal"]   = $myorder["chargetotal"];
			$list = $this->profile_core->createCustomerProfile($arrInfo);
			if($list["validation"] == "NO")
			{	//echo "list validation == NO";
				$arrSession["validation_information"]	=	$list;
				$this->session->set_userdata($arrSession);
				redirect(base_url()."userorder/paymentinfo/".$myorder["oid"]);
			}
			else
			{	
				$paymentProfile = $list["paymentProfile"];
			}
		}
		
		$approved = FALSE;
		if(!$this->input->get_post('paymentProfileId') && $paymentProfile == 0)
		{	
			// $result = $this->authorize_core->processTransaction($myorder);
			// if($result == 1)
				$approved = TRUE;
			// else
			// 	$approved = FALSE;	
		}	
		
		else
		{
			$userInfo["chargetotal"] = $myorder["chargetotal"];
			
			if($paymentProfile == 0)
				$userInfo["customer_payment_profile_id"] = $this->input->get_post('paymentProfileId');
			else
				$userInfo["customer_payment_profile_id"] = $paymentProfile	;
				
			$userId = $this->input->get_post('user_id');
			$user = $this->user->getUserById($userId);
			$userInfo["customer_profile_id"] = $user[0]["customer_profile_id"];
			$userInfo["orderId"] = $myorder["oid"];

			if($userInfo["customer_profile_id"] != "")
				$approved = TRUE;

		}
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
		if ($approved == FALSE)
		{
			$data["status"] = "Unpaid";
			$orderArr1["id"]	=	$myorder["oid"];
			$orderDetail=$this->order->getOrderById($orderArr1["id"]);
			$email_to = $orderDetail['order_email'];
			$data["email_to"] = $email_to;
			$this->user->orders($data);

		redirect(base_url()."userorder/orderFail");			
		}
		else	// success
		{		
			$orderArr1["id"]	=	$myorder["oid"];
			$orderArr1["order_status"]	=	"Confirmed";
			//
			$data["status"] = $orderArr1["order_status"];
			$this->order->updateOrder($orderArr1); 
			$orderDetail=$this->order->getOrderById($orderArr1["id"]);

			$orderNumber=$orderDetail['order_code'];
			$email_to = $orderDetail['order_email'];
			$data["orderNumber"] = $orderNumber;
			$data["email_to"] = $email_to;
			
			$restaurantId=$orderDetail['restaurant_id'];
			$deliveryTime=date("h:i A",strtotime($orderDetail['delivery_time']));
			$date=date("F d, Y",strtotime($orderDetail['delivery_time']));
			$data["deliveryTime"] = $deliveryTime;
			$data["date"] = $date;
			$data["order_id"] = $orderArr1["id"];
			$data["restaurantID"] = $restaurantId;
			//get user details
			if($orderDetail['user_id']!=0)
			{
			$userDetail=$this->user->getUserById($orderDetail['user_id']);

			$firstName=$userDetail[0]['firstname'];

			$data["firstName"] = $firstName;
			}else
			{
			$firstName="Guest";
			$data["firstName"] = $firstName;
			}
			
			$this->user->orders($data);
		
			redirect(base_url()."userorder/orderSuccess");
			exit();
		}
	
	# if verbose output has been checked,
	# print complete server response to a table
		if ($_POST["verbose"])
		{
			echo "<table border=1>";
	
			while (list($key, $value) = each($result))
			{
				# print the returned hash 
				echo "<tr>";
				echo "<td>" . htmlspecialchars($key) . "</td>";
				echo "<td><b>" . htmlspecialchars($value) . "</b></td>";
				echo "</tr>";
			}	
				
			echo "</TABLE><br>\n";
		}
		exit ();
	}
	

	function orderSuccess()
	{
		$arrOrder	=	$this->session->userdata('order');
		$data["orderCode"]=$arrOrder["order_code"];
		$data["orderId"]=$arrOrder["order_id"];
		$orderDetail=$this->order->getOrderById($data["orderId"]);
		//print_r($orderDetail);
		$data["orderStatus"]=$orderDetail["order_status"];
		$orderItems = $this->orderitem->getOrderItemByOrderId($data["orderId"]);
		$data["orderItemId"] = $orderItems[0]["id"];
		$data["orderItems"] = $orderItems;
		//
		require $this->config->item("app_base_path") . '/vendor/autoload.php';

		$options = array(
		    'cluster' => 'us3',
		    'encrypted' => true,
            'curl_options' => [
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ],
		);

		$pusher = new Pusher\Pusher(
		    '28a9f70204712108931e',
		    'fcbe48ce5d1f7770576d',
		    '1162652',
		    $options
		);

		$arrInfo['order_id'] = $order_id;
		$orderDetail['stamp'] = date("m/d/Y", strtotime($orderDetail["stamp"]))."<br />".date("h:i A", strtotime($orderDetail["stamp"]));
		$orderDetail['delivery_time'] = date("m/d/Y", strtotime($orderDetail["delivery_time"]))."<br />".date("h:i A", strtotime($orderDetail["delivery_time"]));
		$table_no = $orderDetail["order_table"] != 0 && !empty($orderDetail["order_table"]) ? $orderDetail["order_table"] : "";
		$orderDetail["order_table"] = $table_no;
		//
		$restaurant_id = $orderDetail['restaurant_id'];
		//
		$pusher->trigger('restaurant-'.$restaurant_id, 'my-event', $orderDetail);
		//
		$restaurantDetail=$this->restaurant->getRestaurantByIdWithTerminal($restaurant_id);
			
		$data["restaurantInfo"]	=	$restaurantDetail;
			
		$this->load->view('userfront/userorder/ordersuccess',$data);
	}	
	function orderFail()
	{
		$arrOrder	=	$this->session->userdata('order');
		$data["orderCode"]=$arrOrder["order_code"];
		$data["orderId"]=$arrOrder["order_id"];
		$orderDetail=$this->order->getOrderById($data["orderId"]);
		$order["orderStatus"]=$orderDetail["status"];
		
		$this->load->view('userfront/userorder/orderfail',$data);
	}	
	
	function taxCalculation()
	{
		$arrReturn = $this->cart->calculateTax();
		print_r($arrReturn);
		exit();
	}
	
	function process()
	{
		
		$last_name = "";
		$invoice_number = "";
		/*require_once($_SERVER['DOCUMENT_ROOT'].
              '/classes/clsCCauthorize.php');
       */
       //$aim=new AuthNetAim();
       //$aim->x_url="https://api.authorize.net/xml/v1/requestweb.api";
   //    $aim->url="https://test.authorize.net/gateway/transact.dll";
      //$aim->x_url="https://certification.authorize.net/gateway/transact.dll";
       //$aim->x_url="http://developer.authorize.net/testaccount";
	/*   
	   $myorder["cardnumber"]    = $_POST["cardnumber"];
		$myorder["cardexpmonth"]  = $_POST["cardexpmonth"];
		$myorder["cardexpyear"]   = $_POST["cardexpyear"];
		$myorder["chargetotal"]   = $_POST["chargetotal"];
		$myorder["ordertype"]     = $_POST["ordertype"];
		$myorder["cvmvalue"]      = $_POST["cvmvalue"];
		$myorder["oid"]     = $_POST["oid"];
		*/
	   
	   $this->load->library('authnetaim');
	   
	   $url	=	$this->config->item("aim_url");
	   $login	=	$this->config->item("x_login");
	   $key	=	$this->config->item("x_trans_key");
	   
	  
	   if($this->session->userdata('id'))
	   {
			$profile = $this->input->get_post("profile_use");
			
			if($profile == "Yes")
			{
				$profileId = $this->input->get_post("pofile_to_use");
				$profileInfo = $this->profile->getProfileById($profileId);
				$data["profileInfo"] = $profileInfo;
			}
			else
			{
				//get all required user data when posted......
				//call the core function to process same as in case of guest.....
				$this->order->processAuthorize();
			}
	   } // end user login condition.
	   if($this->session->userdata('guest_email'))
	   {
			//get all required user data when posted......
			
		// must be in some core function
		// considering it a function in core library and using it on other places where needed
		// in library/core/order. call it processAuthorize();
		   $this->authnetaim->x_login= $login;// required
		   $this->authnetaim->x_tran_key= $key; // required
		   $this->authnetaim->x_version="3.1";
		   $this->authnetaim->x_type="AUTH_ONLY"; // required // x_type = AUTH_CAPTURE for authorize and captuer
		   $this->authnetaim->x_test_request="FALSE";
		   $this->authnetaim->x_card_num=trim($_POST['cardnumber']); // required
		   $this->authnetaim->x_exp_date=trim($_POST['cardexpmonth']).trim($_POST['cardexpyear']); // required
		   $this->authnetaim->x_method="CC";
		   $this->authnetaim->x_amount=$_POST["chargetotal"]; // required
		   $this->authnetaim->x_first_name=$_POST["cvmvalue"];
		   $this->authnetaim->x_last_name=$last_name;
		   $this->authnetaim->x_address=$_POST['address'];
		   $this->authnetaim->x_city=$_POST['city'];
		   $this->authnetaim->x_state=$_POST['state'];
		   $this->authnetaim->x_zip=$_POST['zip'];
		   $this->authnetaim->x_country=$_POST['country'];
		   $this->authnetaim->x_email=$_SESSION['email_address'];
		   $this->authnetaim->x_card_code=$_POST['ccv_no'];
		   $this->authnetaim->x_delim_char="|";
		   $this->authnetaim->x_delim_data="TRUE";
		   $this->authnetaim->x_url="FALSE";
		   $this->authnetaim->x_invoice_num=$invoice_number;
	  //     echo "dsfsd";
		   
		   $error=$this->authnetaim->process(); 
		   echo $error;
	  //////////// till here..........	   
	   } // end guest login condition
	   	   
	}
	
	function getProfile()
	{
		$id = $this->input->get_post('id');
		
		$userInfo = $this->user->getUserById($id);
	//	print_r($userInfo);
	}
	/*	@function creates the customer profile and returns the customer profile id
		does not return customer payment profile id
		@params function takes the user id as the input.	
	*/
	function createCustomerProfile($userId)
	{	
		$authProfile = array();
		$userInfo = $this->user->getUserById($userId);
		if($userInfo[0]["customer_profile_id"] == "")
		{
			$authProfile = $this->authorize_core->createCustomerProfileRequest($userInfo[0]);
			// print_r($authProfile); // customerProfileId , customerPaymentProfileId , validation(YES/NO) , text(successful if yes)
			$userInfo[0]["customer_profile_id"]	= $authProfile["customerProfileId"];
			$this->user->updateUser($userInfo[0]);
		}
		
	}
	/* @function creates the customer payment profiles if the customer profile is already been made
		and returns the customer payment profile id been made successfully.
		@params function takes the userid as the input.
	*/
	function createCustomerPaymentProfile($userId)
	{	
		$authProfile = array();
		$userInfo = $this->user->getUserById($userId);
		if($userInfo[0]["customer_profile_id"] != "")
		{	
			$authProfile = $this->authorize_core->createCustomerPaymentProfileRequest($userInfo[0]);
			// print_r($authProfile); // validation (YES/NO) , text (Successful if yes)
		}	
	}
	/*	@function deletes the customer payment profile
		@params takes the customer profile id and customer payment profile id as the params.
	*/
	function deleteCustomerPaymentProfile($customerProfileId , $customerprofilepaymentId)
	{	
		$userInfo["customer_profile_id"] = $customerProfileId;
		$userInfo["customer_payment_profile_id"] = $customerprofilepaymentId;
		$this->authorize_core->deleteCustomerPaymentProfileRequest($userInfo);
	//	print_r($authProfile);getCustomerProfileRequest
		
	}
	/* @function returns the data of customer payment profiles.
		@params takes the id of the user as a parameter.
	*/
	function getCustomerProfile($id) 
	{	
		$authProfile = array();
		$userInfo = $this->user->getUserById($id);
		$authProfile = $this->authorize_core->getCustomerProfileRequest($userInfo[0]["customer_profile_id"]);
		// print_r($authProfile); // cardNumber , expirationDate , customerPaymentProfileId
	}
	/* @function returns the data of customer payment profile.
		@params takes the customer profile id and customer payment profile id of the user as a parameter.
	*/	
	function getCustomerPaymentProfile($profileId , $paymentId)
	{	
		$authProfile = array();
	//	$userInfo = $this->user->getUserById($id);
		$userInfo["customer_profile_id"] = $profileId;
		$userInfo["customer_payment_profile_id"] = $paymentId;
		$authProfile = $this->authorize_core->getCustomerPaymentProfileRequest($userInfo);
		// print_r($authProfile);
		
	}	
	function validateCustomerPaymentProfile()
	{	
		$authProfile = array();
	//	$userInfo = $this->user->getUserById($id);
		$userInfo["customer_profile_id"] = 15525725;
		$userInfo["customer_payment_profile_id"] = 13750081;
		$authProfile = $this->authorize_core->validateCustomerPaymentProfileRequest($userInfo);
	//	print_r($authProfile);getCustomerProfileRequest
		
	}	
	function deleteCustomerProfile()
	{	
		$userInfo["customer_profile_id"] = 15525611;
		$this->authorize_core->deleteCustomerProfileRequest($userInfo);
	//	print_r($authProfile);getCustomerProfileRequest
		
	}	
/**
.........................................................................................................
									End Restaurant Orders Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
