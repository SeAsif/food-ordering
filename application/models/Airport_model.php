<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Terminal
* 
*/
class Airport_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getAirport($searchString)
	{
		if ($searchString!="")
			$this->db->like('airport_name', $searchString, 'after');
		
		$this->db->select('airport.*');
		$this->db->from('airport');
		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	function getAirportById($id)
	{
		
		$this->db->select('airport.*');
		$this->db->where(array('id'=>$id));
		$this->db->from('airport');
		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	function addNewAirport($arrInfo)
	{
      	$this->db->insert("airport", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateAirport($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('airport');
	}

	/**
		Delete
	*/
	function deleteAirport($airportId)
	{
		$this->db->where('id',$airportId);
		$this->db->delete('airport'); 		
	}
	
}
?>