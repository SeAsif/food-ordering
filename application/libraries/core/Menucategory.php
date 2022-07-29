<?
/**
* Menu Item Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class MenuCategory {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menucategory_model');	
		}
		
		/**
		* @method This method will return menu catogires for restaurant
		* @params restaurant will be passed as parameter
		*/
		function listMenuCategoryByRestaurantId($retaurantId,$categoryFilters=NULL,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menucategory_model->getMenuCategoryByRestaurantId($retaurantId,$categoryFilters,$count,$limit,$offset);
			
			return $list;
		}
		/**
		* @method Update Menu Category
		* @params restaurant information will be passed as parameter
		*/
		function updateMenuCategory($arrInfo)
		{
			$list=$this->_obj->menucategory_model->updateMenuCategory($arrInfo);
			
			return $list;
		}
		
		/**
		* @method Update Menu Category
		* @params restaurant information will be passed as parameter
		*/
		function addNewMenuCategory($arrInfo)
		{
			$list=$this->_obj->menucategory_model->addNewMenuCategory($arrInfo);
			
			return $list;
		}
		
		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getMenuItemCategoryById($Id)
		{
			$list=$this->_obj->menucategory_model->getMenuCategoryById($Id);
			
			return $list;
		}

	}
?>
