<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Restaurant_Timings {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor			
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('restauranttimings_model');	
		}
		
		/**
		* @method This method will return Restaurant timings
		* @params restaurant id will be passed as parameter
		*/
		function listRestaurantTimingsByRestaurantId($retaurantId,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->restauranttimings_model->getRestaurantTimingsByRestaurantId($retaurantId,$count,$limit , $offset);
			
			return $list;
		}


		/**
		* @method This method will return menu item details
		* @params item id will be passed as parameter
		*/
		function listTimingById($Id)
		{
			$list=$this->_obj->restauranttimings_model->listTimingById($Id);
			
			return $list;
		}

		/*
		Update
		*/
		function updateRestaurantTiming($arrInfo)
		{
			$list=$this->_obj->restauranttimings_model->updateRestaurantTiming($arrInfo);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewRestaurantTiming($arrInfo)
		{
			$list=$this->_obj->restauranttimings_model->addRestaurantTiming($arrInfo);
			
			return $list;
		}

				/*
		Delete		
		*/
		
		function deleteRestaurantTiming($restaurant_id,$id)
		{
			$list=$this->_obj->restauranttimings_model->deleteRestaurantTiming($restaurant_id,$id);
			
			return $list;
		}
	}
?>
