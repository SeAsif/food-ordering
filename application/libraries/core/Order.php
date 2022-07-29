<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Order {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('order_model');	
			$this->_obj->load->model('cart_model');	
			$this->_obj->load->library('core/restaurant');	
			$this->_obj->load->library('core/terminals');	
			$this->_obj->load->library('core/airport_core');	
			$this->_obj->load->library('core/user');	
			
		}
		
		/**
		* @method This method will add resturants reviews
		* @params array of review
		*/
		function addOrder($arrInfo,$itemsWithVariants,$sessionId)
		{
		//	$arrInfo["order_code"]=	rand();
			$arrInfo["order_status"]=	"Unpaid";
//			$arrInfo["totalprice"]=	0;
			$orderID=$this->_obj->order_model->addNewOrder($arrInfo);
			$order_code = str_pad($orderID, 10, "0", STR_PAD_LEFT);  
			$this->_obj->order_model->updateOrderRelatedData($orderID,$sessionId,$order_code);
			
			$arrInfo1["order_id"]	=	(string)$orderID;
			$arrInfo1["order_code"]	=	(string)$order_code;
			return $arrInfo1;
			
		}

		function getDeliveryCharges ($restaurant_id) {
			$deliveryCharges = $this->_obj->order_model->getDeliveryCharges($restaurant_id);
			return $deliveryCharges;
		}

		function updateOrder($arrInfo)
		{
			$this->_obj->order_model->updateOrder($arrInfo);
			if (isset($arrInfo["order_status"]))
			{
			//
			}
		}
		
		function getOrders($orderFilter,$limit = NULL, $offset = NULL)
		{	
			$list=$this->_obj->order_model->getOrders($orderFilter,$limit,$offset);
			return $list;
			
		}
		
		function getOrderById($Id,$all="Yes")
		{
			return $this->_obj->order_model->getOrderById($Id,$all);
		}

		function getRestaurantPaystackSecretKey($restaurant_id)
		{
			return $this->_obj->order_model->getRestaurantPaystackSecretKey($restaurant_id);
		}
		
		function getOrdersByUser($orderFilter,$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->order_model->getOrdersByUser($orderFilter,$limit,$offset);
			return $list;
		}

		function getRestaurantFlutterwaveSecretKey($restaurant_id)
		{
			$secret_key = $this->_obj->order_model->getRestaurantFlutterwaveSecretKey($restaurant_id);
			return $secret_key;
		}
		
		function reOrder($orderId, $sessionId)
		{
  	
			$data=	$this->_obj->order_item_model->getOrderItemWithVariants(array("order_id"=>$orderId),"Yes");
			
			//loop for each item	
			$flag=1;
			foreach($data as $Item)
			{
							$itemDetail=$this->_obj->menuitem_model->getMenuItemById($Item['item_id']);
				$arrInfo["id"] = $itemDetail['id'];
		$arrSearchCriteria	=	$this->_obj->session->userdata('search_criteria');
		$arrInfo["delivery_time"]	=	$arrSearchCriteria['pickup_time_hour'].":".$arrSearchCriteria['pickup_time_minute']." ".$arrSearchCriteria['pickup_time_type'];
				$response=$this->_obj->menuitem_model->menuItemTimingAuthentication($arrInfo["id"],$arrInfo["delivery_time"]);
				if($response["response"]!="Available")
				{
					$flag=0;
				}

			}
			if($flag==1)
			{			
				foreach($data as $Item)
				{
					//echo $Item['item_id'];
					$itemDetail=$this->_obj->menuitem_model->getMenuItemById($Item['item_id']);
					$arrInfo["id"] = $itemDetail['id'];
						
					$arrInfo["restaurant_id"]=$itemDetail['restaurant_id'];
					$arrInfo["item_price"]=$itemDetail['item_price'];
					$arrInfo["quantity"]= $Item['quantity'];
					$arrInfo["session_id"]= $sessionId;
					$arrInfo["instructions"]=$Item["instructions"];
					//print_r($Item["variant_list"]);
					foreach($Item["variant_list"] as $variants)
					{
						$variantInfo[]= $variants["variant_id"];
					}
					//print_r($variantInfo);
					
					$this->_obj->cart->addToCart($arrInfo, $variantInfo);
					
					//exit();
				}
			}	
			if($flag==1)
				$list="SUCCESS";
			else
				$list="ERROR";
			return $list;
		}
		
		function validateOrder($arrInfo,$itemsWithVariants,$sessionId)
		{	
			// $restaurantInfo = $this->_obj->restaurant->listRestaurantById($arrInfo["restaurant_id"]);//print_r($restaurantInfo);exit();
			// $deliveryTime=date("h:i:s a",strtotime($arrInfo['delivery_time']));//echo "<br />";
			// $date=date("m/j/Y",strtotime($arrInfo['delivery_time']));//echo "<br />";
			// $time_check = strtotime($deliveryTime);//echo "<br />";
			// $current_time = strtotime(date("Y-m-d H:i:s"));//echo "<br />";
			// $orderTime_check = date("h:i:s a", strtotime('-'.$restaurantInfo["delivery_time_before"].' minutes', $time_check));//echo "<br />";
			// $orderTime_check1 = strtotime(date($date)." ".$orderTime_check);//exit();
			
			//if($current_time < $orderTime_check1)
			//{
				$totalPrice = 0;
				if($sessionId == $itemsWithVariants[0]["session_id"])
				{
					$arrReturn = $this->_obj->orderitem->getOrderItemWithVariants(array("session_id"=>$sessionId));
					foreach($arrReturn as $list)
					{
						$totalPrice = $totalPrice + $list["totalpricewithtax"];
					}
					
					if ($arrInfo['order_type'] == "Delivery" && isset($arrInfo['delivery_charge'])) {
						$totalPrice = $totalPrice + 	$arrInfo['delivery_charge'];
					}

					$t1 = (string) $totalPrice;
					$t2 = (string) $arrInfo["totalprice"];
					if($t1 == $t2 && $arrInfo["totalprice"] != 0)
						return "VERIFIED";
					
					else
						return "Price_Problem";	
				}
				else
					return "Session_Problem";
			// }
			// else
			// 	return "Time_Expired";
		}
		function updateOrderEmail($order)
		{//	print_r($order);reject_reason
			$data["status"] = $order["order_status"];
			$restaurantInfo = $this->_obj->restaurant->listRestaurantById($order["restaurant_id"]);
			// $terminalInfo = $this->_obj->terminals->getTerminalById($restaurantInfo["terminal_id"]);
			// $airportInfo = $this->_obj->airport_core->listAirportById($terminalInfo[0]["airport_id"]);
			//print_r($airportInfo);exit();
			if($order["user_id"] == 0)
				$data["firstName"] = "Guest";
			else
			{
				$userInfo = $this->_obj->user->getUserById($order["user_id"]);
				$data["firstName"] = $userInfo[0]["firstname"];
			}	
			
			$this->_obj->load->library('email');
			$data["reason"] = $order["reject_reason"];
			$data["orderNumber"] = $order["order_code"];
			$data["restaurantName"] = $restaurantInfo["restaurant_name"];//echo "<br />";
			// $data["airportName"] = $airportInfo[0]["airport_name"];//echo "<br />";
			$deliveryTime=date("h:i:s a",strtotime($order['delivery_time']));//echo "<br />";
			$date=date("F d, Y",strtotime($order['delivery_time']));//echo "<br />";
			$data["deliveryTime"] = $deliveryTime;
			$data["date"] = $date;
			$email_to = $order["order_email"];//echo "<br />";
			$adminemail	=	$this->_obj->config->item("adminEmail");//echo "<br />";
			$confirm	=	$this->_obj->config->item("orderSubject");//echo "<br />";
			$reject	=	$this->_obj->config->item("orderReject");//echo "<br />";
			$config['wordwrap'] = TRUE;
			$config['smtp_host'] = 'localhost';
			$this->_obj->email->initialize($config);
			$this->_obj->email->from($adminemail, $this->_obj->config->item("adminName"));
			$this->_obj->email->to($email_to);//echo "zdfz";
		//	echo $this->_obj->load->view('email/confirm_email',$data,true);echo "<br />";
		//	echo $this->_obj->load->view('email/reject_email',$data,true);
			
			if($data["status"] == "Confirmed")
			{
				$this->_obj->email->subject($confirm);
				$this->_obj->email->message($this->_obj->load->view('email/confirm_email',$data,true));
				$this->_obj->email->send();
			}
			else if ($data["status"] == "Rejected")
			{
				$this->_obj->email->subject($reject);
				$this->_obj->email->message($this->_obj->load->view('email/reject_email',$data,true));
				$this->_obj->email->send();
			}
			
		//	exit();
		}

		function checkCouponCodeValid ($coupon_code, $restaurant_id) {
			$result = $this->_obj->order_model->checkCouponCodeValid($coupon_code, $restaurant_id);			
			return $result;
		}

		function checkUserAvailCoupon ($email, $coupon_code, $restaurant_id) {
			$result = $this->_obj->order_model->checkUserAvailCoupon($email, $coupon_code, $restaurant_id);			
			return $result;
		}

		function saveCouponhistory ($data_to_insert) {
			$this->_obj->order_model->saveCouponhistory($data_to_insert);
		}
	}
?>
