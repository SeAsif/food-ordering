<?
/**
*Manager log book
*/
class ManagerLogBook extends CI_Controller {

	public function __construct()
	{

	parent::__construct();
	
	/*load database libray manually*/
	$this->load->database();
	
	/*load Model*/
	$this->load->model('Managerlog_model');
    $this->load->library('pagination');

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
	
	function list()
	{		


       
        $log_date= $this->input->get('log_date');
         // init params
         $params = array();
         $limit_per_page = $this->input->get('show_rows')?? 10;
         $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $total_records = $this->Managerlog_model->get_count();
         $params["activemenu"]="manager_log_book";

         if ($total_records > 0) 
         {
             // get current page records
             $params["logs"] = $this->Managerlog_model->get_logs($limit_per_page, $start_index,$log_date);
              
             $config['base_url'] =base_url().'/managerlogbook/list';
             $config['total_rows'] = $total_records;
             $config['per_page'] = $limit_per_page;
             $config["uri_segment"] = 3;
              
             $this->pagination->initialize($config);
              
             // build paging links
             $params["links"] = $this->pagination->create_links();
         }
         
        $this->load->view('restaurantportal/managerlogs/index',$params);
	}

    function create(){
        
        $data["activemenu"]	="manager_log_book";

        return  $this->load->view('restaurantportal/managerlogs/create',$data);
        
    }
	
/**
 * 
 * 
 * Store Manager Daily Logs
 */
    function store(){

        //Validate form
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        //todo validations
        $this->form_validation->set_rules('log_date', 'Date', 'required');

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
            $input["created_at"]=date('Y-m-d H:i:s');
            $input["created_by"]=$this->session->id;
            $restaurantArr = $this->session->userdata('restaurant');
            $input["restaurant_id"]=$restaurantArr["id"];
           
            $created=$this->Managerlog_model->save($input);
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


    /**
     * 
     * Edit Log
     */

     function edit(int $id){
        $data['log']=$this->Managerlog_model->edit_log($id);
        //echo json_encode($data);
        $data["activemenu"]	="manager_log_book";
        return  $this->load->view('restaurantportal/managerlogs/edit',$data);


     }



     /**
      * 
      *update log
      */

      function update(){
 //Validate form
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        //todo validations
        $this->form_validation->set_rules('log_date', 'Date', 'required');

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

            //Todo update form

            $input=$this->input->post();
            $input["updated_at"]=date('Y-m-d H:i:s');
            $input["updated_by"]=$this->session->id;
            $restaurantArr = $this->session->userdata('restaurant');
            $input["restaurant_id"]=$restaurantArr["id"];
            $created=$this->Managerlog_model->update_log($input, $this->input->post('id'));
                if($created==true){
                    //$response=["message"=>"Record Updated successfully","status"=>"success"];
                    //echo json_encode($response);
                    $response = array('status' => 'success','message'=>'Updated Successfully');
                    $this->output
                            ->set_status_header(200)
                            ->set_content_type('application/json', 'utf-8')
                            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                            ->_display();
                    exit;
                }
                else{
                    $response=array('status'=>'error','message'=>'Record is not update');
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