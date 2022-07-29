<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Irestaurant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');	
		$this->load->library('core/restaurant');	
		$this->load->library('core/menuitem');	
		$this->load->library('core/menucategory');	
		$this->load->library('core/menuitemgroup');	
		$this->load->library('core/restaurant_review');	
		$this->load->library('core/restaurant_rating');	
		$this->load->library('core/order');	
		$this->load->library('core/orderitem');			
		$this->load->library('core/user');	
		$this->load->library('core/payment_prefrences');	
		$this->load->library('core/restaurant_favorites');	
		$this->load->library('core/item_favorites');	
		$this->load->library('core/cart');	
		$this->load->library('core/airport_core');			
		$this->load->library('core/terminals');
		$this->load->library('core/comission');
		$this->load->library('order_model');

//		$this->load->library('MarketplaceWebService/Samples/SubmitFeedSample');

		$this->load->library('c_date');	
	}
	
	function index()
	{
				
	}

	function addNewRestaurant()
	{
		$arrInfo["brand_name"]=$this->input->get_post("brand_name");
		$arrInfo["brand_detail"]=$this->input->get_post("brand_detail");
		if($this->input->get_post("status")!="")
			$arrInfo["status"]=$this->input->get_post("status");
		$insertId=$this->Restaurant_Model->addNewRestaurant($arrInfo);
		
		echo $insertId;
	}

	/*
	* @method This method will return the restaurants against terminals
	* @params It will take terminal Id as parameter 	
	*/
	function listRestaurant($terminalId)
	{
		$pickup_time=$this->input->get_post('pickup_time');
	
		$list	=	$this->restaurant->listRestaurant($terminalId,"Active",$pickup_time);
		if ($list	!=	null)
		{
			echo json_encode($list);
		}
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit ();
	}

	/*
	* @method This method will return the restaurants details
	* @params It will take restaurant Id as parameter 	
	*/
	function getRestaurantById($restaurantId)
	{
		$list=$this->restaurant->listRestaurantById($restaurantId);
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		
		exit ();
	}
	/*
	* @method This method will return the menu items for a restaurant
	* @params It will take restaurant Id as parameter 	
	*/
	function listMenuItem($restaurantId=0)
	{
		$pickup_time=$this->input->get_post('pickup_time');
		$filters	=	array("pickup_time"=> $pickup_time);		
		$list=$this->menuitem->listMenuItemByRestaurantId($restaurantId, $filters);
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit ();
		
	}

	/*
	* @method This method will return the menu items by category
	* @params It will take category Id as parameter 	
	*/
	function listMenuItemByCategory($catId=0)//arslan is not using it
	{
		$list=$this->menuitem->listMenuItemByCategoryId($catId);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
		
	}

	/*
	* @method This method will return the menu categories for a restaurant
	* @params It will take restaurant Id as parameter 	
	*/
	function listMenuCategory($restaurantId=0)//arslan is not using it
	{
		$list=$this->menucategory->listMenuCategoryByRestaurantId($restaurantId);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
		
	}

	/*
	 * @method This method will return the Item details plus groups and vaariants for an Item
	 * @params It will take item Id as parameter 	
	*/
	function menuItemDetail($itemId=0)
	{
		$list=$list=$this->menuitem->listMenuItemById($itemId);
		if ($list	!=	null)
		{
			echo json_encode($list);
/*			$listGoupVariants=$this->menuitemgroup->listMenuItemDetails($itemId);
			echo json_encode($listGoupVariants);
*/		
		}
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit ();
	}

	/*
	 * @method This method will return the Item details plus groups and vaariants for an Item
	 * @params It will take item Id as parameter 	
	*/
	function menuItemVariant($itemId=0)//arslan is not using it
	{
		$list=$this->menuitemgroup->listMenuItemDetails($itemId);
		if ($list	!=	null)
		{
			echo json_encode($list);
		}
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit ();
	}

	/*
	* @method This method will return the reviews of a restaurnat
	* @params It will take restaurant Id as parameter 	
	*/
	function listYelpRestaurantReviews($restaurantId=0)
	{
		// $list=$this->restaurant_review->listYelpRestaurantReviews($restaurantId);
		// if ($list	!=	null)
		// 	echo json_encode($list);
		// else
		// {
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		//}
		exit ();
		
	}

	/*
	* @method This method will return the reviews of a restaurnat
	* @params It will take restaurant Id as parameter 	
	*/
	function listRestaurantReviews($restaurantId=0)
	{
	
		$list=$this->restaurant_review->listRestaurantReviews($restaurantId);
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit ();
		
	}

	/*
	* @method This method will add the restaurant reviews
	* @params $_POST array will be passed to it with params 
	* review,user_id,restaurant_id 	
	*/
	function addRestaurantReviews()
	{
		$arrInfo['review']=$this->input->get_post('review');
		$arrInfo['user_id']=$this->input->get_post('user_id');
		$arrInfo['restaurant_id']=$this->input->get_post('restaurant_id');
		$list=$this->restaurant_review->addRestaurantReviews($arrInfo);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_ADDED";
		exit ();
		
	}
	
	/*
	* @method This method will add the ratings for the restaurant
	* @params $_POST array will be passed to it with params 
	* num,user_id,restaurant_id 	
	*/
	function addRestaurantRating()
	{
		$arrInfo['num']=$this->input->get_post('num');
		$arrInfo['user_id']=$this->input->get_post('user_id');
		$arrInfo['restaurant_id']=$this->input->get_post('restaurant_id');
		$list=$this->restaurant_rating->addRestaurantRating($arrInfo);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_ADDED";
		exit ();
	}

	/*
	* @method This method will return the rating of a restaurnat
	* @params It will take restaurant Id as parameter 	
	*/
	function listRestaurantRatings($restaurantId=0)
	{
		$list=$this->restaurant_rating->listRestaurantRatings($restaurantId);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
		
	}

	/*
	* @method This method will signup the users
	* @params $_POST array will be passed to it 
	* email, password, firstname, lastname, address, country_id=1, status, type 
	*/
	function signup()
	{
		
		$arrInfo["email"]	=	trim($this->input->post("email"));
		$arrInfo["password"]	=	md5(trim($this->input->post("password")));
		$arrInfo["firstname"]	=	trim($this->input->post("firstname"));
		$arrInfo["lastname"]	=	trim($this->input->post("lastname"));
		$arrInfo["address"]	=	trim($this->input->post("address"));
		$arrInfo["country_id"]	=	trim($this->input->post("country_id"));
		$arrInfo["status"]	=	trim($this->input->post("status")); //Active, Inactive		
		$arrInfo["type"]	=	trim($this->input->post("type"));//'restaurantowner','user'		
		$arrInfo["phone_number"]	=	trim($this->input->post("phone_number"));//'restaurantowner','user'		
		
		$list=$this->user->addUser($arrInfo, trim($this->input->post("password")));

		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
		
	}
	/*
	* @method This method will update the users
	* @params $_POST array will be passed to it please see users table 	
	*/
	function updateUserDetails()
	{
		$arrInfo["id"]	=	trim($this->input->get_post("id"));
		if($this->input->get_post("email"))
		{
			$arrInfo["email"]	=	trim($this->input->get_post("email"));
		}
		if($this->input->get_post("password"))
		{
			$arrInfo["password"]	=	md5(trim($this->input->get_post("password")));
		}
		if($this->input->get_post("firstname"))
		{
			$arrInfo["firstname"]	=	trim($this->input->get_post("firstname"));
		}
		if($this->input->get_post("lastname"))
		{
			$arrInfo["lastname"]	=	trim($this->input->get_post("lastname"));
		}
		if($this->input->get_post("address"))
		{
			$arrInfo["address"]	=	trim($this->input->get_post("address"));
		}	

		if($this->input->get_post("phone_number"))
		{
			$arrInfo["phone_number"]	=	trim($this->input->get_post("phone_number"));
		}

		/*if($this->input->post("status"))
		{
			$arrInfo["status"]	=	trim($this->input->post("status")); //Active, Inactive		
		}*/
		/*if($this->input->post("status"))
		{
			$arrInfo["type"]	=	trim($this->input->post("type"));//'restaurantowner','user'		
		}*/
		/*if($this->input->post("phone_number"))
		{
			$arrInfo["phone_number"]	=	trim($this->input->post("phone_number"));
		}*/	
		
		$list=$this->user->updateUser($arrInfo);

		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=>"No_Record_Found");
			echo json_encode($list);
		}
		exit ();
	}

	/*
	* @method This method will login the users
	* @params username and password will be passed as parameter 	
	*/
	function login()
	{
		
		$arrInfo["email"]=strtolower(trim($this->input->get_post("email"))); 
		
		if($this->input->get_post("password") != "")
			$arrInfo["password"]=md5(trim($this->input->get_post("password")));
		else
			$arrInfo["password"]="";
			
		$arrInfo["usertype"]=trim($this->input->get_post("usertype"));
		
		if($arrInfo["email"] == "" && $arrInfo["password"] == "")
			$list["error"] = "Email Password Required";
			
		else if($arrInfo["email"] == "")
			$list["error"] = "Email Required";
				
		else if($arrInfo["password"] == "")
			$list["error"] = "Password Required";
		
		else
			$list=$this->user->login($arrInfo);
		if(isset($list["error"]) && $list["error"] == "Login_Error")
			$list["error"] = "Invalid Email or Password";
		echo json_encode($list);
	}
	/*
	* @method This method will login the users
	* @params username and password will be passed as parameter 	
	*/
	function login_guest()
	{
		
		
		$order_type = trim($this->input->get_post("order_type")); 
		$arrInfo["firstname"]=trim($this->input->get_post("firstname")); 
		$arrInfo["lastname"]=trim($this->input->get_post("lastname")); 
		$arrInfo["guest_email"]=strtolower(trim($this->input->get_post("guest_email"))); 
		$arrInfo["guest_email_conf"]=strtolower(trim($this->input->get_post("guest_email_conf")));
		$arrInfo["phone"]=trim($this->input->get_post("phone"));

		if ($order_type == 'Delivery') {
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone', 'Mobile Phone', 'required|trim');
		}
		
		$this->form_validation->set_rules('guest_email', 'Email Address', 'required|valid_email|trim|matches[guest_email_conf]');
		$this->form_validation->set_rules('guest_email_conf', 'Retype Email Address', 'required|trim');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$list["error"]= array_values($this->form_validation->error_array())[0];	
		}		
		else{
			$sessionData["firstname"]=$arrInfo["firstname"];
			$sessionData["lastname"]=$arrInfo["lastname"];
			$sessionData["guest_email"]=$arrInfo["guest_email_conf"];
			$sessionData["phone"]=$arrInfo["phone"];
			$this->session->set_userdata($sessionData);
			$list["error"]="";
		}	
		//$list=$this->user->login($arrInfo);
		echo json_encode($list);
	}

	/*
	* @method This method will reset the password
	* @params username and password will be passed as parameter 	
	*/
	function resetPassword()
	{
		$arrInfo["id"]=trim($this->input->get_post("userId"));
		$arrInfo["password"]=md5(trim($this->input->get_post("password")));
		$arrInfo["oldpassword"]=md5(trim($this->input->get_post("oldpassword")));
		
		$list["response"]=$this->user->resetPassword($arrInfo);
		echo json_encode($list);
	}

	/*
	* @method This method will logout the users
	* @params 
	*/
	function logout()
	{
		$list=$this->user->logout();
		$this->session->unset_userdata('guest_email');
		$this->session->unset_userdata('phone');
		echo json_encode($list);
		exit ();
	}
	
	
	/*
	* @method This method will return the details of the user
	* @params It will take user Id as parameter 	
	*/
	function getUserDetails($userId=0)
	{
		$list=$this->user->getUserById($userId);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit();
	}
	
	
	/*
	* @method This method will return the payment prefrences
	* @params It will take user Id as parameter 	
	*/
	function getUserPaymentPref($userId=0)
	{
		$list=$this->payment_prefrences->getUserPaymentPrefrences($userId);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit();
	}
	
	
	/*
	* @method This method will set the payment prefrences of the users
	* @params $_POST array will be passed to it please see users table 	
	*/
	function addUserPaymentPrefrences()
	{
		
		$arrInfo["user_id"]	=	trim($this->input->post("user_id"));
		$arrInfo["cardtype"]	=	trim($this->input->post("cardtype")); //'Solo','American Express','Visa'
		$arrInfo["name"]	=	trim($this->input->post("name"));
		$arrInfo["expirydate"]	=	trim($this->input->post("expirydate"));
		$arrInfo["state"]	=	trim($this->input->post("state"));
		$arrInfo["zip"]	=	trim($this->input->post("zip"));
		$arrInfo["street_address"]	=	trim($this->input->post("street_address")); //Active, Inactive		
		$arrInfo["isdefault"]	=	trim($this->input->post("isdefault"));//'Yes','No'		
		
		$list=$this->payment_prefrences->setUserPaymentPrefrences($arrInfo);

		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
	}
	
	
	/*
	* @method This method will add restaurant favortites
	* @params $_POST array will be passed to it please see favorite_restaurant table 	
	*/
	function addFavoriteRestaurant()
	{
		
		$arrInfo["user_id"]	=	trim($this->input->get_post("user_id"));
		if($arrInfo["user_id"]=="")
		{
		if ($this->session->userdata('id'))
			$arrInfo["user_id"]	=	$this->session->userdata('id');					
		}
		$arrInfo["restaurant_id"]	=	trim($this->input->get_post("restaurant_id"));
		$arrInfo["terminal_id"]	=	trim($this->input->get_post("terminal_id"));
		
		if ($arrInfo["user_id"]!=0)
			$list=$this->restaurant_favorites->addRestaurantFavorites($arrInfo);
		else
			$list	=	null;

		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=> "No_Record_Found");
			echo json_encode($list);
		}
		exit ();
	}
	
	/*
	* @method This method will delete the restaurant favorites
	* @params It will take favorite Id as parameter 	
	*/
	function delFavoriteRestaurants($favId)
	{
		
		$arrInfo["id"]	=	trim($favId);
		
		$list=$this->restaurant_favorites->delRestaurantFavorites($arrInfo);
		echo json_encode($list);
		exit();
	}
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getFavoriteRestaurants($userId=0)
	{
		$arrFilters["userId"]	=	$userId;
		$list=$this->restaurant_favorites->listRestaurantFavorites($arrFilters);
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=> "No_Record_Found");
			echo json_encode($list);
			
		}
		exit();
	}

	function getTimeVerification($pickuptime,$id,$type)
	{
		if($type=="restaurant")
		{	
			
			$list=$this->restaurant->restaurantTimeAuthentication($id,$pickuptime);
		}
		else
		{
			$list=$this->menuitem->menuItemTimingAuthentication($id,$pickuptime);
		}	
		
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=> "No_Record_Found");
			echo json_encode($list);
		}
		exit();
	}

	/*
	* @method This method will add restaurant favortites
	* @params $_POST array will be passed to it please see favorite_restaurant table 	
	*/
	function addFavoriteItem()
	{
		
		$arrInfo["user_id"]	=	trim($this->input->get_post("user_id"));
		$arrInfo["item_id"]	=	trim($this->input->get_post("item_id"));
		$arrInfo["restaurant_id"]	=	trim($this->input->get_post("restaurant_id"));
		$list=$this->item_favorites->addItemFavorites($arrInfo);

		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=> "No_Record_Found");
			echo json_encode($list);
		}
		exit ();
	}
	
	/*
	* @method This method will delete the restaurant favorites
	* @params It will take favorite Id as parameter 	
	*/
	function delFavoriteItem($favId)
	{
		
		$arrInfo["id"]	=	trim($favId);
		
		$list=$this->item_favorites->delItemFavorites($arrInfo);
		echo json_encode($list);
		exit();
	}

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getFavoriteItem($userId=0)
	{
		$list=$this->item_favorites->listItemFavorites($userId);
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list	=	array("response"=> "No_Record_Found");
			echo json_encode($list);
		}
		exit();
	}
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getFavoriteOrders($userId=0)
	{
		$orderFilter["user_id"]	=	$userId;
		$orderFilter["is_favorite"]	=	"Yes";

		$list=$this->order->getOrdersByUser($orderFilter);
		
		echo json_encode($list);
		exit();
	}
	
	/*
	* @method add items in cart
	* @params It will take item_id, restaurant_id, variants
	*/
	function addToCart()
	{
		$arrInfo	=	$this->menuitem->listMenuItemById($this->input->get_post("item_id"));
		$arrInfo["session_id"]=$this->input->get_post("session_id");
		$arrInfo["user_id"]=$this->input->get_post("user_id");
		$arrInfo["instructions"]=$this->input->get_post("instructions");
		$arrInfo["quantity"]=$this->input->get_post("quantity");
		$arrInfo["city_tax"]		=	trim($this->input->get_post("city_tax"));
		$arrInfo["state_tax"]		=	trim($this->input->get_post("state_tax"));
		
//		$arrInfo["instructions"]=$this->input->get_post("instructions");
		
		$arrInfoDetail	=	explode(",",trim($this->input->get_post("variants")));
		
		$cartid=$this->cart->addToCart($arrInfo,$arrInfoDetail);
		$list	=	array();
		
		if ($cartid	!=	null)
		{
			$list["response"]	=	(string)$cartid;
			echo json_encode($list);
		}
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit();
	}
	
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getShoppingCart($session_id)
	{

//		$list=$this->cart->listCartItems();
		if(!empty($session_id)){
			$list	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=> $session_id));

			if ($list	!=	null)
				echo json_encode($list);
			else
				echo "No_Record_Found";
		}else{
			echo "No_Record_Found";
		}
		
		exit();
	}
	
	function resetShoppingCart()
	{
		//$this->session->set_userdata("session_id",$session_id);			
//		$this->session->sess_destroy();
		$list=$this->cart->resetShoppingCart();
		$this->session->unset_userdata('restaurantID');
		echo json_encode($list);
		exit();

	}
	function reOrder($orderId)
	{
		//$order	=	$this->order->getOrderById($orderId);
		echo json_encode($this->order->reOrder($orderId, $this->session->userdata("session_id")));
		exit();
		//print_r ($order);
	}
	
	function addOrder()
	{
		//echo ($this->session->userdata("session_id"));
		//$arrInfo["session_id"]	=	$this->_obj->session->userdata("session_id");
		$arrInfo["restaurant_id"]	=	trim($this->input->get_post("restaurant_id"));
		$arrInfo["delivery_time"]	=	trim($this->input->get_post("delivery_time"));
		$arrInfo["is_favorite"]	=	trim($this->input->get_post("is_favorite"));
//		$arrInfo["order_email"]	=	trim($this->input->get_post("order_email"));
//		$arrInfo["order_name"]=		trim($this->input->get_post("order_name"));
//		$arrInfo["order_phone"]	=	trim($this->input->get_post("order_phone"));
		$arrInfo["totalprice"]	=	trim($this->input->get_post("order_cost"));
		$arrInfo["user_id"]		=	trim($this->input->get_post("user_id"));
		$arrInfo["city_tax"]		=	trim($this->input->get_post("city_tax"));
		$arrInfo["state_tax"]		=	trim($this->input->get_post("state_tax"));
		$arrInfo["stamp"] = date("Y-m-d H:i:s");
		if ($this->input->get_post("order_email"))
			$arrInfo["order_email"]	=	trim($this->input->get_post("order_email"));
		else
			$arrInfo["order_email"]	=	$this->session->userdata('guest_email');
			
		if ($this->input->get_post("order_name"))
			$arrInfo["order_name"]=		trim($this->input->get_post("order_name"));
		else 
			$arrInfo["order_name"]=		"Guest";

		if ($this->input->get_post("order_phone"))
			$arrInfo["order_phone"]	=	trim($this->input->get_post("order_phone"));
		else
			$arrInfo["order_phone"]	=	$this->session->userdata('phone');

/*		if( $this->session->userdata('id')!= "")
		{
			$arrInfo["order_email"]	=	trim($this->input->get_post("order_email"));
			$arrInfo["order_name"]=		trim($this->input->get_post("order_name"));
			$arrInfo["order_phone"]	=	trim($this->input->get_post("order_phone"));
		}	
		
		else
		{
			$arrInfo["order_email"]=$this->session->userdata('guest_email');
			$arrInfo["order_name"]="Guest";
			$arrInfo["order_phone"]=$this->session->userdata('phone');
		}
*/		
/*		if( $this->session->userdata('id')!= "")
		{
			$arrInfo["order_name"]=$this->session->userdata('firstname');
			$arrInfo["order_email"]=$this->session->userdata('email');
		}	
*/		
		$arrInfo["order_through"]	=	"IPHone";
		$arrInfo["order_type"]	=	"TakeAway";
		
		$sessionid	=	$this->input->get_post("session_id");
		
		// if ($this->session->userdata("session_id"))
		// {
		// 	$sessionid	=	$this->session->userdata("session_id");
		// }
		// else if ($this->session->userdata("tgb_session_id"))
		// {
		// 	$sessionid	=	$this->session->userdata("tgb_session_id");
		// }
		
			$itemsWithVariants	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$sessionid));


		///////////////Calculate number of minutes remianing in pickup time////////////////////
		$pickUpTime=$arrInfo["delivery_time"];
		$current_date=date("Y-m-d H:i:s");
		$diff=$this->c_date->diffDate ($current_date, $pickUpTime);
		$diff=ceil($diff*24*60);
		$commPercent=$this->comission->calculateComission($diff);
		if($commPercent==NULL)
			$commPercent=$this->config->item('DEFAULT_PERCENTAGE');
		//echo $commPercent."<br>";
		$comission=($arrInfo["totalprice"]*$commPercent)/100;
		$arrInfo["tgb_comission"]	=	$comission;
		//echo $comission."<br>";
		////////////////////////////////////////////////////////////////////////////////////////
		
		//echo $diff;
		//exit();
		
		$list	=	$this->order->addOrder($arrInfo,$itemsWithVariants,$sessionid);
		
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit();
	}
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function deleteFromCart($cartItemId)
	{
		$list=$this->cart->deleteFromCart($cartItemId);
		echo json_encode($list);
		exit();
	}

	/*
	* @method This method will create orders
	* @params It will take $_POST as parameter 	
	*/

	function checkoutCart()
	{
							
		$arrInfo["user_id"]	=	trim($this->input->get_post("user_id"));
		$arrInfo["item_id"]	=	trim($this->input->get_post("item_id"));
		$arrInfo["is_favorite"]	=	trim($this->input->get_post("is_favorite"));
		$arrInfo["delivery_time"]	=	trim($this->input->get_post("delivery_time"));
		$sessionid	=	$this->input->get_post("session_id");
		
		// if ($this->session->userdata("session_id"))
		// {
		// 	$sessionid	=	$this->session->userdata("session_id");
		// }
		// else if ($this->session->userdata("tgb_session_id"))
		// {
		// 	$sessionid	=	$this->session->userdata("tgb_session_id");
		// }
		
		$itemsWithVariants	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$sessionid));

		$list=$this->order->addOrder($arrInfo,$itemsWithVariants,$sessionid);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
	}

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getOrdersByRestaurant($restaurantID)
	{
		$orderFilter["restaurant_id"]	=	$restaurantID	;
		$orderFilter["order_status"]	=	"All";
		$orderFilter1 = [];
		$restaurantArr	=	$this->restaurant->listRestaurantById($restaurantID);				

		if ($this->input->get_post("minutes_after"))	
			$nTimeBefore	=	$this->input->get_post("minutes_after");
		else
			$nTimeBefore	=	$restaurantArr["delivery_time_before"];
		//last 24 hours
		if ($this->input->get_post("hours_before"))//last 24 hours
		{
			$nHours	=	$this->input->get_post("hours_before");
			
			$orderFilter["delivery_time"]	=	date("Y-m-d H:i:s");
			$orderFilter["current_time"]	=	date("Y-m-d H:i:s",time() - ($nHours*3600));
			
			$orderFilter1["ishistory"]	=	"Yes";
			$orderFilter1["restaurant_id"]	=	$restaurantID	;
			$orderFilter1["delivery_time"]	=	date("Y-m-d H:i:s",time() +  $nTimeBefore*60);
			$orderFilter1["current_time"]	=	date("Y-m-d H:i:s");
			$orderFilter1["order_status"]	=	"All";

			$orderFilter["extrafilters"]["current_time"]	=	date("Y-m-d H:i:s");
			$orderFilter["extrafilters"]["delivery_time"]	=	date("Y-m-d H:i:s",time() +  $nTimeBefore*60);
			$orderFilter["extrafilters"]["status1"]	=	"Confirmed";	
			$orderFilter["extrafilters"]["status2"]	=	"Rejected";	
			
			
		}
		else//dashboard page
		{
			if ($this->input->get_post("isdashboard"))	
				$orderFilter["isdashboard"]	=	"Yes";

			
			
			$orderFilter["delivery_time"]	=	date("Y-m-d H:i:s",time() +  $nTimeBefore*60);
			$orderFilter["current_time"]	=	date("Y-m-d H:i:s");
		}

		if ($this->input->get_post("sortby"))//apply sorting
		{
			$orderFilter["sortby"]	=	$this->input->get_post("sortby");
			$orderFilter["ordertype"]	=	"asc";

			$orderFilter1["sortby"]	=	$this->input->get_post("sortby");
			$orderFilter1["ordertype"]	=	"asc";
			
		}
		$list=$this->order->getOrders($orderFilter);
		if (is_array($orderFilter1))
			$list	=	array_merge($this->order->getOrders($orderFilter1),$list);
		
		echo json_encode($list);
		exit();
	}

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function updateOrderStatus($Id)
	{
		$orderArr	=	$this->order->getOrderById($Id,"No");
//		print_r ($orderArr);
		$orderArr1["id"]	=	$orderArr["id"];
		if ($this->input->get_post("order_status"))
			$orderArr1["order_status"]	=	trim($this->input->get_post("order_status"));

		if ($this->input->get_post("order_opened"))
			$orderArr1["order_opened"]	=	trim($this->input->get_post("order_opened"));
			
		if ($this->input->get_post("reject_reason"))
			$orderArr1["reject_reason"]	=	trim($this->input->get_post("reject_reason"));	

		$this->order->updateOrder($orderArr1);
		$orderArr2	=	$this->order->getOrderById($Id);
		$this->order->updateOrderEmail($orderArr2);
		
		echo $Id;			
		exit ();
	}
	/*
	* @method This method is for inceasing the orde quantity
	* @params It will take order ID as parameter
	*/
	function increaseOrderQuantity($Id)
	{
		$orderArr	=	$this->orderitem->getOrderItemById($Id);
		$cart_session = $this->session->userdata("tgb_session_id");
		$order_info = $this->orderitem->increaseQuantity($orderArr[0], $cart_session, $Id);
		//		print_r ($orderArr);
		//		$orderArr1["id"]	=	$orderArr["id"];
		//		$orderArr[0]["quantity"] = $orderArr[0]["quantity"]+1;
		//		$orderArr[0]["totalprice"] = $orderArr[0]["quantity"] * $orderArr[0]["price"];
		//		$this->orderitem->updateOrderItem($orderArr[0]);

		$order_info['message'] = "RECORD_ADDED";
		//		$this->order->updateOrder($orderArr1);
		header('Content-type: application/json');
		echo json_encode($order_info);	
		exit ();
	}
	/*
	* @method This method is for decreasing the orde quantity
	* @params It will take order ID as parameter
	*/
	function decreaseOrderQuantity($Id)
	{
		$orderArr	=	$this->orderitem->getOrderItemById($Id);
		
		//		print_r ($orderArr);
		//		$orderArr1["id"]	=	$orderArr["id"];
		//
		$list = "";
		$order_info = array();
		if($orderArr[0]["quantity"] > 1)
		{
			$cart_session = $this->session->userdata("tgb_session_id");
			$order_info = $this->orderitem->decreaseQuantity($orderArr[0], $cart_session, $Id);
			$list = "RECORD_DELETED";
		}	
		
		//		$this->order->updateOrder($orderArr1);
		$order_info['message'] = $list;
		header('Content-type: application/json');
		echo json_encode($order_info);	
		exit ();
	}
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function updateRestaurant($restaurantID)
	{
		$restaurantArr	=	$this->restaurant->listRestaurantById($restaurantID);
//		print_r ($orderArr);
//		$restaurantArr["order_preparation_time"]	=	trim($this->input->get_post("order_preparation_time"));
		$restaurantArr["delivery_time_before"]	=	trim($this->input->get_post("delivery_time_before"));		
		$this->restaurant->updateRestaurant($restaurantArr);
		echo $restaurantID;			
		exit ();
	}
	
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getOrderById($Id)
	{
		$list=$this->order->getOrderById($Id);
		echo json_encode($list);
		exit();
	}
	
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getOrderItemsById($Id)
	{
		$list=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$Id));
		echo json_encode($list);
		exit();
	}
	/*
	* @method This method will return the complete terminals list based on airport id
	* @params It will take Airport Id as parameter 	
	*/
	function listTerminals($airportId=0)
	{
		$list	=	$this->terminals->listTerminals($airportId);
		
		echo json_encode($list);
		
		exit ();
	}
	/*
	* @method This method will return the complete airport list
	* @params None
	*/
	function listAirports()
	{
		$searchString	=	"";
/*		if ($this->input->get_post("name_startsWith"))
		{
			$searchString	=	trim($this->input->get_post("name_startsWith"));
			
		}
*/		
		$list	=	$this->airport_core->listAirport($searchString);
		
		
		echo json_encode($list);
		
		exit ();
	}
	

	/*
	* @method This method will login into the syste,
	* @params None
	*/
	function logoutRestaurant()
	{
		$this->restaurant->logout();
		$list["response"]	=	"Logout_Success";
		echo json_encode($list);
		exit ();
	}
	/*
	* @method This method will login into the syste,
	* @params None
	*/
	function loginRestaurant()
	{
		$return		=	array ();
		$data["email"]	=	trim($this->input->get_post("email"));
		$data["password"]	=	md5(trim($this->input->get_post("password")));

		$arrUser=$this->restaurant->login($data);
		if ($arrUser	==	"Login_Error")
		{
			$return['error']	=	"Login_Error";
		}
		else
		{
			$return['success']	=	"Yes";

			$restaurantArr = $this->session->userdata('restaurant');
			
			$return['restaurant_id']	=	$restaurantArr["id"];
		}

		echo json_encode($return);
	
		exit ();
		
		
	}//end function
	
	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/
	function getOrdersByUser($userID)
	{
		
		$orderFilter["email"]	=	trim($this->input->get_post("email"));
		$orderFilter["user_id"]	=	$userID	;
		$orderFilter["order_status"]	=	"All";
		

		$list=$this->order->getOrdersByUser($orderFilter,0,10);
		
		if ($list	!=	null)
			echo json_encode($list);
		else
		{
			$list["response"]	=	"No_Record_Found";
			echo json_encode($list);
		}
		exit();
	}

	function getAllFavorites($userId)
	{
		$list	=array();
		$favRestaurants	=	$this->restaurant_favorites->listRestaurantFavorites($userId);
		if ($favRestaurants	!=	null)
			$list["Restaurants"]	=	$favRestaurants;
		else
			$list["Restaurants"]	=	array("response"=> "No_Record_Found");
		
		$favItems	=	$this->item_favorites->listItemFavorites($userId);
		if ($favItems	!=	null)
			$list["Items"]	=	$favItems;
		else
			$list["Items"]	=	array("response"=> "No_Record_Found");

		$orderFilter["user_id"]	=	$userId;
		$orderFilter["is_favorite"]	=	"Yes";

		$favOrders	=	$this->order->getOrdersByUser($orderFilter);
		if ($favOrders	!=	null)
			$list["Orders"]	=	$favOrders;
		else
			$list["Orders"]	=	array("response"=> "No_Record_Found");
			
		echo json_encode($list);
		exit ();
			

	}
	
	// verifies valid email and sends email to valid email id entered
	function forgotPass()
	{
		$nCount =0;
		
		$data["email"] = trim($this->input->get_post("email")); //--> email of the user or restaurantowner who have forgot pass
		$data["type"] = trim($this->input->get_post("type")); //--> type of user either user or restaurantowner
		$userType = $data["type"];
		$list = $this->user->verifyEmail($data,$userType);
		echo json_encode($list);
		exit ();
	
	}
	
	// for change of password based on security code sent to email. The arguments in this functions $id is the id of the user and
	// $code is the security code sent to the user.
/*	function recoverview($id,$code)
	{
		$data = array();
		$arrUser = array();
		
		$arrUser["id"] = $id;
		$arrUser["security_code"] = $code;
		
		
		if($_POST)
		{
			$arrUser["password"] = md5(trim($this->input->get_post("password")));
			$confpass = md5(trim($this->input->get_post("confpass")));
			$arrUser["id"] = $this->input->get_post("userid");
			$arrUser["security_code"] = $this->input->get_post("codeid");
			$userDetail = $this->user->getUserById($arrUser["id"]);
			
			if($userDetail[0]["security_code"] == $arrUser["security_code"])
			{	
				$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confpass]');
				$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim');
				
				if ($this->form_validation->run() == FALSE)
				{	
					$errorsArray['password']	=	form_error('password');
					$data["flag"]=0;
				}
				else
				{	
					$arrUser["security_code"] = "";
					$this->user->updateUser($arrUser);
					$successArray['password']	=	"Your Password hash been changed!!";
					
				}
			}
		}
		
		$data["errors"] = $errorsArray;
		$data["successes"] = $successArray;
		$data["arrUser"] = $arrUser;
		$data["id"] = $id;
		$data["code"] = $code;
		
		$this->load->view('userfront/recoverview',$data);
	}*/
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	/*	@function creates the customer profile and returns the customer profile id
		does not return customer payment profile id
		@params function takes the user id as the input.	
	*/
	function createCustomerProfile($userId)
	{	
		$this->load->library('core/profile_core');
		
		$arrInfo["userid"]  = $userId;
		$arrInfo["cardnumber"]  = $this->input->get_post('cardnumber');
		$arrInfo["expyear"]  = $this->input->get_post('expyear');
		$arrInfo["expmonth"]  = $this->input->get_post('expmonth');
		$list = $this->profile_core->createCustomerProfile($arrInfo);
	//	print_r($list);
	//	echo $list["validation"] ;
		echo json_encode($list);
		exit ();
/*		$this->load->library('core/authorize_core');
		
		$authProfile = array();
		$userInfo = $this->user->getUserById($userId);
		
		$cardData["cardnumber"] = $this->input->get_post('cardnumber');
		$expyear = $this->input->get_post('expyear');
		$expmonth = $this->input->get_post('expmonth');
		$cardData["expiryDate"] = $expyear."-".$expmonth;
	//	print_r($userInfo[0]);
	//	exit();
		if($userInfo[0]["customer_profile_id"] != "")
		{	
			$authProfile = $this->authorize_core->getCustomerProfileRequest($userInfo[0]["customer_profile_id"]);
		//	print_r($authProfile);
			$info["customer_payment_profile_id"] = $authProfile[1]["customerPaymentProfileId"][0];
			$info["customer_profile_id"] = $userInfo[0]["customer_profile_id"];
			
			$newauthProfile = $this->authorize_core->createCustomerPaymentProfileRequest($userInfo[0],$cardData);
		//	print_r($newauthProfile);
			if($info["customer_payment_profile_id"] != "" && $newauthProfile["validation"] == "YES")
				$deleteProfile = $this->authorize_core->deleteCustomerPaymentProfileRequest($info);//echo "here";
			
		//	print_r($newauthProfile);
			$list["validation"] = $newauthProfile["validation"];
			$list["text"] = $newauthProfile["text"];
			$list["paymentProfile"] = $newauthProfile["customerPaymentProfileId"];
			echo json_encode($list);
			exit ();
		}
		else
		{
			$newauthProfile = $this->authorize_core->createCustomerProfileRequest($userInfo[0],$cardData);
		//	print_r($newauthProfile); // customerProfileId , customerPaymentProfileId , validation(YES/NO) , text(successful if yes)
//			$newuserInfo = $this->user->getUserById($userId);
			$userInfo[0]["customer_profile_id"]	= $newauthProfile["customerProfileId"];
			$this->user->updateUser($userInfo[0]);
			
			$list["validation"] = $newauthProfile["validation"];
			$list["text"] = $newauthProfile["text"];
			$list["paymentProfile"] = $newauthProfile["customerPaymentProfileId"];
			echo json_encode($list);
			exit ();
		}
		*/
		
	}
	/* @function creates the customer payment profiles if the customer profile is already been made
		and returns the customer payment profile id been made successfully.
		@params function takes the userid as the input.
	*/
	function createCustomerPaymentProfile($userId)
	{	
		$this->load->library('core/authorize_core');
	
		$authProfile = array();
		$userInfo = $this->user->getUserById($userId);
		if($userInfo[0]["customer_profile_id"] != "")
		{	
			$authProfile = $this->authorize_core->createCustomerPaymentProfileRequest($userInfo[0]);
		//	print_r($authProfile); // validation (YES/NO) , text (Successful if yes)
			$list["response"] = $authProfile;
			echo json_encode($list);
			exit ();
		}
		else
		{
			$list["response"] = "No_Profile_Id";
			echo json_encode($list);
			exit ();
		}
	}
	/*	@function deletes the customer payment profile
		@params takes the customer profile id and customer payment profile id as the params.
	*/
	function deleteCustomerPaymentProfile($id)
	{	
		
		$this->load->library('core/authorize_core');
	
		$userInfo = $this->user->getUserById($id);
		$info= $userInfo[0]["customer_profile_id"];
		
		$authProfile = $this->authorize_core->deleteCustomerProfileRequest($info);
		if($authProfile["resultCode"] == "Ok")
		{
			$userInfo[0]["customer_profile_id"] = "";
			$this->user->updateUser($userInfo[0]);
		}
//		print_r($authProfile);
		$list["text"] = $authProfile["text"];
		$list["resultCode"] = $authProfile["resultCode"];
		
		if($list["text"] == "null")
			$list["text"] = "Error";
			
		if($list["resultCode"] == "null")
			$list["resultCode"] = "Error";	
		echo json_encode($list);
		exit ();
		
/*		
		
		
		$this->load->library('core/authorize_core');
	
		$userInfo = $this->user->getUserById($id);
		$info["customer_profile_id"] = $userInfo[0]["customer_profile_id"];
		$info["customer_payment_profile_id"] = $this->input->get_post('paymentProfile');
	//	print_r($info);exit();
		$authProfile = $this->authorize_core->deleteCustomerPaymentProfileRequest($info);
	//	print_r($authProfile);
		if($authProfile["resultCode"] == "Ok")
		{
			$userInfo[0]["customer_profile_id"] = "";
			$this->user->updateUser($userInfo[0]);
		}
		$list["text"] = $authProfile["text"];
		$list["resultCode"] = $authProfile["resultCode"];
		echo json_encode($list);
		exit ();*/
		
	}
	/* @function returns the data of customer payment profiles.
		@params takes the id of the user as a parameter.
	*/
	function getCustomerProfile($id) 
	{	
		$this->load->library('core/authorize_core');
		
		$authProfile = array();
		$userInfo = $this->user->getUserById($id);
		$authProfile = $this->authorize_core->getCustomerProfileRequest($userInfo[0]["customer_profile_id"]);

/*		$arrReturn["cardNumber"]	=   (string) $authProfile[1]["cardNumber"][0];
		$arrReturn["firstName"]	=   (string) $authProfile[1]["firstName"][0];
		$arrReturn["lastName"]	=   (string) $authProfile[1]["lastName"][0];
		$arrReturn["expirationDate"]	=   (string) $authProfile[1]["expirationDate"][0];
		$arrReturn["customerPaymentProfileId"]	=   (string) $authProfile[1]["customerPaymentProfileId"][0];
		$arrReturn["have_error"]	=   (string) $authProfile[1]["have_error"];*/
//		$list["response"] = $authProfile;
		echo json_encode($authProfile);
		exit ();
	}
	/* @function returns the data of customer payment profile.
		@params takes the customer profile id and customer payment profile id of the user as a parameter.
	*/	
	function getCustomerPaymentProfile($profileId , $paymentId) // No need for this function
	{	
		$authProfile = array();
	//	$userInfo = $this->user->getUserById($id);
		$userInfo["customer_profile_id"] = $profileId;
		$userInfo["customer_payment_profile_id"] = $paymentId;
		$authProfile = $this->authorize_core->getCustomerPaymentProfileRequest($userInfo);
		// print_r($authProfile);
		
	}	
	function validateCustomerPaymentProfile($profileId , $paymentId)
	{	
		$authProfile = array();
	//	$userInfo = $this->user->getUserById($id);
		$userInfo["customer_profile_id"] = $profileId;
		$userInfo["customer_payment_profile_id"] = $paymentId;
		$authProfile = $this->authorize_core->validateCustomerPaymentProfileRequest($userInfo);
	//	print_r($authProfile);
		
	}	
	function deleteCustomerProfile($profileId)
	{	
		$this->load->library('core/authorize_core');
	
		$userInfo["customer_profile_id"] = $profileId;
		$authProfile = $this->authorize_core->deleteCustomerProfileRequest($profileId);
		if($authProfile["resultCode"] == "Ok")
		{
			$userInfo[0]["customer_profile_id"] = "";
			$this->user->updateUser($userInfo[0]);
		}
//		print_r($authProfile);
		$list["text"] = $authProfile["text"];
		$list["resultCode"] = $authProfile["resultCode"];
		echo json_encode($list);
		exit ();
		
	}	
	function createCustomerProfileTransaction() // for the user having customer profile id
	{	
		$this->load->library('core/authorize_core');
		
		$userInfo["chargetotal"] = $this->input->get_post('totalAmount');
		$userInfo["customer_payment_profile_id"] = $this->input->get_post('paymentProfileId');
		$userId = $this->input->get_post('userid');
		$user = $this->user->getUserById($userId);
		$userInfo["customer_profile_id"] = $user[0]["customer_profile_id"];
		
		if($userInfo["customer_profile_id"] != "")
		{
			$authProfile = $this->authorize_core->createCustomerProfileTransactionRequest($userInfo);
			$list["text"] = $authProfile["text"];
			$list["resultCode"] = $authProfile["resultCode"];
			echo json_encode($list);
			exit ();
		}
		
		else
		{
			$list["response"] = "No_Profile_exists";
			echo json_encode($list);
			exit ();
		}
	//	print_r($authProfile);
		
	}
	function createCustomerProfileTransactionAim() // for the guest and the customer dont have customer
												// profile id or dont want to use the payment profile
	{
		$this->load->library('core/authorize_core');
		
		$userInfo["chargetotal"] = $this->input->get_post('totalAmount');
		$userInfo["cardnumber"] = $this->input->get_post('cardnumber');
		$userInfo["cardexpmonth"] = $this->input->get_post('expmonth');
		$userInfo["cardexpyear"] = $this->input->get_post('expyear');
	//	print_r($userInfo);
		$result = $this->authorize_core->processTransaction($userInfo); // returns error if failed and ok for success
	//	print_r($authProfile);
		echo json_encode($result);
		exit ();
		
	}
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	

}

/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
