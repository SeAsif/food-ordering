<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paypal order procesing</title>
</head>

<body>

<form id="paypal_frm" action=" https://www.paypal.com/cgi-bin/webscr" method="post">        	
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?=$orderDetail["order_title"]?>">
    <input type="hidden" name="item_number" value="<?=$orderDetail["order_no"]?>">
    <input type="hidden" name="amount" value="<?=$orderDetail["amount"]?>">
    <input type="hidden" name="email" value="<?=$orderDetail["buyer_email"]?>">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="http://staging.Waive.com/userorder/orderSuccess">
    <input type="hidden" name="cancel_return" value="http://staging.Waive.com/userorder/orderFail">
    <input type="hidden" name="business" value="business@Waive.com">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="notify_url" value="http://staging.Waive.com/userorder/ipn_order">
</form>
<script language="javascript" type="text/javascript">
document.getElementById('paypal_frm').submit();
</script>
<!--seller_1283443835_biz@hotmail.com-->
</body>
</html>
