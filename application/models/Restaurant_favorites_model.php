<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Restaurant_favorites_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addRestaurantFavorites($arrInfo)
	{
      	$this->db->insert("favorite_restaurant", $arrInfo);  
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateRestaurantFavorites($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('favorite_restaurant');
	}

	/**
		Delete
	*/
	function deleteRestaurantFavorites($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('favorite_restaurant'); 		
	}

	/**
		Check Dupliacate
	*/
	function checkDuplicate($arrInfo)
	{
		$this->db->where('user_id',$arrInfo["user_id"]);
		$this->db->where('restaurant_id',$arrInfo["restaurant_id"]);
		$query=$this->db->get('favorite_restaurant');
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
	function getRestaurantFavorites($arrFilters)
	{
/*
*/	
		$strCondition	=	"";
		if (isset($arrFilters["userId"]))
		{
			$strCondition	.=	"and favorite_restaurant.user_id =  '".$arrFilters["userId"]."' ";
		}
		if (isset($arrFilters["restaurantId"]))
		{
			$strCondition	.=	"and favorite_restaurant.restaurant_id =  '".$arrFilters["restaurantId"]."' ";
		}
		$strQry	=	"SELECT
				restaurant.*,
				airport_terminal.terminal_name,
				airport_terminal.terminal_image,
				airport_terminal.airport_id,
				airport.airport_name,
				airport.airport_citytax,
				airport.airport_statetax,
				favorite_restaurant.user_id,
				favorite_restaurant.restaurant_id,
				favorite_restaurant.stamp, favorite_restaurant.id as favid
				FROM
				restaurant
				Inner Join favorite_restaurant ON favorite_restaurant.restaurant_id = restaurant.id
				Inner Join airport_terminal ON favorite_restaurant.terminal_id = airport_terminal.id
				Inner Join airport ON airport_terminal.airport_id = airport.id
				WHERE
				restaurant.`status`='Active' ".$strCondition."";
		$query = $this->db->query($strQry);	
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