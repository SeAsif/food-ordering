<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class RestaurantItem extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('core/menuitem');
		$this->load->library('core/menucategory');
		$this->load->library('core/menuitemvariantcategory');
		$this->load->library('core/menuitemgroup');
		$this->load->library('core/menuitemvariant');
		$this->load->library('core/menu_timings');
		$this->load->library('core/menuitemvariantgroup');		
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

	function managefooditems($state = '')
	{
		$data	=	array();
		$arrSession = array();
		$filters	=	array("status"=> "All","sortby"=>"id","alphabet"=>"","category_id" => "select");
		
		$data["activemenu"]	=	"managefooditems";
		$restaurantArr = $this->session->userdata('restaurant');
		$filters = ($this->session->userdata('search_criteria'))?$this->session->userdata('search_criteria'):$filters;
		
		$restaurantID	=	$restaurantArr["id"];
		
		if ($_POST)
		{
			if ($this->input->post("updatestatus"))//update status{
			{				
				//update or add here
				if ($this->input->post("updateid"))
				{
					$item1["id"]	=	trim($this->input->post("updateid"));
					$item1["status"]	=	$this->input->post("updatestatus");
					$itemid1	=	$this->menuitem->updateMenuItem($item1);
					
					if($item1["status"] == "Deleted")
						$data["success"]=array("msg"=>$this->input->get_post("itemName")." Deleted successfully");
					
					else
						$data["success"]=array("msg"=>$this->input->get_post("itemName")." Status updated successfully");
				}
			}	
			else
			{
				$filters["category_id"]	=	($this->input->post("category_id")!="select")?$this->input->post("category_id"):"";
				$filters["alphabet"]	=	($this->input->post("alphabet"));
				$filters["status"]	=	$this->input->post("status");
				
				$this->session->set_userdata('search_criteria',$filters);
			
			}		
			
		}
	
	//		$data["success"]=array("msg"=>$this->input->post("categoryName")." Updated Successfully");
		
		if ($state	==	"added")
		{
			$data["success"]=array("msg"=>"Item Added Successfully");
		}
		else if ($state	==	"updated")
		{
			$data["success"]=array("msg"=>"Item Updated Successfully");
		}
		$per_page	=	$this->config->item("PER_PAGE");
//		$per_page	=	1;
		$data["ncounter"]	=	1;
		$data["ncounter"]	=	$data["ncounter"]+$this->uri->segment(4);
		
		$data["items"]	=	$this->menuitem->listMenuItemByRestaurantId($restaurantID,$filters,"No",$per_page, $this->uri->segment(4));
		
//		print_r ($data["items"]);
		
		$total	=	$this->menuitem->listMenuItemByRestaurantId($restaurantID,$filters,"Yes");
		
		$config['base_url'] = base_url().'/restaurantitem/managefooditems/page/';
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = '4';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Back';

		if( $total > $per_page )
		{
			$this->pagination->initialize($config);
		}
		
		$data['paginationLinks']=$this->pagination->create_links();

		$data["categorylist"]	=	$this->menucategory->listMenuCategoryByRestaurantId($restaurantID);
		$data["filters"]	=	$filters;

		$this->load->view('restaurantportal/fooditems/managefooditems',$data);
	
	}	
	
	function addItem($itemId)
	{
		$data	=	array();
		$item	=	array(
			'id' => 0,
			'item_name' => '',
			'item_statetax' => 0,
			'serve_type' => '',
			'travelable' => false, 
			'liquid_contain' => false, 
			'basic_taste' => '', 
			'item_price' => '', 
			'item_citytax' => 0, 
			//'attached_menu_timings' => '', 
			'category_id' => 0,
			'item_description' => ''
		);
		//	echo $itemId;		
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];

		if ($itemId!=0)
		{
			// print_r ($this->menuitem->listMenuItemById($itemId));
			$item	=	$this->menuitem->listMenuItemById($itemId);
			$data["type"] = "edit";

		}
		
		if ($_POST)
		{
			$this->form_validation->set_rules('item_name', 'Item Name', 'trim|required');
			$this->form_validation->set_rules('item_price', 'Item Price', 'trim|required');
			$this->form_validation->set_rules('statetax', 'State Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('citytax', 'City Tax', 'trim|numeric|callback_checktax');
			$this->form_validation->set_rules('category_id', 'Food Category', 'trim|required');
			$this->form_validation->set_rules('item_description', 'Item Description', 'max_length[250]');

	        //
			$item["item_name"]			=	$this->input->post("item_name");
			$item["item_price"]			=	$this->input->post("item_price");
			$item["item_statetax"]		=	$this->input->post("statetax");
			$item["item_citytax"]		=	$this->input->post("citytax");
			$item["serve_type"]			=	$this->input->post("serve_type");
			$item["travelable"]			=	$this->input->post("travelable");
			$item["liquid_contain"]		=	$this->input->post("liquid_contain");
			$item["basic_taste"]		=	$this->input->post("basic_taste");
			$item["category_id"]		=	$this->input->post("category_id");
			$item["item_description"]	=	$this->input->post("item_description");
			$item["restaurant_id"]		=	$restaurantID;
			$added_group				=	$this->input->post("added_group");
			
			if ($this->form_validation->run() == FALSE || $item["category_id"]=="select")
			{
				$this->form_validation->set_error_delimiters('<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> <strong>Alert:</strong> ', '</p>');
				
				$errorsArray['item_name']	=	form_error('item_name');
				$errorsArray['item_price']	=	form_error('item_price');
				$errorsArray['statetax']	=	form_error('statetax');
				$errorsArray['citytax']	=	form_error('citytax');
				$errorsArray['item_description']	=	form_error('item_description');
				$errorsArray['category']	=	"Atleast one category should be selected";

				$data["errors"]=$errorsArray;
			
			}
			else
			{
				if (!empty($_FILES) && isset($_FILES['item_image']) && $_FILES['item_image']['size'] > 0 ) {
				
		            $target_file_name = clean_image_path(basename($_FILES["item_image"]["name"]));
		            $item_image_name = strtolower(md5(uniqid(rand(), true)).'_'.$target_file_name);
		            $target_dir = FCPATH . 'uploads/restaurant/menuItems/';

		            $target_file = $target_dir . $item_image_name;

		            if(!is_dir($target_dir)) {
		               mkdir($target_dir, 0777, true);
		            }

		            move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file);
		            $item["item_image"]			=	$item_image_name;
		        }

				$menuTimings	=	$this->input->post("menu_timing_id");
				$attachedTimings	=	explode(",",$this->input->post("attached_menu_timings"));
				if ($itemId!=0 && $itemId!="")
				{
					//update
					$this->menuitem->updateMenuItem($item);
					$data["success"]=array("msg"=>"Updated Successfully");
					
					
					if (is_array($menuTimings))
					{

						foreach ($menuTimings as $menuTimingAttach)
						{
							if ((!is_array($attachedTimings))|| !in_array($menuTimingAttach,$attachedTimings))
							{
								$this->menu_timings->attachMenuTiming($itemId, $menuTimingAttach);	
							}
							
						}
					}

					
					foreach ($attachedTimings as $itemAttached)
					{
						if ((!is_array($menuTimings))|| !in_array($itemAttached,$menuTimings))
						{
							$this->menu_timings->removeMenuTimingAttachment($itemId, $itemAttached);	
						}
					}
				}
				else
				{
					//add
					$itemId	=	$this->menuitem->addNewMenuItem($item);
					$data["success"]=array("msg"=>"Added Successfully");
					$item["id"]	=$itemId;
							
					// foreach ($menuTimings as $menuTimingAttach)
					// {
						//echo $menuTimingAttach;
						// $this->menu_timings->attachMenuTiming($itemId, $menuTimingAttach);	
						//attach menu timing attach					
					// }

					
				}

				
				if ($added_group	!=	"")
				{
					$addedGroups	=	explode(",",$added_group);
					foreach ($addedGroups as $groupId)
					{
						$menu_item_variant["item_id"]	=	$itemId;
						$menu_item_variant["group_id"]	=	$groupId;
					//	$data["groupId"] = $groupId;
						$menu_item_variant["restaurant_id"]	=	$restaurantID;
						$this->menuitemgroup->attachMenuItemWithGroup($menu_item_variant);	
						
					}//end foreach ($addedGroups as $groupId)
				}//end if ($added_group	!=	"")
			}
		}
		$data["item"]	=	$item;
		$data["attached_menu_timings"]	=	'';
		$data["attached_variant_groups"]	=	[];
		
		if ($itemId!=0)
		{
			$data["attached_variant_groups"]	=	$this->menuitemgroup->listMenuItemDetails($itemId,"No");
			$data["attached_menu_timings"]	=	implode(",",$this->menu_timings->getAttachedMenuItemTiming($itemId));
		}
		
		$data["available_menu_timings"]	=	$this->menu_timings->listMenuTimingsByRestaurantId($restaurantID);
		/*		print_r ($data["attached_menu_timings"]);
				echo "<br />";
				print_r ($data["available_menu_timings"]);
		*/		
		$data["categorylist"]	=	$this->menucategory->listMenuCategoryByRestaurantId($restaurantID);
		
		
		$data["menu_item_variant_category"]	=	$this->menuitemvariantcategory->getVariantItemCategories($restaurantID);
		$data["citytax"]	=	$restaurantArr["restaurant_citytax"];
		$data["statetax"]	=	$restaurantArr["restaurant_statetax"];
		
		$this->load->view('restaurantportal/fooditems/additem',$data);
	}
	
	function changestatus($type)
	{
		$this->input->post("id");
		echo "saved";
		exit ();
	}

	function deactivate()
	{
		$this->input->post("id");
		echo "saved";
		exit ();
	}
	
	function addFoodVariant()
	{
		$variant_name =  $this->input->get_post("varia");
		$categoryArr["category_name"]	=	$variant_name;
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
		
	//	$categoryId	=	$this->menucategory->addNewMenuCategory($categoryArr);
		if($variant_name != "")
		{
			$categoryArr["restaurant_id"]	=	$restaurantArr["id"];
			$categoryArr["status"]	=	"Active";
			$data = $this->menucategory->addNewMenuCategory($categoryArr);
			//echo $variant_name;
			echo "RECORD_ADDED";
		//	exit();
			
		}
		else
			echo "variant name Required";

		exit();
	}
	
	function deleteFoodVariant()
	{
		$variant_name =  $this->input->get_post("varia");
		$item_id =  $this->input->get_post("varia2");
		$categoryArr["group_id"]	=	$variant_name;
		$categoryArr["item_id"]	=	$item_id;
	//	print_r($categoryArr);
		if($variant_name != "")
		{
			$data = $this->menuitemvariant->deleteAttachment($categoryArr);
			echo "RECORD_DELETED";
		}
		else
			echo "Record Cannot be Deleted";

		exit();
	}
	
	function getFoodCategories()
	{
		$restaurantArr = $this->session->userdata('restaurant');
		$restaurantID	=	$restaurantArr["id"];
	//	echo "czxczx";
		$list = $this->menucategory->listMenuCategoryByRestaurantId($restaurantID);
	//	print_r($list);
		echo json_encode($list);
		
		exit ();
	}
	function checktax($str)
	{
		if($str < 1 && $str != 0)
		{
			$this->form_validation->set_message('checktax', 'The %s field should be in percentage. Cannot be less than 1');
			return FALSE;
		}
		else if($str > 100)
		{
			$this->form_validation->set_message('checktax', 'The %s field should be less than 100.');
			return FALSE;
		}
		else
		{
			return TRUE;
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
