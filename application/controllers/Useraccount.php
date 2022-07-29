<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class UserAccount extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );

	}
	
/**
.........................................................................................................
									Start Restaurant Front Accouunt Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$data	=	array();
//		$this->load->view('userfront/home',$data);
	}

	function accountsetting()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$userId=1;
		
		$data	=	array();
		$this->load->view('userfront/useraccount/accountsetting',$data);
	}

	function updateaccount()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$userId=$this->session->userdata('id');
		$userDetail=$this->user->getUserById($userId);
		
		$data	=	array();
		$data["userDetail"]=$userDetail;
		if($_POST)
		{
			$userInfo["id"]=$userId;
			
			$userInfo["firstname"]= trim($this->input->post("firstname"));
			$userInfo["lastname"]= trim($this->input->post("lastname"));
			$userInfo["address"]= trim($this->input->post("address"));				
			
			
			if($this->input->post("newemail")!=""  && trim($this->input->post("newemail"))!=trim($this->input->post("confemail")))
			{
				
				$errorsArray['newemail']	=	"Your new email and confirmation email fields does not match!";
			}else{
				if(trim($this->input->post("newemail"))!="")
					$userInfo["email"]= trim($this->input->post("newemail"));					
				
				else
					$userInfo["email"]= trim($this->input->post("email"));				
				$this->user->updateUser($userInfo);
			}
			
			
			$resetPass["id"]=$userId;

			$resetPass["oldpassword"]= md5(trim($this->input->post("pass")));				
			if(
			$resetPass["oldpassword"]!="" 
			&& 
			md5(trim($this->input->post("newpass")))==md5(trim($this->input->post("confpass")))
			)
			{
				$resetPass["password"]= md5(trim($this->input->post("newpass")));					
				$res=$this->user->resetPassword($resetPass);				
				if($res=="Old_Password_Not_Match")
				{
					$errorsArray['Old_Password_Not_Match']="Your old password does not match";
				}
				
			}else{
				$errorsArray['New_Password_Not_Match']="Your new and confirm password does not match";
			}
			
			$userDetail=$this->user->getUserById($userId);
			$data["userDetail"]=$userDetail;
			
			$data["errors"]=$errorsArray;
		
		}
		$this->load->view('userfront/useraccount/updateaccount',$data);
	}

	function createaccount()
	{
		// if ($this->session->userdata('id'))
		// 	redirect(base_url()."home");		
		$errorsArray = array();
		$arrInfo["email"]	=	'';
		$arrInfo["firstname"]	=	'';
		$arrInfo["lastname"]	=	'';
		$arrInfo["phone_number"]	=	'';
		$data	=	array();
		$data["flag"]=0;
		if($_POST)
		{
			$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');
			$this->form_validation->set_rules('newemail', 'Email Address', 'required|valid_email|trim');
			$this->form_validation->set_rules('newpass', 'Desired Password', 'required|trim|matches[confpass]');
			$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim');
		
			$arrInfo["email"]	=	strtolower(trim($this->input->post("newemail")));
			$confemail	=	strtolower(trim($this->input->post("confemail")));
			$arrInfo["password"]	=	md5(trim($this->input->post("newpass")));
			$arrInfo["firstname"]	=	trim($this->input->post("firstname"));
			$arrInfo["lastname"]	=	trim($this->input->post("lastname"));
			$arrInfo["phone_number"]	=	trim($this->input->post("phone_number"));
			$arrInfo["address"]	=	trim($this->input->post("address"));
			$arrInfo["country_id"]	=	1;
			$arrInfo["status"]	=	"Active"; //Active, Inactive		
			$arrInfo["type"]	=	"user";//'restaurantowner','user'		
					
			if ($this->form_validation->run() == FALSE)
			{
				//---------------Professional Summary Section------------------------//
				$errorsArray['firstname']	=	form_error('firstname');
				$errorsArray['lastname']	=	form_error('lastname');
				$errorsArray['phone_number']	=	form_error('phone_number');
				
				if($arrInfo["email"] != $confemail)
					$errorsArray['email'] = "The Email fields does not match";
				
				$errorsArray['password']	=	form_error('newpass');
				//$data["userDetails"]=$arrInfo;
				$data["flag"]=0;
			}
			else
			{
				
				if($this->user->checkDuplicate($arrInfo["email"]))
				{
					$errorsArray['duplicate']	=	"Email you entered is already registered";
					$data["flag"]=0;
				}else
				{	
					$list=$this->user->addUser($arrInfo, trim($this->input->post("newpass")));
					$data["flag"]=1;
					
					$arrInfo["email"]=$arrInfo["email"]; 
					$arrInfo["password"]=$arrInfo["password"];
					$arrInfo["usertype"]="user";

					$list=$this->user->login($arrInfo);
					redirect(base_url('userorder/checkout'));
				}
			
			}
			
		}
		$data["errors"]	=	$errorsArray;
		$data["userDetail"]=$arrInfo;
		$this->load->view('userfront/useraccount/createaccount',$data);
			
	}

	function login()
	{
		$this->load->view('userfront/useraccount/loginScreen');
	}
	function forgotPasswordScreen()
	{		
		$this->load->view('userfront/useraccount/forgotPasswordScreen');
	}
	

	function paymentpreferences()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$data	=	array();
		$this->load->view('userfront/useraccount/paymentpreferences',$data);
	}

	function forgotPassword()
	{
		if (!$this->session->userdata('id'))
			redirect(base_url()."home");		
		$data	=	array();
		$this->load->view('userfront/useraccount/forgotpassword',$data);
	}

	
/**
.........................................................................................................
									End Restaurant Front Accouunt Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
