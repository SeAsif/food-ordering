<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class Department_core {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('department_model');	
		}

		/**
		* @method This method will return Restaurant departments
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantDepartments($retaurantId)
		{
			$department_list = $this->_obj->department_model->getAllRestaurantDepartments($retaurantId);
			
			return $department_list;
		}

		/**
		* @method This method will return Restaurant locations
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantlocations($retaurantId)
		{
			$location_list = $this->_obj->department_model->getAllRestaurantlocations($retaurantId);
			
			return $location_list;
		}

		/*
		Add		
		*/
		function addRestaurantDepartment($arrInfo)
		{
			$department_id = $this->_obj->department_model->addRestaurantDepartment($arrInfo);
			
			return $department_id;
		}

		/*
		Update
		*/
		function updateRestaurantDepartment($department_id, $arrInfo)
		{
			$employee = $this->_obj->department_model->updateRestaurantDepartment($department_id, $arrInfo);
			
			return $employee;
		}

		/*
		Get Employee
		*/
		function getRestaurantDepartment($department_id)
		{
			$department_info = $this->_obj->department_model->getRestaurantDepartment($department_id);
			
			return $department_info;
		}

		/*
		Delete Employee
		*/
		function deleteRestaurantLocation($location_id)
		{
			$this->_obj->department_model->deleteRestaurantLocation($location_id);
		}

		
	}
?>
