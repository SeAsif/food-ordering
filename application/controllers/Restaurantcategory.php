<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantCategory extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/restaurant');
		$this->load->library('core/menucategory');
		$this->load->library('form_validation');	
		$this->load->helper( array('dropdown_helper') );
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
	
/**
.........................................................................................................
									Start Restaurant Food Categories Section 
.........................................................................................................
*/	
	/*
	* @method This method will login the admin
	* @params username and password will be passed as parameter 	
	*/
	function index()
	{
		$data	=	array();
	}
	function getMenuCategoryById()
	{
		$id = $this->input->post('category_id');
		$menu_category = $this->menucategory->getMenuItemCategoryById($id);
		echo json_encode($menu_category);
	}

	function managefoodcategories()
	{
		$data	=	array();
		
		$categoryFilters	=	array("status"=> "All","sortby"=>"id");
		
		$data["activemenu"]	=	"managefoodcategories";
		
		$restaurantArr = $this->session->userdata('restaurant');
		$categoryFilters = ($this->session->userdata('search_criteria2'))?$this->session->userdata('search_criteria2'):$categoryFilters;
		
		
		if ($_POST)
		{
			
			if ($this->input->post("add"))//add category
			{
				
				$categoryArr["category_name"]	=	trim($this->input->post("category_name"));
				
				
				
				$categoryArr["sort_index"]	=	trim($this->input->post("sort_index"));
				$this->form_validation->set_rules('category_name', 'Category Name', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
					
					$errorsArray['category_name']	=	form_error('category_name');
					if(empty($_FILES["category_icon"]["name"]) && empty($this->input->post("id")))
						$errorsArray['category_icon']	=	'<strong>Alert:</strong> The Category Image field is required.';
					$data["errors"]=$errorsArray;
				}
				else
				{
					//update or add here
					if(isset($_FILES["category_icon"]) && !empty($_FILES["category_icon"]["name"])){
						$target_file_name = basename($_FILES["category_icon"]["name"]);
						$category_image = strtolower(md5(uniqid(rand(), true)).'_'.$target_file_name);
						$target_dir = FCPATH . 'uploads/restaurant/category/';

						$target_file = $target_dir . $category_image;

						if(!is_dir($target_dir)) {
							mkdir($target_dir, 0777, true);
						}

						move_uploaded_file($_FILES["category_icon"]["tmp_name"], $target_file);
						$categoryArr["category_icon"]	=	$category_image;

					}
					
					if ($this->input->post("id"))
					{
						$categoryArr["id"]	=	trim($this->input->post("id"));
						$categoryId	=	$this->menucategory->updateMenuCategory($categoryArr);
						$data["success"]=array("msg"=>"Updated Successfully");
					}
					else
					{
						$categoryArr["restaurant_id"]	=	$restaurantArr["id"];
						$categoryArr["status"]	=	"Active";
						$categoryId	=	$this->menucategory->addNewMenuCategory($categoryArr);
						$data["success"]=array("msg"=>"Added Successfully");
					}
					
//					$data["success"]	=	($categoryId > 0 && $categoryId !="")?"Yes":"No";
						$categoryArr["category_name"]	=	"";
	
				}
				$data["category"]	=	$categoryArr;
			}
			else if ($this->input->post("updatestatus"))//update status{
			{				
				//update or add here
				if ($this->input->post("updateid"))
				{
					$categoryArr["id"]	=	trim($this->input->post("updateid"));
					$categoryArr["status"]	=	$this->input->post("updatestatus");
					$categoryId	=	$this->menucategory->updateMenuCategory($categoryArr);
					
					if($categoryArr["status"] == "Deleted")
						$data["success"]=array("msg"=>$this->input->post("categoryName")." Deleted Successfully");
					
					else
						$data["success"]=array("msg"=>$this->input->post("categoryName")." Updated Successfully");
				}
			}			
			else//search
			{
				if ($this->input->post("status"))
					$categoryFilters["status"]	=	$this->input->post("status");
				if ($this->input->post("sortby"))
					$categoryFilters["sortby"]	=	$this->input->post("sortby");
				
				$this->session->set_userdata('search_criteria2',$categoryFilters);	
			}
		}
		$restaurantID	=	$restaurantArr["id"];
		
		$per_page	=	$this->config->item("PER_PAGE");
		
		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(3);
		
		$data["categories"]	=	$this->menucategory->listMenuCategoryByRestaurantId($restaurantID,$categoryFilters,"No",$per_page, $this->uri->segment(3));
		
		$total	=	$this->menucategory->listMenuCategoryByRestaurantId($restaurantID,$categoryFilters,"Yes");
		
		$config['base_url'] = base_url().'/restaurantcategory/managefoodcategories';
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

		$data["categoriesfilter"]	=	$categoryFilters;
//		print_r($categoryFilters);
		$this->load->view('restaurantportal/foodcategories/managefoodcategories',$data);
		//exit();
	
	}	
/**
.........................................................................................................
									End Restaurant Food Categories Section
.........................................................................................................
*/	


}


/* End of file irestaurant.php */
/* Location: ./system/application/controllers/irestaurant.php */
?>
