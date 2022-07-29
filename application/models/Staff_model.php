<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Staff_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

    /**
	* @method This method is returning employees for a Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function listEmployeesByRestaurantId($restaurantId, $filters, $count="No", $limit = NULL, $offset = NULL)
	{
	
		$this->db->where('restaurant_id', $restaurantId);
		$this->db->where('status <>', "Deleted");
		$this->db->where('type', "employee");

		

		if ($filters['name'] != 'all') {
			$name = trim($filters['name']);
			$this->db->group_start();
			$this->db->like('firstname', $name);
 			$this->db->or_like('lastname', $name);
 			$this->db->group_end();
		}

		if ($filters['role'] != 'all') {
			$this->db->where('FIND_IN_SET("'.($filters['role']).'", role_id) > 0', NULL, FALSE);
		}

		$this->db->limit($limit, $offset);

		$this->db->select('*');
		$this->db->from('user');
		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		if ($count	==	"Yes")		
		{
			return $query->num_rows();
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
			}		
			// Return Array
			return $list;
		}
	}

	/**
	* @method This method is returning active roles for a Restaurant 
	* @params Item Id will be passed as parameter
	*/ 

	function getAllRActiveRoles($restaurantId)
	{
	
		$this->db->select('user_role.id');
		$this->db->select('user_role.role_name');
		$this->db->select('user_role.role_color');
		$this->db->select('restaurant_location.location');
		$this->db->select('restaurant_location.address');
		$this->db->select('restaurant_department.department_name');
        $this->db->where('user_role.restaurantID', $restaurantId);
        $this->db->where('user_role.status', 1);

        $this->db->join('restaurant_location',' user_role.location = restaurant_location.id', 'left');
        $this->db->join('restaurant_department','restaurant_department.id = user_role.department', 'left');

        $records_obj = $this->db->get('user_role');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Add		
	*/
	function addNewEmployee($arrInfo)
	{
      	$this->db->insert("user", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateEmployee($employee_id, $arrInfo)
	{
		$this->db->where("id", $employee_id);
		$this->db->set($arrInfo); 
		$this->db->update('user');
	}

	/*
	Get Employee
	*/
	function getRestaurantEmployee($employee_id)
	{
		$this->db->select('*');
        $this->db->where('id', $employee_id);
        $records_obj = $this->db->get('user');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/**
	* @method This method will return role detail
	* @params role id will be passed as parameter
	*/
	function getRestaurantRole($Id)
	{
		$this->db->where('id', $Id);
		
		$query=$this->db->get("user_role");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/*
	Get Restaurant ID
	*/
	function getRestaurantId($employee_id)
	{
		$this->db->select('restaurant_id');
        $this->db->where('id', $employee_id);
        $records_obj = $this->db->get('user');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr['restaurant_id'];
        }

        return $return_data;
	}

	/*
	Get Tracking Log ID
	*/
	function getEmployeeLatestLogID($employee_id, $restaurant_id, $date)
	{
		$this->db->select('id');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('date', $date);
        $this->db->where('check_out', NULL, FALSE);
        $records_obj = $this->db->get('user_tracking');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = 0;

        if (!empty($records_arr)) {
            $return_data = $records_arr['id'];
        }

        return $return_data;
	}

	/*
	Add Employee Log		
	*/
	function insertEmployeeTimeLog($arrInfo)
	{
		$this->db->insert("user_tracking", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update Employee Log
	*/
	function updateEmployeeTimeLog($log_id, $arrInfo)
	{
		$this->db->where("id", $log_id);
		$this->db->set($arrInfo); 
		$this->db->update('user_tracking');
	}

	/*
	Get Tracking Latest Log Data
	*/
	function getEmployeeLatestLogData($employee_id, $restaurant_id, $date)
	{
		$this->db->select('date, check_in');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('date', $date);
        $this->db->where('check_out', NULL, FALSE);
        $records_obj = $this->db->get('user_tracking');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Get Tracking Last Log Data
	*/
	function getEmployeeLastLogData($employee_id, $restaurant_id, $date)
	{
		$this->db->select('date, check_in, check_out');
        $this->db->where('employee_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('date', $date);
        $this->db->order_by('id',"desc");
        $records_obj = $this->db->get('user_tracking');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	 /**
	* @method This method is returning return Staff Time Tracking
	* @params Item Id will be passed as parameter
	*/    
	function getAllSatffTimeTrack($staff_id, $count="No", $limit = NULL, $offset = NULL)
	{
	
		$this->db->where('employee_id', $staff_id);
		$this->db->order_by('id',"desc");
		$this->db->limit($limit, $offset);

		$this->db->select('*');
		$this->db->from('user_tracking');
		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		if ($count	==	"Yes")		
		{
			return $query->num_rows();
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
			}		
			// Return Array
			return $list;
		}
	}

	/*
	Get Staff Schedule
	*/
	function getMySchedule($employee_id, $restaurant_id, $start, $end)
	{
		$this->db->select('day, date, start, end');
        $this->db->where('staff_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('sechdule_status', 1);
        $this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->order_by('date', 'ASC');
        $records_obj = $this->db->get('staff_schedule');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	function getMyScheduleDay($employee_id, $restaurant_id, $date)
	{
		$this->db->select('day, date, start, end');
        $this->db->where('staff_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('sechdule_status', 1);
        $this->db->where('date ', $date);
        $records_obj = $this->db->get('staff_schedule');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Get Staff Employment info
	*/
	function getstaffEmploymentInfo($employee_id)
	{
		$this->db->select('*');
        $this->db->where('user_id', $employee_id);
        $records_obj = $this->db->get('staff_employment_info');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Add	Employment Info	
	*/
	function insertEmploymentInfo($arrInfo)
	{
      	$this->db->insert("staff_employment_info", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update Employment Info
	*/
	function updateEmploymentInfo($employee_id, $arrInfo)
	{
		$this->db->where("user_id", $employee_id);
		$this->db->set($arrInfo); 
		$this->db->update('staff_employment_info');
	}

	/*
	Get Staff Wage info
	*/
	function getstaffWageInfo($employee_id)
	{
		$this->db->select('*');
        $this->db->where('user_id', $employee_id);
        $records_obj = $this->db->get('staff_wages_info');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Add	Wage Info	
	*/
	function insertWageInfo($arrInfo)
	{
      	$this->db->insert("staff_wages_info", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update Wage Info
	*/
	function updateWageInfo($employee_id, $arrInfo)
	{
		$this->db->where("user_id", $employee_id);
		$this->db->set($arrInfo); 
		$this->db->update('staff_wages_info');
	}

	/*
	Check Email already exist in system
	*/
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

	/*
	Get Tracking Log ID
	*/
	function get_check_in_time($employee_id, $restaurant_id, $date)
	{
        
        $this->db->where('employee_id', $employee_id);
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('date', $date);
        $this->db->where('check_out', NULL, FALSE);
        $query = $this->db->get('user_tracking');
        return $query->row();
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

}
?>