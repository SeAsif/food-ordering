<?
		$this->load->view( 'admin/header_view');

?>
<style>
ul.pagination{
	display:flex;
	text-align:center;
	list-style-type:none;
}
ul.pagination li{
	
	padding:10px;
}
</style>
		<script>
			function Caution(terminalId)
			{
				answer = window.confirm("Are you sure you want to delete this terminal?");
				
				if(answer == true)
				{
					document.location="<?=base_url()?>admin/delete_terminal/"+terminalId;
				}
			}
		</script>
			<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
	?>
                
            </div>
            <br class="clear" />
		<table align="center" width="100%" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">
                
                </td>
				<td width="571" colspan="2" align="right">
					<!--<a href="<?=base_url()?>admin/add_brand" class="linkMain"
						onMouseOver="window.status='Add Restaurant Brand'; return true;"
						onMouseOut="window.status=''; return true;">Add Restaurant Brand</a>-->				</td>
			</tr>
	</table>
		<table align="center" width="100%" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="8" class="tdHead"><strong>Manage Orders </strong></td>
			</tr>
			<tr>
			  <td colspan="8" class="tdRow">
			  <?=form_open(base_url().'adminorder')?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                  	<!-- <td style="font-size:11px;">Airport:</td>
                    <td style="font-size:10px;"><?=getAirPortsDropDown($airportList,isset($order["airport_id"]) ? $order["airport_id"] : 0) ?></td>
                    <td style="font-size:11px;">Terminal:</td>
                    <td style="font-size:11px;"><?=getTerminalsDropDown($terminals,isset($order["terminal_id"]) ? $order["terminal_id"] : 0)?></td> -->
                    <td style="font-size:11px;">Restaurant:</td>
                    <td style="font-size:10px;"><?=getRestaurantsDropDown($restaurants,isset($order["restaurant_id"]) ? $order["restaurant_id"] : 0)?></td>
                    <td style="font-size:11px;">Order Status:</td>
                    <td><?=getOrderStatusDropDown($orderstatuses,$order["order_status"])?></td>
                    <td style="font-size:11px;">Order Code:</td>
                    <td><input type="text" name="order_code" value="<?= isset($order["order_code"]) ? $order["order_code"] : "" ?>" /></td>
                  </tr>
              </table>
	          <table width="26%" border="0" cellspacing="0" cellpadding="0" style="margin-top:15px;">
                  <tr>
                    <td>
                        <input type="submit" value="Get Data" class="btn" />
                        <input type="submit" name="Export" value="Export to Excel" class="btn" /> 
                    </td>
                    <td style="font-size:11px; vertical-align:middle;">
                    	<a href="<?=base_url()?>adminorder/resetorderfilter"><strong>Reset</strong></a>
                    </td>
                  </tr>
              </table>
              </form>
              </td>
		  </tr>
			<tr colspan="7" class="tdRow">
				<td align="center" class="tdTitle">ID</td>
				<td align="center" class="tdTitle">Code</td>
				<td align="center" class="tdTitle">Status</td>
				<td align="center" class="tdTitle">Time</td>
				<td align="center" class="tdTitle">Pickup Time</td>
				<td align="center" class="tdTitle">Restaurant</td>
				<td align="center" class="tdTitle">Price</td>
				<td align="center" class="tdTitle">View</td>
			</tr>
			<?
            foreach($list as $listItem)
			{
			?>			
			<tr>
                <td class='tdRow' align='center'><?=$listItem["id"]?></td>
                <td class='tdRow' align='center'><?=$listItem["order_code"]?></td>
                <td class='tdRow' align='center'><?=$listItem["order_status"]?></td>
                <td class='tdRow' align='center'><?=date("m-d-Y h:i A",strtotime($listItem["stamp"]))?></td>
                <td class='tdRow' align='center'><?=date("m-d-Y h:i A",strtotime($listItem["delivery_time"]))?></td>
                <td class='tdRow' align='center'><?=$listItem["restaurant_name"]?></td>
                <td class='tdRow' align='center'>₦<?=$listItem["totalprice"]?></td>
                <td class='tdRow' align='center'>
                    <a href='<?=base_url()?>adminorder/orderdetail/<?=$listItem["id"]?>' class='link'>View</a>                </td>
            </tr>
            <?
            }
			?>
            <tr>
            <td colspan="8" align="center" class="tdRow" style="text-align:center"><ul class="pagination"><?=$paginationLinks?></ul></td>
            </tr>
		</table>
<?
		$this->load->view( 'admin/footer_view');

?>
