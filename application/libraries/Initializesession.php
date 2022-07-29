<?  if (!defined('APPPATH')) exit('No direct script access allowed');

/*
 * @Author: Dean Ericson
 * @Email: mail@deanericson.com
 *
 */
final class InitializeSession{
	function __construct(){
		$this->CI =& get_Instance();
		
		if (!$this->CI->session->userdata("tgb_session_id"))
		{
			$better_token = md5(uniqid(rand(), true));
			$this->CI->session->set_userdata(array("tgb_session_id"=>$better_token));
		}	

	}
}
?>
