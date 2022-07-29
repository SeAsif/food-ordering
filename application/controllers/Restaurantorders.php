<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantOrders extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/order');
		$this->load->library('core/orderitem');		
		$this->load->library('core/payment_history');		
		$this->load->library('form_validation');	
		$this->load->library('session');
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');
		require_once(APPPATH . 'libraries/qr/qrlib.php');

		if( $this->session->userdata('restaurant')== FALSE ) {
		   redirect(base_url()."restaurantportal",true);
		}
		else {
			$restaurantArr = $this->session->userdata('restaurant');
        	$subscription_status = check_user_subscription($restaurantArr);
        	//
        	if ($subscription_status == 'expired') {
        		redirect(base_url()."dashboard",true);
        	}
		}
		
	}
	
/**
.........................................................................................................
									Start Restaurant Manage Orders Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data	=	array();
//		$this->load->view('admin/terminals/index',$data);
	}
	function paymentreport()
	{
		$bc = array(
		   'title' => 'manageOrders',
		   'url' => base_url()."restaurantorders/paymentreport",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();
	
	
			$restaurantArr = $this->session->userdata('restaurant');
			$restaurantID	=	$restaurantArr["id"];
			$data["userType"]	=	$this->session->userdata('type');
					
		if ($_POST)
		{
		
			if ($this->input->get_post("month") && $this->input->get_post("month")	!=	0)
			{
				$filters["month"]	=	$this->input->get_post("month");
				$filters["year"]	=	date("Y");
			}

			if ($this->input->get_post("year") && $this->input->get_post("year")	!=	0)
				$filters["year"]	=	$this->input->get_post("year");
			
			

			if ($this->input->get_post("export")	==	"Yes")
				$filters["isExport"]	=	"Yes";
				
		}
		
		$data["activemenu"]	=	"orderreport";
		$data["activetab"]	=	"orderreport";

		$filters["restaurant_id"]	=	$restaurantID;
		
		// $data["list"]	=	$this->payment_history->getPayment_Historys($filters);
		$data["list"]	=	$this->payment_history->getNewPaymentHistorys($filters);
		$data["filters"]	=	$filters;

		// echo '<pre>';
		// print_r($data['list']);
		// die();
		
		// $this->load->view('restaurantportal/restaurantorders/reports',$data);
		$this->load->view('restaurantportal/restaurantorders/new_report',$data);
	
	}
	
	function processpayments()
	{
		
	}
	
	function allorder($type = "")
	{
		$data	=	array();
		$filters	=	array("order_status"=> "All","sortby"=>"order.id");
		
		$bc = array(
		   'title' => 'All Orders',
		   'url' => base_url()."restaurantorders/allorder/history",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();

		$data["userType"]	=	$this->session->userdata('type');
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
		if($this->session->userdata('search_criteria4') && $type	!=	"history")
			$filters = $this->session->userdata('search_criteria4');
		
		if ($_POST)
		{
			$filters	=	array("order_status"=> "All","sortby"=>"order.id");
			if ($this->input->post("order_status"))
				$filters["order_status"]	=	$this->input->post("order_status");
			if ($this->input->post("from_delivery_date"))
				$filters["from_delivery_date"]	=	date("Y-m-d",strtotime($this->input->post("from_delivery_date")));
			if ($this->input->post("to_delivery_date"))
				$filters["to_delivery_date"]	=	date("Y-m-d",strtotime($this->input->post("to_delivery_date")));
			if ($this->input->post("order_code"))
				$filters["order_code"]	=	$this->input->post("order_code");
			
			$this->session->set_userdata('search_criteria4',$filters);
		//	print_r($filters);
				
		}
		
		
		if ($type	==	"history")
		{
			
			$this->session->unset_userdata('search_criteria4');
			if ($this->input->post("month") || $this->input->post("year"))
			{
			if ($this->input->post("month"))
				$filters["month"]	=	$this->input->post("month");
			if ($this->input->post("year"))
				$filters["year"]	=	$this->input->post("year");
			
			$filters["date"]	=	$this->input->post("end_date");	//print_r($filters);exit();
			}
			else
			{
				$nHours	=	24;
				
				$filters["delivery_time"]	=	date("Y-m-d H:i:s");
				$filters["current_time"]	=	date("Y-m-d H:i:s",time() - ($nHours*3600));
				
			
			}
			
			if ($this->input->get_post("export")	==	"Yes")
				$filters["isExport"]	=	"Yes";
			
			
			$data["activemenu"]	=	"ordernew";
			$data["activetab"]	=	"ordernew";
			
			///////////////////////////////////////////////
			
			$filters["restaurant_id"]	=	$restaurantID	;
			$filters["count"]	=	"No";
		//	print_r($filters);
			$orders	=	$this->order->getOrders($filters);//print_r($orders);exit();
		//	echo "this is imp.";
		//	print_r($orders);
		    ////////////////////////////////////////////////
		}
		else
		{
			$data["activemenu"]	=	"allorder";
			$data["activetab"]	=	"allorder";
			
			//////////////////////////////////////////
			
			$filters["restaurant_id"]	=	$restaurantID	;
			$per_page	=	$this->config->item("PER_PAGE");
			
			$filters["count"]	=	"No";
	
			$data["ncounter"]	=	1;
			$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(3);
			
			$orders	=	$this->order->getOrders($filters,$per_page, $this->uri->segment(3));
	//		print_r($orders);
			
			/////////////////////////////////////////////	
		}

/*		
		$filters["restaurant_id"]	=	$restaurantID	;
		
		$per_page	=	$this->config->item("PER_PAGE");
		
		$filters["count"]	=	"No";

		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(3);
		
		$orders	=	$this->order->getOrders($filters,$per_page, $this->uri->segment(3));
*/
		
		$ordersNew	=	array();

		foreach ($orders as $order)
		{
			$order["items"]	=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$order["id"]),"No");
			$ordersNew[]	=	$order;
		
			
		}
		$data["orders"]=$ordersNew;
		

		$filters["count"]	=	"Yes";
		$data["total_order_count"]	=	$total	=	$this->order->getOrders($filters);
		
		$config['base_url'] = base_url().'/restaurantorders/allorder';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '3';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Back';

		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();

		$data['filters']=	$filters;
		$data["type"] = $type;
				
		$this->load->view('restaurantportal/restaurantorders/allorder',$data);
	
	}	

	function ordersdetail($orderid,$type)
	{
		$data	=	array();
		$data["activemenu"]	=	"ordersdetail";
		
		$data["order"]	=	$this->order->getOrderById($orderid);
  		$data["type"]	=	$type;
		$data["orderitems"]=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$orderid));		
		
		$this->load->view('restaurantportal/restaurantorders/ordersdetail',$data);
	
	}	

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/

	function detail($orderid)
	{
		$data	=	array();
		$data["order"]	=	$this->order->getOrderById($orderid);
  
		$data["orderitems"]=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$orderid));		
		
		$this->load->view('restaurantportal/restaurantorders/detail',$data);
	
	}	

	/*
	* @method This method will return the favorite restaurant details
	* @params It will take user Id as parameter 	
	*/

	function updateOrderStatus($Id)
	{
		$order	=	$this->order->getOrderById($Id);
		
		$orderArr1["id"]	=	$order["id"];
		$orderArr1["order_status"]	=	trim($this->input->get_post("order_status"));
		$orderArr1["reject_reason"]	=	trim($this->input->get_post("reject_reason"));
		
		$this->order->updateOrder($orderArr1);
		$order1	=	$this->order->getOrderById($Id);
		$this->order->updateOrderEmail($order1);
		
		echo $Id;			
		exit ();
	}
	
	function addPaidToRestaurant()
	{
		$arrInfo = array();
		$this->form_validation->set_rules('varia', 'Paid', 'numeric');
		
		$paid =  $this->input->get_post("varia");
		$id = $this->input->get_post("idlist");
		$status = $this->input->get_post("status");
		
		if ($this->form_validation->run() == FALSE)
		{
			echo "Only Numbers Allowed!!";
		}
		else
		{
			$arrInfo["id"] = $id;
			$arrInfo["status"] = $status;
			
			$arrInfo["paid_to_restaurant"] = $paid;
	
			$data["restaurants"] = $this->payment_history->updatePayment_History($arrInfo);
			echo "RECORD_ADDED";
		}
		
	}

	function manage_department()
	{
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurantID				=	$restaurantArr["id"];
		$restaurant_name			=	$restaurantArr["restaurant_name"];

		$data						=	array();
		$data["activemenu"]			=	"manage_department";
		$data["restaurantID"]		=	$restaurantID;
		$data["restaurant_name"]	=	$restaurant_name;

		$this->load->view('restaurantportal/managedepartment',$data);
	}

	function manage_employee()
	{
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurantID				=	$restaurantArr["id"];
		$restaurant_name			=	$restaurantArr["restaurant_name"];

		$data						=	array();
		$data["activemenu"]			=	"manage_role";
		$data["restaurantID"]		=	$restaurantID;
		$data["restaurant_name"]	=	$restaurant_name;

		$this->load->view('restaurantportal/Employee',$data);
	}

	function manage_location()
	{
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurantID				=	$restaurantArr["id"];
		$restaurant_name			=	$restaurantArr["restaurant_name"];

		$data						=	array();
		$data["activemenu"]			=	"manage_location";
		$data["restaurantID"]		=	$restaurantID;
		$data["restaurant_name"]	=	$restaurant_name;

		$this->load->view('restaurantportal/managelocation',$data);
	}

	function generate_qr_code () {
		
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurantID				=	$restaurantArr["id"];
		$restaurant_name			=	$restaurantArr["restaurant_name"];

		$data						=	array();
		$data["activemenu"]			=	"print_qr_code";
		$data["restaurantID"]		=	$restaurantID;
		$data["restaurant_name"]	=	$restaurant_name;

		$this->load->view('restaurantportal/qr_code/qr_code_page',$data);
	}

	function qr_code_ajax_handler () {
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurant_name			=	urlencode($restaurantArr["restaurant_name"]);

		    $table_number = $this->input->post('table_number');

        $path = base_url('m/').$restaurant_name;

        if (!empty($table_number)) {
        	$path = $path."/".urlencode($table_number);
        }


        ob_start();
		QRCode::png($path , null,"M","2","2");
		$imageString = base64_encode( ob_get_contents() );
		ob_end_clean();
		
		$qr_png = "data:image/png;base64, ".$imageString;

        $data_to_return 			= array();
		$data_to_return['QRCode'] 	= $qr_png;
        $data_to_return['Status'] 	= true;
        $data_to_return['Response'] = 'Proceed.';
        $data_to_return['Code'] 	= 'SUCCESS';
        $data_to_return['url_path'] 	= $path;

		header('Content-type: application/json');
        echo json_encode($data_to_return);
	}

	function print_qr_code ($table_number = null) {
		$restaurantArr 				= $this->session->userdata('restaurant');

		$restaurant_sid				=	$restaurantArr["id"];
		$restaurant_name			=	urlencode($restaurantArr["restaurant_name"]);

		// $path = base_url('userrestaurant/restaurantmenu')."/".$restaurant_sid."/".$table_number;
		$path = base_url('m/').$restaurant_name;

        if (!empty($table_number)) {
        	$path = $path."/".urlencode($table_number);
        }

        ob_start();
		QRCode::png($path , null,"M","2","2");
		$imageString = base64_encode( ob_get_contents() );
		ob_end_clean();
		
		$qr_png = "data:image/png;base64, ".$imageString;

        $data 						= array();
		$data['QRCode'] 			= $qr_png;
		//
		if (!empty($table_number)) {
        	$data['table_number'] 	= urldecode($table_number);
		}
		//
        $data['restaurant_name'] 	= $restaurant_name;
        $data['url_path']			= $path;
        
        $this->load->view('restaurantportal/qr_code/print_qr_code_page',$data);
	}


	
	

/**
.........................................................................................................
									End Restaurant Manage Orders Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
