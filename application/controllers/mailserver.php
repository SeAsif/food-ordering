<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class MailServer extends CI_Controller {
	

	function index()
	{
		$data	=	array();
		$data["activemenu"]	=	"automations";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/automations/automations',$data);
	
	}	

	function AddCampaign()
	{
		$data	=	array();
		$data["activemenu"]	=	"addcampaign";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/automations/addcampaign',$data);
	
	}	
}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>