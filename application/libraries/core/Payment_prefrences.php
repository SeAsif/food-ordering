<?
/**
* User Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category User
* 
*/
	class Payment_Prefrences {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('payment_prefrences_model');	
		}


		/**
		* @method This method will return user's Payment prefrences detail
		* @params user id will be passed as parameter
		*/
		function getUserPaymentPrefrences($userId)
		{
			$list=$this->_obj->payment_prefrences_model->getUserPrefrencesByUserId($userId);
			return $list;
		}
		
		/**
		* @method This method will add user's payment prefrences
		* @params array of paymentprefrences
		*/
		function setUserPaymentPrefrences($arrInfo)
		{
			
			$list=$this->_obj->payment_prefrences_model->addUserPaymentPrefrences($arrInfo);
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
?>
