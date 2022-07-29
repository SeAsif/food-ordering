<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Location_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

	/**
	* @method This method is returning all active manager of Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function getAllRestaurantManager($restaurantId)
	{
	
		$this->db->select('id, firstname, lastname');
        $this->db->where('restaurant_id', $restaurantId);
        $this->db->where('status', "Active");
        $this->db->where('is_manager', 1);
        $records_obj = $this->db->get('user');
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
	function addRestaurantLocation($arrInfo)
	{
      	$this->db->insert("restaurant_location", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateRestaurantLocation($location_id, $arrInfo)
	{
		$this->db->where("id", $location_id);
		$this->db->set($arrInfo); 
		$this->db->update('restaurant_location');
	}

	/*
	Get Employee
	*/
	function getRestaurantLocation($location_id)
	{
		$this->db->select('*');
        $this->db->where('id', $location_id);
        $records_obj = $this->db->get('restaurant_location');
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
		$this->db->delete('restaurant_location');  
	}

}
?>