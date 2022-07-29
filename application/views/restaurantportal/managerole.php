<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-colorpicker.min.css " />
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
    width: 20px;
    height: 20px;
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

.btn-close {
    padding: 0 !important;
}

.colorpicker-element {
    float: left;
    width: 100%;
    height: 50px;
    margin: 0 0 20px 0;
}

.input-group-addon {
    padding: 6px 12px;
    font-size: 14px;
    font-weight: normal;
    line-height: 1;
    color: #555;
    text-align: center;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
}

#role_loader {
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
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar ">
    <div class="row ">
        <div class="col-sm-12 col-md-6 col-lg-10 ">
            <h1>Manage Role</h1>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2 ">
            <button class="btn orange_btn text-white mail_btn_responsive centred_button" data-bs-toggle="modal"
                data-bs-target="#add_new_role_modal">Add New Role</button>
        </div>
    </div>


</div>

<div class="modal fade" id="add_new_role_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="resturantlocation" class="form-label">Resturant Location</label>
                    <select id="add_location" class="form-select">
                        <?php if (!empty($restaurant_locations)) { ?>
                        <option value="0">Select Restaurant Location</option>
                        <?php foreach ($restaurant_locations as $key => $location) { ?>
                        <option value="<?php echo $location['id']; ?>">
                            <?php echo $location['address'] . ', ' . $location['location']; ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please add Location First</option>
                        <?php } ?>
                    </select>
                    <div id="add_location_error" class="form-text" style="display: none; color: red;">Please select
                        location.</div>
                </div>
                <div class="mb-3">
                    <label for="resturantdepartment" class="form-label">Resturant Department</label>
                    <select id="add_department" required class="form-select">
                        <option value="0">Please Select Location First</option>
                    </select>
                    <div id="add_department_error" class="form-text" style="display: none; color: red;">Please select
                        department.</div>
                </div>
                <div class="mb-3">
                    <label for="rolename" class="form-label">Role Name</label>
                    <input type="text" class="form-control" id="add_role" aria-describedby="emailHelp">
                    <div id="add_role_error" class="form-text" style="display: none; color: red;">Please enter role.
                    </div>
                </div>
                <!-- <div class="mb-3">
                        <label for="rolecolor" class="form-label">Role Color</label>
                        <input style="padding: 0;width:25px " type="color" class="form-control" name="rolecolor" id="rolecolor" value="" aria-describedby="emailHelp">
                    </div> -->
                <div class="mb-3 form-group">
                    <label for="rolecolor" class="form-label">Role Color</label>
                    <div class="input-group colorcustompicker colorpicker-element">
                        <input type="text" class="form-control jsColor" id="add_color" data-rule-required="true"
                            readonly="" value="#a13e07">
                        <span class="input-group-addon"><i class="role_color_adj"></i></span>
                    </div>
                </div>
                <button class="btn  orange_btn text-white" id="add_new_role">Add Role</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_role_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="update_role_id" aria-describedby="emailHelp">
                <div class="mb-3">
                    <label for="resturantlocation" class="form-label">Resturant Location</label>
                    <select id="update_location" class="form-select">
                        <?php if (!empty($restaurant_locations)) { ?>
                        <option value="0">Select Restaurant Location</option>
                        <?php foreach ($restaurant_locations as $key => $location) { ?>
                        <option value="<?php echo $location['id']; ?>">
                            <?php echo $location['address'] . ', ' . $location['location']; ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please add Location First</option>
                        <?php } ?>
                    </select>
                    <div id="update_location_error" class="form-text" style="display: none; color: red;">Please select
                        location.</div>
                </div>
                <div class="mb-3">
                    <label for="resturantdepartment" class="form-label">Resturant Department</label>
                    <select id="update_department" class="form-select">
                        <option>Please Select Location First</option>
                    </select>
                    <div id="update_department_error" class="form-text" style="display: none; color: red;">Please select
                        department.</div>
                </div>
                <div class="mb-3">
                    <label for="rolename" class="form-label">Role Name</label>
                    <input type="text" class="form-control" id="update_role" aria-describedby="emailHelp">
                    <div id="update_role_error" class="form-text" style="display: none; color: red;">Please enter role.
                    </div>
                </div>
                <!--  <div class="mb-3">
                    <label for="rolecolor" class="form-label">Role Color</label>
                    <input style="padding: 0;width:25px " type="color" class="form-control" id="update_color" aria-describedby="emailHelp">
                </div> -->
                <div class="mb-3 form-group">
                    <label for="rolecolor" class="form-label">Role Color</label>
                    <div class="input-group colorcustompicker colorpicker-element" id="update_color_picker">
                        <input type="text" class="form-control jsColor" id="update_color" data-rule-required="true"
                            readonly="" value="">
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                <button class="btn btn-primary orange_btn text-white" id="update_role_changes">Update Role</button>
            </div>
        </div>
    </div>
</div>

<div class="title_bar content">
    <div class="card">
        <div class="card-body">
            <div class="table_responsive">
                <table class="table table-bordered table_layout_auto">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Resturant Location</th>
                            <th>Resturant Department</th>
                            <th>Role</th>
                            <th>Role Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($restaurant_roles)) { ?>
                        <?php foreach ($restaurant_roles as $key => $role) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $role['address'] . ', ' . $role['location']; ?></td>
                            <td><?php echo $role['department_name']; ?></td>
                            <td><?php echo $role['role_name']; ?></td>
                            <td><input style="padding: 0;width:25px " type="color" class="form-control"
                                    value="<?php echo $role['role_color']; ?>"></td>
                            <?php $role_id = $role['id']; ?>
                            <?php $role_name = $role['role_name']; ?>
                            <td>
                                <div class="btn-group">
                                    <button onclick="editrole('<?php echo $role_id; ?>');"
                                        class="btn text-white orange_btn"
                                        style="background-color:#5dcaca !important;border-color:#5dcaca !important;min-height: unset;width:unset !important;"><i
                                            class="fa fa-edit"></i> Edit</button>
                                    <button style="min-height: unset;width:unset !important;"
                                        class="btn text-white orange_btn"
                                        onclick="deleterole('<?php echo $role_id; ?>', '<?php echo $role_name; ?>');"><i
                                            class="fa fa-trash"></i> Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">No role found!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div style="display: none" id="role_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap-colorpicker.js"></script>

    <script>
    $(document).ready(function() {
        $('.colorcustompicker').colorpicker();
    });

    $('#add_location').on('change', function() {
        $("#add_location_error").hide();
        var location_id = $("#add_location").val();

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
                    var options = '<option value="0">Please Select Department</option>';
                    response.departments.map(function(department) {
                        options += '<option value="' + (department.id) + '">' + (department
                            .department_name) + '</option>';
                    });
                    $('#add_department').html(options);
                }
            },
            error: function(data) {

            }
        });
    });

    $('#add_department').on('change', function() {
        $("#add_department_error").hide();
    });

    $('#add_role').on('change', function() {
        $("#add_role_error").hide();
    });

    $("#add_new_role").on('click', function() {
        var flag = 0;
        var location = $("#add_location").val();
        var department = $("#add_department").val();
        var role = $("#add_role").val();
        var color = $("#add_color").val();

        if (location == "" || location == undefined || location == 0) {
            $("#add_location_error").show();
            flag = 1;
        }

        if (department == "" || department == undefined || department == 0) {
            $("#add_department_error").show();
            flag = 1;
        }

        if (role == "" || role == undefined) {
            $("#add_role_error").show();
            flag = 1;
        }



        if (flag == 1) {
            return false;
        } else {
            $('#add_new_role_modal').modal("hide");
            $("#role_loader").show();

            var add_url = '<?php echo base_url('restaurantroles/handler'); ?>';
            var form_data = new FormData();

            form_data.append('location', location);
            form_data.append('department', department);
            form_data.append('role', role);
            form_data.append('color', color);
            form_data.append('action', "add_role");
            form_data.append('restaurant_id', <?php echo $restaurantID; ?>);

            $.ajax({
                url: add_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response) {
                    $("#role_loader").hide();

                    if (response != "error") {
                        alertify.alert('Role add successfully!', function() {
                            document.location.href = '<?= base_url("restaurantroles") ?>';
                        });
                    } else {
                        alertify.alert('Error Occurred While adding role');
                    }
                },
                error: function() {}
            });
        }
    });

    $('#add_new_role_modal').on('hidden.bs.modal', function() {
        $('#add_role').val("");
        $('#add_color').val("#a13e07");
        $('#add_location option[value="0"]');
        $('#add_department option[value="0"]');
    });

    function editrole(role_id) {
        var form_data = new FormData();
        form_data.append('role_id', role_id);
        form_data.append('action', "get_role");
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
                    alertify.alert('Role not found');
                } else {
                    var role = response.role;
                    var departments = response.departments;
                    var role_location = role.location;
                    var role_department = role.department;
                    var role_name = role.role_name;
                    var role_color = role.role_color;
                    //
                    var options = '<option value="0">Please Select Department</option>';
                    //
                    departments.map(function(department) {
                        options += '<option value="' + (department.id) + '">' + (department
                            .department_name) + '</option>';
                    });
                    //
                    $('#update_department').html(options);
                    //


                    // $('#update_color').val(role_color);
                    $('#update_color_picker').colorpicker('setValue', role_color);
                    $('#update_role').val(role_name);
                    $('#update_role_id').val(role_id);
                    $("#update_location").val(role_location); //.trigger('change');
                    $('#edit_role_modal').modal("show");
                    $("#update_department").val(role_department).trigger('change');
                }
            },
            error: function(data) {

            }
        });
    }

    $('#update_location').on('change', function() {
        $("#update_location_error").hide();
        var location_id = $("#update_location").val();

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
                    var options = '<option value="0">Please Select Department</option>';
                    response.departments.map(function(department) {
                        options += '<option value="' + (department.id) + '">' + (department
                            .department_name) + '</option>';
                    });
                    $('#update_department').html(options);
                }
            },
            error: function(data) {

            }
        });
    });

    $('#update_department').on('change', function() {
        $("#update_department_error").hide();
    });

    $('#update_role').on('change', function() {
        $("#update_role_error").hide();
    });

    $("#update_role_changes").on('click', function() {
        var flag = 0;
        var location = $("#update_location").val();
        var department = $("#update_department").val();
        var role = $("#update_role").val();
        var color = $("#update_color").val();
        var role_id = $("#update_role_id").val();

        if (location == "" || location == undefined || location == 0) {
            $("#update_location_error").show();
            flag = 1;
        }

        if (department == "" || department == undefined || department == 0) {
            $("#update_department_error").show();
            flag = 1;
        }

        if (role == "" || role == undefined) {
            $("#update_role_error").show();
            flag = 1;
        }

        if (flag == 1) {
            return false;
        } else {
            $('#edit_role_modal').modal("hide");
            $("#role_loader").show();

            var update_url = '<?php echo base_url('restaurantroles/handler'); ?>';
            var form_data = new FormData();

            form_data.append('location', location);
            form_data.append('department', department);
            form_data.append('role', role);
            form_data.append('color', color);
            form_data.append('action', "update_role");
            form_data.append('role_id', role_id);

            $.ajax({
                url: update_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response) {
                    $("#role_loader").hide();

                    if (response != "error") {
                        alertify.alert('Role update successfully!', function() {
                            document.location.href = '<?= base_url("restaurantroles") ?>';
                        });
                    } else {
                        alertify.alert('Error Occurred While updating role');
                    }
                },
                error: function() {}
            });
        }
    });

    $('#edit_department_modal').on('hidden.bs.modal', function() {
        $('#update_department').val("");
        $('#update_location option[value="0"]');
    });

    function deleterole(role_id, role_name) {
        alertify.confirm(
            'Do you really want to delete this <b>' + role_name + '</b> role"?',
            function() {
                $("#role_loader").show();
                var delete_url = '<?php echo base_url('restaurantroles/handler'); ?>';
                var form_data = new FormData();

                form_data.append('action', "delete_role");
                form_data.append('role_id', role_id);

                $.ajax({
                    url: delete_url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    data: form_data,
                    success: function(response) {
                        $("#role_loader").hide();

                        if (response != "error") {
                            alertify.alert('Delete delete successfully!', function() {
                                document.location.href = '<?= base_url("restaurantroles") ?>';
                            });
                        } else {
                            alertify.alert('Error Occurred While deleting role');
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
    </script>

    <?
$this->load->view("restaurantportal/footer_view");
?>