<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/admin_core');
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
		$this->load->library('core/brands');
		$this->load->library('core/user');
		$this->load->library('form_validation');	
		$this->load->library('breadcrumb');	
		$this->load->library('breadcrumblist');	
	}
	
	function index()
	{
		$data="";
		$this->load->view( 'admin/login_view' ,$data);
		
	}
	function do_upload()
	{
	}			

	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function login()
	{
		$this->form_validation->set_rules('email', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		
		$errorsArray		=	array ();
		$data["email"]	=	trim($this->input->post("email"));
		$data["password"]	=	md5(trim($this->input->post("password")));
		if ($this->form_validation->run() == FALSE)
		{
			//---------------errors stored in array------------------------//
			$errorsArray['email']	=	form_error('Username');
			$errorsArray['password']	=	form_error('Password');
		}
		else
		{
			$arrUser=$this->admin_core->login($data);
			if ($arrUser	==	"Login_Error")
			{
				$errorsArray['Username']	=	"Sorry! You entered wrong username or password.";
			}
			else
			{
				redirect(base_url()."admin/dashboard");
			
			}
		}
		$data["errors"]	=	$errorsArray;
		$this->load->view('admin/login_view',$data);
	}
	/*
	* @method This method will check if admin is logged in
	* @params no parameter
	*/
	function isLoggedIn()
	{
	}
	
	/*
	* @method This method will check if admin is logged in
	* @params no parameter
	*/
	function logout()
	{
		// $this->session->sess_destroy();
		$this->session->unset_userdata('admin_session');
		redirect("admin/");
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function dashboard()
	{
		
		// if( $this->session->userdata('type')== FALSE || $this->session->userdata('type') != "admin")
		if( !$this->session->userdata('admin_session'))
		redirect(base_url()."admin",true);
		//create breadcrumbs
		$bc = array(
		   'title' => 'Dashboard',
		   'url' => uri_string(),
		   'isRoot' => true
		);
		$this->breadcrumb->setBreadCrumb($bc);

		$data["errors"]	=	"";
		$this->load->view('admin/dashboard',$data);
	}






/**
.........................................................................................................
									Manage Brand Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function brands()
	{
		//create breadcrumbs
		$bc = array(
		   'title' => 'Manage Brands',
		   'url' => base_url()."admin/brands",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["errors"]	=	"";
		$data["brandList"]=$this->brands->listBrands();
		$this->load->view('admin/brands/index.php',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function add_brand()
	{
		$data=array();
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add Brand',
		   'url' => base_url()."admin/add_brand",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		

		if($_POST)
		{
			$this->form_validation->set_rules('name', 'Restaurant Brand name', 'required');
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$data["errors"]=$errorsArray;
			}
			else
			{

				$arrInfo["brand_name"]= trim($this->input->post("name"));
				$arrInfo["brand_detail"]= trim($this->input->post("detail"));
				$this->brands->addBrands($arrInfo);
				redirect("admin/brands");
			}				
				
			
		}
		
		$this->load->view('admin/brands/add-brand.php',$data);
	}

	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function edit_brand($brandId)
	{
	
		$brandDetail=$this->brands->getBrandById($brandId);
		
		$brandInfo	=	$brandDetail[0];

		if($_POST)
		{
			$this->form_validation->set_rules('name', 'Restaurant Brand name', 'required');
			$this->form_validation->run();

			$brandInfo["brand_name"]	=	$arrInfo["brand_name"]= trim($this->input->post("name"));
			$brandInfo["brand_detail"]	=	$arrInfo["brand_detail"]= trim($this->input->post("detail"));
							
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$data["errors"]=$errorsArray;
			}
			else
			{
				$arrInfo["id"]= trim($this->input->post("id"));
				$this->brands->updateBrands($arrInfo);
				redirect("admin/brands");
			}				
		}					

		//create breadcrumbs
		$bc = array(
		   'title' => 'Edit Brand',
		   'url' => base_url()."admin/edit_brand",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["brandDetail"]=$brandInfo;
		$this->load->view('admin/brands/edit-brand.php',$data);
	}
	function delete_brand($brandId)
	{
		$this->brands->deleteBrand($brandId);
		redirect("admin/brands");
	}

/**
.........................................................................................................
									End Manage Brand Section 
.........................................................................................................
*/	



/**
.........................................................................................................
									Manage Users Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function users()
	{
		$data["errors"]	=	"";
		$arrInfo['type']="restaurantowner";
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Restaurant Managers',
		   'url' => base_url()."admin/users",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["userList"]=$this->user->listUsers($arrInfo);
		$this->load->view('admin/users/index.php',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function add_user()
	{
		$data=array();
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add User',
		   'url' => base_url()."admin/add_user",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		$arrList=array(
                  'Active'  => 'Active',
                  'Inactive'    => 'Inactive',
                );
		$data['statusDD']=form_dropdown('status',$arrList,"Active");

		if($_POST)
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			//$this->form_validation->set_rules('zip', 'Zip', 'numeric');

			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['email']	=	form_error('email');
				$errorsArray['firstname']	=	form_error('firstname');
				$errorsArray['lastname']	=	form_error('lastname');
				$errorsArray['phone_number']	=	form_error('phone_number');
				$errorsArray['password']	=	form_error('password');
				$errorsArray['passconf']	=	form_error('passconf');
				$errorsArray['zip']	=	form_error('zip');
				$data["errors"]=$errorsArray;
			}
			else
			{

				$arrInfo["email"]= trim($this->input->post("email"));
				$arrInfo["firstname"]= trim($this->input->post("firstname"));
				$arrInfo["lastname"]= trim($this->input->post("lastname"));
				$arrInfo["phone_number"]= trim($this->input->post("phone_number"));
				$arrInfo["password"]= md5(trim($this->input->post("password")));
				$arrInfo["address"]= trim($this->input->post("address"));
				$arrInfo["country_id"]= trim($this->input->post("country_id"));
				$arrInfo["city"]= trim($this->input->post("city"));
				$arrInfo["state"]= trim($this->input->post("state"));
				$arrInfo["zip"]= trim($this->input->post("zip"));
				$arrInfo["status"]= trim($this->input->post("status"));
				//$arrInfo["email2"]= trim($this->input->post("email2"));
				
				$arrInfo["type"]= "restaurantowner";
				$res=$this->user->addUser($arrInfo);
				if($res["response"]=="RECORD_ADDED")
					redirect("admin/users");
				else
				{
					$errorsArray['duplicate']	=	"Email address already exists";
					$data["errors"]=$errorsArray; 
				}	
			}				
				
			
		}
		
		$this->load->view('admin/users/add-user.php',$data);
	}

	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function edit_user($userId)
	{
	
		$userDetail=$this->user->getUserById($userId);
		$userinfo	=	$userDetail[0];
		
		$arrList=array(
                  'Active'  => 'Active',
                  'Inactive'    => 'Inactive',
                );
		$data['statusDD']=form_dropdown('status',$arrList,$userinfo["status"]);

		if($_POST)
		{
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			//$this->form_validation->set_rules('zip', 'Zip', 'numeric');
			if($this->input->post("password",TRUE) && $this->input->post("password")!="")
			{
				$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
				$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			}

			$userinfo["id"]	=	$arrInfo["id"]= trim($this->input->post("id"));
			$userinfo["email"]	=	$arrInfo["email"]= trim($this->input->post("email"));
			$userinfo["firstname"]	=	$arrInfo["firstname"]= trim($this->input->post("firstname"));
			$userinfo["lastname"]	=	$arrInfo["lastname"]= trim($this->input->post("lastname"));
			$userinfo["status"]	=	$arrInfo["status"]= trim($this->input->post("status"));
			$userinfo["country_id"]=$arrInfo["country_id"]= trim($this->input->post("country_id"));
			$userinfo["address"]=$arrInfo["address"]= trim($this->input->post("address"));
			$userinfo["address2"]= $arrInfo["address2"]=trim($this->input->post("address2"));
			$userinfo["city"]= $arrInfo["city"]=trim($this->input->post("city"));
			$userinfo["state"]= $arrInfo["state"]=trim($this->input->post("state"));
			$userinfo["zip"]= $arrInfo["zip"]=trim($this->input->post("zip"));
			$userinfo["phone_number"]= $arrInfo["phone_number"]=trim($this->input->post("phone_number"));
			// $userinfo["email2"]= $arrInfo["email2"]=trim($this->input->post("email2"));

			if($this->input->post("password",TRUE) && $this->input->post("password")!="")
			{
				$arrInfo["password"]= md5(trim($this->input->post("password")));
			}
			$userinfo["address"]	=	$arrInfo["address"]= trim($this->input->post("address"));
			$userinfo["type"]	=	$arrInfo["type"]= "restaurantowner";

			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['email']	=	form_error('email');
				$errorsArray['firstname']	=	form_error('firstname');
				$errorsArray['lastname']	=	form_error('lastname');
				$errorsArray['zip']	=	form_error('zip');
				if($this->input->post("password",TRUE) && $this->input->post("password")!="")
				{
					
					$errorsArray['password']	=	form_error('password');
					$errorsArray['passconf']	=	form_error('passconf');
				}	
				$data["errors"]=$errorsArray;
			}
			else
			{
				
				
				$res=$this->user->updateUser($arrInfo);
				
				if($res['response']=="RECORD_UPDATED")
				{
					
					redirect("admin/users");
					
				}
				else{
					$errorsArray['duplicate']	=	"Email address already exists";
					$data["errors"]=$errorsArray; 
				}
			}				
		}					
		//create breadcrumbs
		$bc = array(
		   'title' => 'Edit Restaurant Manager',
		   'url' => base_url()."admin/edit_user",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  
		$data["userDetail"]=$userinfo;
		$this->load->view('admin/users/edit-user.php',$data);
	}
	function delete_user($brandId)
	{
		$this->brands->deleteBrand($brandId);
		redirect("admin/brands");
	}
	
	function delete($id)
	{
		$this->user->delete_user($id);
		redirect (base_url()."admin/users");
	}
	


	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function admins()
	{
		$data["errors"]	=	"";
		$arrInfo['type']="restaurantowner";
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Admins',
		   'url' => base_url()."admin/users",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$data["userList"]=$this->user->listAdmins($arrInfo);
		$this->load->view('admin/admins/index.php',$data);
	}

	function add_admin()
	{
		$data=array();
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add Admin',
		   'url' => base_url()."admin/add_admin",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		

		if($_POST)
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['email']	=	form_error('email');
				$errorsArray['password']	=	form_error('password');
				$errorsArray['passconf']	=	form_error('passconf');
				$data["errors"]=$errorsArray;
			}
			else
			{

				$arrInfo["admin_email"]= trim($this->input->post("email"));
				$arrInfo["admin_pass"]= md5(trim($this->input->post("password")));
					
				$res=$this->user->addAdmin($arrInfo);
				if($res["response"]=="RECORD_ADDED")
					redirect("admin/admins");
				else
				{
					$errorsArray['duplicate']	=	"Email address already exists";
					$data["errors"]=$errorsArray; 
				}	
			}				
				
			
		}
		
		$this->load->view('admin/admins/add-admin.php',$data);
	}

	function edit_admin($userId)
	{
	
		$userDetail=$this->user->getAdminById($userId);
		$userinfo	=	$userDetail[0];

		if($_POST)
		{
			$this->form_validation->set_rules('email', 'Email', 'required');
			if($this->input->post("password",TRUE) && $this->input->post("password")!="")
			{
				$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
				$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
			}

			$userinfo["id"]	=	$arrInfo["id"]= trim($this->input->post("id"));
			$userinfo["email"]	=	$arrInfo["admin_email"]= trim($this->input->post("email"));
			if($this->input->post("password",TRUE) && $this->input->post("password")!="")
			{
				$arrInfo["admin_pass"]= md5(trim($this->input->post("password")));
			}

			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['email']	=	form_error('email');
				if($this->input->post("password",TRUE) && $this->input->post("password")!="")
				{
					
					$errorsArray['password']	=	form_error('password');
					$errorsArray['passconf']	=	form_error('passconf');
				}	
				$data["errors"]=$errorsArray;
			}
			else
			{
				
				
				$res=$this->user->updateAdmin($arrInfo);
				
				if($res['response']=="RECORD_UPDATED")
				{
					
					redirect("admin/admins");
					
				}
				else{
					$errorsArray['duplicate']	=	"Email address already exists";
					$data["errors"]=$errorsArray; 
				}
			}				
		}					
		//create breadcrumbs
		$bc = array(
		   'title' => 'Edit Admin',
		   'url' => base_url()."admin/edit_admin",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  
		$data["userDetail"]=$userinfo;
		$this->load->view('admin/admins/edit-admin.php',$data);
	}
/**
.........................................................................................................
									End Manage User Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
