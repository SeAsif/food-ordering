<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Terminal
* 
*/
class Terminal_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addNewTerminal($arrInfo)
	{
      	$this->db->insert("airport_terminal", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateTerminal($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('airport_terminal');
	}

	/**
		Delete
	*/
	function deleteTerminal($terminalId)
	{
		$this->db->where('id',$terminalId);
		$this->db->delete('airport_terminal'); 		
	}

	/**
	* @method This method is returning Restaurants against terminal id 
	* @params Terminal Id will be passed as parameter
	*/
	function getTerminal($airportId)
	{
		if ($airportId	!=	0)
			$this->db->where(array('airport_id'=>$airportId));
			
		$query=$this->db->get("airport_terminal");

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
	function getTerminalById($terminalId)
	{
		$this->db->where(array('id'=>$terminalId));
		$query=$this->db->get("airport_terminal");

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