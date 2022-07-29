<?
$this->load->view("restaurantportal/header_view");
echo form_open(base_url().'restaurantportal/recoverview/',$arrUser->id.'/',$arrUser->security_code);
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



<?
	 if(isset($successes))  	
	 {
	   if (count($successes) > 0)
	   {
	   ?>
<div class="ui-widget">
     <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
    <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>	
       <?
		   foreach ($successes as $success)
		   {
			echo $success;
		   }
		    ?>&nbsp;&nbsp;
               <a href="http://staging.Waive.com/restaurantportal">Click Here</a> 
              <? echo " to go to log in page";
		?>
</div>
</div>
		<?
	   }
	 } 
	?>





<!-- Start Mid Right -->
<?
	if (count($successes) == 0)
	{
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
                        <td>Password:</td>
                      </tr>
                    </table></TD>
                    <TD WIDTH=125 HEIGHT=21 COLSPAN=2 >
                        <input name="password" id="password" type="password" class="txt-field" size="17" value="">
                        <input type="hidden" name="userid" id="userid" value="<?=$arrUser["id"]?>">
                        <input type="hidden" name="codeid" id="codeid" value="<?=$arrUser["security_code"]?>">
                    </TD>
                    <TD WIDTH=36 HEIGHT=21 ></TD>
                  </TR>
                  <TR>
                    <TD COLSPAN=4 WIDTH=272 HEIGHT=8 > </TD>
                  </TR>
                  <TR>
                    <TD WIDTH=111 HEIGHT=21 ><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td>Confirm Password:</td>
                      </tr>
                    </table></TD>
                    <TD WIDTH=125 HEIGHT=21 COLSPAN=2 >
                    <input name="confpass" id="confpass" type="password" class="txt-field" size="17" value="">
                    </TD>
                    <TD WIDTH=36 HEIGHT=21 ></TD>
                  </TR>
                  <TR>
                    <TD COLSPAN=4 WIDTH=272 HEIGHT=15 ></TD>
                  </TR>
                  <TR>
                    <TD COLSPAN=2 WIDTH=150 HEIGHT=21 > <input type="submit" name="Submit" class="btn" value="Submit" ></TD>

                    
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
                <?
				}
				?>
                </div>
                
                </td>
              </tr>
            </table></td>
          </tr>
        </table>
<!-- End Mid Right -->
</form>
<?
$this->load->view("restaurantportal/footer_view");
?>
