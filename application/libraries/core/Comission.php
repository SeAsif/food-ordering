<?
/**
* Menu Item Variant Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Comission {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('comission_model');	
		}
		
		/**
		* @method This method will return menu item variants
		* @params group will be passed as parameter
		*/
		function getComission()
		{
			$list=$this->_obj->comission_model->getComission();
			
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getComissionById($Id)
		{
			$list=$this->_obj->comission_model->getComissionById($Id);
			
			return $list;
		}
		/*
		Add		
		*/
		
		function addNewComission($arrInfo)
		{
			$list=$this->_obj->comission_model->addNewComission($arrInfo);
			return $list;
		}
	
		/*
		Update
		*/
		function updateComission($arrInfo)
		{
			$list=$this->_obj->comission_model->updateComission($arrInfo);
			return $list;
		}
		
		/*
		Delete
		*/
		function deleteComission($id)
		{
			$this->_obj->comission_model->deleteComission($id);
		}
		
		/*
		Calculate commission on order
		*/
		function calculateComission($timediff)
		{
			
			$list=$this->_obj->comission_model->calculateComission($timediff);
			return $list;
		}
		
	}
?>
