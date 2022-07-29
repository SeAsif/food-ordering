<?
/**
* Variant Items Model
* This is a model class for variant items
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Menuitemvariant_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewMenuItemVariant($arrInfo)
	{
      	$this->db->insert("menu_variant", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateMenuItemVariant($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_variant');
	}

	/*
	Delete
	*/
	function deleteMenuItemVariant($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_variant'); 		
	}
	function deleteMenuItemVariantByGroupId($groupId)
	{
		$this->db->where('group_id',$groupId);
		$this->db->delete('menu_variant'); 		
	}
	
	function getVariantItems($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->where(array('restaurant_id'=>$restaurantId));

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
		
		$query=$this->db->get("menu_variant");

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
	function getMenuItemVariantByGroupId($groupId)
	{
		$this->db->where(array('group_id'=>$groupId));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variant");

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
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getMenuItemVariantById($Id)
	{
		$this->db->where(array('id'=>$Id));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variant");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	function deleteAttachment($arrInfo)
	{//	print_r($arrInfo);
		
		$this->db->where('group_id' , $arrInfo["group_id"]);
		$this->db->where('item_id' , $arrInfo["item_id"]);
	//	$this->db->where('445454');
		$this->db->delete('menu_item_variant');
	}


}
?>
