<?
$this->load->view("userfront/header_view");
?>

<script>
	$(function() {
	<?
	for ($n=0;$n<count($restaurants);$n++)
	{
	?>
		$( "#accordion<?=$n?>" ).accordion({ collapsible: true, hide: true , active: false});
	<?
	}
	?>		
	});
</script>
<script type="text/javascript" src="<?=base_url()?>js/frontfunctions.js"></script>
    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            Favorite Order
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

            <!-- Start Restaurant Favorites -->
				<div class="name-rating" style="padding-bottom:20px;">
                	<h1>Favorites</h1>
                </div>
            <!-- End Restaurant Favorites -->
				<br class="clear" />
            <!-- Start Restaurant Favorites Navigation Bar -->
				 <?
                 $this->load->view("userfront/userfavorites/favorite_navigation");
                 ?>
            <!-- End Restaurant Favorites Navigation Bar -->

            <!-- Start Restaurant Favorites Content -->
	            <div class="rest-mid-cont">
                	<div class="fav-cont">
                        <?
						$nCount	=	0;
                        foreach ($restaurants as $restaurant)
						{
						?>
                    	<div class="fav-wrap">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:15px;">
                              <tr>
                                <td valign="middle">
                                	<h3><?=$restaurant["name"]?></h3>
                                </td>
                                <td>
                                <?
									//echo base_url()."uploads/restaurant/logo/".$restaurant["logo"];
									if($restaurant["logo"] != "" && file_exists($logoPath."/".$restaurant["logo"]))
									{
								?>
									<a href="#"><img src="<?=base_url()?>uploads/restaurant/logo/<?=$restaurant["logo"]?>" alt="" /></a>
									<?
									}
									else
									{
									?>	
										<img src="<?=base_url()?>uploads/restaurant/logo/noImage.jpg" alt="logo" />
									 <?
									}
									?>	
                                </td>    	
                              </tr>
                            </table>		
                            	<div class="order-hed">
                                    <span class="orderNum font13"><strong>S No.</strong></span>
                                    <span class="orderCode font13">
                                        <strong>Order Name</strong>
                                    </span>
                                    <span class="orderRest font13">
                                        <strong>Restaurant</strong>
                                    </span>
                                    <span class="orderAirport font13">
                                        <strong>Airport</strong>
                                    </span>
                                    <span class="orderDate font13">
                                        <strong>Order Date</strong>
                                    </span>
                                    <span class="orderType font13">
                                        <strong>Order Type</strong>
                                    </span>
                                    <span class="orderTotal font13">
                                        <strong>Total</strong>
                                    </span>
                                </div>
                            <br class="clear" />
                            <div id="accordion<?=$nCount?>">
                            	<?
								$count=0;
							//	print_r($favoriateorders[$restaurant["id"]]);
                                foreach ($favoriateorders[$restaurant["id"]] as $order)
								{
								?>
								<div class="orderRow">
                                    <span class="orderNum" style="padding:7px 0px 0px 10px; font-weight:normal;">1</span>
                                    <span class="orderCode" style="padding:7px 0px 0px 0px;">
                                        <strong><?=$order["order_name"]?></strong>
                                    </span>
                                    <span class="orderRest" style="padding:7px 0px 0px 0px;">
                                        <strong><?=$order["restaurant_name"]?></strong>
                                    </span>
                                    <span class="orderAirport" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        <?=$order["airport_name"]?>
                                    </span>
                                    <span class="orderDate" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        <?=date("m-d-Y",strtotime($order["stamp"]))?>
                                    </span>
                                    <span class="orderType" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                        <?=$order["order_through"]?>
                                    </span>
                                    <span class="orderTotal" style="padding:7px 0px 0px 0px; font-weight:normal;">
                                     <? $english_format_number = number_format($order["totalprice"], 2, '.', '');?>
                                        <strong>₦<?=$english_format_number?></strong>
                                    </span>
                                </div>
                                <iframe allowtransparency="true" frameborder="0" width="907" height="492" style="background:0px none;" id="itemIframe" name="itemIframe" src="<?=base_url()?>userorder/orderdetail/<?=$order["id"]?>" frameborder="0">
                                    <noscript>
                                        Your browser doesn't appear to support frames.  
                                        Please see the 
                                        <a href="<?=base_url()?>restaurantitem/addItem">non-framed version</a>
                                        of this page.
                                    </noscript> 
                                </iframe>                            
                                <?
									$count++;
                                }//end foreach 
								?>
                            </div><!--end accordion2-->
                           

                        </div><!--end fav-wrap-->
                        <?
						$nCount++;						
						}//end foreach
						if($nCount == 0)
							echo "<br />Empty";
						?>                    	
                    </div>
                </div>
            <!-- End Restaurant Favorites Content -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>