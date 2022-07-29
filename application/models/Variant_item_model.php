<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Terminal
* 
*/
class Variant_item_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addNewVariant($arrInfo)
	{
      	$this->db->insert("menu_variant", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateVariant($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('menu_variant');
	}

	/**
		Delete
	*/
	function deleteVariant($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('menu_variant'); 		
	}

	/**
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getVariant($filters)
	{
		if ($filters["listing"]!="" && is_array($filters["listing"]))
		{
			$this->db->where_in("id",$filters["listing"]);
		}

//			$this->db->where("1");
		
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
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getVariantById($Id)
	{
		$this->db->where(array('id'=>$Id));
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

}
?>