<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class UserSearch extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/restaurant_favorites');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
		$this->load->library('pagination');
	}
	
/**
.........................................................................................................
									Start Restaurant Search Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data	=	array();
//		$this->load->view('userfront/home',$data);
	}

	function getRestaurantTip($nRestaurantID)
	{
		$data	=	array();

		$data["restaurant"]	=	$this->restaurant->listRestaurantById($nRestaurantID);
		
		$response["in_html"]	=	$this->load->view('userfront/userrestaurant/partialviews/tooltip',$data,true);
		echo json_encode($response);
		exit ();		
		
	}

	function searchresult($isfavorite="No")
	{
		die();
		$data	=	array();
		$favrests	=	array();
		$arrReturn	=	array();
		$arrTerminal	=	array();	
//		$userId = 1;
		
		$data["activemenu"]	=	"searchresult";
		
		if ($this->session->userdata('search_criteria')){
			$arrReturn = $this->session->userdata('search_criteria');
		//	print_r($arrReturn);
		//	exit();
			}
		// else
		// 	redirect(base_url()."home");
			
			
		if (!empty($arrReturn["airportid"]))
		{
			$this->load->library('core/terminals');
			
			$arrReturn["terminalList"]	=	$this->terminals->listTerminals($arrReturn["airportid"]);
			foreach ($arrReturn["terminalList"] as $terminalInfo)
			{
				if ($terminalInfo["id"]	==	$arrReturn["terminal"])
				{
					$arrTerminal	=	$terminalInfo;
				}
			}
			
		}
		// else
		// {
		// 	redirect(base_url()."home");
		// }
		
		$data["arrReturn"]	=	$arrReturn;


		if ($this->session->userdata('id'))
		{
			$arrFilters["userId"]	=	$this->session->userdata('id');
			$favrests=$this->restaurant_favorites->listRestaurantFavorites($arrFilters);
		}
		
 		
		$favRestaurantIDs	=	array();
		$favIDs	=	array();
		
		foreach ($favrests as $favRest)
		{
			$favRestaurantIDs[]	=	$favRest["restaurant_id"];
			$favIDs[]	=	$favRest["favid"];
			
		}
		
	/*	if ($arrReturn["pickup_time_type"] == "PM")
			$arrReturn["pickup_time_hour"] = $arrReturn["pickup_time_hour"] + 12;
		if ($arrReturn["pickup_time_hour"] == 24)
			$arrReturn["pickup_time_hour"] = "00";*/
				
		//$pickup_time = date("H:i:s",strtotime($arrReturn["pickup_time_hour"].":".$arrReturn["pickup_time_minute"].":00"));
		$pickup_time = '';
		$arrReturn["terminal"] = '';
		$per_page	=	$this->config->item("PER_PAGE");
		$data["ncounter"]	=	1;
		if(is_numeric($this->uri->segment(3)))
			$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(3);
		$data["total"]= $total	=	$this->restaurant->listRestaurant($arrReturn["terminal"],"Active", $pickup_time, $isfavorite,"Yes");
		if( $total > $per_page )
		{	
			$data["records"] = $per_page + $this->uri->segment(3);
			if($data["records"]>=$total)
				$data["records"]=$total;
		
		}else{
			$data["records"] = $total;
		}
		
		$config['base_url'] = base_url().'/usersearch/searchresult';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '3';
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';

		$config['next_link'] = '<li>Next >></li>';
		$config['prev_link'] = '<li><< Back</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';

		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();
		$logoPath	=	$this->config->item("restaurant_logo_path");
//		$list=$this->restaurant->listRestaurant($arrReturn["terminal"],"Active", $pickup_time="");
		$list=$this->restaurant->listRestaurant($arrReturn["terminal"],"Active", $pickup_time, $isfavorite,"No",$per_page, $this->uri->segment(3));
		$data["logoPath"] = $logoPath;
		$data["restaurants"]=$list;
		$data["favRestaurantIDs"]=$favRestaurantIDs;
		$data["favIDs"]=$favIDs;
		$data["isfavorite"]	=	$isfavorite;
		$data["arrTerminal"]	=	$arrTerminal;
		
///////////////////////////////////////////////////////////////////////////////		
/*		$menutiming = array();
		$restiming = "get all records of restaurant timing table";
		foreach($list as $modified)
		{
			foreach($restiming as $timing)
			{
				
			}
		}
			*/
		
/////////////////////////////////////////////////////////////////////////////////
		
		$this->load->view('userfront/usersearch/searchresult',$data);
	}


/**
.........................................................................................................
									End Restaurant Search Section 
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
