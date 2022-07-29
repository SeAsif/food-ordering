<?
/**
* Payment_History Management Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Payment_history_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewPayment_History($arrInfo)
	{
      	$this->db->insert("payment_history", $arrInfo);  
		return $this->db->insert_id();
	}


	/*
	Update
	*/
	function updatePayment_History($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
//		$this->db->where("1");
		$this->db->set($arrInfo); 
		$this->db->update("payment_history");
	}

	/*
	Delete
	*/
	function deletePayment_History($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete("payment_history"); 		
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/
	function getPayment_Historys($payHistoryFilter,$limit = NULL, $offset = NULL)
	{
		if (isset($payHistoryFilter["restaurant_id"]))
			$this->db->where(array('restaurant_id'=>$payHistoryFilter["restaurant_id"]));

		if (isset($payHistoryFilter["month"]))
			$this->db->where(array('month(start)'=>$payHistoryFilter["month"]));
		
		if (isset($payHistoryFilter["year"]))
			$this->db->where(array('year(start)'=>$payHistoryFilter["year"]));
			

			
		if (isset($payHistoryFilter["sortby"]))
			$this->db->order_by($payHistoryFilter["sortby"], "desc");
		else
			$this->db->order_by("id", "desc");
		

//		$this->db->where('1'); 
		
		
		if (isset($payHistoryFilter["count"]) && $payHistoryFilter["count"]	==	"Yes")
		{
			$this->db->select('count(*) countrecords');
		}
		else
		{
			$this->db->select('payment_history.*');
			if (isset($payHistoryFilter["isExport"]) && $payHistoryFilter["isExport"]	==	"Yes")
			{
			}
			else
				$this->db->limit($limit, $offset);
		}
		$this->db->from('payment_history');
//		$this->db->join('restaurant', 'restaurant.id = payment_history.restaurant_id');

//		$this->db->where("1");

		$query=$this->db->get();
		
		
		// Declare Array to pass data
		$list = array();
//		print_r ($payHistoryFilter);
		if (isset($payHistoryFilter["isExport"]) && $payHistoryFilter["isExport"]	==	"Yes")
		{
			$this->load->dbutil();
			$csvData	=	"\n\n\n ,,,Month, Total number of orders, Total amount, Waive Fees, Net payable to restaurant, Status \n";

			foreach ($query->result_array() as $row)
			{
				$payable	=	$row["total"]-$row["comission"];
				$csvData	.=	",,,".date("F Y",strtotime($row["start"])).", ".$row["order_count"].", $".$row["total"].", $".$row["comission"].", $".$payable.", ".$row["status"]."\n";
			}

/*			$csvData	=	$this->dbutil->csv_from_result($query);
*/
			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			$fileName	=	"order_data_".date("Y-m-d H:i:s").".csv";
			force_download($fileName, $csvData); 						
		}
		
		if (isset($payHistoryFilter["count"]) && $payHistoryFilter["count"]	==	"Yes")
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
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/
	function getNewPaymentHistorys($payHistoryFilter,$limit = NULL, $offset = NULL)
	{

		$this->db->select('*');

		if (isset($payHistoryFilter["restaurant_id"]))
			$this->db->where(array('restaurant_id'=>$payHistoryFilter["restaurant_id"]));

		if (isset($payHistoryFilter["month"]))
			$this->db->where(array('month(stamp)'=>$payHistoryFilter["month"]));
		
		if (isset($payHistoryFilter["year"]))
			$this->db->where(array('year(stamp)'=>$payHistoryFilter["year"]));

        $record_obj = $this->db->get('order');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();

       
        
        if (!empty($record_arr)) {
        	//
        
        	$month= '';
        	$total_amount = 0;
        	$total_city_tax = 0;
        	$total_state_tax = 0;
        	$return_arr = array();

        	foreach ($record_arr as $key => $order) {
        		$month = date("F", strtotime($order['stamp']));
        		$total_order = isset($return_arr[$month]['total_order']) ? $return_arr[$month]['total_order'] : 0;
        		$total_amount = isset($return_arr[$month]['total_amount']) ? $return_arr[$month]['total_amount'] : 0;
        		$city_tax = isset($return_arr[$month]['total_city_tax']) ? $return_arr[$month]['total_city_tax'] : 0;
        		$state_tax = isset($return_arr[$month]['total_state_tax']) ? $return_arr[$month]['total_state_tax'] : 0;
        		//
        		$return_arr[$month]['start'] = $order['stamp'];
	        	$return_arr[$month]['total_order'] = $total_order + 1;
	        	$return_arr[$month]['total_amount'] = $total_amount + $order['totalprice'];
	        	$return_arr[$month]['total_city_tax'] = $city_tax  + $order['city_tax'];
	        	$return_arr[$month]['total_state_tax'] = $state_tax + $order['state_tax'];
        	}

        	// foreach ($record_arr as $key => $order) {

        	// 	$month = date("F", strtotime($record_arr[0]['stamp']));
	        // 	$total_amount = $total_amount + $order['totalprice'];
	        // 	$total_city_tax = $total_city_tax + $order['city_tax'];
	        // 	$total_state_tax = $total_state_tax + $order['state_tax'];
        	// }

    
        	// $return_arr[0]['start'] = $record_arr[0]['stamp'];
        	// $return_arr[0]['total_order'] = count($record_arr);
        	// $return_arr[0]['total_amount'] = $total_amount;
        	// $return_arr[0]['total_city_tax'] = $total_city_tax;
        	// $return_arr[0]['total_state_tax'] = $total_state_tax;
        	//
  //       	 echo '<pre>';
		// print_r($return_arr);
		// print_r($record_arr);
		// die();
            return $return_arr;
        } else {
            return '';
        }
		
		
		
	}

	/**
	* @method This method will return specific menu item details 
	* @params Item Id will be passed as parameter
	*/
	function getPayment_HistoryById($Id,$all="Yes")
	{
		if ($all	==	"Yes")
		$this->db->select('*');
		else
		$this->db->select('payment_history.*');
		$this->db->from("payment_history");
		$this->db->where('payment_history.id',$Id);
//		$this->db->where("1");
		
		$query = $this->db->get();
	
		$arrList	=	$query->result_array();

		return $arrList[0];
	}

}
?>
