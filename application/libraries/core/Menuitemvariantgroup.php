<?
/**
* Menu Item Variant Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class MenuItemVariantGroup {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menuitemvariantgroup_model');	
		}
		

		/**
		* @method This method will return menu item variants
		* @params group will be passed as parameter
		*/
		function getVariantItemGroups($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menuitemvariantgroup_model->getVariantItemGroups($restaurantId ,$filters ,$count,$limit , $offset);
			
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function menuItemVariantGroupById($Id)
		{
			$list=$this->_obj->menuitemvariantgroup_model->getMenuItemVariantGroupById($Id);
			
			return $list;
		}
		function deleteMenuItemVariantGroup($arrInfo)
		{
			$list=$this->_obj->menuitemvariantgroup_model->deleteMenuItemVariantGroup($arrInfo);
			
			return $list;
		}
		function listMenuItemDetails($id)
		{
			$list=$this->_obj->menuitemvariantgroup_model->listMenuItemDetails($id);
			
			return $list;
		}
	}
?>
