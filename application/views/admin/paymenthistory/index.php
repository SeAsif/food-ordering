<?
		$this->load->view( 'admin/header_view');

?>
<script type="text/javascript" src="<?=base_url()?>js/frontfunctions.js"></script>
<script>
	function Caution(terminalId)
	{
		answer = window.confirm("Are you sure you want to delete this terminal?");
		
		if(answer == true)
		{
			document.location="<?=base_url()?>adminterminal/delete_terminal/"+terminalId;
		}
	}
</script>
        
<script language="javascript">
var base_url = "<?=base_url()?>";
function showTerminalsForAirport()
{
	
	var airportId=	$("#airport1 option:selected").val();
	showTerminals(airportId,'showrestaurants');
	
}

function showRestaurantsForTerminal()
{
	
	var terminalId=	$("#terminal option:selected").val();
	
	showRestaurants(terminalId);
	
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
	
/*	$ncount = $restaurantDetail["terminal_id"];
	foreach($terminals as $terminal)
	{
		if($terminal["id"] == $ncount)
			$nCounter = $terminal["airport_id"];
	}	
*/
	
	?>
                
            </div>
            <br class="clear" />
<!--		<table align="center" width="775" cellpadding="5" cellspacing="1">
			<tr>
				<td align="left" colspan="3">&nbsp;</td>
				<td width="571" colspan="2" align="right">
					<a href="<?=base_url()?>adminterminal/add_terminal" class="linkMain"
						onMouseOver="window.status='Add Terminal'; return true;"
						onMouseOut="window.status=''; return true;">Add Terminal</a>				</td>
			</tr>
	</table>
		<table align="center" width="775" cellpadding="5" cellspacing="1" class="tablebg">
			<tr>
				<td align="center" colspan="6" class="tdHead"><strong>Manage Terminals </strong></td>
			</tr>
			<tr>
				<td align="center" class="tdTitle" width="3%"></td>
				<td align="center" class="tdTitle">Terminal Name</td>
				
                <td align="center" class="tdTitle">Airport Name</td>
				<td align="center" class="tdTitle" width="8%">Edit</td>
				<td align="center" class="tdTitle" width="9%">Delete</td>
			</tr>
			<?
			$count=0;
		//	print_r($terminalList);
            foreach($terminalList as $itemTerminal)
			{
				$count++;
			?>			
			<tr>
                <td class='tdRow' align='center'><?=$count?></td>
                <td class='tdRow' align='center'><?=$itemTerminal["terminal_name"]?></td>
                <?
				foreach ($airportList as $itemAirport)
				{
					if($itemTerminal["airport_id"] == $itemAirport["id"])
					{
					?>
                         <td class='tdRow' align='center'><?=$itemAirport["airport_name"]?>
                         </td>
					<?
					}
				}	
					?>
                    
                <td class='tdRow' align='center'>
                    <a href='<?=base_url()?>adminterminal/edit_terminal/<?=$itemTerminal["id"]?>' class='link'>Edit</a>
                </td>
                <td class='tdRow' align='center'>
                    <a href='javascript: Caution(<?=$itemTerminal["id"]?>);' class='link'>Delete</a>
                </td>
            </tr>
            <?
            }
			?>
		</table>-->
  <form class="form01" action="#" method="post">
  <table width="40%" border="0" cellspacing="0" cellpadding="0" align="center">
  
 
  
      
      
	<!-- <tr>
      
      <td>
       <select id="airport1" class="list-box01" name="airport1" onchange="javascript:showTerminalsForAirport();">
      <option value="-1">Please Select airport</option>
        <?
        foreach ($airportList as $airports)
        {
        ?>
        <option value="<?=$airports["id"]?>"><?=$airports["airport_name"]?></option>
        <?
        }
        ?>
      </select>
      
      </td>
  </tr> -->
  
    <!-- <tr>
      
      <td >
      <select id="terminal" class="list-box01" name="terminal" onchange="javascript:showRestaurantsForTerminal();">
      <option value="-1" selected="selected" >Please Select terminal</option>
      <?
      
      foreach($terminals as $terminalInfo)
      {
      ?>
      <option value="<?=$terminalInfo["id"]?>"><?=$terminalInfo["terminal_name"]?></option>
      <?
      }
      ?>
      </select>
       </td >
      </tr> -->
      
      
      
              
  
  

  
  <tr>
    <td><select name="restaurant_name" id="restaurant_name" class="list-box01" style="margin-bottom:none;">
    <option value="-1">Select Restaurant</option>
    <?
    foreach ($restaurantList as $restaurant)
    {
     ?>  
    <option value="<?=$restaurant["id"]?>"> <?=$restaurant["restaurant_name"]?></option>
    <?
    }
    ?>
    
  </select></td>
    <td style="vertical-align:top;"><input name="showHistory" type="submit" class="btn" value="Show History" /></td>
  </tr>
</table>
     
        
      
  <!--       <a href='<?=base_url()?>restaurantorders/paymentreport' onclick="submit" class="global-link" style="float:right;"><span>Show History</span></a> -->
        
        
   </form>
 <script>
//showTerminalsForAirport();

ry</span></a> -->
        
        
   </form>
 <script>
showTerminalsForAirport();
//showRestaurantsForTerminal();
