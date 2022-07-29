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

    h3 {
        margin-bottom: 30px;
    }
    th {
        height: 30px;
        text-align: center;
    }
    td {
        height: 100px;
    }
    .today {
        background: orange;
    }
    th:nth-of-type(8), td:nth-of-type(8) {
        color: red;
    }
    th:nth-of-type(7), td:nth-of-type(7) {
        color: blue;
    }

    .week_day {
        color: #99A3A4;
    }

    .staff_schedule{
        display: block;
        background: #85C1E9;
        color: #515A5A;
        text-align: center;
        padding: 5px 0px;
        font-size: 12px;
        font-weight: 600;
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
</style>
<?
$this->load->view("restaurantportal/top_bar");
?>
<div class="title_bar flexable">
    <h1>Staff Schedule Calendar</h1>
    <button class="btn orange_btn text-white"> </i> Publish Schedule</button>
</div>


<div class="title_bar content">
    <div class="grid-flex">
        <div class="form-group">
            <select name="search" id="search" class="form-select">
                <?php if (!empty($staff_members)) { ?>
                    <option value="0">Select Staff</option>
                    <?php  foreach ($staff_members as $member) { ?>
                        <option value="<?php echo $member['id']; ?>"><?php echo $member['firstname'] .' '. $member['firstname']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="0">No Staff Found!</option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group flex">
            <label for="role">Filter By</label>
            <select name="role" id="role" class="form-select">
                <?php if (!empty($roles)) { ?>
                    <option value="0">Select Role</option>
                    <?php  foreach ($roles as $role) { ?>
                        <option value="<?php echo $role['id']; ?>"><?php echo $role['role_name']; ?></option>
                    <?php } ?>
                <?php } else { ?>
                    <option value="0">No Role Found!</option>
                <?php } ?>>
            </select>
        </div>
        <div class="form-group flex">
            <button class="btn btn-primary orange-btn mr-3"><i class="fas fa-filter"></i></button>
            <button class="btn btn-primary orange-btn"><i class="fas fa-redo"></i></button>
        </div>
    </div>
</div>

<div class="title_bar content">
    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <h3><a href="<?php echo base_url('staffhours/test'); ?>?week_number=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="<?php echo base_url('staffhours/test'); ?>?week_number=<?php echo $next; ?>">&gt;</a></h3>
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th>Mon<br><span class="week_day"><?php echo $required_week['mon']; ?></span></th>
                        <th>Tue<br><span class="week_day"><?php echo $required_week['tue']; ?></span></th>
                        <th>Wed<br><span class="week_day"><?php echo $required_week['wed']; ?></span></th>
                        <th>Thu<br><span class="week_day"><?php echo $required_week['thu']; ?></span></th>
                        <th>Fri<br><span class="week_day"><?php echo $required_week['fri']; ?></span></th>
                        <th>Sat<br><span class="week_day"><?php echo $required_week['sat']; ?></span></th>
                        <th>Sun<br><span class="week_day"><?php echo $required_week['sun']; ?></span></th>
                    </tr>
                    <?php if (!empty($staff_members)) { ?>
                        <? foreach ($staff_members as $member) { ?>
                            <?php $staff_name =  $member['firstname'] .' '. $member['firstname']; ?>
                            <tr>
                                <td>
                                    <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                                    <?php echo $staff_name; ?>
                                </td>
                                <td class="day_event"  id="<?php echo $member['id']; ?>_mon" data-day="Monday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Monday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Monday']['start_min']; ?>" end-h="<?php echo $member['timing']['Monday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Monday']['end_min']; ?>" <?php echo $member['timing']['Monday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Monday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_mon_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Monday']['display']; ?>" <?php echo $member['timing']['Monday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Monday']['start']; ?>" end="<?php echo $member['timing']['Monday']['end']; ?>">
                                            <?php echo $member['timing']['Monday']['display']; ?>
                                        </span>
                                    <?php } ?>
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_tue" data-day="Tuesday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Tuesday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Tuesday']['start_min']; ?>" end-h="<?php echo $member['timing']['Tuesday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Tuesday']['end_min']; ?>" <?php echo $member['timing']['Tuesday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Tuesday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_tue_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Tuesday']['display']; ?>" <?php echo $member['timing']['Tuesday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Tuesday']['start']; ?>" end="<?php echo $member['timing']['Tuesday']['end']; ?>">
                                            <?php echo $member['timing']['Tuesday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_wed" data-day="Wednesday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Wednesday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Wednesday']['start_min']; ?>" end-h="<?php echo $member['timing']['Wednesday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Wednesday']['end_min']; ?>" <?php echo $member['timing']['Wednesday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Wednesday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_wed_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Wednesday']['display']; ?>" <?php echo $member['timing']['Wednesday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Wednesday']['start']; ?>" end="<?php echo $member['timing']['Wednesday']['end']; ?>">
                                            <?php echo $member['timing']['Wednesday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_thu" data-day="Thursday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Thursday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Thursday']['start_min']; ?>" end-h="<?php echo $member['timing']['Thursday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Thursday']['end_min']; ?>" <?php echo $member['timing']['Thursday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Thursday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_thu_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Thursday']['display']; ?>" <?php echo $member['timing']['Thursday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Thursday']['start']; ?>" end="<?php echo $member['timing']['Thursday']['end']; ?>">
                                            <?php echo $member['timing']['Thursday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_fri" data-day="Friday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Friday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Friday']['start_min']; ?>" end-h="<?php echo $member['timing']['Friday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Friday']['end_min']; ?>" <?php echo $member['timing']['Friday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Friday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_fri_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Friday']['display']; ?>" <?php echo $member['timing']['Friday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Friday']['start']; ?>" end="<?php echo $member['timing']['Friday']['end']; ?>">
                                            <?php echo $member['timing']['Friday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_sat" data-day="Saturday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Saturday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Saturday']['start_min']; ?>" end-h="<?php echo $member['timing']['Saturday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Saturday']['end_min']; ?>" <?php echo $member['timing']['Saturday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Saturday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_sat_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Saturday']['display']; ?>" <?php echo $member['timing']['Saturday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Saturday']['start']; ?>" end="<?php echo $member['timing']['Saturday']['end']; ?>">
                                            <?php echo $member['timing']['Saturday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                                <td class="day_event" id="<?php echo $member['id']; ?>_sun" data-day="Sunday" data-staff="<?php echo $member['id']; ?>" start-h="<?php echo $member['timing']['Sunday']['start_hour']; ?>" start-m="<?php echo $member['timing']['Sunday']['start_min']; ?>" end-h="<?php echo $member['timing']['Sunday']['end_hour']; ?>" end-m="<?php echo $member['timing']['Sunday']['end_min']; ?>" <?php echo $member['timing']['Sunday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                    <?php if (!empty($member['timing']['Sunday']['display'])) { ?>
                                        <span id="<?php echo $member['id']; ?>_sun_span" class="staff_schedule" data-toggle="tooltip" data-html="true" title="This schedule timing is <?php echo $member['timing']['Sunday']['display']; ?>" <?php echo $member['timing']['Sunday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?> start="<?php echo $member['timing']['Sunday']['start']; ?>" end="<?php echo $member['timing']['Sunday']['end']; ?>">
                                            <?php echo $member['timing']['Sunday']['display']; ?>
                                        </span>
                                    <?php } ?>    
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="operationHours" tabindex="-1" aria-labelledby="operationHoursLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="operationHoursLabel">Add New time or Editing time</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="staff_time_action">
                <input type="hidden" id="section_id">
                <div class="row justify-content-centre ">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>Select Staff</label>
                    </div>
                    <div class="col-md-8 col-xl-8 col-lg-8 col-12">
                        <select id="staff_id" name="staff_id" disabled="disabled" class="form-control" style="width:242px; float:left; margin-right:10px;" placeholder="Select Staff">
                            <option value="0">Select staff member</option>
                            <?php foreach($staff_members as $member){  ?>
                                <option value="<?= $member['id'] ?>"><?= $member['email'] ?> (<?= $member['firstname'].' '.$member['lastname'] ?>)</option>
                            <?php }  ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-centre setting_upper_margin">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>Day</label>
                    </div>
                    <div class="col-md-8 col-xl-8 col-lg-8 col-12">
                        <select name="day" id="week_day" class="form-control" disabled="disabled" style="width:242px; float:left; margin-right:10px;">
                            <option value="">Please Select Day</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-centre setting_upper_margin">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>Start Time</label>
                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <select name="start_hour" id="start_hour" class="form-control" style="width:100px; float:left; margin-right:10px;">
                            <option value="00">00:00 hr</option>
                            <option value="01">01:00 hr</option>
                            <option value="02">02:00 hr</option>
                            <option value="03">03:00 hr</option>
                            <option value="04">04:00 hr</option>
                            <option value="05">05:00 hr</option>
                            <option value="06">06:00 hr</option>
                            <option value="07">07:00 hr</option>
                            <option value="08">08:00 hr</option>
                            <option value="09">09:00 hr</option>
                            <option value="10">10:00 hr</option>
                            <option value="11">11:00 hr</option>
                            <option value="12">12:00 hr</option>
                            <option value="13">13:00 hr</option>
                            <option value="14">14:00 hr</option>
                            <option value="15">15:00 hr</option>
                            <option value="16">16:00 hr</option>
                            <option value="17">17:00 hr</option>
                            <option value="18">18:00 hr</option>
                            <option value="19">19:00 hr</option>
                            <option value="20">20:00 hr</option>
                            <option value="21">21:00 hr</option>
                            <option value="22">22:00 hr</option>
                            <option value="23">23:00 hr</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <select name="start_min" id="start_min" class="form-control" style="width:80px;">
                            <option value="00" selected="selected">0 min</option>
                            <option value="15">15 min</option>
                            <option value="30">30 min</option>
                            <option value="45">45 min</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-centre setting_upper_margin">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>End Time</label>
                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <select name="end_hour" id="end_hour" class="form-control" style="width:100px; float:left; margin-right:10px;">
                            <option value="00">00:00 hr</option>
                            <option value="01">01:00 hr</option>
                            <option value="02">02:00 hr</option>
                            <option value="03">03:00 hr</option>
                            <option value="04">04:00 hr</option>
                            <option value="05">05:00 hr</option>
                            <option value="06">06:00 hr</option>
                            <option value="07">07:00 hr</option>
                            <option value="08">08:00 hr</option>
                            <option value="09">09:00 hr</option>
                            <option value="10">10:00 hr</option>
                            <option value="11">11:00 hr</option>
                            <option value="12">12:00 hr</option>
                            <option value="13">13:00 hr</option>
                            <option value="14">14:00 hr</option>
                            <option value="15">15:00 hr</option>
                            <option value="16">16:00 hr</option>
                            <option value="17">17:00 hr</option>
                            <option value="18">18:00 hr</option>
                            <option value="19">19:00 hr</option>
                            <option value="20">20:00 hr</option>
                            <option value="21">21:00 hr</option>
                            <option value="22">22:00 hr</option>
                            <option value="23">23:00 hr</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <select name="end_min" id="end_min" class="form-control" style="width:80px;">
                            <option value="00" selected="selected">0 min</option>
                            <option value="15">15 min</option>
                            <option value="30">30 min</option>
                            <option value="45">45 min</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer-new">
               <button style="background-color: #5dcaca;" id="save_staff_timing" class="btn modal_btn_width modal_btn_one">Save</button>
               <button type="button" class="btn modal_btn_width modal_btn_two" data-bs-dismiss="modal">Cancel</button>
               <button style="background-color:#F7665E; display: none;" type="button" class="btn modal_btn_width modal_btn_two" id="delete_staff_time">Delete</button>
            </div>
        </div>
    </div>
</div>

<div style="display: none" id="staff_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(".day_event").on("click", function () {
            var day         = $(this).attr("data-day");
            var staff_id    = $(this).attr("data-staff");
            var start_hour  = $(this).attr("start-h");
            var start_min   = $(this).attr("start-m");
            var end_hour    = $(this).attr("end-h");
            var end_min     = $(this).attr("end-m");
            var section_id  = $(this).attr("id");

            if (start_hour == '00' && end_hour == '00') {
                $("#staff_time_action").val('add_staff_time');
                $('#operationHoursLabel').text('Add Staff time')
                $("#delete_staff_time").hide();
            } else {
                $("#staff_time_action").val('update_staff_time');
                $('#operationHoursLabel').text('Update Staff Time')
                $("#delete_staff_time").show();
            }

            $('#staff_id option[value="'+staff_id+'"]').prop('selected', true);
            $('#week_day option[value="'+day+'"]').prop('selected', true);
            $('#start_hour option[value="'+start_hour+'"]').prop('selected', true);
            $('#start_min option[value="'+start_min+'"]').prop('selected', true);
            $('#end_hour option[value="'+end_hour+'"]').prop('selected', true);
            $('#end_min option[value="'+end_min+'"]').prop('selected', true);

            $('#section_id').val(section_id);

            $("#operationHours").modal('show');

            // alert('you can add or update schedule ' + day + ' for staff id ' + staff_id);
        });

        $("#save_staff_timing").on("click", function () {
            $("#operationHours").modal('hide');

            $("#staff_loader").show();
            var staff_id    = $('#staff_id').val();
            var day         = $('#week_day').val();
            var action      = $('#staff_time_action').val();
            var start_hour  = $('#start_hour').val();
            var start_min   = $('#start_min').val();
            var end_hour    = $('#end_hour').val();
            var end_min     = $('#end_min').val();
            var section_id  = $('#section_id').val();

            var form_data = new FormData();

            form_data.append('day', day);
            form_data.append('staff_id', staff_id);
            form_data.append('action', action);
            form_data.append('start_hour', start_hour);
            form_data.append('start_min', start_min);
            form_data.append('end_hour', end_hour);
            form_data.append('end_min', end_min);

            var update_url = '<?php echo base_url('staffhours/handler'); ?>';

            $.ajax({
                url: update_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response){
                    $("#staff_loader").hide(); 

                    if (response.status != "error") {
                        alertify.alert("Success",response.message, function(){
                            $("#"+section_id).html(response.return_html);
                            $("#"+section_id).attr( 'start-h', start_hour);
                            $("#"+section_id).attr( 'start-m', start_min);
                            $("#"+section_id).attr( 'end-h', end_hour);
                            $("#"+section_id).attr( 'end-m', end_min);
                        });
                    } else {
                        alertify.alert('Error',response.message);
                    }
                },
                error: function(){
                }
            });
        });

        $("#delete_staff_time").on("click", function () {
            $("#operationHours").modal('hide');

            $("#staff_loader").show();
            var staff_id    = $('#staff_id').val();
            var day         = $('#week_day').val();
            var action      = "delete_staff_time";
            var section_id  = $('#section_id').val();

            var form_data = new FormData();

            form_data.append('day', day);
            form_data.append('staff_id', staff_id);
            form_data.append('action', action);

            var update_url = '<?php echo base_url('staffhours/handler'); ?>';

            $.ajax({
                url: update_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response){
                    $("#staff_loader").hide(); 

                    if (response.status != "error") {
                        alertify.alert("Success",response.message, function(){
                            $("#"+section_id).html("");
                            $("#"+section_id).attr( 'start-h', "00");
                            $("#"+section_id).attr( 'start-m', "00");
                            $("#"+section_id).attr( 'end-h', "00");
                            $("#"+section_id).attr( 'end-m', "00");
                            $("#"+section_id).attr( 'ondrop', "drop(event)");
                            $("#"+section_id).attr( 'ondragover', "allowDrop(event)");
                        });
                    } else {
                        alertify.alert('Error',response.message);
                    }
                },
                error: function(){
                }
            });
        });

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("span_id", ev.target.id);
        }

        function drop(ev) {
            $("#staff_loader").show(); 
            // ev.preventDefault();
            console.log(ev)
            var span_id = ev.dataTransfer.getData('span_id');
            var section_id = ev.target.id;
            console.log(span_id);
            console.log(section_id);

            var start    = $("#"+span_id).attr("start");
            var end  = $("#"+span_id).attr("end");
            var day    = $("#"+section_id).attr("data-day");
            var staff_id  = $("#"+section_id).attr("data-staff");
        
            var form_data = new FormData();

            form_data.append('day', day);
            form_data.append('staff_id', staff_id);
            form_data.append('action', 'drop_save_time');
            form_data.append('start', start);
            form_data.append('end', end);

            var update_url = '<?php echo base_url('staffhours/handler'); ?>';

            $.ajax({
                url: update_url,
                cache: false,
                contentType: false,
                processData: false,
                type: 'post',
                data: form_data,
                success: function(response){
                    $("#staff_loader").hide(); 

                    if (response.status != "error") {
                        alertify.alert("Success",response.message, function(){
                            $("#"+section_id).html(response.return_html);
                            $("#"+section_id).attr( 'start-h', response.start_hour);
                            $("#"+section_id).attr( 'start-m', response.start_min);
                            $("#"+section_id).attr( 'end-h', response.end_hour);
                            $("#"+section_id).attr( 'end-m', response.end_min);
                            $("#"+section_id).attr( 'ondrop', "");
                            $("#"+section_id).attr( 'ondragover', "");
                        });
                    } else {
                        alertify.alert('Error',response.message);
                    }
                },
                error: function(){
                }
            });
        }
    </script>

<?
    $this->load->view("restaurantportal/footer_view");
?>