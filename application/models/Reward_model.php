<?
/**
* Menu Category Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Reward_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

	function count(){
	return $this->db->count_all('rewards');
	}

	/*
	retrieve data		
	*/

    function get($limit = NULL, $start = NULL)
	{
        $select = 'm.* , CONCAT(u.firstname, " ", u.lastname) as created_by';
        $select .= ',CONCAT(c.firstname, " ", c.lastname) as updated_by'  ;
        $this->db->select($select);
        $this->db->from('rewards as m');
        $this->db->join('user u', 'u.id = m.created_by', 'left');
        $this->db->join('user c', 'c.id = m.updated_by', 'left');
        $this->db->join('coupons', 'coupons.id = m.coupon_id', 'left');
        $this->db->join('restaurant', 'restaurant.id = m.restaurant_id', 'left');
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
        $this->db->from("rewards"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        return $query->row();

	}

	/*
	Add		
	*/

    function save($data)
	{
		$this->db->insert("rewards", $data);  
		return $this->db->insert_id();
	}
	

    function update($data,$id){

        $this->db->where('id', $id);
        $this->db->update('rewards', $data);
        return true;
    }

	function delete($id){

        $this->db->where('id', $id);
        $this->db->delete('rewards');
        return true;
    }

	
}
?>
