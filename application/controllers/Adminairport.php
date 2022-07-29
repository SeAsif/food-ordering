<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Adminairport extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/airport_core');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		// if( $this->session->userdata('type')== FALSE || $this->session->userdata('type') != "admin")
		if( !$this->session->userdata('admin_session'))
		redirect(base_url()."admin",true);
		
	}
	
/**
.........................................................................................................
									Manage Terminals Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		//create breadcrumbs
		$bc = array(
		   'title' => 'airports',
		   'url' => base_url()."adminairport",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		$data["errors"]	=	"";
		$data["airportList"]=$this->airport_core->listAirport();
		$this->load->view('admin/airports/index',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function add_airport()
	{
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add airport',
		   'url' => base_url()."adminairport/add_airport",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		$arrInfo["airport_name"]= "";
		$arrInfo["airport_code"]= "";
		$arrInfo["airport_statetax"]= "";
		$arrInfo["airport_citytax"] = "";
		$data["airportdata"]	=	$arrInfo;

		if($_POST)
		{
			

			$this->form_validation->set_rules('name', 'Airport name', 'trim|required');
			$this->form_validation->set_rules('code', 'Airport code', 'trim|required');
			$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric|callback_checktax');
			$arrInfo["airport_name"]= trim($this->input->post("name"));
			$arrInfo["airport_code"]= trim($this->input->post("code"));
			$arrInfo["airport_statetax"]= trim($this->input->post("statetax"));
			$arrInfo["airport_citytax"]= trim($this->input->post("citytax"));
			
			$data["airportdata"]	=	$arrInfo;
							
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['code']	=	form_error('code');
				$errorsArray['statetax']	=	form_error('statetax');
				$errorsArray['citytax']	=	form_error('citytax');
				$data["errors"]=$errorsArray;
			}
			else
			{
			
					$this->airport_core->addAirport($arrInfo);
					redirect(base_url()."adminairport");
			}
			
		}
		$this->load->view('admin/airports/add-airport',$data);
	}

	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function edit_airport($airportId)
	{
		//create breadcrumbs
		$bc = array(
		   'title' => 'Edit Airport',
		   'url' => base_url()."adminairport/edit_airport",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		

		if($_POST)
		{
			$this->form_validation->set_rules('name', 'airport name', 'required');
			$this->form_validation->set_rules('code', 'airport code', 'required');
			$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric|callback_checktax');
			$airportInfo["id"]= trim($this->input->post("id"));
			$airportInfo["airport_name"]= trim($this->input->post("name"));
			$airportInfo["airport_code"]= trim($this->input->post("code"));
			$airportInfo["airport_statetax"]= trim($this->input->post("statetax"));
			$airportInfo["airport_citytax"]= trim($this->input->post("citytax"));
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['code']	=	form_error('code');
				$errorsArray['statetax']	=	form_error('statetax');
				$errorsArray['citytax']	=	form_error('citytax');
				$data["errors"]=$errorsArray;
			}
			else
			{
				$this->airport_core->updateAirport($airportInfo);
				redirect(base_url()."adminairport");
			}//end else if ($this->form_validation->run() == FALSE)
			
		}
		$airportDetail=$this->airport_core->listAirportById($airportId);
		$airportInfo	=	$airportDetail[0];
		
		$data["airportDetail"]=$airportInfo;
		$this->load->view('admin/airports/edit-airport.php',$data);
	}
	function delete_airport($airportId)
	{
		$this->airport_core->deleteAirport($airportId);
		redirect(base_url()."adminairport");
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
									End Of Terminal Management 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>