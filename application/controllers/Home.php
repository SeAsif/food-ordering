<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');
		$this->load->library('email');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('user_agent');
	}
	function checkdatetime($flight_date)
	{
		$strCurrentDate	=	strtotime(date("Y-m-d"));
		$flight_date_time	=	strtotime($flight_date);
		
		if($flight_date_time < $strCurrentDate)
		{
			$this->form_validation->set_message('checkdatetime', 'The %s should be the today\'s date OR after today');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function checkpickuptime()
	{
		$pickup_time_check	=	strtotime(date($this->input->get_post('flight_date'))." ".$this->input->get_post('pickup_time_hour').":".$this->input->get_post('pickup_time_minute').":00 ".$this->input->get_post('pickup_time_type'));
//echo "<br/>";
		$flight_time_check	=	strtotime(date($this->input->get_post('flight_date'))." ".$this->input->get_post('flight_time_hour').":".$this->input->get_post('flight_time_minute').":00 ".$this->input->get_post('flight_time_type'));
//echo "<br/>";

		$orderDiffTime	=	$this->config->item("orderDiffTime");
		$flightDiffTime	=	$this->config->item("flightDiffTime");

		$checkTime=strtotime($flight_time_check);
		$startTime = date("h:i:s a", strtotime('+'.$flightDiffTime.' minutes', $pickup_time_check));//echo "<br/>";
		$startTime1 = strtotime(date($this->input->get_post('flight_date'))." ".$startTime);//echo "<br/>";
		$current_time = strtotime(date("Y-m-d H:i:s"));//echo "<br/>";
		$startTime_check = date("h:i:s a", strtotime('-'.$orderDiffTime.' minutes', $pickup_time_check));//echo "<br/>";
		$startTime_check1 = strtotime(date($this->input->get_post('flight_date'))." ".$startTime_check);//echo "<br/>";
	//	echo $current_time;
	//	exit();
		if($flight_time_check > $current_time && $pickup_time_check > $current_time)	
		{	
			if($current_time < $startTime_check1)
			{
				if ($flight_time_check < $startTime1)
				{	
					$this->form_validation->set_message('checkpickuptime', 'Order pickup time must be '.$flightDiffTime.' minutes before the flight departure time');
//					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
			else
			{
				$this->form_validation->set_message('checkpickuptime', 'Order Pick Up time must be '.$orderDiffTime.' minutes after the Current time');
//				return FALSE;
			}
		}
		else
		{
			$this->form_validation->set_message('checkpickuptime', 'Flight time and Order Pick Up time must be after the Current time');
//			return FALSE;
		}

		return TRUE;
	}
	
/**
.........................................................................................................
									Start Restaurant Front Home Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		redirect(base_url()."usersearch/searchresult");
		$data	=	array();
		$arrReturn	=	array();
		$arrSession	=	array();
		if ($this->agent->is_mobile())
			redirect(base_url()."mhome");
		
		$arrReturn = $this->session->userdata('search_criteria');
		
		$orderDiffTime	=	$this->config->item("orderDiffTime");
		$flightDiffTime	=	$this->config->item("flightDiffTime");
		$orderDiffTime = $orderDiffTime + 5;
		$flightDiffTime = $flightDiffTime + 5;
		$totalDiffTime = $flightDiffTime + $orderDiffTime;
		
		if($arrReturn["flight_date"] == "")
			$arrReturn["flight_date"] = date("m/d/Y", strtotime('+'.$totalDiffTime.' minutes'));
		
		if(empty($arrReturn["flight_time_hour"]) && empty($arrReturn["flight_time_minute"]))
		{
//			echo $startTime = date("h:i:s a", strtotime('+'.$flightDiffTime.' minutes'));
			
			$arrReturn["flight_time_hour"] = date("h", strtotime('+'.$totalDiffTime.' minutes'));
			$arrReturn["flight_time_minute"] = date("i", strtotime('+'.$totalDiffTime.' minutes'));
			$arrReturn["flight_time_type"] = date("A", strtotime('+'.$totalDiffTime.' minutes'));
		}
		
		if(empty($arrReturn["pickup_time_hour"]) && empty($arrReturn["pickup_time_minute"]))
		{
			$arrReturn["pickup_time_hour"] = date("h", strtotime('+'.$orderDiffTime.' minutes'));
			$arrReturn["pickup_time_minute"] = date("i", strtotime('+'.$orderDiffTime.' minutes'));
			$arrReturn["pickup_time_type"] = date("A", strtotime('+'.$orderDiffTime.' minutes'));
		}	
		
		if ($_POST)
		{
			$arrReturn["airport"]	=$this->input->get_post('airport');
			$arrReturn["terminal"]	=$this->input->get_post('terminal');
			$arrReturn["flight_date"]	=$this->input->get_post('flight_date');
			$arrReturn["flight_time_hour"]	=$this->input->get_post('flight_time_hour');
			$arrReturn["flight_time_minute"]	=$this->input->get_post('flight_time_minute');
			$arrReturn["flight_time_type"]	=$this->input->get_post('flight_time_type');
			$arrReturn["pickup_time_hour"]	=$this->input->get_post('pickup_time_hour');
			$arrReturn["pickup_time_minute"]	=$this->input->get_post('pickup_time_minute');
			$arrReturn["pickup_time_type"]	=$this->input->get_post('pickup_time_type');
			$arrReturn["airportid"]	=$this->input->get_post('airportid');
			
			$arrSession["search_criteria"]	=	$arrReturn;
			
			$this->form_validation->set_rules('airport', 'Location', 'trim|required');
			$this->form_validation->set_rules('terminal', 'Terminal', 'trim|required');
			$this->form_validation->set_rules('flight_date', 'Flight Date', 'trim|required|callback_checkdatetime');
			$this->form_validation->set_rules('flight_time_hour', 'Flight time hour', 'trim|required');
			$this->form_validation->set_rules('flight_time_minute', 'Flight time minute', 'trim|required');
			$this->form_validation->set_rules('pickup_time_hour', 'Pickup time hour', 'trim|required');
			$this->form_validation->set_rules('pickup_time_minute', 'Pickup time minute', 'trim|required|callback_checkpickuptime');
			
			
				
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['airport']	=	form_error('airport');
				$errorsArray['terminal']	=	form_error('terminal');
				$errorsArray['flight_date']	=	form_error('flight_date');
				$errorsArray['flight_time_hour']	=	form_error('flight_time_hour');
				$errorsArray['flight_time_minute']	=	form_error('flight_time_minute');
				$errorsArray['pickup_time_hour']	=	form_error('pickup_time_hour');
				$errorsArray['pickup_time_minute']	=	form_error('pickup_time_minute');

				$data["errors"]=$errorsArray;
			
			}
			else
			{
				$this->session->set_userdata($arrSession);
//				$arrReturn = $this->session->userdata('search_criteria');
//				print_r($arrReturn);
		//		echo "jsdhajkshjk";
				redirect(base_url()."usersearch/searchresult");
			}
			
			
		}else{
			$arrReturn["airport"] = '';
			$arrReturn["airportid"] = '';
			$arrReturn["terminal"] = '';
		}
		$terminalList = [];
		if (!empty($arrReturn["airportid"]))
		{
			$this->load->library('core/terminals');
			
			$terminalList	=	$this->terminals->listTerminals($arrReturn["airportid"]);
		}
		$this->load->library('core/airport_core');
		$airportArr=$this->airport_core->listAirport();
		$data["terminalList"]	=	$terminalList;
		$data["airportArr"] = $airportArr;
		$data["arrReturn"] = $arrReturn;

		$this->load->view('userfront/home',$data);
	}

	function airport()
	{
		$data	=	array();
		$arrReturn	=	array();
		$arrSession	=	array();
		
		
		$arrReturn = $this->session->userdata('search_criteria');
		
		if ($_POST)
		{
			$arrReturn["airport"]	=$this->input->get_post('airport');
			$arrReturn["terminal"]	=$this->input->get_post('terminal');
			$arrReturn["flight_date"]	=$this->input->get_post('flight_date');
			$arrReturn["flight_time_hour"]	=$this->input->get_post('flight_time_hour');
			$arrReturn["flight_time_minute"]	=$this->input->get_post('flight_time_minute');
			$arrReturn["flight_time_type"]	=$this->input->get_post('flight_time_type');
			$arrReturn["pickup_time_hour"]	=$this->input->get_post('pickup_time_hour');
			$arrReturn["pickup_time_minute"]	=$this->input->get_post('pickup_time_minute');
			$arrReturn["pickup_time_type"]	=$this->input->get_post('pickup_time_type');
			$arrReturn["airportid"]	=$this->input->get_post('airportid');
			
			$arrSession["search_criteria"]	=	$arrReturn;
			
			$this->form_validation->set_rules('airport', 'Location', 'trim|required');
			$this->form_validation->set_rules('terminal', 'Terminal', 'trim|required');
			$this->form_validation->set_rules('flight_date', 'Flight Date', 'trim|required');
			$this->form_validation->set_rules('flight_time_hour', 'Flight time hour', 'trim|required');
			$this->form_validation->set_rules('flight_time_minute', 'Flight time minute', 'trim|required');
			$this->form_validation->set_rules('pickup_time_hour', 'Pickup time hour', 'trim|required');
			$this->form_validation->set_rules('pickup_time_minute', 'Pickup time minute', 'trim|required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['airport']	=	form_error('airport');
				$errorsArray['terminal']	=	form_error('terminal');
				$errorsArray['flight_date']	=	form_error('flight_date');
				$errorsArray['flight_time_hour']	=	form_error('flight_time_hour');
				$errorsArray['flight_time_minute']	=	form_error('flight_time_minute');
				$errorsArray['pickup_time_hour']	=	form_error('pickup_time_hour');
				$errorsArray['pickup_time_minute']	=	form_error('pickup_time_minute');

				$data["errors"]=$errorsArray;
			
			}
			else
			{
				$this->session->set_userdata($arrSession);
				redirect(base_url()."usersearch/searchresult");
			}
			
			
		}

		if ($arrReturn["airportid"]	!=	"" || $arrReturn["airportid"]!=NULL)
		{
			$this->load->library('core/terminals');
			
			$arrReturn["terminalList"]	=	$this->terminals->listTerminals($arrReturn["airportid"]);
		}
		$this->load->library('core/airport_core');
		$airportArr=$this->airport_core->listAirport();
		$data["arrReturn"]	=	$arrReturn;
		$data["airportArr"] = $airportArr;
		$this->load->view('userfront/home',$data);
	}
	
	function verifyEmail()
	{
		$nCount =0;
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$data["email"] = trim($this->input->get_post("email"));
		$userType = "user";
		$arrUser = $this->user->verifyEmail($data,$userType);
		echo $arrUser;
	}
	
	function recoverview($id,$code)
	{
		$data = array();
		$arrUser = array();
		$error = '';
		$success = '';
		
		$arrUser["id"] = $id;
		$arrUser["security_code"] = $code;
		
		
		if($_POST)
		{
			$arrUser["password"] = md5(trim($this->input->get_post("password")));
			$confpass = md5(trim($this->input->get_post("confpass")));
			$arrUser["id"] = $this->input->get_post("userid");
			$arrUser["security_code"] = $this->input->get_post("codeid");
			$userDetail = $this->user->getUserById($arrUser["id"]);
			
			if($userDetail[0]["security_code"] == $arrUser["security_code"])
			{	
				$this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confpass]');
				$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim');
				if ($this->form_validation->run() == FALSE)
				{	
					$error	=	form_error('password');
					$data["flag"]=0;
				}
				else
				{	
					$arrUser["security_code"] = "";
					$this->user->updateUser($arrUser);
					$_SESSION['success']	=	"Your Password hash been changed!!";
					redirect(base_url()."useraccount/login");
				}
			}else{
				$error	=	"Your reset Password link has been expired";
			}
		}
		
		$data["error"] = $error;
		$data["success"] = $success;
		$data["arrUser"] = $arrUser;
		$data["id"] = $id;
		$data["code"] = $code;
		$this->load->view('userfront/recoverview',$data);
	}
	

/**
.........................................................................................................
									End Restaurant Front Home Section 
.........................................................................................................
*/	
}
/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
