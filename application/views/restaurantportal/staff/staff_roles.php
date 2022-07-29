<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>

<script language="javascript">
var urladd = '<?= base_url() ?>restaurantstaff/roles/';

function refreshItemPage(msg) {
    document.location.href = urladd;
}

var roleName;
var editRole;
var url = '<?= base_url() ?>restaurantstaff/add_edit_role/';

function editRole(nItemId) {
    editRole = nItemId;
    itemId = nItemId;
    var pageFrame = document.getElementById('roleIframe');

    pageFrame.src = url + nItemId;

    $('#add_edit_staff_role').dialog('open');
    return false;
}

var disableRole;
var disableType;

function disableRole(nItemId, strRole, type) {
    if (type == undefined) {
        $('#disable_restaurant_role_text').html("Disable");
        disableType = "Inactive";
    } else {
        $('#disable_restaurant_role_text').html("Activate");
        disableType = "Active";
    }
    $('#newspan_variantName').html(strRole);
    roleName = strRole;
    disableRole = nItemId;
    $('#disable_restaurant_role').dialog('open');
    return false;

}

var deleteRole;

function deleteRole(nItemId, strRole) {
    deleteRole = nItemId;
    roleName = strRole;
    $('#span_variantName').html(strRole);
    $('#delete_restaurant_role').dialog('open');
    return false;
}
</script>

<!-- Start Dialog Popups -->
<script type="text/javascript">
$(function() {
    // Dialog	( Start Edit Variant Popup Window Here )
    $('#add_edit_staff_role').dialog({
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
    $('#disable_restaurant_role').dialog({
        autoOpen: false,
        modal: true,
        fluid: true,
        width: 'auto',
        responsive: true,
        maxWidth: 300,
        height: 180,
        buttons: {
            "Yes": function() {

                $("#action_role_name").val(roleName);
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
    $('#delete_restaurant_role').dialog({
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
                $("#updateid").val(deleteRole);
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

function closeAddEditRole() {
    $('#add_edit_staff_role').dialog('close');
}

function closeViewVariant() {
    $('#view_role_iframe').dialog('close');
}
</script>
<!-- End Dialog Popups -->

<?
	echo form_open(base_url().'restaurantstaff/roles',array('id' => 'statuschange','name'=>'statuschange'));
?>
<input type="hidden" name="action_role_name" id="action_role_name" />
<input type="hidden" name="updatestatus" id="updatestatus" />
<input type="hidden" name="updateid" id="updateid" />
</form>





<!-- Start Edit Variant Popup Window Here -->
<div id="add_edit_staff_role" title="Create New Role Or Edit Role">
    <iframe allowtransparency="true" frameborder="0" width="580" height="486" style="background:0px none;"
        id="roleIframe"></iframe>
</div>
<!-- End Edit Variant Popup Window Here -->

<!-- Start Disable Popup Window Here -->
<div id="disable_restaurant_role" title="Disable Role">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to <span id="disable_restaurant_role_text"></span> <span id="newspan_variantName"></span>
        Role?</strong>
</div>
<!-- End Disable Popup Window Here -->

<!-- Start Delete Popup Window Here -->
<div id="delete_restaurant_role" title="Delete Food Variant">
    <br />
    <span style="float: left; margin: 0pt 7px 10px 0pt;" class="ui-icon ui-icon-info"></span>
    <strong>Are you want to Delete <span id="span_variantName"></span> role?</strong>
</div>
<!-- End Delete Popup Window Here -->
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flex-columns">
    <h1>Manage Roles</h1>
    <a href="javascript:void(null);" onclick="editRole(0);"
        class="btn default_orange_button margin_top_stng float-right">
        <span>Add New Role</span>
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
                                                    <th scope="col">Role Title</th>
                                                    <th scope="col">Location / Depatrment</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($roles as $key => $role) { ?>
                                                <tr>
                                                    <td><?php echo $key + 1; ?></td>
                                                    <td><?php echo $role["role_name"]; ?></td>
                                                    <td><?php echo $role["department"]; ?></td>
                                                    <td><?php echo $role["status"] == 1 ? "Active" : "Inactive"; ?></td>
                                                    <td class="btn_style_setting">
                                                        <a href="javascript:void(null);"
                                                            onclick="editRole(<?= $role["id"] ?>);"
                                                            style=" background-color: #5dcaca; "
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fas fa-edit icon_margin"></i> Edit Role</a>
                                                        <?php if ($role["status"]  ==  "0") { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableRole(<?= $role["id"] ?>,'<?= $role["role_name"] ?>',1);"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-check" aria-hidden="true"></i> Activate</a>
                                                        <?php } else { ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="disableRole(<?= $role["id"] ?>,'<?= $role["role_name"] ?>');"
                                                            class="btn margin_top_stng icon_btn_adj"><i
                                                                class="fa fa-ban"></i> Disable</a>
                                                        <?php } ?>
                                                        <a href="javascript:void(null);"
                                                            onclick="deleteRole(<?= $role["id"] ?>, '<?= $role["role_name"] ?>');"
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