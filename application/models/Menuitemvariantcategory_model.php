<?
/**
* Variant Items Model
* This is a model class for variant items
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Menuitemvariantcategory_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	function addNewMenuItemVariantCategory($arrInfo)
	{
      	$this->db->insert("menu_variant_category", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateMenuItemVariantCategory($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_variant_category');
	}

	/*
	Delete
	*/
	function deleteMenuItemVariantCategory($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_variant_category'); 		
	}
	
	function getVariantItemCategories($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->where(array('restaurant_id'=>$restaurantId));

		$this->db->where(array('status !='=>"Deleted"));

		if (isset($filters["group_id"]))
			$this->db->where(array('group_id'=>$filters["group_id"]));

		if (isset($filters["status"]) && $filters["status"]	==	"All")
		{
		}
		else if(isset($filters["status"]))
			$this->db->where(array('status'=>$filters["status"]));
		else
			$this->db->where(array('status'=>'Active'));
		
		
		$this->db->limit($limit, $offset);

		if (isset($filters["sortby"]))
			$this->db->order_by($filters["sortby"], "desc");
		else
			$this->db->order_by("id", "desc");
		
		$query=$this->db->get("menu_variant_category");

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
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getMenuItemVariantCategoryByGroupId($groupId)
	{
		$this->db->where(array('group_id'=>$groupId));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variant_category");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getMenuItemVariantCategoryById($Id)
	{
		$this->db->where(array('id'=>$Id));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variant_category");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}


}
?>