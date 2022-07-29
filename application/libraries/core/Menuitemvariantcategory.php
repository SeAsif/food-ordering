<?
/**
* Menu Item Variant Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class MenuItemVariantCategory {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menuitemvariantcategory_model');	
		}
		

		/**
		* @method This method will return menu item variants
		* @params group will be passed as parameter
		*/
		function getVariantItemCategories($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menuitemvariantcategory_model->getVariantItemCategories($restaurantId ,$filters ,$count,$limit , $offset);
			
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getMenuItemVariantCategoryById($Id)
		{
			$list=$this->_obj->menuitemvariantcategory_model->getMenuItemVariantCategoryById($Id);
			
			return $list;
		}
		/*
		Add		
		*/
		function addNewMenuItemVariantCategory($arrInfo)
		{
			$list=$this->_obj->menuitemvariantcategory_model->addNewMenuItemVariantCategory($arrInfo);
			
			return $list;
		}
		/*
		Update
		*/
		function updateMenuItemVariantCategory($arrInfo)
		{
			$list=$this->_obj->menuitemvariantcategory_model->updateMenuItemVariantCategory($arrInfo);
			
			return $list;
		}
		
	}
?>
