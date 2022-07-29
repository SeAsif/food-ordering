<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Schedule extends CI_Controller {
	

	function index()
	{
		$data	=	array();
		$data["activemenu"]	=	"schedule";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/schedule',$data);
	
	}	

	function ListSchedule()
	{
		$data	=	array();
		$data["activemenu"]	=	"listschedule";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/listschedule',$data);
	
	}	
	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
