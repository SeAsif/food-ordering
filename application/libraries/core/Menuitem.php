<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class MenuItem {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor			
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menuitem_model');	
		}
		
		/**
		* @method This method will return menu items for restaurant
		* @params restaurant id will be passed as parameter
		*/
		function listMenuItemByRestaurantId($retaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menuitem_model->getMenuItemsByRestaurantId($retaurantId,$filters,$count,$limit , $offset);
			
			return $list;
		}

		function menuItemTimingAuthentication($itemId, $pickup_time)
		{
			
			if ($itemId == "")
			{
				return $list["response"]="ITEMID_REQUIRED";
				
			}
			else if ($pickup_time == "")
			{
				return $list["response"]="PICKUPTIME_REQUIRED";
			}
			
			$list=$this->_obj->menuitem_model->menuItemTimingAuthentication($itemId,$status);
			return $list;
		}
		/**
		* @method This method will return menu items against category
		* @params category id will be passed as parameter
		*/
		function listMenuItemByCategoryId($catId)
		{
			$list=$this->_obj->menuitem_model->getMenuItemsByRestaurantId($catId);
			
			return $list;
		}

		/**
		* @method This method will return menu item details
		* @params item id will be passed as parameter
		*/
		function listMenuItemById($Id)
		{
			$list=$this->_obj->menuitem_model->getMenuItemById($Id);
			
			return $list;
		}

		/*
		Update
		*/
		function updateMenuItem($arrInfo)
		{
			$list=$this->_obj->menuitem_model->updateMenuItem($arrInfo);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewMenuItem($arrInfo)
		{
			$list=$this->_obj->menuitem_model->addNewMenuItem($arrInfo);
			
			return $list;
		}
	}
?>
