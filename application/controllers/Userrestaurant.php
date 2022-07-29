<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class UserRestaurant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/restaurant_rating');
		$this->load->library('core/restaurant_review');
		$this->load->library('core/orderitem');
		$this->load->library('core/menuitem');
		$this->load->library('core/menuitemvariantgroup');
		$this->load->library('core/cart');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');	
		$this->load->model('Broadcaster_model');
	}
	
/**
.........................................................................................................
									Start Restaurant Info Section 
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
		redirect(base_url()."userrestaurant/restaurantmenu");
	}

	function get_restaurants_api()
	{
		$list=$this->restaurant->getActiveRestaurants("Active");
		foreach($list as $key => $item){
			$list[$key]['menu_link'] = base_url('/').$item['id'];
			$list[$key]['logo'] = base_url('/uploads/restaurant/logo/').$item['logo'];
		}
		echo json_encode($list);
		exit;
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	function checkdatetime($flight_date)
	{
		$strCurrentDate	=	strtotime(date("Y-m-d"));
		$flight_date_time	=	strtotime($flight_date);
		
		if($flight_date_time < $strCurrentDate)
		{
			$this->form_validation->set_message('checkdatetime', 'The %s should be the today\'s date OR after today');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function checkpickuptime()
	{//echo $this->input->get_post('flight_date');echo "<br />";
		$pickup_time_check	=	strtotime(date($this->input->get_post('flight_date'))." ".$this->input->get_post('pickup_time_hour').":".$this->input->get_post('pickup_time_minute').":00 ".$this->input->get_post('pickup_time_type'));
//echo "<br/>";
		$flight_time_check	=	strtotime(date($this->input->get_post('flight_date'))." ".$this->input->get_post('flight_time_hour').":".$this->input->get_post('flight_time_minute').":00 ".$this->input->get_post('flight_time_type'));
//echo "<br/>";

		$flightDiffTime	=	$this->config->item("flightDiffTime");
		$orderTime = $this->input->get_post('order_time');
		$name = $this->input->get_post('name');

		$checkTime=strtotime($flight_time_check);
		$startTime = date("h:i:s a", strtotime('+'.$flightDiffTime.' minutes', $pickup_time_check));//echo "<br/>";
		$startTime1 = strtotime(date($this->input->get_post('flight_date'))." ".$startTime);//echo "<br/>";
		
		$current_time = strtotime(date("Y-m-d H:i:s"));//echo "<br/>";
		$startTime_check = date("h:i:s a", strtotime('-'.$orderTime.' minutes', $pickup_time_check));//echo "<br/>";
		$startTime_check1 = strtotime(date($this->input->get_post('flight_date'))." ".$startTime_check);//echo "<br/>";
	//	echo $current_time;
	//	exit();
		if($flight_time_check > $current_time && $pickup_time_check > $current_time)	
		{	
			if($current_time < $startTime_check1)
			{
				if ($flight_time_check < $startTime1)
				{	
					$this->form_validation->set_message('checkpickuptime', 'Order pickup time must be '.$flightDiffTime.' minutes before the flight departure time');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
			else
			{
				$this->form_validation->set_message('checkpickuptime', 'Order Pick Up time must be '.$orderTime.' minutes after the Current time for '.$name.' restaurant');
				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('checkpickuptime', 'Flight time and Order Pick Up time must be after the Current time');
			return FALSE;
		}

	}
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function restaurantmenu($restaurantId = 0, $table_no = null)
	{
		if(is_string($restaurantId)){
			$restaurantName = $restaurantId;
			$restaurantId = urldecode($restaurantId);
			$restaurantInfo=$this->restaurant->listRestaurantByName($restaurantId);
			if(isset($restaurantInfo['id']))
				$restaurantId = $restaurantInfo['id'];
		} else {
			$restaurantInfo=$this->restaurant->listRestaurantById($restaurantId);
		}

		if (!empty($table_no)) {
			$this->session->set_userdata("table_no" , $table_no);
		}

		$restaurantCoupons = $this->restaurant->getRestaurantCoupon($restaurantId);

		$data	=	array();
		$errorsArray =	array();
		$data["activemenu"]	=	"restaurantmenu";
		$filters	=	array();
		$arrReturn = [];
		$filters["orderby"]	=	"category_id";
		
		$arrSession["restaurantID"]	=$restaurantId;
		$arrSession["restaurantName"]	=$restaurantName;
		$this->session->set_userdata($arrSession);
			
		$this->load->library('core/menuitem');	
		$this->load->library('core/restaurant');	
		$this->load->library('core/orderitem');	
		
		if ($this->session->userdata('search_criteria'))
			$arrReturn = $this->session->userdata('search_criteria');
		// else
		// 	redirect(base_url()."home");
		

		if (empty($restaurantInfo)) {
			$this->output->set_status_header('404');
			return $this->load->view('userfront/restaurant_not_found');
		}

		$data["order_time"] = $restaurantInfo["delivery_time_before"];
		$items=$this->menuitem->listMenuItemByRestaurantId($restaurantId, $filters);

		$cartItems	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$this->session->userdata("tgb_session_id")));
		
		$favrest	=	array();
		if ($this->session->userdata('id'))
		{
			$arrFilters["userId"]	=	$this->session->userdata('id');
			$arrFilters["restaurantId"]	=	$restaurantInfo["id"];
			$this->load->library('core/restaurant_favorites');
			$favrests	=	$this->restaurant_favorites->listRestaurantFavorites($arrFilters);
			if(isset($favrests[0]))
				$favrest	=	$favrests[0];
		}
		if($_POST)
		{	
			// $arrInfo["airport"]	=$arrReturn["airport"];
			// $arrInfo["terminal"]	=$arrReturn["terminal"];
			// $arrInfo["flight_date"]	=$this->input->get_post('flight_date');
			// $arrInfo["flight_time_hour"]	=$this->input->get_post('flight_time_hour');
			// $arrInfo["flight_time_minute"]	=$this->input->get_post('flight_time_minute');
			// $arrInfo["flight_time_type"]	=$this->input->get_post('flight_time_type');
			// $arrInfo["pickup_time_hour"]	=$this->input->get_post('pickup_time_hour');
			// $arrInfo["pickup_time_minute"]	=$this->input->get_post('pickup_time_minute');
			// $arrInfo["pickup_time_type"]	=$this->input->get_post('pickup_time_type');
			// $arrInfo["airportid"]	=$arrReturn["airportid"];
			
			// $this->form_validation->set_rules('flight_date', 'Flight Date', 'trim|required|callback_checkdatetime');
			// $this->form_validation->set_rules('flight_time_hour', 'Flight time hour', 'trim|required');
			// $this->form_validation->set_rules('flight_time_minute', 'Flight time minute', 'trim|required');
			// $this->form_validation->set_rules('pickup_time_hour', 'Pickup time hour', 'trim|required');
			// $this->form_validation->set_rules('pickup_time_minute', 'Pickup time minute', 'trim|required|callback_checkpickuptime');
			
			if (count($cartItems) > 0)
			{
				redirect(base_url()."userorder/checkout");
				// if ($this->form_validation->run() == FALSE)
				// {
					
					// $this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
					
					// $errorsArray['flight_date']	=	form_error('flight_date');
					// $errorsArray['flight_time_hour']	=	form_error('flight_time_hour');
					// $errorsArray['flight_time_minute']	=	form_error('flight_time_minute');
					// $errorsArray['pickup_time_hour']	=	form_error('pickup_time_hour');
					// $errorsArray['pickup_time_minute']	=	form_error('pickup_time_minute');
	
					// $arrReturn = $arrInfo;
			
				//}
				
				// else if($arrInfo == $arrReturn)
				// {
				// 	redirect(base_url()."userorder/checkout");
				// }
				// else 
				// {
				// 	$arrSession["search_criteria"]	=	$arrInfo;
				// 	$this->session->set_userdata($arrSession);
				// 	$newArr = $this->session->userdata('search_criteria');
				// 	redirect(base_url()."userorder/checkout");
				// }	
			}
			else
			{
				$errorsArray['cartCheck'] = "<strong> Alert:</strong> Sorry Cart is Empty. Cannot check Out!!";
				
			}
		}
		
			
		if (count($cartItems) == 0)
			$this->session->unset_userdata('restaurantID');
			
		$logoPath					=	$this->config->item("restaurant_logo_path");
		$data["logoPath"]			=	$logoPath;
		$data["restaurantCoupons"]	=	$restaurantCoupons;
		$data["items"]				=	$items;
		$data["restaurantInfo"]		=	$restaurantInfo;
		$data["cartItems"]			=	$cartItems;
		$data["favrest"]			=	$favrest;
		$data["arrReturn"]			=	$arrReturn;
		$data["restaurantId"] 		= 	$restaurantId;
		$data["errors"]				=	$errorsArray;
		$categories = [];
		foreach($items as $item){
			$objCategory = new \stdClass;
			$objCategory->category_name = $item['category_name'];
			$objCategory->category_icon = $item['category_icon'];
			$objCategory->sort_index = $item['sort_index'];
			$categories[$item['category_id']] = $objCategory;
		}
		usort($categories,function($first,$second){
				return $first->sort_index > $second->sort_index;
		});
		$data["categories"]			=	$categories;
//		print_r ($restaurantInfo);
		
		$data["broadcaster"]=$this->Broadcaster_model->get_broadcaster($restaurantId);
		$this->session->set_userdata('broadcaster', $data["broadcaster"]);
		$this->load->view('userfront/userrestaurant/restaurantmenu',$data);
	}
	
	function processVariants($varaintArray)
	{
		$errors	=	array();
		$arrVaraintArray	=	array();
		$variantErrors	=	array();
		$arrVariantData	=	array();
		$nCount	=	$varaintArray["variantcount"];
		for ($i=0;$i<=$nCount;$i++)
		{
			if ($this->input->get_post("varianttype_".$i)	==	"slider" || $this->input->get_post("varianttype_".$i)	==	"single")
			{
				if ($this->input->get_post("variantrequired_".$i)	==	"Yes")//apply validation
				{
					if (!$this->input->get_post("variant_name_".$i))
					{
						$variantErrors[$i]		=	"Must select one.";
					}
				}
				$arrVaraintArray[]	=	$this->input->get_post("variant_name_".$i);
				$arrVariantData[$i]	=	$this->input->get_post("variant_name_".$i);
			}
			else if ($this->input->get_post("varianttype_".$i)	==	"multiple")
			{
				//print_r ($this->input->get_post("variant_name_".$i));
				$arrVariants	=	$this->input->get_post("variant_name_".$i);
				$nCountMultiple	=	$this->input->get_post("variant_item_count_".$i);;
				//echo "yes";
				//print_r ($this->input->get_post("variant_name_".$i));
				//print_r ($arrVariants);
				//echo count($arrVariants);
				
				if ($this->input->get_post("variantrequired_".$i)	==	"Yes")//apply validation
				{
					$flag=false;
					
					for($j=0;$j<=$nCountMultiple;$j++)
					{
						//if ($this->input->get_post("variant_name_".$i))
						$arrVariants[]	=	$this->input->get_post("variant_name_".$i.$j);
						
						if ($this->input->get_post("variant_name_".$i.$j))
						{
							$flag	=	true;
						}
					}
					if (!$flag)
					{
						$variantErrors[$i]		=	"Must select one.";
					}
				}
				else
				{
					for($j=0;$j<=$nCountMultiple;$j++)
					{
						$arrVariants[]	=	$this->input->get_post("variant_name_".$i.$j);
					}
				}
				

				foreach ($arrVariants as $variantitem)
				{
					$arrVaraintArray[]	=	$variantitem;
					$arrVariantData[$i][]	=	$variantitem;
				}

				
				
			}
		}
		
		$data["varianterrors"]	=	$variantErrors;
		$data["variantitems"]	=	$arrVaraintArray;
		$data["variantdata"]	=	$arrVariantData;
//		print_r ($arrVaraintArray);
		return $data;
	}

	function addtocart($itemId)
	{
		$data	=	array();
		$variantInfo	=	array();
		$favItems = array();
		$taxCalculation = 0;
		$this->load->library('core/menuitem');	
		$this->load->library('core/menuitemgroup');	
		$this->load->library('core/cart');	
		
		

		$item	=	$this->menuitem->listMenuItemById($itemId);
		$data["item"] = $item;
		$restaurant = $this->restaurant->listRestaurantById($item["restaurant_id"]);
		$data["restaurant_name"] = $restaurant["restaurant_name"];
		$data["restaurant_theme_settings"] = $restaurant["theme_settings"];
		
		if ($_POST)
		{
			$arrInfoDetail	=	array();

			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric');
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['quantity']	=	form_error('quantity');

				$data["errors"]=$errorsArray;
			
			}
			else
			{
			
				$variantInfo	=	$this->processVariants($_POST);
				
				if (count($variantInfo["varianterrors"]) > 0)
				{
					$data["errors"][]='<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> There must be some errors in the variants section.</p>';
				}
				else
				{
				$arrInfo	=	$data["item"];
				$arrInfo["session_id"]=$this->session->userdata("tgb_session_id");
				$arrInfo["instructions"]=$this->input->get_post("instructions");
				$arrInfo["quantity"]=$this->input->get_post("quantity");
				$cartid	=	$this->cart->addToCart($arrInfo,$variantInfo["variantitems"]);
				$taxCalculation = $this->cart->calculateTax($cartid);
			//	print_r($arrInfo);exit();
				$arrSession["restaurantID"]	=	$arrInfo["restaurant_id"];
				$this->session->set_userdata($arrSession);
				if ($cartid	>	0)
					$data["success"]	=	array("msg"=>"Item added to cart successfully");
					$cartPrice	=	$this->cart->getCartOrderPrice($cartid);
					$data["cartPrice"]	=	$cartPrice;
					// return $this->load->view('userfront/userrestaurant/proceed_to_checkout',$data);
					// exit;
				}	
			}
		}
		
	

		$data["itemdetail"]=$this->menuitemgroup->listMenuItemDetails($itemId);
		if( $this->session->userdata('id')== "")
		{
		
			$data["userId"]= 0;
		}else{
			$data["userId"]= $this->session->userdata('id');
		}
		
		$this->load->library('core/item_favorites');	
		
		
		if ($this->session->userdata('id'))
		{
			$userId	=	$this->session->userdata('id');
			$favItems=$this->item_favorites->listItemFavorites($userId);
			
		}
		
 		
		$favItemIDs	=	array();
		$favIDs	=	array();
		
		foreach ($favItems as $favItem)
		{
			$favItemIDs[]	=	$favItem["item_id"];
			$favIDs[]	=	$favItem["fav_id"];
			
		}
		$restaurantId = $this->session->userdata('restaurantID');
		$restaurant = $this->restaurant->listRestaurantById($restaurantId);
		$data["restaurant_name_prev"] = isset($restaurant["restaurant_name"]) ? $restaurant["restaurant_name"] : "";
		$cartItems	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$this->session->userdata("tgb_session_id")));
		
//		$list=$this->restaurant->listRestaurant($arrReturn["terminal"],"Active", $pickup_time="");
		$data["favItemIDs"]=$favItemIDs;
		$data["favIDs"]=$favIDs;
		$data["variantInfo"]=$variantInfo;
		$data["taxCalculation"] = $taxCalculation;
		$data["restaurantId"] = $restaurantId;
		$data["restaurantInfo"] = $restaurant;
		$data["cartItems"] = $cartItems;
		
		
		$this->load->view('userfront/userrestaurant/addtocart',$data);
	}


	function itemdetail($cartItemId)
	{//	echo $cartItemId;
		$data	=	array();
		
		$cartItem = $this->orderitem->getOrderItemById($cartItemId);
	//	print_r($cartItem);
	
		$itemDetail = $this->menuitem->listMenuItemById($cartItem[0]["item_id"]);
		$menuitemdetail=$this->menuitemvariantgroup->listMenuItemDetails($cartItem[0]["id"]);
		
		$data["cartItem"] = $cartItem;
		$data["itemDetail"] = $itemDetail;
		$data["menuitemdetail"] = $menuitemdetail;
//		print_r($cartItem);
		$this->load->view('userfront/userrestaurant/itemdetail',$data);
	}


	function restaurantinfo($restaurantId=0)
	{
		$data	=	array();
		$data["activemenu"]	=	"restaurantinfo";
		
		$restaurantInfo=$this->restaurant->getRestaurantByIdWithTerminal($restaurantId);

		$favrest	=	array();
		if ($this->session->userdata('id'))
		{
			$arrFilters["userId"]	=	$this->session->userdata('id');
			$arrFilters["restaurantId"]	=	$restaurantInfo["id"];
			$this->load->library('core/restaurant_favorites');
			$favrests	=	$this->restaurant_favorites->listRestaurantFavorites($arrFilters);
			if(isset($favrests[0]))
				$favrest	=	$favrests[0];
		}

		$logoPath	=	$this->config->item("restaurant_logo_path");
		$data["logoPath"]	=	$logoPath;
		$data["restaurantInfo"]	=	$restaurantInfo;
		$data["favrest"]	=	$favrest;
		$this->load->view('userfront/userrestaurant/restaurantinfo',$data);
	}
	
	function listYelpRestaurantReviews($restaurantId=0)
	{
		$restaurantInfo=$this->restaurant->getRestaurantByIdWithTerminal($restaurantId);
		$list=$this->restaurant_review->listYelpRestaurantReviews($restaurantId);
		
		$logoPath	=	$this->config->item("restaurant_logo_path");
		$data["logoPath"]	=	$logoPath;
		$data['reviews'] = $list;
		$data["restaurantInfo"]	=	$restaurantInfo;
		$data["activemenu"]	=	"yelpreviews";
		
		$this->load->view('userfront/userrestaurant/yelpreviews',$data);
	}
	
	function reviews($restaurantId=0)
	{
		$data	=	array();
		$data["activemenu"]	=	"reviews";
		$this->load->library('core/restaurant_review');
		$restaurantInfo=$this->restaurant->getRestaurantByIdWithTerminal($restaurantId);

		$favrest	=	array();
		if ($this->session->userdata('id'))
		{
			$arrFilters["userId"]	=	$this->session->userdata('id');
			$arrFilters["restaurantId"]	=	$restaurantInfo["id"];
			$this->load->library('core/restaurant_favorites');
			$favrests	=	$this->restaurant_favorites->listRestaurantFavorites($arrFilters);
			if(isset($favrests[0]))
				$favrest	=	$favrests[0];
		}


		$data["restaurantInfo"]	=	$restaurantInfo;
		$data["favrest"]	=	$favrest;

		if($_POST)
		{
			if( $this->session->userdata('id')!= "")
            {
				$this->form_validation->set_rules('txtreview', 'Review', 'trim|required');
				
				$arrInfo["user_id"] = $this->session->userdata('id');
				$arrInfo["restaurant_id"]	=	$restaurantId;	
				$arrInfo["num"]	=	trim($this->input->post("rating"));
				$rating = $arrInfo;
				$arrInfo["review"]	=	trim($this->input->post("txtreview"));	
				
				if ($this->form_validation->run() == FALSE)
				{
					$errorsArray['txtreview']	=	'Please Write some thing in Review.';
					$data['errors'] = $errorsArray;
				}
				else
					$this->restaurant_rating->addRestaurantRating($rating);
            }

		}
		$per_page	=	$this->config->item("PER_PAGE");
//		$per_page	=	1;
		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(4);
		
		$data['total']= $total	=	$this->restaurant_rating->listRatings($restaurantId,"Yes");
		if( $total > $per_page )
		{
			$data["records"] = $per_page + $this->uri->segment(4);
			if($data["records"]>$total)
				$data["records"]=$total;
		
		}else{
			$data["records"] = $total;
		}
		
		$config['base_url'] = base_url().'/userrestaurant/reviews/'.$restaurantId;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '4';
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['next_link'] = '<li>Next >></li>';
		$config['prev_link'] = '<li><< Back</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		

		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();
		
		$data['restaurantid']	=	$restaurantId;
		$list = $this->restaurant_rating->listRatings($restaurantId,"No",$per_page, $this->uri->segment(4));
		$data['reviews']=$list;
		$logoPath	=	$this->config->item("restaurant_logo_path");
		$data["logoPath"]	=	$logoPath;
		
		$this->load->view('userfront/userrestaurant/reviews',$data);
	}

	
/**
.........................................................................................................
									End Restaurant Info Section 
.........................................................................................................
*/	
	function setPickupTime()
	{
		$arrReturn["flight_date"]	=$this->input->get_post('flight_date');
		$arrReturn["flight_time_hour"]	=$this->input->get_post('flight_time_hour');
		$arrReturn["flight_time_minute"]	=$this->input->get_post('flight_time_minute');
		$arrReturn["flight_time_type"]	=$this->input->get_post('flight_time_type');
		$arrReturn["pickup_time_hour"]	=$this->input->get_post('pickup_time_hour');
		$arrReturn["pickup_time_minute"]	=$this->input->get_post('pickup_time_minute');
		$arrReturn["pickup_time_type"]	=$this->input->get_post('pickup_time_type');
		$arrSession["search_criteria"]	=	$arrReturn;
		$this->form_validation->set_rules('flight_date', 'Flight Date', 'trim|required');
		$this->form_validation->set_rules('flight_time_hour', 'Flight time hour', 'trim|required');
		$this->form_validation->set_rules('flight_time_minute', 'Flight time minute', 'trim|required');
		$this->form_validation->set_rules('pickup_time_hour', 'Pickup time hour', 'trim|required');
		$this->form_validation->set_rules('pickup_time_minute', 'Pickup time minute', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data["status"]="ERROR";
		}else
		{
			$this->session->set_userdata($arrSession);		
			$data["status"]="SUCCESS";
		}
		echo json_encode($data);
		
	}

	function viewCartDetail () {
		$cartItems	=	$this->orderitem->getOrderItemWithVariants(array("session_id"=>$this->session->userdata("tgb_session_id")));

		$row = '';

		if (isset($cartItems) && count($cartItems) > 0) {
			$grandTotal	=	0;
			$totalCityTax = 0;
			$totalStateTax = 0;

			$row .= '<div id="cart_message_section" class="alert alert-warning" style="display: none">';
			$row .= '	<p id="cart_message_text" class="mb-0 p-0" style="border-bottom:0">';
			$row .= '		this is my test message';
			$row .= '	</p>';
			$row .= '</div>';

			foreach ($cartItems as $cartItem) {
				$row .= '<div class="cart-item">';
				$row .= $english_format_number = number_format($cartItem["totalprice"], 2, '.', '');
				$row .= '<span class="cart-itemName font11" id="set2">';
				$row .=substr($cartItem["item_name"], 0, 13);
				$row .= '<span class="cart-itemDel">';
				$row .= '<a href="javascript:void(null);" onclick="deleteItem('.$cartItem["id"].');" title="Delete Item"><img src="'.base_url("images/front/del.png").'" alt="del" border="0" /></a>';
				$row .='</span>';
				$row .='<small>₦<span id="'.$cartItem["id"].'_total_price">'.$english_format_number.'</span></small>';
				$row .='</span>';
				$row .='<span class="cart-arrow">';
				$row .='<span href="javascript:void(null);" onclick="decreaseQuantity('.$cartItem["id"].');">-</span>';
				$row .='<span  id="'.$cartItem["id"].'_dec_inc" class="cart-num font11">'.$cartItem["quantity"].'</span>';
				$row .='<span href="javascript:void(null);" onclick="increaseQuantity('.$cartItem["id"].');">+</span>';
				$row .='</span>';
				$row .='</div>';
								
				$totalCityTax = $totalCityTax + $cartItem["city_tax"];
				$totalStateTax = $totalStateTax + $cartItem["state_tax"];
				$grandTotal	=	$grandTotal+$cartItem["totalpricewithtax"];
			}

			$english_format_number = number_format($totalCityTax, 2, '.', '');
			$row .='<p>Total City Tax: <strong>₦<span id="dis_city_tax">'.$english_format_number.'</span></strong></p>';

			$english_format_number = number_format($totalStateTax, 2, '.', '');
			$row .='<p>Total State Tax: <strong>₦<span id="dis_state_tax">'.$english_format_number.'</span></strong></p>';

			$english_format_number = number_format($grandTotal, 2, '.', '');
			$row .='<p>Total: <strong>₦<span id="dis_Total">'.$english_format_number.'</span></strong></p>';
			$row .='</div>';
		}	
		echo $row;
		// die('hhhh');
		// echo '<pre>';
		// print_r($row);
		// die('pop');
		// $data["cartItems"] = $cartItems;
		
		
		// $this->load->view('userfront/userrestaurant/cart_view_detail',$data);
	}
}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
