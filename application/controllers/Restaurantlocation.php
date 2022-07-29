<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantLocation extends CI_Controller {

	function __construct()
	{
        // exit;

        parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');		
		$this->load->library('core/location_core');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');	
		
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
	
	function index()
	{		
        $restaurantArr 					= $this->session->userdata('restaurant');

		$restaurantID					=	$restaurantArr["id"];
		$restaurant_name				=	$restaurantArr["restaurant_name"];

		$restaurant_managers			=	$this->location_core->getAllRestaurantManager($restaurantID);
		$restaurant_locations			=	$this->location_core->getAllRestaurantlocations($restaurantID);
        
        $data							=	array();
		$data["activemenu"]				=	"manage_location";
		$data["restaurantID"]			=	$restaurantID;
		$data["restaurant_name"]		=	$restaurant_name;
		$data["restaurant_managers"]	=	$restaurant_managers;
		$data["restaurant_locations"]	=	$restaurant_locations;
		$this->load->view('restaurantportal/managelocation', $data);
	}

	function handler()
    {
        // Check for ajax request
        if (!$this->input->is_ajax_request()) $this->resp();
        ///
        $post = $this->input->post(NULL, TRUE);
        //
        switch (strtolower($post['action'])) {
            // add new location
            case 'add_loaction':
                $data_to_insert = array();
                $data_to_insert['location'] = $post['location'];
                $data_to_insert['address'] = $post['address'];
                $data_to_insert['manager_id'] = $post['manager'];
                $data_to_insert['time_zone'] = $post['time_zone'];
                $data_to_insert['restaurant_id'] = $post['restaurant_id'];

                $this->location_core->addRestaurantLocation($data_to_insert);

                $res = array();
                $res['status'] = 'Add location successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // get location
            case 'get_loaction':
            	$location_id = $post['location_id'];
                $location = $this->location_core->getRestaurantLocation($location_id);

                $res = array();
                $res['location'] = $location;
                if (!empty($location)) {
                	$res['status'] = 'success';
                }else {
                	$res['status'] = 'error';
                }
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;   

            // update location
            case 'update_loaction':
                $data_to_update = array();
                $data_to_update['location'] = $post['location'];
                $data_to_update['address'] = $post['address'];
                $data_to_update['manager_id'] = $post['manager'];
                $data_to_update['time_zone'] = $post['time_zone'];
                $location_id = $post['location_id'];

                $this->location_core->updateRestaurantLocation($location_id, $data_to_update);

                $res = array();
                $res['status'] = 'Location update successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // update location
            case 'delete_loaction':
                $location_id = $post['location_id'];

                $this->location_core->deleteRestaurantLocation($location_id);

                $res = array();
                $res['status'] = 'Location delete successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

        }    
    }

    /**
     * AJAX Responder
     */
    private function resp()
    {
        
    }


	
}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
