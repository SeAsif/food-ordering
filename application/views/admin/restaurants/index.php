<?
		$this->load->view( 'admin/header_view');

?>

<script>
	function Caution(restaurantId,restaurant)
	{
		answer = window.confirm("Are you sure you want to delete "+restaurant+" restaurant?");
		
		if(answer == true)
		{
			document.location="<?=base_url()?>adminrestaurant/deleterestaurant/"+restaurantId;
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
		<table align="center" width="980" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">&nbsp;</td>
				<td width="571" colspan="2" align="right">
					<a href="<?=base_url()?>adminrestaurant/save_restaurant" class="linkMain"
						onMouseOver="window.status='Add Restaurant Managers'; return true;"
						onMouseOut="window.status=''; return true;">Add Restaurant</a>				</td>
			</tr>
	</table>
		<table align="center" width="980" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="10" class="tdHead"><strong>Manage Restaurant</strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="4%"></td>
				<td width="21%" align="center" class="tdTitle">Email</td>
				
				<td width="21%" align="center" class="tdTitle">Restaurant Name</td>
				<td width="21%" align="center" class="tdTitle">Restaurant Address</td>
				<td width="10%" align="center" class="tdTitle">Status</td>
                <td width="12%" align="center" class="tdTitle">State Tax (%)</td>
                <td width="18%" align="center" class="tdTitle">City Tax (%)</td>
				<td align="center" class="tdTitle" width="8%">Edit</td>
                <td align="center" class="tdTitle" width="8%">Delete</td>
                <td align="center" class="tdTitle" width="8%">login</td>
			    <!-- <td align="center" class="tdTitle" width="8%">Coordinates</td> -->
			</tr>
			<?
			$count=0;
            foreach($list as $item)
			{
				$count++;
				if($item["status"] != "Deleted")
				{
			?>			
                <tr>
                    <td class='tdRow' align='center'><?=$item["id"]?></td>
                    <td class='tdRow' align='center'><?=$item["email"]?></td>
                    <td class='tdRow' align='center'><?=$item["restaurant_name"]?></td>
                    <td class='tdRow' align='center'><?=$item["address"]?></td>
                    <td class='tdRow' align='center'><?=$item["status"]?></td>
                    <td class='tdRow' align='center'><?=$item["restaurant_statetax"]?></td>
                    <td class='tdRow' align='center'><?=$item["restaurant_citytax"]?></td>
                    <td class='tdRow' align='center'>
                        <a href='<?=base_url()?>adminrestaurant/save_restaurant/<?=$item["id"]?>' class='link'>Edit</a>
                    </td>
                    <td class='tdRow' align='center'>
                        <a href='javascript: Caution(<?=$item["id"]?> ,"<?=str_replace("'","&apos;",$item["restaurant_name"])?>");' class='link'>Delete</a>
                     </td>    
                    <td class='tdRow' align='center'>
                    <!-- <a href='<?=base_url($item["id"])?>' target="_blank" class='link'>login</a> -->
                    <a href='<?=base_url('restaurantportal')?>' target="_blank" class='link'>login</a>
                    </td>
                </tr>
            <?
				}
            }
			?>
		</table>
<?
		$this->load->view( 'admin/footer_view');

?>
