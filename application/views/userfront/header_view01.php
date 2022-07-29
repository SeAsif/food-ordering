<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Waive Inc</title>
<link rel="icon" href="<?=base_url()?>/favicon.ico">
<link href="<?=base_url()?>css/frontstyle.css" rel="stylesheet" type="text/css" />

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
function showToolTip(nRestaurantId)
{
	
	$.ajax({ type: "POST", url: "<?=base_url()?>usersearch/getRestaurantTip/"+nRestaurantId, data: "", success: function(response){ 
			//alert (response);
			
			var obj = jQuery.parseJSON(response);
			$('#tooltip').html(obj.in_html);
		//alert(addFavoriteRestaurant);
//		document.location.href=document.location.href;		
			$('#tooltip').show();
	}//end function
	});	
	
}
function openSign(nSignId)
{
	signId	=	nSignId;
	$('#signin-message').dialog('open');
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




<div class="hedFixed">

<!-- Start Header -->
	<div id="hed-wrap" style="float:none; margin:0px auto;">
    	<div class="logo">
        	<a href="<?=base_url()."home/home"?>">
                <span style="display:none;">
                	Waive<br /><span>slogan!</span>
                </span>
                <img src="<?=base_url()?>/images/new_logo.png" style="max-width: 340px; max-height: 85px;" alt="Logo" />
            </a>
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
            <a href="<?=base_url()."userorder/checkout"?>">Checkout</a><span>|</span>
            <a href="<?=base_url()."useraccount/createaccount"?>">Create Account</a><span>|</span>
            <a href="javascript:void(null);" onclick="openSign(0);" class="active">Sign In</a>
            <?
            }else{
			?>
            <a href="<?=base_url()."useraccount/accountsetting"?>">Your Account</a><span>|</span>
            <a href="<?=base_url()."userfavorites/favoritemenu"?>">Favorites</a><span>|</span>
            <a href="<?=base_url()."userorder/orderhistory"?>">Order History</a><span>|</span>
            <a href="<?=base_url()."userorder/checkout"?>">Checkout</a><span>|</span>
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
<div id="signin-message" title="Signin" style="display:none;">
	<?
        $this->load->view("userfront/signin");
    ?>
</div>
<?
}
?>
<!-- End Signin Legend Popup Window Here -->


    	<div class="crum-menu" style="float:none; margin:0px auto; width:982px; padding-top:30px;">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            Search Result
        </div>
		
        <div class="cont-wrap" style="float:none; margin:0px auto;">

        <!-- Start Open Close Map Section -->
            <div class="map-top">
                <div class="tab">
                    <ul class="login">
                        <li id="toggle">
                            <a id="open" class="open" href="javascript:;">Show Map</a>
                            <a id="close" style="display: none;" class="close" href="javascript:;">Hide Map</a>	 					                       	</li>
                    </ul> 
                </div>
            </div>
            <div class="map-mid">
        
            <!-- Start Restaurant Open Close Map Section -->
                <div id="toppanel">
                    <div id="panel">
                    	<div class="srch-map">
                        	<?
							$i	=	0;
    	                    foreach ($restaurants as $restaurant)
			                {
//								$x	=	round($restaurant["coordinate_x1"]+($restaurant["width"]/2));
//								$y	=	round($restaurant["coordinate_y1"]+($restaurant["height"]/2));
								$x	=	$restaurant["coordinate_x1"];
								$y	=	$restaurant["coordinate_y1"]-20;
							
							?>
                            <div class="map-baloon" style="top:<?=$y?>px; left:<?=$x?>px; z-index:<?=$i?>">
                                <a href="javascript:void(null)" onclick="showToolTip(<?=$restaurant["id"]?>);"></a>
                            </div>
                            <?
								$i++;
                            }
							?>
                            <!--<div class="map-baloon" style="top:118px; left:297px;">
                                <a href="javascript:void(null)" class="selected"></a>
                            </div>-->
                            <img src="<?=base_url()?>images/front/map-big.jpg" alt="big" />
                        </div>
                        <div class="popup" id="tooltip" style="display:none;">
                        </div>
                    </div>
                </div>
            <!-- End Restaurant Open Close Map Section -->
        
            </div>
            <div class="cont-round"><img src="<?=base_url()?>images/front/map-bottom.png" alt="top" border="0" /></div>
        <!-- End Open Close Map Section -->

   	        <br class="clear" />
        </div>


</div>


<!-- Start Main Body -->
<div id="main-wrap">



