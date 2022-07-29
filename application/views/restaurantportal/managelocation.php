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

#location_loader {
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
<div class="title_bar  ">
    <div class="row ">
        <div class="col-sm-12 col-md-6 col-lg-10 ">
            <h1>Manage Location</h1>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-2 ">
            <button class="btn orange_btn text-white mail_btn_responsive centred_button" data-bs-toggle="modal"
                data-bs-target="#add_new_location_modal">Add New
                Location</button>
        </div>
    </div>

</div>

<div class="modal fade" id="add_new_location_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="resturantlocation" class="form-label">Resturant Location</label>
                    <input type="text" required class="form-control" id="add_location" aria-describedby="emailHelp">
                    <div id="add_location_error" class="form-text" style="display: none; color: red;">Please enter
                        location.</div>
                </div>
                <div class="mb-3">
                    <label for="resturantaddress" class="form-label">Resturant Address (Optional)</label>
                    <input type="text" class="form-control" id="add_address" aria-describedby="emailHelp">
                    <div id="add_address_error" class="form-text" style="display: none; color: red;">Please enter
                        address.</div>
                </div>
                <div class="mb-3">
                    <label for="time_zone" class="form-label">Restaurant Manager</label>
                    <select class="form-select" id="add_manager">
                        <?php if (!empty($restaurant_managers)) { ?>
                        <option value="0">Select Restaurant Manager</option>
                        <?php foreach ($restaurant_managers as $key => $manager) { ?>
                        <option value="<?php echo $manager['id']; ?>">
                            <?php echo $manager['firstname'] . " " . $manager['lastname']; ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please add Manager First</option>
                        <?php } ?>
                    </select>
                    <div id="add_manager_error" class="form-text" style="display: none; color: red;">Please select
                        manager.</div>
                </div>
                <div class="mb-3">
                    <label for="time_zone" class="form-label">Time Zone</label>
                    <select class="form-select" id="add_time_zone">
                        <option value="0">Please select time zone</option>
                        <option value="Asia/Karachi">Karachi</option>
                        <option value="Europe/London">London</option>
                        <option value="America/New_York">Eastern Time (US &amp; Canada)</option>
                        <option value="Africa/Casablanca">Casablanca</option>
                        <option value="Africa/Casablanca">Monrovia</option>
                        <option value="Africa/Lagos">West Central Africa</option>
                        <option value="Africa/Cairo">Cairo</option>
                        <option value="Africa/Johannesburg">Harare</option>
                        <option value="Africa/Johannesburg">Pretoria</option>
                        <option value="Africa/Nairobi">Nairobi</option>
                    </select>
                    <div id="add_time_zone_error" class="form-text" style="display: none; color: red;">Please select
                        time zone.</div>
                </div>
                <button class="btn  orange_btn text-white" id="add_new_location">Add Location</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_location_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="update_location_id" aria-describedby="emailHelp">
                <div class="mb-3">
                    <label for="resturantlocation" class="form-label">Resturant Location</label>
                    <input type="text" class="form-control" id="update_location" aria-describedby="emailHelp">
                    <div id="update_location_error" class="form-text" style="display: none; color: red;">Please enter
                        location.</div>
                </div>
                <div class="mb-3">
                    <label for="resturantaddress" class="form-label">Resturant Address (Optional)</label>
                    <input type="text" class="form-control" id="update_address" aria-describedby="emailHelp">
                    <div id="update_address_error" class="form-text" style="display: none; color: red;">Please enter
                        address.</div>
                </div>
                <div class="mb-3">
                    <label for="time_zone" class="form-label">Restaurant Manager</label>
                    <select class="form-select" id="update_manager">
                        <?php if (!empty($restaurant_managers)) { ?>
                        <option value="0">Select Restaurant Manager</option>
                        <?php foreach ($restaurant_managers as $key => $manager) { ?>
                        <option value="<?php echo $manager['id']; ?>">
                            <?php echo $manager['firstname'] . " " . $manager['lastname']; ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please add Manager First</option>
                        <?php } ?>
                    </select>
                    <div id="update_manager_error" class="form-text" style="display: none; color: red;">Please select
                        manager.</div>
                </div>
                <div class="mb-3">
                    <label for="time_zone" class="form-label">Time Zone</label>
                    <select id="update_time_zone" class="form-select">
                        <option value="0">Please select time zone</option>
                        <option value="Asia/Karachi">Karachi</option>
                        <option value="Europe/London">London</option>
                        <option value="America/New_York">Eastern Time (US &amp; Canada)</option>
                        <option value="Africa/Casablanca">Casablanca</option>
                        <option value="Africa/Casablanca">Monrovia</option>
                        <option value="Africa/Lagos">West Central Africa</option>
                        <option value="Africa/Cairo">Cairo</option>
                        <option value="Africa/Johannesburg">Harare</option>
                        <option value="Africa/Johannesburg">Pretoria</option>
                        <option value="Africa/Nairobi">Nairobi</option>
                    </select>
                    <div id="update_time_zone_error" class="form-text" style="display: none; color: red;">Please select
                        time zone.</div>
                </div>
                <button class="btn btn-primary orange_btn text-white" id="update_new_location">Save Location</button>
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
                            <th>Resturant Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($restaurant_locations)) { ?>
                        <?php foreach ($restaurant_locations as $key => $location) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $location['location']; ?></td>
                            <td><?php echo $location['address']; ?></td>
                            <?php $location_id = $location['id']; ?>
                            <?php $location_address = $location['address'] ?>
                            <td>
                                <div class="btn-group">
                                    <button onclick="editlocation('<?php echo $location_id; ?>');"
                                        class="btn text-white orange_btn"
                                        style="min-height: unset;width:unset !important;background-color:#5dcaca !important;border-color:#5dcaca !important;"><i
                                            class="fa fa-edit"></i> Edit</button>
                                    <button style="min-height: unset;width:unset !important;"
                                        class="btn text-white orange_btn"
                                        onclick="deletelocation('<?php echo $location_id; ?>', '<?php echo $location_address; ?>');"><i
                                            class="fa fa-trash"></i> Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No location found!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div style="display: none" id="location_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$('#add_location').on('change', function() {
    $("#add_location_error").hide();
});

$('#add_address').on('change', function() {
    $("#add_address_error").hide();
});

$('#add_manager').on('change', function() {
    $("#add_manager_error").hide();
});

$('#add_time_zone').on('change', function() {
    $("#add_time_zone_error").hide();
});

$('#edit_location_modal').on('hidden.bs.modal', function() {
    $('#update_location').val("");
    $('#update_address').val("");
    $('#update_location_id').val(0);

    $('#update_manager option[value="0"]');
    $('#update_time_zone option[value="0"]');
});

$("#add_new_location_modal").on('click', function() {
    var flag = 0;
    var location = $("#add_location").val();
    var address = $("#add_address").val();
    var manager = $("#add_manager").val();
    var time_zone = $("#add_time_zone").val();

    if (location == "" || location == undefined) {
        $("#add_location_error").show();
        flag = 1;
    }

    if (address == "" || address == undefined) {
        $("#add_address_error").show();
        flag = 1;
    }

    if (manager == "" || manager == undefined || manager == 0) {
        $("#add_manager_error").show();
        flag = 1;
    }

    if (time_zone == "" || time_zone == undefined || time_zone == 0) {
        $("#add_time_zone_error").show();
        flag = 1;
    }


    if (flag == 1) {
        return false;
    } else {
        $("#add_new_location_modal").modal("hide");
        $("#location_loader").show();

        var add_url = '<?php echo base_url('restaurantlocation/handler'); ?>';
        var form_data = new FormData();



        form_data.append('location', location);
        form_data.append('address', address);
        form_data.append('manager', manager);
        form_data.append('time_zone', time_zone);
        form_data.append('action', "add_loaction");
        form_data.append('restaurant_id', <?php echo $restaurantID; ?>);

        $.ajax({
            url: add_url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(response) {
                $("#location_loader").hide();

                if (response != "error") {
                    alertify.alert('Location add successfully!', function() {
                        document.location.href = '<?= base_url("restaurantlocation") ?>';
                    });
                } else {
                    alertify.alert('Error Occurred While adding location');
                }
            },
            error: function() {}
        });
    }
});

function editlocation(location_sid) {
    var form_data = new FormData();
    form_data.append('location_id', location_sid);
    form_data.append('action', "get_loaction");
    var get_url = '<?php echo base_url('restaurantlocation/handler'); ?>';

    $.ajax({
        url: get_url,
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        data: form_data,
        success: function(response) {
            if (response.status == "error") {
                alertify.alert('Location not found');
            } else {
                var location = response.location.location;
                var address = response.location.address;
                var manager = response.location.manager_id;
                var time_zone = response.location.time_zone;

                $('#update_location').val(location);
                $('#update_address').val(address);
                $('#update_location_id').val(location_sid);
                $("#update_manager").val(manager).trigger('change');
                $("#update_time_zone").val(time_zone).trigger('change');
                $('#edit_location_modal').modal("show");
            }
        },
        error: function(data) {

        }
    });
}

$('#update_location').on('change', function() {
    $("#update_location_error").hide();
});

$('#update_address').on('change', function() {
    $("#update_address_error").hide();
});

$('#update_manager').on('change', function() {
    $("#update_manager_error").hide();
});

$('#update_time_zone').on('change', function() {
    $("#update_time_zone_error").hide();
});

$("#update_new_location").on('click', function() {
    var flag = 0;
    var location = $("#update_location").val();
    var address = $("#update_address").val();
    var manager = $("#update_manager").val();
    var time_zone = $("#update_time_zone").val();
    var location_id = $('#update_location_id').val();

    if (location == "" || location == undefined) {
        $("#update_location_error").show();
        flag = 1;
    }

    if (address == "" || address == undefined) {
        $("#update_address_error").show();
        flag = 1;
    }

    if (manager == "" || manager == undefined || manager == 0) {
        $("#update_manager_error").show();
        flag = 1;
    }

    if (time_zone == "" || time_zone == undefined || time_zone == 0) {
        $("#update_time_zone_error").show();
        flag = 1;
    }


    if (flag == 1) {
        return false;
    } else {
        $("#edit_location_modal").modal("hide");
        $("#location_loader").show();

        var update_url = '<?php echo base_url('restaurantlocation/handler'); ?>';
        var form_data = new FormData();



        form_data.append('location', location);
        form_data.append('address', address);
        form_data.append('manager', manager);
        form_data.append('time_zone', time_zone);
        form_data.append('action', "update_loaction");
        form_data.append('location_id', location_id);

        $('#update_new_location').addClass('disabled-btn');
        $('#update_new_location').prop('disabled', true);

        $.ajax({
            url: update_url,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            data: form_data,
            success: function(response) {
                $("#location_loader").hide();

                if (response != "error") {
                    alertify.alert('Location update successfully!', function() {
                        document.location.href = '<?= base_url("restaurantlocation") ?>';
                    });
                } else {
                    alertify.alert('Error Occurred While updating location');
                }
            },
            error: function() {}
        });
    }
});

$('#edit_location_modal').on('hidden.bs.modal', function() {
    $('#update_location').val("");
    $('#update_address').val("");
    $('#update_location_id').val(0);

    $('#update_manager option[value="0"]');
    $('#update_time_zone option[value="0"]');
});

function deletelocation(location_id, location_address) {
    alertify.confirm(
        'Do you really want to delete this <b>' + location_address + '</b> location"?',
        function() {
            var delete_url = '<?php echo base_url('restaurantlocation/handler'); ?>';
            var form_data = new FormData();

            form_data.append('action', "delete_loaction");
            form_data.append('location_id', location_id);

            $.ajax({
                url: delete_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response) {
                    $("#location_loader").hide();

                    if (response != "error") {
                        alertify.alert('Location delete successfully!', function() {
                            document.location.href = '<?= base_url("restaurantlocation") ?>';
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