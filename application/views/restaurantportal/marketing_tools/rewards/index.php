<?
   $this->load->view("restaurantportal/header_view");
   $this->load->view("restaurantportal/sidepanel_view");
   ?>
<?
$this->load->view("restaurantportal/top_bar");
?>

<!-- End Dialog Popups -->
<div class="title_bar title_bar_adj">

    <div class="row" style="width:100%">
        <div class="col-sm-6">
            <h1>Rewards</h1>
        </div>
        <div class="col-sm-6 ">
            <div class="flex_btn" style="float:right">
                <button class="btn default_orange_button  btn_margin_bottom mob_btn_font" data-bs-toggle="modal"
                    data-bs-target="#reward_settings" style="width: fit-content !important;">Loyality Reward
                    Settings</button>
                <a href="<?= base_url('marketingtools') . "/create_reward" ?>"
                    class="btn default_orange_button  mob_btn_font">Add New Reward</a>
            </div>
        </div>
    </div>

</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class=" title_bar content employe_table">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <div class="card card_width ">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tble_layout_auto">
                    <thead>
                        <tr>
                            <th scope="col">Reward</th>
                            <th scope="col">Description</th>
                            <th scope="col">Req. Points</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                        <? if(!empty($rewards)){
                        foreach($rewards as $key=>$value){
                        ?>

                        <tr>
                            <td>
                                <? echo $value->title;?>
                            </td>
                            <td>
                                <? echo $value->description;?>
                            </td>
                            <td>
                                <? echo $value->points;?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url() . "marketingtools/edit_reward/".$value->id; ?>"
                                        style=" background-color: #5dcaca; " class="btn margin_top_stng icon_btn_adj"><i
                                            class="fas fa-edit icon_margin"></i> Edit</a>
                                    <!-- <button class="disable-active btn margin_top_stng icon_btn_adj">Activate</button> -->

                                    <button style="background-color: #F7665E;" class="btn icon_btn_adj"
                                        onclick="open_model('<? echo $value->id;?>');"><i
                                            class=" fa fa-trash icon_margin"></i> Delete</button>
                                </div>

                            </td>
                        </tr>
                        <?
                    }
                }?>

                    </tbody>
                </table>
            </div>

        </div>
        <? 

  
  if(!empty($loyality_settings))
  {

     ?>
        <!-- Start Loyality Reward Settings  Popup Window Here -->
        <div class="modal fade" id="reward_settings" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form id="submit_form_loyality" action="javascript: void(0)">
                <input type="hidden" name="id" value="<? echo $loyality_settings->id ?? null; ?>">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Loyality Reward Settings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Turn ON/OFF Loyality Program
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <? echo
                                                    $loyality_settings->status=="On"? 'checked':'' ;?> name="status"
                                                id="on" value="On">
                                                <label class="form-check-label" for="on">On</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <? echo
                                                    $loyality_settings->status=="Off"? 'checked':'' ;?> name="status"
                                                id="off"
                                                value="Off">
                                                <label class="form-check-label" for="inactive"> Off</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Customer's points based on ?
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <? echo
                                                    $loyality_settings->based_on=="Dollars"? 'checked':'' ;?>
                                                name="based_on" id="Dollars"
                                                value="Dollars">
                                                <label class="form-check-label" for="Dollars">Dollars Spent</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <? echo
                                                    $loyality_settings->based_on=="Orders"? 'checked':'' ;?>
                                                name="based_on" id="Orders"
                                                value="Orders">
                                                <label class="form-check-label" for="Orders"> Orders Placed</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Conversion Rate
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-sm-4 flex_row"><span
                                                        class="select_span conversion">₦</span> <input type="text"
                                                        class="form-control" name="conversion_value"
                                                        value="<? echo  $loyality_settings->conversion_value;?>">
                                                </div>
                                                <div class="col-sm-1 center_text " style="text-align: center "><span> =
                                                    </span>
                                                </div>
                                                <div class="col-sm-4 flex_row"><span class="select_span"></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter conversion rate" name="conversion_rate"
                                                        value="<? echo  $loyality_settings->conversion_rate;?>">
                                                </div>
                                                <div class="col-sm-3 center_text">points (Conversation Ratio is 0.25)
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Calculate points based on
                                            <? $calculation_based= $loyality_settings->calculation_based;?>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="calculation_based"
                                                    id="active" value="Subtotal" <? echo $calculation_based=="Subtotal"
                                                    ? 'checked' :'' ;?>>
                                                <label class="form-check-label" for="active">Subtotal or</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <? echo
                                                    $calculation_based=="Total" ? 'checked' :'' ;?>
                                                name="calculation_based"
                                                id="inactive" value="Total" >
                                                <label class="form-check-label" for="inactive"> Total ( Iclude
                                                    Tax,Gratuity,Delivery
                                                    Charges )</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Enter the Terms and Conditions of your Loyality Program
                                        </div>
                                        <div class="card-body p-3">
                                            <textarea
                                                name="editor1"> <? echo $loyality_settings->termconditions;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title_bar flexable" id="return_message_m" style="display:none"></div>
                        <div class="modal-footer reward_modal_footer">

                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button> -->
                            <input type="submit" class="btn orange_btn text-white mb-4" value="Submit" onclick="Save()">
                            <button class="btn margin_top_stng icon_btn_adj" style="margin-bottom: 23px;"
                                data-bs-dismiss="modal" aria-label="Close">
                                Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?} else {?>


        <div class="modal fade" id="reward_settings" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form id="submit_form_loyality" action="javascript: void(0)">
                <input type="hidden" name="id">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Loyality Reward Settings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Turn ON/OFF Loyality Program
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked name="status"
                                                    id="on" value="On">
                                                <label class="form-check-label" for="on">On</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="off"
                                                    value="Off">
                                                <label class="form-check-label" for="inactive"> Off</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Customer's points based on ?
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked name="based_on"
                                                    id="Dollars" value="Dollars">
                                                <label class="form-check-label" for="Dollars">Dollars Spent</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="based_on" id="Orders"
                                                    value="Orders">
                                                <label class="form-check-label" for="Orders"> Orders Placed</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Conversion Rate
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="row">
                                                <div class="col-sm-4 flex_row"><span
                                                        class="select_span conversion">₦</span> <input type="text"
                                                        class="form-control" name="conversion_value">
                                                </div>
                                                <div class="col-sm-1 center_text " style="text-align: center "><span> =
                                                    </span>
                                                </div>
                                                <div class="col-sm-4 flex_row"><span class="select_span"></span>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter conversion rate" name="conversion_rate">
                                                </div>
                                                <div class="col-sm-3 center_text">points (Conversation Ratio is 0.25)
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Calculate points based on
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked
                                                    name="calculation_based" id="active" value="Subtotal">
                                                <label class="form-check-label" for="active">Subtotal or</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked
                                                    name="calculation_based" id="inactive" value="Total">
                                                <label class="form-check-label" for="inactive"> Total ( Iclude
                                                    Tax,Gratuity,Delivery
                                                    Charges )</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card card_width mb-4">
                                        <div class="card-header"
                                            style="background-color: transparent;font-weight: 500;">
                                            Enter the Terms and Conditions of your Loyality Program
                                        </div>
                                        <div class="card-body p-3">
                                            <textarea name="editor1"> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="title_bar flexable" id="return_message_m" style="display:none"></div>
                        <div class="modal-footer reward_modal_footer">

                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button> -->
                            <input type="submit" class="btn orange_btn text-white mb-4" value="Submit" onclick="Save()">
                            <button class="btn margin_top_stng icon_btn_adj" style="margin-bottom: 23px;"
                                data-bs-dismiss="modal" aria-label="Close">
                                Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?}?>
    </div>

    <!-- Start Delete Popup Window Here -->
    <div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="submit_form" action="javascript: void(0)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete_hourLabel">Delete operation hours</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong>Are you want to delete Coupon </strong>
                    </div>
                    <div class="title_bar flexable" id="return_message_m_m" style="display:none"></div>
                    <div class="modal-footer-new">

                        <input type="hidden" name="row_id" id="row_id" />
                        <button type="submit" class="btn modal_btn_width text-white modal_btn_one"
                            onclick="delete_row()">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Delete Popup Window Here -->
</div>
<!-- End Mid Right -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
var ckfield = CKEDITOR.replace('editor1');
ckfield.on('change', function() {
    ckfield.updateElement();
});
</script>
<script>
$(document).ready(function() {
    $("#Dollars").change(function() {
        if ($('#Dollars').attr('checked')) {
            $(".conversion").text("₦")

        }
    });

    $("#Orders").change(function() {
        if ($('#Orders').attr('checked')) {
            $(".conversion").text("Orders")
        }
    });
});

function open_model(id) {
    $("#delete_hour").modal('show');
    $("#row_id").val(id);
}

function delete_row() {

    var formData = $("#submit_form").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/delete_reward" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m_m").show();
                $("#return_message_m_m").append(return_message);
                setTimeout(() => {
                    $("#delete_hour").modal('hide');
                    window.location.href =
                        "<?= base_url() . "marketingtools/rewards"; ?>"
                }, 5000);
            } else {
                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m_m").show();
                $("#return_message_m_m").append(return_message);
            }
        },



    });
}


function Save() {

    var formData = $("#submit_form_loyality").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/loyality_settings" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m").show();
                $("#return_message_m").append(return_message);

                setTimeout(() => {
                    $("#delete_hour").modal('hide');
                    window.location.href =
                        "<?= base_url() . "marketingtools/rewards"; ?>"
                }, 5000);
            } else {
                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message_m").show();
                $("#return_message_m").append(return_message);
                setTimeout(() => {
                    $("#return_message_m").hide();
                }, 5000);
            }
        },



    });
}
</script>
<?
   $this->load->view("restaurantportal/footer_view");
   ?>