<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>

<script language="javascript">
var urladd	=	'<?=base_url()?>menutimings/menutiming/';
function refreshItemPage(msg)
{
//refresh item page
//close item popup
	if (msg	==	"Added Successfully")
	{
		document.location.href	=urladd+"added";	
	}
	else
	{
		document.location.href	=urladd+"updated";	
	}
}
var itemId	;
var url	=	'<?=base_url()?>menutimings/addmenutiming/';
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

/*var addItem	;
function addItems(nItemId)
{
	addItem	=	nItemId;
	$('#add_food_item').dialog('open');
	return false;
}
*/
var disableItem	;
function disableItems(nItemId)
{
	disableItem	=	nItemId;
	$('#disable_operetional_time').dialog('open');
	return false;
}

var activeItem	;
function activeItems(nItemId)
{
	activeItem	=	nItemId;
	$('#active_operetional_time').dialog('open');
	return false;
}

var deleteItem	;
function deleteItems(nItemId)
{
	deleteItem	=	nItemId;
	$('#delete_operetional_time').dialog('open');
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
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
				});

				$('#add_food_item').dialog({
					autoOpen: false,
					modal: false,
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
					buttons: {
						"Save": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});

				// Dialog	( Start Disable Popup Window Here )
				$('#disable_operetional_time').dialog({
					autoOpen: false,
					modal: true,
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
					height: 180,
					buttons: {
						"Yes": function() { 
							$.ajax({ type: "POST", url: "<?=base_url()?>menutimings/changestatus/Inactive", data: "id="+disableItem+"", success: function(msg){ 
								if (msg	==	"saved")
								{
									showSuccess("Time DeActivated Succesfully.");
								}
								$('#disable_operetional_time').dialog("close");   
							}//end function
							});
							
						}, 
						"No": function() { 
							$(this).dialog("close"); 
						} 
					}
				});

				// Dialog	( Start Active Popup Window Here )
				$('#active_operetional_time').dialog({
					autoOpen: false,
					modal: true,
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
					height: 180,
					buttons: {
						"Yes": function() { 
							$.ajax({ type: "POST", url: "<?=base_url()?>menutimings/changestatus/Active", data: "id="+activeItem+"", success: function(msg){ 
								if (msg	==	"saved")
								{
									showSuccess("Product Activated Succesfully.");
								}
								$('#active_operetional_time').dialog("close");   
							}//end function
							});
						}, 
						"No": function() { 
							$(this).dialog("close"); 
						} 
					}
				});

				// Dialog	( Start Delete Popup Window Here )
				$('#delete_operetional_time').dialog({
					autoOpen: false,
					modal: true,
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
					height: 180,
					buttons: {
						"Yes": function() { 
							$.ajax({ type: "POST", url: "<?=base_url()?>menutimings/changestatus/Deleted", data: "id="+activeItem+"", success: function(msg){ 
								if (msg	==	"saved")
								{
									showSuccess("Product Deleted Succesfully.");
								}
								$('#delete_operetional_time').dialog("close");   
							}//end function
							});
						}, 
						"No": function() { 
							$(this).dialog("close"); 
						} 
					}
				});

			});
function closeMenuTiming()
{
$('#dialog-message').dialog('close');
}
			
		</script>
<!-- End Dialog Popups -->

<!-- Start Mid Right -->
		<div class="mid-right">
        	<h1>
            	Menu Timings
                <a href="javascript:void(null);" onclick="openItem(0);" class="global-link float-right"><span>Add New Timing</span></a>
            </h1>
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
            <br class="clear" />
            <br/>
            
            <div class="ctgry-table">
                        <!-- Start Edit Food Item Popup Window Here -->
                        <div id="dialog-message" title="Add New Time Or Editing Time">
							<iframe allowtransparency="true" frameborder="0" width="510" height="251" style="background:0px none;" id="itemIframe" name="itemIframe">
                            <script type="text/javascript">
								document.location = "<?=base_url()?>menutimings/addmenutiming";
							</script>
							<noscript>
							Your browser doesn't appear to support frames.  Please see the <a href="<?=base_url()?>restaurantitem/addItem">non-framed version</a> of this page.
							</noscript> 
                            </iframe>
                        </div>
                        <!-- End Edit Food Item Popup Window Here -->

                        <!-- Start Disable Popup Window Here -->
                        <div id="disable_operetional_time" title="Disable Menu Time">
                        	<br />
							<span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
                            <strong>Are you want to disable this menu time</strong>
                            <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
  <tr>
    <td><img src="<?=base_url()?>/images/ajax-loader.gif" alt="loader" /></td>
  </tr>
</table>
                        </div>
                        <!-- End Disable Popup Window Here -->

                        <!-- Start Active Popup Window Here -->
                        <div id="active_operetional_time" title="Active Menu Time">
                        	<br />
							<span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
                            <strong>Are you want to Active this menu time</strong>
                            <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
  <tr>
    <td><img src="<?=base_url()?>/images/ajax-loader.gif" alt="loader" /></td>
  </tr>
</table>
                        </div>
                        <!-- End Active Popup Window Here -->

                        <!-- Start Delete Popup Window Here -->
                        <div id="delete_operetional_time" title="Delete Menu Time">
                        	<br />
							<span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
                            <strong>Are you want to Delete this menu time</strong>
                            <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
  <tr>
    <td><img src="<?=base_url()?>/images/ajax-loader.gif" alt="loader" /></td>
  </tr>
</table>
                        </div>
                        <!-- End Delete Popup Window Here -->                                
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="ctgry-rowbg01">
                    <td>No</td>
                    <td style="width:31%;">Name</td>
                    <td style="width:18%;">Start Time</td>
                    <td style="width:18%;">End Time</td>
                    <td style="padding-right:0px;">Actions</td>
                  </tr>
                  
                  <?
				  $nCount	=	$ncounter;
                  foreach ($timings as $item)
				  {
				  ?>
                  <tr>
                    <td colspan="5" class="td-height"></td>
                  </tr>
                  <tr class="<?=($item["status"]=="Inactive")?"ctgry-disable":"ctgry-rowbg02"?>">
                    <td align="left" style="padding-left:15px;"><?=$nCount?></td>
                    <td><?=$item["menu_timing_name"]?></td>
                    <td><?=$item["start"]?></td>
                    <td><span style="padding-left:0px;"><?=$item["end"]?></span></td>
                    <td class="action">
                    	<a href="javascript:void(null);" onclick="openItem(<?=$item["id"]?>);">Edit Time</a>              </td>
                  </tr>
                  <?
					  $nCount++;
                  }//end foreach
				  ?>
                  
                  <tr>
                    <td colspan="4" class="td-height"></td>
                  </tr>
                  
                </table>
          </div>
            <div class="paging">
            <?=$paginationLinks?>            	
            </div>
        </div>
<!-- End Mid Right -->
<?
$this->load->view("restaurantportal/footer_view");
?>