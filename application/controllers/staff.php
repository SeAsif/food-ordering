<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Staff extends CI_Controller {
	private $_obj;

	function __construct()
	{

		// $this->_obj =& get_instance();
		parent::__construct();
		/*load database libray manually*/
		$this->load->database();
		$this->load->library('core/restaurant');
		$this->load->library('email');
		$this->load->library('pagination');

		/*load Model*/
		$this->load->model('Payroll_model');
	
		
		
		
	}

	function staffHours()
	{
		$data	=	array();
		$data["activemenu"]	=	"staffhours";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/staff_hour',$data);
	
	}	

	function appEmployee()
	{
		$data	=	array();
		$data["activemenu"]	=	"appEmployee";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/appEmployee',$data);
	
	}	

	function employee()
	{
		$data	=	array();
		$data["activemenu"]	=	"employee";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/employee',$data);
	
	}

	
}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>