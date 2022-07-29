<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<script language="javascript">
var urladd = '<?= base_url() ?>restaurantitem/managefooditems/';

function refreshItemPage(msg) {
    //refresh item page
    //close item popup
    if (msg == "Added Successfully") {
        document.location.href = urladd + "added";
    } else {
        document.location.href = urladd + "updated";
    }
}

function closeEditItemDialog() {
    $('#dialog-message-edit').dialog('close');
}

function closeItemDialog() {
    $('#dialog-message').dialog('close');
}
var itemId;
var itemName;
var url = '<?= base_url() ?>restaurantitem/addItem/';

function openItem(nItemId) {
    itemId = nItemId;
    var pageFrame = document.getElementById('itemIframe');

    pageFrame.src = url + nItemId;

    //	alert (window.frames[ "itemIframe" ].src);

    //	window.frames[ "itemIframe" ].document;

    $('#dialog-message').dialog('open');
    return false;
}

function openItemEdit(nItemId, nItemName) {
    itemId = nItemId;
    itemName = nItemName;
    $('#newspan_itemName').html(nItemName);
    var pageFrame = document.getElementById('itemIframeEdit');


    pageFrame.src = url + nItemId;

    //	alert (window.frames[ "itemIframe" ].src);

    //	window.frames[ "itemIframe" ].document;

    $('#dialog-message-edit').dialog('open');
    //	 alert ($("div.dialog-message-edit").html());
    return false;
}

/*var addItem	;
function addItems(nItemId)
{
	addItem	=	nItemId;
	$('#add_food_item').dialog('open');
	return false;
}
*/
var disableItem;

function disableItems(nItemId, strItemName) {
    disableItem = nItemId;
    itemName = strItemName;
    $('#newspan_itemNameDis').html(strItemName);
    $('#disable_food_item').dialog('open');
    return false;
}

var activeItem;

function activeItems(nItemId, strItemName) {
    activeItem = nItemId;
    itemName = strItemName;
    $('#newspan_itemNameAct').html(strItemName);
    $('#active_food_item').dialog('open');
    return false;
}

var deleteItem;

function deleteItems(nItemId, strItemName) {
    deleteItem = nItemId;
    itemName = strItemName;
    $('#span_itemName').html(strItemName);
    $('#delete_food_item').dialog('open');
    return false;
}

var addCategory;

function addCategory(nItemId) {
    addCategory = nItemId;
    $('#add_new_category').dialog('open');
    return false;
}
</script>
<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#dialog-message').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300
    });
    $('#dialog-message-edit').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300
    });

    $('#add_food_item').dialog({
        autoOpen: false,
        modal: false,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        buttons: {
            "Save": function() {
                $(this).dialog("close");
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Disable Popup Window Here )
    $('#disable_food_item').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {

                $("#itemName").val(itemName);
                $("#updatestatus").val("Inactive");
                $("#updateid").val(disableItem);

                document.statuschange.submit();

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Active Popup Window Here )
    $('#active_food_item').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {
                $("#itemName").val(itemName);
                $("#updatestatus").val("Active");
                $("#updateid").val(activeItem);

                document.statuschange.submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#delete_food_item').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {
                $("#itemName").val(itemName);
                $("#updatestatus").val("Deleted");
                $("#updateid").val(deleteItem);

                document.statuschange.submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#add_new_category').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        fluid: true,
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
<!-- Start Mid Right -->
<?
   echo form_open(base_url().'restaurantitem/managefooditems',array('id' => 'statuschange','name'=>'statuschange'));
   
   ?>
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
<input type="hidden" name="itemName" id="itemName" />
</form>
<style>
.searchbar_grid form {
    display: flex;
    justify-content: space-between;
}
</style>

<?
$this->load->view("restaurantportal/top_bar");
?>

<div class="title_bar title_bar_adj">
    <h1>Manage Food Items</h1>
</div>
<div class="title_bar ">
    <div class="row align_row">
        <div class="col-sm-12 ">
            <div class="float-right">
                <div class="dropdown d-inline-block mb-2">
                    <button class="btn default_orange_button dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Export and Import
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Export Items</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Import Items</a></li>
                    </ul>
                </div>
                <button type="button" class="btn default_orange_button " onclick="openItem(0)">
                    Add New Item
                </button>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content">
    <?
$this->load->view("restaurantportal/messages");
?>
    <div class="row search_grid">
        <?
         //	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
         $attributes = array('id' => 'frmsearchitem','name' => 'frmsearchitem', 'class' => 'row row-cols-lg-auto g-3 align-items-center');
         echo form_open(base_url().'restaurantitem/managefooditems',$attributes);
         ?>
        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 col-12">
            <div class="show_adj_again">
                <label class="label_show_adj" for="inlineFormSelectPref">Within Category: </label>
                <?= getFoodCategoryDropDown($categorylist, isset($filters["category_id"]) ? $filters["category_id"] : 0, 'class="form-select" ') ?>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 col-md-12 col-sm-12 col-12">
            <div class="show_adj_again">
                <label class="label_show_adj" for="inlineFormSelectPref">By Letter: </label>
                <select name="sortby" class="form-select select_show_width" id="inlineFormSelectPref">
                    <option <?= empty($filters["alphabet"]) ? 'selected="selected"' : '' ?> value="">All</option>
                    <?
							for ($char=0;$char<26;$char++)
							{
									$val	=	chr($char+65);
									$isSelected	=	(isset($filters["alphabet"]) && $filters["alphabet"]	==	$val)?'selected="selected"':'';
							?>
                    <option value="<?= $val ?>" <?= $isSelected ?>><?= $val ?></option>
                    <?
							}
							?>
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-12">
            <div class="show_adj_again">
                <label class="label_show_adj" for="inlineFormSelectPref">Show: </label>
                <select name="status" class="form-select select_show_width" id="inlineFormSelectPref">
                    <option value="All"
                        <?= (isset($filters["status"]) && $filters["status"] == "All") ? 'selected="selected"' : '' ?>>
                        All</option>
                    <option value="Active"
                        <?= (isset($filters["status"]) && $filters["status"] == "Active") ? 'selected="selected"' : '' ?>>
                        Active</option>
                    <option value="Inactive"
                        <?= (isset($filters["status"]) && $filters["status"] == "Inactive") ? 'selected="selected"' : '' ?>>
                        Disable</option>
                </select>
                <button type="submit" class="span_search"><i class="fas fa-search search_icon"></i></button>
            </div>
        </div>

        </form>
    </div>
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive table_layout_auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item Name</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
            $nCount	=	$ncounter;
                        foreach ($items as $item)
            {
            ?>
                        <tr class="<?= ($item["status"] == "Inactive") ? "" : "" ?>">
                            <td align="center"><?= $nCount ?></td>
                            <td><?= $item["item_name"] ?></td>
                            <td><span><?= $item["category_name"] ?></span></td>
                            <td>
                                <div class="btn-group">
                                    <button style=" background-color: #5dcaca; "
                                        class="btn margin_top_stng icon_btn_adj"
                                        onclick="openItemEdit(<?= $item["id"] ?> , '<?= addslashes($item["item_name"]) ?>');"><i
                                            class="fas fa-edit icon_margin"></i> Edit Item</button>
                                    <?
			  if ($item["status"]=="Inactive")
			  {
				?>
                                    <button
                                        onclick="activeItems(<?= $item["id"] ?>, '<?= addslashes($item["item_name"]) ?>');"
                                        class="disable-active btn margin_top_stng icon_btn_adj">Activate</button>

                                    <?
			  }
			  else
			  {
				?>
                                    <button class="btn margin_top_stng icon_btn_adj"
                                        onclick="disableItems(<?= $item["id"] ?>, '<?= addslashes($item["item_name"]) ?>');"><i
                                            class="fa fa-ban icon_margin"></i> Disable</button>
                                    <?
			  }
				?>
                                    <button style="background-color: #F7665E; " class="btn icon_btn_adj"
                                        onclick="deleteItems(<?= $item["id"] ?>, '<?= addslashes($item["item_name"]) ?>');""><i class="
                                        fa fa-trash icon_margin"></i> Delete</button>
                            </td>
            </div>
            </tr>
            <? 
		$nCount++;	
		} 
			?>
            </tbody>
            </table>
        </div>
        <div class="row justify-content-start show_more_row mt-3">
            <div class="col-12">
                <ul class="pagination"><?= $paginationLinks ?></ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- <div class="mid-right">
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
	<br class="clear" />
	<br />
	<div class="itemdrop-list">
		<?
         //	$attributes	=	array("id"=>"frmAddItem","name"=>"frmAddItem")
         $attributes = array('id' => 'frmsearchitem','name' => 'frmsearchitem');
         echo form_open(base_url().'restaurantitem/managefooditems',$attributes);
         ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td style="width:17%;">Within Category:</td>
				<td>
					<?= getFoodCategoryDropDown($categorylist, isset($filters["category_id"]) ? $filters["category_id"] : 0, 'class="combwd01" style="width:200px;"') ?>
				</td>
				<td>By Letter:</td>
				<td>
					<select name="alphabet" class="combwd01" style="width:56px;">
						<option <?= empty($filters["alphabet"]) ? 'selected="selected"' : '' ?> value="">All</option>
						<?
                     for ($char=0;$char<26;$char++)
                     {
                         $val	=	chr($char+65);
                         $isSelected	=	(isset($filters["alphabet"]) && $filters["alphabet"]	==	$val)?'selected="selected"':'';
                     ?>
						<option value="<?= $val ?>" <?= $isSelected ?>><?= $val ?></option>
						<?
                     }
                     ?>
					</select>
				</td>
				<td>Show:</td>
				<td>
					<select name="status" class="combwd01">
						<option value="All" <?= (isset($filters["status"]) && $filters["status"] == "All") ? 'selected="selected"' : '' ?>>All</option>
						<option value="Active" <?= (isset($filters["status"]) && $filters["status"] == "Active") ? 'selected="selected"' : '' ?>>Active</option>
						<option value="Inactive" <?= (isset($filters["status"]) && $filters["status"] == "Inactive") ? 'selected="selected"' : '' ?>>Disable</option>
					</select>
				</td>
				<td style="width:75px;">
					<a href="javascript:void(null);" onclick="document.frmsearchitem.submit();" class="global-link" style="float:right;"><span>Search</span></a>
				</td>
			</tr>
		</table>
		</form>
	</div>
	<div class="ctgry-table">
		<!-- Start Edit Food Item Popup Window Here -->
<div id="dialog-message" title="Create New Food Item">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe allowtransparency="true" frameborder="0" style="background:0px none;" width="350" height="700"
            id="itemIframe" name="itemIframe">
            <script type="text/javascript">
            document.location = "<?= base_url() ?>restaurantitem/addItem";
            </script>
            <noscript>
                Your browser doesn't appear to support frames. Please see the <a
                    href="<?= base_url() ?>restaurantitem/addItem">non-framed version</a> of this page.
            </noscript>
        </iframe>
    </div>
</div>
<div id="dialog-message-edit" title="Edit Food Item">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe allowtransparency="true" frameborder="0" width="350" height="700" style="background:0px none;"
            id="itemIframeEdit" name="itemIframeEdit">
            <script type="text/javascript">
            document.location = "<?= base_url() ?>restaurantitem/addItem";
            </script>
            <noscript>
                Your browser doesn't appear to support frames. Please see the <a
                    href="<?= base_url() ?>restaurantitem/addItem">non-framed version</a> of this page.
            </noscript>
        </iframe>
    </div>
</div>
<div class="modal  fade import_menu_modal" id="importMenuModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <span class="upload_csv_text"> Upload CSV</span>
                        <span class="pic_type_text"> Only JPG,GIF or PNG</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-8 choose_file_col">
                        <div class="inline_form_adj">

                            <label class="file width_mob_adj">
                                <input type="file" class="width_mob_adj custom_file_uploader" name="logo"
                                    aria-label="File browser example">
                                <span class="file-custom span_adj  light_grey_color">Click to Add a Logo</span>
                            </label>
                            <div>
                                <button type="submit" class="btn  upload_btn_adj">Upload</button>
                                <input type="hidden" value="logoupload" name="logoupload" />
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 sample_col">
                        <button type="button" class="btn opr_btn_adj sample_btn ">Download Sample</button>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <p class="light_grey_color"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                            dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Edit Food Item Popup Window Here -->
<div id="add_new_category" title="Create New Category">
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="width:28%;">New Category:</td>
            <td><input name="fld" type="text" class="txt-field" style="width:250px;" /></td>
        </tr>
    </table>
    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
        <tr>
            <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
        </tr>
    </table>
</div>
<!-- End Edit Food Item Popup Window Here -->
<!-- Start Disable Popup Window Here -->
<div id="disable_food_item" title="Disable Food Item">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to disable <span id="newspan_itemNameDis"></span> food item</strong>
    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
        <tr>
            <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
        </tr>
    </table>
</div>
<!-- End Disable Popup Window Here -->
<!-- Start Active Popup Window Here -->
<div id="active_food_item" title="Active Food Item">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Active <span id="newspan_itemNameAct"></span> food item</strong>
    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
        <tr>
            <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
        </tr>
    </table>
</div>
<!-- End Active Popup Window Here -->
<!-- Start Delete Popup Window Here -->
<div id="delete_food_item" title="Delete Food Item">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Delete <span id="span_itemName"></span> food item</strong>
    <table width="100%" border="0" cellspacing="2" cellpadding="0" class="ajax-loader" style="display:none;">
        <tr>
            <td><img src="<?= base_url() ?>/images/ajax-loader.gif" alt="loader" /></td>
        </tr>
    </table>
</div>
<!-- End Delete Popup Window Here -->

</div>

</div>
</div>

<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
   ?>