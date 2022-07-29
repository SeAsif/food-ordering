<?
/**
* Menu Category Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Coupon_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }

	function count(){
    $restaurantArr = $this->session->userdata('restaurant');
	return $this->db->where('m.restaurant_id',$restaurantArr["id"])->count_all('coupons');
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
        $this->db->from('coupons as m');
        $this->db->join('user u', 'u.id = m.created_by', 'left');
        $this->db->join('user c', 'c.id = m.updated_by', 'left');
        $this->db->where('m.restaurant_id',$restaurantArr["id"]);
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
        $this->db->from("coupons"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        return $query->row();

	}

	/*
	Add		
	*/

    function save($data)
	{
		$this->db->insert("coupons", $data);  
		return $this->db->insert_id();
	}
	

    function update($data,$id){

        $this->db->where('id', $id);
        $this->db->update('coupons', $data);
        return true;
    }
    
    function update_status($id){
        $this->db->from("coupons"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        $res=$query->row();
        
        if($res->status=="Active"){
            $this->db->where('id', $id);
            $data["status"]="Inactive";
            $this->db->update('coupons', $data);
         return true;
        }else{
            $this->db->where('id', $id);
            $data["status"]="Active";
            $this->db->update('coupons', $data);
             return true;
        }
    }


	function delete($id){

        $this->db->where('id', $id);
        $this->db->delete('coupons');
        return true;
    }

	
}
?>
