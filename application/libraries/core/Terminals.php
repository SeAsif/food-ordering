<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Terminals {

		private $_obj;
		public 	$user 			= NULL;
		public 	$user_id 		= FALSE;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('terminal_model');	
		}
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function listTerminals($airportId=0)
		{
			$list=$this->_obj->terminal_model->getTerminal($airportId);
			return $list;
		}
		
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function getTerminalById($terminalId)
		{
			$list=$this->_obj->terminal_model->getTerminalById($terminalId);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function addTerminals($arrInfo)
		{
			
			$list=$this->_obj->terminal_model->addNewTerminal($arrInfo);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function updateTerminals($arrInfo)
		{
			$list=$this->_obj->terminal_model->updateTerminal($arrInfo);
			return $list;
		}
		/**
		* @method This method will return resturants for terminals
		* @params terminal id will be passed as parameter
		*/
		function deleteTerminal($terminalId)
		{
			$list=$this->_obj->terminal_model->deleteTerminal($terminalId);
			return $list;
		}
		
	}
?>
