<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>
<style>
.my_loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1234;
}

#file_loader {
    background: black none repeat scroll 0 0;
    display: none;
    height: 100%;
    left: 0;
    opacity: 0.7;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 9;
    display: block;
    height: 1353px;
}

.loader-icon-box {
    position: absolute;
    top: 50%;
    left: 50%;
    width: auto;
    z-index: 9999;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.loader-text {
    display: inline-block;
    padding: 28px 10px;
    color: #000;
    background-color: #e9e9e9;
    border-radius: 5px;
    text-align: center;
    font-weight: 600;
    width: 500px;
    display: block;
    margin-top: 35px;
}

.logo {
    width: auto;
    height: auto;
    text-align: center;
}

.logo img {
    display: inline-block;
}

.QR_code_holder {
    width: auto;
    height: auto;
    text-align: center;
}

.QR_code_btn_holder {
    width: auto;
    height: auto;
    text-align: center;
}

.QR_code_btn_holder button {
    background: #F36737;
    color: #fff;
    width: 124px;
    padding: 9px 0px;
    border-radius: 5px;
    border: 0px;
    font-weight: 400;
}

.QR_code_btn_holder a {
    background: #F36737;
    color: #fff;
    width: 124px;
    padding: 9px 0px;
    border-radius: 5px;
    border: 0px;
    display: inline-block;
    font-weight: 400;
}

.QR_code_holder img {
    display: inline-block;
    width: 150px;
    height: 150px;
}

.restaurant_text p {
    display: block;
}

.restaurant_text p {
    color: #F36737;
    font-size: 28px;
    margin: 0px;
    padding: 12px 0px;
}

#QR_table_no {
    font-size: 24px;
}

.QR_link {
    color: #888888;
}

#QR_Note {
    color: #000;
    font-size: 38px;
    font-weight: 800;
    margin: 0px;
}

.powered_by {
    width: auto;
    height: auto;
    text-align: center;
    margin-top: 8px;
    padding-top: 12px;
}

.powered_by_new {
    width: auto;
    height: auto;
    border-top: 2px dashed #888888;
    text-align: center;
    margin-top: 8px;
    padding-top: 12px;
}

@media print {}

.powered_by img {
    width: 30px;
    height: 30px;
}

.powered_by span {
    color: #000;
    position: relative;
    top: 0px;
    right: -9px;
}

.top_popup_close_button {
    float: right;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 28px;
}

.flexable {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.btn-primary:hover {
    background-color: #f36737;
    border-color: #f36737;
}

#staff_loader {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    width: 100%;
    background: rgba(255, 255, 255, .9);
    z-index: 99;
    text-align: center;
    padding-top: 450px;
    font-size: 50px;
}

.avatar {
    margin-top: 0 !important;
    align-items: center;
    justify-content: center;
    /* flex-direction: column; */
}

.avatar span.image_holder {
    position: relative;
    margin-right: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: block;
    /* background: red; */
    overflow: hidden;
}

.avatar span.image_holder img {
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    margin-right: 0;
    height: 100%;
    /* border-radius: 50%; */
}

.avatar p {
    margin-bottom: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flexable">
    <h1>Staff</h1>
    <a href="<?php echo base_url('restaurantstaff/add_edit_employee/0'); ?>"><button
            class="btn  default_orange_button"><i class="fa fa-plus"></i> Add Staff</button></a>
</div>


<div class="title_bar content">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-12 ">
            <div class="form-group btn_margin_bottom">
                <?php $name_filter = $filters['name'] != 'all' ? $filters['name'] : ''; ?>
                <input type="text" id="staff_name" class="form-control" placeholder="Search Staff By Name"
                    value="<?php echo $name_filter; ?>">
            </div>
        </div>
        <div class="col-lg-5 col-md-6 col-sm-12 ">
            <div class="form-group d-flex btn_margin_bottom">
                <label for="role" class="filter_label">Filter By</label>
                <?php $role_filter = $filters['role']; ?>
                <select id="staff_role" class="form-select">
                    <?php if (!empty($roles)) { ?>
                    <option value="0">Select Role</option>
                    <?php  foreach ($roles as $role) { ?>
                    <option value="<?php echo $role['id']; ?>"
                        <?php echo $role['id'] == $role_filter ? 'selected="selected"' : '';?>>
                        <?php echo $role['role_name']; ?></option>
                    <?php } ?>
                    <?php } else { ?>
                    <option value="0">No Role Found!</option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 ">
            <div class="form-group d-flex btn_margin_bottom">
                <form action="<?php echo base_url('restaurantstaff'); ?>" method="post">
                    <input type="hidden" name="selected_staff_name" id="selected_staff_name">
                    <input type="hidden" name="selected_staff_role" id="selected_staff_role">
                    <button type="submit" class="btn btn-primary orange-btn mr-3 icon_button staff_search_btn"
                        id="search_btn"><i class="fas fa-filter"></i></button>
                </form>

                <a href="<?php echo base_url('restaurantstaff'); ?>"
                    class="btn btn-primary orange-btn icon_button  staff_search_btn "><i class="fas fa-redo"></i></a>
            </div>
        </div>
    </div>
    <!-- <div class="grid-flex">
        <div class="form-group">
            <?php $name_filter = $filters['name'] != 'all' ? $filters['name'] : ''; ?>
            <input type="text" id="staff_name" class="form-control" placeholder="Search Staff By Name"
                value="<?php echo $name_filter; ?>">
        </div>
        <div class="form-group flex">
            <label for="role">Filter By</label>
            <?php $role_filter = $filters['role']; ?>
            <select id="staff_role" class="form-select">
                <?php if (!empty($roles)) { ?>
                <option value="0">Select Role</option>
                <?php  foreach ($roles as $role) { ?>
                <option value="<?php echo $role['id']; ?>"
                    <?php echo $role['id'] == $role_filter ? 'selected="selected"' : '';?>>
                    <?php echo $role['role_name']; ?></option>
                <?php } ?>
                <?php } else { ?>
                <option value="0">No Role Found!</option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group flex">
            <form action="<?php echo base_url('restaurantstaff'); ?>" method="post">
                <input type="hidden" name="selected_staff_name" id="selected_staff_name">
                <input type="hidden" name="selected_staff_role" id="selected_staff_role">
                <button type="submit" class="btn btn-primary orange-btn mr-3" id="search_btn"><i
                        class="fas fa-filter"></i></button>
            </form>

            <a href="<?php echo base_url('restaurantstaff'); ?>" class="btn btn-primary orange-btn"><i
                    class="fas fa-redo"></i></a>
        </div>
    </div> -->
</div>

<div class="title_bar content">
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table class="table table_layout_auto">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Location</th>
                            <th>Is Manager</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($employees)) { ?>
                        <?php foreach ($employees as $key => $employee) { ?>
                        <?php $employee_name = $employee["firstname"].' '.$employee["lastname"]; ?>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <?php if(isset($employee["profile_picture"]) && !empty($employee["profile_picture"])) { ?>
                                        <img src="<?php echo base_url('uploads/restaurant/resturant_staff') .'/'. $employee["profile_picture"]; ?>"
                                            class="table-image" alt="">

                                        <?php } else { ?>
                                        <img src="<?php echo base_url() . '/images/dashboard.png'; ?>"
                                            class="table-image" alt="">
                                        <?php } ?>
                                    </span>
                                </div>
                            </td>
                            <td><?php echo $employee_name; ?></td>
                            <td><?php echo $employee["email"]; ?></td>
                            <td><?php echo $employee["phone_number"]; ?></td>
                            <td><?php echo get_location_name($employee["location_id"]); ?></td>
                            <td><?php echo $employee["is_manager"] == 1 ? "Yes" : "No"; ?></td>
                            <td><?php echo get_Role_name($employee["role_id"]); ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('restaurantstaff/add_edit_employee').'/'.$employee["id"]; ?>"
                                        style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i
                                            class="fas fa-edit icon_margin"></i> Edit</a>
                                    <?php if ($employee["status"]  ==  "Inactive") { ?>
                                    <a href="javascript:void(null);"
                                        onclick="update_staff_status(<?php echo $employee["id"]; ?>, 'Active', '<?php echo $employee_name; ?>')"
                                        class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i>
                                        Anable</a>
                                    <?php } else { ?>
                                    <a href="javascript:void(null);"
                                        onclick="update_staff_status(<?php echo $employee["id"]; ?>, 'Inactive', '<?php echo $employee_name; ?>')"
                                        class="btn margin_top_stng icon_btn_adj"><i class="fa fa-ban icon_margin"></i>
                                        Disable</a>
                                    <?php } ?>
                                    <a href="javascript:void(null);"
                                        onclick="update_staff_status(<?php echo $employee["id"]; ?>, 'Deleted', '<?php echo $employee_name; ?>')"
                                        style="background-color: #F7665E; " class="btn icon_btn_adj"><i
                                            class=" fa fa-trash icon_margin"></i> Delete</a>
                                </div>

                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="7" class="text-center">No Employee Found!</td>
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

<div style="display: none" id="staff_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script>
var search_url = "<?php echo base_url("restaurantstaff/0/0"); ?>";

function update_staff_status(employee_id, status, staff_name) {
    var message = '';
    if (status == 'Active') {
        message = 'Do you really want to activate  <b>' + staff_name + '</b>"?';
    } else if (status == 'Inactive') {
        message = 'Do you really want to deactivate  <b>' + staff_name + '</b>"?';
    } else if (status == 'Deleted') {
        message = 'Do you really want to delete  <b>' + staff_name + '</b>"?';
    }
    alertify.confirm(
        message,
        function() {
            $("#staff_loader").show();

            var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';

            var form_data = new FormData();
            form_data.append('status', status);
            form_data.append('staff_name', staff_name);
            form_data.append('employee_id', employee_id);
            form_data.append('action', "update_staff_status");

            $.ajax({
                url: update_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response) {
                    $("#staff_loader").hide();

                    if (response.status != "error") {
                        alertify.alert("Success", response.message, function() {
                            document.location.href = '<?= base_url("restaurantstaff") ?>';
                        });
                    } else {
                        alertify.alert('Error', 'Error occurred while updating staff status');
                    }
                },
                error: function() {}
            });
        }).set({
        title: "Confirmation"
    }).set('labels', {
        'ok': 'Yes',
        'cancel': 'No'
    });
}

$("#staff_name").on('keyup', function() {
    generate_url();
});

$("#staff_role").on('change', function() {
    generate_url();
});

function generate_url() {
    var name = $("#staff_name").val();

    if (name == '' || name == undefined) {
        name = 'all';
    }

    var role = $("#staff_role").val();

    if (role == '' || role == undefined || role == 0) {
        role = 'all';
    }

    $("#selected_staff_name").val(name);
    $("#selected_staff_role").val(role);
}
</script>

<?
	$this->load->view("restaurantportal/footer_view");
?>