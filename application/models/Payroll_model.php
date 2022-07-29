<?

class Payroll_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
/*
	count		
	*/
    public function count($restaurant_id) {

         $this->db->where('restaurant_id',$restaurant_id);
         return  $this->db->count_all('payrolls');
            
    }
	/*
	retrieve data		
	*/

    function get($limit = NULL, $start = NULL, $restaurant_id=NULL,$user=NULL,$start_date=NULL,$end_date=Null)
	{


        //echo $user."<br>".$start_date."<br>".$end_date;
       //die();
        $select = 'm.* , CONCAT(u.firstname, " ", u.lastname) as staff_name';
        $select .= ',CONCAT(c.firstname, " ", c.lastname) as created_by'  ;
        $this->db->select($select);
        $this->db->from('payrolls as m');
        $this->db->join('user u', 'u.id = m.user_id', 'left');
        $this->db->join('user c', 'c.id = m.created_by', 'left');
        $this->db->where('m.restaurant_id',$restaurant_id);
        if(!empty($start_date)){
            $this->db->where("m.start_date >= '$start_date'");
        }

         if(!empty($end_date)){
          $this->db->where("m.end_date <= '$end_date'");
         }
        if(!empty($user)){
        $this->db->like('CONCAT(u.firstname, " ", u.lastname)', $user);
        }
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

    function get_staff($restaurant_id){

        $select = 'm.id,m.restaurant_id, CONCAT(m.firstname, " ", m.lastname) as username';
        $this->db->select($select);
        $this->db->from('user as m');
        $this->db->where('m.restaurant_id',$restaurant_id);
       // $this->db->where('m.type','employee');
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

    function payroll_settings($restaurant_id){
        $query= $this->db->from("payroll_settings")->where('restaurant_id',$restaurant_id)->get();
        return $query->row();
    }


    function generate_payroll($id=NULL,$input){

        if(!empty($id)){
            $this->db->where('id', $id);
            $this->db->update('payroll_settings', $input);
        }else{
            $this->db->insert("payroll_settings",$input);
        }
       
        return true;
       

    }


    function pay_to_satff($id,$data){

        $this->db->where('id', $id);
        $this->db->update('payrolls', $data);
        return true;

    }


    function update_payroll($id,$data){
        $this->db->from("payrolls"); 
        $this->db->where('id',$id); 
        $query= $this->db->get();
        $payroll= $query->row();


        $data["payable_amount"]=(float)($payroll->payable_amount)+ (float)($data["change_amount"]);
        $data["change_amount"]=$data["change_amount"]>0? "+".$data["change_amount"]:$data["change_amount"];
        $this->db->where('id', $id);
        $this->db->update('payrolls', $data);
        return true;
    }


  
}
?>