<?
		$this->load->view( 'admin/header_view');

?>
		<script>
			function Caution(id)
			{
				answer = window.confirm("Are you sure you want to delete this comission?");
				
				if(answer == true)
				{
					document.location="<?=base_url()?>admincomissions/delete/"+id;
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
		<table align="center" width="775" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">&nbsp;</td>
				<td width="571" colspan="2" align="right">
					<a href="<?=base_url()?>admincomissions/edit" class="linkMain"
						onMouseOver="window.status='Add Comission'; return true;"
						onMouseOut="window.status=''; return true;">Add Comission</a>				</td>
			</tr>
	</table>
		<table align="center" width="775" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="5" class="tdHead"><strong>Manage Comissions </strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="3%"></td>
				<td align="center" class="tdTitle">Start Minute Before Order</td>
				<td align="center" class="tdTitle">End Minute Before Order</td>                
			  <td align="center" class="tdTitle" width="8%">Edit</td>
				<td align="center" class="tdTitle" width="9%">Delete</td>
			</tr>
			<?
			$count=0;
            foreach($list as $item)
			{
			?>			
			<tr>
                <td class='tdRow' align='center'><?=$item["id"]?></td>
                <td class='tdRow' align='center'><?=$item["start"]?></td>
                <td class='tdRow' align='center'><?=$item["end"]?></td>
                <td class='tdRow' align='center'>
                    <a href='<?=base_url()?>admincomissions/edit/<?=$item["id"]?>' class='link'>Edit</a>
                </td>
                <td class='tdRow' align='center'>
                    <a href='javascript: Caution(<?=$item["id"]?>);' class='link'>Delete</a>
                </td>
            </tr>
            <?
            }
			?>
		</table>
<?
		$this->load->view( 'admin/footer_view');
?>
