<?
$this->load->view("admin/header_view");

echo form_open(base_url().'admin/login');
?>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table"s>
      <tr>
        <td valign="top"></td>
      </tr>
      <tr>
        <td valign="top" style="padding-top:30px;">
        
        <div class="login-page-wrap">
        <TABLE WIDTH=330 BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0 >
          <TR>
            <TD COLSPAN=4 WIDTH=272 HEIGHT=42 ></TD>
          </TR>
          <TR>
            <TD WIDTH=111 HEIGHT=21 ><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>Email:</td>
              </tr>
            </table></TD>
            <TD WIDTH=125 HEIGHT=21 COLSPAN=2 >
            	<input name="email" type="text" class="txt-field" size="17" value="">
            </TD>
            <TD WIDTH=36 HEIGHT=21 ></TD>
          </TR>
          <TR>
            <TD COLSPAN=4 WIDTH=272 HEIGHT=8 > </TD>
          </TR>
          <TR>
            <TD WIDTH=111 HEIGHT=21 ><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td>Password:</td>
              </tr>
            </table></TD>
            <TD WIDTH=125 HEIGHT=21 COLSPAN=2 >
            <input name="password" type="password" class="txt-field" size="17" value="">
            </TD>
            <TD WIDTH=36 HEIGHT=21 ></TD>
          </TR>
          <TR>
            <TD COLSPAN=4 WIDTH=272 HEIGHT=15 ></TD>
          </TR>
          <TR>
            <TD COLSPAN=2 WIDTH=182 HEIGHT=21 ></TD>
            <TD>
            <input type="submit" name="Submit" class="btn" value="Submit" >
            </TD>
            <TD WIDTH=36 HEIGHT=21 ></TD>
          </TR>
          <TR>
            <TD COLSPAN=4 WIDTH=272 HEIGHT=42  class="err" align="center">
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
			</TD>
          </TR>
        </TABLE>
        </div>
        
        </td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<?
$this->load->view("admin/inc/footer");
?>