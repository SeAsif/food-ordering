<?
/**
* Restaurants Library
* This is a model class for variant Groups
* @author Mustafa Mahmood
* @category Menu
* 
*/
	class User {

		private $_obj;
		
		/**
		* @method constructor		
		*/
		function __construct()
		{
			$this->_obj =& get_instance();
			$this->_obj->load->model('user_model');	
			$this->_obj->load->model('order_model');	
			$this->_obj->load->model('order_item_model');	
			$this->_obj->load->model('restaurant_model');
		}
		
		function checkDuplicate($email,$userId=0)
		{
			if($userId==0)
			$res=$this->_obj->user_model->isDuplicate($email);
			else
			$res=$this->_obj->user_model->isDuplicate($email,$userId);
			return $res;
		}
		/**
		* @method This method will add user
		* @params array of user
		*/
		
		function addUser($arrInfo,$password="")
		{
			$data["arrInfo"]	=	$arrInfo;
			$data["password"]	=	$password;
	//		echo $arrInfo["email"];
	//		echo $adminemail	=	$this->_obj->config->item("adminEmail");
	//		echo $Subject	=	$this->_obj->config->item("signupSubject");
	//		echo $this->_obj->load->view('email/signup_email',$data,true);
	//		exit();
			
			if($this->checkDuplicate($arrInfo['email']))
			{
				$list_return["response"]="RECORD_DUPLICATE";
				$list_return["insert_id"]=0;
			}
			else{
				$list=$this->_obj->user_model->addUser($arrInfo);
				if($list!="" && $list!=0)
				{
					$list_return["response"]="RECORD_ADDED";
					$list_return["insert_id"]=$list;
					
					$this->_obj->load->library('email');
					
					$adminemail	=	$this->_obj->config->item("adminEmail");
					$Subject	=	$this->_obj->config->item("signupSubject");
					$config['wordwrap'] = TRUE;
					$this->_obj->email->initialize($config);
					$this->_obj->email->from($adminemail, $this->_obj->config->item("adminName"));
					$this->_obj->email->to($arrInfo["email"]);
					$this->_obj->email->subject($Subject);
					$this->_obj->email->message($this->_obj->load->view('email/signup_email',$data,true));
					$this->_obj->email->set_alt_message($this->_obj->load->view('email/signup_email_alt',$data,true));
					$this->_obj->email->send();
				}
				else
				{
					$list_return["response"]="RECORD_NOT_ADDED";
					$list_return["insert_id"]=0;
				}	
			}	
			return $list_return;
		}

		/**
		* @method This method will update the user
		* @params array of user
		*/
		function updateUser($arrInfo)
		{
/*			if($this->checkDuplicate($arrInfo['email'],$arrInfo['id']))
			{
				$list_return=array("response"=>"RECORD_DUPLICATE");
			}
			else
			{
*/			
				$list=$this->_obj->user_model->updateUser($arrInfo);
				$list_return=array("response"=>"RECORD_UPDATED");
//			}
			return $list_return;
		}
		/**
		* @method This method will return user's detail
		* @params user id will be passed as parameter
		*/
		function listUsers($arrInfo)
		{
			
			$list=$this->_obj->user_model->getUsersList($arrInfo);
			return $list;
		}
		
		/**
		* @method This method will return user's detail
		* @params user id will be passed as parameter
		*/
		function getUserById($userId)
		{
			$list=$this->_obj->user_model->getUserDetailsById($userId);
			return $list;
		}

		/**
		* @method This method will login a user
		* @params array of username and password
		*/
		function login($arrInfo)
		{
			$list=$this->_obj->user_model->login($arrInfo);
			return $list;
		}
		
		function delete_user($id)
		{
			$this->_obj->user_model->delete_user($id);
		//	return $list;
		}
		
		/**
		* @method This method will reset password
		* @params array of passwords
		*/
		function resetPassword($arrInfo)
		{
//			print_r ($arrInfo);
			if($this->_obj->user_model->isResetPassword($arrInfo))
			{
				$arrInfoUser['id']=$arrInfo["id"];
				$arrInfoUser['password']=$arrInfo['password'];
				$list=$this->_obj->user_model->updateUser($arrInfoUser);

				return "Password_Changed";
			}else{
				return "Old_Password_Not_Match";
			}
		}

		/**
		* @method This method will logout a user
		* @params array of username and password
		*/
		function logout()
		{
			$list=$this->_obj->user_model->logout();
			return $list;
		}
		
		function verifyEmail($arrInfo,$userType)
		{	
		//	$arrReturn = array();
			$list=$this->_obj->user_model->verifyEmail($arrInfo);
			
			
		//	echo $userType;
			$arrInfo = array();
			$arrInfo = $list;
	//		print_r($arrInfo);
			$nCount = 0;
			$data["userType"] = $userType;
		//	echo $arrInfo["email"];
		//	exit();
		///////////////////////////////////////////////////
			if($list != "Login_Error" && $list->type == $userType)
			{	
				$adminemail	=	$this->_obj->config->item("adminEmail");
				$code	=	$this->_obj->config->item("code");
				$msg	=	$this->_obj->config->item("thankmsg");
				$this->_obj->load->library('email');
				
				$config['wordwrap'] = TRUE;
				$this->_obj->email->initialize($config);
				$token = md5(uniqid(""));
				$list->security_code = $token;
				$data["list"] = $list;
				$this->_obj->user->updateSecurityCode($list);
				$this->_obj->email->from($adminemail, $this->_obj->config->item("adminName"));
					
					if($list->type == "user"){
						$this->_obj->email->to($list->email);
					//	echo " if condition";
					}
					
					else
					{//	echo " else condition";
					//	echo  $list->id;
						$restaurants = $this->_obj->restaurant->listRestaurant();
						foreach($restaurants as $res)
						{	
							if($res["user_id"] == $list->id && $nCount < 1)
							{//	echo $res["email"];
							//	echo $res["user_id"];
								$this->_obj->email->to($res["email"]);
								$nCount++;
							}
						}
					}
				
				$this->_obj->email->subject($code);
			//	echo $this->_obj->load->view('email/securitycode_email',$data,true);
				$this->_obj->email->message($this->_obj->load->view('email/securitycode_email',$data,true));
				$this->_obj->email->send();
			//	echo $msg;
			//	$list["flag"] = "Email_Sent";
				$arrReturn	=	"Email_Sent";
				
			//	exit();
			}
			else
			{
				$arrReturn	=	"Email_NotSent";
				
			}
			
		///////////////////////////////////////////////////	
		//	exit();	
		//	$list["arrReturn"] = $arrReturn;
//		print_r($arrReturn);
//			exit();	
			return $arrReturn;		
//			return $list;
		}
		
		function updateSecurityCode($arrInfo)
		{
			$list=$this->_obj->user_model->updateSecurityCode($arrInfo);
			$list_return=array("response"=>"RECORD_UPDATED");
			
			return $list_return;
		}
		
		function orders($arrInfo)
		{
			$data["status"] = $arrInfo["status"];
			
			if($arrInfo["status"] == "Confirmed")
			{
				
			
			//send email to payer
			
				$data["firstName"] = $arrInfo["firstName"];
				$data["restaurantName"] = $arrInfo["restaurantName"];
				$data["airportName"] = $arrInfo["airportName"];
				$data["date"] = $arrInfo["date"];

				$data["deliveryTime"] = $arrInfo["deliveryTime"];
				$data["orderNumber"] = $arrInfo["orderNumber"];
				$data["email_to"] = $arrInfo["email_to"];
				
				$orderemail	=	$this->_obj->config->item("orderEmail");
				//$subject	=	$this->_obj->config->item("orderSuccessSubject");
				$subject	=	'Order '.$data["orderNumber"];

				$this->_obj->load->library('email');
				$config['wordwrap'] = TRUE;
				$this->_obj->email->initialize($config);
							
				$this->_obj->email->from($orderemail, $this->_obj->config->item("adminName"));
				$this->_obj->email->to($data["email_to"]);
				
				$this->_obj->email->subject($subject);
				$this->_obj->email->message($this->_obj->load->view('email/success_email',$data,true));
				//send PDF in order
				//get restaurant details
				$restaurantDetail= $this->_obj->restaurant_model->getRestaurantByIdWithTerminal($arrInfo['restaurantID'],"Active");
				
				$data["restaurant_owner_id"]=$restaurantDetail["user_id"];
				if($restaurantDetail["send_email"] == "Yes")
					$arrInfo["restaurant_email"]=$restaurantDetail["email"];
				if($restaurantDetail["send_sms"] == "Yes")
					$arrInfo["restaurant_phone"]=$restaurantDetail["phone_number"];
				
				
				require $this->_obj->config->item("app_base_path") . '/vendor/autoload.php';
				$orderDetail=$this->_obj->order_model->getOrderById($arrInfo['order_id'],"All");
				$orderitems=	$this->_obj->order_item_model->getOrderItemWithVariants(array("order_id"=>$arrInfo['order_id']),'Yes');	
				$data['restaurantName'] = $orderDetail['restaurant_name'] = $restaurantDetail["restaurant_name"];
				$orderDetail['restaurant_addresss'] = $restaurantDetail["address"];
				$data['order'] = $orderDetail;
				$data['orderitems'] = $orderitems;

				$orderDetails = $this->_obj->load->view('userfront/userorder/orderdetail',$data,true);
	
				$pdfPath  = $this->_obj->config->item("app_base_path")."/uploads/orders/".$arrInfo['oid'].".pdf";
	
				$options = new Dompdf\Options();
				$options->set('defaultFont', 'Courier');
				$dompdf = new Dompdf\Dompdf($options);
				$dompdf->loadHtml($orderDetails);
	
				// Render the HTML as PDF
				$dompdf->render();
	
				// Output the generated PDF to Browser
				file_put_contents($pdfPath, $dompdf->output());
				$this->_obj->email->attach($pdfPath);
				
							
				$this->_obj->email->send();

				//send email to restaurant manager
				$sms = "A new order # ".$data["orderNumber"]. " received";
				if(!empty($arrInfo["restaurant_email"])){
					$this->_obj->email->initialize($config);							
					$this->_obj->email->from($orderemail, $this->_obj->config->item("adminName"));
					$this->_obj->email->to($arrInfo["restaurant_email"]);				
					$this->_obj->email->subject($sms);
					$this->_obj->email->message($this->_obj->load->view('email/new_order',$data,true));
					$this->_obj->email->send();
				}
				//send SMS to manager
				if(!empty($arrInfo["restaurant_phone"])){
					$data = ['phone' => $arrInfo["restaurant_phone"], 'text' => $sms];
					sendSMS($data);
				}
			}
			else
			{
				$data["email_to"] = $arrInfo["email_to"];
				
				$orderemail	=	$this->_obj->config->item("orderEmail");
				$subject	=	$this->_obj->config->item("orderFailSubject");
				
				$this->_obj->load->library('email');
				$config['wordwrap'] = TRUE;
				$this->_obj->email->initialize($config);
							
				$this->_obj->email->from($orderemail, $this->_obj->config->item("adminName"));
				$this->_obj->email->to($data["email_to"]);
				
				$this->_obj->email->subject($subject);
				$this->_obj->email->message($this->_obj->load->view('email/failure_email',$data,true));

				$this->_obj->email->send();
			}
			
		}

		function insertBankDetail($arrInfo)
		{
			$list = $this->_obj->user_model->insertBankDetail($arrInfo);
			if ($list!="" && $list!=0) {
				$list_return["response"]="RECORD_ADDED";
				$list_return["insert_id"]=$list;
			} else {
				$list_return["response"]="RECORD_NOT_ADDED";
				$list_return["insert_id"]=0;
			}	

			return $list_return;
		}
		/**
		* @method This method will return user's detail
		* @params user id will be passed as parameter
		*/
		function listAdmins($arrInfo)
		{
			
			$list=$this->_obj->user_model->getAdminsList($arrInfo);
			return $list;
		}

		function addAdmin($arrInfo,$password="")
		{
			$data["arrInfo"]	=	$arrInfo;
			$data["password"]	=	$password;
			if($this->_obj->user_model->isDuplicateAdmin(	$arrInfo['admin_email']))
			{
				$list_return["response"]="RECORD_DUPLICATE";
				$list_return["insert_id"]=0;
			}
			else{
				$list=$this->_obj->user_model->addAdmin($arrInfo);
				if($list!="" && $list!=0)
				{
					$list_return["response"]="RECORD_ADDED";
					$list_return["insert_id"]=$list;
					
					//$this->_obj->load->library('email');
					
					// $adminemail	=	$this->_obj->config->item("adminEmail");
					// $Subject	=	$this->_obj->config->item("signupSubject");
					// $config['wordwrap'] = TRUE;
					// $this->_obj->email->initialize($config);
					// $this->_obj->email->from($adminemail, $this->_obj->config->item("adminName"));
					// $this->_obj->email->to($arrInfo["email"]);
					// $this->_obj->email->subject($Subject);
					// $this->_obj->email->message($this->_obj->load->view('email/signup_email',$data,true));
					// $this->_obj->email->set_alt_message($this->_obj->load->view('email/signup_email_alt',$data,true));
					// $this->_obj->email->send();
				}
				else
				{
					$list_return["response"]="RECORD_NOT_ADDED";
					$list_return["insert_id"]=0;
				}	
			}	
			return $list_return;
		}
		function getAdminById($userId)
		{
			$list=$this->_obj->user_model->getAdminDetailsById($userId);
			return $list;
		}

		function updateAdmin($arrInfo)
		{
			if($this->_obj->user_model->isDuplicateAdmin(	$arrInfo['admin_email'],$arrInfo['id']))
			{
				$list_return["response"]="RECORD_DUPLICATE";
				$list_return["insert_id"]=0;
			}
			else{
				$list=$this->_obj->user_model->updateAdmin($arrInfo);
				$list_return=array("response"=>"RECORD_UPDATED");
			}
				
			return $list_return;
		}
	}
?>
