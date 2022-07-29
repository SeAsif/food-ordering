<?
		$this->load->view( 'admin/header_view');

?>
		<script>
			function Caution(airportId,airport)
			{
				answer = window.confirm("Are you sure you want to delete "+airport+" airport?");
				
				if(answer == true)
				{
					document.location="<?=base_url()?>adminairport/delete_airport/"+airportId;
				}
			}
		</script>
<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}else{
		echo "No Data";
	}
	?>
                
            </div>
            <br class="clear" />
		<table align="center" width="775" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">&nbsp;</td>
				<td width="571" colspan="2" align="right">
					<a href="<?=base_url()?>adminairport/add_airport" class="linkMain"
						onMouseOver="window.status='Add Airport'; return true;"
						onMouseOut="window.status=''; return true;">Add Airport</a>				</td>
			</tr>
	</table>
		<table align="center" width="775" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="7" class="tdHead"><strong>Manage Airports </strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="3%"></td>
				<td align="center" class="tdTitle">Airport Name</td>
				
				<td align="center" class="tdTitle">Airport Code</td>
                <td align="center" class="tdTitle">State Tax (%)</td>
                <td align="center" class="tdTitle">City Tax (%)</td>
				<td align="center" class="tdTitle" width="8%">Edit</td>
				<td align="center" class="tdTitle" width="9%">Delete</td>
			</tr>
			<?
			$count=0;
            foreach($airportList as $itemAirport)
			{
				$count++;
			?>			
			<tr>
                <td class='tdRow' align='center'><?=$count?></td>
                <td class='tdRow' align='center'><?=$itemAirport["airport_name"]?></td>
                <td class='tdRow' align='center'><?=$itemAirport["airport_code"]?></td>
                <td class='tdRow' align='center'><?=$itemAirport["airport_statetax"]?></td>
                <td class='tdRow' align='center'><?=$itemAirport["airport_citytax"]?></td>
                <td class='tdRow' align='center'>
                    <a href='<?=base_url()?>adminairport/edit_airport/<?=$itemAirport["id"]?>' class='link'>Edit</a>                </td>
                <td class='tdRow' align='center'>
                    <a href='javascript: Caution(<?=$itemAirport["id"]?> , "<?=$itemAirport["airport_name"]?>");' class='link'>Delete</a>                </td>
            </tr>
            <?
            }
			?>
		</table>
<?
		$this->load->view( 'admin/footer_view');
?>
