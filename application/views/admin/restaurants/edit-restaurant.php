<?
		$this->load->view( 'admin/header_view');

?>
<script language="javascript">
var base_url = "<?=base_url()?>";
</script>
<script type="text/javascript" src="<?=base_url()?>js/front/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/frontfunctions.js"></script>
<script language="javascript">

function showTerminalsForAirport()
{
	
//	var airportId=$("#airport1 option:selected").val();
	var airportId=	$("#airport1 option:selected").val();
	
	showTerminals(airportId);
	
}
/*
function searchTerminal()
{
	airportid=document.getElementById('airportid').value;
	
	$.ajax({ type: "POST", url: "<?=base_url()?>irestaurant/listTerminals", data: "airportId="+airportid+"", success: function(searchTerminal){ 
		var status="";
		var obj = jQuery.parseJSON(searchTerminal);
		$.each(obj, function() {
			
			status=obj.error;
			
		});
		
		if (status=="Login_Error")
		{
			document.getElementById("error").style.display="block";
		}
		else
		{
		//	document.location.href=document.location.href;		
		}
	}//end function
	});	
	
}
*/
</script>	

<?=form_open_multipart(base_url().'adminrestaurant/save_restaurant/'. (isset($restaurantDetail["id"]) ? $restaurantDetail["id"] : 0))?>
			<div class="trl-menu">
	<? 	
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
//	print_r($airportList);
//	print_r($restaurantDetail);
//	print_r($terminals);
	$ncount = isset($restaurantDetail["terminal_id"]) ? $restaurantDetail["terminal_id"] : 0;
//	echo "counter = ";
//	echo $ncount;
	foreach($terminals as $terminal)
	{
		if($terminal["id"] == $ncount)
			$nCounter = $terminal["airport_id"];
	}	
	?>
                
            </div>
            <br class="clear" />
			<table align="center" cellpadding="5" cellspacing="1" class="tablebg">

				<tr>
					<td align="center" colspan="5" class="tdHead"><strong>Edit Restaurant</strong></td>
			  </tr>
				<tr>
				  <td colspan="5" class="tdRow" style="color:#FF0000">
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
                  </div>                  </td>
			  </tr>
			
				<tr>
					<td align="left" class="tdRow" width="162">Restaurant Name</td>
					<td width="404" align="left" class="tdRow" colspan="3">
					<input name="name" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["restaurant_name"]) ? $restaurantDetail["restaurant_name"] : "" ?>">		
                    <input type="hidden" name="id" value="<?=isset($restaurantDetail["id"]) ? $restaurantDetail["id"] : ""?>">                    			</td>
					<input type="hidden" name="hidden">
				</tr>
				<tr>
				  <td align="left" class="tdRow">Slogan</td>
				  <td align="left" class="tdRow">
                  <input name="slogan" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["restaurant_slogan"]) ? $restaurantDetail["restaurant_slogan"] : "" ?>">                  </td>
			  </tr>
				<tr>
				  <td align="left" class="tdRow">Details</td>
				  <td align="left" class="tdRow">
                  <input name="details" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["restaurant_details"]) ? $restaurantDetail["restaurant_details"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">email</td>
				  <td align="left" class="tdRow">
                  <input name="email" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["email"]) ? $restaurantDetail["email"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">Phone Number</td>
				  <td align="left" class="tdRow">
                  <input name="phone_number" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["phone_number"]) ? $restaurantDetail["phone_number"] : "" ?>">                  </td>
			  </tr>
				 <tr>
				  <td align="left" class="tdRow">State Tax (%)</td>
				  <td align="left" class="tdRow">
                  <input name="statetax" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["restaurant_statetax"]) ? $restaurantDetail["restaurant_statetax"] : ""?>">                  </td>
			  </tr>
               <tr>
				  <td align="left" class="tdRow">City Tax (%)</td>
				  <td align="left" class="tdRow">
                  <input name="citytax" type="text" class="input" size="56" maxlength="255" value="<?= isset($restaurantDetail["restaurant_citytax"]) ? $restaurantDetail["restaurant_citytax"] : "" ?>">                  </td>
			  </tr>
              
				<tr>
				  <td align="left" class="tdRow">User</td>
				  <td align="left" class="tdRow">
                  <?=getUsersDropDown($users,isset($restaurantDetail["user_id"]) ? $restaurantDetail["user_id"] : "")?>                  </td>
			  </tr>          
                <tr>
				  <td align="left" class="tdRow">Country</td>
				  <td align="left" class="tdRow">
                  <select id="country" name="country" class="combowd float-left">
                  <option value="select">Select Country</option>
                  <option value="Canada" <? if(isset($restaurantDetail["country"]) && $restaurantDetail["country"] == "Canada") echo"selected='selected'";?>>Canada</option>
                  <option value="Nigeria" <? if(isset($restaurantDetail["country"]) && $restaurantDetail["country"] == "Nigeria") echo"selected='selected'";?>>Nigeria</option>
                  <option value="USA" <? if(isset($restaurantDetail["country"]) && $restaurantDetail["country"] == "USA") echo"selected='selected'";?>>USA</option>
                  </select>
                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">Address Line1</td>
				  <td align="left" class="tdRow">
                  <input name="address" id="address" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["address"]) ? $restaurantDetail["address"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">Address Line2</td>
				  <td align="left" class="tdRow">
                  <input name="address2" id="address2" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["address2"]) ? $restaurantDetail["address2"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">City</td>
				  <td align="left" class="tdRow">
                  <input name="city" id="city" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["city"]) ? $restaurantDetail["city"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">State</td>
				  <td align="left" class="tdRow">
                  <input name="state" id="state" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["state"]) ? $restaurantDetail["state"] : "" ?>">                  </td>
			  </tr>
              
              <tr>
				  <td align="left" class="tdRow">zip</td>
				  <td align="left" class="tdRow">
                  <input name="zip" id="zip" type="text" class="input" size="56" maxlength="255" value="<?=isset($restaurantDetail["zip"]) ? $restaurantDetail["zip"] : "" ?>">                  </td>
			  </tr>
                
                
			<!--	 <tr >
				  <td align="left" class="tdRow">Address</td>
				  <td align="left" class="tdRow">
                  	<textarea  name="address" id="textarea" cols="35" rows="5"><?=$restaurantDetail["address"]?></textarea >
                  </td>
			  </tr> -->
				
				<tr>
				  <td align="left" class="tdRow">Status</td>
				  <td  align="left" class="tdRow"><?=$statusDD?></td>
			  </tr>
				
				
				<tr>
					<td align="center" class="tdRow"></td>
					<td align="center" class="tdRow">
							<input type="submit" class="btn" value="Submit" >
                    </td>
				</tr>
		</table>
</form>
<?
if($mode == "add")
{
?>
<script>
showTerminalsForAirport();
</script>
<?
}
?>
<?
		$this->load->view( 'admin/footer_view');

?>
