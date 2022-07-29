<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantSettings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');		
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
									Start Restaurant Settings Section 
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

	function basicinfo()
	{
		$data	=	array();
		$data["activemenu"]	=	"basicinfo";
		
		$restaurantArr = $this->session->userdata('restaurant');
		if ($_POST)
		{
			$this->form_validation->set_rules('restaurant_name', 'Restaurant Name', 'trim|required');
			$this->form_validation->set_rules('restaurant_details', 'Restaurant Details', 'trim|required|max_length[1000]');
			$this->form_validation->set_rules('delivery_time_before', 'Before Delivery Order display time', 'trim|required');
			$this->form_validation->set_rules('city_tax', 'City Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('state_tax', 'State Tax', 'trim|numeric|callback_checktax');
			
			$restaurantArr["restaurant_name"]		=	$this->input->post("restaurant_name");
			$restaurantArr["restaurant_details"]	=	$this->input->post("restaurant_details");
			$restaurantArr["delivery_time_before"]	=	$this->input->post("delivery_time_before");
			$restaurantArr["restaurant_citytax"]	=	$this->input->post("city_tax");
			$restaurantArr["restaurant_statetax"]	=	$this->input->post("state_tax");
			$restaurantArr["allow_banner"]			=	$this->input->post("allow_banner");
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['restaurant_name']	=	form_error('restaurant_name');
				$errorsArray['restaurant_details']	=	form_error('restaurant_details');
				$errorsArray['delivery_time_before']	=	form_error('delivery_time_before');
				$errorsArray['city_tax']	=	form_error('city_tax');
				$errorsArray['state_tax']	=	form_error('state_tax');
				
				$data["errors"]=$errorsArray;
			}
			else
			{
				if (empty($restaurantArr["allow_banner"])) {
					$restaurantArr["allow_banner"] = 'No';
				}

				//update here
				$this->restaurant->updateRestaurant($restaurantArr);

				$data["success"]=array("msg"=>"Updated Successfully");
				
				$this->session->set_userdata("restaurant",$restaurantArr);
			}
		}
				
		$data["restaurant"]	=	$restaurantArr;
		$data["banner"]=$this->restaurant->getRestaurantBanner($restaurantArr["id"]);
		$data["mobile_banner"]=$this->restaurant->getRestaurantMobileBanner($restaurantArr["id"]);
		// echo "<pre>";
		// print_r($data);

		$this->load->view('restaurantportal/restaurant/basicinfo',$data);
	
	}	
	function basicfeatures()
	{
		$data	=	array();
		$data["activemenu"]	=	"basicfeatures";
		$restaurantArr = $this->session->userdata('restaurant');
		if ($_POST)
		{
			$restaurantArr["pre_order"]	=	($this->input->post("pre_order")?$this->input->post("pre_order"):"No");
			$restaurantArr["take_out"]	=	($this->input->post("take_out")?$this->input->post("take_out"):"No");
			$restaurantArr["dine_in"]	=	($this->input->post("dine_in")?$this->input->post("dine_in"):"No");
			$restaurantArr["delivery"]	=	($this->input->post("delivery")?$this->input->post("delivery"):"No");
			if($restaurantArr["delivery"] == "Yes"){
				$restaurantArr["delivery_charge"]	=	$this->input->post("delivery_charge");
			}
			//			$restaurantArr["legal_sea_food"]	=	($this->input->post("legal_sea_food")?$this->input->post("legal_sea_food"):"No");
			$restaurantArr["proximity_to_gate"]	=	($this->input->post("proximity_to_gate")?$this->input->post("proximity_to_gate"):"0");
			$restaurantArr["location_security"]	=	($this->input->post("location_security")?$this->input->post("location_security"):"Post");

			//update here
			$data["success"]=array("msg"=>"Updated Successfully");
			$this->restaurant->updateRestaurant($restaurantArr);

			$this->session->set_userdata("restaurant",$restaurantArr);
			
		}
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/restaurant/basicfeatures',$data);
	
	}	

	public function upload_banner() {
		
		if (!empty($_FILES) && isset($_FILES['docs']) && $_FILES['docs']['size'] > 0 ) {
			$restaurant_id = $_POST['id'];
			$banner_type = $_POST['upload_type'];
            $target_file_name = basename($_FILES["docs"]["name"]);
            $banner_name = strtolower(md5(uniqid(rand(), true)).'_'.$target_file_name);
            $target_dir = FCPATH . 'uploads/restaurant/banner/';

            $target_file = $target_dir . $banner_name;

            if(!is_dir($target_dir)) {
               mkdir($target_dir, 0777, true);
            }

            move_uploaded_file($_FILES["docs"]["tmp_name"], $target_file);

            //update here
            $data_to_update = array();

            if ($banner_type == 'desktop') {
            	$data_to_update["banner"]	=	$banner_name;
            } else {
            	$data_to_update["mobile_banner"]	=	$banner_name;
            }

            $this->restaurant->updateRestaurantBanner($data_to_update, $restaurant_id);
			// $this->restaurant->updateRestaurant($restaurantArr);
			// $this->session->set_userdata("restaurant",$restaurantArr);
            echo 'success';

        }
    }


	function logoslogan()
	{
		$data	=	array();
		$data["activemenu"]	=	"logoslogan";

		$restaurantArr = $this->session->userdata('restaurant');
		$data["new_logo"] = $restaurantArr['logo'];
		if ($_POST)
		{
			//print_r ($_POST);
			$logoUpload	=	$this->input->post("logoupload");
			if ($logoUpload	==	"logoupload")
			{
				$config['upload_path'] = $this->config->item('restaurant_image_path');
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '2048';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				$config['file_name']=md5(uniqid(rand(), true))."_".str_replace(" ","_",$_FILES['logo']['name']);
				
				$this->load->library('upload', $config);
			
				if ( ! $this->upload->do_upload('logo'))
				{
					$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
					$error = array('error' => $this->upload->display_errors());
					$data['errors']=$error;
				}	
				else
				{
					
					$config1['image_library'] = 'gd2';
					$config1['source_image'] = $this->config->item('restaurant_image_path')."/".$config['file_name'];
					$config1['new_image'] = $this->config->item('restaurant_logo_path').$config['file_name'];
					$config1['maintain_ratio'] = TRUE;
					$config1['width'] = 123;
					$config1['height'] = 120;
					
					$this->load->library('image_lib');

					$this->image_lib->initialize($config1);
					
					$this->image_lib->resize();
					if ( ! $this->image_lib->resize())
					{
						echo $this->image_lib->display_errors();
					}

					$config2['image_library'] = 'gd2';
					$config2['source_image'] = $this->config->item('restaurant_image_path')."/".$config['file_name'];
					$config2['new_image'] = $this->config->item('restaurant_logo_thumb_path').$config['file_name'];

					$config2['maintain_ratio'] = TRUE;
					$config2['width'] = 38;
					$config2['height'] = 38;
					
					$this->image_lib->initialize($config2);
					
					$this->image_lib->resize();
										
					$data["new_logo"]	=	$config['file_name'];
				}
			
			}
			else
			{
//				$this->form_validation->set_rules('restaurant_slogan', 'Restaurant Slogan', 'trim|required');
				$restaurantArr["restaurant_slogan"]	=	$this->input->post("restaurant_slogan");
/*				if ($this->form_validation->run() == FALSE)
				{
					$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
					$errorsArray['restaurant_slogan']	=	form_error('restaurant_slogan');
					$data["errors"]=$errorsArray;
				}
				else
				{
*/				
					$logo	=	$this->input->post("logo");
					if ($logo!=""){
						$data["new_logo"] = $logo;
						$restaurantArr["logo"]	=	$logo;
					}						
					
					//update here
					$this->restaurant->updateRestaurant($restaurantArr);

					$this->session->set_userdata("restaurant",$restaurantArr);

					$data["success"]=array("msg"=>"Updated Successfully");

					
//				}
				
			}
		}

		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/restaurant/logoslogan',$data);
	
	}	

	function mapandlocation()
	{
		$data	=	array();
		$data["activemenu"]	=	"mapandlocation";
		$restaurantArr = $this->session->userdata('restaurant');
		if ($_POST)
		{
			$this->form_validation->set_rules('address', 'Restaurant Address', 'trim|required');
			$restaurantArr["address"]	=	$this->input->post("address");
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');

				$errorsArray['address']	=	form_error('address');
				$data["errors"]=$errorsArray;
			}
			else
			{
				//update here
				$this->restaurant->updateRestaurant($restaurantArr);

				$this->session->set_userdata("restaurant",$restaurantArr);
				$data["success"]=array("msg"=>"Updated Successfully");
				
			}
			
		}
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/restaurant/mapandlocation',$data);
	
	}	
	
	/*
	* @method This method will check if admin is logged in
	* @params no parameter
	*/
	function logout()
	{
		//session_destroy();
		$this->session->sess_destroy();
		
		redirect("restaurantportal");
	}
	

	function changepassword()
	{
		$data	=	array();
		$data["activemenu"]	=	"changepassword";
		$errorsArray	=	array();

		$email = $this->session->userdata('email');
		
		if ($_POST)
		{
			$this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
			$this->form_validation->set_rules('Password', 'New Password', 'required|trim|matches[ConfirmPassword]');
			$this->form_validation->set_rules('ConfirmPassword', 'Confirm New Password', 'required|trim');
	
			$data["email"]	=	trim($email);
			$data["password"]	=	md5(trim($this->input->post("currentpassword")));
			
			if ($this->form_validation->run() == FALSE)
			{
				$errorsArray['currentpassword']	=	form_error('currentpassword');
				$errorsArray['Password']	=	form_error('Password');
				$errorsArray['ConfirmPassword']	=	form_error('ConfirmPassword');
			}
			else
			{
				$arrUser=$this->restaurant->login($data);
				if ($arrUser	==	"Login_Error")
				{
					$errorsArray['Username']	=	"Sorry! You entered wrong password.";
				}
				else
				{
					$userInfo["id"]	=	$arrUser["restaurant"]["user_id"]	;
					$userInfo["password"]	=	md5(trim($this->input->post("ConfirmPassword")));
					$result	=	$this->user->updateUser($userInfo);
					if (isset($result['response']) &&$result['response']	==	"RECORD_UPDATED")
						$data["success"]=array("msg"=>"Password changed successfully.");
					else
						$errorsArray['Error']	=	"Sorry! You entered wrong password.";
					

					//redirect(base_url()."restaurantcategory/managefoodcategories");
				}
			}
		}
		
		$data["errors"]	=	$errorsArray;
		
		$this->load->view('restaurantportal/accountsettings/changepassword',$data);
	
	}	

	function checktax($str)
	{
		if($str < 1 && $str != 0)
		{
			$this->form_validation->set_message('checktax', 'The %s field should be in percentage. Cannot be less than 1');
			return FALSE;
		}
		else if($str > 100)
		{
			$this->form_validation->set_message('checktax', 'The %s field should be less than 100.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function paymentgateway()
	{
		$data	=	array();
		$data["activemenu"]	=	"paymentgateway";
		$errorsArray	=	array();

		$restaurantArr = $this->session->userdata('restaurant');
		
		if ($_POST)
		{
			$this->form_validation->set_rules('payment_gateway', 'payment_gateway', 'required|trim');
			
			if ($this->form_validation->run() == FALSE)
			{
				$errorsArray['secret_key']	=	form_error('secret_key');
			}
			else
			{
				$post = $this->input->post();
			
				$restaurantArr["paystack_secret_key"] = $post["paystack_secret_key"];
				$restaurantArr["flutterwave_secret_key"] = $post["flutterwave_secret_key"];
				$restaurantArr["payment_gateway"] = $post["payment_gateway"];
				$this->restaurant->updateRestaurant($restaurantArr);

				$data["success"] = array("msg"=>"Payment gateway update successfully.");	

			}
		}

		$data["payment_gateway_info"] = $this->restaurant->getRestaurantSecretKey($restaurantArr['id']);
		$data["restaurant"] = $restaurantArr;
		$data["errors"]	=	$errorsArray;
		
		$this->load->view('restaurantportal/bankdetail/paystack',$data);
	
	}

	function bankinformation()
	{
		$data	=	array();
		$data["activemenu"]	=	"bankinformation";
		$errorsArray	=	array();

		$email = $this->session->userdata('email');
		
		if ($_POST)
		{
			$this->form_validation->set_rules('IBAN', 'IBAN', 'required|trim');
			$this->form_validation->set_rules('account_name', 'Account Name', 'required|trim');
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required|trim');
			$this->form_validation->set_rules('country', 'Country', 'required|trim');
			$this->form_validation->set_rules('address', 'Address', 'required|trim');
			$this->form_validation->set_rules('city', 'City', 'required|trim');
			
			if ($this->form_validation->run() == FALSE)
			{
				$errorsArray['IBAN']			=	form_error('IBAN');
				$errorsArray['account_name']	=	form_error('account_name');
				$errorsArray['bank_name']		=	form_error('bank_name');
				$errorsArray['country']			=	form_error('country');
				$errorsArray['address']			=	form_error('address');
				$errorsArray['city']			=	form_error('city');
			}
			else
			{
				$restaurantArr 				= $this->session->userdata('restaurant');
				$post = $this->input->post();

				$data_to_insert = array();
				$data_to_insert['restaurant_sid'] 	=	$restaurantArr["id"];
				$data_to_insert['restaurant_name']	=	$restaurantArr["restaurant_name"];
				$data_to_insert['IBAN']	=	$post["IBAN"];
				$data_to_insert['account_number']	=	$post["account_number"];
				$data_to_insert['account_name']	=	$post["account_name"];
				$data_to_insert['bank_name']	=	$post["bank_name"];
				$data_to_insert['country']	=	$post["country"];
				$data_to_insert['address']	=	$post["address"];
				$data_to_insert['city']	=	$post["city"];
				$data_to_insert['post_code']	=	$post["post_code"];

				$result	=	$this->user->insertBankDetail($data_to_insert);

				if (isset($result['response']) &&$result['response']	==	"RECORD_ADDED") {
					$data["success"]=array("msg"=>"Bank detail added successfully.");
				} else {
					$errorsArray['Error']	=	"Sorry! Bank detail not added.";
				}	
			}
		}
		
		$data["errors"]	=	$errorsArray;
		
		$this->load->view('restaurantportal/bankdetail/bank_information',$data);
	
	}	

	function notification_settings()
	{
		$data	=	array();
		$data["activemenu"]	=	"Notification Settings";
		$restaurantArr = $this->session->userdata('restaurant');
		if ($_POST)
		{
			$restaurantArr["send_email"]	=	$this->input->post("send_email");
			if($_POST['send_email'] == "Yes"){
				$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
				$restaurantArr["email"]	=	$this->input->post("email");
			}

			$restaurantArr["send_sms"]	=	$this->input->post("send_sms");
			if($_POST['send_sms'] == "Yes"){
				$this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');
				$restaurantArr["phone_number"]	=	$this->input->post("phone_number");
			}
		
			if ($this->form_validation->run() == FALSE && ($_POST['send_email'] == "Yes" || $_POST['send_sms'] == "Yes") )
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');

				$errorsArray['email']	=	form_error('email');
				$errorsArray['phone_number']	=	form_error('phone_number');
				$data["errors"]=$errorsArray;
			}
			else
			{
				//update here
				$this->restaurant->updateRestaurant($restaurantArr);

				$this->session->set_userdata("restaurant",$restaurantArr);
				$data["success"]=array("msg"=>"Updated Successfully");
				
			}
			
		}
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/restaurant/notification_settings',$data);
	
	}	

	function handler()
    {
        // Check for ajax request
        if (!$this->input->is_ajax_request()) $this->resp();
        //
        $post = $this->input->post(NULL, TRUE);
        //
        $restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
        //
        switch (strtolower($post['action'])) {
            // Delete Restaurant Bannner
            case 'delete_restaurant_banner':
            	$banner_type = $post['banner_type'];
            	//
            	$res = array();
            	//
		        if (empty($banner_type)) {
		            $res['status'] = 'error';
                	$res['message'] = 'Provided banner type to delete!';
		        } else {
					$old_banner	= '';
					$data_to_update = array();
					//
					if ($banner_type == 'web') {
						$old_banner =$this->restaurant->getRestaurantBanner($restaurantID);
						$data_to_update["banner"] = NULL;
						$message = 'Wed banner deleted successfully.';

					} else if ($banner_type == 'mobile') {
						$old_banner = $this->restaurant->getRestaurantMobileBanner($restaurantID);
						$data_to_update["mobile_banner"] = NULL;
						$message = 'Mobile banner deleted successfully.';
					}
					//
					$banner_url = 'uploads/restaurant/banner/' . $old_banner;
                    unlink($banner_url);
                    $this->restaurant->updateRestaurantBanner($data_to_update, $restaurantID);
 
					$res['status'] = 'success';
					$res['message'] = $message;

					
		        }
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

        }    
    }
/**
.........................................................................................................
									End Restaurant Settings Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
