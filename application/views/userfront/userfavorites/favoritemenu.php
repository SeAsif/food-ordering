<?
$this->load->view("userfront/header_view");
?>
<script language="javascript">
var nRestaurantID;
var url	=	'<?=base_url()?>userrestaurant/addtocart/';
function refreshItemPage()
{
	document.location.href	=	'<?=base_url()?>userrestaurant/restaurantmenu/'+nRestaurantID;
}
function openItem(nItemId,restId)
{
	itemId	=	nItemId;
	nRestaurantID	=	restId;
	
	var pageFrame = document.getElementById('itemIframe'); 
	
	pageFrame.src 	=	url+nItemId;
		
	$('#dialog-message').dialog('open');
	return false;
}
	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#dialog-message').dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',fluid:true,
				maxWidth:300,
		});

	});

</script>
                    <!-- Start Menu Popup -->
                    	<div id="dialog-message" title="Item Details">
                            <iframe allowtransparency="true" frameborder="0" width="526" height="590" style="background:0px none; padding-top:10px;" id="itemIframe" name="itemIframe">
                                <!--<script type="text/javascript">
                                    document.location = "<?=base_url()?>userrestaurant/additem";
                                </script>
                                <noscript>
                                    Your browser doesn't appear to support frames.  Please see the 
                                    <a href="<?=base_url()?>userrestaurant/additem">non-framed version</a> of this page.
                                </noscript> 
                                -->
                            </iframe>
                        </div>
                    <!-- End Menu Popup -->

    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            Favorite Menu
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
                
                <?
                $ncount=0;
				 foreach ($listItemFavorites as $itemFav)
				 	$ncount++;
					
				if($ncount == 0)
					echo "<br />Empty";
					
				else
				{		
				?>
                
                
                	<div class="fav-cont">
                    	<div class="fav-wrap">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr class="fav-itemHed">
                                <td style="width:35%;">Item name</td>
                                <td>Restaurant Name</td>
                                <td>Price</td>
                                <td></td>
                              </tr>
                              <?
							  $nOld	=	$listItemFavorites[0]["restaurant_id"];
//							  print_r ($listItemFavorites);
                              foreach ($listItemFavorites as $itemFav)
							  {
							  	if ($nOld	==	$itemFav["restaurant_id"])
								{
									$class	=	"fav-itemBlue";
								}
								else{
									$class	=	"fav-item";
								}
							  ?>
                              
                              <tr class="<?=$class?>">
                                <td onclick="openItem(<?=$itemFav["item_id"]?>,<?=$itemFav["restaurant_id"]?>);" style="cursor:pointer"><span><?=$itemFav["item_name"]?></span></td>
                                <td><span><?=$itemFav["restaurant_name"]?></span></td>
                                <td>₦<?=$itemFav["item_price"]?></td>
                                <td align="right">
                                      <a href="javascript:void(null);"><img src="<?=base_url()?>images/front/del.png" alt="del" border="0" /></a>
                                </td>
                              </tr>
                              
                              <?
                              }//end foreach ($listItemFavorites as $itemFav)
							  ?>
                            </table>
                        </div>
                       <!-- Start Restaurant Pagination -->
                        <!--<div class="nav">
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

                    </div>
                    
                 <?
				 } // end else empty condition
				 ?>   
                </div>
            <!-- End Restaurant Favorites Content -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>