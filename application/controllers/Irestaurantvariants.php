<?
/**
* Iphone service for restaurant section
* This class returns the any kind of restaurant related data
* @author Mustafa Mahmood
* @category Iphone Service
*/
class irestaurantvariants extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');	
		$this->load->library('core/menuitemvariantgroup');		
	}
	


	/*
	* @method This method will return the menu variant group by category
	* @params It will take category Id as parameter 	
	*/
	function getVariantGroups()
	{
		$catId = $this->input->post("category_id");
		$restaurantArr = $this->session->userdata('restaurant');
		$list=$this->menuitemvariantgroup->getVariantItemGroups($restaurantArr['id'],['category_id' => $catId]);
		if ($list	!=	null)
			echo json_encode($list);
		else
			echo "No_Record_Found";
		exit ();
		
	}


}

/* End of file Irestaurantvariants.php */
/* Location: ./system/application/controllers/Irestaurantvariants.php */
