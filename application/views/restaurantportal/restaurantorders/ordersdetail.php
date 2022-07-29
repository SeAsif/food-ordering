
<html xmlns="http://www.w3.org/1999/xhtml" style="border:0px none;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css" />
<!--.................Variant Popup..............-->
<script type="text/javascript" src="<?=base_url()?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/dropdowncontent.js"></script>
<!--.................Variant Popup..............-->

<script language="javascript">

function rejectOrder(orderid,status)
{
	var rejectReason;
	rejectReason	=	$("#reject_reason").val();

	$.ajax({ type: "POST", url: "<?=base_url()?>restaurantorders/updateOrderStatus/"+orderid, data: "order_status="+status+"&reject_reason="+rejectReason, success: function(orderstatus){ 
	
		if (orderstatus>0)
		{
		//	alert ('Order Updated');
			document.location.href	=	"<?=base_url()?>restaurantorders/ordersdetail/"+orderid;
//			var objRef = parent.window;
//			objRef.refreshMessage("Order Rejected");
//			objRef.showSuccess("Order Rejected","");
			
		}
	}//end function
	});	
}

function updateOrderStatus(orderid,status)
{

	$.ajax({ type: "POST", url: "<?=base_url()?>restaurantorders/updateOrderStatus/"+orderid, data: "order_status="+status+"", success: function(orderstatus){ 
	
		if (orderstatus>0)
		{
		//	alert ('Order Updated');
			document.location.href	=	"<?=base_url()?>restaurantorders/ordersdetail/"+orderid;
		}
	}//end function
	});	
}

</script>
<style type="text/css">

body { background:0px none !important;}

</style>

</head>

<body style="box-shadow: none;">

<div class="order-wrap" style="border:0px none;">
    <h1 style="float:left;">Orders Details</h1>
    <div class="order-menu">
        <?
        if ($order["order_status"]	==	"Confirmed")
        {
        ?>
        <!--<a href="javascript:void(null);" onclick="updateOrderStatus(<?=$order["id"]?>,'Delivered')" title="Delivered" class="delivered">Delivered</a>-->
        <?
        }
		if($type != "history")
		{
			if ($order["order_status"]	==	"Pending" || $order["order_status"]	==	"Unpaid" )//later on after payment processing on the front end it will be done only on paid
			{
			?>
			<a href="javascript:void(null);" onClick="updateOrderStatus(<?=$order["id"]?>,'Confirmed')" title="Confirm" class="process">Confirm</a>
			<?
			}
			if ($order["order_status"]	==	"Pending" || $order["order_status"]	==	"Unpaid" )//later on after payment processing on the front end it will be done only on paid
			{
			?>
			<a href="javascript:void(null);" title="Reject" class="reject" id="searchlink01" rel="subcontent01">Reject</a>
			<?
			}
		}
        ?>
        <!-- Start Popup Window Here -->
        <div id="subcontent01" class="reject-popup">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>Why Is Rejected!</strong></td>
              </tr>
              <tr>
                <td style="padding-top:6px;">
                    <textarea name="reject_reason" id="reject_reason" cols="10" rows="10" class="txt-area"></textarea>
                </td>
              </tr>
              <tr>
                <td style="padding-top:6px;">
                    <input name="btn" type="button" class="confirm" value="Confirm and Send" onClick="rejectOrder(<?=$order["id"]?>,'Rejected');" />
                </td>
              </tr>
            </table>

        </div>
        <script type="text/javascript">
        dropdowncontent.init("searchlink01", "right-bottom", 500, "onclick")
        </script>
        <!-- End Popup Window Here -->
        
        <a href="javascript:window.print()" title="Print" class="print">Print</a>
    </div>
    <div class="order-table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="width:50%; vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Order Number:</td>
                  <td><strong><?=$order["order_code"]?>
                  </strong></td>
                </tr>
                
                <tr>
                  <td>Order Time:</td>
                  <td><strong>
                    <?=date("m-d-Y h:i A",strtotime($order["stamp"]))?>
                  </strong></td>
                </tr>
                <tr>
                  <td>Pickup Time:</td>
                  <td><strong>
                    <?=date("m-d-Y h:i A",strtotime($order["delivery_time"]))?>
                  </strong></td>
                </tr>
            </table></td>
            <td style="vertical-align:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                
                <tr>
                  <td>Order Type:</td>
                  <td><strong><?=$order["order_type"]?></strong></td>
                </tr>
      					<tr>
                  <td>Address:</td>
                  <td>
                  <strong><?=$order["order_address"]?>
                  </strong></td>
                </tr>
                <tr>
                  <td>Total :</td>
                  <td>
                  <? //$toal = $order["city_tax"] + $order["state_tax"] + $order["totalprice"]?>
                  <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                  <strong>₦
                        <?=$english_format_number?>
                  </strong></td>
                </tr>
								
            </table></td>
          </tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<?php if(!empty($order["order_name"])){ ?>
									<tr>
										<td>Customer Name: </td>
										<td><?=$order["order_name"]?></td>
									</tr>
								<?php } ?>
								<?php if(!empty($order["order_email"])){ ?>
									<tr>
										<td>Customer Email: </td>
										<td><?=$order["order_email"]?></td>
									</tr>
								<?php } ?>	
								<?php if(!empty($order["order_phone"])){ ?>
									<tr>
										<td>Customer Phone: </td>
										<td><?=$order["order_phone"]?></td>
									</tr>
								<?php } ?>	
								
								
							</table>
						</td>
						
					</tr>
					
        </table>
    </div>
    
    <div class="order-item">
      <h1>Orders Item (s)</h1>
      
	  <div class="item-table" style="margin-bottom:0px; padding-top:20px;">
        <div class="item-name" style="border-bottom:0px none; margin-bottom:0px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="width:35%;"><strong>Item Name</strong></td>
              <td align="center" style="width:10%;"><strong>QTY</strong></td>
              <td align="center" style="width:10%;"><strong> Basic Price</strong></td>
          <!--    <td align="center" style="width:16%;"><strong>Total City Tax</strong></td>
               <td align="center" style="width:16%;"><strong>Total State Tax</strong></td> -->
               <td align="center" style="width:16%;"><strong>Total Price</strong></td>
            </tr>
          </table>
        </div>
      </div>
	  <?
          //print_r ($orderitems);
		  $total = 0;
          foreach ($orderitems as $orderitem)
          {
          ?>
      <div class="item-table">
        <div class="item-name" style="border-bottom:0px none; margin-bottom:0px;">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td style="width:35%;"><?=$orderitem["item_name"]?></td>
              <td align="center" style="width:10%;"><?=$orderitem["quantity"]?></td>
               <? $english_format_number = number_format($orderitem["price"], 2, '.', '');?>
              <td align="center" style="width:10%;">₦ <?=$english_format_number?></td>
        <!--      <td align="center" style="width:16%;">$ <?=$orderitem["city_tax"]?></td>
              <td align="center" style="width:16%;">$ <?=$orderitem["state_tax"]?></td> -->
               <? $english_format_number = number_format($orderitem["totalprice"], 2, '.', '');?>
              <td align="center" style="width:16%;">₦ <?=$english_format_number?></td>
              <? $total = $total + $orderitem["totalprice"]; ?>
            </tr>
          </table>
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #999999;">
          <tr>
            <td style="vertical-align:top; padding-bottom:0px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td style="padding-left:2px;">
					<?  
					$nCounter	=	1;
					$nCount	=	count($orderitem["variant_list"]);
                    foreach($orderitem["variant_list"] as $variant)
                    {
                    ?>
                    
                    <strong><?=$variant["variant_name"]?></strong> 
                    <span class="red-price">(₦ <?=$variant["price"]?>)</span><? if ($nCounter!=	$nCount){?>,<? }?>
                    <?
						$nCounter++;
                    } // End foreach($orderitem["variant_list"] as $variant)
                    ?>
                  </td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td style="vertical-align:top;"><p><?=($orderitem["instructions"]=="0")?"":$orderitem["instructions"]?></p></td>
          </tr>
        </table>
      </div>
      <?
              } // End foreach ($orderitems as $orderitem)
              
              ?>
      <div class="total">
      
      <div class="float-left"> 
      <?
	  if($type != "history")
	  {
			if ($order["order_status"]	==	"Pending" || $order["order_status"]	==	"Unpaid" )//later on after payment processing on the front end it will be done only on paid
			{
			?>
			<a href="javascript:void(null);" onClick="updateOrderStatus(<?=$order["id"]?>,'Active')" title="Confirm" class="process">Confirm</a>
			<?
			}
	  }	
        ?>

      <a href="javascript:window.print()" title="Print" class="print">Print</a> </div>
        <div class="table01">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <!--
            <tr>
              <td>Sub Total:</td>
              <td style="text-align:right;">$
                <?=$order["totalprice"]?></td>
            </tr>
            -->
            <tr>
                  <td>Sub Total :</td>
                  <td>
                  <strong><span style="font-family: DejaVu Sans;">&#x20A6;</span>
                  <? $english_format_number = number_format($total, 2, '.', '');?>
                        <?=$english_format_number?>
                  </strong></td>
                </tr>
             <tr>
                  <td>Total City Tax:</td>
                  <td>
                  <strong><span style="font-family: DejaVu Sans;">&#x20A6;</span>
                  <? $english_format_number = number_format($order["city_tax"], 2, '.', '');?>
                        <?=$english_format_number?>
                  </strong></td>
                </tr>
                <tr>
                  <td>Total State Tax:</td>
                  <td>
                  <strong><span style="font-family: DejaVu Sans;">&#x20A6;</span>
                  <? $english_format_number = number_format($order["state_tax"], 2, '.', '');?>
                        <?=$english_format_number?>
                  </strong></td>
                </tr>
								<?php if(!empty($order["delivery_charge"])){ ?>
								<tr>
									<td>Delivery Fee :</td>
									<? $english_format_number = number_format($order["delivery_charge"], 2, '.', '');?>
									<td><strong><span style="font-family: DejaVu Sans;">&#x20A6;</span><?= $english_format_number ?></strong></td>
								</tr>
								<?php } ?>
            <tr>
              <td>Total:</td>
              <td style="text-align:left;">₦<strong>
              <? //$order["totalprice"] = $order["totalprice"] + $order["city_tax"] + $order["state_tax"]?>
               <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                <?=$english_format_number?>
              </strong></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
</div>


</body>
</html>






