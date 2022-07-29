<?

/**
 * Iphone service for restaurant section
 * This class returns the any kind of restaurant related data
 * @author Mustafa Mahmood
 * @category Iphone Service
 */


?>
<style>
	.navbar-expand-lg,
	.navbar-expand-lg {
		display: none !important;
	}
</style>

<?php

class Manageraccount extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');
		$this->load->library('form_validation');
		$this->load->helper(array('dropdown_helper'));
		$this->load->library('core/defaultvariant');
	}



	function createaccount()
	{
		$errorsArray = array();
		$arrInfo["email"]	=	'';
		$arrInfo["firstname"]	=	'';
		$arrInfo["lastname"]	=	'';
		$data	=	array();
		$data["flag"] = 0;
		if ($_POST) {
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|callback_if_user_exists_ci_validation');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');

			$this->form_validation->set_rules('name', 'Restaurant Name', 'trim|required');
			// $this->form_validation->set_rules('slogan', 'Restaurant Slogan', 'trim|required');
			// $this->form_validation->set_rules('details', 'Details', 'trim|required');
			$this->form_validation->set_rules('restaurant_email', 'Restaurant Email', 'required|valid_email|trim|callback_if_restaurant_exists_ci_validation');
			if ($this->form_validation->run() == FALSE) {
				//------------errors stored in array------------//
				$errorsArray['email']	=	form_error('email');
				$errorsArray['firstname']	=	form_error('firstname');
				$errorsArray['lastname']	=	form_error('lastname');
				$errorsArray['phone_number']	=	form_error('phone_number');
				$errorsArray['password']	=	form_error('password');
				$errorsArray['passconf']	=	form_error('passconf');

				$errorsArray['name']	=	form_error('name');
				// $errorsArray['slogan']	=	form_error('slogan');
				// $errorsArray['details']	=	form_error('details');
				$errorsArray['restaurant_email']	=	form_error('restaurant_email');

				$data["errors"] = $errorsArray;
			} else {

				$arrInfo["email"] = trim($this->input->post("email"));
				$arrInfo["firstname"] = trim($this->input->post("firstname"));
				$arrInfo["lastname"] = trim($this->input->post("lastname"));
				$arrInfo["phone_number"] = trim($this->input->post("phone_number"));
				$arrInfo["password"] = md5(trim($this->input->post("password")));
				$arrInfo["address"]= trim($this->input->post("address"));
				$arrInfo["country_id"]= trim($this->input->post("country_id"));
				$arrInfo["city"]= trim($this->input->post("city"));
				$arrInfo["state"]= trim($this->input->post("state"));
				$arrInfo["zip"]= trim($this->input->post("zip"));
				$arrInfo["status"]= trim($this->input->post("status"));

				$restaurantDetail["restaurant_name"]	=	$this->input->post("name");
				// $restaurantDetail["restaurant_slogan"]	=	$this->input->post("slogan");
				// $restaurantDetail["restaurant_details"]	=	$this->input->post("details");
				$restaurantDetail["email"]	=	$this->input->post("restaurant_email");
				$existing_res = $this->restaurant->listRestaurantByName($restaurantDetail["restaurant_name"]);
				if (count($existing_res) > 0) {
					$errorsArray['duplicate']	=	"Restaurant already exists";
					$data["errors"] = $errorsArray;
				} else {
					$arrInfo["type"] = "restaurantowner";
					$res = $this->user->addUser($arrInfo);
					if ($res["response"] == "RECORD_ADDED") {
						$restaurantDetail['user_id'] = $res['insert_id'];
						$res = $this->restaurant->addRestaurant($restaurantDetail);
						$this->restaurant->addDefaultVariantToRestaurant($this->defaultvariant->getDefaultVariant(), $res);
						redirect("restaurantportal");
					} else {
						$errorsArray['duplicate']	=	"Email address already exists";
						$data["errors"] = $errorsArray;
					}
				}
			}
		}
		$data["errors"]	=	$errorsArray;
		$data["userDetail"] = $arrInfo;
		$this->load->view('userfront/useraccount/createmanager', $data);
	}

	function if_user_exists_ci_validation($email) {
       
        $userInfo = $this->restaurant->isEmailAlreadyExist($email);
        $return = FALSE;

        if (empty($userInfo)) {
            $return = TRUE;
        }

        $this->form_validation->set_message('if_user_exists_ci_validation', 'Provided manager email address is already in use!');
        return $return;
    }

    function if_restaurant_exists_ci_validation($email) {
        
        $userInfo = $this->restaurant->isEmailAlreadyExist($email);
        $return = FALSE;

        if (empty($userInfo)) {
            $return = TRUE;
        }

        $this->form_validation->set_message('if_restaurant_exists_ci_validation', 'Provided restaurant email address is already in use!');
        return $return;
    }

	function login()
	{
		$this->load->view('userfront/useraccount/loginScreen');
	}
}
