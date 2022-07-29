<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class StaffHours extends CI_Controller {

	function __construct()

	{	//exit;

		parent::__construct();
		$this->load->library('core/staff_timings');
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

	function index($state = '')
	{
		$data	=	array();

		$data["activemenu"]	=	"staffhours";
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
		
		$data["staff_members"]	=	$this->staff_timings->getStaffMembersByRestaurantId($restaurantID);

		$data["timings"]	=	$this->staff_timings->listStaffTimingsByRestaurantId($restaurantID,"No",$per_page, $this->uri->segment(3));
		
		$total	=	$this->staff_timings->listStaffTimingsByRestaurantId($restaurantID,"Yes");
		$config['base_url'] = base_url().'/staffhours/index';
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
		$this->load->view('restaurantportal/staff/staff_hours',$data);
	
	}

	function get_total_duration ($start, $end) {
		
	    $array1 = explode(':', $start);
	    $array2 = explode(':', $end);

	    $minutes1 = ($array1[0] * 60.0 + $array1[1]);
	    $minutes2 = ($array2[0] * 60.0 + $array2[1]);

	    return $diff = $minutes2 - $minutes1;
	} 	

	
	function addtiming($itemId = 0)
	{
		$data	=	array();
		$item =	['id' => 0, 'start' => "00:00",'end' => "00:00"];
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
		
		if ($itemId!=0)
		{
			$item	=	$this->staff_timings->listTimingById($itemId);
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

			$staff_note = $this->input->post("staff_note");
			
			$item["start"]	= $start;
			$item["end"]	= $end;
			$item["day"]	= $day;
			$item["staff_note"]	= $staff_note;
			$item["staff_id"]	=	$this->input->post("staff_id");

			if ($item["staff_id"] == 0) {
				$errorsArray['time_error']	=	"Select staff member";
				$data["errors"]=$errorsArray;
			} else if ($startMKTime>$endMKTime) {
				$errorsArray['time_error']	=	"Start time should be lesser than end time";
				$data["errors"]=$errorsArray;
			} else {
				$duration = $this->get_total_duration($start, $end);
				$item["time_duration"] = $duration;

				if (isset($_POST['whole_week']) && $_POST['whole_week'] == 'yes') {
					unset($item['id']);
					$week = ["Monday", "Tuesday","Wednesday",  "Thursday", "Friday","Saturday","Sunday",  ];
					$this->staff_timings->deleteTimingWholeWeek($item["staff_id"]);
					foreach ($week as $day) {
						$item["day"]	= $day;
						$this->staff_timings->addNewStaffTiming($item);
					}
				} else {
					if ($itemId!=0 && $itemId!="") {
						//update
						$this->staff_timings->updateStaffTiming($item);
						$data["success"]=array("msg"=>"Updated Successfully");
					} else {
						//add
						$itemId	=	$this->staff_timings->addNewStaffTiming($item);
						$data["success"]=array("msg"=>"Added Successfully");
						$item["id"]	=$itemId;
					}
				}	
			}
		}

		$data["item"]	=	$item;
		$_SESSION["user_msgs"] = $data;
		redirect(base_url()."staffhours");
	}
	

	function deleteoperetionalhours()
	{
		if($_POST['operation_hour_id']){
			$restaurantArr = $this->session->userdata('restaurant');
			$restaurantID	=	$restaurantArr["id"];
			$this->staff_timings->deleteStaffTiming($_POST['operation_hour_id']);
			$data["success"]=array("msg"=>"Staff hours deleted successfully");
			$_SESSION["user_msgs"] = $data;
			redirect(base_url()."staffhours");
		}
	}

	function schedule()
	{
		$data	=	array();
		$data["activemenu"]	=	"listschedule";
		$allow_default	=	"no";
		$allow_default	=	"no";
		$schedule_staff = array();
		//
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
		//
		$week_number = 1;

		if (isset($_POST['week_no'])) {
		    $week_number = $_POST['week_no'];
		} else {
		    $week_number =  date("W");
		}

		$staff_members = $staff_filter =$this->staff_timings->getStaffMembersByRestaurantId($restaurantID);
		//
		$selected_staff = 0;
		//
		if (isset($_POST['selected_staff'])) {
			$selected_staff = $_POST['selected_staff'];
			$staff_members	=	$this->staff_timings->getRestaurantMember($selected_staff);
		} 
		//
		$year = date("Y");
		$data["week_number"] = $week_number;
		$data["current_year"] = $year;

		$current_week = $this->getStartAndEndDate($week_number, $year);
		//
		$html_title = $current_week['mon'].' / '.$current_week['sun'];
		//
		foreach ($staff_members as $mkey => $member) {
			//
			$staff_week_time_duration = 0;
			//
			$staff_id = $member['id'];
			$staff_timing	=	$this->staff_timings->getStaffweeklytiming($staff_id);
			//
			$staff_week = array();
			//
			$staff_week['Monday']['display'] = '';
			$staff_week['Monday']['day_note'] = '';
			$staff_week['Monday']['allow_drop'] = 'yes';
			$staff_week['Monday']['start_hour'] = '00';
			$staff_week['Monday']['end_hour'] = '00';
			$staff_week['Monday']['start_min'] = '00';
			$staff_week['Monday']['end_min'] = '00';
			//
			$staff_week['Tuesday']['display'] = '';
			$staff_week['Tuesday']['day_note'] = '';
			$staff_week['Tuesday']['allow_drop'] = 'yes';
			$staff_week['Tuesday']['start_hour'] = '00';
			$staff_week['Tuesday']['end_hour'] = '00';
			$staff_week['Tuesday']['start_min'] = '00';
			$staff_week['Tuesday']['end_min'] = '00';
			//
			$staff_week['Wednesday']['display'] = '';
			$staff_week['Wednesday']['day_note'] = '';
			$staff_week['Wednesday']['allow_drop'] = 'yes';
			$staff_week['Wednesday']['start_hour'] = '00';
			$staff_week['Wednesday']['end_hour'] = '00';
			$staff_week['Wednesday']['start_min'] = '00';
			$staff_week['Wednesday']['end_min'] = '00';
			//
			$staff_week['Thursday']['display']= '';
			$staff_week['Thursday']['day_note']= '';
			$staff_week['Thursday']['allow_drop'] = 'yes';
			$staff_week['Thursday']['start_hour'] = '00';
			$staff_week['Thursday']['end_hour'] = '00';
			$staff_week['Thursday']['start_min'] = '00';
			$staff_week['Thursday']['end_min'] = '00';
			//
			$staff_week['Friday']['display'] = '';
			$staff_week['Friday']['day_note'] = '';
			$staff_week['Friday']['allow_drop'] = 'yes';
			$staff_week['Friday']['start_hour'] = '00';
			$staff_week['Friday']['end_hour'] = '00';
			$staff_week['Friday']['start_min'] = '00';
			$staff_week['Friday']['end_min'] = '00';
			//
			$staff_week['Saturday']['display'] = '';
			$staff_week['Saturday']['day_note'] = '';
			$staff_week['Saturday']['allow_drop'] = 'yes';
			$staff_week['Saturday']['start_hour'] = '00';
			$staff_week['Saturday']['end_hour'] = '00';
			$staff_week['Saturday']['start_min'] = '00';
			$staff_week['Saturday']['end_min'] = '00';
			//
			$staff_week['Sunday']['display'] = '';
			$staff_week['Sunday']['day_note'] = '';
			$staff_week['Sunday']['allow_drop'] = 'yes';
			$staff_week['Sunday']['start_hour'] = '00';
			$staff_week['Sunday']['end_hour'] = '00';
			$staff_week['Sunday']['start_min'] = '00';
			$staff_week['Sunday']['end_min'] = '00';
			//
			if (!empty($staff_timing)) {
				//
				array_push($schedule_staff, $staff_id);
				//
				foreach ($staff_timing as $key => $value) {
					if ($value['time_duration'] == 0) {
						$start = $value['start'];
						$end = $value['end'];
						$row_id = $value['id'];
						//
						$duration = $this->get_total_duration($start, $end);
						$this->staff_timings->updateStaffDuration($duration, $row_id);
						//
						$staff_week_time_duration = $staff_week_time_duration + $duration;
					} else {
						$staff_week_time_duration = $staff_week_time_duration + $value['time_duration'];
					}
					//
					
					$staff_week[$value['day']]['display'] = date("h:i a", strtotime($value['start'])).' - '.date("h:i a", strtotime($value['end']));
					$staff_week[$value['day']]['day_note'] = $value['staff_note'];
					
					$start_time = explode(":", $value['start']);
					$staff_week[$value['day']]['start_hour'] = $start_time[0];
					$staff_week[$value['day']]['start_min'] = $start_time[1];
					$staff_week[$value['day']]['start'] = $value['start'];

					$end_time = explode(":", $value['end']);
					$staff_week[$value['day']]['end_hour'] = $end_time[0];
					$staff_week[$value['day']]['end_min'] = $end_time[1];
					$staff_week[$value['day']]['end'] = $value['end'];

					$staff_week[$value['day']]['allow_drop'] = 'no';
				}
				//
			}
			//		
			if ($member['role_id'] == 0) {
				$allow_default	=	"yes";
			}
			$member_roles = explode(',', $member['role_id']);
			//
			$staff_members[$mkey]['member_roles'] = $member_roles;
			//
			$staff_members[$mkey]['timing'] = $staff_week;
			$staff_members[$mkey]['total_time_duration'] = $this->convertToHoursMins($staff_week_time_duration);

		}
		//
		$roles = $role_filter = $this->staff_timings->getAllRActiveRoles($restaurantID);
		//
		$selected_role = 0;
		//
		if (isset($_POST['restaurant_role'])) {
			$selected_role = $_POST['restaurant_role'];
			$roles	=	$this->staff_timings->getRestaurantRoles($selected_role);
		} 
		//
		if (!empty($roles) && $allow_default == 'yes' && !isset($_POST['restaurant_role'])) {
			$role_count = count($roles);
			$roles[$role_count]['id'] = 0;
			$roles[$role_count]['role_name'] = 'No Role Assign';
			$roles[$role_count]['role_color'] = '#000';
			$roles[$role_count]['default'] = 'yes';
		}
		//
		$filter_weeks = array();
		// 
		for ($x = 1; $x <= 52; $x++) {
			$week_days = $this->getStartAndEndDate($x, $year);
			$filter_weeks[$x] = $week_days['mon']. ' -> '. $week_days['sun'].' , '. $year;
		}
		//
		$data["roles"]			=	$roles;
		$data["staff_members"]	=	$staff_members;
		$data["staff_filter"]	=	$staff_filter;
		$data["role_filter"]	=	$role_filter;
		$data["selected_staff"]	=	$selected_staff;
		$data["selected_role"]	=	$selected_role;
		$data["restaurant"]		=	$restaurantArr;
		$data["restaurantID"]	=	$restaurantID;
		$data["required_week"]	=	$current_week;
		$data["html_title"]		=	$html_title;
		$data["filter_weeks"]	=	$filter_weeks;
		$data["schedule_staff"]	=	implode(',', $schedule_staff);

		$this->load->view('restaurantportal/staff/final_calendar',$data);
	}

	function convertToHoursMins($time) {
	    if ($time < 1) {
	        return;
	    }
	    //
	    $hours = floor($time / 60);
	    //
	    if ($hours == 0) {
	    	$hours = '00';
	    }
	    //
	    $minutes = ($time % 60);

	    if ($minutes == 0) {
	    	$minutes = '00';
	    }
	    //
	    return $hours.':'.$minutes. ' hr';
	}

	function getStartAndEndDate($week, $year) {
		$dateTime = new DateTime();
		$dateTime->setISODate($year, $week);
		//
		$result['mon'] = $dateTime->format('M d');
		//
		$tuesday = $dateTime->modify('+1 days');
		$result['tue'] = $tuesday->format('M d');
		//
		$wednesday = $dateTime->modify('+1 days');
		$result['wed'] = $wednesday->format('M d');
		//
		$thursday = $dateTime->modify('+1 days');
		$result['thu'] = $thursday->format('M d');
		//
		$friday = $dateTime->modify('+1 days');
		$result['fri'] = $friday->format('M d');
		//
		//
		$saturday = $dateTime->modify('+1 days');
		$result['sat'] = $saturday->format('M d');
		//
		$sunday = $dateTime->modify('+1 days');
		$result['sun'] = $sunday->format('M d');
		//
		return $result;
	}

	function publish_schedule () {
		$year = $_POST['schedule_year'];
		$week = $_POST['selected_schedule_week'];
		$restaurant_id = $_POST['restaurant_id'];
		$schedule_staff = explode(',', $_POST['schedule_staff']);
		//
		foreach ($schedule_staff as $staff_id) {
			$staff_timing	=	$this->staff_timings->getStaffweeklytiming($staff_id);
			//
			$this->staff_timings->deactiveAllPreviousSchedule($staff_id, $restaurant_id);
			//
			foreach ($staff_timing as $staff_time) {
				//
				$week_day = 0;
				//
				if ($staff_time['day'] == 'Monday') {
					$week_day = 1;
				} else if ($staff_time['day'] == 'Tuesday') {
					$week_day = 2;
				} else if ($staff_time['day'] == 'Wednesday') {
					$week_day = 3;
				} else if ($staff_time['day'] == 'Thursday') {
					$week_day = 4;
				} else if ($staff_time['day'] == 'Friday') {
					$week_day = 5;
				} else if ($staff_time['day'] == 'Saturday') {
					$week_day = 6;
				} else if ($staff_time['day'] == 'Sunday') {
					$week_day = 7;
				} 
				//		
				$sechdule_date = $this->get_sechdule_date($year, $week, $week_day);
				//
				$data_to_insert = array();
				$data_to_insert['start'] = $staff_time['start'];
				$data_to_insert['end'] = $staff_time['end'];
				$data_to_insert['day'] = $staff_time['day'];
				$data_to_insert['date'] = $sechdule_date;
				$data_to_insert['staff_note'] = $staff_time['staff_note'];
				$data_to_insert['staff_id'] = $staff_id;
				$data_to_insert['restaurant_id'] = $restaurant_id;
				$data_to_insert['sechdule_status'] = 1;

				$this->staff_timings->addNewStaffSchedule($data_to_insert);

			}
			
			$this->sendScheduleEmailToStaff($week, $year, $staff_id);
		}
		//
		$this->session->set_flashdata('schedule_success', '<b>Success:</b> You have been successfully published schedule.');
		redirect(base_url()."restaurantportal",true);	
	}

	function get_sechdule_date ($year, $week, $week_day) {
		$gendate = new DateTime();
		$gendate->setISODate($year, $week, $week_day);
		return $gendate->format('Y-m-d');
	}

	function sendScheduleEmailToStaff($week, $year, $staff_id)
	{
		$selected_week = $this->getStartAndEndDate($week, $year);
		//
		$staffInfo = $this->staff_timings->getStaffInfo($staff_id);
		//
		$email = $staffInfo['email'];
		$firstname = $staffInfo['firstname'];
		$lastname = $staffInfo['lastname'];
		//
		$start = $selected_week['mon'] . ',' . $year;
		$end = $selected_week['sun'] . ',' . $year;
		//
		$data['name']	=	$firstname.' '.$lastname;
		$data["start"]	=	$start;
		$data["end"]	=	$end;
		//
		$this->load->library('email');
					
		$adminemail	=	$this->config->item("adminEmail");
		$Subject	=	"Publish Schedule";
		$config['wordwrap'] = TRUE;
		//
		$this->email->initialize($config);
		$this->email->from($adminemail, $this->config->item("adminName"));
		$this->email->to($email);
		$this->email->subject($Subject);
		$this->email->message($this->load->view('email/staff_schedule',$data,true));
		$this->email->send();
	
	}

	function handler()
    {
        // Check for ajax request
        if (!$this->input->is_ajax_request()) $this->resp();
        ///
        $post = $this->input->post(NULL, TRUE);
        //
        $restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
        //
        switch (strtolower($post['action'])) {
        	// Add New Staff Time
            case 'add_new_staff_timing':
                $start_hours = $post["start_hour"];
				$start_min = $post["start_min"];
				$days = explode(',', $post["days"]);
				//
				$startMKTime = mktime($start_hours,$start_min,0);
				$start= $start_hours.":".$start_min.":00";
				//
				$end_hours = $post["end_hour"];
				$end_min = $post["end_min"];
				$endMKTime = mktime($end_hours,$end_min,0);
				$end = $end_hours.":".$end_min.":"."00";
				//
				$res = array();
				//
				if ($startMKTime > $endMKTime || $startMKTime == $endMKTime) {
					$res['status'] = 'error';
					$res['message'] = 'Start time should be lesser than end time.';
				} else {
					$staff_id = $post["staff_id"];
					$staff_role = $post["staff_role"];

					$this->staff_timings->updateNewStaffRole($staff_id, $staff_role);

					$staff_note = $post["note"];

					$this->staff_timings->deleteTimingWholeWeek($staff_id);
					//
					$duration = $this->get_total_duration($start, $end);
					$item["time_duration"] = $duration;
					//
					$item["start"]	= $start;
					$item["end"]	= $end;
					$item["staff_id"]	=	$staff_id;
					$item["staff_note"]	=	$staff_note;

					foreach ($days as $day) {
						$item["day"]	= $day;
						$this->staff_timings->addNewStaffTiming($item);
					}
                                        
					$res['status'] = 'success';
					$res['message'] = 'Staff time added successfully.';
				}
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // Add Staff Time
            case 'add_staff_time':
                $start_hours = $post["start_hour"];
				$start_min = $post["start_min"];
				$day = $post["day"];
				//
				$startMKTime = mktime($start_hours,$start_min,0);
				$start= $start_hours.":".$start_min.":00";
				//
				$end_hours = $post["end_hour"];
				$end_min = $post["end_min"];
				$endMKTime = mktime($end_hours,$end_min,0);
				$end = $end_hours.":".$end_min.":"."00";
				//
				$res = array();
				//
				if ($startMKTime > $endMKTime) {
					$res['status'] = 'error';
					$res['message'] = 'Start time should be lesser than end time.';
				} else {
					$duration = $this->get_total_duration($start, $end);
					$item["time_duration"] = $duration;
					//
					$staff_id = $post["staff_id"];
					$item["start"]	= $start;
					$item["end"]	= $end;
					$item["day"]	= $day;
					$item["staff_id"]	=	$staff_id;

					$staff_id = $this->staff_timings->addNewStaffTiming($item);

					$display = date("h:i a", strtotime($start)).' - '.date("h:i a", strtotime($end));

					$span_id = '';

					if ($day == 'Monday') {
						$span_id = $staff_id.'_mon_span';
					}else if ($day == 'Tuesday') {
						$span_id = $staff_id.'_tue_span';
					} else if ($day == 'Wednesday') {
						$span_id = $staff_id.'_wed_span';
					} else if ($day == 'Thursday') {
						$span_id = $staff_id.'_thu_span';
					} else if ($day == 'Friday') {
						$span_id = $staff_id.'_fri_span';
					} else if ($day == 'Saturday') {
						$span_id = $staff_id.'_sat_span';
					} else if ($day == 'Sunday') {
						$span_id = $staff_id.'_sun_span';
					}



					$return_html = '';
					$return_html .= '<span id="'.$span_id.'" class="event" data-toggle="tooltip" data-html="true" title="<b>This schedule is for '.$display.'></b>" draggable="true" ondragstart="drag(event)"  start="'.$start.'" end="'.$end.'">';
					$return_html .= $display;
					$return_html .= '</span>';
                                        
					//
					$total_duration = $this->convertToHoursMins($duration);
					$res['status'] = 'success';
					$res['total_duration'] = $total_duration;
					$res['hour_key'] = 'staff_total_duration_'.$staff_id;
					$res['return_html'] = $return_html;
					$res['message'] = 'Staff time added successfully.';
				}
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // update Staff Time
            case 'update_staff_time':
            	$start_hours = $post["start_hour"];
				$start_min = $post["start_min"];
				$day = $post["day"];
				//
				$startMKTime = mktime($start_hours,$start_min,0);
				$start= $start_hours.":".$start_min.":00";
				//
				$end_hours = $post["end_hour"];
				$end_min = $post["end_min"];
				$endMKTime = mktime($end_hours,$end_min,0);
				$end = $end_hours.":".$end_min.":"."00";
				//
				$res = array();
				//
				if ($startMKTime > $endMKTime) {
					$res['status'] = 'error';
					$res['message'] = 'Start time should be lesser than end time.';
				} else {
					$duration = $this->get_total_duration($start, $end);
					$item["time_duration"] = $duration;
					//
					$staff_id = $post["staff_id"];
					$item["start"]	= $start;
					$item["end"]	= $end;

					$this->staff_timings->updateStaffScheduleTiming($item, $day, $staff_id);

					$display = date("h:i a", strtotime($start)).' - '.date("h:i a", strtotime($end));

					$span_id = '';

					if ($day == 'Monday') {
						$span_id = $staff_id.'_mon_span';
					}else if ($day == 'Tuesday') {
						$span_id = $staff_id.'_tue_span';
					} else if ($day == 'Wednesday') {
						$span_id = $staff_id.'_wed_span';
					} else if ($day == 'Thursday') {
						$span_id = $staff_id.'_thu_span';
					} else if ($day == 'Friday') {
						$span_id = $staff_id.'_fri_span';
					} else if ($day == 'Saturday') {
						$span_id = $staff_id.'_sat_span';
					} else if ($day == 'Sunday') {
						$span_id = $staff_id.'_sun_span';
					}

					$return_html = '';
					$return_html .= '<span id="'.$span_id.'" class="event" data-toggle="tooltip" data-html="true" title="<b>This schedule is for '.$display.'></b>" draggable="true" ondragstart="drag(event)" draggable="true" ondragstart="drag(event)"  start="'.$start.'" end="'.$end.'">';
					$return_html .= $display;
					$return_html .= '</span>';
                                        
					$total_duration = $this->staff_timings->getStaffTotalDuration($staff_id);
					$total_duration = $this->convertToHoursMins($total_duration);
					$res['status'] = 'success';
					$res['total_duration'] = $total_duration;
					$res['hour_key'] = 'staff_total_duration_'.$staff_id;
					$res['return_html'] = $return_html;
					$res['message'] = 'Staff time Update successfully.';
				}
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

            // Add Staff Time Via Drop Event
            case 'drop_save_time':
                $start 		= $post["start"];
				$end 		= $post["end"];
				$day 		= $post["day"];
				$staff_id 	= $post["staff_id"];
				//
				$duration = $this->get_total_duration($start, $end);
				$item["time_duration"] = $duration;
				//
				$item["day"]		= $day;
				$item["start"]		= $start;
				$item["end"]		= $end;
				$item["staff_id"]	= $staff_id;

				$this->staff_timings->addNewStaffTiming($item);

				$display = date("h:i a", strtotime($start)).' - '.date("h:i a", strtotime($end));

				$span_id = '';

				if ($day == 'Monday') {
					$span_id = $staff_id.'_mon_span';
				}else if ($day == 'Tuesday') {
					$span_id = $staff_id.'_tue_span';
				} else if ($day == 'Wednesday') {
					$span_id = $staff_id.'_wed_span';
				} else if ($day == 'Thursday') {
					$span_id = $staff_id.'_thu_span';
				} else if ($day == 'Friday') {
					$span_id = $staff_id.'_fri_span';
				} else if ($day == 'Saturday') {
					$span_id = $staff_id.'_sat_span';
				} else if ($day == 'Sunday') {
					$span_id = $staff_id.'_sun_span';
				}

				$return_html = '';
				$return_html .= '<span id="'.$span_id.'" class="event" data-toggle="tooltip" data-html="true" title="<b>This schedule is for '.$display.'></b>" draggable="true" ondragstart="drag(event)" draggable="true" ondragstart="drag(event)"  start="'.$start.'" end="'.$end.'">';
				$return_html .= $display;
				$return_html .= '</span>';

				$start_time = explode(":", $start);
				$start_hour = $start_time[0];
				$start_min 	= $start_time[1];

				$end_time 	= explode(":", $end);
				$end_hour 	= $end_time[0];
				$end_min 	= $end_time[1];
                  
                $total_duration = $this->staff_timings->getStaffTotalDuration($staff_id);
				$total_duration = $this->convertToHoursMins($total_duration); 
				//                   
				$res 				= array();
				$res['status'] 		= 'success';
				$res['total_duration'] = $total_duration;
				$res['hour_key'] = 'staff_total_duration_'.$staff_id;
				$res['return_html'] = $return_html;
				$res['start_hour'] 	= $start_hour;
				$res['start_min'] 	= $start_min;
				$res['end_hour'] 	= $end_hour;
				$res['end_min'] 	= $end_min;
				$res['message'] 	= 'Staff time added successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break;

            // Delete Staff Time
            case 'delete_staff_time':
            	$staff_id 	= $post['staff_id'];
            	$day 		= $post['day'];
				//
                $this->staff_timings->deleteStaffScheduleTiming($day, $staff_id);
                //
                $res = array();
				$res['status'] = 'success';
				$res['message'] = 'Staff time delete successfully.';
                
                header('Content-type: application/json');
		        echo json_encode($res);
		        exit(0);
            break; 

        }    
    }

}

?>