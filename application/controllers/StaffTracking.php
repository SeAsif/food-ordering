<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class StaffTracking extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/user');		
		$this->load->library('core/staff_core');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');	
		
		if( $this->session->userdata('type') == FALSE ) {
			if ($this->session->userdata('restaurant') == FALSE) {
				redirect(base_url()."restaurantportal",true);
			}
		}
	}
	
/**
.........................................................................................................
									Start Restaurant Staff Section 
.........................................................................................................
*/	

	function index () {
		if ($this->session->userdata('type') == 'employee') {
			$data = array();
			//
			$employee_id = $this->session->userdata('id');
			$restaurant_id = $this->staff_core->getRestaurantId($employee_id);
			$current_date = date("Y-m-d"); 
			$latest_log_id = $this->staff_core->getEmployeeLatestLogID($employee_id, $restaurant_id, $current_date);
			$restaurant = $this->staff_core->getRestaurantByRestaurantId($restaurant_id);

			//
			$allow_tracking = 'yes';
			$message = '';
			//
			$schedule_available = $this->staff_core->getMyScheduleDay($employee_id, $restaurant_id, $current_date);
			//
			if (empty($schedule_available)) {
				$allow_tracking = 'no';
				$message = 'Sorry! You are not able to track your time today because the schedule not published against you for <b>'.date('M d Y, D', strtotime($current_date)).' </b>.';
			}

			if ($latest_log_id == 0) {
				$data["latest_log_id"] = $latest_log_id;
				$data["perform_action"] = 'insert_log';
				$last_log_data = $this->staff_core->getEmployeeLastLogData($employee_id, $restaurant_id, $current_date);
				$data["log_data"] = $last_log_data;
			} else {
				$data["latest_log_id"] = $latest_log_id;
				$data["perform_action"] = 'updatelog';
				$latest_log_data = $this->staff_core->getEmployeeLatestLogData($employee_id, $restaurant_id, $current_date);
				$data["log_data"] = $latest_log_data;
			}
			//
			if ($_POST)
			{
				$this->form_validation->set_rules('perform_action', 'perform_action', 'trim|required');
				
				$tracking_id	=	$this->input->post("tracking_id");
				$perform_action	=	$this->input->post("perform_action");

				if ($this->form_validation->run() == FALSE) {
					$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
					
					$errorsArray['perform_action']	=	form_error('perform_action');
					
					$data["errors"]=$errorsArray;
				} else {
					if ($tracking_id!=0 && $tracking_id!="") {
						$employee_id = $this->session->userdata('id');
						$restaurant_id = $this->staff_core->getRestaurantId($employee_id);
						$current_date = date("Y-m-d"); 
						$get_check_in_time = $this->staff_core->get_checkintime($employee_id, $restaurant_id, $current_date);
					
						// total worked hours
						$start_time= $get_check_in_time->check_in;
						$end_time = date("H:i:s");

						list($hours, $minutes) = explode(':', $start_time);
						$startTimestamp = mktime($hours, $minutes);
						
						list($hours, $minutes) = explode(':', $end_time);
						$endTimestamp = mktime($hours, $minutes);
						
						$seconds = abs($endTimestamp - $startTimestamp);
						$diff = (24*60*60)-$seconds;
						if ($diff < $seconds) {
							$seconds = $diff;
						}
						
						$minutes = ($seconds / 60) % 60; 
						$hours = round($seconds / (60 * 60));
						$total_hours=$hours.'.'.$minutes;

						//update
						$data_to_update = array();
						$data_to_update['check_out'] = date("H:i:s");
						$data_to_update['total_hours'] = $total_hours;
						$this->staff_core->updateEmployeeTimeLog($tracking_id, $data_to_update);
						//
						$this->session->set_flashdata('message', 'Check out successfully.');
                		redirect(base_url()."StaffTracking",true);
					} else {
						//add
						$data_to_insert = array();
						$data_to_insert['date'] = $current_date;
						$data_to_insert['check_in'] = date("H:i:s");
						$data_to_insert['restaurant_id'] = $restaurant_id;
						$data_to_insert['employee_id'] = $employee_id;
						$log_id	=	$this->staff_core->insertEmployeeTimeLog($data_to_insert);
						//
						$this->session->set_flashdata('message', 'Check in successfully.');
                		redirect(base_url()."StaffTracking",true);
					}
				}
			}

			$per_page	=	$this->config->item("PER_PAGE");
			$time_tracking	=	$this->staff_core->getAllSatffTimeTrack($employee_id, "No", $per_page, $this->uri->segment(3));
			$total_time_tracking	=	$this->staff_core->getAllSatffTimeTrack($employee_id, "Yes");
			
			
			$config['base_url'] = base_url().'/restaurantstaff';
			$config['total_rows'] = $total_time_tracking;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = '10';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Back';

			if( $total_time_tracking > $per_page )
			{
				$this->pagination->initialize($config);
			}
		
			$data['paginationLinks'] = $this->pagination->create_links();
			$data['totalcount'] = $total_time_tracking;
			$data["time_tracking"]	=	$time_tracking;
			$data["restaurant"]	=	$restaurant;
			$data['activemenu'] = 'stafftracking';
			$data['allow_tracking'] = $allow_tracking;
			$data['message'] = $message;
	
			$this->load->view('restaurantportal/staff/time_tracking',$data);
		} else {
			redirect(base_url()."restaurantportal",true);
		}
	}

	function myschedule () {
		if ($this->session->userdata('type') == 'employee') {
			//
			$current_week =  date("W");
			$year =  date("Y");
			//
			$weekdays = $this->getStartAndEndDate($current_week, $year);
			$week_start_date = $weekdays['mon'];
			$week_end_date = $weekdays['sun'];
			//
			$employee_id = $this->session->userdata('id');
			$restaurant_id = $this->staff_core->getRestaurantId($employee_id);
			$restaurant = $this->staff_core->getRestaurantByRestaurantId($restaurant_id);
			//
			$myschedule = $this->staff_core->getMySchedule($employee_id, $restaurant_id, $week_start_date, $week_end_date);
			//
			$data = array();
			$data['myschedule'] = $myschedule;
			$data['activemenu'] = 'myschedule';
			$data["restaurant"]	=	$restaurant;
			$data['start'] = date('M d Y, D', strtotime($week_start_date));
			$data['end'] = date('M d Y, D', strtotime($week_end_date));
		
			$this->load->view('restaurantportal/staff/my_schedule',$data);
		} else {
			redirect(base_url()."restaurantportal",true);
		}
	}

	function getStartAndEndDate($week, $year) {
		$dateTime = new DateTime();
		$dateTime->setISODate($year, $week);
		//
		$result['mon'] = $dateTime->format('Y-m-d');
		//
		$tuesday = $dateTime->modify('+1 days');
		$result['tue'] = $tuesday->format('Y-m-d');
		//
		$wednesday = $dateTime->modify('+1 days');
		$result['wed'] = $wednesday->format('Y-m-d');
		//
		$thursday = $dateTime->modify('+1 days');
		$result['thu'] = $thursday->format('Y-m-d');
		//
		$friday = $dateTime->modify('+1 days');
		$result['fri'] = $friday->format('Y-m-d');
		//
		//
		$saturday = $dateTime->modify('+1 days');
		$result['sat'] = $saturday->format('Y-m-d');
		//
		$sunday = $dateTime->modify('+1 days');
		$result['sun'] = $sunday->format('Y-m-d');
		//
		return $result;
	}
	
/**
.........................................................................................................
									End Restaurant Staff Section 
.........................................................................................................
*/	


}

?>
