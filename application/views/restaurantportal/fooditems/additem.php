<link href="<?= base_url() ?>css/style.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="<?= base_url() ?>css/cupertino/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui-1.8.6.custom.min.js"></script>
<style>
  .add-item label,
  .add-item label.form-label {
    font-family: Helvetica;
    font-size: 16px;
    font-weight: normal;
    font-stretch: normal;
    font-style: normal;
    line-height: 1.8;
    letter-spacing: normal;
    color: #575757;
    width: 25%;
    display: inline-block;
  }

  .add-item .col-12 {
    display: block !important;
    width: 100% !important;
    margin: 10px 0 !important;
    float: left !important;
  }

  .select-variant {
    display: block;
    width: 100%;
  }

  .ui-widget-header {
    background: none !important;
    background-color: white !important;
    border: none !important;
  }

  form,
  body {
    box-shadow: none !important;
  }

  .ui-widget-content
  {
    background: white !important;
  }
  .add-item input.txt-field,
  .add-item input.form-control,
  .txtarea,
  .custom-select {
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
  .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default
  {
    background: none !important;
    border-color: transparent !important;
    color: white !important;
    outline: none !important;
    min-height: 20px !important;
    font-size: 18px !important;
    min-width: 30px !important;
    background-color: #f36737 !important;
  }
  button:hover 
  {
    font-weight: normal !important;
  }
  .ui-state-hover
  {
    background: transparent !important;
    border-color: transparent !important;
  }
  .add-item .select-variant {
    margin-top: 20px;
    width: 95%;
  }

  .add-item .btn-primary {
    display: block;
    background-color: #f36737 !important;
    color: white !important;
    justify-content: center !important;
    width: 25% !important;
    display: flex;
    text-align: center;
    min-height: 25px;
    align-items: center;
  }

  .add-item .btn-primary span {
    color: white !important;
    text-align: center;
  }

  .add-item .col-12 {
    padding: 10px 0px;
  }

  .add-item .db-half .btn-primary {
    width: 100% !important;
  }

  .add-item .db-half {
    display: inline-block !important;
    width: 45% !important;
  }

  .item-img {
    text-align: center;
  }

  .item-img img {
    width: 150px;
    border-radius: 31px;
    border: 2px dashed #f36737;
  }
</style>
<script language="javascript">
  var attachedGroups;
  var base_url = '<?= base_url(); ?>';

  function addCategory(nItemId) {
    addCategories = nItemId;
    $('#add_new_category').dialog('open');
    return false;
  }
  var groupsAvailable; <?
  if (isset($success["msg"])) {
    ?>
    var successMgs = '<?= $success["msg"] ?>';

    <?
  } else {
    ?>
    var successMgs = '';

    <?
  } ?>

  if (successMgs != "") {
    var objRef = parent.window;
    objRef.refreshItemPage(successMgs);

  }

  $(document).ready(function() {
    //attachedGroups

    groupsAvailable = attachedGroups.split(',');

    $("#check_all").click(function() {
      $("input[name=VariantGroup[]]").each(function() {
        this.checked = "checked";
      });
    });

    $("#uncheck_all").click(function() {
      $("input[name='VariantGroup[]']").each(function() {
        this.checked = "";
      });
    });


    $("#add_item").click(function() {

      $('#added_group').val(selectedItems.join(','));
      $('#frmAddItem').submit();

    });

    $("#attach_to_item").click(function() {
      $("input[name='VariantGroup[]']:checked").each(function() {



        if (jQuery.inArray($(this).val(), groupsAvailable) == -1) {
          groupsAvailable.push($(this).val());
          selectedItems.push($(this).val());

          $("#selected_food_variants").append('<tr class="attached_groups_' + $(this).val() + '"><td style="width:93%;">' + $(this).attr('title') + '</td><td align="center" style="padding-left:0px;"><a href="javascript:void(null);" onclick="removeGroup(' + $(this).val() + ',' + <?= (isset($item["id"]) ? $item["id"] : 0) ?> + ');"><img src="<?= base_url() ?>/images/delete.png" alt="img" border="0" /></a></td></tr>');

        }

      });
    });

  });

  function deSelectAll() {

  }

  var selectedItems = new Array();

  function attachToItem() {

    //	alert (groupsAvailable.length);
  }

  function getGroups() {
    //	alert (document.getElementById("menu_variant_item_category").value);
    var category_id;
    category_id = $("#menu_variant_item_category").val();

    /*$.post('ajax/test.html', function(data) {
      $('.result').html(data);
    });
    */
    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>irestaurantvariants/getVariantGroups",
      data: "category_id=" + category_id + "",
      success: function(variantGroups) {

        if (variantGroups == "No_Record_Found") {
          $(".variant_group_name").remove();
          $("#tableVariantGroup").append('<tr class="variant_group_name"><td style="width:93%;">Sorry! No record found</td>               <td></td></tr>');
        } else {
          var obj = jQuery.parseJSON(variantGroups);
          $(".variant_group_name").remove();
          $.each(obj, function() {
            //append new row in tableVariantGroup
            $("#tableVariantGroup").append('<tr class="variant_group_name"><td style="width:93%;">' + this.group_name + '</td>               <td><input name="VariantGroup[]" id="VariantGroup" type="checkbox" value="' + this.id + '" title="' + this.group_name + '" /></td></tr>');
          });
        }
      } //end function
    });
  }

  function removeGroup(nGroupId, nItemId) { //	addCategories	=	nItemId;
    var removeGroupId = nGroupId;
    var removeItemId = nItemId;
    //	category_id	=	$("#menu_variant_item_category").val();

    $.ajax({
      type: "POST",
      url: "<?= base_url() ?>restaurantitem/deleteFoodVariant",
      data: {
        varia: removeGroupId,
        varia2: removeItemId
      },
      success: function(response) {
        if (response == 'RECORD_DELETED') {
          //	alert(response);
          $(".attached_groups_" + removeGroupId).remove();

          selectedItems.pop(removeItemId);
          groupsAvailable.pop(removeGroupId);

          //	document.location.href=document.location.href;
        }
        //	else
        //	alert(response);


      }

    });

  }
</script>
<!-- Start Dialog Popups -->
<script type="text/javascript">
  $(function() {

    // Dialog	( Start Delete Popup Window Here )
    $('#add_new_category').dialog({
      autoOpen: false,
      modal: true,
      width: 'auto',responsive: true,
      maxWidth:300,fluid:true,
      height: 180,
      buttons: {
        "Save": function() {
          var Variant = $("#category_name").val();

          $.ajax({
            type: "POST",
            url: base_url + "restaurantitem/addFoodVariant/",
            data: "varia=" + Variant,
            success: function(response) {
              if (response == 'RECORD_ADDED') {
                $("#add_new_category").dialog("close");
                //	alert(response);
                //	document.location.href=document.location.href;
                $.ajax({
                  url: base_url + "restaurantitem/getFoodCategories",
                  success: function(data) {
                    var obj = jQuery.parseJSON(data);

                    //terminal1
                    $('#category_id').find('option').remove();
                    //terminal2

                    $.each(obj, function() {

                      $("#category_id").append('<option value="' + this.id + '" >' + this.category_name + '</option>');

                    });
                  }
                });
                //	alert(response);
                //	$(this).dialog("close"); 
              } else
                alert(response);

            }

          });
        },
        "Cancel": function() {
          $(this).dialog("close");
        }
      }
    });

  });
</script>
<!-- End Dialog Popups -->
<!-- Start Add New Variant Category Window Here -->
<div id="add_new_category" title="Add Category">
  <table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td style="padding-bottom: 10px; width:auto; font-size:12px; padding-top:10px;" colspan="2">
        Create New Food Category
      </td>
    </tr>
    <tr>
      <td>
        <input type="text" value="" name="category_name" id="category_name" style=" padding:3px;" class="txt-field">
        <input type="hidden" value="yes" name="add">
      </td>
      <!--      <td>
            <a onclick="document.categoryform.submit();" class="btn btn-primary" title="Add" href="javascript:void(null);">
               	<span>Add</span>
               </a>
            </td> -->
    </tr>
  </table>
</div>
<!-- End Add New Variant Category Window Here -->
<style type="text/css">
  body {
    background: 0px none !important;
  }
</style>
<?
   //	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
   $attributes = array('id' => 'frmAddItem','name' => 'frmAddItem');
   // echo form_open(base_url().'restaurantitem/addItem/'.$item["id"],$attributes);
   echo form_open_multipart(base_url().'restaurantitem/addItem/'.$item["id"],$attributes);
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

  <div class="row">
    <div class="col-12">
      <div class="row ">
        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="hidden" class="form-control" name="added_group" id="added_group" />
            <input name="item_name" id="item_name" type="text" class="txt-field" value="<?= $item["item_name"] ?>" />
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xl-12 col-12">
          <div class="mb-3">
            <label for="item_image" class="w-100 form-label">Item Image</label>
            <input name="item_image" id="item_image" type="file" class="txt-field" />
          </div>
        </div>
        <?php if (isset($item["item_image"]) && !empty($item["item_image"])) { ?>
            <div class="col-lg-6 col-md-6 col-xl-6 col-12">
                <div class="mb-3 item-img">
                    <img src="<?= base_url() . "uploads/restaurant/menuItems/" . $item["item_image"]; ?>">
                </div>
            </div>
        <?php } ?>
        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <label for="item_price" class="form-label">Start Price</label>
            <input name="item_price" id="item_price" type="text" class="txt-field" value="<?= $item["item_price"] ?>" />
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <?php 
                $food_item_state_tax = 0;
                if (isset($item["item_statetax"]) && !empty($item["item_statetax"])) {
                    $food_item_state_tax = $item["item_statetax"];
                } else if (isset($statetax) && !empty($statetax)) {
                    $food_item_state_tax = $statetax;
                }

            ?>
            <label for="statetax" class="form-label">State Tax (%)</label>
            <input name="statetax" id="statetax" type="text" class="txt-field" value="<?= $food_item_state_tax ?>" />
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <?php 
                $food_item_city_tax = 0;
                if (isset($item["item_citytax"]) && !empty($item["item_citytax"])) {
                    $food_item_city_tax = $item["item_citytax"];
                } else if (isset($citytax) && !empty($citytax)) {
                    $food_item_city_tax = $citytax;
                }

            ?>
            <label for="citytax" class="form-label">City Tax (%)</label>
            <input name="citytax" id="citytax" type="text" class="txt-field" value="<?= $food_item_city_tax ?>" />
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xl-12 col-12">
          <div class="mb-3">
            <label for="item_description" class="w-100 form-label">Item Description
              <span class="font11 font-red">Max 250 Character</span>
            </label>
            <textarea name="item_description" id="item_description" cols="5" rows="5" class="w-100 txtarea"><?= $item["item_description"] ?></textarea>
          </div>
        </div>

        <!-- <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <label for="serve_type" class="form-label">Served:</label>
            <input name="serve_type" type="radio" value="Hot" <?= ($item["serve_type"]  ==  "Hot" || empty($item["serve_type"])) ? 'checked="checked"' : '' ?> /> Hot
            <input name="serve_type" type="radio" value="Cold" <?= ($item["serve_type"]  ==  "Cold") ? 'checked="checked"' : '' ?> /> Cold
          </div>
        </div> -->

        <!-- <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <input type="hidden" name="travelable" value="No" />
            <label for="travelable" class="form-label">Travelable:</label>
            <input name="travelable" type="checkbox" value="Yes" <?= ($item["travelable"]  ==  "Yes") ? 'checked="checked"' : '' ?> /> Yes
          </div>
        </div> -->

        <!-- <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <input type="hidden" name="liquid_contain" value="No" />
            <label for="liquid_contain" class="form-label">Liquid Contains:</label>
            <input name="liquid_contain" type="checkbox" value="Yes" <?= ($item["liquid_contain"]  ==  "Yes") ? 'checked="checked"' : '' ?> /> Yes
          </div>
        </div> -->

        <!-- <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <label for="travelable" class="form-label">Basic Taste:</label>
            <input name="basic_taste" type="radio" value="Spicy" <?= ($item["basic_taste"]  ==  "Spicy") || empty($item["basic_taste"]) ? 'checked="checked"' : '' ?> /> Spicy
            <input name="basic_taste" type="radio" value="Salty" <?= ($item["basic_taste"]  ==  "Salty") ? 'checked="checked"' : '' ?> /> Salty
            <input name="basic_taste" type="radio" value="Sweet" <?= ($item["basic_taste"]  ==  "Sweet") ? 'checked="checked"' : '' ?> /> Sweet
            <input name="basic_taste" type="radio" value="Sour" <?= ($item["basic_taste"]  ==  "Sour") ? 'checked="checked"' : '' ?> /> Sour
          </div>
        </div> -->

        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <label class="form-label">Food Category:</label>
            <?= getFoodCategoryDropDown($categorylist, $item["category_id"], 'class="custom-select "') ?>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 col-12">
          <div class="mb-3">
            <a href="javascript:void(null);" onclick="addCategory(0);" class="btn btn-primary" style="width:90% !important; background-color: #5dcaca !important;">
              <span>Add New Food Category</span></a>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xl-12 col-12 db">
          <div class="mb-3">
            <label for="menu_variant_item_category" class="form-label">Available Food Variants:</label>
            <?= getVariantItemCategory($menu_item_variant_category, !empty($selected["menu_item_variant_category"]) ? $selected["menu_item_variant_category"] : '', 'class="custom-select "  id="menu_variant_item_category" onchange="getGroups();"') ?>
          </div>
          <div class="select-variant w-100">
						<table width="100%" border="0" cellspacing="2" cellpadding="0" id="tableVariantGroup">
            </table>
					</div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 col-12 db-half">
          <div class="mb-3">
            <a href="javascript:void(null);" id="check_all">Select All / </a>
            <a href="javascript:void(null);" id="uncheck_all">Deselect</a>
          </div>
        </div>

        <div class="col-lg-6 col-md-6 col-xl-6 col-12 db-half">
          <div class="mb-3">
            <a href="javascript:void(null);" class="btn btn-primary" id="attach_to_item" style="background-color: #5dcaca !important;">
              <span>Attach to Item</span></a>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xl-12 col-12">
          <div class="mb-3">
						<label for="" class="form-label">Selected Food Variants:</label>
						<div id="selected_food_variants">
						<?
                        //	print_r($menu_item_variant);
                        //	print_r($attached_variant_groups);
                        //	echo $item["id"];
													$groupIds	=	array();
													           foreach ($attached_variant_groups as $variantGroupDetail)
                        	{
                        		$variantGroup	=	$variantGroupDetail["GroupDetail"];
                        		$groupIds[]	=	$variantGroup["id"];
                        	?>
            <div class="attached_groups_<?= $variantGroup["id"] ?>" style="display:flex;justify-content:space-between;width:95%;">
              <p style="" id="variantGroupName"><?= $variantGroup["group_name"] ?></p>
              <p align="center" style="padding-left:0px;">
                <a href="javascript:void(null);" onclick="removeGroup(<?= $variantGroup["id"] ?>,<?= $item["id"] ?>);"><img src="<?= base_url() ?>/images/delete.png" alt="img" border="0" /></a>
              </p>
            </div>
            <?
                        }
                        $attachedGroups	=	implode(",",$groupIds)
												?>
												</div>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xl-12 col-12">
          <div class="mb-3">
            <a href="javascript:void(null);" class="btn btn-primary float-left" style="margin-right:5px;" id="add_item">
              <?
                  if(!empty($type) && $type == "edit")
                  {
                  ?><span>Update</span>
            </a>
            <a href="javascript:void(null)" onclick="parent.closeEditItemDialog();" class="btn btn-primary float-left">
              <span>Cancel</span></a>
            <?
                  }
                  else
                  {
                  ?>
            <span>Add Item</span></a>
            <a href="javascript:void(null)" onclick="parent.closeItemDialog();" class="btn btn-primary float-left" style="background-color: #d6d5d5 !important;">
              <span>Cancel</span></a>
            <?
                  }
                  ?>
          </div>
        </div>

        <!-- <div class="col-lg-12 col-12">
          <div class="mb-0">
            <a href="javascript:void(null);" class="btn btn-primary float-left" style="margin-right:5px;" id="add_item">
              <?
                  if(!empty($type) && $type == "edit")
                  {
                  ?><span >Update</span>
            </a>
            <a href="javascript:void(null)" onclick="parent.closeEditItemDialog();" class="btn btn-primary float-left">
              <span >Cancel</span></a>
            <?
                  }
                  else
                  {
                  ?>
            <span >Add Item</span></a>
            <a href="javascript:void(null)" onclick="parent.closeItemDialog();" class="btn btn-primary float-left">
              <span >Cancel</span></a>
            <?
                  }
                  ?>
          </div>
        </div> -->

      </div>
    </div>
  </div>


</div>
</form>
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
  <tr>
    <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
  </tr>
</table>
<script language="javascript">
  attachedGroups = '<?= $attachedGroups ?>';
</script>
