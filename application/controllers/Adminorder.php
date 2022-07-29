<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class AdminOrder extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/order');
		$this->load->library('core/airport_core');
		$this->load->library('core/orderitem');		
		$this->load->library('core/terminals');		
		$this->load->library('core/restaurant');		
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		// if( $this->session->userdata('type')== FALSE || $this->session->userdata('type') != "admin")
		if( !$this->session->userdata('admin_session'))
		redirect(base_url()."admin",true);
	}
	
/**
.........................................................................................................
									Manage Orders Section 
.........................................................................................................
*/	
function resetorderfilter()
{
	if($this->session->userdata("orderfilters")	==	true )
	{
		$this->session->unset_userdata('orderfilters');
	}
	redirect (base_url()."adminorder");
}
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data["errors"]	=	"";
		
		$per_page = 10;
		
		$filters	=	array("order_status"=>"All");
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Orders',
		   'url' => base_url()."adminorder/",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  	
		$data["airportList"]=$this->airport_core->listAirport();
		$data['terminals']	=	$this->terminals->listTerminals(0);
		$data['restaurants']	=	$this->restaurant->listRestaurant(0,"Active");
		$data['orderstatuses']	=	array("0"=>"Unpaid","1"=>"Pending","2"=>"Confirmed","3"=>"Rejected");
	//	print_r($data["airportList"]);

		if ($_POST)
		{
		
			if ($this->input->post("airport")!="select")
				$filters["airport_id"]	=	$this->input->post("airport");
			if ($this->input->post("terminal_name")!="select")
				$filters["terminal_id"]	=	$this->input->post("terminal_name");
			if ($this->input->post("restaurant")!="select")
				$filters["restaurant_id"]	=	$this->input->post("restaurant");
			if ($this->input->post("orderstatus")!="select")
				$filters["order_status"]	=	$this->input->post("orderstatus");
			if (trim($this->input->post("order_code"))!="")
				$filters["order_code"]	=	trim($this->input->post("order_code"));
				
			$orderfilterarray = array('orderfilters'=> $filters);			
			
			$this->session->set_userdata($orderfilterarray);

			if ($this->input->post("Export"))	
			$filters["isExport"]	=	"Yes";

		}
		else
		{
		
			if($this->session->userdata("orderfilters")	==	true )
			{
				$filters	=	$this->session->userdata("orderfilters");
			}		
		}
		
		$data["order"]	=	$filters;
		
		$filters["count"]	=	"No";

		$data["list"]=$this->order->getOrders($filters,$per_page, $this->uri->segment(3));

		$filters["count"]	=	"Yes";
		$total	=	$this->order->getOrders($filters);
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'/adminorder/index';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '3';
		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();
		
		$this->load->view('admin/order/index',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function orderdetail($orderId)
	{
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Order Detail',
		   'url' => base_url()."adminorder/orderdetail",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["order"]=$this->order->getOrderById($orderId);
		
		$data["orderitems"]=	$this->orderitem->getOrderItemWithVariants(array("order_id"=>$orderId));
		
		$this->load->view('admin/order/detail',$data);
		
	}
/**
.........................................................................................................
									End Of Orders Management 
.........................................................................................................
*/	
}
/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
