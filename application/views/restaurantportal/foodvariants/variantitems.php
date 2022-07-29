<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>

<script language="javascript">
var urladd = '<?= base_url() ?>restaurantvariant/variantitems/';

function refreshItemPage(msg) {
    //refresh item page
    //close item popup
    if (msg == "Added Successfully") {
        document.location.href = urladd + "added";
    } else {
        document.location.href = urladd + "updated";
    }
}

var variantItem;
var editVariant;
var url = '<?= base_url() ?>restaurantvariant/editvariant/';

function editVariants(nItemId) {
    editVariant = nItemId;
    itemId = nItemId;
    var pageFrame = document.getElementById('variantitemIframe');

    pageFrame.src = url + nItemId;

    $('#edit_food_variant').dialog('open');
    return false;
}

var viewVariant;
var viewFrame = '<?= base_url() ?>restaurantvariant/viewvariant/';

function viewVariants(nItemId) {
    viewVariant = nItemId;

    var pageFrame = document.getElementById('variantitemviewIframe');

    pageFrame.src = viewFrame + nItemId;

    $('#view_food_variant').dialog('open');
    return false;
}

var disableVariant;

function disableVariants(nItemId, strvariantItem, type) {
    if (type == undefined) {
        $('#disable_food_variant_text').html("Disable");
        disableType = "Inactive";
    } else {
        $('#disable_food_variant_text').html("Activate");
        disableType = "Active";
    }
    $('#newspan_variantName').html(strvariantItem);
    variantItem = strvariantItem;
    disableVariant = nItemId;
    $('#disable_food_variant').dialog('open');
    return false;

}

var deleteVariant;

function deleteVariants(nItemId, strvariantItem) {
    deleteVariant = nItemId;
    variantItem = strvariantItem;
    $('#span_variantName').html(strvariantItem);
    $('#delete_food_variant').dialog('open');
    return false;
}
</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#edit_food_variant').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
    });

    // Dialog	( Start Edit Variant Popup Window Here )
    $('#view_food_variant').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
    });

    // Dialog	( Start Disable Popup Window Here )
    $('#disable_food_variant').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {

                $("#variantgroupname").val(variantItem);
                $("#updatestatus").val(disableType);
                $("#updateid").val(disableVariant);

                document.statuschange.submit();

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#delete_food_variant').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {
                $("#variantgroupname").val(variantItem);
                $("#updatestatus").val("Deleted");
                $("#updateid").val(deleteVariant);
                document.statuschange.submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    //hover states on the static widgets
    $('#dialog_link, ul#icons li').hover(
        function() {
            $(this).addClass('ui-state-hover');
        },
        function() {
            $(this).removeClass('ui-state-hover');
        }
    );

});

function closeAddVariant() {
    $('#edit_food_variant').dialog('close');
}

function closeViewVariant() {
    $('#view_food_variant').dialog('close');
}
</script>
<!-- End Dialog Popups -->

<?
			echo form_open(base_url().'restaurantvariant/variantitems',array('id' => 'statuschange','name'=>'statuschange'));

?>
<input type="hidden" name="variantgroupname" id="variantgroupname" />
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
</form>
<!-- Start Delete Popup Window Here -->


<!-- Start Edit Variant Popup Window Here -->
<div id="edit_food_variant" title="Create New Variant Or Edit Variant">
    <iframe allowtransparency="true" frameborder="0" width="580" height="486" style="background:0px none;"
        id="variantitemIframe"></iframe>
</div>
<!-- End Edit Variant Popup Window Here -->

<!-- Start View Variant Popup Window Here -->
<div id="view_food_variant" title="View Variant Detail">
    <iframe allowtransparency="true" frameborder="0" width="553" height="151" style="background:0px none;"
        id="variantitemviewIframe"></iframe>
</div>
<!-- End View Variant Popup Window Here -->

<!-- Start Disable Popup Window Here -->
<div id="disable_food_variant" title="Disable Food Variant">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to <span id="disable_food_variant_text"></span> <span id="newspan_variantName"></span> food
        Variant</strong>
</div>
<!-- End Disable Popup Window Here -->

<!-- Start Delete Popup Window Here -->
<div id="delete_food_variant" title="Delete Food Variant">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Delete <span id="span_variantName"></span> food Variant</strong>
</div>
<!-- End Delete Popup Window Here -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<!-- <div class="title_bar flex-columns">
    <h1>Manage Food Variants</h1>
    <a href="javascript:void(null);" onclick="editVariants(0);" class="btn new_btn_adj margin_top_stng float-right">
        <span>Add New Variant</span>
    </a>
</div> -->
<div class="row title_bar">
    <div class="col-sm-12 col-md-8 col-lg-9">
        <h1>Manage Food Variants</h1>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-3">
        <a href="javascript:void(null);" onclick="editVariants(0);" class="btn new_btn_adj margin_top_stng float-right">
            <span>Add New Variant</span>
        </a>
    </div>
</div>
<div class="title_bar content">
    <?
$this->load->view("restaurantportal/messages");
?>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <div id="exTab1" class="">
                <ul class="nav nav-tabs">
                    <li class="active li_variants_adj nav-item">
                        <a href="<?= base_url() . "restaurantvariant/variantitems" ?>"
                            class="nav-link padding_li">Current Food Variants (<?= $totalcount ?>)</a>
                    </li>
                    <li class="li_variants_adj nav-item">
                        <a href="<?= base_url() . "restaurantvariant/variantcategories" ?>"
                            class="nav-link padding_li">Manage Variant Categories</a>
                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="card ">
                            <div class="card-body p-4">
                                <form action="<?php echo base_url('restaurantvariant/variantitems'); ?>"
                                    id="frmsearchitem" name="frmsearchitem" method="post" accept-charset="utf-8">
                                    <div class="row mb-4">
                                        <div class="col-md-12 col-lg-6 col-xl-6 col-12 dis_flex_desktop">
                                            <div class="show_adj_again usetflex">
                                                <label class="label_show_adj" for="inlineFormSelectPref">Current
                                                    Categories: </label>
                                                <?= getFoodCategoryDropDown($categorylist, $filters["category_id"], 'class="form-select mb-0 custom-select select_category_width" style="width:200px;"') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-6 col-12">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="show_adj_again">
                                                        <label class="label_show_adj" for="inlineFormSelectPref">By
                                                            Letter: </label>
                                                        <select name="alphabet" class="form-select select_show_width"
                                                            style="width:56px;">
                                                            <option
                                                                <?php echo ($filters["alphabet"] == "") ? 'selected="selected"' : ''; ?>
                                                                value="">All</option>
                                                            <?php
                                             for ($char = 0; $char < 26; $char++) {
                                                $val    =   chr($char + 65);
                                                $isSelected =   ($filters["alphabet"]   ==  $val) ? 'selected="selected"' : '';
                                             ?>
                                                            <option value="<?= $val ?>" <?php echo $isSelected; ?>>
                                                                <?php echo $val; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                                                    <div class="show_adj_again">
                                                        <label class="label_show_adj" for="inlineFormSelectPref">Show:
                                                        </label>
                                                        <select name="status" class="form-select select_show_width"
                                                            id="inlineFormSelectPref">
                                                            <option value="All"
                                                                <?= ($filters["status"] == "All") ? 'selected="selected"' : '' ?>>
                                                                All</option>
                                                            <option value="Active"
                                                                <?= ($filters["status"] == "Active") ? 'selected="selected"' : '' ?>>
                                                                Active</option>
                                                            <option value="Inactive"
                                                                <?= ($filters["status"] == "Inactive") ? 'selected="selected"' : '' ?>>
                                                                Disable</option>
                                                        </select>
                                                        <!-- <span class="span_search" ><i class="fas fa-search search_icon"></i></span> -->
                                                        <a href="javascript:void(null);"
                                                            onclick="document.frmsearchitem.submit();"><span
                                                                class="span_search"><i
                                                                    class="fas fa-search search_icon"></i></span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-12">
                                    <div class="table-responsive variant_fixed_table">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Variant Name</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($variants as $key => $variant) { ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $variant["group_name"]; ?></td>
                                                    <td><?php echo $variant["category_name"]; ?></td>
                                                    <td><?php echo $variant["selection"]; ?></td>
                                                    <td class="btn_style_setting">
                                                        <a href="javascript:void(null);"
                                                            onclick="editVariants(<?= $variant["id"] ?>);"
                                                            style=" background-color: #5dcaca; "
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fas fa-edit icon_margin"></i> Edit Variant</a>
                                                        <a href="javascript:void(null);"
                                                            onclick="viewVariants(<?= $variant["id"] ?>);"
                                                            style="background-color: #428BCA; "
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-eye icon_margin"></i> View Variant</a>
                                                        <?php if ($variant["status"]  ==  "Inactive") { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableVariants(<?= $variant["id"] ?>,'<?= $variant["group_name"] ?>','Activate');"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-check" aria-hidden="true"></i> Activate</a>
                                                        <?php } else { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableVariants(<?= $variant["id"] ?>,'<?= $variant["group_name"] ?>');"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-ban"></i> Disable</a>
                                                        <?php } ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="deleteVariants(<?= $variant["id"] ?>, '<?= $variant["group_name"] ?>');"
                                                            style="background-color: #F7665E;"
                                                            class="btn btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-trash icon_margin "></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="inline_flex_adj">
                                            <div class="show_rows_adj">
                                                <ul class="pagination"><?= $paginationLinks ?></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?
$this->load->view("restaurantportal/footer_view");
?>