<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Restaurant {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('restaurant_model');	
		
		}
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function listRestaurant($terminalId=0,$status="Active", $pickup_time="",$is_favorite="No",$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->restaurant_model->getRestaurants($terminalId,$status,$pickup_time,$is_favorite,$count,$limit, $offset);
			
			return $list;
		}
		function getActiveRestaurants($status="Active",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->restaurant_model->getActiveRestaurants($status,$limit, $offset);			
			return $list;
		}
		

		/**
		* @method This method will return restaurants details
		* @params restaurant id will be passed as parameter
		*/
		function listRestaurantById($restaurantId,$status="Active")
		{
			$list=$this->_obj->restaurant_model->getRestaurantById($restaurantId,$status);
			return $list;
		}

		/**
		* @method This method will return restaurants details
		* @params restaurant id will be passed as parameter
		*/
		function listRestaurantByName($restaurantName,$status="Active")
		{
			$list=$this->_obj->restaurant_model->getRestaurantByName($restaurantName,$status);
			return $list;
		}
		/**
		* @method This method will return restaurants details
		* @params restaurant id will be passed as parameter
		*/
		function getRestaurantByIdWithTerminal($restaurantId,$status="Active")
		{
			$list=$this->_obj->restaurant_model->getRestaurantByIdWithTerminal($restaurantId,$status);
			
			return $list;
		}
		function restaurantTimeAuthentication($restaurantId, $pickup_time)
		{
			
			if ($restaurantId == "")
			{
				return $list["response"]="RESTAURANTID_REQUIRED";
				
			}
			else if ($pickup_time == "")
			{
				return $list["response"]="PICKUPTIME_REQUIRED";
			}
			
			$list=$this->_obj->restaurant_model->restaurantTimeAuthentication($restaurantId,$pickup_time);
			return $list;
		}
		
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function addRestaurant($arrInfo)
		{
			
			$list=$this->_obj->restaurant_model->addNewRestaurant($arrInfo);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function updateRestaurant($arrInfo)
		{
			$list=$this->_obj->restaurant_model->updateRestaurant($arrInfo);
			return $list;
		}

		function updateRestaurantBanner($data_to_update, $restaurant_id)
		{
			$list=$this->_obj->restaurant_model->updateRestaurantBanner($data_to_update, $restaurant_id);
			return $list;
		}

		function getRestaurantBanner($id)
		{
			$list=$this->_obj->restaurant_model->getRestaurantBanner($id);
			return $list;
		}

		function getRestaurantMobileBanner($id)
		{
			$list=$this->_obj->restaurant_model->getRestaurantMobileBanner($id);
			return $list;
		}
		
		function addDefaultVariantToRestaurant($variants,$restaurantID)
		{
			$this->_obj->load->model('menuitemvariant_model');	

			foreach ($variants as $variant)
			{
				$arrInfo["name"]	=	$variant["name"];
				$arrInfo["price"]	=	$variant["price"];
				$arrInfo["restaurant_id"]	=	$restaurantID;
				$arrInfo["status"]	=	$variant["status"];
				$this->_obj->menuitemvariant_model->addNewMenuItemVariant($arrInfo);
			
			}
		}
		/**
		* @method This method will search restaurants
		* @params 
		*/
		function search()
		{
			$list=$this->_obj->restaurant_model->getRestaurants($arrfilters);
							
			return $list;
		}
		
		/**
		* @method This method will login a user
		* @params array of username and password
		*/
		
		function login($arrInfo)
		{
			$list=$this->_obj->restaurant_model->login($arrInfo);
							
			return $list;
		}
		/**
		* @method This method will logout
		* @params array of username and password
		*/
		function logout()
		{
			$this->session->sess_destroy();
		}
	/*	function verifyEmail($arrInfo)
		{
			$list=$this->_obj->restaurant_model->verifyEmail($arrInfo);
							
			return $list;
		}*/
		
		function deleteRestaurant($arrInfo)
		{
			$this->_obj->restaurant_model->deleteRestaurant($arrInfo);
		}

		function addSubscriptionPlane($arrInfo) {
			$id = $this->_obj->restaurant_model->addNewSubscriptionPlan($arrInfo);
			return $id;
		}

		function updateSubscriptionPlane($id, $arrInfo) {
			$id = $this->_obj->restaurant_model->updateSubscriptionPlane($id, $arrInfo);
			return $id;
		}

		function addSubscription($arrInfo) {
			$id = $this->_obj->restaurant_model->addNewSubscription($arrInfo);
			return $id;
		}

		function updateSubscription ($id, $data_to_update) {
			$this->_obj->restaurant_model->updateSubscription($id, $data_to_update);
		}

		function getSubscription ($restaurantId) {
			$record = $this->_obj->restaurant_model->getSubscriptionById($restaurantId);			
			return $record;
		}

		function addCustumerPaystackId ($email, $data_to_update) {
			$this->_obj->restaurant_model->updateCustumerPaystackId($email, $data_to_update);
		}

		function updateSubscriptionEvent ($subscription_code, $data_to_update) {
			$this->_obj->restaurant_model->updateSubscriptionEvent($subscription_code, $data_to_update);
		}

		function getSubscriptionPlanCode ($category) {
			$code = $this->_obj->restaurant_model->getSubscriptionPlanCode($category);			
			return $code;
		}

		function getSubscriptionPlanPrice ($category) {
			$code = $this->_obj->restaurant_model->getSubscriptionPlanPrice($category);			
			return $code;
		}

		function checkSubscriptionPlan ($category) {
			$id = $this->_obj->restaurant_model->checkSubscriptionPlan($category);			
			return $id;
		}

		function getRestaurantSecretKey ($restaurantId) {
			$secretKey = $this->_obj->restaurant_model->getRestaurantSecretKey($restaurantId);			
			return $secretKey;
		}

		function isEmailAlreadyExist ($email) {
			$result = $this->_obj->restaurant_model->isEmailAlreadyExist($email);			
			return $result;
		}

		function getRestaurantCoupon ($restaurantId, $status="Active") {
			$couponList = $this->_obj->restaurant_model->getRestaurantCoupon($restaurantId, $status);			
			return $couponList;
		}
	}
?>
