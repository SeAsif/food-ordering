<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Stafftimings_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }


	/*
	Add		
	*/
	
	function addStaffTiming($arrInfo)
	{
      	$this->db->insert("staff_timing", $arrInfo);  
		$nInsertId	=	$this->db->insert_id();

	}

	/*
	Update
	*/
	function updateStaffTiming($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('staff_timing');
	}

	/*
	Delete
	*/
	function deleteStaffTiming($id)
	{
		$this->db->where(array("id"=>$id));
		$this->db->delete('staff_timing');
	}

	function deleteTimingWholeWeek($staff_id)
	{
		$this->db->where(array("staff_id"=>$staff_id));
		$this->db->delete('staff_timing');
	}

	function updateNewStaffRole($staff_id, $staff_role)
	{
		$this->db->select('role_id');
        $this->db->where('id', $staff_id);
        $record_obj = $this->db->get('user');
        $record_arr = $record_obj->row_array();
        $record_obj->free_result();

        $return_data = array();

        if (!empty($record_arr)) {
        	$role_id = '';
            if ($record_arr['role_id'] == 0) {
            	$role_id = $staff_role;
            } else {
            	$old_roles = explode(',', $record_arr['role_id']);
            	if (!in_array($staff_role, $old_roles)) {
            		array_push($old_roles, $staff_role);
            	}
            	$role_id = implode(',', $old_roles);
            }

            $this->db->set('role_id', $role_id);
        	$this->db->where('id', $staff_id);
        	$this->db->update('user');
        } 
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function getStaffTimingsByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
	
		$this->db->where(array('user.restaurant_id'=>$restaurantId));

		$this->db->limit($limit, $offset);

		$this->db->select('staff_timing.*,user.firstname,user.lastname,user.email');
		$this->db->from('staff_timing');
		$this->db->join('user', 'user.id = staff_timing.staff_id');
		$this->db->order_by('staff_timing.staff_id','asc');
		$this->db->order_by('staff_timing.id','asc');
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

	function getStaffMembersByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
	
		$this->db->where(array('user.restaurant_id'=>$restaurantId));
		$this->db->where(array('user.type'=>'employee'));
		$this->db->where(array('user.status'=>'Active'));

		$this->db->limit($limit, $offset);

		$this->db->select('user.id,user.firstname,user.lastname,user.email,user.role_id,user.profile_picture');
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

	function getRestaurantRoles($role_id)
	{
	
		$this->db->select('user_role.id');
		$this->db->select('user_role.role_name');
		$this->db->select('user_role.role_color');
		$this->db->select('restaurant_location.location');
		$this->db->select('restaurant_location.address');
		$this->db->select('restaurant_department.department_name');
        $this->db->where('user_role.id', $role_id);

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

	/**
	* @method This method is returning active roles for a Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function getStaffMembersRoleName($role_id)
	{
	
		$this->db->select('role_name');
        $this->db->where_in('id', $role_id);
        $this->db->where('status', 1);
        $records_obj = $this->db->get('user_role');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}
	
	/**
	* @method This method will return specific menu item details 
	* @params Item Id will be passed as parameter
	*/
	function listTimingById($Id)
	{
		$this->db->where(array('id'=>$Id));
		$query=$this->db->get("staff_timing");	

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}

	/*
	Get Staff Schedule info
	*/
	function getStaffweeklytiming($staff_id)
	{
		$this->db->select('id, start, end, day, staff_note, time_duration');
        $this->db->where('staff_id', $staff_id);
        $records_obj = $this->db->get('staff_timing');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	function updateStaffScheduleTiming ($item, $day, $staff_id) {
		$this->db->where("staff_id", $staff_id);
		$this->db->where("day", $day);
		$this->db->set($item); 
		$this->db->update('staff_timing');
	}

	/*
	Delete
	*/
	function deleteStaffScheduleTiming($day, $staff_id)
	{
		$this->db->where("staff_id", $staff_id);
		$this->db->where("day", $day);
		$this->db->delete('staff_timing');
	}

	/*
	Update
	*/
	function deactiveAllPreviousSchedule($staff_id, $restaurant_id)
	{
		$this->db->where("staff_id",$staff_id);
		$this->db->where("restaurant_id",$restaurant_id);
		$this->db->set('sechdule_status', 0); 
		$this->db->update('staff_schedule');
	}

	/*
	Add New Staff Schedule
	*/
	
	function addNewStaffSchedule($data_to_insert)
	{
      	$this->db->insert("staff_schedule", $data_to_insert);  
	}

	/*
	Get Staff Info
	*/
	function getStaffInfo($staff_id)
	{
		$this->db->select('firstname, lastname, email');
        $this->db->where('id', $staff_id);
        $records_obj = $this->db->get('user');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Get Resturant member 
	*/
	function getRestaurantMember($staff_id)
	{
		$this->db->select('id, firstname, lastname, email, role_id, profile_picture');
        $this->db->where('id', $staff_id);
        $records_obj = $this->db->get('user');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Get Staff Timing Duration
	*/
	function getStaffTotalDuration($staff_id)
	{
		$this->db->select('time_duration');
        $this->db->where('staff_id', $staff_id);
        $records_obj = $this->db->get('staff_timing');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = 0;

        if (!empty($records_arr)) {
        	foreach ($records_arr as $time) {
        		$return_data = $return_data + $time['time_duration'];
        	}
        }

        return $return_data;
	}

	/*
	Update Staff Duration
	*/
	function updateStaffDuration($duration, $row_id)
	{
		$data_to_update['time_duration'] = $duration;
		$this->db->where("id", $row_id);
		$this->db->set($data_to_update); 
		$this->db->update('staff_timing');
	}
}
?>
