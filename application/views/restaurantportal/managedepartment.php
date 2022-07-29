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

#department_loader {
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
            <h1>Manage Department</h1>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2 ">
            <button class="btn default_orange_button mail_btn_responsive centred_button" data-bs-toggle="modal"
                data-bs-target="#add_new_departmen_modal">Add New Department</button>
        </div>
    </div>
</div>

<div class="modal fade" id="add_new_departmen_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Department</h5>
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
                    <input type="text" class="form-control" id="add_department" aria-describedby="emailHelp">
                    <div id="add_department_error" class="form-text" style="display: none; color: red;">Please enter
                        address.</div>
                </div>
                <button class="btn  orange_btn text-white" id="add_new_department">Add Department</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_department_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="update_department_id" aria-describedby="emailHelp">
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
                    <input type="text" class="form-control" id="update_department" aria-describedby="emailHelp">
                    <div id="update_department_error" class="form-text" style="display: none; color: red;">Please enter
                        address.</div>
                </div>
                <button class="btn btn-primary orange_btn text-white" id="update_department_changes">Save
                    Department</button>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($restaurant_departments)) { ?>
                        <?php foreach ($restaurant_departments as $key => $department) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $department['address'] . ', ' . $department['location']; ?></td>
                            <td><?php echo $department['department_name']; ?></td>
                            <?php $department_id = $department['id']; ?>
                            <?php $department_name = $department['department_name']; ?>
                            <td>
                                <div class="btn-group">
                                    <button onclick="editdepartment('<?php echo $department_id; ?>');"
                                        class="btn text-white orange_btn"
                                        style="min-height: unset;width:unset !important;background-color:#5dcaca !important;border-color:#5dcaca !important;"><i
                                            class="fa fa-edit"></i> Edit</button>
                                    <button style="min-height: unset;width:unset !important;"
                                        class="btn text-white orange_btn"
                                        onclick="deletedepartment('<?php echo $department_id; ?>', '<?php echo $department_name; ?>');"><i
                                            class="fa fa-trash"></i> Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No department found!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div style="display: none" id="department_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$('#add_location').on('change', function() {
    $("#add_location_error").hide();
});

$('#add_department').on('change', function() {
    $("#add_department_error").hide();
});

$("#add_new_department").on('click', function() {
    var flag = 0;
    var location = $("#add_location").val();
    var department = $("#add_department").val();

    if (location == "" || location == undefined || location == 0) {
        $("#add_location_error").show();
        flag = 1;
    }

    if (department == "" || department == undefined) {
        $("#add_department_error").show();
        flag = 1;
    }


    if (flag == 1) {
        return false;
    } else {
        $('#add_new_departmen_modal').modal("hide");
        $("#department_loader").show();

        var add_url = '<?php echo base_url('restaurantdepartment/handler'); ?>';
        var form_data = new FormData();



        form_data.append('location', location);
        form_data.append('department', department);
        form_data.append('action', "add_department");
        form_data.append('restaurant_id', <?php echo $restaurantID; ?>);

        $.ajax({
            url: add_url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(response) {
                $("#department_loader").hide();

                if (response != "error") {
                    alertify.alert('Department add successfully!', function() {
                        document.location.href = '<?= base_url("restaurantdepartment") ?>';
                    });
                } else {
                    alertify.alert('Error Occurred While adding department');
                }
            },
            error: function() {}
        });
    }
});

$('#add_new_departmen_modal').on('hidden.bs.modal', function() {
    $('#add_department').val("");
    $('#add_location option[value="0"]');
});

function editdepartment(department_sid) {
    var form_data = new FormData();
    form_data.append('department_id', department_sid);
    form_data.append('action', "get_department");
    var get_url = '<?php echo base_url('restaurantdepartment/handler'); ?>';

    $.ajax({
        url: get_url,
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        data: form_data,
        success: function(response) {
            if (response.status == "error") {
                alertify.alert('Department not found');
            } else {
                var location = response.department_info.location_id;
                var department = response.department_info.department_name;

                $('#update_department').val(department);
                $('#update_department_id').val(department_sid);
                $("#update_location").val(location).trigger('change');
                $('#edit_department_modal').modal("show");
            }
        },
        error: function(data) {

        }
    });
}

$('#update_location').on('change', function() {
    $("#update_location_error").hide();
});

$('#update_department').on('change', function() {
    $("#update_department_error").hide();
});

$("#update_department_changes").on('click', function() {
    var flag = 0;
    var location = $("#update_location").val();
    var department = $("#update_department").val();
    var department_id = $('#update_department_id').val();

    if (location == "" || location == undefined || location == 0) {
        $("#update_location_error").show();
        flag = 1;
    }

    if (department == "" || department == undefined) {
        $("#update_department_error").show();
        flag = 1;
    }


    if (flag == 1) {
        return false;
    } else {
        $('#edit_department_modal').modal("hide");
        $("#department_loader").show();

        var update_url = '<?php echo base_url('restaurantdepartment/handler'); ?>';
        var form_data = new FormData();



        form_data.append('location', location);
        form_data.append('department', department);
        form_data.append('action', "update_department");
        form_data.append('department_id', department_id);

        $.ajax({
            url: update_url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(response) {
                $("#department_loader").hide();

                if (response != "error") {
                    alertify.alert('Department update successfully!', function() {
                        document.location.href = '<?= base_url("restaurantdepartment") ?>';
                    });
                } else {
                    alertify.alert('Error Occurred While updating department');
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

function deletedepartment(department_id, department_name) {
    alertify.confirm(
        'Do you really want to delete this <b>' + department_name + '</b> department"?',
        function() {
            var delete_url = '<?php echo base_url('restaurantdepartment/handler'); ?>';
            var form_data = new FormData();

            form_data.append('action', "delete_department");
            form_data.append('department_id', department_id);

            $.ajax({
                url: delete_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response) {
                    $("#department_loader").hide();

                    if (response != "error") {
                        alertify.alert('Delete delete successfully!', function() {
                            document.location.href = '<?= base_url("restaurantdepartment") ?>';
                        });
                    } else {
                        alertify.alert('Error Occurred While deleting location');
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