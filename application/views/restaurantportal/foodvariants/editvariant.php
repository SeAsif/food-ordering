<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<style>
  form,
  body {
    box-shadow: none !important;
  }

  input.txt-field,
  input.form-control,
  .txtarea,
  .custom-select,
  select {
    display: inline-block;
    width: 70%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }
  a.global-link span
  {
    background-image:none !important;
    color: white !important;
  }
  a img
  {
    display:none !important;
  }
  a.global-link {
    background: none !important;
    border-color: transparent !important;
    color: white !important;
    outline: none !important;
    min-height: 30px !important;
    border-radius:5px !important;
    font-size: 15px !important;
    min-width: 30px !important;
    background-color: #f36737 !important;
  }
</style>
<style type="text/css">
  body {
    background: 0px none !important;
  }
</style>
<script language="javascript">
  <?
  if (isset($success["msg"])) {
    ?>
    var successMgs = '<?= $success["msg"] ?>';

    <?
  } else {
    ?>
    var successMgs = '';

    <?
	} 
	?>
  var base_url = '<?= base_url(); ?>';

  var varientItemCount = '<?= $variantitem_count ?>';
  $(document).ready(function() {

    if (successMgs != "") {
      var objRef = parent.window;
      objRef.refreshItemPage(successMgs);

    }


    $("#add_variant").click(function() {

      $('#frmAddVariant').submit();

    });
    $("#add_more").click(function() {
      varientItemCount = parseInt($("#variant_totalcount").val()) + 1;
      //				alert (varientItemCount);


      $('#varaint_item_list').append('<tr><td><span>Name:</span></td><td><input name="variant_name' + varientItemCount + '" type="text" class="txt-field" style="width:100px;" value="" /></td><td><span class="font11">Add Price ₦</span></td><td><input name="price' + varientItemCount + '" type="text" class="txt-field" style="width:50px;" value="" /></td><td><span class="font10">e.g:0.51 or 1</span></td><td><span class="font10" style="color:#d54343 !important;">Note Leave empty if none</span></td><td><i class="fas fa-times-circle fa-2x delete-choice" style="color:#f36737 !important;cursor:pointer"></i></td></tr>');

      $("#variant_totalcount").val(varientItemCount);

		});
		$(".delete-choice").live("click",function() {
			$(this).parent().parent().remove();
		});
		

  });
</script>

<style>
      .ui-widget-header
      {
         background: white !important;
         border-color: transparent !important;
      }
      .ui-widget-content
      {
        background: white !important;
      }
      .ui-state-hover span{
    font-weight:normal !important;
}
      .ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
    background: none !important;
    border-color: transparent !important;
    color: white !important;
    outline: none !important;
    min-height: 20px !important;
    font-size: 16px !important;
    min-width: 30px !important;
    background-color: #f36737 !important;
}
      input
      {
    display: inline-block;
    width: 70%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }
   </style>
<script language="javascript">
  function addVariants(nItemId) {
    addVariant = nItemId;
    itemId = nItemId;

    $('#add_food_variant').dialog('open');
    return false;
  }
</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
  $(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#add_food_variant').dialog({
      autoOpen: false,
      modal: true,
      width: 300,

      buttons: {
        "Save": function() {
          //$(this).dialog("close"); 
          var Variant = $("#category_name").val();
          //$("#variant").val(Variant);
          $.ajax({
            type: "POST",
            url: base_url + "restaurantvariant/addCategoryVariant/",
            data: "varia=" + Variant,
            success: function(response) {
              if (response == 'RECORD_ADDED') {

                document.location.href = document.location.href;
                /*refresh category dropdown*/
                /*$.ajax({
                	url: base_url+"irestaurant/listTerminals/"+airportId,
                	success: function( data ) 
                	{
                		var obj = jQuery.parseJSON(data);
                		//terminal1
                		$('#terminal') .find('option') .remove() ;
                		//terminal2
                		$.each(obj, function() 
                		{
                			  $("#terminal").append('<option value="'+this.id+'" >'+this.terminal_name+'</option>');
                			  
                		});				
                	}
                });*/

                /////////////////////////////
                //	$('#add_food_variant').dialog('close');
              }



            }

          });
          /*							$.ajax({
          									url: base_url+"restaurantvariant/addCategoryVariant/"+Variant,
          									success: function( data ) 
          									{
          										if (data == added)
          										{
          											alert "added";
          										}
          												
          									}
          								});		*/
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
      /*
      function(){ 
      		var Variant=$("#category_name").val();
      		$("#variant").val(Variant);
      		$.ajax({
      				url: base_url+"restaurantvariant/addCategoryVariant/"+Variant,
      				success: function( data ) 
      				{
      					if (data == added)
      					{
      						alert "added";
      					}
      							
      				}
      			});
      		
      }*/
    });

  });
</script>
<!-- End Dialog Popups -->


<!-- Start Add New Variant Category Window Here -->
<div id="add_food_variant" title="Add Variant">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td style="padding-bottom: 10px; width: 596px; font-size:12px; padding-top:10px;" colspan="2">
        Create New Variant Category
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" value="" name="category_name" id="category_name" style="width:200px; padding:3px;" class="txt-field01">
        <input type="hidden" value="yes" name="add">
      </td>
      <!--      <td>
        	<a onclick="document.categoryform.submit();" class="global-link" title="Add" href="javascript:void(null);">
            	<span>Add</span>
            </a>
        </td> -->
    </tr>
  </table>
</div>
<!-- End Add New Variant Category Window Here -->


<?
//	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
$attributes = array('id' => 'frmAddVariant','name' => 'frmAddVariant');
echo form_open(base_url().'restaurantvariant/editvariant/'.$variantGroup["id"],$attributes);
?>

<div class="add-item">
  <?
    if (isset($success["msg"]))
    {
    ?>
  <div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
      <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
        <strong><?= $success["msg"] ?></strong>
      </p>
    </div>
  </div>
  <?
    }
    ?>
  <?
    if (isset($errors) && count($errors))
    {
    ?>
  <br />
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
    ?>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td style="padding-top:14px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><strong>Variant Group Title:</strong></td>
            <td><input name="group_name" id="group_name" type="text" class="txt-field" value="<?= $variantGroup["group_name"] ?>" /></td>
          </tr>
          <tr>
            <td style="padding-top:10px;"><strong>Variant Group Category:</strong></td>
            <td style="padding-top:10px;">
              <?= getFoodCategoryDropDown($categorylist, $variantGroup["category_id"], 'class="combwd01" style="width:228px; float:left; margin-right:10px;"') ?>
              <a href="javascript:void(null);" onclick="addVariants(0);" class="global-link float-left">
                <span>Add</span>
              </a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><strong>Type:</strong></td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
                <tr>
                  <td><input name="selection" type="radio" value="multiple" <?= ($variantGroup["selection"] == "multiple" || $variantGroup["selection"] == "") ? 'checked="checked"' : '' ?> /></td>
                  <td>Multiple Choice</td>
                  <td>
                    <a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
                  </td>
                </tr>
              </table>
            </td>
            <td>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add-variant">
                <tr>
                  <td><input name="selection" type="radio" value="single" <?= ($variantGroup["selection"] == "single") ? 'checked="checked"' : '' ?> /></td>
                  <td>Single Choice</td>
                  <td>
                    <a href="#"><img src="<?= base_url() ?>images/Q-mark.png" alt="mark" border="0" /></a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding:10px 0px 10px 0px;">
				<table width="40%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:10px;">
          <tr>
            <td><strong>Required:</strong></td>
            <td style="padding-right:0px;"><input name="required" type="radio" value="Yes" <?= ($variantGroup["required"] == "Yes") ? 'checked="checked"' : '' ?> /></td>
            <td>Yes</td>
            <td style="padding-right:0px;"><input name="required" type="radio" value="No" <?= ($variantGroup["required"] == "No") ? 'checked="checked"' : '' ?> /></td>
            <td>No</td>
          </tr>
        </table>
        <div class="choice-wrap">
          <h2>Defining Multiple Choice Variant Group</h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" id="varaint_item_list" style="margin-bottom:15px;">
            <?
					$nCount	=	0;
                    foreach ($variantItems as $variantItem)
					{
					  $nCount++;
					?>
            <tr>
              <td><span>Name:</span></td>
              <td>
                <input name="variant_name<?= $nCount ?>" type="text" class="txt-field" style="width:100px;" value="<?= $variantItem["name"] ?>" />
              </td>
              <td><span class="font11">Add Price ₦</span></td>
              <td>
                <input name="price<?= $nCount ?>" type="text" class="txt-field" style="width:50px;" value="<?= $variantItem["price"] ?>" />
                <input name="variant_id<?= $nCount ?>" type="hidden" value="<?= $variantItem["id"] ?>" />
              </td>
              <td><span class="font10">e.g:0.51 or 1</span></td>
              <td><span class="font10" style="color:#d54343 !important;">Note Leave empty if none</span></td>
							<td><i class="fas fa-times-circle fa-2x delete-choice" style="color:#f36737 !important;cursor:pointer"></i></td>
						</tr>
            <?
                  	}
				  ?>

            <tr>
              <td colspan="6" style="padding:0px;"><input name="variant_totalcount" id="variant_totalcount" type="hidden" class="txt-field" style="width:50px;" value="<?= $nCount ?>" /></td>
            </tr>
          </table>
          <a href="javascript:void(null);" class="global-link float-left" style="margin-right:10px;" id="add_more"><span>Add More</span></a>

        </div>
        
      </td>
    </tr>
    <tr>
      <td style="padding:10px 0px 0px 0px;">
        <a href="javascript:void(null);" id="add_variant" class="global-link float-left" style="margin-right:5px;">
          <span>Save</span></a>
        <a href="javascript:void(null)" onclick="parent.closeAddVariant();" class="global-link float-left">
          <span>Cancel</span></a>
      </td>
    </tr>
  </table>
</div>
</form>
