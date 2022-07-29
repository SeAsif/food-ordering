<?

class Marketingtools extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	
		/*load database libray manually*/
		$this->load->database();
		
		/*load Model*/
		$this->load->library('pagination');
		$this->load->model('Broadcaster_model');
		$this->load->model('Coupon_model');
		$this->load->model('Emailautomation_model');
		$this->load->model('MailServerSetting_model');
		$this->load->model('Reward_model');
		$this->load->model('Loyalitysetting_model');

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
	

	function coupons()
	{	

		  $params = array();
		  $limit_per_page = $per_page ?? 10;
		  $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  $total_records = $this->Coupon_model->count();
		  
		  $params["activemenu"]="coupons";
 
		  if ($total_records > 0) 
		  {
			  // get current page records
			  $params["coupons"] = $this->Coupon_model->get($limit_per_page, $start_index,$data=null);
			 
			  $config['base_url'] =base_url().'/marketingtools/coupons';
			  $config['total_rows'] = $total_records;
			  $config['per_page'] = $limit_per_page;
			  $config["uri_segment"] = 3;
			 
			 $this->pagination->initialize($config);
			  // build paging links
			  $params["links"] = $this->pagination->create_links();
		  }
		  
		  $this->load->view('restaurantportal/marketing_tools/coupons/index',$params);
	}
	

	function create_coupon()
	{	
		$data	=	array();
		$data["activemenu"]	=	"coupons";
		
		$restaurantArr = $this->session->userdata('restaurant');
				
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/marketing_tools/coupons/create',$data);
	}
	
	function store_coupon()
	{	
		$data	=	array();
		 //Validate form
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 //todo validations
		 $this->form_validation->set_rules('code', 'Coupon Code', 'required|is_unique[coupons.code]
		 ');
   
		if ($this->form_validation->run() == FALSE) {
			 //Report Error message to client
			$response=array('status'=>'error','message'=>validation_errors());
			$this->output
			 ->set_status_header(201)
			 ->set_content_type('application/json', 'utf-8')
			 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			 ->_display();
			exit;
			 
		} else {
   
			//Todo Save form
			$restaurantArr = $this->session->userdata('restaurant');
		   	$data=[
			   "restaurant_id"=>$restaurantArr["id"],
			   "code"=>$this->input->post('code'),
			   "start_date"=>!isset($_POST['is_default']) ? $this->input->post('start_date') : '',
			   "end_date"=>!isset($_POST['is_default']) ? $this->input->post('end_date') : '',
			   "is_default"=>isset($_POST['is_default']) ? 1 : 0,
			   "usage"=>$this->input->post('usage'),
			   "discount_type"=>$this->input->post('discount_type'),
			   "discount"=>$this->input->post('discount'),
			   "status"=>$this->input->post('status'),
			   "customer_log"=>$this->input->post('customer_log'),
			   "is_home_page"=>$this->input->post('is_home_page'),
			   "created_at"=>date('Y-m-d H:i:s'),
			   "created_by"=>$this->session->id
		   	];
   
   
			$created= $this->Coupon_model->save($data);
				if($created==true){
					$response = array('status' => 'success','message'=>'Created Successfully');
					$this->output
							 ->set_status_header(200)
							 ->set_content_type('application/json', 'utf-8')
							 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							 ->_display();
					exit;
				} else {
					$response=array('status'=>'error','message'=>'Record is not created');
					$this->output
					 ->set_status_header(201)
					 ->set_content_type('application/json', 'utf-8')
					 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					 ->_display();
				  exit;
				}
		}
	}

	
	function edit_coupon($id)
	{	
		$data	=	array();
		$data["activemenu"]	=	"coupons";		
		$data["coupon"]	=$this->Coupon_model->edit($id);
		$this->load->view('restaurantportal/marketing_tools/coupons/edit',$data);
	}

	function update_coupon()
	{	
		$data	=	array();
		 //Validate form
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 //todo validations
		 $this->form_validation->set_rules('code', 'Coupon Code', 'required');
   
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
   
			$restaurantArr = $this->session->userdata('restaurant');
			$data=[
			"restaurant_id"=>$restaurantArr["id"],
			   "code"=>$this->input->post('code'),
			   "start_date"=>!isset($_POST['is_default']) ? $this->input->post('start_date') : '',
			   "end_date"=>!isset($_POST['is_default']) ? $this->input->post('end_date') : '',
			   "is_default"=>isset($_POST['is_default']) ? 1 : 0,
			   "usage"=>!isset($_POST['is_unlimited']) ? $this->input->post('usage') : 0,
			   "discount_type"=>$this->input->post('discount_type'),
			   "discount"=>$this->input->post('discount'),
			   "status"=>$this->input->post('status'),
			   "customer_log"=>$this->input->post('customer_log'),
			   "is_home_page"=>$this->input->post('is_home_page'),
			   "updated_at"=>date('Y-m-d H:i:s'),
			   "updated_by"=>$this->session->id
		   ];
   
   
			 $created= $this->Coupon_model->update($data,$this->input->post('id'));
				 if($created==true){
					 $response = array('status' => 'success','message'=>'Updated Successfully');
					 $this->output
							 ->set_status_header(200)
							 ->set_content_type('application/json', 'utf-8')
							 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							 ->_display();
					 exit;
				 }
				 else{
					 $response=array('status'=>'error','message'=>'Record is not Updated');
					 $this->output
					 ->set_status_header(201)
					 ->set_content_type('application/json', 'utf-8')
					 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					 ->_display();
				  exit;
				 }
		  }
	}



	function update_coupon_status(){
		$this->load->helper(array('form', 'url'));
  
		$updated= $this->Coupon_model->update_status($this->input->post('row_id'));
			if($updated==true){
				$response = array('status' => 'success','message'=>'Status Updated Successfully');
				$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
				exit;
			}
			else{
				$response=array('status'=>'error','message'=>'Status is not updated');
				$this->output
				->set_status_header(201)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			 exit;
			}
	}

	function delete_coupon(){

		$this->load->helper(array('form', 'url'));
  
			$deleted= $this->Coupon_model->delete($this->input->post('row_id'));
				if($deleted==true){
					$response = array('status' => 'success','message'=>'Deleted Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not Deleted');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
	}
	 
	function email_automations()
	{
	
		$params = array();
		$limit_per_page = $per_page ?? 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Emailautomation_model->count();
		
		$params["activemenu"]="email_automations";

		if ($total_records > 0) 
		{
			// get current page records
			$params["email_automations"] = $this->Emailautomation_model->get($limit_per_page, $start_index,$data=null);
		   
			$config['base_url'] =base_url().'/marketingtools/email_automations';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 3;
		   
		   $this->pagination->initialize($config);
			// build paging links
			$params["links"] = $this->pagination->create_links();
		}
		$restaurantArr = $this->session->userdata('restaurant');
		$params["mail_server_setting"]=  $this->db->where('restaurant_id',$restaurantArr["id"])->get('mail_server_settings')->result();
		$this->load->view('restaurantportal/marketing_tools/email_automations/index',$params);
	}

	
	function create_campaign()
	{
		$data	=	array();
		$data["activemenu"]	=	"email_automations";
		
		$restaurantArr = $this->session->userdata('restaurant');
		$data["coupons"] = $this->db->get('coupons')->result();
			
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/marketing_tools/email_automations/create',$data);
	}

	function store_campaign()
	{
		$data	=	array();
		 //Validate form
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 //todo validations
		 $this->form_validation->set_rules('name', 'Name', 'required');
   
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
			$restaurantArr = $this->session->userdata('restaurant');
			if($this->input->post('condition')=="Registration"){
				$is_registeration=$this->input->post('anniversary');
			}
			

		


			if($this->input->post('is_specific_day')=="Registration")
			 $data=[
				"restaurant_id"=>$restaurantArr["id"],
				"name"=>$this->input->post('name'),
				"name"=>$this->input->post('name'),
				"subject"=>$this->input->post('subject'),
				"condition"=>$this->input->post('condition'),
				"days"=>$this->input->post('days'),
				"anniversary"=>$this->input->post('anniversary'),
				"start_date"=>$this->input->post('start_date'),
				"end_date"=>$this->input->post('end_date'),
				"is_never_expire"=>$this->input->post('is_never_expire')?? 0,
				"details"=>$this->input->post('editor1'),
				"status"=>$this->input->post('status'),
				"coupon_id"=>$this->input->post('coupon_id'),
				"is_registeration"=>$is_registeration,
				"is_registeration"=>$is_registeration,
				"is_registeration"=>$is_registeration,
				"is_registeration"=>$is_registeration,
				"is_registeration"=>$is_registeration,
				"is_specific_day"=>$this->input->post('is_specific_day'),
				"created_at"=>date('Y-m-d H:i:s'),
				"created_by"=>$this->session->id
			];
	
			 $created=$this->Emailautomation_model->save($data);
				 if($created==true){
					 $response = array('status' => 'success','message'=>'Created Successfully');
					 $this->output
							 ->set_status_header(200)
							 ->set_content_type('application/json', 'utf-8')
							 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							 ->_display();
					 exit;
				 }
				 else{
					 $response=array('status'=>'error','message'=>'Record is not created');
					 $this->output
					 ->set_status_header(201)
					 ->set_content_type('application/json', 'utf-8')
					 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					 ->_display();
				  exit;
				 }
		  }
	}

	function edit_campaign($id)
	{
	$data	=	array();
	$data["activemenu"]	=	"email_automations";		
	$data["campaign"]	=$this->Emailautomation_model->edit($id);
	$data["coupons"] = $this->db->get('coupons')->result();
	
	$this->load->view('restaurantportal/marketing_tools/email_automations/edit',$data);
	}

	function update_campaign()
	{
		
		$data	=	array();
		 //Validate form
		 $this->load->helper(array('form', 'url'));
		 $this->load->library('form_validation');
		 //todo validations
		 $this->form_validation->set_rules('name', 'Name', 'required');
   
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

			$restaurantArr = $this->session->userdata('restaurant');
			 $data=[
				"restaurant_id"=>$restaurantArr["id"],
				"name"=>$this->input->post('name'),
				"subject"=>$this->input->post('subject'),
				"condition"=>$this->input->post('condition'),
				"days"=>$this->input->post('days'),
				"anniversary"=>$this->input->post('anniversary'),
				"start_date"=>$this->input->post('start_date'),
				"end_date"=>$this->input->post('end_date'),
				"is_never_expire"=>$this->input->post('is_never_expire')?? 0,
				"details"=>$this->input->post('editor1'),
				"status"=>$this->input->post('status'),
				"coupon_id"=>$this->input->post('coupon_id'),
				"updated_at"=>date('Y-m-d H:i:s'),
				"updated_by"=>$this->session->id
			];
	
			 $created=$this->Emailautomation_model->update($data,$this->input->post('id'));
				 if($created==true){
					 $response = array('status' => 'success','message'=>'updated Successfully');
					 $this->output
							 ->set_status_header(200)
							 ->set_content_type('application/json', 'utf-8')
							 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							 ->_display();
					 exit;
				 }
				 else{
					 $response=array('status'=>'error','message'=>'Record is not updated');
					 $this->output
					 ->set_status_header(201)
					 ->set_content_type('application/json', 'utf-8')
					 ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					 ->_display();
				  exit;
				 }
		  }
	}


	function delete_campaign()
	{
		$this->load->helper(array('form', 'url'));

			$deleted= $this->Emailautomation_model->delete($this->input->post('row_id'));
				if($deleted==true){
					$response = array('status' => 'success','message'=>'Deleted Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not Deleted');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
	}

	function email_server_settings(){
		$data	=	array();
		//Validate form
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//todo validations

		$this->form_validation->set_rules('smtp_username', 'User Name', 'required');
		$this->form_validation->set_rules('smtp_password', 'User Password', 'required');
		$this->form_validation->set_rules('smtp_server', 'Server details', 'required');
		$this->form_validation->set_rules('smtp_port', 'Port', 'required');
  
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
	   	$restaurantArr = $this->session->userdata('restaurant');
			$data=[
			   "smtp_username"=>$this->input->post('smtp_username'),
			   "smtp_password"=>$this->input->post('smtp_password'),
			   "smtp_server"=>$this->input->post('smtp_server'),
			   "smtp_port"=>$this->input->post('smtp_port'),
			   "restaurant_id"=>$restaurantArr["id"],
			   "created_at"=>date('Y-m-d H:i:s'),
			   "created_by"=>$this->session->id
		   ];
		   if($this->input->post('id') !=null){
			$created=$this->MailServerSetting_model->update($data,$this->input->post('id'));
		   }else{
			$created=$this->MailServerSetting_model->save($data);
		   }
			
				if($created==true){
					$response = array('status' => 'success','message'=>'Created Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not created');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
		 }	
	}
	

	function rewards()
	{

		$params = array();
		$limit_per_page = $per_page ?? 10;
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$total_records = $this->Reward_model->count();
		
		$params["activemenu"]="rewards";

		if ($total_records > 0) 
		{
			// get current page records
			$params["rewards"] = $this->Reward_model->get($limit_per_page, $start_index,$data=null);
		   
			$config['base_url'] =base_url().'/marketingtools/email_automations';
			$config['total_rows'] = $total_records;
			$config['per_page'] = $limit_per_page;
			$config["uri_segment"] = 3;
		   
		   $this->pagination->initialize($config);
			// build paging links
			$params["links"] = $this->pagination->create_links();
		}
		$restaurantArr = $this->session->userdata('restaurant');
		$params["coupons"] = $this->db->get('coupons')->result();
		$params["loyality_settings"] = $this->db->get('loyality_settings')->row();

		
		
		$params["mail_server_setting"]=  $this->db->where('restaurant_id',$restaurantArr["id"])->get('mail_server_settings')->result();
		
		$this->load->view('restaurantportal/marketing_tools/rewards/index',$params);

	}

	function create_reward()
	{
		$data	=	array();
		$data["activemenu"]	=	"rewards";
		
		$restaurantArr = $this->session->userdata('restaurant');
		$data["coupons"] = $this->db->get('coupons')->result();
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/marketing_tools/rewards/create',$data);
	}

	function  store_reward(){
		$data	=	array();
		//Validate form
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//todo validations

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('description', 'desciption', 'required');
		$this->form_validation->set_rules('points', 'Ponits', 'required|numeric');
	
  
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
	   	$restaurantArr = $this->session->userdata('restaurant');
			$data=[
			   "title"=>$this->input->post('title'),
			   "description"=>$this->input->post('description'),
			   "points"=>$this->input->post('points'),
			   "coupon_id"=>$this->input->post('coupon_id'),
			   "restaurant_id"=>$restaurantArr["id"],
			   "is_redeemed"=>$this->input->post('is_redeemed')=="on"? 1: 0,
			   "created_at"=>date('Y-m-d H:i:s'),
			   "created_by"=>$this->session->id
		   ];
		   
			$created=$this->Reward_model->save($data);
		
				if($created==true){
					$response = array('status' => 'success','message'=>'Created Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not created');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
		 }	
	}

	function edit_reward($id)
	{
		$data	=	array();
		$data["activemenu"]	=	"rewards";
		
		$restaurantArr = $this->session->userdata('restaurant');
		$data["coupons"] = $this->db->get('coupons')->result();
		$data["reward"]= $this->Reward_model->edit($id);
		$data["restaurant"]	=	$restaurantArr;
		$this->load->view('restaurantportal/marketing_tools/rewards/edit',$data);
	}
	

	function  update_reward(){
		$data	=	array();
		//Validate form
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//todo validations

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('description', 'desciption', 'required');
		$this->form_validation->set_rules('points', 'Ponits', 'required|numeric');
	
  
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
	   	$restaurantArr = $this->session->userdata('restaurant');
			$data=[
			   "title"=>$this->input->post('title'),
			   "description"=>$this->input->post('description'),
			   "points"=>$this->input->post('points'),
			   "coupon_id"=>$this->input->post('coupon_id'),
			   "restaurant_id"=>$restaurantArr["id"],
			   "is_redeemed"=>$this->input->post('is_redeemed')=="on"? 1: 0,
			   "updated_at"=>date('Y-m-d H:i:s'),
			   "updated_by"=>$this->session->id
		   ];
		   
			$created=$this->Reward_model->update($data,$this->input->post('id'));
		
				if($created==true){
					$response = array('status' => 'success','message'=>'Updated Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not Updated');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
		 }	
	}




	function delete_reward()
	{
		$this->load->helper(array('form', 'url'));

			$deleted= $this->Reward_model->delete($this->input->post('row_id'));
				if($deleted==true){
					$response = array('status' => 'success','message'=>'Deleted Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not Deleted');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
	}


	function loyality_settings(){

		$data	=	array();
		//Validate form
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//todo validations

		$this->form_validation->set_rules('status','Turn ON/OFF Loyality Prograg', 'required');
	
  
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
	   	$restaurantArr = $this->session->userdata('restaurant');
			$data=[
			   "status"=>$this->input->post('status'),
			   "based_on"=>$this->input->post('based_on'),
			   "calculation_based"=>$this->input->post('calculation_based'),
			   "termconditions"=>$this->input->post('editor1'),
			   "conversion_value"=>$this->input->post('conversion_value'),
			   "conversion_rate"=>$this->input->post('conversion_rate'),
			   "restaurant_id"=>$restaurantArr["id"],
			   "created_at"=>date('Y-m-d H:i:s'),
			   "created_by"=>$this->session->id
		   ];
		 
		   if($this->input->post('id') !=null){
			$created=$this->Loyalitysetting_model->update($data,$this->input->post('id'));
		   }else{
			$created=$this->Loyalitysetting_model->save($data);
		   }
			
				if($created==true){
					$response = array('status' => 'success','message'=>'Created Successfully');
					$this->output
							->set_status_header(200)
							->set_content_type('application/json', 'utf-8')
							->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
							->_display();
					exit;
				}
				else{
					$response=array('status'=>'error','message'=>'Record is not created');
					$this->output
					->set_status_header(201)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				 exit;
				}
		 }	

	}

	 function broadcaster()
	{
		  // init params
		  $params = array();
		  $limit_per_page = $per_page?? 10;
		  $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  $total_records = $this->Broadcaster_model->count();
		
		  $params["activemenu"]="broadcasting";
 
		  if ($total_records > 0) 
		  {
			  // get current page records
			  $params["broadcaster"] = $this->Broadcaster_model->get($limit_per_page, $start_index,$data=null);
			   
			  $config['base_url'] =base_url().'/marketingtools/broadcaster';
			  $config['total_rows'] = $total_records;
			  $config['per_page'] = $limit_per_page;
			  $config["uri_segment"] = 3;
			   
			  $this->pagination->initialize($config);
			   
			  // build paging links
			  $params["links"] = $this->pagination->create_links();
		  }
		  
		  $this->load->view('restaurantportal/marketing_tools/broadcaster/index',$params);
		
		
       
	}

	function create_broadcaster()
	{


		$data	=	array();
        $data["activemenu"]="broadcasting";
		
        $this->load->view('restaurantportal/marketing_tools/broadcaster/create',$data);
	}

	function store_broadcaster()
	{
		
	
	  //Validate form
	  $this->load->helper(array('form', 'url'));
	  $this->load->library('form_validation');
	  //todo validations
	  $this->form_validation->set_rules('name', 'Name', 'required');

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
		$restaurantArr = $this->session->userdata('restaurant');

		
		
		if($this->input->post('duration')=="Range"){
			
			if($this->input->post('date_range_start')!=""){
				$start_date=date("Y-m-d", strtotime($this->input->post('date_range_start')));
				}else{
					$start_date="";
				}
				if($this->input->post('date_range_end')!=""){
					$end_date= date("Y-m-d", strtotime($this->input->post('date_range_end')));
					}else{
						$end_date="";
					}
				

			if($this->input->post('all_day')=="on"){
				$start_time="00:00";
				$end_time="23:59";
			}else{
			$start_time= $this->input->post('start_time');
			$end_time=$this->input->post('end_time');
			}
			
		}else{
			if($this->input->post('current_date')!=""){
			$start_date=date("Y-m-d", strtotime($this->input->post('current_date')));
			}else{
				$start_date="";
			}
			if($this->input->post('current_date')!=""){
				$end_date= date("Y-m-d", strtotime($this->input->post('current_date')));
				}else{
					$end_date="";
				}
			
		

			if($this->input->post('all_day')=="on"){
				$start_time="00:00:00";
				$end_time="23:59:59";
			}else{
			$start_time= $this->input->post('start_time');
			$end_time=$this->input->post('end_time');
			}
		}
	
			
			   

		$arrays=[
			"restaurant_id"=>$restaurantArr["id"],
			"name"=>$this->input->post('name'),
			"is_open"=>$this->input->post('is_open'),
			"is_on"=>$this->input->post('is_on'),
			"duration"=>$this->input->post('duration'),
			"message"=>$this->input->post('message'),
			"all_day"=>$this->input->post('all_day')=="on"?1:0,
			"start_date"=>$start_date,
			"end_date"=>$end_date,
			"start_time"=>$start_time,
			"end_time"=>$end_time,
			"created_at"=>date('Y-m-d H:i:s'),
			"created_by"=>$this->session->id
		];


		  $created=$this->Broadcaster_model->save($arrays);
			  if($created==true){
				  $response = array('status' => 'success','message'=>'Created Successfully');
				  $this->output
						  ->set_status_header(200)
						  ->set_content_type('application/json', 'utf-8')
						  ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						  ->_display();
				  exit;
			  }
			  else{
				  $response=array('status'=>'error','message'=>'Record is not created');
				  $this->output
				  ->set_status_header(201)
				  ->set_content_type('application/json', 'utf-8')
				  ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				  ->_display();
			   exit;
			  }
	   }
	 
	}


	function edit_broadcaster($id){
		$data	=	array();
        $data["activemenu"]="broadcasting";
		$data["broadcaster"]=$this->Broadcaster_model->edit($id);
		
        $this->load->view('restaurantportal/marketing_tools/broadcaster/edit',$data);
	}



	function update_broadcaster()
	{
		
	
	  //Validate form
	  $this->load->helper(array('form', 'url'));
	  $this->load->library('form_validation');
	  //todo validations
	  $this->form_validation->set_rules('name', 'Name', 'required');

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
		
		
		if($this->input->post('duration')=="Range"){
			
			if($this->input->post('date_range_start')!=""){
				$start_date=date("Y-m-d", strtotime($this->input->post('date_range_start')));
				}else{
					$start_date="";
				}
				if($this->input->post('date_range_end')!=""){
					$end_date= date("Y-m-d", strtotime($this->input->post('date_range_end')));
					}else{
						$end_date="";
					}
				

			if($this->input->post('all_day')=="on"){
				$start_time="00:00";
				$end_time="23:59";
			}else{
			$start_time= $this->input->post('start_time');
			$end_time=$this->input->post('end_time');
			}
			
		}else{
			if($this->input->post('current_date')!=""){
			$start_date=date("Y-m-d", strtotime($this->input->post('current_date')));
			}else{
				$start_date="";
			}
			if($this->input->post('current_date')!=""){
				$end_date= date("Y-m-d", strtotime($this->input->post('current_date')));
				}else{
					$end_date="";
				}
			
		

			if($this->input->post('all_day')=="on"){
				$start_time="00:00:00";
				$end_time="23:59:59";
			}else{
			$start_time= $this->input->post('start_time');
			$end_time=$this->input->post('end_time');
			}
		}

		$restaurantArr = $this->session->userdata('restaurant');
			
			   

		$arrays=[
			"restaurant_id"=>$restaurantArr["id"],
			"name"=>$this->input->post('name'),
			"is_open"=>$this->input->post('is_open'),
			"is_on"=>$this->input->post('is_on'),
			"duration"=>$this->input->post('duration'),
			"message"=>$this->input->post('message'),
			"all_day"=>$this->input->post('all_day')=="on"?1:0,
			"start_date"=>$start_date,
			"end_date"=>$end_date,
			"start_time"=>$start_time,
			"end_time"=>$end_time,
			"updated_at"=>date('Y-m-d H:i:s'),
			"updated_by"=>$this->session->id
		];
	
		
		  $created=$this->Broadcaster_model->update($arrays,$this->input->post('id'));
			  if($created==true){
				  $response = array('status' => 'success','message'=>'Updated Successfully');
				  $this->output
						  ->set_status_header(200)
						  ->set_content_type('application/json', 'utf-8')
						  ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						  ->_display();
				  exit;
			  }
			  else{
				  $response=array('status'=>'error','message'=>'Record is not Updated');
				  $this->output
				  ->set_status_header(201)
				  ->set_content_type('application/json', 'utf-8')
				  ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				  ->_display();
			   exit;
			  }
	   }
	 
	}

}

?>