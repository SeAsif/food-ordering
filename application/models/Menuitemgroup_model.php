<?
/**
* Item Group Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Menuitemgroup_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewMenuItemGroup($arrInfo)
	{
      	$this->db->insert("menu_variant_group", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateMenuItemGroup($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_variant_group');
	}

	/*
	Delete
	*/
	function deleteMenuItemGroup($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_variant_group'); 		
	}
	/**
	* @method This method will return group detail
	* @params group id will be passed as parameter
	*/
	function getMenuItemGroupById($Id)
	{
		$this->db->where(array('id'=>$Id));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variant_group");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method This method will return group detail
	* @params group id will be passed as parameter
	*/
	function getMenuItemForDashboard($Id)
	{
		$this->db->where(array('id'=>$Id));
		
		$query=$this->db->get("menu_variant_group");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method This method will return vriant groups 
	* @params Item Id will be passed as parameter
	*/
	function getMenuItemGroupByItemId($itemId)
	{
		$this->db->where(array('item_id'=>$itemId));
		
		$query=$this->db->get("menu_item_variant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	function getVariantItemGroups($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->where(array('menu_variant_group.restaurant_id'=>$restaurantId));

		$this->db->where(array('menu_variant_group.status <>'=>"Deleted"));

		if (isset($filters["status"]) && $filters["status"]	==	"All")
		{
		}
		else if(isset($filters["status"]))
			$this->db->where(array('menu_variant_group.status'=>$filters["status"]));
		else
			$this->db->where(array('menu_variant_group.status'=>'Active'));
		
		if(isset($filters["alphabet"]) && $filters["alphabet"]!="")
			$this->db->like('menu_variant_group.group_name', $filters["alphabet"], 'after');

		
		$this->db->limit($limit, $offset);

		if (isset($filters["sortby"]))
			$this->db->order_by($filters["sortby"], "desc");
		else
			$this->db->order_by("menu_variant_group.id", "desc");

		if(isset($filters["category_id"]) && $filters["category_id"]!="" && $filters["category_id"]!="select")
			$this->db->where(array('menu_variant_group.category_id'=>$filters["category_id"]));
		

		$this->db->select('menu_variant_group.*, menu_variant_category.category_name');
		$this->db->from('menu_variant_group');
		$this->db->join('menu_variant_category', 'menu_variant_category.id = menu_variant_group.category_id');

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
	Add		
	*/
	function attachMenuItemWithGroup($arrInfo)
	{
      	$this->db->insert("menu_item_variant", $arrInfo);  
		return $this->db->insert_id();
	}

		
}
?>
