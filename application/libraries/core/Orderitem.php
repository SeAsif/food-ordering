<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class OrderItem {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('order_item_model');	
			$this->_obj->load->model('cart_model');	
		//	$this->_obj->load->library('core/cart');	
		}
		
		/**
		* @method This method will add resturants reviews
		* @params array of review
		*/
		function addOrder($arrInfo)
		{
/*			$list=$this->_obj->item_favorites_model->addItemFavorites($arrInfo);
			$arrInfoItem['order_id']=$list;
			$arrInfoItem['session_id']=$this->session->userdata("session_id");
			$updateList=$this->_obj->cart_model->updateCartItem($arrInfoItem);
			$updateListDetail=$this->_obj->cart_model->updateCartItemDetail($arrInfoItem);
			if($list!="" && $list!=0)
			{
				$list_return["response"]="RECORD_ADDED";
				$list_return["insert_id"]=$list;
				
			}
			else
			{
				$list_return["response"]="RECORD_NOT_ADDED";
				$list_return["insert_id"]=0;
			}	
			return $list_return;
*/			
		}
		
		function getOrderItems($orderFilter)
		{
			$list=$this->_obj->order_item_model->getOrderItems($orderFilter);
			return $list;
			
		}

		function getOrderItemWithVariants($orderFilter,$withVariants="Yes")
		{
			$list=$this->_obj->order_item_model->getOrderItemWithVariants($orderFilter,$withVariants);
			return $list;
			
		}
		
		function getOrderItemById($Id)
		{
			return $this->_obj->order_item_model->getOrderItemById($Id);
		}
		
		function updateOrderItem($arrInfo)
		{
			return $this->_obj->order_item_model->updateOrderItem($arrInfo);
		}
		function getOrderItemByOrderId($Id)
		{
			return $this->_obj->order_item_model->getOrderItemByOrderId($Id);
		}
		function increaseQuantity($arrInfo, $cart_session, $Id)
		{
			$city_tax = $arrInfo["city_tax"] / $arrInfo["quantity"];
			$state_tax = $arrInfo["state_tax"] / $arrInfo["quantity"];
			//
			// $previousCityTax = $city_tax * $arrInfo["quantity"];
			// $previousStateTax = $state_tax * $arrInfo["quantity"];
			// $previousTPrice = $arrInfo["price"] * $arrInfo["quantity"];
			//
			$arrInfo["quantity"] = $arrInfo["quantity"] + 1;
			$arrInfo["totalprice"] = $arrInfo["quantity"] * $arrInfo["price"]; 
			$arrInfo["city_tax"] = $arrInfo["city_tax"] + $city_tax;
			$arrInfo["state_tax"] = $arrInfo["state_tax"] + $state_tax;
			$arrInfo["totalpricewithtax"] = $arrInfo["city_tax"] + $arrInfo["state_tax"] + $arrInfo["totalprice"]; 
			$this->_obj->order_item_model->updateOrderItem($arrInfo);
			//
			// $arrInfo["oCityTax"] = number_format($city_tax, 2, '.', '');
			// $arrInfo["oStateTax"] = number_format($state_tax, 2, '.', '');
			// $arrInfo["city_tax"] = number_format($arrInfo["city_tax"], 2, '.', '');
			// $arrInfo["state_tax"] = number_format($arrInfo["state_tax"], 2, '.', '');
			// $arrInfo["totalpricewithtax"] = number_format($arrInfo["totalpricewithtax"], 2, '.', '');
			// $arrInfo["previousCityTax"] = number_format($previousCityTax, 2, '.', '');
			// $arrInfo["previousStateTax"] = number_format($previousStateTax, 2, '.', '');
			// $arrInfo["previousTPrice"] = number_format($previousTPrice, 2, '.', '');
			//
			$cartItems	=	$this->getOrderItemWithVariants(array("session_id"=>$cart_session));

			$return_data = array();
			$total_city_tax = 0;
			$total_state_tax = 0;
			$total_price = 0;

			foreach ($cartItems as $cartItem) {

				if ($cartItem['id'] ==  $Id) {
					$return_data['item_total'] = number_format($cartItem['totalprice'], 2, '.', '');
					$return_data['new_quantity'] = $cartItem['quantity'];
				}

				$total_city_tax = $total_city_tax +  $cartItem['city_tax'];
				$total_state_tax = $total_state_tax +  $cartItem['state_tax'];
				$total_price = $total_price +  $cartItem['totalpricewithtax'];
			}

			$return_data['total_city_tax'] = number_format($total_city_tax, 2, '.', '');
			$return_data['total_state_tax'] = number_format($total_state_tax, 2, '.', '');
			$return_data['total_price'] = number_format($total_price, 2, '.', '');
			//
			return $return_data;
		
		}
		function decreaseQuantity($arrInfo, $cart_session, $Id)
		{
			$city_tax = $arrInfo["city_tax"] / $arrInfo["quantity"];
			$state_tax = $arrInfo["state_tax"] / $arrInfo["quantity"];
			//
			// $previousCityTax = $city_tax * $arrInfo["quantity"];
			// $previousStateTax = $state_tax * $arrInfo["quantity"];
			// $previousTPrice = $arrInfo["price"] * $arrInfo["quantity"];
			//
			$arrInfo["quantity"] = $arrInfo["quantity"] - 1;
			$arrInfo["totalprice"] = $arrInfo["quantity"] * $arrInfo["price"]; 
			$arrInfo["city_tax"] = $arrInfo["city_tax"] - $city_tax;
			$arrInfo["state_tax"] = $arrInfo["state_tax"] - $state_tax;
			$arrInfo["totalpricewithtax"] = $arrInfo["city_tax"] + $arrInfo["state_tax"] + $arrInfo["totalprice"]; 
			$this->_obj->order_item_model->updateOrderItem($arrInfo);
			//
			// $arrInfo["oCityTax"] = number_format($city_tax, 2, '.', '');
			// $arrInfo["oStateTax"] = number_format($state_tax, 2, '.', '');
			// $arrInfo["city_tax"] = number_format($arrInfo["city_tax"], 2, '.', '');
			// $arrInfo["state_tax"] = number_format($arrInfo["state_tax"], 2, '.', '');
			// $arrInfo["totalpricewithtax"] = number_format($arrInfo["totalpricewithtax"], 2, '.', '');
			// $arrInfo["previousCityTax"] = number_format($previousCityTax, 2, '.', '');
			// $arrInfo["previousStateTax"] = number_format($previousStateTax, 2, '.', '');
			// $arrInfo["previousTPrice"] = number_format($previousTPrice, 2, '.', '');
			//
			$cartItems	=	$this->getOrderItemWithVariants(array("session_id"=>$cart_session));

			$return_data = array();
			$total_city_tax = 0;
			$total_state_tax = 0;
			$total_price = 0;

			foreach ($cartItems as $cartItem) {

				if ($cartItem['id'] ==  $Id) {
					$return_data['item_total'] = number_format($cartItem['totalprice'], 2, '.', '');
					$return_data['new_quantity'] = $cartItem['quantity'];
				}

				$total_city_tax = $total_city_tax +  $cartItem['city_tax'];
				$total_state_tax = $total_state_tax +  $cartItem['state_tax'];
				$total_price = $total_price +  $cartItem['totalpricewithtax'];
			}

			$return_data['total_city_tax'] = number_format($total_city_tax, 2, '.', '');
			$return_data['total_state_tax'] = number_format($total_state_tax, 2, '.', '');
			$return_data['total_price'] = number_format($total_price, 2, '.', '');
			//
			return $return_data;
		}

		function getRestaurantName ($restaurantId) {
			$restaurantName = $this->_obj->order_item_model->getRestaurantName($restaurantId);			
			return $restaurantName;
		}
	}
?>
