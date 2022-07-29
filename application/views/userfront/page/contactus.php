<?
$this->load->view("userfront/header_view");
?>

<!-- Start Menu Popups -->

<script language="javascript">
var url	=	'<?=base_url()?>userrestaurant/addtocart/';
function refreshItemPage()
{
	document.location.href	=	document.location.href;
}
function openItem(nItemId)
{
	itemId	=	nItemId;
	var pageFrame = document.getElementById('itemIframe'); 
	
	pageFrame.src 	=	url+nItemId;
		
	$('#dialog-message').dialog('open');
	return false;
}
</script>

<script type="text/javascript">
	$(function(){
		// Dialog	( Start Edit Variant Popup Window Here )
		$('#dialog-message').dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',fluid:true,responsive: true,
				maxWidth:300,
		});

	});

	
</script>

<!-- End Menu Popups -->

<form id="sendfeedback" action="" method="post">
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
        	<a href="<?=base_url()?>mhome">Home</a><span>&gt;</span>
            Contact Us
        </div>
		<div class="cont-wrap">
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-top.jpg" alt="top" border="0" /></div>
        	<div class="rest-mid">

            <!-- Start Restaurant Head -->
				<div class="account-hed">
                	<h1>CONTACT US</h1>
                </div>
            <!-- End Restaurant Head -->
				<br class="clear" />
                <?
				if($emailSend == "false")
				{
				?>
                
                
                <?
					 if(isset($errors))  	
					 {
					   if (isset($errors) && count($errors) > 0)
					   {
					   ?>
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
					 } 
					?>

                
                
                
			      <div class="ui-widget contentPage">
                  		<div class="contactTxt">
                            <p><strong>Customer Service:</strong> 111-111-1111<br/>
                            <strong>Physical address:</strong> abc<br/>
                            <strong>Email address:</strong> admin@Waive.com<br/></p>
                        </div>
                        <div class="contactForm">
                        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td style="padding-bottom:3px; width:30%;"><strong>Name:</strong></td>
                                <td>
                                	<input name="name" value="<?=$contact["name"]?>" type="text" class="itemTxtfield" style="padding:3px; width:250px;" />
                                </td>
                              </tr>
                               <tr>
                                <td style="padding-bottom:3px; width:30%;"><strong>Email Address:</strong></td>
                                <td>
                                	<input name="email" value="<?=$contact["email"]?>" type="text" class="itemTxtfield" style="padding:3px; width:250px;" />
                                </td>
                              </tr>
                               <tr>
                                <td style="padding-bottom:3px; width:30%;"><strong>Phone Number:</strong></td>
                                <td>
                                	<input name="phone" value="<?=$contact["phone"]?>" type="text" class="itemTxtfield" style="padding:3px; width:250px;" />
                                </td>
                              </tr>
                              <tr>
                                <td style="padding-bottom:3px; vertical-align:top;"><strong>Your Feedback:</strong></td>
                                <td>
                                	<textarea name="feedback" class="itemTxtarea" style="padding:3px; width:250px; height:150px;"></textarea>
                                    
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>
                                	<input name="Submit" type="submit" class="add-btn float-left" value="Submit Your Feed Back" />
                                </td>
                              </tr>
                               <tr>
                                <td>
                                    <span class="font15" style="text-decoration:none; font-weight:normal; color:#0065B4;">
                                        <span style="color:#FF0000;">*</span>Phone number is optional
                                    </span>
                                </td>
                              </tr>
                            </table>
                        </div>
                  </div> 
				<?
				}
				else
					echo " Thanks gor providing us with your feedback, we will get back to you soon.";
				?>
            </div>
        	<div class="cont-round"><img src="<?=base_url()?>images/front/rest-bottom.jpg" alt="top" border="0" /></div>
        </div>
</form>
<?
$this->load->view("userfront/footer_view");
?>
