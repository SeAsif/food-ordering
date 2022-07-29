<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Item_favorites_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addItemFavorites($arrInfo)
	{
      	$this->db->insert("favorite_item", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateItemFavorites($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('favorite_item');
	}

	/**
		Delete
	*/
	function deleteItemFavorites($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('favorite_item'); 		
	}

	/**
		Check Dupliacate
	*/
	function checkDuplicate($arrInfo)
	{
		$this->db->where('user_id',$arrInfo["user_id"]);
		$this->db->where('item_id',$arrInfo["item_id"]);
		$query=$this->db->get('favorite_item');
		if ($query->num_rows() > 0)
		{
			return true;
		}else{
			return false;
		}
	}

	/**
	* @method This method will return Restaurants Review against restaurant id 
	* @params Restaurant Id will be passed as parameter
	*/
	function getItemFavorites($userId, $orderBy)
	{
		$query = $this->db->query("
			SELECT
			menu_item.id,
			menu_item.item_name,
			menu_item.item_description,
			menu_item.item_price,
			menu_item.category_id,
			menu_item.restaurant_id,
			menu_item.stamp,
			menu_item.`status`,
			menu_item.order_count,
			menu_item.item_statetax,
			menu_item.item_citytax,
			restaurant.restaurant_name,
			restaurant.restaurant_statetax,
			restaurant.restaurant_citytax,
			airport_terminal.terminal_name,
			airport.airport_name,
			airport.airport_statetax,
			airport.airport_citytax,
			favorite_item.id as fav_id,
			favorite_item.user_id,
			favorite_item.restaurant_id,
			favorite_item.item_id,
			favorite_item.stamp,
			restaurant.id
			FROM
			favorite_item
			Inner Join menu_item ON favorite_item.item_id = menu_item.id
			Inner Join restaurant ON favorite_item.restaurant_id = restaurant.id
			Inner Join airport_terminal ON restaurant.terminal_id = airport_terminal.id
			Inner Join airport ON airport_terminal.airport_id = airport.id
			WHERE
			favorite_item.user_id =  '".$userId."' and restaurant.status='active' and menu_item.`status`='Active'
			Order By '".$orderBy." desc'

		");	
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
}
?>