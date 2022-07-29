<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Menu_Timings {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor			
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menutimings_model');	
		}
		
		/**
		* @method This method will return Restaurant timings
		* @params restaurant id will be passed as parameter
		*/
		function listMenuTimingsByRestaurantId($retaurantId,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menutimings_model->getMenuTimingsByRestaurantId($retaurantId,$count,$limit , $offset);
			
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
		function listMenuTimingById($Id)
		{
			$list=$this->_obj->menutimings_model->getMenuTimingById($Id);
			return $list;
		}
		/**
		* @method This method will return menu item details
		* @params item id will be passed as parameter
		*/
		function getAttachedMenuItemTiming($itemId)
		{
			$list=$this->_obj->menutimings_model->getAttachedMenuItemTiming($itemId);
			return $list;
		}

		/*
		Update
		*/
		function updateMenuTiming($arrInfo)
		{
			$list=$this->_obj->menutimings_model->updateMenuTiming($arrInfo);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewMenuTiming($arrInfo)
		{
			$list=$this->_obj->menutimings_model->addNewMenuTiming($arrInfo);
			
			return $list;
		}
		//Attach Menu Timing
		function attachMenuTiming($itemID, $menuTimingId)
		{
			$arrInfo["item_id"]	=	$itemID;
			$arrInfo["menu_timing_id"]	=	$menuTimingId;
			$list=$this->_obj->menutimings_model->attachMenuTiming($arrInfo);
			
			return $list;
		}
		
		function removeMenuTimingAttachment($itemID, $menuTimingId)
		{
			$arrInfo["item_id"]	=	$itemID;
			$arrInfo["menu_timing_id"]	=	$menuTimingId;
			$this->_obj->menutimings_model->removeMenuTimingAttachment($arrInfo);
			
			
		}
	}
?>
