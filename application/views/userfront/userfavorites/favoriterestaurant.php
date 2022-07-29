<?
$this->load->view("userfront/header_view");
?>

<script language="javascript">
var itemId	;
var url	=	'<?=base_url()?>userfavorites/restaurantlegend/';
function openItem(nItemId)
{
	itemId	=	nItemId;
	var pageFrame = document.getElementById('itemIframe'); 
	
	pageFrame.src 	=	url+nItemId;
	
//	alert (window.frames[ "itemIframe" ].src);
	
//	window.frames[ "itemIframe" ].document;
	
	$('#dialog-message').dialog('open');
	return false;
}


</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
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
<script language="javascript" src="<?=base_url();?>js/frontfunctions.js"></script>

<!-- End Dialog Popups -->


    	<div class="crum-menu">
        	<a href="<?=base_url()?>home">Home</a><span>&gt;</span>
            Favorite Restaurant
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
	            <div class="center-main">
                                        	<?
						$nCount=0;
                        foreach ($restaurants as $restaurant)
		                {
							$data["restaurant"]	=	$restaurant;
							$data["logoPath"] = $logoPath;
						//	echo 'testing..';
							$this->load->view("userfront/userrestaurant/partialviews/restaurant",$data);
						$nCount++;
						//  echo 'testing..';
                        }
						if($nCount == 0)
							echo "<br />Empty";
						?>
               	  <!-- Start Restaurant Pagination -->
     <div class="nav">
     	<?=$paginationLinks?>
     <!--
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
				-->
                                                 
                     </div>
                   <!-- End Restaurant Pagination -->
                </div>
            <!-- End Restaurant Favorites Content -->

            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>

<?
$this->load->view("userfront/footer_view");
?>
