<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantStaff extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');		
		$this->load->library('core/staff_core');
		$this->load->library('core/location_core');
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
	
/**
.........................................................................................................
									Start Restaurant Staff Section 
.........................................................................................................
*/	

	function index()
	{
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];

		$per_page	=	$this->config->item("PER_PAGE");

		$filters = array();
		$filters['name'] = 'all';
		$filters['role'] = 'all';

		if ($_POST) {
			$filters['name'] = $_POST['selected_staff_name'];
			$filters['role'] = $_POST['selected_staff_role'];	
		}
		
		$employees	=	$this->staff_core->getAllRestaurantEmployee($restaurantID, $filters, "No", $per_page, $this->uri->segment(3));
		$total_employees	=	$this->staff_core->getAllRestaurantEmployee($restaurantID, $filters, "Yes");

		$roles = $this->staff_core->getAllRActiveRoles($restaurantID);
		
		$config['base_url'] 	= base_url().'/restaurantstaff/index';
		$config['total_rows'] 	= $total_employees;
		$config['per_page'] 	= $per_page;
		$config['uri_segment'] 	= '3';
		$config['next_link'] 	= 'Next';
		$config['prev_link'] 	= 'Back';

		if( $total_employees > $per_page )
		{
			$this->pagination->initialize($config);
		}

		$data						= array();
		$data["roles"] 				= $roles;
		$data["filters"]			= $filters;
		$data["employees"]			= $employees;
		$data["restaurant"]			= $restaurantArr;
		$data['totalcount'] 		= $total_employees;
		$data["activemenu"]			= "restaurant_staff";
		$data['paginationLinks'] 	= $this->pagination->create_links();

		$this->load->view('restaurantportal/staff/restaurant_staff_new',$data);
	
	}

	function add_edit_employee ($employee_id) {
		$data	=	array();
		$data["activemenu"]	=	"restaurant_staff";
		$employee	=	array(
			'id' => 0,
			'firstname' => '',
			'lastname' => '',
			'email' => '',
			'phone_number' => '',
			'birthday' => date('Y-m-d'),
			'role_id' => 0,
			'address' => '',
			'country_id' => '',
			'state' => '',
			'city' => '',
			'zip' => '',
			'status' => 'Active',
			'is_manager' => 0,
			'staff_note' => '',
			'profile_picture' => ''
		);

		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];

		$restaurant_locations			=	$this->location_core->getAllRestaurantlocations($restaurantID);
		$data["restaurant_locations"] = $restaurant_locations;

		if ($employee_id != 0) {
			$employee	=	$this->staff_core->getRestaurantEmployee($employee_id);

			if ($employee['role_id'] != 0 ) {
				//
				$departments = $this->roles_core->getRestaurantlocationDepartments($employee['location_id']);
				$data["departments"] = $departments;
				//
				$roles = $this->roles_core->getDepartmentRoles($employee['department_id']);
				$data["roles"] = $roles;
				//
			}
			//
			$employment_info = $this->staff_core->getstaffEmploymentInfo($employee['id']);
			
			if (!empty($employment_info)) {
				$data["employment_info"] = $employment_info;
			}
			//
			$wage_info = $this->staff_core->getstaffWageInfo($employee_id);

			if (!empty($wage_info)) {
				$data["wage_info"] = $wage_info;
			}
		}

		if ($_POST)
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
			// $this->form_validation->set_rules('role_id', 'Role', 'required');
			if ($employee_id == 0 ) {
				$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
				$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			}
			
			$employee_array["firstname"]	=	$this->input->post("firstname");
			$employee_array["lastname"]		=	$this->input->post("lastname");
			$employee_array["email"]		=	$this->input->post("email");
			$employee_array["role_id"]		=	$this->input->post("role_id");
			$employee_array["phone_number"]	=	$this->input->post("phone_number");
			$employee_array["address"]		=	$this->input->post("address");
			$employee_array["country_id"]	=	$this->input->post("country_id");
			$employee_array["state"]		=	$this->input->post("state");
			$employee_array["city"]			=	$this->input->post("city");
			$employee_array["zip"]			=	$this->input->post("zip");
			$employee_array["password"]		=	md5($this->input->post("password"));
			$employee_array["status"]		=	$this->input->post("status");
			$employee_array["is_manager"]	=	$this->input->post("is_manager");
			

			if ($this->form_validation->run() == FALSE) {
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['email']			=	form_error('email');
				$errorsArray['firstname']		=	form_error('firstname');
				$errorsArray['lastname']		=	form_error('lastname');
				$errorsArray['phone_number']	=	form_error('phone_number');
				$errorsArray['role_id']			=	form_error('role_id');
				$errorsArray['password']		=	form_error('password');
				$errorsArray['passconf']		=	form_error('passconf');

				$employee_array["id"]			=	$employee_id;

				$data["errors"]=$errorsArray;
				$employee = $employee_array;
			
			} else {
				if ($employee_id!=0 && $employee_id!="") {
					//update
					$this->staff_core->updateEmployee($employee_id, $employee_array);
					$data["success"]=array("msg"=>"Employee updated successfully.");
				} else {
					//add
					$employee_array["restaurant_id"]	=	$restaurantID;
					$employee_array["type"]				=	"employee";
					$employee_id	=	$this->staff_core->addNewEmployee($employee_array);
					$data["success"]=array("msg"=>"Employee added successfully");
					$employee_array["id"]	=$employee_id;
				}
			}
		}

		$data["employee"]	=	$employee;
		$data["employee_id"]	=	$employee_id;
		$data["role_count"]	=	0;				
		
		$this->load->view('restaurantportal/staff/add_edit_employee_new',$data);
	}

	function handler()
    {
        // Check for ajax request
        if (!$this->input->is_ajax_request()) $this->resp();
        ///
        $post = $this->input->post(NULL, TRUE);
        //
        $restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
        //
        switch (strtolower($post['action'])) {
            // Add Staff Basic Info
            case 'add_staff':
            	$userInfo = $this->staff_core->isEmailAlreadyExist($post['email']);

		        if (!empty($userInfo)) {
		            $res['status'] = 'error';
                	$res['employee_id'] = 0;
                	$res['message'] = 'Provided staff email address is already in use!';
                	header('Content-type: application/json');
		        	echo json_encode($res);
		        	exit(0);
		        }

                $data_to_insert = array();
                $data_to_insert["firstname"]		= $post['firstname'];
				$data_to_insert["lastname"]			= $post['lastname'];
				$data_to_insert["email"]			= $post['email'];
				$data_to_insert["password"]			= md5($post['password']);
				$data_to_insert["phone_number"]		= $post['phone_number'];
				$data_to_insert["birthday"]			= $post['birthday'];
				$data_to_insert["address"]			= $post['address'];
				$data_to_insert["state"]			= $post['state'];
				$data_to_insert["city"]				= $post['city'];
				$data_to_insert["zip"]				= $post['zip'];
				$data_to_update["is_manager"]		= $post['is_manager'];
				$data_to_insert["restaurant_id"]	= $restaurantID;
				$data_to_insert["type"]				= "employee";
				//
				if (!empty($_FILES) && isset($_FILES['profile_picture']) && $_FILES['profile_picture']['size'] > 0 ) {
				
		            $target_file_name = clean_image_path(basename($_FILES["profile_picture"]["name"]));
		            $item_image_name = strtolower(md5(uniqid(rand(), true)).'_'.$target_file_name);
		            $target_dir = FCPATH . 'uploads/restaurant/resturant_staff/';

		            $target_file = $target_dir . $item_image_name;

		            if(!is_dir($target_dir)) {
		               mkdir($target_dir, 0777, true);
		            }

		            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
		            $data_to_insert["profile_picture"]		= $item_image_name;
		        }
				//
                $employee_id	=	$this->staff_core->addNewEmployee($data_to_insert);

                $res = array();
                if ($employee_id > 0) {
					$res['status'] = 'success';
					$res['employee_id'] = $employee_id;
					$res['message'] = 'Staff added successfully.';

					$staff_email = $post['email'];
					$staff_name = $post['firstname'].' '.$post['lastname'];
					$staff_pass = $post['password'];
					$restaurant_name = $restaurantArr["restaurant_name"];

					$this->send_email($staff_name, $staff_email, $staff_pass, $restaurant_name);
                }else {
                	$res['status'] = 'error';
                	$res['employee_id'] = 0;
                	$res['message'] = 'Error occurred while adding staff.';
                }
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // update Staff Basic Info
            case 'update_staff':
            	
            	$employee_id 		= $post['employee_id'];
				$old_staff_email	= $post['old_staff_email'];
				$new_email			= $post['email'];
				//
				if ($old_staff_email != $new_email) {
					$userInfo = $this->staff_core->isEmailAlreadyExist($post['email']);

			        if (!empty($userInfo)) {
			            $res['status'] = 'error';
	                	$res['employee_id'] = $employee_id;
	                	$res['message'] = 'Provided staff email address is already in use!';
	                	header('Content-type: application/json');
			        	echo json_encode($res);
			        	exit(0);
			        }
				}
				//
            	//
                $data_to_update 					= array();
                $data_to_update["firstname"]		= $post['firstname'];
				$data_to_update["lastname"]			= $post['lastname'];
				$data_to_update["email"]			= $post['email'];
				$data_to_update["phone_number"]		= $post['phone_number'];
				$data_to_update["birthday"]			= date('Y-m-d', strtotime($post['birthday']));
				$data_to_update["address"]			= $post['address'];
				$data_to_update["state"]			= $post['state'];
				$data_to_update["city"]				= $post['city'];
				$data_to_update["zip"]				= $post['zip'];
				$data_to_update["is_manager"]		= $post['is_manager'];
				//
				if(!empty($post['password'])){
					$data_to_update["password"]		= md5($post['password']);
				}
				//
				if (!empty($_FILES) && isset($_FILES['profile_picture']) && $_FILES['profile_picture']['size'] > 0 ) {
				
		            $target_file_name = clean_image_path(basename($_FILES["profile_picture"]["name"]));
		            $item_image_name = strtolower(md5(uniqid(rand(), true)).'_'.$target_file_name);
		            $target_dir = FCPATH . 'uploads/restaurant/resturant_staff/';

		            $target_file = $target_dir . $item_image_name;

		            if(!is_dir($target_dir)) {
		               mkdir($target_dir, 0777, true);
		            }

		            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
		            $data_to_update["profile_picture"]		= $item_image_name;
		        }
				//
                $this->staff_core->updateEmployee($employee_id, $data_to_update);
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				$res['message'] = 'Staff updated successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // update Staff Role Info
            case 'update_role_info':
            	$employee_id 						= $post['employee_id'];
            	//
                $data_to_update 					= array();
                $data_to_update["location_id"]		= $post['location_id'];
				$data_to_update["department_id"]	= $post['department_id'];
				$data_to_update["role_id"]			= $post['roles'];
				//
                $this->staff_core->updateEmployee($employee_id, $data_to_update);
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				$res['message'] = 'Staff role updated successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // update Staff Employment Info
            case 'update_employment_info':
            	$employee_id 						= $post['employee_id'];
            	//
            	$employment_info = $this->staff_core->getstaffEmploymentInfo($employee_id);
            	//
            	$max_hours 	= $post['weekly_hours'];
            	$hire_date 	= $post['hire_date'];
            	$status 	= $post['status'];
            	//
            	if (empty($employment_info)) {
            		$data_to_insert 				= array();
	                $data_to_insert["max_hours"]	= $max_hours;
					$data_to_insert["hire_date"]	= $hire_date;
					$data_to_insert["status"]		= $status;
					$data_to_insert["user_id"]		= $employee_id;
					//
                	$this->staff_core->insertEmploymentInfo($data_to_insert);
            	} else {
            		$row_id = $employment_info['id'];

            		$data_to_update 				= array();
	                $data_to_update["max_hours"]	= $max_hours;
					$data_to_update["hire_date"]	= $hire_date;
					$data_to_update["status"]		= $status;
					//
                	$this->staff_core->updateEmploymentInfo($employee_id, $data_to_update);
            	}
                
				
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				$res['message'] = 'Staff employment info updated successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // update Staff Wage Info
            case 'update_wage_info':
            	$employee_id 						= $post['employee_id'];
            	//
            	$wage_info = $this->staff_core->getstaffWageInfo($employee_id);
            	//
            	$wage_type 	= $post['wage_type'];
            	$wage_rate 	= $post['wage_rate'];
            	$status 	= $post['status'];
            	//
            	if (empty($wage_info)) {
            		$data_to_insert 				= array();
	                $data_to_insert["wage_type"]	= $wage_type;
					$data_to_insert["wage"]			= $wage_rate;
					$data_to_insert["status"]		= $status;
					$data_to_insert["user_id"]		= $employee_id;
					//
                	$this->staff_core->insertWageInfo($data_to_insert);
            	} else {
            		$row_id = $wage_info['id'];

            		$data_to_update 				= array();
	                $data_to_update["wage_type"]	= $wage_type;
					$data_to_update["wage"]			= $wage_rate;
					$data_to_update["status"]		= $status;
					//
                	$this->staff_core->updateWageInfo($employee_id, $data_to_update);
            	}
                
				
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				$res['message'] = 'Staff wage info updated successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // update Staff Note
            case 'update_staff_scheduling_note':
            	$employee_id 						= $post['employee_id'];
            	//
                $data_to_update 					= array();
                $data_to_update["staff_note"]		= $post['note'];
				//
                $this->staff_core->updateEmployee($employee_id, $data_to_update);
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				$res['message'] = 'Staff scheduling note updated successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // get department
            case 'get_department':
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

            // Update Staff Status
            case 'update_staff_status':
                $employee_id 						= $post['employee_id'];
                $employee_status					= $post['status'];
                $staff_name							= $post['staff_name'];
            	//
                $data_to_update 					= array();
                $data_to_update["status"]			= $employee_status;
				//
                $this->staff_core->updateEmployee($employee_id, $data_to_update);
                //
                $res = array();
				$res['status'] = 'success';
				$res['employee_id'] = $employee_id;
				if ($employee_status == 'Active') {
					$res['message'] = '<b>'.$staff_name.'</b> active successfully.';
				} else if ($employee_status == 'Inactive') {
					$res['message'] = '<b>'.$staff_name.'</b> inactive successfully.';
				} else if ($employee_status == 'Deleted') {
					$res['message'] = '<b>'.$staff_name.'</b> deleted successfully.';
				}
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

        }    
    }

    private function send_email ($name, $email, $password, $restaurant_name) {
    	$data['staff_name']			=	$name;
		$data['staff_email']		=	$email;
		$data["staff_password"]		=	$password;
		$data['restaurant_name']	=	$restaurant_name;
		//
		$this->load->library('email');
		//				
		$adminemail	=	$this->config->item("adminEmail");
		$Subject	=	$this->config->item("signupSubject");
		//
		$config['wordwrap'] = TRUE;
		//
		$this->email->initialize($config);
		$this->email->from($adminemail, $this->config->item("adminName"));
		$this->email->to($email);
		$this->email->subject($Subject);
		$this->email->message($this->load->view('email/staff_created',$data,true));
		$this->email->send();
    }
/**
.........................................................................................................
									End Restaurant Staff Section 
.........................................................................................................
*/	


}

?>
