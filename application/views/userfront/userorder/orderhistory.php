<?
$this->load->view("userfront/header_view");
?>
<link type="text/css" href="<?=base_url()?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />	
<script>
	$(function() {
		$( "#accordion" ).accordion({ collapsible: true, hide: true , active: false});
		$( "#datepicker" ).datepicker();
		$( "#datepicker1" ).datepicker();
	});
</script>

    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            Order History
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

            <!-- Start Restaurant Account Settings Head -->
				<div class="account-hed" style="padding-left:27px;">
                	<h1>Order History</h1>
                </div>
            <!-- End Restaurant Account Settings Head -->
				<br class="clear" />
				<div class="account">
                	<div class="about-info">
                    	<h2 style="float:none; margin:0px; padding:0px; font-size:16px; font-weight:bold;">Order Mades On</h2>
                        <p style="padding-top:6px; padding-bottom:6px;">Data available from <strong>3rd Jan 2010</strong></p>
                    </div>
                    <!-- Start Order-Mades-On-info -->
                		
                        <div class="Order-Mades-On-info">
                        	<form method="post" name="formorder" id="formorder">
                        	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                                  <tr>
                                      <td style="width:264px;"><strong>Order date From</strong></td>
                                      <td style="width:264px;"><strong>Order date To</strong></td>
                                      <td>&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td style="padding-top:5px; width:264px;">
                                        <input name="start_date" type="text" class="txt-field02" style="width:239px; background-position:230px 4px; font-size:12px;" value="<?=$orderFilter["start_date"]?>" id="datepicker" />
                                    </td>
                                     <td style="padding-top:5px; width:264px;">
                                            <input name="end_date" type="text" class="txt-field02" style="width:239px; background-position:230px 4px; font-size:12px;" value="<?=$orderFilter["end_date"]?>" id="datepicker1" />
                                        </td>
                                    <td><a href="javascript:void(null);" onclick="formorder.submit();" class="add-btn" style="padding:6px 10px 6px 10px;">Go</a></td
                                  ></tr>
                               </table>        
                               </form>       
                        </div>
                      
                      <!-- End Order-Mades-On-info -->	
                </div>
                
               
                
               <div class="Order-Mades-On-form">
                <?
				$ncount=0;
				foreach ($orders as $order)
					$ncount++;
					
				if($ncount==0)
					echo "<br />Empty";
				
				else
				{		
                ?>
                    <div class="order-hed">
                            <span class="orderNum font13"><strong>S No.</strong></span>
                            <span class="orderCode font13">
                                <strong>Order Number</strong>
                            </span>
                            <span class="orderRest font13">
                                <strong>Restaurant</strong>
                            </span>
                            <!-- <span class="orderAirport font13">
                                <strong>Airport</strong>
                            </span> -->
                            <span class="orderDate font13">
                                <strong>Order Date</strong>
                            </span>
                            <span class="orderType font13">
                                <strong>Order Type</strong>
                            </span>
                             <span class="orderTotal font13">
                                <strong>Tax</strong>
                            </span>
                            <span class="orderTotal font13">
                                <strong>Total</strong>
                            </span>
                        </div>
                    <br class="clear" />
                    <div id="accordion">
                            	<?
								
                                foreach ($orders as $order)
								{
								?>
								<div class="orderRow">
                                    <span class="orderNum" style="padding:7px 0px 0px 10px; font-weight:normal;"><?=$order["id"]?></span>
                                    <span class="orderCode" style="padding:7px 0px 0px 0px;">
                                        <strong><?=$order["order_code"]?></strong>
                                    </span>
                                    <span class="orderRest" style="padding:7px 0px 0px 0px;">
                                        <strong><?=$order["restaurant_name"]?></strong>
                                    </span>
                                    <!-- <span class="orderAirport" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        JFK
                                    </span> -->
                                    <span class="orderDate" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        <?=date("m-d-Y",strtotime($order["stamp"]))?>
                                    </span>
                                    <span class="orderType" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        <?=$order["order_through"]?>
                                    </span>
                                    <span class="orderTotal" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                    <? $totalTax = $order["city_tax"] + $order["state_tax"];?>
                                        <strong>₦<?=$totalTax?></strong>
                                    </span>
                                    <span class="orderTotal" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                    <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                                        <strong>₦<?=$english_format_number?></strong>
                                    </span>
                                </div>
                                <iframe allowtransparency="true" frameborder="0" width="907" height="492" style="background:0px none;" id="itemIframe" name="itemIframe" src="<?=base_url()?>userorder/orderdetail/<?=$order["id"]?>">
                                    <noscript>
                                        Your browser doesn't appear to support frames.  
                                        Please see the 
                                        <a href="<?=base_url()?>restaurantitem/addItem">non-framed version</a>
                                        of this page.
                                    </noscript> 
                                </iframe>                            
                                <?
								
                                }//end foreach 
								
								?>
                    </div>
                    
                   <!-- Start Restaurant Pagination -->
                   <!--
                    <div class="nav">
                                 <ul>
                                    <li><a class="back-none" href="#"><<</a></li>
                                    <li><a class="back-none" href="#">Back</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">6</a></li>
                                    <li><a class="back-none" href="#">Next</a></li>
                                    <li><a class="back-none" href="#">>></a></li>
                                 </ul>
                     </div>
                     -->
                   <!-- End Restaurant Pagination -->
                
                 <?
                } //end empty else Condition
                ?>
                    
                    </div>
                   

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>
