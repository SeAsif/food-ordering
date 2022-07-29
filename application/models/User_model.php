<?
/**
* Menu Item Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Restaurants
* 
*/
class User_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/**
		Add	user
	*/
	function addUser($arrInfo)
	{
      	$this->db->insert("user", $arrInfo);  
		return $this->db->insert_id();
	}
	/**
		Add	user Payment Prefrences
	*/
	function addUserPaymentPrefrences($arrInfo)
	{
      	$this->db->insert("user_payment_pref", $arrInfo);  
		return $this->db->insert_id();
	}

	
	/**
		Update
	*/
	function updateUser($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('user');
	}

	/**
		Delete
	*/
	function deleteUser($arrInfo)
	{
		$this->db->where('id',$arrInfo["id"]);
		$this->db->delete('restaurant_review'); 		
	}
	
	function delete_user($id)
	{
		$this->db->query('update user set status = "Deleted" where id = '.$id.'');
	}

	/**
	* @method This method will return User's details user id 
	* @params User Id will be passed as parameter
	*/
	function getUsersList($arrInfo)
	{
		$this->db->where(array('type'=>$arrInfo['type']));
		$query=$this->db->get("user");
		// Declare Array to pass data
		$list = array();
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method This method will return User's details user id 
	* @params User Id will be passed as parameter
	*/
	function getUserDetailsById($userId)
	{
		$this->db->where(array('id'=>$userId));
		$query=$this->db->get("user");
		// Declare Array to pass data
		$list = array();
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	/**
	* @method This method will check the duplicate
	* @params email will be passed as parameter
	*/
	function isDuplicate($email,$userId=0)
	{
		if($userId!=0)
			$this->db->where(array('id !='=>$userId));	
		$this->db->where(array('email'=>$email));
		
		$query=$this->db->get("user");
		return $query->num_rows(); 
	}
	/**
	* @method This method will return User's Payment Prefrences 
	* @params User Id will be passed as parameter
	*/
	function login($arrInfo)
	{
		$this->db->where(array('email'=>$arrInfo['email']));
		$this->db->where(array('password'=>$arrInfo['password']));
		$this->db->where(array('status'=>"Active"));
		$this->db->where(array('type'=>$arrInfo['usertype']));
		$query=$this->db->get("user");
		// Declare Array to pass data
		$list = array();
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			$sessionData["email"]=$arrInfo['email'];
			$sessionData["id"]=$row->id;
			$sessionData["firstname"]=$row->firstname;
			$sessionData["phone"]=$row->phone_number;
			$sessionData["usertype"]=$row->type;

			$this->session->set_userdata($sessionData);

			$sessionData["phone_number"]=$row->phone_number;
			$sessionData["lastname"]=$row->lastname;
			$list	=	$sessionData;
			return $list;
		}else
		{		
			$list["error"] = "Login_Error";
			return $list;
		}
	}

	/**
	* @method This method will return User's Payment Prefrences 
	* @params User Id will be passed as parameter
	*/
	function isResetPassword($arrInfo)
	{
		$this->db->where(array('id'=>$arrInfo["id"]));
		$this->db->where(array('password'=>$arrInfo['oldpassword']));
		$this->db->where(array('status'=>"Active"));
		$query=$this->db->get("user");
		// Declare Array to pass data
		$list = array();
		if ($query->num_rows() > 0)
		{
			return true;
		}
		else
		{		
			return false;
		}
	}
	/**
	* @method This method will return logout user
	* @params User Id will be passed as parameter
	*/
	function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('firstname');
		$this->session->unset_userdata('usertype');
		$list["response"] = "Logout_Successfull";
		return $list;
	}
	
	function verifyEmail($arrInfo)
	{
		$this->db->where(array('email'=>$arrInfo['email']));
		
		$query=$this->db->get("user");
		
		$count	=	$query->num_rows();
		// Declare Array to pass data
		$list = array();

		if ($count > 0)
		{
			$row = $query->row();
			$list=$row;
			
		}
		else
		{		
			$list = "Login_Error";
			return $list;
		}
		return $list;
	}
	
	function updateSecurityCode($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo->id));
		$this->db->set($arrInfo); 
		$this->db->update('user');
	}

	function insertBankDetail($arrInfo)
	{
		$this->db->insert("bank_detail", $arrInfo);  
		return $this->db->insert_id();
	}

	function getAdminsList($arrInfo)
	{
		$query=$this->db->get("admin");
		// Declare Array to pass data
		$list = array();
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	/**
	* @method This method will check the duplicate
	* @params email will be passed as parameter
	*/
	function isDuplicateAdmin($email,$userId=0)
	{
		if($userId!=0)
			$this->db->where(array('admin_id !='=>$userId));	
		$this->db->where(array('admin_email'=>$email));
		
		$query=$this->db->get("admin");
		return $query->num_rows(); 
	}

	function addAdmin($arrInfo)
	{
      	$this->db->insert("admin", $arrInfo);  
		return $this->db->insert_id();
	}

	function getAdminDetailsById($userId)
	{
		$this->db->where(array('admin_id'=>$userId));
		$query=$this->db->get("admin");
		// Declare Array to pass data
		$list = array();
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	function updateAdmin($arrInfo)
	{
		$this->db->where(array("admin_id"=>$arrInfo["id"]));
		unset($arrInfo["id"]);
		$this->db->set($arrInfo); 
		$this->db->update('admin');
	}
}
?>
