<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Designsettings extends CI_Controller {
	

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		
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

	function theme_setting()
	{
		$data	=	array();
		$data["activemenu"]	=	"themesettigs";
		
		$restaurantArr = $this->session->userdata('restaurant');
		if(!empty($_POST)){
			unset($_POST['saveSetting']);
			$json = json_encode($_POST);
			$restaurantArr['theme_settings'] = $json;
			$this->restaurant->updateRestaurant($restaurantArr);		
			$this->session->set_userdata("restaurant",$restaurantArr);
			$data["success"]=array("msg"=>"Updated Successfully");
		}		
		$data["restaurant"]	=	$restaurantArr;

		$this->load->view('restaurantportal/theme_setting',$data);
	
	}	
	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
