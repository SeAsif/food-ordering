<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waive - Hungry?</title>
<link rel="icon" href="<?=base_url()?>/favicon.ico">
<link href="<?=base_url()?>css/frontstyle.css?v=1" rel="stylesheet" type="text/css" />

<!--................. Start Search and Map Sliding Gallery Effect ..............-->
<link rel="stylesheet" href="<?=base_url()?>css/slide.css" type="text/css" media="screen" />
<script src="<?=base_url()?>js/jquery-1.3.2.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/slide.js" type="text/javascript"></script>
<!--................. End Search and Map Sliding Gallery Effect ..............-->


<!--................. Start Jquery Ui Popup Effect ..............-->
<link type="text/css" href="<?=base_url()?>css/front/jquery-ui-1.8.6.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="<?=base_url()?>js/front/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/front/jquery-ui-1.8.6.custom.min.js"></script>
<!--................. End Jquery Ui Popup Effect ..............-->


<!--................. Start FireBud Here ..............-->
<!-- <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script> -->
<!--................. End FireBud Here ..............-->

<script language="javascript">
var base_url	=	"<?=base_url()?>";
var itemId	;
function openSign(nSignId)
{
	signId	=	nSignId;
	$('#signin-message').dialog('open');
	return false;
}

var base_url	=	"<?=base_url()?>";
var itemId	;
function forgotPass(nForgotId)
{
	forgotId	=	nForgotId;
	//$('#forgot-message').dialog('open');
	return false;
}

var base_url	=	"<?=base_url()?>";
var itemId	;
function orderPickUp(nOrderId)
{
	orderId	=	nOrderId;
	$('#order-message').dialog('open');
	return false;
}
function closeOrderPickup()
{
	$('#order-message').dialog('close');
	return false;
}
</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#signin-message').dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',fluid:true,responsive: true,
				maxWidth:300,
		});

	});

	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		// $('#forgot-message').dialog({
		// 	autoOpen: false,
		// 	modal: true,
		// 	width: 'auto',fluid:true,responsive: true,
		// 		maxWidth:300,
		// });

	});

	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#order-message').dialog({
			autoOpen: false,
			modal: true,
			width: 300,
		});

	});
</script>
<script>
function logout()
{
	$.ajax({ type: "POST", url: "<?=base_url()?>irestaurant/logout", data: "", success: function(logout){ 
		//alert(addFavoriteRestaurant);
		document.location.href=document.location.href;		
	}//end function
	});	
	
}
</script>

<!-- End Dialog Popups -->

</head>

<body>


<noscript>
<div class="javaErrorDiv">
    <div class="noScripterror javaError">
        <h1>JAVASCRIPT IS DISABLED, Please enable it to enter.</h1>
        <ul>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>                                    
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>
            <li>Javascript is Disabled, Please enable it to use the Waive's full functionalities.</li>                        
        </ul>
    </div>
</div>
</noscript>



<!-- Start Order PickUp Popup Window Here -->
<div id="order-message" title="Order PickUp Time" style="display:none; visibility:hidden;">
	<?
        $this->load->view("userfront/orderpickup");
    ?>
    <input type="hidden" name="flagPickup" id="flagPickup" value="0" />
</div>
<!-- End Order PickUp Popup Window Here -->

<!-- Start Main Body -->
<div id="main-wrap">

<!-- Start Header -->
	<div id="hed-wrap">
    	<div class="logo">
           
        </div>
        <div class="login-wrap">
        	<span class="login-name">
            <?
            if( $this->session->userdata('id')== "")
			{
    		?>
            <!--	Hi User: -->
            <?
            }
			else
			{
			?>
            	Hi <?=$this->session->userdata('firstname')?>:
			<?
			}
			?>
            </span>
        	<?
            if( $this->session->userdata('id')== "")
			{
    		?>
            <!-- <a href="<?=base_url()."userorder/checkout"?>">Checkout</a><span>|</span> -->
            <!-- <a href="<?=base_url()."useraccount/createaccount"?>">Create Account</a><span>|</span> -->
            <!-- <a href="javascript:void(null);" onclick="orderPickUp(0);">Order PickUp</a><span>|</span> -->
            <!-- <a href="javascript:void(null);" onclick="openSign(0);" class="active">Sign In</a> -->
            <?
            }else{
			?>
            <!-- <a href="<?=base_url()."useraccount/accountsetting"?>">Your Account</a><span>|</span> -->
            <!-- <a href="<?=base_url()."userfavorites/favoritemenu"?>">Favorites</a><span>|</span> -->
            <!-- <a href="<?=base_url()."userorder/orderhistory"?>">Order History</a><span>|</span> -->
            <!-- <a href="<?=base_url()."userorder/checkout"?>">Checkout</a><span>|</span> -->
			<a href="javascript:void(null);" onclick="javascript:logout();" class="active">Logout</a>
			<?
			}
			?>
        </div>
    </div>
<!-- End Header -->
<?
if( $this->session->userdata('id')== "")
{
?>

<!-- Start Signin Popup Window Here -->
<div id="signin-message" title="Sign In" style="display:none;">
	<?
        $this->load->view("userfront/signin");
    ?>
</div>
<?
}
?>
<!-- End Signin Legend Popup Window Here -->


<!-- Start Forgot Password Window Here -->
<div id="forgot-message" title="Forgot Password" style="display:none;">
	<?
        $this->load->view("userfront/forgotpass");
    ?>
</div>
<!-- End Forgot Password Window Here -->



<!-- Start Mid Section -->
	<div id="mid-wrap">
