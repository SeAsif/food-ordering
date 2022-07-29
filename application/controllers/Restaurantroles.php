<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Restaurantroles extends CI_Controller {

	function __construct()
	{
        parent::__construct();
		$this->load->library('core/restaurant');		
		$this->load->library('core/roles_core');
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

		$restaurant_locations			=	$this->roles_core->getAllRestaurantlocations($restaurantID);
		$restaurant_roles               =   $this->roles_core->getAllRestaurantRoles($restaurantID);
        
        $data							=	array();
		$data["activemenu"]				=	"manage_role";
		$data["restaurantID"]			=	$restaurantID;
		$data["restaurant_name"]		=	$restaurant_name;
		$data["restaurant_roles"]	    =	$restaurant_roles;
		$data["restaurant_locations"]	=	$restaurant_locations;
		$this->load->view('restaurantportal/managerole', $data);
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
            case 'add_role':
                $data_to_insert = array();
                $data_to_insert['location'] = $post['location'];
                $data_to_insert['department'] = $post['department'];
                $data_to_insert['role_name'] = $post['role'];
                $data_to_insert['role_color'] = $post['color'];
                $data_to_insert['restaurantID'] = $post['restaurant_id'];

                $this->roles_core->addNewRole($data_to_insert);

                $res = array();
                $res['status'] = 'Add role successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // get department
            case 'get_departments':
            	$location_id = $post['location_id'];
                $departments = $this->roles_core->getRestaurantlocationDepartments($location_id);

                $res = array();
                $res['departments'] = $departments;
                if (!empty($departments)) {
                	$res['status'] = 'success';
                }else {
                	$res['status'] = 'error';
                }
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // get department
            case 'get_role':
                $role_id = $post['role_id'];
                $role = $this->roles_core->getRestaurantRole($role_id);
                $location_id = $role['location'];
                $departments = $this->roles_core->getRestaurantlocationDepartments($location_id);

                $res = array();
                $res['role'] = $role;
                $res['departments'] = $departments;
                if (!empty($departments)) {
                    $res['status'] = 'success';
                }else {
                    $res['status'] = 'error';
                }
                
                header('Content-type: application/json');
                echo json_encode($res);
                exit(0);
            break;   

            // update department
            case 'update_role':
                $data_to_update = array();
                $data_to_update['location'] = $post['location'];
                $data_to_update['department'] = $post['department'];
                $data_to_update['role_name'] = $post['role'];
                $data_to_update['role_color'] = $post['color'];
                $role_id = $post['role_id'];

                $this->roles_core->updateRole($role_id, $data_to_update);

                $res = array();
                $res['status'] = 'Role update successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // update department
            case 'delete_role':
                $role_id = $post['role_id'];

                $this->roles_core->deleteRestaurantRole($role_id);

                $res = array();
                $res['status'] = 'Role delete successfully.';
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // update department
            case 'get_department_roles':
                $department_id = $post['department_id'];

                $roles = $this->roles_core->getDepartmentRoles($department_id);
                
                $res = array();
                $res['roles'] = $roles;

                if (!empty($roles)) {
                    $res['status'] = 'success';
                }else {
                    $res['status'] = 'error';
                }

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
