<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class AdminRestaurant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->_obj =& get_instance();
		$this->load->library('core/restaurant');
		$this->load->library('core/brands');
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
		$this->load->library('core/user');
		$this->load->library('core/defaultvariant');
		$this->load->library('email');
		
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		// if( $this->session->userdata('type')== FALSE || $this->session->userdata('type') != "admin")
		if( !$this->session->userdata('admin_session'))
		redirect(base_url()."admin",true);
	}
	
/**
.........................................................................................................
									Manage Resturant Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params restaurantname and password will be passed as parameter 	
	*/
	function index()
	{
		$data["errors"]	=	"";
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Restaurant',
		   'url' => base_url()."adminrestaurant/",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		

		$data["list"]=$this->restaurant->listRestaurant(0,"All");
//		print_r($data);
		$this->load->view('admin/restaurants/index',$data);
	}
	/*
	* @method This method will login the admin
	* @params restaurantname and password will be passed as parameter 	
	*/
	function setupcordinates($restaurantId=0)
	{
		$data["errors"]	=	"";
		//create breadcrumbs
		$bc = array(
		   'title' => 'Coordinates',
		   'url' => base_url()."adminrestaurant/setupcordinates",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$restaurantDetail=$this->restaurant->getRestaurantByIdWithTerminal($restaurantId,"All");
		
		if ($_POST)
		{
			$this->form_validation->set_rules('x1', 'Coordinate x1', 'trim|required');
			$this->form_validation->set_rules('x2', 'Coordinate x2', 'trim|required');
			$this->form_validation->set_rules('y1', 'Coordinate y1', 'trim|required');
			$this->form_validation->set_rules('y2', 'Coordinate y1', 'trim|required');
			$this->form_validation->set_rules('w', 'Width', 'trim|required');
			$this->form_validation->set_rules('h', 'Height', 'trim|required');

			$restaurantinfo["coordinate_x1"]	=	$restaurantDetail["coordinate_x1"]	=	$this->input->post("x1");
			$restaurantinfo["coordinate_x2"]	=	$restaurantDetail["coordinate_x2"]	=	$this->input->post("x2");
			$restaurantinfo["coordinate_y1"]	=	$restaurantDetail["coordinate_y1"]	=	$this->input->post("y1");
			$restaurantinfo["coordinate_y2"]	=	$restaurantDetail["coordinate_y2"]	=	$this->input->post("y2");
			$restaurantinfo["height"]	=	$restaurantDetail["height"]	=	$this->input->post("h");
			$restaurantinfo["width"]	=	$restaurantDetail["width"]	=	$this->input->post("w");
			$restaurantinfo["id"]	=	$restaurantId;

			if ($this->form_validation->run() == FALSE)
			{
				$errorsArray['x1']	=	form_error('x1');
				$errorsArray['x2']	=	form_error('x2');
				$errorsArray['y1']	=	form_error('y1');
				$errorsArray['y2']	=	form_error('y2');
				$errorsArray['h']	=	form_error('h');
				$errorsArray['w']	=	form_error('w');
				$data["errors"]=$errorsArray;
			}
			else
			{
				$res=$this->restaurant->updateRestaurant($restaurantinfo);

				redirect(base_url()."adminrestaurant");
			}

		}
		
		$data["restaurant_id"]	=	$restaurantId;
		$data["restaurantDetail"]	=	$restaurantDetail;
//		$data["list"]=$this->restaurant->listRestaurant(0,"All");
		$this->load->view('admin/restaurants/cordinates',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params restaurantname and password will be passed as parameter 	
	*/
	function save_restaurant($restaurantId = 0)
	{
		$restaurantDetail	=	array();
		$res = "";
		$data['mode']="add";
		if ($restaurantId>0)
		{
			$data['mode']="edit";
			$restaurantDetail=$this->restaurant->listRestaurantById($restaurantId,"All");
		}
		

		$data['brands']=$this->brands->listBrands();

		$data['users']	=	$this->user->listUsers(array("type"=>"restaurantowner"));
		
		$arrReturn["airportid"]	=$this->input->get_post('airportid');
		
//		$data['terminals']	=	$this->terminals->listTerminals(0);
		$data["airportList"]=$this->airport_core->listAirport();
		$data["terminals"]	=	$this->terminals->listTerminals(0);
		
//		print_r($terminals);
		
		if($_POST)
		{
		
			$this->form_validation->set_rules('name', 'Restaurant Name', 'trim|required');
			$this->form_validation->set_rules('slogan', 'Restaurant Slogan', 'trim|required');
			$this->form_validation->set_rules('details', 'Details', 'trim|required');
		//	$this->form_validation->set_rules('phone_number', 'Phone Numebr', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric|callback_checktax');
			
			//$this->form_validation->set_rules('terminal_name', 'Terminal Name', 'trim|required|numeric');
			$this->form_validation->set_rules('user_name', 'User Name', 'trim|required|numeric');
			//$this->form_validation->set_rules('brand_name', 'Brand Name', 'trim|required|numeric');
			
		//	$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			//$this->form_validation->set_rules('zip', 'Zip', 'trim|numeric');
			
			
			$restaurantDetail["restaurant_name"]	=	$this->input->post("name");
			$restaurantDetail["restaurant_slogan"]	=	$this->input->post("slogan");
			$restaurantDetail["restaurant_details"]	=	$this->input->post("details");
			$restaurantDetail["email"]	=	$this->input->post("email");
			$restaurantDetail["restaurant_statetax"]	=	$this->input->post("statetax");
			$restaurantDetail["restaurant_citytax"]	=	$this->input->post("citytax");
			$restaurantDetail["phone_number"]	=	$this->input->post("phone_number");
			$restaurantDetail["user_id"]	=	$this->input->post("user_name");
			$restaurantDetail["terminal_id"]	=	$this->input->post("terminal_name");
			$restaurantDetail["brand_id"]	=	$this->input->post("brand_name");
			$restaurantDetail["status"]	=	$this->input->post("status");
			$restaurantDetail["country"]	=	$this->input->post("country");
			$restaurantDetail["city"]	=	$this->input->post("city");
			$restaurantDetail["state"]	=	$this->input->post("state");
			$restaurantDetail["zip"]	=	$this->input->post("zip");
			$restaurantDetail["address"]	=	$this->input->post("address");
			$restaurantDetail["address2"]	=	$this->input->post("address2");
			$restaurantDetailToUpdate = $restaurantDetail;
			if ($this->input->post("id"))
				$restaurantDetail["id"]	=	$this->input->post("id");
			
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['slogan']	=	form_error('slogan');
				$errorsArray['details']	=	form_error('details');
				$errorsArray['email']	=	form_error('email');
				$errorsArray['user_name']	=	form_error('user_name');
				$errorsArray['terminal_name']	=	form_error('terminal_name');
				$errorsArray['brand_name']	=	form_error('brand_name');
			//	$errorsArray['address']	=	form_error('address');
				$errorsArray['status']	=	form_error('status');
				$errorsArray['statetax']	=	form_error('statetax');
				$errorsArray['citytax']	=	form_error('citytax');
				$errorsArray['zip']	=	form_error('zip');

				$data["errors"]=$errorsArray;
			}
			else
			{

				//	print_r ($restaurantDetail);
				if ($data['mode']	==	"edit")
					$res=$this->restaurant->updateRestaurant($restaurantDetailToUpdate);
				else
				{
					$res=$this->restaurant->addRestaurant($restaurantDetailToUpdate);
					
					$this->restaurant->addDefaultVariantToRestaurant($this->defaultvariant->getDefaultVariant(),$res);

					$config['wordwrap'] = TRUE;
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'ssl://smtp.googlemail.com';
					$config['smtp_port'] = 465;
					$config['mailtype'] = 'html';
					$config['charset'] = 'iso-8859-1';
					$config['smtp_user'] = 'support@waivemenu.com';
					//
					$this->email->initialize($config);
					//
					$from_email	=	$this->_obj->config->item("sender_email");
					$from_name	=	$this->_obj->config->item("adminName");
					$to_email	=	$restaurantDetail["email"];
					//
					$this->email->from($from_email, $from_name);
					$this->email->to($to_email);
					$this->email->subject('Restaurant Created');
					//
					$email_data['url'] = base_url('restaurantportal');
					//
					$this->email->message($this->_obj->load->view('email/create_restaurant',$email_data,true));
					//
					$this->email->send();
				
				}

				redirect(base_url()."adminrestaurant");
			}				
		}				

		$arrList=array(
                  'Active'  => 'Active',
                  'Inactive'    => 'Inactive',
                );
		$status = "";
		if(isset($restaurantDetail["status"]))	{
			$status = $restaurantDetail["status"];
		}	
		$data['statusDD']=form_dropdown('status',$arrList,$status);

		$data["restaurantDetail"]=$restaurantDetail;
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add/Edit Restaurant',
		   'url' => base_url()."adminrestaurant/save_restaurant",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["arrReturn"]	=	$arrReturn;
		$data["res"] = $res;
		
		$this->load->view('admin/restaurants/edit-restaurant',$data);
	}
	function delete_restaurant($brandId)
	{
		$this->brands->deleteBrand($brandId);
		redirect("admin/brands");
	}
	function deleterestaurant($restId)
	{
		$arrInfo["id"] = $restId;
		$this->restaurant->deleteRestaurant($arrInfo);
		redirect(base_url()."adminrestaurant");
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

/**
.........................................................................................................
									End Manage Restaurant Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
