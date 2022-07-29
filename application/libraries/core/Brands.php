<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Brands {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('brand_model');	
		}
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function listBrands()
		{
			$list=$this->_obj->brand_model->getBrand();
			return $list;
		}
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function getBrandById($brandId)
		{
			$list=$this->_obj->brand_model->getBrandById($brandId);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function addBrands($arrInfo)
		{
			
			$list=$this->_obj->brand_model->addNewBrand($arrInfo);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function updateBrands($arrInfo)
		{
			$list=$this->_obj->brand_model->updateBrand($arrInfo);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function deleteBrand($brandId)
		{
			$list=$this->_obj->brand_model->deleteBrand($brandId);
			return $list;
		}
		
	}
?>
