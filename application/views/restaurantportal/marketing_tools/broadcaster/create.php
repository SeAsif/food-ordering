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
        Add Broadcast
    </h1>
</div>
<div class="title_bar flexable" id="return_message" style="display:none"></div>
<div class=" title_bar content employe_table" style="border-bottom:none">
    <?
    $this->load->view("restaurantportal/messages");
    ?>
    <style>
    .width_changed {
        width: 30%;
    }

    .date_adj {
        max-width: 350px !important;
        width: 350px;
        height: 38px;
        border-radius: 10px !important;
        margin-left: 5px;
        border: 1px solid #ced4da !important;
        padding: 10px;
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
                BroadCast
            </div>
            <div class="card-body p-3">
                <div class="form-group">
                    <label class="font_family width_changed" for="coupon">
                        <span class="mb-2" style="display: block;font-weight:500;">Name</span>
                        <input type="text" class="form-control" name="name" id="name">
                    </label>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Allow Ordering
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="is_open" id="is_open" value="Enable">
                    <label class="form-check-label" for="inlineRadio1">Enable</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_open" id="inlineRadio2" value="Disable">
                    <label class="form-check-label" for="inlineRadio2"> Disable</label>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Turn ON/OFF broadcast?
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="is_on" id="on" value="On">
                    <label class="form-check-label" for="on">On</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_on" id="off" value="Off">
                    <label class="form-check-label" for="off">Off</label>
                </div>
            </div>

        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                Run this broadcast on certain:
            </div>
            <div class="card-body p-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="duration" id="active" value="Days">
                    <label class="form-check-label" for="active">Days(s)</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="duration" id="inactive" value="Range">
                    <label class="form-check-label" for="inactive">Date Range</label>
                </div>
                <div class="row">
                    <div class=" row date-range  ">
                        <div class="col-lg-6  col-sm-12 col-xl-6 col-md-6 col-12">
                            <div class="form-group ">
                                <label class="font_family broad_start_date_width" for="start-date">
                                    <span class="mb-2" style="font-weight:500;">From:</span>
                                    <input type="date" class="form-control " id="log_date" name="date_range_start">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6  col-sm-12 col-md-6 col-12 ">
                            <div class="form-group broad_end_date_margin">
                                <label class="font_family broad_end_date_width" for="coupon">
                                    <span class="mb-2" style="font-weight:500;" name="end_time">To</span>
                                    <input type="date" class="form-control " name="date_range_end">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6  col-xl-6 col-md-6 col-12 week-days">
                        <? 
                        $dt = new DateTime();
                        $dates = [];
                        for ($d = 1; $d <= 7; $d++) {
                        $dt->setISODate($dt->format('o'), $dt->format('W'), $d);
                        echo  '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" checked name="current_date" id="yes" value="'.$dt->format('Y-m-d').'">
                        <label class="form-check-label" for="yes">'.substr($dt->format('D'),0,1).'</label></div>';
                        }
                        ?>
                    </div>

                    <div class="col-sm-12 col_mrg_btm">
                        <div class="form-check">
                            <input name="alla_day" type="hidden" value="No" />
                            <input class="form-check-input checkbox_adj" name="all_day" type="checkbox" />
                            <label class="form-check-label " for="flexCheckDefault">
                                All Day
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6  col-xl-6 col-md-6 col-12">
                        <div class="form-group ">
                            <label class="font_family w-75" for="coupon">
                                <span class="mb-2" style="font-weight:500;">From</span>
                                <input type="time" class="form-control time_range" name="start_time">
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                        <div class="form-group ">
                            <label class="font_family w-75" for="coupon">
                                <span class="mb-2" style="font-weight:500;">To</span>
                                <input type="time" class="form-control time_range" name="end_time">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            
           
            <!--<div class="card-body p-3">
                <div class="row">

                    <div class="col-lg-6  col-xl-6 col-md-6 col-12">
                        <div class="form-group ">
                            <label class="font_family w-75" for="coupon">
                                <span class="mb-2" style="font-weight:500;">From</span>
                                <input type="time" class="form-control" name="start_time">
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6 col-12">
                        <div class="form-group ">
                            <label class="font_family w-75" for="coupon">
                                <span class="mb-2" style="font-weight:500;" name="end_time">To</span>
                                <input type="time" class="form-control">
                            </label>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>

        <div class="card card_width mb-4">
            <div class="card-header" style="background-color: transparent;font-weight: 500;">
                BroadCast Message
            </div>
            <div class="card-body p-3">
                <textarea name="message" id="message"></textarea>
            </div>
        </div>

        <input type="submit" class="btn  orange_btn text-white mb-4" value="Submit">

    </form>
</div>


<!-- Start Delete Popup Window Here -->
            <div class="modal fade" id="delete_hour" tabindex="-1" aria-labelledby="delete_hourLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="addtiming_form" action="<?= base_url() ?>staffhours/deleteoperetionalhours"
                            method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete_hourLabel">Delete operation hours</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <strong>Are you want to delete Coupon </strong>
                            </div>

                            <div class="modal-footer-new">
                                <input type="hidden" name="operation_hour_id" id="operation_hour_id" value="" />
                                <button type="submit"
                                    class="btn modal_btn_width text-white modal_btn_one">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Delete Popup Window Here -->
        </div>
        <!-- End Mid Right -->

        <script type="text/javascript">
        $("#submit_form").submit(function(e) {
            e.preventDefault();
            var formData = $("#submit_form").serialize();

            $.ajax({
                type: 'POST',
                url: '<?= base_url() . "marketingtools/store_broadcaster" ?>',
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
                                "<?= base_url() . "marketingtools/broadcaster"; ?>"
                        }, 5000);
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
                        scrollTop: $('#data_picker').top
                    }, 'slow');
                }

            });
        });
        </script>

        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <script type="text/javascript">
        var ckfield = CKEDITOR.replace('message');
        ckfield.on('change', function() {
            ckfield.updateElement();
        });
        </script>
        <script>
        $(document).ready(function() {
            var checkbox_val = $('input[name="duration"]:checked').val();
            if (checkbox_val == "Range") {
                $(".week-days").hide();
                $(".date-range").show();
            } else {
                $(".date-range").hide();
                $(".week-days").show();
            }
            $('input[name="all_day"]').click(function() {
                if ($('input[name="all_day"]').attr("checked")) {
                    $(".time_range").attr("disabled", true);
                } else {
                    console.log("not checked");
                    $(".time_range").attr("disabled", false);
                }
            });
        });
        $('input[name="duration"]').click(function() {
            var checkbox_val = $('input[name="duration"]:checked').val();
            if (checkbox_val == "Range") {
                $(".week-days").hide();
                $(".date-range").show();

            } else {
                $(".date-range").hide();
                $(".week-days").show();
            }
        });
        $('input[name="all_day"]').click(function() {
            if ($('input[name="all_day"]').attr("checked")) {
                $(".time_range").attr("disabled", true);

            } else {
                console.log("not checked");
                $(".time_range").attr("disabled", false);
            }
        });
        </script>

        <?
$this->load->view("restaurantportal/footer_view");
?>