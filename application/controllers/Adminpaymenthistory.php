<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class AdminPaymentHistory extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/terminals');
		$this->load->library('core/airport_core');
		$this->load->library('core/brands');
		$this->load->library('core/user');
		$this->load->library('core/restaurant');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		if( $this->session->userdata('type')== FALSE )
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
		   'title' => 'paymentHistory',
		   'url' => base_url()."adminpaymenthistory",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
	
		
		$data["restaurantList"] = $this->restaurant->listRestaurant();
		$data["airportList"]=$this->airport_core->listAirport();
		$data["terminals"]	=	$this->terminals->listTerminals(0);
		
		if ($_POST)
		{
			$filters["restaurant"]	=	array("id"=>$this->input->get_post("restaurant_name"));
			$this->session->set_userdata($filters);
			$data["filters"]	=	$filters;
			redirect(base_url()."restaurantorders/paymentreport",$data);
		
		}
		$data["errors"]	=	"";
		
		
	
		$this->load->view('admin/paymenthistory/index',$data);
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
			
			$config['upload_path'] = $this->config->item('terminal_image_path');;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '2048';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name']=rand()."_".$_FILES['image']['name'];

			$this->form_validation->set_rules('name', 'Terminal name', 'trim|required');
			$this->form_validation->set_rules('airport', 'Airport', 'trim|required|numeric');

			$arrInfo["terminal_name"]= trim($this->input->post("name"));
			$arrInfo["terminal_image"]= trim($config['file_name']);
			$arrInfo["airport_id"]= trim($this->input->post("airport"));
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
			
				if ( ! $this->upload->do_upload('image'))
				{
					$error = array('error' => $this->upload->display_errors());
					$data['errors']=$error;
				}	
				else
				{
					$data = array('upload_data' => $this->upload->data());
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
		
		$data['airports']=$this->airport_core->listAirport();

		if($_POST)
		{
			$this->form_validation->set_rules('name', 'Terminal name', 'required');
			$this->form_validation->set_rules('airport', 'Airport name', 'required|numeric');
			$this->form_validation->run();

			$terminalInfo["id"]= trim($this->input->post("id"));
			$terminalInfo["terminal_name"]= trim($this->input->post("name"));
			$terminalInfo["airport_id"]= trim($this->input->post("airport"));
			$terminalInfo["terminal_description"]= trim($this->input->post("terminal_desc"));				
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['name']	=	form_error('name');
				$errorsArray['airport']	=	form_error('airport');
				
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