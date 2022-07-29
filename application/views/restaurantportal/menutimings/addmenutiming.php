<link href="<?=base_url()?>css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.6.custom.min.js"></script>

<script language="javascript">
var addCategory	;
function addCategory(nItemId)
{
	addCategory	=	nItemId;
	$('#add_new_category').dialog('open');
	return false;
}
var groupsAvailable;
<?
if (isset($success["msg"]))
{
?>
	var successMgs	=	'<?=$success["msg"]?>';

<?
}
else
{
?>
var successMgs	=	'';

<?
}
?>

	if (successMgs!="")
	{
		var objRef = parent.window;
		objRef.refreshItemPage(successMgs);

	}

$(document).ready(function()
		{
			//attachedGroups
			
			
			$("#add_item").click(function()				
			{
				
				$('#frmAddItem').submit();

			});

			
		});

function deSelectAll()
{

}

	var selectedItems = new Array();
function attachToItem()
{
	
//	alert (groupsAvailable.length);
}
function getGroups()
{
//	alert (document.getElementById("menu_variant_item_category").value);
	var category_id	;
	category_id	=	$("#menu_variant_item_category").val();

/*$.post('ajax/test.html', function(data) {
  $('.result').html(data);
});
*/	
	$.ajax({ type: "POST", url: "<?=base_url()?>irestaurantvariants/getVariantGroups", data: "category_id="+category_id+"", success: function(variantGroups){ 
	
		if (variantGroups=="No_Record_Found")
		{
			$(".variant_group_name").remove();
			$("#tableVariantGroup").append('<tr class="variant_group_name"><td style="width:93%;">Sorry! No record found</td>               <td></td></tr>');
		}
		else
		{
			var obj = jQuery.parseJSON(variantGroups);
			$(".variant_group_name").remove();
			$.each(obj, function() {
				  //append new row in tableVariantGroup
				  $("#tableVariantGroup").append('<tr class="variant_group_name"><td style="width:93%;">'+this.group_name+'</td>               <td><input name="VariantGroup[]" id="VariantGroup" type="checkbox" value="'+this.id+'" title="'+this.group_name+'" /></td></tr>');
			 });		
		}
	}//end function
	});	
}

</script>
<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function(){

				// Dialog	( Start Delete Popup Window Here )
				$('#add_new_category').dialog({
					autoOpen: false,
					modal: true,
					width: 'auto',fluid:true,responsive: true,
					maxWidth:300,
					height: 180,
					buttons: {
						"Save": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
	
});
</script>
<!-- End Dialog Popups -->

<style type="text/css">

body { background:0px none !important;}

</style>

<?
//	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
$attributes = array('id' => 'frmAddItem','name' => 'frmAddItem');
echo form_open(base_url().'menutimings/addmenutiming/'.$item["id"],$attributes);
?>
<div class="add-item">
	<?
    if (isset($success["msg"]))
    {
    ?>
    <div class="ui-widget">
        <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
            <strong><?=$success["msg"]?></strong></p>
        </div>
    </div>
    <?
    }
    ?>
    <?
    if (isset($errors) && count($errors))
    {
    ?>
    <br/>
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
	//print_r($item);
	$start=$item['start'];
	$weekday=$item['menu_timing_day'];
	$start_arr=explode(":",$start);
	$start_hour=$start_arr[0];
	$start_min=$start_arr[1];

	$end=$item['end'];
	$end_arr=explode(":",$end);
	$end_hour=$end_arr[0];
	$end_min=$end_arr[1];
	
    ?>
<div style="float:left; width:493px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
                Name :            </td>
            <td>
                <input name="item_name" id="item_name" type="text" class="txt-field" style="width:191px;" value="<?=$item["menu_timing_name"]?>" />            </td>
          </tr>
          <tr>
            <td>
                Start Time :            </td>
            <td>
                <select name="start_hour" class="combwd01" style="width:100px; float:left; margin-right:10px;">
                	<option value="00" <? if($start_hour=="00") echo "selected";?>>00:00 hr</option>
                	<option value="01" <? if($start_hour=="01") echo "selected";?>>01:00 hr</option>
                	<option value="02" <? if($start_hour=="02") echo "selected";?>>02:00 hr</option>
                	<option value="03" <? if($start_hour=="03") echo "selected";?>>03:00 hr</option>
                	<option value="04" <? if($start_hour=="04") echo "selected";?>>04:00 hr</option>
                	<option value="05" <? if($start_hour=="05") echo "selected";?>>05:00 hr</option>
                	<option value="06" <? if($start_hour=="06") echo "selected";?>>06:00 hr</option>
                	<option value="07" <? if($start_hour=="07") echo "selected";?>>07:00 hr</option>
                	<option value="08" <? if($start_hour=="08") echo "selected";?>>08:00 hr</option>
                	<option value="09" <? if($start_hour=="09") echo "selected";?>>09:00 hr</option>
                	<option value="10" <? if($start_hour=="10") echo "selected";?>>10:00 hr</option>
                	<option value="11" <? if($start_hour=="11") echo "selected";?>>11:00 hr</option>
                	<option value="12" <? if($start_hour=="12") echo "selected";?>>12:00 hr</option>
                	<option value="13" <? if($start_hour=="13") echo "selected";?>>13:00 hr</option>
                	<option value="14" <? if($start_hour=="14") echo "selected";?>>14:00 hr</option>
                	<option value="15" <? if($start_hour=="15") echo "selected";?>>15:00 hr</option>
                	<option value="16" <? if($start_hour=="16") echo "selected";?>>16:00 hr</option>
                	<option value="17" <? if($start_hour=="17") echo "selected";?>>17:00 hr</option>
                	<option value="18" <? if($start_hour=="18") echo "selected";?>>18:00 hr</option>
                	<option value="19" <? if($start_hour=="19") echo "selected";?>>19:00 hr</option>
                	<option value="20" <? if($start_hour=="20") echo "selected";?>>20:00 hr</option>
                	<option value="21" <? if($start_hour=="21") echo "selected";?>>21:00 hr</option>
                	<option value="22" <? if($start_hour=="22") echo "selected";?>>22:00 hr</option>
                	<option value="23" <? if($start_hour=="23") echo "selected";?>>23:00 hr</option>
                </select>
                <select name="start_min" class="combwd01" style="width:80px;">
                	<option value="00" selected="selected">0 min</option>
                    <option value="15" <? if($start_min=="15") echo "selected";?>>15 min</option>
                	<option value="30" <? if($start_min=="30") echo "selected";?>>30 min</option>
                	<option value="45" <? if($start_min=="45") echo "selected";?>>45 min</option>
                </select>            </td>
          </tr>
          <tr>
            <td>
                End Time :            </td>
            <td>
                <select name="end_hour" class="combwd01" style="width:100px; float:left; margin-right:10px;">
                	<option value="00" <? if($end_hour=="00") echo "selected";?>>00:00 hr</option>
                	<option value="01" <? if($end_hour=="01") echo "selected";?>>01:00 hr</option>
                	<option value="02" <? if($end_hour=="02") echo "selected";?>>02:00 hr</option>
                	<option value="03" <? if($end_hour=="03") echo "selected";?>>03:00 hr</option>
                	<option value="04" <? if($end_hour=="04") echo "selected";?>>04:00 hr</option>
                	<option value="05" <? if($end_hour=="05") echo "selected";?>>05:00 hr</option>
                	<option value="06" <? if($end_hour=="06") echo "selected";?>>06:00 hr</option>
                	<option value="07" <? if($end_hour=="07") echo "selected";?>>07:00 hr</option>
                	<option value="08" <? if($end_hour=="08") echo "selected";?>>08:00 hr</option>
                	<option value="09" <? if($end_hour=="09") echo "selected";?>>09:00 hr</option>
                	<option value="10" <? if($end_hour=="10") echo "selected";?>>10:00 hr</option>
                	<option value="11" <? if($end_hour=="11") echo "selected";?>>11:00 hr</option>
                	<option value="12" <? if($end_hour=="12") echo "selected";?>>12:00 hr</option>
                	<option value="13" <? if($end_hour=="13") echo "selected";?>>13:00 hr</option>
                	<option value="14" <? if($end_hour=="14") echo "selected";?>>14:00 hr</option>
                	<option value="15" <? if($end_hour=="15") echo "selected";?>>15:00 hr</option>
                	<option value="16" <? if($end_hour=="16") echo "selected";?>>16:00 hr</option>
                	<option value="17" <? if($end_hour=="17") echo "selected";?>>17:00 hr</option>
                	<option value="18" <? if($end_hour=="18") echo "selected";?>>18:00 hr</option>
                	<option value="19" <? if($end_hour=="19") echo "selected";?>>19:00 hr</option>
                	<option value="20" <? if($end_hour=="20") echo "selected";?>>20:00 hr</option>
                	<option value="21" <? if($end_hour=="21") echo "selected";?>>21:00 hr</option>
                	<option value="22" <? if($end_hour=="22") echo "selected";?>>22:00 hr</option>
                	<option value="23" <? if($end_hour=="23") echo "selected";?>>23:00 hr</option>
                </select>
                <select name="end_min" class="combwd01" style="width:80px;">
                	<option value="00" selected="selected">0 min</option>
                    <option value="15" <? if($end_min=="15") echo "selected";?>>15 min</option>
                	<option value="30" <? if($end_min=="30") echo "selected";?>>30 min</option>
                	<option value="45" <? if($end_min=="45") echo "selected";?>>45 min</option>
                </select>            </td>
          </tr>
          <tr>
            <td colspan="2">
           
            <table width="480" border="0">
              <tr>
                <td><input type="checkbox" name="weekday[]" value="Monday" <?=($item["monday"] =="Yes")?'checked="checked"':''?>/> Monday</td>
                <td><input type="checkbox" name="weekday[]" value="Tuesday" <?=($item["tuesday"] =="Yes")?'checked="checked"':''?>/> Tuesday</td>
                <td><input type="checkbox" name="weekday[]" value="Wednesday" <?=($item["wednesday"] =="Yes")?'checked="checked"':''?>/> Wednesday</td>
                <td><input type="checkbox" name="weekday[]" value="Thursday" <?=($item["thursday"] =="Yes")?'checked="checked"':''?>/> Thursday</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="weekday[]" value="Friday" <?=($item["friday"] =="Yes")?'checked="checked"':''?>/> Friday</td>
                <td><input type="checkbox" name="weekday[]" value="Saturday" <?=($item["saturday"] =="Yes")?'checked="checked"':''?>/> Saturday</td>
                <td><input type="checkbox" name="weekday[]" value="Sunday" <?=($item["sunday"] =="Yes")?'checked="checked"':''?>/> Sunday</td>
                <td>&nbsp;</td>
              </tr>
              
            </table></td>
            </tr>
          <tr>
            <td></td>
            <td>
                <a href="javascript:void(null);" class="global-link float-left" style="margin-right:5px;" id="add_item">
                <span style="color:#0D73DA !important;">Add</span></a>
                <a href="javascript:void(null)" onclick="parent.closeMenuTiming();" class="global-link float-left">
                <span style="color:#0D73DA !important;">Cancel</span></a>            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>
</div>


</div>
</form>
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
  <tr>
    <td><img src="<?=base_url()?>/images/ajax-loader.gif" alt="loader" /></td>
  </tr>
</table>


