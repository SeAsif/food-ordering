<?

class Authorize_core
{
	private $_obj;
	
	function __construct()
	{
		$this->_obj =& get_instance();
		$paramArray["login"]	=	$this->_obj->config->item("x_login");
		$paramArray["transkey"]	=	$this->_obj->config->item("x_trans_key");
		$paramArray["test_mode"]	=	"TRUE";
		//print_r($paramArray);
		
		$this->_obj->load->library('authnetcim',$paramArray);
		
		$this->_obj->load->library('AuthNetAim');
		//$this->_obj->load->library('xmllib_xmlparser');
		
		
	}
	
	function processTransaction($arrInfo)
	{
	   $url	=	$this->_obj->config->item("aim_url");
	   $login	=	$this->_obj->config->item("x_login");
	   $key		=	$this->_obj->config->item("x_trans_key");
	//   print_r($arrInfo);//exit();
	   $this->_obj->authnetaim->url=$url;
	   $this->_obj->authnetaim->x_login= $login;// required
	   $this->_obj->authnetaim->x_tran_key= $key; // required
	   $this->_obj->authnetaim->x_version="3.1";
	   $this->_obj->authnetaim->x_type="AUTH_ONLY"; // required // x_type = AUTH_CAPTURE for authorize and captuer
	   $this->_obj->authnetaim->x_test_request="TRUE";
	   $this->_obj->authnetaim->x_card_num=trim($arrInfo["cardnumber"]); // required
	   $this->_obj->authnetaim->x_exp_date=trim($arrInfo["cardexpmonth"]).trim($arrInfo["cardexpyear"]); // required
//	   $this->_obj->authnetaim->x_method="CC";
	   $this->_obj->authnetaim->x_amount=$arrInfo["chargetotal"]; // required
//	   $this->_obj->authnetaim->x_first_name="zxczx";//$arrInfo["cvmvalue"];
//	   $this->_obj->authnetaim->x_last_name="czxc";//$last_name;
//	   $this->_obj->authnetaim->x_address="sdhkcs dchjd";//$arrInfo['address'];
//	   $this->_obj->authnetaim->x_city="abc";//$arrInfo['city'];
//	   $this->_obj->authnetaim->x_state="az";//$arrInfo['state'];
//	   $this->_obj->authnetaim->x_zip="54000";//$arrInfo['zip'];
//	   $this->_obj->authnetaim->x_country="USA";//$arrInfo['country'];
//	   $this->_obj->authnetaim->x_email="abc@gmail.com";//$arrInfo['email_address'];
//	   $this->_obj->authnetaim->x_card_code="123";//$arrInfo['ccv'];
	   $this->_obj->authnetaim->x_delim_char="|";
	   $this->_obj->authnetaim->x_delim_data="TRUE";
	   $this->_obj->authnetaim->x_relay_response="FALSE";
//	   $this->_obj->authnetaim->x_url="FALSE";
//	   $this->_obj->authnetaim->x_encap_char ='';
//	   $this->_obj->authnetaim->x_invoice_num=rand(1,1000);
//     echo "dsfsd";
	   
	   $error=$this->_obj->authnetaim->process(); 
	   
	 //  echo $error;
	//  $this->_obj->authnetaim->dump_fields();      // outputs all the fields that we set
	//   $this->_obj->authnetaim->dump_response();
	   $response = $this->_obj->authnetaim->dump_response();    // outputs the response from the payment gateway
//	  echo $response;exit();
	   return $response;
	}
	
	function createCustomerProfileRequest($arrInfo,$card) // Returning refId and customerProfileId.
	{	
	//	exit();
		$arrReturn = array();
		$paramArray["login"]	=	$this->_obj->config->item("x_login");
		$paramArray["transkey"]	=	$this->_obj->config->item("x_trans_key");
		
		$this->_obj->load->library('authnetcim',$paramArray);
		
//		$objauthnetcim	=	new authnetcim($paramArray);
		
	
	//	$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Choose a payment type - (creditCard or bankAccount) REQUIRED
		
		// creditCard payment method - (aka creditcard)
		$this->_obj->authnetcim->setParameter('paymentType', 'creditCard');
		$this->_obj->authnetcim->setParameter('cardNumber', $card["cardnumber"]);
		$this->_obj->authnetcim->setParameter('expirationDate', $card["expiryDate"]); // (YYYY-MM)
		
		// bankAccount payment method - (aka echeck) 
//		$this->_obj->authnetcim->setParameter('paymentType', 'bankAccount');
//		$this->_obj->authnetcim->setParameter('accountType', 'checking'); // (checking, savings or businessChecking)
//		$this->_obj->authnetcim->setParameter('nameOnAccount', 'Ray Solomon');
//		$this->_obj->authnetcim->setParameter('echeckType', 'WEB'); // (CCD, PPD, TEL or WEB)
//		$this->_obj->authnetcim->setParameter('bankName', 'Bank of America');
//		$this->_obj->authnetcim->setParameter('routingNumber', '000000000');
//		$this->_obj->authnetcim->setParameter('accountNumber', '0000000000000');
		
		// Some Billing address information is required and some is optional 
		// depending on your Address Verification Service (AVS) settings 
		$this->_obj->authnetcim->setParameter('billTo_firstName', $arrInfo["firstname"]); // Up to 50 characters (no symbols)
		
		$this->_obj->authnetcim->setParameter('billTo_lastName', $arrInfo["lastname"]); // Up to 50 characters (no symbols)
		//$cim->setParameter('billTo_company', 'Acme, Inc.'); // Up to 50 characters (no symbols) (optional)
		//$this->_obj->authnetcim->setParameter('billTo_address', $arrInfo["address"]); // Up to 60 characters (no symbols)
//		$this->_obj->authnetcim->setParameter('billTo_city', $arrInfo["city"]); // Up to 40 characters (no symbols)
	//	$this->_obj->authnetcim->setParameter('billTo_state', 'AZ'); // A valid two-character state code (US only) (optional)
//		$this->_obj->authnetcim->setParameter('billTo_zip', $arrInfo["zip"]); // Up to 20 characters (no symbols)
		
//		$this->_obj->authnetcim->setParameter('billTo_country', 'US'); // Up to 60 characters (no symbols) (optional)
//		$this->_obj->authnetcim->setParameter('billTo_phoneNumber', '555-555-5555'); // Up to 25 digits (no letters) (optional)
//		$this->_obj->authnetcim->setParameter('billTo_faxNumber', '444-444-4444'); // Up to 25 digits (no letters) (optional)
		
		// In this method, shipping information is required because it reduces an extra
		// step from having to create a shipping address in the future, therefore you can simply update it when needed.
		// You can populate it with the billing info if you don't have an order form with shipping details.
		$this->_obj->authnetcim->setParameter('shipTo_firstName', 'James'); // Up to 50 characters (no symbols)
//		$this->_obj->authnetcim->setParameter('shipTo_lastName', 'Beistle'); // Up to 50 characters (no symbols)
		//$cim->setParameter('shipTo_company', 'Acme, Inc.'); // Up to 50 characters (no symbols) (optional)
//		$this->_obj->authnetcim->setParameter('shipTo_address', 'My Address'); // Up to 60 characters (no symbols)
//		$this->_obj->authnetcim->setParameter('shipTo_city', 'My City'); // Up to 40 characters (no symbols)
//		$this->_obj->authnetcim->setParameter('shipTo_state', 'AZ'); // A valid two-character state code (US only) (optional)
//		$this->_obj->authnetcim->setParameter('shipTo_zip', '85282'); // Up to 20 characters (no symbols)
//		$this->_obj->authnetcim->setParameter('shipTo_country', 'US'); // Up to 60 characters (no symbols) (optional)
		//$cim->setParameter('shipTo_phoneNumber', '555-555-5555'); // Up to 25 digits (no letters) (optional)
		//$cim->setParameter('shipTo_faxNumber', '444-444-4444'); // Up to 25 digits (no letters) (optional)
		
		// Merchant-assigned reference ID for the request
		$this->_obj->authnetcim->setParameter('refId', $arrInfo["id"]); // Up to 20 characters (optional) // was 235 previously
		
		// merchantCustomerId must be unique across all profiles
		$this->_obj->authnetcim->setParameter('merchantCustomerId', $arrInfo["id"]); // Up to 20 characters (optional) //was 39 previously
		
		// description must be unique across all profiles, if defined
		$this->_obj->authnetcim->setParameter('description', 'Customer'); // Up to 255 characters (optional)
		
		// A receipt from authorize.net will be sent to the email address defined here
		$this->_obj->authnetcim->setParameter('email', $arrInfo["email"]); // Up to 255 characters (optional)
		
		$this->_obj->authnetcim->setParameter('customerType', 'individual'); // individual or business (optional)
		
		$this->_obj->authnetcim->createCustomerProfileRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
		//	echo "<br>".$this->_obj->authnetcim->response;
		//	echo "YES<br>".$this->_obj->authnetcim->directResponse;
		//	echo "<br>".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br>".$this->_obj->authnetcim->resultCode;
		//	echo "<br>".$this->_obj->authnetcim->code;
		//	echo "<br>".$this->_obj->authnetcim->text;
		//	echo "<br>refId = ".$this->_obj->authnetcim->refId;
		//	echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
			$arrReturn["customerProfileId"] = $this->_obj->authnetcim->customerProfileId;
		//	echo "<br> customerPaymentProfileId = ".$this->_obj->authnetcim->customerPaymentProfileId;
			$arrReturn["customerPaymentProfileId"] = $this->_obj->authnetcim->customerPaymentProfileId;
		//	echo "<br>".$this->_obj->authnetcim->customerAddressId;
			$arrReturn["validation"] = "YES";
			$arrReturn["text"] = $this->_obj->authnetcim->text;
			return $arrReturn;
		}
		else
		{
		//	echo "NO<br> directResponse = ".$this->_obj->authnetcim->directResponse;
		//	echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
		//	echo "<br> code = ".$this->_obj->authnetcim->code;
		//	echo "<br> text = ".$this->_obj->authnetcim->text;
		//	echo "<br><pre>error_messages = ";
		//	print_r($this->_obj->authnetcim->error_messages);
		//	echo "</pre>";
			$arrReturn["validation"] = "NO";
			$arrReturn["text"] = $this->_obj->authnetcim->text;
			return $arrReturn;
		}
		
		
	}
	
	function createCustomerPaymentProfileRequest($arrInfo,$card) // Returns new customerPaymentProfileId 
//resultCode = Ok
//code = I00001
//text = Successful.
	
	{ //print_r($card);
		$paramArray["login"]	=	$this->_obj->config->item("x_login");
		$paramArray["transkey"]	=	$this->_obj->config->item("x_trans_key");
		
		$this->_obj->load->library('authnetcim',$paramArray);
	//	$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Choose a payment type - (creditCard or bankAccount)
		
		// creditCard payment method - (aka creditcard) 
		$this->_obj->authnetcim->setParameter('paymentType', 'creditCard');
		$this->_obj->authnetcim->setParameter('cardNumber', $card["cardnumber"]);
		$this->_obj->authnetcim->setParameter('expirationDate', $card["expiryDate"]); // (YYYY-MM)
		$arrReturn = array();
		// bankAccount payment method - (aka echeck) 
		//$cim->setParameter('paymentType', 'bankAccount');
		//$cim->setParameter('accountType', 'checking'); // (checking, savings or businessChecking)
		//$cim->setParameter('nameOnAccount', 'Ray Solomon');
		//$cim->setParameter('echeckType', 'WEB'); // (CCD, PPD, TEL or WEB)
		//$cim->setParameter('bankName', 'Bank of America');
		//$cim->setParameter('routingNumber', '000000000');
		//$cim->setParameter('accountNumber', '0000000000000');
		
		// Some Billing address information is required and some is optional 
		// depending on your Address Verification Service (AVS) settings 
		$this->_obj->authnetcim->setParameter('billTo_firstName', $arrInfo["firstname"]); // Up to 50 characters (no symbols)
		$this->_obj->authnetcim->setParameter('billTo_lastName', $arrInfo["lastname"]); // Up to 50 characters (no symbols)
//		$cim->setParameter('billTo_company', 'Acme, Inc.'); // Up to 50 characters (no symbols) (optional)
		//$this->_obj->authnetcim->setParameter('billTo_address', $arrInfo["address"]); // Up to 60 characters (no symbols)
	//	$this->_obj->authnetcim->setParameter('billTo_city', $arrInfo["city"]); // Up to 40 characters (no symbols)
	//	$this->_obj->authnetcim->setParameter('billTo_state', 'AZ'); // A valid two-character state code (US only) (optional)
	//	$this->_obj->authnetcim->setParameter('billTo_zip', $arrInfo["zip"]); // Up to 20 characters (no symbols)
	//	$this->_obj->authnetcim->setParameter('billTo_country', 'US'); // Up to 60 characters (no symbols) (optional)
	//	$this->_obj->authnetcim->setParameter('billTo_phoneNumber', '666-666-6666'); // Up to 25 digits (no letters) (optional)
	//	$this->_obj->authnetcim->setParameter('billTo_faxNumber', '555-555-5555'); // Up to 25 digits (no letters) (optional)
		
	//	$this->_obj->authnetcim->setParameter('customerType', 'individual'); // individual or business (optional)
		
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $arrInfo["customer_profile_id"]); // Numeric (required)
		
		// Merchant-assigned reference ID for the request
//		$this->_obj->authnetcim->setParameter('refId', 'my unique ref id'); // Up to 20 characters (optional)
		
		//  if liveMode, the billing address gets verified according to AVS settings on your Authorize.net account
		$this->_obj->authnetcim->setParameter('validationMode', 'testMode'); // required (none, testMode or liveMode)
		
		$this->_obj->authnetcim->createCustomerPaymentProfileRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
		//	echo "<br> response = ".$this->_obj->authnetcim->response;
		//	echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
		//	echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
		//	echo "<br> code = ".$this->_obj->authnetcim->code;
		//	echo "<br> text = ".$this->_obj->authnetcim->text;
		//	echo "<br> refId = ".$this->_obj->authnetcim->refId;
		//	echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
		//	echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
		//	echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;
			$arrReturn["customerPaymentProfileId"] = $this->_obj->authnetcim->customerPaymentProfileId;
			$arrReturn["text"] = $this->_obj->authnetcim->text; // Successful
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Ok
			$arrReturn["validation"] = "YES";
			return $arrReturn;
		}
		else
		{
		//	echo "NO<br>directResponse = ".$this->_obj->authnetcim->directResponse;
		//	echo "<br>validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br>resultCode= ".$this->_obj->authnetcim->resultCode;
		//	echo "<br>code= ".$this->_obj->authnetcim->code;
		//	echo "<br>text= ".$this->_obj->authnetcim->text;
		//	echo "<br><pre>error_messages= ";
		//	print_r($this->_obj->authnetcim->error_messages);
		//	echo "</pre>";
			$arrReturn["validation"] = "NO";
			$arrReturn["text"] = $this->_obj->authnetcim->text;
			return $arrReturn;
			
		}
	}
	
	function createCustomerProfileTransactionRequest($arrInfo)
	
	{//	print_r($arrInfo);exit();
	
//		$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Merchant-assigned reference ID for the request
//		$this->_obj->authnetcim->setParameter('refId', $arrInfo["orderId"]); // Up to 20 characters (optional)
		
		// Total Amount: This amount should include all other amounts such as tax amount, shipping amount, etc.
		$this->_obj->authnetcim->setParameter('transaction_amount', $arrInfo["chargetotal"]); // Up to 4 digits with a decimal (required)
		
		// This amount must be included in the total amount for the transaction. (optional)
//		$this->_obj->authnetcim->setParameter('tax_amount', '0.00'); // Up to 4 digits with a decimal point (no dollar symbol) (optional)
//		$this->_obj->authnetcim->setParameter('tax_name', 'my custom name'); // Up to 31 characters (optional)
//		$this->_obj->authnetcim->setParameter('tax_description', 'my custom description'); // Up to 255 characters (optional)
		
		// This amount must be included in the total amount for the transaction. (optional)
//		$cim->setParameter('shipping_amount', '0.00'); // Up to 4 digits with a decimal point (no dollar symbol) (optional)
//		$cim->setParameter('shipping_name', 'my custom name'); // Up to 31 characters (optional)
//		$cim->setParameter('shipping_description', 'my custom description'); // Up to 255 characters (optional)
		
		// This amount must be included in the total amount for the transaction. (optional)
//		$cim->setParameter('duty_amount', '0.00'); // Up to 4 digits with a decimal point (no dollar symbol) (optional)
//		$cim->setParameter('duty_name', 'my custom name'); // Up to 31 characters (optional)
//		$cim->setParameter('duty_description', 'my custom description'); // Up to 255 characters (optional)
		
		// LineItems: (Contains line item details about the order.) (optional)
		// Up to 30 distinct instances of this element may be included per transaction to describe items included in the order.
		// Below is an example of adding LineItems into a multidimensional array during a loop
/*		$LineItem = array();
		for ($i = 1; $i <= 2; $i++)
		{
			// The ID assigned to the item 
			$LineItem[$i]['itemId'] = '123456'; // Up to 31 characters
			// A short description of an item 
			$LineItem[$i]['name'] = 'custom item name'; // Up to 31 characters
			// A detailed description of an item 
			$LineItem[$i]['description'] = 'my custom description'; // Up to 255 characters
			// The quantity of an item 
			$LineItem[$i]['quantity'] = '1'; // Up to 4 digits (up to two decimal places)
			// Cost of an item per unit excluding tax, freight, and duty 
			$LineItem[$i]['unitPrice'] = '1.00'; // Up to 4 digits with a decimal point (no dollar symbol)
			// Indicates whether the item is subject to tax
			$LineItem[$i]['taxable'] = '0'; // Standard Boolean logic, 0=FALSE and 1=TRUE
		}
		$cim->LineItems = $LineItem;*/
		
		// transactionType = (profileTransCaptureOnly, profileTransAuthCapture or profileTransAuthOnly)
		$this->_obj->authnetcim->setParameter('transactionType', 'profileTransAuthOnly'); // see options above
		
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $arrInfo["customer_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer payment profile
		$this->_obj->authnetcim->setParameter('customerPaymentProfileId', $arrInfo["customer_payment_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer shipping address (optional)
		// If the customer AddressId is not passed, shipping information will not be included with the transaction.
//		$cim->setParameter('customerShippingAddressId', '98934'); // Numeric (optional)
		
	
		// Up to 20 characters (no symbols) (optional)
//		$cim->setParameter('order_invoiceNumber', 'my order invoice id'); 
		// Up to 255 characters (no symbols) (optional)
//		$cim->setParameter('order_description', 'my order description'); 
		// Up to 25 characters (no symbols) (optional)
//		$cim->setParameter('order_purchaseOrderNumber', '1234'); 
		
		// The tax exempt status
//		$this->_obj->authnetcim->setParameter('transactionTaxExempt', 'false');
		
		// The recurring billing status
//		$this->_obj->authnetcim->setParameter('transactionRecurringBilling', 'false');
		
		// The customer's card code (the three- or four-digit number on the back or front of a credit card)
		// Required only when the merchant would like to use the Card Code Verification (CCV) filter
//		$this->_obj->authnetcim->setParameter('transactionCardCode', $arrInfo["ccv"]); // (conditional)
		
		// The authorization code of an original transaction required for a Capture Only
		// This element is only required for the Capture Only transaction type.
		//$cim->setParameter('transactionApprovalCode', 'abc123'); // 6 characters only (conditional)
		
		$this->_obj->authnetcim->createCustomerProfileTransactionRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
	/*		echo "<br> response = ".$this->_obj->authnetcim->response;
			echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
			echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
			echo "<br> code = ".$this->_obj->authnetcim->code;
			echo "<br> text = ".$this->_obj->authnetcim->text;
			echo "<br> refId = ".$this->_obj->authnetcim->refId;
			echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
			echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
			echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;*/
			$arrReturn["resultCode"] = "Ok";//$this->_obj->authnetcim->resultCode; // Ok
			$arrReturn["text"] = $this->_obj->authnetcim->text; // Successful
		//	print_r($arrReturn);exit();
			return $arrReturn; 
		}
		else
		{
		/*	echo "NO<br>directResponse= ".$this->_obj->authnetcim->directResponse;
			echo "<br>validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br>resultCode= ".$this->_obj->authnetcim->resultCode; // Error
			echo "<br>code= ".$this->_obj->authnetcim->code;
			echo "<br>text= ".$this->_obj->authnetcim->text; // The record cannot be found.
			echo "<br><pre>error_messages= ";
			print_r($this->_obj->authnetcim->error_messages);
			echo "</pre>";*/
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Error
			$arrReturn["text"] = $this->_obj->authnetcim->text; // The record cannot be found.
		//	print_r($arrReturn);exit();
			return $arrReturn; 
			
		}
	}
	
	
	function deleteCustomerProfileRequest($id)
	
	{
	
	//	$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Merchant-assigned reference ID for the request
//		$this->_obj->authnetcim->setParameter('refId', 'my unique ref id'); // Up to 20 characters (optional)
		
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $id); // Numeric (required)
		
		$this->_obj->authnetcim->deleteCustomerProfileRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
		//	echo "<br> response = ".$this->_obj->authnetcim->response;
		//	echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
		//	echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
		//	echo "<br> code = ".$this->_obj->authnetcim->code;
		//	echo "<br> text = ".$this->_obj->authnetcim->text;
		//	echo "<br> refId = ".$this->_obj->authnetcim->refId;
		//	echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
		//	echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
		//	echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Ok
			$arrReturn["text"] = $this->_obj->authnetcim->text; // Successful
			return $arrReturn;
		}
		else
		{
		//	echo "NO<br>directResponse= ".$this->_obj->authnetcim->directResponse;
		//	echo "<br>validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br>resultCode= ".$this->_obj->authnetcim->resultCode; // Error
		//	echo "<br>code= ".$this->_obj->authnetcim->code;
		//	echo "<br>text= ".$this->_obj->authnetcim->text; // The record cannot be found.
		//	echo "<br><pre>error_messages= ";
		//	print_r($this->_obj->authnetcim->error_messages);
		//	echo "</pre>";
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Error
			$arrReturn["text"] = $this->_obj->authnetcim->text; // The record cannot be found.
			return $arrReturn;
			
		}
	}
	
	function deleteCustomerPaymentProfileRequest($arrInfo) // returns resultCode OK if response is deleted
	
	{
		$arrReturn = array();
//		$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Merchant-assigned reference ID for the request
	//	$this->_obj->authnetcim->setParameter('refId', 'my unique ref id'); // Up to 20 characters (optional)
		
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $arrInfo["customer_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer payment profile
		$this->_obj->authnetcim->setParameter('customerPaymentProfileId', $arrInfo["customer_payment_profile_id"]); // Numeric (required)
		
		$this->_obj->authnetcim->deleteCustomerPaymentProfileRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
		//	echo "<br> response = ".$this->_obj->authnetcim->response;
		//	echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
		//	echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
		//	echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
		//	echo "<br> code = ".$this->_obj->authnetcim->code;
		//	echo "<br> text = ".$this->_obj->authnetcim->text;
		//	echo "<br> refId = ".$this->_obj->authnetcim->refId;
		//	echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
		//	echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
		//	echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Ok
			$arrReturn["text"] = $this->_obj->authnetcim->text; // Successful
			return $arrReturn;
		}
		else
		{
		/*	echo "NO<br>directResponse= ".$this->_obj->authnetcim->directResponse;
			echo "<br>validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br>resultCode= ".$this->_obj->authnetcim->resultCode; // Error
			echo "<br>code= ".$this->_obj->authnetcim->code;
			echo "<br>text= ".$this->_obj->authnetcim->text; // The record cannot be found.
			echo "<br><pre>error_messages= ";
			print_r($this->_obj->authnetcim->error_messages);
			echo "</pre>";*/
			$arrReturn["resultCode"] = $this->_obj->authnetcim->resultCode; // Error
			$arrReturn["text"] = $this->_obj->authnetcim->text; // The record cannot be found.
			return $arrReturn;
			
		}
	}
	
	function getCustomerProfileRequest($id) // response:  HTTP/1.1 200 OK Date: Mon, 11 Apr 2011 07:33:40 GMT Server: Microsoft-IIS/6.0 X-Powered-By: ASP.NET X-AspNet-Version: 2.0.50727 Cache-Control: private Content-Type: text/xml; charset=utf-8 Content-Length: 895 ﻿OkI00001Successful.63Customerdanibhai@gmail.com15525725
//xjvxcbvxnbc vxbcv
//13750081XXXX2222XXXXJames15783464YES
//also returns
//resultCode = Ok
//code = I00001
//text = Successful.
//customerProfileId = 15525725
//customerPaymentProfileId =13750081
//customerAddressId = 15783464
	
	{//echo $id;echo "<br />";
		$paramArray["login"]	=	$this->_obj->config->item("x_login");
		$paramArray["transkey"]	=	$this->_obj->config->item("x_trans_key");
	//	print_r($paramArray);echo "<br />";
		$this->_obj->load->library('authnetcim',$paramArray);
	//	$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		$arr = array();
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $id); // Numeric (required)
		
		$this->_obj->authnetcim->getCustomerProfileRequest();
	//	echo $this->_obj->authnetcim->response;
	
		if ($this->_obj->authnetcim->isSuccessful())
		{//echo "dfds";
		/*	echo "<br><br> response = ".$this->_obj->authnetcim->response;
			echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
			echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
			echo "<br> code = ".$this->_obj->authnetcim->code;
			echo "<br> text = ".$this->_obj->authnetcim->text;
			echo "<br> refId = ".$this->_obj->authnetcim->refId;
			echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
			echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
			echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;
			$arr["customerPaymentProfileId"] = $this->_obj->authnetcim->customerPaymentProfileId;
			$arr["resultCode "] = $this->_obj->authnetcim->resultCode ;
			$arr["text "] = $this->_obj->authnetcim->text ;
			$arr["customerProfileId "] = $this->_obj->authnetcim->customerProfileId;
			exit();
			return $arr;*/
			$responseArr	=	explode ("<?xml version=",$this->_obj->authnetcim->response);
			$parsedresponse = simplexml_load_string("<?xml version=".$responseArr[1], "SimpleXMLElement", LIBXML_NOWARNING);
//			$parsedresponse = simplexml_load_string($this->_obj->authnetcim->response, "SimpleXMLElement", LIBXML_NOWARNING);
			$paymentProfiles = $parsedresponse->profile->paymentProfiles;
	//		var_dump($paymentProfiles);
		//	echo $paymentProfiles->billTo->firstName;
			$count = 1;
			foreach ($parsedresponse->profile->paymentProfiles as $key => $profile)
			{
			//	echo $profile->payment->creditCard->cardNumber."<br>";
			//	$arrCard	=	$profile->payment->creditCard->cardNumber;
				$arr[$count]["cardNumber"] = $profile->payment->creditCard->cardNumber;
				$arrFirstName	=	$profile->billTo->firstName;
				$arr[$count]["firstName"] = $arrFirstName;
				$arrLastName	=	$profile->billTo->lastName;
				$arr[$count]["lastName"] = $arrLastName;
			//	echo $profile->payment->creditCard->expirationDate."<br>";
			//	$arrexpirationDate	=	$profile->payment->creditCard->expirationDate;
				$arr[$count]["expirationDate"] = $profile->payment->creditCard->expirationDate;
			//	echo $profile->customerPaymentProfileId."<br>";
			//	$arrPaymentProfileId	=	$profile->customerPaymentProfileId;
				$arr[$count]["customerPaymentProfileId"] = $profile->customerPaymentProfileId;
				$count++;
			}
	//		print_r($arr);
			$arr[1]["have_error"] = "NO";
	//		print_r($arr);echo "<br />";
			$arrReturn = array();
			$arrReturn["cardNumber"]	=   (string) $arr[1]["cardNumber"][0];
			$arrReturn["firstName"]	=   (string) $arr[1]["firstName"][0];
			$arrReturn["lastName"]	=   (string) $arr[1]["lastName"][0];
			$arrReturn["expirationDate"]	=   (string) $arr[1]["expirationDate"][0];
			$arrReturn["customerPaymentProfileId"]	=   (string) $arr[1]["customerPaymentProfileId"][0];
			$arrReturn["have_error"]	=   (string) $arr[1]["have_error"];
		//	print_r($arrReturn);exit();
			
			return $arrReturn;
		}
		
		else
		{
		//	echo "not successful";exit();
		/*	echo "NO<br>".$this->_obj->authnetcim->directResponse;
			echo "<br>".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br>".$this->_obj->authnetcim->resultCode;
			echo "<br>".$this->_obj->authnetcim->code;
			echo "<br>".$this->_obj->authnetcim->text;
			echo "<br><pre>";
			print_r($this->_obj->authnetcim->error_messages);
			echo "</pre>";*/
			$arr["have_error"] = "YES";
			return $arr;
			
		}
	
//		$xml = $this->_obj->xmllib_xmlparser->XmlLib_xmlParser($this->_obj->authnetcim->response);
		// parse document and return rootnode
//		var_dump($xml->data);
//		$doc = $this->_obj->xmllib_xmlparser->getDocument();
		//print_r($doc);
		
/*		if ($doc->hasChildren()) {
		for ($i=0;$i<count($doc->children);$i++) {
			// parse the node into associative array
			$n = $doc->children[$i]->toArray();
			echo "<h2>".htmlentities($n['title'])."</h2>\n";
			if (isset($n['date']))
				echo "<p><em>&lt;".date("j F Y", strtotime($n['date']))."&gt;</em></p>\n";
			echo "<p>".nl2br(htmlentities(trim($n['body'])))."</p>\n";
			}
		} 
	*/
		
		
	}
	
	function getCustomerPaymentProfileRequest($arrInfo) // returns resultCode = Ok , code , text = Successful. , customerPaymentProfileId
														// and a string long response HTTP/1.1 200 OK Date: Mon, 11 Apr 2011 07:20:50 GMT 
														//Server:Microsoft-IIS/6.0 X-Powered-By: ASP.NET X-AspNet-Version: 2.0.50727 
														//Cache-Control: private Content-Type: text/xml; charset=utf-8 
														//Content-Length: 630 ﻿OkI00001Successful.
														//xjvxcbvxnbc vxbcv
														//13750081XXXX2222XXXXYES
	{
		$paramArray["login"]	=	$this->_obj->config->item("x_login");
		$paramArray["transkey"]	=	$this->_obj->config->item("x_trans_key");
		
		$this->_obj->load->library('authnetcim',$paramArray);
	
		// many more elements are returned as defined in the manual, just parse the xml response
		
//		$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
	
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $arrInfo["customer_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer payment profile
		$this->_obj->authnetcim->setParameter('customerPaymentProfileId', $arrInfo["customer_payment_profile_id"]); // Numeric (required)
		$this->_obj->authnetcim->getCustomerPaymentProfileRequest();
		
		
		$responseArr	=	explode ("<?xml version=",$this->_obj->authnetcim->response);
		$parsedresponse = simplexml_load_string("<?xml version=".$responseArr[1], "SimpleXMLElement", LIBXML_NOWARNING);
		$paymentProfiles = $parsedresponse->profile->paymentProfiles;
	//	print_r($paymentProfiles);
	//	$count = 0;
	/*	foreach ($parsedresponse->profile->paymentProfiles as $key => $profile)
		{
		//	echo $profile->payment->creditCard->cardNumber."<br>";
			$arr["cardNumber"] = $profile->payment->creditCard->cardNumber;
		//	echo $profile->payment->creditCard->expirationDate."<br>";
			$arr["expirationDate"] = $profile->payment->creditCard->expirationDate;
		//	echo $profile->customerPaymentProfileId."<br>";
			$arr["customerPaymentProfileId"] = $profile->customerPaymentProfileId;
		//	$count++;
		}*/
		
	//	print_r($arr);
		
		
		
		
		if ($this->_obj->authnetcim->isSuccessful())
		{	/*echo "<br> response starts from here : <br> <br>";
			echo "<br> response = ".$this->_obj->authnetcim->response;
			echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
			echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
			echo "<br> code = ".$this->_obj->authnetcim->code;
			echo "<br> text = ".$this->_obj->authnetcim->text;
			echo "<br> refId = ".$this->_obj->authnetcim->refId;
			echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
			echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
			echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;*/
		}
		else
		{
		/*	echo "NO<br>directResponse= ".$this->_obj->authnetcim->directResponse;
			echo "<br>validationDirectResponse= ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br>resultCode= ".$this->_obj->authnetcim->resultCode;
			echo "<br>code= ".$this->_obj->authnetcim->code;
			echo "<br>text= ".$this->_obj->authnetcim->text;
			echo "<br><pre>error_messages= ";
			print_r($this->_obj->authnetcim->error_messages);
			echo "</pre>";*/
			
		}
	}
	
	function validateCustomerPaymentProfileRequest($arrInfo) // response HTTP/1.1 200 OK Date: Mon, 11 Apr 2011 07:31:00 GMT Server: Microsoft-IIS/6.0 X-Powered-By: ASP.NET X-AspNet-Version: 2.0.50727 Cache-Control: private Content-Type: text/xml; charset=utf-8 Content-Length: 709 ﻿OkI00001Successful.1,1,1,(TESTMODE) This transaction has been approved.,000000,P,0,none,Test transaction for ValidateCustomerPaymentProfile.,1.00,CC,auth_only,63,,,,xjvxcbvxnbc vxbcv,,,,,,,danibhai@gmail.com,,,,,,,,,0.00,0.00,0.00,FALSE,none,207BCBBF78E85CF174C87AE286B472D2,,,,,,,,,,,,,XXXX2222,Visa,,,,,,,,,,,,,,,,YES
	// also returns
	//resultCode = Ok
	//code = I00001
	//text = Successful.
	
	{
		
//		$cim = new AuthNetCim('api-login-id', 'api-transaction-key', false);
		
		// Payment gateway assigned ID associated with the customer profile
		$this->_obj->authnetcim->setParameter('customerProfileId', $arrInfo["customer_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer payment profile
		$this->_obj->authnetcim->setParameter('customerPaymentProfileId', $arrInfo["customer_payment_profile_id"]); // Numeric (required)
		
		// Payment gateway assigned ID associated with the customer shipping address
		// If the customer AddressId is not passed, shipping information will not be included with the transaction.
		// customerShippingAddressId used the same value of customerAddressId (not specified in the manual)
//		$cim->setParameter('customerShippingAddressId', '564'); // Numeric (optional)
		
		// Indicates the processing mode for the request (if live, the billing/shipping address gets verified)
		$this->_obj->authnetcim->setParameter('validationMode', 'testMode'); // testMode or liveMode
		
		$this->_obj->authnetcim->validateCustomerPaymentProfileRequest();
		if ($this->_obj->authnetcim->isSuccessful())
		{
		/*	echo "<br> response starts from here : <br> <br>";
			echo "<br> response = ".$this->_obj->authnetcim->response;
			echo "YES<br> directResponse = ".$this->_obj->authnetcim->directResponse;
			echo "<br> validationDirectResponse = ".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br> resultCode = ".$this->_obj->authnetcim->resultCode;
			echo "<br> code = ".$this->_obj->authnetcim->code;
			echo "<br> text = ".$this->_obj->authnetcim->text;
			echo "<br> refId = ".$this->_obj->authnetcim->refId;
			echo "<br> customerProfileId = ".$this->_obj->authnetcim->customerProfileId;
			echo "<br> customerPaymentProfileId =".$this->_obj->authnetcim->customerPaymentProfileId;
			echo "<br> customerAddressId = ".$this->_obj->authnetcim->customerAddressId;*/
		}
		else
		{
			/*echo "NO<br>".$this->_obj->authnetcim->directResponse;
			echo "<br>".$this->_obj->authnetcim->validationDirectResponse;
			echo "<br>".$this->_obj->authnetcim->resultCode;
			echo "<br>".$this->_obj->authnetcim->code;
			echo "<br>".$this->_obj->authnetcim->text;
			echo "<br><pre>";
			print_r($this->_obj->authnetcim->error_messages);
			echo "</pre>";*/
			
		}
	}
	
}

?>