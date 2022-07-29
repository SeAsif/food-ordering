<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>
<!-- End Dialog Popups -->
<div class="title_bar title_bar_adj">
    <h1>
        Staff Hours
    </h1>
    <button type="button" class="btn default_orange_button " onclick="openHours(0,'00:00:00','00:00:00','Monday','')">
        Add New Timing
    </button>
</div>

<div class="title_bar content operational_hours">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table_layout_auto">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Staff member</th>
                            <th scope="col">Day</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                           $nCount	=	$ncounter;
                           foreach ($timings as $item){ 
                           ?>
                        <tr>
                            <td><?= $nCount; ?></td>
                            <td><?= $item["firstname"].' '.$item["lastname"]; ?><br> (<?= $item["email"] ?>)</td>
                            <td><?= $item["day"]; ?></td>
                            <td><?= $item["start"] ?></td>
                            <td><?= $item["end"] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button style="background-color:#5dcaca;width: 90px !important;"
                                        class="btn icon_btn_adj"
                                        onclick="openHours('<?= $item['id'] ?>','<?= $item['start'] ?>','<?= $item['end'] ?>','<?= $item['day'] ?>','<?= $item['staff_id'] ?>')"><i
                                            class="fa fa-pencil icon_margin"></i> Edit</button>
                                    <button style="background-color: #F7665E;width: 90px !important; "
                                        class="btn icon_btn_adj"
                                        onclick="deleteHour(<?= $item["id"] ?>,'<?= $item["day"] ?>','<?= $item["email"] ?>');"><i
                                            class="fa fa-trash icon_margin"></i> Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?
                           $nCount++;
                           } 
                           ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="show_rows_adj">
            <ul class="pagination"><?= $paginationLinks ?></ul>
        </div>
    </div>
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
                            <select required name="staff_id" class="form-select"
                                style="width:242px; float:left; margin-right:10px;" placeholder="Select Staff">
                                <option value="0">Select staff member</option>
                                <?php foreach($staff_members as $member){  ?>
                                <option value="<?= $member['id'] ?>"><?= $member['email'] ?>
                                    (<?= $member['firstname'].' '.$member['lastname'] ?>)</option>
                                <?php }  ?>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-centre setting_upper_margin">
                        <div class="col-md-4 col-xl-4 col-lg-4 col-12">
                            <label>Day</label>
                        </div>
                        <div class="col-md-8 col-xl-8 col-lg-8 col-12">
                            <select name="day" class="form-select" style="width:242px; float:left; margin-right:10px;">
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
                            <select name="start_hour" class="form-control"
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
                            <select name="end_hour" class="form-control"
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
                            <select name="end_min" class="form-control" style="width:80px;">
                                <option value="00" selected="selected">0 min</option>
                                <option value="15">15 min</option>
                                <option value="30">30 min</option>
                                <option value="45">45 min</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-xl-12 col-lg-12 col-12">
                            <div class="form-check" style="margin-top:20px">
                                <input name="whole_week" class="form-check-input" type="checkbox" value="yes"
                                    id="whole_week_check">
                                <label class="form-check-label" for="whole_week_check">
                                    Apply to the rest of the week
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-12 col-lg-12 col-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="staff_note" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-new">
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one">Save</button>
                    <button style="background-color:F7665E " type="button"
                        class="btn modal_btn_width text-white modal_btn_two" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Start Delete Popup Window Here -->
<div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addtiming_form" action="<?= base_url() ?>staffhours/deleteoperetionalhours" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_hourLabel">Delete operation hours</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure you want to delete '<span id="span_operation_hour"></span>' for staff '<span
                            id="span_staff_member"></span>'?</strong>
                </div>

                <div class="modal-footer-new">
                    <input type="hidden" name="operation_hour_id" id="operation_hour_id" value="" />
                    <button type="submit" class="btn modal_btn_width modal_btn_one">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Popup Window Here -->
</div>
<script>
function openHours(id, start, end, day, staff_id) {
    var startArr = start.split(':');
    var endArr = end.split(':');
    console.log(id, start, end);
    var url = '<?= base_url() ?>staffhours/addtiming/' + id;
    console.log(url);
    $('#addtiming_form').attr('action', url);
    $('[name=start_hour]').val(startArr[0]);
    $('[name=start_min]').val(startArr[1]);
    $('[name=end_hour]').val(endArr[0]);
    $('[name=end_min]').val(endArr[1]);
    $('[name=day]').val(day);
    $('[name=staff_id]').val(staff_id);
    $('#operationHours').modal('show');

}

function deleteHour(nItemId, strHourName, strEmail) {

    $('#delete_hour').modal('show');
    $('#span_operation_hour').html(strHourName);
    $('#span_staff_member').html(strEmail);
    $('#operation_hour_id').val(nItemId);
    return false;
}
</script>
<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
   ?>