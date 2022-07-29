<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class Roles_core {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('roles_model');	
		}

		/**
		* @method This method will return Restaurant roles
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantRoles($retaurantId, $count="No", $limit = NULL, $offset = NULL)
		{
			$roles_list=$this->_obj->roles_model->listRoleByRestaurantId($retaurantId, $count, $limit , $offset);
			
			return $roles_list;
		}

		/**
		* @method This method will return Restaurant locations
		* @params restaurant id will be passed as parameter
		*/
		function getAllRestaurantlocations($retaurantId)
		{
			$location_list = $this->_obj->roles_model->getAllRestaurantlocations($retaurantId);
			
			return $location_list;
		}

		/**
		* @method This method will return Restaurant Specific Departments
		* @params restaurant id will be passed as parameter
		*/
		function getRestaurantlocationDepartments($location_id)
		{
			$department_list = $this->_obj->roles_model->getRestaurantlocationDepartments($location_id);
			
			return $department_list;
		}



		/*
		Add Role		
		*/
		function addNewRole($arrInfo)
		{
			$role_id = $this->_obj->roles_model->addNewRole($arrInfo);
			
			return $role_id;
		}

		/*
		Update Role
		*/
		function updateRole($role_id, $arrInfo)
		{
			$this->_obj->roles_model->updateRole($role_id, $arrInfo);
		}

		/*
		Get Role
		*/
		function getRestaurantRole($role_id)
		{
			$role = $this->_obj->roles_model->getRestaurantRole($role_id);
			
			return $role;
		}

		/*
		Delete Role
		*/
		function deleteRestaurantRole($role_id)
		{
			$this->_obj->roles_model->deleteRestaurantRole($role_id);
		}

		/*
		Get Department Roles
		*/
		function getDepartmentRoles($department_id)
		{
			$roles_list = $this->_obj->roles_model->getDepartmentRoles($department_id);
			return $roles_list;
		}

		
	}
?>
