<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paypal order procesing</title>
</head>

<body>
<h3>Payment Successful</h3>
</body>
</html>
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="HandheldFriendly" content="True" />
<title>Restaurant Home</title>
<link href="<?=base_url()?>css/mobile.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>

<!-- Start Main Body -->
<div id="main-wrap">

<!-- Start Header -->
	<div id="header">
    	<div class="logo">
                <span style="display:none;">
                	Waive<br /><span>a bite for your flight!</span>
                </span>
               <a href="<?=base_url()."mhome"?>" title="home">
                <img src="<?=base_url()?>/images/mobile/logo.png" alt="Logo" />
            </a>
        </div>
    </div>
<!-- End Header -->
<!-- Start Mid Section -->
	<div id="mid-wrap">
<!-- Start Restaurant Cart Section -->
<div class="srchWrap01">
	<div class="cartWrap">
    	<div class="orderDone">
        <?
		$deliveryTime=date("h:i A",strtotime($order['delivery_time']));
		$date=date("F d, Y",strtotime($order['delivery_time']));
		?>
        	<h4>Order Confirmed Successfully</h4>
            <p>Your Order will be ready for pickup at
            
            <?=$restaurant_info["address"]?> , <?=$restaurant_info["restaurant_name"]?> ,
			<?=$terminal_info["terminal_name"]?> , 
            <?=$airport_info["airport_name"]?>
            for 
            <?=$date ?> and will be prepared by <?=$deliveryTime?>
        </p>
        </div>
    </div>
</div>
<!-- End Restaurant Cart Section -->
