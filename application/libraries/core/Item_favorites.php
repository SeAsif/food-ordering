<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Item_Favorites {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('item_favorites_model');	
		}
		
		/**
		* @method This method will add resturants reviews
		* @params array of review
		*/
		function addItemFavorites($arrInfo)
		{
			if($this->_obj->item_favorites_model->checkDuplicate($arrInfo))
			{
				$list_return["response"]="DUPLICATE_ERROR";
				$list_return["insert_id"]=0;
				return $list_return;
			}else{
			
				$list=$this->_obj->item_favorites_model->addItemFavorites($arrInfo);
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
		* @method This method will delete the favorite item
		* @params id will be passed
		*/
		function delItemFavorites($arrInfo)
		{
			$this->_obj->item_favorites_model->deleteItemFavorites($arrInfo);
			$list_return=array("response"=>"RECORD_DELETED");
			return $list_return;
		}
		/**
		* @method This method will return resturants reviews
		* @params restaurant id will be passed as parameter
		*/
		function listItemFavorites($userId,$orderby="menu_item.id")
		{
			
			$list=$this->_obj->item_favorites_model->getItemFavorites($userId,$orderby);
			
			return $list;
		}
		
	}
?>
