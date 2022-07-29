<?
/**
* Menu Category Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Loyalitysetting_model extends CI_Model
{
    
	function __construct() {
        parent::__construct();
    }

	
	
    
    /*
	Edit		
	*/

    function edit($id)
	{
        $this->db->from("loyality_settings"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        return $query->row();

	}

	/*
	Add		
	*/

    function save($data)
	{
		$this->db->insert("loyality_settings", $data);  
		return $this->db->insert_id();
	}
	

    function update($data,$id){

        $this->db->where('id', $id);
        $this->db->update('loyality_settings', $data);
        return true;
    }

	
	
}
?>
