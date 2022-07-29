<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Restaurant_model extends CI_Model
{
	
	/**
		Add	
	*/
	function addNewRestaurant($arrInfo)
	{
		$this->db->insert("restaurant", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateRestaurant($arrInfo)
	{
		unset($arrInfo['timings']);
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('restaurant');
	}

	function getRestaurantBanner($id)
	{

		$this->db->select('banner');
        $this->db->where('id', $id);

        $record_obj = $this->db->get('restaurant');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['banner'];
        } else {
            return array();
        }
	}

	function getRestaurantMobileBanner($id)
	{

		$this->db->select('mobile_banner');
        $this->db->where('id', $id);

        $record_obj = $this->db->get('restaurant');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['mobile_banner'];
        } else {
            return array();
        }
	}

	function updateRestaurantBanner ($data_to_update, $restaurant_id) {
		$this->db->where("id", $restaurant_id);
		$this->db->set($data_to_update); 
		$this->db->update('restaurant');
	}

	/**
		Delete
	*/
	function deleteRestaurant($arrInfo)
	{	
	//	$this->db->where('id',$arrInfo["id"]);
		$this->db->query('update restaurant set status = "Deleted" where id = '.$arrInfo["id"].'');
		$this->db->query('update menu_item set status = "Deleted" where restaurant_id = '.$arrInfo["id"].'');
		$this->db->query('update menu_category set status = "Deleted" where restaurant_id = '.$arrInfo["id"].'');
	//	$this->db->delete('restaurant'); 		
	}

	/**
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getRestaurants($terminalId	=	0,$status="Active",$pickup_time="", $is_favorite="No",$count="No",$limit = NULL, $offset = NULL)
	{
		if ($terminalId	!=	0)
		$this->db->where(array('restaurant.terminal_id'=>$terminalId));
		
		if ($status!="All")
		$this->db->where(array('restaurant.status'=>$status));
		
		if ($pickup_time!="")
		{
//		$this->db->where('1');
			$this->db->where('(start is NULL OR ( time(start)<= "'.$pickup_time.'" AND time(end)>="'.$pickup_time.'"))');
			$this->db->join('restaurant_timing', 'restaurant.id = restaurant_timing.restaurant_id', "left outer");
		}
		if ($is_favorite=="Yes")
		{
			if ($this->session->userdata('id')!="")
			{
				$this->db->where(array('favorite_restaurant.user_id'=>$this->session->userdata('id')));
			
				$this->db->join('favorite_restaurant', 'favorite_restaurant.restaurant_id = restaurant.id');
				
			}
			
//			$this->db->where("1");
			
		}
		$this->db->limit($limit, $offset);

		$this->db->select('restaurant.*');
		$this->db->from('restaurant');

		$query=$this->db->get();
//		print_r($query);
		//Return Disabled in case of not matching in menu timings....
//		$query=$this->db->get("restaurant");

		// Declare Array to pass data
		$list = array();
		if ($count	==	"Yes")		
		{
			return $query->num_rows();
		}else
		{

			
			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
			}		
		}	
		// Return Array
		return $list;
	}
	/**
	Restaurant Timing Authentication
	**/
	function restaurantTimeAuthentication($restaurantId, $pickup_time)
	{
		$this->db->where(array('restaurant.id'=>$restaurantId));

		$this->db->where('(start is NULL OR ( time(start)<= "'.$pickup_time.'" AND time(end)>="'.$pickup_time.'"))');
			$this->db->join('restaurant_timing', 'restaurant.id = restaurant_timing.restaurant_id', "left outer");
		$this->db->select('restaurant.*');
		$this->db->from('restaurant');

		$query=$this->db->get();
		
		// Declare Array to pass data
		$list = array();
		
		if ($query->num_rows() > 0)
		{
			$list["response"]="Available";
		}else{
			$list["response"]="Not Available";
		}	
		
		return $list;
	}
	/**
	* @method This method will return restaurant's full details
	* @params Terminal Id will be passed as parameter
	*/
	function getRestaurantById($restaurantId,$status="Active")
	{
		$this->db->where(array('id'=>$restaurantId));

		if ($status	!=	"All")
			$this->db->where(array('status'=>$status));
		
		$query=$this->db->get("restaurant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$this->db->select('*')
			->from('restaurant_timing')
			->where('restaurant_id', $row['id']);
			$timings = $this->db->get()->result_array();
			$row['timings'] = $timings;
			return $row;
		}	
		// Return Array
		return $list;
	}

	/**
	* @method This method will return restaurant's full details
	* @params Terminal Id will be passed as parameter
	*/
	function getRestaurantByName($restaurantName,$status="Active")
	{
		$this->db->where(array('restaurant_name'=>$restaurantName));

		if ($status	!=	"All")
			$this->db->where(array('status'=>$status));
		
		$query=$this->db->get("restaurant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$this->db->select('*')
			->from('restaurant_timing')
			->where('restaurant_id', $row['id']);
			$timings = $this->db->get()->result_array();
			$row['timings'] = $timings;
			return $row;
		}	
		// Return Array
		return $list;
	}
	/**
	* @method This method will return restaurant's full details
	* @params Terminal Id will be passed as parameter
	*/
	function getRestaurantByUserId($userId,$status="Active")
	{
		$this->db->where(array('user_id'=>$userId));

		if ($status	!=	"All")
			$this->db->where(array('status'=>$status));
		
		$query=$this->db->get("restaurant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method This method will return restaurant's full details
	* @params Terminal Id will be passed as parameter
	*/
	function getRestaurantByRestaurantId($restaurantId,$status="Active")
	{
		$this->db->where(array('id'=>$restaurantId));

		if ($status	!=	"All")
			$this->db->where(array('status'=>$status));
		
		$query=$this->db->get("restaurant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return $list;
	}

	function getRestaurantByIdWithTerminal($restaurantId,$status="Active")
	{
		$this->db->where(array('restaurant.id'=>$restaurantId));

		if ($status	!=	"All")
			$this->db->where(array('restaurant.status'=>$status));
		
		$this->db->select('restaurant.*');
		$this->db->from('restaurant');
		//$this->db->join('airport_terminal', 'airport_terminal.id = restaurant.terminal_id');
		$query=$this->db->get();
//		$query=$this->db->get("restaurant");
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return $list;
	}
	/**
	* @method This method will return User's Payment Prefrences 
	* @params User Id will be passed as parameter
	*/
	function login($arrInfo)
	{
		$this->db->where(array('email'=>$arrInfo['email']));
		$this->db->where(array('password'=>$arrInfo['password']));
		// $this->db->where(array('type'=>"restaurantowner"));
		
		$query=$this->db->get("user");
		
		$count	=	$query->num_rows();
		// Declare Array to pass data
		$list = array();
		
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('type');
		// $this->session->unset_userdata('sessionData');

		if ($count > 0)
		{
			$row = $query->row();
			$sessionData["fullname"]=$row->firstname." ".$row->lastname;
			$sessionData["email"]=$arrInfo['email'];
			$sessionData["id"]=$row->id;

			if ($row->type == "restaurantowner") {
				$sessionData["type"] = "restaurant";
				$sessionData["restaurant"] =	$this->getRestaurantByUserId($row->id);
			} else if ($row->type == "employee") {
				if ($row->status == "Active") {
					$sessionData["type"]="employee";
					if ($row->is_manager == 1) {
						$sessionData["restaurant"] = $this->getRestaurantByRestaurantId($row->restaurant_id);
						$sessionData["employee_type"] = "manager";
					} else {
						$sessionData["employee_type"] = "staff";
					}
				} else {
					$list = "Inactive";
					return $list;
				}		
			}
			
			
			$this->session->set_userdata($sessionData);
			$list	=	$sessionData;
		}
		else
		{		
			$list = "Login_Error";
			return $list;
		}
		return $list;
	}
	
/*	function verifyEmail($arrInfo)
	{
		$this->db->where(array('email'=>$arrInfo['email']));
//		$this->db->where(array('password'=>$arrInfo['password']));
//		$this->db->where(array('type'=>"restaurantowner"));
		
		$query=$this->db->get("user");
		
		$count	=	$query->num_rows();
		// Declare Array to pass data
		$list = array();
		
//		$this->session->unset_userdata('email');
//		$this->session->unset_userdata('id');
//		$this->session->unset_userdata('type');
//		$this->session->unset_userdata('sessionData');
		if ($count > 0)
		{
			$row = $query->row();
		//	$sessionData["fullname"]=$row->firstname." ".$row->lastname;
			$list["email"]=$arrInfo['email'];
		//	$sessionData["id"]=$row->id;
		//	$sessionData["type"]="restaurant";
		//	$sessionData["restaurant"]=	$this->getRestaurantByUserId($row->id);
			
		//	$this->session->set_userdata($sessionData);
		//	$list	=	$sessionData;
			$token = md5(uniqid(""));
			$this->db->insert("security_code", $token);
			
		}
		else
		{		
			$list = "Login_Error";
			return $list;
		}
		return $list;
	}*/

	function addNewSubscriptionPlan($arrInfo)
	{
      	$this->db->insert("subscription_plans", $arrInfo);  
		return $this->db->insert_id();
	}

	function updateSubscriptionPlane ($id, $data_to_update) {
		$this->db->where("id", $id);
		$this->db->set($data_to_update); 
		$this->db->update('subscription_plans');
	}

	function addNewSubscription($arrInfo)
	{
      	$this->db->insert("subscriptions", $arrInfo);  
		return $this->db->insert_id();
	}

	function updateSubscription ($id, $data_to_update) {
		$this->db->where("id", $id);
		$this->db->set($data_to_update); 
		$this->db->update('subscriptions');
	}

	function updateCustumerPaystackId ($email, $data_to_update) {
		$this->db->where("email", $email);
		$this->db->set($data_to_update); 
		$this->db->update('restaurant');
	}

	function getSubscriptionById($restaurantId)
	{
		$this->db->where('restauran_id', $restaurantId);
		
		$query=$this->db->get("subscriptions");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return $list;
	}

	function getSubscriptionPlanCode($category)
	{

		$this->db->select('plan_code');
        $this->db->where('category', $category);

        $record_obj = $this->db->get('subscription_plans');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['plan_code'];
        } else {
            return '';
        }
	}

	function getSubscriptionPlanPrice($category)
	{

		$this->db->select('price');
        $this->db->where('category', $category);

        $record_obj = $this->db->get('subscription_plans');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['price'];
        } else {
            return '';
        }
	}

	function checkSubscriptionPlan($category)
	{

		$this->db->select('id');
        $this->db->where('category', $category);

        $record_obj = $this->db->get('subscription_plans');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['id'];
        } else {
            return '';
        }
	}

	function updateSubscriptionEvent ($subscription_code, $data_to_update) {
		$this->db->where("subscription_code", $subscription_code);
		$this->db->set($data_to_update); 
		$this->db->update('subscriptions');
	}

	function getRestaurantSecretKey($id)
	{

		$this->db->select('paystack_secret_key, flutterwave_secret_key, payment_gateway');
        $this->db->where('id', $id);

        $record_obj = $this->db->get('restaurant');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0];
        } else {
            return '';
        }
	}

	function getActiveRestaurants($status="Active",$limit = NULL, $offset = NULL)
	{
		if ($status!="All")
		$this->db->where(array('restaurant.status'=>$status));
		
		$this->db->limit($limit, $offset);

		$this->db->select('restaurant.restaurant_name,restaurant.logo,restaurant.address,restaurant.id');
		$this->db->from('restaurant');

		$query=$this->db->get();
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		

		return $list;
	}

	function isEmailAlreadyExist($email)
	{

		$this->db->select('id');
        $this->db->where('email', $email);

        $record_obj = $this->db->get('user');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr;
        } else {
            return array();
        }
	}

	function getRestaurantCoupon ($restaurantId, $status)
	{

		$this->db->select('*');
        $this->db->where('restaurant_id', $restaurantId);
        $this->db->where('status', 'Active');
        $this->db->where('is_home_page', 'Public');
       
        $this->db->group_start();
  		$this->db->where('end_date > ', date('Y-m-d'));
 		$this->db->or_where('is_default', 1);
   		$this->db->group_end();

        $record_obj = $this->db->get('coupons');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr;
        } else {
            return array();
        }
	}
}
?>
