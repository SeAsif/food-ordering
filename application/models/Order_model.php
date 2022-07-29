<?
/**
* Order Management Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Order_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewOrder($arrInfo)
	{
		  	$this->db->insert("order", $arrInfo);  
		return $this->db->insert_id();
	}

	function updateOrderRelatedData($orderId,$sessionID,$order_code)
	{
		$this->db->where(array("id"=>$orderId));
		$this->db->set(array("order_code"=>$order_code)); 
		$this->db->update('order');
		
		$this->db->where(array("session_id"=>$sessionID));
		$this->db->set(array("order_id"=>$orderId)); 
		$this->db->update('order_item');

		$this->db->where(array("session_id"=>$sessionID));
		$this->db->set(array("order_id"=>$orderId)); 
		$this->db->update('order_item_detail'); 
	}

	/*
	Get Delivery Charges
	*/
	function getDeliveryCharges($restaurant_id)
	{
		$this->db->select('delivery_charge');
        $this->db->where('id', $restaurant_id);
        $records_obj = $this->db->get('restaurant');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr['delivery_charge'];
        }

        return $return_data; 		
	}

	/*
	Update
	*/
	function updateOrder($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
//		$this->db->where("1");
		$this->db->set($arrInfo); 
		$this->db->update('order');
		
		if($arrInfo["order_status"] == "Confirmed")
		{
			$this->db->where(array("order_id"=>$arrInfo["id"]));
			$this->db->set(array("session_id"=>"")); 
			$this->db->update('order_item');
	
			$this->db->where(array("order_id"=>$arrInfo["id"]));
			$this->db->set(array("session_id"=>"")); 
			$this->db->update('order_item_detail');
		}
	}

	/*
	Delete
	*/
	function deleteOrder($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('order'); 		
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/
	function getOrders($orderFilter,$limit = NULL, $offset = NULL)
	{	//print_r($orderFilter);
		if (isset($orderFilter["restaurant_id"]))
			$this->db->where(array('restaurant_id'=>$orderFilter["restaurant_id"]));

		if (isset($orderFilter["terminal_id"]))
			$this->db->where(array('restaurant.terminal_id'=>$orderFilter["terminal_id"]));

		if (isset($orderFilter["order_code"]))
			$this->db->where(array('order_code'=>$orderFilter["order_code"]));

		if (isset($orderFilter["order_status"]) && $orderFilter["order_status"]	!=	"All")
			$this->db->where(array('order_status'=>$orderFilter["order_status"]));

		if (isset($orderFilter["delivery_date"]) && $orderFilter["delivery_date"]!="")
			$this->db->where('date(delivery_time) =', $orderFilter["delivery_date"]); 

		if (isset($orderFilter["start_date"]) && $orderFilter["start_date"]!="")
			$this->db->where('date(delivery_time) >=', $orderFilter["start_date"]); 

		if (isset($orderFilter["end_date"]) && $orderFilter["end_date"]!="")
			$this->db->where('date(delivery_time) <=', $orderFilter["end_date"]); 

		if (isset($orderFilter["delivery_time"]))
			$this->db->where('delivery_time <=', $orderFilter["delivery_time"]); 

		if (isset($orderFilter["current_time"]))
			$this->db->where('delivery_time >=', $orderFilter["current_time"]); 

		if (isset($orderFilter["isdashboard"]) && $orderFilter["isdashboard"]	==	"Yes")
		{
			$this->db->where('order_status =', 'Confirmed'); 
			
		}
		if (isset($orderFilter["is_favorite"]))
			$this->db->where(array('is_favorite'=>$orderFilter["is_favorite"]));
		
		if (isset($orderFilter["from_delivery_date"]) && isset($orderFilter["to_delivery_date"]))
		{
			$this->db->where('delivery_time >=', $orderFilter["from_delivery_date"]); 
			$this->db->where('delivery_time <=', $orderFilter["to_delivery_date"]); 
		}
/*		
		from_delivery_date
		to_delivery_date
*/
		$this->db->where('order_status <>', 'Unpaid'); 

		if (isset($orderFilter["month"]) )
		{
			$this->db->where('month(delivery_time) =', $orderFilter["month"]);
		}
		if (isset($orderFilter["year"]) )
		{
			$this->db->where('year(delivery_time) =', $orderFilter["year"]);
		}
		if (isset($orderFilter["date"]))
			$this->db->where('delivery_time <=', $orderFilter["date"]); 


		if (isset($orderFilter["ishistory"]) && $orderFilter["ishistory"]	==	"Yes")
		{
			$this->db->where_in('order_status', array("Confirmed","Rejected"));
		}
			
		if (isset($orderFilter["sortby"]) && isset($orderFilter["ordertype"]))
			$this->db->order_by($orderFilter["sortby"], $orderFilter["ordertype"]);
		else if (isset($orderFilter["sortby"]))
			$this->db->order_by($orderFilter["sortby"], "desc");
		else
			$this->db->order_by("order.id", "desc");
		

//		$this->db->where('1'); 
		
		
		if (isset($orderFilter["count"]) && $orderFilter["count"]	==	"Yes")
		{
			$this->db->select('count(*) countrecords');
		}
		else
		{
			$this->db->select('order.*,restaurant.restaurant_name');
			if (isset($orderFilter["isExport"]) && $orderFilter["isExport"]	==	"Yes")
			{
			}
			else
				$this->db->limit($limit, $offset);
		}
		$this->db->from('order');
		$this->db->join('restaurant', 'restaurant.id = order.restaurant_id');

//		$this->db->where("1");

		$query=$this->db->get();
		
		
		// Declare Array to pass data
		$list = array();
//		print_r ($orderFilter);
		if (isset($orderFilter["isExport"]) && $orderFilter["isExport"]	==	"Yes")
		{
			$this->load->dbutil();

			$csvData	=	$this->dbutil->csv_from_result($query);
			foreach ($query->result_array() as $row)
			{
			$sum	=	$sum+$row["totalprice"];
			}

			$csvData	=	$csvData."\n,,,,,,,,, Sum, ".$sum;
			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			$fileName	=	"order_data_".date("Y-m-d H:i:s").".csv";
			force_download($fileName, $csvData); 						
		}
		
		if (isset($orderFilter["count"]) && $orderFilter["count"]	==	"Yes")
		{
			foreach ($query->result_array() as $row)
			{
				return $row["countrecords"];
			}
			
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
				$row1	=	$row;
				
				// if ((isset($orderFilter["isdashboard"]) && $orderFilter["isdashboard"]	==	"Yes") || (isset($orderFilter["ishistory"]) && $orderFilter["ishistory"]	==	"Yes"))
				// {
				// 	$row1["delivery_time"]	=	date("h:i a",strtotime($row1["delivery_time"]));
				// }

				$list[]	=	$row1;
			}		
		// Return Array
			return $list;
		}
	}
	/**
	* @method This method is returning orders by user
	* @params Item Id will be passed as parameter
	*/
	function getOrdersByUser($orderFilter,$limit = NULL, $offset = NULL)
	{

		if (isset($orderFilter["user_id"])	&& $orderFilter["user_id"]!="" && $orderFilter["user_id"]!="0")
			$this->db->where(array('order.user_id'=>$orderFilter["user_id"]));

		if (isset($orderFilter["is_favorite"])	&& $orderFilter["is_favorite"]!="" )
			$this->db->where(array('order.is_favorite'=>$orderFilter["is_favorite"]));
			
		if (isset($orderFilter["email"])	&& $orderFilter["email"]!="")
			$this->db->where(array('email'=>$orderFilter["email"]));
			
		if (isset($orderFilter["start_date"]) && $orderFilter["start_date"]!="")
			$this->db->where('date(order.stamp) >=', $orderFilter["start_date"]); 

		if (isset($orderFilter["end_date"]) && $orderFilter["end_date"]!="")
			$this->db->where('date(order.stamp) <=', $orderFilter["end_date"]); 

		if (isset($orderFilter["sortby"])	&& $orderFilter["sortby"]!="")
			$this->db->order_by($orderFilter["sortby"]);
		else
		{
			$this->db->order_by("order.id","desc");
		}
		
		if (isset($orderFilter["order_status"]) && $orderFilter["order_status"]	==	"All")
			$this->db->where('(order_status="Pending" or order_status="Confirmed" or order_status="Rejected")'); 
		
		

		$this->db->select('order.*,restaurant.restaurant_name, airport_terminal.terminal_name as terminal_name, airport.airport_name as airport_name');
		$this->db->from('order');
		$this->db->join('restaurant', 'restaurant.id = order.restaurant_id');
		$this->db->join('airport_terminal', 'airport_terminal.id = restaurant.terminal_id');
		$this->db->join('airport', 'airport.id = airport_terminal.airport_id');


//		$this->db->where("1");

		$query=$this->db->get();
		
		
		// Declare Array to pass data
		$list = array();
//		print_r ($orderFilter);
		
		if (isset($orderFilter["count"]) && $orderFilter["count"]	==	"Yes")
		{
			foreach ($query->result_array() as $row)
			{
				return $row["countrecords"];
			}
			
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
			}		
		// Return Array
			return $list;
		}
	}

	/**
	* @method This method will return specific menu item details 
	* @params Item Id will be passed as parameter
	*/
	function getOrderById($Id,$all="Yes")
	{	
		if ($all	==	"Yes")
		$this->db->select('order.*,order.address as order_address,restaurant_name,restaurant_slogan,restaurant_details, brand_id, terminal_id, restaurant.address  ');
//"restaurant_name":"name","restaurant_slogan":"slogan1abccde3","restaurant_details":"abc cde","brand_id":"1","terminal_id":"1","address":"abc derf","coordinate_x1":"605","coordinate_x2":"715","coordinate_y1":"181","coordinate_y2":"270","width":"110","height":"89","status":"Active","take_out":"No","dine_in":"Yes","legal_sea_food":"No","proximity_to_gate":"0","location_security":"Pre","logo":"988c2775fae81eb8fee9d1eedb834636_Jellyfish.jpg","order_preparation_time":"44","avg_rating":"0","delivery_time_before":"50"}		
		
		else
		$this->db->select('order.*,order.address as order_address');
		$this->db->from('order');
		$this->db->where('order.id',$Id);
		$this->db->join('restaurant', 'restaurant.id = order.restaurant_id');
//		$this->db->where("1");
		
		$query = $this->db->get();
	
		$arrList	=	$query->result_array();

		return $arrList[0];
	}

	function getRestaurantPaystackSecretKey ($id) {
		$this->db->select('paystack_secret_key');
        $this->db->where('id', $id);

        $record_obj = $this->db->get('restaurant');
        $record_arr = $record_obj->row_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr['paystack_secret_key'];
        } else {
            return '';
        }
	}

	/*
	Get Restaurant Flutterwave SecretKey
	*/
	function getRestaurantFlutterwaveSecretKey($restaurant_id)
	{
		$this->db->select('flutterwave_secret_key');
        $this->db->where('id', $restaurant_id);
        $records_obj = $this->db->get('restaurant');
        $records_arr = $records_obj->row_array();
        $records_obj->free_result();

        $return_data = '';

        if (!empty($records_arr)) {
            $return_data = $records_arr['flutterwave_secret_key'];
        }

        return $return_data;
	}

	function checkCouponCodeValid ($coupon_code, $restaurant_id)
	{

		$this->db->select('discount_type, discount, usage, customer_log');
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('code', $coupon_code);
        $this->db->where('status', 'Active');
        $this->db->where('is_home_page', 'Public');
       
        $this->db->group_start();
  		$this->db->where('end_date > ', date('Y-m-d'));
 		$this->db->or_where('is_default', 1);
   		$this->db->group_end();

        $record_obj = $this->db->get('coupons');
        $record_arr = $record_obj->row_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr;
        } else {
            return array();
        }
	}

	function checkUserAvailCoupon ($email, $coupon_code, $restaurant_id)
	{

		$this->db->select('id');
        $this->db->where('restaurant_id', $restaurant_id);
        $this->db->where('coupon_code', $coupon_code);
        $this->db->where('user_email', $email);

        $record_obj = $this->db->get('used_coupons_history');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return count($record_arr);
        } else {
            return 0;
        }
	}

	function saveCouponhistory($data_to_insert)
	{
		$this->db->insert("used_coupons_history", $data_to_insert);  
	}

}
?>
