<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurant
* 
*/

	class Restaurant_Rating {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('restaurant_rating_model');	
			
			
		
		}
		
		/**
		* @method This method will add ratings
		* @params array of rating table
		*/
		function addRestaurantRating($arrInfo)
		{
			$list=$this->_obj->restaurant_rating_model->addRating($arrInfo);
			if($list!="" && $list!=0)
			{
				$list_return["response"]="RECORD_ADDED";
				$list_return["insert_id"]=$list;
				
			}
			else
			{
				$list_return["response"]="RECORD_ADDED";
				$list_return["insert_id"]=0;
			}	
			return $list_return;
		}

		/**
		* @method This method will return resturants ratings
		* @params restaurant id will be passed as parameter
		*/
		function listRestaurantRatings($restaurantId)
		{
			$list=$this->_obj->restaurant_rating_model->getRestaurantRatings($restaurantId);
			
			return $list;
		}
		
		function listRatings($restaurantId,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->restaurant_rating_model->getRatings($restaurantId,$count,$limit, $offset);
			return $list;
		}
	}
?>
