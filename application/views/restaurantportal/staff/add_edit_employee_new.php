<?
	$this->load->view("restaurantportal/header_view");
	$this->load->view("restaurantportal/sidepanel_view");
?>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.datetimepicker.css" />
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

.input_error {
    color: red;
    display: none;
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
    <h1>Employee Information</h1>
</div>


<div class="title_bar content" style="border-bottom: none;">
    <div class="row">
        <div class="col-12">
            <h4>Personal Information</h4>
            <div class="avatar">
                <?php
                    $first_name = !empty($employee["firstname"]) ? $employee["firstname"] : 'John';
                    $last_name = !empty($employee["lastname"]) ? $employee["lastname"] : 'Doe';
                    $staff_name = $first_name .' '.$last_name;
                ?>
                <span class="image_holder">
                    <?php if(isset($employee["profile_picture"]) && !empty($employee["profile_picture"])) { ?>
                    <img src="<?php echo base_url('uploads/restaurant/resturant_staff') .'/'. $employee["profile_picture"]; ?>"
                        class="table-image" alt="">

                    <?php } else { ?>
                    <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                    <?php } ?>
                </span>
                <span><?php echo $staff_name; ?></span>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="employee_id" value="<?php echo $employee_id; ?>">

<div class="title_bar content">
    <!-- <form class="form"> -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="f_name" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">First Name
                    (required)</label>
                <input type="text" name="firstname" id="firstname" class="form-control"
                    value="<?= $employee["firstname"] ?>">
                <span class="input_error" id="error_firstname">Please enter first name.</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="l_name" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Last Name
                    (required)</label>
                <input type="text" name="lastname" id="lastname" class="form-control"
                    value="<?= $employee["lastname"] ?>">
                <span class="input_error" id="error_lastname">Please enter last name.</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="email" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $employee["email"] ?>">
                <input type="hidden" id="old_staff_email" value="<?= $employee["email"] ?>">
                <span class="input_error" id="error_email">Please enter email.</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="home_phone" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Home
                    Phone</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control"
                    value="<?= $employee["phone_number"] ?>">
                <span class="input_error" id="error_phone">Please enter phone number.</span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="bd" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Birthday</label>
                <?php $birthday = isset($employee) && !empty($employee['birthday']) ? date('Y-m-d', strtotime($employee['birthday'])) : date('Y-m-d'); ?>
                <input type="date" name="birthday" id="birthday" class="form-control" value="<?php echo $birthday; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="inline_form_adj">
                <div class="form-group w-100">
                    <label for="bd" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Profile
                        Picture</label>
                    <label class="file width_mob_adj w-100 d-block">
                        <input type="file" class="width_mob_adj" name="profile_picture" id="profile_picture"
                            aria-label="File browser example" onchange="check_staff_image('profile_picture')">
                        <span class="file-custom span_adj" id="name_profile_picture">Choose file</span>
                    </label>
                    <span class="input_error" id="error_profile_picture">Please enter phone number.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="addres" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="<?= $employee["address"] ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="zipcode" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Zip / Postal
                    Code</label>
                <input type="text" name="zip" id="zip" class="form-control" value="<?= $employee["zip"] ?>">
            </div>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="City" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?= $employee["city"] ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="state" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">State /
                    Province</label>
                <input type="text" name="state" id="state" class="form-control" value="<?= $employee["state"] ?>">
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-4">
            <div class="form-group">
                <label for="password" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Password</label>
                <input id="password" type="text" name="password" id="password" class="form-control" value="">
                <span class="input_error" id="error_password">Please enter password.</span>
            </div>
        </div>
        <div class="col-md-6 is_manager_check">
            <div class="form-group ">
                <label for="is_manager" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Is
                    Manager</label>
                <input id="is_manager" name="is_manager" type="checkbox" value="1"
                    <?= ($employee["is_manager"] == 1 || $employee["is_manager"] == "") ? 'checked="checked"' : '' ?> />
                Yes
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12 col-sm-12">
            <div class="form-group ">
                <button class="form-control orange_btn btn btn-primary text-white" id="save_basic_info">Save</button>
                <span class="discard" id="discard_basic_info">Discard Changes</span>
            </div>
        </div>
    </div>
    <!-- </form> -->
</div>

<?php $weekly_hours = isset($employment_info) && !empty($employment_info['max_hours']) ? $employment_info['max_hours'] : ''; ?>
<?php $hire_date = isset($employment_info) && !empty($employment_info['hire_date']) ? date('Y-m-d', strtotime($employment_info['hire_date'])) : date('Y-m-d'); ?>

<?php if ($employee_id != 0) { ?>
<div class="title_bar content">
    <h4>Role Assignment</h4>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="location" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Location</label>
                <select name="location" id="location" class="form-select">
                    <?php if (!empty($restaurant_locations)) { ?>
                    <option value="0">Select Restaurant Location</option>
                    <?php foreach ($restaurant_locations as $key => $location) { ?>
                    <?php $selected_loc = $location['id'] == $employee["location_id"] ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $location['id']; ?>" <?php echo $selected_loc; ?>>
                        <?php echo $location['address'].', '.$location['location']; ?></option>
                    <?php } ?>
                    <?php } else { ?>
                    <option value="0">Please add Location First</option>
                    <?php } ?>
                </select>
                <span class="input_error" id="error_location">Please select location.</span>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="grid">
                <div>
                    <span>Departments</span>
                    <div class="checkboxes" id="location_department">
                        <?php if (isset($departments) && !empty($departments)) { ?>
                        <?php foreach ($departments as $key => $department) { ?>
                        <label for="department">
                            <?php $dep_selected = $department['id'] == $employee["department_id"] ? 'checked="checked"' : ''; ?>
                            <input type="radio" name="department" value="<?php echo $department['id'] ?>"
                                class="selected_department" <?php echo $dep_selected; ?>>
                            <?php echo $department['department_name'] ?>
                        </label>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <span class="input_error" id="error_department">Please select department.</span>
                </div>
                <div>
                    <span>Roles</span>
                    <div class="checkboxes" id="department_roles">
                        <?php if (isset($roles) && !empty($roles)) { ?>
                        <?php foreach ($roles as $key => $role) { ?>
                        <?php 
                                        $user_roles = explode(',', $employee["role_id"]);
                                        $selected_role = in_array($role['id'], $user_roles) ? 'checked="checked"' : ''; 
                                    ?>
                        <label for="role">
                            <input type="checkbox" name="roles" class="selected_role" value="<?php echo $role['id'] ?>"
                                <?php echo $selected_role; ?>>
                            <badge class="badge" style="background: <?php echo $role['role_color'] ?>;">
                                <?php echo $role['role_name'] ?></badge>
                        </label>
                        <?php } ?>
                        <?php } ?>
                    </div>
                    <span class="input_error" id="error_role">Please choose role.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <button class="form-control orange_btn btn btn-primary text-white" id="save_role_info">Save</button>
                <span class="discard" id="discard_role_info">Discard Changes</span>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content">
    <h4>Employment</h4>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="max_weekly_hours" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Max
                    Weekly Hours</label>
                <input type="text" name="max_weekly_hours" id="max_weekly_hours" class="form-control"
                    value="<?php echo $weekly_hours; ?>">
                <span class="input_error" id="error_max_weekly_hours">Please enter weekly hours.</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="hire_date" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Hire
                    Date</label>
                <input type="date" name="hire_date" id="hire_date" class="form-control"
                    value="<?php echo $hire_date; ?>">
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="status" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Status</label>
                <select name="employment_info_status" id="employment_info_status" class="form-select">
                    <option value="-1">Please Select Employment Status</option>
                    <option value="1"
                        <?php echo isset($employment_info) && $employment_info['status'] == 1 ? 'selected="selected"' : ''; ?>>
                        Active</option>
                    <option value="0"
                        <?php echo isset($employment_info) && $employment_info['status'] == 0 ? 'selected="selected"' : ''; ?>>
                        Disabled</option>
                </select>
                <span class="input_error" id="error_employment_info_status">Please select employment status.</span>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <button class="form-control  orange_btn btn btn-primary text-white "
                    id="save_employment_info">Save</button>
                <span class="discard" id="discard_employment_info">Discard Changes</span>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content">
    <h4>Wages</h4>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="wage_type" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Wage
                    Type</label>
                <select name="wage_type" id="wage_type" class="form-select">
                    <option value="-1">Please Select Wage Type</option>
                    <option value="1"
                        <?php echo isset($wage_info) && $wage_info['wage_type'] == 1 ? 'selected="selected"' : ''; ?>>
                        Hourly</option>
                    <option value="2"
                        <?php echo isset($wage_info) && $wage_info['wage_type'] == 2 ? 'selected="selected"' : ''; ?>>
                        Weekly</option>
                    <option value="3"
                        <?php echo isset($wage_info) && $wage_info['wage_type'] == 3 ? 'selected="selected"' : ''; ?>>
                        Monthly</option>
                </select>
                <span class="input_error" id="error_wage_type">Please select wage type.</span>
                <span class="short">Employees can only have one wage type.</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="wage" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Wage</label>
                <?php $wage_rate = isset($wage_info) && !empty($wage_info['wage']) ? $wage_info['wage'] : ''; ?>
                <input type="text" name="wage_rate" id="wage_rate" class="form-control"
                    value="<?php echo $wage_rate; ?>">
                <span class="input_error" id="error_wage_rate">Please enter wage rate.</span>
                <span class="short">This rate will be applicable from next salary cycle.</span>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="status" class="form-label" style="font-weight: 600;color:rgba(0,0,0,.7)">Status</label>
                <select name="wage_status" id="wage_status" class="form-select">
                    <option value="-1">Please Select Wage Status</option>
                    <option value="1"
                        <?php echo isset($wage_info) && $wage_info['status'] == 1 ? 'selected="selected"' : ''; ?>>
                        Active</option>
                    <option value="0"
                        <?php echo isset($wage_info) && $wage_info['status'] == 0 ? 'selected="selected"' : ''; ?>>
                        Disabled</option>
                </select>
                <span class="input_error" id="error_wage_status">Please select wage status.</span>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <button class="form-control orange_btn btn btn-primary text-white" id="save_wage_info">Save</button>
                <span class="discard" id="discard_wage_info">Discard Changes</span>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content" id="discard_note">
    <h4>Notes</h4>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <label for="notes" class="form-label notes" style="font-weight: 600;color:rgba(0,0,0,.7)">Scheduling
                    Notes
                    <span class="right">Max 1000 Characters</span>
                </label>
                <textarea name="notes" id="notes" rows="5"
                    class="form-control"><?php echo $employee['staff_note'] ?></textarea>
                <span class="input_error" id="error_notes">Please write a note for staff.</span>
                <span class="short">These notes will be available when viewing the schedule. Only you and other
                    management staff can see scheduling notes.</span>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="form-group">
                <button class="form-control orange_btn btn btn-primary text-white" id="save_note">Save</button>
                <span class="discard" id="discard_note">Discard Changes</span>
            </div>
        </div>
    </div>
</div>
<?php } ?>








<div style="display: none" id="staff_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

<script>
$('#location').on('change', function() {
    $("#error_location").hide();
    var location_id = $("#location").val();

    var form_data = new FormData();
    form_data.append('location_id', location_id);
    form_data.append('action', "get_departments");
    var get_url = '<?php echo base_url('restaurantroles/handler'); ?>';

    $.ajax({
        url: get_url,
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        data: form_data,
        success: function(response) {
            if (response.status == "error") {
                alertify.alert('Department not found against this location!');
            } else {
                var checkbox = '';
                response.departments.map(function(department) {
                    // checkbox += '<option value="'+( department.id )+'">'+( department.department_name )+'</option>';
                    checkbox +=
                        '<label for="department"><input type="radio" name="department" value="' +
                        (department.id) + '" class="selected_department"> ' + (department
                            .department_name) + '</label>';
                });
                $('#location_department').html(checkbox);
            }
        },
        error: function(data) {

        }
    });
});

$(document).on('click', '.selected_department', function() {
    $("#error_department").hide();
    var department_id = $('input[name="department"]:checked').val();

    var form_data = new FormData();
    form_data.append('department_id', department_id);
    form_data.append('action', "get_department_roles");
    var get_url = '<?php echo base_url('restaurantroles/handler'); ?>';

    $.ajax({
        url: get_url,
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        data: form_data,
        success: function(response) {
            if (response.status == "error") {
                alertify.alert('Roles not found against this Department!');
                $('#department_roles').html('');
            } else {
                var checkbox = '';
                response.roles.map(function(role) {
                    // checkbox += '<label for="department"><input type="vhr" name="department" value="'+( role.id )+'" class="selected_department"> '+( role.role_name )+'</label>';
                    checkbox += '<label for="role">';
                    checkbox +=
                        '<input type="checkbox" name="roles" class="selected_role" value="' +
                        (role.id) + '"> ';
                    checkbox += '<badge class="badge" style="background: ' + (role
                        .role_color) + ';">' + (role.role_name) + '</badge>';
                    checkbox += '</label>';
                });
                $('#department_roles').html(checkbox);
            }
        },
        error: function(data) {

        }
    });
});

$('#firstname').on('keyup', function() {
    $("#error_firstname").hide();
});

$('#lastname').on('keyup', function() {
    $("#error_lastname").hide();
});

$('#email').on('keyup', function() {
    $("#error_email").hide();
});

$('#phone_number').on('keyup', function() {
    $("#error_phone").hide();
});

function check_staff_image(val) {
    var fileName = $("#" + val).val();

    if (fileName.length > 0) {
        $('#name_' + val).html(fileName.substring(0, 45));
        var ext = fileName.split('.').pop();
        var ext = ext.toLowerCase();

        if (val == 'profile_picture') {
            if (ext != "jpg" && ext != "jpe" && ext != "jpeg" && ext != "png") {
                $("#" + val).val(null);
                alertify.alert("Warning", "Please select a valid image format.");
                $('#name_' + val).html('<p class="red">Only (.jpg, .jpe, .jpeg, .png) allowed!</p>');

                return false;
            } else {
                var file_size = Number(($("#" + val)[0].files[0].size / 1024 / 1024).toFixed(2));
                var image_size_limit = Number('2.00');

                if (image_size_limit < file_size) {
                    $("#" + val).val(null);
                    alertify.alert("Warning", 'The uploaded image is too long, You can upload image up to 2MB.');
                    $('#name_' + val).html('');

                    return false;
                } else {
                    var selected_file = fileName;
                    var original_selected_file = selected_file.substring(selected_file.lastIndexOf('\\') + 1,
                        selected_file.length);
                    $('#name_' + val).html(original_selected_file);

                    var output = document.getElementById('selected_profile_pic');
                    output.src = URL.createObjectURL($("#" + val)[0].files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                    }
                    return true;
                }

            }
        }
    } else {
        alertify.alert("Warning", "No image selected");
        $('#name_' + val).html('<p class="red">Please select image</p>');

        return false;
    }
}

$("#save_basic_info").on('click', function() {
    var flag = 0;
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var phone_number = $("#phone_number").val();
    var birthday = $("#birthday").val();
    var address = $("#address").val();
    var zip = $("#zip").val();
    var city = $("#city").val();
    var state = $("#state").val();
    var password = $("#password").val();
    var old_staff_email = $("#old_staff_email").val();
    var is_manager = 0;
    if ($('#is_manager').is(":checked")) {
        var is_manager = 1;
    }
    var employee_id = $("#employee_id").val();

    if (firstname == "" || firstname == undefined) {
        $("#error_firstname").show();
        flag = 1;
    }

    if (lastname == "" || lastname == undefined) {
        $("#error_lastname").show();
        flag = 1;
    }

    if (email == "" || email == undefined) {
        $("#error_email").show();
        flag = 1;
    }
    if (employee_id == 0) {
        if (password == "" || password == undefined) {
            $("#error_password").show();
            flag = 1;
        }
    }

    if (phone_number == "" || phone_number == undefined) {
        $("#error_phone").show();
        flag = 1;
    }

    var fileName = $("#profile_picture").val();

    if (fileName.length > 0) {
        $('#profile_picture').html(fileName.substring(0, 45));
        var ext = fileName.split('.').pop();
        var ext = ext.toLowerCase();


        if (ext != "jpg" && ext != "jpe" && ext != "jpeg" && ext != "png") {
            $("#error_profile_picture").text('Please select a valid image format.');
            $("#error_profile_picture").show();
            flag = 1;
        } else {
            var file_size = Number(($("#profile_picture")[0].files[0].size / 1024 / 1024).toFixed(2));
            var image_size_limit = Number('2.00');
            if (image_size_limit < file_size) {
                $("#error_profile_picture").text(
                    'The uploaded image is too long, You can upload image up to 2MB.');
                $("#error_profile_picture").show();
                flag = 1;
            }
        }

    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide required fields first!")
        return false;
    } else {
        $("#staff_loader").show();

        var file_data = $('#profile_picture').prop('files')[0];
        var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';
        var form_data = new FormData();

        form_data.append('firstname', firstname);
        form_data.append('lastname', lastname);
        form_data.append('email', email);
        form_data.append('phone_number', phone_number);
        form_data.append('birthday', birthday);
        form_data.append('profile_picture', file_data);
        form_data.append('address', address);
        form_data.append('zip', zip);
        form_data.append('city', city);
        form_data.append('state', state);
        form_data.append('password', password);
        form_data.append('is_manager', is_manager);
        form_data.append('employee_id', employee_id);
        form_data.append('old_staff_email', old_staff_email);

        if (employee_id == 0) {
            form_data.append('action', 'add_staff');
        } else {
            form_data.append('action', "update_staff");
        }

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
                    if (employee_id == 0) {
                        alertify.alert("Success", response.message, function() {
                            document.location.href =
                                '<?= base_url("restaurantstaff/add_edit_employee") ?>' +
                                '/' + response.employee_id;
                        });
                    } else {
                        alertify.alert("Success", response.message, function() {
                            document.location.href =
                                '<?= base_url("restaurantstaff/add_edit_employee") ?>' +
                                '/' + employee_id;
                        });
                    }
                } else {
                    if (employee_id == 0) {
                        alertify.alert("Error", response.message);
                    } else {
                        alertify.alert("Error", response.message);
                    }
                }
            },
            error: function() {}
        });
    }
});

$("#discard_basic_info").on("click", function() {
    var firstname = '<?= $employee["firstname"] ?>';
    var lastname = '<?= $employee["lastname"] ?>';
    var email = '<?= $employee["email"] ?>';
    var phone_number = '<?= $employee["phone_number"] ?>';
    var birthday = '<?php echo $birthday; ?>';
    var address = '<?= $employee["address"] ?>';
    var zip = '<?= $employee["zip"] ?>';
    var city = '<?= $employee["city"] ?>';
    var state = '<?= $employee["state"] ?>';

    $("#firstname").val(firstname);
    $("#lastname").val(lastname);
    $("#email").val(email);
    $("#phone_number").val(phone_number);
    $("#birthday").val(birthday);
    $("#address").val(address);
    $("#zip").val(zip);
    $("#city").val(city);
    $("#state").val(state);
});

$(document).on('click', '.selected_role', function() {
    $("#error_role").hide();
});

$("#save_role_info").on('click', function() {
    var flag = 0;
    var roles_array = [];
    var location_id = $("#location").val();
    var department_id = $('input[name="department"]:checked').val();
    var roles = $('input:checkbox[name="roles"]:checked').val();
    var employee_id = $("#employee_id").val();

    if (location_id == "" || location_id == undefined || location_id == 0) {
        $("#error_location").show();
        flag = 1;
    }

    if (department_id == "" || department_id == undefined) {
        $("#error_department").show();
        flag = 1;
    }

    if (roles == "" || roles == undefined) {
        $("#error_role").show();
        flag = 1;
    } else {
        $("input:checkbox[name=roles]:checked").each(function() {
            roles_array.push($(this).val());
        });
    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide complete role assignment info!")
        return false;
    } else {

        $("#staff_loader").show();

        var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';
        var form_data = new FormData();

        form_data.append('location_id', location_id);
        form_data.append('department_id', department_id);
        form_data.append('roles', roles_array);
        form_data.append('employee_id', employee_id);
        form_data.append('action', "update_role_info");

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
                        document.location.href =
                            '<?= base_url("restaurantstaff/add_edit_employee") ?>' + '/' +
                            employee_id;
                    });
                } else {
                    alertify.alert('Error', 'Error occurred while updating staff role info');
                }
            },
            error: function() {}
        });
    }
});

$("#discard_role_info").on("click", function() {
    var employee_id = $("#employee_id").val();
    document.location.href = '<?= base_url("restaurantstaff/add_edit_employee") ?>' + '/' + employee_id;
})

$('#max_weekly_hours').on('keyup', function() {
    $("#error_max_weekly_hours").hide();
});

$('#employment_info_status').on('change', function() {
    $("#error_employment_info_status").hide();
});

$("#save_employment_info").on('click', function() {
    var flag = 0;

    var weekly_hours = $("#max_weekly_hours").val();
    var hire_date = $('#hire_date').val();
    var status = $('#employment_info_status').val();
    var employee_id = $("#employee_id").val();

    if (weekly_hours == "" || weekly_hours == undefined) {
        $("#error_max_weekly_hours").show();
        flag = 1;
    } else if (weekly_hours != '' && !/^[0-9]+$/.test(weekly_hours)) {
        alertify.alert("Warning", "Only number are accepted for max hours!")
        return false;
    }

    if (status == "" || status == undefined || status == '-1') {
        $("#error_employment_info_status").show();
        flag = 1;
    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide complete Staff employment info!")
        return false;
    } else {

        $("#staff_loader").show();

        var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';
        var form_data = new FormData();

        form_data.append('weekly_hours', weekly_hours);
        form_data.append('hire_date', hire_date);
        form_data.append('status', status);
        form_data.append('employee_id', employee_id);
        form_data.append('action', "update_employment_info");

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
                        document.location.href =
                            '<?= base_url("restaurantstaff/add_edit_employee") ?>' + '/' +
                            employee_id;
                    });
                } else {
                    alertify.alert('Error', 'Error occurred while updating staff employment info');
                }
            },
            error: function() {}
        });
    }
});

$("#discard_employment_info").on("click", function() {
    var weekly_hours = '<?= $weekly_hours ?>';
    var hire_date = '<?= $hire_date ?>';
    var status = '<?= isset($employment_info['status'] ) ? $employment_info['status'] : 'Active' ?>';

    $("#max_weekly_hours").val(weekly_hours);
    $('#hire_date').val(hire_date);
    $('#employment_info_status').val(status);
});

$('#wage_type').on('change', function() {
    $("#error_wage_type").hide();
});

$('#wage_rate').on('keyup', function() {
    $("#error_wage_rate").hide();
});

$('#wage_status').on('change', function() {
    $("#error_wage_status").hide();
});

$("#save_wage_info").on('click', function() {
    var flag = 0;

    var wage_type = $("#wage_type").val();
    var wage_rate = $('#wage_rate').val();
    var status = $('#wage_status').val();
    var employee_id = $("#employee_id").val();

    if (wage_type == "" || wage_type == undefined || wage_type == '-1') {
        $("#error_wage_type").show();
        flag = 1;
    }

    if (wage_rate == "" || wage_rate == undefined) {
        $("#error_wage_rate").show();
        flag = 1;
    } else if (wage_rate != '' && !/^[0-9]+$/.test(wage_rate)) {
        alertify.alert("Warning", "Only number are accepted for wage rate!")
        return false;
    }

    if (status == "" || status == undefined || status == '-1') {
        $("#error_wage_status").show();
        flag = 1;
    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide complete Staff wage info!")
        return false;
    } else {

        $("#staff_loader").show();

        var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';
        var form_data = new FormData();

        form_data.append('wage_type', wage_type);
        form_data.append('wage_rate', wage_rate);
        form_data.append('status', status);
        form_data.append('employee_id', employee_id);
        form_data.append('action', "update_wage_info");

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
                        document.location.href =
                            '<?= base_url("restaurantstaff/add_edit_employee") ?>' + '/' +
                            employee_id;
                    });
                } else {
                    alertify.alert('Error', 'Error occurred while updating staff wage info');
                }
            },
            error: function() {}
        });
    }
});

$("#discard_wage_info").on("click", function() {
    var wage_type = '<?= isset($wage_info['wage_type']) ? $wage_info['wage_type'] : '' ?>';
    var wage_rate = '<?= isset($wage_info['wage']) ? $wage_info['wage'] : '' ?>';
    var wage_status = '<?=  isset($wage_info['status']) ? $wage_info['status'] : '' ?>';

    $("#wage_type").val(wage_type);
    $('#wage_rate').val(wage_rate);
    $('#wage_status').val(wage_status);
});

$('#notes').on('keyup', function() {
    $("#error_notes").hide();
});

$("#discard_note").on('click', function() {
    var note = `<?php echo $employee['staff_note'] ?>`;
    $("#notes").val(note);
})

$("#save_note").on('click', function() {
    var flag = 0;

    var note = $("#notes").val();
    var employee_id = $("#employee_id").val();

    if (note == "" || note == undefined) {
        $("#error_notes").show();
        flag = 1;
    } else if (note.length > 1000) {
        alertify.alert("Warning", "Only 1000 Characters are accepted and you write " + note.length +
            " Characters!")
        return false;
    }

    if (flag == 1) {
        alertify.alert("Warning", "Please provide staff scheduling note!")
        return false;
    } else {

        $("#staff_loader").show();

        var update_url = '<?php echo base_url('restaurantstaff/handler'); ?>';
        var form_data = new FormData();

        form_data.append('note', note);
        form_data.append('employee_id', employee_id);
        form_data.append('action', "update_staff_scheduling_note");

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
                        document.location.href =
                            '<?= base_url("restaurantstaff/add_edit_employee") ?>' + '/' +
                            employee_id;
                    });
                } else {
                    alertify.alert('Error', 'Error occurred while updating staff scheduling note');
                }
            },
            error: function() {}
        });
    }
});
</script>

<?
	$this->load->view("restaurantportal/footer_view");
?>