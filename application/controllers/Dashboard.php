<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class DashBoard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/order');
		$this->load->library('core/orderitem');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');
		
		if( $this->session->userdata('restaurant')== FALSE ) {
		   redirect(base_url()."restaurantportal",true);
		}
	}
	
/**
.........................................................................................................
									Start Restaurant Dash Board Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index($page = 0)
	{
		$data	=	array();
		$filters	=	array("order_status"=> "All","sortby"=>"order.id");
		
		$nHours	=	24;

		$restaurantArr = $this->session->userdata('restaurant');
		//
		$subscription_status = check_user_subscription($restaurantArr);
		//		
		$restaurantID	=	$restaurantArr["id"];
		$restaurantName	=	$restaurantArr["restaurant_name"];
		
		$filters["delivery_time"]	=	date("Y-m-d H:i:s");
		$filters["current_time"]	=	date("Y-m-d H:i:s",time() - ($nHours*3600));

		$filters["restaurant_id"]	=	$restaurantID	;
		
		$per_page	=	$this->config->item("PER_PAGE");
		
		$filters["count"]	=	"No";

		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(3);
		$data["activemenu"]	=	"dashboard";

		$orderFilter["restaurant_id"]	=	$restaurantID	;
		$orderFilter["order_status"]	=	"All";
		$orderFilter["isdashboard"]	=	"Yes";
		$nTimeBefore	=	$restaurantArr["delivery_time_before"];
		// $orderFilter["delivery_time"]	=	date("Y-m-d H:i:s",time() +  $nTimeBefore*60);
		// $orderFilter["current_time"]	=	date("Y-m-d H:i:s");


		$orderFilter["restaurant_id"]	=	$restaurantID	;
		
		$per_page	=	$this->config->item("PER_PAGE");
		
		$filters["count"]	=	"No";

		$data["ncounter1"]	=	1;
		$data["ncounter1"]	=	$data["ncounter1"]+$this->uri->segment(3);
		$data["restaurantID"] = $restaurantID;
		$data["pre_order"]	=	$restaurantArr["pre_order"];
		if($data["pre_order"] == "Yes"){
			if(!isset($_GET['day'])){
				$orderFilter['delivery_date'] = date('Y-m-d');
			}else if(isset($_GET['day']) && $_GET['day'] == "tomorrow"){
				$orderFilter['delivery_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
			}else if(isset($_GET['day']) && $_GET['day'] == "upcoming"){
				$orderFilter['start_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +2 day'));
			}else if(isset($_GET['day']) && $_GET['day'] == "past"){
				$orderFilter['end_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));
			}
		}
		$orders	=	$this->order->getOrders($orderFilter);

		$ordersNew1	=	array();

		foreach ($orders as $order)
		{
			$order["items"]	=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$order["id"]),"No");
			$ordersNew1[]	=	$order;
		}
		$data["neworders"]=$ordersNew1;
		
		$orderFilter["count"]	=	"Yes";
		$data["total_neworders_count"]	=	$total	=	$this->order->getOrders($orderFilter);
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'/dashboard';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '2';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Back';
		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();
		$data['subscription_status'] = $subscription_status;
		
		$this->load->view('restaurantportal/dashboard/orders',$data);
	}



/**
.........................................................................................................
									End Restaurant Dash Board Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
