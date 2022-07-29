<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class MenuItem_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addNewMenuItem($arrInfo)
	{
      	$this->db->insert("menu_item", $arrInfo);  
		$nInsertId	=	$this->db->insert_id();

		$this->db->query('update menu_category set item_count=item_count+1 where id='.$arrInfo["category_id"].'');
		//$this->db->join('restaurant' , 'menu_item.restaurant_id = restaurant.id' , "inner join");
		$this->db->query('update restaurant set have_menu = "Yes" where id = '.$arrInfo["restaurant_id"].'');
		
		return $nInsertId;
	}

	/*
	Update
	*/
	function updateMenuItem($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_item');
	}

	/*
	Delete
	*/
	function deleteMenuItem($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('menu_item'); 		
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/
	function getMenuItemsByRestaurantId($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
	{
		$this->db->where(array('menu_item.restaurant_id'=>$restaurantId));

		$this->db->where(array('menu_item.status <>'=>"Deleted"));


		if(isset($filters["orderby"]))
		{
			$this->db->order_by($filters["orderby"], "desc"); 
		}
		
		if (isset($filters["status"]) && $filters["status"]	==	"All")
		{
		}
		else if(isset($filters["status"]))
		{
			$this->db->where(array('menu_item.status'=>$filters["status"]));
			$this->db->where(array('menu_category.status'=>$filters["status"]));
		}
		else
		{
			$this->db->where(array('menu_item.status'=>'Active'));
			$this->db->where(array('menu_category.status'=>'Active'));
		}
		
		if(isset($filters["alphabet"]) && $filters["alphabet"]!="")
			$this->db->like('item_name', $filters["alphabet"], 'after');

		if(isset($filters["category_id"]) && $filters["category_id"]!="" && $filters["category_id"]!="select")
			$this->db->where(array('category_id'=>$filters["category_id"]));
//			$this->db->where(array('status'=>$filters["status"]));
			
//		$this->db->where(array('1'=>$filters["category_id"]));
		
		$this->db->limit($limit, $offset);

		if (isset($filters["sortby"]))
			$this->db->order_by($filters["sortby"], "desc");
		else
			$this->db->order_by("id", "desc");

			
		$this->db->select('menu_item.*, menu_category.category_name, menu_category.category_icon, menu_category.sort_index, restaurant.restaurant_citytax, restaurant.restaurant_statetax');
		$this->db->from('menu_item');
		$this->db->join('menu_category', 'menu_category.id = menu_item.category_id');

		$this->db->join('restaurant', 'menu_item.restaurant_id = restaurant.id');
		//$this->db->join('airport_terminal', 'restaurant.terminal_id = airport_terminal.id');
		//$this->db->join('airport', 'airport_terminal.airport_id = airport.id');


		if (isset($filters["pickup_time"]))			
		{
//			echo $filters["pickup_time"];
			
			if (date("l",strtotime($filters["pickup_time"]))	==	"monday")
				$this->db->where(array('menu_timing.monday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"tuesday")
				$this->db->where(array('menu_timing.tuesday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"wednesday")
				$this->db->where(array('menu_timing.wednesday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"thursday")
				$this->db->where(array('menu_timing.thursday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"friday")
				$this->db->where(array('menu_timing.friday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"satureday")
				$this->db->where(array('menu_timing.satureday'=>"Yes"));
			if (date("l",strtotime($filters["pickup_time"]))	==	"sunday")
				$this->db->where(array('menu_timing.sunday'=>"Yes"));
								
			$this->db->where('(start is NULL OR ( time(start)<= "'.$filters["pickup_time"].'" AND time(end)>="'.$filters["pickup_time"].'"))');
			$this->db->join('menu_item_timing', 'menu_item.id = menu_item_timing.item_id', "left outer");
			$this->db->join('menu_timing', 'menu_timing.id = menu_item_timing.menu_timing_id', "left outer");
			

		}
		

		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		if ($count	==	"Yes")		
		{
			return $query->num_rows();
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
			}		
			// Return Array
			return $list;
		}
	}
	/**
	* Menu Item Timing Authentication
	*/
	function menuItemTimingAuthentication($itemId, $pickup_time)
	{
		$this->db->where(array('menu_item.id'=>$itemId));
		
		$this->db->where('(start is NULL OR ( time(start)<= "'.$pickup_time.'" AND time(end)>="'.$pickup_time.'"))');
		$this->db->join('menu_item_timing', 'menu_item.id = menu_item_timing.item_id', "left outer");
		$this->db->join('menu_timing', 'menu_timing.id = menu_item_timing.menu_timing_id', "left outer");
			
		$this->db->select('menu_item.*');
		$this->db->from('menu_item');

		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		
		if ($query->num_rows() > 0)
		{
			$list["response"]="Available";
		}else{
			$list["response"]="Not Available";
		}	
		
		return $list;
			
	}
	/**
	* @method This method will return Menu Items against a category 
	* @params category Id will be passed as parameter
	*/
	function getMenuItemsByCategoryId($catId)
	{
		$this->db->where(array('category_id'=>$catId));
		$this->db->where(array('status'=>'Active'));
		$query=$this->db->get("menu_item");

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	/**
	* @method This method will return specific menu item details 
	* @params Item Id will be passed as parameter
	*/
	function getMenuItemById($Id)
	{
		$this->db->where(array('id'=>$Id));
		$this->db->where(array('status'=>'Active'));
		$query=$this->db->get("menu_item");	

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}

}
?>
