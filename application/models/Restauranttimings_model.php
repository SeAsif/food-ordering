<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Restauranttimings_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addRestaurantTiming($arrInfo)
	{
      	$this->db->insert("restaurant_timing", $arrInfo);  
		$nInsertId	=	$this->db->insert_id();

	}

	/*
	Update
	*/
	function updateRestaurantTiming($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('restaurant_timing');
	}

	/*
	Delete
	*/
	function deleteRestaurantTiming($restaurant_id,$id)
	{
		$this->db->where(array("restaurant_id"=>$restaurant_id));
		if(!empty($id))
			$this->db->where(array("id"=>$id));
		$this->db->delete('restaurant_timing');
	}

	/*
	Delete
	*/
	function deleteMenuItem($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_item'); 		
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/    
	function getRestaurantTimingsByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
	
		$this->db->where(array('restaurant_timing.restaurant_id'=>$restaurantId));

		$this->db->limit($limit, $offset);

		$this->db->select('*');
		$this->db->from('restaurant_timing');
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
	* @method This method will return specific menu item details 
	* @params Item Id will be passed as parameter
	*/
	function listTimingById($Id)
	{
		$this->db->where(array('id'=>$Id));
		$query=$this->db->get("restaurant_timing");	

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}
}
?>
