<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>
<style type="text/css" media="screen">
td.btn_style_setting {
    display: inline-flex !important;
}
</style>
<script language="javascript">
var urladd = '<?= base_url() ?>restaurantstaff';

function refreshItemPage(msg) {
    document.location.href = urladd;
}

var employeeName;
var editEmployee;
var url = '<?= base_url() ?>restaurantstaff/add_edit_employee/';

function addEditEmployee(nItemId) {
    editEmployee = nItemId;
    itemId = nItemId;
    var pageFrame = document.getElementById('roleIframe');

    pageFrame.src = url + nItemId;

    $('#add_edit_employee').dialog('open');
    return false;
}

var disableRole;
var disableType;

function disableRole(nItemId, strRole, type) {
    if (type == undefined) {
        $('#disable_restaurant_employee_text').html("Disable");
        disableType = "Inactive";
    } else {
        $('#disable_restaurant_employee_text').html("Activate");
        disableType = "Active";
    }
    $('#newspan_employeeName').html(strRole);
    roleName = strRole;
    disableRole = nItemId;
    $('#disable_restaurant_employee').dialog('open');
    return false;

}

var deleteEmployee;

function deleteRole(nItemId, strRole) {
    deleteEmployee = nItemId;
    roleName = strRole;
    $('#span_variantName').html(strRole);
    $('#delete_restaurant_employee').dialog('open');
    return false;
}
</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#add_edit_employee').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
    });

    // Dialog	( Start Edit Variant Popup Window Here )
    $('#view_role_iframe').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
    });

    // Dialog	( Start Disable Popup Window Here )
    $('#disable_restaurant_employee').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {

                $("#action_employee_name").val(roleName);
                $("#updatestatus").val(disableType);
                $("#updateid").val(disableRole);

                document.statuschange.submit();

            },
            "No": function() {
                $(this).dialog("close");
            }
        }
    });

    // Dialog	( Start Delete Popup Window Here )
    $('#delete_restaurant_employee').dialog({
        autoOpen: false,
        modal: true,
        width: 'auto',
        fluid: true,
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {
                $("#variantgroupname").val(roleName);
                $("#updatestatus").val("Deleted");
                $("#updateid").val(deleteEmployee);
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

function closeAddEditEmployee() {
    $('#add_edit_employee').dialog('close');
}

function closeViewVariant() {
    $('#view_role_iframe').dialog('close');
}
</script>
<!-- End Dialog Popups -->

<?
	echo form_open(base_url().'restaurantstaff',array('id' => 'statuschange','name'=>'statuschange'));
?>
<input type="hidden" name="action_employee_name" id="action_employee_name" />
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
</form>


<!-- Start Edit Variant Popup Window Here -->
<div id="add_edit_employee" title="Create New Staff Or Edit Staff">
    <iframe allowtransparency="true" frameborder="0" width="580" height="486" style="background:0px none;"
        id="roleIframe"></iframe>
</div>
<!-- End Edit Variant Popup Window Here -->

<!-- Start Disable Popup Window Here -->
<div id="disable_restaurant_employee" title="Disable Staff">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to <span id="disable_restaurant_employee_text"></span> <span id="newspan_employeeName"></span>
        ?</strong>
</div>
<!-- End Disable Popup Window Here -->

<!-- Start Delete Popup Window Here -->
<div id="delete_restaurant_employee" title="Delete Staff">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Delete <span id="span_variantName"></span> ?</strong>
</div>
<!-- End Delete Popup Window Here -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flex-columns">
    <h1>Manage Staff</h1>
    <a href="javascript:void(null);" onclick="addEditEmployee(0);" class="btn new_btn_adj margin_top_stng float-right">
        <span>Add New Staff</span>
    </a>
</div>
<div class="title_bar content">
    <?
$this->load->view("restaurantportal/messages");
?>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-12">
            <div id="exTab1" class="">
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="1a">
                        <div class="card ">
                            <div class="card-body p-4">
                                <div class="col-sm-12">
                                    <div class="table-responsive variant_fixed_table">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Is Manager</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($employees)) { ?>
                                                <?php foreach ($employees as $key => $employee) { ?>
                                                <?php $employee_name = $employee["firstname"].' '.$employee["lastname"]; ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $employee_name; ?></td>
                                                    <td><?php echo $employee["email"]; ?></td>
                                                    <td><?php echo $employee["phone_number"]; ?></td>
                                                    <td><?php echo $employee["is_manager"] == 1 ? "Yes" : "No"; ?></td>
                                                    <td><?php echo $employee["status"] == "Active" ? "Active" : "Inactive"; ?>
                                                    </td>
                                                    <td class="btn_style_setting">
                                                        <a href="javascript:void(null);"
                                                            onclick="addEditEmployee(<?= $employee["id"] ?>);"
                                                            style=" background-color: #5dcaca; "
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fas fa-edit icon_margin"></i> Edit Staff</a>
                                                        <?php if ($employee["status"]  ==  "Inactive") { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableRole(<?= $employee["id"] ?>,'<?= $employee_name ?>','Active');"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-check" aria-hidden="true"></i> Activate</a>
                                                        <?php } else { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableRole(<?= $employee["id"] ?>,'<?= $employee_name ?>');"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-ban"></i> Disable</a>
                                                        <?php } ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="deleteRole(<?= $employee["id"] ?>, '<?= $employee_name ?>');"
                                                            style="background-color: #F7665E;"
                                                            class="btn btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-trash icon_margin "></i> Delete</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php } else { ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">No Employee Found!</td>
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