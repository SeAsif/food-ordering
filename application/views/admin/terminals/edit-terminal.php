<?
		$this->load->view( 'admin/header_view');
?>
		<script>
			function check()
			{
				if(document.add.name.value == "")
				{
					alert("Event Name not given");
					document.add.name.focus();
					return;
				}
				if(document.add.detail.value == "")
				{
					alert("Detail not given");
					document.add.detail.focus();
					return;
				}
				
				document.add.submit();
			}
		</script>
		<?=form_open_multipart(base_url().'adminterminal/edit_terminal/'.$terminalDetail["id"])?>
			<div class="trl-menu">
	<? 
	if(isset($breadcrumbs))
	{
			echo $breadcrumbs;
	}
	?>
                
            </div>
            <br class="clear" />

			<table align="center" width="500" cellpadding="5" cellspacing="1" class="tablebg">

				<tr>
					<td align="center" colspan="5" class="tdHead"><strong>Edit Terminal </strong></td>
				</tr>
				<tr>
				  <td colspan="2" class="tdRow" style="color:#FF0000">
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
				  <td align="left" class="tdRow">Airport </td>
				  <td align="left" class="tdRow">
                  <?=getAirPortsDropDown($airports,$terminalDetail["airport_id"])?>                  </td>
			    </tr>

				<tr>
					<td align="left" class="tdRow" width="35%">Terminal Name</td>
					<td align="left" class="tdRow">
					<input name="name" type="text" class="input" size="50" maxlength="255" value="<?=$terminalDetail["terminal_name"]?>">	
                    <input type="hidden" name="id" value="<?=$terminalDetail["id"]?>">                    </td>
					<input type="hidden" name="hidden">
				</tr>
				<tr>
				  <td align="left" class="tdRow">Terminal Image </td>
				  <td width="50" align="left" class="tdRow"><input type="file" name="image">&nbsp;&nbsp;<a href="<?=base_url()?>uploads/terminals/<?=$terminalDetail["terminal_image"]?>" target="_blank">View Image</a></td>
			  </tr>
              
              <tr>
              <td align="left" class="tdRow">Terminal Description</td>
              <td align="left" class="tdRow"><textarea name="terminal_desc" id="terminal_desc" rows="5" cols="40"><?=nl2br($terminalDetail["terminal_description"])?></textarea></td>
          </tr>
              <tr>
                <td align="center" class="tdRow"></td>
                <td align="center" class="tdRow">
                        <input type="submit" class="btn" value="Submit" >                    </td>
            </tr>
			</table>
		</form>
        
<?
		$this->load->view( 'admin/footer_view');
?>