<?
$this->load->view("userfront/header_view01");
if( $this->session->userdata('id')!= "")
{
	$userId = $this->session->userdata('id');
}else{
$userId=0;
}

?>


<script>
	$(function() {
		$( "#flight_date" ).datepicker();
	});

$(function() 
{
		$( "#airports" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "<?=base_url();?>irestaurant/listAirports",
					dataType: "json",
					data: {
						name_startsWith: request.term
					},
					success: function( data ) {
						response( $.map( data, function( item ) {
							return {
								label: item.airport_name + (item.city? ", " + item.city: ""),
								value: item.airport_name + (item.city? ", " + item.city: ""),
								data: item.id
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				showTerminals( ui.item.data );
			},
			open: function() {
//				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
//				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});

</script>
<script language="javascript" src="<?=base_url();?>js/frontfunctions.js"></script>
<script language="javascript">
var itemId	;
function openItem(nItemId)
{
	itemId	=	nItemId;
	$('#dialog-message').dialog('open');
	return false;
}


var deleteItem	;
function deleteItems(nItemId)
{
	deleteItem	=	nItemId;
	$('#remove_from_fav').dialog('open');
	return false;
}



</script>


<!--<script language="javascript">
	var deleteVariant	;
	function deleteVariants(nItemId)
	{
		deleteVariant	=	nItemId;
		$('#delete_food_variant').dialog('open');
		return false;
	}
</script>-->

<!-- Start Remove Dialog Popup -->
<script type="text/javascript">
		// Dialog	( Start Delete Popup Window Here )
		$('#remove_from_fav').dialog({
			autoOpen: false,
			modal: true,
			width: 560,
			buttons: {
				"Yes": function() { 
//					$("#updatestatus").val("Deleted");
//					$("#updateid").val(removeFavorites);
//					document.statuschange.submit();
					

				}, 
				"No": function() { 
					$(this).dialog("close"); 
				} 
			}
		});
		
		//hover states on the static widgets
		
</script>
<!-- End Remove Dialog Popup -->

<!-- Start Dialog Popups -->
<script type="text/javascript">
	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#dialog-message').dialog({
			autoOpen: false,
			modal: true,
			width: 560
		});

	});
</script>
<!-- End Dialog Popups -->


<!-- Star Rating widget stuff here... -->
<!--<script type="text/javascript" src="<?=base_url()?>js/jquery.uni-form.js?v=1.3"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.ui.stars.js?v=3.0.0b38"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/front/crystal-stars.css?v=2.0.3b38"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/front/uni-form.css"/>
<script type="text/javascript">
	$(function(){
       $("#starify").children().not(":input").hide();
        
        // Create stars from :radio boxes
        $("#starify").stars({
            cancelShow: false
        });
    });

</script>
-->
<!-- End Rating widget stuff here... -->

<br class="clear" />
<br class="clear" />
<br class="clear" />

<!-- Start Mid Section -->
	<div id="mid-wrap" style="padding-top:200px;">

<!-- Start Food Legend Popup Window Here -->
	<div id="dialog-message" title="Food Legend" style="display:none;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="legend">
<tr>
<td>
<span class="takeout" title="Take Out">Take Out</span>
</td>
</tr>
<tr>
<td>
<span class="dine-inn" title="Dine Inn">Dine In</span>
</td>
</tr>
<!-- <tr>
<td>
<span class="proximity" title="Proximity to Gate">Proximity to Gate (45m)</span>
</td>
</tr>
<tr>
<td>
<span class="pre-security" title="Pre-Security">Pre-Security</span>
</td>
</tr>
<tr>
<td>
<span class="post-security" title="Pre-Security">Post-Security</span>
</td>
</tr> -->
</table>
	</div>
<!-- End Food Legend Popup Window Here -->

<!-- Start Delete Popup Window Here -->
    <div id="remove_from_fav" title="Remove From Fav" style="display:none;">
        <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
        <strong>Are you want to Remove this from Favorite</strong>
    </div>
<!-- End Delete Popup Window Here -->


        <div class="cont-wrap">

        <!-- Start Open Close Search Form Section -->
        <?
                 $this->load->view("userfront/usersearch/search_navigation", array("isfavorite"=>$isfavorite));
                 ?>
            <!-- End Restaurant Favorites Navigation Bar -->
            	
                <!-- Start Restaurant Search Content -->
                	<div class="center-main">
                        <div class="center-search-page">
                        	 <div class="show-pages">
                             <?
							 if($total == 0)
							 	$ncounter = 0;
							 ?>
                    			<p>Showing <strong><?=$ncounter?></strong> - <strong><?=$records?></strong> of <strong><?=$total?></strong> Restaurants</p>
                   			 </div>
                             	<div class="menu-bar-main" style="width:204px;">
                                	 <div class="sort-by">
                                        <span>Sort By:</span>
                                        <select class="combowd" style="width:136px;">
                                            <option>Rating</option>
                                        </select>
                                    </div>
                                    <!--	 <div class="sort-by">
                                        <span>Show Only:</span>
                                        <select class="combowd" style="width:136px;">
                                            <option>View All</option>
                                        </select>
                                    </div>-->
                                </div>
                             	
                        </div>
                        
                <!-- Start Error Success Msg -->
						<?
                        if (isset($success["msg"]))
                        {
                        ?>
                        <div class="ui-widget">
                            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
                                <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                <strong><?=$success["msg"]?></strong></p>
                            </div>
                        </div>
                        <?
                        }
                        ?>
                        <?
                        if (isset($errors) && isset($errors) && count($errors))
                        {
                        ?>
                        <br/>
                        <div class="ui-widget">
                            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
                                <?
                                foreach ($errors as $error)
                                {
                                    echo $error;
                                }
                                ?>
                                
                            </div>
                            
                        </div>
                        <?
                        }
                        ?>
                        <br class="clear" />
                <!-- End Error Success Msg -->

						<?
					//	print_r($restaurants);
						$nCount=0;
                        foreach ($restaurants as $restaurant)
		                {
						//	echo $restaurant["take_out"];
						//	echo $restaurant["dine_in"];
							$nCount++;
							$data["restaurant"]	=	$restaurant;
							$data["logoPath"] 	= 	$logoPath;
						//	echo 'testing..';
							$this->load->view("userfront/userrestaurant/partialviews/restaurant",$data);
						
						//  echo 'testing..';
                        }
						if($nCount==0)
							echo "<br />Empty";
						?>
           	  </div>
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

                <!-- End Restaurant Search Content -->
                
            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/srch-bottom.jpg" alt="top" border="0" /></div>
        <!-- End Open Close Search Form Section -->
        
        </div>
        

<?
$this->load->view("userfront/footer_view");
?>

