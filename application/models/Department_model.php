<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Department_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

	/**
	* @method This method is returning all active manager of Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function getAllRestaurantDepartments($restaurantId)
	{
		$this->db->select('restaurant_department.*');
        $this->db->select('restaurant_location.location');
        $this->db->select('restaurant_location.address');
        $this->db->join('restaurant_location', 'restaurant_location.id = restaurant_department.location_id', 'left');
        $this->db->where('restaurant_department.restaurant_id', $restaurantId);

        $records_obj = $this->db->get('restaurant_department');
        $records_arr = $records_obj->result_array();
        $records_obj->free_result();

        $return_data = array();

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
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

	/*
	Add		
	*/
	function addRestaurantDepartment($arrInfo)
	{
      	$this->db->insert("restaurant_department", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateRestaurantDepartment($department_id, $arrInfo)
	{
		$this->db->where("id", $department_id);
		$this->db->set($arrInfo); 
		$this->db->update('restaurant_department');
	}

	/*
	Get Employee
	*/
	function getRestaurantDepartment($department_id)
	{
		$this->db->select('*');
        $this->db->where('id', $department_id);
        $records_obj = $this->db->get('restaurant_department');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr;
        }

        return $return_data;
	}

	/*
	Delete	
	*/
	function deleteRestaurantLocation($location_id)
	{
      	$this->db->where('id', $location_id);
		$this->db->delete('restaurant_department');  
	}

}
?>