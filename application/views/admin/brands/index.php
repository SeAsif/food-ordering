<?
		$this->load->view( 'admin/header_view');

?>

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
		<table align="center" width="775" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">&nbsp;</td>
				<td width="571" colspan="2" align="right">
					<a href="<?=base_url()?>admin/add_brand" class="linkMain"
						onMouseOver="window.status='Add Restaurant Brand'; return true;"
						onMouseOut="window.status=''; return true;">Add Restaurant Brand</a>				</td>
			</tr>
	</table>
		<table align="center" width="775" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="4" class="tdHead"><strong>Manage Restaurant Brands </strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="3%"></td>
				<td align="center" class="tdTitle">Restaurant Brand Name</td>
				
				<td align="center" class="tdTitle" width="8%">Edit</td>
			</tr>
			<?
			$count=0;
            foreach($brandList as $itemBrand)
			{
				$count++;
			?>			
			<tr>
                <td class='tdRow' align='center'><?=$count?></td>
                <td class='tdRow' align='center'><?=$itemBrand["brand_name"]?></td>
                <td class='tdRow' align='center'>
                    <a href='<?=base_url()?>admin/edit_brand/<?=$itemBrand["id"]?>' class='link'>Edit</a>                </td>
            </tr>
            <?
            }
			?>
		</table>
<?
		$this->load->view( 'admin/footer_view');

?>