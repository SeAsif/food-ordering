<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Restaurantdepartment extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->library('core/restaurant');		
		$this->load->library('core/department_core');
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

		$restaurant_locations			=	$this->department_core->getAllRestaurantlocations($restaurantID);
		$restaurant_departments         =   $this->department_core->getAllRestaurantDepartments($restaurantID);
        
        $data							=	array();
		$data["activemenu"]				=	"manage_department";
		$data["restaurantID"]			=	$restaurantID;
		$data["restaurant_name"]		=	$restaurant_name;
		$data["restaurant_locations"]	=	$restaurant_locations;
		$data["restaurant_departments"]	=	$restaurant_departments;
		$this->load->view('restaurantportal/managedepartment', $data);
	}

	function handler()
    {
        // Check for ajax request
        if (!$this->input->is_ajax_request()) $this->resp();
        ///
        $post = $this->input->post(NULL, TRUE);
        //
        switch (strtolower($post['action'])) {
            // add new department
            case 'add_department':
                $data_to_insert = array();
                $data_to_insert['location_id'] = $post['location'];
                $data_to_insert['department_name'] = $post['department'];
                $data_to_insert['restaurant_id'] = $post['restaurant_id'];

                $this->department_core->addRestaurantDepartment($data_to_insert);

                $res = array();
                $res['status'] = 'Add department successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // get department
            case 'get_department':
            	$department_id = $post['department_id'];
                $department = $this->department_core->getRestaurantDepartment($department_id);

                $res = array();
                $res['department_info'] = $department;
                if (!empty($department)) {
                	$res['status'] = 'success';
                }else {
                	$res['status'] = 'error';
                }
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;   

            // update department
            case 'update_department':
                $data_to_update = array();
                $data_to_update['department_name'] = $post['department'];
                $data_to_update['location_id'] = $post['location'];
                $department_id = $post['department_id'];

                $this->department_core->updateRestaurantDepartment($department_id, $data_to_update);

                $res = array();
                $res['status'] = 'Department update successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // update department
            case 'delete_department':
                $department_id = $post['department_id'];

                $this->department_core->deleteRestaurantLocation($department_id);

                $res = array();
                $res['status'] = 'Location delete successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

        }    
    }


	
}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
