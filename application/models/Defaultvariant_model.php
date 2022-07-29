<?
/**
* Variant Items Model
* This is a model class for variant items
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Defaultvariant_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewDefaultVariant($arrInfo)
	{
      	$this->db->insert("menu_variants_default", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateDefaultVariant($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_variants_default');
	}

	/*
	Delete
	*/
	function deleteDefaultVariant($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('menu_variants_default'); 		
	}

	/**
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getDefaultVariantById($Id)
	{
		$this->db->where(array('id'=>$Id));

		$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variants_default");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}
	function getAllDefaultVariantById($Id)
	{
		$this->db->where(array('id'=>$Id));

		//$this->db->where(array('status'=>'Active'));
		
		$query=$this->db->get("menu_variants_default");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}
	/**
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getDefaultVariant()
	{
		$query=$this->db->get("menu_variants_default");

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