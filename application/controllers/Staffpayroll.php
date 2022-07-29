<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class Staffpayroll extends CI_Controller {

	function __construct()

	{	//exit;

		parent::__construct();
		$this->load->database();
		$this->load->library('core/staff_core');
		$this->load->library('core/staff_timings');
		$this->load->library('form_validation');	
		$this->load->library('pagination');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->model('Payroll_model');
		
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
	


	function index()
	{
 
	

		$user=$this->input->get('staff')?? null;
		$start_date=$this->input->get('start_date')?? null;
		$end_date=$this->input->get('end_date')?? null;

		$restaurantArr = $this->session->userdata('restaurant');
		$restaurant_id=$restaurantArr["id"];
	


         // init params
         $params = array();
		 $params["staff"]=$this->Payroll_model->get_staff($restaurant_id);
		 $params["payroll_settings"]=$this->Payroll_model->payroll_settings($restaurant_id);
         $limit_per_page = $this->input->get('show_rows')?? 10;
         $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $total_records = $this->Payroll_model->count($restaurant_id);
		 $params["activemenu"]	=	"staffpayroll";

         if ($total_records > 0) 
         {
             // get current page records
             $params["payrolls"] = $this->Payroll_model->get($limit_per_page, $start_index,$restaurant_id,$user,$start_date,$end_date);
              
             $config['base_url'] =base_url().'/staffpayroll';
             $config['total_rows'] = $total_records;
             $config['per_page'] = $limit_per_page;
             $config["uri_segment"] = 3;
              
             $this->pagination->initialize($config);
              
             // build paging links
             $params["links"] = $this->pagination->create_links();
         }
		
		 $this->load->view('restaurantportal/payroll',$params);
	
	}


	function generate_payroll(){
	//Validate form
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	//todo validations
	$this->form_validation->set_rules('effective_date', 'Effective Date', 'required');
	$this->form_validation->set_rules('frequency', 'Frequency', 'required');


	if ($this->form_validation->run() == FALSE) {
		//Report Error message to client
		$response=array('status'=>'error','message'=>validation_errors());
		$this->output
		->set_status_header(201)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
		exit;
	} 
	else {

		//Todo Save form
		$input=$this->input->post();
		$id=$this->input->post('id')?? null;
		if(!empty($id)){

		
			$input["updated_at"]=date('Y-m-d H:i:s');
			$restaurantArr = $this->session->userdata('restaurant');
			$input["restaurant_id"]=$restaurantArr["id"];
			$input["updated_by"]=$this->session->id;
			$created=$this->Payroll_model->generate_payroll($id,$input);
		}else{
			$input["created_at"]=date('Y-m-d H:i:s');
			$restaurantArr = $this->session->userdata('restaurant');
			$input["restaurant_id"]=$restaurantArr["id"];
			$input["created_by"]=$this->session->id;
			$created=$this->Payroll_model->generate_payroll($id=NULL,$input);

		}
		
			if($created==true){
				$response = array('status' => 'success','message'=>'Payroll Settings Saved Successfully');
				$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
				exit;
			}
			else{
				$response=array('status'=>'error','message'=>'Payroll is not Generated');
				$this->output
				->set_status_header(201)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
			}
			}




	}


		function pay($id){
				# code...
			$input["updated_at"]=date('Y-m-d H:i:s');
			$input["created_by"]=$this->session->id;
			$input["status"]="Paid";
			$created=$this->Payroll_model->pay_to_satff($id,$input);
				if($created==true){
					$response = array('status' => 'success','message'=>'Paid Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Not paid');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				exit;
				}
		}


		function change_amount(){
		
			//update 
		$input=$this->input->post();
		$input["updated_at"]=date('Y-m-d H:i:s');
		$restaurantArr = $this->session->userdata('restaurant');
		$input["restaurant_id"]=$restaurantArr["id"];
		$input["updated_by"]=$this->session->id;


		$created=$this->Payroll_model->update_payroll($this->input->post('id'),$input);
			if($created==true){
				$response = array('status' => 'success','message'=>'Payroll Updated Successfully');
				$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
				exit;
			}
			else{
				$response=array('status'=>'error','message'=>'Payroll is not Updated');
				$this->output
				->set_status_header(201)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
			}
		}
			
	}
			


?>
