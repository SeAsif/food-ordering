<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class Restaurant_review_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	
	*/
	function addReview($arrInfo)
	{
      	$this->db->insert("restaurant_review", $arrInfo);  
		
		return $this->db->insert_id();
	}

	/**
		Update
	*/
	function updateReview($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		
		$this->db->set($arrInfo); 
		$this->db->update('restaurant_review');
	}

	/**
		Delete
	*/
	function deleteReview($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('restaurant_review'); 		
	}

	/**
	* @method This method will return Restaurants Review against restaurant id 
	* @params Restaurant Id will be passed as parameter
	*/
	function getRestaurantReviews($restaurantId,$count="No",$limit = NULL, $offset = NULL)
	{
//		$query=$this->db->get("restaurant_review");

		$this->db->select('restaurant_review.*, user.firstname, user.lastname');
		$this->db->from('restaurant_review');
		$this->db->join('user', 'user.id = restaurant_review.user_id');
		$this->db->order_by("restaurant_review.stamp", "desc");
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
	
	/**
	* @method This method will return Restaurants Review against restaurant id 
	* @params Restaurant Id will be passed as parameter
	*/
	function readURL($arrInfo)
	{
		$loc = $arrInfo['address'];
		$address = str_ireplace(" ", "+", $loc);	
		//$address = str_ireplace(" ", "%20", $address);	
	//	echo $address;	
		
		$url = "http://api.yelp.com/business_review_search?term=".$arrInfo['restaurant_name']."&category=restaurants&ywsid=Z45OLwMg8ereEmnKGmJRbA&location=".$address;
		
		$handle = fopen ($url, "r");
		$contents = "";
		do {
			$data = fread($handle, 8192);
			if (strlen($data) == 0) {
				break;
			}
			$contents .= $data;
		} while(true);
		fclose ($handle);	
		$contents=json_decode($contents);
	//	print_r($contents);//->{businesses}[0]->{reviews}[1]->{text_excerpt});
	//	exit();
		return $contents;
	}
	
	/**
	* @method This method will return Restaurants Review against restaurant id 
	* @params Restaurant Id will be passed as parameter
	*/
	function getYelpRestaurantReviews($arrInfo)
	{
		
		$list=$this->readURL($arrInfo);		
		
		return $list;
	}
}
?>