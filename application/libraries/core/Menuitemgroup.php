<?
/**
* Menu Item Group Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class MenuItemGroup {

		private $_obj;
		
		/**
		* @method constructor
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('menuitemgroup_model');
			$this->_obj->load->model('menuitemvariant_model');
				
		}
		

		/**
		* @method This method will return menu item variants
		* @params group will be passed as parameter
		*/
		function getVariantItemGroups($restaurantId,$filters=NULL,$count="No",$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->menuitemgroup_model->getVariantItemGroups($restaurantId ,$filters ,$count,$limit , $offset);
			
			return $list;
		}
		/**
		* @method This method will return menu item groups plus its respective variants
		* @params item id will be passed as parameter
		*/
		function listMenuItemDetails($itemId,$needVariantItems	=	"Yes")
		{
			
			$list_groups=$this->_obj->menuitemgroup_model->getMenuItemGroupByItemId($itemId);
			
			$list_groupDetail = array();
			$nCount=0;
			foreach ($list_groups as $row)
			{
				$groupInfo	=	$this->_obj->menuitemgroup_model->getMenuItemGroupById($row["group_id"]);
				if(!empty($groupInfo)) {
					$list_groupDetail[$nCount]["GroupDetail"]	=	$groupInfo[0];
					/**
					* Now its time to get the variat items in groups
					*/
					if ($needVariantItems	==	"Yes")//in all cases we don't need variant items
						$list_groupDetail[$nCount]["GroupDetail"]["variant"]	=	$this->_obj->menuitemvariant_model->getMenuItemVariantByGroupId($row["group_id"]);
				}
				
						
				$nCount++;
			
			}		
			return $list_groupDetail;
		}

		/*
		Add		
		*/
		function attachMenuItemWithGroup($arrInfo)
		{
			
			$list=$this->_obj->menuitemgroup_model->attachMenuItemWithGroup($arrInfo);
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getMenuItemGroupById($Id)
		{
			$list=$this->_obj->menuitemgroup_model->getMenuItemGroupById($Id);
			
			return $list;
		}

		/**
		* @method This method will return menu item variant
		* @params variant will be passed as parameter
		*/
		function getMenuItemForDashboard($Id)
		{
			$list=$this->_obj->menuitemgroup_model->getMenuItemForDashboard($Id);
			
			return $list;
		}


		/*
		Add		
		*/
		
		function addNewMenuItemGroup($arrInfo)
		{
			$list=$this->_obj->menuitemgroup_model->addNewMenuItemGroup($arrInfo);
			
			return $list;
		}

		/*
		Update
		*/
		function updateMenuItemGroup($arrInfo)
		{
			$list=$this->_obj->menuitemgroup_model->updateMenuItemGroup($arrInfo);
			
			return $list;
		}

	}
?>
