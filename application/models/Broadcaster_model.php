<?

class Broadcaster_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

    function count(){

        $restaurantArr = $this->session->userdata('restaurant');
        $restaurant_id=$restaurantArr["id"];
         return $this->db->where('restaurant_id', $restaurant_id)->count_all_results('broadcast');

    }
    
	/*
	retrieve data		
	*/

    function get($limit = NULL, $start = NULL)
	{
        $restaurantArr = $this->session->userdata('restaurant');
        $select = 'm.* , CONCAT(u.firstname, " ", u.lastname) as created_by';
        $select .= ',CONCAT(c.firstname, " ", c.lastname) as updated_by'  ;
        $this->db->select($select);
        $this->db->from('broadcast as m');
        $this->db->join('user u', 'u.id = m.created_by', 'left');
        $this->db->join('user c', 'c.id = m.updated_by', 'left');
        $this->db->where("m.restaurant_id",$restaurantArr["id"]);
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

    function edit($id)
	{
        $this->db->from("broadcast"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        return $query->row();

	}

	/*
	Add		
	*/

    function save($data)
	{
        $this->db->insert("broadcast", $data);  
        return $this->db->insert_id();
	}
	/*
	update		
	*/

    function update($data,$id){

        $this->db->where('id', $id);
        $this->db->update('broadcast', $data);
        return true;
    }


    function get_broadcaster($id){

    
       $query= $this->db->from("broadcast")
            ->where('restaurant_id', $id)
            ->where('is_on', 'On')
            ->get();
      return $query->row();
      
       

    }

	
}
?>