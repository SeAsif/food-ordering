<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Terminal
* 
*/
class Brand_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addNewBrand($arrInfo)
	{
      	$this->db->insert("brand", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateBrand($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('brand');
	}

	/**
		Delete
	*/
	function deleteBrand($terminalId)
	{
		$this->db->where('id',$terminalId);
		$this->db->delete('brand'); 		
	}

	/**
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getBrand()
	{
		$query=$this->db->get("brand");

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
	function getBrandById($brandId)
	{
		$this->db->where(array('id'=>$brandId));
		$query=$this->db->get("brand");

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