<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class PaymentHistory extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/payment_history');
		
	}
	
/**
.........................................................................................................
									Start Restaurant Food Categories Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$this->payment_history->calculatePaymentHistory();
	}

/**
.........................................................................................................
									End Restaurant Food Categories Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>