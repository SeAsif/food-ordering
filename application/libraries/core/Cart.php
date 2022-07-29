<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Cart {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor			
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('cart_model');	
			$this->_obj->load->model('terminal_model');	
			$this->_obj->load->model('airport_model');	
			$this->_obj->load->model('variant_item_model');	
		}
		
		/**
		* @method This method will return menu items for restaurant
		* @params restaurant id will be passed as parameter
		*/
		function listCartItems()
		{
		
			$list_cart_item=$this->_obj->cart_model->getCartDetails();
			$nCount=0;
			foreach ($list_cart_item as $row)
			{
				
				$list_cart_item[$nCount]["orderItem"]	=	$row["item_id"];
				
				/**
				* Now its time to get the variat items 
				*/
					
					$list_cart_item[$nCount]["GroupDetail"]["variant"]	=	$this->_obj->cart_model->getCartVariantDetails($row["item_id"]);
					$nCount++;
			
			}		
			return $list_cart_details;
		}

		/**
		* @method This method will return menu items against category
		* @params category id will be passed as parameter
		*/
		function addToCart($arrInfo,$arrInfoDetail)
		{
			//$arrInfo["session_id"]=$this->_obj->session->userdata("session_id");
			$variantPrice	=	0;
			$list	=	array();
			if ($arrInfoDetail!=NULL)
			{
				$filters["listing"]	=	$arrInfoDetail;
	
				$list	=	$this->_obj->variant_item_model->getVariant($filters);
				foreach($list as $variant)
				{
					$variantPrice	=	$variantPrice+$variant["price"];
				}
			}//end 
			

			$arrInsert["item_id"]	=	$arrInfo["id"];
			$arrInsert["restaurant_id"]	=	$arrInfo["restaurant_id"];
			$arrInsert["price"]	=	$arrInfo["item_price"];
			$arrInsert["totalprice"]	=	$arrInfo["quantity"]*($variantPrice+$arrInfo["item_price"]);
			$arrInsert["quantity"]	=	$arrInfo["quantity"];
			$arrInsert["session_id"]	=	$arrInfo["session_id"];
			$arrInsert["instructions"]	=	$arrInfo["instructions"];
			
			$cartItemID=$this->_obj->cart_model->addToCartitem($arrInsert);
			
			if (count($list) > 0)
			{
				foreach($list as $variant)
				{
					$variantDetail['variant_id']=$variant["id"];
					$variantDetail['session_id']=$arrInfo["session_id"];
					$variantDetail['order_item_id']=$cartItemID;
					$variantDetail['price']=$variant["price"];
					$listDetail=$this->_obj->cart_model->addToCartitemDetail($variantDetail);
					
				}
			}//end if (count($list) > 0)
			
			return $cartItemID;
		}
		
		/**
		* @method This method will return menu item details
		* @params item id will be passed as parameter
		*/
		function deleteFromCart($cartItemId)
		{
			$this->_obj->cart_model->deleteFromCartItem($cartItemId);
			$this->_obj->cart_model->deleteFromCartItemDetail($cartItemId);
			return "RECORD_DELETED";
		}
		
		function resetShoppingCart()
		{
			$this->_obj->cart_model->resetShoppingCart();
			return "RECORD_DELETED";
		}
		
		function calculateTax($id)
		{
			$list_cart_updated_items	=	array();
			$list_cart_item=$this->_obj->cart_model->getCartDetailsForTax($id);
	//		print_r($list_cart_item);
	//		exit();
			$restaurantId = $list_cart_item[0]["restaurant_id"];
		//	echo $restaurantId;
			
			$list_restaurant = $this->_obj->restaurant_model->getRestaurantById($restaurantId);
			//$terminalId = $list_restaurant["terminal_id"];
	//		print_r($list_restaurant);
	//		echo $terminalId;
			//$list_terminal = $this->_obj->terminal_model->getTerminalById($terminalId);
	//		print_r($list_terminal);
			//$airportId = $list_terminal[0]["airport_id"];
			
			//$list_airport = $this->_obj->airport_model->getAirportById($airportId);
	//		print_r($list_airport);
		//	exit();
			$subTotal = 0;
			$totalCityTax = 0;
			$totalStateTax =0;
			$totalTax =0;
			$total =0;
			
			// $airportCityTax = $list_airport[0]["airport_citytax"];
			// $airportStateTax = $list_airport[0]["airport_statetax"];
			
			$restaurantStateTax = $list_restaurant["restaurant_statetax"];
			$restaurantCityTax = $list_restaurant["restaurant_citytax"];
			
		//	foreach($list_cart_item as $row)
		//	{//	echo "czx";
			//	print_r($row);
			$itemPrice = $list_cart_item[0]["price"];
			$itemTotal = $itemPrice * $list_cart_item[0]["quantity"];
			
			$subTotal = $subTotal + $itemTotal;
			
			$item = $this->_obj->menuitem_model->getMenuItemById($list_cart_item[0]["item_id"]);
			$itemCityTax = $item["item_citytax"];
			
			if($itemCityTax != 0)
				$cityTax = $itemCityTax;
			else if($restaurantCityTax != 0)
				$cityTax = $restaurantCityTax;
			// else if($airportCityTax != 0)
			// 	$cityTax = $airportCityTax;		
			else
				$cityTax = 0;
			
			$itemStateTax = $item["item_statetax"];
			
			if($itemStateTax != 0)
				$stateTax = $itemStateTax;
			else if($restaurantStateTax != 0)
				$stateTax = $restaurantStateTax;
			// else if($airportStateTax != 0)
			// 	$stateTax = $airportStateTax;		
			else
				$stateTax = 0;
			
			
			if($cityTax == 0)
				$totalCityTax = 0;
			else
				$totalCityTax = $totalCityTax + ($itemTotal*($cityTax/100));
				
			if($stateTax == 0)
				$totalStateTax = 0;
			else	
				$totalStateTax = $totalStateTax + ($itemTotal*($stateTax/100));
			
			
					
		//	}//end foreach
			
			$totalTax = $totalCityTax + $totalStateTax;
			$total = $subTotal + $totalTax;
			$totalCityTax = round($totalCityTax, 2);
			$totalStateTax = round($totalStateTax, 2);
			$list_cart_item[0]["city_tax"] = $totalCityTax;
			$list_cart_item[0]["state_tax"] = $totalStateTax;
			$list_cart_item[0]["totalpricewithtax"] = $list_cart_item[0]["totalprice"] + $totalCityTax + $totalStateTax;
			
		//	print_r($list_cart_item[0]);
			
			$this->_obj->cart_model->updateCartItemForTax($list_cart_item[0]);
	//		exit();
			$list_cart_item[0]["taxapplied"]	=	$stateTax+$cityTax;
			$list_cart_updated_items[]	=	$list_cart_item;
				
			$arrReturn["totalTax"]		=	$totalTax;
			$arrReturn["total"]		=	$total;
			$arrReturn["list_cart_updated_items"]		=	$list_cart_updated_items;
			
		//	print_r($arrReturn);
		//	exit();
			return $arrReturn;
			
		}
		
		function getTaxes($sessionid)
		{	//echo $sessionid;
		//	exit();
			$arrReturn=$this->_obj->cart_model->getTaxes($sessionid);
		//	print_r($arrReturn);
		//	exit();
			return $arrReturn;
		}

		function getCartOrderPrice ($cartId) {
			$secretKey = $this->_obj->cart_model->getCartOrderPrice($cartId);			
			return $secretKey;
		}
	}
?>
