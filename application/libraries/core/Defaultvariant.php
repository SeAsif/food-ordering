<?
/**
* Menu Item Variant Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class DefaultVariant {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('defaultvariant_model');	
		}
		
		/**
		* @method This method will return menu item variants
		* @params group will be passed as parameter
		*/
		function getDefaultVariant()
		{
			$list=$this->_obj->defaultvariant_model->getDefaultVariant();
			
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getDefaultVariantById($Id)
		{
			$list=$this->_obj->defaultvariant_model->getDefaultVariantById($Id);
			
			return $list;
		}

		function getAllDefaultVariantById($Id)
		{
			$list=$this->_obj->defaultvariant_model->getAllDefaultVariantById($Id);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewDefaultVariant($arrInfo)
		{
			$list=$this->_obj->defaultvariant_model->addNewDefaultVariant($arrInfo);
			return $list;
		}
	
		/*
		Update
		*/
		function updateDefaultVariant($arrInfo)
		{
			$list=$this->_obj->defaultvariant_model->updateDefaultVariant($arrInfo);
			return $list;
		}
		
		/*
		Delete
		*/
		function deleteDefaultVariant($id)
		{
			$this->_obj->defaultvariant_model->deleteDefaultVariant($id);
		}
		
		
	}
?>
