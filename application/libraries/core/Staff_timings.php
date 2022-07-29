<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Staff_Timings {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor			
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('stafftimings_model');	
		}
		
		/**
		* @method This method will return Restaurant timings
		* @params restaurant id will be passed as parameter
		*/
		function listStaffTimingsByRestaurantId($retaurantId,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->stafftimings_model->getStaffTimingsByRestaurantId($retaurantId,$count,$limit , $offset);
			
			return $list;
		}

		function getStaffMembersByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->stafftimings_model->getStaffMembersByRestaurantId($restaurantId,$count,$limit , $offset);
			
			return $list;
		}

		/**
		* @method This method will return Restaurant active roles
		* @params restaurant id will be passed as parameter
		*/
		function getAllRActiveRoles($retaurantId)
		{
			$list=$this->_obj->stafftimings_model->getAllRActiveRoles($retaurantId);
			
			return $list;
		}


		/**
		* @method This method will return menu item details
		* @params item id will be passed as parameter
		*/
		function listTimingById($Id)
		{
			$list=$this->_obj->stafftimings_model->listTimingById($Id);
			
			return $list;
		}

		/*
		Update
		*/
		function updateStaffTiming($arrInfo)
		{
			$list=$this->_obj->stafftimings_model->updateStaffTiming($arrInfo);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewStaffTiming($arrInfo)
		{
			$list=$this->_obj->stafftimings_model->addStaffTiming($arrInfo);
			
			return $list;
		}

		/*
		Delete		
		*/
		
		function deleteStaffTiming($id)
		{
			$list=$this->_obj->stafftimings_model->deleteStaffTiming($id);
			
			return $list;
		}
		
		function deleteTimingWholeWeek($staff_id)
		{
			$list=$this->_obj->stafftimings_model->deleteTimingWholeWeek($staff_id);
			
			return $list;
		}

		/*
		Add		
		*/
		function updateNewStaffRole($staff_id, $staff_role)
		{
			$this->_obj->stafftimings_model->updateNewStaffRole($staff_id, $staff_role);
		}

		/**
		* @method This method will return staff schedule info 
		* @params restaurant id will be passed as parameter
		*/
		function getStaffweeklytiming($staff_id)
		{
			$wage_info = $this->_obj->stafftimings_model->getStaffweeklytiming($staff_id);
			
			return $wage_info;
		}

		function updateStaffScheduleTiming ($item, $day, $staff_id) {
			$this->_obj->stafftimings_model->updateStaffScheduleTiming($item, $day, $staff_id);
		}

		function deleteStaffScheduleTiming ($day, $staff_id) {
			$this->_obj->stafftimings_model->deleteStaffScheduleTiming($day, $staff_id);
		}

		function getStaffMembersRoleName($role_id)
		{
			$role_name = $this->_obj->stafftimings_model->getStaffMembersRoleName($role_id);
			
			return $role_name;
		}

		function deactiveAllPreviousSchedule ($staff_id, $restaurant_id) {
			$this->_obj->stafftimings_model->deactiveAllPreviousSchedule($staff_id, $restaurant_id);
		}

		function addNewStaffSchedule ($data_to_insert) {
			$this->_obj->stafftimings_model->addNewStaffSchedule($data_to_insert);
		}

		function getStaffInfo($staff_id)
		{
			$staff_info = $this->_obj->stafftimings_model->getStaffInfo($staff_id);
			
			return $staff_info;
		}

		function getRestaurantMember($staff_id)
		{
			$staff_member = $this->_obj->stafftimings_model->getRestaurantMember($staff_id);
			
			return $staff_member;
		}

		function getRestaurantRoles($role_id)
		{
			$role = $this->_obj->stafftimings_model->getRestaurantRoles($role_id);
			
			return $role;
		}

		function getStaffTotalDuration($staff_id)
		{
			$role = $this->_obj->stafftimings_model->getStaffTotalDuration($staff_id);
			
			return $role;
		}

		/*
		Update Staff Duration
		*/
		function updateStaffDuration($duration, $row_id)
		{
			$this->_obj->stafftimings_model->updateStaffDuration($duration, $row_id);
		}

	}
?>
