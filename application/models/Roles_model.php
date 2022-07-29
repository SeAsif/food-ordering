<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Roles_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

	/**
	* @method This method is returning roles for a Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function listRoleByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->select('user_role.*');
        $this->db->select('restaurant_location.location');
        $this->db->select('restaurant_location.address');
        $this->db->select('restaurant_department.department_name');
        $this->db->join('restaurant_location', 'restaurant_location.id = user_role.location', 'left');
        $this->db->join('restaurant_department', 'restaurant_department.id = user_role.department', 'left');
        $this->db->where('user_role.restaurantID', $restaurantId);

        $records_obj = $this->db->get('user_role');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	
		$this->db->where('restaurantID', $restaurantId);

		$this->db->limit($limit, $offset);

		$this->db->select('*');
		$this->db->from('user_role');
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
	* @method This method is returning all restaurant locations
	* @params Item Id will be passed as parameter
	*/    
	function getAllRestaurantlocations($restaurantId)
	{
	
		$this->db->select('id, location, address');
        $this->db->where('restaurant_id', $restaurantId);
        $records_obj = $this->db->get('restaurant_location');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/**
	* @method This method is returning all restaurant department for specific location
	* @params Item Id will be passed as parameter
	*/    
	function getRestaurantlocationDepartments($location_id)
	{
	
		$this->db->select('id, department_name');
        $this->db->where('location_id', $location_id);
        $records_obj = $this->db->get('restaurant_department');
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
	function addNewRole($arrInfo)
	{
      	$this->db->insert("user_role", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateRole($role_id, $arrInfo)
	{
		$this->db->where("id", $role_id);
		$this->db->set($arrInfo); 
		$this->db->update('user_role');
	}

	/*
	Delete	
	*/
	function deleteRestaurantRole($role_id)
	{
      	$this->db->where('id', $role_id);
		$this->db->delete('user_role');  
	}

	/**
	* @method This method will return role detail
	* @params role id will be passed as parameter
	*/
	function getRestaurantRole($role_id)
	{
		$this->db->select('*');
        $this->db->where('id', $role_id);
        $records_obj = $this->db->get('user_role');
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
	function getDepartmentRoles($department_id)
	{
		$this->db->select('*');
        $this->db->where('department', $department_id);
        $records_obj = $this->db->get('user_role');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

}
?>