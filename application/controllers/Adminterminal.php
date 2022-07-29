<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class AdminTerminal extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
		$this->load->library('core/brands');
		$this->load->library('core/user');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		// if( $this->session->userdata('type')== FALSE || $this->session->userdata('type') != "admin")
		if( !$this->session->userdata('admin_session'))
		redirect(base_url()."admin",true);
		$this->load->library('breadcrumb');	
		$this->load->library('breadcrumblist');
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
		   'title' => 'terminal',
		   'url' => base_url()."adminterminal",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		$data["errors"]	=	"";
		$data["terminalList"]=$this->terminals->listTerminals();
		$data["airportList"]=$this->airport_core->listAirport();
//		print_r($data);
		$this->load->view('admin/terminals/index',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function add_terminal()
	{
		
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add terminal',
		   'url' => base_url()."adminterminal/add_terminal",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		

		$data['airports']=$this->airport_core->listAirport();

		if($_POST)
		{
			
			$config['upload_path'] = $this->config->item('terminal_image_path');
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name']=rand()."_".$_FILES['image']['name'];
			

			$this->form_validation->set_rules('name', 'Terminal name', 'trim|required');
			$this->form_validation->set_rules('airport', 'Airport', 'trim|required|numeric');
	//		$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric');
	//		$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric');

			$arrInfo["terminal_name"]= trim($this->input->post("name"));
			$arrInfo["terminal_image"]= trim($config['file_name']);
			$arrInfo["airport_id"]= trim($this->input->post("airport"));
	//		$arrInfo["terminal_statetax"]= trim($this->input->post("statetax"));
	//		$arrInfo["terminal_citytax"]= trim($this->input->post("citytax"));
			$arrInfo["terminal_description"]= trim($this->input->post("terminal_desc"));
			
			$data["terminaldata"]	=	$arrInfo;
							
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['airport']	=	form_error('airport');
				$data["errors"]=$errorsArray;
			}
			else
			{
			
				$this->load->library('upload', $config);
			
				if ($_FILES['image']['name'])
				{
					if ($this->upload->do_upload('image') )
					{ 
						$data = array('upload_data' => $this->upload->data());
						$this->terminals->addTerminals($arrInfo);
						redirect(base_url()."adminterminal");
					}	
					
					else
					{
						$error = array('error' => $this->upload->display_errors());
						$data['errors']=$error;
					}
				}
				else
				{
					$arrInfo["terminal_image"]	=	"Empty";
					$this->terminals->addTerminals($arrInfo);
					redirect(base_url()."adminterminal");
				}
					

			}
			
		}
		$this->load->view('admin/terminals/add-terminal.php',$data);
	}

	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function edit_terminal($terminalId)
	{
		//create breadcrumbs
		$bc = array(
		   'title' => 'Edit terminal',
		   'url' => base_url()."adminterminal/edit_terminal",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		$terminalDetail=$this->terminals->getTerminalById($terminalId);
		$terminalInfo	=	$terminalDetail[0];
	//	print_r($terminalDetail);
		$data['airports']=$this->airport_core->listAirport();

		if($_POST)
		{
			$this->form_validation->set_rules('name', 'Terminal name', 'required');
			$this->form_validation->set_rules('airport', 'Airport name', 'required|numeric');
		//	$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric');
		//	$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric');
			$this->form_validation->run();

			$terminalInfo["id"]= trim($this->input->post("id"));
			$terminalInfo["terminal_name"]= trim($this->input->post("name"));
			$terminalInfo["airport_id"]= trim($this->input->post("airport"));
	//		$terminalInfo["terminal_statetax"]= trim($this->input->post("statetax"));
	//		$terminalInfo["terminal_citytax"]= trim($this->input->post("citytax"));
			$terminalInfo["terminal_description"]= trim($this->input->post("terminal_desc"));				
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['airport']	=	form_error('airport');
		/*		$errorsArray['statetax']	=	form_error('statetax');
				$errorsArray['citytax']	=	form_error('citytax');	*/			
				$data["errors"]=$errorsArray;
			}
			else
			{
			
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!="")
				{
					$config['upload_path'] = './uploads/terminals';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '2048';
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name']=rand()."_".$_FILES['image']['name'];
					
		
					$this->load->library('upload', $config);
				
					if ( ! $this->upload->do_upload('image'))
					{
						$error = array('error' => $this->upload->display_errors());
						$data['errors']=$error;
						
					}	
					else
					{
						$data = array('upload_data' => $this->upload->data());
						$terminalInfo["terminal_image"]= trim($config['file_name']);
						$this->terminals->updateTerminals($terminalInfo);
						redirect(base_url()."adminterminal");
						
					}
				}
				else
				{
					$this->terminals->updateTerminals($terminalInfo);
					redirect(base_url()."adminterminal");
				}	

			}//end else if ($this->form_validation->run() == FALSE)
			
		}
		
		$data["terminalDetail"]=$terminalInfo;
	//	print_r($data);
		$this->load->view('admin/terminals/edit-terminal.php',$data);
	}
	function delete_terminal($terminalId)
	{
		$this->terminals->deleteTerminal($terminalId);
		redirect(base_url()."adminterminal");
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