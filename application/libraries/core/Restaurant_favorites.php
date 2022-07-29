<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Restaurant_Favorites {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('restaurant_favorites_model');	
		}
		
		/**
		* @method This method will add resturants reviews
		* @params array of review
		*/
		function addRestaurantFavorites($arrInfo)
		{
			if($this->_obj->restaurant_favorites_model->checkDuplicate($arrInfo))
			{
					$list_return["response"]="DUPLICATE_ERROR";
					$list_return["insert_id"]=0;
				return $list_return;
			}else{
			
				$list=$this->_obj->restaurant_favorites_model->addRestaurantFavorites($arrInfo);
				if($list!="" && $list!=0)
				{
					$list_return["response"]="RECORD_ADDED";
					$list_return["insert_id"]=$list;
					
				}
				else
				{
					$list_return["response"]="RECORD_NOT_ADDED";
					$list_return["insert_id"]=0;
				}	
				return $list_return;
			}	
		}

		/**
		* @method This method will delete the favorite restaurant
		* @params array of review
		*/
		function delRestaurantFavorites($arrInfo)
		{
			$this->_obj->restaurant_favorites_model->deleteRestaurantFavorites($arrInfo);
			$list_return=array("response"=>"FAVORITE_RESTAURANT_DELETED");
			return $list_return;
		}
		/**
		* @method This method will return resturants reviews
		* @params restaurant id will be passed as parameter
		*/
		function listRestaurantFavorites($arrFilters)
		{
			
			$list=$this->_obj->restaurant_favorites_model->getRestaurantFavorites($arrFilters);
			
			return $list;
		}
		
	}
?>
