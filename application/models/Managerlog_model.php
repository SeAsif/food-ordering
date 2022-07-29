<?

class Managerlog_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
/*
	count		
	*/
    public function get_count() {
        $restaurantArr = $this->session->userdata('restaurant');
        $restaurant_id=$restaurantArr["id"];
        return $this->db->where('restaurant_id', $restaurant_id)->count_all_results('manager_logs');
    }
	/*
	retrieve data		
	*/

    function get_logs($limit = NULL, $start = NULL,$log_date=NULL)
	{
        $restaurantArr = $this->session->userdata('restaurant');
        $restaurant_id=$restaurantArr["id"];
        $select = 'm.* , CONCAT(u.firstname, " ", u.lastname) as created_by';
        $select .= ',CONCAT(c.firstname, " ", c.lastname) as updated_by'  ;
        $this->db->select($select);
        $this->db->from('manager_logs as m');
        $this->db->join('user u', 'u.id = m.created_by', 'left');
        $this->db->join('user c', 'c.id = m.updated_by', 'left');
       if(!empty($log_date)){
        $this->db->where('m.log_date', $log_date);
        
       }
       $this->db->where('m.restaurant_id', $restaurant_id);
        $this->db->limit($limit, $start);
        $this->db->order_by("m.id desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) 
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    
	}


    
    /*
	Edit		
	*/

    function edit_log($id)
	{
        $this->db->from("manager_logs"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        return $query->row();

	}

	/*
	Add		
	*/

    function save($data)
	{
        $this->db->insert("manager_logs", $data);  
        return $this->db->insert_id();
	}
	

    function update_log($data,$id){

        $this->db->where('id', $id);
        $this->db->update('manager_logs', $data);
        return true;
    }

	
}
?>