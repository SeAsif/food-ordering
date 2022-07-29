<?
/**
* Menu Category Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Menucategory_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewMenuCategory($arrInfo)
	{
      	$this->db->insert("menu_category", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateMenuCategory($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_category');
		return $arrInfo["id"];
	}

	/*
	Delete
	*/
	function deleteMenuCategory($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_category'); 		
	}

	/**
	* @method This method is returning Categories of Menu Items for a Restaurant 
	* @params Restaurant Id will be passed as parameter
	*/
	function getMenuCategoryByRestaurantId($restaurantId,$categoryFilters=NULL,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->where(array('restaurant_id'=>$restaurantId));

		$this->db->where(array('status !='=>'Deleted'));

		if (isset($categoryFilters["status"]) && $categoryFilters["status"]	==	"All")
		{
		}
		else if(isset($categoryFilters["status"]))
			$this->db->where(array('status'=>$categoryFilters["status"]));
		else
			$this->db->where(array('status'=>'Active'));
		
		
		if (isset($categoryFilters["sortby"]))
		{
			$sortFilters	=	explode (" ", $categoryFilters["sortby"]);
			if (count($sortFilters) > 1)
				$this->db->order_by($sortFilters[0], $sortFilters[1]);
			else
			$this->db->order_by($categoryFilters["sortby"], "desc");
		}
		else
			$this->db->order_by("id", "desc");
		
		$this->db->limit($limit, $offset);
		
		$query=$this->db->get("menu_category");

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
	* @method This method will return Menu Items against a ctegory
	* @params Category Id will be passed as parameter
	*/
	function getMenuCategoryById($catId)
	{
		$this->db->where(array('id'=>$catId));
		$this->db->where(array('status !='=>'Deleted'));

		$query=$this->db->get("menu_category");

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
