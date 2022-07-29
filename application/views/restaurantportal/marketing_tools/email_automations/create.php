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
        Add Campaign
    </h1>
</div>

<div class=" title_bar content employe_table" style="border-bottom:none">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <style>
    .width_changed {
        width: 30%;
    }

    .grid_roww {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 25px;
    }


    .no_margin {
        margin: 0;
        height: 1px !important;
    }

    @media only screen and (max-width:575px) {
        .grid_roww {
            grid-template-columns: repeat(1, 1fr) !important;
            column-gap: 0px !important;
            row-gap: 10px !important;
        }

        .width_changed {
            width: 100% !important;
        }
    }

    @media only screen and (max-width:767px) and (min-width:575px) {


        .grid_roww {
            grid-template-columns: repeat(2, 1fr) !important;
            column-gap: 10px !important;
            row-gap: 10px !important;
        }

        .width_changed {
            width: 100% !important;
        }
    }
    </style>


    <form id="submit_form" action="javascript: void(0)">
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Campaign
            </div>
            <div class="card-body p-3">
                <div class="grid_roww">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Name</span>
                            <input type="text" class="form-control" name="name" id="name">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Subject Line</span>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Condition (send this message to registered customers based on)
            </div>
            <div class="card-body p-3">
                <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="condition" id="birthday"
                        value="Birthday">
                    <label class="form-check-label" for="birthday">Birthday</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="aniversary" value="Anniversary">
                    <label class="form-check-label" for="aniversary"> Anniversary</label>
                </div> -->
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="condition" id="registration"
                        value="Registration">
                    <label class="form-check-label" for="registration"> Registration</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="f_order" value="FirstOrder">
                    <label class="form-check-label" for="f_order"> First Order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="l_order" value="LastOrder">
                    <label class="form-check-label" for="l_order"> Last Order</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="condition" id="s_date" value="SpecificDay">
                    <label class="form-check-label" for="s_date"> Specific Day (9 AM EST)</label>
                </div>
                <span class="mt-5 d-block">How many times can a customer use the coupon?</span>
            </div>
            <hr class="no_margin">
            <div class="card-body p-3">
                <div class="grid_roww no_specific_day">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Day(s)</span>
                            <input type="number" class="form-control" disabled min="0" id="days" name="days">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="changing_text" class="mb-2"
                                style="display: block;font-weight:500;margin-bottom: 7px;">Registration</span>
                            <select name="anniversary" class=" form-select" id="no_specific_day_condition">
                                <option value="on" selected> On </option>
                                <option value="after" id="after_option"> After </option>
                                <!-- <? 
                                for($i=1; $i<=10; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                                }?> -->
                            </select>
                        </label>
                    </div>
                </div>
                <div class="grid_roww_specific_day specific_day">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Select Week</span>
                            <select name="anniversary" class=" form-select" id="">
                                <option value="select"> Select </option>
                                <option value="monday"> Monday </option>
                                <option value="Tuesday"> Tuesday </option>
                                <option value="Wednesday"> Wednesday </option>
                                <option value="Thrusday"> Thrusday </option>
                                <option value="Friday"> Friday </option>
                                <option value="Saturday"> Saturday </option>
                                <option value="Sunday"> Sunday </option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Day(s)</span>
                            <input type="number" disabled class="form-control" id="specific_days" min="0" name="days">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2"
                                style="display: block;font-weight:500;margin-bottom: 7px;">Condition</span>
                            <select name="specific_day_condition" class=" form-select" id="specific_day_condition">
                                <option value="on" selected> On </option>
                                <option value="before"> Before </option>
                                <option value="after"> After </option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Select Date</span>
                            <input type="date" class="form-control" name="select_date">
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Compose Email
            </div>
            <div class="card-body p-3">
                <textarea name="editor1"></textarea>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Include a coupon code?
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label class="font_family width_changed" for="coupon">
                        <!-- <span class="mb-2" style="display: block;font-weight:500;">How Many Times</span> -->
                        <select name="coupon_id" class=" form-select" id="">
                            <option value="">Select</option>
                            <? 
                            if(!empty($coupons)){
                                foreach($coupons as $key=>$value){
                                echo '<option value="'.$value->id.'">'.$value->code.'</option>';
                                }
                            }
                          ?>

                        </select>
                        <!-- <input type="text" class="form-control"> -->
                    </label>
                    <span class="red d-block mt-2">The selected coupon can only be redeemed by only recipients.</span>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Duration
            </div>
            <div class="card-body p-3">
                <div class="grid_roww_duration">
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">Start Date</span>
                            <input type="date" class="form-control" name="start_date">
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="font_family w-100" for="coupon">
                            <span class="mb-2" style="display: block;font-weight:500;">End Date</span>
                            <input type="date" class="form-control" name="end_date">
                        </label>
                    </div>
                    <div class="form-group" style="display: flex;align-items:flex-end;height:100%;">
                        <span style="display: block;margin-right:20px;">Or</span>
                        <div class="form-check mb-0">
                            <input class="form-check-input coupon_checkbox" type="checkbox" name="is_never_expire"
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Never Expires
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Enable Campaign
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="status" id="inlineRadio1" value="Active">
                    <label class="form-check-label" for="inlineRadio1">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Inactive">
                    <label class="form-check-label" for="inlineRadio2"> Inactive</label>
                </div>
            </div>
        </div>



        <input type="submit" class="btn  orange_btn text-white mb-4" value="Submit">

    </form>
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
                    <strong>Are you want to delete Coupon </strong>
                </div>

                <div class="modal-footer-new">
                    <input type="hidden" name="operation_hour_id" id="operation_hour_id" value="" />
                    <button type="submit" class="btn modal_btn_width text-white modal_btn_one">Delete</button>
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
$(".specific_day").hide();
var ckfield = CKEDITOR.replace('editor1');
ckfield.on('change', function() {
    ckfield.updateElement();
});
$("#no_specific_day_condition").change(function() {
    var specific_day_val = $("#no_specific_day_condition").val();
    console.log(specific_day_val);
    if (specific_day_val == "before") {
        $("#days").attr("disabled", false);
    } else if (specific_day_val == "after") {
        $("#days").attr("disabled", false);
    } else if (specific_day_val == "on") {
        $("#days").attr("disabled", true);
    }
})
$("#specific_day_condition").change(function() {
    var specific_day_val = $("#specific_day_condition").val();
    if (specific_day_val == "before") {
        $("#specific_days").attr("disabled", false);
    } else if (specific_day_val == "after") {
        $("#specific_days").attr("disabled", false);
    } else if (specific_day_val == "on") {
        $("#specific_days").attr("disabled", true);
    }
})
var condition = $('input[name="condition"]:checked').val();
$('input[name="condition"]').click(function() {
    var condition = $('input[name="condition"]:checked').val();
    if (condition == "FirstOrder") {
        $('.changing_text').text("First Order");
        $('#dropdownid').val('selectedvalue');
        $(".no_specific_day").show();
        $(".specific_day").hide();
        $("#after_option").show();
    } else if (condition == "LastOrder") {
        $('.changing_text').text("Last Order");
        $(".no_specific_day").show();
        $(".specific_day").hide();
        $("#after_option").hide();

    } else if (condition == "Registration") {
        $('.changing_text').text("Registration");
        $(".no_specific_day").show();
        $(".specific_day").hide();
        $("#after_option").show();
    } else if (condition == "SpecificDay") {
        $(".no_specific_day").hide();
        $(".specific_day").show();
    }
})
</script>
<script type="text/javascript">
$("#submit_form").submit(function(e) {
    e.preventDefault();
    var formData = $("#submit_form").serialize();

    $.ajax({
        type: 'POST',
        url: '<?= base_url() . "marketingtools/store_campaign" ?>',
        data: formData,
        success: function(data) {
            console.log(data)
            if (data.status == "success") {
                var return_message = '<div class="alert alert-success" role="alert">' + data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                setTimeout(() => {
                    window.location.href =
                        "<?= base_url() . "marketingtools/email_automations"; ?>"
                }, 1000);
            } else {

                var return_message = '<div class="alert alert-danger" role="alert">' + data
                    .message + '</div>';
                $("#return_message").show();
                $("#return_message").append(return_message);
                setTimeout(() => {
                    $("#return_message").hide();
                }, 5000);
            }
        },
        complete: function() {
            $('body, html').animate({
                scrollTop: $('#return_message').top
            }, 'slow');
        }

    });
});
</script>

<?
   $this->load->view("restaurantportal/footer_view");
   ?>