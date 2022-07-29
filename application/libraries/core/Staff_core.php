<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class Staff_core {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('staff_model');	
		}

		/**
		* @method This method will return Restaurant employees
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantEmployee($retaurantId, $filters, $count="No", $limit = NULL, $offset = NULL)
		{
			$employee_list = $this->_obj->staff_model->listEmployeesByRestaurantId($retaurantId, $filters, $count, $limit , $offset);
			
			return $employee_list;
		}

		/**
		* @method This method will return Restaurant active roles
		* @params restaurant id will be passed as parameter
		*/
		function getAllRActiveRoles($retaurantId)
		{
			$list=$this->_obj->staff_model->getAllRActiveRoles($retaurantId);
			
			return $list;
		}

		/*
		Add		
		*/
		function addNewEmployee($arrInfo)
		{
			$employee=$this->_obj->staff_model->addNewEmployee($arrInfo);
			
			return $employee;
		}

		/*
		Update
		*/
		function updateEmployee($employee_id, $arrInfo)
		{
			$employee = $this->_obj->staff_model->updateEmployee($employee_id, $arrInfo);
			
			return $employee;
		}

		/*
		Get Employee
		*/
		function getRestaurantEmployee($employee_id)
		{
			$employee = $this->_obj->staff_model->getRestaurantEmployee($employee_id);
			
			return $employee;
		}

		/*
		Delete Employee
		*/
		function deleteRestaurantEmployee($role_id, $restaurant_id)
		{
			$this->_obj->staff_model->deleteRestaurantEmployee($role_id, $restaurant_id);
		}

		/*
		Get Restaurant ID
		*/
		function getRestaurantId($employee_id)
		{
			$restaurant_id = $this->_obj->staff_model->getRestaurantId($employee_id);
			
			return $restaurant_id;
		}

		/*
		Get Tracking Log ID
		*/
		function getEmployeeLatestLogID($employee_id, $restaurant_id, $date)
		{
			$log_id = $this->_obj->staff_model->getEmployeeLatestLogID($employee_id, $restaurant_id, $date);
			
			return $log_id;
		}

		/*
		Add Employee Log		
		*/
		function insertEmployeeTimeLog($arrInfo)
		{
			$log_id = $this->_obj->staff_model->insertEmployeeTimeLog($arrInfo);
			
			return $log_id;
		}

		/*
		Update Employee Log
		*/
		function updateEmployeeTimeLog($log_id, $arrInfo)
		{
			$this->_obj->staff_model->updateEmployeeTimeLog($log_id, $arrInfo);
		}

		/*
		Get Tracking Latest Log Data
		*/
		function getEmployeeLatestLogData($employee_id, $restaurant_id, $date)
		{
			$log_data = $this->_obj->staff_model->getEmployeeLatestLogData($employee_id, $restaurant_id, $date);
			
			return $log_data;
		}

		/*
		Get Tracking Latest Log Data
		*/
		function getEmployeeLastLogData($employee_id, $restaurant_id, $date)
		{
			$log_data = $this->_obj->staff_model->getEmployeeLastLogData($employee_id, $restaurant_id, $date);
			
			return $log_data;
		}

		/**
		* @method This method will return Staff Time Tracking
		* @params restaurant id will be passed as parameter
		*/
		function getAllSatffTimeTrack($staff_id, $count="No", $limit = NULL, $offset = NULL)
		{
			$employee_list = $this->_obj->staff_model->getAllSatffTimeTrack($staff_id, $count, $limit , $offset);
			
			return $employee_list;
		}

		/**
		* @method This method will return Staff Schedule
		* @params restaurant id will be passed as parameter
		*/
		function getMySchedule($employee_id, $restaurant_id, $start, $end)
		{
			$schedule_list = $this->_obj->staff_model->getMySchedule($employee_id, $restaurant_id, $start, $end);
			
			return $schedule_list;
		}

		/**
		* @method This method will return Staff Schedule
		* @params restaurant id will be passed as parameter
		*/
		function getMyScheduleDay($employee_id, $restaurant_id, $date)
		{
			$schedule_day = $this->_obj->staff_model->getMyScheduleDay($employee_id, $restaurant_id, $date);
			
			return $schedule_day;
		}

		/**
		* @method This method will return staff employment info
		* @params restaurant id will be passed as parameter
		*/
		function getstaffEmploymentInfo($employee_id)
		{
			$employment_info = $this->_obj->staff_model->getstaffEmploymentInfo($employee_id);
			
			return $employment_info;
		}

		/*
		Add	Employment Info	
		*/
		function insertEmploymentInfo($arrInfo)
		{
			$this->_obj->staff_model->insertEmploymentInfo($arrInfo);
		}

		/*
		Update Employment Info
		*/
		function updateEmploymentInfo($employee_id, $arrInfo)
		{
			$this->_obj->staff_model->updateEmploymentInfo($employee_id, $arrInfo);
		}

		/**
		* @method This method will return staff wage info 
		* @params restaurant id will be passed as parameter
		*/
		function getstaffWageInfo($employee_id)
		{
			$wage_info = $this->_obj->staff_model->getstaffWageInfo($employee_id);
			
			return $wage_info;
		}

		/*
		Add	Wage Info	
		*/
		function insertWageInfo($arrInfo)
		{
			$this->_obj->staff_model->insertWageInfo($arrInfo);
		}

		/*
		Update Wage Info
		*/
		function updateWageInfo($employee_id, $arrInfo)
		{
			$this->_obj->staff_model->updateWageInfo($employee_id, $arrInfo);
		}

		/*
		Check Email already exist in system
		*/
		function isEmailAlreadyExist ($email) {
			$result = $this->_obj->staff_model->isEmailAlreadyExist($email);			
			return $result;
		}

		/*
		Check Email already exist in system
		*/
		function get_checkintime ($employee_id,$restaurant_id,$date) {
			$result = $this->_obj->staff_model->get_check_in_time($employee_id,$restaurant_id,$date);			
			return $result;
		}

		
		function getRestaurantByRestaurantId ($restaurantId) {
			$result = $this->_obj->staff_model->getRestaurantByRestaurantId($restaurantId);			
			return $result;
		}
	}
?>
