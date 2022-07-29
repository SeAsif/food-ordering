<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/

	class Payment_History {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('payment_history_model');	
			$this->_obj->load->model('restaurant_model');	
			$this->_obj->load->model('order_model');	
		}
		
		function calculatePaymentHistory()
		{
			$restaurants	=	$this->_obj->restaurant_model->getRestaurants();
			
			$historyFilter	=	array("month"=>date("m") , "year"=>date("Y"));
			
			foreach ($restaurants as $restaurant)
			{
				$historyFilter["restaurant_id"]	=	$restaurant["id"];
				
				$orderFilter["order_status"]	=	"All";
				$orderFilter["restaurant_id"]	=	$restaurant["id"];
				$orderFilter["start_date"]	=	date("Y-m-d H:i:s",mktime(0,0,0,date("m"),1,date("Y")));
				$orderFilter["end_date"]	=	date("Y-m-d H:i:s");
				
				
				$totalPrice	=	0;
				$comissionPrice	=	0;
				$nOrderCount	=	0;

				$orders	=	$this->_obj->order_model->getOrders($orderFilter);
				if ($orders!=NULL)	
				{			
					
					foreach ($orders as $order)
					{
						//print_r ();
						$totalPrice	=	$totalPrice+$order["totalprice"];
						$comissionPrice	=	$comissionPrice+$order["tgb_comission"];
						$nOrderCount++;
					}


				}
				$arrInfo["total"]	=	$totalPrice;
				$arrInfo["comission"]	=	$comissionPrice;
				$arrInfo["order_count"]	=	$nOrderCount;
				$arrInfo["end"]	=	date("Y-m-d H:i:s");
				
				$paymentHistory	=	$this->getPayment_Historys($historyFilter);

				if (!is_numeric($paymentHistory[0]["id"]))
				{
					$arrInfo["restaurant_id"]	=	$historyFilter["restaurant_id"];
					$arrInfo["status"]	=	"Pending";
					$arrInfo["start"]	=	date("Y-m-d H:i:s",mktime(0,0,0,date("m"),1,date("Y")));
					
					$this->addPayment_History($arrInfo);
				//insert
				}
				else
				{
					//update
					$arrInfo["id"]	=	$paymentHistory[0]["id"]	;
					$this->updatePayment_History($arrInfo);
					$arrInfo["id"]	=	0;
				}
				
				//print_r ($restaurant);
			}//end foreach restaurant
		}
		/**
		* @method This method will add resturants reviews
		* @params array of review
		*/
		function addPayment_History($arrInfo)
		{
			$orderID=$this->_obj->payment_history_model->addNewPayment_History($arrInfo);
			
			return $orderID;
			
		}
		function updatePayment_History($arrInfo)
		{
			$this->_obj->payment_history_model->updatePayment_History($arrInfo);
		}
		
		function getPayment_Historys($orderFilter,$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->payment_history_model->getPayment_Historys($orderFilter,$limit,$offset);
			return $list;
			
		}

		function getNewPaymentHistorys($orderFilter,$limit = NULL, $offset = NULL)
		{
			$list=$this->_obj->payment_history_model->getNewPaymentHistorys($orderFilter,$limit,$offset);
			return $list;
			
		}
		
		function getPayment_HistoryById($Id,$all="Yes")
		{
			return $this->_obj->payment_history_model->getPayment_HistoryById($Id,$all);
		}

	}
?>
