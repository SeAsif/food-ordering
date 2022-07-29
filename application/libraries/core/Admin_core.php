<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class Admin_core {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('admin_model');	
		}
		/**
		* @method This method will login a user
		* @params array of username and password
		*/
		function login($arrInfo)
		{
			$list=$this->_obj->admin_model->login($arrInfo);
			return $list;
		}
	}
?>
