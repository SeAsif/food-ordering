<?
/**
* Variant Items Model
* This is a model class for variant items
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Comission_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	function addNewComission($arrInfo)
	{
      	$this->db->insert("comission", $arrInfo);  
		return $this->db->insert_id();
	}

	/*
	Update
	*/
	function updateComission($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('comission');
	}

	/*
	Delete
	*/
	function deleteComission($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('comission'); 		
	}

	/**
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getComissionById($Id)
	{
		$this->db->where(array('id'=>$Id));

		$query=$this->db->get("comission");

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
	function calculateComission($timediff)
	{
		
		$this->db->where(array('start <='=>$timediff));
		$this->db->where(array('end >='=>$timediff));
		//$this->db->where(array('1'=>$timediff));
		$query=$this->db->get("comission");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row["percent"];
		}		
		// Return Array
		return NULL;
	}

	/**
	* @method returns variants against group id
	* @params This method will take group id as param
	*/
	function getComission()
	{
		$query=$this->db->get("comission");

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