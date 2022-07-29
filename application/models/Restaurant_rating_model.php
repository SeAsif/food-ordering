<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Restaurant_rating_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addRating($arrInfo)
	{
		$this->db->insert("restaurant_rating", $arrInfo);
		
		
		
		$this->db->where(array('restaurant_id'=>$arrInfo['restaurant_id']));
		$query=$this->db->get("restaurant_rating");
		$total_rating = 0;
		$total_count = 0;
		
		foreach ($query->result_array() as $row)
		{
			$total_rating = $total_rating + $row['num'];
			$total_count++;
		}
		
		$avg_rating = round($total_rating / $total_count);
		$this->db->where(array('id'=>$arrInfo['restaurant_id']));
		$this->db->set(array('avg_rating'=>$avg_rating));
		$this->db->update('restaurant');
		
		
		 
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateRating($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('restaurant_rating');
	}

	/**
		Delete
	*/
	function deleteRating($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('restaurant_rating'); 		
	}

	/**
	* @method This method will return Restaurants Ratings against restaurant id 
	* @params Restaurant Id will be passed as parameter
	*/
	function getRestaurantRatings($restaurantId)
	{
		$this->db->where(array('restaurant_id'=>$restaurantId));
		$query=$this->db->get("restaurant_rating");
	
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		
		return $list;
	}
	
	function getRatings($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
//		$query=$this->db->get("restaurant_review");

		$this->db->select('restaurant_rating.*, user.firstname, user.lastname');
		$this->db->from('restaurant_rating');
		$this->db->join('user', 'user.id = restaurant_rating.user_id');
		$this->db->order_by("restaurant_rating.stamp", "desc");
		$this->db->where(array('restaurant_id'=>$restaurantId));
		$this->db->limit($limit, $offset);
	
		$query=$this->db->get();

		// Declare Array to pass data
		$list = array();
		
		if ($count	==	"Yes")		
		{
			return $query->num_rows();
		}else
		{

			foreach ($query->result_array() as $row)
			{
				$list[]	=	$row;
				
			}
			
			
			
		}			
		// Return Array
		
		
		return $list;
	}
}
?>