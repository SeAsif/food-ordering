<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class Location_core {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('location_model');	
		}

		/**
		* @method This method will return Restaurant employees
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantManager($retaurantId)
		{
			$manager_list = $this->_obj->location_model->getAllRestaurantManager($retaurantId);
			
			return $manager_list;
		}

		/**
		* @method This method will return Restaurant locations
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantlocations($retaurantId)
		{
			$location_list = $this->_obj->location_model->getAllRestaurantlocations($retaurantId);
			
			return $location_list;
		}

		/*
		Add		
		*/
		function addRestaurantLocation($arrInfo)
		{
			$employee=$this->_obj->location_model->addRestaurantLocation($arrInfo);
			
			return $employee;
		}

		/*
		Update
		*/
		function updateRestaurantLocation($location_id, $arrInfo)
		{
			$employee = $this->_obj->location_model->updateRestaurantLocation($location_id, $arrInfo);
			
			return $employee;
		}

		/*
		Get Employee
		*/
		function getRestaurantLocation($location_id)
		{
			$location = $this->_obj->location_model->getRestaurantLocation($location_id);
			
			return $location;
		}

		/*
		Delete Employee
		*/
		function deleteRestaurantLocation($location_id)
		{
			$this->_obj->location_model->deleteRestaurantLocation($location_id);
		}

		
	}
?>
