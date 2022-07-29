<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class AdminComissions extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/comission');
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
		   'title' => 'comissions',
		   'url' => base_url()."admincomissions",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		

		$data["errors"]	=	"";
		$data["list"]=$this->comission->getComission();
		
		$this->load->view('admin/comission/index',$data);
	}
	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function edit($comissionId = 0)
	{
		$comissionInfo	=	array();
		$comissionInfo["id"] = "";
		$comissionInfo["start"]= "";
		$comissionInfo["end"]= "";
		$comissionInfo["percent"]= "";
		if ($comissionId!=0 && $comissionId!="")
		{
			$comissionInfo=$this->comission->getComissionById($comissionId);
		}
		
		if($_POST)
		{
			$this->form_validation->set_rules('start', 'Start', 'numeric');
			$this->form_validation->set_rules('end', 'End', 'numeric');
			$this->form_validation->set_rules('percent', 'Percentage', 'numeric');
			$this->form_validation->run();

			$comissionInfo["start"]= trim($this->input->post("start"));
			$comissionInfo["end"]= trim($this->input->post("end"));
			$comissionInfo["percent"]= trim($this->input->post("percent"));
							
			if ($this->form_validation->run() == FALSE)
			{
				//------------errors stored in array------------//
				$errorsArray['start']	=	form_error('start');
				$errorsArray['end']	=	form_error('end');
				$errorsArray['percent']	=	form_error('percent');
				
				$data["errors"]=$errorsArray;
			}
			else
			{
				if (is_numeric($comissionInfo["id"]))
					$this->comission->updateComission($comissionInfo);
				else
					$this->comission->addNewComission($comissionInfo);
					
				redirect (base_url()."admincomissions");
			}//end else if ($this->form_validation->run() == FALSE)
			
		}
		//create breadcrumbs
		$bc = array(
		   'title' => 'Add/Edit comissions',
		   'url' => base_url()."admincomissions/edit",
		   'isRoot' => false
		);
		$this->breadcrumb->setBreadCrumb($bc);
		$data['breadcrumbs'] = get_Instance()->breadcrumblist->display();  		
		
		$data["comissionInfo"]=$comissionInfo;
		
		$this->load->view('admin/comission/edit',$data);
	}
	
	function delete($id)
	{
		$this->comission->deleteComission($id);
		redirect (base_url()."admincomissions");
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