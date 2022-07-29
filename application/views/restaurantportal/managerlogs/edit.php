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
        Daily Logs
    </h1>
</div>
<div class="title_bar flexable" id="return_message" style="display:none">

</div>
<div class="title_bar flexable">
    <form class="row  align-items-center" id="data_picker">
        <div class="col-lg-12 col-sm-12 col-xs-12 div_inline">
            <label for="birthday">Select Date:</label>
            <input class="date_adj form-control" type="date" id="log_date" name="log_date"
                value="<? echo $log->log_date;?>">
        </div>

    </form>
</div>
<div class=" title_bar content employe_table">
    <?
            $this->load->view("restaurantportal/messages");
            ?>
    <style>
    .accordion-button:not(.collapsed) {
        color: inherit !important;
        background-color: inherit !important;
    }

    .accordion-button:focus {
        border-color: transparent !important;
        box-shadow: 0 0 0 0.25rem transparent !important;
    }

    .border_bottom {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .float_element {
        float: right;
    }

    .flex_row {
        display: flex;
        align-items: center;
    }

    .card_width {
        border-radius: 15px !important;
    }

    .date_adj {
        max-width: 250px !important;
        width: 250px;
        height: 38px;
        border-radius: 10px !important;
        margin-left: 5px;
        border: 1px solid #ced4da !important;
        padding: 10px;
    }

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
        height: 5px !important;
    }

    input[type=date]:focus-visible {
        border: none !important;
    }

    .accordion-button:hover {
        color: black !important
    }

    .accordion-button {
        font-weight: 600 !important;
    }


    .accordion-collapse {
        border: None !important;
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
        <input type="hidden" name="id" value="<? echo $log->id;?>">
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Deposit Drop
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Code</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">#</p><input type="text"
                                                class="form-control input_width" name="deposit_drop_code"
                                                id="deposit_drop_code" value="<? echo $log->deposit_drop_code;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Amount</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">₦</p><input type="text"
                                                pattern="[\-\+]?[0-9]*(\.[0-9]+)?" class="form-control input_width"
                                                name="deposit_drop_amount" id="deposit_drop_amount"
                                                value="<? echo $log->deposit_drop_amount;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapseOne">
                            Petty Cash
                        </button>
                    </h2>
                    <div id="collapsetwo" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Amount</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">₦</p><input type="text"
                                                pattern="[\-\+]?[0-9]*(\.[0-9]+)?" class="form-control input_width"
                                                name="petty_cash_amount" id="petty_cash_amount"
                                                value="<? echo $log->petty_cash_amount;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Description</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"></p><input type="text"
                                                class="form-control input_width" name="petty_cash_description"
                                                id="petty_cash_description"
                                                value="<? echo $log->petty_cash_description;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                            Breakfast
                        </button>
                    </h2>
                    <div id="collapsefour" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3 col-xl-3 col-md-4"> <label>Sales</label></div>
                                        <div class="col-sm-9 col-xl-9 col-md-8">
                                            <p class="span_width">₦</p><input type="text"
                                                pattern="[\-\+]?[0-9]*(\.[0-9]+)?" class="form-control input_width"
                                                name="breakfast_sales" id="breakfast_sales" value="<? echo $log->breakfast_sales;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3 col-xl-3 col-md-4"> <label>Guest Count</label></div>
                                        <div class="col-sm-9 col-xl-9 col-md-8">
                                            <p class="span_width"></p><input type="text" pattern="[0-9]*"
                                                class="form-control input_width" name="breakfast_guest_count"  value="<? echo $log->breakfast_guest_count;?>"
                                                id="breakfast_guest_count" value="0" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsefour" aria-expanded="true" aria-controls="collapseOne">
                            Lunch
                        </button>
                    </h2>
                    <div id="collapsefour" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Sales</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">₦</p><input type="text"
                                                class="form-control input_width" name="lunch_sales" id="lunch_sales"
                                                value="<? echo $log->lunch_sales;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Guest Count</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"></p><input type="text"
                                                class="form-control input_width" name="lunch_guest_count"
                                                id="lunch_guest_count" value="<? echo $log->lunch_guest_count;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsefive" aria-expanded="true" aria-controls="collapseOne">
                            Dinner
                        </button>
                    </h2>
                    <div id="collapsefive" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Sales</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">₦</p><input type="text"
                                                class="form-control input_width" name="dinner_sales" id="dinner_sales"
                                                value="<? echo $log->dinner_sales;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Guest Count</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"></p><input type="text"
                                                class="form-control input_width" name="dinner_guest_count"
                                                id="dinner_guest_count" value="<? echo $log->dinner_guest_count;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsethree" aria-expanded="true" aria-controls="collapseOne">
                            Daily
                        </button>
                    </h2>
                    <div id="collapsethree" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row " style="margin-bottom: 15px;">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Sales</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width">₦</p><input type="text"
                                                pattern="[\-\+]?[0-9]*(\.[0-9]+)?" class="form-control input_width"
                                                name="daily_sales" id="daily_sales"
                                                value="<? echo $log->daily_sales;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Guest Count</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"></p><input type="text" pattern="[0-9]*"
                                                class="form-control input_width" name="daily_guest_count"
                                                id="daily_guest_count" value="<? echo $log->daily_guest_count;?>" />
                                            <p class="span_width"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Labor</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"> </p><input type="text" pattern="[0-9]*"
                                                class="form-control input_width" name="daily_labor" id="daily_labor"
                                                value="<? echo $log->daily_labor;?>" />
                                            <p class="span_width"> % </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="row flex_row">
                                        <div class="col-sm-3"> <label>Food</label></div>
                                        <div class="col-sm-9">
                                            <p class="span_width"></p><input type="text" pattern="[0-9]*"
                                                class="form-control input_width" name="daily_food" id="daily_food"
                                                value="<? echo $log->daily_food;?>" />
                                            <p class="span_width"> % </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsesix" aria-expanded="true" aria-controls="collapseOne">
                            Repair and Maintenance
                        </button>
                    </h2>
                    <div id="collapsesix" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <textarea class="form-control" rows="5" name="repair_and_mentenance"
                                    id="repair_and_mentenance"> <? echo $log->repair_and_mentenance;?> </textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_seven" aria-expanded="true" aria-controls="collapseOne">
                            Personal Issues
                        </button>
                    </h2>
                    <div id="collapse_seven" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <textarea class="form-control" rows="5" name="personal_issues"
                                    id="personal_issues"><? echo $log->personal_issues;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_eight" aria-expanded="true" aria-controls="collapseOne">
                            Customer Feedback
                        </button>
                    </h2>
                    <div id="collapse_eight" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <textarea class="form-control" rows="5" name="customer_feedback"
                                    id="customer_feedback"><? echo $log->customer_feedback;?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card_width mb-4">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header border_bottom" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse_nine" aria-expanded="true" aria-controls="collapseOne">
                            Action Taken
                        </button>
                    </h2>
                    <div id="collapse_nine" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row ">
                                <textarea class="form-control" rows="5" name="action_taken"
                                    id="action_taken"><? echo $log->action_taken;?></textarea>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-12 ">
                <input type="submit" class="btn default_orange_button text-white mb-4" value="Save Changes">
            </div>
        </div>
    </form>
</div>

<!-- Start Delete Popup Window Here -->

<!-- End Delete Popup Window Here -->
</div>
<!-- End Mid Right -->
<?
   $this->load->view("restaurantportal/footer_view");
   ?>


<script type="text/javascript">
$(document).ready(function() {

    var lunch_sales = $("#lunch_sales");
    var lunch_guest_count = $("#lunch_guest_count");
    var dinner_sales = $("#dinner_sales");
    var dinner_guest_count = $("#dinner_guest_count");

    var daily_sales = $("#daily_sales");
    var daily_guest_count = $("#daily_guest_count");


    var breakfast_sales = $("#breakfast_sales");
    var breakfast_guest_count = $("#breakfast_guest_count");
    


    breakfast_sales.blur(function() {

    const total_breakfast_sales = $("#breakfast_sales").val();
    const total_breakfast_guest_count = $("#breakfast_guest_count").val();
    const total_lunch_sales = $("#lunch_sales").val();
    const total_lunch_guest_count = $("#lunch_guest_count").val();
    const total_dinner_sales = $("#dinner_sales").val();
    const total_dinner_guest_count = $("#dinner_guest_count").val();
    const sales = parseInt(total_breakfast_sales)+parseInt(total_lunch_sales) + parseInt(total_dinner_sales);
    daily_sales.val(sales);
    const guest = parseInt(total_breakfast_guest_count)+parseInt(total_lunch_guest_count) + parseInt(total_dinner_guest_count);
    daily_guest_count.val(guest);
    });



    lunch_sales.blur(function() {

        const total_breakfast_sales = $("#breakfast_sales").val();
        const total_breakfast_guest_count = $("#breakfast_guest_count").val();
        const total_lunch_sales = $("#lunch_sales").val();
        const total_lunch_guest_count = $("#lunch_guest_count").val();
        const total_dinner_sales = $("#dinner_sales").val();
        const total_dinner_guest_count = $("#dinner_guest_count").val();
        const sales = parseInt(total_breakfast_sales)+parseInt(total_lunch_sales) + parseInt(total_dinner_sales);
        daily_sales.val(sales);
        const guest = parseInt(total_breakfast_guest_count)+parseInt(total_lunch_guest_count) + parseInt(total_dinner_guest_count);
        daily_guest_count.val(guest);
    });

    lunch_guest_count.blur(function() {
       
        const total_breakfast_sales = $("#breakfast_sales").val();
        const total_breakfast_guest_count = $("#breakfast_guest_count").val();
        const total_lunch_sales = $("#lunch_sales").val();
        const total_lunch_guest_count = $("#lunch_guest_count").val();
        const total_dinner_sales = $("#dinner_sales").val();
        const total_dinner_guest_count = $("#dinner_guest_count").val();
        const sales = parseInt(total_breakfast_sales)+parseInt(total_lunch_sales) + parseInt(total_dinner_sales);
        daily_sales.val(sales);
        const guest = parseInt(total_breakfast_guest_count)+parseInt(total_lunch_guest_count) + parseInt(total_dinner_guest_count);
        daily_guest_count.val(guest);
    });

    dinner_sales.blur(function() {
     
        const total_breakfast_sales = $("#breakfast_sales").val();
        const total_breakfast_guest_count = $("#breakfast_guest_count").val();
        const total_lunch_sales = $("#lunch_sales").val();
        const total_lunch_guest_count = $("#lunch_guest_count").val();
        const total_dinner_sales = $("#dinner_sales").val();
        const total_dinner_guest_count = $("#dinner_guest_count").val();
        const sales = parseInt(total_breakfast_sales)+parseInt(total_lunch_sales) + parseInt(total_dinner_sales);
        daily_sales.val(sales);
        const guest = parseInt(total_breakfast_guest_count)+parseInt(total_lunch_guest_count) + parseInt(total_dinner_guest_count);
        daily_guest_count.val(guest);
    });


    dinner_guest_count.blur(function() {
      
        const total_breakfast_sales = $("#breakfast_sales").val();
        const total_breakfast_guest_count = $("#breakfast_guest_count").val();
        const total_lunch_sales = $("#lunch_sales").val();
        const total_lunch_guest_count = $("#lunch_guest_count").val();
        const total_dinner_sales = $("#dinner_sales").val();
        const total_dinner_guest_count = $("#dinner_guest_count").val();
        const sales = parseInt(total_breakfast_sales)+parseInt(total_lunch_sales) + parseInt(total_dinner_sales);
        daily_sales.val(sales);
        const guest = parseInt(total_breakfast_guest_count)+parseInt(total_lunch_guest_count) + parseInt(total_dinner_guest_count);
        daily_guest_count.val(guest);
    });


    $("#submit_form").submit(function(e) {
        e.preventDefault();
        var formData = $("#submit_form").serialize() + "&" + $("#data_picker").serialize();
        var log_date = $("#log_date").val();
        //formData.append("log_date",log_date);
        $.ajax({
            type: 'POST',
            url: '<?= base_url() . "managerlogbook/update" ?>',
            data: formData,
            success: function(data) {
                console.log(data);
                if (data.status == "success") {
                    $("#return_message").scrollTop();
                    var return_message = '<div class="alert alert-success" role="alert">' +
                        data.message + '</div>';
                    $("#return_message").show();
                    $("#return_message").append(return_message);
                    setTimeout(() => {
                        window.location.href =
                            "<?= base_url() . "managerlogbook/list/"; ?>"
                    }, 1000);
                } else {
                    var return_message = '<div class="alert alert-danger" role="alert">' +
                        data.message + '</div>';
                    $("#return_message").show();
                    $("#return_message").append(return_message);
                    setTimeout(() => {
                        $("#return_message").hide();
                    }, 5000);
                }
            },
            complete: function() {
                $('body, html').animate({
                    scrollTop: $('#data_picker').top
                }, 'slow');
            }
        });
    });
});
</script>