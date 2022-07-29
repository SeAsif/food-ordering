<?  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This function returns the user type
 *
 * @access	public
 * @return	integer
 */ 
 
if ( ! function_exists('getBrandsDropDown') )
{
	function getBrandsDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Brand";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr["brand_name"];
			}
			return form_dropdown('brand_name',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}

if ( ! function_exists('getUsersDropDown') )
{
	function getUsersDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select User";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr["email"]." ( ".$arr["firstname"]." ".$arr["lastname"]." ) ";
			}
			return form_dropdown('user_name',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}
if ( ! function_exists('getTerminalsDropDown') )
{
	function getTerminalsDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Terminal";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr["terminal_name"];
			}
			return form_dropdown('terminal_name',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}
if ( ! function_exists('getAirPortsDropDown') )
{
	function getAirPortsDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Airport";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr['airport_name']." ".$arr['airport_code'];
			}
			return form_dropdown('airport',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}
if ( ! function_exists('getRestaurantsDropDown') )
{
	function getRestaurantsDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Restaurant";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr['restaurant_name'];
			}
			return form_dropdown('restaurant',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}
if ( ! function_exists('getOrderStatusDropDown') )
{
	function getOrderStatusDropDown($arrList,$selected)
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Order Status";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr]	=	$arr;
			}
			return form_dropdown('orderstatus',$arrReturn,$selected);
		}
		else
		{
			return "N/A";
		}
	}
}

if ( ! function_exists('getFoodCategoryDropDown') )
{
	function getFoodCategoryDropDown($arrList,$selected,$style="")
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn[""]	=	"Select Category";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr["category_name"];
			}
			//print_r ($arrReturn);
			

			return form_dropdown('category_id',$arrReturn,$selected,$style.' id="category_id"');
		}
		else
		{
			return "N/A";
		}
	}
}
if ( ! function_exists('getVariantItemCategory') )
{
	function getVariantItemCategory($arrList,$selected,$style="")
	{
		if (count($arrList)>0)
		{
			$arrReturn	=	array();
			$arrReturn["select"]	=	"Select Category";
			foreach($arrList as $arr)
			{
				$arrReturn[$arr["id"]]	=	$arr["category_name"];
			}
			//print_r ($arrReturn);
			

			return form_dropdown('menu_variant_item_category',$arrReturn,$selected,$style);
		}
		else
		{
			return "N/A";
		}
	}
}

