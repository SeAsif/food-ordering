<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantTimings extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant_timings');
		$this->load->library('form_validation');	
		$this->load->library('pagination');	
		$this->load->helper( array('dropdown_helper') );
		
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
	
/**
.........................................................................................................
									Start Restaurant Food Items Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data	=	array();
//		$this->load->view('admin/terminals/index',$data);
	}

	function operetionalhours($state = '')
	{

		$data	=	array();

		$data["activemenu"]	=	"operetionalhours";
		$restaurantArr = $this->session->userdata('restaurant');
		
		$restaurantID	=	$restaurantArr["id"];
		
		if ($state	==	"added")
		{
			$data["success"]=array("msg"=>"Item Added Successfully");
		}
		else if ($state	==	"updated")
		{
			$data["success"]=array("msg"=>"Item Updated Successfully");
		}
		
		$per_page	=	$this->config->item("PER_PAGE");

		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"];
		//+$this->uri->segment(3);
		
		$data["timings"]	=	$this->restaurant_timings->listRestaurantTimingsByRestaurantId($restaurantID,"No",$per_page, $this->uri->segment(3));
		
		$total	=	$this->restaurant_timings->listRestaurantTimingsByRestaurantId($restaurantID,"Yes");
		$config['base_url'] = base_url().'/restauranttimings/operetionalhours';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '3';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Back';

		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();

		
//		print_r ($data);

		$this->load->view('restaurantportal/restauranttimings/operetionalhours',$data);
	
	}	

	
	function addtiming($itemId = 0)
	{
		$data	=	array();
		$item =	['id' => 0, 'start' => "00:00",'end' => "00:00"];
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
		
		if ($itemId!=0)
		{
			$item	=	$this->restaurant_timings->listTimingById($itemId);
		}
		
		if ($_POST)
		{
			$start_hours = $this->input->post("start_hour");
			$start_min = $this->input->post("start_min");
			$day = $this->input->post("day");
			$startMKTime=mktime($start_hours,$start_min,0);
			$start= $start_hours.":".$start_min.":00";
			
			$end_hours = $this->input->post("end_hour");
			$end_min = $this->input->post("end_min");
			$endMKTime=mktime($end_hours,$end_min,0);
			$end=$end_hours.":".$end_min.":"."00"; 
			
			$item["start"]	= $start;
			$item["end"]	= $end;
			$item["day"]	= $day;
			$item["restaurant_id"]	=	$restaurantID;
			
			
			if($startMKTime>$endMKTime)
			{
				$errorsArray['time_error']	=	"Start time should be lesser than end time";
				$data["errors"]=$errorsArray;
			}else
			{			
				if(isset($_POST['whole_week']) && $_POST['whole_week'] == 'yes'){
					unset($item['id']);
					$week = ["Sunday", "Saturday", "Friday", "Thursday", "Wednesday", "Tuesday", "Monday",      ];
					$this->restaurant_timings->deleteRestaurantTiming($restaurantID,0);
					foreach($week as $day){
						$item["day"]	= $day;
						$this->restaurant_timings->addNewRestaurantTiming($item);
					}
				}else{
					if ($itemId!=0 && $itemId!="")
					{
						//update
						$this->restaurant_timings->updateRestaurantTiming($item);
						$data["success"]=array("msg"=>"Updated Successfully");
					}
					else
					{
						//add
						$itemId	=	$this->restaurant_timings->addNewRestaurantTiming($item);
						$data["success"]=array("msg"=>"Added Successfully");
						$item["id"]	=$itemId;
						
					}
				}	
				
				
			}
		}
		$data["item"]	=	$item;
		$_SESSION["user_msgs"] = $data;
		redirect(base_url()."restauranttimings/operetionalhours");
	}
	

	function deleteoperetionalhours()
	{
		if($_POST['operation_hour_id']){
			$restaurantArr = $this->session->userdata('restaurant');
			$restaurantID	=	$restaurantArr["id"];
			$this->restaurant_timings->deleteRestaurantTiming($restaurantID,$_POST['operation_hour_id']);
			$data["success"]=array("msg"=>"Operation hours deleted successfully");
			$_SESSION["user_msgs"] = $data;
			redirect(base_url()."restauranttimings/operetionalhours");
		}
	}
/**
.........................................................................................................
									End Restaurant Food Items Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
