<?
$this->load->view("restaurantportal/header_view");
$this->load->view("restaurantportal/sidepanel_view");
$this->load->view("restaurantportal/top_bar");
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

.week-picker {
    display: none;
}

.grid_roww_schedule {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    column-gap: 10px;
}

.radio_buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.radio_buttons input {
    display: none;
}

.radio_buttons label {
    font-size: 14px;
    border: 1px solid rgba(0, 0, 0, .5);
    padding: 8px 10px;
    border-radius: 10px;
    min-width: 50px;
    align-items: center;
    text-align: center;
    transition: .3s all;
}

.radio:checked+label {
    color: #fffF;
    background-color: #37B8AC;
    border-color: #37B8AC;
}

.fc-button-group>.fc-button:not(:last-child) {
    margin-right: 10px;
}

.fc-body .fc-resource-area .fc-cell-content img {
    margin-right: 10px;
    border-radius: 50%;
    object-fit: cover;
    width: 100%;
}


.fc .fc-toolbar.fc-header-toolbar,
.fc-toolbar {

    margin-bottom: 0 !important;
    padding: 15px;
}

.fc-flat .fc-expander-space {
    display: block !important;
}

.fc-body .fc-resource-area .fc-cell-content {
    display: grid;
    grid-template-columns: 20% 75%;
    column-gap: 5%;
}

.fc-body .fc-resource-area .fc-cell-content .fc-cell-text span {
    display: block;
    line-height: 1;
}

.event_table tr th,
.event_table tr td {
    vertical-align: middle;
}

.event_table tr td {
    padding-left: 0;
    padding-right: 0;
}

.event_table tr td span.event {
    display: block;
    padding: 5px 10px;
    width: 100%;
    background-color: rgba(93, 202, 202, .3);
}

.event_table tr th span {
    font-weight: bold;
    display: block;
    font-size: 20px;
}

.event_table tr.header {
    background-color: #5dcaca;
    color: #fff;
}

.event_table tr.header td {
    font-weight: bold !important;
    color: #fff !important;
}

.event_table tr th span small {
    font-weight: normal;
    display: block;
    font-size: 12px;
    line-height: 1;
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

@media only screen and (max-width:767px) {
    .grid_roww_schedule {
        display: grid;
        grid-template-columns: repeat(1, 2fr);
        column-gap: 10px;
    }
}

@media only screen and (min-width:768px) and (max-width:800px) {
    .grid_roww_schedule {
        display: grid;
        grid-template-columns: repeat(3, 2fr);
        column-gap: 10px;
    }
}
</style>

<div class="title_bar flexable">
    <h1>View Schedule</h1>
</div>

<div class="title_bar grid_roww_schedule">
    <div class="form-group mb-2">
        <label for="" class="w-100">
            <select name="search" id="change_schedule_week" class="form-select">
                <?php if (!empty($filter_weeks)) { ?>
                <option value="0">Select Week</option>
                <?php foreach ($filter_weeks as $wkey => $week) { ?>
                <?php $current_week = $week_number == $wkey ? 'selected="selected"' : '';  ?>
                <option <?php echo $current_week; ?> value="<?php echo $wkey; ?>"><?php echo $week; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
            <form action="<?php echo base_url('staffhours/schedule'); ?>" method="post" id="form_week_filter">
                <input type="hidden" name="week_no" id="selected_week" value="" />
            </form>
        </label>
    </div>
    <div class="form-group mb-2">
        <label for="" class="w-100">
            <select name="search" id="change_schedule_staff" class="form-select">
                <?php if (!empty($staff_filter)) { ?>
                <option value="0">Select Staff</option>
                <?php foreach ($staff_filter as $member) { ?>
                <?php $current_staff = $selected_staff == $member['id'] ? 'selected="selected"' : '';  ?>
                <option <?php echo $current_staff; ?> value="<?php echo $member['id']; ?>">
                    <?php echo $member['firstname'] . ' ' . $member['lastname']; ?></option>
                <?php } ?>
                <?php } else { ?>
                <option value="0">No Staff Found!</option>
                <?php } ?>
            </select>
            <form action="<?php echo base_url('staffhours/schedule'); ?>" method="post" id="form_staff_filter">
                <input type="hidden" name="selected_staff" id="selected_staff" value="" />
            </form>
        </label>
    </div>
    <div class="form-group mb-2">
        <label for="" class="w-100">
            <select name="search" id="change_restaurant_role" class="form-select">
                <?php if (!empty($role_filter)) { ?>
                <option value="0">Select Role</option>
                <?php foreach ($role_filter as $role) { ?>
                <?php $current_role = $selected_role == $role['id'] ? 'selected="selected"' : '';  ?>
                <?php $rolename = remakeRoleCompleteName($role); ?>
                <option <?php echo $current_role; ?> value="<?php echo $role['id']; ?>"><?php echo $rolename; ?>
                </option>
                <?php } ?>
                <?php } else { ?>
                <option value="0">No Role Found!</option>
                <?php } ?>
            </select>
            <form action="<?php echo base_url('staffhours/schedule'); ?>" method="post" id="form_role_filter">
                <input type="hidden" name="restaurant_role" id="restaurant_role" value="" />
            </form>
        </label>
    </div>
    <div class="form-group mb-2">
        <a href="<?= base_url("staffhours/schedule"); ?>">
            <button class="btn btn-primary orange_btn text-white"
                style="background-color:#5dcaca;border-color:#5dcaca;width:unset !important;">Clear Filters</button>
        </a>
    </div>
    <div class="form-group mb-2" style="text-align: right; display:flex;justify-content:flex-end;">
        <form action="<?php echo base_url('staffhours/publish_schedule'); ?>" method="post" id="form_publish_schedule">
            <input type="hidden" name="selected_schedule_week" id="selected_schedule_week"
                value="<?php echo $week_number; ?>">
            <input type="hidden" name="schedule_year" value="<?php echo $current_year; ?>">
            <input type="hidden" name="schedule_staff" value="<?php echo $schedule_staff; ?>">
            <input type="hidden" name="restaurant_id" value="<?php echo $restaurantID; ?>">
            <button style="margin-right:0;" class="btn btn-primary orange_btn text-white publish_button"
                id="publish_schedule_btn">Publish Schedule</button>
        </form>
    </div>
</div>


<div class="title_bar content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table event_table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                <span>
                                    Mon
                                    <small><?php echo $required_week['mon']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Tue
                                    <small><?php echo $required_week['tue']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Wed
                                    <small><?php echo $required_week['wed']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Thu
                                    <small><?php echo $required_week['thu']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Fri
                                    <small><?php echo $required_week['fri']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Sat
                                    <small><?php echo $required_week['sat']; ?></small>
                                </span>
                            </th>
                            <th>
                                <span>
                                    Sun
                                    <small><?php echo $required_week['sun']; ?></small>
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($roles)) { ?>
                        <?php if (!empty($staff_members)) { ?>
                        <?php foreach ($roles as $role) { ?>
                        <tr class="header">
                            <td colspan="8" style="background-color: <?php echo $role['role_color']; ?>">
                                <?php echo remakeRoleCompleteName($role); ?></td>
                        </tr>
                        <?php $empty_roll = 'yes'; ?>
                        <?php foreach ($staff_members as $member) { ?>
                        <?php $member_roles = isset($member['member_roles']) ? $member['member_roles'] : array(); ?>
                        <?php if (in_array($role['id'], $member_roles)) { ?>
                        <?php $empty_roll = 'no'; ?>
                        <?php $staff_name =  $member['firstname'] . ' ' . $member['lastname']; ?>
                        <tr>
                            <td>
                                <div class="avatar">
                                    <span class="image_holder">
                                        <?php if (isset($member["profile_picture"]) && !empty($member["profile_picture"])) { ?>
                                        <img src="<?php echo base_url('uploads/restaurant/resturant_staff') . '/' . $member["profile_picture"]; ?>"
                                            class="table-image" alt="">

                                        <?php } else { ?>
                                        <img src="<?php echo base_url() . '/images/dashboard.png'; ?>"
                                            class="table-image" alt="">
                                        <?php } ?>
                                    </span>
                                    <p>
                                        <?php echo $staff_name; ?>
                                        <br>
                                        <b
                                            id="staff_total_duration_<?=$member['id']?>"><?php echo $member["total_time_duration"]; ?></b>
                                    </p>
                                </div>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_mon" data-day="Monday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Monday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Monday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Monday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Monday']['end_min']; ?>"
                                <?php echo $member['timing']['Monday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Monday']['display'])) { ?>
                                <?php 
                                                            $mon_popup = 'This schedule timing is '. $member['timing']['Monday']['display'];

                                                            if (!empty($member['timing']['Monday']['day_note'])) {
                                                                $mon_popup = $member['timing']['Monday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_mon_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $mon_popup; ?>"
                                    <?php echo $member['timing']['Monday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Monday']['start']; ?>"
                                    end="<?php echo $member['timing']['Monday']['end']; ?>">
                                    <?php echo $member['timing']['Monday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_tue" data-day="Tuesday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Tuesday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Tuesday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Tuesday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Tuesday']['end_min']; ?>"
                                <?php echo $member['timing']['Tuesday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Tuesday']['display'])) { ?>
                                <?php 
                                                            $tue_popup = 'This schedule timing is '. $member['timing']['Tuesday']['display'];

                                                            if (!empty($member['timing']['Tuesday']['day_note'])) {
                                                                $tue_popup = $member['timing']['Tuesday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_tue_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $tue_popup; ?>"
                                    <?php echo $member['timing']['Tuesday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Tuesday']['start']; ?>"
                                    end="<?php echo $member['timing']['Tuesday']['end']; ?>">
                                    <?php echo $member['timing']['Tuesday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_wed" data-day="Wednesday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Wednesday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Wednesday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Wednesday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Wednesday']['end_min']; ?>"
                                <?php echo $member['timing']['Wednesday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Wednesday']['display'])) { ?>
                                <?php 
                                                            $wed_popup = 'This schedule timing is '. $member['timing']['Wednesday']['display'];

                                                            if (!empty($member['timing']['Wednesday']['day_note'])) {
                                                                $wed_popup = $member['timing']['Wednesday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_wed_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $wed_popup; ?>"
                                    <?php echo $member['timing']['Wednesday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Wednesday']['start']; ?>"
                                    end="<?php echo $member['timing']['Wednesday']['end']; ?>">
                                    <?php echo $member['timing']['Wednesday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_thu" data-day="Thursday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Thursday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Thursday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Thursday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Thursday']['end_min']; ?>"
                                <?php echo $member['timing']['Thursday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Thursday']['display'])) { ?>
                                <?php 
                                                            $thu_popup = 'This schedule timing is '. $member['timing']['Thursday']['display'];

                                                            if (!empty($member['timing']['Thursday']['day_note'])) {
                                                                $thu_popup = $member['timing']['Thursday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_thu_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $thu_popup; ?>"
                                    <?php echo $member['timing']['Thursday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Thursday']['start']; ?>"
                                    end="<?php echo $member['timing']['Thursday']['end']; ?>">
                                    <?php echo $member['timing']['Thursday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_fri" data-day="Friday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Friday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Friday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Friday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Friday']['end_min']; ?>"
                                <?php echo $member['timing']['Friday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Friday']['display'])) { ?>
                                <?php 
                                                            $fri_popup = 'This schedule timing is '. $member['timing']['Friday']['display'];

                                                            if (!empty($member['timing']['Friday']['day_note'])) {
                                                                $fri_popup = $member['timing']['Friday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_fri_span" class="event" data-toggle="tooltip"
                                    data-html="true" title=<?php echo $fri_popup; ?>"
                                    <?php echo $member['timing']['Friday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Friday']['start']; ?>"
                                    end="<?php echo $member['timing']['Friday']['end']; ?>">
                                    <?php echo $member['timing']['Friday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_sat" data-day="Saturday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Saturday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Saturday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Saturday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Saturday']['end_min']; ?>"
                                <?php echo $member['timing']['Saturday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Saturday']['display'])) { ?>
                                <?php 
                                                            $sat_popup = 'This schedule timing is '. $member['timing']['Saturday']['display'];

                                                            if (!empty($member['timing']['Saturday']['day_note'])) {
                                                                $sat_popup = $member['timing']['Saturday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_sat_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $sat_popup; ?>"
                                    <?php echo $member['timing']['Saturday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Saturday']['start']; ?>"
                                    end="<?php echo $member['timing']['Saturday']['end']; ?>">
                                    <?php echo $member['timing']['Saturday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                            <td class="day_event" id="<?php echo $member['id']; ?>_sun" data-day="Sunday"
                                data-staff="<?php echo $member['id']; ?>"
                                start-h="<?php echo $member['timing']['Sunday']['start_hour']; ?>"
                                start-m="<?php echo $member['timing']['Sunday']['start_min']; ?>"
                                end-h="<?php echo $member['timing']['Sunday']['end_hour']; ?>"
                                end-m="<?php echo $member['timing']['Sunday']['end_min']; ?>"
                                <?php echo $member['timing']['Sunday']['allow_drop'] == 'yes' ? 'ondrop="drop(event)" ondragover="allowDrop(event)"' : ''; ?>>
                                <?php if (!empty($member['timing']['Sunday']['display'])) { ?>
                                <?php 
                                                            $sun_popup = 'This schedule timing is '. $member['timing']['Sunday']['display'];

                                                            if (!empty($member['timing']['Sunday']['day_note'])) {
                                                                $sun_popup = $member['timing']['Sunday']['day_note'];
                                                            } 
                                                        ?>
                                <span id="<?php echo $member['id']; ?>_sun_span" class="event" data-toggle="tooltip"
                                    data-html="true" title="<?php echo $sun_popup; ?>"
                                    <?php echo $member['timing']['Sunday']['allow_drop'] == 'no' ? 'draggable="true" ondragstart="drag(event)"' : ''; ?>
                                    start="<?php echo $member['timing']['Sunday']['start']; ?>"
                                    end="<?php echo $member['timing']['Sunday']['end']; ?>">
                                    <?php echo $member['timing']['Sunday']['display']; ?>
                                </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php if ($empty_roll == 'yes') { ?>
                        <tr>
                            <td colspan="8" class="text-center">Role not assigned yet</td>
                        </tr>
                        <?php } ?>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">No staff found</td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                            <td colspan="8" class="text-center">Please add staff roles</td>
                        </tr>
                        <? } ?>

                        <tr class="addmore">
                            <td>
                                <button style="min-height: 40px;" class="btn btn-primary orange_btn text-white"
                                    id="add_time">
                                    <i style="margin-right:10px;" class="fa fa-plus"></i>
                                    Add More
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.form-check {
    position: relative;
    padding-left: 0;
    margin-right: 5px;
}

.form-check.form-check-inline input {
    display: none;
}

.form-check.form-check-inline input:checked+label,
.form-check.form-check-inline label:hover {
    background-color: #5dcaca !important;
    border-color: #5dcaca !important;
    color: #fff !important;
}

.form-check.form-check-inline label {
    font-size: 16px;
    transition: .3s all;
    padding: 5px 5px;
    cursor: pointer;
    border: 1px solid rgba(0, 0, 0, .3);
    border-radius: 5px;
    width: 50px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<div class="modal fade" id="add_time_modal" tabindex="-1" aria-labelledby="operationHoursLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="operationHoursLabel">Add Staff Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <select id="new_staff_id" class="form-select">
                        <?php if (!empty($staff_filter)) { ?>
                        <option value="0">Select staff member</option>
                        <?php foreach ($staff_filter as $member) {  ?>
                        <option value="<?= $member['id'] ?>"><?= $member['email'] ?>
                            (<?= $member['firstname'] . ' ' . $member['lastname'] ?>)</option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please Add Staff</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <select name="" id="new_staff_role" class="form-select">
                        <?php if (!empty($role_filter)) { ?>
                        <option value="0">Please Select Role</option>
                        <?php foreach ($role_filter as $role) { ?>
                        <option value="<?= $role['id'] ?>"><?= remakeRoleCompleteName($role); ?></option>
                        <?php } ?>
                        <?php } else { ?>
                        <option value="0">Please Add Role</option>
                        <?php } ?>

                    </select>
                </div>
                <div class="form-group mb-3">
                    <div class="row justify-content-centre setting_upper_margin">
                        <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                            <label>Start Time</label>
                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                            <select id="new_staff_start_hour" class="form-select"
                                style="width:100px; float:left; margin-right:10px;">
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
                            <select id="new_staff_start_min" class="form-select" style="width:80px;">
                                <option value="00" selected="selected">00 min</option>
                                <option value="05">05 min</option>
                                <option value="10">10 min</option>
                                <option value="15">15 min</option>
                                <option value="20">20 min</option>
                                <option value="25">25 min</option>
                                <option value="30">30 min</option>
                                <option value="35">35 min</option>
                                <option value="40">40 min</option>
                                <option value="45">45 min</option>
                                <option value="50">50 min</option>
                                <option value="55">55 min</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-centre setting_upper_margin">
                        <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                            <label>End Time</label>
                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                            <select name="end_hour" id="new_staff_end_hour" class="form-select"
                                style="width:100px; float:left; margin-right:10px;">
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
                            <select name="end_min" id="new_staff_end_min" class="form-select" style="width:80px;">
                                <option value="00" selected="selected">00 min</option>
                                <option value="05">05 min</option>
                                <option value="10">10 min</option>
                                <option value="15">15 min</option>
                                <option value="20">20 min</option>
                                <option value="25">25 min</option>
                                <option value="30">30 min</option>
                                <option value="35">35 min</option>
                                <option value="40">40 min</option>
                                <option value="45">45 min</option>
                                <option value="50">50 min</option>
                                <option value="55">55 min</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <div class="form-group mb-2">
                        <label for="Days">Days</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="monday" type="checkbox" value="Monday">
                        <label class="form-check-label" for="monday">Mon</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="tuesday" type="checkbox" value="Tuesday">
                        <label class="form-check-label" for="tuesday">Tue</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="wednesday" type="checkbox"
                            value="Wednesday">
                        <label class="form-check-label" for="wednesday">Wed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="thursday" type="checkbox"
                            value="Thursday">
                        <label class="form-check-label" for="thursday">Thu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="friday" type="checkbox" value="Friday">
                        <label class="form-check-label" for="friday">Fri</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="saturday" type="checkbox"
                            value="Saturday">
                        <label class="form-check-label" for="saturday">Sat</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input selected_week_day" id="sunday" type="checkbox" value="Sunday">
                        <label class="form-check-label" for="sunday">Sun</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="" id="new_staff_note" class="form-control" cols="30" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer-new">
                <button style="color:white !important;" id="save_new_staff_timing"
                    class="btn modal_btn_width modal_btn_one">Save</button>
                <button type="button" class="btn modal_btn_width modal_btn_two" data-bs-dismiss="modal">Cancel</button>
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
                        <select id="staff_id" name="staff_id" disabled="disabled" class="form-control"
                            style="width:242px; float:left; margin-right:10px;" placeholder="Select Staff">
                            <?php if (!empty($staff_filter)) { ?>
                            <option value="0">Select staff member</option>
                            <?php foreach ($staff_filter as $member) {  ?>
                            <option value="<?= $member['id'] ?>"><?= $member['email'] ?>
                                (<?= $member['firstname'] . ' ' . $member['lastname'] ?>)</option>
                            <?php }  ?>
                            <?php }  ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-centre setting_upper_margin">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>Day</label>
                    </div>
                    <div class="col-md-8 col-xl-8 col-lg-8 col-12">
                        <select name="day" id="week_day" class="form-control" disabled="disabled"
                            style="width:242px; float:left; margin-right:10px;">
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
                        <select name="start_hour" id="start_hour" class="form-select"
                            style="width:100px; float:left; margin-right:10px;">
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
                        <select name="start_min" id="start_min" class="form-select" style="width:80px;">
                            <option value="00" selected="selected">00 min</option>
                            <option value="05">05 min</option>
                            <option value="10">10 min</option>
                            <option value="15">15 min</option>
                            <option value="20">20 min</option>
                            <option value="25">25 min</option>
                            <option value="30">30 min</option>
                            <option value="35">35 min</option>
                            <option value="40">40 min</option>
                            <option value="45">45 min</option>
                            <option value="50">50 min</option>
                            <option value="55">55 min</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-centre setting_upper_margin">
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <label>End Time</label>
                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                        <select name="end_hour" id="end_hour" class="form-select"
                            style="width:100px; float:left; margin-right:10px;">
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
                        <select name="end_min" id="end_min" class="form-select" style="width:80px;">
                            <option value="00" selected="selected">00 min</option>
                            <option value="15">15 min</option>
                            <option value="30">30 min</option>
                            <option value="45">45 min</option>
                            <option value="05">05 min</option>
                            <option value="10">10 min</option>
                            <option value="15">15 min</option>
                            <option value="20">20 min</option>
                            <option value="25">25 min</option>
                            <option value="30">30 min</option>
                            <option value="35">35 min</option>
                            <option value="40">40 min</option>
                            <option value="45">45 min</option>
                            <option value="50">50 min</option>
                            <option value="55">55 min</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer-new">
                <button style="background-color: #5dcaca;" id="save_staff_timing"
                    class="btn modal_btn_width modal_btn_one">Save</button>
                <button type="button" class="btn modal_btn_width modal_btn_two" data-bs-dismiss="modal">Cancel</button>
                <button style="background-color:#F7665E; display: none;" type="button"
                    class="btn modal_btn_width modal_btn_two" id="delete_staff_time">Delete</button>
            </div>
        </div>
    </div>
</div>

<div style="display: none" id="staff_loader" data-page="approver"><i class="fad fa-sync fa-spin"></i></div>

<?
$this->load->view("restaurantportal/footer_view");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
    integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
    crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
    integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
    integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-weekpicker@1.0.4/src/jquery.weekpicker.min.js"></script>
<script>
jQuery(function() {
    jQuery('.week-picker').weekpicker();
});

jQuery(document).ready(function() {
    jQuery('#date_picker').click(function() {

    });
});

$("#change_schedule_week").on("change", function() {
    var week_no = $(this).val();
    $("#selected_week").val(week_no);
    $("#selected_schedule_week").val(week_no);
    $("#form_week_filter").submit();

});

$("#change_schedule_staff").on("change", function() {
    var staff_id = $(this).val();
    $("#selected_staff").val(staff_id);
    $("#form_staff_filter").submit();

});

$("#change_restaurant_role").on("change", function() {
    var role_id = $(this).val();
    $("#restaurant_role").val(role_id);
    $("#form_role_filter").submit();

});

$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

$(".day_event").on("click", function() {
    var day = $(this).attr("data-day");
    var staff_id = $(this).attr("data-staff");
    var start_hour = $(this).attr("start-h");
    var start_min = $(this).attr("start-m");
    var end_hour = $(this).attr("end-h");
    var end_min = $(this).attr("end-m");
    var section_id = $(this).attr("id");

    if (start_hour == '00' && end_hour == '00') {
        $("#staff_time_action").val('add_staff_time');
        $('#operationHoursLabel').text('Add Staff time')
        $("#delete_staff_time").hide();
    } else {
        $("#staff_time_action").val('update_staff_time');
        $('#operationHoursLabel').text('Update Staff Time')
        $("#delete_staff_time").show();
    }

    $('#staff_id option[value="' + staff_id + '"]').prop('selected', true);
    $('#week_day option[value="' + day + '"]').prop('selected', true);
    $('#start_hour option[value="' + start_hour + '"]').prop('selected', true);
    $('#start_min option[value="' + start_min + '"]').prop('selected', true);
    $('#end_hour option[value="' + end_hour + '"]').prop('selected', true);
    $('#end_min option[value="' + end_min + '"]').prop('selected', true);

    $('#section_id').val(section_id);

    $("#operationHours").modal('show');

    // alert('you can add or update schedule ' + day + ' for staff id ' + staff_id);
});

$("#save_staff_timing").on("click", function() {
    $("#operationHours").modal('hide');

    $("#staff_loader").show();
    var staff_id = $('#staff_id').val();
    var day = $('#week_day').val();
    var action = $('#staff_time_action').val();
    var start_hour = $('#start_hour').val();
    var start_min = $('#start_min').val();
    var end_hour = $('#end_hour').val();
    var end_min = $('#end_min').val();
    var section_id = $('#section_id').val();

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
        success: function(response) {
            $("#staff_loader").hide();

            if (response.status != "error") {
                alertify.success(response.message);
                $("#" + section_id).html(response.return_html);
                $("#" + section_id).attr('start-h', start_hour);
                $("#" + section_id).attr('start-m', start_min);
                $("#" + section_id).attr('end-h', end_hour);
                $("#" + section_id).attr('end-m', end_min);
                $("#" + response.hour_key).html(response.total_duration);
                // alertify.alert("Success", response.message, function() {
                //     $("#" + section_id).html(response.return_html);
                //     $("#" + section_id).attr('start-h', start_hour);
                //     $("#" + section_id).attr('start-m', start_min);
                //     $("#" + section_id).attr('end-h', end_hour);
                //     $("#" + section_id).attr('end-m', end_min);
                // });
            } else {
                alertify.alert('Error', response.message);
            }
        },
        error: function() {}
    });
});

$("#delete_staff_time").on("click", function() {
    $("#operationHours").modal('hide');

    $("#staff_loader").show();
    var staff_id = $('#staff_id').val();
    var day = $('#week_day').val();
    var action = "delete_staff_time";
    var section_id = $('#section_id').val();

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
        success: function(response) {
            $("#staff_loader").hide();

            if (response.status != "error") {
                alertify.success(response.message);
                $("#" + section_id).html("");
                $("#" + section_id).attr('start-h', "00");
                $("#" + section_id).attr('start-m', "00");
                $("#" + section_id).attr('end-h', "00");
                $("#" + section_id).attr('end-m', "00");
                $("#" + section_id).attr('ondrop', "drop(event)");
                $("#" + section_id).attr('ondragover', "allowDrop(event)");
                // alertify.alert("Success", response.message, function() {
                //     $("#" + section_id).html("");
                //     $("#" + section_id).attr('start-h', "00");
                //     $("#" + section_id).attr('start-m', "00");
                //     $("#" + section_id).attr('end-h', "00");
                //     $("#" + section_id).attr('end-m', "00");
                //     $("#" + section_id).attr('ondrop', "drop(event)");
                //     $("#" + section_id).attr('ondragover', "allowDrop(event)");
                // });
            } else {
                alertify.alert('Error', response.message);
            }
        },
        error: function() {}
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

    var start = $("#" + span_id).attr("start");
    var end = $("#" + span_id).attr("end");
    var day = $("#" + section_id).attr("data-day");
    var staff_id = $("#" + section_id).attr("data-staff");

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
        success: function(response) {
            $("#staff_loader").hide();

            if (response.status != "error") {
                alertify.success(response.message);
                $("#" + section_id).html(response.return_html);
                $("#" + section_id).attr('start-h', response.start_hour);
                $("#" + section_id).attr('start-m', response.start_min);
                $("#" + section_id).attr('end-h', response.end_hour);
                $("#" + section_id).attr('end-m', response.end_min);
                $("#" + section_id).attr('ondrop', "");
                $("#" + section_id).attr('ondragover', "");
                $("#" + response.hour_key).html(response.total_duration);
                // alertify.alert("Success", response.message, function() {
                //     $("#" + section_id).html(response.return_html);
                //     $("#" + section_id).attr('start-h', response.start_hour);
                //     $("#" + section_id).attr('start-m', response.start_min);
                //     $("#" + section_id).attr('end-h', response.end_hour);
                //     $("#" + section_id).attr('end-m', response.end_min);
                //     $("#" + section_id).attr('ondrop', "");
                //     $("#" + section_id).attr('ondragover', "");
                // });
            } else {
                alertify.alert('Error', response.message);
            }
        },
        error: function() {}
    });
}

$("#add_time").on("click", function() {
    $("#add_time_modal").modal('show');
});

$("#save_new_staff_timing").on("click", function() {

    var staff_id = $('#new_staff_id').val();

    if (staff_id == 0) {
        alertify.alert("Warning", "Please select any Staff from list!")
        return false;
    }

    var staff_role = $('#new_staff_role').val();

    if (staff_role == 0) {
        alertify.alert("Warning", "Please select any Staff role!")
        return false;
    }

    var days = [];
    //
    $('input.selected_week_day:checkbox:checked').each(function() {
        days.push($(this).val());
    });
    //

    if (days.length === 0) {
        alertify.alert("Warning", "Please select schedule days!")
        return false;
    }

    var start_hour = $('#new_staff_start_hour').val();

    var start_min = $('#new_staff_start_min').val();
    var end_hour = $('#new_staff_end_hour').val();
    var end_min = $('#new_staff_end_min').val();
    var note = $('#new_staff_note').val();
    var action = "add_new_staff_timing";

    $("#add_time_modal").modal('hide');
    $("#staff_loader").show();

    var form_data = new FormData();

    form_data.append('days', days);
    form_data.append('staff_id', staff_id);
    form_data.append('staff_role', staff_role);
    form_data.append('action', action);
    form_data.append('start_hour', start_hour);
    form_data.append('start_min', start_min);
    form_data.append('end_hour', end_hour);
    form_data.append('end_min', end_min);
    form_data.append('note', note);

    var update_url = '<?php echo base_url('staffhours/handler'); ?>';

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
                    location.reload();
                });
            } else {
                alertify.alert('Error', response.message);
            }
        },
        error: function() {}
    });
})

$("#publish_schedule_btn").on("click", function() {
    $("#staff_loader").show();
    $("#form_publish_schedule").submit();
});
</script>