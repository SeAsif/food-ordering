<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>

<style>
.txt-field {
    width: 216px;
    padding: 5px;
}

.add-item td a {
    color: #362b36;
}

select.fontawesome-select,
.fontawesome-select option,
.fontawesome-icon {
    font-family: "Font Awesome 5 Pro";
}

.fontawesome-select option {
    font-size: 25px;
}
</style>
<script language="javascript">
var categoryName;
var renameVariant;

function renameCategory(nId) {
    viewVariant = nId;

    $.ajax({
        type: "POST",
        url: "<?= base_url() ?>restaurantcategory/getMenuCategoryById",
        data: "category_id=" + nId + "",
        success: function(variantCategory) {

            if (variantCategory == "No_Record_Found") {
                alert("Sorry! No record found");
            } else {
                var obj = jQuery.parseJSON(variantCategory);
                $("#category_name").val(obj.category_name);
                $("#category_icon").val(obj.category_icon);
                $("#sort_index").val(obj.sort_index);
                $("#id").val(obj.id);
                $('#rename_food_category').dialog('open');


            }
        } //end function
    });

    return false;
}

var deleteCat;

function deleteCategory(nItemId, strCategoryName) {
    categoryName = strCategoryName;
    deleteCat = nItemId;
    //	document.getElementById('delete_category').value=strCategoryName;
    //	alert(categoryName);

    $('#span_categoryName').html(categoryName);
    $('#delete_category').dialog('open');
    return false;
}
var disableCat;
var disableType;

function disableCategory(nItemId, strCategoryName, type) {
    categoryName = strCategoryName;
    if (type == undefined) {
        $('#disable_category_text').html("Disable");
        disableType = "Inactive";
    } else {
        $('#disable_category_text').html("Activate");
        disableType = "Active";
    }
    disableCat = nItemId;
    $('#newspan_categoryName').html(strCategoryName);
    $('#disable_category').dialog('open');
    return false;
}
</script>
<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#rename_food_category').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#delete_category').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        responsive: true,
        fluid: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {
                $("#categoryName").val(categoryName);
                $("#updatestatus").val("Deleted");
                $("#updateid").val(deleteCat);
                document.statuschange.submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#disable_category').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        fluid: true,
        height: 180,
        buttons: {
            "Yes": function() {

                $("#categoryName").val(categoryName);
                $("#updatestatus").val(disableType);
                $("#updateid").val(disableCat);

                document.statuschange.submit();
            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

});
</script>
<!-- End Dialog Popups -->
<?
   echo form_open(base_url().'restaurantcategory/managefoodcategories',array('id' => 'statuschange','name'=>'statuschange'));
   
   ?>
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
<input type="hidden" name="categoryName" id="categoryName" />
</form>
<!-- Start Delete Popup Window Here -->
<div id="delete_category" title="Delete Category" style="display:none">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Delete <span id="span_categoryName"></span> category?</strong>
</div>
<!-- End Delete Popup Window Here -->
<!-- Start Disable Popup Window Here -->
<div id="disable_category" title="Disable Category" style="display:none">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to <span id="disable_category_text"></span> <span id="newspan_categoryName"></span>
        category?</strong>
</div>
<!-- End Disable Popup Window Here -->
<!-- Start Rename Popup Window Here -->
<div id="rename_food_category" title="Rename Food Category" style="display:none">
    <div class="add-item">
        <?
         echo form_open(base_url().'restaurantcategory/managefoodcategories',array('id' => 'categoryformedit','name'=>'categoryformedit', 'enctype' => "multipart/form-data"));
         
         ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width:33%;">Rename Variant Category:</td>
                <td><input name="category_name" id="category_name" type="text" class="txt-field"
                        style="width:365px;" /><input name="id" id="id" type="hidden" class="txt-field"
                        style="width:365px;" /><input type="hidden" name="add" value="yes" /></td>
            </tr>
            <tr>
                <td style="width:33%;">Change Category Image:</td>
                <td>
                    <label class="file width_mob_adj">

                        <input type="file" class="width_mob_adj form-control" name="category_icon" id="upload_banner2"
                            aria-label="File browser" onchange="check_banner_image('upload_banner2')">
                        <!-- <span class="file-custom span_adj" id="name_upload_banner2">Choose file</span> -->
                    </label>
                </td>
            </tr>
            <tr>
                <td style="width:33%;">Change Sort Index:</td>
                <td>
                    <input placeholder="Sort Index" type="number" class="form-control" name="sort_index"
                        value="<?= !empty($category["sort_index"]) ? $category["sort_index"] : '' ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href="javascript:void(null);" class="orange_btn btn text-white float-left"
                        style="margin-right:10px;" onclick="document.categoryformedit.submit();"><span>Save</span></a>
                    <a href="javascript:void(null)" onclick="$('#rename_food_category').dialog('close');"
                        class="btn modal_btn_width modal_btn_two float-left"><span>Cancel</span></a>
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>
<!-- End Rename Popup Window Here -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar">
    <h1>Manage Food Categories</h1>
</div>
<div class="title_bar content">
    <?
$this->load->view("restaurantportal/messages");
?>
    <div class="card card_width p-4">
        <div class="card-body">
            <h5 class="font_family">Create New Category</h5>
            <form action="<?= base_url() ?>restaurantcategory/managefoodcategories" method="POST"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 col-sm-6 mb-2">
                        <input type="text" class="form-control" name="category_name"
                            value="<?= !empty($category["category_name"]) ? $category["category_name"] : '' ?>">
                        <input type="hidden" name="add" value="yes" />
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 col-12 col-sm-6 mb-2">
                        <label class="file width_mob_adj w-100">
                            <input type="file" class="width_mob_adj w-100" name="category_icon" id="upload_banner"
                                aria-label="File browser" onchange="check_banner_image('upload_banner')">
                            <span class="file-custom span_adj" id="name_upload_banner">Choose file</span>
                        </label>
                    </div>
                    <div class="col-md-6 col-lg-2 col-xl-2 col-12 col-sm-6 mb-2">
                        <input placeholder="Sort Index" type="number" class="form-control" name="sort_index"
                            value="<?= !empty($category["sort_index"]) ? $category["sort_index"] : '' ?>">
                    </div>
                    <div class="col-md-6 col-lg-2 col-xl-2 col-12 col-sm-6 mb-2">
                        <input type="submit" class="btn  new_btn_adj w-100 margin_top_stng" value="Add"
                            style="width: 100% !important;">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="title_bar content">
    <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-6 col-12">
            <h5 class="font_family">Current Categories</h5>
        </div>
        <div class="col-md-12 col-lg-8 col-xl-6 col-12">
            <form action="<?= base_url() ?>restaurantcategory/managefoodcategories" method="POST"
                class="row row-cols-lg-auto g-3 align-items-center">
                <div class="row w-100 pt-3">
                    <div class="col-12 col-xl-5 col-md-6 col-lg-6 col-sm-12">
                        <div class="show_adj_again">
                            <label class="label_show_adj" for="inlineFormSelectPref">Show: </label>
                            <select name="status" class="form-select select_show_width" id="inlineFormSelectPref">
                                <option value="All"
                                    <?= ($categoriesfilter["status"] == "All") ? 'selected="selected"' : '' ?>>All
                                </option>
                                <option value="Active"
                                    <?= ($categoriesfilter["status"] == "Active") ? 'selected="selected"' : '' ?>>Active
                                </option>
                                <option value="Inactive"
                                    <?= ($categoriesfilter["status"] == "Inactive") ? 'selected="selected"' : '' ?>>
                                    Disable</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-xl-7 col-md-6 col-lg-6 col-sm-12">
                        <div class="show_adj_again">
                            <label class="label_show_adj" for="inlineFormSelectPref">Sort By: </label>
                            <select name="sortby" class="form-select select_show_width" id="inlineFormSelectPref">
                                <option value="category_name"
                                    <?= ($categoriesfilter["sortby"] == "category_name") ? 'selected="selected"' : '' ?>>
                                    Name</option>
                                <option value="stamp desc"
                                    <?= ($categoriesfilter["sortby"] == "stamp desc") ? 'selected="selected"' : '' ?>>
                                    Latest</option>
                                <option value="stamp asc"
                                    <?= ($categoriesfilter["sortby"] == "stamp asc") ? 'selected="selected"' : '' ?>>
                                    Oldest</option>
                                <option value="sort_index asc"
                                    <?= ($categoriesfilter["sortby"] == "sort_index asc") ? 'selected="selected"' : '' ?>>
                                    Sort Index</option>
                            </select>
                            <button type="submit" class="span_search"><i class="fas fa-search search_icon"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="title_bar content operational_hours">
        <div class="card card_width ">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table_layout_auto">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Caregory Name</th>
                                <th scope="col">Caregory Image</th>
                                <th scope="col">Sort Index</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
            				$nCount	=	$ncounter;
								foreach ($categories as $category)
            				{
            				  ?>
                            <tr>
                                <td><?= $nCount ?></td>
                                <td><?= $category["category_name"] ?> (<?= $category["item_count"] ?> items)</td>
                                <td><img width="100px"
                                        src='<?= !empty($category["category_icon"]) ? base_url('uploads/restaurant/category/').$category["category_icon"] : '' ?>' />
                                </td>
                                <td><?= $category["sort_index"] ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button style="background-color: #F7665E; " class="btn icon_btn_adj"
                                            onclick="deleteCategory(<?= $category["id"] ?>,'<?= $category["category_name"] ?>');"><i
                                                class="fa fa-trash icon_margin"></i> Delete</button>
                                        <button style=" background-color: #5dcaca; "
                                            class="btn margin_top_stng icon_btn_adj"
                                            onclick="renameCategory(<?= $category["id"] ?>);"><i
                                                class="fas fa-edit icon_margin"></i> Rename</button>
                                        <?
										if ($category["status"]=="Inactive")
										{
										?>
                                        <button
                                            onclick="disableCategory(<?= $category["id"] ?>,'<?= $category["category_name"] ?>','Activate');"
                                            class="disable-active btn margin_top_stng icon_btn_adj">Activate</button>
                                        <?
										}else
										{
										?>
                                        <button class="btn margin_top_stng icon_btn_adj"
                                            onclick="disableCategory(<?= $category["id"] ?>,'<?= $category["category_name"] ?>');"><i
                                                class="fa fa-ban icon_margin"></i> Disable</button>

                                        <?
										}                        
									?>
                                    </div>
                                </td>
                            </tr>
                            <?
							 	$nCount++;
								}
            			?>
                        </tbody>
                    </table>
                    <div class="inline_flex_adj">
                        <!-- <div class="inline_block_adj show_rows_adj">
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Show Rows :</label>
							<select class="custom-select my-1 show_rows_count" id="inlineFormCustomSelectPref">
								<option selected>30</option>
								<option value="1">50</option>
								<option value="2">60</option>
								<option value="3">70</option>
							</select>
						</div> -->
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
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<script>
function check_banner_image(val) {

    var fileName = $("#" + val).val();
    if (fileName.length > 0) {
        $('#name_' + val).html(fileName.substring(0, 45));
        var ext = fileName.split('.').pop();
        var ext = ext.toLowerCase();

        //if (val == 'upload_banner') {
        if (ext != "jpg" && ext != "jpe" && ext != "jpeg" && ext != "png" && ext != "gif") {
            $("#" + val).val(null);
            alertify.alert("Warning", "Please select a valid image format.");
            $('#name_' + val).html('<p class="red">Only (.jpg, .gif, .png) allowed!</p>');
            $('.upload_bannar_btn').hide();
            $('.text_center_adj').hide();
            return false;
        } else {
            var file_size = Number(($("#" + val)[0].files[0].size / 1024 / 1024).toFixed(2));
            var image_size_limit = Number('2.00');

            if (image_size_limit < file_size) {
                $("#" + val).val(null);
                alertify.alert("Warning", 'The uploaded image is too long, You can upload image up to 2MB.');
                $('#name_' + val).html('');
                $('.upload_bannar_btn').hide();
                $('.text_center_adj').hide();
                return false;
            } else {
                var selected_file = fileName;
                var original_selected_file = selected_file.substring(selected_file.lastIndexOf('\\') + 1, selected_file
                    .length);
                $('#name_' + val).html(original_selected_file);
                return true;
            }

        }
        //}
    } else {
        alertify.alert("Warning", "No image selected");
        $('#name_' + val).html('<p class="red">Please select image</p>');
        $('.upload_bannar_btn').hide();
        $('.text_center_adj').hide();
        return false;
    }
}
</script>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>