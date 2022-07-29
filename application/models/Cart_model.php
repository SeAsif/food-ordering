<?
/**
* Order Management Model
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
class Cart_model extends CI_Model
{
	function __construct() {
        parent::__construct();
    }
	/*
	Add		
	*/
	
	function addToCartitem($arrInfo)
	{
      	$this->db->insert("order_item", $arrInfo);  
		
		return $this->db->insert_id();
		
	}
	function addToCartitemDetail($arrInfo)
	{
      	$this->db->insert("order_item_detail", $arrInfo);  
		
		return $this->db->insert_id();
		
	}
	function addToCart($arrInfoItem,$arrInfoItemDetail)
	{
      	$this->addToCartitem($arrInfoItem);  
		$this->addToCartitemDetail($arrInfoItemDetail);  
		
		return $this->db->insert_id();
		
	}

	/*
	Update
	*/
	function updateCartItem($arrInfo)
	{
		$this->db->where(array("session_id"=>$arrInfo["session_id"]));
		$this->db->set($arrInfo); 
		$this->db->update('order_item');
	}
	
	function updateCartItemForTax($arrInfo)
	{
		$this->db->where(array("id"=>$arrInfo["id"]));
		$this->db->set($arrInfo); 
		$this->db->update('order_item');
	}

	function updateCartItemDetail($arrInfo)
	{
		$this->db->where(array("session_id"=>$arrInfo["session_id"]));
		$this->db->set($arrInfo); 
		$this->db->update('order_item_detail');
	}
	/*
	Delete
	*/
	function deleteFromCartItem($cartItemId)
	{
		$this->db->where('id',$cartItemId);
		$this->db->delete('order_item'); 		
	}
	function deleteFromCartItemDetail($cartItemId)
	{
		$this->db->where('order_item_id',$cartItemId);
		$this->db->delete('order_item_detail'); 		
	}
	
	function resetShoppingCart()
	{
		if ($this->session->userdata("tgb_session_id"))
		{
			$this->db->where('session_id',$this->session->userdata("tgb_session_id"));
			$this->db->delete('order_item'); 		
			$this->db->where('session_id',$this->session->userdata("tgb_session_id"));
			$this->db->delete('order_item_detail'); 		
		}
		else if ($this->session->userdata("session_id"))
		{
			$this->db->where('session_id',$this->session->userdata("session_id"));
			$this->db->delete('order_item'); 		
			$this->db->where('session_id',$this->session->userdata("tgb_session_id"));
			$this->db->delete('order_item_detail'); 		
		}
		
	}
	function deleteFromCart($itemId)
	{
		$this->deleteFromCartItem($itemId);
		$this->deleteFromCartItem($itemId);
	}

	/**
	* @method This method is returning Menu Items for a Restaurant 
	* @params Item Id will be passed as parameter
	*/
	function getCartDetails()
	{
	//	echo $this->session->userdata("tgb_session_id");
		$query = $this->db->query("
		SELECT
		*
		FROM
		order_item
		WHERE
		order_item.session_id =  '".$this->session->userdata("session_id")."'
		");
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	function getCartDetailsForTax($id)
	{//	echo $this->session->userdata("tgb_session_id");
		$query = $this->db->query("
		SELECT
		*
		FROM
		order_item
		WHERE
		order_item.id = '".$id."'
		");
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	function getTaxes($sessionid)
	{
		$query = $this->db->query("
		SELECT
		order_item.city_tax,
		order_item.state_tax
		FROM
		order_item
		WHERE
		order_item.session_id = '".$sessionid."'
		");
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}
	
	function getCartVariantDetails($orderItemId,$tgbSessionID="")
	{
		if ($tgbSessionID!="")
		$sessionid	=	$tgbSessionID;
		else
		$sessionid	=	$this->session->userdata("session_id");
		
		$query = $this->db->query("
		SELECT
		*
		FROM
		order_item_detail
		WHERE
		order_item_detail.order_item_id =  '".$orderItemId."'
		AND
		order_item_detail.session_id =  '".$sessionid."'
		");
		// Declare Array to pass data
		$list = array();
		
		foreach ($query->result_array() as $row)
		{
			$list[]	=	$row;
		}		
		// Return Array
		return $list;
	}

	function getCartOrderPrice($id)
	{

		$this->db->select('totalprice');
        $this->db->where('id', $id);

        $record_obj = $this->db->get('order_item');
        $record_arr = $record_obj->result_array();
        $record_obj->free_result();
        
        if (!empty($record_arr)) {
            return $record_arr[0]['totalprice'];
        } else {
            return '';
        }
	}
	
}
?>
