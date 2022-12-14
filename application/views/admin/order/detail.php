<?
		$this->load->view( 'admin/header_view');
?>	

			<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
	?>
            </div>
            <br class="clear" />
        	<div class="order-wrap">
	        	<h1>Orders Details</h1>
                <div align="center">
					<?
					 if(isset($errors))  	
					 {
					   if (isset($errors) && count($errors) > 0)
					   {
						   foreach ($errors as $error)
						   {
							echo $error;
						   }
					   }
					 } 
					?>                                    
                  </div>
                <div class="order-table">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="width:50%; vertical-align:top;">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>Order Number:</td>
                                <td><strong><?=$order["order_code"]?></strong></td>
                              </tr>
                              <tr>
                                <td>Order By:</td>
                                <td><strong><?=$order["order_email"]?></strong></td>
                              </tr>
                              <tr>
                                <td>Order Time:</td>
                                <td><strong><?=date("m-d-Y h:i A",strtotime($order["stamp"]))?></strong></td>
                              </tr>
                              <tr>
                                <td>Pickup Time:</td>
                                <td><strong><?=date("m-d-Y h:i A",strtotime($order["delivery_time"]))?></strong></td>
                              </tr>
                            </table>
                        </td>
                        <td style="vertical-align:top;">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>Order Through:</td>
                                <td><strong>Mob</strong></td>
                              </tr>
                              <tr>
                                <td>Order Type:</td>
                                <td><strong>Take Away</strong></td>
                              </tr>
                              <tr>
                                <td>Total :</td>
                                <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                                <td><strong>???<?=$english_format_number?></strong></td>
                              </tr>
                            </table>
                        </td>
                      </tr>
                    </table>
                </div>
                
                <div class="order-item">
		        	<h1>Orders Item (s)</h1>
					<?
                      //print_r ($orderitems);
                      foreach ($orderitems as $orderitem)
                      {
					  ?>
	                	<div class="item-table">
							<div class="item-name">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td style="width:39%;"><strong>Chicken Chimps</strong></td>
									<td align="center"><strong>QTY:<?=$orderitem["quantity"]?></strong></td>
									<td align="right">
										<strong>
                                        	Basic Price:$
											 <? $english_format_number = number_format($orderitem["price"], 2, '.', '');?>
											 <?=$english_format_number?> 
                                            <span class="item-sptr">l</span> 
                                            <? $totalPrice = $orderitem["price"]*$orderitem["quantity"];?>
                                            <? $english_format_number = number_format($totalPrice, 2, '.', '');?>
                                            Total Price:???<?=$english_format_number?>
                                        </strong>
									</td>
								  </tr>
								</table>
							</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td style="width:50%; vertical-align:top;">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  <?  
                                        foreach($orderitem["variant_list"] as $variant)
                                        {
										?>  
										  <tr>
											<td><?=$variant["group_name"]?>:</td>
											<td>
                                            	<strong><?=$variant["variant_name"]?></strong>
                                                <span class="red-price">(???<?=$variant["price"]?>)</span>
                                            </td>
										  </tr>
                                        <?
                                        } // End foreach($orderitem["variant_list"] as $variant)
										?>
									</table>
								</td>
								<td style="vertical-align:top;">
									<strong class="instruction">Instructions</strong><br class="clear" />
									<p>Nulla sagittis aliquet elit. Nullam vitae elit turpis, id euismod purus. Mauris nunc augue, porttitor ut vulputate ut, porttitor vitae sapien. Mauris sollicitudin luctus turpis eu condimentum.</p>
								</td>
							  </tr>
							</table>
                    	</div>
						<?
                          } // End foreach ($orderitems as $orderitem)
                          
                          ?>
                
                    <div class="total">
                    	<div class="table01">
                    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>Sub Total:</td>
                            <? $subtotal = $order["totalprice"] - ($order["city_tax"] + $order["state_tax"]);?>
                             <? $english_format_number = number_format($subtotal, 2, '.', '');?>
                            <td style="text-align:right;">???<?=$english_format_number?></td>
                          </tr>
                          <tr>
                            <td>Tax:</td>
                            <? $tax = $order["city_tax"] + $order["state_tax"];?>
                            <? $english_format_number = number_format($tax, 2, '.', '');?>
                            <td style="text-align:right;">???<?=$english_format_number?></td>
                          </tr>
                          <tr>
                            <td>Total:</td>
                            
                            <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                            <td style="text-align:right;">???<?=$english_format_number?></td>
                          </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

<br class="clear" />
			<!--<table align="center" cellpadding="5" cellspacing="1" class="tablebg">

				<tr>
					<td align="center" colspan="5" class="tdHead"><strong>Order Detail</strong></td>
				</tr>
				<tr>
				  <td colspan="2" class="tdRow" style="color:#FF0000">
                  
                                    </td>
			  </tr>
				

				<tr>
					<td align="left" class="tdRow" width="179">Order and Restaurant Detail</td>
					<td align="left" class="tdRow"><?
                    // print_r ($order);
					?></td>
					<input type="hidden" name="hidden">
				</tr>
				<tr>
				  <td align="left" class="tdRow">Order Items</td>
				  <td align="left" class="tdRow">
				  
				  <?
				  //print_r ($orderitems);
				  foreach ($orderitems as $orderitem)
				  {
				  	// print_r ($orderitem);
					echo "<br /><br />";
					foreach($orderitem["variant_list"] as $variant)
					{
						// print_r ($variant);
						echo "<br /><br />";
					}
					echo "<br /><br /><br /><br />";
				  }
                  
				  ?></td>
			  </tr>
			</table>-->
<?
$this->load->view( 'admin/footer_view');
?>
