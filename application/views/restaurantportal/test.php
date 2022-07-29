<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
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
    </style>
</head>
<body>
    <div class="container">
        <h3><a href="<?php echo base_url('StaffHours/test'); ?>?week_number=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="<?php echo base_url('StaffHours/test'); ?>?week_number=<?php echo $next; ?>">&gt;</a></h3>
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
                    <tr>
                        <td>
                            <img src="<?php echo base_url() . '/images/dashboard.png'; ?>" class="table-image" alt="">
                            <?php echo $member['firstname'] .' '. $member['firstname']; ?>
                        </td>
                        <td class="day_event" data-day="Monday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Monday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Monday']; ?></b>">
                                    <?php echo $member['timing']['Monday']; ?>
                                </span>
                            <?php } ?>
                        </td>
                        <td class="day_event" data-day="Tuesday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Tuesday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Tuesday']; ?></b>">
                                    <?php echo $member['timing']['Tuesday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                        <td class="day_event" data-day="Wednesday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Wednesday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Wednesday']; ?></b>">
                                    <?php echo $member['timing']['Wednesday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                        <td class="day_event" data-day="Thursday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Thursday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Thursday']; ?></b>">
                                    <?php echo $member['timing']['Thursday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                        <td class="day_event" data-day="Friday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Friday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Friday']; ?></b>">
                                    <?php echo $member['timing']['Friday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                        <td class="day_event" data-day="Saturday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Saturday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Saturday']; ?></b>">
                                    <?php echo $member['timing']['Saturday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                        <td class="day_event" data-day="Sunday" data-staff="<?php echo $member['id']; ?>">
                            <?php if (!empty($member['timing']['Sunday'])) { ?>
                                <span class="staff_schedule" data-toggle="tooltip" data-html="true" title="<b>This schedule is for <?php echo $member['timing']['Sunday']; ?></b>">
                                    <?php echo $member['timing']['Sunday']; ?>
                                </span>
                            <?php } ?>    
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>

    <div class="modal fade" id="operationHours" tabindex="-1" aria-labelledby="operationHoursLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addtiming_form" action="<?= base_url() ?>staffhours/addtiming/" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="operationHoursLabel">Add New time or Editing time</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-centre ">
                            <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                                <label>Select Staff</label>
                            </div>
                            <div class="col-md-8 col-xl-8 col-lg-8 col-12">
                                <select required name="staff_id" class="form-control" style="width:242px; float:left; margin-right:10px;" placeholder="Select Staff">
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
                                <select name="day" class="form-control" style="width:242px; float:left; margin-right:10px;">
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
                                <select name="start_hour" class="form-control" style="width:100px; float:left; margin-right:10px;">
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
                                <select name="start_min" class="form-control" style="width:80px;">
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
                                <select name="end_hour" class="form-control" style="width:100px; float:left; margin-right:10px;">
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
                                <select name="end_min" class="form-control" style="width:80px;">
                                    <option value="00" selected="selected">0 min</option>
                                    <option value="15">15 min</option>
                                    <option value="30">30 min</option>
                                    <option value="45">45 min</option>
                                </select>
                            </div>
                            <div class="col-md-12 col-xl-12 col-lg-12 col-12">
                                <div class="form-check" style="margin-top:20px">
                                <input name="whole_week" class="form-check-input" type="checkbox" value="yes" id="whole_week_check">
                                <label class="form-check-label" for="whole_week_check">
                                    Apply to the rest of the week
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer-new">
                       <button type="submit" class="btn modal_btn_width modal_btn_one">Save</button>
                       <button style="background-color:F7665E " type="button" class="btn modal_btn_width modal_btn_two" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

    <script>
        $(".day_event").on("click", function () {
            var day = $(this).attr("data-day");
            var staff_id = $(this).attr("data-staff");
            var start_hour = $(this).attr("data-staff");
            var start_min = $(this).attr("data-staff");
            var end_hour = $(this).attr("data-staff");
            var end_min = $(this).attr("data-staff");

            $("#operationHours").modal('show');

            alert('you can add or update schedule ' + day + ' for staff id ' + staff_id);
        });
    </script>

    <!-- HTML to write -->
<!-- <a href="#" data-toggle="tooltip" title="Some tooltip text!">Hover over me</a> -->


</body>
</html>

