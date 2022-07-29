<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Accountsetting extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		
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
									Start Restaurant Account Settings Section 
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


/**
.........................................................................................................
									End Restaurant Account Settings Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>