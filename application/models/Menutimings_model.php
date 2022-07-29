<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Menutimings_model extends CI_Model
{
	
	/*
	Add		
	*/
	
	function addNewMenuTiming($arrInfo)
	{
      	$this->db->insert("menu_timing", $arrInfo);  
		$nInsertId	=	$this->db->insert_id();

		return $nInsertId;
	}

	/*
	Update
	*/
	function updateMenuTiming($arrInfo)
	{	
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('menu_timing');
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
	function getMenuTimingsByRestaurantId($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
	
		$this->db->where(array('menu_timing.restaurant_id'=>$restaurantId));

		$this->db->limit($limit, $offset);

		$this->db->select('*');
		$this->db->from('menu_timing');
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
	function getMenuTimingById($Id)
	{
		$this->db->where(array('id'=>$Id));
		$query=$this->db->get("menu_timing");	

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			return $row;
		}		
		// Return Array
		return NULL;
	}
	
	function getAttachedMenuItemTiming($itemId)
	{
		$this->db->where(array('item_id'=>$itemId));
		$query=$this->db->get("menu_item_timing");	

		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row["menu_timing_id"];
		}		
		// Return Array
		return $list;
	}

	//Attach Menu Timing
	
	function attachMenuTiming($arrInfo)
	{
      	$this->db->insert("menu_item_timing", $arrInfo);  
		$nInsertId	=	$this->db->insert_id();

		return $nInsertId;
	}

	//Attach Menu Timing
	
	function removeMenuTimingAttachment($arrInfo)
	{
		$this->db->where('item_id',$arrInfo["item_id"]);
		$this->db->where('menu_timing_id',$arrInfo["menu_timing_id"]);
		$this->db->delete('menu_item_timing'); 		
	}

}
?>