<?
		$this->load->view( 'admin/header_view');

?>

		<script>
			function Caution(id,name)
			{
				answer = window.confirm("Are you sure you want to delete "+name);
				
				if(answer == true)
				{
					document.location="<?=base_url()?>admin/delete/"+id;
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
					<a href="<?=base_url()?>admin/add_user" class="linkMain"
						onMouseOver="window.status='Add Restaurant Managers'; return true;"
						onMouseOut="window.status=''; return true;">Add Restaurant Managers</a>				</td>
			</tr>
	</table>
		<table align="center" width="775" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="8" class="tdHead"><strong>Manage Restaurant Managers </strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="4%"></td>
				<td width="21%" align="center" class="tdTitle">User Email</td>
				
				<td width="21%" align="center" class="tdTitle">First Name</td>
				<td width="21%" align="center" class="tdTitle">Last Name</td>
                <td width="21%" align="center" class="tdTitle">Contact Number</td>
				<td width="18%" align="center" class="tdTitle">Status</td>
				<td align="center" class="tdTitle" width="8%">Edit</td>
			    <td align="center" class="tdTitle" width="8%">Delete</td>
			</tr>
			<?
			$count=0;
		//	print_r($userList);
            foreach($userList as $itemUser)
			{
				$count++;
				if($itemUser["status"] != "Deleted")
				{
			?>			
                <tr>
                    <td class='tdRow' align='center'><?=$count?></td>
                    <td class='tdRow' align='center'><?=$itemUser["email"]?></td>
                    <td class='tdRow' align='center'><?=$itemUser["firstname"]?></td>
                    <td class='tdRow' align='center'><?=$itemUser["lastname"]?></td>
                    <td class='tdRow' align='center'><?=$itemUser["phone_number"]?></td>
                    <td class='tdRow' align='center'><?=$itemUser["status"]?></td>
                    <td class='tdRow' align='center'>
                        <a href='<?=base_url()?>admin/edit_user/<?=$itemUser["id"]?>' class='link'>Edit</a>                </td>
                    <td class='tdRow' align='center'><a href='javascript: Caution(<?=$itemUser["id"]?> , "<?=$itemUser["firstname"]?>");' class='link'>Delete</a></td>
                </tr>
           <?
                }
            }
			?>
		</table>
<?
		$this->load->view( 'admin/footer_view');

?>
